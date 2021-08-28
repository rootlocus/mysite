<?php

namespace App\Http\Controllers\Steam;

use App\Actions\Steam\GetSailData;
use App\Actions\Steam\GetUserData;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SteamController extends Controller
{
    public function index()
    {
        return Inertia::render('Playground/Steam', [
            'userData' => GetUserData::run(),
            'gameData' => GetSailData::run()
        ]);
    }

    public function submit(Request $request)
    {
        dd($request->steamid);
        return Redirect::route('playground.steam.index');
    }
}
