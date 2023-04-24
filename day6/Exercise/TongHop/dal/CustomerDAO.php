<?php

namespace DataAccessLayer;

use Model\Customer;
use mysqli;

include '../../models/Customer.php';

class CustomerDAO {
    public static function getList(mysqli $conn): array
    {        
        $sql = "SELECT * FROM `customers`;";
        $result = $conn->query($sql);
        $list = [];
        while ($row = $result->fetch_array()) {
            $list[] = new Customer(
                $row['id'],
                $row['name'],
                $row['address'],
                $row['phone'],
                $row['email'],
                $row['status']
            );
        }
        $result->free_result();
        return $list;
    }

    public static function insert(mysqli $conn, Customer $c): bool
    {
        $sql = 'INSERT INTO `customers`(`name`, `address`, `phone`, `email`, `status`) 
                VALUES (? ,? ,? ,?, ?);';
        $stm = $conn->prepare($sql);
        $stm->bind_param('ssssi', $c->name, $c->address, $c->phone, $c->email, $c->status);
                                             
        return $stm->execute();
    } 

    public static function getById(mysqli $conn, $id): ?Customer
    {
        $sql = "SELECT * FROM `customers` WHERE `id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("i", $id);
        $stm->execute();
        $result = $stm->get_result();        
        while ($row = $result->fetch_array()) {
            $result->free_result();
            return new Customer(
                $row['id'],
                $row['name'],
                $row['address'],
                $row['phone'],
                $row['email'],
                $row['status']
            );
        }
        $result->free_result();
        return null;
    }

    public static function update(mysqli $conn, Customer $customer): bool
    {
        $sql = "UPDATE `customers` SET `name`= ?,`address`= ?,`phone`= ?,`email`= ?, `status`= ? WHERE `id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("ssssii", $customer->name, $customer->address
                        , $customer->phone, $customer->email, $customer->status, $customer->id);                
        
        return $stm->execute();
    }

    public static function toggleStatus(mysqli $conn, $id): bool
    {
        $sql = "UPDATE `customers` SET `status`= !`status` WHERE `id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("i", $id);                
        
        return $stm->execute();
    }
}