<?php

namespace App\Http\Controllers;

use App\Models\CourseFor;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    function __construct()

    {

        $this->middleware('permission:semester-list|semester-create|semester-edit|semester-delete', ['only' => ['index', 'store']]);

        $this->middleware('permission:semester-create', ['only' => ['create', 'store']]);

        $this->middleware('permission:semester-edit', ['only' => ['edit', 'update']]);

        $this->middleware('permission:semester-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = CourseFor::all();
        return view('semester.index', compact('data'));
    }
    public function semesterList($id, $course)
    {
        $data = CourseFor::find($id);
        return view('semester.list', compact('data'));
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
        return view('semester.view');

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
