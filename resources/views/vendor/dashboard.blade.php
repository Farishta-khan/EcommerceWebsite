<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vendor Dashboard') }} - {{ $shop->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-4">Welcome to your shop, {{ $shop->name }}!</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <!-- Stats Card 1 -->
                        <div class="bg-indigo-50 dark:bg-gray-700 rounded-lg p-6 shadow">
                            <h4 class="text-lg font-semibold text-indigo-700 dark:text-indigo-300">Total Products</h4>
                            <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">{{ $shop->products()->count() ?? 0 }}</p>
                        </div>
                        <!-- Stats Card 2 -->
                        <div class="bg-green-50 dark:bg-gray-700 rounded-lg p-6 shadow">
                            <h4 class="text-lg font-semibold text-green-700 dark:text-green-300">Total Orders</h4>
                            <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">0</p>
                        </div>
                        <!-- Stats Card 3 -->
                        <div class="bg-yellow-50 dark:bg-gray-700 rounded-lg p-6 shadow">
                            <h4 class="text-lg font-semibold text-yellow-700 dark:text-yellow-300">Revenue</h4>
                            <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">$0.00</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="text-xl font-semibold mb-4">Quick Links</h4>
                        <div class="flex space-x-4">
                            <a href="{{ route('vendor.products.index') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Manage Products</a>
                            <a href="{{ route('vendor.orders.index') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">View Orders</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
