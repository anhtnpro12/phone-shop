<?php

use DataAccessLayer\CustomerDAO;
use DataAccessLayer\PaymentDAO;
use DataAccessLayer\ProductDAO;
use DataAccessLayer\ShippingDAO;

$page = 'order';
require '../components/header.php'; 
include '../../dal/CustomerDAO.php';
include '../../dal/ShippingDAO.php';
include '../../dal/PaymentDAO.php';
include '../../dal/ProductDAO.php';

$quantityError = false;
$amountError = false;

if (isset($_POST['submit'])) {    
    if (isset($_POST['quantity'])) {
        foreach ($_POST['quantity'] as $key => $value) {
            if (empty($value) || !is_numeric($value)) {
                $quantityError = true;
            }
        }
    }   
    
    if (empty($_POST['amount']) || !is_numeric($_POST['amount'])) {
        $amountError = true;
    }
}

$products = ProductDAO::getList($conn);
$customers = CustomerDAO::getList($conn);
$shippings = ShippingDAO::getList($conn);
$payments = PaymentDAO::getList($conn);
$isOK = true;

?>

<div class="container mt-5 mb-5 d-flex justify-content-center">    
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" style="width: 50%;">
        <h3 class="text-center">Add Order</h3>    
        
        <div class="container mb-3 d-flex flex-wrap">
            <hr style="width: 100%;"/>
            <div class="wrapper flex-fill">
                <div class="mb-3">
                    <label for="product_id1" class="form-label">Product Name</label>
                    <select id="product_id1" name="product_id[]" class="selectpicker" 
                            data-live-search="true" data-width="100%" 
                            data-style="border" data-size="5">
                            <?php

                            foreach ($products as $key => $value) {
                                echo "<option value='$value->id' 
                                        data-content='<div>
                                                        <h6>$value->name</h6>
                                                        <small>$ $value->price</small>
                                                    </div>' >$value->name</option>";
                            }                    
    
                            ?>                                                                                                                                        
                    </select>
                </div>                                 
                <div class="mb-3">
                    <label for="quantity1" class="form-label">Quantity</label>
                    <input type="number" min="1" value="1" name="quantity[]" class="form-control" id="quantity1">
                    <small class="text-danger <?php echo ($quantityError?'':'d-none'); ?>">Quantity must be an integer greater than 1</small>
                </div>                 
            </div>
            <div class="flex-fill d-flex justify-content-end align-items-center">
                <button class="btn btn-danger" onclick="this.parentNode.parentNode.remove();">Remove</button>
            </div>
        </div>
        <div id="add-product-container" class="container mb-3 d-flex">
            <button id="add-product-btn" class="btn btn-success" type="button" onclick="addProduct();">Add Product</button>
        </div>
        <hr>
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="text" name="amount" class="form-control" id="amount">
            <small class="text-danger <?php echo ($amountError?'':'d-none'); ?>">Amount must be an number</small>
        </div> 
        <div class="mb-3">
            <label for="customer_id" class="form-label">Customer</label>
            <select id="customer_id" name="customer_id" class="selectpicker" 
                    data-live-search="true" data-width="100%" 
                    data-style="border" data-size="5">
                <?php
                
                foreach ($customers as $key => $value) {
                    echo "<option value='$value->id' 
                        data-content='<div>
                                        <h6>$value->name</h6>
                                        <small>$value->address</small>
                                    </div>' >$value->name</option>";
                }                    

                ?>                                                                                                                                                      
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
                <?php
            
                foreach ($shippings as $key => $value) {
                    echo "<option value='$value->id' >$value->name</option>";
                }                    

                ?>                                                                                                                                    
            </select>
        </div>              
        <div class="mb-3">
            <label for="payment_id" class="form-label">Payment Method</label>
            <select id="payment_id" name="payment_id" class="selectpicker" 
                    data-live-search="true" data-width="100%" 
                    data-style="border" data-size="5">
                <?php
            
                foreach ($payments as $key => $value) {
                    echo "<option value='$value->id' >$value->name</option>";
                }                    

                ?>                                                                                                                                    
            </select>
        </div>    
              
                                     
        
        <input type="submit" name="submit" value="Add now" class="btn btn-primary">
    </form>
</div>

<script>

    let addProductContainer = $('#add-product-container')[0]; 
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
                            data-style="border" data-size="5">
                            <?php

                            foreach ($products as $key => $value) {
                                echo "<option value='$value->id' 
                                        data-content='<div>
                                                        <h6>$value->name</h6>
                                                        <small>$ $value->price</small>
                                                    </div>' >$value->name</option>";
                            }                    
    
                            ?>                                                                                                                                        
                    </select>
                </div>                                 
                <div class="mb-3">
                    <label for="quantity${count}" class="form-label">Quantity</label>
                    <input type="number" value="1" name="quantity[]" class="form-control" id="quantity${count}">
                </div>                 
            </div>
            <div class="flex-fill d-flex justify-content-end align-items-center">
                <button class="btn btn-danger" onclick="this.parentNode.parentNode.remove();">Remove</button>
            </div>
        </div>`                
        );
        $(".selectpicker").selectpicker();
    }               

    <?php

    if (isset($_POST['submit'])) {
        if ($isOK) {
            echo 'showSuccessToast("Add Successful!")';
        } else {
            echo 'showErrorToast("Add Failed!")';            
        }
    }

    ?>    

</script>

<?php require '../components/footer.php'; ?>