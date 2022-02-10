<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'number', 'user_id', 'status', 'payment_status', 'discount', 'tax', 'total', 'payment_method', 'payment_transaction_id', 'payment_data', 'ip', 'user_agent'
    ];
    protected static function booted()
    {
        static::creating(function (Order $order) {
            // yearNumber##### => 20220001, 20220002
            $now =  Carbon::now();
            $number =  Order::whereYear('created_at', $now->year)->max('number');
            if(!$number){
               $number = $now->year . '00001';
            }else{
                $number++;
            }

            $order->number = $number;
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function addresses()
    {
        return $this->hasMany(OrderAddress::class, 'order_id');
    }
    public function items()
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id');
    }
}
