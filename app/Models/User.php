<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use \Laravel\Sanctum\HasApiTokens;
use App\Models\Proflie;
use App\Models\Branchs;
use App\Models\Has_Branchs;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    // use HasFactory, Notifiable,HasApiTokens ;
    use HasFactory, Notifiable,HasApiTokens,HasRoles ;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'usernmae',
        'email',
        'image',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',

    ];
    // public $timestamps = true;
    // public function profile(){
    //     return $this->belongsTo(Proflie::class,'id','user_id');
    // }
    public function Branch(){
        // echo $this->profile()->first();
        return Branchs::where('id',Has_Branchs::where('user_id',auth()->user()->id)->first()->branchs_id)->first();
    }
    public function branch_id(){
       return Has_Branchs::where('user_id',auth()->user()->id)->first()->branchs_id;
    }
    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class);
    // }
    public function cart()
    {
        return $this->belongsToMany(Product::class, 'user_cart')->withPivot('quantity');
    }
}
