<?php

use DataAccessLayer\CustomerDAO;
use Model\Customer;

$page = 'customer';
require '../components/header.php'; 
include '../../dal/CustomerDAO.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $delete_flag = 1;

    $isOK = CustomerDAO::insert($conn, new Customer('', $name, $address, $phone, $email, $delete_flag));

    if ($isOK) {
        header('Location: index.php?type=success&mess=Add%20Customer%20Successful%21');
    }

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
            <label for="address" class="form-label">Address</label>
            <input type="text" min='0' name="address" class="form-control" id="address" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" required>
        </div>        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
        </div>                
        <input type="submit" name="submit" value="Add now" class="btn btn-primary">
    </form>
</div>

<script>
    <?php

    if (isset($_POST['submit'])) {
        if ($isOK) {
            echo 'showSuccessToast("Add Customer Successful!")';
        } else {
            echo 'showErrorToast("Add Failed!")';            
        }
    }

    ?>
</script>

<?php require '../components/footer.php'; ?>