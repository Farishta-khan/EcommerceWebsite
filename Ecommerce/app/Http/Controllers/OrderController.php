<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\DeliveryTracking;

class OrderController extends Controller
{
    // Customer Methods
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) abort(403);
        $order->load(['items.product.shop', 'payment', 'deliveryTracking']);
        return view('orders.show', compact('order'));
    }

    public function cancel(Order $order)
    {
        if ($order->user_id !== auth()->id()) abort(403);
        
        if ($order->status === 'pending') {
            $order->update(['status' => 'cancelled']);
            if ($order->deliveryTracking) {
                $order->deliveryTracking->update(['status' => 'cancelled']);
            }
            // Optional: Restore product stock if needed
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->quantity);
            }
            return back()->with('success', 'Order cancelled successfully.');
        }
        return back()->with('error', 'Order cannot be cancelled at this stage.');
    }

    // Vendor Methods
    public function vendorIndex()
    {
        $shopId = auth()->user()->shop->id;
        
        // Get all orders that have items belonging to this vendor's shop
        $orders = Order::whereHas('items.product', function($query) use ($shopId) {
            $query->where('shop_id', $shopId);
        })->latest()->get();

        return view('vendor.orders.index', compact('orders', 'shopId'));
    }

    public function vendorShow(Order $order)
    {
        $shopId = auth()->user()->shop->id;
        
        // Ensure this order has items for this vendor
        $hasItems = $order->items()->whereHas('product', function($q) use ($shopId) {
            $q->where('shop_id', $shopId);
        })->exists();

        if (!$hasItems) abort(403);

        $order->load(['items.product', 'user', 'deliveryTracking']);
        
        return view('vendor.orders.show', compact('order', 'shopId'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,shipped,out_for_delivery,delivered',
            'remarks' => 'nullable|string'
        ]);

        $shopId = auth()->user()->shop->id;
        $hasItems = $order->items()->whereHas('product', function($q) use ($shopId) {
            $q->where('shop_id', $shopId);
        })->exists();

        if (!$hasItems) abort(403);

        // Update overall order status based on vendor (simplified for this demo)
        $order->update(['status' => $request->status]);
        
        if ($order->deliveryTracking) {
            $order->deliveryTracking->update([
                'status' => $request->status,
                'remarks' => $request->remarks,
            ]);
        } else {
            DeliveryTracking::create([
                'order_id' => $order->id,
                'status' => $request->status,
                'remarks' => $request->remarks,
            ]);
        }

        return back()->with('success', 'Order status updated successfully.');
    }
}
