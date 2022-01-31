<?php

namespace App\View\Components;

use App\Models\Cart;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartMenu extends Component
{
    public $cart;
    public $total = 0;
    public $quantity = 0;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->cart = Cart::with('product')->where('cookie_id', app()->make('cart.cookie_id'))
        ->orWhere('user_id', '=', Auth::id())
        ->get();

        $this->total = $this->cart->sum(function($item){
            return  $item->quantity * $item->product->price;
        });
        $this->quantity = $this->cart->sum('quantity');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart-menu');
    }

}
