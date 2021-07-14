<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Validator\ValidationException;

use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
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
                'status_error' => $validator->errors(),
                'status_code' => 401,

                ]);
        }else{
            $Username= $request->username;
            $Password= $request->password;
            $user = User::where('username','=',$Username)->first();
            if (! $user || ! Hash::check( $Password, $user->password)) {
                return response()->json([
                    'status_error' => 'ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง',
                    'status_code' => 401,
                    ]) 
                    ->header('Content-Type', 'application/json','charset=utf-8');
                   
            }else{
                if ($user->tokenCan('server:update')) {
                    $token = $user->tokenCan('server:update');
                }else{
                    $token =$user->createToken($request->device_name)->plainTextToken;

                }
                return response()->json([
                    'status_code' => 201,
                    'status_sucess' => $token,
                    ])
                    ->header('Content-Type', 'application/json','charset=utf-8');
            }
                
            
               
        }
    }
}
