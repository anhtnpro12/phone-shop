<?php

use DataAccessLayer\OrderDAO;
use Model\Order;
use function Database\getConnection;

include 'OrderDAO.php';

$conn = getConnection();

// insert order to mysql
// $o = new Order('', 1, 'Hà Nội', 122.234, 1, 1, 1, '2022-12-01 05:05:05', 1, '2022-12-01 05:05:05', 1);
// OrderDAO::insert($conn, $o);

// toggle order status by id
// OrderDAO::toggleStatus($conn, 1);

// update order by id
// OrderDAO::updateById($conn, new Order(1, 1, 'Hà Nội', 100.4334, 1, 1, 1, '2022-12-01 05:05:05', 1, '2022-12-01 05:05:05', 1));

// get list order
$list = OrderDAO::getList($conn);


foreach ($list as $key => $value) {
    echo $value.'<br>';
}

$conn->close();
