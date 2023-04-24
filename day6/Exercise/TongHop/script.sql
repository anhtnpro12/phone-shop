CREATE DATABASE day6;

CREATE TABLE `day6`.`customers` (`id` INT NOT NULL AUTO_INCREMENT 
, `name` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NULL 
, `address` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NULL 
, `phone` VARCHAR(100) NULL , `email` VARCHAR(100) NULL , `status` BOOLEAN NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `day6`.`products` (`id` INT NOT NULL AUTO_INCREMENT 
, `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NULL 
, `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NULL 
, `price` DECIMAL(20,2) NULL , `quantity` INT NULL , `status` BOOLEAN NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `day6`.`orders` (`id` INT NOT NULL AUTO_INCREMENT 
, `customer_id` INT NULL , `amount` DECIMAL(20,2) NULL , `state` INT NULL 
, `status` BOOLEAN NULL , `ship_id` INT NULL , `payment_id` INT NULL 
, `created_at` DATETIME NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `day6`.`order_detail` (`id` INT NOT NULL AUTO_INCREMENT 
, `order_id` INT NOT NULL , `product_id` INT NOT NULL , `quantity` INT NOT NULL 
, PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `day6`.`ships` (`id` INT NOT NULL AUTO_INCREMENT 
, `ship_detail_id` INT NOT NULL , `customer_id` INT NOT NULL 
, `shiped_at` DATETIME NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `day6`.`ship_detail` (`id` INT NOT NULL AUTO_INCREMENT 
, `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL 
, `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL 
, `status` BOOLEAN NULL
, PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `day6`.`pays` (`id` INT NOT NULL AUTO_INCREMENT 
, `pay_detail_id` INT NOT NULL , `pay_amount` DECIMAL(20,2) NOT NULL 
, `customer_id` INT NOT NULL , `paid_at` DATETIME NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `day6`.`pay_detail` (`id` INT NOT NULL AUTO_INCREMENT 
, `name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL 
, `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL 
, `status` BOOLEAN NULL
, PRIMARY KEY (`id`)) ENGINE = InnoDB;

