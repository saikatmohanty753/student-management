<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClgNoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notification=  Auth::user()->Notifications;
        $noticeIds = [];
        foreach ($notification as $key => $value) {
            $noticeIds[] = $value['data']['notice_id'];
        }
        $notice = Notice::whereIn('id', $noticeIds)->where('notice_type', '1')->get();
        $OtherNotice = Notice::whereIn('id', $noticeIds)->where('notice_type', '3')->get();
        return view('publish-notices.index', compact('notice', 'OtherNotice'));
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
        $data = Notice::select('notices.*', 'course_fors.course_for as course', 'courses.name as couse_name')
        ->leftJoin('course_fors', 'notices.department_id', "=", 'course_fors.id')
        ->leftJoin('courses', 'notices.course_id', "=", 'courses.id')
        ->where('notices.id', $id)
        ->first();
        return view('publish-notices.view', compact('data'));
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
