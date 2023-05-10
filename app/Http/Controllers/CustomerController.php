<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function list(): View
    {
        return view('customers.index');
    }

    public function create(): View
    {
        
        return view('customers.create');
    }

    public function edit(Request $request, $id): View
    {
        return view('customers.edit');
    }

    public function store(Request $request)
    {        
        $data = [
            'name' => $request->get('name') ?? ''
        ];
        dd(User::create($data));
        return view('customers.create');
    }
}

?>
