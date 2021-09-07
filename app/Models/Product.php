<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HistoryProduct;
// use App\Models\Product;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    public function history(){

        $this->belongsTo(HistoryProduct::class);
    }

    public function category(){

            return $this->hasMany('App\Models\Catagory');
  
    }

}
