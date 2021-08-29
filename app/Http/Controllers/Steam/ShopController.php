<?php

namespace App\Http\Controllers\Steam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Playground/Shop', [
        ]);
    }

}
