<?php

namespace App\Http\Controllers\Steam\Shop;

use App\Actions\Shop\UpdateCartQuantity;
use App\Http\Controllers\Controller;
use App\Models\Shop\Cart;
use App\Models\Shop\CartItem;
use App\Models\Shop\Order;
use App\Models\Shop\OrderItem;
use App\Models\Shop\Product;
use App\Models\Shop\Status;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Throwable;

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

    public function checkout(Request $request, Cart $cart)
    {
        // basic status processing -> delivering -> delivered
        try {
            $order = Order::create([
                'cart_id' => $cart->id,
            ]);
    
            Status::create([
                'name' => 'PROCESSING',
                'status_timestamp_at' => now(),
                'model_type' => Order::class,
                'model_id' => $order->id
            ]);

            $items = CartItem::query()
                ->select('cart_id', 'product_id', 'price', 'quantity', 'image')
                ->where('cart_id', $cart->id)
                ->get()
                ->toArray();
    
            $order->items()->createMany($items);
    
            $cart->delete();
        } catch (Throwable $e) {
            report($e);

            abort(404);
        }

        return redirect()->route('playground.shop.index'); 
    }
}
