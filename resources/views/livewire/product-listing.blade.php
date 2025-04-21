<div>
    <div class="container mx-auto px-4 py-8">
        <!-- Filters Section -->
        <div class="mb-8 bg-white p-6 rounded-lg shadow-lg">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <!-- Search Input -->
                <div class="w-full md:w-1/3">
                    <input
                        type="text"
                        id="globalSearch"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search products by title..."
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                    >
                </div>

                <!-- Category Filter -->
                <div class="w-full md:w-1/3">
                    <select
                        id="category"
                        wire:model.live="category"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                    >
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Sort Filter -->
                <div class="w-full md:w-1/3">
                    <select
                        id="sort"
                        wire:model.live.debounce.300ms="sort"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                    >
                        <option value="">Sort</option>
                        <option value="latest">Latest</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                        <option value="name_asc">Name: A-Z</option>
                        <option value="name_desc">Name: Z-A</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Loader -->
        <div wire:loading class="flex justify-center py-12">
            <svg class="animate-spin h-16 w-16 text-orange-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16M12 4v16" />
            </svg>
        </div>

        <!-- All Products Section -->
        <h2 class="text-3xl font-bold text-gray-900 mb-6">All Products</h2>

        @if(count($products) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        @if(!empty($product))
                            <a href="{{ route('products.show', $product->slug) }}">
                                <div class="h-48 bg-gray-200 overflow-hidden">
                                    @if($product->image)
                                        <img
                                            src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-full object-cover"
                                        >
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-100 rounded mb-2 text-gray-400">
                                            <svg class="w-12 h-12 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </a>

                            <div class="p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <a href="{{ route('products.show', $product->slug) }}" class="text-lg font-semibold text-gray-800 hover:text-orange-600">
                                        {{ $product->name }}
                                    </a>
                                    <span class="text-lg font-bold text-orange-600">
                                        {{ $product->formatted_price }}
                                    </span>
                                </div>

                                <div class="mb-3">
                                    @foreach($product->categories as $category)
                                        <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-1 mb-1">
                                            {{ $category->name }}
                                        </span>
                                    @endforeach
                                </div>

                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    {{ $product->description }}
                                </p>

                                <div class="flex justify-between items-center">
                                    <span class="text-sm {{ $product->stock_quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $product->stock_quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                                    </span>

                                    <a
                                        href="{{ route('products.show', $product->slug) }}"
                                        class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors duration-200 {{ $product->stock_quantity <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                        {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}
                                    >
                                        Add to Cart
                                    </a>
                                </div>
                            </div>
                        @endif

                    </div>

                @endforeach
            </div>

            <div class="mt-8">
                <!-- Pagination -->
                <div class="flex justify-center">
                    @if ($pagination['current_page'] > 1)
                        <button wire:click="previousPage" class="text-orange-500 hover:text-orange-600">Previous</button>
                    @endif
                    <span class="mx-2">Page {{ $pagination['current_page'] }} of {{ $pagination['last_page'] }}</span>
                    @if ($pagination['current_page'] < $pagination['last_page'])
                        <button wire:click="nextPage" class="text-orange-500 hover:text-orange-600">Next</button>
                    @endif
                </div>
            </div>
        @else
            <div class="text-center py-12 bg-white rounded-xl shadow-sm border border-orange-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-800">No products found</h3>
                <p class="mt-2 text-gray-500">Try adjusting your search or filter to find what you're looking for.</p>
                <button wire:click="clearSearch" class="mt-4 px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition">
                    Clear Search
                </button>
            </div>
        @endif

        <!-- Featured Products Section -->
        @if(!empty($featuredProducts))
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Featured Products</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($featuredProducts as $product)
                        <livewire:product-card :product="$product" :key="$product->id"/>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
