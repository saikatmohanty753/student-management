<?php

namespace App\Http\Controllers;

use App\Models\StudentDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = DB::table("roles")->where("");
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
        $students = StudentDetails::where('id', $id)->get();

        return view('colleges.view', compact('students'));
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

        $courseview = StudentDetails::where([['clg_id', Auth::user()->clg_user_id], ['department_id', $department_id]])->groupby('course_id')->distinct()->get(['course_id', 'department_id', 'batch_year']);

        return view('colleges.course', compact('courseview'));
    }

    public function studentincourseview($department_id, $course_id)
    {
        //  $currunt_year = date("Y");

        $studentincourseview = StudentDetails::select('name', 'id', 'batch_year')
            ->where('clg_id', Auth::user()->clg_user_id)
            ->where('department_id', $department_id)
            ->where('course_id', $course_id)
            // ->where('batch_year','like','%'.$currunt_year.'%')
            // ->distinct()
            ->get();

        $course_id = $course_id;
        $department_id = $department_id;

        return view('colleges.studentincourse', compact('studentincourseview', 'course_id', 'department_id'));
    }


    public function filterStudent(Request $request)
    {
        if ($request->ajax()) {
            $departmentId = $request->department_id;
            $courseId = $request->course_id;
            $fromDate = $request->from_date;
            $toDate = $request->to_date;

            if (!empty($fromDate) && !empty($toDate)) {
                /* $from = date('Y', strtotime($fromDate));
                $to = date('Y', strtotime($toDate)); */
                $search_year = $fromDate . '-' . $toDate;
                $data = StudentDetails::select('name')
                    ->where('clg_id', Auth::user()->clg_user_id)
                    ->where('department_id', $departmentId)
                    ->where('course_id', $courseId)
                    ->where('batch_year', 'like', '%' . $search_year . '%')
                    ->get();
            } else {
                $data = StudentDetails::select('name')
                    ->where('clg_id', Auth::user()->clg_user_id)
                    ->where('department_id', $departmentId)
                    ->where('course_id', $courseId)
                    ->get();
            }
            return response()->json($data);
        }
    }
}
