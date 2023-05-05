<?php

use DataAccessLayer\OrderDAO;

use function Database\getConnection;

require '../../dal/database.php';
include '../../dal/OrderDAO.php';

$conn = getConnection();

if (OrderDAO::pay($conn, $_GET['id'])) {
    $conn->close();
    header('Location: index.php?page='.$_GET['page']);
} else {
    $conn->close();    
    die('Toggle failed');
}