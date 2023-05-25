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
                <select id="user_id" name="user_id" class="selectpicker"
                        data-live-search="true" data-width="100%"
                        data-style="border" data-size="5">

                    @foreach ($users as $u)
                        <option value='{{ $u->id }}'
                            data-content='<div>
                                            <h6>{{ $u->name }}</h6>
                                            <div><small>{{ $u->phone }}</small></div>
                                            <small>{{ $u->address }}</small>
                                        </div>' {{ $order->user->id === $u->id?'selected':'' }}></option>
                    @endforeach
                    </select>
                </div>
            <div class="mb-3">
                <label for="ship_id" class="form-label">Shipping Method</label>
                <select id="ship_id" name="ship_id" class="selectpicker"
                        data-live-search="true" data-width="100%"
                        data-style="border" data-size="5">
                    @foreach ($ships as $s)
                        <option value='{{ $s->id }}' {{ $order->ship->id === $s->id?'selected':'' }}>{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="payment_id" class="form-label">Payment Method</label>
                <select id="payment_id" name="payment_id" class="selectpicker"
                        data-live-search="true" data-width="100%"
                        data-style="border" data-size="5">

                    @foreach ($payments as $p)
                        <option value='{{ $p->id }}' {{ $order->payment->id === $p->id?'selected':'' }}>{{ $p->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex justify-content-end">
                <input type="submit" name="submit" value="Update now" class="btn btn-primary">
            </div>

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
                        <span class="badge bg-success">Complete</span>
                        @break
                    @default
                        <span class="badge bg-warning">Complete</span>
                @endswitch
            </div>
            <div class="mb-3">
                <label for="payment_mode" class="form-label">Payment: </label>
                {!! $order->payment_mode==1?'<span class="badge bg-secondary">Unpaid</span>':'' !!}
                {!! $order->payment_mode==2?'<span class="badge bg-success">Paid</span>':'' !!}
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
                            <th scope="row">{{ $index+1 }}</th>
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
                            <td>${{ number_format($oi->qty*$oi->product->original_price, 2, '.', ',') }}</td>
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
        <div class="w-50 d-flex justify-content-start">
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back</a>
            <form action="{{ route('orders.changeStatus', [2, 3]) }}" method="post">
                @method('put')
                @csrf
                <button class="btn btn-primary ms-1">test</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    @if($errors->any())
        <script>
            showErrorToast('Edit Order failed!!' + '{{ $errors->first('error') }}');
        </script>
    @endif
    @if(session('success') && !$errors->any())
        <script>
            showSuccessToast('{{ session('success') }}');
        </script>
    @endif
    @if(session('error'))
        <script>
            showErrorToast('{{ session('error') }}');
        </script>
    @endif
@endsection
