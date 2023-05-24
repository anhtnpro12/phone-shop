@extends('layouts.default')

@section('styles')

@endsection

@section('contents')

    <div class="container mt-5 mb-5 d-flex justify-content-center">
        <form action="{{ route('orders.update', ['order' => $order->id]) }}" method="post" style="width: 50%;">
            <h3 class="text-center">Update Order</h3>

            @method('put')
            @csrf
            @foreach ($order->order_items as $oi)
                <div class="container mb-3 d-flex flex-wrap">
                    <hr style="width: 100%;"/>
                    <div class="wrapper flex-fill">
                        <div class="mb-3">
                            <label for="product_id1" class="form-label">Product Name</label>
                            <select id="product_id1" name="product_id[]" class="selectpicker"
                                    data-live-search="true" data-width="100%"
                                    onchange="changeAmount(); changeMaxQuantity(this.id.substr(10), this.selectedOptions[0].dataset.quantity);"
                                    data-style="border" data-size="5">
                                    @foreach ($products as $p)
                                        <option data-price='{{ $p->original_price }}' data-quantity='{{ $p->qty }}'
                                        value='{{ $p->id }}'
                                        data-content='<div class="d-flex">
                                                        <div class="">
                                                            <img src="{{ asset('storage/imgs/products/'.$p->id.'/'.$p->image) }}"
                                                                    class="img-fluid" alt="image" style="max-height: 15vh; max-width: 20vh;">
                                                        </div>
                                                        <div class="ps-2">
                                                            <h6>{{ $p->name }}</h6>
                                                            <div>{{ $p->category->name }}</div>
                                                            <small>${{ $p->original_price }}</small>
                                                            <small>Remaining: {{ $p->qty }}</small>
                                                        </div>
                                                    </div>' {{ $p->qty<=0?'disabled':'' }} {{ $p->id === $oi->product->id?'selected':'' }}></option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="qty1" class="form-label">Quantity</label>
                            <input onchange="changeAmount();" type="number" min="1" value="{{ $oi->qty }}"
                                    name="qty[]" class="form-control" id="qty1" readonly>
                            @foreach ($errors->get('qty') as $message)
                                <span class="d-block small text-danger">{{ $message }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex-fill d-flex justify-content-end align-items-center">
                        <button class="btn btn-danger" onclick="this.parentNode.parentNode.remove(); changeAmount();">Remove</button>
                    </div>
                </div>
            @endforeach
            <div id="add-product-container" class="container mb-3 d-flex">
                <button id="add-product-btn" class="btn btn-success" type="button" onclick="addProduct(); changeAmount();">Add Product</button>
            </div>
            <hr>
            <div class="mb-3">
                <label for="total_price" class="form-label">Total</label>
                <input type="text" name="total_price" value="{{ $order->total_price }}" class="form-control @if ($errors->has('total_price')) is-invalid @endif" id="total_price">
                @foreach ($errors->get('total_price') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="user_id" class="form-label">Customer</label>
                <select id="user_id" name="user_id" class="selectpicker"
                        data-live-search="true" data-width="100%"
                        data-style="border" data-size="5">

                    @foreach ($users as $u)
                        <option value='{{ $u->id }}'
                            data-content='<div>
                                            <h6>{{ $u->name }}</h6>
                                            <small>{{ $u->address }}</small>
                                        </div>' {{ $order->user->id === $u->id?'selected':'' }}></option>
                    @endforeach
                    </select>
                </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="selectpicker"
                        data-live-search="true" data-width="100%"
                        data-style="border" data-size="5">
                    <option value="1" {{ $order->status == 1?'selected':'' }} class="@if ($order->status==3 || $order->ship_mode <= 2) d-none @endif" data-content='<span class="badge bg-secondary">Unconfirmed</span>'>Unconfirmed</option>
                    <option value="2" {{ $order->status == 2?'selected':'' }} class="@if ($order->status==3) d-none @endif" data-content='<span class="badge bg-primary">Confirmed</span>'>Confirmed</option>                    
                    <option value="3" {{ $order->status == 3?'selected':'' }} class="@if ($order->status!=3) d-none @endif" data-content='<span class="badge bg-success">Complete</span>'>Complete</option>
                </select>
                @foreach ($errors->get('status') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
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
                <label for="ship_mode" class="form-label">Shipping Mode {{ $order->ship_mode }}</label>
                <select id="ship_mode" name="ship_mode" class="selectpicker"
                        data-live-search="true" data-width="100%"
                        data-style="border" data-size="5">
                        <option value="1" {{ $order->ship_mode==1?'selected':'' }} data-content='<span class="badge bg-success">Shipped</span>'>Shipped</option>
                        <option value="2" {{ $order->ship_mode==2?'selected':'' }} class="@if ($order->ship_mode<2) d-none @endif" data-content='<span class="badge bg-warning">delivery</span>'>delivery</option>
                        <option value="3" {{ $order->ship_mode==3?'selected':'' }} class="@if ($order->ship_mode<3) d-none @endif" data-content='<span class="badge bg-secondary">Not delivery</span>'>Not delivery</option>
                </select>
                @foreach ($errors->get('ship_mode') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
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
            <div class="mb-3">
                <label for="payment_mode" class="form-label">Payment Mode</label>
                <select id="payment_mode" name="payment_mode" class="selectpicker"
                        data-live-search="true" data-width="100%"
                        data-style="border" data-size="5">
                        <option value="1" {{ $order->payment_mode==1?'selected':'' }} data-content='<span class="badge bg-success">Paid</span>'>Paid</option>
                        <option value="2" {{ $order->payment_mode==2?'selected':'' }} class="@if ($order->payment_mode<2) d-none @endif" data-content='<span class="badge bg-secondary">Unpaid</span>'>Unpaid</option>
                </select>
                @foreach ($errors->get('payment_mode') as $message)
                    <span class="d-block small text-danger">{{ $message }}</span>
                @endforeach
            </div>



            <input type="submit" name="submit" value="Update now" class="btn btn-primary">
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection

@section('scripts')
    <script>

        let addProductContainer = $('#add-product-container')[0];
        let amountInput = $('#total_price')[0];
        let count = 1;

        function addProduct() {
            count++;
            addProductContainer.insertAdjacentHTML('beforebegin',
            `<div class="container mb-3 d-flex flex-wrap">
                <hr style="width: 100%;"/>
                <div class="wrapper flex-fill">
                    <div class="mb-3">
                        <label for="product_id${count}" class="form-label">Product Name</label>
                        <select id="product_id${count}" name="product_id[]" class="selectpicker"
                                data-live-search="true" data-width="100%"
                                onchange="changeAmount(); changeMaxQuantity(this.id.substr(10), this.selectedOptions[0].dataset.quantity);"
                                data-style="border" data-size="5">
                                @foreach ($products as $p)
                                    <option data-price='{{ $p->original_price }}' data-quantity='{{ $p->qty }}'
                                    value='{{ $p->id }}'
                                    data-content='<div class="d-flex">
                                                    <div class="">
                                                        <img src="{{ asset('storage/imgs/products/'.$p->id.'/'.$p->image) }}"
                                                                class="img-fluid" alt="image" style="max-height: 15vh; max-width: 20vh;">
                                                    </div>
                                                    <div class="ps-2">
                                                        <h6>{{ $p->name }}</h6>
                                                        <div>{{ $p->category->name }}</div>
                                                        <small>${{ $p->original_price }}</small>
                                                        <small>Remaining: {{ $p->qty }}</small>
                                                    </div>
                                                </div>' {{ $p->qty<=0?'disabled':'' }}></option>
                                @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="qty${count}" class="form-label">Quantity</label>
                        <input onchange="changeAmount();" type="number" min="1" max=@foreach ($products as $p)
                                @if ($p->qty > 0)
                                    {{ $p->qty }}
                                    @break
                                @endif
                            @endforeach value="1"  name="qty[]" class="form-control" id="qty${count}">
                    </div>
                </div>
                <div class="flex-fill d-flex justify-content-end align-items-center">
                    <button class="btn btn-danger" onclick="this.parentNode.parentNode.remove(); changeAmount();">Remove</button>
                </div>
            </div>`
            );
            $(".selectpicker").selectpicker();
        }

        function changeAmount() {
            productSelects = $('select[name="product_id[]"]');
            quantities = $('input[name="qty[]"]');
            sum = 0;
            for (let i = 0; i < productSelects.length; i++) {
                sum += (+productSelects[i].selectedOptions[0].dataset.price) * (+quantities[i].value);
            }
            sum = sum.toFixed(2);
            amountInput.value = sum;
        }

        function changeMaxQuantity(count, value) {
            $('#qty'+count)[0].max = value;
        }

    </script>
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
