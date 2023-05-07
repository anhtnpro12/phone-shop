@extends('layouts.default')

@section('order', 'active')

@section('content')

<div class="container mt-5 mb-5 d-flex justify-content-center">    
    <form action="#" method="post" style="width: 50%;">
        <h3 class="text-center">Add Order</h3>    
        
        <div class="container mb-3 d-flex flex-wrap">
            <hr style="width: 100%;"/>
            <div class="wrapper flex-fill">
                <div class="mb-3">
                    <label for="product_id1" class="form-label">Product Name</label>
                    <select id="product_id1" name="product_id[]" class="selectpicker" 
                            data-live-search="true" data-width="100%" 
                            onchange="changeAmount(); changeMaxQuantity(this.id.substr(10), this.selectedOptions[0].dataset.quantity);" 
                            data-style="border" data-size="5">
                            
                            <option data-price='1234' data-quantity='12' 
                                value='1'
                                data-content='<div> 
                                                <h6>Máy Tính</h6>
                                                <small>$ 1200</small>
                                                <small>Remaining: 12</small>
                                            </div>' ></option>
                            <option data-price='1300' data-quantity='12' 
                                value='2'
                                data-content='<div> 
                                                <h6>Macbook</h6>
                                                <small>$ 1300</small>
                                                <small>Remaining: 12</small>
                                            </div>' ></option>
                            <option data-price='1400' data-quantity='$value->quantity' 
                                value='3'
                                data-content='<div> 
                                                <h6>Laptop Razer</h6>
                                                <small>$ 1400</small>
                                                <small>Remaining: 12</small>
                                            </div>' ></option>
                            
                    </select>
                </div>                                 
                <div class="mb-3">
                    <label for="quantity1" class="form-label">Quantity</label>
                    <input onchange="changeAmount();" type="number" min="1" max="12" value="1" name="quantity[]" class="form-control " id="quantity1">
                    <small class="text-danger d-none">Quantity must be an integer greater than 0 and less than the remainder</small>
                </div>                 
            </div>
            <div class="flex-fill d-flex justify-content-end align-items-center">
                <button class="btn btn-danger" onclick="this.parentNode.parentNode.remove(); changeAmount();">Remove</button>
            </div>
        </div>
        <div id="add-product-container" class="container mb-3 d-flex">
            <button id="add-product-btn" class="btn btn-success" type="button" onclick="addProduct(); changeAmount();">Add Product</button>
        </div>
        <hr>
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="text" name="amount" value="1200" class="form-control" id="amount" readonly>
            <small class="text-danger d-none">Amount must be an number</small>
        </div> 
        <div class="mb-3">
            <label for="customer_id" class="form-label">Customer</label>
            <select id="customer_id" name="customer_id" class="selectpicker" 
                    data-live-search="true" data-width="100%" 
                    data-style="border" data-size="5">
                    
                <option value='1'
                    data-content='<div>
                                    <h6>Nam Anh</h6>
                                    <small>Ha Noi</small>
                                </div>' ></option>                                                                                                                                                                      
                <option value='2'
                    data-content='<div>
                                    <h6>Thanh</h6>
                                    <small>Ha Noi</small>
                                </div>' ></option>                                                                                                                                                                      
                <option value='3'
                    data-content='<div>
                                    <h6>Quyen</h6>
                                    <small>Ha Noi</small>
                                </div>' ></option>                                                                                                                                                                      
                <option value='4'
                    data-content='<div>
                                    <h6>Trong</h6>
                                    <small>Ha Noi</small>
                                </div>' ></option>                                                                                                                                                                      
                </select>
            </div>    
        <div class="mb-3">
            <label for="name" class="form-label">State</label>
            <select id="state" name="state" class="selectpicker" 
                    data-live-search="true" data-width="100%" 
                    data-style="border" data-size="5">
                <option value="1" data-content='<span class="badge bg-secondary">Unconfirmed</span>'>Unconfirmed</option>                                                                
                <option value="2" data-content='<span class="badge bg-primary">Confirmed</span>' selected>Confirmed</option>                                                                
                <option value="3" data-content='<span class="badge bg-warning">Delivery</span>'>Delivery</option>                                                                
                <option value="4" data-content='<span class="badge bg-success">Complete</span>'>Complete</option>                                                                                                                                       
            </select>
        </div>    
        <div class="mb-3">
            <label for="shipping_id" class="form-label">Shipping Method</label>
            <select id="shipping_id" name="shipping_id" class="selectpicker" 
                    data-live-search="true" data-width="100%" 
                    data-style="border" data-size="5">

                <option value='1'  >COD</option>
                <option value='2'  >Tự Lấy</option>
                                                                                                                                                    
            </select>
        </div>              
        <div class="mb-3">
            <label for="payment_id" class="form-label">Payment Method</label>
            <select id="payment_id" name="payment_id" class="selectpicker" 
                    data-live-search="true" data-width="100%" 
                    data-style="border" data-size="5">

                <option value='1'  >Ngân hàng</option>                                                                                                                                                    
                <option value='2'  >TNA Pay</option>                                                                                                                                                    
                <option value='3'  >Khi nhận hàng</option>                                                                                                                                                    
            </select>
        </div>    
              
                                     
        
        <input type="submit" name="submit" value="Add now" class="btn btn-primary">
    </form>
</div>

<script>

    let addProductContainer = $('#add-product-container')[0]; 
    let amountInput = $('#amount')[0];
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
                            <option data-price='1234' data-quantity='12' 
                                value='1'
                                data-content='<div> 
                                                <h6>Máy Tính</h6>
                                                <small>$ 1200</small>
                                                <small>Remaining: 12</small>
                                            </div>' ></option>
                            <option data-price='1300' data-quantity='12' 
                                value='2'
                                data-content='<div> 
                                                <h6>Macbook</h6>
                                                <small>$ 1300</small>
                                                <small>Remaining: 12</small>
                                            </div>' ></option>
                            <option data-price='1400' data-quantity='$value->quantity' 
                                value='3'
                                data-content='<div> 
                                                <h6>Laptop Razer</h6>
                                                <small>$ 1400</small>
                                                <small>Remaining: 12</small>
                                            </div>' ></option>                                                                                                                                        
                    </select>
                </div>                                 
                <div class="mb-3">
                    <label for="quantity${count}" class="form-label">Quantity</label>
                    <input onchange="changeAmount();" type="number" min="1" max="12" value="1"  name="quantity[]" class="form-control" id="quantity${count}">
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
        quantities = $('input[name="quantity[]"]');
        sum = 0;
        for (let i = 0; i < productSelects.length; i++) {
            sum += (+productSelects[i].selectedOptions[0].dataset.price) * (+quantities[i].value);
        }       
        sum = sum.toFixed(2);         
        amountInput.value = sum;
    }

    function changeMaxQuantity(count, value) {
        $('#quantity'+count)[0].max = value;
    }        

</script>

@endsection