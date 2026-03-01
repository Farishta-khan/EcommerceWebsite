<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order Details') }} - #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <!-- Order status overview -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Order Status: <span class="uppercase text-indigo-600 dark:text-indigo-400">{{ str_replace('_', ' ', $order->status) }}</span></h3>
                    <p class="text-sm text-gray-500 mt-1">Placed on {{ $order->created_at->format('M d, Y h:i A') }}</p>
                </div>
                
                @if($order->status === 'pending')
                    <form action="{{ route('orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                        @csrf
                        <button type="submit" class="bg-red-100 text-red-700 hover:bg-red-200 font-bold py-2 px-4 rounded transition">
                            Cancel Order
                        </button>
                    </form>
                @endif
            </div>

            <!-- Delivery Tracking -->
            @if($order->deliveryTracking)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">Delivery Tracking</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Current Status</p>
                        <p class="font-semibold text-gray-900 dark:text-white uppercase">{{ str_replace('_', ' ', $order->deliveryTracking->status) }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Last Updated</p>
                        <p class="text-gray-900 dark:text-white">{{ $order->deliveryTracking->updated_at->diffForHumans() }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-sm font-medium text-gray-500">Remarks</p>
                        <p class="text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-900 p-3 rounded mt-1">{{ $order->deliveryTracking->remarks ?? 'No remarks provided by the vendor yet.' }}</p>
                    </div>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Items list -->
                <div class="md:col-span-2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">Items inside Order</h3>
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            <div class="flex justify-between items-center bg-gray-50 dark:bg-gray-900 p-4 rounded border border-gray-100 dark:border-gray-700">
                                <div class="flex items-center">
                                    <div class="ml-4 flex flex-col">
                                        <a href="{{ route('product.show', $item->product->id) }}" class="text-indigo-600 hover:underline font-semibold">{{ $item->product->name }}</a>
                                        <span class="text-xs text-gray-500 mt-1">Sold by: {{ $item->product->shop->name }}</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $item->quantity }} x Rs. {{ number_format($item->price, 2) }}</p>
                                    <p class="font-bold text-gray-900 dark:text-white">Rs. {{ number_format($item->quantity * $item->price, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Shipping and Payment Overview -->
                <div class="space-y-6">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">Order Summary</h3>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600 dark:text-gray-400">Total Items</span>
                            <span class="text-gray-900 dark:text-gray-100 font-medium">{{ $order->items->sum('quantity') }}</span>
                        </div>
                        <div class="flex justify-between mb-2 border-t border-gray-200 dark:border-gray-700 pt-2 font-bold text-xl">
                            <span class="text-gray-900 dark:text-gray-100">Total</span>
                            <span class="text-indigo-600 dark:text-indigo-400">Rs. {{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">Shipping Information</h3>
                        <p class="text-gray-600 dark:text-gray-400 whitespace-pre-wrap">{{ $order->shipping_address }}</p>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">Payment Information</h3>
                        <p class="text-gray-600 dark:text-gray-400 uppercase font-medium">{{ str_replace('_', ' ', $order->payment_method) }}</p>
                        <p class="text-sm text-green-600 font-bold mt-1">Status: Paid</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
