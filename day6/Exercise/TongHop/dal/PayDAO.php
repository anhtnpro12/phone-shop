<?php

namespace DataAccessLayer;

use Model\Customer;
use Model\Pay;
use Model\PayDetail;
use mysqli;

include '../../models/PayDetail.php';
include '../../models/Pay.php';
include '../../models/Customer.php';

class PayDAO {
    public static function getList(mysqli $conn): array
    {        
        $sql = "SELECT * FROM `pay_detail`;";
        $result = $conn->query($sql);
        $list = [];
        while ($row = $result->fetch_array()) {
            $list[] = new PayDetail(
                $row['id'],
                $row['name'],
                $row['description'],                
                $row['status']
            );
        }
        $result->free_result();
        return $list;
    }

    public static function insert(mysqli $conn, PayDetail $s): bool
    {
        $sql = 'INSERT INTO `pay_detail`(`name`, `description`, `status`) 
                VALUES (? ,? ,?);';
        $stm = $conn->prepare($sql);
        $stm->bind_param('ssi', $s->name, $s->description, $s->status);
                                             
        return $stm->execute();
    } 

    public static function getById(mysqli $conn, $id): ?PayDetail
    {
        $sql = "SELECT * FROM `pay_detail` WHERE `id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("i", $id);
        $stm->execute();
        $result = $stm->get_result();        
        while ($row = $result->fetch_array()) {
            $result->free_result();
            return new PayDetail(
                $row['id'],
                $row['name'],
                $row['description'],                
                $row['status']
            );
        }
        $result->free_result();
        return null;
    }

    public static function update(mysqli $conn, PayDetail $product): bool
    {
        $sql = "UPDATE `pay_detail` SET `name`= ?,`description`= ?, `status`= ? WHERE `id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("ssii", $product->name, $product->description
                        , $product->status, $product->id);                
        
        return $stm->execute();
    }

    public static function toggleStatus(mysqli $conn, $id): bool
    {
        $sql = "UPDATE `pay_detail` SET `status`= !`status` WHERE `id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("i", $id);                
        
        return $stm->execute();
    }

    public static function getDetailById(mysqli $conn, $id): ?Pay
    {
        $sql = "SELECT p.`id`, p.`pay_detail_id`, p.`pay_amount`, p.`customer_id`, p.`paid_at` 
                , pd.`name` as pay_detail_name, pd.`description`, pd.`status` as pay_detail_status
                , `c`.`name` as customer_name, `c`.`address`, `c`.`phone`, `c`.`email`, `c`.`status` as customer_status
                FROM `pays` p
                LEFT JOIN pay_detail pd ON p.`pay_detail_id` = pd.`id`
                LEFT JOIN customers c ON `p`.`customer_id` = c.`id`
                WHERE p.`id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("i", $id);
        $stm->execute();
        $result = $stm->get_result();        
        while ($row = $result->fetch_array()) {
            $result->free_result();
            $pd = new PayDetail(
                $row['pay_detail_id'], 
                $row['pay_detail_name'], 
                $row['description'], 
                $row['pay_detail_status'],                 
            );
            $c = new Customer(
                $row['customer_id'],
                $row['customer_name'],
                $row['address'],
                $row['phone'],
                $row['email'],
                $row['customer_status'],
            );
            return new Pay(
                $row['id'],
                $pd,
                $row['pay_amount'],
                $c,                
                $row['paid_at']
            );
        }
        $result->free_result();
        return null;
    }
}