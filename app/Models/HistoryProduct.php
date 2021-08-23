<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class HistoryProduct extends Model
{
    use HasFactory;

    public function product(){

        $this->hasOne(Product::class);
    }
}
