<div class="bg-white">
    <!-- Hero Banner -->
    <section class="relative overflow-hidden bg-orange-500">
        <div class="max-w-7xl mx-auto flex flex-col-reverse md:flex-row items-center px-6 py-16 lg:py-24">
            <div class="w-full md:w-1/2 text-center md:text-left">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">
                    Big Deals. Big Brands.
                </h1>
                <p class="text-white text-lg mb-6">Shop top categories, latest gadgets, and more – all in one place.</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-white text-orange-600 font-semibold px-6 py-3 rounded-lg shadow hover:bg-gray-100 transition">
                    Explore Now
                </a>
            </div>
            <div class="w-full md:w-1/2">
                <img src="https://images.unsplash.com/photo-1525130413817-d45c1d127c42?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1920&q=60&blend=6366F1&sat=-100&blend-mode=multiply" class="rounded-lg shadow-lg" alt="Hero Image" />
            </div>
        </div>
    </section>

    <!-- Featured Categories -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <h2 class="text-2xl font-bold mb-6 text-gray-900">Top Categories</h2>
        @if(isset($categories) && count($categories) > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->id]) }}" class="block bg-gray-100 p-3 rounded-lg text-center hover:shadow">
                        @if($category->image_url)
                            <img src="{{ $category->image_url }}" class="w-full h-24 object-cover rounded mb-2" alt="{{ $category->name }}">
                        @else
                            <div class="w-full h-24 flex items-center justify-center rounded mb-2 bg-orange-100 text-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                        @endif
                        <div class="text-sm font-medium text-gray-700">{{ $category->name }}</div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-10 bg-orange-50 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No categories found</h3>
                <p class="mt-1 text-sm text-gray-500">We couldn't find any product categories at the moment.</p>
            </div>
        @endif
    </section>

    <!-- Flash Deals / Featured Products -->
    <section class="bg-orange-50 py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Flash Deals</h2>
                <a href="{{ route('products.index') }}" class="text-orange-600 hover:text-orange-700 font-medium text-sm">View All</a>
            </div>

            @if(isset($featuredProducts) && count($featuredProducts) > 0)
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($featuredProducts as $product)
                        <livewire:product-card :product="$product" />
                    @endforeach
                </div>
            @else
                <div class="text-center py-10 bg-white rounded-lg border border-orange-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No featured products</h3>
                    <p class="mt-1 text-sm text-gray-500">Check back later for our special deals.</p>
                    <a href="{{ route('products.index') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                        Browse All Products
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Latest Arrivals -->
    <section class="py-14 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">New Arrivals</h2>

            @if(isset($latestProducts) && count($latestProducts) > 0)
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($latestProducts as $product)
                        <div class="bg-white border rounded-lg p-3 shadow-sm hover:shadow-lg transition">
                            <a href="{{ route('products.show', $product->slug) }}">
                                <div class="relative">
                                    @if($product->image_url)
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded mb-2">
                                    @else
                                        <div class="w-full h-48 flex items-center justify-center bg-gray-100 rounded mb-2 text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <span class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded">New</span>
                                </div>
                            </a>
                            <h3 class="text-sm font-semibold text-gray-800 truncate">{{ $product->name ?? 'Untitled Product' }}</h3>
                            <p class="text-xs text-gray-500 mb-1">{{ $product->categories[0]->name ?? 'Uncategorized' }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-orange-600 font-bold text-md">${{ number_format($product->price ?? 0, 2) }}</span>
                                <span class="text-xs text-green-600 font-semibold">Free Shipping</span>
                            </div>
                            <button class="mt-3 w-full bg-orange-500 text-white py-2 text-sm rounded hover:bg-orange-600">Add to Cart</button>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10 bg-orange-50 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No new arrivals yet</h3>
                    <p class="mt-1 text-sm text-gray-500">We're working on adding new products. Please check back soon!</p>
                </div>
            @endif
        </div>
    </section>
</div>
