<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    public function createShop()
    {
        if (auth()->user()->hasRole('vendor') && auth()->user()->shop) {
            return redirect()->route('vendor.dashboard');
        }
        return view('vendor.apply');
    }

    public function storeShop(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:shops,name',
            'description' => 'nullable|string',
        ]);

        $user = auth()->user();

        Shop::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => true,
        ]);

        if (!$user->hasRole('vendor')) {
            $user->assignRole('vendor');
        }

        return redirect()->route('vendor.dashboard')->with('success', 'Shop created successfully! You are now a vendor.');
    }

    public function dashboard()
    {
        $shop = auth()->user()->shop;
        return view('vendor.dashboard', compact('shop'));
    }
}
