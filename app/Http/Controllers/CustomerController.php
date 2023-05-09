<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function list(): View
    {
        return view('customers.index');
    }
}
?>
