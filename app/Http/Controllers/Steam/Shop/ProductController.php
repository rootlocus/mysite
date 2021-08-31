<?php

namespace App\Http\Controllers\Steam\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Cart;
use App\Models\Shop\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function show(Request $request, Product $product)
    {
        $cart = Cart::query()->withCount(['items'])->first();

        return Inertia::render('Playground/Shop/Show', [
            'product' => Product::query()->with('category:id,name')->where('id', $product->id)->first(),
            'cart' => $cart,
            'cartItem' => $cart->items()->where('product_id', $product->id)->first(),
        ]);
    }

}
