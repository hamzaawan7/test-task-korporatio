<div>
    <div class="container mx-auto px-4 py-8">
        <!-- Filters -->
        <div class="mb-8 bg-white p-6 rounded-lg shadow">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="w-full md:w-1/3">
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search products..."
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <div class="w-full md:w-1/3">
                    <select
                        wire:model.live="category"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-full md:w-1/3">
                    <select
                        wire:model.live="sort"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="latest">Latest</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                        <option value="name_asc">Name: A-Z</option>
                        <option value="name_desc">Name: Z-A</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Featured Products -->
        @if($featuredProducts->count() > 0)
            <div class="mb-12">
                <h2 class="text-2xl font-bold mb-6">Featured Products</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($featuredProducts as $product)
                        @livewire('product-card', ['product' => $product], key($product->id))
                    @endforeach
                </div>
            </div>
        @endif

        <!-- All Products -->
        <h2 class="text-2xl font-bold mb-6">All Products</h2>

        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                    @livewire('product-card', ['product' => $product], key($product->id))
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">No products found matching your criteria.</p>
            </div>
        @endif
    </div>
</div>
