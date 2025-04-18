@extends('layouts.app')

@section('content')
    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <!-- Filters -->
            <div class="mb-8 border-b border-gray-200 pb-6">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">All Products</h1>

                <div class="mt-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <!-- Search -->
                    <div class="w-full md:w-1/3">
                        <form>
                            <div class="relative">
                                <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Search products..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 pl-10">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Category Filter -->
                    <div class="w-full md:w-1/3">
                        <select name="category" onchange="this.form.submit()" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ ($filters['category'] ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort -->
                    <div class="w-full md:w-1/3">
                        <select name="sort" onchange="this.form.submit()" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Sort By</option>
                            <option value="latest" {{ ($filters['sort'] ?? '') == 'latest' ? 'selected' : '' }}>Newest</option>
                            <option value="price_low" {{ ($filters['sort'] ?? '') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ ($filters['sort'] ?? '') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            @if($products->count() > 0)
                <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                    @foreach($products as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No products found</h3>
                    <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter to find what you're looking for.</p>
                    <div class="mt-6">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Reset Filters
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
