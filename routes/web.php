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
        Route::get('/product/{product}', [App\Http\Controllers\Steam\Shop\ProductController::class, 'show'])->name('playground.shop.product.show');
    });
});

// Route::get('/abc', function(){
//     return inertia('Hello');
// });

// Route::get('/test', App\Http\Livewire\HelloWorld::class);