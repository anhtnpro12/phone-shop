<?php

use DataAccessLayer\CustomerDAO;
use DataAccessLayer\OrderDAO;
use DataAccessLayer\OrderDetailDAO;
use DataAccessLayer\PaymentDAO;
use DataAccessLayer\ProductDAO;
use DataAccessLayer\ShippingDAO;
use Model\Order;
use Model\OrderDetail;
use Model\Product;

$page = 'order';
require '../components/header.php'; 
include '../../dal/CustomerDAO.php';
include '../../dal/ShippingDAO.php';
include '../../dal/PaymentDAO.php';
include '../../dal/ProductDAO.php';
include '../../dal/OrderDAO.php';
include '../../dal/OrderDetailDAO.php';

$quantityError = false;
$amountError = false;
$isOK = false;
$order_id = $_GET['id'] ?? $_POST['id']; 
$orderDetails = OrderDetailDAO::getListByOrderId($conn, $order_id);

if (isset($_POST['submit'])) {    
    if (isset($_POST['quantity'])) {
        foreach ($_POST['quantity'] as $key => $value) {
            if (empty($value) || !is_numeric($value) || $value < 1) {
                $quantityError = true;
            }
        }
    }   
    
    if (empty($_POST['amount']) || !is_numeric($_POST['amount'])) {
        $amountError = true;
    }

    if (!$quantityError && !$amountError) {
        $customer_id = $_POST['customer_id'];        
        $amount = $_POST['amount'];        
        $state = $_POST['state'];        
        $delete_flag = 1;        
        $ship_id = $_POST['shipping_id'];        
        $payment_id = $_POST['payment_id'];
        $product_ids = $_POST['product_id'] ?? [];
        $quantities = $_POST['quantity'] ?? [];
        // var_dump($amount); die();

        OrderDAO::update($conn, new Order($order_id, $customer_id, $amount, $state
                    , $delete_flag, $ship_id, $payment_id, date('Y-m-d h:i:s'), '', ''));
        
        foreach ($orderDetails as $key => $value) {
            $value->product->quantity += $value->quantity;
            ProductDAO::update($conn, $value->product);
        }
        OrderDetailDAO::deleteByOrderId($conn, $order_id);                    
        foreach ($product_ids as $key => $value) {
            $pid = $product_ids[$key];
            $quan = $quantities[$key];
            OrderDetailDAO::insert($conn, new OrderDetail('', $order_id, new Product($pid), $quan));  
            
            $pro = ProductDAO::getById($conn, $pid);
            $pro->quantity -= $quan;
            if ($pro->quantity == 0) {
                $pro->delete_flag = 0;
            }
            ProductDAO::update($conn, $pro);            
        }  
        $isOK = true;         
    }
}

$products = ProductDAO::getList($conn);
$customers = CustomerDAO::getList($conn);
$shippings = ShippingDAO::getList($conn);
$payments = PaymentDAO::getList($conn);
$order = OrderDAO::getById($conn, $order_id);
$orderDetails = OrderDetailDAO::getListByOrderId($conn, $order_id);

?>

<div class="container mt-5 mb-5 d-flex justify-content-center">    
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" style="width: 50%;">
        <h3 class="text-center">Edit Order</h3>    
        
        <?php
        
        foreach ($orderDetails as $index => $orderDetail) {
        
            echo '<div class="container mb-3 d-flex flex-wrap">
                    <hr style="width: 100%;"/>
        
                    <div class="wrapper flex-fill">
                            <div class="mb-3">
                                <label for="product_id'.$index.'" class="form-label">Product Name</label>
                                <select id="product_id'.$index.'" name="product_id[]" class="selectpicker" 
                                        data-live-search="true" data-width="100%" 
                                        onchange="changeAmount(); changeMaxQuantity(this.id.substr(10), this.selectedOptions[0].dataset.quantity);" 
                                        data-style="border" data-size="5">';

                                    
            foreach ($products as $value) {
                echo "<option data-price='$value->price' data-quantity='$value->quantity' 
                        value='$value->id' ".($value->delete_flag?'':'disabled')."
                        data-content='<div> 
                                        <h6>$value->name</h6>
                                        <small>$ $value->price</small>
                                        <small>Remaining: $value->quantity</small>
                                    </div>' ".($value->id==$orderDetail->product->id?"selected":"").">$value->price</option>";
            }
                                    
            echo '      </select>
                    </div>                                 
                    <div class="mb-3">
                        <label for="quantity'.$index.'" class="form-label">Quantity</label>
                        <input onchange="changeAmount();" type="number" min="1" max="'.$orderDetail->product->quantity.'" 
                            value="'.$orderDetail->quantity.'" name="quantity[]" class="form-control" id="quantity'.$index.'">
                        <small class="text-danger '.($quantityError?"":"d-none").'">Quantity must be an integer greater than 0 and less than the remainder</small>
                    </div>                 
                </div>
                <div class="flex-fill d-flex justify-content-end align-items-center">
                    <button class="btn btn-danger" onclick="this.parentNode.parentNode.remove(); changeAmount();">Remove</button>
                </div>
            </div>';
        }
                
        ?>
        <div id="add-product-container" class="container mb-3 d-flex">
            <button id="add-product-btn" class="btn btn-success" type="button" onclick="addProduct(); changeAmount();">Add Product</button>
        </div>
        <hr>
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="text" name="amount" value="<?php echo $order->amount; ?>" class="form-control" id="amount" readonly>
            <small class="text-danger <?php echo ($amountError?'':'d-none'); ?>">Amount must be an number</small>
        </div> 
        <div class="mb-3">
            <label for="customer_id" class="form-label">Customer</label>
            <select id="customer_id" name="customer_id" class="selectpicker" 
                    data-live-search="true" data-width="100%" 
                    data-style="border" data-size="5">
                <?php
                
                foreach ($customers as $key => $value) {
                    echo "<option value='$value->id' ".($value->delete_flag?'':'disabled')." 
                        data-content='<div>
                                        <h6>$value->name</h6>
                                        <small>$value->address</small>
                                    </div>' ".($value->id==$order->customer_id?"selected":"").">$value->name</option>";
                }                    

                ?>                                                                                                                                                      
            </select>
        </div>    
        <div class="mb-3">
            <label for="name" class="form-label">State</label>
            <select id="state" name="state" class="selectpicker" 
                    data-live-search="true" data-width="100%" 
                    data-style="border" data-size="5">
                <option value="1" <?php echo ($order->state==1?'selected':''); ?> data-content='<span class="badge bg-secondary">Unconfirmed</span>'>Unconfirmed</option>                                                                
                <option value="2" <?php echo ($order->state==2?'selected':''); ?> data-content='<span class="badge bg-primary">Confirmed</span>'>Confirmed</option>                                                                
                <option value="3" <?php echo ($order->state==3?'selected':''); ?> data-content='<span class="badge bg-warning">Delivery</span>'>Delivery</option>                                                                
                <option value="4" <?php echo ($order->state==4?'selected':''); ?> data-content='<span class="badge bg-success">Complete</span>'>Complete</option>                                                                                                                                       
            </select>
        </div>    
        <div class="mb-3">
            <label for="shipping_id" class="form-label">Shipping Method</label>
            <select id="shipping_id" name="shipping_id" class="selectpicker" 
                    data-live-search="true" data-width="100%" 
                    data-style="border" data-size="5">
                <?php
            
                foreach ($shippings as $key => $value) {
                    echo "<option ".($order->ship_id==$value->id?"selected":'')." value='$value->id' ".($value->delete_flag?'':'disabled')."  >$value->name</option>";
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
                    echo "<option ".($order->payment_id==$value->id?"selected":'')." value='$value->id' ".($value->delete_flag?'':'disabled')."  >$value->name</option>";
                }                    

                ?>                                                                                                                                    
            </select>
        </div>    
              
        <input type="hidden" name="id" value="<?php echo $order_id; ?>">                                     
        
        <input onclick="return cancelSubmit();" type="submit" name="submit" value="Update now" class="btn btn-primary">
    </form>
</div>

<script>

    let addProductContainer = $('#add-product-container')[0]; 
    let amountInput = $('#amount')[0];
    let count = <?php echo count($orderDetails); ?>;               

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
                            <?php

                            foreach ($products as $key => $value) {
                                echo "<option data-price='$value->price' data-quantity='$value->quantity' 
                                        value='$value->id' ".($value->delete_flag?'':'disabled')." 
                                        data-content='<div>
                                                        <h6>$value->name</h6>
                                                        <small>$ $value->price</small>
                                                        <small>Remaining: $value->quantity</small>
                                                    </div>' >$value->name</option>";
                            }                    
    
                            ?>                                                                                                                                        
                    </select>
                </div>                                 
                <div class="mb-3">
                    <label for="quantity${count}" class="form-label">Quantity</label>
                    <input onchange="changeAmount();" type="number" max="<?php
                        foreach ($products as $key => $value) {
                            if ($value->delete_flag) {
                                echo $value->quantity;
                                break;
                            }
                        }
                    ?>" value="1"  name="quantity[]" class="form-control" id="quantity${count}">
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

    function cancelSubmit() {
        if (<?php echo ($order->state > 2); ?>) {
            showErrorToast("You cannot modify the order!!<br>The product is being shipped or you have already received it");
            return false;
        }

        return true;
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