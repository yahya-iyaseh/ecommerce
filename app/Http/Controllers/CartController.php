<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    // List of cart products (items)
    public function index()
    {
    }

    // Add product to cart
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity' => ['int', 'min:1'],
        ]);
        $cookie_id = app('cart.cookie_id');
        $item = Cart::where([
                'product_id'=>  $request->post('product_id'),
                  'cookie_id'=> $cookie_id])->first();
        if ($item) {
            $item->increment('quantity', $request->post('quantity'));
        } else {
            Cart::create([
                'id' => Str::uuid(),
                'cookie_id' => $cookie_id,
                'user_id' => \Auth::id(),
                'product_id' => $request->post('product_id'),
                'quantity' => $request->quantity,
            ]);
        }

        notify()->success('Add Product', 'Product  added successfully');
        return redirect()->back();
    }


}