<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\API\CompraController;
use App\Http\Controllers\API\ProductoController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/checkout', [\App\Http\Controllers\StripeController::class,'newOrder'])->name('checkout');
Route::post('/create-order', [\App\Http\Controllers\StripeController::class,'createOrder'])->name('create.order');

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/products/create', [ProductoController::class, 'create'])->name('admin.products.create');
    Route::get('/admin/products', [AdminController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/orders', [AdminController::class, 'adminCompras'])->name('admin.orders.index');
    Route::get('/admin/ordersHistory', [AdminController::class, 'orderHistory'])->name('admin.orders.history');
    Route::get('/admin/newOrders', [AdminController::class, 'newOrders'])->name('admin.orders.news');
    Route::get('/admin/orders/{id}', [AdminController::class, 'orderDetail'])->name('admin.orderDetail');
    Route::post('/admin/orders/{id}/update-status', [CompraController::class, 'updateStatus']);
    Route::get('/admin/productos', [AdminController::class, 'productos'])->name('admin.productos.index');
    Route::get('/admin/productos/{id}', [ProductoController::class, 'showAdmin'])->name('admin.productos.show');
    Route::put('/admin/productos/{id}', [ProductoController::class, 'update'])->name('admin.productos.update');
    Route::get('/products/create', [ProductoController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductoController::class, 'store'])->name('products.store');
});

Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
