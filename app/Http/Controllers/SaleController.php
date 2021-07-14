<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_Details;
use App\Models\Wallet;
use App\Models\Has_Branchs;
use Illuminate\Support\Facades\DB;
use App\Models\Branchs;
class SaleController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $Product = Product::all();
        return view('sales.sale')->with(['products'=>$Product]);
        
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
   
        
        // print_r($request->product);
        $totol = 0.0;
        $discount = 0;
        foreach ($request->product as $key => $value) {
            $n = number_format(floatval($value['totol']), 2, '.', '');
            $totol += $n;
        }
        $discount = number_format(floatval($request->discount), 2, '.', '');
        $cash = number_format(floatval($request->cash), 2, '.', '');
        $change = $cash - ($totol - $discount); 
        $net_amount = $totol - $discount; 
        
        $order = new Order;
        $order->cash_totol=$totol;  // รวมราคาสินค้า
        $order->cash=$cash;   //เงินสด
        $order->discount=$discount; // ส่วนลด
        $order->net_amount=$net_amount;   // ยอดสุุทธิ
        $order->change=$change;   // เงินทอน
        $order->status=$request->status;   // สถานะ
        $order->paid_by=$request->paid_by;   // ชำระโดย
        $order->user_id=auth()->user()->id;  // คนขาย
        $order->branch_id = Has_Branchs::where('user_id',auth()->user()->id)->first()->id;  // สาขา
        $order->save();  // คนขาย
        
        // เพิ่มเงินใส่กระเป๋า

        $walwt = Wallet::where('branch_id', Has_Branchs::where('user_id',auth()->user()->id)->first()->id)->first()->balance;
        Wallet::where('branch_id', Has_Branchs::where('user_id',auth()->user()->id)->first()->id)->update(['balance'=> floatval($net_amount) + floatval($walwt)]);

        foreach ($request->product as $key => $value) {
            $order_detail = new Order_details;
            $order_detail->product_id = $value['id'];
            $order_detail->order_id = $order->id;
            $order_detail->name = $value['name'];
            $order_detail->price = $value['price'];
            $order_detail->totol = $value['totol'];
            $order_detail->qty = $value['qty'];
            $order_detail->save();

            // ลบออกจากคลัง
            $p_qty = Product::where('id',$value['id'])->first()->qty;
            // $p_qty =  $Product;
            Product::where('id',$value['id'])->update(['qty'=> intval($p_qty)  -  intval($value['qty']) ] );

        }


        return response()->json([
            'Change' => $change
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
