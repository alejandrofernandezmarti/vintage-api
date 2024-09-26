<?php

use App\Http\Controllers\API\LoginController;
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
Route::group(["middleware" => 'auth:sanctum'], function () {
    Route::get('/user/compras', [CompraController::class, 'ordersByUser']);
    Route::get('/user/getInfo', [UserController::class, 'getInfo']);
});
Route::post('/login', [LoginController::class, 'login']);
Route::post('/getCarrito',[ProductosCompraController::class,'getCarrito']);

Route::get('/users', [UserController::class, 'index']);
Route::post('/register', [UserController::class, 'store']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::delete('/users/{user}', [UserController::class, 'destroy']);


// Rutas para el controlador ImagenController
Route::get('/imagenes', [ImagenController::class, 'index']);
Route::post('/imagenes', [ImagenController::class, 'store']);
Route::get('/imagenes/{imagen}', [ImagenController::class, 'show']);
Route::put('/imagenes/{imagen}', [ImagenController::class, 'update']);
Route::delete('/imagenes/{imagen}', [ImagenController::class, 'destroy']);


// Rutas para el controlador CategoriaController
Route::get('/categorias', [CategoriaController::class, 'index']);
Route::post('/categorias', [CategoriaController::class, 'store']);
Route::get('/categorias/{categoria}', [CategoriaController::class, 'show']);
Route::put('/categorias/{categoria}', [CategoriaController::class, 'update']);
Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy']);
Route::get('/categoriasEspecificas', [CategoriaController::class, 'obtenerCategoriasEspecificas']);


// Rutas para el controlador CompraController
Route::get('/compras', [CompraController::class, 'index']);
Route::post('/compras', [CompraController::class, 'store']);
Route::get('/compras/{compra}', [CompraController::class, 'show']);
Route::put('/compras/{compra}', [CompraController::class, 'update']);
Route::delete('/compras/{compra}', [CompraController::class, 'destroy']);

// Rutas para el controlador ProductoController
Route::get('/productos', [ProductoController::class, 'index']);
Route::get('/productosSelected', [ProductoController::class, 'indexSelected']);
Route::get('/productosLotes', [ProductoController::class, 'indexLotes']);
Route::post('/productoCreate', [ProductoController::class, 'store']);
Route::get('/productos/{producto}', [ProductoController::class, 'show']);
Route::put('/productos/{producto}', [ProductoController::class, 'update']);
Route::delete('/productos/{producto}', [ProductoController::class, 'destroy']);
Route::post('/productosFiltrados', [ProductoController::class, 'filtrar']);
Route::get('/productosRand', [ProductoController::class, 'obtenerProductosAleatorios']);
Route::get('/selectedRand', [ProductoController::class, 'obtenerSelectedAleatorios']);
Route::get('/productos/categoria/{id}', [ProductoController::class, 'productosPorCategoria']);



// Rutas para el controlador ProductosCompraController
Route::get('/compras/{id_compra}/productos', [ProductosCompraController::class, 'index']);
Route::post('/compras/{id_compra}/productos', [ProductosCompraController::class, 'store']);
Route::get('/compras/{id_compra}/productos/{id_producto}', [ProductosCompraController::class, 'show']);
Route::delete('/compras/{id_compra}/productos/{id_producto}', [ProductosCompraController::class, 'destroy']);
