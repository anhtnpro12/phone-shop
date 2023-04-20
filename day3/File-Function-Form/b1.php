<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="container">
        <h2>Login</h3>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" id="createForm" method="post">
            <span id="success" style="font-family: tahoma;color: red; font-size: 12px;display: none;">
                Welcome, admin
            </span>
            <span id="authentication-error" style="font-family: tahoma;color: green; font-size: 12px;display: none;">
                Username or password incorrect
            </span>
            <div class="form-control">
                <label for="user-name">User name</label>
                <input type="text" name="user-name" id="user-name" placeholder="User Name">
                <span id="user-name-error" style="color: red; font-size: 12px;display: none;">User name is not empty</span>
            </div>
            <div class="form-control">
                <label for="password">Password</label>
                <input type="text" name="password" id="password" placeholder="Password">
                <span id="password-error" style="color: red; font-size: 12px;display: none;">Password is not empty</span>
            </div>                        
            
            <div class="wrapper">
                <input type="submit" name="create" value="Login" id="create"> 
            </div>           
        </form>
    </div> 
    
    <script src="./createScript.js"></script>
    <script>
        let success = document.getElementById('success');
        let authen_error = document.getElementById('authentication-error');
        <?php
            if(isset($_POST['create'])) {
                if($_POST['user-name'] === 'admin' && $_POST['password'] === '12345') {
                    echo 'success.style.display = "block";';
                    echo 'authen_error.style.display = "none"';
                } else {
                    echo 'authen_error.style.display = "block";';
                    echo 'success.style.display = "none";';
                }
            }
        ?>
    </script>
</body>

</html>