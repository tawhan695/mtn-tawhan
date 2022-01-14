<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order_Details;
use App\Models\Product;
use App\Models\Wallet;
use Phattarachai\LineNotify\Line;
use App\Models\Linenotify;
class OrderController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request){
        return response([
             'detail' =>Order_Details::join('products','products.id','=','order__details.product_id')->where('order_id',$request->id)->select('products.unit', 'order__details.*')->get()

        ]);
    }
    public function index()
    {
        /*
        $users = User::join('posts', 'users.id', '=', 'posts.user_id')
               ->get(['users.*', 'posts.descrption']
        */
        return response([
            'order'=>
             Order::where('branch_id',auth()->user()->branch_id())
             ->orderBy('created_at', 'desc')
            //  ->order_details()
             ->paginate(8),
            //  'detail' =>Order_Details::where('branch_id',auth()->user()->branch_id())->get()

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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        return response([
            'order' =>  Order::where('id', $request->id)->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $or = Order::where('id', $id)->with(['order_details']);
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

        $or->update([
            'status' =>'คืนสินค้า/คืนเงิน'
        ]);

        try{

            $linetoken =  Linenotify::where('branch_id',auth()->user()->branch_id())->first()->token;
            $line = new Line($linetoken);
            $line->send('ขายสินค้า คืนสินค้า/ยกเลิกสินค้า ใบเสร้จที่ :'.  $or->id);
            // $line->send('ขายสินค้า:'.customer::where('phone', $request->customer)->first()->company);
        }catch(\Exception $e){

        }
        return response([
            'success' => true,
        ]);
    }
}
