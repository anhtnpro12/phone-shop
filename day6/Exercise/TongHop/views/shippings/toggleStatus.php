<?php

use DataAccessLayer\ShippingDAO;
use function Database\getConnection;

require '../../dal/database.php';
include '../../dal/ShippingDAO.php';

$conn = getConnection();

if (ShippingDAO::toggleStatus($conn, $_GET['id'])) {
    $conn->close();
    header('Location: index.php?page='.$_GET['page']);
} else {
    $conn->close();    
    die('Toggle failed');
}