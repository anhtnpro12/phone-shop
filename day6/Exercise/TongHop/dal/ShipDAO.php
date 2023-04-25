<?php

namespace DataAccessLayer;

use Model\Customer;
use Model\Ship;
use Model\ShipDetail;
use mysqli;

include '../../models/ShipDetail.php';
include '../../models/Ship.php';
include '../../models/Customer.php';

class ShipDAO {
    public static function getList(mysqli $conn): array
    {        
        $sql = "SELECT * FROM `ship_detail`;";
        $result = $conn->query($sql);
        $list = [];
        while ($row = $result->fetch_array()) {
            $list[] = new ShipDetail(
                $row['id'],
                $row['name'],
                $row['description'],                
                $row['status']
            );
        }
        $result->free_result();
        return $list;
    }

    public static function insert(mysqli $conn, ShipDetail $s): bool
    {
        $sql = 'INSERT INTO `ship_detail`(`name`, `description`, `status`) 
                VALUES (? ,? ,?);';
        $stm = $conn->prepare($sql);
        $stm->bind_param('ssi', $s->name, $s->description, $s->status);
                                             
        return $stm->execute();
    } 

    public static function getById(mysqli $conn, $id): ?ShipDetail
    {
        $sql = "SELECT * FROM `ship_detail` WHERE `id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("i", $id);
        $stm->execute();
        $result = $stm->get_result();        
        while ($row = $result->fetch_array()) {
            $result->free_result();
            return new ShipDetail(
                $row['id'],
                $row['name'],
                $row['description'],                
                $row['status']
            );
        }
        $result->free_result();
        return null;
    }

    public static function update(mysqli $conn, ShipDetail $product): bool
    {
        $sql = "UPDATE `ship_detail` SET `name`= ?,`description`= ?, `status`= ? WHERE `id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("ssii", $product->name, $product->description
                        , $product->status, $product->id);                
        
        return $stm->execute();
    }

    public static function toggleStatus(mysqli $conn, $id): bool
    {
        $sql = "UPDATE `ship_detail` SET `status`= !`status` WHERE `id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("i", $id);                
        
        return $stm->execute();
    }

    public static function getDetailById(mysqli $conn, $id): ?Ship
    {
        $sql = "SELECT s.`id`, s.`ship_detail_id`, s.`customer_id`, s.`shiped_at` 
                , sd.`name` as ship_detail_name, sd.`description`, sd.`status` as ship_detail_status
                , `c`.`name` as customer_name, `c`.`address`, `c`.`phone`, `c`.`email`, `c`.`status` as customer_status
                FROM `ships` s
                LEFT JOIN ship_detail sd ON s.`ship_detail_id` = sd.`id`
                LEFT JOIN customers c ON `s`.`customer_id` = c.`id`
                WHERE s.`id` = 1;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("i", $id);
        $stm->execute();
        $result = $stm->get_result();        
        while ($row = $result->fetch_array()) {
            $result->free_result();
            $pd = new ShipDetail(
                $row['ship_detail_id'],                 
                $row['ship_detail_name'],                 
                $row['description'], 
                $row['ship_detail_status'],                 
            );
            $c = new Customer(
                $row['customer_id'],
                $row['customer_name'],
                $row['address'],
                $row['phone'],
                $row['email'],
                $row['customer_status'],
            );
            return new Ship(
                $row['id'],
                $pd,                
                $c,                
                $row['shiped_at']
            );
        }
        $result->free_result();
        return null;
    }
}