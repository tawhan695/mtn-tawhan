<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Validator;     
use Laravel\Sanctum\Sanctum;   
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
            'des' => 'required',
            'legular_price' => 'required',
            'catagory_id' => 'required',
            'branch_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status_code' => 401,
    
                ]);
        }else{
            if(auth()->user()->hasRole(['admin','seller'])){
               
                $product = new Product;
                $product->name = $request->name;
                $product->slug = $request->slug;
                $product->des = $request->des;
                $product->legular_price = $request->legular_price;
                $product->catagory_id = $request->catagory_id;
                $product->branch_id = $request->branch_id;
                $product->save();
                       
            }else{
                return response()->json([
                    'error' => 'สิทธิ์ไม่สามารถเข้าถึง',
                    'status_code' => 401,
                    ])
                    ->header('Content-Type', 'application/json','charset=utf-8'); 
            }
    
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
            'des' => 'required',
            'legular_price' => 'required',
            'catagory_id' => 'required',
            'branch_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status_code' => 401,
    
                ]);
        }else{
            if(auth()->user()->hasRole(['admin','seller'])){
               
                // $product = new Product;
                $product->name = $request->name;
                $product->slug = $request->slug;
                $product->des = $request->des;
                $product->legular_price = $request->legular_price;
                $product->catagory_id = $request->catagory_id;
                $product->branch_id = $request->branch_id;
                $product->save();
                       
            }else{
                return response()->json([
                    'error' => 'สิทธิ์ไม่สามารถเข้าถึง',
                    'status_code' => 401,
                    ])
                    ->header('Content-Type', 'application/json','charset=utf-8'); 
            }
    
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
