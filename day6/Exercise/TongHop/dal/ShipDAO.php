<?php

namespace DataAccessLayer;

use Model\ShipDetail;
use mysqli;

include '../../models/ShipDetail.php';

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
}