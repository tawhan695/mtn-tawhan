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
use App\Http\Controllers\Api\AuthControllor;
use App\Http\Controllers\Api\ApiProduct;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController;

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
Route::post('login',[AuthControllor::class,'login']);

Route::get('login',function(){
    abort(401);
});
// Route::middleware(['auth:api','request.log'])->get('/logout', function (Request $request) {
//     $request->user()->token()->revoke();
// });

// Route::post('product',[ApiProduct::class,'product']);
Route::group(['middleware' => 'auth:sanctum'],function (){
    Route::post('logout',[AuthControllor::class,'logout']);
    Route::post('product',[ApiProduct::class,'product']);
    Route::post('catagory',[ApiProduct::class,'catagory']);

    // chart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::post('/sale', [CartController::class, 'sale'])->name('cart.sale');
    Route::post('/cart/change-qty', [CartController::class, 'changeQty']);
    Route::delete('/cart/delete', [CartController::class, 'delete']);
    Route::delete('/cart/empty', [CartController::class, 'empty']);
    Route::resource('customer',App\Http\Controllers\Api\CustomerController::class);

    // // test
    // Route::get('test',function(){
    //     return response()->json([
    //         'status_code' => User::all(),
    //         ]);
    // });

    // // user upload image
    // Route::resource('role',RoleController::class);
    // Route::resource('branch',BranchsController::class);
    // Route::resource('wallet',WalletController::class);
    // Route::resource('product',ProductController::class);

});
