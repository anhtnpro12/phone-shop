<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShippingController;
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

Route::prefix('customer')->group(function () {
    Route::get('/list', [CustomerController::class, 'list'])->name('customer.list');
    Route::get('/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::get('/edit', [CustomerController::class, 'edit'])->name('customer.edit');    
    
    Route::post('/create', [CustomerController::class, 'store'])->name('customer.store');          
});

Route::prefix('order')->group(function () {
    Route::get('/list', [OrderController::class, 'list'])->name('order.list');
    Route::get('/create', [OrderController::class, 'create'])->name('order.create');
    Route::get('/edit', [OrderController::class, 'edit'])->name('order.edit');                
});

Route::prefix('payment')->group(function () {
    Route::get('/list', [PaymentController::class, 'list'])->name('payment.list');
    Route::get('/create', [PaymentController::class, 'create'])->name('payment.create');
    Route::get('/edit', [PaymentController::class, 'edit'])->name('payment.edit');              
});

Route::prefix('product')->group(function () {
    Route::get('/list', [ProductController::class, 'list'])->name('product.list');
    Route::get('/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/edit', [ProductController::class, 'edit'])->name('product.edit');          
});

Route::prefix('shipping')->group(function () {
    Route::get('/list', [ShippingController::class, 'list'])->name('shipping.list');
    Route::get('/create', [ShippingController::class, 'create'])->name('shipping.create');
    Route::get('/edit', [ShippingController::class, 'edit'])->name('shipping.edit');             
});

