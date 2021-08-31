<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $fillable = [
        'cash_totol',
         'discount',
         'change',
         'user_id',
        ];
    public function order_details() {
            return $this->hasMany('App\Models\Order_Details');
    }
}
