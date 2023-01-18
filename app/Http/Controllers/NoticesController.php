<?php

namespace App\Http\Controllers;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseFor;
use App\Models\Notice;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NoticesController extends Controller
{
    function __construct()

    {

        $this->middleware('permission:notice-list|notice-create|notice-edit|notice-delete', ['only' => ['index', 'store']]);

        $this->middleware('permission:notice-create', ['only' => ['create', 'store']]);

        $this->middleware('permission:notice-edit', ['only' => ['edit', 'update']]);

        $this->middleware('permission:notice-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $notice = Notice::all();
        return view('notices.notices', compact('notice'));
    }

    public function create()
    {
        $course = Course::all();
        $dept = CourseFor::all();
        return view('notices.add_notice', compact('course', 'dept'));
    }

    public function store(Request $request)
    {
        return back()->with('success', 'Notification Created Successfully');
        $startDate = Carbon::parse($request->start_date);
        $startDate->hour   = 00;
        $startDate->minute = 00;
        $startDate->second = 01;
        $expDate = Carbon::parse($request->exp_date);
        $expDate->hour   = 59;
        $expDate->minute = 59;
        $expDate->second = 59;
        $notice = new Notice();
        $notice->notice_type = $request->notice_type;
        $notice->department_id = $request->department;
        $notice->course_id = $request->course != '' ? implode(',', $request->course) : '';
        $notice->semester = $request->semester;
        $notice->start_date = $startDate;
        $notice->exp_date = $expDate;
        $notice->details = $request->details;
        $notice->save();
        return redirect()->action([NoticesController::class, 'index'])->with('success', 'Notification Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('notices')
            ->select('notices.*', 'course_fors.course_for as course', 'courses.name as couse_name')
            ->leftJoin('course_fors', 'notices.department_id', "=", 'course_fors.id')
            ->leftJoin('courses', 'notices.course_id', "=", 'courses.id')
            ->where('notices.id', $id)
            ->first();
        return view('notices.view', compact('data'));
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
