@extends('layouts.app')

@section('content')
    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Your Orders</h1>
                    <p class="mt-2 text-sm text-gray-700">A list of all your recent orders.</p>
                </div>
            </div>

            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Order #</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Product</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Amount</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6"><span class="sr-only">View</span></th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">#{{ $order->id }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 flex-shrink-0">
                                                    <img class="h-10 w-10 rounded-md object-cover" src="{{ $order->product->image ? asset('storage/'.$order->product->image) : 'https://via.placeholder.com/100?text=No+Image' }}" alt="{{ $order->product->name }}">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="font-medium text-gray-900">{{ $order->product->name }}</div>
                                                    <div class="text-gray-500">Qty: {{ $order->quantity }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                                @if($order->status === 'completed') bg-green-100 text-green-800
                                                @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                                @else bg-blue-100 text-blue-800 @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">${{ number_format($order->total_price, 2) }}</td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <a href="{{ route('orders.show', $order->id) }}" class="text-indigo-600 hover:text-indigo-900">View<span class="sr-only">, Order #{{ $order->id }}</span></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
