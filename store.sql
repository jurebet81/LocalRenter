-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-10-2015 a las 05:14:24
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `store`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identification` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `observations` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `amount` int(11) unsigned NOT NULL,
  `unit_price` int(11) NOT NULL,
  `date_submitted` date NOT NULL,
  `observations` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `providers`
--

CREATE TABLE IF NOT EXISTS `providers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `observations` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchasedetails`
--

CREATE TABLE IF NOT EXISTS `purchasedetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `unit_price` float NOT NULL,
  `total_price` float NOT NULL,
  `purchase_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Disparadores `purchasedetails`
--
DROP TRIGGER IF EXISTS `PurchaseAddStockItems`;
DELIMITER //
CREATE TRIGGER `PurchaseAddStockItems` AFTER INSERT ON `purchasedetails`
 FOR EACH ROW BEGIN
    UPDATE products p SET p.amount = NEW.amount + p.amount WHERE p.id = NEW.product_id;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `PurchaseRemoveItem`;
DELIMITER //
CREATE TRIGGER `PurchaseRemoveItem` AFTER DELETE ON `purchasedetails`
 FOR EACH ROW BEGIN
    UPDATE products p SET p.amount = p.amount - OLD.amount WHERE p.id = OLD.product_id;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchases`
--

CREATE TABLE IF NOT EXISTS `purchases` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `provider_id` int(11) NOT NULL,
  `id_invoice` varchar(20) NOT NULL,
  `date_delivered` date NOT NULL,
  `conditions` int(11) NOT NULL,
  `observations` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saledetails`
--

CREATE TABLE IF NOT EXISTS `saledetails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sale_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `amount` int(10) unsigned NOT NULL,
  `unit_price` float unsigned NOT NULL,
  `total_price` float unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Disparadores `saledetails`
--
DROP TRIGGER IF EXISTS `ReturnSoldStockItems`;
DELIMITER //
CREATE TRIGGER `ReturnSoldStockItems` AFTER DELETE ON `saledetails`
 FOR EACH ROW BEGIN
    UPDATE products p SET p.amount = p.amount + OLD.amount WHERE p.id = OLD.product_id;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `UpdateSoldStockItems`;
DELIMITER //
CREATE TRIGGER `UpdateSoldStockItems` AFTER INSERT ON `saledetails`
 FOR EACH ROW BEGIN
    UPDATE products p SET p.amount = p.amount - NEW.amount WHERE p.id = NEW.product_id;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `observations` text,
  `conditions` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `storedetails`
--

CREATE TABLE IF NOT EXISTS `storedetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `nit` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `regimenmessage` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `username` varchar(50) NOT NULL,
  `role` varchar(5) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `role`, `password`) VALUES
(0, 'root', 'admin', '3b0e81aa6c1a51754ce9986770bf796fcdd7eecf'),
(1, 'root', 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
