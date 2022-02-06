<?php

namespace App\View\Components;


use Illuminate\View\Component;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Repositories\Cart\CartRepository;

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
        $cart = App::make(CartRepository::class);
        $this->cart = $cart->all();
        $this->total = $cart->total();
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
