<?php

namespace App\Http\Controllers\Steam\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Cart;
use App\Models\Shop\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Playground/Shop/Cart', [
            'cart' => Cart::query()->first()
        ]);
    }

}
