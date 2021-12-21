<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderCustomerController extends Controller
{
    public function order(Request $request){
        return response(['order'=> Order::where('customer_id',$request->customer_id)->get()]);
    }
}
