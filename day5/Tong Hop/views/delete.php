<?php
    require '../dal/UserDAO.php';    
    session_start();    
    
    if (!isset($_SESSION['user'])) {
        header('Location:./login.php');
    }
    
    UserDAO::updateLastActive($_SESSION['user']->getId());
    
    $id = $_GET['id'];
    
    UserDAO::deleteUserById($id);
    

    header('Location:./index.php');
?>