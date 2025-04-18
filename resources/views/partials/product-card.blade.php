<div class="group relative">
    <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
        <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/300x300?text=No+Image' }}" alt="{{ $product->name }}" class="h-full w-full object-cover object-center lg:h-full lg:w-full">
    </div>
    <div class="mt-4 flex justify-between">
        <div>
            <h3 class="text-sm text-gray-700">
                <a href="{{ route('products.show', $product->slug) }}">
                    <span aria-hidden="true" class="absolute inset-0"></span>
                    {{ $product->name }}
                </a>
            </h3>
            <p class="mt-1 text-sm text-gray-500">
                @foreach($product->categories as $category)
                    <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800">{{ $category->name }}</span>
                @endforeach
            </p>
        </div>
        <p class="text-sm font-medium text-gray-900">${{ number_format($product->price, 2) }}</p>
    </div>
</div>
