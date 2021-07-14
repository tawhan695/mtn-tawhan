<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Defective extends Model
{
    use HasFactory;
    protected $table = "defectives";
    protected $fillable = [
        'id',
         'qty', 
         'product_id',
         'status',
        ];
    
}
