-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2022 at 03:01 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cobranza_amares`
--

-- --------------------------------------------------------

--
-- Table structure for table `cat_estatus_pago`
--

CREATE TABLE `cat_estatus_pago` (
  `id_estatus_pago` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cat_estatus_pago`
--

INSERT INTO `cat_estatus_pago` (`id_estatus_pago`, `nombre`) VALUES
(1, 'Pagado'),
(2, 'Parcial');

-- --------------------------------------------------------

--
-- Table structure for table `cat_estatus_venta`
--

CREATE TABLE `cat_estatus_venta` (
  `id_estatus_venta` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cat_estatus_venta`
--

INSERT INTO `cat_estatus_venta` (`id_estatus_venta`, `nombre`) VALUES
(1, 'Apartado'),
(2, 'Enganche'),
(3, 'Enganche Mensualidad'),
(4, 'Pendiente de Firma de Contrato'),
(5, 'Contrato Firmado'),
(6, 'Pagado');

-- --------------------------------------------------------

--
-- Table structure for table `cat_tipo_compra`
--

CREATE TABLE `cat_tipo_compra` (
  `id_tipo_compra` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cat_tipo_compra`
--

INSERT INTO `cat_tipo_compra` (`id_tipo_compra`, `nombre`) VALUES
(1, 'Financiado'),
(2, 'Contado'),
(3, 'Contado Comercial'),
(4, 'MSI');

-- --------------------------------------------------------

--
-- Table structure for table `cat_tipo_lote`
--

CREATE TABLE `cat_tipo_lote` (
  `id_tipo_lote` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cat_tipo_lote`
--

INSERT INTO `cat_tipo_lote` (`id_tipo_lote`, `nombre`) VALUES
(1, 'Premium'),
(2, 'Estandar'),
(3, 'Plus');

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido_paterno` varchar(50) NOT NULL,
  `apellido_materno` varchar(50) NOT NULL,
  `residencia` varchar(50) NOT NULL,
  `nacionalidad` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(13) NOT NULL,
  `estado_civil` varchar(50) NOT NULL,
  `act_economica` varchar(50) NOT NULL,
  `fecha_captura` date NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha en la que se capturo el registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellido_paterno`, `apellido_materno`, `residencia`, `nacionalidad`, `correo`, `direccion`, `telefono`, `estado_civil`, `act_economica`, `fecha_captura`) VALUES
(1, 'Cesar Julian', 'Toraya ', 'Novelo', 'Mérida', 'Mexicana', 'cesartn12@gmail.com', '', '999 360 0284', 'Soltero', 'Desarrollador', '2022-03-05'),
(2, 'Jorge Carlos', 'Navarrete', 'Torres', 'Mérida', 'Mexicana', 'jorgecnt98@gmail.com', 'asdfasdf', '999 579 9501', 'Casado', 'Desarrollador', '2022-03-05'),
(3, 'Maritzel Beatriz', 'Euan', 'Solis', 'Uman', 'Mexicana', 'maritzels@gmail.com', '', '9991409186', 'Soltera', 'Administrador de Proyectos', '2022-03-05'),
(4, 'Ana Carolina ', 'Martinez', 'Maza', 'Mocochá', 'Mexicana', 'karo@gmail.com', '', '999 397 1844', 'Soltera', 'Coordinadora ', '2022-03-05'),
(10, 'Nicte-Ha', 'Velez', 'Koeppel', 'Playa del carmen ', 'Mexicana ', 'NICKYVK@ICLOUD.COM ', '', '2283110412', '', '', '2022-03-05'),
(11, 'Ramei', 'Dubois', 'Garcia', 'Ciudad de Mexico ', 'Mexicana ', 'Ramaeldubois@hotmail.com', '', '5510697917', '', '', '2022-03-05'),
(12, 'Isaac', 'Banman', 'Derksen', 'Sherwood Park', 'Canadiense', 'isaacdereksen@gmail.com', '', '7809269523', '', '', '2022-03-05'),
(13, 'Luis Alonso', 'Joya', 'Villareal', 'San Pedro de Garza Garcia', 'Mexicana', 'luisjoya7@yahoo.com', '', '8115873786', '', '', '2022-03-05'),
(14, 'Alma Leticia', 'Medellin', 'Bazaldua', 'San Pedro de Garza Garcia', 'Mexicana', 'luisjoya7@yahoo.com', '', '8115873786', '', '', '2022-03-05'),
(15, 'Rosalie', 'Roeper', '', 'Amsterdam', 'Holandesa', 'rosalieroeper@live.nl ', '', ' +31 68321989', '', '', '2022-03-05'),
(16, 'Laurena', 'Rutgers', '', 'Amsterdam', 'Holandesa', ' laurentarutgers1@gmail.com', '', '+31 655818843', '', '', '2022-03-05'),
(17, 'Carlos Ernesto', 'Gutierrez', 'Villaseñor', 'Canada', 'Mexicano', 'neno.gutierrez.03@gmail.com', '', '9057836955', '', '', '2022-03-05'),
(18, 'Roberto', 'Luna', 'Salcedo', 'Solidaridad', 'Mexicano', 'ing_roberto_luna@outlook.es', '', '3337241815', '', '', '2022-03-05'),
(19, 'Olga Maria', 'Rocha ', 'Leon', 'Colombiana', 'Mexicano', 'neno.gutierrez.03@gmail.com', '', '9057836955', '', '', '2022-03-05');

-- --------------------------------------------------------

--
-- Table structure for table `cliente_contrato`
--

CREATE TABLE `cliente_contrato` (
  `id_cliente_contrato` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cliente_contrato`
--

INSERT INTO `cliente_contrato` (`id_cliente_contrato`, `id_cliente`, `id_contrato`) VALUES
(12511, 2, 23),
(12513, 1, 25),
(12514, 2, 27);

-- --------------------------------------------------------

--
-- Table structure for table `concepto`
--

CREATE TABLE `concepto` (
  `id_concepto` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `concepto`
--

INSERT INTO `concepto` (`id_concepto`, `nombre`) VALUES
(1, 'APARTADO'),
(2, 'ENGANCHE'),
(3, 'MENSUALIDAD ENGANCHE'),
(4, 'MENSUALIDAD CONTRATO'),
(5, 'ABONO A CAPITAL'),
(6, 'PAGO FINAL');

-- --------------------------------------------------------

--
-- Table structure for table `contrato`
--

CREATE TABLE `contrato` (
  `id_contrato` int(11) NOT NULL,
  `fecha_contrato` date NOT NULL,
  `fecha_firma` date NOT NULL,
  `precio_venta` float NOT NULL,
  `id_tipo_compra` int(11) DEFAULT NULL,
  `cant_apartado` float NOT NULL,
  `fecha_apartado` date NOT NULL,
  `cant_enganche` float NOT NULL,
  `fecha_enganche` date NOT NULL,
  `mensualidades` int(50) NOT NULL,
  `mensualidades_enganche` int(50) NOT NULL,
  `monto_mensual` float NOT NULL,
  `tasa_interes` float NOT NULL,
  `pago_final` float NOT NULL,
  `id_estatus_venta` int(11) DEFAULT NULL,
  `dia_pago` date NOT NULL,
  `nombre_descuento` varchar(100) NOT NULL,
  `descuento` float NOT NULL,
  `nombre_broker` varchar(50) NOT NULL,
  `comision_broker` float NOT NULL,
  `clientes` varchar(300) NOT NULL,
  `id_lote` int(11) NOT NULL,
  `observaciones` varchar(1000) NOT NULL,
  `fecha_captura` date NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha en la que se captura el registro',
  `cant_mensual_enganche` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contrato`
--

INSERT INTO `contrato` (`id_contrato`, `fecha_contrato`, `fecha_firma`, `precio_venta`, `id_tipo_compra`, `cant_apartado`, `fecha_apartado`, `cant_enganche`, `fecha_enganche`, `mensualidades`, `mensualidades_enganche`, `monto_mensual`, `tasa_interes`, `pago_final`, `id_estatus_venta`, `dia_pago`, `nombre_descuento`, `descuento`, `nombre_broker`, `comision_broker`, `clientes`, `id_lote`, `observaciones`, `fecha_captura`, `cant_mensual_enganche`) VALUES
(23, '2022-02-28', '2022-02-01', 1000, 1, 10000, '2022-02-28', 5000, '2022-02-28', 144, 6, 5000, 0, 5500, 2, '2022-03-22', '', 0, '', 0, 'Navarrete Torres Jorge Carlos', 1, '', '2022-03-05', 0),
(25, '0000-00-00', '0000-00-00', 35000, 1, 3500, '2022-03-18', 3500, '2022-04-18', 144, 8, 243.05, 19.44, 3500, 3, '2022-05-18', '', 0, '', 0, '', 2, '', '0000-00-00', 0),
(27, '0000-00-00', '0000-00-00', 21000, 1, 0, '0000-00-00', 7800, '2022-03-14', 0, 8, 227.32, 8, 350, 1, '2022-03-31', '', 0, '', 0, 'Navarrete Torres Jorge Carlos', 212, '', '2022-03-13', 975);

-- --------------------------------------------------------

--
-- Table structure for table `cuentas_usuario`
--

CREATE TABLE `cuentas_usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cuentas_usuario`
--

INSERT INTO `cuentas_usuario` (`id_usuario`, `usuario`, `password`, `nombre`) VALUES
(1, 'admin', 'admin', 'Administrador');

-- --------------------------------------------------------

--
-- Table structure for table `lotes`
--

CREATE TABLE `lotes` (
  `id_lote` int(11) NOT NULL,
  `fase` varchar(50) NOT NULL,
  `super_manzana` varchar(50) NOT NULL,
  `mza` varchar(50) NOT NULL,
  `lote` varchar(50) NOT NULL,
  `m2` float NOT NULL,
  `cos` float NOT NULL,
  `cus` float NOT NULL,
  `uso` varchar(50) NOT NULL,
  `id_tipo_lote` int(11) NOT NULL,
  `fecha_entrega` date NOT NULL,
  `disponibilidad` varchar(50) NOT NULL,
  `precio_lista` float NOT NULL,
  `estatus` int(11) NOT NULL COMMENT 'Indica si el lote ya fue ocupado por algun cliente o no.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lotes`
--

INSERT INTO `lotes` (`id_lote`, `fase`, `super_manzana`, `mza`, `lote`, `m2`, `cos`, `cus`, `uso`, `id_tipo_lote`, `fecha_entrega`, `disponibilidad`, `precio_lista`, `estatus`) VALUES
(1, '1', '1', '3', '1', 1, 378.11, 756.21, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 100, 0),
(2, '1', '1', '3', '2', 841.31, 294.46, 588.92, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 200, 0),
(3, '1', '1', '3', '3', 841.31, 294.46, 588.92, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 300, 0),
(4, '1', '1', '3', '4', 785.99, 275.1, 550.19, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 400, 0),
(5, '1', '1', '3', '5', 919.45, 321.81, 643.62, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 500, 0),
(6, '1', '1', '3', '6', 845.18, 295.81, 591.63, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 600, 0),
(7, '1', '1', '3', '7', 712.93, 249.53, 499.05, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 700, 0),
(8, '1', '1', '3', '8', 749.37, 262.28, 524.56, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 800, 0),
(9, '1', '1', '3', '9', 749.37, 262.28, 524.56, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 900, 0),
(10, '1', '1', '3', '10', 988.36, 345.93, 691.85, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 1000, 0),
(11, '1', '1', '4', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 1100, 0),
(12, '1', '1', '4', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 1200, 0),
(13, '1', '1', '4', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 1300, 0),
(14, '1', '1', '4', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 1400, 0),
(15, '1', '1', '4', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 1500, 0),
(16, '1', '1', '4', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 1600, 0),
(17, '1', '1', '4', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 1700, 0),
(18, '1', '1', '4', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 1800, 0),
(19, '1', '1', '4', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 1900, 0),
(20, '1', '1', '4', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 2000, 0),
(21, '1', '1', '4', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 2100, 0),
(22, '1', '1', '4', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 2200, 0),
(23, '1', '1', '5', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 2300, 0),
(24, '1', '1', '5', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 2400, 0),
(25, '1', '1', '5', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 2500, 0),
(26, '1', '1', '5', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 2600, 0),
(27, '1', '1', '5', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 2700, 0),
(28, '1', '1', '5', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 2800, 0),
(29, '1', '1', '5', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 2900, 0),
(30, '1', '1', '5', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 3000, 0),
(31, '1', '1', '5', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 3100, 0),
(32, '1', '1', '5', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 3200, 0),
(33, '1', '1', '5', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 3300, 0),
(34, '1', '1', '5', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 3400, 0),
(35, '1', '1', '6', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 3500, 0),
(36, '1', '1', '6', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 3600, 0),
(37, '1', '1', '6', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 3700, 0),
(38, '1', '1', '6', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 3800, 0),
(39, '1', '1', '6', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 3900, 0),
(40, '1', '1', '6', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 4000, 0),
(41, '1', '1', '6', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 4100, 0),
(42, '1', '1', '6', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 4200, 0),
(43, '1', '1', '6', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 4300, 0),
(44, '1', '1', '6', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 4400, 0),
(45, '1', '1', '6', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 4500, 0),
(46, '1', '1', '6', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 4600, 0),
(47, '1', '1', '7', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 4700, 0),
(48, '1', '1', '7', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 4800, 0),
(49, '1', '1', '7', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 4900, 0),
(50, '1', '1', '7', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 5000, 0),
(51, '1', '1', '7', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 5100, 0),
(52, '1', '1', '7', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 5200, 0),
(53, '1', '1', '7', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 5300, 0),
(54, '1', '1', '7', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 5400, 0),
(55, '1', '1', '7', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 5500, 0),
(56, '1', '1', '7', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 5600, 0),
(57, '1', '1', '7', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 5700, 0),
(58, '1', '1', '7', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 5800, 0),
(59, '1', '1', '8', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 5900, 0),
(60, '1', '1', '8', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 6000, 0),
(61, '1', '1', '8', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 6100, 0),
(62, '1', '1', '8', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 6200, 0),
(63, '1', '1', '8', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 6300, 0),
(64, '1', '1', '8', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 6400, 0),
(65, '1', '1', '8', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 6500, 0),
(66, '1', '1', '8', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 6600, 0),
(67, '1', '1', '8', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 6700, 0),
(68, '1', '1', '8', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 6800, 0),
(69, '1', '1', '8', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 6900, 0),
(70, '1', '1', '8', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 7000, 0),
(71, '1', '1', '9', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 7100, 0),
(72, '1', '1', '9', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 7200, 0),
(73, '1', '1', '9', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 7300, 0),
(74, '1', '1', '9', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 7400, 0),
(75, '1', '1', '9', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 7500, 0),
(76, '1', '1', '9', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 7600, 0),
(77, '1', '1', '9', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 7700, 0),
(78, '1', '1', '9', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 7800, 0),
(79, '1', '1', '9', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 7900, 0),
(80, '1', '1', '9', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 8000, 0),
(81, '1', '1', '9', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 8100, 0),
(82, '1', '1', '9', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 8200, 0),
(83, '1', '1', '10', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 8300, 0),
(84, '1', '1', '10', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 8400, 0),
(85, '1', '1', '10', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 8500, 0),
(86, '1', '1', '10', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 8600, 0),
(87, '1', '1', '10', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 8700, 0),
(88, '1', '1', '10', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 8800, 0),
(89, '1', '1', '10', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 8900, 0),
(90, '1', '1', '10', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 9000, 0),
(91, '1', '1', '10', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 9100, 0),
(92, '1', '1', '10', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 9200, 0),
(93, '1', '1', '10', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 9300, 0),
(94, '1', '1', '10', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 9400, 0),
(95, '1', '1', '11', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 9500, 0),
(96, '1', '1', '11', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 9600, 0),
(97, '1', '1', '11', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 9700, 0),
(98, '1', '1', '11', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 9800, 0),
(99, '1', '1', '11', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 9900, 0),
(100, '1', '1', '11', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 10000, 0),
(101, '1', '1', '11', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 10100, 0),
(102, '1', '1', '11', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 10200, 0),
(103, '1', '1', '11', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 10300, 0),
(104, '1', '1', '11', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 10400, 0),
(105, '1', '1', '11', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 10500, 0),
(106, '1', '1', '11', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 10600, 0),
(107, '1', '1', '12', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 10700, 0),
(108, '1', '1', '12', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 10800, 0),
(109, '1', '1', '12', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 10900, 0),
(110, '1', '1', '12', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 11000, 0),
(111, '1', '1', '12', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 11100, 0),
(112, '1', '1', '12', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 11200, 0),
(113, '1', '1', '12', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 11300, 0),
(114, '1', '1', '12', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 11400, 0),
(115, '1', '1', '12', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 11500, 0),
(116, '1', '1', '12', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 11600, 0),
(117, '1', '1', '12', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 11700, 0),
(118, '1', '1', '12', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 11800, 0),
(119, '1', '1', '13', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 11900, 0),
(120, '1', '1', '13', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 12000, 0),
(121, '1', '1', '13', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 12100, 0),
(122, '1', '1', '13', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 12200, 0),
(123, '1', '1', '13', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 12300, 0),
(124, '1', '1', '13', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 12400, 0),
(125, '1', '1', '13', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 12500, 0),
(126, '1', '1', '13', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 12600, 0),
(127, '1', '1', '13', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 12700, 0),
(128, '1', '1', '13', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 12800, 0),
(129, '1', '1', '13', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 12900, 0),
(130, '1', '1', '13', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 13000, 0),
(131, '1', '1', '14', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 13100, 0),
(132, '1', '1', '14', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 13200, 0),
(133, '1', '1', '14', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 13300, 0),
(134, '1', '1', '14', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 13400, 0),
(135, '1', '1', '14', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 13500, 0),
(136, '1', '1', '14', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 13600, 0),
(137, '1', '1', '14', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 13700, 0),
(138, '1', '1', '14', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 13800, 0),
(139, '1', '1', '14', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 13900, 0),
(140, '1', '1', '14', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 14000, 0),
(141, '1', '1', '14', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 14100, 0),
(142, '1', '1', '14', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 14200, 0),
(143, '1', '1', '15', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 14300, 0),
(144, '1', '1', '15', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 14400, 0),
(145, '1', '1', '15', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 14500, 0),
(146, '1', '1', '15', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 14600, 0),
(147, '1', '1', '15', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 14700, 0),
(148, '1', '1', '15', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 14800, 0),
(149, '1', '1', '15', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 14900, 0),
(150, '1', '1', '15', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 15000, 0),
(151, '1', '1', '15', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 15100, 0),
(152, '1', '1', '15', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 15200, 0),
(153, '1', '1', '15', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 15300, 0),
(154, '1', '1', '15', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 15400, 0),
(155, '1', '1', '16', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 15500, 0),
(156, '1', '1', '16', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 15600, 0),
(157, '1', '1', '16', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 15700, 0),
(158, '1', '1', '16', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 15800, 0),
(159, '1', '1', '16', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 15900, 0),
(160, '1', '1', '16', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 16000, 0),
(161, '1', '1', '16', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 16100, 0),
(162, '1', '1', '16', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 16200, 0),
(163, '1', '1', '16', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 16300, 0),
(164, '1', '1', '16', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 16400, 0),
(165, '1', '1', '16', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 16500, 0),
(166, '1', '1', '16', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 16600, 0),
(167, '1', '1', '17', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 16700, 0),
(168, '1', '1', '17', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 16800, 0),
(169, '1', '1', '17', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 16900, 0),
(170, '1', '1', '17', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 17000, 0),
(171, '1', '1', '17', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 17100, 0),
(172, '1', '1', '17', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 17200, 0),
(173, '1', '1', '17', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 17300, 0),
(174, '1', '1', '17', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 17400, 0),
(175, '1', '1', '17', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 17500, 0),
(176, '1', '1', '17', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 17600, 0),
(177, '1', '1', '17', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 17700, 0),
(178, '1', '1', '17', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 17800, 0),
(179, '1', '1', '18', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 17900, 0),
(180, '1', '1', '18', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 18000, 0),
(181, '1', '1', '18', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 18100, 0),
(182, '1', '1', '18', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 18200, 0),
(183, '1', '1', '18', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 18300, 0),
(184, '1', '1', '18', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 18400, 0),
(185, '1', '1', '18', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 18500, 0),
(186, '1', '1', '18', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 18600, 0),
(187, '1', '1', '18', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 18700, 0),
(188, '1', '1', '18', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 18800, 0),
(189, '1', '1', '18', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 18900, 0),
(190, '1', '1', '18', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 19000, 0),
(191, '1', '2', '4', '1', 1, 381.5, 762.99, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 19100, 0),
(192, '1', '2', '4', '2', 829.4, 290.29, 580.58, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 19200, 0),
(193, '1', '2', '4', '3', 829.4, 290.29, 580.58, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 19300, 0),
(194, '1', '2', '4', '4', 766.74, 268.36, 536.72, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 19400, 0),
(195, '1', '2', '4', '5', 960.47, 336.16, 672.33, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 19500, 0),
(196, '1', '2', '4', '7', 766.05, 268.12, 536.24, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 19600, 0),
(197, '1', '2', '4', '8', 1, 360.95, 721.9, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 19700, 0),
(198, '1', '2', '5', '1', 917.02, 320.96, 641.91, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 19800, 0),
(199, '1', '2', '5', '2', 690.47, 241.66, 483.33, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 19900, 0),
(200, '1', '2', '5', '3', 690.47, 241.66, 483.33, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 20000, 0),
(201, '1', '2', '5', '4', 690.47, 241.66, 483.33, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 20100, 0),
(202, '1', '2', '5', '5', 624.13, 218.45, 436.89, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 20200, 0),
(203, '1', '2', '5', '6', 803.85, 281.35, 562.7, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 20300, 0),
(204, '1', '2', '5', '7', 711.55, 249.04, 498.09, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 20400, 0),
(205, '1', '2', '5', '8', 586.71, 205.35, 410.7, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 20500, 0),
(206, '1', '2', '5', '9', 630.92, 220.82, 441.64, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 20600, 0),
(207, '1', '2', '5', '10', 630.92, 220.82, 441.64, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 20700, 0),
(208, '1', '2', '5', '11', 630.92, 220.82, 441.64, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 20800, 0),
(209, '1', '2', '5', '12', 853.82, 298.84, 597.67, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 20900, 0),
(210, '1', '2', '6', '1', 871.07, 304.87, 609.75, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 21000, 0),
(211, '1', '2', '6', '2', 673.2, 235.62, 471.24, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 21100, 0),
(212, '1', '2', '6', '3', 673.2, 235.62, 471.24, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 21200, 0),
(213, '1', '2', '6', '4', 673.2, 235.62, 471.24, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 21300, 0),
(214, '1', '2', '6', '5', 619.62, 216.87, 433.73, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 21400, 0),
(215, '1', '2', '6', '6', 756.51, 264.78, 529.56, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 21500, 0),
(216, '1', '2', '6', '7', 690.69, 241.74, 483.48, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 21600, 0),
(217, '1', '2', '6', '8', 604.42, 211.55, 423.09, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 21700, 0),
(218, '1', '2', '6', '9', 636.75, 222.86, 445.73, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 21800, 0),
(219, '1', '2', '6', '10', 636.75, 222.86, 445.73, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 21900, 0),
(220, '1', '2', '6', '11', 636.75, 222.86, 445.73, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 22000, 0),
(221, '1', '2', '6', '12', 835.46, 292.41, 584.82, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 22100, 0),
(222, '1', '2', '7', '1', 795.83, 278.54, 557.08, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 22200, 0),
(223, '1', '2', '7', '2', 627.51, 219.63, 439.26, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 22300, 0),
(224, '1', '2', '7', '3', 627.51, 219.63, 439.26, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 22400, 0),
(225, '1', '2', '7', '4', 627.51, 219.63, 439.26, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 22500, 0),
(226, '1', '2', '7', '5', 585.62, 204.97, 409.93, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 22600, 0),
(227, '1', '2', '7', '6', 681.04, 238.36, 476.73, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 22700, 0),
(228, '1', '2', '7', '7', 707.47, 247.61, 495.23, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 22800, 0),
(229, '1', '2', '7', '8', 647.05, 226.47, 452.94, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 22900, 0),
(230, '1', '2', '7', '9', 669.4, 234.29, 468.58, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 23000, 0),
(231, '1', '2', '7', '10', 669.4, 234.29, 468.58, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 23100, 0),
(232, '1', '2', '7', '11', 669.4, 234.29, 468.58, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 23200, 0),
(233, '1', '2', '7', '12', 858.24, 300.38, 600.77, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 23300, 0),
(234, '1', '2', '8', '1', 821.19, 287.42, 574.83, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 23400, 0),
(235, '1', '2', '8', '2', 657.67, 230.18, 460.37, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 23500, 0),
(236, '1', '2', '8', '3', 657.67, 230.18, 460.37, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 23600, 0),
(237, '1', '2', '8', '4', 657.67, 230.18, 460.37, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 23700, 0),
(238, '1', '2', '8', '5', 625.7, 219, 437.99, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 23800, 0),
(239, '1', '2', '8', '6', 698.37, 244.43, 488.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 23900, 0),
(240, '1', '2', '8', '7', 641.3, 224.46, 448.91, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 24000, 0),
(241, '1', '2', '8', '8', 612.13, 214.25, 428.49, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 24100, 0),
(242, '1', '2', '8', '9', 626.77, 219.37, 438.74, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 24200, 0),
(243, '1', '2', '8', '10', 626.77, 219.37, 438.74, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 24300, 0),
(244, '1', '2', '8', '11', 626.77, 219.37, 438.74, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 24400, 0),
(245, '1', '2', '8', '12', 789.56, 276.35, 552.69, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 24500, 0),
(246, '1', '3', '1', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 24600, 0),
(247, '1', '3', '1', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 24700, 0),
(248, '1', '3', '1', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 24800, 0),
(249, '1', '3', '1', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 24900, 0),
(250, '1', '3', '1', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 25000, 0),
(251, '1', '3', '1', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 25100, 0),
(252, '1', '3', '1', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 25200, 0),
(253, '1', '3', '1', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 25300, 0),
(254, '1', '3', '1', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 25400, 0),
(255, '1', '3', '1', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 25500, 0),
(256, '1', '3', '1', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 25600, 0),
(257, '1', '3', '1', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 25700, 0),
(258, '1', '3', '2', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 25800, 0),
(259, '1', '3', '2', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 25900, 0),
(260, '1', '3', '2', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 26000, 0),
(261, '1', '3', '2', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 26100, 0),
(262, '1', '3', '2', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 26200, 0),
(263, '1', '3', '2', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 26300, 0),
(264, '1', '3', '2', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 26400, 0),
(265, '1', '3', '2', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 26500, 0),
(266, '1', '3', '2', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 26600, 0),
(267, '1', '3', '2', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 26700, 0),
(268, '1', '3', '2', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 26800, 0),
(269, '1', '3', '2', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 26900, 0),
(270, '1', '3', '3', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 27000, 0),
(271, '1', '3', '3', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 27100, 0),
(272, '1', '3', '3', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 27200, 0),
(273, '1', '3', '3', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 27300, 0),
(274, '1', '3', '3', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 27400, 0),
(275, '1', '3', '3', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 27500, 0),
(276, '1', '3', '3', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 27600, 0),
(277, '1', '3', '3', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 27700, 0),
(278, '1', '3', '3', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 27800, 0),
(279, '1', '3', '3', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 27900, 0),
(280, '1', '3', '3', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 28000, 0),
(281, '1', '3', '3', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 28100, 0),
(282, '1', '3', '4', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 28200, 0),
(283, '1', '3', '4', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 28300, 0),
(284, '1', '3', '4', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 28400, 0),
(285, '1', '3', '4', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 28500, 0),
(286, '1', '3', '4', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 28600, 0),
(287, '1', '3', '4', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 28700, 0),
(288, '1', '3', '4', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 28800, 0),
(289, '1', '3', '4', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 28900, 0),
(290, '1', '3', '4', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 29000, 0),
(291, '1', '3', '4', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 29100, 0),
(292, '1', '3', '4', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 29200, 0),
(293, '1', '3', '4', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 29300, 0),
(294, '1', '3', '5', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 29400, 0),
(295, '1', '3', '5', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 29500, 0),
(296, '1', '3', '5', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 29600, 0),
(297, '1', '3', '5', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 29700, 0),
(298, '1', '3', '5', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 29800, 0),
(299, '1', '3', '5', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 29900, 0),
(300, '1', '3', '5', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 30000, 0),
(301, '1', '3', '5', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 30100, 0),
(302, '1', '3', '5', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 30200, 0),
(303, '1', '3', '5', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 30300, 0),
(304, '1', '3', '5', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 30400, 0),
(305, '1', '3', '5', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 30500, 0),
(306, '1', '3', '6', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 30600, 0),
(307, '1', '3', '6', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 30700, 0),
(308, '1', '3', '6', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 30800, 0),
(309, '1', '3', '6', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 30900, 0),
(310, '1', '3', '6', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 31000, 0),
(311, '1', '3', '6', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 31100, 0),
(312, '1', '3', '6', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 31200, 0),
(313, '1', '3', '6', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 31300, 0),
(314, '1', '3', '6', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 31400, 0),
(315, '1', '3', '6', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 31500, 0),
(316, '1', '3', '6', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 31600, 0),
(317, '1', '3', '6', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 31700, 0),
(318, '1', '4', '2', '1', 10, 0, 0, 'AREA DE RESERVA', 1, '0000-00-00', 'N/A', 31800, 0),
(319, '1', '4', '3', '1', 467.88, 163.76, 327.52, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 31900, 0),
(320, '1', '4', '3', '2', 612.58, 214.4, 428.81, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 32000, 0),
(321, '1', '4', '3', '3', 662.46, 231.86, 463.72, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 32100, 0),
(322, '1', '4', '3', '4', 690.03, 241.51, 483.02, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 32200, 0),
(323, '1', '4', '3', '5', 717.59, 251.16, 502.31, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 32300, 0),
(324, '1', '4', '3', '6', 745.16, 260.81, 521.61, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 32400, 0),
(325, '1', '4', '3', '7', 745.16, 260.81, 521.61, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 32500, 0),
(326, '1', '4', '3', '8', 717.59, 251.16, 502.31, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 32600, 0),
(327, '1', '4', '3', '9', 690.03, 241.51, 483.02, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 32700, 0),
(328, '1', '4', '3', '10', 662.46, 231.86, 463.72, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 32800, 0),
(329, '1', '4', '3', '11', 633.5, 221.73, 443.45, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 32900, 0),
(330, '1', '4', '3', '12', 526.56, 184.3, 368.59, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 33000, 0),
(331, '1', '4', '4', '1', 651.32, 227.96, 455.92, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 33100, 0),
(332, '1', '4', '4', '2', 671.02, 234.86, 469.71, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 33200, 0),
(333, '1', '4', '4', '3', 690.71, 241.75, 483.5, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 33300, 0),
(334, '1', '4', '4', '4', 710.41, 248.64, 497.29, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 33400, 0),
(335, '1', '4', '4', '5', 730.1, 255.54, 511.07, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 33500, 0),
(336, '1', '4', '4', '6', 749.79, 262.43, 524.85, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 33600, 0),
(337, '1', '4', '4', '7', 749.79, 262.43, 524.85, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 33700, 0),
(338, '1', '4', '4', '8', 730.1, 255.54, 511.07, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 33800, 0),
(339, '1', '4', '4', '9', 710.41, 248.64, 497.29, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 33900, 0),
(340, '1', '4', '4', '10', 690.71, 241.75, 483.5, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 34000, 0),
(341, '1', '4', '4', '11', 671.02, 234.86, 469.71, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 34100, 0),
(342, '1', '4', '4', '12', 651.32, 227.96, 455.92, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 34200, 0),
(343, '1', '4', '5', '1', 677.87, 237.25, 474.51, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 34300, 0),
(344, '1', '4', '5', '2', 693.2, 242.62, 485.24, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 34400, 0),
(345, '1', '4', '5', '3', 708.53, 247.99, 495.97, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 34500, 0),
(346, '1', '4', '5', '4', 723.86, 253.35, 506.7, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 34600, 0),
(347, '1', '4', '5', '5', 739.19, 258.72, 517.43, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 34700, 0),
(348, '1', '4', '5', '6', 754.51, 264.08, 528.16, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 34800, 0),
(349, '1', '4', '5', '7', 754.51, 264.08, 528.16, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 34900, 0),
(350, '1', '4', '5', '8', 739.19, 258.72, 517.43, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 35000, 0),
(351, '1', '4', '5', '9', 723.86, 253.35, 506.7, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 35100, 0),
(352, '1', '4', '5', '10', 708.53, 247.99, 495.97, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 35200, 0),
(353, '1', '4', '5', '11', 693.2, 242.62, 485.24, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 35300, 0),
(354, '1', '4', '5', '12', 677.87, 237.25, 474.51, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 35400, 0),
(355, '2', '1', '21', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 35500, 0),
(356, '2', '1', '21', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 35600, 0),
(357, '2', '1', '21', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 35700, 0),
(358, '2', '1', '21', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 35800, 0),
(359, '2', '1', '21', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 35900, 0),
(360, '2', '1', '21', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 36000, 0),
(361, '2', '1', '21', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 36100, 0),
(362, '2', '1', '21', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 36200, 0),
(363, '2', '1', '21', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 36300, 0),
(364, '2', '1', '21', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 36400, 0),
(365, '2', '1', '21', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 36500, 0),
(366, '2', '1', '21', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 36600, 0),
(367, '2', '1', '22', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 36700, 0),
(368, '2', '1', '22', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 36800, 0),
(369, '2', '1', '22', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 36900, 0),
(370, '2', '1', '22', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 37000, 0),
(371, '2', '1', '22', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 37100, 0),
(372, '2', '1', '22', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 37200, 0),
(373, '2', '1', '22', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 37300, 0),
(374, '2', '1', '22', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 37400, 0),
(375, '2', '1', '22', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 37500, 0),
(376, '2', '1', '22', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 37600, 0),
(377, '2', '1', '22', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 37700, 0),
(378, '2', '1', '22', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 37800, 0),
(379, '2', '1', '23', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 37900, 0),
(380, '2', '1', '23', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 38000, 0),
(381, '2', '1', '23', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 38100, 0),
(382, '2', '1', '23', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 38200, 0),
(383, '2', '1', '23', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 38300, 0),
(384, '2', '1', '23', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 38400, 0),
(385, '2', '1', '23', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 38500, 0),
(386, '2', '1', '23', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 38600, 0),
(387, '2', '1', '23', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 38700, 0),
(388, '2', '1', '23', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 38800, 0),
(389, '2', '1', '23', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 38900, 0),
(390, '2', '1', '23', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 39000, 0),
(391, '2', '1', '24', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 39100, 0),
(392, '2', '1', '24', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 39200, 0),
(393, '2', '1', '24', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 39300, 0),
(394, '2', '1', '24', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 39400, 0),
(395, '2', '1', '24', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 39500, 0),
(396, '2', '1', '24', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 39600, 0),
(397, '2', '1', '24', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 39700, 0),
(398, '2', '1', '24', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 39800, 0),
(399, '2', '1', '24', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 39900, 0),
(400, '2', '1', '24', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 40000, 0),
(401, '2', '1', '24', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 40100, 0),
(402, '2', '1', '24', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 40200, 0),
(403, '2', '1', '25', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 40300, 0),
(404, '2', '1', '25', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 40400, 0),
(405, '2', '1', '25', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 40500, 0),
(406, '2', '1', '25', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 40600, 0),
(407, '2', '1', '25', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 40700, 0),
(408, '2', '1', '25', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 40800, 0),
(409, '2', '1', '25', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 40900, 0),
(410, '2', '1', '25', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 41000, 0),
(411, '2', '1', '25', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 41100, 0),
(412, '2', '1', '25', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 41200, 0),
(413, '2', '1', '25', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 41300, 0),
(414, '2', '1', '25', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 41400, 0),
(415, '2', '1', '26', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 41500, 0),
(416, '2', '1', '26', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 41600, 0),
(417, '2', '1', '26', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 41700, 0),
(418, '2', '1', '26', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 41800, 0),
(419, '2', '1', '26', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 41900, 0),
(420, '2', '1', '26', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 42000, 0),
(421, '2', '1', '26', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 42100, 0),
(422, '2', '1', '26', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 42200, 0),
(423, '2', '1', '26', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 42300, 0),
(424, '2', '1', '26', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 42400, 0),
(425, '2', '1', '26', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 42500, 0),
(426, '2', '1', '26', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 42600, 0),
(427, '2', '1', '27', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 42700, 0),
(428, '2', '1', '27', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 42800, 0),
(429, '2', '1', '27', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 42900, 0),
(430, '2', '1', '27', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 43000, 0),
(431, '2', '1', '27', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 43100, 0),
(432, '2', '1', '27', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 43200, 0),
(433, '2', '1', '27', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 43300, 0),
(434, '2', '1', '27', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 43400, 0),
(435, '2', '1', '27', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 43500, 0),
(436, '2', '1', '27', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 43600, 0),
(437, '2', '1', '27', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 43700, 0),
(438, '2', '1', '27', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 43800, 0),
(439, '2', '5', '1', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 43900, 0),
(440, '2', '5', '1', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 44000, 0),
(441, '2', '5', '1', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 44100, 0),
(442, '2', '5', '1', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 44200, 0),
(443, '2', '5', '1', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 44300, 0),
(444, '2', '5', '1', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 44400, 0),
(445, '2', '5', '1', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 44500, 0),
(446, '2', '5', '1', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 44600, 0),
(447, '2', '5', '1', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 44700, 0),
(448, '2', '5', '1', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 44800, 0),
(449, '2', '5', '1', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 44900, 0),
(450, '2', '5', '1', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 45000, 0),
(451, '2', '5', '2', '1', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 45100, 0),
(452, '2', '5', '2', '2', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 45200, 0),
(453, '2', '5', '2', '3', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 45300, 0),
(454, '2', '5', '2', '4', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 45400, 0),
(455, '2', '5', '2', '5', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 45500, 0),
(456, '2', '5', '2', '6', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 45600, 0),
(457, '2', '5', '2', '7', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 45700, 0),
(458, '2', '5', '2', '8', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 45800, 0),
(459, '2', '5', '2', '9', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 45900, 0),
(460, '2', '5', '2', '10', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 46000, 0),
(461, '2', '5', '2', '11', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 46100, 0),
(462, '2', '5', '2', '12', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 46200, 0),
(463, '2', '5', '3', '1', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 46300, 0),
(464, '2', '5', '3', '2', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 46400, 0),
(465, '2', '5', '3', '3', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 46500, 0),
(466, '2', '5', '3', '4', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 46600, 0),
(467, '2', '5', '3', '5', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 46700, 0),
(468, '2', '5', '3', '6', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 46800, 0),
(469, '2', '5', '3', '7', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 46900, 0),
(470, '2', '5', '3', '8', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 47000, 0),
(471, '2', '5', '3', '9', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 47100, 0),
(472, '2', '5', '3', '10', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 47200, 0),
(473, '2', '5', '3', '11', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 47300, 0),
(474, '2', '5', '3', '12', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 47400, 0);
INSERT INTO `lotes` (`id_lote`, `fase`, `super_manzana`, `mza`, `lote`, `m2`, `cos`, `cus`, `uso`, `id_tipo_lote`, `fecha_entrega`, `disponibilidad`, `precio_lista`, `estatus`) VALUES
(475, '2', '5', '4', '1', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 47500, 0),
(476, '2', '5', '4', '2', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 47600, 0),
(477, '2', '5', '4', '3', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 47700, 0),
(478, '2', '5', '4', '4', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 47800, 0),
(479, '2', '5', '4', '5', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 47900, 0),
(480, '2', '5', '4', '6', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 48000, 0),
(481, '2', '5', '4', '7', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 48100, 0),
(482, '2', '5', '4', '8', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 48200, 0),
(483, '2', '5', '4', '9', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 48300, 0),
(484, '2', '5', '4', '10', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 48400, 0),
(485, '2', '5', '4', '11', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 48500, 0),
(486, '2', '5', '4', '12', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 48600, 0),
(487, '2', '5', '5', '1', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 48700, 0),
(488, '2', '5', '5', '2', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 48800, 0),
(489, '2', '5', '5', '3', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 48900, 0),
(490, '2', '5', '5', '4', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 49000, 0),
(491, '2', '5', '5', '5', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 49100, 0),
(492, '2', '5', '5', '6', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 49200, 0),
(493, '2', '5', '5', '7', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 49300, 0),
(494, '2', '5', '5', '8', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 49400, 0),
(495, '2', '5', '5', '9', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 49500, 0),
(496, '2', '5', '5', '10', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 49600, 0),
(497, '2', '5', '5', '11', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 49700, 0),
(498, '2', '5', '5', '12', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 49800, 0),
(499, '2', '5', '6', '1', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 49900, 0),
(500, '2', '5', '6', '2', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 50000, 0),
(501, '2', '5', '6', '3', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 50100, 0),
(502, '2', '5', '6', '4', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 50200, 0),
(503, '2', '5', '6', '5', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 50300, 0),
(504, '2', '5', '6', '6', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 50400, 0),
(505, '2', '5', '6', '7', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 50500, 0),
(506, '2', '5', '6', '8', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 50600, 0),
(507, '2', '5', '6', '9', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 50700, 0),
(508, '2', '5', '6', '10', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 50800, 0),
(509, '2', '5', '6', '11', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 50900, 0),
(510, '2', '5', '6', '12', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 51000, 0),
(511, '2', '5', '7', '1', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 51100, 0),
(512, '2', '5', '7', '2', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 51200, 0),
(513, '2', '5', '7', '3', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 51300, 0),
(514, '2', '5', '7', '4', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 51400, 0),
(515, '2', '5', '7', '5', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 51500, 0),
(516, '2', '5', '7', '6', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 51600, 0),
(517, '2', '5', '7', '7', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 51700, 0),
(518, '2', '5', '7', '8', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 51800, 0),
(519, '2', '5', '7', '9', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 51900, 0),
(520, '2', '5', '7', '10', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 52000, 0),
(521, '2', '5', '7', '11', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 52100, 0),
(522, '2', '5', '7', '12', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 52200, 0),
(523, '2', '5', '8', '1', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 52300, 0),
(524, '2', '5', '8', '2', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 52400, 0),
(525, '2', '5', '8', '3', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 52500, 0),
(526, '2', '5', '8', '4', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 52600, 0),
(527, '2', '5', '8', '5', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 52700, 0),
(528, '2', '5', '8', '6', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 52800, 0),
(529, '2', '5', '8', '7', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 52900, 0),
(530, '2', '5', '8', '8', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 53000, 0),
(531, '2', '5', '8', '9', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 53100, 0),
(532, '2', '5', '8', '10', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 53200, 0),
(533, '2', '5', '8', '11', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 53300, 0),
(534, '2', '5', '8', '12', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 53400, 0),
(535, '2', '5', '9', '1', 699.6, 244.86, 489.72, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 53500, 0),
(536, '2', '5', '9', '2', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 53600, 0),
(537, '2', '5', '9', '3', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 53700, 0),
(538, '2', '5', '9', '4', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 53800, 0),
(539, '2', '5', '9', '5', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 53900, 0),
(540, '2', '5', '9', '6', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 54000, 0),
(541, '2', '5', '9', '7', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 54100, 0),
(542, '2', '5', '9', '8', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 54200, 0),
(543, '2', '5', '9', '9', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 54300, 0),
(544, '2', '5', '9', '10', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 54400, 0),
(545, '2', '5', '9', '11', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 54500, 0),
(546, '2', '5', '9', '12', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 54600, 0),
(547, '2', '5', '10', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 54700, 0),
(548, '2', '5', '10', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 54800, 0),
(549, '2', '5', '10', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 54900, 0),
(550, '2', '5', '10', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 55000, 0),
(551, '2', '5', '10', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 55100, 0),
(552, '2', '5', '10', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 55200, 0),
(553, '2', '5', '10', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 55300, 0),
(554, '2', '5', '10', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 55400, 0),
(555, '2', '5', '10', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 55500, 0),
(556, '2', '5', '10', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 55600, 0),
(557, '2', '5', '10', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 55700, 0),
(558, '2', '5', '10', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 55800, 0),
(559, '2', '5', '11', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 55900, 0),
(560, '2', '5', '11', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 56000, 0),
(561, '2', '5', '11', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 56100, 0),
(562, '2', '5', '11', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 56200, 0),
(563, '2', '5', '11', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 56300, 0),
(564, '2', '5', '11', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 56400, 0),
(565, '2', '5', '11', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 56500, 0),
(566, '2', '5', '11', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 56600, 0),
(567, '2', '5', '11', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 56700, 0),
(568, '2', '5', '11', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 56800, 0),
(569, '2', '5', '11', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 56900, 0),
(570, '2', '5', '11', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 57000, 0),
(571, '2', '5', '12', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 57100, 0),
(572, '2', '5', '12', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 57200, 0),
(573, '2', '5', '12', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 57300, 0),
(574, '2', '5', '12', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 57400, 0),
(575, '2', '5', '12', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 57500, 0),
(576, '2', '5', '12', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 57600, 0),
(577, '2', '5', '12', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 57700, 0),
(578, '2', '5', '12', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 57800, 0),
(579, '2', '5', '12', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 57900, 0),
(580, '2', '5', '12', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 58000, 0),
(581, '2', '5', '12', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 58100, 0),
(582, '2', '5', '12', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 58200, 0),
(583, '2', '5', '13', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 58300, 0),
(584, '2', '5', '13', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 58400, 0),
(585, '2', '5', '13', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 58500, 0),
(586, '2', '5', '13', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 58600, 0),
(587, '2', '5', '13', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 58700, 0),
(588, '2', '5', '13', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 58800, 0),
(589, '2', '5', '13', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 58900, 0),
(590, '2', '5', '13', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 59000, 0),
(591, '2', '5', '13', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 59100, 0),
(592, '2', '5', '13', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 59200, 0),
(593, '2', '5', '13', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 59300, 0),
(594, '2', '5', '13', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 59400, 0),
(595, '2', '5', '14', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 59500, 0),
(596, '2', '5', '14', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 59600, 0),
(597, '2', '5', '14', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 59700, 0),
(598, '2', '5', '14', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 59800, 0),
(599, '2', '5', '14', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 59900, 0),
(600, '2', '5', '14', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 60000, 0),
(601, '2', '5', '14', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 60100, 0),
(602, '2', '5', '14', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 60200, 0),
(603, '2', '5', '14', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 60300, 0),
(604, '2', '5', '14', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 60400, 0),
(605, '2', '5', '14', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 60500, 0),
(606, '2', '5', '14', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 60600, 0),
(607, '2', '5', '15', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 60700, 0),
(608, '2', '5', '15', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 60800, 0),
(609, '2', '5', '15', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 60900, 0),
(610, '2', '5', '15', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 61000, 0),
(611, '2', '5', '15', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 61100, 0),
(612, '2', '5', '15', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 61200, 0),
(613, '2', '5', '15', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 61300, 0),
(614, '2', '5', '15', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 61400, 0),
(615, '2', '5', '15', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 61500, 0),
(616, '2', '5', '15', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 61600, 0),
(617, '2', '5', '15', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 61700, 0),
(618, '2', '5', '15', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 61800, 0),
(619, '2', '5', '16', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 61900, 0),
(620, '2', '5', '16', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 62000, 0),
(621, '2', '5', '16', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 62100, 0),
(622, '2', '5', '16', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 62200, 0),
(623, '2', '5', '16', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 62300, 0),
(624, '2', '5', '16', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 62400, 0),
(625, '2', '5', '16', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 62500, 0),
(626, '2', '5', '16', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 62600, 0),
(627, '2', '5', '16', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 62700, 0),
(628, '2', '5', '16', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 62800, 0),
(629, '2', '5', '16', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 62900, 0),
(630, '2', '5', '16', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 63000, 0),
(631, '2', '6', '2', '1', 10, 0, 0, 'AREA DE RESERVA', 2, '0000-00-00', 'N/A', 63100, 0),
(632, '2', '6', '3', '1', 10, 0, 0, 'AREA DE RESERVA', 1, '0000-00-00', 'N/A', 63200, 0),
(633, '2', '6', '4', '1', 785.65, 274.98, 549.96, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 63300, 0),
(634, '2', '6', '4', '2', 866.45, 303.26, 606.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 63400, 0),
(635, '2', '6', '4', '3', 866.45, 303.26, 606.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 63500, 0),
(636, '2', '6', '4', '4', 978.95, 342.63, 685.27, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 63600, 0),
(637, '2', '6', '4', '5', 978.95, 342.63, 685.27, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 63700, 0),
(638, '2', '6', '4', '6', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 63800, 0),
(639, '2', '6', '4', '7', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 63900, 0),
(640, '2', '6', '4', '8', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 64000, 0),
(641, '2', '6', '4', '9', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 64100, 0),
(642, '2', '6', '4', '10', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 64200, 0),
(643, '2', '6', '4', '11', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 64300, 0),
(644, '2', '6', '4', '12', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 64400, 0),
(645, '2', '6', '4', '13', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 64500, 0),
(646, '2', '6', '4', '14', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 64600, 0),
(647, '2', '6', '4', '15', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 64700, 0),
(648, '2', '6', '4', '16', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 64800, 0),
(649, '2', '6', '4', '17', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 64900, 0),
(650, '2', '6', '4', '18', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 65000, 0),
(651, '2', '6', '4', '19', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 65100, 0),
(652, '2', '6', '4', '20', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 65200, 0),
(653, '2', '6', '4', '21', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 65300, 0),
(654, '2', '6', '4', '22', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 65400, 0),
(655, '2', '6', '4', '23', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 65500, 0),
(656, '2', '6', '4', '24', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 65600, 0),
(657, '2', '6', '4', '25', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 65700, 0),
(658, '2', '6', '4', '26', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 65800, 0),
(659, '2', '6', '4', '27', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 65900, 0),
(660, '2', '6', '4', '28', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 66000, 0),
(661, '2', '6', '4', '29', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 66100, 0),
(662, '2', '6', '4', '30', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 66200, 0),
(663, '2', '6', '4', '31', 839.5, 293.83, 587.65, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 66300, 0),
(664, '2', '6', '4', '32', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 66400, 0),
(665, '2', '6', '4', '33', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 66500, 0),
(666, '2', '6', '4', '34', 839.5, 293.83, 587.65, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 66600, 0),
(667, '2', '6', '4', '35', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 66700, 0),
(668, '2', '6', '4', '36', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 66800, 0),
(669, '2', '6', '4', '37', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 66900, 0),
(670, '2', '6', '4', '38', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 67000, 0),
(671, '2', '6', '4', '39', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 67100, 0),
(672, '2', '6', '4', '40', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 67200, 0),
(673, '2', '6', '4', '41', 785.65, 274.98, 549.96, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 67300, 0),
(674, '2', '6', '4', '42', 785.65, 274.98, 549.96, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 67400, 0),
(675, '2', '6', '4', '43', 785.65, 274.98, 549.96, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 67500, 0),
(676, '2', '6', '4', '44', 785.65, 274.98, 549.96, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 67600, 0),
(677, '2', '6', '5', '1', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 67700, 0),
(678, '2', '6', '5', '2', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 67800, 0),
(679, '2', '6', '5', '3', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 67900, 0),
(680, '2', '6', '5', '4', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 68000, 0),
(681, '2', '6', '5', '5', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 68100, 0),
(682, '2', '6', '5', '6', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 68200, 0),
(683, '2', '6', '5', '7', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 68300, 0),
(684, '2', '6', '5', '8', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 68400, 0),
(685, '2', '6', '5', '9', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 68500, 0),
(686, '2', '6', '5', '10', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 68600, 0),
(687, '2', '6', '5', '11', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 68700, 0),
(688, '2', '6', '5', '12', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 68800, 0),
(689, '2', '6', '5', '13', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 68900, 0),
(690, '2', '6', '5', '14', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 69000, 0),
(691, '2', '6', '5', '15', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 69100, 0),
(692, '2', '6', '5', '16', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 69200, 0),
(693, '2', '6', '5', '17', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 69300, 0),
(694, '2', '6', '5', '18', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 69400, 0),
(695, '2', '6', '5', '19', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 69500, 0),
(696, '2', '6', '5', '20', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 69600, 0),
(697, '2', '6', '5', '21', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 69700, 0),
(698, '2', '6', '5', '22', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 69800, 0),
(699, '2', '6', '5', '23', 839.5, 293.83, 587.65, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 69900, 0),
(700, '2', '6', '5', '24', 839.5, 293.83, 587.65, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 70000, 0),
(701, '2', '6', '5', '25', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 70100, 0),
(702, '2', '6', '5', '26', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 70200, 0),
(703, '2', '6', '5', '27', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 70300, 0),
(704, '2', '6', '5', '28', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 70400, 0),
(705, '2', '6', '5', '29', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 70500, 0),
(706, '2', '6', '5', '30', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 70600, 0),
(707, '2', '6', '5', '31', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 70700, 0),
(708, '2', '6', '5', '32', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 70800, 0),
(709, '2', '6', '5', '33', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 70900, 0),
(710, '2', '6', '5', '34', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 71000, 0),
(711, '3', '1', '28', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 71100, 0),
(712, '3', '1', '28', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 71200, 0),
(713, '3', '1', '28', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 71300, 0),
(714, '3', '1', '28', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 71400, 0),
(715, '3', '1', '28', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 71500, 0),
(716, '3', '1', '28', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 71600, 0),
(717, '3', '1', '28', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 71700, 0),
(718, '3', '1', '28', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 71800, 0),
(719, '3', '1', '28', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 71900, 0),
(720, '3', '1', '28', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 72000, 0),
(721, '3', '1', '28', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 72100, 0),
(722, '3', '1', '28', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 72200, 0),
(723, '3', '1', '29', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 72300, 0),
(724, '3', '1', '29', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 72400, 0),
(725, '3', '1', '29', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 72500, 0),
(726, '3', '1', '29', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 72600, 0),
(727, '3', '1', '29', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 72700, 0),
(728, '3', '1', '29', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 72800, 0),
(729, '3', '1', '29', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 72900, 0),
(730, '3', '1', '29', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 73000, 0),
(731, '3', '1', '29', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 73100, 0),
(732, '3', '1', '29', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 73200, 0),
(733, '3', '1', '29', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 73300, 0),
(734, '3', '1', '29', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 73400, 0),
(735, '3', '1', '30', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 73500, 0),
(736, '3', '1', '30', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 73600, 0),
(737, '3', '1', '30', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 73700, 0),
(738, '3', '1', '30', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 73800, 0),
(739, '3', '1', '30', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 73900, 0),
(740, '3', '1', '30', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 74000, 0),
(741, '3', '1', '30', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 74100, 0),
(742, '3', '1', '30', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 74200, 0),
(743, '3', '1', '30', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 74300, 0),
(744, '3', '1', '30', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 74400, 0),
(745, '3', '1', '30', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 74500, 0),
(746, '3', '1', '30', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 74600, 0),
(747, '3', '1', '31', '1', 954.28, 334, 668, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 74700, 0),
(748, '3', '1', '31', '2', 765.45, 267.91, 535.82, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 74800, 0),
(749, '3', '1', '31', '3', 771.64, 270.07, 540.15, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 74900, 0),
(750, '3', '1', '31', '4', 774.28, 271, 542, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 75000, 0),
(751, '3', '1', '31', '5', 773.36, 270.68, 541.35, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 75100, 0),
(752, '3', '1', '31', '6', 768.88, 269.11, 538.22, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 75200, 0),
(753, '3', '1', '31', '7', 765.45, 267.91, 535.82, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 75300, 0),
(754, '3', '1', '31', '8', 765.45, 267.91, 535.82, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 75400, 0),
(755, '3', '1', '31', '9', 765.45, 267.91, 535.82, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 75500, 0),
(756, '3', '1', '31', '10', 765.45, 267.91, 535.82, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 75600, 0),
(757, '3', '1', '31', '11', 765.45, 267.91, 535.82, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 75700, 0),
(758, '3', '1', '31', '12', 1, 352.51, 705.02, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 75800, 0),
(759, '3', '13', '1', '1', 759.38, 265.78, 531.57, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 75900, 0),
(760, '3', '13', '1', '2', 760.73, 266.26, 532.51, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 76000, 0),
(761, '3', '13', '1', '3', 762.08, 266.73, 533.46, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 76100, 0),
(762, '3', '13', '1', '4', 763.44, 267.2, 534.41, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 76200, 0),
(763, '3', '13', '1', '5', 764.79, 267.68, 535.35, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 76300, 0),
(764, '3', '13', '1', '6', 766.14, 268.15, 536.3, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 76400, 0),
(765, '3', '13', '1', '7', 766.16, 268.16, 536.31, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 76500, 0),
(766, '3', '13', '1', '8', 764.81, 267.68, 535.37, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 76600, 0),
(767, '3', '13', '1', '9', 763.45, 267.21, 534.42, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 76700, 0),
(768, '3', '13', '1', '10', 762.09, 266.73, 533.46, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 76800, 0),
(769, '3', '13', '1', '11', 760.73, 266.26, 532.51, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 76900, 0),
(770, '3', '13', '1', '12', 759.38, 265.78, 531.57, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 77000, 0),
(771, '3', '13', '2', '1', 768.44, 268.95, 537.91, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 77100, 0),
(772, '3', '13', '2', '2', 769.8, 269.43, 538.86, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 77200, 0),
(773, '3', '13', '2', '3', 771.15, 269.9, 539.81, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 77300, 0),
(774, '3', '13', '2', '4', 772.51, 270.38, 540.76, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 77400, 0),
(775, '3', '13', '2', '5', 773.87, 270.85, 541.71, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 77500, 0),
(776, '3', '13', '2', '6', 769.53, 269.34, 538.67, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 77600, 0),
(777, '3', '13', '2', '7', 769.57, 269.35, 538.7, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 77700, 0),
(778, '3', '13', '2', '8', 773.9, 270.87, 541.73, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 77800, 0),
(779, '3', '13', '2', '9', 772.54, 270.39, 540.78, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 77900, 0),
(780, '3', '13', '2', '10', 771.18, 269.91, 539.83, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 78000, 0),
(781, '3', '13', '2', '11', 769.82, 269.44, 538.87, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 78100, 0),
(782, '3', '13', '2', '12', 768.46, 268.96, 537.92, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 78200, 0),
(783, '3', '13', '3', '1', 782.42, 273.85, 547.69, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 78300, 0),
(784, '3', '13', '3', '2', 781.06, 273.37, 546.74, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 78400, 0),
(785, '3', '13', '3', '3', 779.71, 272.9, 545.8, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 78500, 0),
(786, '3', '13', '3', '4', 778.35, 272.42, 544.85, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 78600, 0),
(787, '3', '13', '3', '5', 777, 271.95, 543.9, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 78700, 0),
(788, '3', '13', '3', '6', 775.64, 271.47, 542.95, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 78800, 0),
(789, '3', '13', '3', '7', 775.64, 271.47, 542.95, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 78900, 0),
(790, '3', '13', '3', '8', 777, 271.95, 543.9, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 79000, 0),
(791, '3', '13', '3', '9', 778.35, 272.42, 544.85, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 79100, 0),
(792, '3', '13', '3', '10', 779.71, 272.9, 545.8, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 79200, 0),
(793, '3', '13', '3', '11', 781.06, 273.37, 546.74, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 79300, 0),
(794, '3', '13', '3', '12', 782.42, 273.85, 547.69, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 79400, 0),
(795, '3', '13', '4', '1', 865.04, 302.76, 605.53, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 79500, 0),
(796, '3', '13', '4', '2', 911.59, 319.06, 638.11, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 79600, 0),
(797, '3', '13', '4', '3', 958.89, 335.61, 671.22, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 79700, 0),
(798, '3', '13', '4', '4', 999.1, 349.69, 699.37, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 79800, 0),
(799, '3', '13', '4', '5', 1, 360.98, 721.96, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 79900, 0),
(800, '3', '13', '4', '6', 1, 369.47, 738.94, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 80000, 0),
(801, '3', '13', '4', '7', 1, 375.15, 750.3, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 80100, 0),
(802, '3', '13', '4', '8', 1, 378.01, 756.01, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 80200, 0),
(803, '3', '13', '4', '9', 1, 378.04, 756.08, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 80300, 0),
(804, '3', '13', '4', '10', 1, 375.25, 750.5, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 80400, 0),
(805, '3', '13', '4', '11', 1, 369.64, 739.28, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 80500, 0),
(806, '3', '13', '4', '12', 1, 361.21, 722.43, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 80600, 0),
(807, '3', '13', '5', '1', 790.55, 276.69, 553.39, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 80700, 0),
(808, '3', '13', '5', '2', 789.19, 276.22, 552.43, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 80800, 0),
(809, '3', '13', '5', '3', 787.84, 275.74, 551.49, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 80900, 0),
(810, '3', '13', '5', '4', 786.48, 275.27, 550.54, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 81000, 0),
(811, '3', '13', '5', '5', 785.13, 274.8, 549.59, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 81100, 0),
(812, '3', '13', '5', '6', 783.77, 274.32, 548.64, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 81200, 0),
(813, '3', '13', '5', '7', 783.77, 274.32, 548.64, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 81300, 0),
(814, '3', '13', '5', '8', 785.13, 274.8, 549.59, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 81400, 0),
(815, '3', '13', '5', '9', 786.48, 275.27, 550.54, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 81500, 0),
(816, '3', '13', '5', '10', 787.84, 275.74, 551.49, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 81600, 0),
(817, '3', '13', '5', '11', 789.19, 276.22, 552.43, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 81700, 0),
(818, '3', '13', '5', '12', 790.55, 276.69, 553.39, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 81800, 0),
(819, '3', '14', '1', '1', 845.4, 295.89, 591.78, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 81900, 0),
(820, '3', '14', '1', '2', 815.32, 285.36, 570.72, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 82000, 0),
(821, '3', '14', '1', '3', 785.24, 274.83, 549.67, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 82100, 0),
(822, '3', '14', '1', '4', 755.16, 264.31, 528.61, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 82200, 0),
(823, '3', '14', '1', '5', 725.08, 253.78, 507.56, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 82300, 0),
(824, '3', '14', '1', '6', 695, 243.25, 486.5, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 82400, 0),
(825, '3', '14', '1', '7', 794.34, 278.02, 556.04, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 82500, 0),
(826, '3', '14', '1', '8', 832.64, 291.42, 582.85, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 82600, 0),
(827, '3', '14', '1', '9', 870.94, 304.83, 609.66, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 82700, 0),
(828, '3', '14', '1', '10', 909.23, 318.23, 636.46, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 82800, 0),
(829, '3', '14', '1', '11', 947.53, 331.64, 663.27, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 82900, 0),
(830, '3', '14', '1', '12', 1, 369.38, 738.77, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 83000, 0),
(831, '3', '14', '2', '1', 697.41, 244.09, 488.19, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 83100, 0),
(832, '3', '14', '2', '2', 694.54, 243.09, 486.18, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 83200, 0),
(833, '3', '14', '2', '3', 691.67, 242.08, 484.17, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 83300, 0),
(834, '3', '14', '2', '4', 688.8, 241.08, 482.16, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 83400, 0),
(835, '3', '14', '2', '5', 685.93, 240.08, 480.15, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 83500, 0),
(836, '3', '14', '2', '6', 683.06, 239.07, 478.14, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 83600, 0),
(837, '3', '14', '2', '7', 830.54, 290.69, 581.38, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 83700, 0),
(838, '3', '14', '2', '8', 824.96, 288.74, 577.47, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 83800, 0),
(839, '3', '14', '2', '9', 819.38, 286.78, 573.57, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 83900, 0),
(840, '3', '14', '2', '10', 813.8, 284.83, 569.66, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 84000, 0),
(841, '3', '14', '2', '11', 808.21, 282.87, 565.75, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 84100, 0),
(842, '3', '14', '2', '12', 802.63, 280.92, 561.84, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 84200, 0),
(843, '3', '14', '3', '1', 799.9, 279.97, 559.93, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 84300, 0),
(844, '3', '14', '3', '2', 798.55, 279.49, 558.99, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 84400, 0),
(845, '3', '14', '3', '3', 797.19, 279.02, 558.03, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 84500, 0),
(846, '3', '14', '3', '4', 795.84, 278.54, 557.09, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 84600, 0),
(847, '3', '14', '3', '5', 794.48, 278.07, 556.14, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 84700, 0),
(848, '3', '14', '3', '6', 793.13, 277.6, 555.19, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 84800, 0),
(849, '3', '14', '3', '7', 793.13, 277.6, 555.19, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 84900, 0),
(850, '3', '14', '3', '8', 794.48, 278.07, 556.14, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 85000, 0),
(851, '3', '14', '3', '9', 795.84, 278.54, 557.09, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 85100, 0),
(852, '3', '14', '3', '10', 797.19, 279.02, 558.03, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 85200, 0),
(853, '3', '14', '3', '11', 798.55, 279.49, 558.99, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 85300, 0),
(854, '3', '14', '3', '12', 799.9, 279.97, 559.93, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 85400, 0),
(855, '3', '14', '4', '1', 895.32, 313.36, 626.72, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 85500, 0),
(856, '3', '14', '4', '2', 851.2, 297.92, 595.84, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 85600, 0),
(857, '3', '14', '4', '3', 813.55, 284.74, 569.49, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 85700, 0),
(858, '3', '14', '4', '4', 782.54, 273.89, 547.78, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 85800, 0),
(859, '3', '14', '4', '5', 758.22, 265.38, 530.75, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 85900, 0),
(860, '3', '14', '4', '6', 740.63, 259.22, 518.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 86000, 0),
(861, '3', '14', '4', '7', 729.79, 255.43, 510.85, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 86100, 0),
(862, '3', '14', '4', '8', 725.72, 254, 508, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 86200, 0),
(863, '3', '14', '4', '9', 728.42, 254.95, 509.89, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 86300, 0),
(864, '3', '14', '4', '10', 737.88, 258.26, 516.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 86400, 0),
(865, '3', '14', '4', '11', 754.1, 263.94, 527.87, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 86500, 0),
(866, '3', '14', '4', '12', 777.05, 271.97, 543.94, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 86600, 0),
(867, '3', '14', '5', '1', 773.51, 270.73, 541.46, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 86700, 0),
(868, '3', '14', '5', '2', 772.26, 270.29, 540.58, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 86800, 0),
(869, '3', '14', '5', '3', 771.01, 269.85, 539.71, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 86900, 0),
(870, '3', '14', '5', '4', 769.76, 269.42, 538.83, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 87000, 0),
(871, '3', '14', '5', '5', 768.51, 268.98, 537.96, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 87100, 0),
(872, '3', '14', '5', '6', 767.26, 268.54, 537.08, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 87200, 0),
(873, '3', '14', '5', '7', 772.53, 270.39, 540.77, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 87300, 0),
(874, '3', '14', '5', '8', 773.78, 270.82, 541.65, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 87400, 0),
(875, '3', '14', '5', '9', 775.03, 271.26, 542.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 87500, 0),
(876, '3', '14', '5', '10', 776.28, 271.7, 543.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 87600, 0),
(877, '3', '14', '5', '11', 777.53, 272.14, 544.27, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 87700, 0),
(878, '3', '14', '5', '12', 778.78, 272.57, 545.15, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 87800, 0),
(879, '3', '15', '1', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 87900, 0),
(880, '3', '15', '1', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 88000, 0),
(881, '3', '15', '1', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 88100, 0),
(882, '3', '15', '1', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 88200, 0),
(883, '3', '15', '1', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 88300, 0),
(884, '3', '15', '1', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 88400, 0),
(885, '3', '15', '1', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 88500, 0),
(886, '3', '15', '1', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 88600, 0),
(887, '3', '15', '1', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 88700, 0),
(888, '3', '15', '1', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 88800, 0),
(889, '3', '15', '1', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 88900, 0),
(890, '3', '15', '1', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 89000, 0),
(891, '3', '15', '2', '1', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 89100, 0),
(892, '3', '15', '2', '2', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 89200, 0),
(893, '3', '15', '2', '3', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 89300, 0),
(894, '3', '15', '2', '4', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 89400, 0),
(895, '3', '15', '2', '5', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 89500, 0),
(896, '3', '15', '2', '6', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 89600, 0),
(897, '3', '15', '2', '7', 697.94, 244.28, 488.56, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 89700, 0),
(898, '3', '15', '2', '8', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 89800, 0),
(899, '3', '15', '2', '9', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 89900, 0),
(900, '3', '15', '2', '10', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 90000, 0),
(901, '3', '15', '2', '11', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 90100, 0),
(902, '3', '15', '2', '12', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 90200, 0),
(903, '3', '15', '3', '1', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 90300, 0),
(904, '3', '15', '3', '2', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 90400, 0),
(905, '3', '15', '3', '3', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 90500, 0),
(906, '3', '15', '3', '4', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 90600, 0),
(907, '3', '15', '3', '5', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 90700, 0),
(908, '3', '15', '3', '6', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 90800, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `fecha_pago` date NOT NULL,
  `no_mensualidad` int(11) NOT NULL COMMENT 'Contador de las mensualidades del contrato',
  `monto_pagado` float NOT NULL,
  `abonado_capital` float NOT NULL COMMENT 'Cantidad que el cliente abona a capital con la mensualidad que está pagando',
  `abonado_interes` float NOT NULL COMMENT 'Cantidad que el cliente abona a interés con la mensualidad que paga',
  `diferencia` float NOT NULL,
  `id_estatus_pago` int(11) NOT NULL,
  `comentario` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_concepto` int(11) NOT NULL,
  `mensualidad_historica` float NOT NULL COMMENT 'Mensualidad que el cliente debió pagar en ese registro.',
  `fecha_mensualidad` date DEFAULT NULL COMMENT 'Fecha de la mensualidad a la que corresponde el pago',
  `fecha_captura` date NOT NULL DEFAULT current_timestamp() COMMENT 'Es la fecha en la que se capturó el pago.',
  `balance_final` float NOT NULL COMMENT 'Cantidad que el cliente debe despues de realizar el pago',
  `estatus_contrato` varchar(100) NOT NULL COMMENT 'Es el estatus que tenía el contrato antes de realizar el pago.',
  `habilitado` int(1) NOT NULL COMMENT 'Indica si el pago está activo o si fue eliminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pagos`
--

INSERT INTO `pagos` (`id_pago`, `id_cliente`, `id_contrato`, `fecha_pago`, `no_mensualidad`, `monto_pagado`, `abonado_capital`, `abonado_interes`, `diferencia`, `id_estatus_pago`, `comentario`, `id_concepto`, `mensualidad_historica`, `fecha_mensualidad`, `fecha_captura`, `balance_final`, `estatus_contrato`, `habilitado`) VALUES
(4, 2, 23, '2022-03-01', 1, 5000, 0, 0, 110, 1, 'No paga completo por x razon.', 3, 0, NULL, '2022-03-05', 0, '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cat_estatus_pago`
--
ALTER TABLE `cat_estatus_pago`
  ADD PRIMARY KEY (`id_estatus_pago`);

--
-- Indexes for table `cat_estatus_venta`
--
ALTER TABLE `cat_estatus_venta`
  ADD PRIMARY KEY (`id_estatus_venta`);

--
-- Indexes for table `cat_tipo_compra`
--
ALTER TABLE `cat_tipo_compra`
  ADD PRIMARY KEY (`id_tipo_compra`);

--
-- Indexes for table `cat_tipo_lote`
--
ALTER TABLE `cat_tipo_lote`
  ADD PRIMARY KEY (`id_tipo_lote`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `cliente_contrato`
--
ALTER TABLE `cliente_contrato`
  ADD PRIMARY KEY (`id_cliente_contrato`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_contrato` (`id_contrato`);

--
-- Indexes for table `concepto`
--
ALTER TABLE `concepto`
  ADD PRIMARY KEY (`id_concepto`);

--
-- Indexes for table `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`id_contrato`),
  ADD KEY `id_estatus_venta` (`id_estatus_venta`),
  ADD KEY `id_tipo_compra` (`id_tipo_compra`),
  ADD KEY `id_lote` (`id_lote`);

--
-- Indexes for table `cuentas_usuario`
--
ALTER TABLE `cuentas_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indexes for table `lotes`
--
ALTER TABLE `lotes`
  ADD PRIMARY KEY (`id_lote`),
  ADD KEY `id_tipo_lote` (`id_tipo_lote`);

--
-- Indexes for table `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_contrato` (`id_contrato`),
  ADD KEY `id_estatus_paga` (`id_estatus_pago`),
  ADD KEY `id_concepto` (`id_concepto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cat_estatus_pago`
--
ALTER TABLE `cat_estatus_pago`
  MODIFY `id_estatus_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cat_estatus_venta`
--
ALTER TABLE `cat_estatus_venta`
  MODIFY `id_estatus_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cat_tipo_compra`
--
ALTER TABLE `cat_tipo_compra`
  MODIFY `id_tipo_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cat_tipo_lote`
--
ALTER TABLE `cat_tipo_lote`
  MODIFY `id_tipo_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cliente_contrato`
--
ALTER TABLE `cliente_contrato`
  MODIFY `id_cliente_contrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12515;

--
-- AUTO_INCREMENT for table `concepto`
--
ALTER TABLE `concepto`
  MODIFY `id_concepto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contrato`
--
ALTER TABLE `contrato`
  MODIFY `id_contrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `cuentas_usuario`
--
ALTER TABLE `cuentas_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lotes`
--
ALTER TABLE `lotes`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=909;

--
-- AUTO_INCREMENT for table `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cliente_contrato`
--
ALTER TABLE `cliente_contrato`
  ADD CONSTRAINT `cliente_contrato_ibfk_1` FOREIGN KEY (`id_contrato`) REFERENCES `contrato` (`id_contrato`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cliente_contrato_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `contrato_ibfk_2` FOREIGN KEY (`id_estatus_venta`) REFERENCES `cat_estatus_venta` (`id_estatus_venta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contrato_ibfk_4` FOREIGN KEY (`id_tipo_compra`) REFERENCES `cat_tipo_compra` (`id_tipo_compra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contrato_ibfk_5` FOREIGN KEY (`id_lote`) REFERENCES `lotes` (`id_lote`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lotes`
--
ALTER TABLE `lotes`
  ADD CONSTRAINT `lotes_ibfk_1` FOREIGN KEY (`id_tipo_lote`) REFERENCES `cat_tipo_lote` (`id_tipo_lote`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pagos_ibfk_2` FOREIGN KEY (`id_contrato`) REFERENCES `contrato` (`id_contrato`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pagos_ibfk_3` FOREIGN KEY (`id_estatus_pago`) REFERENCES `cat_estatus_pago` (`id_estatus_pago`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pagos_ibfk_4` FOREIGN KEY (`id_concepto`) REFERENCES `concepto` (`id_concepto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
