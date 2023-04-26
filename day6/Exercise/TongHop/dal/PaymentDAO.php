<?php

namespace DataAccessLayer;

use Model\Customer;
use Model\OrderPayment;
use Model\Payment;
use mysqli;

include_once '../../models/Payment.php';
include_once '../../models/Customer.php';

class PaymentDAO {
    public static function getList(mysqli $conn): array
    {        
        $sql = "SELECT * FROM `payments`;";
        $result = $conn->query($sql);
        $list = [];
        while ($row = $result->fetch_array()) {
            $list[] = new Payment(
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
        $sql = "SELECT COUNT(*) AS count FROM `payments`;";
        $result = $conn->query($sql);                       
        
        return $result->fetch_row()[0];             
    }  

    public static function getListInRange(mysqli $conn, $from, $length): array
    {        
        $sql = "SELECT * FROM `payments` LIMIT ?, ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param('ii', $from, $length);
        $stm->execute();
        $result = $stm->get_result();
        $list = [];
        while ($row = $result->fetch_array()) {
            $list[] = new Payment(
                $row['id'],
                $row['name'],
                $row['description'],                
                $row['delete_flag']
            );
        }
        $result->free_result();
        return $list;
    }

    public static function insert(mysqli $conn, Payment $s): bool
    {
        $sql = 'INSERT INTO `payments`(`name`, `description`, `delete_flag`) 
                VALUES (? ,? ,?);';
        $stm = $conn->prepare($sql);
        $stm->bind_param('ssi', $s->name, $s->description, $s->delete_flag);
                                             
        return $stm->execute();
    } 

    public static function getById(mysqli $conn, $id): ?Payment
    {
        $sql = "SELECT * FROM `payments` WHERE `id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("i", $id);
        $stm->execute();
        $result = $stm->get_result();        
        while ($row = $result->fetch_array()) {
            $result->free_result();
            return new Payment(
                $row['id'],
                $row['name'],
                $row['description'],                
                $row['delete_flag']
            );
        }
        $result->free_result();
        return null;
    }

    public static function update(mysqli $conn, Payment $product): bool
    {
        $sql = "UPDATE `payments` SET `name`= ?,`description`= ?, `delete_flag`= ? WHERE `id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("ssii", $product->name, $product->description
                        , $product->delete_flag, $product->id);                
        
        return $stm->execute();
    }

    public static function toggleStatus(mysqli $conn, $id): bool
    {
        $sql = "UPDATE `payments` SET `delete_flag`= !`delete_flag` WHERE `id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("i", $id);                
        
        return $stm->execute();
    }

    
}