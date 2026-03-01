<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $shop->name }}
        </h2>
    </x-slot>

    <!-- Store Banner -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden h-64 md:h-80">
            @if($shop->banner_url)
                <img src="{{ $shop->banner_url }}" alt="Store Banner" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-40"></div>
            @else
                <div class="absolute inset-0 bg-indigo-600 dark:bg-indigo-900"></div>
            @endif
            
            <div class="absolute inset-0 flex items-center justify-center flex-col text-center p-6">
                @if($shop->logo_url)
                    <img src="{{ $shop->logo_url }}" alt="{{ $shop->name }} Logo" class="h-24 w-24 object-cover rounded-full border-4 border-white shadow-lg mb-4">
                @endif
                <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight drop-shadow-md">{{ $shop->name }}</h1>
                <p class="mt-4 text-lg md:text-xl text-gray-200 max-w-2xl drop-shadow">{{ $shop->description }}</p>
            </div>
        </div>
    </div>

    <!-- Store Products -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-6">
                
                <!-- Sidebar Filters -->
                <div class="w-full md:w-1/4">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Filter Store</h3>
                        <form method="GET" action="{{ route('store.show', $shop->id) }}">
                            
                            <!-- Categories -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>
                                <select name="category" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="w-full bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Apply Filters
                            </button>
                            
                            @if(request()->anyFilled(['category']))
                                <a href="{{ route('store.show', $shop->id) }}" class="mt-2 w-full bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none">
                                    Clear Filters
                                </a>
                            @endif
                        </form>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="w-full md:w-3/4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($products as $product)
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden flex flex-col h-full transform transition hover:-translate-y-1 hover:shadow-lg">
                                <div class="h-48 flex items-center justify-center text-gray-500 overflow-hidden bg-gray-100 dark:bg-gray-700 relative">
                                    <img src="{{ $product->image_url ?? 'https://placehold.co/400x300?text=No+Image' }}" alt="{{ $product->name }}" class="object-cover h-full w-full">
                                    @if($product->stock <= 0)
                                        <div class="absolute inset-0 bg-white bg-opacity-70 flex items-center justify-center">
                                            <span class="text-red-600 font-bold text-lg border-2 border-red-600 px-4 py-1 rounded rotate-12">OUT OF STOCK</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4 flex flex-col flex-grow">
                                    <div class="text-xs text-indigo-600 dark:text-indigo-400 font-semibold uppercase tracking-wider mb-1">{{ $product->category->name }}</div>
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2 truncate">
                                        <a href="{{ route('product.show', $product->id) }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">{{ $product->name }}</a>
                                    </h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 flex-grow line-clamp-2">{{ $product->description }}</p>
                                    <div class="mt-auto flex items-center justify-between">
                                        <span class="text-xl font-bold text-gray-900 dark:text-gray-100">Rs. {{ number_format($product->price, 2) }}</span>
                                        <a href="{{ route('product.show', $product->id) }}" class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500">View Details &rarr;</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full bg-white dark:bg-gray-800 rounded-lg shadow p-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No products found</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try adjusting your filters.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
