<?php

use DataAccessLayer\ShipDAO;
use Model\ShipDetail;

$page = 'ship';
require '../components/header.php'; 
include '../../dal/ShipDAO.php';

$id = $_GET['id'] ?? $_POST['id'];
 
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];    
    $status = $_POST['status'];

    $isOK = ShipDAO::update($conn, new ShipDetail($id, $name, $description, $status));
}

$product = ShipDAO::getById($conn, $id);
?>

<div class="container mt-5 mb-5 d-flex justify-content-center">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" style="width: 50%;">
        <h3 class="text-center">Update Shipping Method</h3>        

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" value="<?php echo $product->name; ?>" name="name" class="form-control" id="name" required>
        </div>                
        <div class="mb-3">
            <label for="description" class="form-label">Address</label>
            <input type="text" value="<?php echo $product->description; ?>" name="description" class="form-control" id="description" required>
        </div>        
        <div class="mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="active" value="1" <?php echo $product->status===1?'checked':''; ?> >
                <label class="form-check-label" for="active">Active</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="inactive" value="0" <?php echo $product->status===0?'checked':''; ?>>
                <label class="form-check-label" for="inactive">Inactive</label>
            </div>
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" name="submit" value="Update now" class="btn btn-primary">
    </form>
</div>

<script>
    <?php

    if (isset($_POST['submit'])) {
        if ($isOK) {
            echo 'showSuccessToast("Update Successful!")';
        } else {
            echo 'showErrorToast("Update Failed!")';            
        }
    }

    ?>
</script>

<?php require '../components/footer.php'; ?>