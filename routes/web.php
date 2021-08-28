<?php

use App\Http\Controllers\Steam\SteamController;
use App\Http\Controllers\TestController;
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
    // Route::get('/steam', App\Http\Livewire\Playground\Steam::class);
    Route::get('/steam', [SteamController::class, 'index'])->name('playground.steam.index');
    Route::post('/steam', [SteamController::class, 'submit'])->name('playground.steam.submit');
});

// Route::get('/abc', function(){
//     return inertia('Hello');
// });

// Route::get('/test', App\Http\Livewire\HelloWorld::class);