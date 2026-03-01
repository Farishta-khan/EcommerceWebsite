<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Shop All Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col md:flex-row gap-6">
            
            <!-- Filters Sidebar -->
            <div class="w-full md:w-1/4">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Filters</h3>
                    <form action="{{ route('home') }}" method="GET">
                        
                        <!-- Categories -->
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Categories</h4>
                            @foreach($categories as $category)
                                <div class="flex items-center mb-2">
                                    <input type="radio" id="cat_{{ $category->id }}" name="category" value="{{ $category->slug }}" 
                                           {{ request('category') == $category->slug ? 'checked' : '' }}
                                           class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="cat_{{ $category->id }}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $category->name }}</label>
                                </div>
                            @endforeach
                        </div>

                        <!-- Price Range -->
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Price</h4>
                            <div class="flex items-center space-x-2">
                                <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}" class="w-full p-2 border border-gray-300 rounded text-sm dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300">
                                <span>-</span>
                                <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}" class="w-full p-2 border border-gray-300 rounded text-sm dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300">
                            </div>
                        </div>

                        <!-- Availability -->
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Availability</h4>
                            <div class="flex items-center mb-2">
                                <input type="checkbox" id="in_stock" name="availability" value="in_stock" {{ request('availability') == 'in_stock' ? 'checked' : '' }} class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="in_stock" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">In Stock Only</label>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out">
                            Apply Filters
                        </button>
                        
                        @if(request()->anyFilled(['category', 'min_price', 'max_price', 'availability']))
                            <a href="{{ route('home') }}" class="block text-center mt-3 text-sm text-indigo-600 dark:text-indigo-400 hover:underline">Clear Filters</a>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="w-full md:w-3/4">
                @if($products->isEmpty())
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center text-gray-500 dark:text-gray-400">
                        No products found matching your criteria.
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden flex flex-col h-full transform transition hover:-translate-y-1 hover:shadow-lg">
                                <div class="h-48 flex items-center justify-center text-gray-500 overflow-hidden bg-gray-100 dark:bg-gray-700">
                                    <img src="{{ $product->image_url ?? 'https://placehold.co/400x300?text=No+Image' }}" alt="{{ $product->name }}" class="object-cover h-full w-full">
                                </div>
                                <div class="p-4 flex flex-col flex-grow">
                                    <div class="text-xs text-indigo-600 dark:text-indigo-400 font-semibold uppercase tracking-wider mb-1">{{ $product->category->name }}</div>
                                    <h3 class="font-bold text-lg text-gray-900 dark:text-gray-100 mb-2 truncate">
                                        <a href="{{ route('product.show', $product->id) }}" class="hover:underline flex-grow">{{ $product->name }}</a>
                                    </h3>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-2">{{ $product->description }}</p>
                                    
                                    <div class="mt-auto flex justify-between items-center">
                                        <span class="text-xl font-bold text-gray-900 dark:text-gray-100">Rs. {{ number_format($product->price, 2) }}</span>
                                        <span class="text-xs px-2 py-1 rounded {{ $product->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                                        </span>
                                    </div>
                                    <div class="mt-4 text-xs text-gray-500">Sold by: <a href="{{ route('store.show', $product->shop->id) }}" class="underline hover:text-indigo-600 dark:hover:text-indigo-400">{{ $product->shop->name }}</a></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
