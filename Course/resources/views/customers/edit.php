<?php

use DataAccessLayer\CustomerDAO;
use Model\Customer;

$page = 'customer';
require '../components/header.php'; 
include '../../dal/CustomerDAO.php';

$id = $_GET['id'] ?? $_POST['id'];
 
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $delete_flag = $_POST['delete_flag'];

    $isOK = CustomerDAO::update($conn, new Customer($id, $name, $address, $phone, $email, $delete_flag));
}

$customer = CustomerDAO::getById($conn, $id);
?>

<div class="container mt-5 mb-5 d-flex justify-content-center">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" style="width: 50%;">
        <h3 class="text-center">Update Customer</h3>        

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" value="<?php echo $customer->name; ?>" name="name" class="form-control" id="name" required>
        </div>                
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" value="<?php echo $customer->address; ?>" min='0' name="address" class="form-control" id="address" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" value="<?php echo $customer->phone; ?>" name="phone" class="form-control" id="phone" required>
        </div>        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" value="<?php echo $customer->email; ?>" name="email" class="form-control" id="email" required>
        </div>
        <div class="mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="delete_flag" id="active" value="1" <?php echo $customer->delete_flag===1?'checked':''; ?> >
                <label class="form-check-label" for="active">Active</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="delete_flag" id="inactive" value="0" <?php echo $customer->delete_flag===0?'checked':''; ?>>
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