<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
// use App\Models\Profile;
use App\Http\UserController;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\BranchsController;
use App\Http\Controllers\Api\WalletController;
use App\Http\Controllers\Api\ProductController;

// use App\Http\Controllers\;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login',[LoginController::class,'login']);
Route::get('login',function(){
    abort(401);
});

Route::group(['middleware' => 'auth:sanctum'],function (){
    // test  
    Route::get('test',function(){
        return response()->json([
            'status_code' => User::all(),
            ]);
    });

    // user upload image
    Route::resource('role',RoleController::class);
    Route::resource('branch',BranchsController::class);
    Route::resource('wallet',WalletController::class);
    Route::resource('product',ProductController::class);

});