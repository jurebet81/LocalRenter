-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 15, 2015 at 10:10 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `localrenter`
--
CREATE DATABASE IF NOT EXISTS `localrenter` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `localrenter`;

-- --------------------------------------------------------

--
-- Table structure for table `apartments`
--

CREATE TABLE IF NOT EXISTS `apartments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location_id` int(10) unsigned NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `address` varchar(50) CHARACTER SET latin1 NOT NULL,
  `rent_price` int(11) NOT NULL,
  `observations` text COLLATE utf8_spanish_ci,
  `available` enum('si','no') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'si',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `apartments`
--

INSERT INTO `apartments` (`id`, `location_id`, `name`, `address`, `rent_price`, `observations`, `available`) VALUES
(1, 2, 'San Luis 301', 'Carrea 50 #50-20', 350000, '', 'no'),
(2, 1, 'Andes Suite 201', 'Carrea 50 # 50-20', 320000, 'Factura Nro 2000202', 'si'),
(3, 1, 'Apto de en frente', 'Libertadores Calle 10 #40-20', 230000, 'Culquier info', 'si'),
(4, 2, 'Apto de el lado', 'kjjkjk', 60000, 'asd', 'si'),
(5, 3, '301', 'Calle 50 # 50-20', 300000, '', 'si'),
(6, 3, '203', 'cARRERA', 300000, '', 'si'),
(7, 3, '102', '', 20000, '', 'no'),
(8, 1, 'Apartamento que tenia numeros', 'Carrera 50 # con dire', 15000, '', 'si'),
(9, 1, 'Casa 2', 'carrera calle %52', 220000, '', 'si');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `apartment_id` int(10) unsigned NOT NULL,
  `amount` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `apartment_id`, `amount`, `date`, `description`) VALUES
(1, 2, 56000, '2015-10-21', 'asdasd'),
(2, 4, 89000, '2015-10-14', 'asdasd'),
(3, 8, 50000, '2015-10-15', 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `leases`
--

CREATE TABLE IF NOT EXISTS `leases` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `renter_id` int(10) unsigned NOT NULL,
  `apartment_id` int(10) unsigned NOT NULL,
  `holder_name` varchar(50) NOT NULL,
  `holder_identification` varchar(20) NOT NULL,
  `holder_phone` varchar(20) NOT NULL,
  `init_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `amount` int(10) unsigned NOT NULL DEFAULT '0',
  `frecuency` enum('Mensual','Semanal') NOT NULL DEFAULT 'Mensual',
  `status` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `last_payment_date` date NOT NULL,
  `observations` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `leases`
--

INSERT INTO `leases` (`id`, `renter_id`, `apartment_id`, `holder_name`, `holder_identification`, `holder_phone`, `init_date`, `end_date`, `amount`, `frecuency`, `status`, `last_payment_date`, `observations`) VALUES
(1, 1, 3, 'Wilson Riveraaaa', '1020000', '', '0000-00-00', '2015-10-15', 13000, 'Mensual', 'Inactivo', '2016-01-01', 'Cua'),
(2, 1, 3, 'Cirstian Daniel Ramirez', '88045666', '', '2015-10-14', '2015-10-31', 230000, 'Mensual', 'Inactivo', '2015-12-01', 'adasda'),
(3, 1, 5, 'Daniel Julian Cardona Mendez', '14545255', '', '2015-10-01', '2015-10-15', 300000, 'Mensual', 'Inactivo', '2015-11-14', 'adasda'),
(4, 1, 5, 'Ernesto Samperrrr', '102586688', '', '2015-10-15', '2015-10-15', 200000, 'Mensual', 'Inactivo', '2015-11-13', ''),
(5, 1, 7, 'juan juan', '1010101000', '', '2015-10-15', '2015-10-15', 20000, 'Mensual', 'Inactivo', '2015-10-15', 'Contrato de prueba real'),
(6, 1, 5, 'Restrepo restrepo julian julian', '2020202002', '', '2015-10-15', '2015-10-15', 520000, 'Mensual', 'Inactivo', '2015-11-15', 'Test real modifi'),
(7, 1, 5, 'nombre de inquilino', '55555000', '', '2015-10-15', '2015-10-15', 500000, 'Mensual', 'Inactivo', '2015-10-15', 'info adds'),
(8, 2, 7, 'Julian alberto restrepo', '102455554554', '8415000', '2015-10-15', '2016-10-15', 20000, 'Mensual', 'Activo', '2015-11-15', '');

--
-- Triggers `leases`
--
DROP TRIGGER IF EXISTS `UpdateApartmentAvailable`;
DELIMITER //
CREATE TRIGGER `UpdateApartmentAvailable` AFTER UPDATE ON `leases`
 FOR EACH ROW IF NEW.status = 'Inactivo' THEN
	UPDATE Apartments a SET a.available = 'si' 
	WHERE a.id = NEW.apartment_id;
END IF
//
DELIMITER ;
DROP TRIGGER IF EXISTS `UpdateApartmentNOAvailable`;
DELIMITER //
CREATE TRIGGER `UpdateApartmentNOAvailable` AFTER INSERT ON `leases`
 FOR EACH ROW UPDATE Apartments a SET a.available = 'no' 
WHERE a.id = NEW.apartment_id
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`) VALUES
(1, 'Los Libertadores'),
(2, 'San Luis'),
(3, 'Andes Suite');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lease_id` int(10) unsigned NOT NULL,
  `amount` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `paid_to` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `observations` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `lease_id`, `amount`, `date`, `from_date`, `to_date`, `paid_to`, `observations`) VALUES
(2, 0, 300, '2015-10-14', '2015-10-01', '2015-11-01', '', ''),
(3, 0, 230000, '2015-10-14', '2015-10-31', '2015-12-01', '', ''),
(4, 0, 230000, '2015-10-14', '2015-10-31', '2015-12-01', '', ''),
(5, 0, 300000, '2015-10-14', '2015-10-01', '2015-11-01', '', ''),
(7, 0, 230000, '2015-10-14', '2015-11-01', '2015-12-01', '', ''),
(8, 0, 230000, '2015-10-14', '2015-11-01', '2015-12-01', '', ''),
(9, 1, 230000, '2015-10-14', '2015-12-01', '2016-01-01', '', ''),
(10, 4, 300000, '2015-10-14', '2015-10-13', '2015-11-13', '', ''),
(11, 3, 300000, '2015-10-15', '2015-10-14', '2015-11-14', '', ''),
(12, 6, 520000, '2015-10-15', '2015-10-15', '2015-11-15', '', 'pago test real'),
(13, 8, 20000, '2015-10-15', '2015-10-15', '2015-11-15', 'root', '');

--
-- Triggers `payments`
--
DROP TRIGGER IF EXISTS `updateLeasePaymentDate`;
DELIMITER //
CREATE TRIGGER `updateLeasePaymentDate` AFTER INSERT ON `payments`
 FOR EACH ROW BEGIN
    UPDATE leases l SET l.last_payment_date = NEW.to_date 
	WHERE l.id = NEW.lease_id;
	
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `renters`
--

CREATE TABLE IF NOT EXISTS `renters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identification` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `renters`
--

INSERT INTO `renters` (`id`, `identification`, `name`) VALUES
(1, '1027884448', 'Alberto Alfonso Restrepo Fernandez'),
(2, '43286032', 'Estela Betancur'),
(3, '1024559665', 'Julian restrepo');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `role` varchar(5) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `role`, `password`) VALUES
(1, 'root', 'admin', '3b0e81aa6c1a51754ce9986770bf796fcdd7eecf'),
(2, 'root', 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
