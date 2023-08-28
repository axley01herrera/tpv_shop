-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-08-2023 a las 19:21:47
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `shoptpv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shop_basket`
--

DROP TABLE IF EXISTS `shop_basket`;
CREATE TABLE IF NOT EXISTS `shop_basket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(1) NOT NULL COMMENT '0 Closed\r\n1 Open',
  `dateTime` datetime DEFAULT NULL,
  `date` date DEFAULT NULL,
  `payType` int(1) DEFAULT NULL COMMENT '1 = Cash\r\n2 = Card',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shop_basket_product`
--

DROP TABLE IF EXISTS `shop_basket_product`;
CREATE TABLE IF NOT EXISTS `shop_basket_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_basket` int(11) NOT NULL,
  `fk_product` int(11) NOT NULL,
  `amount` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='join table to relate basket with products ';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shop_config`
--

DROP TABLE IF EXISTS `shop_config`;
CREATE TABLE IF NOT EXISTS `shop_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cif` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `address1` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `address2` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `city` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `state` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `zipCode` int(5) DEFAULT NULL,
  `country` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `phone` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(999) COLLATE utf8_spanish_ci NOT NULL DEFAULT '$2y$10$AqHRm7ncB4yYCLYQv7yDvu5amAsD7RQ.GDHH/O84RgthbT1tiHIfu',
  `printer` varchar(999) COLLATE utf8_spanish_ci DEFAULT 'smb://AcerNitroDev/POS80 Printer',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shop_product`
--

DROP TABLE IF EXISTS `shop_product`;
CREATE TABLE IF NOT EXISTS `shop_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `code` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `price` float NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
