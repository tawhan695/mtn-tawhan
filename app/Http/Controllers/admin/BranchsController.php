<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Branchs;
use Illuminate\Http\Request;

class BranchsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branchs = Branchs::all();
        return view('admin.branchs.index')->with(['branchs'=>$branchs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.branchs.create');
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
     * @param  \App\Models\Branchs  $branchs
     * @return \Illuminate\Http\Response
     */
    public function show(Branchs $branchs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branchs  $branchs
     * @return \Illuminate\Http\Response
     */
    public function edit(Branchs $branchs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branchs  $branchs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branchs $branchs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branchs  $branchs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branchs $branchs)
    {
        //
    }
}