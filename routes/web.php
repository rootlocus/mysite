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

Route::prefix('playground')->name('playground.')->group(function () {
    Route::get('/', App\Http\Livewire\Playground\Index::class);
    Route::get('/steam', [App\Http\Controllers\Steam\SteamController::class, 'index'])->name('steam.index');
    Route::get('/steam/logs', [App\Http\Controllers\Steam\SteamController::class, 'logs'])->name('steam.logs');

    /** Shop */
    Route::prefix('shop')->name('shop.')->group(function () {
        Route::get('/', [App\Http\Controllers\Shop\ShopController::class, 'index'])->name('index');
        Route::get('/orders', [App\Http\Controllers\Shop\MyOrderController::class, 'index'])->middleware('auth')->name('orders.index');
        Route::get('/profile', [App\Http\Controllers\Shop\ProfileController::class, 'index'])->middleware('auth')->name('profile.index');
        Route::get('/logs', [App\Http\Controllers\Shop\ShopController::class, 'logs'])->name('logs');

        Route::prefix('/address')->name('address.')->middleware('auth')->group(function () {
            Route::post('/', [App\Http\Controllers\Shop\AddressController::class, 'store'])->name('store');
            Route::put('/{address}', [App\Http\Controllers\Shop\AddressController::class, 'update'])->name('update');
            Route::put('/{address}/default', [App\Http\Controllers\Shop\AddressController::class, 'setDefault'])->name('setDefault');
        });

        /** Cart */
        Route::prefix('/cart')->name('cart.')->group(function () {
            Route::middleware('auth')->group(function() {
                Route::get('/', [App\Http\Controllers\Shop\CartController::class, 'index'])->name('index');
                Route::delete('/{cart}', [App\Http\Controllers\Shop\CartController::class, 'clearAll'])->name('clearAll');
                Route::put('/{cart}/product', [App\Http\Controllers\Shop\CartController::class, 'update'])->name('update');
                Route::delete('/{cart}/product/{product}', [App\Http\Controllers\Shop\CartController::class, 'destroy'])->name('product.destroy');
                Route::put('/{cart}/update-address', [App\Http\Controllers\Shop\CartController::class, 'updateAddress'])->name('updateAddress');
            });
            Route::middleware('verified')->group(function() {
                Route::post('/{cart}', [App\Http\Controllers\Shop\CartController::class, 'checkout'])->name('checkout');
            });
        });

        /** Product */
        Route::prefix('/product')->name('product.')->middleware('auth')->group(function () {
            Route::get('/{product}', [App\Http\Controllers\Shop\ProductController::class, 'show'])->name('show');
            Route::put('/{product}/add', [App\Http\Controllers\Shop\ProductController::class, 'addToCart'])->name('add');
        });
    });
});

// Route::get('/abc', function(){
//     return inertia('Hello');
// });

// Route::get('/test', App\Http\Livewire\HelloWorld::class);

require __DIR__.'/email.php'; //this adds the routes here

require __DIR__.'/auth.php'; //this adds the routes here
