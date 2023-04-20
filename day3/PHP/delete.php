<?php
    require './configurations/database.php';

    if (!isset($_SESSION['user'])) {
        header('Location:./login.php');
    }

    // Do this every time a user makes a request to server
    $stmt = $connection->prepare('UPDATE users SET last_active=NOW() WHERE id=?');
    $stmt->bind_param('s', $_SESSION['user']['id']);
    $stmt->execute();
    
    $id = $_GET['id'];
    
    $query = 'DELETE FROM users WHERE `id`=?';
    $statement = $connection->prepare($query);
    $statement->bind_param('i', $id);
    $statement->execute();
    
    header('Location:./index.php');
?>