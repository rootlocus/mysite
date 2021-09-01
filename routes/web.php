<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//display a notice to the user that they should click the email verification link 
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

//user clicks the email verification link that was emailed to them
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

// user may misplace or accidentally delete the email address verification email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// https://laravel.com/docs/8.x/verification
// Route::get('/profile', function () {
//     // Only verified users may access this route...
// })->middleware('verified');


Route::get('/', App\Http\Livewire\Home\Index::class);
Route::get('/about-me', App\Http\Livewire\AboutMe\Index::class);

Route::prefix('playground')->group(function () {
    Route::get('/', App\Http\Livewire\Playground\Index::class);
    Route::get('/steam', [App\Http\Controllers\Steam\SteamController::class, 'index'])->name('playground.steam.index');

    /** Shop */
    Route::prefix('shop')->group(function () {
        Route::get('/', [App\Http\Controllers\Shop\ShopController::class, 'index'])->name('playground.shop.index');
        Route::get('/my-orders', [App\Http\Controllers\Shop\MyOrderController::class, 'index'])->name('playground.shop.my-orders.index');
        /** Cart */
        Route::prefix('/cart')->group(function () {
            Route::get('/', [App\Http\Controllers\Shop\CartController::class, 'index'])->name('playground.shop.cart');
            Route::delete('/{cart}', [App\Http\Controllers\Shop\CartController::class, 'clearAll'])->name('playground.shop.cart.clearAll');
            Route::post('/{cart}', [App\Http\Controllers\Shop\CartController::class, 'checkout'])->name('playground.shop.cart.checkout');
            Route::put('/{cart}/product', [App\Http\Controllers\Shop\CartController::class, 'update'])->name('playground.shop.cart.update');
            Route::delete('/{cart}/product/{product}', [App\Http\Controllers\Shop\CartController::class, 'destroy'])->name('playground.shop.cart.product.destroy');
        });
        /** Product */
        Route::prefix('/product')->group(function () {
            Route::get('/{product}', [App\Http\Controllers\Shop\ProductController::class, 'show'])->name('playground.shop.product.show');
            Route::put('/{product}/add', [App\Http\Controllers\Shop\ProductController::class, 'addToCart'])->name('playground.shop.product.add');
        });
    });
});

// Route::get('/abc', function(){
//     return inertia('Hello');
// });

// Route::get('/test', App\Http\Livewire\HelloWorld::class);

require __DIR__.'/auth.php';
