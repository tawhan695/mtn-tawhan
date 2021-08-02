<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Has_Branchs;
class Branchs extends Model
{
    use HasFactory;

    protected $table = "branchs";

    protected $fillable = [
        'id',
        'name',
        'des',
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(App\Models\User::class);
    }
    // public function branch(){
    //     $this->belog(Has_Branchs::class);
    // }
}
