<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HistoryProduct;
use App\Models\Product;
class HistoryProductController extends Controller
{
    public function index()
    {
        $His = HistoryProduct::join('products', 'history_products.product_id', '=', 'products.id')
        ->join('users', 'history_products.user_id', '=', 'users.id')
        ->select('history_products.*','products.name as pname','products.image','products.unit','users.name')
        ->paginate(5);
        return view('admin.product.history')->with(['His'=>$His]);
    }

    public function store(Request $request){

        // $user = auth()->user()->id;
        // $product = Product::find($request->product_id);

        // $His =new HistoryProduct();

        // $His->qty = $request->qty;
        // $His->product_id = $product->id;
        // $His->user_id = $user->id;
        // $His->save();

        // if($His){
        //     return
        // }
    }
}
