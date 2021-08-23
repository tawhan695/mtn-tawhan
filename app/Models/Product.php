<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HistoryProduct;
class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    public function history(){

        $this->belongsTo(HistoryProduct::class);
    }

}
