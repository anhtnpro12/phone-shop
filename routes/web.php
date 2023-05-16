<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resources([
    'users' => UserController::class,
    'products' => ProductController::class,
    'categories' => CategoryController::class,
    'ships' => ShipController::class,
    'payments' => PaymentController::class,
]);

Route::prefix('order')->group(function () {
    Route::get('/list', [OrderController::class, 'list'])->name('order.list');
    Route::get('/create', [OrderController::class, 'create'])->name('order.create');
    Route::get('/edit', [OrderController::class, 'edit'])->name('order.edit');
});
