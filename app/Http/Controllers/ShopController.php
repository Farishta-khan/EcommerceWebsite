<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true)->with(['shop', 'category']);

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('availability') && $request->availability == 'in_stock') {
            $query->where('stock', '>', 0);
        }

        $products = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('welcome', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        if (!$product->is_active) abort(404);
        return view('products.show', compact('product'));
    }

    public function store(\App\Models\Shop $shop, Request $request)
    {
        if (!$shop->is_active) abort(404);
        
        $query = $shop->products()->where('is_active', true)->with('category');
        
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        $products = $query->latest()->paginate(12);
        
        $categories = Category::whereHas('products', function($q) use ($shop) {
             $q->where('shop_id', $shop->id);
        })->get();

        return view('store.show', compact('shop', 'products', 'categories'));
    }
}
