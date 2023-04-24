<?php

use DataAccessLayer\ProductDAO;
use Model\Product;

$page = 'product';
require '../components/header.php'; 
include '../../dal/ProductDAO.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $status = $_POST['status'];

    $isOK = ProductDAO::insert($conn, new Product('', $name, $description, $price, $quantity, $status));
}

?>

<div class="container mt-5 mb-5 d-flex justify-content-center">    
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" style="width: 50%;">
        <h3 class="text-center">Add Customer</h3>        

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>                
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" name="price" class="form-control" id="price" required>
        </div>        
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" id="quantity" required>
        </div>        
        <div class="mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="active" value="1" checked>
                <label class="form-check-label" for="active">Active</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="inactive" value="0">
                <label class="form-check-label" for="inactive">Inactive</label>
            </div>
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