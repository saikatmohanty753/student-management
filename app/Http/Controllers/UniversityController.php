<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Mail;
use PDF;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Models\College;
use App\Models\Course;
use App\Models\CourseFor;
use App\Models\District;
use App\Models\Notice;
use App\Models\StudentAddress;
use App\Models\StudentApplication;
use App\Models\StudentDetails;
use App\Models\StudentDocuments;
use App\Models\StudentEducationDetails;
use App\Models\AdmissionSeat;
use App\Models\User;
use App\Models\City;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail as FacadesMail;
use App\Repositories\CustomRepository;

class UniversityController extends Controller
{
    private $app;
    public function __construct(CustomRepository $app)
    {
        $this->app = $app;
    }

    public function index($clg_id='')
    {
        if(empty($clg_id))
        {
            $clg_id = 85;
        }
        $notice = Notice::where('notice_sub_type',5)->whereDate('start_date','<=',date('Y-m-d'))->whereDate('exp_date','>=',date('d-m-Y'))->where('is_verified',1);
        if(!$notice->exists())
        {
            return redirect()->route('login')->with('error','Admission is closed');
        }
        $course = DB::table('admission_seats')->select('admission_seats.*', 'courses.name')
            ->where('clg_id', $clg_id)
            ->where('admission_year', date('Y'))
            ->join('courses', 'admission_seats.course_id', 'courses.id')
            ->where('courses.course_for', 2)
            ->get();

        $district = DB::table('district')->get();
        $depId = 2;
        session()->put('clg',$clg_id);
        $clg_id = $this->encrypt($clg_id);
        return view('admission.university_admission',compact('course', 'district','depId','clg_id'));
    }
    public function getCourse(Request $request)
    {
        if(!empty($request->clg_id) && !empty($request->code))
        {

            $course = DB::table('admission_seats')->select('admission_seats.*', 'courses.name')
                        ->where('clg_id', $request->clg_id)
                        ->where('main_course_code', $request->code)
                        ->where('admission_year', date('Y'))
                        ->join('courses', 'admission_seats.course_id', 'courses.id')
                        ->where('courses.course_for', 2)
                        ->get();
            $options = '<option value="">Select Course</option>';
            if(isset($course) && count($course) > 0){
                foreach ($course as $item)
                {
                    $options .= '<option value="'.$item->course_id.'" data-id="'.$item->available_seat.'" data-total="'.$item->total_strength.'" data-occupied="'.$item->consumption_seat.'">'.$item->name.'</option>';
                }
            }
            return response()->json(['status'=>1,'msg'=>$options]);
        }else{
            return response()->json(['status'=>0,'msg'=>'<option value="" data-id="" data-total="" data-occupied=""> --Select-- </option>']);
        }

    }
    public function store(Request $request)
    {
        $clgId = '';
        if(!empty($request->clg_token))
        {
            $clgId = $this->decrypt($request->clg_token);
        }
        if(empty($clgId))
        {
            return back();
        }
        if($clgId != session()->get('clg'))
        {
            return back();
        }
        if ($this->checkSeatAvl($clgId, $request->course) == 0) {
            return redirect()->back()->with('error', 'You have already fill up all the seats');
        }
        $student_check = DB::table('student_applications')->where('email',$request->email)->where('status',3);

        if($student_check->exists())
        {
            $student_check = $student_check->first();
            if($this->getDiffYear($student_check->admission_date,date('Y-m-d')) < 1 && $request->course == $student_check->course_id)
            {
                return redirect()->back()->with('error','Your addmission form has been rejected for the applied course on '.date('d-m-Y',strtotime($student_check->admission_date)));
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

        $course = Course::find($request->course);
        $email = $request->email;
        $student = new StudentApplication();
        $student->academic_year = date('Y');
        $student->admission_date = Carbon::now();
        $student->clg_id = $clgId;
        $student->department_id = $course->course_for;
        $student->course_id = $request->course;
        $student->app_status = 1;
        $student->email = $request->email;
        $student->descipline = $request->descipline;
        $student->is_university = 1;
        $student_app = $this->app->genAppNo($request->course);
        if(!empty($student_app['application_no']))
        {
            $student->application_no = $student_app['application_no'];
        }
        if(!empty($student_app['app_count_no']))
        {
            $student->app_count_no = $student_app['app_count_no'];
        }
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
            'application_no'=> (!empty($student_app['application_no']))?$student_app['application_no']:'',
            'app_count_no'=> (!empty($student_app['app_count_no']))?$student_app['app_count_no']:''
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
        if ($request->file('signature')) {
            $file = $request->file('signature');
            $filename = time() . uniqid(rand()) . $file->getClientOriginalName();
            $file->move(public_path('/student-documents/profile-photo'), $filename);
            $signature = '/student-documents/profile-photo/' . $filename;
            $documents['signature'] = $signature ? $signature : '';
        } else {
            $documents['signature'] = '';
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
        $student->personal_information = json_encode($student_details);
        $student->present_address = json_encode($present_address);
        $student->permanent_address = json_encode($permanent_address);
        $student->prv_clg_info = json_encode($prv_clg_info);
        $student->documents = json_encode($documents);
        $student->qualification_details = json_encode($qualification_details);
        $student->status = 5;
        $student->app_status = 2;
        if($student->save())
        {
            Mail::send('mail.applied_ad_uni', compact('student_details'), function ($message) use ($email) {
                $message->to($email);
                $message->subject('UUC Admission Status');
            });
        }


        $course = AdmissionSeat::where('clg_id', $clgId)
            ->where('admission_year', date('Y'))
            ->where('course_id', $request->course)
            ->first();
        $avl_seat = $course->available_seat;
        $cons_seat = $course->consumption_seat;
        $course->available_seat = $avl_seat - 1;
        $course->consumption_seat = $cons_seat + 1;
        $course->save();

        return redirect()->route('uni-success',[$this->encrypt(json_encode($student_details))])->with('success', 'Applied for admission successfully');
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

    public function checkSeatAvl($clg_id, $course_id)
    {
        $course = AdmissionSeat::where('clg_id', $clg_id)
            ->where('admission_year', date('Y'))
            ->where('course_id', $course_id)
            ->first();
        return $course->available_seat;
    }

    public function verifyStudentAdmission(Request $request)
    {

        $student_app = StudentApplication::where('id', $request->id)->first();
        if ($request->status == 6) {
            $email = $student_app->email;
            $data = array(
                'email'=>$student_app->email,
                'remarks'=>$request->remarks,
                'student'=>$student_app,
                'personal_info'=>json_decode($student_app->personal_information)
            );
            $student_app->remarks_app_university = $request->remarks;
            $student_app->status = $request->status;
            if($student_app->save())
            {
                Mail::send('mail.approval_uni', compact('data'), function ($message) use ($email) {
                    $message->to($email);
                    $message->subject('UUC Admission Status');
                });
            }
        } else {
            $email = $student_app->email;
            $personal_information = json_decode($student_app->personal_information);
            $html = 'Your admission application has been rejected with "<strong>'.$request->remarks.'</strong>" reason by UUC. For futher information please contact UUC help desk';
            $data = array(
                'email'=>$student_app->email,
                'remarks'=>$request->remarks,
                'student'=>$student_app,
                'name'=>$personal_information->name,
                'html'=>$html
            );
            $student_app->remarks = $request->remarks;
            $student_app->status = $request->status;
            if($student_app->save()){
                Mail::send('mail.custom_mail', compact('data'), function ($message) use ($email) {
                    $message->to($email);
                    $message->subject('UUC Admission Status');
                });
            }
        }

        return redirect()->route('pgadmissionList')->with('success', 'Application examined successfully.');
    }
    public function success($hash)
    {
        if(empty($hash))
        {
            return back();
        }
        $hash = json_decode($this->decrypt($hash));
        return view('success',compact('hash'));
    }

    public function getEmailStatus(Request $request)
    {
        $student_check = DB::table('student_applications')->where('email',$request->email)->where('status',3);

        if($student_check->exists())
        {
            $student_check = $student_check->first();
            if($this->getDiffYear($student_check->admission_date,date('Y-m-d')) < 1 && $request->course == $student_check->course_id)
            {
                return response()->json(['status'=>0,'msg'=>'This email already taken']);
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
                    return response()->json(['status'=>0,'msg'=>'Enrolled in the applied course in not ended']);
                }
            }
            return response()->json(['status'=>0,'msg'=>'Email id already exists']);
        }
        return response()->json(['status'=>1,'msg'=>'success']);
    }
    public function verifyStudentFinalAdmission(Request $request)
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

            $std_app = StudentApplication::where('id', $request->id)->first();
            $std_app->remarks = $request->remarks;
            $std_app->status = $request->status;
            $std_app->save();
            $info = json_decode($std_app->personal_information);
            $prs_address = json_decode($std_app->present_address);
            $per_address = json_decode($std_app->permanent_address);
            $clg_info = json_decode($std_app->prv_clg_info);
            $qualification = json_decode($std_app->qualification_details);
            $documents = json_decode($std_app->documents);

            $student = new StudentDetails();
            $student->clg_id = $std_app->clg_id;
            $student->department_id = $std_app->department_id;
            $student->course_id = $std_app->course_id;
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

            $std = StudentDetails::where('regd_no', '!=', null)->latest()->first();
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
            StudentDetails::where('id', $student->id)->update(['regd_no' => $regdNo]);

            $this->generatePDF($info->email, $info->name, $regdNo, $request->issued, $std_app->clg_id, date('Y') . '-' . $year);

            //dd('demo ee');
            $count = User::where('email', $student->email)->count();
            if ($count == 0) {
                $user = new User();
                $user->name = $student->name;
                $user->email = $student->email;
                $user->mob_no = $student->mobile;
                $user->clg_id = $student->clg_id;
                $user->student_id = $student->id;
                $user->role_id = 3;
                $user->batch_year = date('Y') . '-' . $year;
                $user->password = Hash::make(12345678);
                $user->save();
                $user->assignRole(3);
                $data = [
                    "name" => $user->name,
                    "user_name" => $user->email,
                    "password" => 12345678,
                ];

                Mail::send('mail.credential', compact('data'), function ($message) use ($user) {
                    $message->to($user->email);
                    $message->subject('Login credential for UUC');
                });
            }

            $std_id = $student->id;
            $address = new StudentAddress();
            $address->student_id = $std_id;
            $address->present_state = $prs_address->present_state;
            $address->present_district_id = $prs_address->present_district_id;
            $address->present_pin_code = $prs_address->present_pin_code;
            $address->present_address = $prs_address->present_address;
            $address->permanent_state = $per_address->permanent_state;
            $address->permanent_district_id = $per_address->permanent_district_id;
            $address->permanent_pin_code = $per_address->permanent_pin_code;
            $address->permanent_address = $per_address->permanent_address;
            $address->save();
            $education = new StudentEducationDetails();
            $education->student_id = $std_id;
            $education->clg_name = $clg_info->clg_name;
            $education->year_of_passing = $clg_info->year_of_passing;
            $education->course_name = $clg_info->course_name;
            $education->is_migration_cert = $clg_info->is_migration_cert;
            $education->qualification = json_encode($qualification);
            $education->save();
            $doc = new StudentDocuments();
            $doc->student_id = $std_id;
            $doc->photo = $documents->profile;
            $doc->aadhaar_card = $documents->aadhaar_card;
            $doc->hsc_cert = $documents->hsc_cert;
            $doc->migration_cert = $documents->migration_cert;
            $doc->save();
        } else {

            $student_app = StudentApplication::where('id', $request->id)->first();
            $student_app->remarks = $request->remarks;
            $student_app->status = $request->status;
            $student_app->save();
        }

        return redirect()->route('pgadmissionList')->with('success', 'Application examined successfully.');
    }
    public function encrypt($data)
    {
        return Crypt::encryptString($data);
    }
    public function decrypt($data){
        return Crypt::decryptString($data);
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

    public function admissionList(Request $request)
    {
        /* $clg_courses = DB::table('admission_seats')
            ->where('clg_id', Auth::user()->clg_user_id)
            ->groupBy('course_id')
            ->pluck('course_id')
            ->all(); */
        $clg_courses = DB::table('student_applications')->where('is_university',1)->pluck('course_id')->toArray();
        $clg_courses = array_unique($clg_courses);
        $department = CourseFor::where('id',2)->get();
        $course = Course::whereIn('id', $clg_courses)->get();
        return view('uuc_admission.list', compact('department', 'course'));
    }
    public function appliedApplication($id)
    {
        // return $id;
        $district = District::get();
        $std_app = StudentApplication::find($id);
        $personal_information = json_decode($std_app->personal_information);
        $present_address = json_decode($std_app->present_address);
        $present_address->district = $std_app->presentDis();
        $permanent_address = json_decode($std_app->permanent_address);
        $permanent_address->district = $std_app->presentDis();
        $prv_clg_info = json_decode($std_app->prv_clg_info);
        $documents = json_decode($std_app->documents);
        $qualification_details = json_decode($std_app->qualification_details);

        $clg_courses = DB::table('student_applications')->where('is_university',1)->pluck('clg_id')->toArray();
        $clg_courses = array_unique($clg_courses);

        $course = DB::table('admission_seats')->select('admission_seats.*', 'courses.name')
            ->whereIn('clg_id', $clg_courses)
            ->where('admission_year', date('Y'))
            ->join('courses', 'admission_seats.course_id', 'courses.id')
            ->where('courses.course_for', 2)
            ->get();

        $student = StudentDetails::where('id', $id)->first();

        // $district = District::get();
        // $documents = StudentDocuments::where('id', $id)->first();
        // $student  = StudentDetails::where('id', $id)->first();
        // $education = StudentEducationDetails::where('id', $id)->first();
        // $address = StudentAddress::where('id', $id)->first();
        return view('uuc_admission.apply_app', compact('std_app', 'present_address', 'personal_information', 'permanent_address', 'course', 'district', 'prv_clg_info', 'qualification_details', 'documents', 'student'));
    }
    public function studentadmissionList(Request $request)
    {

        if ($request->ajax()) {
            $clgId = Auth::user()->clg_user_id;
            $data = StudentApplication::select('student_applications.*', 'dep.course_for', 'course.name')
                ->join('course_fors as dep', 'dep.id', '=', 'student_applications.department_id')
                ->join('courses as course', 'course.id', '=', 'student_applications.course_id')
                /* ->where('clg_id', $clgId) */
                ->where('academic_year', date('Y'))
                ->where('student_applications.is_university', 1)
                ->whereIn('student_applications.status', [1,5,6]);

            if ($request->get('dep') != '') {
                $data->where('student_applications.department_id', $request->get('dep'));
            }
            if ($request->get('course') != '') {
                $data->where('student_applications.course_id', $request->get('course'));
            }
            if ($request->get('session') != '') {
                $data->where('student_applications.academic_year', $request->get('session'));
            }

            $data = $data->orderBy('id','desc')->get();

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
}
