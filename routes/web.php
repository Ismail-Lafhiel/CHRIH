<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishListController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// routes for testing
Route::get('/shop', [ProductController::class, 'index'])->name('products.shop');
Route::get('/view-product/{product}', [ProductController::class, 'show'])->name('products.show');

Route::middleware(['auth'])->group(function () {
    //wishlist
    Route::post('/wishlist/add/{product}', [WishListController::class, 'addToWishlist'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{product}', [WishListController::class, 'removeFromWishlist'])->name('wishlist.remove');
    Route::get('/wishlist', [WishListController::class, 'index'])->name('wishlist.index');


    //cart
    Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{product}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
});

//
