<?php

use App\Http\Controllers\Auth\LoginRegisterController;
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

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::resources([
    'users' => UserController::class,
    'products' => ProductController::class,
    'categories' => CategoryController::class,
    'ships' => ShipController::class,
    'payments' => PaymentController::class,
    'orders' => OrderController::class,
], [
    'middleware' => 'auth'
]);

Route::group([
    'prefix' => 'orders',
    'as' => 'orders.',
    'controller' => OrderController::class,
    'middleware' => 'auth'
], function() {
    Route::put('{id}/{status}/change-status', 'changeStatus')->name('changeStatus');
    Route::put('{id}/{mode}/change-payment', 'changePayment')->name('changePayment');
});

Route::group([
    'controller' => LoginRegisterController::class
], function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
});
