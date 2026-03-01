<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($items->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500 text-lg mb-4">Your cart is empty.</p>
                            <a href="{{ route('home') }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">Start Shopping</a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-900 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-900 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-900 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-900 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                        <th class="px-6 py-3 bg-gray-50 dark:bg-gray-900 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @php $cartTotal = 0; @endphp
                                    @foreach($items as $item)
                                        @php $itemTotal = $item->product->price * $item->quantity; $cartTotal += $itemTotal; @endphp
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-12 w-12 rounded overflow-hidden bg-gray-100">
                                                        <img src="{{ $item->product->image_url ?? 'https://placehold.co/100x100?text=Image' }}" alt="{{ $item->product->name }}" class="h-12 w-12 object-cover">
                                                    </div>
                                                    <div class="ml-4">
                                                        <a href="{{ route('product.show', $item->product->id) }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">{{ $item->product->name }}</a>
                                                        <div class="text-sm text-gray-500">Sold by: <a href="{{ route('store.show', $item->product->shop->id) }}" class="hover:underline hover:text-indigo-600 dark:hover:text-indigo-400">{{ $item->product->shop->name }}</a></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                Rs. {{ number_format($item->product->price, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {{ $item->quantity }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                                Rs. {{ number_format($itemTotal, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex">
                                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-sm w-full md:w-1/3">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-600 pb-2 mb-4">Order Summary</h3>
                                <div class="flex justify-between mb-4">
                                    <span class="text-gray-600 dark:text-gray-400">Total</span>
                                    <span class="font-bold text-xl text-gray-900 dark:text-gray-100">Rs. {{ number_format($cartTotal, 2) }}</span>
                                </div>
                                <a href="{{ route('checkout.index') }}" class="w-full block text-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded transition duration-150">
                                    Proceed to Checkout
                                </a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
