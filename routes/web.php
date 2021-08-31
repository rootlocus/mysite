<?php

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

Route::get('/', App\Http\Livewire\Home\Index::class);
Route::get('/about-me', App\Http\Livewire\AboutMe\Index::class);
Route::prefix('playground')->group(function () {
    Route::get('/', App\Http\Livewire\Playground\Index::class);
    Route::get('/steam', [App\Http\Controllers\Steam\SteamController::class, 'index'])->name('playground.steam.index');
    Route::prefix('shop')->group(function () {
        Route::get('/', [App\Http\Controllers\Steam\Shop\ShopController::class, 'index'])->name('playground.shop.index');
        Route::get('/cart', [App\Http\Controllers\Steam\Shop\CartController::class, 'index'])->name('playground.shop.cart');
        Route::delete('/cart/{cart}', [App\Http\Controllers\Steam\Shop\CartController::class, 'clearAll'])->name('playground.shop.cart.clearAll');
        Route::put('/cart/{cart}/product', [App\Http\Controllers\Steam\Shop\CartController::class, 'update'])->name('playground.shop.cart.update');
        Route::delete('/cart/{cart}/product/{product}', [App\Http\Controllers\Steam\Shop\CartController::class, 'destroy'])->name('playground.shop.cart.product.destroy');
        Route::get('/product/{product}', [App\Http\Controllers\Steam\Shop\ProductController::class, 'show'])->name('playground.shop.product.show');
        Route::put('/product/{product}/add', [App\Http\Controllers\Steam\Shop\ProductController::class, 'addToCart'])->name('playground.shop.product.add');
    });
});

// Route::get('/abc', function(){
//     return inertia('Hello');
// });

// Route::get('/test', App\Http\Livewire\HelloWorld::class);