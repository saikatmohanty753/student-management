<?php

namespace App\Http\Controllers;

use App\Models\AdmissionSeat;
use App\Models\City;
use App\Models\College;
use App\Models\Course;
use App\Models\CourseFor;
use App\Models\District;
use App\Models\Notice;
use Illuminate\Support\Facades\Artisan;
use App\Models\StudentAddress;
use App\Models\StudentApplication;
use App\Models\StudentDetails;
use App\Models\StudentDocuments;
use App\Models\StudentEducationDetails;
use App\Models\StudentLog;
use App\Models\StudentDetailList;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Mail;
use PDF;
use Yajra\DataTables\DataTables;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Repositories\CustomRepository;
use Illuminate\Support\Facades\File;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $app;
    public function __construct(CustomRepository $app)
    {
        $this->middleware('permission:verify-admission-edit', ['only' => ['verifyAdmission', 'verifyStudentAdmission']]);
        $this->app = $app;
    }

    public function AdmissionSeat()
    {
        $course = DB::table('affiliation_masters')->select('affiliation_masters.*', DB::raw('SUM(seat_no) as total_seat_no'))
            ->groupBy('affiliation_masters.course')
            ->groupBy('affiliation_masters.college_name')
            ->get();
        $arr = array();
        foreach ($course as $key => $value) {
            $crs = Course::where('id', $value->course)->first(['course_for']);
            $chk = DB::table('admission_seats')
                ->where('clg_id', $value->college_name)
                ->where('course_id', $value->course)
                ->where('admission_year', date('Y'))
                ->count();
            if ($chk == 0) {
                DB::table('admission_seats')->insert([
                    'admission_year' => date('Y'),
                    'clg_id' => $value->college_name,
                    'department_id' => $crs->course_for,
                    'course_id' => $value->course,
                    'total_strength' => $value->total_seat_no,
                    'available_seat' => $value->total_seat_no,
                    'consumption_seat' => 0,
                    'created_at' => Carbon::now(),
                ]);
                $arr = [
                    $value->college_name,
                    $value->total_seat_no,
                    $value->total_seat_no,
                ];
            }
        }
    }

    public function index($id, $dep, $depId)
    {

        $count = Notice::whereDate('start_date', '<=', Carbon::now())
            ->whereDate('exp_date', '>', Carbon::now())
            ->where('id', $id)
            ->count();
        if ($count == 0) {
            return redirect()->intended('dashboard')->with('error', 'Now the admission process has been stopped.');
        }
        $course = DB::table('admission_seats')->select('admission_seats.*', 'courses.name')
            ->where('clg_id', Auth::user()->clg_user_id)
            ->where('admission_year', date('Y'))
            ->join('courses', 'admission_seats.course_id', 'courses.id')
            ->where('courses.course_for', $depId)
            ->get();
        $district = District::all();
        return view('admission.index', compact('course', 'district', 'depId', 'dep'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dump($request->all());
        $clgId = Auth::user()->clg_user_id;
        if ($this->checkSeatAvl($clgId, $request->course) == 0) {
            return redirect()->action([AdmissionController::class, 'admissionList'])->with('error', 'You have already fill up all the seats');
        }
        /**************************************
        * New Validation code added by Saikat
        * 03-07-2023
        **************************************/
        $studentApplicationTable = 'student'.$clgId.'_applications';
        $studentUserTable = 'student'.$clgId.'_users';
        $studentDetailTable = 'student'.$clgId.'_details';
        $studentApplicationModel = 'Student'.$clgId.'Application';
        $studentUserModel = 'Student'.$clgId.'User';
        $studentDetailModel = 'Student'.$clgId.'Details';

        if (Schema::hasTable($studentApplicationTable)) {

            $student_check = DB::table($studentApplicationTable)->where('email',$request->email)->where('status',3);

            if($student_check->exists())
            {
                $student_check = $student_check->first();
                if($this->getDiffYear($student_check->admission_date,date('Y-m-d')) < 1 && $request->course == $student_check->course_id)
                {
                    return redirect()->back()->with('error','This student addmission form has been rejected for applied course on '.date('d-m-Y',strtotime($student_check->admission_date)));
                }
            }
            if (Schema::hasTable($studentUserTable)) {
                $users_exists = DB::table($studentUserTable)->where('is_active',1)->where('email',$request->email);
                if($users_exists->exists())
                {
                    $users_exists = $users_exists->first();
                    $student_details = DB::table($studentDetailTable)->where('id',$users_exists->student_id);
                    if($student_details->exists())
                    {
                        $student_details = $student_details->first();
                        $arr_batch = $this->getBatch($student_details->batch_year);
                        if($arr_batch['to'] < date('Y'))
                        {
                            return redirect()->back()->with('error','Enrolled in the applied course in not ended');
                        }
                        if($student_details->course_id == $request->course)
                        {
                            return redirect()->back()->with('error','Already enrolled in the applied course');
                        }
                    }
                    return redirect()->back()->with('error','Email id already exists');
                }
            }
        }
        /* **********************************
        * Ends here
        *************************************/

        $course = Course::find($request->course);

        if (!Schema::hasTable($studentApplicationTable)) {
            Schema::create($studentApplicationTable, function (Blueprint $table) {
                $table->increments('id');
                $table->string('academic_year','200')->nullable();
                $table->date('admission_date')->nullable();
                $table->string('clg_id','200')->nullable();
                $table->string('email','200')->nullable();
                $table->tinyInteger('is_university')->default(0);
                $table->integer('department_id')->unsigned()->nullable();
                $table->integer('course_id')->unsigned()->nullable();
                $table->text('personal_information')->nullable();
                $table->text('present_address')->nullable();
                $table->text('permanent_address')->nullable();
                $table->text('prv_clg_info')->nullable();
                $table->text('qualification_details')->nullable();
                $table->text('documents')->nullable();
                $table->enum('app_status', ['0', '1'])->nullable();
                $table->integer('status')->unsigned()->nullable();
                $table->text('remarks')->nullable();
                $table->text('remarks_app_university')->nullable();
                $table->string('application_no','200')->nullable();
                $table->string('app_count_no','200')->nullable();
                $table->string('descipline','200')->nullable();
                $table->timestamps();
            });
            $modelPath = app_path('Models'.'\\'.$studentApplicationModel . '.php');
            $modelTemp = $this->modelTemplate($studentApplicationModel,$studentApplicationTable);
            if (!File::exists($modelPath)) {
                File::put($modelPath, $modelTemp);
            }
            if (Schema::hasTable($studentApplicationTable)) {
                $liststudent = new StudentDetailList;
                $liststudent->clg_id = $clgId;
                $liststudent->table_name = $studentApplicationTable;
                $liststudent->model = $studentApplicationModel;
                $liststudent->type = 2;
                $liststudent->save();
            }
        }
        if (!Schema::hasTable($studentUserTable)) {
            Schema::create($studentUserTable, function (Blueprint $table) {
                $table->increments('id');
                $table->string('name','200')->nullable();
                $table->string('email')->unique()->nullable();
                $table->integer('role_id')->unsigned()->nullable();
                $table->string('clg_id','200')->nullable();
                $table->tinyInteger('is_active')->default(1);
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password', 200)->nullable();
                $table->string('remember_token','200')->nullable();
                $table->string('batch_year','200')->nullable();
                $table->bigInteger('mob_no')->nullable();
                $table->integer('clg_user_id')->unsigned()->nullable();
                $table->integer('student_id')->unsigned()->nullable();
                $table->timestamps();
            });
            $modelPath = app_path('Models'.'\\'.$studentUserModel . '.php');
            $modelTemp = $this->modelUserTemplate($studentUserModel,$studentUserTable);
            if (!File::exists($modelPath)) {
                File::put($modelPath, $modelTemp);
            }
        }
        if (Schema::hasTable($studentUserTable)) {
            $liststudent = new StudentDetailList;
            $liststudent->clg_id = $clgId;
            $liststudent->table_name = $studentUserTable;
            $liststudent->model = $studentUserModel;
            $liststudent->type = 1;
            $liststudent->save();
        }

        $class = modelFn($studentApplicationModel);

        $student = new $class;
        $student->academic_year = date('Y');
        $student->admission_date = Carbon::now();
        //$student->clg_id = Carbon::now();
        $student->clg_id = $clgId;
        $student->department_id = $course->course_for;
        $student->course_id = $request->course;
        $student->app_status = 1;
        $student->email = $request->email;

        $student_details = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'mother_name' => $request->mother_name,
            'father_name' => $request->father_name,
            'gender' => $request->gender,
            'dob' => Carbon::parse($request->dob),
            'cast' => $request->cast_category,
            'specially_abled' => $request->specially_abled,
            'aadhaar_no' => $request->aadhaar_no,
        ];
        $present_address = [
            'present_state' => $request->present_state,
            'present_district_id' => $request->present_district,
            'present_pin_code' => $request->present_pin_code,
            'present_address' => $request->present_address,

        ];
        $permanent_address = [
            'permanent_state' => $request->permanent_state,
            'permanent_district_id' => $request->permanent_district,
            'permanent_pin_code' => $request->permanent_pin_code,
            'permanent_address' => $request->permanent_address,
        ];
        $prv_clg_info = [
            'clg_name' => $request->last_collage_name,
            'year_of_passing' => $request->last_passing_year,
            'course_name' => $request->last_course_name,
            'is_migration_cert' => $request->is_migration,
        ];

        $documents = [];
        if ($request->file('profile')) {
            $file = $request->file('profile');
            $filename = time() . uniqid(rand()) . $file->getClientOriginalName();
            $file->move(public_path('/student-documents/profile'), $filename);
            $profile = '/student-documents/profile/' . $filename;
            $documents['profile'] = $profile ? $profile : '';
        } else {
            $documents['profile'] = '';
        }
        if ($request->file('aadhaar_card')) {
            $file = $request->file('aadhaar_card');
            $filename = time() . uniqid(rand()) . $file->getClientOriginalName();
            $file->move(public_path('/student-documents/aadhaar_card'), $filename);
            $aadhaar_card = '/student-documents/aadhaar_card/' . $filename;
            $documents['aadhaar_card'] = $aadhaar_card ? $aadhaar_card : '';
        } else {
            $documents['aadhaar_card'] = '';
        }

        if ($request->file('hsc_cert')) {
            $file = $request->file('hsc_cert');
            $filename = time() . uniqid(rand()) . $file->getClientOriginalName();
            $file->move(public_path('/student-documents/hsc_cert'), $filename);
            $hsc_cert = '/student-documents/hsc_cert/' . $filename;
            $documents['hsc_cert'] = $hsc_cert ? $hsc_cert : '';
        } else {
            $documents['hsc_cert'] = '';
        }
        if ($request->file('migration_cert')) {
            $file = $request->file('migration_cert');
            $filename = time() . uniqid(rand()) . $file->getClientOriginalName();
            $file->move(public_path('/student-documents/migration_cert'), $filename);
            $migration_cert = '/student-documents/migration_cert/' . $filename;
            $documents['migration_cert'] = $migration_cert ? $migration_cert : '';
        } else {
            $documents['migration_cert'] = '';
        }
        $qualification_details = [
            'hsc' => [
                'course' => $request->hsc,
                'board' => $request->hsc_board,
                'passing_year' => $request->hsc_passing_year,
                'month' => $request->hsc_passing_month,
                'roll' => $request->hsc_roll,
                'division' => $request->hsc_division,
                'mark' => $request->hsc_mark,
                'total' => $request->hsc_total_mark,
                'percentage' => $request->hsc_percentage,
            ],
            'intermediate' => [
                'course' => $request->intermediate,
                'board' => $request->intermediate_board,
                'passing_year' => $request->intermediate_passing_year,
                'month' => $request->intermediate_passing_month,
                'roll' => $request->intermediate_roll,
                'division' => $request->intermediate_division,
                'mark' => $request->intermediate_mark,
                'total' => $request->intermediate_total_mark,
                'percentage' => $request->intermediate_percentage,
            ],
            'graduate' => [
                'course' => $request->graduate,
                'board' => $request->graduate_board,
                'passing_year' => $request->graduate_passing_year,
                'month' => $request->graduate_passing_month,
                'roll' => $request->graduate_roll,
                'division' => $request->graduate_division,
                'mark' => $request->graduate_mark,
                'total' => $request->graduate_total_mark,
                'percentage' => $request->graduate_percentage,
            ],
            'postGraduate' => [
                'course' => $request->post_graduate,
                'board' => $request->post_graduate_board,
                'passing_year' => $request->post_graduate_passing_year,
                'month' => $request->post_graduate_passing_month,
                'roll' => $request->post_graduate_roll,
                'division' => $request->post_graduate_division,
                'mark' => $request->post_graduate_mark,
                'total' => $request->post_graduate_total_mark,
                'percentage' => $request->post_graduate_percentage,
            ],
            'other' => [
                'course' => $request->other_graduate,
                'board' => $request->other_graduate_board,
                'passing_year' => $request->other_graduate_passing_year,
                'month' => $request->other_graduate_passing_month,
                'roll' => $request->other_graduate_roll,
                'division' => $request->other_graduate_division,
                'mark' => $request->other_graduate_mark,
                'total' => $request->other_graduate_total_mark,
                'percentage' => $request->other_graduate_percentage,
            ],
        ];
        //dd('ok');
        $student->personal_information = json_encode($student_details);
        $student->present_address = json_encode($present_address);
        $student->permanent_address = json_encode($permanent_address);
        // $student->permanent_address = json_encode($permanent_address);
        $student->prv_clg_info = json_encode($prv_clg_info);
        $student->documents = json_encode($documents);
        $student->qualification_details = json_encode($qualification_details);
        $student->save();

        return redirect()->action([AdmissionController::class, 'show'], ['id' => $student->id])->with('success', 'Application saved in draft.');
    }

    public function getBatch($batch)
    {
        $batch_arr = array('to'=>'','from'=>'');
        if(!empty($batch))
        {
            $arr_batch = explode('-',$batch);
            $batch_arr = array(
                'to'=>$arr_batch[1],
                'from'=>$arr_batch[0],
            );
        }
        return $batch_arr;
    }

    public function getDiffYear($start,$end)
    {
        $diff = abs(strtotime($end)-strtotime($start));
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        return $years;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clgId = Auth::user()->clg_user_id;
        $class = $studentApplicationModel = 'Student'.$clgId.'Application';
        $std_app = modelFn($class)::where('id',$id)->first();
        $personal_information = json_decode($std_app->personal_information);
        $present_address = json_decode($std_app->present_address);
        $present_address->district = presentDis($std_app->present_address);
        $permanent_address = json_decode($std_app->permanent_address);
        $permanent_address->district = permanentDis($std_app->permanent_address);
        $prv_clg_info = json_decode($std_app->prv_clg_info);
        $documents = json_decode($std_app->documents);
        $qualification_details = json_decode($std_app->qualification_details);
        //dd($std_app);
        // return $app->course;
        return view('admission.view', compact('std_app', 'personal_information', 'present_address', 'permanent_address', 'prv_clg_info', 'documents', 'qualification_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $district = District::get();
        $clgId = Auth::user()->clg_user_id;
        $class = $studentApplicationModel = 'Student'.$clgId.'Application';
        $std_app = modelFn($class)::find($id);
        //$std_app = StudentApplication::find($id);
        $personal_information = json_decode($std_app->personal_information);
        $present_address = json_decode($std_app->present_address);
        $present_address->district = $std_app->presentDis();
        $permanent_address = json_decode($std_app->permanent_address);
        $permanent_address->district = $std_app->presentDis();
        $prv_clg_info = json_decode($std_app->prv_clg_info);
        $documents = json_decode($std_app->documents);
        $qualification_details = json_decode($std_app->qualification_details);

        $course = DB::table('admission_seats')->select('admission_seats.*', 'courses.name')
            ->where('clg_id', Auth::user()->clg_user_id)
            ->where('admission_year', date('Y'))
            ->join('courses', 'admission_seats.course_id', 'courses.id')
            ->where('courses.course_for', $std_app->department_id)
            ->get();
        return view('admission.edit', compact('std_app', 'present_address', 'personal_information', 'permanent_address', 'course', 'district', 'prv_clg_info', 'qualification_details', 'documents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $clgId = Auth::user()->clg_user_id;
        if ($this->checkSeatAvl($clgId, $request->course) == 0) {
            return redirect()->action([AdmissionController::class, 'admissionList'])->with('error', 'You have already fill up all the seats');
        }
        /**************************************
        * New Validation code added by Saikat
        * 03-07-2023
        **************************************/
        $class = $studentApplicationModel = 'Student'.$clgId.'Application';
        $student_check = DB::table($studentApplicationModel)->where('email',$request->email)->where('status',3);

        if($student_check->exists())
        {
            $student_check = $student_check->first();
            if($this->getDiffYear($student_check->admission_date,date('Y-m-d')) < 1 && $request->course == $student_check->course_id)
            {
                return redirect()->back()->with('error','This student addmission form has been rejected for applied course on '.date('d-m-Y',strtotime($student_check->admission_date)));
            }
        }

        $users_exists = DB::table('users')->where('is_active',1)->where('email',$request->email);
        if($users_exists->exists())
        {
            $users_exists = $users_exists->first();
            $student_details = DB::table('student_details')->where('id',$users_exists->student_id);
            if($student_details->exists())
            {
                $student_details = $student_details->first();
                $arr_batch = $this->getBatch($student_details->batch_year);
                if($arr_batch['to'] < date('Y'))
                {
                    return redirect()->back()->with('error','Enrolled in the applied course in not ended');
                }
                if($student_details->course_id == $request->course)
                {
                    return redirect()->back()->with('error','Already enrolled in the applied course');
                }
            }
            return redirect()->back()->with('error','Email id already exists');
        }
        /* **********************************
        * Ends here
        *************************************/
        $id = $request->hid;
        $course = Course::find($request->course);

        $student = modelFn($class)::find($id);
        //$student = StudentApplication::find($id);
        $student->academic_year = date('Y');
        $student->admission_date = Carbon::now();
        $student->clg_id = Carbon::now();
        $student->clg_id = $clgId;
        $student->department_id = $course->course_for;
        $student->course_id = $request->course;
        $student->app_status = 1;
        $student->email = $request->email;

        $student_details = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'mother_name' => $request->mother_name,
            'father_name' => $request->father_name,
            'gender' => $request->gender,
            'dob' => Carbon::parse($request->dob),
            'cast' => $request->cast_category,
            'specially_abled' => $request->specially_abled,
            'aadhaar_no' => $request->aadhaar_no,
        ];
        $present_address = [
            'present_state' => $request->present_state,
            'present_district_id' => $request->present_district,
            'present_pin_code' => $request->present_pin_code,
            'present_address' => $request->present_address,

        ];
        $permanent_address = [
            'permanent_state' => $request->permanent_state,
            'permanent_district_id' => $request->permanent_district,
            'permanent_pin_code' => $request->permanent_pin_code,
            'permanent_address' => $request->permanent_address,
        ];
        $prv_clg_info = [
            'clg_name' => $request->last_collage_name,
            'year_of_passing' => $request->last_passing_year,
            'course_name' => $request->last_course_name,
            'is_migration_cert' => $request->is_migration,
        ];
        $doc = json_decode($student->documents);
        $documents = [
            'profile' => $doc->profile,
            'aadhaar_card' => $doc->aadhaar_card,
            'hsc_cert' => $doc->hsc_cert,
            'migration_cert' => $doc->migration_cert,
        ];
        if ($request->file('profile')) {
            $file = $request->file('profile');
            $filename = time() . uniqid(rand()) . $file->getClientOriginalName();
            $file->move(public_path('/student-documents/profile'), $filename);
            $profile = '/student-documents/profile/' . $filename;
            $documents['profile'] = $profile ? $profile : '';
        }
        if ($request->file('aadhaar_card')) {
            $file = $request->file('aadhaar_card');
            $filename = time() . uniqid(rand()) . $file->getClientOriginalName();
            $file->move(public_path('/student-documents/aadhaar_card'), $filename);
            $aadhaar_card = '/student-documents/aadhaar_card/' . $filename;
            $documents['aadhaar_card'] = $aadhaar_card ? $aadhaar_card : '';
        }

        if ($request->file('hsc_cert')) {
            $file = $request->file('hsc_cert');
            $filename = time() . uniqid(rand()) . $file->getClientOriginalName();
            $file->move(public_path('/student-documents/hsc_cert'), $filename);
            $hsc_cert = '/student-documents/hsc_cert/' . $filename;
            $documents['hsc_cert'] = $hsc_cert ? $hsc_cert : '';
        }
        if ($request->file('migration_cert')) {
            $file = $request->file('migration_cert');
            $filename = time() . uniqid(rand()) . $file->getClientOriginalName();
            $file->move(public_path('/student-documents/migration_cert'), $filename);
            $migration_cert = '/student-documents/migration_cert/' . $filename;
            $documents['migration_cert'] = $migration_cert ? $migration_cert : '';
        }
        // return $documents;
        // return $request;
        $qualification_details = [
            'hsc' => [
                'course' => $request->hsc,
                'board' => $request->board,
                'passing_year' => $request->hsc_passing_year,
                'month' => $request->hsc_passing_month,
                'roll' => $request->hsc_roll,
                'division' => $request->division,
                'mark' => $request->hsc_mark,
                'total' => $request->total_mark,
                'percentage' => $request->percentage,
            ],
            'intermediate' => [
                'course' => $request->intermediate,
                'board' => $request->intermediate_board,
                'passing_year' => $request->intermediate_passing_year,
                'month' => $request->intermediate_passing_month,
                'roll' => $request->intermediate_roll,
                'division' => $request->intermediate_division,
                'mark' => $request->intermediate_mark,
                'total' => $request->intermediate_total_mark,
                'percentage' => $request->intermediate_percentage,
            ],
            'graduate' => [
                'course' => $request->graduate,
                'board' => $request->graduate_board,
                'passing_year' => $request->graduate_passing_year,
                'month' => $request->graduate_passing_month,
                'roll' => $request->graduate_roll,
                'division' => $request->graduate_division,
                'mark' => $request->graduate_mark,
                'total' => $request->graduate_total_mark,
                'percentage' => $request->graduate_percentage,
            ],
            'postGraduate' => [
                'course' => $request->post_graduate,
                'board' => $request->post_graduate_board,
                'passing_year' => $request->post_graduate_passing_year,
                'month' => $request->post_graduate_passing_month,
                'roll' => $request->post_graduate_roll,
                'division' => $request->post_graduate_division,
                'mark' => $request->post_graduate_mark,
                'total' => $request->post_graduate_total_mark,
                'percentage' => $request->post_graduate_percentage,
            ],
            'other' => [
                'course' => $request->other_graduate,
                'board' => $request->other_graduate_board,
                'passing_year' => $request->other_graduate_passing_year,
                'month' => $request->other_graduate_passing_month,
                'roll' => $request->other_graduate_roll,
                'division' => $request->other_graduate_division,
                'mark' => $request->other_graduate_mark,
                'total' => $request->other_graduate_total_mark,
                'percentage' => $request->other_graduate_percentage,
            ],
        ];
        $student->personal_information = json_encode($student_details);
        $student->present_address = json_encode($present_address);
        $student->permanent_address = json_encode($permanent_address);
        // $student->permanent_address = json_encode($permanent_address);
        $student->prv_clg_info = json_encode($prv_clg_info);
        $student->documents = json_encode($documents);
        $student->qualification_details = json_encode($qualification_details);
        $student->save();
        return redirect()->action([AdmissionController::class, 'show'], ['id' => $student->id])->with('success', 'Application saved in draft.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function apply(Request $request)
    {
        $clgId = Auth::user()->clg_user_id;
        $class = 'Student'.$clgId.'Application';
        $application = modelFn($class)::find($request->id);
        //$application = StudentApplication::find($request->id);
        if ($this->checkSeatAvl($clgId, $application->course_id) == 0) {
            return redirect()->action([AdmissionController::class, 'admissionList'])->with('error', 'You have already fill up all the seats');
        }
        $application->status = 1;
        $application->app_status = 2;
        $application->save();

        $course = AdmissionSeat::where('clg_id', $application->clg_id)
            ->where('admission_year', date('Y'))
            ->where('course_id', $application->course_id)
            ->first();
        $avl_seat = $course->available_seat;
        $cons_seat = $course->consumption_seat;
        $course->available_seat = $avl_seat - 1;
        $course->consumption_seat = $cons_seat + 1;
        $course->save();

        return redirect()->action([AdmissionController::class, 'admissionList'])->with('success', 'Application submitted successfully.');
    }

    public function admissionList(Request $request)
    {

        // $clgId = Auth::user()->clg_user_id;
        // return $application = StudentApplication::where('clg_id', $clgId)->orderByDesc('id')->get();
        $clg_courses = DB::table('admission_seats')
            ->where('clg_id', Auth::user()->clg_user_id)
            ->groupBy('course_id')
            ->pluck('course_id')
            ->all();
        /* dump(Auth::user()->clg_user_id);
        dd($clg_courses); */
        $department = CourseFor::all();
        $course = Course::whereIn('id', $clg_courses)->get();
        return view('admission.list', compact('department', 'course'));
    }

    public function studentadmissionList(Request $request)
    {

        if ($request->ajax()) {
            $clgId = Auth::user()->clg_user_id;
            $class = 'Student'.$clgId.'Application';
            $studentApplicationTable = 'student'.$clgId.'_applications';
            $data = modelFn($class)::select($studentApplicationTable.'.*', 'dep.course_for', 'course.name')
                ->join('course_fors as dep', 'dep.id', '=', $studentApplicationTable.'.department_id')
                ->join('courses as course', 'course.id', '=', $studentApplicationTable.'.course_id')
                ->where('clg_id', $clgId)
                ->where('academic_year', date('Y'))
                ->whereIn($studentApplicationTable.'.status', [1]);

            if ($request->get('dep') != '') {
                $data->where($studentApplicationTable.'.department_id', $request->get('dep'));
            }
            if ($request->get('course') != '') {
                $data->where($studentApplicationTable.'.course_id', $request->get('course'));
            }
            if ($request->get('session') != '') {
                $data->where($studentApplicationTable.'.academic_year', $request->get('session'));
            }

            $data = $data->get();

            // Decode personal_information field for each row
            foreach ($data as $row) {
                $row->personal_information = json_decode($row->personal_information);
                $row->status = $row->applicationStatus();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function appliedAdmissionList(Request $request,$clgId)
    {
        $clgAuthId = Auth::user()->clg_user_id;
        if(!empty($clgAuthId))
        {
            $clgId = $clgAuthId;
        }elseif(empty($clgId))
        {
            return back();
        }
        $class = 'Student'.$clgId.'Application';
        //dd($clgId);
        $application = modelFn($class)::where('status', 1)->orderBy('id', 'desc')->get();
        $verified_application = modelFn($class)::where('status', 2)->orderBy('id', 'desc')->get();
        $rejected_application = modelFn($class)::where('status', 3)->orderBy('id', 'desc')->get();
        return view('admin.admission.index', compact('application', 'verified_application', 'rejected_application'));
    }

    public function verifyAdmission(Request $request, $id,$clg_id)
    {
        $clgId = $clg_id;
        $class = 'Student'.$clgId.'Application';
        $std_app = modelFn($class)::find($id);

        //dd(Auth::user());
        $personal_information = json_decode($std_app->personal_information);
        $present_address = json_decode($std_app->present_address);
        $present_address->district = $std_app->presentDis();
        $permanent_address = json_decode($std_app->permanent_address);
        $permanent_address->district = $std_app->presentDis();
        $prv_clg_info = json_decode($std_app->prv_clg_info);
        $documents = json_decode($std_app->documents);
        $qualification_details = json_decode($std_app->qualification_details);
        return view('admin.admission.verify', compact(
            'std_app',
            'personal_information',
            'present_address',
            'permanent_address',
            'prv_clg_info',
            'documents',
            'qualification_details',
            'clg_id'
        ));
    }

    public function verifyStudentAdmission(Request $request)
    {

        if ($request->status == 2) {
            $course_section = Course::where('id', $request->course_id)->first();
            $section_name = CourseFor::where('id', $course_section->course_for)->first('course_for');

            if ($section_name->course_for == 'UG') {
                $year1 = Carbon::now()->addYear(4);
                $year = date('Y', strtotime($year1));
            } elseif ($section_name->course_for == 'PG') {
                $year2 = Carbon::now()->addYear(2);
                $year = date('Y', strtotime($year2));
            } elseif ($section_name->course_for == 'M.Phil') {
                $year3 = Carbon::now()->addYear(1);
                $year = date('Y', strtotime($year3));
            } elseif ($section_name->course_for == 'Certificate') {
                $year4 = Carbon::now()->addYear(1);
                $year = date('Y', strtotime($year4));
            }
            $clgId = $request->clg_id;
            $class = 'Student'.$clgId.'Application';
            $std_app = modelFn($class)::where('id', $request->id)->first();
            $std_app->remarks = $request->remarks;
            $std_app->status = $request->status;
            $std_app->save();

            $info = json_decode($std_app->personal_information);
            $prs_address = json_decode($std_app->present_address);
            $per_address = json_decode($std_app->permanent_address);
            $clg_info = json_decode($std_app->prv_clg_info);
            $qualification = json_decode($std_app->qualification_details);
            $documents = json_decode($std_app->documents);

            $studentDetailsTable = 'student'.$std_app->clg_id.'_details';
            $studentDetailsModel = 'Student'.$std_app->clg_id.'Details';
            if (!Schema::hasTable($studentDetailsTable)) {
                Schema::create($studentDetailsTable, function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('clg_id')->nullable();
                    $table->integer('student_id')->nullable();
                    $table->integer('current_semester')->nullable();
                    $table->integer('user_id')->nullable();
                    $table->integer('department_id')->nullable();
                    $table->integer('course_id')->nullable();
                    $table->string('name')->nullable();
                    $table->string('email')->nullable();
                    $table->string('mobile')->nullable();
                    $table->string('mother_name')->nullable();
                    $table->string('father_name')->nullable();
                    $table->string('gender')->nullable();
                    $table->date('dob')->nullable();
                    $table->string('cast')->nullable();
                    $table->enum('specially_abled', ['0', '1'])->default('0');
                    $table->string('aadhaar_no')->nullable();
                    $table->string('roll_no')->nullable();
                    $table->string('regd_no')->nullable();
                    $table->enum('regd_no_issued', ['0', '1'])->default('0');
                    $table->enum('app_status', ['0', '1'])->default('0');
                    $table->integer('status')->nullable();
                    $table->text('remarks')->nullable();
                    $table->string('batch_year')->nullable();
                    $table->string('admission_year')->nullable();
                    $table->string('profile_picture')->nullable();
                    $table->string('addmission_exam')->nullable();
                    $table->string('completed_semester')->nullable();
                    $table->timestamps();
                });
                $modelPath = app_path('Models'.'\\'.$studentDetailsModel . '.php');
                $modelTemp = $this->modelTemplate($studentDetailsModel,$studentDetailsTable);
                if (!File::exists($modelPath)) {
                    File::put($modelPath, $modelTemp);
                }
                if (Schema::hasTable($studentDetailsTable)) {
                    $liststudent = new StudentDetailList;
                    $liststudent->clg_id = $std_app->clg_id;
                    $liststudent->table_name = $studentDetailsTable;
                    $liststudent->model = $studentDetailsModel;
                    $liststudent->type = 4;
                    $liststudent->save();
                }
            }
            $studentUserModel = 'Student'.$std_app->clg_id.'User';
            $user_id = '';
            $urs = modelFn($studentUserModel)::where('email', $std_app->email);
            if (!$urs->exists()) {
                $userClass = modelFn($studentUserModel);
                $user = new $userClass;
                $user->name = $info->name;
                $user->email = $info->email;
                $user->mob_no = $info->mobile;
                $user->clg_id = $std_app->clg_id;
                $user->student_id = $request->id;
                $user->role_id = 3;
                $user->batch_year = date('Y') . '-' . $year;
                $user->password = Hash::make(12345678);
                if($user->save())
                {
                    $user_id = $user->id;
                    $student_logs = new StudentLog;
                    $student_logs->user_id = $user->id;
                    $student_logs->student_id = $std_app->id;
                    $student_logs->course_id = $std_app->course_id;
                    $student_logs->department_id = $std_app->department_id;
                    $student_logs->clg_id = $std_app->clg_id;
                    $student_logs->updated_by = Auth::user()->id;
                    $student_logs->name = $info->name;
                    $student_logs->email = $info->email;
                    $student_logs->updated_on = date('Y-m-d h:i:s');
                    $student_logs->save();
                }
                $data = [
                    "name" => $user->name,
                    "user_name" => $user->email,
                    "password" => 12345678,
                ];

                Mail::send('mail.credential', compact('data'), function ($message) use ($user) {
                    $message->to($user->email);
                    $message->subject('Login credential for UUC');
                });
            }else{
                $urs = $urs->first();
                $user_id = $urs->id;
                $student_details = modelFn($class)::where('id',$urs->student_id)->first();
                if($std_app->course_id != $student_details->course_id)
                {
                    $batch = $this->getBatch($student_details->batch_year);
                    if($batch[1] < date('Y'))
                    {
                        $urs->student_id = $std_app->id;
                        $urs->batch_year = date('Y') . '-' . $year;
                        $urs->clg_id = $std_app->clg_id;
                        if($urs->update())
                        {
                            $student_logs = new StudentLog;
                            $student_logs->user_id = $urs->id;
                            $student_logs->student_id = $std_app->id;
                            $student_logs->course_id = $std_app->course_id;
                            $student_logs->department_id = $std_app->department_id;
                            $student_logs->clg_id = $std_app->clg_id;
                            $student_logs->updated_by = Auth::user()->id;
                            $student_logs->name = $urs->name;
                            $student_logs->email = $urs->email;
                            $student_logs->updated_on = date('Y-m-d h:i:s');
                            $student_logs->save();
                        }
                    }
                }
            }

            $detailClass = modelFn($studentDetailsModel);
            $student = new $detailClass;
            $student->clg_id = $std_app->clg_id;
            $student->department_id = $std_app->department_id;
            $student->course_id = $std_app->course_id;
            $student->student_id = $request->id;
            $student->user_id = $user_id;

            $student->name = $info->name;
            $student->email = $info->email;
            $student->mobile = $info->mobile;
            $student->mother_name = $info->mother_name;
            $student->father_name = $info->father_name;
            $student->gender = $info->gender;
            $student->dob = Carbon::parse($info->dob);
            $student->cast = $info->cast;
            $student->specially_abled = $info->specially_abled;
            $student->aadhaar_no = $info->aadhaar_no;
            $student->regd_no_issued = $request->issued == 1 ? '1' : '0';
            $student->admission_year = date('Y');
            $student->batch_year = date('Y') . '-' . $year;
            $student->save();

            $std = modelFn($studentDetailsModel)::where('regd_no', '!=', null)->latest()->first();
            if ($std) {
                $regdNo = $std->regd_no;
                $regdNo = substr($regdNo, 5);
                $increment = $regdNo + 1;
                $regdNo = str_pad($increment, 5, '0', STR_PAD_LEFT);
                $regdNo = 'UUC' . date('y') . $regdNo;
            } else {
                $regdNo = str_pad($student->id, 5, '0', STR_PAD_LEFT);
                $regdNo = 'UUC' . date('y') . $regdNo;
            }
            modelFn($studentDetailsModel)::where('id', $student->id)->update(['regd_no' => $regdNo]);

            $this->generatePDF($info->email, $info->name, $regdNo, $request->issued, $std_app->clg_id, date('Y') . '-' . $year);

            $std_id = $std_app->id;
            $studentAddressTable = 'student'.$request->clg_id.'_addresses';
            $studentAddressModel = 'Student'.$request->clg_id.'Address';
            if (!Schema::hasTable($studentAddressTable)) {
                Schema::create($studentAddressTable, function (Blueprint $table) {
                    $table->increments('id');
                    $table->integer('student_id')->nullable();
                    $table->integer('user_id')->nullable();
                    $table->string('present_state')->nullable();
                    $table->string('present_district_id')->nullable();
                    $table->string('present_pin_code')->nullable();
                    $table->text('present_address')->nullable();
                    $table->string('permanent_state')->nullable();
                    $table->string('permanent_district_id')->nullable();
                    $table->string('permanent_pin_code')->nullable();
                    $table->text('permanent_address')->nullable();
                    $table->timestamps();
                });
                $modelPath = app_path('Models'.'\\'.$studentAddressModel . '.php');
                $modelTemp = $this->modelAdressTemplate($studentAddressModel,$studentAddressTable);
                if (!File::exists($modelPath)) {
                    File::put($modelPath, $modelTemp);
                }
                if (Schema::hasTable($studentAddressTable)) {
                    $liststudent = new StudentDetailList;
                    $liststudent->clg_id = $request->clg_id;
                    $liststudent->table_name = $studentAddressTable;
                    $liststudent->model = $studentAddressModel;
                    $liststudent->type = 3;
                    $liststudent->save();
                }
            }
            $studentEduTable = 'student'.$request->clg_id.'_education_details';
            $studentEduModel = 'Student'.$request->clg_id.'EducationDetails';
            if (!Schema::hasTable($studentEduTable)) {
                Schema::create($studentEduTable, function (Blueprint $table) {
                    $table->increments('id');
                    $table->integer('student_id')->nullable();
                    $table->integer('user_id')->nullable();
                    $table->string('clg_name')->nullable();
                    $table->string('year_of_passing')->nullable();
                    $table->string('course_name')->nullable();
                    $table->text('qualification')->nullable();
                    $table->enum('is_migration_cert', ['0', '1'])->default('0');
                    $table->timestamps();
                });
                Artisan::call('make:model '.$studentEduModel);
                if (Schema::hasTable($studentEduTable)) {
                    $liststudent = new StudentDetailList;
                    $liststudent->clg_id = $request->clg_id;
                    $liststudent->table_name = $studentEduTable;
                    $liststudent->model = $studentEduModel;
                    $liststudent->type = 5;
                    $liststudent->save();
                }
            }
            $studentDocTable = 'student'.$request->clg_id.'_documents';
            $studentDocModel = 'Student'.$request->clg_id.'Documents';
            if (!Schema::hasTable($studentDocTable)) {
                Schema::create($studentDocTable, function (Blueprint $table) {
                    $table->increments('id');
                    $table->integer('student_id')->nullable();
                    $table->integer('user_id')->nullable();
                    $table->text('photo')->nullable();
                    $table->text('aadhaar_card')->nullable();
                    $table->text('hsc_cert')->nullable();
                    $table->text('migration_cert')->nullable();
                    $table->timestamps();
                });
                Artisan::call('make:model '.$studentDocModel);
                if (Schema::hasTable($studentDocTable)) {
                    $liststudent = new StudentDetailList;
                    $liststudent->clg_id = $request->clg_id;
                    $liststudent->table_name = $studentDocTable;
                    $liststudent->model = $studentDocModel;
                    $liststudent->type = 6;
                    $liststudent->save();
                }
            }
            $adressClass = modelFn($studentAddressModel);
            $address = new $adressClass;
            $address->student_id = $std_id;
            $address->user_id = $user_id;
            $address->present_state = $prs_address->present_state;
            $address->present_district_id = $prs_address->present_district_id;
            $address->present_pin_code = $prs_address->present_pin_code;
            $address->present_address = $prs_address->present_address;
            $address->permanent_state = $per_address->permanent_state;
            $address->permanent_district_id = $per_address->permanent_district_id;
            $address->permanent_pin_code = $per_address->permanent_pin_code;
            $address->permanent_address = $per_address->permanent_address;
            $address->save();

            $eduClass = modelFn($studentEduModel);
            $education = new $eduClass;
            $education->student_id = $std_id;
            $education->user_id = $user_id;
            $education->clg_name = $clg_info->clg_name;
            $education->year_of_passing = $clg_info->year_of_passing;
            $education->course_name = $clg_info->course_name;
            $education->is_migration_cert = $clg_info->is_migration_cert;
            $education->qualification = json_encode($qualification);
            $education->save();

            $docClass = modelFn($studentDocModel);
            $doc = new $docClass;
            $doc->student_id = $std_id;
            $doc->user_id = $user_id;
            $doc->photo = $documents->profile;
            $doc->aadhaar_card = $documents->aadhaar_card;
            $doc->hsc_cert = $documents->hsc_cert;
            $doc->migration_cert = $documents->migration_cert;
            $doc->save();
        } else {

            $student_app = modelFn($class)::where('id', $request->id)->first();
            $student_app->remarks = $request->remarks;
            $student_app->status = $request->status;
            $student_app->save();
        }

        return redirect()->action([AdmissionController::class, 'appliedAdmissionList'])->with('success', 'Application examined successfully.');
    }

    public function generatePDF($email, $name, $reg_no, $issued, $clg_id, $session_yr)
    {

        // dd('123');

        $clg = College::where('id', $clg_id)->first(['name', 'city']);
        $city = City::where('id', $clg->city)->first(['city_name']);
        $data = ['email' => $email, 'name' => $name, 'reg_no' => $reg_no, 'clg' => $clg->name, 'city' => $city->city_name, 'session_yr' => $session_yr];

        $user['to'] = $data["email"];
        $customPaper = array(0, 0, 567.00, 883.80);
        $pdf = PDF::loadView('pdf.student_registration_card', $data);
        $pdf->download('document.pdf');
        $path = public_path() . '/registration_card/';

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        file_put_contents('registration_card/' . $reg_no . '.pdf', $pdf->output());
        // $to_email = $user['to'];
        // Mail::to($to_email)->send(new SendPDFMail($pdf));
        if ($issued == 1) {
            FacadesMail::send('pdf.test', $data, function ($message) use ($pdf, $user) {
                $message->to($user['to'])
                    ->attachData($pdf->output(), "Registration.pdf");
                $message->subject('UUC Registration Card');
            });
        }
        return response()->json(['status' => 'success', 'message' => 'Report has been sent successfully.']);
    }

    public function admissionDetails(Request $request, $id,$clg_id)
    {
        $class = 'Student'.$clg_id.'Application';
        $std_app = modelFn($class)::find($id);
        $personal_information = json_decode($std_app->personal_information);
        $present_address = json_decode($std_app->present_address);
        $present_address->district = $std_app->presentDis();
        $permanent_address = json_decode($std_app->permanent_address);
        $permanent_address->district = $std_app->presentDis();
        $prv_clg_info = json_decode($std_app->prv_clg_info);
        $documents = json_decode($std_app->documents);
        $qualification_details = json_decode($std_app->qualification_details);

        return view('admin.admission.view', compact('id', 'std_app', 'personal_information', 'present_address', 'permanent_address', 'prv_clg_info', 'documents', 'qualification_details'));
    }
    public function appliedApplication($id)
    {
        // return $id;
        $district = District::get();
        $clgId = Auth::user()->clg_user_id;
        $class = 'Student'.$clgId.'Application';
        $std_app = modelFn($class)::find($id);
        $personal_information = json_decode($std_app->personal_information);
        $present_address = json_decode($std_app->present_address);
        $present_address->district = $std_app->presentDis();
        $permanent_address = json_decode($std_app->permanent_address);
        $permanent_address->district = $std_app->presentDis();
        $prv_clg_info = json_decode($std_app->prv_clg_info);
        $documents = json_decode($std_app->documents);
        $qualification_details = json_decode($std_app->qualification_details);

        $course = DB::table('admission_seats')->select('admission_seats.*', 'courses.name')
            ->where('clg_id', Auth::user()->clg_user_id)
            ->where('admission_year', date('Y'))
            ->join('courses', 'admission_seats.course_id', 'courses.id')
            ->where('courses.course_for', $std_app->department_id)
            ->get();

        $student = modelFn($class)::where('id', $id)->first();

        return view('admission.apply_app', compact('std_app', 'present_address', 'personal_information', 'permanent_address', 'course', 'district', 'prv_clg_info', 'qualification_details', 'documents', 'student'));
    }

    public function checkSeatAvl($clg_id, $course_id)
    {
        $course = AdmissionSeat::where('clg_id', $clg_id)
            ->where('admission_year', date('Y'))
            ->where('course_id', $course_id)
            ->first();
        return $course->available_seat;
    }

    public function newAdmission()
    {
        $notification = Auth::user()->Notifications;
        $noticeIds = [];
        foreach ($notification as $key => $value) {
            if ($value['data']['notice_type_id'] == 1 && $value['data']['notice_sub_type_id'] == 1) {
                $noticeIds[] = [
                    'notice_id' => $value['data']['notice_id'],
                    'notification_id' => $value->id,
                ];
            }
        }
        $notice = [];
        foreach ($noticeIds as $value) {
            $data = Notice::where('id', $value['notice_id'])
                ->where('notice_type', '1')
                ->where('exp_date', '>=', Carbon::now())
                ->first();
            if ($data) {
                $data['notification_id'] = $value['notification_id'];
                $notice[] = $data;
            }
        }
        return view('admission.new-admission', compact('notice'));
    }

    public function collegeList($dep)
    {
        $dep_id = $this->depId($dep);
        $collegs = DB::table('colleges')->where('status',1)->select('id')->get();
        $clgids = [];
        if(isset($collegs) && $collegs->count() > 0)
        {
            foreach($collegs as $clg)
            {
                $studentApplicationTable = 'student'.$clg->id.'_applications';
                $class = 'Student'.$clg->id.'Application';
                if (Schema::hasTable($studentApplicationTable)) {
                    $student_app = modelFn($class)::where([['academic_year', date('Y')], ['department_id', $dep_id]])->whereIn('status',[1])->groupBy('clg_id');
                    if($student_app->exists())
                    {
                        $clgids[] = $clg->id;
                    }
                }
            }
        }
        /* $student_app = StudentApplication::where([['academic_year', date('Y')], ['department_id', $dep_id]])->whereIn('status',[1])->groupBy('clg_id')->get(['clg_id']); */
        $college = College::where('status', 1)->whereIn('id', $clgids)->get(['id', 'name']);
        return view('admin.admission.colleges', compact('college', 'dep'));
    }
    public function courseList($dep, $clg_id)
    {
        $dep_id = $this->depId($dep);
        $class = 'Student'.$clg_id.'Application';
        $app_course = modelFn($class)::where([['academic_year', date('Y')], ['clg_id', $clg_id], ['department_id', $dep_id]])->whereIn('status',[1])->groupBy('course_id')->get(['course_id']);
        $course = Course::whereIn('id', $app_course)->get(['id', 'name']);
        $clg = College::find($clg_id);
        $clg_name = $clg->name;
        return view('admin.admission.course', compact('course', 'dep', 'clg_id', 'clg_name'));
    }

    public function applyApplication($dep, $clg_id, $course_id)
    {
        $dep_id = $this->depId($dep);
        $class = 'Student'.$clg_id.'Application';
        $application = modelFn($class)::where([['academic_year', date('Y')], ['clg_id', $clg_id], ['department_id', $dep_id], ['course_id', $course_id]])->whereIn('status',[1])->get();

        return view('admin.admission.apply-application', compact('application','dep_id','course_id','clg_id'));
    }
    public function depId($dep)
    {
        if ($dep == 'ug') {
            $dep_id = 1;
        } elseif ($dep == 'pg') {
            $dep_id = 2;
        } elseif ($dep == 'mphill') {
            $dep_id = 3;
        } elseif ($dep == 'certificate') {
            $dep_id = 4;
        }
        return $dep_id;
    }

    public function modelTemplate($modelName,$tableName)
    {
        $modelTemplate = "<?php\n\nnamespace App\Models;\n\nuse Illuminate\Database\Eloquent\Model;\nuse Illuminate\Database\Eloquent\Factories\HasFactory;\nuse Illuminate\Database\Eloquent\Casts\Attribute;\n\nclass {$modelName} extends Model\n{\n \nuse HasFactory;\n\n   protected \$table = '{$tableName}';\n public \$applicationStatus; \n public \$present_dis_id;\n\n public function course(){\n return \$this->belongsTo(Course::class, 'course_id', 'id');\n}\n\n public function department(){\n\n return \$this->belongsTo(CourseFor::class, 'department_id', 'id');\n}\n public function districtName(){\n \$clg = District::where('id', \$this->clg_id)->first();\n return \$clg->name;\n} \n public function permanentDis(){\n \$present_address = json_decode(\$this->permanent_address);\n \$district = District::where('id', \$present_address->present_district_id)->first();\n return \$district->district_name;\n } \n public function presentDis(){\n \$present_address = json_decode(\$this->present_address);\n \$district = District::where('id', \$present_address->present_district_id)->first();\n return \$district->district_name;\n} \n public function collegeName(){\n \$clg = College::where('id', \$this->clg_id)->first();\n return \$clg->name;\n }\n public function applicationStatus(){\n \$chk = \$this->status;\n if (\$chk == 1) {\n return \$this->applicationStatus = 'Applied';\n } elseif (\$chk == 2) {\n return  \$this->applicationStatus = 'Approved';\n } elseif (\$chk == 3) {\n return  \$this->applicationStatus = 'Rejected';\n } elseif (\$chk == 4) {\n return  \$this->applicationStatus = 'Application-Backed';\n }elseif (\$chk == 5) {\n return  \$this->applicationStatus = 'Apply';\n }elseif (\$chk == 6) {\n return  \$this->applicationStatus = 'Pending for verification';\n } else {\n return '';\n }\n } \n public function statusColor(){\n \$chk = \$this->status;\n \tif (\$chk == 1) {\n\t return 'primary';\n} elseif (\$chk == 2) {\n \t return  'success';\n \t } elseif (\$chk == 3) {\n \t return  'danger'; } else {\n \treturn  'warning';\n}\n} \n}\n";
        return $modelTemplate;
    }

    public function modelAdressTemplate($modelName,$tableName)
    {
        $modelTemplate = "<?php\n\nnamespace App\Models;\n\nuse Illuminate\Database\Eloquent\Model;\nuse Illuminate\Database\Eloquent\Factories\HasFactory;\nuse Illuminate\Database\Eloquent\Casts\Attribute;\n\nclass {$modelName} extends Model\n{\n \nuse HasFactory;\n\n   protected \$table = '{$tableName}';\n public function presentDistrict(){\n return \$this->belongsTo(\District::class, 'present_district_id', 'id');\n}\n\n public function permanentDistrict(){\n return \$this->belongsTo(District::class, 'permanent_district_id', 'id');\n}  \n}\n";
        return $modelTemplate;
    }

    public function modelUserTemplate($modelName,$tableName)
    {
        $modelTemplate = "<?php\n\nnamespace App\Models;\n\nuse Illuminate\Database\Eloquent\Model;\nuse Illuminate\Database\Eloquent\Factories\HasFactory;\nuse Illuminate\Database\Eloquent\Casts\Attribute; \n use Illuminate\Foundation\Auth\User as Authenticatable; \n use Illuminate\Notifications\Notifiable;\nuse Illuminate\Support\Facades\Hash;\nuse Spatie\Permission\Traits\HasRoles; \n\nclass {$modelName} extends Authenticatable\n{\n \nuse HasFactory, Notifiable, HasRoles;\n\n   protected \$table = '{$tableName}';\n public function role():BelongsToMany\n{\n\t return \$this->BelongsToMany(Role::class, 'role_id', 'id');\n}\n public function userdetails(){\n \t return \$this->belongsTo(Role::class, 'role_id', 'id');\n} \n}\n";
        return $modelTemplate;
    }

    public function collegeAdList()
    {
        $colleges = DB::table('colleges')->where('status',1)->orderBy('name','asc')->get();
        return view('admission.college_admission_list',compact('colleges'));
    }
    public function dashStudent()
    {
        dd(Auth::user());
    }
}
