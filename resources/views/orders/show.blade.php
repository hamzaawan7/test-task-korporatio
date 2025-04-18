@extends('layouts.app')

@section('content')
    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <div class="max-w-xl">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Order #{{ $order->id }}</h1>
                <p class="mt-2 text-sm text-gray-500">Placed on {{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
            </div>

            <div class="mt-8 grid grid-cols-1 gap-8 lg:grid-cols-2">
                <!-- Order summary -->
                <div class="lg:col-start-2">
                    <div class="rounded-lg bg-gray-50 px-6 py-6 lg:px-8 lg:py-8">
                        <h2 class="sr-only">Order summary</h2>

                        <div class="flow-root">
                            <ul class="-my-6 divide-y divide-gray-200">
                                <li class="flex py-6">
                                    <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                        <img src="{{ $order->product->image ? asset('storage/'.$order->product->image) : 'https://via.placeholder.com/150?text=No+Image' }}" alt="{{ $order->product->name }}" class="h-full w-full object-cover object-center">
                                    </div>

                                    <div class="ml-4 flex flex-1 flex-col">
                                        <div>
                                            <div class="flex justify-between text-base font-medium text-gray-900">
                                                <h3>{{ $order->product->name }}</h3>
                                                <p class="ml-4">${{ number_format($order->product->price, 2) }}</p>
                                            </div>
                                            <p class="mt-1 text-sm text-gray-500">Quantity: {{ $order->quantity }}</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <dl class="mt-6 space-y-4">
                            <div class="flex items-center justify-between">
                                <dt class="text-sm text-gray-600">Subtotal</dt>
                                <dd class="text-sm font-medium text-gray-900">${{ number_format($order->product->price * $order->quantity, 2) }}</dd>
                            </div>
                            <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                                <dt class="text-base font-medium text-gray-900">Order total</dt>
                                <dd class="text-base font-medium text-gray-900">${{ number_format($order->total_price, 2) }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Shipping and status -->
                <div class="lg:col-start-1 lg:row-start-1">
                    <div class="rounded-lg bg-gray-50 px-6 py-6 lg:px-8 lg:py-8">
                        <h2 class="text-lg font-medium text-gray-900">Order Status</h2>

                        <div class="mt-6">
                            <div class="flex items-center">
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                @if($order->status === 'completed') bg-green-100 text-green-800
                                @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                @else bg-blue-100 text-blue-800 @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                            </div>
                        </div>

                        <div class="mt-8 border-t border-gray-200 pt-8">
                            <h2 class="text-lg font-medium text-gray-900">Shipping information</h2>

                            <div class="mt-4">
                                <div class="space-y-2">
                                    <p class="text-sm text-gray-700">{{ $order->customer_name }}</p>
                                    <p class="text-sm text-gray-700">{{ $order->customer_email }}</p>
                                    @if($order->customer_phone)
                                        <p class="text-sm text-gray-700">{{ $order->customer_phone }}</p>
                                    @endif
                                    @if($order->customer_address)
                                        <p class="text-sm text-gray-700">{{ $order->customer_address }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
