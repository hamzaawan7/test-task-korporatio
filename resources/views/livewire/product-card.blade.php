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
