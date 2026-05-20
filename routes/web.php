<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Catalog
Route::get('/catalog', [ProductController::class, 'index'])->name('catalog');
Route::get('/catalog/{slug}', [ProductController::class, 'show'])->name('product.show');

// Quiz
Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');
Route::post('/quiz/result', [QuizController::class, 'result'])->name('quiz.result');

// Static pages
Route::view('/privacy', 'pages.privacy')->name('privacy');
Route::view('/terms', 'pages.terms')->name('terms');

// Auth required
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Favorites
    Route::post('/favorites/{product}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');

    // Orders
    Route::get('/checkout', [OrderController::class, 'create'])->name('checkout.create');
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Reviews
    Route::post('/catalog/{product}/review', [ReviewController::class, 'store'])->name('review.store');
});

// Admin panel
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', Admin\ProductController::class);
    Route::resource('categories', Admin\CategoryController::class);
    Route::resource('notes', Admin\NoteController::class);
    Route::resource('orders', Admin\OrderController::class)->only(['index', 'show', 'update']);
    Route::patch('orders/{order}/status', [Admin\OrderController::class, 'updateStatus'])->name('orders.status');
    Route::get('reviews', [Admin\ReviewController::class, 'index'])->name('reviews.index');
    Route::patch('reviews/{review}/approve', [Admin\ReviewController::class, 'approve'])->name('reviews.approve');
    Route::delete('reviews/{review}', [Admin\ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::post('products/{product}/images', [Admin\ProductController::class, 'uploadImage'])->name('products.images.upload');
    Route::delete('products/{product}/images/{image}', [Admin\ProductController::class, 'deleteImage'])->name('products.images.delete');
});

require __DIR__.'/auth.php';
