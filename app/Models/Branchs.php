<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
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
        return $this->belongsTo(User::class);
    }
}
