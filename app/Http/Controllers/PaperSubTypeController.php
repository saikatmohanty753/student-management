<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaperSubType;
use App\Models\Paper;


class PaperSubTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        $Paper=Paper::all();
       
         $PaperSub= PaperSubType::select('pap.*','paper_sub_types.paper_sub_type')
         ->leftJoin("papers as pap", "paper_sub_types.paper_type_id", "=", "pap.id")
        
        ->get();
        return view('papersub.index',compact('Paper','PaperSub'));
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
       
      
        $paper = new PaperSubType();
        $paper->paper_type_id = $request->paper_type;
        $paper->paper_sub_type = $request->paper_sub_type;

        $paper->save();
        return redirect('/papersubtype')->with('success', 'Paper stored successfully..');
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
       
        $data = PaperSubType::find($id);
        $data->paper_type_id= $request->papertype;
        $data->paper_sub_type= $request->papersubtype;
        $data->save();
        return redirect('/papersubtype');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pap = PaperSubType::find($id);
        $pap->delete();
        return redirect('/papersubtype');
    }
}
