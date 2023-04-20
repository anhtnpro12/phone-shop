<?php

require 'database.php';
require '../models/User.php';

class UserDAO extends Database
{
    public static function insertUser($user_name, $password, $name, $age, $address, $sex): bool
    {
        $connection = self::getConnection();
        $sql = 'INSERT INTO `users` (`user_name`, `password`, `name`, `age`, `address`, `sex`, `last_active`) 
                            VALUES (?, ?, ?, ?, ?, ?, now() - INTERVAL 24 HOUR);';

        $statement = $connection->prepare($sql);
        $statement->bind_param('sssisi', $user_name, $password, $name, $age, $address, $sex);

        // if ($statement->execute()) {
        //     return true;
        // } else {
        //     die('Error: (' . $connection->errno . ') ' . $connection->error);
        //     return false;
        // }
        $success = $statement->execute();
        $connection->close();
        return $success;
    }

    public static function login($user_name, $password): ?User
    {
        $connection = self::getConnection();    
        $query = 'SELECT *
                    FROM `users` 
                    WHERE `user_name`=? and `password`=?';
        $statement = $connection->prepare($query);
        $statement->bind_param('ss', $user_name, $password);
        $statement->execute();
        $result = $statement->get_result();
        while ($row = $result->fetch_array()) {
            $connection->close();
            return new User(
                $row['id'],
                $row['user_name'],
                $row['password'],
                $row['name'],
                $row['age'],
                $row['address'],
                $row['sex'],
                $row['last_active']
            );
        }
        $connection->close();
        return null;
    }

    public static function updateLastActive($user_id): bool
    {
        $connection = self::getConnection();            
        $stmt = $connection->prepare('UPDATE users SET last_active=NOW() WHERE id=?');
        $stmt->bind_param('s', $user_id);
        $success = $stmt->execute();
        $connection->close();
        return $success;
    }
    
    public static function logout($user_id): bool
    {
        $connection = self::getConnection();    
        $stmt = $connection->prepare('UPDATE users SET last_active=NOW()-INTERVAL 24 HOUR WHERE id=?');
        $stmt->bind_param('s', $user_id);
        $success = $stmt->execute();
        $connection->close();
        return $success;
    }

    public static function getNumUserOnline(): int
    {
        $connection = self::getConnection();  
        $result = $connection->query('SELECT COUNT(*) FROM users WHERE last_active >= NOW() - INTERVAL 15 MINUTE')->fetch_row()[0];
        $connection->close();
        return $result;
    }

    public static function getListUser(): array
    {
        $connection = self::getConnection();            
        $list = [];
        $results = $connection->query("SELECT * FROM users;");
        while ($row = $results->fetch_array()) {
            $list[] = new User(
                $row['id'],
                $row['user_name'],
                $row['password'],
                $row['name'],
                $row['age'],
                $row['address'],
                $row['sex'],
                $row['last_active']
            );
        }
        $connection->close();
        return $list;
    }

    public static function updateUser($user_name, $password, $name, $age, $address, $sex, $id): bool
    {
        $connection = self::getConnection();        
        $sql = "UPDATE `users` SET `user_name` = ?, `password` = ?, `name` = ?, `age` = ?
            , `address` = ?, `sex` = ?, `last_active` = NOW() WHERE `users`.`id` = ?";

        $statement = $connection->prepare($sql);
        $statement->bind_param('sssisii', $user_name, $password, $name, $age, $address, $sex, $id);

        // if ($statement->execute()) {
        //     return true;
        // } else {
        //     die('Error: (' . $connection->errno . ') ' . $connection->error);
        //     return false;
        // }
        $success = $statement->execute();
        $connection->close();
        return $success;
    }

    public static function getUserById($id): ?User
    {
        $connection = self::getConnection();            
        $result = $connection->query("SELECT * FROM `users` WHERE `id`=$id");
        while ($row = $result->fetch_array()) {
            $connection->close();
            return new User(
                $row['id'],
                $row['user_name'],
                $row['password'],
                $row['name'],
                $row['age'],
                $row['address'],
                $row['sex'],
                $row['last_active']
            );
        }
        $connection->close();
        return null;
    }

    public static function deleteUserById($id): bool
    {
        $connection = self::getConnection();            
        $query = 'DELETE FROM users WHERE `id`=?';
        $statement = $connection->prepare($query);
        $statement->bind_param('i', $id);
        $success = $statement->execute();
        $connection->close();
        return $success;
    }
}
