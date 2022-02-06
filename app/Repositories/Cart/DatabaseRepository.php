<?php

namespace App\Repositories\Cart;


use App\Models\Cart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class DatabaseRepository implements CartRepository
{
    protected $items;
    protected $cookie_id;
    public function __construct($cookie_id)
    {
        $this->cookie_id = $cookie_id;
    }

    public function all()
    {
        if($this->items === null){
        $this->items = Cart::with('product')->where('cookie_id', app()->make('cart.cookie_id'))
            ->orWhere('user_id', '=', Auth::id())
            ->get();
        }
        return $this->items;
    }

    public function add($item, $quantity = 1)
    {
        $item = Cart::where('product_id', $item->post('product_id')
            ->orWhere('cookie_id',  $this->cookie_id))
            ->first();
        if ($item) {
            $item->increment('quantity', $quantity);
        } else {
            Cart::create([
                'id' => Str::uuid(),
                'cookie_id' =>  $this->cookie_id,
                'user_id' => \Auth::id(),
                'product_id' => $item->id,
                'quantity' => quantity,
            ]);
        }
    }

    public function remove($id)
    {
        Cart::where([
            'id' => $id,
            'cookie_id' =>  $this->cookie_id
        ])->delete();
    }

    public function empty()
    {
        Cart::where([
            'cookie_id' => $this->cookie_id
        ])->delte();
    }

    public function total()
    {

      return $this->items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

    }

    public function setCartUserId($id)
    {
         Cart::where('cookie_id', '=', $this->cookie_id)->update(['user_id' => $id]);

    }
}
