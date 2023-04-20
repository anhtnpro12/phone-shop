<?php
    require './configurations/database.php';

    session_start();

    $logged = false;
    if (isset($_SESSION['user'])) {
        $logged = true;
    }    

    if ($logged) {
        // Do this every time a user makes a request to server
        $stmt = $connection->prepare('UPDATE users SET last_active=NOW() WHERE id=?');
        $stmt->bind_param('s', $_SESSION['user']['id']);
        $stmt->execute();
    
        // To fetch count:
        $count_of_active_user = $connection->query('SELECT COUNT(*) FROM users WHERE last_active >= NOW() - INTERVAL 15 MINUTE')->fetch_row()[0];
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TNA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="./index.php">TNA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">                                       
                </ul>
                <?php
                    if ($logged) {
                        echo "<strong class='me-3'>$count_of_active_user <span class='text-success'>User Online</span> </strong>";
                    }
                ?>
                
                <?php
                if (!$logged) {
                    echo '<a href="login.php"><button class="btn btn-outline-primary me-3" type="button">Login</button></a>                
                        <a href="register.php"><button class="btn btn-outline-primary" type="button">Register</button></a>';
                } else {
                    echo '<a href="logout.php"><button class="btn btn-outline-danger me-3" type="button">Logout</button></a>';
                }
                ?>
            </div>
        </div>
    </nav>