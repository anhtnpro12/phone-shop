<?php     
    require './components/header.php';           

    if (isset($_SESSION['user'])) {
        header('Location:./index.php');
    }

    $success = false;
    if (isset($_POST['submit'])) {
        $user_name = $_POST['user-name'];
        $password = $_POST['password'];

        $user = UserDAO::login($user_name, $password);
        
        if (!is_null($user)) {            
            $_SESSION['user'] = $user;
            $success = true;
            header('Location:./index.php');
        }                
    }
    
?>

<div class="container mt-5 mb-5 d-flex justify-content-center">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" style="width: 50%;">
        <h3 class="text-center">Login</h3>        

        <?php
            if (isset($_POST['submit']) && !$success) {
                echo '<span class="fs-4 text-warning">Login failed. user name or password is incorrect.</span>';
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
        <input type="submit" name="submit" value="login" class="btn btn-primary">        
    </form>
</div>

<?php require './components/footer.php'; ?>