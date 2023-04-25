<?php

namespace DataAccessLayer;

use Model\Customer;
use Model\OrderShipping;
use Model\Shipping;
use mysqli;

include_once '../../models/Shipping.php';
include_once '../../models/OrderShipping.php';
include_once '../../models/Customer.php';

class ShippingDAO {
    public static function getList(mysqli $conn): array
    {        
        $sql = "SELECT * FROM `shippings`;";
        $result = $conn->query($sql);
        $list = [];
        while ($row = $result->fetch_array()) {
            $list[] = new Shipping(
                $row['id'],
                $row['name'],
                $row['description'],                
                $row['delete_flag']
            );
        }
        $result->free_result();
        return $list;
    }

    public static function insert(mysqli $conn, Shipping $s): bool
    {
        $sql = 'INSERT INTO `shippings`(`name`, `description`, `delete_flag`) 
                VALUES (? ,? ,?);';
        $stm = $conn->prepare($sql);
        $stm->bind_param('ssi', $s->name, $s->description, $s->delete_flag);
                                             
        return $stm->execute();
    } 

    public static function getById(mysqli $conn, $id): ?Shipping
    {
        $sql = "SELECT * FROM `shippings` WHERE `id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("i", $id);
        $stm->execute();
        $result = $stm->get_result();        
        while ($row = $result->fetch_array()) {
            $result->free_result();
            return new Shipping(
                $row['id'],
                $row['name'],
                $row['description'],                
                $row['delete_flag']
            );
        }
        $result->free_result();
        return null;
    }

    public static function update(mysqli $conn, Shipping $product): bool
    {
        $sql = "UPDATE `shippings` SET `name`= ?,`description`= ?, `delete_flag`= ? WHERE `id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("ssii", $product->name, $product->description
                        , $product->delete_flag, $product->id);                
        
        return $stm->execute();
    }

    public static function toggleStatus(mysqli $conn, $id): bool
    {
        $sql = "UPDATE `shippings` SET `delete_flag`= !`delete_flag` WHERE `id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("i", $id);                
        
        return $stm->execute();
    }

    public static function getDetailById(mysqli $conn, $id): ?OrderShipping
    {
        $sql = "SELECT s.`id`, s.`shipping_id`, s.`customer_id`, s.`shiped_at` 
                , sd.`name` as shipping_name, sd.`description`, sd.`delete_flag` as shipping_status
                , `c`.`name` as customer_name, `c`.`address`, `c`.`phone`, `c`.`email`, `c`.`delete_flag` as customer_status
                FROM `order_shippings` s
                LEFT JOIN shippings sd ON s.`shipping_id` = sd.`id`
                LEFT JOIN customers c ON `s`.`customer_id` = c.`id`
                WHERE s.`id` = 1;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("i", $id);
        $stm->execute();
        $result = $stm->get_result();        
        while ($row = $result->fetch_array()) {
            $result->free_result();
            $pd = new Shipping(
                $row['shipping_id'],                 
                $row['shipping_name'],                 
                $row['description'], 
                $row['shipping_status'],                 
            );
            $c = new Customer(
                $row['customer_id'],
                $row['customer_name'],
                $row['address'],
                $row['phone'],
                $row['email'],
                $row['customer_status'],
            );
            return new OrderShipping(
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