<?php

namespace App\Http\Controllers;

use App\Models\AcademicCourseStructure;
use App\Models\Course;
use App\Models\CourseFor;
use App\Models\Credit;
use App\Models\Paper;
use App\Models\PaperSubType;
use Illuminate\Http\Request;
use DataTables;

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
        $paper_type = Paper::all();

        return view('course-structure.create', compact('department', 'credit', 'paper_type'));
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
        $data->paper_type_id = $request->paper_type;
        $data->paper_sub_type_id = $request->paper_sub_type;
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
        $paper_type = Paper::all();
        $paper_sub_type = PaperSubType::where('paper_type_id', $data->paper_type_id)->get();

        return view('course-structure.edit', compact('data', 'department', 'credit', 'course', 'sem', 'paper_type', 'paper_sub_type'));
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
        $data->paper_type_id = $request->paper_type;
        $data->paper_sub_type_id = $request->paper_sub_type;
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

    public function mapedCourse()
    {
        $department = CourseFor::all();
        $course = Course::all();
        return view('course-structure.maped-course', compact('department', 'course'));
    }
    public function filterCourse(Request $request)
    {
        if ($request->ajax()) {
            $data = AcademicCourseStructure::select('cs.*', 'courses.name as course_name', 'cf.course_for as dep_name', 'pt.paper_type', 'pst.paper_sub_type')
                ->from('academic_course_structures as cs')
                // ->latest()
                ->join('course_fors as cf', 'cs.dep_id', 'cf.id')
                ->join('courses', 'cs.course_id', 'courses.id')
                ->join('papers as pt', 'cs.paper_type_id', 'pt.id')
                ->join('paper_sub_types as pst', 'cs.paper_sub_type_id', 'pst.id');
            // ->get();
            return Datatables::eloquent($data)
                ->addIndexColumn()
                /*                 ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action']) */
                ->filter(function ($instance) use ($request) {
                    $instance->where('session_year', $request->get('session'));
                    if ($request->get('dep') != '') {
                        $instance->where('dep_id', $request->get('dep'));
                    }
                    if ($request->get('course')!= '') {
                        $instance->where('cs.course_id', $request->get('course'));
                    }
                    if ($request->get('sem')!= '') {
                        $instance->where('cs.semester', $request->get('sem'));
                    }
                })
                ->make(true);
        }
    }
}
