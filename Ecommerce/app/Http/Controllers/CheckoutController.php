<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\DeliveryTracking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', auth()->id())->orWhere('session_id', Session::getId())->first();
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('home')->with('error', 'Your cart is empty.');
        }

        $items = $cart->items()->with('product')->get();
        $total = $items->sum(function($item) { return $item->product->price * $item->quantity; });

        return view('checkout.index', compact('items', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $cart = Cart::where('user_id', auth()->id())->orWhere('session_id', Session::getId())->first();
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('home')->with('error', 'Your cart is empty.');
        }

        $items = $cart->items()->with('product')->get();
        $total = $items->sum(function($item) { return $item->product->price * $item->quantity; });

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $total,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'shipping_address' => $request->shipping_address,
            ]);

            foreach ($items as $item) {
                if ($item->product->stock < $item->quantity) {
                    throw new \Exception("Product {$item->product->name} does not have enough stock.");
                }
                
                $item->product->decrement('stock', $item->quantity);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            Payment::create([
                'order_id' => $order->id,
                'amount' => $total,
                'status' => 'paid',
                'provider' => 'stub',
                'transaction_id' => uniqid('txn_'),
            ]);

            DeliveryTracking::create([
                'order_id' => $order->id,
                'status' => 'pending',
            ]);

            $cart->items()->delete();
            $cart->delete();

            DB::commit();

            return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
