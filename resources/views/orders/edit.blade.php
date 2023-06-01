@extends('layouts.default')

@section('styles')
@endsection

@section('contents')

    <div class="container mt-5 mb-5 d-flex flex-column align-items-center">
        <form action="{{ route('orders.update', ['order' => $order->id]) }}" method="post" style="width: 50%;">
            <div class="mb-3">
                <p style="color: #7e8d9f;font-size: 20px;">Invoice &gt;&gt; <strong>ID: {{ $order->uuid }}</strong></p>
            </div>
            {{-- <h3 class="text-center">Order</h3> --}}

            @method('put')
            @csrf
            {{-- <div class="mb-3">
                <label for="total_price" class="form-label">Total Amount</label>
                <input type="text" name="total_price" value="{{ $order->total_price }}"
                        class="form-control @if ($errors->has('total_price')) is-invalid @endif" id="total_price" readonly>
                @foreach ($errors->get('total_price') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div> --}}
            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                @if ($order->status <= 2 && Auth::user()->role_as === 1)
                    <select id="user_id" name="user_id" class="selectpicker" data-live-search="true" data-width="100%"
                        data-style="border" data-size="5">

                        @foreach ($users as $u)
                            <option value='{{ $u->id }}'
                                data-content='<div>
                                                <h6>{{ $u->name }}</h6>
                                                <div><small>{{ $u->phone }}</small></div>
                                                <small>{{ $u->address }}</small>
                                            </div>'
                                {{ $order->user->id === $u->id ? 'selected' : '' }}></option>
                        @endforeach
                    </select>
                @else
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>{{ $order->user->name }}</strong></li>
                        <li class="list-group-item">Phone: {{ $order->user->phone }}</li>
                        <li class="list-group-item">Address: {{ $order->user->address }}</li>
                    </ul>
                @endif
                @if (Auth::user()->role_as === 2)
                    <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                @endif
            </div>
            <div class="mb-3">
                <label for="ship_id" class="form-label">Shipping Method</label>
                @if ($order->status <= 2)
                    <select id="ship_id" name="ship_id" class="selectpicker" data-live-search="true" data-width="100%"
                        data-style="border" data-size="5">
                        @foreach ($ships as $s)
                            <option value='{{ $s->id }}' {{ $order->ship->id === $s->id ? 'selected' : '' }}>
                                {{ $s->name }}</option>
                        @endforeach
                    </select>
                @else
                    <input type="hidden" name="ship_id" value="{{ $order->ship_id }}">
                    <strong>: {{ $order->ship->name }}</strong>
                @endif
            </div>
            <div class="mb-3">
                <label for="payment_id" class="form-label">Payment Method</label>
                @if ($order->payment_mode  == 1 && $order->status <= 2)
                    <select id="payment_id" name="payment_id" class="selectpicker" data-live-search="true" data-width="100%"
                        data-style="border" data-size="5">

                        @foreach ($payments as $p)
                            <option value='{{ $p->id }}' {{ $order->payment->id === $p->id ? 'selected' : '' }}>
                                {{ $p->name }}</option>
                        @endforeach
                    </select>
                @else
                    <input type="hidden" name="payment_id" value="{{ $order->payment_id }}">
                    <strong>: {{ $order->payment->name }}</strong>
                @endif
            </div>
            @if ($order->status <= 2)
                <div class="d-flex justify-content-end">
                    <input type="submit" name="submit" value="Update now" class="btn btn-primary">
                </div>
            @endif

            <div class="mb-3">
                <label for="status" class="form-label">Status: </label>
                @switch($order->status)
                    @case(1)
                        <span class="badge bg-secondary">Unconfirmed</span>
                        @break

                    @case(2)
                        <span class="badge bg-primary">Confirmed</span>
                        @break

                    @case(3)
                        <span class="badge bg-warning">Delivery</span>
                        @break

                    @case(4)
                        <span class="badge bg-success">Complete</span>
                        @break

                    @default
                        <span class="badge bg-danger">Canceled</span>
                @endswitch
            </div>
            <div class="mb-3">
                <label for="payment_mode" class="form-label">Payment: </label>
                {!! $order->payment_mode == 1 ? '<span class="badge bg-secondary">Unpaid</span>' : '' !!}
                {!! $order->payment_mode == 2 ? '<span class="badge bg-success">Paid</span>' : '' !!}
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Products</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->order_items as $index => $oi)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>
                                <div class="row justify-content-center mb-1">
                                    <div class="col-md-5">
                                        <img src="{{ asset('storage/imgs/products/' . $oi->product->id . '/' . $oi->product->image) }}"
                                            class="w-100" style="object-fit:contain" height="100px" alt="image" />
                                    </div>
                                    <div class="col-md-6">
                                        <p class="fw-bold">{{ $oi->product->name }}</p>
                                        <p class="mb-1">
                                            <span
                                                class="text-muted me-2">Category:</span><span>{{ $oi->product->category->name }}</span>
                                        </p>
                                        <p>
                                            <span
                                                class="text-muted me-2">Price:</span><span>${{ number_format($oi->product->original_price, 2, '.', ',') }}</span>
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $oi->qty }}</td>
                            <td>${{ number_format($oi->qty * $oi->product->original_price, 2, '.', ',') }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th scope="row"></th>
                        <td colspan="2"></td>
                        <td><strong>${{ number_format($order->total_price, 2, '.', ',') }}</strong></td>
                    </tr>
                </tbody>
            </table>

        </form>
        <div class="container-fluid w-50">
            <div class="row">
                <div class="col d-flex justify-content-start">
                    @switch($order->status)
                        @case(1)
                            @if (Auth::user()->role_as === 1)
                                <form action="{{ route('orders.changeStatus', [$order->id, 2]) }}" method="post">
                                    @method('put')
                                    @csrf
                                    <button class="btn btn-primary me-1">Confirm</button>
                                </form>
                            @endif
                            @break
                        @case(2)
                            @if (Auth::user()->role_as === 1)
                                <form action="{{ route('orders.changeStatus', [$order->id, 3]) }}" method="post">
                                    @method('put')
                                    @csrf
                                    <button class="btn btn-warning me-1">Delivery</button>
                                </form>
                            @endif
                            @break
                        @case(3)
                            @if ($order->payment_mode == 2 && Auth::user()->role_as === 1)
                                <form action="{{ route('orders.changeStatus', [$order->id, 4]) }}" method="post">
                                    @method('put')
                                    @csrf
                                    <button class="btn btn-success me-1">Complete</button>
                                </form>
                            @endif
                            @break
                        @default

                    @endswitch
                    @if ($order->payment_mode == 1 && $order->status > 1 && $order->status != 5)
                        <form action="{{ route('orders.changePayment', [$order->id, 2]) }}" method="post">
                            @method('put')
                            @csrf
                            <button class="btn btn-success me-1">Pay</button>
                        </form>
                    @endif
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back</a>
                </div>
                @if ($order->status < 2 && Auth::user()->role_as === 1)
                    <div class="col d-flex justify-content-end">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $order->id }}">
                            Cancel
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('modals')
    <div class="modal fade" id="deleteModal{{ $order->id }}" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><i
                            class="bi bi-exclamation-circle-fill text-danger"></i> Warning!!!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to cancel <span class="text-danger">{{ $order->uuid }}</span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <form action="{{ route('orders.changeStatus', [$order->id, 5]) }}" method="post">
                            @method('put')
                            @csrf
                            <button class="btn btn-danger me-1">Cancel</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @if ($errors->any())
        <script>
            showErrorToast('Edit Order failed!!' + '{{ $errors->first('error') }}');
        </script>
    @endif
    @if (session('success') && !$errors->any())
        <script>
            showSuccessToast('{{ session('success') }}');
        </script>
    @endif
    @if (session('error'))
        <script>
            showErrorToast('{{ session('error') }}');
        </script>
    @endif
@endsection
