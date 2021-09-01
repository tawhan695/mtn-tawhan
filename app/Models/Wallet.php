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
            }else if ($des == "ถอนเงิน"){

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
      $payment =   $this->payment()->where('order_id',$order_id);
      if($payment->first()){
        $this->update([
            'balance' => $this->balance + $payment->first()->change
          ]);
        $payment->delete();
      }
    }
}
