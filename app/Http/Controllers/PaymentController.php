<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository) {
        $this->paymentRepository = $paymentRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Payment::class);

        $payments = $this->paymentRepository->paginate(10);
        return view('payments.index', [
            'payments' => $payments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Payment::class);

        return view('payments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Payment::class);

        $request->validate([
            'name' => 'required'
        ]);

        $this->paymentRepository->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $payments = $this->paymentRepository->paginate(10);
        return to_route('payments.index', [
            'page' => $payments->lastPage(),
            'success' => 'Create Payment Method Successful'
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
        $this->authorize('update', Payment::class);

        $payment = $this->paymentRepository->find($id);
        return view('payments.edit', ['payment' => $payment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('update', Payment::class);

        $request->validate([
            'name' => 'required',
        ]);

        $this->paymentRepository->update([
            'name' => $request->name,
            'description' => $request->description,
        ], $id);

        return to_route('payments.edit', [
            'payment' => $id,
            'success' => 'Update Payment Method Successful'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $this->authorize('forceDelete', Payment::class);

        $payment = $this->paymentRepository->find($id);

        if($payment->orders->count() > 0) {
            return to_route('payments.index', [
                'page' => $request->page,
            ])->with('error', 'Delete Failed. Have an order using this payment method.');
        }

        $this->paymentRepository->delete($id);
        return to_route('payments.index', [
            'page' => $request->page,
            'success' => 'Delete Successful'
        ]);
    }
}
