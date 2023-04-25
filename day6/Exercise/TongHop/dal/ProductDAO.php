<?php

namespace DataAccessLayer;

use Model\Product;
use mysqli;

include_once '../../models/Product.php';

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
                $row['delete_flag']
            );
        }
        $result->free_result();
        return $list;
    }

    public static function getListInRange(mysqli $conn, $from, $length): array
    {        
        $sql = "SELECT * FROM `products` LIMIT ?, ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param('ii', $from, $length);
        $stm->execute();
        $result = $stm->get_result();
        $list = [];
        while ($row = $result->fetch_array()) {
            $list[] = new Product(
                $row['id'],
                $row['name'],
                $row['description'],
                $row['price'],
                $row['quantity'],
                $row['delete_flag']
            );
        }
        $result->free_result();
        return $list;
    }

    public static function insert(mysqli $conn, Product $c): bool
    {
        $sql = 'INSERT INTO `products`(`name`, `description`, `price`, `quantity`, `delete_flag`) 
                VALUES (? ,? ,? ,? ,?);';
        $stm = $conn->prepare($sql);
        $stm->bind_param('sssii', $c->name, $c->description, $c->price, $c->quantity, $c->delete_flag);
                                             
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
                $row['delete_flag']
            );
        }
        $result->free_result();
        return null;
    }

    public static function update(mysqli $conn, Product $product): bool
    {
        $sql = "UPDATE `products` SET `name`= ?,`description`= ?,`price`= ?,`quantity`= ?, `delete_flag`= ? WHERE `id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("sssiii", $product->name, $product->description
                        , $product->price, $product->quantity, $product->delete_flag, $product->id);                
        
        return $stm->execute();
    }

    public static function toggleStatus(mysqli $conn, $id): bool
    {
        $sql = "UPDATE `products` SET `delete_flag`= !`delete_flag` WHERE `id` = ?;";
        $stm = $conn->prepare($sql);
        $stm->bind_param("i", $id);                
        
        return $stm->execute();
    }   
    
    public static function count(mysqli $conn): int
    {
        $sql = "SELECT COUNT(*) AS count FROM `products`;";
        $result = $conn->query($sql);                       
        
        return $result->fetch_row()[0];             
    }    
}