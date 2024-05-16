<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/productosCreate', [ProductoController::class,'store'])->name('productos.store');
Route::get('/productos', [ProductoController::class,'index'])->name('productos.index');



Route::get('/', function () {
    return view('welcome');
});

Route::post('/checkout', [\App\Http\Controllers\StripeController::class,'newOrder'])->name('checkout');
Route::post('/create-order', [\App\Http\Controllers\StripeController::class,'createOrder'])->name('create.order');
