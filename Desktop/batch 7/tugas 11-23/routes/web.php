<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WishlistController;

/*
|--------------------------------------------------------------------------
| Public Routes (Bisa diakses siapa saja)
|--------------------------------------------------------------------------
*/

Route::get('/', [ProductController::class, 'katalog'])->name('home');
Route::get('/katalog', [ProductController::class, 'katalog'])->name('product.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');

// MIDTRANS CALLBACK
Route::post('/midtrans/callback', [OrderController::class, 'callback']);

/*
|--------------------------------------------------------------------------
| Protected Routes (Wajib Login)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    
    // Dashboard & Profile
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Fitur Keranjang (Cart)
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add/{id}', [CartController::class, 'add'])->name('cart.add');
        Route::delete('/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
    });

    // Fitur Wishlist (Love)
    Route::prefix('wishlist')->group(function () {
        Route::get('/', [WishlistController::class, 'index'])->name('wishlist.index');
        Route::post('/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');
        Route::delete('/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    });

    // Fitur Checkout & Payment
    Route::post('/checkout/process', [OrderController::class, 'process'])->name('checkout.process');
    Route::post('/checkout', [OrderController::class, 'process'])->name('checkout'); 

    // Tracking Pesanan & Riwayat
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/{id}/complete', [OrderController::class, 'complete'])->name('orders.complete');

    /*
    |--------------------------------------------------------------------------
    | Admin Routes (Khusus Role Admin)
    |--------------------------------------------------------------------------
    */
    Route::middleware('admin')->group(function () {
        
        // Dashboard Statistik Admin
        Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

        // CRUD Produk
        Route::get('/products/list', [ProductController::class, 'index'])->name('products.list'); 
        Route::prefix('products')->group(function () {
            Route::get('/create', [ProductController::class, 'create'])->name('products.create');
            Route::post('/store', [ProductController::class, 'store'])->name('product.store');
            Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
            Route::put('/{id}', [ProductController::class, 'update'])->name('products.update');
            Route::delete('/{id}', [ProductController::class, 'delete'])->name('products.delete');
        });

        // CRUD Kategori
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index'); 
        Route::prefix('categories')->group(function () {
            Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
            Route::post('/store', [CategoryController::class, 'store'])->name('product-category.store');
            Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::put('/{id}', [CategoryController::class, 'update'])->name('categories.update');
            Route::delete('/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
        });
    });
});

require __DIR__.'/auth.php';