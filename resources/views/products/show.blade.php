<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-indigo-600">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('home', ['category' => $product->category->slug]) }}" class="hover:text-indigo-600">{{ $product->category->name }}</a>
            <span class="mx-2">/</span>
            <span class="text-gray-700 dark:text-gray-300 font-medium">{{ $product->name }}</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden flex flex-col md:flex-row">
                
                <!-- Product Image -->
                <div class="w-full md:w-1/2 bg-gray-100 dark:bg-gray-700 flex items-center justify-center overflow-hidden min-h-[400px]">
                    <img src="{{ $product->image_url ?? 'https://placehold.co/600x600?text=No+Image' }}" alt="{{ $product->name }}" class="object-cover w-full h-full max-h-[600px]">
                </div>

                <!-- Product Details -->
                <div class="w-full md:w-1/2 p-8 flex flex-col">
                    <div class="mb-2">
                        <span class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wide">{{ $product->category->name }}</span>
                    </div>
                    <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl mb-4">{{ $product->name }}</h1>
                    
                    <div class="flex items-center justify-between mb-6">
                        <span class="text-3xl font-bold text-gray-900 dark:text-gray-100">Rs. {{ number_format($product->price, 2) }}</span>
                        <div class="flex items-center">
                            @if($product->stock > 0)
                                <span class="bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full font-semibold">In Stock ({{ $product->stock }})</span>
                            @else
                                <span class="bg-red-100 text-red-800 text-xs px-3 py-1 rounded-full font-semibold">Out of Stock</span>
                            @endif
                        </div>
                    </div>

                    <div class="prose dark:prose-invert text-gray-600 dark:text-gray-400 mb-8 border-b border-gray-200 dark:border-gray-700 pb-8 flex-grow">
                        {{ $product->description }}
                    </div>

                    <div class="mb-6">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Sold by <a href="{{ route('store.show', $product->shop->id) }}" class="font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">{{ $product->shop->name }}</a></p>
                    </div>

                    <!-- Add to Cart Form -->
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-auto">
                        @csrf
                        <div class="flex space-x-4">
                            <div class="w-24">
                                <label for="quantity" class="sr-only">Quantity</label>
                                <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-full border border-gray-300 rounded-md shadow-sm p-3 text-center dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" {{ $product->stock == 0 ? 'disabled' : '' }}>
                            </div>
                            <button type="submit" class="flex-1 bg-indigo-600 border border-transparent rounded-md shadow-sm py-3 px-8 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition disabled:opacity-50 disabled:cursor-not-allowed" {{ $product->stock == 0 ? 'disabled' : '' }}>
                                Add to Cart
                            </button>
                        </div>
                    </form>

                </div>
            </div>
            
            @if(session('success'))
                <div class="mt-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm" role="alert">
                    <p>{{ session('success') }} <a href="{{ route('cart.index') }}" class="font-bold underline">View Cart</a></p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
