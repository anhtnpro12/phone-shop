<?php
namespace DataAccessLayer;

use Model\Order;
use mysqli;

include 'Database.php';
include 'Order.php';

trait General {
    public function getListByPage($array, $from, $length) 
    {
        return array_slice($array, $from, $length);
    }
}

class OrderDAO {
    use General;

    public static function insert(mysqli $conn, Order $o): bool
    {
        $sql = 'INSERT INTO `orders` (`customer_id`, `address`, `total`, `state`, `payment`, `status`
                            , `created_at`, `created_by`, `modified_at`, `modified_by`) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);';

        $stm = $conn->prepare($sql);
    
        $stm->bind_param('isdiiisisi', $o->customer_id, $o->address, $o->total, $o->state, $o->payment
                                , $o->status, $o->created_at, $o->created_by, $o->modified_at, $o->modified_by);
                                             
        return $stm->execute();
    }

    public static function getList(mysqli $conn): array
    {
        $sql = 'SELECT * FROM `orders`;';
        $result = $conn->query($sql);        
        $list = [];
        while ($row = $result->fetch_array()) {
            $list[] = new Order(
                $row['id'],
                $row['customer_id'],
                $row['address'],
                $row['total'],
                $row['state'],
                $row['payment'],
                $row['status'],
                $row['created_at'],
                $row['created_by'],
                $row['modified_at'],
                $row['modified_by']
            );
        }   
        $result->free_result();                                          
        return $list;
    }

    public static function toggleStatus(mysqli $conn, $id): bool
    {
        $sql = 'UPDATE `orders` SET `status` = !`status` WHERE `orders`.`id` = ?;';    
        $stm = $conn->prepare($sql);
        $stm->bind_param('i', $id);
        return $stm->execute();
    }

    public static function updateById(mysqli $conn, Order $o) {
        $sql = 'UPDATE `orders` SET `customer_id`=?,`address`=?
                        ,`total`=?,`state`=?,`payment`=?,`status`=?
                        ,`created_at`=?,`created_by`=?,`modified_at`=?
                        ,`modified_by`=? WHERE `id`=?';
        $stm = $conn->prepare($sql);
        $stm->bind_param('isdiiisisii', $o->customer_id, $o->address, $o->total, $o->state, $o->payment
                                , $o->status, $o->created_at, $o->created_by, $o->modified_at
                                , $o->modified_by, $o->id);
        return $stm->execute();                                                        
    }
}