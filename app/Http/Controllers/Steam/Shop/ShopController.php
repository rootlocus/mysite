<?php

namespace App\Http\Controllers\Steam\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Cart;
use App\Models\Shop\Category;
use App\Models\Shop\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        //TODO change when add user
        Cart::query()->get()->isEmpty() && Cart::create([]);

        return Inertia::render('Playground/Shop/Index', [
            'products' => Product::query()
                ->when($request->search, function($query) use ($request) {
                    $query->where('name', 'LIKE', '%'. $request->search . '%');
                })
                ->when(!empty($request->categories), function($query) use($request) {
                    $query->whereHas('category', function($query) use($request) {
                        $query->whereIn('name', $request->categories);
                    });
                })
                ->when($request->minPrice || $request->maxPrice, function($query) use($request) {
                    $query
                        ->when($request->maxPrice, function($query) use($request) {
                            $query->where('price', '<=', $request->maxPrice);
                        })
                        ->when($request->minPrice, function($query) use($request) {
                            $query->where('price', '>=', $request->minPrice);
                        });
                })
                ->paginate(20)
                ->withQueryString(),
            'categories' => Category::query()->get(),
            'cart' => Cart::query()->withCount(['items'])->first(),
            'filters' => [
                'search' => $request->search ?? null,
                'categories' => !empty($request->categories) ? $request->categories : [],
                'minPrice' => $request->minPrice ?? null,
                'maxPrice' => $request->maxPrice ?? null,
            ]
        ]);
    }

}
