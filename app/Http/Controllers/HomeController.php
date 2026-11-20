<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Platform;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'gameCount' => Game::count(),
            'platformCount' => Platform::count(),
        ]);
    }
}
