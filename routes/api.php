<?php

use App\Http\Controllers\Api\CategoriaController;
use App\Http\Controllers\Api\ProductoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('productos', ProductoController::class);
