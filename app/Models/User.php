<?php

namespace App\Models;


use App\Models\Cart;
use App\Models\Product;
use App\Models\Profile;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(){
        return $this->hasOne(Profile::class)->withDefault();
    }
    public function  cart()
    {
        return $this->hasMany(Cart::class, 'user_id', 'id');
    }
    public function cartProducts(){
        return $this->belongsToMany(Product::class,'carts', 'user_id', 'product_id', 'id', 'id');
    }
    public function receivesBroadcastNotificationsOn(){
        return 'Notifications.' . $this->id;
    }
}
