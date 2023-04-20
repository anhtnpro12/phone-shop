<?php

require 'database.php';
require '../models/User.php';

class UserDAO
{
    public static function insertUser($user_name, $password, $name, $age, $address, $sex): bool
    {
        global $connection;
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
        return $statement->execute();
    }

    public static function login($user_name, $password): ?User
    {
        global $connection;
        $query = 'SELECT *
                    FROM `users` 
                    WHERE `user_name`=? and `password`=?';
        $statement = $connection->prepare($query);
        $statement->bind_param('ss', $user_name, $password);
        $statement->execute();
        $result = $statement->get_result();
        while ($row = $result->fetch_array()) {
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
        return null;
    }

    public static function updateLastActive($user_id): bool
    {
        global $connection;
        $stmt = $connection->prepare('UPDATE users SET last_active=NOW() WHERE id=?');
        $stmt->bind_param('s', $user_id);
        return $stmt->execute();
    }
    
    public static function logout($user_id): bool
    {
        global $connection;
        $stmt = $connection->prepare('UPDATE users SET last_active=NOW()-INTERVAL 24 HOUR WHERE id=?');
        $stmt->bind_param('s', $user_id);
        return $stmt->execute();
    }

    public static function getNumUserOnline(): int
    {
        global $connection;
        return $connection->query('SELECT COUNT(*) FROM users WHERE last_active >= NOW() - INTERVAL 15 MINUTE')->fetch_row()[0];
    }

    public static function getListUser(): array
    {
        global $connection;
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
        return $list;
    }

    public static function updateUser($user_name, $password, $name, $age, $address, $sex, $id): bool
    {
        global $connection;
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
        return $statement->execute();
    }

    public static function getUserById($id): ?User
    {
        global $connection;
        $result = $connection->query("SELECT * FROM `users` WHERE `id`=$id");
        while ($row = $result->fetch_array()) {
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
        return null;
    }

    public static function deleteUserById($id): bool
    {
        global $connection;
        $query = 'DELETE FROM users WHERE `id`=?';
        $statement = $connection->prepare($query);
        $statement->bind_param('i', $id);
        return $statement->execute();
    }
}
