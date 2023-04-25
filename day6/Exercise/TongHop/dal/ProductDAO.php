<?php

namespace DataAccessLayer;

use Model\Product;
use mysqli;

include '../../models/Product.php';

class ProductDAO {
    public static function getList(mysqli $conn): array
    {        
        $sql = "SELECT * FROM `products`;";
        $result = $conn->query($sql);
        $list = [];
        while ($row = $result->fetch_array()) {
            $list[] = new Product(
                $row['id'],
                $row['name'],
                $row['description'],
                $row['price'],
                $row['quantity'],
                $row['status']
            );
        }
        $result->free_result();
        return $list;
    }

    public static function insert(mysqli $conn, Product $c): bool
    {
        $sql = 'INSERT INTO `products`(`name`, `description`, `price`, `quantity`, `status`) 
                VALUES (? ,? ,? ,? ,?);';
        $stm = $conn->prepare($sql);
        $stm->bind_param('sssii', $c->name, $c->description, $c->price, $c->quantity, $c->status);
                                             
        return $stm->execute();
    } 

    public static function getById(mysqli $conn, $id): ?Product
    {
        $sql = "SELECT * FROM `products` WHERE `id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("i", $id);
        $stm->execute();
        $result = $stm->get_result();        
        while ($row = $result->fetch_array()) {
            $result->free_result();
            return new Product(
                $row['id'],
                $row['name'],
                $row['description'],
                $row['price'],
                $row['quantity'],
                $row['status']
            );
        }
        $result->free_result();
        return null;
    }

    public static function update(mysqli $conn, Product $product): bool
    {
        $sql = "UPDATE `products` SET `name`= ?,`description`= ?,`price`= ?,`quantity`= ?, `status`= ? WHERE `id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("sssiii", $product->name, $product->description
                        , $product->price, $product->quantity, $product->status, $product->id);                
        
        return $stm->execute();
    }

    public static function toggleStatus(mysqli $conn, $id): bool
    {
        $sql = "UPDATE `products` SET `status`= !`status` WHERE `id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("i", $id);                
        
        return $stm->execute();
    }        
}