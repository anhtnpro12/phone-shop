@extends('layouts.default')

@section('styles')

@endsection

@section('contents')

    {{-- @if ($errors->any())
        {{ dd($errors->get('qty.*')) }}
    @endif --}}

    <div class="container mt-5 mb-5 d-flex justify-content-center">
        <form action="{{ route('orders.store') }}" method="post" style="width: 50%;">
            <h3 class="text-center">Add Order</h3>

            @method('post')
            @csrf
            <div class="container mb-3 d-flex flex-wrap">
                <hr style="width: 100%;"/>
                <div class="wrapper flex-fill">
                    <div class="mb-3">
                        <label for="product_id0" class="form-label">Product Name</label>
                        <select id="product_id0" name="product_id[]" class="selectpicker"
                                data-live-search="true" data-width="100%"
                                onchange="changeSelect(this); changeAmount(); 
                                        changeMaxQuantity(this.id.substr(10), this.selectedOptions[0].dataset.quantity);"
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
                        <label for="qty0" class="form-label">Quantity <span class="text-danger">*</span></label>
                        <input onchange="changeAmount();" type="number" value="1" name="qty[]" class="form-control @if ($errors->has('qty.*')) is-invalid @endif" id="qty0">
                        @foreach ($errors->get('qty.*') as $message)
                            <span class="d-block small text-danger">{{ $message[0] }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="flex-fill d-flex justify-content-end align-items-center">
                    <button class="btn btn-danger" onclick="deleteSelect(this.parentNode.parentNode.querySelector('select'));
                            this.parentNode.parentNode.remove(); changeAmount();">Remove</button>
                </div>
            </div>
            <div id="add-product-container" class="container mb-3 d-flex">
                <button id="add-product-btn" class="btn btn-success" type="button" onclick="addProduct(); changeAmount();">Add Product</button>
            </div>
            <hr>
            <div class="mb-3">
                <label for="total_price" class="form-label">Total <span class="text-danger">*</span></label>
                <input type="text" name="total_price" @foreach ($products as $p)
                        @if ($p->qty > 0)
                            value={{ $p->original_price }}
                            @break
                        @endif
                    @endforeach class="form-control @if ($errors->has('total_price')) is-invalid @endif" id="total_price">
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
                                        </div>' ></option>
                    @endforeach
                    </select>
                </div>
            {{-- <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="selectpicker"
                        data-live-search="true" data-width="100%"
                        data-style="border" data-size="5">
                    <option value="1" data-content='<span class="badge bg-secondary">Unconfirmed</span>'>Unconfirmed</option>
                    <option value="2" data-content='<span class="badge bg-primary">Confirmed</span>' selected>Confirmed</option>
                    <option value="3" data-content='<span class="badge bg-success">Complete</span>'>Complete</option>
                </select>
            </div> --}}
            <div class="mb-3">
                <label for="ship_id" class="form-label">Shipping Method</label>
                <select id="ship_id" name="ship_id" class="selectpicker"
                        data-live-search="true" data-width="100%"
                        data-style="border" data-size="5">
                    @foreach ($ships as $s)
                        <option value='{{ $s->id }}'>{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="payment_id" class="form-label">Payment Method</label>
                <select id="payment_id" name="payment_id" class="selectpicker"
                        data-live-search="true" data-width="100%"
                        data-style="border" data-size="5">

                    @foreach ($payments as $p)
                        <option value='{{ $p->id }}'>{{ $p->name }}</option>
                    @endforeach
                </select>
            </div>

            <input type="submit" name="submit" value="Add now" class="btn btn-primary">
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection

@section('scripts')
    <script>

        let addProductContainer = $('#add-product-container')[0];
        let amountInput = $('#total_price')[0];
        let count = 0;
        let map = new Map();
        let selects = $('select[name="product_id[]"]');
        let preValues = [];
        for (const select of selects) {
            map.set(select.value, count+'');    
            preValues.push(select.value);
        }

        function addProduct() {
            selects = $('select[name="product_id[]"]');
            if (selects.length > 0) {
                let flag = true;            
                for (const option of selects[selects.length-1]) {                    
                    if (option.hasAttribute('disabled') == false && option != selects[selects.length-1].selectedOptions[0]) {
                        flag = false;
                        break;
                    }
                }
                if (flag) {
                    showErrorToast('Add product failed. out of product');
                    return;
                }
            }

            count++;
            addProductContainer.insertAdjacentHTML('beforebegin',
            `<div class="container mb-3 d-flex flex-wrap">
                <hr style="width: 100%;"/>
                <div class="wrapper flex-fill">
                    <div class="mb-3">
                        <label for="product_id${count}" class="form-label">Product Name</label>
                        <select id="product_id${count}" name="product_id[]" class="selectpicker"
                                data-live-search="true" data-width="100%"
                                onchange="changeSelect(this); changeAmount(); 
                                        changeMaxQuantity(this.id.substr(10), this.selectedOptions[0].dataset.quantity);"
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
                        <label for="qty${count}" class="form-label">Quantity <span class="text-danger">*</span></label>
                        <input onchange="changeAmount();" type="number" value="1"  name="qty[]" class="form-control" id="qty${count}">
                    </div>
                </div>
                <div class="flex-fill d-flex justify-content-end align-items-center">
                    <button class="btn btn-danger" onclick="deleteSelect(this.parentNode.parentNode.querySelector('select'));
                            this.parentNode.parentNode.remove(); changeAmount();">Remove</button>
                </div>
            </div>`
            );
            
            let select = $('select[name="product_id[]"]:last')[0];            
            for (const option of select) {
                if (!map.has(option.value) && option.dataset.quantity > 0) {
                    $(option).attr('selected', 'selected');
                    map.set(select.value, count); 
                    preValues.push(select.value); 
                    break;
                }
            }                    

            refreshSelects();            
        }

        function changeSelect(select) {            
            let id = select.id.substr(10);
            
            map.delete(preValues[id]);
            map.set(select.value, id);
            refreshSelects();            

            preValues[id] = select.value;            
        }

        function deleteSelect(select) {
            console.log(select);
            let id = select.id.substr(10);            
            map.delete(select.value);
            refreshSelects();
        }

        function refreshSelects() {
            selects = $('select[name="product_id[]"]');

            for (const select of selects) {
                for (const option of select) {
                    if (option.value != select.value && map.has(option.value)) {
                        $(option).attr('disabled', 'disabled');
                    } else if (option.dataset.quantity > 0) {
                        $(option).removeAttr('disabled');
                    }
                }
                $(select).selectpicker('destroy');
                $(select).selectpicker('render'); 
            }
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
            showErrorToast('Create Order failed!! ' + '{{ $errors->first('error') }}');
        </script>
    @endif
    @if(session('success') && !$errors->any())
        <script>
            showSuccessToast('{{ session('success') }}');
        </script>
    @endif
@endsection
