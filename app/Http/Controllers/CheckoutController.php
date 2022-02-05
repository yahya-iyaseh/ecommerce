<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(CartRepository $cart){
        return view('store.checkout');
    }

    public function store(){

    }
}
