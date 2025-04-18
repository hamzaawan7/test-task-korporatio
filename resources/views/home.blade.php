@extends('layouts.app')

@section('content')
    <div class="bg-white">
        <!-- Hero Section -->
        <div class="relative bg-gray-900">
            <div class="relative h-80 overflow-hidden bg-indigo-600 md:absolute md:left-0 md:h-full md:w-1/3 lg:w-1/2">
                <img class="h-full w-full object-cover" src="https://images.unsplash.com/photo-1525130413817-d45c1d127c42?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1920&q=60&blend=6366F1&sat=-100&blend-mode=multiply" alt="">
            </div>
            <div class="relative mx-auto max-w-7xl py-24 sm:py-32 lg:px-8 lg:py-40">
                <div class="pl-6 pr-6 md:ml-auto md:w-2/3 md:pl-16 lg:w-1/2 lg:pl-24 lg:pr-0">
                    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl">Welcome to Our Store</h1>
                    <p class="mt-6 text-lg leading-7 text-gray-300">Discover amazing products at unbeatable prices. Quality you can trust, service you can rely on.</p>
                    <div class="mt-8">
                        <a href="{{ route('products.index') }}" class="inline-flex rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Products -->
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Featured Products</h2>
                <a href="{{ route('products.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Browse all products<span aria-hidden="true"> &rarr;</span></a>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach($featuredProducts as $product)
                    @include('partials.product-card', ['product' => $product])
                @endforeach
            </div>
        </div>

        <!-- Latest Products -->
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 bg-gray-50">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">New Arrivals</h2>
            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach($latestProducts as $product)
                    @include('partials.product-card', ['product' => $product])
                @endforeach
            </div>
        </div>

        <!-- Categories -->
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Shop by Category</h2>
            <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->id]) }}" class="group relative block h-64 overflow-hidden rounded-lg bg-gray-100">
                        <img src="https://images.unsplash.com/photo-1511556820780-d912e42b4980?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=720&q=80" alt="{{ $category->name }}" class="h-full w-full object-cover object-center transition-opacity group-hover:opacity-75">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <h3 class="text-xl font-semibold text-white">{{ $category->name }}</h3>
                            <p class="mt-1 text-sm text-gray-300">{{ $category->products_count ?? 0 }} products</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
