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

    /** Shop */
    Route::prefix('shop')->name('shop.')->group(function () {
        Route::get('/', [App\Http\Controllers\Shop\ShopController::class, 'index'])->name('index');
        Route::get('/my-orders', [App\Http\Controllers\Shop\MyOrderController::class, 'index'])->middleware('auth')->name('my-orders.index');
        /** Cart */
        Route::prefix('/cart')->name('cart.')->middleware('auth')->group(function () {
            Route::get('/', [App\Http\Controllers\Shop\CartController::class, 'index']);
            Route::delete('/{cart}', [App\Http\Controllers\Shop\CartController::class, 'clearAll'])->name('clearAll');
            Route::post('/{cart}', [App\Http\Controllers\Shop\CartController::class, 'checkout'])->name('checkout');
            Route::put('/{cart}/product', [App\Http\Controllers\Shop\CartController::class, 'update'])->name('update');
            Route::delete('/{cart}/product/{product}', [App\Http\Controllers\Shop\CartController::class, 'destroy'])->name('product.destroy');
        });
        /** Product */
        Route::prefix('/product')->name('product.')->group(function () {
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
