<?php

namespace App\Http\Controllers;

use App\Models\Paper;
use Illuminate\Http\Request;

class PaperController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:paper-list|paper-create|paper-edit|paper-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:paper-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:paper-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:paper-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $data = Paper::orderBy('id', 'ASC')->get();
        return view('paper.index', compact('data'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        return $request;
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
