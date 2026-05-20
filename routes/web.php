<?php

use Illuminate\Support\Facades\Route;
use App\Models\Coche;
use App\Http\Controllers\CocheController;
use App\Http\Controllers\RedsysController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\PasswordController;

Route::get('/', [CocheController::class, 'index'])->name('welcome');

Route::get('/coches/{coche}', function (Coche $coche) {
    return view('vercoche', compact('coche'));
})->name('coches.show');

Route::get('/sobre-nosotros', function () {
    return view('components.sobre-nosotros');
})->name('sobre-nosotros');

Route::get('/reservar-cita', function () {
    return view('reservar-cita');
})->name('reservar-cita');

Route::get('/comprar-coche', function () {
    return view('comprar-coche');
})->name('comprar-coche');

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/perfil', function () {
        return view('auth.profile');
    })->name('mi.perfil');

    Route::get('/configuracion', function () {
        return view('auth.settings');
    })->name('mi.configuracion');

    Route::put('/configuracion/perfil', [ProfileController::class, 'update'])->name('mi.perfil.update');
    Route::put('/configuracion/password', [PasswordController::class, 'updatePassword'])->name('mi.password.update');
});

Route::controller(RedsysController::class)->prefix('redsys')
    ->group(function () {
        Route::get('/', 'index');
    });
