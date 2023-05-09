<?php

use App\Http\Controllers\CustomerController;
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
    return view('home.index');
})->name('home'); 

Route::prefix('customer')->group(function () {
    Route::get('/list', [CustomerController::class, 'list'])->name('customer.list');

    Route::get('/create', function () {
        return view('customers.create');
    })->name('customer.create');            
    
    Route::get('/edit', function () {
        return view('customers.edit');
    })->name('customer.edit');            
});

Route::prefix('order')->group(function () {
    Route::get('/list', function () {
        return view('orders.index');
    })->name('order.list');

    Route::get('/create', function () {
        return view('orders.create');
    })->name('order.create');            
    
    Route::get('/edit', function () {
        return view('orders.edit');
    })->name('order.edit');            
});

Route::prefix('payment')->group(function () {
    Route::get('/list', function () {
        return view('payments.index');
    })->name('payment.list');

    Route::get('/create', function () {
        return view('payments.create');
    })->name('payment.create');            
    
    Route::get('/edit', function () {
        return view('payments.edit');
    })->name('payment.edit');            
});

Route::prefix('product')->group(function () {
    Route::get('/list', function () {
        return view('products.index');
    })->name('product.list');

    Route::get('/create', function () {
        return view('products.create');
    })->name('product.create');            
    
    Route::get('/edit', function () {
        return view('products.edit');
    })->name('product.edit');            
});

Route::prefix('shipping')->group(function () {
    Route::get('/list', function () {
        return view('shippings.index');
    })->name('shipping.list');

    Route::get('/create', function () {
        return view('shippings.create');
    })->name('shipping.create');            
    
    Route::get('/edit', function () {
        return view('shippings.edit');
    })->name('shipping.edit');            
});

