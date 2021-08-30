<?php

namespace App\Http\Controllers\Steam\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function show(Request $request)
    {
        return Inertia::render('Playground/Shop/Show', [
            'product' => Product::query()->with('category:id,name')->where('id', $request->product)->first()
        ]);
    }

}
