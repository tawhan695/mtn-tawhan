<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Defective;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DefectiveController extends Controller
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
        $product = Product::where('qty','>', '0')->get();
        $Defective = Defective::orderBy('created_at', 'desc')->paginate(10);
        return view('sales.defective')->with(['product'=>$product,'defec'=>$Defective]);
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
            'id' => 'required',
            'defective' => 'required',
            'status' => 'required',
        ]);
    
        if($request->id == 'null'){
            return redirect('defective')->withErrors(['id'=>'กรุณาเลือกสินค้า']);
        }
        if($request->defective == '0' || $request->defective == 0 ){
            return redirect('defective')->withErrors(['defective'=>'กรุณาใส่ตัวเลขมากกว่า 0 ']);
        }
        if ($validator->fails()) {
            return redirect('defective')
                        ->withErrors($validator)
                        ->withInput();
        }
         $QTY = Product::where('id', $request->id)->first()->qty;
         if($QTY == 0 || $QTY == '0'){
            return redirect('defective')->withErrors(['errorqty'=>'สินค้าในคลังหมด ไม่สามารถบันทึกการชำรุดได้']);
         }
         $count = intval($QTY) - intval($request->defective);
         if($count < 0){
            return redirect('defective')->withErrors(['errorqty'=>'สินค้าในคลังหมด ไม่สามารถบันทึกการชำรุดได้']);
         }
         Product::where('id', $request->id)->update(['qty'=> $count ]);

        $Defective = new Defective;
        $Defective->product_id = $request->id;
        $Defective->qty = $request->defective;
        $Defective->status = $request->status;
        $Defective->save();
        return redirect('defective')->withErrors(['saved'=>'บันทึกเรียบร้อย']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Defective  $defective
     * @return \Illuminate\Http\Response
     */
    public function show(Defective $defective)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Defective  $defective
     * @return \Illuminate\Http\Response
     */
    public function edit(Defective $defective)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Defective  $defective
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Defective $defective)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Defective  $defective
     * @return \Illuminate\Http\Response
     */
    public function destroy(Defective $defective)
    {
        //
    }
}
