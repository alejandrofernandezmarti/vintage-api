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

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::delete('/users/{user}', [UserController::class, 'destroy']);

// Rutas para el controlador MarcaController
Route::get('/marcas', [MarcaController::class, 'index']);
Route::post('/marcas', [MarcaController::class, 'store']);
Route::get('/marcas/{marca}', [MarcaController::class, 'show']);
Route::put('/marcas/{marca}', [MarcaController::class, 'update']);
Route::delete('/marcas/{marca}', [MarcaController::class, 'destroy']);

// Rutas para el controlador TallaController
Route::get('/tallas', [TallasController::class, 'index']);
Route::post('/tallas', [TallasController::class, 'store']);
Route::get('/tallas/{talla}', [TallasController::class, 'show']);
Route::put('/tallas/{talla}', [TallasController::class, 'update']);
Route::delete('/tallas/{talla}', [TallasController::class, 'destroy']);

// Rutas para el controlador ImagenController
Route::get('/imagenes', [ImagenController::class, 'index']);
Route::post('/imagenes', [ImagenController::class, 'store']);
Route::get('/imagenes/{imagen}', [ImagenController::class, 'show']);
Route::put('/imagenes/{imagen}', [ImagenController::class, 'update']);
Route::delete('/imagenes/{imagen}', [ImagenController::class, 'destroy']);

// Rutas para el controlador MedidaController
Route::get('/medidas', [MedidaController::class, 'index']);
Route::post('/medidas', [MedidaController::class, 'store']);
Route::get('/medidas/{medida}', [MedidaController::class, 'show']);
Route::put('/medidas/{medida}', [MedidaController::class, 'update']);
Route::delete('/medidas/{medida}', [MedidaController::class, 'destroy']);

// Rutas para el controlador CategoriaController
Route::get('/categorias', [CategoriaController::class, 'index']);
Route::post('/categorias', [CategoriaController::class, 'store']);
Route::get('/categorias/{categoria}', [CategoriaController::class, 'show']);
Route::put('/categorias/{categoria}', [CategoriaController::class, 'update']);
Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy']);

// Rutas para el controlador CompraController
Route::get('/compras', [CompraController::class, 'index']);
Route::post('/compras', [CompraController::class, 'store']);
Route::get('/compras/{compra}', [CompraController::class, 'show']);
Route::put('/compras/{compra}', [CompraController::class, 'update']);
Route::delete('/compras/{compra}', [CompraController::class, 'destroy']);

// Rutas para el controlador ProductoController
Route::get('/productos', [ProductoController::class, 'index']);
Route::post('/productos', [ProductoController::class, 'store']);
Route::get('/productos/{producto}', [ProductoController::class, 'show']);
Route::put('/productos/{producto}', [ProductoController::class, 'update']);
Route::delete('/productos/{producto}', [ProductoController::class, 'destroy']);

// Rutas para el controlador ProductosCompraController
Route::get('/compras/{id_compra}/productos', [ProductosCompraController::class, 'index']);
Route::post('/compras/{id_compra}/productos', [ProductosCompraController::class, 'store']);
Route::get('/compras/{id_compra}/productos/{id_producto}', [ProductosCompraController::class, 'show']);
Route::delete('/compras/{id_compra}/productos/{id_producto}', [ProductosCompraController::class, 'destroy']);
