<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use App\Models\Has_Branchs;
use App\Models\Branchs;
class AuthControllor extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                // 'status_code' => 401,

                ]);
        }else{
            $Username= $request->username;
            $Password= $request->password;
            $user = User::where('email','=',$Username)->first();
            $user_id = User::where('email','=',$Username)->first()->id;
            $branch_id = Has_Branchs::where('user_id',$user_id)->first()->branchs_id;
            if (! $user || ! Hash::check( $Password, $user->password)) {
                return response()->json([
                    'sucess' => false,
                    'error' => 'ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง',
                    // 'status_code' => 401,
                    ])
                    ->header('Content-Type', 'application/json','charset=utf-8');

            }else{
                if ($user->tokenCan('server:update')) {
                 $token = $user->tokenCan('server:update');
                }else{
                    $token =$user->createToken($request->device_name)->plainTextToken;

                }
                return response()->json([
                    'sucess' => true,
                    'user' => $user,
                    'token' => $token,
                    'branch' => Branchs::where('id',$branch_id)->first(),
                    ])
                    ->header('Content-Type', 'application/json','charset=utf-8');
            }
        }
    }
    public function logout( Request $request) {
        // $request()->user();
        return response()->json([
            // 'success' => true,
            'success'=> $request->user()->currentAccessToken()->delete(),
        ]);
    }
}
