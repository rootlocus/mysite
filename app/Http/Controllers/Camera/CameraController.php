<?php

namespace App\Http\Controllers\Camera;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CameraController extends Controller
{
    public function index(Request $request)
    {

        return Inertia::render('Playground/Camera/Index', [
        ]);
    }

}
