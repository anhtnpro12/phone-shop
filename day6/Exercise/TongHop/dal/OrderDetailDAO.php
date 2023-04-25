<?php

namespace DataAccessLayer;

use Model\OrderDetail;
use mysqli;
use Product;

include_once '../../models/OrderDetail.php';
include_once '../../models/Product.php';

class OrderDetailDAO {
    public static function getListByOrderId(mysqli $conn, $order_id): array
    {        
        $sql = "SELECT od.`id`, od.`order_id`, od.`product_id`, od.`quantity` AS order_quantity
                , `p`.`name`, `p`.`description`, `p`.`price`, `p`.`quantity` AS product_quantity, `p`.`status`
                FROM `order_detail` od
                INNER JOIN products p ON od.`product_id` = p.`id`
                WHERE od.`order_id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("i", $order_id);
        $stm->execute();                
        $result = $stm->get_result();
        $list = [];
        while ($row = $result->fetch_array()) {
            $product = new Product(
                $row['product_id'],
                $row['name'],
                $row['description'],
                $row['price'],
                $row['product_quantity'],
                $row['status'],
            );
            $list[] = new OrderDetail(
                $row['id'],
                $row['order_id'],
                $product,
                $row['order_quantity']                
            );
        }
        $result->free_result();
        return $list;
    }
         
}