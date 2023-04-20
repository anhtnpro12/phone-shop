<?php
    define('DATABASE_SERVER', 'localhost');
    define('DATABASE_USER', 'root');
    define('DATABASE_PASSWORD', '');
    define('DATABASE_NAME', 'user');    
            
    $connection = new mysqli(DATABASE_SERVER,DATABASE_USER,DATABASE_PASSWORD,DATABASE_NAME);
    
    if ($connection->connect_error) {
        die('Error : ('. $connection->connect_errno .') '. $connection->connect_error);
    }            
?>