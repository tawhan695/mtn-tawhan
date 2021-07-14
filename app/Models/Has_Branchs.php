<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branchs;
class Has_Branchs extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'branchs_id',
    ];
    public function branch(){
        // $this->belog(Branchs::class);
    }
}
