<?php

namespace Database;

use mysqli;

define('DATABASE_SERVER', 'localhost');
define('DATABASE_USER', 'root');
define('DATABASE_PASSWORD', '');
define('DATABASE_NAME', 'day6');

function getConnection(): ?mysqli
{    
    $connection = new mysqli(DATABASE_SERVER,DATABASE_USER,DATABASE_PASSWORD,DATABASE_NAME);
    
    if ($connection->connect_error) {
        die('Error : ('. $connection->connect_errno .') '. $connection->connect_error);
        return null;
    }            
    return $connection;
}        