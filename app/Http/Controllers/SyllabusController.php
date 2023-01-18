<?php

namespace App\Http\Controllers;

use App\Models\CourseFor;
use Illuminate\Http\Request;

class SyllabusController extends Controller
{

    function __construct()

    {
        $this->middleware('permission:syllabus-list|syllabus-create|syllabus-edit|syllabus-delete', ['only' => ['index', 'store', 'syllabus']]);

        $this->middleware('permission:syllabus-create', ['only' => ['create', 'store', 'syllabus']]);

        $this->middleware('permission:syllabus-edit', ['only' => ['edit', 'update', 'syllabus']]);

        $this->middleware('permission:syllabus-delete', ['only' => ['destroy']]);
    }

    public function syllabus($id, $dep, $sem)
    {
        $data = CourseFor::find($id);
        $data['semester-no'] = $sem;
        return view('syllabus.index', compact($data));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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


}
