<?php

namespace App\Http\Controllers;

use App\Models\AcademicCourseStructure;
use App\Models\Course;
use App\Models\CourseFor;
use App\Models\Credit;
use Illuminate\Http\Request;

class CourseStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AcademicCourseStructure::all();
        return view('course-structure.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department = CourseFor::all();
        $credit = Credit::all();
        return view('course-structure.create', compact('department', 'credit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new AcademicCourseStructure();
        $data->year = $request->year;
        $data->session_year = $request->session_year;
        $data->dep_id = $request->department;
        $data->course_id = $request->course;
        $data->semester = $request->semester;
        $data->paper_code = $request->paper_code;
        $data->subject = $request->subject;
        $data->mid_sem_mark = $request->mid_sem_mark;
        $data->end_sem_mark = $request->end_sem_mark;
        $data->total_marks = $request->total_marks;
        $data->pass_mark = $request->pass_mark;
        $data->credit = $request->credit;
        $data->save();
        return redirect()->action([CourseStructureController::class, 'index'])->with('success', 'Academic Course Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('course-structure.show');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = AcademicCourseStructure::find($id);
        $department = CourseFor::all();
        $course = Course::where('course_for', $data->dep_id)->get();
        $credit = Credit::all();
        $sem = CourseFor::where('id', $data->dep_id)->first(['semester']);
        return view('course-structure.edit', compact('data', 'department', 'credit', 'course', 'sem'));
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
        $data = AcademicCourseStructure::find($id);
        $data->year = $request->year;
        $data->session_year = $request->session_year;
        $data->dep_id = $request->department;
        $data->course_id = $request->course;
        $data->semester = $request->semester;
        $data->paper_code = $request->paper_code;
        $data->subject = $request->subject;
        $data->mid_sem_mark = $request->mid_sem_mark;
        $data->end_sem_mark = $request->end_sem_mark;
        $data->total_marks = $request->total_marks;
        $data->pass_mark = $request->pass_mark;
        $data->credit = $request->credit;
        $data->save();
        return redirect()->action([CourseStructureController::class, 'index'])->with('success', 'Academic Course Updated Successfully');
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
}
