<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function list(): View
    {
        return view('payments.index');
    }

    public function create(): View
    {
        return view('payments.create');
    }

    public function edit(): View
    {
        return view('payments.edit');
    }
}
