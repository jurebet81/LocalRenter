/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50610
Source Host           : localhost:3306
Source Database       : store

Target Server Type    : MYSQL
Target Server Version : 50610
File Encoding         : 65001

Date: 2014-02-21 13:53:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `clients`
-- ----------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT '',
  `address` varchar(50) DEFAULT '',
  `observations` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of clients
-- ----------------------------


-- ----------------------------
-- Table structure for `products`
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `amount` int(11) unsigned NOT NULL,
  `unit_price` int(11) unsigned NOT NULL,
  `date_submitted` date NOT NULL,
  `observations` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of products
-- ----------------------------


-- ----------------------------
-- Table structure for `providers`
-- ----------------------------
DROP TABLE IF EXISTS `providers`;
CREATE TABLE `providers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `observations` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of providers
-- ----------------------------


-- ----------------------------
-- Table structure for `purchasedetails`
-- ----------------------------
DROP TABLE IF EXISTS `purchasedetails`;
CREATE TABLE `purchasedetails` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) unsigned NOT NULL,
  `purchase_id` int(11) unsigned NOT NULL,
  `amount` int(11) unsigned NOT NULL,
  `unit_price` int(11) unsigned NOT NULL,
  `total_price` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of purchasedetails
-- ----------------------------


-- ----------------------------
-- Table structure for `purchases`
-- ----------------------------
DROP TABLE IF EXISTS `purchases`;
CREATE TABLE `purchases` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `provider_id` int(11) unsigned NOT NULL,
  `id_invoice` varchar(50) DEFAULT '',
  `date_requested` date NOT NULL,
  `date_delivered` date NOT NULL,
  `observations` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of purchases
-- ----------------------------


-- ----------------------------
-- Table structure for `saledetails`
-- ----------------------------
DROP TABLE IF EXISTS `saledetails`;
CREATE TABLE `saledetails` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) unsigned NOT NULL,
  `sale_id` int(11) unsigned NOT NULL,
  `amount` int(11) unsigned NOT NULL,
  `unit_price` int(11) unsigned NOT NULL,
  `total_price` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of saledetails
-- ----------------------------


-- ----------------------------
-- Table structure for `sales`
-- ----------------------------
DROP TABLE IF EXISTS `sales`;
CREATE TABLE `sales` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) unsigned NOT NULL,
  `date` date NOT NULL,
  `observations` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sales
-- ----------------------------


-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `role` varchar(20) NOT NULL,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('3', 'Julian', '7a87d3ec23056262544def348aa90faad10f7219', 'admin', '2014-02-17', '2014-02-17');
DROP TRIGGER IF EXISTS `add_amount_purchase`;
DELIMITER ;;
CREATE TRIGGER `add_amount_purchase` BEFORE INSERT ON `purchasedetails` FOR EACH ROW BEGIN
DECLARE am INT;

SET am = (SELECT amount FROM products WHERE id = NEW.product_id LIMIT 1);
SET am = am + NEW.amount;
UPDATE products SET amount = am WHERE id = NEW.product_id;

END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `subtract_amount_purchase`;
DELIMITER ;;
CREATE TRIGGER `subtract_amount_purchase` AFTER DELETE ON `purchasedetails` FOR EACH ROW BEGIN
DECLARE am INT;

SET am = (SELECT amount FROM products WHERE id = OLD.product_id LIMIT 1);
SET am = am - OLD.amount;
UPDATE products SET amount = am WHERE id = OLD.product_id;

END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `subtract_amount_sale`;
DELIMITER ;;
CREATE TRIGGER `subtract_amount_sale` BEFORE INSERT ON `saledetails` FOR EACH ROW BEGIN
DECLARE am INT;

SET am = (SELECT amount FROM products WHERE id = NEW.product_id LIMIT 1);
SET am = am - NEW.amount;
UPDATE products SET amount = am WHERE id = NEW.product_id;

END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `add_amount_sale`;
DELIMITER ;;
CREATE TRIGGER `add_amount_sale` AFTER DELETE ON `saledetails` FOR EACH ROW BEGIN
DECLARE am INT;

SET am = (SELECT amount FROM products WHERE id = OLD.product_id LIMIT 1);
SET am = am + OLD.amount;
UPDATE products SET amount = am WHERE id = OLD.product_id;

END
;;
DELIMITER ;
