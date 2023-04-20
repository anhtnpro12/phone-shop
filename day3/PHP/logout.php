<?php    
    require('./configurations/database.php');
    session_start();

    // Do this every time a user makes a request to server
    $stmt = $connection->prepare('UPDATE users SET last_active=NOW() - INTERVAL 24 HOUR WHERE id=?');
    $stmt->bind_param('s', $_SESSION['user']['id']);
    $stmt->execute();
    
    unset($_SESSION['user']);    
    header('Location:./login.php');
?>