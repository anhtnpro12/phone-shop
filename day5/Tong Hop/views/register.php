<?php 
    require './components/header.php'; 
    
    $isOk = false;
    if (isset($_POST['submit'])) {
        $user_name = $_POST['user-name'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $address = $_POST['address'];
        $sex = $_POST['sex'];
        
        $isOK = UserDAO::insertUser($user_name, $password, $name, $age, $address, $sex);        
    }
?>

<div class="container mt-5 mb-5 d-flex justify-content-center">    
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" style="width: 50%;">
        <h3 class="text-center">Register</h3>
        <?php
            if (isset($_POST['submit'])) {
                if ($isOK) {
                    echo '<span class="fs-4 text-success">Register successful. You can login now!</span>';
                } else {
                    echo '<span class="fs-4 text-success">Register failed</span>';
                }
            }
        ?>

        <div class="mb-3">
            <label for="user-name" class="form-label">User Name</label>
            <input type="text" name="user-name" class="form-control" id="user-name" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" min='0' name="age" class="form-control" id="age" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" class="form-control" id="address" required>
        </div>
        <div class="mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="sex" id="male" value="1" checked>
                <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="sex" id="female" value="0">
                <label class="form-check-label" for="female">Female</label>
            </div>
        </div>
        <input type="submit" name="submit" value="Register now" class="btn btn-primary">
    </form>
</div>

<?php require './components/footer.php'; ?>