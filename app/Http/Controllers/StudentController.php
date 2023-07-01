<?php

namespace App\Http\Controllers;

use App\Models\AdmissionSeat;
use App\Models\StudentApplication;
use App\Models\StudentDetails;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = DB::table("roles")->where("id", 3)->get();
        return view('student.index');
    }

    /**
     * Show the form for creating a new resource.
     * $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    // public function clgStudents()
    // {

    //     $students = StudentDetails::where('clg_id', Auth::user()->clg_user_id)->get();
    //     return view('colleges.student', compact('students'));

    // }

    public function studentview($id)
    {

        // $students = StudentDetails::where('clg_id', Auth::user()->clg_user_id)->get();
        // $students = StudentDetails::where('id', $id)->get();
        $std_app = StudentApplication::find($id);
        $studentdetails = StudentDetails::select('sd.*', 'colleges.name as clg_name', 'course_fors.course_for as departmentname', 'courses.name as coursename', 'student_addresses.*', 'student_education_details.*', 'student_education_details.qualification as qualification', 'student_documents.*', 'prsdis.district_name as present_dis', 'perdis.district_name as per_district')
            ->where('sd.id', $id)
            ->from('student_details as sd')
            ->leftJoin('colleges', 'sd.clg_id', '=', 'colleges.id')
            ->leftJoin('course_fors', 'sd.department_id', '=', 'course_fors.id')
            ->leftJoin('courses', 'sd.course_id', '=', 'courses.id')
            ->leftJoin('student_addresses', 'sd.id', '=', 'student_addresses.student_id')
            ->leftJoin('student_education_details', 'sd.id', '=', 'student_education_details.student_id')
            ->leftJoin('student_documents', 'sd.id', '=', 'student_documents.student_id')
            ->leftJoin('district as prsdis', 'student_addresses.present_district_id', '=', 'prsdis.id')
            ->leftJoin('district as perdis', 'student_addresses.permanent_district_id', '=', 'perdis.id')
            ->first();

        // $path = 'registration_card/UUC2300051.pdf';
        $path = 'registration_card/' . $studentdetails->regd_no . '.pdf';
        //return $path;

        if (file_exists(public_path($path))) {
            $path = 'registration_card/' . $studentdetails->regd_no . '.pdf';
        } else {
            // return  'The file does not exist';
            $path = 'The file does not exist';
        }

        $qualification_details = json_decode($studentdetails->qualification);

        return view('colleges.view', compact('studentdetails', 'qualification_details', 'std_app', 'path'));
    }

    public function departmentview()
    {
        $departmentview = StudentDetails::select('department_id')
            ->where('clg_id', Auth::user()->clg_user_id)
            ->distinct()
            ->get();

        return view('colleges.student', compact('departmentview'));
    }

    public function courseview($department_id)
    {

        $courseview = StudentDetails::where([['clg_id', Auth::user()->clg_user_id],
            ['department_id', $department_id]])->groupby('course_id')->distinct()->get(['course_id', 'department_id', 'batch_year']);

        foreach ($courseview as $key => $value) {
            $course_list_details = AdmissionSeat::where([['course_id', $value->course_id], ['department_id', $value->department_id], ['clg_id', Auth::user()->clg_user_id]])->get(['total_strength', 'available_seat']);

            foreach ($course_list_details as $key2 => $item) {
                // dd($item);
                $value->total_strength = $item->total_strength;
                $value->available_seat = $item->available_seat;
            }

            $course_all[] = $value;
        }

        // return $course_all;

        //  return   $courseview = StudentDetails::where([['clg_id', Auth::user()->clg_user_id],
        //  ['department_id', $department_id]])->groupby('course_id')->distinct()->get(['course_id', 'department_id', 'batch_year']);

        return view('colleges.course', compact('courseview', 'course_all'));
    }

    public function studentincourseview($department_id, $course_id)
    {
        //  $currunt_year = date("Y");

        $studentincourseview = StudentDetails::select('name', 'id', 'batch_year')
            ->where('clg_id', Auth::user()->clg_user_id)
            ->where('department_id', $department_id)
            ->where('course_id', $course_id)
        // ->where('batch_year','like','%'.$currunt_year.'%')
            ->orderBy('id', 'desc')
            ->get();

        $course_id = $course_id;
        $department_id = $department_id;

        return view('colleges.studentincourse', compact('studentincourseview', 'course_id', 'department_id'));
    }

    public function filterStudent(Request $request)
    {
        // return $request;
        if ($request->ajax()) {
            $departmentId = $request->department_id;
            $courseId = $request->course_id;
            $fromDate = $request->from_date;
            $toDate = $request->to_date;

            if (!empty($fromDate) && !empty($toDate)) {
                /* $from = date('Y', strtotime($fromDate));
                $to = date('Y', strtotime($toDate)); */
                $search_year = $fromDate . '-' . $toDate;
                $data = StudentDetails::select('student_details.*', 'cf.course_for as dep_name', 'courses.name as course_name')
                    ->where('clg_id', Auth::user()->clg_user_id)
                    ->where('department_id', $departmentId)
                    ->where('course_id', $courseId)
                    ->where('batch_year', 'like', '%' . $search_year . '%')
                    ->join('course_fors as cf', 'student_details.department_id', '=', 'cf.id')
                    ->join('courses', 'student_details.course_id', '=', 'courses.id')
                    ->get();
            } else {
                $data = StudentDetails::select('student_details.*', 'cf.course_for as dep_name', 'courses.name as course_name')
                    ->where('clg_id', Auth::user()->clg_user_id)
                    ->where('department_id', $departmentId)
                    ->where('course_id', $courseId)
                    ->join('course_fors as cf', 'student_details.department_id', '=', 'cf.id')
                    ->join('courses', 'student_details.course_id', '=', 'courses.id')
                    ->get();
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->make();
        }
    }
}
