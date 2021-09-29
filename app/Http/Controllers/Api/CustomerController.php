<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = customer::where('branch_id', auth()->user()->branch_id())->get();
        return response([
            'success' => true,
            'customers'=>$customer
        ]);
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
        $request->validate([
            'company'=>'required|string|max:255',
            'name'=>'required|string|max:255',
            'phone'=>'required|string|max:10',
            'address'=>'required|string|max:1000',
        ]);
        $model_customer = new customer;

        $model_customer->company = $request->company;
        $model_customer->name=$request->name;
        $model_customer->phone=$request->phone;
        $model_customer->address=$request->address;
        $model_customer->branch_id=auth()->user()->branch_id();

        $model_customer->save();
        return response([
            'success' => true,
            'customer'=>$model_customer,
        ]);

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
        $request->validate([
            'company'=>'required|string|max:255',
            'name'=>'required|string|max:255',
            'phone'=>'required|exists:customers,phone',
            'address'=>'required|string|max:1000',
        ]);
        $model_customer =  customer::where('phone',$request->phone);

        $model_customer->phone=$request->phone;
        $model_customer->company = $request->company;
        $model_customer->name=$request->name;
        $model_customer->address=$request->address;

        $model_customer->save();
        return response([
            'success' => true,
            'customer'=>$model_customer,
        ]);
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
