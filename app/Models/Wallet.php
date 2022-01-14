<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\payment;
class Wallet extends Model
{
    use HasFactory;


    protected $table = "wallets";
    protected $fillable = [
        'balance',
         'branch_id',
        ];
    public function payment() {
            return $this->hasMany('App\Models\payment');
    }
    public function payment_add($order,$amount,$des) {
        if($amount >= 0) {

            $payment  = new payment;
            if ($des == "ฝากเงิน") {
                # code...
                $payment->amount = 0+$amount;
            }
            else if ($des == "ถอนเงิน"){

                $payment->amount = 0-$amount;
            }
            else if ($des == "คืนเงิน"){

                $payment->amount = 0-$amount;
            }
            else if ($des == "เงินสด"){

                $payment->amount = 0+$amount;
            }
            else if ($des == "พร้อมเพย์"){

                $payment->amount = 0+$amount;
            }
            else if ($des == "ธนาคาร"){

                $payment->amount = 0+$amount;
            }
            else if ($des == "เงินทอน"){

                $payment->amount = 0-$amount;
            }
            else {

                $payment->amount = 0-$amount;
            }
            $payment->des= $des;
            $payment->wallet_id = $this->id;
            if($order != 'NULL'){

                $payment->order_id = $order ;
            }
            $payment->user_id = auth()->user()->id;
            $payment->branch_id = auth()->user()->branch_id();
            $payment->save();

            // $this->update([
            //     'balance' => $this->balance - $amount
            // ]);
        }

    }
    public function update_payment($order_id,$amount){
        $this->payment()->where('order_id',$order_id)
        ->update([
            'amount' => $amount,
        ]);
    }
    public function del_payment($order_id){
        $payment_ =   $this->payment()->where('order_id',$order_id);
        $payment  = new payment;
        $payment->des= 'คืนเงิน';
        $payment->wallet_id = $this->id;
        $payment->order_id = $order_id ;
        $payment->amount = $payment_->first()->amount;
        $payment->user_id = auth()->user()->id;
        $payment->branch_id = auth()->user()->branch_id();
        $payment->save();



    }
}
