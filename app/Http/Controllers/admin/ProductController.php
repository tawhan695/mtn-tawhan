<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Catagory;
use App\Models\HistoryProduct;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ProductController extends Controller
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

        return view('admin.product.index')->with(['product'=>Product::where('branch_id',auth()->user()->branch_id())->paginate(10),'catagory'=>Catagory::where('branch_id',auth()->user()->branch_id())->get(),'sku'=>$current_timestamp = Carbon::now()->timestamp]);
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
            'price' => 'required',
            'qty' => 'required',
            'unit' => 'required',
            'des' => 'required',
            'catagory' => 'required',
            // 'image' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with([
                'error' => $validator->errors(),
                'status_code' => 401,
                ]);
        }
        // print_r(Product::where('name',$request->name)->count());
        if(Product::where('name',$request->name)->count() > 0){
            return back()->withErrors(['name'=>'ชื่อนี้มีอยู่แล้ว']);
        }

        if(empty($request->image)){
            $imageName = 'default.png';
            $pathImage = 'default.png';
        }else{
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $pathImage =  $request->image->move(public_path('images/products/'), $imageName);
        }
        print_r($request->all());

        //Array ( [_token] => sUR44FvKgyfilaXODmQDFSL158hqLjoygZCLVfAD
        // [image] =>
        // [name] => 1627746078768
        // [price] => 80.00
        // [qty] => 20
        // [unit] => แผง
        // [des] => 5555555
        // [catagory] => 1


        $Product = new Product;
        $Product->name = $request->name;
        $Product->slug = Str::slug($request->name.$request->sku);
        $Product->image =  'images/products/'.$imageName;
        $Product->des = $request->des;
        $Product->sku = $request->sku;
        $Product->qty = $request->qty;
        $Product->retail_price = $request->price;
        $Product->wholesale_price = $request->price2;
        $Product->catagory_id = $request->catagory;
        $Product->branch_id = auth()->user()->branch_id();
        $Product->unit = $request->unit;
        $Product->save();

        return redirect()->back()->withErrors(['sucess'=>'บันทึกสำเร็จ']);
        // $image = $request->image
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
        // print_r($product);
        return view('admin.product.edit')->with(['product'=>$product,'catagory'=>Catagory::where('branch_id',auth()->user()->branch_id())->get()]);
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
        // update qty
        if($request->updateQTY){
            // print_r($request->updateQTY);
            Product::where('id',$product->id)->update([
                'qty'=> $product->qty + intval($request->updateQTY)
            ]);

            $user = auth()->user()->id;
        // $product = Product::find($request->product_id);

        $His =new HistoryProduct;
        $His->qty = $request->updateQTY;
        $His->product_id = $product->id;
        $His->user_id = auth()->user()->id;
        $His->save();
            return redirect()->back();
        }
        // update all
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'price2' => 'required',
            'qty' => 'required',
            'unit' => 'required',
            'des' => 'required',
            'catagory' => 'required',
            // 'image' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with([
                'error' => $validator->errors(),
                'status_code' => 401,
                ]);
        }
        // print_r(Product::where('name',$request->name)->count());\
        if($product->name != $request->name){

            if(Product::where('name',$request->name)->count() > 0){
                return back()->withErrors(['name'=>'ชื่อนี้มีอยู่แล้ว']);
            }
        }
        $Product =  $product;
        $Product->name = $request->name;
        // $Product->slug = Str::slug($request->name);
        if(!empty($request->image)){
            // $pathImage = 'default.png';
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $pathImage =  $request->image->move(public_path('images/products/'), $imageName);
            $Product->image =  'images/products/'.$imageName;
        }
        $Product->sku = $request->sku;
        $Product->des = $request->des;
        $Product->qty = $request->qty;
        $Product->retail_price = $request->price; //ราคาขายปลีก
        $Product->wholesale_price = $request->price2; //ราคาขายส่ง
        $Product->catagory_id = $request->catagory;
        // $Product->branch_id = auth()->user()->branch_id();
        $Product->unit = $request->unit;
        $Product->update();


        return redirect(route('product.index'))->withErrors(['sucess'=>'บันทึกสำเร็จ']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back();
    }
    // public function history()
    // {

    // }
}
