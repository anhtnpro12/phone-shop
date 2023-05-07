<?php

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

Route::get('/home', function () {
    return view('home.index');
})->name('home'); 

Route::prefix('customer')->group(function () {
    Route::get('/list', function () {
        return view('customers.index');
    })->name('customer.list');

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