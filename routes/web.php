<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/perfil', function () {
        return view('perfil');
    })->name('perfil');
});

Route::middleware(['auth', 'verificar.rol:admin', 'registrar.peticion'])->group(function () {
    Route::get('/admin/panel', function () {
        return view('admin.panel');
    })->name('admin.panel');
});

Route::get('/movil', function () {
    return view('movil');
})->name('movil');

Route::middleware('solo.celular')->group(function () {
    Route::get('/ruta-celular-1', function () {
        return 'Ruta solo para celulares 1';
    })->name('ruta-celular-1');

    Route::get('/ruta-celular-2', function () {
        return 'Ruta solo para celulares 2';
    })->name('ruta-celular-2');

    Route::get('/ruta-celular-3', function () {
        return 'Ruta solo para celulares 3';
    })->name('ruta-celular-3');
});

require __DIR__.'/auth.php';
