<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Address;
use App\Models\Shop\Cart;
use App\Models\Shop\Order;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index()
    {
        return Inertia::render('Playground/Shop/Profile', [
            'cart' => Cart::query()->select('id','user_id')->withCount(['items'])->first(),
            'addresses' => Address::query()->get(),
        ]);
    }
}
