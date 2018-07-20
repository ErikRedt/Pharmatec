-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-05-2018 a las 18:23:44
-- Versión del servidor: 5.5.59-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `PharmatecDB`
--
CREATE DATABASE IF NOT EXISTS `PharmatecDB` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `PharmatecDB`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

DROP TABLE IF EXISTS `compra`;
CREATE TABLE IF NOT EXISTS `compra` (
  `idcompra` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iduser` int(10) unsigned NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idcompra`),
  KEY `iduser` (`iduser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`idcompra`, `iduser`, `fecha`) VALUES
(1, 1, '2018-05-06 16:03:05'),
(2, 1, '2018-05-06 16:04:08'),
(3, 1, '2018-05-07 14:04:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleCompra`
--

DROP TABLE IF EXISTS `detalleCompra`;
CREATE TABLE IF NOT EXISTS `detalleCompra` (
  `iddetalleCompra` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idcompra` int(10) unsigned NOT NULL,
  `idmedicamento` int(10) unsigned NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` decimal(6,2) NOT NULL,
  PRIMARY KEY (`iddetalleCompra`),
  KEY `iduser` (`idcompra`,`idmedicamento`),
  KEY `idmedicamento` (`idmedicamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `detalleCompra`
--

INSERT INTO `detalleCompra` (`iddetalleCompra`, `idcompra`, `idmedicamento`, `cantidad`, `subtotal`) VALUES
(1, 1, 18, 12, 446.16),
(2, 1, 25, 1, 23.72),
(3, 1, 40, 1, 14.36),
(4, 2, 1, 10, 305.60),
(5, 3, 5, 3, 179.97),
(6, 3, 5, 3, 179.97);

--
-- Disparadores `detalleCompra`
--
DROP TRIGGER IF EXISTS `TR_detalleCompraInsert`;
DELIMITER //
CREATE TRIGGER `TR_detalleCompraInsert` AFTER INSERT ON `detalleCompra`
 FOR EACH ROW BEGIN 
    UPDATE medicamento SET stock = stock + NEW.cantidad
	WHERE medicamento.idmedicamento = NEW.idmedicamento ;
  END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleVenta`
--

DROP TABLE IF EXISTS `detalleVenta`;
CREATE TABLE IF NOT EXISTS `detalleVenta` (
  `iddetalleVenta` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idventa` int(10) unsigned NOT NULL,
  `idmedicamento` int(10) unsigned NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` decimal(6,2) NOT NULL,
  PRIMARY KEY (`iddetalleVenta`),
  KEY `iduser` (`idventa`,`idmedicamento`),
  KEY `idmedicamento` (`idmedicamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `detalleVenta`
--

INSERT INTO `detalleVenta` (`iddetalleVenta`, `idventa`, `idmedicamento`, `cantidad`, `subtotal`) VALUES
(1, 1, 1, 2, 140.00),
(2, 2, 1, 6, 420.00),
(3, 2, 57, 1, 35.00);

--
-- Disparadores `detalleVenta`
--
DROP TRIGGER IF EXISTS `TR_detalleVentaInsert`;
DELIMITER //
CREATE TRIGGER `TR_detalleVentaInsert` AFTER INSERT ON `detalleVenta`
 FOR EACH ROW BEGIN 
    UPDATE medicamento SET stock = stock - NEW.cantidad
	WHERE medicamento.idmedicamento = NEW.idmedicamento ;
  END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamento`
--

DROP TABLE IF EXISTS `medicamento`;
CREATE TABLE IF NOT EXISTS `medicamento` (
  `idmedicamento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idpresentacion` int(10) unsigned NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `imagen` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` float(6,2) NOT NULL,
  `precio_venta` float(6,2) NOT NULL,
  PRIMARY KEY (`idmedicamento`),
  KEY `idpresentacion` (`idpresentacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=83 ;

--
-- Volcado de datos para la tabla `medicamento`
--

INSERT INTO `medicamento` (`idmedicamento`, `idpresentacion`, `nombre`, `descripcion`, `imagen`, `stock`, `precio_compra`, `precio_venta`) VALUES
(1, 1, 'Aciclovir', '200 mg', 'aciclovir- susp.jpg', 10, 30.56, 70.00),
(2, 2, 'Aciclovir', '200 mg', 'aciclovir-200mg.png', 5, 28.40, 75.00),
(3, 3, 'Aciclovir', '400 mg', 'aciclovir-400.jpg', 6, 54.83, 175.00),
(4, 4, 'Ampicilina', '500 mg', 'ampicilina-jarabe.jpg', 4, 14.75, 30.00),
(5, 5, 'Ampigrim', '500 mg adulto', 'amipigrim.jpg', 9, 59.99, 83.00),
(6, 6, 'Ampigrim PFC ', '300 mg', 'ampigrim.jpg', 5, 25.96, 28.00),
(7, 7, 'Ampigrim PFC', 'infantil', 'descarga.jpg', 2, 17.25, 27.00),
(8, 8, 'Ácido Ascorbico', '1 g', 'acido.jpg', 1, 29.77, 44.00),
(9, 4, 'Ambroxol ', '30 mg', 'ambroxol.jpg', 2, 11.29, 20.00),
(10, 4, 'Ambroxol con dextro ', '150 ml', 'histiacil2.png', 2, 14.31, 21.00),
(11, 4, 'Ambroxol + loratadina ', '----', '0750129930286L.jpg', 3, 11.29, 25.00),
(13, 13, 'Amoxicilina', '500 mg', 'amox.png', 2, 23.61, 30.00),
(14, 2, 'Amoxicilina', '500 mg', 'amox.png', 5, 14.89, 30.00),
(16, 12, 'Clamoxin 12 hrs', '400 mg junior', 'camoxidin junior.jpg', 4, 25.17, 57.00),
(17, 12, 'Clamoxin', '500/125 mg', 'amoxcv.png', 8, 29.38, 88.00),
(18, 12, 'Clamoxin 12 hrs ', '875/125', 'mx53125_2.jpg', 24, 37.18, 98.00),
(19, 12, 'Acitromicina', '4g', 'azitromicina.jpg', 3, 58.96, 180.00),
(20, 12, 'Acitromicina', '500 mg', 'azotromicinatabletas.jpg', 3, 29.39, 110.00),
(21, 12, 'Bencilpenicilina proca 800', '---', 'Bencilpenicilina proca 800.png', 6, 9.16, 11.00),
(22, 12, 'Benzonatato ', '100 mg', 'benzonatato.jpg', 2, 17.72, 25.00),
(23, 3, 'Butilhioscina ', '20 mg', 'Butilhioscina20mgInyectable.jpg', 9, 23.75, 29.00),
(24, 3, 'Busconet', '---', 'BusconetInyectable.png', 6, 19.61, 25.00),
(25, 6, 'Cefalexina ', '500 mg', 'Cefalexina500mgCapsulas.jpg', 10, 23.72, 65.00),
(26, 3, 'Cefotaxima ', '500 mg', 'Cefotaxima500mgInyectable.png', 5, 15.67, 52.00),
(27, 4, 'Cefalexina ', '250 mg', 'Cefalexina250mgJarabe.jpg', 3, 23.95, 55.00),
(28, 2, 'Ciprofloxacino ', '250 mg', 'Ciprofloxacino250mgTabletas.jpg', 6, 6.97, 35.00),
(29, 3, 'Ceftriaxona ', '500g', 'Ceftriaxona1gInyectable.jpg', 29, 18.00, 60.00),
(30, 3, 'Ceftriaxona ', '500 mg', 'Ceftriaxona500mgInyectable.jpg', 10, 19.00, 50.00),
(31, 3, 'Ceftazidima ', '1 g', 'Ceftazidima1gInyectable.jpg', 5, 25.14, 60.00),
(32, 3, 'Cefalotina ', '1 g', 'Cefalotina1gInyectable.png', 5, 23.28, 34.00),
(33, 2, 'KY6', '---', 'kaye6tabs.jpg', 4, 4.30, 10.00),
(34, 3, 'Ketorolaco ', '30 mg', 'Ketorolaco30mgInyectable.jpg', 11, 11.03, 44.00),
(35, 2, 'Ketorolaco ', '10 mg', 'Ketorolaco10mgBotella.png', 10, 15.40, 25.00),
(37, 6, 'Ibuprofeno ', '400 mg', 'ibuprofeno.jpg', 17, 10.99, 17.00),
(40, 6, 'Ibuprofeno ', '800 mg', 'ibuprofeno800mg.jpg', 6, 14.36, 22.00),
(41, 2, 'Ciprofloxacino ', '500 mg', 'Ciprofloxacino500mgTabletas.jpg', 5, 16.66, 70.00),
(42, 3, 'Lincomicina ', '300 mg', 'Lincomicina300mgInyectable.jpg', 1, 27.98, 50.00),
(43, 3, 'Lincomicina ', '600 mg', 'Lincomicina600mgInyectable.png', 1, 42.86, 70.00),
(44, 4, 'Ibuprofeno (aflusil)', '---', 'Ibuprofeno(aflusil)Jarabe.jpg', 2, 12.75, 24.00),
(45, 4, 'Ibuprofeno dolprin', '---', 'IbuprofenodolprinJarabe.jpg', 7, 13.22, 25.00),
(46, 8, 'Paracetamol ', 'pediátrico', 'ParacetamolpediátricoGotas.jpg', 5, 12.40, 15.00),
(47, 2, 'Nimesulida ', '100 mg', 'Nimesulida100mgTabletas.jpg', 4, 11.05, 50.00),
(48, 1, 'Eritromicina ', '--', 'EritromicinaSuspensión.jpg', 1, 38.03, 58.00),
(49, 8, 'Vo-Remi ', '---', 'Vo-RemiGotas.jpg', 2, 16.42, 20.00),
(50, 2, 'Loratadina ', '10 mg', 'Loratadina10mgTabletas.jpg', 3, 8.11, 34.00),
(51, 2, 'Metformina ', '850 mg', 'Metformina850mgTabletas.png', 3, 18.56, 30.00),
(52, 2, 'Maviglin ', '500/5 mg', 'Maviglin500-5mgTabletas.jpg', 3, 46.75, 55.00),
(53, 10, 'Ketoconazol ', '---', 'KetoconazolCrema.jpg', 14, 11.50, 23.00),
(54, 2, 'Paracetamol ', '500 mg', 'Paracetamol50.jpeg', 9, 4.33, 7.00),
(55, 3, 'Ranitidina ', '50 mg', '551778.jpg', 9, 15.92, 27.00),
(56, 9, 'Diclofenaco ', '---', 'DiclofenacoGel.jpg', 5, 14.25, 21.00),
(57, 4, 'Loratadina (lovarin)', '---', 'Loratadina(lovarin)Jarabe.jpg', 2, 11.91, 35.00),
(58, 1, 'Cobedina', '---', 'CobedinaSuspensión.png', 2, 23.49, 81.00),
(59, 2, 'Paracetamol + naproxeno ', '300/250 mg', 'Paracetamol + naproxeno.jpg', 3, 17.78, 35.00),
(60, 2, 'Dicloxacilina ', '500 mg', 'Dicloxacilina500mgTabletas.jpg', 1, 19.43, 30.00),
(61, 2, 'Cobedina ', '---', 'CobedinaTabletas.png', 1, 22.48, 42.00),
(62, 10, 'Gelmicin', '---', 'GelmicinCrema.jpg', 5, 14.57, 22.00),
(63, 2, 'Levofloxacino ', '500 mg', 'Levofloxacino500mgTabletas.jpg', 2, 24.28, 149.00),
(64, 2, 'Levofloxacino ', '750 mg', 'Levofloxacino750mgTabletas.jpg', 2, 53.20, 225.00),
(65, 2, 'Ketoconazol ', '200 mg', 'ketoconazol.png', 2, 11.56, 25.00),
(66, 2, 'Meloxicam ', '15 mg', 'Meloxicam15mgTabletas.jpg', 1, 11.05, 40.00),
(67, 1, 'Nitazoxanida ', '---', 'NitazoxanidaSuspensión.jpg', 5, 26.29, 41.00),
(68, 2, 'Nitazoxanida', '500 mg', 'nitazoxanida500mgtab.jpg', 5, 35.85, 52.00),
(69, 2, 'Loperamida ', '2 mg', 'Loperamida2mlTabletas.jpg', 5, 8.22, 11.00),
(70, 2, 'Tramadol ', '50 mg', 'Tramadol50mgTabletas.jpg', 3, 37.91, 40.00),
(71, 2, 'Caridoxen ', '250/200 mg', 'Caridoxen.jpg', 1, 52.80, 84.00),
(72, 1, 'Cefaclor ', '500 mg', 'cefaclor.JPG', 1, 84.18, 149.00),
(73, 11, 'Algodón ', '50 g', 'algodon50g.jpg', 5, 6.12, 10.00),
(74, 12, 'Alcohol ', '125 ml', 'alcohol125.jpg', 10, 3.92, 10.00),
(75, 13, 'Jeringas ', '3 ml 5 jeringas', 'jeringa 3ml.png', 100, 2.00, 10.00),
(76, 13, 'Jeringas ', '5 ml 5 jeringas', 'jeringa 5ml.png', 100, 4.50, 12.50),
(77, 13, 'Jeringas', '10 ml 100 pzas', 'jeringas 10 ml.jpg', 100, 30.00, 150.00),
(78, 13, 'Venda ', '20 cm', 'venda20cm.jpg', 2, 11.60, 17.00),
(79, 13, 'Venda ', '10 cm', 'venda10cm.jpg', 4, 7.02, 11.00),
(80, 13, 'Venda ', '5 cm', 'venda5cm.jpg', 3, 4.40, 10.00),
(82, 11, 'Condones', 'Condones de alta duración.', 'durex.png', 100, 30.00, 60.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('rob.hdz.mtz@gmail.com', 'ee9b14b596218955570f3bc74007682428a963f6f5fe6ff856dae920d82a2f21', '2018-04-30 13:47:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion`
--

DROP TABLE IF EXISTS `presentacion`;
CREATE TABLE IF NOT EXISTS `presentacion` (
  `idpresentacion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idpresentacion`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `presentacion`
--

INSERT INTO `presentacion` (`idpresentacion`, `nombre`) VALUES
(12, 'Botella'),
(6, 'Capsulas'),
(10, 'Crema'),
(5, 'Efervescente'),
(9, 'Gel'),
(8, 'Gotas'),
(3, 'Inyectable'),
(4, 'Jarabe'),
(11, 'Paquete'),
(7, 'Perlas'),
(13, 'Pieza'),
(1, 'Suspensión'),
(2, 'Tabletas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Erik', 'erikr2787@gmail.com', '$2y$10$1lFQu5pXXPF1ZFwKycRn3uYUxpvIHRMMIp5ZksU6O1D2ldxNIsaGa', 'pdSiyQCfhwlSAFJNyN60qelIEPJVBle91fVVHAYPqEwlrM8oqtKDs4Dl3yNU', '2018-04-21 05:36:46', '2018-05-16 21:04:16'),
(2, 'roberto hernandez', 'rob.hdz.mtz@gmail.com', '$2y$10$Y9cuBPEAyfLoNUxIlkclPOsHRvPZYr8GIo.rx4XsND9isBNZbcGX6', NULL, '2018-04-30 13:48:42', '2018-04-30 13:48:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

DROP TABLE IF EXISTS `venta`;
CREATE TABLE IF NOT EXISTS `venta` (
  `idventa` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iduser` int(10) unsigned NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idventa`),
  KEY `iduser` (`iduser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`idventa`, `iduser`, `fecha`) VALUES
(1, 1, '2018-05-06 16:04:35'),
(2, 1, '2018-05-07 13:57:48');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `FK_users_id_compra` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalleCompra`
--
ALTER TABLE `detalleCompra`
  ADD CONSTRAINT `FK_compra_idcompra` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_medicamento_idmedicamento_DC` FOREIGN KEY (`idmedicamento`) REFERENCES `medicamento` (`idmedicamento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalleVenta`
--
ALTER TABLE `detalleVenta`
  ADD CONSTRAINT `FK_medicamento_idmedicamento_DV` FOREIGN KEY (`idmedicamento`) REFERENCES `medicamento` (`idmedicamento`),
  ADD CONSTRAINT `FK_venta_idventa` FOREIGN KEY (`idventa`) REFERENCES `venta` (`idventa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `medicamento`
--
ALTER TABLE `medicamento`
  ADD CONSTRAINT `FK_presentacion_idpresentacion` FOREIGN KEY (`idpresentacion`) REFERENCES `presentacion` (`idpresentacion`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `F` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
