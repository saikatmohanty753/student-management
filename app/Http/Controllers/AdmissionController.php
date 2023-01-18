<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\District;
use App\Models\Notice;
use App\Models\StudentAddress;
use App\Models\StudentDetails;
use App\Models\StudentDocuments;
use App\Models\StudentEducationDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $dep, $depId)
    {
        $count = Notice::whereDate('start_date', '>=', Carbon::now())->whereDate('exp_date', '>', Carbon::now())->where('id', $id)->count();
        if($count == 0){
            return redirect()->intended('dashboard')->with('error', 'Now the admission process has been stopped.');
        }
        $course = Course::where('course_for', $depId)->get();
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

        $course = Course::find($request->course);
        $clgId = Auth::user()->clg_user_id == '' ? '000' : Auth::user()->clg_user_id;
        $student = new StudentDetails();
        $student->clg_id = $clgId;
        $student->department_id = $course->course_for;
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
        $address = new StudentAddress();
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

        $education = new StudentEducationDetails();
        $education->student_id = $std_id;
        $education->clg_name = $request->last_collage_name;
        $education->year_of_passing = $request->last_passing_year;
        $education->course_name = $request->last_course_name;
        $education->is_migration_cert = $request->is_migration;
        $education->save();

        $documents = new StudentDocuments();
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $documents = StudentDocuments::where('id', $id)->first();
        $student = StudentDetails::where('id', $id)->first();
        $education = StudentEducationDetails::where('id', $id)->first();
        $address = StudentAddress::where('id', $id)->first();
        return view('admission.view', compact('id', 'student', 'address', 'education', 'documents'));
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
        $documents = StudentDocuments::where('id', $id)->first();
        $student = StudentDetails::where('id', $id)->first();
        $education = StudentEducationDetails::where('id', $id)->first();
        $address = StudentAddress::where('id', $id)->first();
        $course = Course::where('course_for', $student->department_id)->get();
        return view('admission.edit', compact('student', 'address', 'education', 'course', 'district', 'documents'));
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
        $application = StudentDetails::find($request->id);
        $application->status = 1;
        $application->app_status = 2;
        $application->save();
        return redirect()->action([AdmissionController::class, 'admissionList'])->with('success', 'Application submitted successfully.');
    }
    public function admissionList(Request $request)
    {
        $clgId = Auth::user()->clg_user_id == '' ? '000' : Auth::user()->clg_user_id;
        $application = StudentDetails::where('clg_id', $clgId)->get();
        return view('admission.list', compact('application'));
    }

    public function appliedAdmissionList(Request $request)
    {
        $application = StudentDetails::where('status', 1)->get();
        $verified_application = StudentDetails::where('status', 2)->get();
        $rejected_application = StudentDetails::where('status', 3)->get();
        return view('admin.admission.index', compact('application', 'verified_application', 'rejected_application'));
    }

    public function verifyAdmission(Request $request, $id)
    {
        $student = StudentDetails::where('id', $id)->first();
        $education = StudentEducationDetails::where('id', $id)->first();
        $address = StudentAddress::where('id', $id)->first();
        $documents = StudentDocuments::where('id', $id)->first();

        return view('admin.admission.verify', compact('id', 'student', 'address', 'education', 'documents'));
    }

    public function verifyStudentAdmission(Request $request)
    {
        $student = StudentDetails::where('id', $request->id)->first();
        $student->remarks = $request->remarks;
        $student->status = $request->status;
        if ($request->status == 2 && $request->issued == 1) {
            if ($student->regd_no == null) {
                $std = StudentDetails::where('regd_no', '!=', null)->latest()->first();
                if (!empty($std)) {
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
                $student->regd_no_issued = '1';
            }
        }else{
            $student->regd_no_issued = '0';

        }

        $student->save();
        return redirect()->action([AdmissionController::class, 'appliedAdmissionList'])->with('success', 'Application examined successfully.');
    }

    public function admissionDetails(Request $request, $id)
    {
        $student = StudentDetails::where('id', $id)->first();
        $education = StudentEducationDetails::where('id', $id)->first();
        $address = StudentAddress::where('id', $id)->first();
        $documents = StudentDocuments::where('id', $id)->first();

        return view('admin.admission.view', compact('id', 'student', 'address', 'education', 'documents'));
    }
    public function appliedApplication($id){

        $district = District::get();
        $documents = StudentDocuments::where('id', $id)->first();
        $student  = StudentDetails::where('id', $id)->first();
        $education = StudentEducationDetails::where('id', $id)->first();
        $address = StudentAddress::where('id', $id)->first();
        return view('admission.apply_app',compact('student', 'address', 'education', 'district', 'documents'));
    }
}
