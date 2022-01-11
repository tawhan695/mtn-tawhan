<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_Details;
use App\Models\Wallet;
use App\Models\Has_Branchs;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Catagory;
use Exception;
use Phattarachai\LineNotify\Line;
use App\Models\Linenotify;
use App\Models\customer;
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
        $Product = Product::where('branch_id',auth()->user()->branch_id())->get();
        $Catagory = Catagory::where('branch_id',auth()->user()->branch_id())->get();

        // dd($Product);
        // print_r($Catagory);
        return view('sales.sale')->with(['products'=>$Product,'catagory'=>$Catagory]);

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


       try {
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
        $order->status_sale=$request->status_sale;   // สถานะ
        $order->paid_by=$request->paid_by;   // ชำระโดย
        $order->user_id=auth()->user()->id;  // คนขาย
        $order->customer_id=$request->customer;  // คนขาย
        $order->branch_id = auth()->user()->branch_id();  // สาขา
        $order->save();  // คนขาย

        // เพิ่มเงินใส่กระเป๋า
        $text_line = "";
        $text_line = "เลขที่ใบเสร็จ ". $order->id ."/n";
        $text_line += "---------------";
        $walwt = Wallet::where('branch_id', auth()->user()->branch_id())->first()->balance;
        Wallet::where('branch_id', auth()->user()->branch_id())->update(['balance'=> floatval($net_amount) + floatval($walwt)]);
        // $text_line = "แคชเชียร์ ".auth()->user()->name ."/n";
        // $customer = customer::where('id',$request->customer)->first()->company;
        // if( $customer){
        //     $text_line = "ลูกค้า ". $customer ."/n";
        // }else{
        //     $text_line = "ลูกค้า :ทั่วไป/n";
        // }
        // $text_line += "---------------";

        foreach ($request->product as $key => $value) {
            $order_detail = new Order_details;
            $order_detail->product_id = $value['id'];
            $order_detail->order_id = $order->id;
            $order_detail->name = $value['name'];
            $order_detail->price = $value['price'];
            $order_detail->totol = $value['totol'];
            $order_detail->qty = $value['qty'];
            $order_detail->save();


            $text_line += $value['name']. "ราคา ".$value['price'] ."จำนวน ".$value['qty']."รวม ".$value['totol']."/n";

            // ลบออกจากคลัง
            $p_qty = Product::where('id',$value['id'])->first()->qty;
            // $p_qty =  $Product;
           Product::where('id',$value['id'])->update(['qty'=> intval($p_qty)  -  intval($value['qty']) ] );

        }
        // $text_line += "---------------/n";
        $prod = Order::where('id',$order->id)->first();

        $date = date_create($order->created_at);
        $walet = Wallet::where('branch_id',auth()->user()->branch_id())->first()
        ->payment_add($order->id,$change,'เงินทอน');

        $date_up = date_format($date,'Y-m-d H:i:s');

        // $text_line += "รวมยอด ". $totol."/n";
        // $text_line += "เงิน".$request->paid_by."รับ ". $cash."/n";
        // $text_line += "สวนลด ". $discount."/n";
        // $text_line += "เงินทอน ". $discount."/n";
        // $text_line += "เงินทอน ". $discount."/n";
        // $text_line += "---------------/n";
        // $text_line += " ". $date_up."/n";

        try{

            $linetoken =  Linenotify::where('branch_id',auth()->user()->branch_id())->first()->token;
            $line = new Line($linetoken);
            $line->send('ขายสินค้า:'. $text_line  );
        }catch(\Exception $e){

        }
        return response()->json([
            'Change' => $change,
            'order_detail' => $request->product,
            'totol' => $totol,
            'cash' => $cash,
            'discount' => $discount,
            'net_amount' => $net_amount,
            'change' => $change,
            'date' =>$date_up ,
            'sale' => User::where('id',$prod->user_id)->first()->name,
            'D' =>  $order
            ]);

        } catch (Exception $e){
            return response()->json([
                'error' =>$e,
            ]);
        }
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
