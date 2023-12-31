<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credit;

class CreditController extends Controller
{
    function __construct()

    {

        $this->middleware('permission:credit-list|credit-create|credit-edit|credit-delete', ['only' => ['index', 'store']]);

        $this->middleware('permission:credit-create', ['only' => ['create', 'store']]);

        $this->middleware('permission:credit-edit', ['only' => ['edit', 'update']]);

        $this->middleware('permission:credit-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $credit = Credit::all();
        return view('credit.index',compact('credit'));
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
        $credit = new Credit();
        $credit->credit = $request->credit;
        $credit->save();
        return redirect('/credit')->with('success', 'Credit stored successfully..');
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
        $credit = Credit::whereIn('id', $id)->get();
        return view('course_master.index', compact('credit'));
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $credit = Credit::find($request->hid);
        $credit->credit = intval($request->ecredit);
        $credit->save();
        return redirect('/credit')->with('success', 'Credit updated successfully..');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $credit = Credit::find($id);
        $credit->delete();
        return redirect('/credit');
    }
}
