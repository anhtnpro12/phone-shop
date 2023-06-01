<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Repositories\Contracts\OrderItemsRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Auth;
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
        if(Auth::user()->role_as === 1) {
            $orderNum = $this->orderRepository->all()->count();
            $revenue = $this->orderRepository->findWhere([
                'status' => 4
            ])->sum('total_price');            
        } else {
            $orderNum = $this->orderRepository->findWhere([
                'user_id' => Auth::id(),                
            ])->count();
            $revenue = $this->orderRepository->findWhere([
                'user_id' => Auth::id(),
                'payment_mode' => 2
            ])->sum('total_price');    
        }
        $products_paid = $this->orderItemsRepository->all()->sum('qty');
        $orderNums = [];
        $revenues = [];
        for ($i=1; $i < 13; $i++) {
            $from = date('Y-m-d H:i:s', mktime(0,0,0,$i, 1, date('Y')));
            $to = date('Y-m-d H:i:s', mktime(0,0,0,$i+1, 1, date('Y')));
            if(Auth::user()->role_as === 1) {
                $orderNums[] = $this->orderRepository->findWhere([
                    ['updated_at', 'DATE >=', $from],
                    ['updated_at', 'DATE <', $to],                    
                ])->count();
    
                $revenues[] = $this->orderRepository->findWhere([
                    ['updated_at', 'DATE >=', $from],
                    ['updated_at', 'DATE <', $to],
                    'status' => 4
                ])->sum('total_price');
            } else {
                $orderNums[] = $this->orderRepository->findWhere([
                    ['updated_at', 'DATE >=', $from],
                    ['updated_at', 'DATE <', $to],
                    'user_id' => Auth::id(),                    
                ])->count();
    
                $revenues[] = $this->orderRepository->findWhere([
                    ['updated_at', 'DATE >=', $from],
                    ['updated_at', 'DATE <', $to],
                    'user_id' => Auth::id(),
                    'payment_mode' => 2
                ])->sum('total_price');
            }
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
