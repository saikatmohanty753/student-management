<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Course;
use App\Models\CourseFor;
use App\Models\StudentDetails;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UucStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $department = CourseFor::all();
        $course = Course::all();
        $college = College::all(['id', 'name']);
        return view('uuc-student.index', compact('department', 'course', 'college'));
    }


    public function uucStudent(Request $request)
    {
        if ($request->ajax()) {
            $data = StudentDetails::select('sd.*', 'courses.name as course_name', 'cf.course_for as dep_name', 'colleges.name as clg_name')
                ->from('student_details as sd')
                ->join('course_fors as cf', 'sd.department_id', 'cf.id')
                ->join('courses', 'sd.course_id', 'courses.id')
                ->join('colleges', 'sd.clg_id', 'colleges.id');
            // ->get();
            return Datatables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('view', function ($row) {
                    $btn = '<a href="'.route('uuc-students.show', [$row->id]).'" id="' . $row->id . '" class="edit btn btn-info btn-sm">View</a>';
                    return $btn;
                })
                ->filter(function ($instance) use ($request) {
                    $instance->where('admission_year', $request->get('session'));
                    if ($request->get('dep') != '') {
                        $instance->where('sd.department_id', $request->get('dep'));
                    }
                    if ($request->get('course') != '') {
                        $instance->where('cs.course_id', $request->get('course'));
                    }
                    if ($request->get('sem') != '') {
                        $instance->where('cs.semester', $request->get('sem'));
                    }
                })
                ->rawColumns(['view'])
                ->make(true);
        }
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
        return $id;
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
}
