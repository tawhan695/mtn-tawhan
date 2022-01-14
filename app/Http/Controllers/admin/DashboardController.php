<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Defective;
use App\Models\Order;
use App\Models\Order_Details;

class DashboardController extends Controller
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
//         $mytime = \Carbon\Carbon::now();
// echo $mytime->toDateTimeString();
//WHERE `created_at` LIKE '%2021-07-14%' ORDER BY `legular_price` ASC
$dayDefective = Defective::where('branch_id', auth()->user()->branch_id())->where('created_at','like','%'.date('Y-m-d').'%')->count();
$dayOrder = Order::where('branch_id', auth()->user()->branch_id())
->where('status','สำเร็จ')
->where('created_at','like','%'.date('Y-m-d').'%')->count();
$sumOrder = Order::where('branch_id', auth()->user()->branch_id())
->where('status','สำเร็จ')
->where('created_at','like','%'.date('Y-m-d').'%')->sum('net_amount');
$Product = Product::where('branch_id',auth()->user()->branch_id())
->get();
// ->get(['id','name','unit','retail_price','wholesale_price']);
        // $Product_day = Product::where('branch_id',auth()->user()->branch_id())

        //     ->get(['id','name','unit','retail_price','wholesale_price']);
        // print_r(date());
        return view('admin.dashboard.index')->with([
            'Defective'=>$dayDefective,
            'Order'=>$dayOrder,
            'ordersum'=>$sumOrder,
            'product'=>$Product,
            // 'product_day'=>$Product_day,

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
