<?php

namespace App\Http\Controllers;

use App\Models\ReturnProduct;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_Details;
use App\Models\Wallet;
use App\Models\payment;
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
        // $walwt = Wallet::where('branch_id', Has_Branchs::where('user_id',auth()->user()->id)->first()->id)->first()->balance;
        if($request->qty >= 1){
            // $qty = $Order_Details->qty - $request->qty

            $orr = Order_Details::where('id',$request->idd);
            $totol = $orr->first()->price * $request->qty;
            $product = Product::where('id',$orr->first()->product_id);

            $qty = $product->first()->qty;
            $product->update([
                'qty' => $qty + ($orr->first()->qty - $request->qty),
            ]);
            $orr->update([
                'qty'=> $request->qty,
                'totol'=> $orr->first()->totol - $totol,
            ]);
            //ที่โปรแกรมมันใช้ไม่ได้ คือ..
            //ผมยังทำไม่เสร็จ




            $order = Order::where('id',$orr->first()->order_id)->first();
            Order::where('id',$orr->first()->order_id)->update([
                'cash_totol'=> $order->cash_totol -($order->cash_totol - $totol) ,
                'net_amount'=>  floatval($totol) - floatval($order->discount) ,
                'change' => $order->cash - (floatval($totol) - floatval($order->discount)),
            ]);

            $walwt = Wallet::where('branch_id', auth()->user()->branch_id());
            $Price = $walwt->first()->balance;
            $walwt->first()->update_payment($order->id,$order->cash - (floatval($totol) - floatval($order->discount)));
            $walwt->update([
                 'balance' => $Price - $totol
              ]);

            // Wallet::where('branch_id', Has_Branchs::where('user_id',auth()->user()->id)->first()->id)->update(['balance'=> floatval($walwt)-floatval($totol)]);
            // dd($order);
        }else if($request->qty <1 ){

           $del_data =  Order_Details::where('id',$request->idd)->first();
           $totol = $del_data->price * $del_data->qty;

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
                'change' => $order->cash - (floatval($totol) - floatval($order->discount)),
                'status'=>  'ยกเลิก' ,
            ]);
            $orr = Order_Details::where('id',$request->idd);
            $product = Product::where('id',$orr->first()->product_id);

            $qty = $product->first()->qty;
            $product->update([
                'qty' => $qty + ($orr->first()->qty - $request->qty),
            ]);
            $walwt = Wallet::where('branch_id', auth()->user()->branch_id());
            $Price = $walwt->first()->balance;
            $walwt->update([
                 'balance' => $Price - $totol
              ]);
            Order_Details::where('id',$request->idd)->delete();
            $od = Order_Details::where('order_id',$order->id);
            // print_r($od->count());

            if ($od->count() == 0) {
                // echo "<br>";
                // print_r($od->count());
                $this->destroy($order->id);
                // $od->delete();
                return redirect()->route('transection.index');
                // # code...
            }
            // Wallet::where('branch_id', Has_Branchs::where('user_id',auth()->user()->id)->first()->id)->update(['balance'=> floatval($walwt)-floatval($totol)]);
        }
        // print_r($Order_Details->qty);
        // print_r($Order_Details->qty);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $Order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $or = Order::find($id)->with(['order_details']);
        $order_details = $or->first()->order_details;
        foreach ($order_details as $item){
           $product = Product::where('id',$item->product_id);
           $qty = $product->first()->qty;
           $product->update([
                'qty' => $qty + $item->qty,
           ]);
          $walwt = Wallet::where('branch_id', auth()->user()->branch_id());
          $Price = $walwt->first()->balance;
          $walwt->update([
               'balance' => $Price - ($item->qty * $item->price)
            ]);
            Wallet::where('branch_id', auth()->user()->branch_id())->first()->del_payment($or->first()->id);
        }
        $or->delete();
        return redirect()->route('transection.index');

    }
}
