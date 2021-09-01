<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Cart;
use App\Models\Shop\Order;
use Inertia\Inertia;

class MyOrderController extends Controller
{
    public function index()
    {
        return Inertia::render('Playground/Shop/MyOrder', [
            'cart' => Cart::query()->select('id','user_id')->withCount(['items'])->first(),
            'orders' => Order::query()->with(['items.product'])->withCount(['items'])->orderByDesc('id')->get(),
        ]);
    }
}
