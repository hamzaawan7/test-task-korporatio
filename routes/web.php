<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/', [HomeController::class, 'index'])->name('home');

// Product Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

// Order Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

// Authentication Routes
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect('/admin');
    }
    return redirect()->route('home');
})->name('dashboard');
