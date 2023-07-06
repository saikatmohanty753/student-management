<?php

namespace App\Http\Controllers;

use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseFor;
use App\Models\Notice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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

        $notice = Notice::where([['notice_sub_type', '1'], ['notice_type', 1]])->orderBy('id', 'desc')->get();
        $uucNotice = Notice::where([['notice_sub_type', '5'], ['notice_type', 1]])->orderBy('id', 'desc')->get();
        $clgNotice = Notice::where([['notice_sub_type', '2'], ['notice_type', 1]])->orderBy('id', 'desc')->get();
        $studentNotice = Notice::where([['notice_sub_type', '3'], ['notice_type', 1]])->orderBy('id', 'desc')->get();
        $eventNotice = Notice::where([['notice_sub_type', '4'], ['notice_type', 1]])->orderBy('id', 'desc')->get();
        return view('notices.notices', compact('notice', 'clgNotice', 'studentNotice', 'eventNotice','uucNotice'));
    }

    public function create()
    {
        $course = Course::all();
        $dept = CourseFor::all();
        return view('notices.add_notice', compact('course', 'dept'));
    }

    public function store(Request $request)
    {
        // return $request;
        $this->validate($request, [
            'notice_type' => 'required',
            'start_date' => 'required',
            'exp_date' => 'required',
            'details' => 'required'

        ]);

        $startDate = Carbon::parse($request->start_date);
        $startDate->hour   = 00;
        $startDate->minute = 00;
        $startDate->second = 01;
        $expDate = Carbon::parse($request->exp_date);
        $expDate->hour   = 23;
        $expDate->minute = 59;
        $expDate->second = 59;
        $fee_payment = Carbon::parse($request->fee_payment);
        $fee_payment->hour   = 23;
        $fee_payment->minute = 59;
        $fee_payment->second = 59;
        $publish_date = Carbon::parse($request->publish_date);
        $publish_date->hour   = 00;
        $publish_date->minute = 00;
        $publish_date->second = 01;
        $notice = new Notice();
        $notice->notice_type = 1;
        $notice->notice_sub_type = $request->notice_type;
        $notice->department_id = $request->department;
        $notice->course_id = $request->course != '' ? implode(',', $request->course) : '';
        $notice->semester = $request->semester;
        $notice->start_date = $startDate;
        $notice->exp_date = $expDate;
        $notice->details = $request->details;
        $notice->published_date = $publish_date;
        $notice->payment_last_date = $fee_payment;
        $notice->session = Carbon::parse($request->exp_date)->format('Y');
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
        $course = Course::all();
        $dept = CourseFor::all();
        $notice = Notice::find($id);

        if ($notice->is_verified == 0) {
            return view('notices.edit', compact('course', 'dept', 'notice'));
        } else {
            return redirect()->action([NoticesController::class, 'index'])->with('error', 'Notice can not be modified.');
        }
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
        //  return $request->notice_type;

        $startDate = Carbon::parse($request->start_date);
        $startDate->hour   = 00;
        $startDate->minute = 00;
        $startDate->second = 01;

        $expDate = Carbon::parse($request->exp_date);
        $expDate->hour   = 23;
        $expDate->minute = 59;
        $expDate->second = 59;
        $fee_payment = Carbon::parse($request->fee_payment);
        $fee_payment->hour   = 23;
        $fee_payment->minute = 59;
        $fee_payment->second = 59;
        $notice = Notice::find($id);
        $notice->notice_type = 1;
        $notice->notice_sub_type = $request->notice_type;
        $notice->department_id = $request->notice_type == 1 ? $request->department : '';
        $notice->start_date = $startDate;
        $notice->exp_date = $expDate;
        $notice->details = $request->details;
        $notice->payment_last_date = $request->fee_payment != '' ? $fee_payment : '';
        $notice->session = Carbon::parse($request->exp_date)->format('Y');
        if ($notice->is_verified == 0) {
            $notice->save();
            return redirect()->action([NoticesController::class, 'index'])->with('success', 'Notice Updated Successfully');
        } else {
            return redirect()->action([NoticesController::class, 'index'])->with('error', 'Notice can not be modified.');
        }
    }

    public function status(Request $request)
    {


        $status = Notice::find($request->id);
        $status->is_verified = $request->verified;
        $status->save();
        return redirect()->back();
    }

    // public function verified($id){
    //     return $verified=Notice::find($id);
    //     return view('notices.notices', compact('verified'));
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $count = Notice::where([['id', $id], ['status', 0]])->count();
        if ($count == 1) {
            Notice::find($id)->delete();
            return redirect()->route('notices.index')
                ->with('success', 'Notice deleted successfully');
        } else {
            return redirect()->route('notices.index')
                ->with('error', 'Notice can not be deleted..');
        }
    }
}
