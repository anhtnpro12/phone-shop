<?php

use DataAccessLayer\ProductDAO;

use function Database\getConnection;

require '../../dal/database.php';
include '../../dal/ProductDAO.php';

$conn = getConnection();

if (ProductDAO::toggleStatus($conn, $_GET['id'])) {
    $conn->close();
    header('Location: index.php?page='.$_GET['page']);
} else {
    $conn->close();    
    die('Toggle failed');
}