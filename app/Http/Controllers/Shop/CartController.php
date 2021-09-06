<?php

namespace App\Http\Controllers\Shop;

use App\Actions\Shop\UpdateCartQuantity;
use App\Http\Controllers\Controller;
use App\Models\Shop\Address;
use App\Models\Shop\Cart;
use App\Models\Shop\CartItem;
use App\Models\Shop\Order;
use App\Models\Shop\Product;
use App\Models\Shop\Status;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Throwable;

class CartController extends Controller
{
    public function index(Request $request)
    {
        // if cart no address
        $cart = Cart::query()->first();
        if ($cart->address_id === null) {
            $cart->update([
                'address_id' => Address::query()->where('is_default', true)->value('id')
            ]);
        }

        return Inertia::render('Playground/Shop/Cart', [
            'cart' => Cart::query()->with(['items.product'])->withCount(['items'])->first(),
            'addresses' => Address::query()->get(),
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
        
        return redirect()->route('playground.shop.cart.index', data_get($request->product, 'id'));
    }

    public function updateAddress(Request $request, Cart $cart)
    {
        $cart->update([
            'address_id' => $request->address_id
        ]);

        return redirect()->route('playground.shop.cart.index');
    }

    public function destroy(Request $request, Cart $cart, Product $product)
    {
        $cart->items()->where('product_id', $product->id)->delete();

        return redirect()->route('playground.shop.cart.index', data_get($request->product, 'id'));
    }

    public function clearAll(Request $request, Cart $cart)
    {
        $cart->items()->delete();

        return redirect()->route('playground.shop.cart.index', data_get($request->product, 'id'));
    }

    public function checkout(Request $request, Cart $cart)
    {
        // basic status processing -> delivering -> delivered
        try {
            $order = Order::create([
                'cart_id' => $cart->id,
                'user_id' => $cart->user_id,
                'address_id' => $cart->address_id,
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
