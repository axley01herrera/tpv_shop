DROP TABLE IF EXISTS `shop_basket`;
CREATE TABLE IF NOT EXISTS `shop_basket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(1) NOT NULL COMMENT '0 Closed\r\n1 Open',
  `dateTime` datetime DEFAULT NULL,
  `date` date DEFAULT NULL,
  `payType` int(1) DEFAULT NULL COMMENT '1 = Cash\r\n2 = Card',
  PRIMARY KEY (`id`)
) 

DROP TABLE IF EXISTS `shop_basket_product`;
CREATE TABLE IF NOT EXISTS `shop_basket_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_basket` int(11) NOT NULL,
  `fk_product` int(11) NOT NULL,
  `amount` float NOT NULL,
  PRIMARY KEY (`id`)
) 

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
) 

DROP TABLE IF EXISTS `shop_product`;
CREATE TABLE IF NOT EXISTS `shop_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `code` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `price` float NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
)