<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index(): View
    {
        $orderNum = $this->orderRepository->all()->count();

        return view('home.index', compact('orderNum'));
    }
}
