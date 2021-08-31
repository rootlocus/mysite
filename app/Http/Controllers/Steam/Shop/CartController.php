<?php

namespace App\Http\Controllers\Steam\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Cart;
use App\Models\Shop\CartItem;
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
        $item = CartItem::firstOrNew([
            'cart_id' => $cart->id,
            'product_id' => data_get($request->product, 'id'),
        ],
        [
            'price' => data_get($request->product, 'price'),
            'quantity' => 0,
        ]);
        $item->save();

        $quantity = $request->quantity ?? ($request->type == 'add' ? $item->quantity + 1 : $item->quantity - 1);

        $quantity <= 0 ? $item->delete() : $item->update(['quantity' => $quantity]);

        return redirect()->route('playground.shop.product.show', data_get($request->product, 'id')); 
    }

}
