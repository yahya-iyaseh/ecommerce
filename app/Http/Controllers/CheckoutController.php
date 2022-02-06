<?php

namespace App\Http\Controllers;

use App\Repositories\Cart\CartRepository;
// use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(CartRepository $cart){
        $cart->all();
        $total = $cart->total();
        return view('store.checkout', compact('cart', 'total'));
    }

    public function store(Request $request, CartRepository $cart){

    }
}
