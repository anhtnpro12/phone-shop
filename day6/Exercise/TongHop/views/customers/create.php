<?php

use DataAccessLayer\CustomerDAO;
use Model\Customer;

$page = 'customer';
require '../components/header.php'; 
include '../../dal/CustomerDAO.php';

$isOK = false;
$name = $_POST['name'] ?? '';
$address = $_POST['address'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$delete_flag = 1;
if (isset($_POST['submit'])) {    
    $emailExist = CustomerDAO::emailExists($conn, $email);
    $phoneExist = CustomerDAO::phoneExists($conn, $phone);

    if (!$emailExist && !$phoneExist) {
        $isOK = CustomerDAO::insert($conn, new Customer('', $name, $address, $phone, $email, $delete_flag));
        
        if ($isOK) {
            header('Location: index.php?type=success&mess=Add%20Customer%20Successful%21');
        }
    }
}

?>

<div class="container mt-5 mb-5 d-flex justify-content-center">    
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" style="width: 50%;">
        <h3 class="text-center">Add Customer</h3>        

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" value="<?php echo $name;?>" name="name" class="form-control" id="name" required>
        </div>                
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" value="<?php echo $address;?>" min='0' name="address" class="form-control" id="address" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" value="<?php echo $phone;?>" name="phone" class="form-control <?php echo ($phoneExist?'is-invalid':''); ?>" id="phone" required>
            <small class="text-danger <?php echo ($phoneExist?'':'d-none'); ?>">Phone already exists</small>
        </div>        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" value="<?php echo $email;?>" name="email" class="form-control <?php echo ($emailExist?'is-invalid':''); ?>" id="email" required>
            <small class="text-danger <?php echo ($emailExist?'':'d-none'); ?>">Email already exists</small>
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