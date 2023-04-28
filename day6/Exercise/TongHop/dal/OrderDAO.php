<?php

namespace DataAccessLayer;

use Model\Order;
use mysqli;

include_once '../../models/Order.php';

class OrderDAO {
    public static function getList(mysqli $conn): array
    {        
        $sql = "SELECT * FROM `orders`;";
        $result = $conn->query($sql);
        $list = [];
        while ($row = $result->fetch_array()) {
            $list[] = new Order(
                $row['id'],
                $row['customer_id'],
                $row['amount'],                
                $row['state'],
                $row['delete_flag'],
                $row['ship_id'],
                $row['payment_id'],
                $row['created_at'],
                $row['paid_at'],
                $row['shipped_at']
            );
        }
        $result->free_result();
        return $list;
    }

    public static function insert(mysqli $conn, Order $o): bool
    {
        $sql = 'INSERT INTO `orders`(`customer_id`, `amount`, `state`, `delete_flag`, `ship_id`, `payment_id`, `created_at`) 
                VALUES (? ,? ,?, ?, ?, ?, NOW());';
        $stm = $conn->prepare($sql);
        $stm->bind_param('idiiii', $o->customer_id, $o->amount, $o->state, $o->delete_flag, $o->ship_id, $o->payment_id);
                                             
        return $stm->execute();
    } 

    public static function count(mysqli $conn): int
    {
        $sql = "SELECT COUNT(*) AS count FROM `orders`;";
        $result = $conn->query($sql);                       
        
        return $result->fetch_row()[0];             
    } 

    public static function getListInRange(mysqli $conn, $from, $length): array
    {        
        $sql = "SELECT * FROM `orders` LIMIT ?, ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param('ii', $from, $length);
        $stm->execute();
        $result = $stm->get_result();
        $list = [];
        while ($row = $result->fetch_array()) {
            $list[] = new Order(
                $row['id'],
                $row['customer_id'],
                $row['amount'],                
                $row['state'],
                $row['delete_flag'],
                $row['ship_id'],
                $row['payment_id'],
                $row['created_at'],
                $row['paid_at'],
                $row['shipped_at']
            );
        }
        $result->free_result();
        return $list;
    }

    public static function getById(mysqli $conn, $id): ?Order
    {
        $sql = "SELECT * FROM `orders` WHERE `id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("i", $id);
        $stm->execute();
        $result = $stm->get_result();        
        while ($row = $result->fetch_array()) {
            $result->free_result();
            return new Order(
                $row['id'],
                $row['customer_id'],
                $row['amount'],                
                $row['state'],
                $row['delete_flag'],
                $row['ship_id'],
                $row['payment_id'],
                $row['created_at'],
                $row['paid_at'],
                $row['shipped_at']
            );
        }
        $result->free_result();
        return null;
    }

    public static function update(mysqli $conn, Order $o): bool
    {
        $sql = "UPDATE `orders` SET `customer_id`= ?,`amount`= ?,`state`= ?, `delete_flag`= ?, `ship_id`= ?, `payment_id`= ? WHERE `id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("idiiiii", $o->customer_id, $o->amount, $o->state
                        , $o->delete_flag, $o->ship_id, $o->payment_id, $o->id);                
        
        return $stm->execute();
    }

    public static function toggleStatus(mysqli $conn, $id): bool
    {
        $sql = "UPDATE `orders` SET `delete_flag`= !`delete_flag` WHERE `id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("i", $id);                
        
        return $stm->execute();
    }

    public static function getMaxId(mysqli $conn): int
    {
        $sql = "SELECT MAX(`id`) AS max FROM `orders`;";
        $result = $conn->query($sql);                       
        
        return $result->fetch_row()[0];             
    } 
}