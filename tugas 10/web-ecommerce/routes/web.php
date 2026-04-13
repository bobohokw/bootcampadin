<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// 1. Halaman Utama (memanggil Controller)
Route::get('/', [ProductController::class, 'index']);

// 2. Halaman Daftar Produk
Route::get('/products', function () {
    return "Halaman Daftar Produk";
});

// 3. Halaman Keranjang
Route::get('/cart', function () {
    return "Halaman Keranjang Belanja";
});

// 4. Halaman Checkout
Route::get('/checkout', function () {
    return "Halaman Checkout";
});