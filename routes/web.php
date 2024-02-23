<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\PurchaseHistoricController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{product}', [ProductController::class, 'destroy'])->name('promotions.show');

    Route::get('/promotions/create', [PromotionController::class, 'create'])->name('promotions.create');
    Route::post('/promotions', [PromotionController::class, 'store'])->name('promotions.store');
    Route::get('/promotions/{promotion}/edit', [PromotionController::class, 'edit'])->name('promotions.edit');
    Route::put('/promotions/{promotion}', [PromotionController::class, 'update'])->name('promotions.update');
    Route::delete('/promotions/{promotion}', [PromotionController::class, 'destroy'])->name('promotions.destroy');
    Route::get('/promotions/{promotion}', [PromotionController::class, 'destroy'])->name('promotions.show');

    Route::post('/purchase/checkout', [PurchaseHistoricController::class, 'store'])->name('purchase.store');
    Route::get('/purchase-histories', 'App\Http\Controllers\PurchaseHistoricController@index')
        ->name('purchaseHistories.index');

    Route::resource('carts', CartController::class);
    Route::resource('cart-items', CartItemController::class);
    Route::resource('rules', RuleController::class);
});

require __DIR__.'/auth.php';
