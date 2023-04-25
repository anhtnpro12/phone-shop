<?php

$page = 'order';
require '../components/header.php'; 
include '../../dal/CustomerDAO.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];    
    $status = $_POST['status'];

    
}



?>

<div class="container mt-5 mb-5 d-flex justify-content-center">    
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" style="width: 50%;">
        <h3 class="text-center">Add Shipping Method</h3>    

        <div class="container mb-3 d-flex">
            <hr>
            <div class="wrapper flex-fill">
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                </div>
            </div>
            <div class="flex-fill d-flex justify-content-end align-items-center">
                <button class="btn btn-danger">Remove</button>
            </div>
        </div>
        <hr>
        <div class="mb-3">
            <label for="name" class="form-label">Creator</label>
            <select id="state" name="state" class="selectpicker" 
                    data-live-search="true" data-width="100%" 
                    data-style="border" data-size="5">
                <option value="1" data-content='<span class="badge badge-secondary">Unconfirmed</span>'>Unconfirmed</option>                                                                
                <option value="2" data-content='<span class="badge badge-primary">Confirmed</span>' selected>Confirmed</option>                                                                
                <option value="3" data-content='<span class="badge badge-warning">Delivery</span>'>Delivery</option>                                                                
                <option value="4" data-content='<span class="badge badge-success">Complete</span>'>Complete</option>                                                                
            </select>

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