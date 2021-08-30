<?php

namespace App\Http\Controllers\Steam;

use App\Http\Controllers\Controller;
use App\Models\Shop\Category;
use App\Models\Shop\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Playground/Shop', [
            'products' => Product::query()
                ->when($request->search, function($query) use ($request) {
                    $query->where('name', 'LIKE', '%'. $request->search . '%');
                })
                ->when($request->category, function($query) use($request) {
                    $query->whereHas('category', function($query) use($request) {
                        $query->where('name', 'LIKE', '%' . $request->category . '%');
                    });
                })
                ->paginate(20),
            'categories' => Category::query()->get(),
            'filters' => [
                'search' => $request->search ?? null,
                'category' => $request->category ?? null
            ]
        ]);
    }

}
