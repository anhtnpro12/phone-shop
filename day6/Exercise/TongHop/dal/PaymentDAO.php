<?php

namespace DataAccessLayer;

use Model\Customer;
use Model\OrderPayment;
use Model\Payment;
use mysqli;

include_once '../../models/Payment.php';
include_once '../../models/OrderPayment.php';
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

    public static function getDetailById(mysqli $conn, $id): ?OrderPayment
    {
        $sql = "SELECT p.`id`, p.`payment_id`, p.`pay_amount`, p.`customer_id`, p.`paid_at` 
                , pd.`name` as payment_name, pd.`description`, pd.`status` as payment_status
                , `c`.`name` as customer_name, `c`.`address`, `c`.`phone`, `c`.`email`, `c`.`status` as customer_status
                FROM `order_payments` p
                LEFT JOIN payments pd ON p.`payment_id` = pd.`id`
                LEFT JOIN customers c ON `p`.`customer_id` = c.`id`
                WHERE p.`id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("i", $id);
        $stm->execute();
        $result = $stm->get_result();        
        while ($row = $result->fetch_array()) {
            $result->free_result();
            $pd = new Payment(
                $row['payment_id'], 
                $row['payment_name'], 
                $row['description'], 
                $row['payment_status'],                 
            );
            $c = new Customer(
                $row['customer_id'],
                $row['customer_name'],
                $row['address'],
                $row['phone'],
                $row['email'],
                $row['customer_status'],
            );
            return new OrderPayment(
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