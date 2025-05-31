<?php

use App\Livewire\Frontend\Account\Dashboard;
use App\Livewire\Frontend\Account\Orders;
use App\Livewire\Frontend\Account\Profile;
use App\Livewire\Frontend\Cart;
use App\Livewire\Frontend\Checkout;
use App\Livewire\Frontend\HomePage;
use App\Livewire\Frontend\ProductCatalog;
use App\Livewire\Frontend\ProductDetail;
use App\Livewire\Frontend\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', HomePage::class)->name('home');

Route::get('/products', ProductCatalog::class)->name('products');

Route::get('/product/{slug}', ProductDetail::class)->name('product.detail');

Route::get('/cart', Cart::class)->name('cart');

Route::get('/wishlist', Wishlist::class)->name('wishlist');

Route::get('/checkout', Checkout::class)->name('checkout')->middleware('auth:account');

// Category Routes
Route::get('/category/{slug}', ProductCatalog::class)->name('category.products');

// Search Routes
Route::get('/search', ProductCatalog::class)->name('search');

// Account Authentication Routes
Route::middleware('guest:account')->group(function () {
    Route::get('/login', function () {
        return view('frontend.auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('frontend.auth.register');
    })->name('register');
});

// Account Routes
Route::middleware('auth:account')->prefix('account')->name('account.')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/orders', Orders::class)->name('orders');
    Route::get('/profile', Profile::class)->name('profile');

    // Order details
    Route::get('/orders/{order}', function ($order) {
        return view('frontend.account.order-detail', compact('order'));
    })->name('order.detail');
});

// Logout Route
Route::post('/logout', function () {
    Auth::guard('account')->logout();

    return redirect()->route('home');
})->name('logout');

// API Routes for AJAX calls
Route::prefix('api')->group(function () {
    Route::post('/cart/add', [Cart::class, 'addToCart'])->name('api.cart.add');
    Route::post('/wishlist/toggle', [Wishlist::class, 'toggleWishlist'])->name('api.wishlist.toggle');
});
