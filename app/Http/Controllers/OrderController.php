<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\ShipRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\OrderItemsRepository;
use DB;
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
        DB::beginTransaction();
        try {
            $order = $this->orderRepository->create([
                'total_price' => $request->total_price,
                'user_id' => $request->user_id,
                'status' => $request->status,
                'ship_id' => $request->ship_id,
                'ship_mode' => 1,
                'payment_id' => $request->payment_id,
                'payment_mode' => 1,
            ]);
    
            $product_ids = $request->product_id;
            $qtys = $request->qty;
            foreach ($product_ids as $key => $product_id) {
                $this->orderItemsRepository->create([
                    'order_id' => $order->id,
                    'product_id' => $product_id,
                    'qty' => $qtys[$key]
                ]);
    
                if ($request->status >= 3) {
                    $pro = $this->productRepository->find($product_id);
                    $this->productRepository->update([
                        'qty' => $pro->qty - $qtys[$key]
                    ], $product_id);
                }
            }
            DB::commit();
            $orders = $this->orderItemsRepository->paginate(10);
            return to_route('orders.index', [
                'success' => 'Add Order successful!',
                'page' => $orders->lastPage()
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            abort(404);
        }                
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
        $products = $this->productRepository->all();
        $order = $this->orderRepository->find($id);
        $users = $this->userRepository->all();
        $payments = $this->paymentRepository->all();
        $ships = $this->shipRepository->all();
        return view('orders.edit', [
            'products' => $products,
            'order' => $order,
            'users' => $users,
            'payments' => $payments,
            'ships' => $ships,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->status >= 3) {
            return redirect()->back()->with('error', 'Can\'t update!!');
        }

        $request->validate([
            'total_price' => ['required', 'regex:/^\d+(\.\d{1,10})?$/']
        ]);

        $order = $this->orderRepository->update([
            'total_price' => $request->total_price,
            'user_id' => $request->user_id,
            'status' => $request->status,
            'ship_id' => $request->ship_id,
            'ship_mode' => 1,
            'payment_id' => $request->payment_id,
            'payment_mode' => 1,
        ], $id);


        $old_order_items = $this->orderItemsRepository->where('order_id','=', $order->id);
        $old_order_items->delete();

        $product_ids = $request->product_id;
        $qtys = $request->qty;
        foreach ($product_ids as $key => $product_id) {
            $this->orderItemsRepository->create([
                'order_id' => $order->id,
                'product_id' => $product_id,
                'qty' => $qtys[$key]
            ]);

            if ($request->status >= 3) {
                $pro = $this->productRepository->find($product_id);
                $this->productRepository->update([
                    'qty' => $pro->qty - $qtys[$key]
                ], $product_id);
            }
        }
        
        return to_route('orders.edit', [
            'success' => 'Update Order successful!',
            'order' => $order->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $old_order_items = $this->orderItemsRepository->where('order_id','=', $id);
        $old_order_items->delete();
        $this->orderRepository->delete($id);
        return to_route('orders.index', [
            'page' => $request->page,
            'success' => 'Delete Successful'
        ]);
    }
}
