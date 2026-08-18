<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminArtistController;
use App\Http\Controllers\Admin\AdminBrandAssetsController;
use App\Http\Controllers\Admin\AdminTattooSupplyController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminPortfolioController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/{category}', [ShopController::class, 'category'])->name('shop.category');
Route::get('/shop/product/{slug}', [ShopController::class, 'show'])->name('shop.product');
Route::post('/shop/order', [ShopController::class, 'storeOrder'])->name('shop.order.store');
Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/gallery/{slug}', [GalleryController::class, 'show'])->name('gallery.show');
Route::get('/artists/{slug}', [GalleryController::class, 'artist'])->name('gallery.artist');

// Admin Auth Routes (Guest)
Route::middleware('guest')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit')
        ->middleware('throttle:login');
});

// Admin Routes (Authenticated + Admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Product Management
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');
    Route::post('/products/{product}/toggle-status', [AdminProductController::class, 'toggleStatus'])->name('products.toggle-status');
    Route::post('/products/{id}/restore', [AdminProductController::class, 'restore'])->name('products.restore');
    Route::delete('/products/gallery/{id}', [AdminProductController::class, 'destroyGalleryImage'])->name('products.gallery.destroy');

    // Category Management
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');

    // Portfolio Management
    Route::get('/portfolio', [AdminPortfolioController::class, 'index'])->name('portfolio.index');
    Route::get('/portfolio/create', [AdminPortfolioController::class, 'create'])->name('portfolio.create');
    Route::post('/portfolio', [AdminPortfolioController::class, 'store'])->name('portfolio.store');
    Route::get('/portfolio/{portfolio}/edit', [AdminPortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::put('/portfolio/{portfolio}', [AdminPortfolioController::class, 'update'])->name('portfolio.update');
    Route::delete('/portfolio/{portfolio}', [AdminPortfolioController::class, 'destroy'])->name('portfolio.destroy');

    // Review Management
    Route::get('/reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/create', [AdminReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [AdminReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}/edit', [AdminReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [AdminReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::post('/reviews/{review}/toggle-status', [AdminReviewController::class, 'toggleStatus'])->name('reviews.toggle-status');
    Route::post('/reviews/{review}/toggle-featured', [AdminReviewController::class, 'toggleFeatured'])->name('reviews.toggle-featured');

    // Settings
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::get('/settings/{group}/edit', [AdminSettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings/{group}', [AdminSettingController::class, 'update'])->name('settings.update');

    // Brand Assets
    Route::get('/brand-assets', [AdminBrandAssetsController::class, 'edit'])->name('brand-assets.edit');
    Route::put('/brand-assets', [AdminBrandAssetsController::class, 'update'])->name('brand-assets.update');
    Route::delete('/brand-assets/{key}', [AdminBrandAssetsController::class, 'destroy'])->name('brand-assets.destroy');

    // Artist Profile (single)
    Route::get('/artist-profile', [AdminArtistController::class, 'edit'])->name('artist-profile.edit');
    Route::put('/artist-profile', [AdminArtistController::class, 'update'])->name('artist-profile.update');

    // Tattoo Supply
    Route::get('/tattoo-supplies', [AdminTattooSupplyController::class, 'index'])->name('tattoo-supplies.index');
    Route::get('/tattoo-supplies/create', [AdminTattooSupplyController::class, 'create'])->name('tattoo-supplies.create');
    Route::post('/tattoo-supplies', [AdminTattooSupplyController::class, 'store'])->name('tattoo-supplies.store');
    Route::get('/tattoo-supplies/{tattooSupply}/edit', [AdminTattooSupplyController::class, 'edit'])->name('tattoo-supplies.edit');
    Route::put('/tattoo-supplies/{tattooSupply}', [AdminTattooSupplyController::class, 'update'])->name('tattoo-supplies.update');
    Route::delete('/tattoo-supplies/{tattooSupply}', [AdminTattooSupplyController::class, 'destroy'])->name('tattoo-supplies.destroy');

    // Orders & Bookings
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');
    Route::post('/orders/{id}/restore', [AdminOrderController::class, 'restore'])->name('orders.restore');
    Route::delete('/orders/{id}/force', [AdminOrderController::class, 'forceDelete'])->name('orders.force-delete');

    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::delete('/bookings/{booking}', [AdminBookingController::class, 'destroy'])->name('bookings.destroy');
    Route::post('/bookings/{id}/restore', [AdminBookingController::class, 'restore'])->name('bookings.restore');
    Route::delete('/bookings/{id}/force', [AdminBookingController::class, 'forceDelete'])->name('bookings.force-delete');

});
