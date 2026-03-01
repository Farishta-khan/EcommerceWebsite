<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private function getCart()
    {
        if (auth()->check()) {
            return Cart::firstOrCreate(['user_id' => auth()->id()]);
        }
        return Cart::firstOrCreate(['session_id' => Session::getId()]);
    }

    public function index()
    {
        $cart = $this->getCart();
        $items = $cart->items()->with('product.shop')->get();
        return view('cart.index', compact('items'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        
        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Not enough stock available.');
        }

        $cart = $this->getCart();
        
        $cartItem = $cart->items()->where('product_id', $product->id)->first();
        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function remove($itemId)
    {
        $cart = $this->getCart();
        $cart->items()->where('id', $itemId)->delete();
        return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
    }
}
