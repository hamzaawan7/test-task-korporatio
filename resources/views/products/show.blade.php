@extends('layouts.app')

@section('content')
    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:items-start lg:gap-x-8">
                <!-- Image gallery -->
                <div class="flex flex-col-reverse">
                    <div class="aspect-h-1 aspect-w-1 w-full">
                        <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/600x600?text=No+Image' }}" alt="{{ $product->name }}" class="h-full w-full object-cover object-center sm:rounded-lg">
                    </div>
                </div>

                <!-- Product info -->
                <div class="mt-10 px-4 sm:mt-16 sm:px-0 lg:mt-0">
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $product->name }}</h1>

                    <div class="mt-3">
                        <h2 class="sr-only">Product information</h2>
                        <p class="text-3xl tracking-tight text-gray-900">${{ number_format($product->price, 2) }}</p>
                    </div>

                    <!-- Reviews -->
                    <div class="mt-3">
                        <div class="flex items-center">
                            <div class="flex items-center">
                                <!-- Stars -->
                                <svg class="text-yellow-400 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                                </svg>
                                <p class="ml-1 text-sm text-gray-500">4.5 <span class="text-gray-400">(32 reviews)</span></p>
                            </div>
                            <div class="ml-4 border-l border-gray-300 pl-4">
                                <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">See all reviews</a>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="sr-only">Description</h3>
                        <div class="space-y-6 text-base text-gray-700">
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="flex items-center">
                            @if($product->stock_quantity > 0)
                                <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <p class="ml-2 text-sm text-gray-500">In stock ({{ $product->stock_quantity }} available)</p>
                            @else
                                <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                <p class="ml-2 text-sm text-gray-500">Out of stock</p>
                            @endif
                        </div>
                    </div>

                    <form class="mt-6" action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="mt-10 flex">
                            <div class="mr-4">
                                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                                <select id="quantity" name="quantity" class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                    @for($i = 1; $i <= min(10, $product->stock_quantity); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <button type="submit" class="flex max-w-xs flex-1 items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50 sm:w-full" {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}>
                                Add to cart
                            </button>
                        </div>
                    </form>

                    <div class="mt-8 border-t border-gray-200 pt-8">
                        <h2 class="text-sm font-medium text-gray-900">Categories</h2>
                        <div class="mt-4 space-x-2">
                            @foreach($product->categories as $category)
                                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1.5 text-xs font-medium text-gray-800 hover:bg-gray-200">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related products -->
            @if($relatedProducts->count() > 0)
                <div class="mx-auto mt-16 max-w-2xl px-4 sm:mt-24 sm:px-6 lg:max-w-7xl lg:px-8">
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Customers also purchased</h2>
                    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                        @foreach($relatedProducts as $product)
                            @include('partials.product-card', ['product' => $product])
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
