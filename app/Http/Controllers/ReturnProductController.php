<?php

namespace App\Http\Controllers;

use App\Models\ReturnProduct;
use App\Models\Order;
use App\Models\Order_Details;
use App\Models\Wallet;
use App\Models\Has_Branchs;
use Illuminate\Http\Request;

class ReturnProductController extends Controller
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
        return view('sales.return');

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
     * @param  \App\Models\ReturnProduct  $returnProduct
     * @return \Illuminate\Http\Response
     */
    public function show(Order $returnProduct)
    {
        // return view('sales.orders_edit');
        return view('sales.return');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReturnProduct  $returnProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $order =Order::where('id',$request->id)->first();
        $order_details = Order_Details::join('products','products.id','=','order__details.product_id')->where('order_id',$order->id)->select('products.unit', 'order__details.*')->get();
        // dd($order);
        
        // dd($order_details);
        return view('sales.orders_edit')->with(['order'=>$order,'details'=>$order_details]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReturnProduct  $returnProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $Order_Details = Order_Details::where('id',$request->idd)->first();
        $walwt = Wallet::where('branch_id', Has_Branchs::where('user_id',auth()->user()->id)->first()->id)->first()->balance;
        if($request->qty >= 1){
            $totol = $Order_Details->price * $request->qty;
            // $qty = $Order_Details->qty - $request->qty
            Order_Details::find($request->idd)->update([
                'qty'=>  $request->qty,
                'totol'=> $Order_Details->totol - $totol,
                
            ]);
            // print($request->idd);
            // echo "//////////";
            // print($Order_Details);

            $order = Order::where('id',$Order_Details->order_id)->first();
            Order::where('id',$Order_Details->order_id)->update([
                'cash_totol'=>  $totol ,
                'net_amount'=>  floatval($totol) - floatval($order->discount) ,
            ]);
            Wallet::where('branch_id', Has_Branchs::where('user_id',auth()->user()->id)->first()->id)->update(['balance'=> floatval($walwt)-floatval($totol)]);
            // dd($order);
        }else if($request->qty <1 ){

           $del_data =  Order_Details::where('id',$request->idd)->first();
           $totol = $del_data->price * $del_data->qty;
            Order_Details::where('id',$request->idd)->delete();
            $order = Order::where('id',$del_data->order_id)->first();
            $discount = $order->discount;
            $net_amount = $order->net_amount - $del_data->totol;
            if(( $order->net_amount - $del_data->totol) < 0){
                $discount = 0;
                $net_amount += $order->discount;
            }
            Order::where('id',$Order_Details->order_id)->update([
                'cash_totol'=>  $order->cash_totol - $del_data->totol ,
                'discount'=>  $discount ,
                'net_amount'=>  $net_amount ,
                'status'=>  'ยกเลิก' ,
            ]);
            Wallet::where('branch_id', Has_Branchs::where('user_id',auth()->user()->id)->first()->id)->update(['balance'=> floatval($walwt)-floatval($totol)]);
        }
        // print_r($Order_Details->qty);
        // print_r($Order_Details->qty);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnProduct  $returnProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnProduct $returnProduct)
    {
        //
    }
}
