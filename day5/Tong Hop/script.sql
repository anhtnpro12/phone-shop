CREATE DATABASE user;

CREATE TABLE `user`.`users` (`id` INT NOT NULL AUTO_INCREMENT , `user_name` VARCHAR(100) NOT NULL 
, `password` VARCHAR(100) NOT NULL , `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NULL 
, `age` INT NULL , `address` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NULL , `sex` BOOLEAN NULL 
, `last_active` DATETIME NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;