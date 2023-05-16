<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\ShipRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\OrderItemsRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderRepository;
    private $productRepository;
    private $paymentRepository;
    private $shipRepository;
    private $userRepository;
    private $orderItemsRepository;

    public function __construct(OrderRepositoryInterface $orderRepository
                                , ProductRepositoryInterface $productRepository
                                , PaymentRepositoryInterface $paymentRepository
                                , ShipRepositoryInterface $shipRepository
                                , UserRepositoryInterface $userRepository
                                , OrderItemsRepository $orderItemsRepository) {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
        $this->paymentRepository = $paymentRepository;
        $this->shipRepository = $shipRepository;
        $this->userRepository = $userRepository;
        $this->orderItemsRepository = $orderItemsRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = $this->orderRepository->paginate(10);
        return view('orders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = $this->productRepository->all();
        $users = $this->userRepository->all();
        $payments = $this->paymentRepository->all();
        $ships = $this->shipRepository->all();
        return view('orders.create', [
            'products' => $products,
            'users' => $users,
            'payments' => $payments,
            'ships' => $ships,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'total_price' => ['required', 'regex:/^\d+(\.\d{1,10})?$/']
        ]);

        $order = $this->orderRepository->create([
            'total_price' => $request->total_price,
            'user_id' => $request->user_id,
            'status' => $request->status,
            'ship_id' => $request->ship_id,
            'payment_id' => $request->payment_id
        ]);

        $product_ids = $request->product_id;
        $qtys = $request->qty;
        foreach ($product_ids as $key => $product_id) {
            $this->orderItemsRepository->create([
                'order_id' => $order->id,
                'product_id' => $product_id,
                'qty' => $qtys[$key]
            ]);

            $pro = $this->productRepository->find($product_id);
            $this->productRepository->update([
                'qty' => $pro->qty - $qtys[$key]
            ], $product_id);
        }

        $orders = $this->orderItemsRepository->paginate(10);
        return to_route('orders.index', [
            'success' => 'Add Order successful!',
            'page' => $orders->lastPage()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
