<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\StudentDetails;
use App\Models\College;
use Illuminate\Support\Facades\Auth;

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

    // $user = auth()->user();
    public function clgStudents()
    {
        
        $students = StudentDetails::where('clg_id', Auth::user()->clg_user_id)->get();
        return view('colleges.student', compact('students'));

    }

    public function studentview($id){

        // $students = StudentDetails::where('clg_id', Auth::user()->clg_user_id)->get();
        $students=StudentDetails::where('id',$id)->get();

        return view('colleges.view',compact('students'));
    }

    public function departmentview(){

        
        $departmentview=StudentDetails::select('department_id')
    ->where('clg_id', Auth::user()->clg_user_id)
    ->distinct()
    ->get();


        return view('colleges.department',compact('departmentview'));
    }

    

    public function courseview($department_id){

        
 

     $courseview = StudentDetails::where([['clg_id', Auth::user()->clg_user_id],['department_id', $department_id]])->groupby('course_id')->distinct()->get(['course_id','department_id','batch_year']);


        return view('colleges.course',compact('courseview'));
    }

    public function studentincourseview($department_id,$course_id){
        //  $currunt_year = date("Y");
        
         $studentincourseview = StudentDetails::select('name','id','batch_year')
    ->where('clg_id', Auth::user()->clg_user_id)
    ->where('department_id', $department_id)
    ->where('course_id', $course_id)
    // ->where('batch_year','like','%'.$currunt_year.'%')
    // ->distinct()
    ->get();

        $course_id =$course_id;
        $department_id =$department_id;

        return view('colleges.studentincourse',compact('studentincourseview','course_id','department_id'));
    }
    public function filterstudent(Request $res){
        // return $res;
        $from = date('Y', strtotime($res->filterstudent));
        $to = date('Y', strtotime($res->studentinbatchyear));
        $search_year=$from.'-'.$to;


 $results = StudentDetails::
    where('clg_id', Auth::user()->clg_user_id)
    ->where('department_id', $res->deprt_id)
    ->where('course_id', $res->course_id)
    ->where('batch_year','like','%'.$search_year.'%')
    // ->distinct()
    ->get();

// $results = StudentDetails::where('batch_year', 'LIKE', $search_year)->get(['results']);


return view('colleges.filterstudent',compact('results'));
        
               

        
    }



}
