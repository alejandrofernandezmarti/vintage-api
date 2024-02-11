<?php

use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MarcaController;
use App\Http\Controllers\API\TallasController;
use App\Http\Controllers\API\ImagenController;
use App\Http\Controllers\API\MedidaController;
use App\Http\Controllers\API\CategoriaController;
use App\Http\Controllers\API\CompraController;
use App\Http\Controllers\API\ProductoController;
use App\Http\Controllers\API\ProductosCompraController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('users', UserController::class);

// Rutas para el controlador MarcaController
Route::apiResource('marcas', MarcaController::class);

// Rutas para el controlador TallaController
Route::apiResource('tallas', TallasController::class);

// Rutas para el controlador ImagenController
Route::apiResource('imagenes', ImagenController::class);

// Rutas para el controlador MedidaController
Route::apiResource('medidas', MedidaController::class);

// Rutas para el controlador CategoriaController
Route::apiResource('categorias', CategoriaController::class);

// Rutas para el controlador CompraController
Route::apiResource('compras', CompraController::class);

// Rutas para el controlador ProductoController
Route::apiResource('productos', ProductoController::class);

// Rutas para el controlador ProductosCompraController
Route::apiResource('compras.productos', ProductosCompraController::class)->shallow();
