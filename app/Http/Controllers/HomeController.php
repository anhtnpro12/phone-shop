<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Repositories\Contracts\OrderItemsRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    private $orderRepository;
    private $orderItemsRepository;

    public function __construct(OrderRepositoryInterface $orderRepository
                                , OrderItemsRepositoryInterface $orderItemsRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderItemsRepository = $orderItemsRepository;
    }

    public function index(): View
    {
        $orderNum = $this->orderRepository->all()->count();
        $revenue = $this->orderRepository->all()->sum('total_price');
        $products_paid = $this->orderItemsRepository->all()->sum('qty');
        $orderNums = [];
        $revenues = [];
        for ($i=1; $i < 13; $i++) {
            $from = date('Y-m-d H:i:s', mktime(0,0,0,$i, 1, date('Y')));
            $to = date('Y-m-d H:i:s', mktime(0,0,0,$i+1, 1, date('Y')));
            $orderNums[] = $this->orderRepository->findWhere([
                ['updated_at', 'DATE >=', $from],
                ['updated_at', 'DATE <', $to],
            ])->count();

            $revenues[] = $this->orderRepository->findWhere([
                ['updated_at', 'DATE >=', $from],
                ['updated_at', 'DATE <', $to],
            ])->sum('total_price');
        }
        return view('home.index', compact(
            'orderNum',
            'revenue',
            'products_paid',
            'orderNums',
            'revenues'
        ));
    }
}
