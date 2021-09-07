<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
    use HasFactory;

    protected $table = "catagories";

    public function product() {
        return $this->belongsTo('App\Models\Product');
    }
}
