<?php

use DataAccessLayer\PayDAO;

use function Database\getConnection;

require '../../dal/database.php';
include '../../dal/PayDAO.php';

$conn = getConnection();

if (PayDAO::toggleStatus($conn, $_GET['id'])) {
    $conn->close();
    header('Location: index.php');
} else {
    $conn->close();    
    die('Toggle failed');
}