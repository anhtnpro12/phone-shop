/*
 Navicat Premium Data Transfer

 Source Server         : A_PHP_COURSE
 Source Server Type    : MySQL
 Source Server Version : 100703 (10.7.3-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : day6

 Target Server Type    : MySQL
 Target Server Version : 100703 (10.7.3-MariaDB)
 File Encoding         : 65001

 Date: 26/04/2023 17:32:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NULL DEFAULT NULL,
  `phone` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `delete_flag` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (1, 'Trá»‹nh Nam Anh', 'HÃ  Ná»™i', '0123456789', 'anh@anh.commm.vn', 0);
INSERT INTO `customers` VALUES (2, 'há»‘ há»‘ há»‘', 'ThÃ nh phá»‘ Há»“ ChÃ­ Minh', '0123456789', 'test@213.com', 0);
INSERT INTO `customers` VALUES (3, 'há»‘ há»‘ há»‘', 'Nháº­t Báº£n', '0123456789', 'anh@gmail.com', 1);
INSERT INTO `customers` VALUES (4, 'hÃ¡ hÃ¡ hÃ¡', 'HÃ n Quá»‘c', '0123456789', 'test@213.com', 1);
INSERT INTO `customers` VALUES (5, 'hÃ  hÃ  hÃ ', 'ThÃ nh phá»‘ Há»“ ChÃ­ Minh', '0123456789', 'asdfasdf@asdf', 1);
INSERT INTO `customers` VALUES (6, 'hÃ  hÃ  hÃ ', 'ThÃ nh phá»‘ Há»“ ChÃ­ Minh', '0123456789', 'anh@gmail.com', 1);

-- ----------------------------
-- Table structure for order_detail
-- ----------------------------
DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE `order_detail`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_detail
-- ----------------------------

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NULL DEFAULT NULL,
  `amount` decimal(20, 2) NULL DEFAULT NULL,
  `state` int NULL DEFAULT NULL,
  `delete_flag` tinyint(1) NULL DEFAULT NULL,
  `ship_id` int NULL DEFAULT NULL,
  `payment_id` int NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `paid_at` datetime NULL DEFAULT NULL,
  `shipped_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------

-- ----------------------------
-- Table structure for payments
-- ----------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NULL,
  `delete_flag` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payments
-- ----------------------------
INSERT INTO `payments` VALUES (1, 'há»‘ há»‘ há»‘', 'ka kakakakakakak', 0);
INSERT INTO `payments` VALUES (2, 'Paypal', 'hÃ¡ hÃ¡ hÃ¡ hÃ¡ hÃ¡ ', 1);

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NULL,
  `price` decimal(20, 2) NULL DEFAULT NULL,
  `quantity` int NULL DEFAULT NULL,
  `delete_flag` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'asdf', 'ÄÃ  Náºµng', 10000.00, 12, 1);
INSERT INTO `products` VALUES (2, 'há»‘ há»‘ há»‘', 'Cao Báº±ng', 1234.00, 24, 0);
INSERT INTO `products` VALUES (3, 'hÃ¡ hÃ¡ hÃ¡', 'asdfasdfasd', 321.00, 5, 0);
INSERT INTO `products` VALUES (4, 'há»‘ há»‘ há»‘', 'kakakakakakaka', 12345.00, 12, 1);
INSERT INTO `products` VALUES (5, 'hÃ  hÃ  hÃ ', 'kÃ  kÃ  kÃ  kÃ  kÃ  kÃ  ', 532.00, 32, 1);
INSERT INTO `products` VALUES (6, 'há»‘ há»‘ há»‘', 'kakakakakakakakakakakakakakakaka', 12345.00, 5, 1);
INSERT INTO `products` VALUES (7, 'hÃ¡ hÃ¡ hÃ¡', 'kakakakakakakak', 123.00, 23, 0);
INSERT INTO `products` VALUES (8, 'hÃ¡ hÃ¡ hÃ¡', 'kakakakakakakak', 123.00, 23, 1);
INSERT INTO `products` VALUES (9, 'hÃ¡ hÃ¡ hÃ¡', 'kakakakakakakak', 123.00, 23, 1);
INSERT INTO `products` VALUES (10, 'hÃ¡ hÃ¡ hÃ¡', 'kakakakakakakak', 123.00, 23, 1);
INSERT INTO `products` VALUES (11, 'hÃ¡ hÃ¡ hÃ¡', 'kakakakakakakak', 123.00, 23, 1);
INSERT INTO `products` VALUES (12, 'hÃ¡ hÃ¡ hÃ¡', 'kakakakakakakak', 123.00, 23, 1);
INSERT INTO `products` VALUES (13, 'hÃ¡ hÃ¡ hÃ¡', 'kakakakakakakak', 123.00, 23, 0);
INSERT INTO `products` VALUES (14, 'hohohoho', 'kakakaka', 23.00, 2, 0);
INSERT INTO `products` VALUES (15, 'hohohoho', 'kakakaka', 23.00, 2, 1);
INSERT INTO `products` VALUES (16, 'hohohoho', 'kakakaka', 23.00, 2, 1);

-- ----------------------------
-- Table structure for shippings
-- ----------------------------
DROP TABLE IF EXISTS `shippings`;
CREATE TABLE `shippings`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `delete_flag` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of shippings
-- ----------------------------
INSERT INTO `shippings` VALUES (1, 'COD', 'LÃ  phÆ°Æ¡ng phÃ¡p giao Ä‘áº¿n táº­n giÆ°á»ng cá»§a báº¡n', 1);
INSERT INTO `shippings` VALUES (2, 'há»‘ há»‘ há»‘', 'hahahahahahah', 1);
INSERT INTO `shippings` VALUES (3, 'há»‘ há»‘ há»‘', 'araerqaweraer', 0);
INSERT INTO `shippings` VALUES (4, 'hÃ¡ hÃ¡ hÃ¡', 'haf gahadfasdf', 1);

SET FOREIGN_KEY_CHECKS = 1;
