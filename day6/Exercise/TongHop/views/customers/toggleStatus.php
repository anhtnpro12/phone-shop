<?php

use DataAccessLayer\CustomerDAO;

use function Database\getConnection;

require '../../dal/database.php';
include '../../dal/CustomerDAO.php';

$conn = getConnection();

if (CustomerDAO::toggleStatus($conn, $_GET['id'])) {
    $conn->close();
    header('Location: index.php?page='.$_GET['page']);
} else {
    $conn->close();    
    die('Toggle failed');
}