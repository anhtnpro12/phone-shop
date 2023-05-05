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

Route::prefix('customer')->group(function () {
    Route::get('/list', function () {
        return view('customers.index');
    });
    Route::get('/post', function () {
        return view('customers.index');
    });
    Route::get('/list', function () {
        return view('customers.index');
    });
    Route::get('/list', function () {
        return view('customers.index');
    });    
});
