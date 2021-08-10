<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Defective;
use App\Models\Order;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//         $mytime = \Carbon\Carbon::now();
// echo $mytime->toDateTimeString();
//WHERE `created_at` LIKE '%2021-07-14%' ORDER BY `legular_price` ASC
        $dayDefective = Defective::where('created_at','like','%'.date('Y-m-d').'%')->count();
        $dayOrder = Order::where('created_at','like','%'.date('Y-m-d').'%')->count();
        $sumOrder = Order::where('created_at','like','%'.date('Y-m-d').'%')->sum('net_amount');
        // print_r(date());
        return view('admin.dashboard.index')->with(['Defective'=>$dayDefective,'Order'=>$dayOrder,'ordersum'=>$sumOrder]);
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
