<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order_Details;
use App\Models\Product;
use App\Models\Wallet;
use App\Models\Defective;
use App\Models\Order;

class DashboardController extends Controller
{
    public function wallet()
    {
        $dayDefective = Defective::where('branch_id', auth()->user()->branch_id())->where('created_at', 'like', '%' . date('Y-m-d') . '%')->count();
        $dayOrder = Order::where('branch_id', auth()->user()->branch_id())
        ->where('status','สำเร็จ')
        ->where('created_at', 'like', '%' . date('Y-m-d') . '%')->count();
        $sumOrder = Order::where('branch_id', auth()->user()->branch_id())
        ->where('status','สำเร็จ')
        ->where('created_at', 'like', '%' . date('Y-m-d') . '%')->sum('net_amount');
        $Product = Product::where('branch_id', auth()->user()->branch_id())->get(['id', 'name', 'unit', 'retail_price', 'wholesale_price']);
        return response([
            'wallet' => Wallet::where('branch_id', auth()->user()->branch_id())->first()->balance,
            'Defective' => $dayDefective,
            'Order' => $dayOrder,
            'ordersum' => $sumOrder,
            'product' => $Product,
        ]);
    }
    public function order_detail(Request $request)
    {
        $list_p = [];
        $i = 1;
        $Product = Product::all();
        foreach ($Product as $key) {
            $qty_1 = 0;
            $price_1 = 0;
            $qty_2 = 0;
            $price_2 = 0;

            $det = Order_Details::where('product_id', $key->id)
                ->where('created_at', 'like', '%' . date('Y-m-d') . '%')
                ->with(['order'])
                ->get();

            foreach ($det as $item2) {
                if ($item2->order->status_sale == 'ขายปลีก') {
                    $price_1 += $key->retail_price * $item2->qty;
                    $qty_1 += $item2->qty;
                } else {
                    $price_2 += $key->wholesale_price * $item2->qty;
                    $qty_2 += $item2->qty;
                }
            }
            if ( $qty_1 > 0 || $qty_2 > 0 ) {

                array_push($list_p,[
                    "num"=>$i,
                    "name"=>$key->name,
                    "qty_1"=>$qty_1,
                    "price_1"=>$price_1,
                    "qty_2"=>$qty_2,
                    "price_2"=>$price_2,
                    "sum_qty"=>$qty_1 + $qty_2,
                    "sum_price"=>$price_1 + $price_2,
                    "img"=>$key->image,
                ]);
                $i++;
            }

        }


        return response([
            'product' => $list_p,
            // 'det' =>$det,
            // 'qty_1' => $qty_1,
            // 'qty_2' => $qty_2,
            // 'price_1' => $price_1,
            // 'price_2' => $price_2,
        ]);
    }
}
