<?php

namespace App\Http\Controllers\Steam;

use App\Actions\Steam\GetGameData;
use App\Actions\Steam\GetUserData;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SteamController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Playground/Steam', [
            'userData' => GetUserData::run($request->steamid),
            'gameData' => GetGameData::run($request->steamid)
        ]);
    }

    public function submit(Request $request)
    {
        dd($request->steamid);

        return Redirect::route('playground.steam.index');
    }
}
