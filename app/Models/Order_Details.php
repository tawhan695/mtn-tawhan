<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Details extends Model
{
    use HasFactory;
    protected $table = "order__details";
    protected $fillable = [
        'product_id',
         'order_id', 
         'qty',
         'user_id',
        ];
}
