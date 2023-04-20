<?php    
    require('../dal/UserDAO.php');
    session_start();

    UserDAO::logout($_SESSION['user']->getId());    
    
    unset($_SESSION['user']);    
    header('Location:./login.php');
?>