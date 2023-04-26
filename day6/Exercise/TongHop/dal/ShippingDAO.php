<?php

namespace DataAccessLayer;

use Model\Customer;
use Model\OrderShipping;
use Model\Shipping;
use mysqli;

include_once '../../models/Shipping.php';
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

    public static function count(mysqli $conn): int
    {
        $sql = "SELECT COUNT(*) AS count FROM `shippings`;";
        $result = $conn->query($sql);                       
        
        return $result->fetch_row()[0];             
    }  

    public static function getListInRange(mysqli $conn, $from, $length): array
    {        
        $sql = "SELECT * FROM `shippings` LIMIT ?, ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param('ii', $from, $length);
        $stm->execute();
        $result = $stm->get_result();
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
   
}