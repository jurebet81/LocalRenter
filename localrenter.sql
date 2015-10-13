-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-10-2015 a las 14:21:35
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `localrenter`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apartaments`
--

CREATE TABLE IF NOT EXISTS `apartaments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location_id` int(10) unsigned NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `address` varchar(50) NOT NULL,
  `rent_price` int(11) NOT NULL,
  `observations` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `available` enum('si','no') CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'si',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `apartaments`
--

INSERT INTO `apartaments` (`id`, `location_id`, `name`, `address`, `rent_price`, `observations`, `available`) VALUES
(1, 0, 'San Luis 301', 'Carrea 50 #50-20', 350000, '', 'no'),
(2, 0, 'Andes Suite 201', 'Carrea 50 # 50-20', 320000, 'Factura Nro 2000202', 'si'),
(3, 1, 'Apto de en frente', 'Libertadores Calle 10 #40-20', 230000, 'Culquier info', 'si'),
(4, 2, 'Apto de el lado', 'kjjkjk', 60000, 'asd', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `leases`
--

CREATE TABLE IF NOT EXISTS `leases` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `apartament_id` int(10) unsigned NOT NULL,
  `init_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `observations` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `locations`
--

INSERT INTO `locations` (`id`, `name`) VALUES
(1, 'Los Libertadores'),
(2, 'San Luis'),
(3, 'Andes Suite');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `renters`
--

CREATE TABLE IF NOT EXISTS `renters` (
  `id` int(10) unsigned NOT NULL,
  `identification` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
