<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Validator;     
use Laravel\Sanctum\Sanctum;      

class WalletController extends Controller
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

    // //    $wallet_id = Wallet::find($request->branch_id);
    //    if(Wallet::find($request->branch_id)){
    //     $wallet_ = Wallet::find($request->branch_id);
    //     $wallet_->balance =  bcadd($wallet_->balance, $request->balance, 2);
    //     // doubleval($wallet_->balance,2) + doubleval($wallet_->balance,2);
    //     $wallet_->save();
    //    }
    // //    $Wallet =new  Wallet;
    // //    $Wallet->balance = $request->balance;
    // //    $Wallet->branch_id = $request->branch_id;
    // //    $Wallet->save();
    // //    if($Wallet){
        // return response()->json([
        //             'data' =>  Wallet::all(),
        //             // 'data2' =>  $Wallet,
        //             'status_code' => auth()->user()->hasRole('admin'),
        
        //             ]);
    //    }
       $validator = Validator::make($request->all(), [
        'balance' => 'required',
        'branch_id' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'error' => $validator->errors(),
            'status_code' => 401,

            ]);
    }else{
        if(auth()->user()->hasRole(['admin','seller'])){
            if(Wallet::where('branch_id',$request->branch_id)){
                    $wallet_ = Wallet::where('branch_id',$request->branch_id)->first();
                    $wallet_->balance =  bcadd($wallet_->balance, $request->balance, 2);
                    // doubleval($wallet_->balance,2) + doubleval($wallet_->balance,2);
                    $wallet_->save();
                    return response()->json([
                        'data' =>  $wallet_->balance ,
                        ]);
                }else{

                       $wallet =new  Wallet;
                       $wallet->balance = $request->balance;
                       $wallet->branch_id =  $request->branch_id;
                       $wallet->save();
                       return response()->json([
                        'data' =>  $wallet->balance ,
                        'data2' =>  $request->all() ,
                        ]);
                }
                //    if($Wallet){
                   
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Wallet::find($id)){
            $wallet_ = Wallet::find($id);
            $wallet_->balance =  bcsub($wallet_->balance, $request->balance, 2);
            // doubleval($wallet_->balance,2) + doubleval($wallet_->balance,2);
            $wallet_->update();
            return response()->json([
                'data' =>  Wallet::all(),
                'data2' =>  $request->all(),
                'status_code' => 201,
    
                ]);
           }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
