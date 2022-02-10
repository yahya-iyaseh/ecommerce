<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Order;
use App\Events\OrderCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Cart\CartRepository;
use function PHPUnit\Framework\throwException;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index(CartRepository $cart)
    {

        if ($cart->all()->count() > 0) {
            $user = Auth::check() ? Auth::user() : new User();
            $total = $cart->total();
            return view('store.checkout', compact('cart', 'total', 'user'));
        }

        notify()->warning('Add Some Products before', 'There are no Product In your Cart');
        return redirect()->route('products');
    }

    public function store(Request $request, CartRepository $cart)
    {

        $request->validate([
            'shipping.first_name' => ['required'],
            'shipping.last_name' => ['required'],
            'shipping.street' => ['required'],
            'shipping.city' => ['required'],
            'shipping.country_code' => ['required'],
        ]);
        DB::beginTransaction();
        try {
            $order = $this->storeOrder($request, $cart);
            // Add Order Address
            $this->storeOrderAddress($request, $order);
            // Add Order Items
            $this->storeItems($cart->all(), $order);
            DB::commit();
            // Create Order
            $cart->empty();

            event(new OrderCreated($order));

            notify()->success('Order Submit', 'Order Was Send');
            return redirect()->route('products');
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    protected function storeOrder(Request $request, CartRepository $cart)
    {
        return
            Order::create([
                'user_id' => Auth::id(),
                'tax' => $request->post('tags', 0),
                'discount' => $request->post('discount', 0),
                'total' => $cart->total(),
                'status' => 'pending',
                'payment_status' => 'pending',
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
    }
    protected function storeOrderAddress(Request $request, $order)
    {
        $shipping_address = $request->input('shipping');
        $shipping_address['type'] = 'shipping';
        $order->addresses()->create($shipping_address);

        $billing_address = $request->input('billing');
        if (!$billing_address) {
            $billing_address = $shipping_address;
        }
        $billing_address['type'] = 'billing';
        $order->addresses()->create($billing_address);
    }
    protected function storeItems($items, $order)
    {
        foreach ($items as $item) {
            // dd($item->product->name);
            $order->items()->create([
                'product_id' => $item->product_id,
                'product_name' => $item->product->name,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
            ]);
        }
    }
}
