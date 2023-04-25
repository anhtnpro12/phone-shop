<?php

use DataAccessLayer\PaymentDAO;

use function Database\getConnection;

require '../../dal/database.php';
include '../../dal/PaymentDAO.php';

$conn = getConnection();

if (PaymentDAO::toggleStatus($conn, $_GET['id'])) {
    $conn->close();
    header('Location: index.php');
} else {
    $conn->close();    
    die('Toggle failed');
}