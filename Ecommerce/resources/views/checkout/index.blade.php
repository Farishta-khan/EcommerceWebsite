<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col md:flex-row gap-6">
            
            <div class="w-full md:w-2/3">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold mb-6">Shipping & Payment Details</h3>
                    
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-6">
                            <x-input-label for="shipping_address" value="Shipping Address" class="text-lg" />
                            <textarea id="shipping_address" name="shipping_address" rows="3" class="mt-2 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm" required placeholder="Enter your full shipping address...">{{ old('shipping_address') }}</textarea>
                            <x-input-error :messages="$errors->get('shipping_address')" class="mt-2" />
                        </div>

                        <div class="mb-6 border-t border-gray-200 dark:border-gray-700 pt-6">
                            <x-input-label value="Payment Method" class="text-lg mb-4" />
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <input id="payment_credit" name="payment_method" type="radio" value="credit_card" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300" checked>
                                    <label for="payment_credit" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Credit Card (Stripe Stub)
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input id="payment_paypal" name="payment_method" type="radio" value="paypal" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                    <label for="payment_paypal" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        PayPal
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input id="payment_cod" name="payment_method" type="radio" value="cash_on_delivery" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                    <label for="payment_cod" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Cash on Delivery
                                    </label>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
                        </div>

                        <div class="mt-8">
                            <x-primary-button class="w-full justify-center py-4 text-lg">
                                {{ __('Place Order') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="w-full md:w-1/3">
                <div class="bg-gray-50 dark:bg-gray-700 shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 border-b border-gray-200 dark:border-gray-600 pb-2">Order Summary</h3>
                    
                    <div class="space-y-4 mb-4 max-h-60 overflow-y-auto pr-2">
                        @foreach($items as $item)
                        <div class="flex justify-between text-sm">
                            <div class="text-gray-600 dark:text-gray-300 flex-1 truncate pr-2">
                                <span class="font-bold border-r border-gray-300 dark:border-gray-500 pr-2 mr-2">{{ $item->quantity }}x</span>{{ $item->product->name }}
                            </div>
                            <div class="font-medium text-gray-900 dark:text-gray-100">Rs. {{ number_format($item->product->price * $item->quantity, 2) }}</div>
                        </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-600 pt-4 flex justify-between font-bold text-lg text-gray-900 dark:text-gray-100">
                        <span>Total</span>
                        <span>Rs. {{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
