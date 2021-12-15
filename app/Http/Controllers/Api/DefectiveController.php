<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Defective;
use Illuminate\Support\Facades\Validator;
class DefectiveController extends Controller
{
    public function index (){
        // รายการสินค้าชำรุด
        $Defective = Defective::where('branch_id', auth()->user()->branch_id())->orderBy('created_at', 'desc')->paginate(10);
        return response(['defective' => $Defective]);
    }
    public function store(Request $request){
        // เพิ่มสินค้าชำรุด
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'defective' => 'required',
            'status' => 'required',
        ]);

        if($request->defective == '0' || $request->defective == 0 ){
            return response()->json(['error'=>'กรุณาใส่ตัวเลขมากกว่า 0']);
        }
        if ($validator->fails()) {
            return response()->json(['error'=>$validator]);
        }
         $QTY = Product::where('id', $request->id)->first()->qty;
         if($QTY == 0 || $QTY == '0'){
            return response()->json(['error'=>'สินค้าในคลังหมด ไม่สามารถบันทึกการชำรุดได้']);
         }
         $count = intval($QTY) - intval($request->defective);
         if($count < 0){
            return response()->json(['error'=>'สินค้าในคลังหมด ไม่สามารถบันทึกการชำรุดได้']);
         }
         Product::where('id', $request->id)->update(['qty'=> $count ]);

        $Defective = new Defective;
        $Defective->product_id = $request->id;
        $Defective->qty = $request->defective;
        $Defective->status = $request->status;
        $Defective->branch_id = auth()->user()->branch_id();
        $Defective->save();
        return  response()->json(['success'=>'บันทึกเรียบร้อย']);
    }
}
