<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MonsterHunterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/whoami', function () {
    return 'Ezekiel Adz F. Molina | BSIT 4C';
});

Route::get('/monsterhunters/featured', [MonsterHunterController::class, 'featured'])
    ->name('monsterhunter.featured');

Route::get('/monsterhunters/filter/{value?}', function ($value = null) {
    if ($value) {
        return redirect()->route('monsterhunters.index', ['platform' => $value]);
    }
    return redirect()->route('monsterhunters.index');
});

Route::resource('monsterhunters', MonsterHunterController::class);