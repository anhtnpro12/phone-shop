<?php

use function Database\getConnection;

include '../../dal/database.php';
$conn = getConnection();

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TNA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function showSuccessToast(mess) {
            toastr.options.progressBar = true;
            toastr.options.positionClass = 'toast-bottom-right';
            toastr.success(mess, 'Congratulations', {
                timeOut: 3000
            });
        } 
        function showErrorToast(mess) {
            toastr.options.progressBar = true;
            toastr.options.positionClass = 'toast-bottom-right';
            toastr.error(mess, 'Oops!', {
                timeOut: 3000
            });
        } 
    </script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="../home/index.php">TNA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page === 'home' ? 'active' : ''; ?>" href="../home/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page === 'customer' ? 'active' : ''; ?>" href="../customers/index.php">Customer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page === 'product' ? 'active' : ''; ?>" href="../products/index.php">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page === 'order' ? 'active' : ''; ?>" href="../orders/index.php">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page === 'ship' ? 'active' : ''; ?>" href="../ships/index.php">Shipping</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page === 'pay' ? 'active' : ''; ?>" href="../pays/index.php">Payment</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>