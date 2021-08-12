<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/',HomeController,'index');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

// // Auth::routes();

// Route::get('/test', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/sale/transection',App\Http\Controllers\TransectionController::class);
// Route::middleware(['seller'])->group(function () {

// });
Route::resource('sale',App\Http\Controllers\SaleController::class);
Route::resource('sale2',App\Http\Controllers\Sale2Controller::class);
Route::resource('return',App\Http\Controllers\ReturnProductController::class);
Route::resource('user',App\Http\Controllers\UserController::class);
Route::resource('user2',App\Http\Controllers\UserAppController::class);
Route::resource('defective',App\Http\Controllers\DefectiveController::class);
// Route::middleware(['seller'])->group(function () {

// });


//admin
Route::resource('admin/dashboard',App\Http\Controllers\admin\DashboardController::class);
// Route::resource('admin',App\Http\Controllers\admin\DashboardController::class);
Route::resource('admin/product',App\Http\Controllers\admin\ProductController::class);
Route::resource('admin/catagory',App\Http\Controllers\admin\CatagoryController::class);
Route::resource('admin/employee',App\Http\Controllers\admin\EmployeeController::class);
Route::resource('admin/branchs',App\Http\Controllers\admin\BranchsController::class);
