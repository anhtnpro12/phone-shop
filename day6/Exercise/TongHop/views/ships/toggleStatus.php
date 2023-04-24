<?php

use DataAccessLayer\ShipDAO;

use function Database\getConnection;

require '../../dal/database.php';
include '../../dal/ShipDAO.php';

$conn = getConnection();

if (ShipDAO::toggleStatus($conn, $_GET['id'])) {
    $conn->close();
    header('Location: index.php');
} else {
    $conn->close();    
    die('Toggle failed');
}