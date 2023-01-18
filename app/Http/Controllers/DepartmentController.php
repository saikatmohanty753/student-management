<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartmentMaster;
use App\Models\CourseFor;
// use App\Models\Course;
class DepartmentController extends Controller
{
    function __construct()

    {

        $this->middleware('permission:department-list|department-create|department-edit|department-delete', ['only' => ['index', 'store']]);

        $this->middleware('permission:department-create', ['only' => ['create', 'store']]);

        $this->middleware('permission:department-edit', ['only' => ['edit', 'update']]);

        $this->middleware('permission:department-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course = CourseFor::all();
        //    $dept = DepartmentMaster::all();
        return view('department_master.index', compact('course'));
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
        $department = new CourseFor();
        $department->course_for = $request->course;
        $department->save();
        return redirect('/department');
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
        $course = CourseFor::find($id);

        return view('department_master.index', compact('course'));
        return redirect()->back();
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
        $course = CourseFor::find($id);
        $course->course_for = $request->course;
        $course->save();
        return redirect('/department');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = CourseFor::find($id);
        $course->delete();
        return redirect('/department');
        // return redirect()->back();
    }
}
