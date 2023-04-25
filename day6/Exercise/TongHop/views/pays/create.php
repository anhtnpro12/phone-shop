<?php

use DataAccessLayer\PayDAO;
use Model\PayDetail;

$page = 'pay';
require '../components/header.php'; 
include '../../dal/PayDAO.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];    
    $status = $_POST['status'];

    $isOK = PayDAO::insert($conn, new PayDetail('', $name, $description, $status));
}

?>

<div class="container mt-5 mb-5 d-flex justify-content-center">    
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" style="width: 50%;">
        <h3 class="text-center">Add Shipping Method</h3>        

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>                
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
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