<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\OrderItemsRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\ShipRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Exception;
use Faker\Core\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                                , OrderItemsRepositoryInterface $orderItemsRepository) {
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
        $orders = $this->orderRepository->paginate();
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
            'total_price' => ['required', 'regex:/^\d+(\.\d{1,10})?$/'],
            'qty.*' => 'required|numeric|min:1',
        ], [
            'qty.*.required' => 'The quantity field is required.',
            'qty.*.min' => 'The quantity field must be at least 1.'
        ]);
        DB::beginTransaction();
        try {
            $order = $this->orderRepository->create([
                'total_price' => $request->total_price,
                'user_id' => $request->user_id,
                'status' => '1',
                'ship_id' => $request->ship_id,
                'payment_id' => $request->payment_id,
                'payment_mode' => '1',
            ]);

            $product_ids = $request->product_id;
            $qtys = $request->qty;
            foreach ($product_ids as $key => $product_id) {
                $pro = $this->productRepository->find($product_id);
                if ($pro->qty < $qtys[$key]) {
                    DB::rollBack();
                    return redirect()->back()->withErrors(['qty.*.max' => 'Quantity must be less than or equal to remain']);
                }

                $this->orderItemsRepository->create([
                    'order_id' => $order->id,
                    'product_id' => $product_id,
                    'qty' => $qtys[$key]
                ]);

                $this->productRepository->update([
                    'qty' => $pro->qty - $qtys[$key]
                ], $product_id);
            }
            DB::commit();
            $orders = $this->orderItemsRepository->paginate();
            return to_route('orders.index', [
                'page' => $orders->lastPage()
            ])->with('success', 'Add Order successful!');
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
        DB::beginTransaction();
        try {
            $order = $this->orderRepository->update([
                'user_id' => $request->user_id,
                'ship_id' => $request->ship_id,
                'payment_id' => $request->payment_id,
            ], $id);

            DB::commit();
            return to_route('orders.edit', [
                'order' => $order->id
            ])->with('success', 'Update Order successful!');
        } catch (\Exception $e) {
            DB::rollBack();
            abort(404);
        }
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
        ])->with('success', 'Delete Successful');
    }

    public function changeStatus($id, $status)
    {
        DB::beginTransaction();
        try {
            $order = $this->orderRepository->update([
                'status' => $status
            ], $id);
            
            if ($status == '5') {
                $ois = $this->orderItemsRepository->findWhere([
                    'order_id' => $id
                ]);
                foreach ($ois as $oi) {
                    $pro = $this->productRepository->find($oi->product_id);
                    $this->productRepository->update([
                        'qty' => $pro->qty + $oi->qty
                    ], $oi->product_id);                        
                }

                DB::commit();
                return to_route('orders.index', [
                    'order' => $order->id
                ])->with('success', 'Cancel Order successful!');
            }

            DB::commit();
            return to_route('orders.edit', [
                'order' => $order->id
            ])->with('success', 'Update Order successful!');
        } catch (\Exception $e) {
            DB::rollBack();
            abort(404);
        }
    }

    public function changePayment($id, $mode)
    {
        DB::beginTransaction();
        try {
            $order = $this->orderRepository->update([
                'payment_mode' => $mode
            ], $id);
            

            DB::commit();
            return to_route('orders.edit', [
                'order' => $order->id
            ])->with('success', 'Update Order successful!');
        } catch (\Exception $e) {
            DB::rollBack();
            abort(404);
        }
    }
}
