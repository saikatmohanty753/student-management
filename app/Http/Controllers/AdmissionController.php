<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Controllers\SendPDFMail;

use App\Models\AdmissionSeat;
use App\Models\AffiliationMaster;
use App\Models\Course;
use App\Models\CourseFor;
use App\Models\District;
use App\Models\Notice;
use App\Models\Role;
use App\Models\StudentAddress;
use App\Models\StudentApplication;
use App\Models\StudentDetails;
use App\Models\StudentDocuments;
use App\Models\StudentEducationDetails;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Support\Facades\Mail;
use PDF;


class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AdmissionSeat()
    {
        $course =  DB::table('affiliation_masters')->select('affiliation_masters.*', DB::raw('SUM(seat_no) as total_seat_no'))
            ->groupBy('affiliation_masters.course')
            ->groupBy('affiliation_masters.college_name')
            ->get();

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
                    'created_at' => Carbon::now()
                ]);
            }
        }
    }

    public function index($id, $dep, $depId)
    {
        $count = Notice::whereDate('start_date', '>=', Carbon::now())->whereDate('exp_date', '>', Carbon::now())->where('id', $id)->count();
        if ($count == 0) {
            return redirect()->intended('dashboard')->with('error', 'Now the admission process has been stopped.');
        }
        $course =  DB::table('admission_seats')->select('admission_seats.*', 'courses.name')
            ->where('clg_id', Auth::user()->clg_user_id)
            ->where('admission_year', date('Y'))
            ->join('courses', 'admission_seats.course_id', 'courses.id')
            ->where('courses.course_for', $depId)
            ->get();
        $district = District::all();
        return view('admission.index', compact('course', 'district'));
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
        $clgId = Auth::user()->clg_user_id;
        if ($this->checkSeatAvl($clgId, $request->course) == 0) {
            return redirect()->action([AdmissionController::class, 'admissionList'])->with('error', 'You have already fill up all the seats');
        }
        $course = Course::find($request->course);
        $student = new StudentApplication();
        $student->academic_year = date('Y');
        $student->admission_date = Carbon::now();
        $student->clg_id = Carbon::now();
        $student->clg_id = $clgId;
        $student->department_id = $course->course_for;
        $student->course_id = $request->course;
        $student->app_status = 1;

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
        $qualification_details = [
            'hsc' => [
                'course' => $request->hsc,
                'board' => $request->hsc_board,
                'passing_year' => $request->hsc_passing_year,
                'division' => $request->hsc_division,
                'mark' => $request->hsc_mark,
                'total' => $request->hsc_total_mark,
                'percentage' => $request->hsc_percentage,
            ],
            'intermediate' => [
                'course' => $request->intermediate,
                'board' => $request->intermediate_board,
                'passing_year' => $request->intermediate_passing_year,
                'division' => $request->intermediate_division,
                'mark' => $request->intermediate_mark,
                'total' => $request->intermediate_total_mark,
                'percentage' => $request->intermediate_percentage,
            ],
            'graduate' => [
                'course' => $request->graduate,
                'board' => $request->graduate_board,
                'passing_year' => $request->graduate_passing_year,
                'division' => $request->graduate_division,
                'mark' => $request->graduate_mark,
                'total' => $request->graduate_total_mark,
                'percentage' => $request->graduate_percentage,
            ],
            'postGraduate' => [
                'course' => $request->post_graduate,
                'board' => $request->post_graduate_board,
                'passing_year' => $request->post_graduate_passing_year,
                'division' => $request->post_graduate_division,
                'mark' => $request->post_graduate_mark,
                'total' => $request->post_graduate_total_mark,
                'percentage' => $request->post_graduate_percentage,
            ],
            'other' => [
                'course' => $request->other_graduate,
                'board' => $request->other_graduate_board,
                'passing_year' => $request->other_graduate_passing_year,
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
        // return $student;
        return redirect()->action([AdmissionController::class, 'show'], ['id' => $student->id])->with('success', 'Application saved in draft.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $std_app = StudentApplication::find($id);
        $personal_information = json_decode($std_app->personal_information);
        $present_address = json_decode($std_app->present_address);
        $present_address->district = $std_app->presentDis();
        $permanent_address = json_decode($std_app->permanent_address);
        $permanent_address->district = $std_app->presentDis();
        $prv_clg_info = json_decode($std_app->prv_clg_info);
        $documents = json_decode($std_app->documents);
        $qualification_details = json_decode($std_app->qualification_details);
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
        $std_app = StudentApplication::find($id);
        $personal_information = json_decode($std_app->personal_information);
        $present_address = json_decode($std_app->present_address);
        $present_address->district = $std_app->presentDis();
        $permanent_address = json_decode($std_app->permanent_address);
        $permanent_address->district = $std_app->presentDis();
        $prv_clg_info = json_decode($std_app->prv_clg_info);
        $documents = json_decode($std_app->documents);
        $qualification_details = json_decode($std_app->qualification_details);

        $course =  DB::table('admission_seats')->select('admission_seats.*', 'courses.name')
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

        $clgId = Auth::user()->clg_user_id == '' ? '000' : Auth::user()->clg_user_id;
        if ($this->checkSeatAvl($clgId, $request->course) == 0) {
            return redirect()->action([AdmissionController::class, 'admissionList'])->with('error', 'You have already fill up all the seats');
        }

        $id = $request->hid;
        $student = StudentDetails::find($id);
        $student->course_id = $request->course;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->mobile = $request->mobile;
        $student->mother_name = $request->mother_name;
        $student->father_name = $request->father_name;
        $student->gender = $request->gender;
        $student->dob = Carbon::parse($request->dob);
        $student->cast = $request->cast_category;
        $student->specially_abled = $request->specially_abled;
        $student->aadhaar_no = $request->aadhar_no;
        $student->app_status = 1;
        $student->save();

        $std_id = $student->id;
        $address = StudentAddress::find($id);
        $address->student_id = $std_id;
        $address->present_state = $request->present_state;
        $address->present_district_id = $request->present_district;
        $address->present_pin_code = $request->present_pin_code;
        $address->present_address = $request->present_address;
        $address->permanent_state = $request->permanent_state;
        $address->permanent_district_id = $request->permanent_district;
        $address->permanent_pin_code = $request->permanent_pin_code;
        $address->permanent_address = $request->permanent_address;
        $address->save();

        $education = StudentEducationDetails::find($id);
        $education->student_id = $std_id;
        $education->clg_name = $request->last_collage_name;
        $education->year_of_passing = $request->last_passing_year;
        $education->course_name = $request->last_course_name;
        $education->is_migration_cert = $request->is_migration;
        $education->save();

        $documents = StudentDocuments::find($id);
        $documents->student_id = $std_id;
        if ($request->file('profile')) {
            $file = $request->file('profile');
            $filename = time() . uniqid(rand()) . $file->getClientOriginalName();
            $file->move(public_path('/student-documents/profile'), $filename);
            $profile = '/student-documents/profile/' . $filename;
            $documents->photo = $profile;
        }

        if ($request->file('aadhaar_card')) {
            $file = $request->file('aadhaar_card');
            $filename = time() . uniqid(rand()) . $file->getClientOriginalName();
            $file->move(public_path('/student-documents/aadhaar_card'), $filename);
            $aadhaar_card = '/student-documents/aadhaar_card/' . $filename;
            $documents->aadhaar_card = $aadhaar_card;
        }

        if ($request->file('hsc_cert')) {
            $file = $request->file('hsc_cert');
            $filename = time() . uniqid(rand()) . $file->getClientOriginalName();
            $file->move(public_path('/student-documents/hsc_cert'), $filename);
            $hsc_cert = '/student-documents/hsc_cert/' . $filename;
            $documents->hsc_cert = $hsc_cert;
        }
        if ($request->file('migration_cert')) {
            $file = $request->file('migration_cert');
            $filename = time() . uniqid(rand()) . $file->getClientOriginalName();
            $file->move(public_path('/student-documents/migration_cert'), $filename);
            $migration_cert = '/student-documents/migration_cert/' . $filename;
            $documents->migration_cert = $migration_cert;
        }
        $documents->save();
        return redirect()->action([AdmissionController::class, 'show'], ['id' => $std_id])->with('success', 'Application saved in draft.');
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
        $application = StudentApplication::find($request->id);
        $clgId = Auth::user()->clg_user_id;
        if ($this->checkSeatAvl($clgId, $application->course_id) == 0) {
            return redirect()->action([AdmissionController::class, 'admissionList'])->with('error', 'You have already fill up all the seats');
        }

        $application->status = 1;
        $application->app_status = 2;
        $application->save();

        $course =  AdmissionSeat::where('clg_id', $application->clg_id)
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
        $clgId = Auth::user()->clg_user_id;
        $application = StudentApplication::where('clg_id', $clgId)->where('status', 1)->get();

        $department = CourseFor::all();
        $course = Course::all();
        return view('admission.list', compact('application', 'department', 'course'));
    }

    public function appliedAdmissionList(Request $request)
    {
        $application = StudentApplication::where('status', 1)->get();
        $verified_application = StudentApplication::where('status', 2)->get();
        $rejected_application = StudentApplication::where('status', 3)->get();
        return view('admin.admission.index', compact('application', 'verified_application', 'rejected_application'));
    }

    public function verifyAdmission(Request $request, $id)
    {
        /*  $student = StudentDetails::where('id', $id)->first();
        $education = StudentEducationDetails::where('id', $id)->first();
        $address = StudentAddress::where('id', $id)->first();
        $documents = StudentDocuments::where('id', $id)->first();

        return view('admin.admission.verify', compact('id', 'student', 'address', 'education', 'documents')); */

        $std_app = StudentApplication::find($id);
        $personal_information = json_decode($std_app->personal_information);
        $present_address = json_decode($std_app->present_address);
        $present_address->district = $std_app->presentDis();
        $permanent_address = json_decode($std_app->permanent_address);
        $permanent_address->district = $std_app->presentDis();
        $prv_clg_info = json_decode($std_app->prv_clg_info);
        $documents = json_decode($std_app->documents);
        $qualification_details = json_decode($std_app->qualification_details);
        // return $app->course;
        return view('admin.admission.verify', compact(
            'std_app',
            'personal_information',
            'present_address',
            'permanent_address',
            'prv_clg_info',
            'documents',
            'qualification_details'
        ));
    }

    public function verifyStudentAdmission(Request $request)
    {


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


        $student = StudentDetails::where('id', $request->id)->first();
        $student->remarks = $request->remarks;
        $student->status = $request->status;




        if ($student->regd_no == null) {
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
            $student->regd_no = $regdNo;
            // $student->roll_no = date('Y').rand(1111, 9999);
            $student->regd_no_issued = $request->issued == 1 ? '1' : '0';
            if ($request->status == 2) {
                $email = $student->email;
                $name = $student->name;
                $reg_no = $regdNo;
                $this->generatePDF($email, $name, $reg_no);

                $student->batch_year = date('Y') . '-' . $year;
            }
        }


        $clg_id = $student->clg_id; //1
        $course_id = $student->course_id; //1
        $join_year = date('Y') . '-' . $year; //2021-2025
        $rollNo = Helpers::createRollNO($clg_id, $course_id, $join_year);
        $student->roll_no = $rollNo;
        $student->save();

        if ($request->status == 2) {
            $count = User::where('email', $student->email)->count();
            if ($count == 0) {
                $user = new User();
                $user->name = $student->name;
                $user->email = $student->email;
                $user->mob_no = $student->mobile;
                $user->clg_id = $student->clg_id;
                $user->role_id = 3;
                $user->batch_year = date('Y') . '-' . $year;
                $user->password = Hash::make(12345678);
                $user->save();
                $user->assignRole(3);
            }
        }

        return redirect()->action([AdmissionController::class, 'appliedAdmissionList'])->with('success', 'Application examined successfully.');
    }

    public function generatePDF($email, $name, $reg_no)
    {


        $data = ['email' => $email, 'name' => $name, 'reg_no' => $reg_no];

        $user['to'] = $data["email"];
        $customPaper = array(0, 0, 567.00, 883.80);
        $pdf = PDF::loadView('pdf.student_registration_card', $data)->setPaper($customPaper, 'landscape');
        file_put_contents('registration_card/' . $reg_no . '.pdf', $pdf->output());
        // $to_email = $user['to'];
        // Mail::to($to_email)->send(new SendPDFMail($pdf));
        FacadesMail::send('pdf.test', $data, function ($message) use ($pdf, $user) {
            $message->to($user['to'])

                ->attachData($pdf->output(), "Registration.pdf");
            $message->subject('Registration Verification Successfull');
        });
        return response()->json(['status' => 'success', 'message' => 'Report has been sent successfully.']);
    }



    public function admissionDetails(Request $request, $id)
    {
        $student = StudentDetails::where('id', $id)->first();
        $education = StudentEducationDetails::where('id', $id)->first();
        $address = StudentAddress::where('id', $id)->first();
        $documents = StudentDocuments::where('id', $id)->first();

        return view('admin.admission.view', compact('id', 'student', 'address', 'education', 'documents'));
    }
    public function appliedApplication($id)
    {
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

        $course =  DB::table('admission_seats')->select('admission_seats.*', 'courses.name')
            ->where('clg_id', Auth::user()->clg_user_id)
            ->where('admission_year', date('Y'))
            ->join('courses', 'admission_seats.course_id', 'courses.id')
            ->where('courses.course_for', $std_app->department_id)
            ->get();

            $student = StudentDetails::where('id', $id)->first();
        // $district = District::get();
        // $documents = StudentDocuments::where('id', $id)->first();
        // $student  = StudentDetails::where('id', $id)->first();
        // $education = StudentEducationDetails::where('id', $id)->first();
        // $address = StudentAddress::where('id', $id)->first();
        return view('admission.apply_app', compact('std_app', 'present_address', 'personal_information', 'permanent_address', 'course', 'district', 'prv_clg_info', 'qualification_details', 'documents','student'));
    }

    public function checkSeatAvl($clg_id, $course_id)
    {
        $course =  AdmissionSeat::where('clg_id', $clg_id)
            ->where('admission_year', date('Y'))
            ->where('course_id', $course_id)
            ->first();
        return $course->available_seat;
    }


    public function newAdmission()
    {
        $notification =  Auth::user()->Notifications;
        $noticeIds = [];
        foreach ($notification as $key => $value) {
            if ($value['data']['notice_type_id'] == 1 && $value['data']['notice_sub_type_id'] == 1) {
                $noticeIds[] = [
                    'notice_id' => $value['data']['notice_id'],
                    'notification_id' => $value->id
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
        // return $notice;
        return view('admission.new-admission', compact('notice'));
    }
}
