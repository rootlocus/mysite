<?php

namespace App\Http\Controllers\Shop;

use App\Actions\Shop\UpdateCartQuantity;
use App\Http\Controllers\Controller;
use App\Models\Shop\Cart;
use App\Models\Shop\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function addToCart(Request $request, Product $product)
    {
        if (Auth::check()) {
            $data = [
                'cart_id' => $request->cart,
                'product_id' => $product->id,
                'price' => $product->price,
                'type' => $request->type,
                'quantity' => $request->quantity
            ];
    
            UpdateCartQuantity::run($data);
            
            return redirect()->route('playground.shop.product.show', $product->id); 
        }

        return redirect()->route('shop.login.create');
    }
}
