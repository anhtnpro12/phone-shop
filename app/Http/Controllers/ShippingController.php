<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ShippingController extends Controller
{
    public function list(): View
    {
        return view('shippings.index');
    }

    public function create(): View
    {
        return view('shippings.create');
    }

    public function edit(): View
    {
        return view('shippings.edit');
    }
}
