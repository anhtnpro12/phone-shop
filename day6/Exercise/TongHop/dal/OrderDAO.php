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
                $row['status'],
                $row['ship_id'],
                $row['payment_id'],
                $row['created_at']
            );
        }
        $result->free_result();
        return $list;
    }

    // public static function insert(mysqli $conn, PayDetail $s): bool
    // {
    //     $sql = 'INSERT INTO `pay_detail`(`name`, `description`, `status`) 
    //             VALUES (? ,? ,?);';
    //     $stm = $conn->prepare($sql);
    //     $stm->bind_param('ssi', $s->name, $s->description, $s->status);
                                             
    //     return $stm->execute();
    // } 

    // public static function getById(mysqli $conn, $id): ?PayDetail
    // {
    //     $sql = "SELECT * FROM `pay_detail` WHERE `id` = ?;";
    //     $stm = $conn->prepare($sql);
    //     $stm->bind_param("i", $id);
    //     $stm->execute();
    //     $result = $stm->get_result();        
    //     while ($row = $result->fetch_array()) {
    //         $result->free_result();
    //         return new PayDetail(
    //             $row['id'],
    //             $row['name'],
    //             $row['description'],                
    //             $row['status']
    //         );
    //     }
    //     $result->free_result();
    //     return null;
    // }

    // public static function update(mysqli $conn, PayDetail $product): bool
    // {
    //     $sql = "UPDATE `pay_detail` SET `name`= ?,`description`= ?, `status`= ? WHERE `id` = ?;";
    //     $stm = $conn->prepare($sql);
    //     $stm->bind_param("ssii", $product->name, $product->description
    //                     , $product->status, $product->id);                
        
    //     return $stm->execute();
    // }

    // public static function toggleStatus(mysqli $conn, $id): bool
    // {
    //     $sql = "UPDATE `pay_detail` SET `status`= !`status` WHERE `id` = ?;";
    //     $stm = $conn->prepare($sql);
    //     $stm->bind_param("i", $id);                
        
    //     return $stm->execute();
    // }
}