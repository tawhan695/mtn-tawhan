<?php

namespace App\Http\Controllers\Api;
use App\Models\Has_Branchs;
use App\Models\Branchs;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Validator;

class BranchsController extends Controller
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
            'user_id' => 'required',
            'branch_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status_code' => 401,

                ]);
        }else{

            if(auth()->user()->hasRole('admin')){
                
              $add_branch = new  Has_Branchs;
              $add_branch->timestamps   = false;
              $add_branch->user_id = $request->user_id;
              $add_branch->branchs_id = $request->branch_id;
              $add_branch->save();
            return response()->json([
                'sucess' => 'sucess',
                'data' => $request->all(),
                'branch' =>$add_branch,
                'status_code' => 201,
                ])
                ->header('Content-Type', 'application/json','charset=utf-8');
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
        $validator = Validator::make($request->all(), [
            // 'user_id' => 'required',
            'branch_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status_code' => 401,

                ]);
        }else{
            if(auth()->user()->hasRole('admin')){
                if(Branchs::find($request->branch_id) && Has_Branchs::where('user_id',$id)->first() ){
                    $edit = Has_Branchs::where('user_id',$id)->first(); 
                    $branchs = Branchs::find($request->branch_id)->id;
                    $up = Has_Branchs::where('user_id','=',$edit->id)->update(['branchs_id'=>$branchs]);
                    // $up->branchs_id = $branchs;
                    // $up->save();
                    // $edit->branchs_id = $branchs;
                    // $edit->update();
                    return response()->json([
                      'sucess' => 'อัพเดท เรียบร้อย',
                      'data' =>Branchs::find($request->branch_id),
                    //   'edit' => $up ,
                    //   'id' => $branchs,
                    //   'id2' => $request->branch_id,
                      'status_code' => 201,
                      ])
                      ->header('Content-Type', 'application/json','charset=utf-8');
                } else{
                    return response()->json([
                    'error' => 'ไม่พบข้อมูล',
                    'status_code' => 401,
                    ])
                    ->header('Content-Type', 'application/json','charset=utf-8');
                }
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
