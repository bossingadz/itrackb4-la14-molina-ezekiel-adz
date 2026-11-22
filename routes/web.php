<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MonsterHunterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;


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

Route::resource('monsterhunters', MonsterHunterController::class)
->middlewareFor(['create', 'store', 'edit', 'update', 'destroy'], 'auth');

Route::get('/register',  [RegisterController::class, 'create'])
->name('register');

Route::post('/register', [RegisterController::class, 'store'])
->name('register.store');

Route::get('/login',   [LoginController::class, 'create'])
->name('login');

Route::post('/login',  [LoginController::class, 'store'])
->name('login.store');

Route::post('/logout', [LoginController::class, 'destroy'])
->name('logout');

