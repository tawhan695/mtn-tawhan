<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $Product = Product::all();
        $user = User::where('id',1)->first()->Branch()->get();
        // dd($user);
        if (auth()->user()->hasRole('super_admin')){

            return redirect(route('superadmin.index'));
        }else if (auth()->user()->hasRole('admin')){
            return redirect(route('dashboard.index'));
        }else{
            return "<h1>ไม่มีสิทธิ์เข้าถึง</h1>";
        }
    }
}
