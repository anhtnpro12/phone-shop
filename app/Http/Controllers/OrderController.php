<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function list(): View
    {
        return view('orders.index');
    }

    public function create(): View
    {
        return view('orders.create');
    }

    public function edit(): View
    {
        return view('orders.edit');
    }
}
