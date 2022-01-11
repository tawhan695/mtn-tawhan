<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\payment;
use Phattarachai\LineNotify\Line;
use App\Models\Linenotify;
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
        $Sum = $Wallet->first()->balance + $request->balance;
        $Wallet->update([
            'balance' =>$Sum
        ]);
        $Wallet->first()->payment_add('NULL',$request->balance,'ฝากเงิน');
            try{

                $linetoken =  Linenotify::where('branch_id',auth()->user()->branch_id())->first()->token;
                $line = new Line($linetoken);
                $line->send('ฝากเงินเข้าลิ้นชัก:'.$request->balance.' บาท , ยอดรวม:'.$Sum );
            }catch(\Exception $e){

            }


        return back();
    }
    public function withdraw( Request $request){ //ถอน

        $Wallet = Wallet::where('branch_id',auth()->user()->branch_id());
        $Sum = $Wallet->first()->balance - $request->balance;
        $Wallet->update([
            'balance' => $Sum,
        ]);
        $Wallet->first()->payment_add('NULL',intval($request->balance),'ถอนเงิน');
        try{

            $linetoken =  Linenotify::where('branch_id',auth()->user()->branch_id())->first()->token;
            $line = new Line($linetoken);
            $line->send('ถอนเงินออกลิ้นชัก:'.$request->balance.' บาท , ยอดรวม:'.$Sum );
        }catch(\Exception $e){

        }
        return back();
    }
}
