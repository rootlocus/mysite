<?php

namespace App\Http\Controllers\Steam;

use App\Actions\Steam\GetGameData;
use App\Actions\Steam\GetUserData;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SteamController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Playground/Steam/Index', [
            'userData' => GetUserData::run($request->steamid),
            'gameData' => GetGameData::run($request->steamid)
        ]);
    }

    public function logs(Request $request)
    {
        return Inertia::render('Playground/Steam/Logs');
    }

}
