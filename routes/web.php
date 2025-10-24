<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// Cart Routes
Route::post('/cart/add/{id}', [ProductController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{id}', [ProductController::class, 'removeFromCart'])->name('cart.remove');
Route::put('/cart/update/{id}', [ProductController::class, 'updateCart'])->name('cart.update');
Route::get('/cart', [ProductController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/clear', [ProductController::class, 'clearCart'])->name('cart.clear');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');