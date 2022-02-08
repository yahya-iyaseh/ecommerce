<?php

namespace App\Http\Controllers;

use Exception;
// use App\Repositories\Cart\CartRepository;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Cart\CartRepository;

use function PHPUnit\Framework\throwException;

class CheckoutController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }
    public function index(CartRepository $cart)
    {
        $cart->all();
        $user = Auth::check() ? Auth::user() : new User();
        $total = $cart->total();
        return view('store.checkout', compact('cart', 'total', 'user'));
    }

    public function store(Request $request, CartRepository $cart)
    {
        // dd($request->shipping);
        $request->validate([
            'shipping.first_name' => ['required'],
            'shipping.last_name' => ['required'],
            'shipping.street' => ['required'],
            'shipping.city' => ['required'],
            'shipping.country_code' => ['required'],
        ]);
        DB::beginTransaction();
        try {
          $order =   Order::create([
                'user_id' => Auth::id(),
                'tax' => $request->post('tags', 0),
                'discount' => $request->post('discount', 0),
                'total' => $cart->total(),
                'status' => 'pending',
                'payment_status' => 'pending',
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
            // Add Order Address

            $shipping_address = $request->input('shipping');
            $shipping_address['type'] = 'shipping';
            $order->addresses()->create($shipping_address);

            $billing_address = $request->input('billing');
            if (!$billing_address) {
                $billing_address = $shipping_address;
            }
            $billing_address['type'] = 'billing';
            $order->addresses()->create($billing_address);

            // Add Order Items
            // dd($cart->all());
            foreach ($cart->all() as $item) {
                // dd($item->product->name);
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                ]);
            }
            DB::commit();
            // Create Order
            $cart->empty();
        } catch (Exception $e) {
            DB::rollBack();
             throw $e;
        }

    }
}
