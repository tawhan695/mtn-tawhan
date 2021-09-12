<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Catagory;
class ApiProduct extends Controller
{
    public function product(Request $request){

        if ($request->sale == "1") {
            $sale = "wholesale_price";
        }else{
            $sale = "retail_price";

        }
        if ($request->catagory) {
            # code...
            $product = Product::where('branch_id',auth()->user()->branch_id())
            ->where('catagory_id',$request->catagory)
            ->get();
        } else {
            # code...
            $product = Product::where('branch_id',auth()->user()->branch_id())->get();
        }


        return response()->json($product);
    }

    public function catagory(Request $request){
        $category = Catagory::where('branch_id',auth()->user()->branch_id())->get();
        return response()->json($category);
    }


}
