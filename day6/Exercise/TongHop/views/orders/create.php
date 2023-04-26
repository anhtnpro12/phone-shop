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

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];    
    $status = $_POST['status'];

    
}

$products = ProductDAO::getList($conn);
$customers = CustomerDAO::getList($conn);
$shippings = ShippingDAO::getList($conn);
$payments = PaymentDAO::getList($conn);


?>

<div class="container mt-5 mb-5 d-flex justify-content-center">    
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" style="width: 50%;">
        <h3 class="text-center">Add Order</h3>    
        
        <div class="container mb-3 d-flex">
            <hr>
            <div class="wrapper flex-fill">
                <div class="mb-3">
                    <label for="product_id" class="form-label">Product Name</label>
                    <select id="product_id" name="product_id" class="selectpicker" 
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
                    <input type="text" name="quantity[]" class="form-control" id="quantity1" required>
                </div>                 
            </div>
            <div class="flex-fill d-flex justify-content-end align-items-center">
                <button class="btn btn-danger" onclick="this.parentNode.parentNode.remove();">Remove</button>
            </div>
        </div>
        <div class="container mb-3 d-flex">
            <button class="btn btn-danger" onclick=";">Add Product</button>
        </div>
        <hr>
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="text" name="amount" class="form-control" id="amount" required>
        </div> 
        <div class="mb-3">
            <label for="customer_id" class="form-label">Creator</label>
            <select id="customer_id" name="customer_id" class="selectpicker" 
                    data-live-search="true" data-width="100%" 
                    data-style="border" data-size="5">
                <?php
                
                foreach ($customers as $key => $value) {
                    echo "<option value='$value->id' >$value->name</option>";
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