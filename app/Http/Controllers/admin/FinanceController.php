<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;
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
        $Wallet =  Wallet::where('branch_id',auth()->user()->branch_id())->with(['payment'])->get();
        return view('admin.finance.index')->with(['payment' => $Wallet[0]->payment]);
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
            'balance' => $Wallet->first()->balance - $request->balance
        ]);
        $Wallet->first()->payment_add('NULL',intval($request->balance),'ถอนเงิน');
        return back();
    }
}
