<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\payment;
class FinanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Wallet =  payment::where('branch_id',auth()->user()->branch_id())->orderBy('created_at', 'desc')->paginate(10);
        // var_dump($Wallet);
        return view('admin.finance.index')->with(['payment' => $Wallet]);
    }

    public function deposit( Request $request){ // ฝาก

        $Wallet = Wallet::where('branch_id',auth()->user()->branch_id());
        $Wallet->update([
            'balance' => $Wallet->first()->balance + $request->balance
        ]);
        $Wallet->first()->payment_add('NULL',$request->balance,'ฝากเงิน');
        return back();
    }
    public function withdraw( Request $request){ //ถอน

        $Wallet = Wallet::where('branch_id',auth()->user()->branch_id());
        $Wallet->update([
            'balance' => $Wallet->first()->balance - $request->balance,
        ]);
        $Wallet->first()->payment_add('NULL',intval($request->balance),'ถอนเงิน');
        return back();
    }
}
