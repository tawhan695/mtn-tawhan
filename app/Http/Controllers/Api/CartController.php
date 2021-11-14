<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\customer;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_Details;
use App\Models\Wallet;

class CartController extends Controller
{
    public function index(Request $request)
    {
        // if ($request->wantsJson()) {
        return response(
            $request->user()->cart()->get()
        );
        // }
        // return view('cart.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sku' => 'required|exists:products,sku',
        ]);
        $sku = $request->sku;

        $cart = $request->user()->cart()->where('sku', $sku)->first();
        if ($cart) {
            // update only quantity
            $product = Product::where('sku', $sku)
            ->where('branch_id', auth()->user()->branch_id());
            $qty = $product->first()->qty;

            if ($qty > 0){
                $cart->pivot->quantity = $cart->pivot->quantity + 1;
                $cart->pivot->save();

                $product->update([
                    'qty'=>$qty-1
                ]);
            }
        } else {
            $product = Product::where('sku', $sku)
            ->where('branch_id', auth()->user()->branch_id());
            $id = $product->first()->id;
            $request->user()->cart()->attach($id, ['quantity' => 1]);
            $qty = $product->first()->qty;
            $product->update([
                'qty'=>$qty-1
            ]);

        }

        return response('', 204);
    }

    public function changeQty(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $request->user()->cart()->where('id', $request->product_id)->first();

        if ($cart) {
            $Qty = $cart->pivot->quantity - $request->quantity;
            $cart->pivot->quantity = $request->quantity;
            $cart->pivot->save();
        }
        $product = Product::where('id', $request->product_id);
        // ->where('branch_id', auth()->user()->branch_id());
        $qty = $product->first()->qty;
        $product->update([
            'qty'=>$qty + ($Qty)
        ]);
        // if($Qty > 0){

        // }else if($Qty < 0){

        // }

        return response([
            'success' => true
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id'
        ]);
        $cart = $request->user()->cart()->where('id', $request->product_id)->first();
        $product = Product::where('id', $request->product_id);
        // ->where('branch_id', auth()->user()->branch_id());
        $qty = $product->first()->qty;
        $product->update([
            'qty'=>$qty + $cart->pivot->quantity
        ]);

        $request->user()->cart()->detach($request->product_id);

        return response('', 204);
    }

    public function empty(Request $request)
    {
        $cart =  $request->user()->cart()->get();
        foreach ($cart as $key => $value) {
            $product = Product::where('id', $value['pivot']['product_id']);
            $qty = $product->first()->qty;
            $product->update([
                'qty'=>$qty +$value['pivot']['quantity']
            ]);


        }

        $request->user()->cart()->detach();

        return response('', 204);
    }

    public function sale(Request $request)
    {
        /*
[id] => 1
[name] => ไข่ไก่ No.0
[slug] => 2265452
[sku] => 251182
[des] => ไข่ไก่ มัทนาฟาร์ม
[unit] => แผง
[retail_price] => 72
[wholesale_price] => 98
[sale_price] => 0
[qty] => 0
[featured] => 0
[retail] => 1
[image] => images/products/1629691656.png
[catagory_id] => 1
[branch_id] => 1
[created_at] => 2021-08-14 08:23:31
[updated_at] => 2021-08-23 04:17:01
[pivot_user_id] => 1
[pivot_product_id] => 1
[pivot_quantity] => 10
        */


        $user_id = auth()->user()->branch_id();
        $cash =floatval( $request->cash);
        $payid_by = $request->payid_by;
        $discount = 0.0;
        $net_amount = 0.0;
        $change = 0.0;
        $totol = 0.0;  // รวมราคาสินค้า
        $status = 'สำเร็จ';   // สถานะ
        $status_sale = '';   // การขาย
        $cart =  $request->user()->cart()->get();
        $price = 0.0;

        $detail = [];
        foreach ($cart as $key => $value) {
            // print_r($value['id']);
            if ($value['pivot']['quantity'] > 10) { //อย่าลืมทำตัวตั้งค่านะของแต่ละสาขา
                # code...
                $price =  $value['wholesale_price'];
                $totol =  $value['pivot']['quantity'] * $price;
                $status_sale = 'ขายส่ง';
            } else {
                $price =  $value['retail_price'];
                $totol =  $value['pivot']['quantity'] * $price;
                $status_sale = 'ขายปลีก';
                # code...
            }
            $net_amount += $totol;

            array_push($detail, [
                'product_id' => $value['id'],
                'order_id' => $value['id'],
                'name' => $value['name'],
                'price' => $price,
                'totol' => $totol,
                'qty' => $value['pivot']['quantity'],
            ]);

            // print_r($value);
        }
        $change = floatval($cash) - $net_amount ;
        // echo ($totol);
        // echo ("|");
        // echo ($cash);
        // echo ("|");
        // echo ($change);
        // echo ("|");
        // echo ($status);
        // echo ("|");
        // echo ($status_sale);
        // echo ("|");
        // echo ($customer);
        // echo ("|");
        // echo ($net_amount);

        $order = new Order;
        $order->cash_totol = $totol;  // รวมราคาสินค้า
        $order->cash = $cash;   //เงินสด
        $order->discount = $discount; // ส่วนลด
        $order->net_amount = $net_amount;   // ยอดสุุทธิ
        $order->change = $change;   // เงินทอน
        $order->status = $status;   // สถานะ
        $order->status_sale = $status_sale;   // การขาย
        $order->paid_by = $payid_by;   // ชำระโดย
        $order->user_id = $user_id;  // คนขาย
        if($request->customer != '0'){

            $customer = customer::where('phone',$request->customer)->first()->id;
            $order->customer_id = $customer;  // คนขาย
        }
        $order->branch_id = auth()->user()->branch_id();  // สาขา
        $order->save();  // คนขาย

        if ($order) {
            # code...
            // echo "Id $order->id";
            foreach ($detail as $key => $value) {
                $order_detail = new Order_details;
                $order_detail->product_id = $value['product_id'];
                $order_detail->order_id = $order->id;
                $order_detail->name = $value['name'];
                $order_detail->price = $value['price'];
                $order_detail->totol = $value['totol'];
                $order_detail->qty = $value['qty'];
                $order_detail->save();
                // echo $value['name'];
            }

            $Wallet = Wallet::where('branch_id',auth()->user()->branch_id());
            $Wallet->update([
                'balance' => $Wallet->first()->balance + floatval($cash)
            ]);
            $Wallet->first()->payment_add('NULL',$cash,$payid_by);
            if($change > 0){
                $Wallet->first()->payment_add('NULL',$change,'เงินทอน');
            }

            $request->user()->cart()->detach();
            return response([
       'success' => true,
       'change' =>$change,

       ]);
        } else {
             return response([
        'success' => false
        ]);
        }

        // return response([
        // 'success' => true
        // ]);
    }
}
