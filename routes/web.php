<?php

use App\Livewire\ProductDetails;
use App\Livewire\HomePage;
use App\Livewire\ProductListing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/', HomePage::class)->name('home');

// Product Routes
Route::get('/products', ProductListing::class)->name('products.index');
Route::get('/products/{slug}', ProductDetails::class)->name('products.show');

// Order Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});



// Authentication Routes
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect('/admin');
    }
    return redirect()->route('home');
})->name('dashboard');
