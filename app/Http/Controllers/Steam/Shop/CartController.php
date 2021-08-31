<?php

namespace App\Http\Controllers\Steam\Shop;

use App\Actions\Shop\UpdateCartQuantity;
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
            'cart' => Cart::query()->with(['items.product'])->withCount(['items'])->first(),
        ]);
    }

    public function update(Request $request, Cart $cart)
    {
        $data = [
            'cart_id' => $cart->id,
            'product_id' => data_get($request->product, 'id'),
            'price' => data_get($request->product, 'price'),
            'type' => $request->type,
            'quantity' => $request->quantity
        ];

        UpdateCartQuantity::run($data);
        
        return redirect()->route('playground.shop.cart', data_get($request->product, 'id'));
    }

    public function destroy(Request $request, Cart $cart, Product $product)
    {
        $cart->items()->where('product_id', $product->id)->delete();

        return redirect()->route('playground.shop.cart', data_get($request->product, 'id'));
    }

    public function clearAll(Request $request, Cart $cart)
    {
        $cart->items()->delete();

        return redirect()->route('playground.shop.cart', data_get($request->product, 'id'));
    }

}
