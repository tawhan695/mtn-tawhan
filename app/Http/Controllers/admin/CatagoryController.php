<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Catagory;
use App\Models\Product;

use Illuminate\Http\Request;

class CatagoryController extends Controller
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
        // echo auth()->user()->branch_id();
        return view('admin.catagory.index')->with(['catagory'=>Catagory::where('branch_id',auth()->user()->branch_id())->paginate(10)]);
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
        $Catagory = new Catagory;
        $Catagory->name = $request->catagory;
        $Catagory->slug = $request->catagory;
        $Catagory->branch_id = auth()->user()->branch_id();
        $Catagory->save();

        return redirect()->back()->with('success','บันทึกสำเร็จ');
        // print_r($request->catagory);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catagory  $catagory
     * @return \Illuminate\Http\Response
     */
    public function show(Catagory $catagory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catagory  $catagory
     * @return \Illuminate\Http\Response
     */
    public function edit(Catagory $catagory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catagory  $catagory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catagory $catagory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catagory  $catagory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catagory $catagory)
    {
       $catagory_id = Product::where('catagory_id',$catagory->id)->count();
    //    echo $catagory_id;
       if ($catagory_id > 0) {
           # code...
           return redirect()->back()->withErrors(['del'=>'มีสินค้าอยู่ในประเภทนี้ ไม่สามารถลบได้']);
        }else{

            $catagory->delete();
        }
        // return redirect()->back()->withErrors(['del'=>'ลบสำเร็จ']);
        return redirect()->back()->with('success','ลบสำเร็จ');
    }
}
