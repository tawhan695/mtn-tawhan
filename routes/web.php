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
// Route::get('download', function () {
//     return response()->download(public_path('apk/app-release.zip'));
// });
Route::get('download2', function () {
    return response()->download(public_path('apk/app-release.apk'));
});
// Route::get('download3', function () {
//     return response()->download(public_path('apk/testBlue.apk'));
// });
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('dowload', [App\Http\Controllers\HomeController::class, 'app']);

// // Auth::routes();

// Route::get('/test', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/sale/transection', App\Http\Controllers\TransectionController::class);
// Route::middleware(['seller'])->group(function () {

// });
Route::resource('sale', App\Http\Controllers\SaleController::class);
Route::resource('sale2', App\Http\Controllers\Sale2Controller::class);
Route::resource('return', App\Http\Controllers\ReturnProductController::class);
Route::resource('user', App\Http\Controllers\UserController::class);
Route::resource('user2', App\Http\Controllers\UserAppController::class);
Route::resource('defective', App\Http\Controllers\DefectiveController::class);

// test esc
Route::get('apk', [App\Http\Controllers\esc\EscController::class, 'index']);
Route::middleware(['manager', 'admin'])->group(function () {
    //admin
    Route::resource('admin/dashboard', App\Http\Controllers\admin\DashboardController::class);
    // Route::resource('admin',App\Http\Controllers\admin\DashboardController::class);
    Route::resource('admin/product', App\Http\Controllers\admin\ProductController::class);
    Route::resource('admin/catagory', App\Http\Controllers\admin\CatagoryController::class);
    Route::resource('admin/employee', App\Http\Controllers\admin\EmployeeController::class);
    Route::resource('admin/branchs', App\Http\Controllers\admin\BranchsController::class);
    Route::resource('admin/customer', App\Http\Controllers\admin\CustomerController::class);

    Route::get('admin/finance', [App\Http\Controllers\admin\FinanceController::class, 'index']);
    Route::get('admin/history', [App\Http\Controllers\admin\HistoryProductController::class, 'index']);

    Route::post('admin/finance/deposit', [App\Http\Controllers\admin\FinanceController::class, 'deposit']);
    Route::post('admin/finance/withdraw', [App\Http\Controllers\admin\FinanceController::class, 'withdraw']);

    //supdre admin
    Route::resource('superadmin', App\Http\Controllers\superadmin\DashboardController::class);
});
