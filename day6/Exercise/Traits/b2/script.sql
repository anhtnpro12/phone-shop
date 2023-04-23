CREATE DATABASE user;

CREATE TABLE `user`.`orders` (`id` INT NOT NULL AUTO_INCREMENT , `customer_id` INT NOT NULL 
, `address` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NULL , `total` DECIMAL(20,2) NULL , `state` INT NULL 
, `payment` BOOLEAN NULL , `status` BOOLEAN NULL , `created_at` DATETIME NULL 
, `created_by` INT NULL , `modified_at` DATETIME NULL , `modified_by` INT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;