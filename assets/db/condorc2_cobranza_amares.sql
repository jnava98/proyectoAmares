-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2022 at 10:36 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `condorc2_cobranza_amares`
--

-- --------------------------------------------------------

--
-- Table structure for table `cat_cuentas_bancarias`
--

CREATE TABLE `cat_cuentas_bancarias` (
  `id_cuenta_bancaria` int(11) NOT NULL,
  `identificador_cuenta` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `banco` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `moneda` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cat_cuentas_bancarias`
--

INSERT INTO `cat_cuentas_bancarias` (`id_cuenta_bancaria`, `identificador_cuenta`, `banco`, `moneda`) VALUES
(1, '111111', 'SANTANDER', 'EUR'),
(2, '33333', 'BANXICO', 'MEX');

-- --------------------------------------------------------

--
-- Table structure for table `cat_descuentos`
--

CREATE TABLE `cat_descuentos` (
  `id_descuento` int(11) NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `tasa` float NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_modificacion` date NOT NULL,
  `uc` int(11) NOT NULL COMMENT 'Usuario Creacion',
  `uum` int(11) NOT NULL COMMENT 'Usuario ultima modificacion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `cat_descuentos`
--

INSERT INTO `cat_descuentos` (`id_descuento`, `descripcion`, `tasa`, `fecha_creacion`, `fecha_modificacion`, `uc`, `uum`) VALUES
(3, 'Friends And Family', 5, '2022-04-26', '2022-04-26', 1, 1),
(4, 'Preventa', 10, '2022-04-26', '2022-05-19', 1, 1),
(5, 'Dir vtas', 3, '2022-05-19', '2022-05-19', 1, 1),
(6, 'contado', 5, '2022-05-19', '2022-05-19', 1, 1),
(7, 'compra broker', 6, '2022-05-20', '2022-05-20', 1, 1),
(8, 'Direccion de ventas', 1.66666, '2022-05-23', '2022-05-23', 1, 1);

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
(1, 'En promesa de compra'),
(2, 'Apartado'),
(3, 'Enganche'),
(4, 'Pagado');

-- --------------------------------------------------------

--
-- Table structure for table `cat_tipo_compra`
--

CREATE TABLE `cat_tipo_compra` (
  `id_tipo_compra` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tasa` float NOT NULL COMMENT 'Descuento que recibe la compra segun su tipo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cat_tipo_compra`
--

INSERT INTO `cat_tipo_compra` (`id_tipo_compra`, `nombre`, `tasa`) VALUES
(1, 'Financiado', 0),
(2, 'Contado', 15),
(3, 'Contado Comercial', 10),
(4, 'MSI', 5);

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
  `fecha_captura` date NOT NULL COMMENT 'Fecha en la que se capturo el registro',
  `uc` int(11) NOT NULL COMMENT 'Usuario que crea el registro',
  `fecha_modificacion` date DEFAULT NULL,
  `uum` int(11) DEFAULT NULL COMMENT 'Usuario que realizo la ultima modificacion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellido_paterno`, `apellido_materno`, `residencia`, `nacionalidad`, `correo`, `direccion`, `telefono`, `estado_civil`, `act_economica`, `fecha_captura`, `uc`, `fecha_modificacion`, `uum`) VALUES
(1, 'Cesar Julian', 'Toraya', 'Novelo', 'Mérida', 'Mexicana', 'cesartn12@gmail.com', 'C. 87 #660h x 68 y 66 La Herradura IV, Ciudad Caucel, Merida Yucatan', '999 360 0284', 'Soltero', 'Desarrollador', '2022-03-05', 0, NULL, 0),
(2, 'Jorge Carlos', 'Navarrete', 'Torres', 'Mérida', 'Mexicana', 'jorgecnt98@gmail.com', 'asdfasdf', '999 579 9501', 'Casado', 'Desarrollador', '2022-03-05', 0, NULL, 0),
(3, 'Maritzel Beatriz', 'Euan', 'Solis', 'Uman', 'Mexicana', 'maritzels@gmail.com', '', '9991409186', 'Soltera', 'Administrador de Proyectos', '2022-03-05', 0, NULL, 0),
(4, 'Ana Carolina ', 'Martinez', 'Maza', 'Mocochá', 'Mexicana', 'karo@gmail.com', '', '999 397 1844', 'Soltera', 'Coordinadora ', '2022-03-05', 0, NULL, 0),
(10, 'Nicte-Ha', 'Velez', 'Koeppel', 'Playa del carmen ', 'Mexicana ', 'NICKYVK@ICLOUD.COM ', '', '2283110412', '', '', '2022-03-05', 0, NULL, 0),
(11, 'Ramei', 'Dubois', 'Garcia', 'Ciudad de Mexico ', 'Mexicana ', 'Ramaeldubois@hotmail.com', '', '5510697917', '', '', '2022-03-05', 0, NULL, 0),
(12, 'Isaac', 'Banman', 'Derksen', 'Sherwood Park', 'Canadiense', 'isaacdereksen@gmail.com', '', '7809269523', '', '', '2022-03-05', 0, NULL, 0),
(13, 'Luis Alonso', 'Joya', 'Villareal', 'San Pedro de Garza Garcia', 'Mexicana', 'luisjoya7@yahoo.com', '', '8115873786', '', '', '2022-03-05', 0, NULL, 0),
(14, 'Alma Leticia', 'Medellin', 'Bazaldua', 'San Pedro de Garza Garcia', 'Mexicana', 'luisjoya7@yahoo.com', '', '8115873786', '', '', '2022-03-05', 0, NULL, 0),
(15, 'Rosalie', 'Roeper', '', 'Amsterdam', 'Holandesa', 'rosalieroeper@live.nl ', '', ' +31 68321989', '', '', '2022-03-05', 0, NULL, 0),
(16, 'Laurena', 'Rutgers', '', 'Amsterdam', 'Holandesa', ' laurentarutgers1@gmail.com', '', '+31 655818843', '', '', '2022-03-05', 0, NULL, 0),
(17, 'Carlos Ernesto', 'Gutierrez', 'Villaseñor', 'Canada', 'Mexicano', 'neno.gutierrez.03@gmail.com', '', '9057836955', '', '', '2022-03-05', 0, NULL, 0),
(18, 'Roberto', 'Luna', 'Salcedo', 'Solidaridad', 'Mexicano', 'ing_roberto_luna@outlook.es', '', '3337241815', '', '', '2022-03-05', 0, NULL, 0),
(19, 'Olga Maria', 'Rocha ', 'Leon', 'Colombiana', 'Mexicano', 'neno.gutierrez.03@gmail.com', '', '9057836955', '', '', '2022-03-05', 0, NULL, 0),
(20, 'Luis', 'Toraya', 'Novelo', 'Mérida', 'Mexicano', 'luigitoraya@gmail.com', 'C. 45 x 23 y 24 Frac. Del Parque, Mérida, Yucatán', '9992600284', 'Soltero', 'Estudiante', '2022-04-10', 0, NULL, NULL),
(21, 'pepito', 'perez', 'mat', 'Playa del Carmen', 'Mexicana', 'pep@hotmail.com', 'AV115', '9984422150', 'Soltero', '', '0000-00-00', 0, NULL, NULL),
(22, 'BERENICE VALERIE', 'CHARNY', 'AGUIRRE', 'Puerto Aventuras', 'Mexicana', 'berechar@gmail.com', 'Caleta Xelha Dep 4 Mz 18 Lt 57 CP 77713 Puerto Aventuras, Quintana Roo', '9848029357', 'Soltero', '', '0000-00-00', 0, NULL, NULL),
(23, 'LAURA LAURIE ', 'MARION ', 'DUMONT', 'Ciudad de Mexico', 'Francesa', 'laura.dumont@hotmail.fr', 'Av Jose Vasconcelos  9202 Colonia Condesa 06140 Ciudad de Mexico', '5535575311', 'soltera', '', '0000-00-00', 0, NULL, NULL),
(24, 'ANA MARIA', 'MARTINERZ', 'OLMEDO', 'CANCUN', 'MEXICANA', 'mtzana2010@hotmail.com', 'SM330 M58 L31 M 58 L31 FUENTE DE LA SALUD SM330 RESID AQUA 77500', '984 157 8578', 'SOLTERO', '', '0000-00-00', 0, NULL, NULL),
(25, 'ANA BERTHA ', 'MARTINEZ', 'ABUNDIS', 'Fresno 170 SANTA MARIA LA RIVERA CUAHUTEMOC 06400', 'MEXICANA', 'tesor2050@gmail.com', 'FRESNO 170 SANTA MA LA RIVERA 06400', '9841121650', 'CASADA', 'EMPRESARIA', '0000-00-00', 0, NULL, NULL),
(26, 'JUAN RUBEN ', 'MENDOZA', ' RODRIGUEZ ', 'Solidaridad ', 'Mexicana ', 'jrnecedad@hotmail.com', 'Av 35 nte Lt 10 Mz 118 Num 226, Gonzalo Guerrero C.P. 77710 Solidaridad, Quintana Roo', '5533347316', 'Soltero', '', '0000-00-00', 0, NULL, NULL);

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
(12537, 4, 41),
(12538, 20, 41),
(12539, 1, 42),
(12540, 21, 43),
(12541, 21, 44),
(12545, 25, 49);

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
(3, 'MENSUALIDAD CONTRATO'),
(4, 'PAGO FINAL'),
(5, 'ABONO CAPITAL');

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
  `nombre_broker` varchar(50) NOT NULL,
  `comision_broker` float NOT NULL,
  `clientes` varchar(300) NOT NULL,
  `id_lote` int(11) NOT NULL,
  `observaciones` varchar(1000) NOT NULL,
  `fecha_captura` date NOT NULL COMMENT 'Fecha en la que se captura el registro',
  `cant_mensual_enganche` float NOT NULL,
  `fecha_modificacion` date DEFAULT NULL,
  `uc` int(11) NOT NULL,
  `uum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contrato`
--

INSERT INTO `contrato` (`id_contrato`, `fecha_contrato`, `fecha_firma`, `precio_venta`, `id_tipo_compra`, `cant_apartado`, `fecha_apartado`, `cant_enganche`, `fecha_enganche`, `mensualidades`, `mensualidades_enganche`, `monto_mensual`, `tasa_interes`, `pago_final`, `id_estatus_venta`, `dia_pago`, `nombre_broker`, `comision_broker`, `clientes`, `id_lote`, `observaciones`, `fecha_captura`, `cant_mensual_enganche`, `fecha_modificacion`, `uc`, `uum`) VALUES
(41, '0000-00-00', '0000-00-00', 7000, 1, 500, '2022-05-01', 900, '2022-05-07', 144, 9, 54.72, 2, 1000, 2, '2022-05-15', 'Broker de muestra', 0.05, 'Martinez Maza Ana Carolina ,Toraya Novelo Luis', 1, '', '2022-05-12', 100, '2022-06-10', 1, 1),
(42, '0000-00-00', '0000-00-00', 33200, 2, 3200, '2022-05-12', 10000, '2022-05-12', 0, 1, 0, 0, 20000, 2, '2022-05-13', '', 0, 'Toraya Novelo Cesar Julian', 368, '', '2022-05-12', 10000, '2022-05-12', 1, 1),
(43, '2022-05-30', '2022-05-30', 25000, 3, 5000, '2022-05-23', 15000, '2022-05-24', 0, 5, 0, 10, 5000, 2, '2025-05-31', 'Chio', 2500, 'perez mat pepito', 276, 'paga su esposa', '2022-05-19', 3000, '2022-05-19', 1, 1),
(44, '2022-06-11', '2022-06-11', 46356.3, 1, 5000, '2022-05-14', 9271.26, '2022-06-03', 144, 1, 401.43, 0, 401.43, 2, '2022-07-10', '', 0, 'perez mat pepito', 604, 'paga el hijo', '2022-05-19', 4271.26, '2022-05-19', 1, 1),
(45, '2022-06-01', '2022-06-01', 45400.5, 2, 5000, '2022-05-17', 13620.2, '2022-05-31', 0, 0, 0, 0, 4540.05, 2, '2022-07-10', '', 0, 'CHARNY  AGUIRRE BERENICE VALERIE ', 624, '', '2022-05-19', 0, '2022-05-19', 1, 1),
(46, '2022-06-06', '2022-06-06', 46356.3, 1, 5000, '2022-05-17', 9271.26, '2022-06-03', 144, 0, 401.43, 0, 401.43, 2, '2022-07-10', '', 0, 'MARION  DUMONT LAURA LAURIE ', 602, '', '2022-05-20', 0, '2022-05-20', 1, 1),
(47, '2022-06-06', '2022-06-06', 52816.5, 1, 5000, '2022-05-17', 9271.23, '2022-06-03', 144, 0, 401.43, 0, 401.43, 2, '2022-07-10', '', 0, 'MARION  DUMONT LAURA LAURIE ', 605, '', '2022-05-20', 0, '2022-05-20', 1, 1),
(48, '2022-05-20', '2022-05-20', 44926.8, 2, 24680.2, '2022-05-13', 40434.1, '2022-05-17', 0, 0, 0, 0, 4492.68, 2, '2022-05-13', '', 0, 'MARTINERZ  OLMEDO ANA MARIA ', 489, 'compra de broker se descuenta el 6% de comision ', '2022-05-20', 0, '2022-05-20', 1, 1),
(49, '0000-00-00', '0000-00-00', 38200, 1, 5000, '2021-11-20', 8064, '2021-12-09', 60, 1, 654.03, 8, 654.03, 2, '2021-12-10', 'Cesar', 3, 'MARTINEZ ABUNDIS ANA BERTHA ', 382, 'esta mal el precio', '2022-05-23', 3064, '2022-05-23', 1, 1),
(50, '2022-06-16', '2022-06-16', 47790, 1, 5000, '2022-05-17', 9558, '2022-06-15', 144, 1, 413.84, 0, 413.84, 2, '2022-07-15', '', 0, 'MENDOZA  RODRIGUEZ  JUAN RUBEN ', 405, 'descuento del 1.6666% por direccion  de ventas ', '2022-05-23', 0, '2022-05-23', 1, 1);

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
-- Table structure for table `descuentos_contrato`
--

CREATE TABLE `descuentos_contrato` (
  `id` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `id_descuento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `descuentos_contrato`
--

INSERT INTO `descuentos_contrato` (`id`, `id_contrato`, `id_descuento`) VALUES
(10, 30, 1),
(11, 31, 1),
(12, 32, 1),
(13, 33, 1),
(14, 34, 1),
(15, 35, 1),
(16, 36, 1),
(21, 37, 0),
(22, 38, 0),
(23, 42, 3),
(24, 42, 4),
(25, 43, 3),
(26, 43, 4),
(27, 44, 4),
(28, 44, 5),
(29, 45, 4),
(30, 45, 6),
(31, 46, 4),
(32, 46, 5),
(33, 47, 4),
(34, 47, 5),
(35, 48, 4),
(36, 48, 6),
(37, 48, 7),
(38, 50, 4),
(39, 50, 8);

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
  `precio_historico` float NOT NULL,
  `estatus` int(11) NOT NULL COMMENT 'Indica si el lote ya fue ocupado por algun cliente o no.',
  `uum` int(11) DEFAULT NULL COMMENT 'Ultimo usuario que modifico',
  `fecha_modificacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lotes`
--

INSERT INTO `lotes` (`id_lote`, `fase`, `super_manzana`, `mza`, `lote`, `m2`, `cos`, `cus`, `uso`, `id_tipo_lote`, `fecha_entrega`, `disponibilidad`, `precio_lista`, `precio_historico`, `estatus`, `uum`, `fecha_modificacion`) VALUES
(1, '1', '1', '3', '1', 700, 378.11, 756.21, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 7000, 0, 0, 0, NULL),
(2, '1', '1', '3', '2', 841.31, 294.46, 588.92, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 200, 0, 0, 0, NULL),
(3, '1', '1', '3', '3', 841.31, 294.46, 588.92, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 300, 0, 0, 0, NULL),
(4, '1', '1', '3', '4', 785.99, 275.1, 550.19, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 400, 0, 0, 0, NULL),
(5, '1', '1', '3', '5', 919.45, 321.81, 643.62, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 500, 0, 0, 0, NULL),
(6, '1', '1', '3', '6', 845.18, 295.81, 591.63, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 600, 0, 0, 0, NULL),
(7, '1', '1', '3', '7', 712.93, 249.53, 499.05, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 700, 0, 0, 0, NULL),
(8, '1', '1', '3', '8', 749.37, 262.28, 524.56, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 800, 0, 0, 0, NULL),
(9, '1', '1', '3', '9', 749.37, 262.28, 524.56, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 900, 0, 0, 0, NULL),
(10, '1', '1', '3', '10', 988.36, 345.93, 691.85, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 1000, 0, 0, 0, NULL),
(11, '1', '1', '4', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 1100, 0, 0, 0, NULL),
(12, '1', '1', '4', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 1200, 0, 0, 0, NULL),
(13, '1', '1', '4', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 1300, 0, 0, 0, NULL),
(14, '1', '1', '4', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 1400, 0, 0, 0, NULL),
(15, '1', '1', '4', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 1500, 0, 0, 0, NULL),
(16, '1', '1', '4', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 1600, 0, 0, 0, NULL),
(17, '1', '1', '4', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 1700, 0, 0, 0, NULL),
(18, '1', '1', '4', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 1800, 0, 0, 0, NULL),
(19, '1', '1', '4', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 1900, 0, 0, 0, NULL),
(20, '1', '1', '4', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 2000, 0, 0, 0, NULL),
(21, '1', '1', '4', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 2100, 0, 0, 0, NULL),
(22, '1', '1', '4', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 2200, 0, 0, 0, NULL),
(23, '1', '1', '5', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 2300, 0, 0, 0, NULL),
(24, '1', '1', '5', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 2400, 0, 0, 0, NULL),
(25, '1', '1', '5', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 2500, 0, 0, 0, NULL),
(26, '1', '1', '5', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 2600, 0, 0, 0, NULL),
(27, '1', '1', '5', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 2700, 0, 0, 0, NULL),
(28, '1', '1', '5', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 2800, 0, 0, 0, NULL),
(29, '1', '1', '5', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 2900, 0, 0, 0, NULL),
(30, '1', '1', '5', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 3000, 0, 0, 0, NULL),
(31, '3', '2', '5', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 5000, 3100, 0, 0, NULL),
(32, '1', '1', '5', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 3200, 0, 0, 0, NULL),
(33, '1', '1', '5', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 3300, 0, 0, 0, NULL),
(34, '1', '1', '5', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 3400, 0, 0, 0, NULL),
(35, '1', '1', '6', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 3500, 0, 0, 0, NULL),
(36, '1', '1', '6', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 3600, 0, 0, 0, NULL),
(37, '1', '1', '6', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 3700, 0, 0, 0, NULL),
(38, '1', '1', '6', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 3800, 0, 0, 0, NULL),
(39, '1', '1', '6', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 3900, 0, 0, 0, NULL),
(40, '1', '1', '6', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 4000, 0, 0, 0, NULL),
(41, '1', '1', '6', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 4100, 0, 0, 0, NULL),
(42, '1', '1', '6', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 4200, 0, 0, 0, NULL),
(43, '1', '1', '6', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 4300, 0, 0, 0, NULL),
(44, '1', '1', '6', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 4400, 0, 0, 0, NULL),
(45, '1', '1', '6', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 4500, 0, 0, 0, NULL),
(46, '1', '1', '6', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 4600, 0, 0, 0, NULL),
(47, '1', '1', '7', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 4700, 0, 0, 0, NULL),
(48, '1', '1', '7', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 4800, 0, 0, 0, NULL),
(49, '1', '1', '7', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 4900, 0, 0, 0, NULL),
(50, '1', '1', '7', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 5000, 0, 0, 0, NULL),
(51, '1', '1', '7', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 5100, 0, 0, 0, NULL),
(52, '1', '1', '7', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 5200, 0, 0, 0, NULL),
(53, '1', '1', '7', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 5300, 0, 0, 0, NULL),
(54, '1', '1', '7', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 5400, 0, 0, 0, NULL),
(55, '1', '1', '7', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 5500, 0, 0, 0, NULL),
(56, '1', '1', '7', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 5600, 0, 0, 0, NULL),
(57, '1', '1', '7', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 5700, 0, 0, 0, NULL),
(58, '1', '1', '7', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 5800, 0, 0, 0, NULL),
(59, '1', '1', '8', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 5900, 0, 0, 0, NULL),
(60, '1', '1', '8', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 6000, 0, 0, 0, NULL),
(61, '1', '1', '8', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 6100, 0, 0, 0, NULL),
(62, '1', '1', '8', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 6200, 0, 0, 0, NULL),
(63, '1', '1', '8', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 6300, 0, 0, 0, NULL),
(64, '1', '1', '8', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 6400, 0, 0, 0, NULL),
(65, '1', '1', '8', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 6500, 0, 0, 0, NULL),
(66, '1', '1', '8', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 6600, 0, 0, 0, NULL),
(67, '1', '1', '8', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 6700, 0, 0, 0, NULL),
(68, '1', '1', '8', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 6800, 0, 0, 0, NULL),
(69, '1', '1', '8', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 6900, 0, 0, 0, NULL),
(70, '1', '1', '8', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 7000, 0, 0, 0, NULL),
(71, '1', '1', '9', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 7100, 0, 0, 0, NULL),
(72, '1', '1', '9', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 7200, 0, 0, 0, NULL),
(73, '1', '1', '9', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 7300, 0, 0, 0, NULL),
(74, '1', '1', '9', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 7400, 0, 0, 0, NULL),
(75, '1', '1', '9', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 7500, 0, 0, 0, NULL),
(76, '1', '1', '9', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 7600, 0, 0, 0, NULL),
(77, '1', '1', '9', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 7700, 0, 0, 0, NULL),
(78, '1', '1', '9', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 7800, 0, 0, 0, NULL),
(79, '1', '1', '9', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 7900, 0, 0, 0, NULL),
(80, '1', '1', '9', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 8000, 0, 0, 0, NULL),
(81, '1', '1', '9', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 8100, 0, 0, 0, NULL),
(82, '1', '1', '9', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 8200, 0, 0, 0, NULL),
(83, '1', '1', '10', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 8300, 0, 0, 0, NULL),
(84, '1', '1', '10', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 8400, 0, 0, 0, NULL),
(85, '1', '1', '10', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 8500, 0, 0, 0, NULL),
(86, '1', '1', '10', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 8600, 0, 0, 0, NULL),
(87, '1', '1', '10', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 8700, 0, 0, 0, NULL),
(88, '1', '1', '10', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 8800, 0, 0, 0, NULL),
(89, '1', '1', '10', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 8900, 0, 0, 0, NULL),
(90, '1', '1', '10', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 9000, 0, 0, 0, NULL),
(91, '1', '1', '10', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 9100, 0, 0, 0, NULL),
(92, '1', '1', '10', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 9200, 0, 0, 0, NULL),
(93, '1', '1', '10', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 9300, 0, 0, 0, NULL),
(94, '1', '1', '10', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 9400, 0, 0, 0, NULL),
(95, '1', '1', '11', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 9500, 0, 0, 0, NULL),
(96, '1', '1', '11', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 9600, 0, 0, 0, NULL),
(97, '1', '1', '11', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 9700, 0, 0, 0, NULL),
(98, '1', '1', '11', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 9800, 0, 0, 0, NULL),
(99, '1', '1', '11', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 9900, 0, 0, 0, NULL),
(100, '1', '1', '11', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 10000, 0, 0, 0, NULL),
(101, '1', '1', '11', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 10100, 0, 0, 0, NULL),
(102, '1', '1', '11', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 10200, 0, 0, 0, NULL),
(103, '1', '1', '11', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 10300, 0, 0, 0, NULL),
(104, '1', '1', '11', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 10400, 0, 0, 0, NULL),
(105, '1', '1', '11', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 10500, 0, 0, 0, NULL),
(106, '1', '1', '11', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 10600, 0, 0, 0, NULL),
(107, '1', '1', '12', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 10700, 0, 0, 0, NULL),
(108, '1', '1', '12', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 10800, 0, 0, 0, NULL),
(109, '1', '1', '12', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 10900, 0, 0, 0, NULL),
(110, '1', '1', '12', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 11000, 0, 0, 0, NULL),
(111, '1', '1', '12', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 11100, 0, 0, 0, NULL),
(112, '1', '1', '12', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 11200, 0, 0, 0, NULL),
(113, '1', '1', '12', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 11300, 0, 0, 0, NULL),
(114, '1', '1', '12', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 11400, 0, 0, 0, NULL),
(115, '1', '1', '12', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 11500, 0, 0, 0, NULL),
(116, '1', '1', '12', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 11600, 0, 0, 0, NULL),
(117, '1', '1', '12', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 11700, 0, 0, 0, NULL),
(118, '1', '1', '12', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 11800, 0, 0, 0, NULL),
(119, '1', '1', '13', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 11900, 0, 0, 0, NULL),
(120, '1', '1', '13', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 12000, 0, 0, 0, NULL),
(121, '1', '1', '13', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 12100, 0, 0, 0, NULL),
(122, '1', '1', '13', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 12200, 0, 0, 0, NULL),
(123, '1', '1', '13', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 12300, 0, 0, 0, NULL),
(124, '1', '1', '13', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 12400, 0, 0, 0, NULL),
(125, '1', '1', '13', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 12500, 0, 0, 0, NULL),
(126, '1', '1', '13', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 12600, 0, 0, 0, NULL),
(127, '1', '1', '13', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 12700, 0, 0, 0, NULL),
(128, '1', '1', '13', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 12800, 0, 0, 0, NULL),
(129, '1', '1', '13', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 12900, 0, 0, 0, NULL),
(130, '1', '1', '13', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 13000, 0, 0, 0, NULL),
(131, '1', '1', '14', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 13100, 0, 0, 0, NULL),
(132, '1', '1', '14', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 13200, 0, 0, 0, NULL),
(133, '1', '1', '14', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 13300, 0, 0, 0, NULL),
(134, '1', '1', '14', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 13400, 0, 0, 0, NULL),
(135, '1', '1', '14', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 13500, 0, 0, 0, NULL),
(136, '1', '1', '14', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 13600, 0, 0, 0, NULL),
(137, '1', '1', '14', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 13700, 0, 0, 0, NULL),
(138, '1', '1', '14', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 13800, 0, 0, 0, NULL),
(139, '1', '1', '14', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 13900, 0, 0, 0, NULL),
(140, '1', '1', '14', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 14000, 0, 0, 0, NULL),
(141, '1', '1', '14', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 14100, 0, 0, 0, NULL),
(142, '1', '1', '14', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 14200, 0, 0, 0, NULL),
(143, '1', '1', '15', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 14300, 0, 0, 0, NULL),
(144, '1', '1', '15', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 14400, 0, 0, 0, NULL),
(145, '1', '1', '15', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 14500, 0, 0, 0, NULL),
(146, '1', '1', '15', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 14600, 0, 0, 0, NULL),
(147, '1', '1', '15', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 14700, 0, 0, 0, NULL),
(148, '1', '1', '15', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 14800, 0, 0, 0, NULL),
(149, '1', '1', '15', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 14900, 0, 0, 0, NULL),
(150, '1', '1', '15', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 15000, 0, 0, 0, NULL),
(151, '1', '1', '15', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 15100, 0, 0, 0, NULL),
(152, '1', '1', '15', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 15200, 0, 0, 0, NULL),
(153, '1', '1', '15', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 15300, 0, 0, 0, NULL),
(154, '1', '1', '15', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 15400, 0, 0, 0, NULL),
(155, '1', '1', '16', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 15500, 0, 0, 0, NULL),
(156, '1', '1', '16', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 15600, 0, 0, 0, NULL),
(157, '1', '1', '16', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 15700, 0, 0, 0, NULL),
(158, '1', '1', '16', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 15800, 0, 0, 0, NULL),
(159, '1', '1', '16', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 15900, 0, 0, 0, NULL),
(160, '1', '1', '16', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 16000, 0, 0, 0, NULL),
(161, '1', '1', '16', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 16100, 0, 0, 0, NULL),
(162, '1', '1', '16', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 16200, 0, 0, 0, NULL),
(163, '1', '1', '16', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 16300, 0, 0, 0, NULL),
(164, '1', '1', '16', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 16400, 0, 0, 0, NULL),
(165, '1', '1', '16', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 16500, 0, 0, 0, NULL),
(166, '1', '1', '16', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 16600, 0, 0, 0, NULL),
(167, '1', '1', '17', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 16700, 0, 0, 0, NULL),
(168, '1', '1', '17', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 16800, 0, 0, 0, NULL),
(169, '1', '1', '17', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 16900, 0, 0, 0, NULL),
(170, '1', '1', '17', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 17000, 0, 0, 0, NULL),
(171, '1', '1', '17', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 17100, 0, 0, 0, NULL),
(172, '1', '1', '17', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 17200, 0, 0, 0, NULL),
(173, '1', '1', '17', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 17300, 0, 0, 0, NULL),
(174, '1', '1', '17', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 17400, 0, 0, 0, NULL),
(175, '1', '1', '17', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 17500, 0, 0, 0, NULL),
(176, '1', '1', '17', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 17600, 0, 0, 0, NULL),
(177, '1', '1', '17', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 17700, 0, 0, 0, NULL),
(178, '1', '1', '17', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 17800, 0, 0, 0, NULL),
(179, '1', '1', '18', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 17900, 0, 0, 0, NULL),
(180, '1', '1', '18', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 18000, 0, 0, 0, NULL),
(181, '1', '1', '18', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 18100, 0, 0, 0, NULL),
(182, '1', '1', '18', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 18200, 0, 0, 0, NULL),
(183, '1', '1', '18', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 18300, 0, 0, 0, NULL),
(184, '1', '1', '18', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 18400, 0, 0, 0, NULL),
(185, '1', '1', '18', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 18500, 0, 0, 0, NULL),
(186, '1', '1', '18', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 18600, 0, 0, 0, NULL),
(187, '1', '1', '18', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 18700, 0, 0, 0, NULL),
(188, '1', '1', '18', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 18800, 0, 0, 0, NULL),
(189, '1', '1', '18', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 18900, 0, 0, 0, NULL),
(190, '1', '1', '18', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 19000, 0, 0, 0, NULL),
(191, '1', '2', '4', '1', 1, 381.5, 762.99, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 19100, 0, 0, 0, NULL),
(192, '1', '2', '4', '2', 829.4, 290.29, 580.58, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 19200, 0, 0, 0, NULL),
(193, '1', '2', '4', '3', 829.4, 290.29, 580.58, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 19300, 0, 0, 0, NULL),
(194, '1', '2', '4', '4', 766.74, 268.36, 536.72, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 19400, 0, 0, 0, NULL),
(195, '1', '2', '4', '5', 960.47, 336.16, 672.33, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 19500, 0, 0, 0, NULL),
(196, '1', '2', '4', '7', 766.05, 268.12, 536.24, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 19600, 0, 0, 0, NULL),
(197, '1', '2', '4', '8', 1, 360.95, 721.9, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 19700, 0, 0, 0, NULL),
(198, '1', '2', '5', '1', 917.02, 320.96, 641.91, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 19800, 0, 0, 0, NULL),
(199, '1', '2', '5', '2', 690.47, 241.66, 483.33, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 19900, 0, 0, 0, NULL),
(200, '1', '2', '5', '3', 690.47, 241.66, 483.33, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 20000, 0, 0, 0, NULL),
(201, '1', '2', '5', '4', 690.47, 241.66, 483.33, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 20100, 0, 0, 0, NULL),
(202, '1', '2', '5', '5', 624.13, 218.45, 436.89, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 20200, 0, 0, 0, NULL),
(203, '1', '2', '5', '6', 803.85, 281.35, 562.7, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 20300, 0, 0, 0, NULL),
(204, '1', '2', '5', '7', 711.55, 249.04, 498.09, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 20400, 0, 0, 0, NULL),
(205, '1', '2', '5', '8', 586.71, 205.35, 410.7, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 20500, 0, 0, 0, NULL),
(206, '1', '2', '5', '9', 630.92, 220.82, 441.64, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 20600, 0, 0, 0, NULL),
(207, '1', '2', '5', '10', 630.92, 220.82, 441.64, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 20700, 0, 0, 0, NULL),
(208, '1', '2', '5', '11', 630.92, 220.82, 441.64, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 20800, 0, 0, 0, NULL),
(209, '1', '2', '5', '12', 853.82, 298.84, 597.67, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 20900, 0, 0, 0, NULL),
(210, '1', '2', '6', '1', 871.07, 304.87, 609.75, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 21000, 0, 0, 0, NULL),
(211, '1', '2', '6', '2', 673.2, 235.62, 471.24, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 21100, 0, 0, 0, NULL),
(212, '1', '2', '6', '3', 673.2, 235.62, 471.24, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 21200, 0, 0, 0, NULL),
(213, '1', '2', '6', '4', 673.2, 235.62, 471.24, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 21300, 0, 0, 0, NULL),
(214, '1', '2', '6', '5', 619.62, 216.87, 433.73, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 21400, 0, 0, 0, NULL),
(215, '1', '2', '6', '6', 756.51, 264.78, 529.56, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 21500, 0, 0, 0, NULL),
(216, '1', '2', '6', '7', 690.69, 241.74, 483.48, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 21600, 0, 0, 0, NULL),
(217, '1', '2', '6', '8', 604.42, 211.55, 423.09, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 21700, 0, 0, 0, NULL),
(218, '1', '2', '6', '9', 636.75, 222.86, 445.73, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 21800, 0, 0, 0, NULL),
(219, '1', '2', '6', '10', 636.75, 222.86, 445.73, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 21900, 0, 0, 0, NULL),
(220, '1', '2', '6', '11', 636.75, 222.86, 445.73, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 22000, 0, 0, 0, NULL),
(221, '1', '2', '6', '12', 835.46, 292.41, 584.82, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 22100, 0, 0, 0, NULL),
(222, '1', '2', '7', '1', 795.83, 278.54, 557.08, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 22200, 0, 0, 0, NULL),
(223, '1', '2', '7', '2', 627.51, 219.63, 439.26, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 22300, 0, 0, 0, NULL),
(224, '1', '2', '7', '3', 627.51, 219.63, 439.26, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 22400, 0, 0, 0, NULL),
(225, '1', '2', '7', '4', 627.51, 219.63, 439.26, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 22500, 0, 0, 0, NULL),
(226, '1', '2', '7', '5', 585.62, 204.97, 409.93, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 22600, 0, 0, 0, NULL),
(227, '1', '2', '7', '6', 681.04, 238.36, 476.73, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 22700, 0, 0, 0, NULL),
(228, '1', '2', '7', '7', 707.47, 247.61, 495.23, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 22800, 0, 0, 0, NULL),
(229, '1', '2', '7', '8', 647.05, 226.47, 452.94, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 22900, 0, 0, 0, NULL),
(230, '1', '2', '7', '9', 669.4, 234.29, 468.58, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 23000, 0, 0, 0, NULL),
(231, '1', '2', '7', '10', 669.4, 234.29, 468.58, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 23100, 0, 0, 0, NULL),
(232, '1', '2', '7', '11', 669.4, 234.29, 468.58, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 23200, 0, 0, 0, NULL),
(233, '1', '2', '7', '12', 858.24, 300.38, 600.77, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 23300, 0, 0, 0, NULL),
(234, '1', '2', '8', '1', 821.19, 287.42, 574.83, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 23400, 0, 0, 0, NULL),
(235, '1', '2', '8', '2', 657.67, 230.18, 460.37, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 23500, 0, 0, 0, NULL),
(236, '1', '2', '8', '3', 657.67, 230.18, 460.37, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 23600, 0, 0, 0, NULL),
(237, '1', '2', '8', '4', 657.67, 230.18, 460.37, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 23700, 0, 0, 0, NULL),
(238, '1', '2', '8', '5', 625.7, 219, 437.99, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 23800, 0, 0, 0, NULL),
(239, '1', '2', '8', '6', 698.37, 244.43, 488.86, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 23900, 0, 0, 0, NULL),
(240, '1', '2', '8', '7', 641.3, 224.46, 448.91, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 24000, 0, 0, 0, NULL),
(241, '1', '2', '8', '8', 612.13, 214.25, 428.49, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 24100, 0, 0, 0, NULL),
(242, '1', '2', '8', '9', 626.77, 219.37, 438.74, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 24200, 0, 0, 0, NULL),
(243, '1', '2', '8', '10', 626.77, 219.37, 438.74, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 24300, 0, 0, 0, NULL),
(244, '1', '2', '8', '11', 626.77, 219.37, 438.74, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 24400, 0, 0, 0, NULL),
(245, '1', '2', '8', '12', 789.56, 276.35, 552.69, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 24500, 0, 0, 0, NULL),
(246, '1', '3', '1', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 24600, 0, 0, 0, NULL),
(247, '1', '3', '1', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 24700, 0, 0, 0, NULL),
(248, '1', '3', '1', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 24800, 0, 0, 0, NULL),
(249, '1', '3', '1', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 24900, 0, 0, 0, NULL),
(250, '1', '3', '1', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 25000, 0, 0, 0, NULL),
(251, '1', '3', '1', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 25100, 0, 0, 0, NULL),
(252, '1', '3', '1', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 25200, 0, 0, 0, NULL),
(253, '1', '3', '1', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 25300, 0, 0, 0, NULL),
(254, '1', '3', '1', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 25400, 0, 0, 0, NULL),
(255, '1', '3', '1', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 25500, 0, 0, 0, NULL),
(256, '1', '3', '1', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 25600, 0, 0, 0, NULL),
(257, '1', '3', '1', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 25700, 0, 0, 0, NULL),
(258, '1', '3', '2', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 25800, 0, 0, 0, NULL),
(259, '1', '3', '2', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 25900, 0, 0, 0, NULL),
(260, '1', '3', '2', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 26000, 0, 0, 0, NULL),
(261, '1', '3', '2', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 26100, 0, 0, 0, NULL),
(262, '1', '3', '2', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 26200, 0, 0, 0, NULL),
(263, '1', '3', '2', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 26300, 0, 0, 0, NULL),
(264, '1', '3', '2', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 26400, 0, 0, 0, NULL),
(265, '1', '3', '2', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 26500, 0, 0, 0, NULL),
(266, '1', '3', '2', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 26600, 0, 0, 0, NULL),
(267, '1', '3', '2', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 26700, 0, 0, 0, NULL),
(268, '1', '3', '2', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 26800, 0, 0, 0, NULL),
(269, '1', '3', '2', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 26900, 0, 0, 0, NULL),
(270, '1', '3', '3', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 27000, 0, 0, 0, NULL),
(271, '1', '3', '3', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 27100, 0, 0, 0, NULL),
(272, '1', '3', '3', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 27200, 0, 0, 0, NULL),
(273, '1', '3', '3', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 27300, 0, 0, 0, NULL),
(274, '1', '3', '3', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 27400, 0, 0, 0, NULL),
(275, '1', '3', '3', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 27500, 0, 0, 0, NULL),
(276, '1', '3', '3', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 27600, 0, 0, 0, NULL),
(277, '1', '3', '3', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 27700, 0, 0, 0, NULL),
(278, '1', '3', '3', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 27800, 0, 0, 0, NULL),
(279, '1', '3', '3', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 27900, 0, 0, 0, NULL),
(280, '1', '3', '3', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 28000, 0, 0, 0, NULL),
(281, '1', '3', '3', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 28100, 0, 0, 0, NULL),
(282, '1', '3', '4', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 28200, 0, 0, 0, NULL),
(283, '1', '3', '4', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 28300, 0, 0, 0, NULL),
(284, '1', '3', '4', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 28400, 0, 0, 0, NULL),
(285, '1', '3', '4', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 28500, 0, 0, 0, NULL),
(286, '1', '3', '4', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 28600, 0, 0, 0, NULL),
(287, '1', '3', '4', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 28700, 0, 0, 0, NULL),
(288, '1', '3', '4', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 28800, 0, 0, 0, NULL),
(289, '1', '3', '4', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 28900, 0, 0, 0, NULL),
(290, '1', '3', '4', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 29000, 0, 0, 0, NULL),
(291, '1', '3', '4', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 29100, 0, 0, 0, NULL),
(292, '1', '3', '4', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 29200, 0, 0, 0, NULL),
(293, '1', '3', '4', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 29300, 0, 0, 0, NULL),
(294, '1', '3', '5', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 29400, 0, 0, 0, NULL),
(295, '1', '3', '5', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 29500, 0, 0, 0, NULL),
(296, '1', '3', '5', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 29600, 0, 0, 0, NULL),
(297, '1', '3', '5', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 29700, 0, 0, 0, NULL),
(298, '1', '3', '5', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 29800, 0, 0, 0, NULL),
(299, '1', '3', '5', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 29900, 0, 0, 0, NULL),
(300, '1', '3', '5', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 30000, 0, 0, 0, NULL),
(301, '1', '3', '5', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 30100, 0, 0, 0, NULL),
(302, '1', '3', '5', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 30200, 0, 0, 0, NULL),
(303, '1', '3', '5', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 30300, 0, 0, 0, NULL),
(304, '1', '3', '5', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 30400, 0, 0, 0, NULL),
(305, '1', '3', '5', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 30500, 0, 0, 0, NULL),
(306, '1', '3', '6', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 30600, 0, 0, 0, NULL),
(307, '1', '3', '6', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 30700, 0, 0, 0, NULL),
(308, '1', '3', '6', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 30800, 0, 0, 0, NULL),
(309, '1', '3', '6', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 30900, 0, 0, 0, NULL),
(310, '1', '3', '6', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 31000, 0, 0, 0, NULL),
(311, '1', '3', '6', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 31100, 0, 0, 0, NULL),
(312, '1', '3', '6', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 31200, 0, 0, 0, NULL),
(313, '1', '3', '6', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 31300, 0, 0, 0, NULL),
(314, '1', '3', '6', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 31400, 0, 0, 0, NULL),
(315, '1', '3', '6', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 31500, 0, 0, 0, NULL),
(316, '1', '3', '6', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 31600, 0, 0, 0, NULL),
(317, '1', '3', '6', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 31700, 0, 0, 0, NULL),
(318, '1', '4', '2', '1', 10, 0, 0, 'AREA DE RESERVA', 1, '0000-00-00', 'N/A', 31800, 0, 0, 0, NULL),
(319, '1', '4', '3', '1', 467.88, 163.76, 327.52, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 31900, 0, 0, 0, NULL),
(320, '1', '4', '3', '2', 612.58, 214.4, 428.81, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 32000, 0, 0, 0, NULL),
(321, '1', '4', '3', '3', 662.46, 231.86, 463.72, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 32100, 0, 0, 0, NULL),
(322, '1', '4', '3', '4', 690.03, 241.51, 483.02, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 32200, 0, 0, 0, NULL),
(323, '1', '4', '3', '5', 717.59, 251.16, 502.31, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 32300, 0, 0, 0, NULL),
(324, '1', '4', '3', '6', 745.16, 260.81, 521.61, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 32400, 0, 0, 0, NULL),
(325, '1', '4', '3', '7', 745.16, 260.81, 521.61, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 32500, 0, 0, 0, NULL),
(326, '1', '4', '3', '8', 717.59, 251.16, 502.31, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 32600, 0, 0, 0, NULL),
(327, '1', '4', '3', '9', 690.03, 241.51, 483.02, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 32700, 0, 0, 0, NULL),
(328, '1', '4', '3', '10', 662.46, 231.86, 463.72, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 32800, 0, 0, 0, NULL),
(329, '1', '4', '3', '11', 633.5, 221.73, 443.45, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 32900, 0, 0, 0, NULL),
(330, '1', '4', '3', '12', 526.56, 184.3, 368.59, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 33000, 0, 0, 0, NULL),
(331, '1', '4', '4', '1', 651.32, 227.96, 455.92, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 33100, 0, 0, 0, NULL),
(332, '1', '4', '4', '2', 671.02, 234.86, 469.71, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 33200, 0, 0, 0, NULL),
(333, '1', '4', '4', '3', 690.71, 241.75, 483.5, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 33300, 0, 0, 0, NULL),
(334, '1', '4', '4', '4', 710.41, 248.64, 497.29, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 33400, 0, 0, 0, NULL),
(335, '1', '4', '4', '5', 730.1, 255.54, 511.07, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 33500, 0, 0, 0, NULL),
(336, '1', '4', '4', '6', 749.79, 262.43, 524.85, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 33600, 0, 0, 0, NULL),
(337, '1', '4', '4', '7', 749.79, 262.43, 524.85, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 33700, 0, 0, 0, NULL),
(338, '1', '4', '4', '8', 730.1, 255.54, 511.07, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 33800, 0, 0, 0, NULL),
(339, '1', '4', '4', '9', 710.41, 248.64, 497.29, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 33900, 0, 0, 0, NULL),
(340, '1', '4', '4', '10', 690.71, 241.75, 483.5, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 34000, 0, 0, 0, NULL),
(341, '1', '4', '4', '11', 671.02, 234.86, 469.71, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 34100, 0, 0, 0, NULL),
(342, '1', '4', '4', '12', 651.32, 227.96, 455.92, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 34200, 0, 0, 0, NULL),
(343, '1', '4', '5', '1', 677.87, 237.25, 474.51, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 34300, 0, 0, 0, NULL),
(344, '1', '4', '5', '2', 693.2, 242.62, 485.24, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 34400, 0, 0, 0, NULL),
(345, '1', '4', '5', '3', 708.53, 247.99, 495.97, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 34500, 0, 0, 0, NULL),
(346, '1', '4', '5', '4', 723.86, 253.35, 506.7, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 34600, 0, 0, 0, NULL),
(347, '1', '4', '5', '5', 739.19, 258.72, 517.43, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 34700, 0, 0, 0, NULL),
(348, '1', '4', '5', '6', 754.51, 264.08, 528.16, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 34800, 0, 0, 0, NULL),
(349, '1', '4', '5', '7', 754.51, 264.08, 528.16, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 34900, 0, 0, 0, NULL),
(350, '1', '4', '5', '8', 739.19, 258.72, 517.43, 'HABITACIONAL', 1, '0000-00-00', 'PARA VENTA', 35000, 0, 0, 0, NULL),
(351, '1', '4', '5', '9', 723.86, 253.35, 506.7, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 35100, 0, 0, 0, NULL),
(352, '1', '4', '5', '10', 708.53, 247.99, 495.97, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 35200, 0, 0, 0, NULL),
(353, '1', '4', '5', '11', 693.2, 242.62, 485.24, 'HABITACIONAL', 2, '0000-00-00', 'PARA VENTA', 35300, 0, 0, 0, NULL),
(354, '1', '4', '5', '12', 677.87, 237.25, 474.51, 'HABITACIONAL', 3, '0000-00-00', 'PARA VENTA', 35400, 0, 0, 0, NULL),
(355, '2', '1', '21', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 35500, 0, 0, 0, NULL),
(356, '2', '1', '21', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 35600, 0, 0, 0, NULL),
(357, '2', '1', '21', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 35700, 0, 0, 0, NULL),
(358, '2', '1', '21', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 35800, 0, 0, 0, NULL),
(359, '2', '1', '21', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 35900, 0, 0, 0, NULL),
(360, '2', '1', '21', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 36000, 0, 0, 0, NULL),
(361, '2', '1', '21', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 36100, 0, 0, 0, NULL),
(362, '2', '1', '21', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 36200, 0, 0, 0, NULL),
(363, '2', '1', '21', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 36300, 0, 0, 0, NULL),
(364, '2', '1', '21', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 36400, 0, 0, 0, NULL),
(365, '2', '1', '21', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 36500, 0, 0, 0, NULL),
(366, '2', '1', '21', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 36600, 0, 0, 0, NULL),
(367, '2', '1', '22', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 36700, 0, 0, 0, NULL),
(368, '2', '1', '22', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 36800, 0, 0, 0, NULL),
(369, '2', '1', '22', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 36900, 0, 0, 0, NULL),
(370, '2', '1', '22', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 37000, 0, 0, 0, NULL),
(371, '2', '1', '22', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 37100, 0, 0, 0, NULL),
(372, '2', '1', '22', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 37200, 0, 0, 0, NULL),
(373, '2', '1', '22', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 37300, 0, 0, 0, NULL),
(374, '2', '1', '22', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 37400, 0, 0, 0, NULL),
(375, '2', '1', '22', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 37500, 0, 0, 0, NULL),
(376, '2', '1', '22', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 37600, 0, 0, 0, NULL),
(377, '2', '1', '22', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 37700, 0, 0, 0, NULL),
(378, '2', '1', '22', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 37800, 0, 0, 0, NULL),
(379, '2', '1', '23', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 37900, 0, 0, 0, NULL),
(380, '2', '1', '23', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 38000, 0, 0, 0, NULL),
(381, '2', '1', '23', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 38100, 0, 0, 0, NULL),
(382, '2', '1', '23', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 38200, 0, 0, 0, NULL),
(383, '2', '1', '23', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 38300, 0, 0, 0, NULL),
(384, '2', '1', '23', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 38400, 0, 0, 0, NULL),
(385, '2', '1', '23', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 38500, 0, 0, 0, NULL),
(386, '2', '1', '23', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 38600, 0, 0, 0, NULL),
(387, '2', '1', '23', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 38700, 0, 0, 0, NULL),
(388, '2', '1', '23', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 38800, 0, 0, 0, NULL),
(389, '2', '1', '23', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 38900, 0, 0, 0, NULL),
(390, '2', '1', '23', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 39000, 0, 0, 0, NULL),
(391, '2', '1', '24', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 39100, 0, 0, 0, NULL),
(392, '2', '1', '24', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 39200, 0, 0, 0, NULL),
(393, '2', '1', '24', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 39300, 0, 0, 0, NULL),
(394, '2', '1', '24', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 39400, 0, 0, 0, NULL),
(395, '2', '1', '24', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 39500, 0, 0, 0, NULL),
(396, '2', '1', '24', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 39600, 0, 0, 0, NULL),
(397, '2', '1', '24', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 39700, 0, 0, 0, NULL),
(398, '2', '1', '24', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 39800, 0, 0, 0, NULL),
(399, '2', '1', '24', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 39900, 0, 0, 0, NULL),
(400, '2', '1', '24', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 40000, 0, 0, 0, NULL),
(401, '2', '1', '24', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 40100, 0, 0, 0, NULL),
(402, '2', '1', '24', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 40200, 0, 0, 0, NULL),
(403, '2', '1', '25', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 40300, 0, 0, 0, NULL),
(404, '2', '1', '25', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 40400, 0, 0, 0, NULL),
(405, '2', '1', '25', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 54000, 40500, 0, 0, NULL),
(406, '2', '1', '25', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 40600, 0, 0, 0, NULL),
(407, '2', '1', '25', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 40700, 0, 0, 0, NULL),
(408, '2', '1', '25', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 40800, 0, 0, 0, NULL),
(409, '2', '1', '25', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 40900, 0, 0, 0, NULL),
(410, '2', '1', '25', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 41000, 0, 0, 0, NULL),
(411, '2', '1', '25', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 41100, 0, 0, 0, NULL),
(412, '2', '1', '25', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 41200, 0, 0, 0, NULL),
(413, '2', '1', '25', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 41300, 0, 0, 0, NULL),
(414, '2', '1', '25', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 41400, 0, 0, 0, NULL),
(415, '2', '1', '26', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 41500, 0, 0, 0, NULL),
(416, '2', '1', '26', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 41600, 0, 0, 0, NULL),
(417, '2', '1', '26', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 41700, 0, 0, 0, NULL),
(418, '2', '1', '26', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 41800, 0, 0, 0, NULL),
(419, '2', '1', '26', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 41900, 0, 0, 0, NULL),
(420, '2', '1', '26', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 42000, 0, 0, 0, NULL),
(421, '2', '1', '26', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 42100, 0, 0, 0, NULL),
(422, '2', '1', '26', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 42200, 0, 0, 0, NULL),
(423, '2', '1', '26', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 42300, 0, 0, 0, NULL),
(424, '2', '1', '26', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 42400, 0, 0, 0, NULL),
(425, '2', '1', '26', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 42500, 0, 0, 0, NULL);
INSERT INTO `lotes` (`id_lote`, `fase`, `super_manzana`, `mza`, `lote`, `m2`, `cos`, `cus`, `uso`, `id_tipo_lote`, `fecha_entrega`, `disponibilidad`, `precio_lista`, `precio_historico`, `estatus`, `uum`, `fecha_modificacion`) VALUES
(426, '2', '1', '26', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 42600, 0, 0, 0, NULL),
(427, '2', '1', '27', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 42700, 0, 0, 0, NULL),
(428, '2', '1', '27', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 42800, 0, 0, 0, NULL),
(429, '2', '1', '27', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 42900, 0, 0, 0, NULL),
(430, '2', '1', '27', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 43000, 0, 0, 0, NULL),
(431, '2', '1', '27', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 43100, 0, 0, 0, NULL),
(432, '2', '1', '27', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 43200, 0, 0, 0, NULL),
(433, '2', '1', '27', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 43300, 0, 0, 0, NULL),
(434, '2', '1', '27', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 43400, 0, 0, 0, NULL),
(435, '2', '1', '27', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 43500, 0, 0, 0, NULL),
(436, '2', '1', '27', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 43600, 0, 0, 0, NULL),
(437, '2', '1', '27', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 43700, 0, 0, 0, NULL),
(438, '2', '1', '27', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 43800, 0, 0, 0, NULL),
(439, '2', '5', '1', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 43900, 0, 0, 0, NULL),
(440, '2', '5', '1', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 44000, 0, 0, 0, NULL),
(441, '2', '5', '1', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 44100, 0, 0, 0, NULL),
(442, '2', '5', '1', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 44200, 0, 0, 0, NULL),
(443, '2', '5', '1', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 44300, 0, 0, 0, NULL),
(444, '2', '5', '1', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 44400, 0, 0, 0, NULL),
(445, '2', '5', '1', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 44500, 0, 0, 0, NULL),
(446, '2', '5', '1', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 44600, 0, 0, 0, NULL),
(447, '2', '5', '1', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 44700, 0, 0, 0, NULL),
(448, '2', '5', '1', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 44800, 0, 0, 0, NULL),
(449, '2', '5', '1', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 44900, 0, 0, 0, NULL),
(450, '2', '5', '1', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 45000, 0, 0, 0, NULL),
(451, '2', '5', '2', '1', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 45100, 0, 0, 0, NULL),
(452, '2', '5', '2', '2', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 45200, 0, 0, 0, NULL),
(453, '2', '5', '2', '3', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 45300, 0, 0, 0, NULL),
(454, '2', '5', '2', '4', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 45400, 0, 0, 0, NULL),
(455, '2', '5', '2', '5', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 45500, 0, 0, 0, NULL),
(456, '2', '5', '2', '6', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 45600, 0, 0, 0, NULL),
(457, '2', '5', '2', '7', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 45700, 0, 0, 0, NULL),
(458, '2', '5', '2', '8', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 45800, 0, 0, 0, NULL),
(459, '2', '5', '2', '9', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 45900, 0, 0, 0, NULL),
(460, '2', '5', '2', '10', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 46000, 0, 0, 0, NULL),
(461, '2', '5', '2', '11', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 46100, 0, 0, 0, NULL),
(462, '2', '5', '2', '12', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 46200, 0, 0, 0, NULL),
(463, '2', '5', '3', '1', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 46300, 0, 0, 0, NULL),
(464, '2', '5', '3', '2', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 46400, 0, 0, 0, NULL),
(465, '2', '5', '3', '3', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 46500, 0, 0, 0, NULL),
(466, '2', '5', '3', '4', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 46600, 0, 0, 0, NULL),
(467, '2', '5', '3', '5', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 46700, 0, 0, 0, NULL),
(468, '2', '5', '3', '6', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 46800, 0, 0, 0, NULL),
(469, '2', '5', '3', '7', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 46900, 0, 0, 0, NULL),
(470, '2', '5', '3', '8', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 47000, 0, 0, 0, NULL),
(471, '2', '5', '3', '9', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 47100, 0, 0, 0, NULL),
(472, '2', '5', '3', '10', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 47200, 0, 0, 0, NULL),
(473, '2', '5', '3', '11', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 47300, 0, 0, 0, NULL),
(474, '2', '5', '3', '12', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 47400, 0, 0, 0, NULL),
(475, '2', '5', '4', '1', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 47500, 0, 0, 0, NULL),
(476, '2', '5', '4', '2', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 47600, 0, 0, 0, NULL),
(477, '2', '5', '4', '3', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 47700, 0, 0, 0, NULL),
(478, '2', '5', '4', '4', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 47800, 0, 0, 0, NULL),
(479, '2', '5', '4', '5', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 47900, 0, 0, 0, NULL),
(480, '2', '5', '4', '6', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 48000, 0, 0, 0, NULL),
(481, '2', '5', '4', '7', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 48100, 0, 0, 0, NULL),
(482, '2', '5', '4', '8', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 48200, 0, 0, 0, NULL),
(483, '2', '5', '4', '9', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 48300, 0, 0, 0, NULL),
(484, '2', '5', '4', '10', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 48400, 0, 0, 0, NULL),
(485, '2', '5', '4', '11', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 48500, 0, 0, 0, NULL),
(486, '2', '5', '4', '12', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 48600, 0, 0, 0, NULL),
(487, '2', '5', '5', '1', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 48700, 0, 0, 0, NULL),
(488, '2', '5', '5', '2', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 48800, 0, 0, 0, NULL),
(489, '2', '5', '5', '3', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 55900, 48900, 0, 0, NULL),
(490, '2', '5', '5', '4', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 49000, 0, 0, 0, NULL),
(491, '2', '5', '5', '5', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 49100, 0, 0, 0, NULL),
(492, '2', '5', '5', '6', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 49200, 0, 0, 0, NULL),
(493, '2', '5', '5', '7', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 49300, 0, 0, 0, NULL),
(494, '2', '5', '5', '8', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 49400, 0, 0, 0, NULL),
(495, '2', '5', '5', '9', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 49500, 0, 0, 0, NULL),
(496, '2', '5', '5', '10', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 49600, 0, 0, 0, NULL),
(497, '2', '5', '5', '11', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 49700, 0, 0, 0, NULL),
(498, '2', '5', '5', '12', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 49800, 0, 0, 0, NULL),
(499, '2', '5', '6', '1', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 49900, 0, 0, 0, NULL),
(500, '2', '5', '6', '2', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 50000, 0, 0, 0, NULL),
(501, '2', '5', '6', '3', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 50100, 0, 0, 0, NULL),
(502, '2', '5', '6', '4', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 50200, 0, 0, 0, NULL),
(503, '2', '5', '6', '5', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 50300, 0, 0, 0, NULL),
(504, '2', '5', '6', '6', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 50400, 0, 0, 0, NULL),
(505, '2', '5', '6', '7', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 50500, 0, 0, 0, NULL),
(506, '2', '5', '6', '8', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 50600, 0, 0, 0, NULL),
(507, '2', '5', '6', '9', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 50700, 0, 0, 0, NULL),
(508, '2', '5', '6', '10', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 50800, 0, 0, 0, NULL),
(509, '2', '5', '6', '11', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 50900, 0, 0, 0, NULL),
(510, '2', '5', '6', '12', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 51000, 0, 0, 0, NULL),
(511, '2', '5', '7', '1', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 51100, 0, 0, 0, NULL),
(512, '2', '5', '7', '2', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 51200, 0, 0, 0, NULL),
(513, '2', '5', '7', '3', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 51300, 0, 0, 0, NULL),
(514, '2', '5', '7', '4', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 51400, 0, 0, 0, NULL),
(515, '2', '5', '7', '5', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 51500, 0, 0, 0, NULL),
(516, '2', '5', '7', '6', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 51600, 0, 0, 0, NULL),
(517, '2', '5', '7', '7', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 51700, 0, 0, 0, NULL),
(518, '2', '5', '7', '8', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 51800, 0, 0, 0, NULL),
(519, '2', '5', '7', '9', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 51900, 0, 0, 0, NULL),
(520, '2', '5', '7', '10', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 52000, 0, 0, 0, NULL),
(521, '2', '5', '7', '11', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 52100, 0, 0, 0, NULL),
(522, '2', '5', '7', '12', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 52200, 0, 0, 0, NULL),
(523, '2', '5', '8', '1', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 52300, 0, 0, 0, NULL),
(524, '2', '5', '8', '2', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 52400, 0, 0, 0, NULL),
(525, '2', '5', '8', '3', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 52500, 0, 0, 0, NULL),
(526, '2', '5', '8', '4', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 52600, 0, 0, 0, NULL),
(527, '2', '5', '8', '5', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 52700, 0, 0, 0, NULL),
(528, '2', '5', '8', '6', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 52800, 0, 0, 0, NULL),
(529, '2', '5', '8', '7', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 52900, 0, 0, 0, NULL),
(530, '2', '5', '8', '8', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 53000, 0, 0, 0, NULL),
(531, '2', '5', '8', '9', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 53100, 0, 0, 0, NULL),
(532, '2', '5', '8', '10', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 53200, 0, 0, 0, NULL),
(533, '2', '5', '8', '11', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 53300, 0, 0, 0, NULL),
(534, '2', '5', '8', '12', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 53400, 0, 0, 0, NULL),
(535, '2', '5', '9', '1', 699.6, 244.86, 489.72, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 53500, 0, 0, 0, NULL),
(536, '2', '5', '9', '2', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 53600, 0, 0, 0, NULL),
(537, '2', '5', '9', '3', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 53700, 0, 0, 0, NULL),
(538, '2', '5', '9', '4', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 53800, 0, 0, 0, NULL),
(539, '2', '5', '9', '5', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 53900, 0, 0, 0, NULL),
(540, '2', '5', '9', '6', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 54000, 0, 0, 0, NULL),
(541, '2', '5', '9', '7', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 54100, 0, 0, 0, NULL),
(542, '2', '5', '9', '8', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 54200, 0, 0, 0, NULL),
(543, '2', '5', '9', '9', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 54300, 0, 0, 0, NULL),
(544, '2', '5', '9', '10', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 54400, 0, 0, 0, NULL),
(545, '2', '5', '9', '11', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 54500, 0, 0, 0, NULL),
(546, '2', '5', '9', '12', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 54600, 0, 0, 0, NULL),
(547, '2', '5', '10', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 54700, 0, 0, 0, NULL),
(548, '2', '5', '10', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 54800, 0, 0, 0, NULL),
(549, '2', '5', '10', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 54900, 0, 0, 0, NULL),
(550, '2', '5', '10', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 55000, 0, 0, 0, NULL),
(551, '2', '5', '10', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 55100, 0, 0, 0, NULL),
(552, '2', '5', '10', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 55200, 0, 0, 0, NULL),
(553, '2', '5', '10', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 55300, 0, 0, 0, NULL),
(554, '2', '5', '10', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 55400, 0, 0, 0, NULL),
(555, '2', '5', '10', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 55500, 0, 0, 0, NULL),
(556, '2', '5', '10', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 55600, 0, 0, 0, NULL),
(557, '2', '5', '10', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 55700, 0, 0, 0, NULL),
(558, '2', '5', '10', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 55800, 0, 0, 0, NULL),
(559, '2', '5', '11', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 55900, 0, 0, 0, NULL),
(560, '2', '5', '11', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 56000, 0, 0, 0, NULL),
(561, '2', '5', '11', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 56100, 0, 0, 0, NULL),
(562, '2', '5', '11', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 56200, 0, 0, 0, NULL),
(563, '2', '5', '11', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 56300, 0, 0, 0, NULL),
(564, '2', '5', '11', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 56400, 0, 0, 0, NULL),
(565, '2', '5', '11', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 56500, 0, 0, 0, NULL),
(566, '2', '5', '11', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 56600, 0, 0, 0, NULL),
(567, '2', '5', '11', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 56700, 0, 0, 0, NULL),
(568, '2', '5', '11', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 56800, 0, 0, 0, NULL),
(569, '2', '5', '11', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 56900, 0, 0, 0, NULL),
(570, '2', '5', '11', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 57000, 0, 0, 0, NULL),
(571, '2', '5', '12', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 57100, 0, 0, 0, NULL),
(572, '2', '5', '12', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 57200, 0, 0, 0, NULL),
(573, '2', '5', '12', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 57300, 0, 0, 0, NULL),
(574, '2', '5', '12', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 57400, 0, 0, 0, NULL),
(575, '2', '5', '12', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 57500, 0, 0, 0, NULL),
(576, '2', '5', '12', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 57600, 0, 0, 0, NULL),
(577, '2', '5', '12', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 57700, 0, 0, 0, NULL),
(578, '2', '5', '12', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 57800, 0, 0, 0, NULL),
(579, '2', '5', '12', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 57900, 0, 0, 0, NULL),
(580, '2', '5', '12', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 58000, 0, 0, 0, NULL),
(581, '2', '5', '12', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 58100, 0, 0, 0, NULL),
(582, '2', '5', '12', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 58200, 0, 0, 0, NULL),
(583, '2', '5', '13', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 58300, 0, 0, 0, NULL),
(584, '2', '5', '13', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 58400, 0, 0, 0, NULL),
(585, '2', '5', '13', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 58500, 0, 0, 0, NULL),
(586, '2', '5', '13', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 58600, 0, 0, 0, NULL),
(587, '2', '5', '13', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 58700, 0, 0, 0, NULL),
(588, '2', '5', '13', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 58800, 0, 0, 0, NULL),
(589, '2', '5', '13', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 58900, 0, 0, 0, NULL),
(590, '2', '5', '13', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 59000, 0, 0, 0, NULL),
(591, '2', '5', '13', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 59100, 0, 0, 0, NULL),
(592, '2', '5', '13', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 59200, 0, 0, 0, NULL),
(593, '2', '5', '13', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 59300, 0, 0, 0, NULL),
(594, '2', '5', '13', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 59400, 0, 0, 0, NULL),
(595, '2', '5', '14', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 59500, 0, 0, 0, NULL),
(596, '2', '5', '14', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 59600, 0, 0, 0, NULL),
(597, '2', '5', '14', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 59700, 0, 0, 0, NULL),
(598, '2', '5', '14', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 59800, 0, 0, 0, NULL),
(599, '2', '5', '14', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 59900, 0, 0, 0, NULL),
(600, '2', '5', '14', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 60000, 0, 0, 0, NULL),
(601, '2', '5', '14', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 60100, 0, 0, 0, NULL),
(602, '2', '5', '14', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 53100, 60200, 0, 0, NULL),
(603, '2', '5', '14', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 60300, 0, 0, 0, NULL),
(604, '2', '5', '14', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 53100, 53100, 0, 0, NULL),
(605, '2', '5', '14', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 60500, 0, 0, 0, NULL),
(606, '2', '5', '14', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 60600, 0, 0, 0, NULL),
(607, '2', '5', '15', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 60700, 0, 0, 0, NULL),
(608, '2', '5', '15', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 60800, 0, 0, 0, NULL),
(609, '2', '5', '15', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 60900, 0, 0, 0, NULL),
(610, '2', '5', '15', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 61000, 0, 0, 0, NULL),
(611, '2', '5', '15', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 61100, 0, 0, 0, NULL),
(612, '2', '5', '15', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 61200, 0, 0, 0, NULL),
(613, '2', '5', '15', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 61300, 0, 0, 0, NULL),
(614, '2', '5', '15', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 61400, 0, 0, 0, NULL),
(615, '2', '5', '15', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 61500, 0, 0, 0, NULL),
(616, '2', '5', '15', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 61600, 0, 0, 0, NULL),
(617, '2', '5', '15', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 61700, 0, 0, 0, NULL),
(618, '2', '5', '15', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 61800, 0, 0, 0, NULL),
(619, '2', '5', '16', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 61900, 0, 0, 0, NULL),
(620, '2', '5', '16', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 62000, 0, 0, 0, NULL),
(621, '2', '5', '16', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 62100, 0, 0, 0, NULL),
(622, '2', '5', '16', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 62200, 0, 0, 0, NULL),
(623, '2', '5', '16', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 62300, 0, 0, 0, NULL),
(624, '2', '5', '16', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 53100, 53100, 0, 0, NULL),
(625, '2', '5', '16', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 62500, 0, 0, 0, NULL),
(626, '2', '5', '16', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 62600, 0, 0, 0, NULL),
(627, '2', '5', '16', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 62700, 0, 0, 0, NULL),
(628, '2', '5', '16', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 62800, 0, 0, 0, NULL),
(629, '2', '5', '16', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 62900, 0, 0, 0, NULL),
(630, '2', '5', '16', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 63000, 0, 0, 0, NULL),
(631, '2', '6', '2', '1', 10, 0, 0, 'AREA DE RESERVA', 2, '0000-00-00', 'N/A', 63100, 0, 0, 0, NULL),
(632, '2', '6', '3', '1', 10, 0, 0, 'AREA DE RESERVA', 1, '0000-00-00', 'N/A', 63200, 0, 0, 0, NULL),
(633, '2', '6', '4', '1', 785.65, 274.98, 549.96, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 63300, 0, 0, 0, NULL),
(634, '2', '6', '4', '2', 866.45, 303.26, 606.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 63400, 0, 0, 0, NULL),
(635, '2', '6', '4', '3', 866.45, 303.26, 606.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 63500, 0, 0, 0, NULL),
(636, '2', '6', '4', '4', 978.95, 342.63, 685.27, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 63600, 0, 0, 0, NULL),
(637, '2', '6', '4', '5', 978.95, 342.63, 685.27, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 63700, 0, 0, 0, NULL),
(638, '2', '6', '4', '6', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 63800, 0, 0, 0, NULL),
(639, '2', '6', '4', '7', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 63900, 0, 0, 0, NULL),
(640, '2', '6', '4', '8', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 64000, 0, 0, 0, NULL),
(641, '2', '6', '4', '9', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 64100, 0, 0, 0, NULL),
(642, '2', '6', '4', '10', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 64200, 0, 0, 0, NULL),
(643, '2', '6', '4', '11', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 64300, 0, 0, 0, NULL),
(644, '2', '6', '4', '12', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 64400, 0, 0, 0, NULL),
(645, '2', '6', '4', '13', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 64500, 0, 0, 0, NULL),
(646, '2', '6', '4', '14', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 64600, 0, 0, 0, NULL),
(647, '2', '6', '4', '15', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 64700, 0, 0, 0, NULL),
(648, '2', '6', '4', '16', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 64800, 0, 0, 0, NULL),
(649, '2', '6', '4', '17', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 64900, 0, 0, 0, NULL),
(650, '2', '6', '4', '18', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 65000, 0, 0, 0, NULL),
(651, '2', '6', '4', '19', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 65100, 0, 0, 0, NULL),
(652, '2', '6', '4', '20', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 65200, 0, 0, 0, NULL),
(653, '2', '6', '4', '21', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 65300, 0, 0, 0, NULL),
(654, '2', '6', '4', '22', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 65400, 0, 0, 0, NULL),
(655, '2', '6', '4', '23', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 65500, 0, 0, 0, NULL),
(656, '2', '6', '4', '24', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 65600, 0, 0, 0, NULL),
(657, '2', '6', '4', '25', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 65700, 0, 0, 0, NULL),
(658, '2', '6', '4', '26', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 65800, 0, 0, 0, NULL),
(659, '2', '6', '4', '27', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 65900, 0, 0, 0, NULL),
(660, '2', '6', '4', '28', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 66000, 0, 0, 0, NULL),
(661, '2', '6', '4', '29', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 66100, 0, 0, 0, NULL),
(662, '2', '6', '4', '30', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 66200, 0, 0, 0, NULL),
(663, '2', '6', '4', '31', 839.5, 293.83, 587.65, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 66300, 0, 0, 0, NULL),
(664, '2', '6', '4', '32', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 66400, 0, 0, 0, NULL),
(665, '2', '6', '4', '33', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 66500, 0, 0, 0, NULL),
(666, '2', '6', '4', '34', 839.5, 293.83, 587.65, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 66600, 0, 0, 0, NULL),
(667, '2', '6', '4', '35', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 66700, 0, 0, 0, NULL),
(668, '2', '6', '4', '36', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 66800, 0, 0, 0, NULL),
(669, '2', '6', '4', '37', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 66900, 0, 0, 0, NULL),
(670, '2', '6', '4', '38', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 67000, 0, 0, 0, NULL),
(671, '2', '6', '4', '39', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 67100, 0, 0, 0, NULL),
(672, '2', '6', '4', '40', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 67200, 0, 0, 0, NULL),
(673, '2', '6', '4', '41', 785.65, 274.98, 549.96, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 67300, 0, 0, 0, NULL),
(674, '2', '6', '4', '42', 785.65, 274.98, 549.96, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 67400, 0, 0, 0, NULL),
(675, '2', '6', '4', '43', 785.65, 274.98, 549.96, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 67500, 0, 0, 0, NULL),
(676, '2', '6', '4', '44', 785.65, 274.98, 549.96, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 67600, 0, 0, 0, NULL),
(677, '2', '6', '5', '1', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 67700, 0, 0, 0, NULL),
(678, '2', '6', '5', '2', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 67800, 0, 0, 0, NULL),
(679, '2', '6', '5', '3', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 67900, 0, 0, 0, NULL),
(680, '2', '6', '5', '4', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 68000, 0, 0, 0, NULL),
(681, '2', '6', '5', '5', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 68100, 0, 0, 0, NULL),
(682, '2', '6', '5', '6', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 68200, 0, 0, 0, NULL),
(683, '2', '6', '5', '7', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 68300, 0, 0, 0, NULL),
(684, '2', '6', '5', '8', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 68400, 0, 0, 0, NULL),
(685, '2', '6', '5', '9', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 68500, 0, 0, 0, NULL),
(686, '2', '6', '5', '10', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 68600, 0, 0, 0, NULL),
(687, '2', '6', '5', '11', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 68700, 0, 0, 0, NULL),
(688, '2', '6', '5', '12', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 68800, 0, 0, 0, NULL),
(689, '2', '6', '5', '13', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 68900, 0, 0, 0, NULL),
(690, '2', '6', '5', '14', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 69000, 0, 0, 0, NULL),
(691, '2', '6', '5', '15', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 69100, 0, 0, 0, NULL),
(692, '2', '6', '5', '16', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 69200, 0, 0, 0, NULL),
(693, '2', '6', '5', '17', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 69300, 0, 0, 0, NULL),
(694, '2', '6', '5', '18', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 69400, 0, 0, 0, NULL),
(695, '2', '6', '5', '19', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 69500, 0, 0, 0, NULL),
(696, '2', '6', '5', '20', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 69600, 0, 0, 0, NULL),
(697, '2', '6', '5', '21', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 69700, 0, 0, 0, NULL),
(698, '2', '6', '5', '22', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 69800, 0, 0, 0, NULL),
(699, '2', '6', '5', '23', 839.5, 293.83, 587.65, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 69900, 0, 0, 0, NULL),
(700, '2', '6', '5', '24', 839.5, 293.83, 587.65, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 70000, 0, 0, 0, NULL),
(701, '2', '6', '5', '25', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 70100, 0, 0, 0, NULL),
(702, '2', '6', '5', '26', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 70200, 0, 0, 0, NULL),
(703, '2', '6', '5', '27', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 70300, 0, 0, 0, NULL),
(704, '2', '6', '5', '28', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 70400, 0, 0, 0, NULL),
(705, '2', '6', '5', '29', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 70500, 0, 0, 0, NULL),
(706, '2', '6', '5', '30', 760.42, 266.15, 532.29, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 70600, 0, 0, 0, NULL),
(707, '2', '6', '5', '31', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 70700, 0, 0, 0, NULL),
(708, '2', '6', '5', '32', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 70800, 0, 0, 0, NULL),
(709, '2', '6', '5', '33', 760.42, 266.15, 532.29, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 70900, 0, 0, 0, NULL),
(710, '2', '6', '5', '34', 760.42, 266.15, 532.29, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 71000, 0, 0, 0, NULL),
(711, '3', '1', '28', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 71100, 0, 0, 0, NULL),
(712, '3', '1', '28', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 71200, 0, 0, 0, NULL),
(713, '3', '1', '28', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 71300, 0, 0, 0, NULL),
(714, '3', '1', '28', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 71400, 0, 0, 0, NULL),
(715, '3', '1', '28', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 71500, 0, 0, 0, NULL),
(716, '3', '1', '28', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 71600, 0, 0, 0, NULL),
(717, '3', '1', '28', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 71700, 0, 0, 0, NULL),
(718, '3', '1', '28', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 71800, 0, 0, 0, NULL),
(719, '3', '1', '28', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 71900, 0, 0, 0, NULL),
(720, '3', '1', '28', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 72000, 0, 0, 0, NULL),
(721, '3', '1', '28', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 72100, 0, 0, 0, NULL),
(722, '3', '1', '28', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 72200, 0, 0, 0, NULL),
(723, '3', '1', '29', '1', 874.08, 305.93, 611.86, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 72300, 0, 0, 0, NULL),
(724, '3', '1', '29', '2', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 72400, 0, 0, 0, NULL),
(725, '3', '1', '29', '3', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 72500, 0, 0, 0, NULL),
(726, '3', '1', '29', '4', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 72600, 0, 0, 0, NULL),
(727, '3', '1', '29', '5', 600.81, 210.28, 420.57, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 72700, 0, 0, 0, NULL),
(728, '3', '1', '29', '6', 723.05, 253.07, 506.14, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 72800, 0, 0, 0, NULL),
(729, '3', '1', '29', '7', 758.54, 265.49, 530.98, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 72900, 0, 0, 0, NULL),
(730, '3', '1', '29', '8', 608.31, 212.91, 425.82, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 73000, 0, 0, 0, NULL),
(731, '3', '1', '29', '9', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 73100, 0, 0, 0, NULL),
(732, '3', '1', '29', '10', 659.14, 230.7, 461.4, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 73200, 0, 0, 0, NULL),
(733, '3', '1', '29', '11', 659.14, 230.7, 461.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 73300, 0, 0, 0, NULL),
(734, '3', '1', '29', '12', 874.08, 305.93, 611.86, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 73400, 0, 0, 0, NULL),
(735, '3', '1', '30', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 73500, 0, 0, 0, NULL),
(736, '3', '1', '30', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 73600, 0, 0, 0, NULL),
(737, '3', '1', '30', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 73700, 0, 0, 0, NULL),
(738, '3', '1', '30', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 73800, 0, 0, 0, NULL),
(739, '3', '1', '30', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 73900, 0, 0, 0, NULL),
(740, '3', '1', '30', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 74000, 0, 0, 0, NULL),
(741, '3', '1', '30', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 74100, 0, 0, 0, NULL),
(742, '3', '1', '30', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 74200, 0, 0, 0, NULL),
(743, '3', '1', '30', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 74300, 0, 0, 0, NULL),
(744, '3', '1', '30', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 74400, 0, 0, 0, NULL),
(745, '3', '1', '30', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 74500, 0, 0, 0, NULL),
(746, '3', '1', '30', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 74600, 0, 0, 0, NULL),
(747, '3', '1', '31', '1', 954.28, 334, 668, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 74700, 0, 0, 0, NULL),
(748, '3', '1', '31', '2', 765.45, 267.91, 535.82, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 74800, 0, 0, 0, NULL),
(749, '3', '1', '31', '3', 771.64, 270.07, 540.15, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 74900, 0, 0, 0, NULL),
(750, '3', '1', '31', '4', 774.28, 271, 542, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 75000, 0, 0, 0, NULL),
(751, '3', '1', '31', '5', 773.36, 270.68, 541.35, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 75100, 0, 0, 0, NULL),
(752, '3', '1', '31', '6', 768.88, 269.11, 538.22, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 75200, 0, 0, 0, NULL),
(753, '3', '1', '31', '7', 765.45, 267.91, 535.82, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 75300, 0, 0, 0, NULL),
(754, '3', '1', '31', '8', 765.45, 267.91, 535.82, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 75400, 0, 0, 0, NULL),
(755, '3', '1', '31', '9', 765.45, 267.91, 535.82, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 75500, 0, 0, 0, NULL),
(756, '3', '1', '31', '10', 765.45, 267.91, 535.82, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 75600, 0, 0, 0, NULL),
(757, '3', '1', '31', '11', 765.45, 267.91, 535.82, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 75700, 0, 0, 0, NULL),
(758, '3', '1', '31', '12', 1, 352.51, 705.02, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 75800, 0, 0, 0, NULL),
(759, '3', '13', '1', '1', 759.38, 265.78, 531.57, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 75900, 0, 0, 0, NULL),
(760, '3', '13', '1', '2', 760.73, 266.26, 532.51, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 76000, 0, 0, 0, NULL),
(761, '3', '13', '1', '3', 762.08, 266.73, 533.46, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 76100, 0, 0, 0, NULL),
(762, '3', '13', '1', '4', 763.44, 267.2, 534.41, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 76200, 0, 0, 0, NULL),
(763, '3', '13', '1', '5', 764.79, 267.68, 535.35, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 76300, 0, 0, 0, NULL),
(764, '3', '13', '1', '6', 766.14, 268.15, 536.3, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 76400, 0, 0, 0, NULL),
(765, '3', '13', '1', '7', 766.16, 268.16, 536.31, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 76500, 0, 0, 0, NULL),
(766, '3', '13', '1', '8', 764.81, 267.68, 535.37, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 76600, 0, 0, 0, NULL),
(767, '3', '13', '1', '9', 763.45, 267.21, 534.42, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 76700, 0, 0, 0, NULL),
(768, '3', '13', '1', '10', 762.09, 266.73, 533.46, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 76800, 0, 0, 0, NULL),
(769, '3', '13', '1', '11', 760.73, 266.26, 532.51, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 76900, 0, 0, 0, NULL),
(770, '3', '13', '1', '12', 759.38, 265.78, 531.57, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 77000, 0, 0, 0, NULL),
(771, '3', '13', '2', '1', 768.44, 268.95, 537.91, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 77100, 0, 0, 0, NULL),
(772, '3', '13', '2', '2', 769.8, 269.43, 538.86, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 77200, 0, 0, 0, NULL),
(773, '3', '13', '2', '3', 771.15, 269.9, 539.81, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 77300, 0, 0, 0, NULL),
(774, '3', '13', '2', '4', 772.51, 270.38, 540.76, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 77400, 0, 0, 0, NULL),
(775, '3', '13', '2', '5', 773.87, 270.85, 541.71, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 77500, 0, 0, 0, NULL),
(776, '3', '13', '2', '6', 769.53, 269.34, 538.67, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 77600, 0, 0, 0, NULL),
(777, '3', '13', '2', '7', 769.57, 269.35, 538.7, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 77700, 0, 0, 0, NULL),
(778, '3', '13', '2', '8', 773.9, 270.87, 541.73, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 77800, 0, 0, 0, NULL),
(779, '3', '13', '2', '9', 772.54, 270.39, 540.78, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 77900, 0, 0, 0, NULL),
(780, '3', '13', '2', '10', 771.18, 269.91, 539.83, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 78000, 0, 0, 0, NULL),
(781, '3', '13', '2', '11', 769.82, 269.44, 538.87, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 78100, 0, 0, 0, NULL),
(782, '3', '13', '2', '12', 768.46, 268.96, 537.92, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 78200, 0, 0, 0, NULL),
(783, '3', '13', '3', '1', 782.42, 273.85, 547.69, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 78300, 0, 0, 0, NULL),
(784, '3', '13', '3', '2', 781.06, 273.37, 546.74, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 78400, 0, 0, 0, NULL),
(785, '3', '13', '3', '3', 779.71, 272.9, 545.8, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 78500, 0, 0, 0, NULL),
(786, '3', '13', '3', '4', 778.35, 272.42, 544.85, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 78600, 0, 0, 0, NULL),
(787, '3', '13', '3', '5', 777, 271.95, 543.9, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 78700, 0, 0, 0, NULL),
(788, '3', '13', '3', '6', 775.64, 271.47, 542.95, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 78800, 0, 0, 0, NULL),
(789, '3', '13', '3', '7', 775.64, 271.47, 542.95, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 78900, 0, 0, 0, NULL),
(790, '3', '13', '3', '8', 777, 271.95, 543.9, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 79000, 0, 0, 0, NULL),
(791, '3', '13', '3', '9', 778.35, 272.42, 544.85, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 79100, 0, 0, 0, NULL),
(792, '3', '13', '3', '10', 779.71, 272.9, 545.8, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 79200, 0, 0, 0, NULL),
(793, '3', '13', '3', '11', 781.06, 273.37, 546.74, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 79300, 0, 0, 0, NULL),
(794, '3', '13', '3', '12', 782.42, 273.85, 547.69, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 79400, 0, 0, 0, NULL),
(795, '3', '13', '4', '1', 865.04, 302.76, 605.53, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 79500, 0, 0, 0, NULL),
(796, '3', '13', '4', '2', 911.59, 319.06, 638.11, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 79600, 0, 0, 0, NULL),
(797, '3', '13', '4', '3', 958.89, 335.61, 671.22, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 79700, 0, 0, 0, NULL),
(798, '3', '13', '4', '4', 999.1, 349.69, 699.37, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 79800, 0, 0, 0, NULL),
(799, '3', '13', '4', '5', 1, 360.98, 721.96, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 79900, 0, 0, 0, NULL),
(800, '3', '13', '4', '6', 1, 369.47, 738.94, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 80000, 0, 0, 0, NULL),
(801, '3', '13', '4', '7', 1, 375.15, 750.3, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 80100, 0, 0, 0, NULL),
(802, '3', '13', '4', '8', 1, 378.01, 756.01, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 80200, 0, 0, 0, NULL),
(803, '3', '13', '4', '9', 1, 378.04, 756.08, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 80300, 0, 0, 0, NULL),
(804, '3', '13', '4', '10', 1, 375.25, 750.5, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 80400, 0, 0, 0, NULL),
(805, '3', '13', '4', '11', 1, 369.64, 739.28, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 80500, 0, 0, 0, NULL),
(806, '3', '13', '4', '12', 1, 361.21, 722.43, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 80600, 0, 0, 0, NULL),
(807, '3', '13', '5', '1', 790.55, 276.69, 553.39, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 80700, 0, 0, 0, NULL),
(808, '3', '13', '5', '2', 789.19, 276.22, 552.43, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 80800, 0, 0, 0, NULL),
(809, '3', '13', '5', '3', 787.84, 275.74, 551.49, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 80900, 0, 0, 0, NULL),
(810, '3', '13', '5', '4', 786.48, 275.27, 550.54, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 81000, 0, 0, 0, NULL),
(811, '3', '13', '5', '5', 785.13, 274.8, 549.59, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 81100, 0, 0, 0, NULL),
(812, '3', '13', '5', '6', 783.77, 274.32, 548.64, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 81200, 0, 0, 0, NULL),
(813, '3', '13', '5', '7', 783.77, 274.32, 548.64, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 81300, 0, 0, 0, NULL),
(814, '3', '13', '5', '8', 785.13, 274.8, 549.59, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 81400, 0, 0, 0, NULL),
(815, '3', '13', '5', '9', 786.48, 275.27, 550.54, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 81500, 0, 0, 0, NULL),
(816, '3', '13', '5', '10', 787.84, 275.74, 551.49, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 81600, 0, 0, 0, NULL),
(817, '3', '13', '5', '11', 789.19, 276.22, 552.43, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 81700, 0, 0, 0, NULL),
(818, '3', '13', '5', '12', 790.55, 276.69, 553.39, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 81800, 0, 0, 0, NULL),
(819, '3', '14', '1', '1', 845.4, 295.89, 591.78, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 81900, 0, 0, 0, NULL),
(820, '3', '14', '1', '2', 815.32, 285.36, 570.72, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 82000, 0, 0, 0, NULL),
(821, '3', '14', '1', '3', 785.24, 274.83, 549.67, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 82100, 0, 0, 0, NULL),
(822, '3', '14', '1', '4', 755.16, 264.31, 528.61, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 82200, 0, 0, 0, NULL),
(823, '3', '14', '1', '5', 725.08, 253.78, 507.56, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 82300, 0, 0, 0, NULL),
(824, '3', '14', '1', '6', 695, 243.25, 486.5, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 82400, 0, 0, 0, NULL),
(825, '3', '14', '1', '7', 794.34, 278.02, 556.04, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 82500, 0, 0, 0, NULL),
(826, '3', '14', '1', '8', 832.64, 291.42, 582.85, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 82600, 0, 0, 0, NULL),
(827, '3', '14', '1', '9', 870.94, 304.83, 609.66, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 82700, 0, 0, 0, NULL),
(828, '3', '14', '1', '10', 909.23, 318.23, 636.46, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 82800, 0, 0, 0, NULL),
(829, '3', '14', '1', '11', 947.53, 331.64, 663.27, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 82900, 0, 0, 0, NULL),
(830, '3', '14', '1', '12', 1, 369.38, 738.77, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 83000, 0, 0, 0, NULL),
(831, '3', '14', '2', '1', 697.41, 244.09, 488.19, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 83100, 0, 0, 0, NULL),
(832, '3', '14', '2', '2', 694.54, 243.09, 486.18, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 83200, 0, 0, 0, NULL),
(833, '3', '14', '2', '3', 691.67, 242.08, 484.17, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 83300, 0, 0, 0, NULL),
(834, '3', '14', '2', '4', 688.8, 241.08, 482.16, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 83400, 0, 0, 0, NULL),
(835, '3', '14', '2', '5', 685.93, 240.08, 480.15, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 83500, 0, 0, 0, NULL),
(836, '3', '14', '2', '6', 683.06, 239.07, 478.14, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 83600, 0, 0, 0, NULL),
(837, '3', '14', '2', '7', 830.54, 290.69, 581.38, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 83700, 0, 0, 0, NULL),
(838, '3', '14', '2', '8', 824.96, 288.74, 577.47, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 83800, 0, 0, 0, NULL),
(839, '3', '14', '2', '9', 819.38, 286.78, 573.57, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 83900, 0, 0, 0, NULL),
(840, '3', '14', '2', '10', 813.8, 284.83, 569.66, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 84000, 0, 0, 0, NULL),
(841, '3', '14', '2', '11', 808.21, 282.87, 565.75, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 84100, 0, 0, 0, NULL),
(842, '3', '14', '2', '12', 802.63, 280.92, 561.84, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 84200, 0, 0, 0, NULL),
(843, '3', '14', '3', '1', 799.9, 279.97, 559.93, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 84300, 0, 0, 0, NULL),
(844, '3', '14', '3', '2', 798.55, 279.49, 558.99, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 84400, 0, 0, 0, NULL),
(845, '3', '14', '3', '3', 797.19, 279.02, 558.03, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 84500, 0, 0, 0, NULL),
(846, '3', '14', '3', '4', 795.84, 278.54, 557.09, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 84600, 0, 0, 0, NULL),
(847, '3', '14', '3', '5', 794.48, 278.07, 556.14, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 84700, 0, 0, 0, NULL),
(848, '3', '14', '3', '6', 793.13, 277.6, 555.19, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 84800, 0, 0, 0, NULL);
INSERT INTO `lotes` (`id_lote`, `fase`, `super_manzana`, `mza`, `lote`, `m2`, `cos`, `cus`, `uso`, `id_tipo_lote`, `fecha_entrega`, `disponibilidad`, `precio_lista`, `precio_historico`, `estatus`, `uum`, `fecha_modificacion`) VALUES
(849, '3', '14', '3', '7', 793.13, 277.6, 555.19, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 84900, 0, 0, 0, NULL),
(850, '3', '14', '3', '8', 794.48, 278.07, 556.14, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 85000, 0, 0, 0, NULL),
(851, '3', '14', '3', '9', 795.84, 278.54, 557.09, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 85100, 0, 0, 0, NULL),
(852, '3', '14', '3', '10', 797.19, 279.02, 558.03, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 85200, 0, 0, 0, NULL),
(853, '3', '14', '3', '11', 798.55, 279.49, 558.99, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 85300, 0, 0, 0, NULL),
(854, '3', '14', '3', '12', 799.9, 279.97, 559.93, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 85400, 0, 0, 0, NULL),
(855, '3', '14', '4', '1', 895.32, 313.36, 626.72, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 85500, 0, 0, 0, NULL),
(856, '3', '14', '4', '2', 851.2, 297.92, 595.84, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 85600, 0, 0, 0, NULL),
(857, '3', '14', '4', '3', 813.55, 284.74, 569.49, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 85700, 0, 0, 0, NULL),
(858, '3', '14', '4', '4', 782.54, 273.89, 547.78, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 85800, 0, 0, 0, NULL),
(859, '3', '14', '4', '5', 758.22, 265.38, 530.75, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 85900, 0, 0, 0, NULL),
(860, '3', '14', '4', '6', 740.63, 259.22, 518.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 86000, 0, 0, 0, NULL),
(861, '3', '14', '4', '7', 729.79, 255.43, 510.85, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 86100, 0, 0, 0, NULL),
(862, '3', '14', '4', '8', 725.72, 254, 508, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 86200, 0, 0, 0, NULL),
(863, '3', '14', '4', '9', 728.42, 254.95, 509.89, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 86300, 0, 0, 0, NULL),
(864, '3', '14', '4', '10', 737.88, 258.26, 516.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 86400, 0, 0, 0, NULL),
(865, '3', '14', '4', '11', 754.1, 263.94, 527.87, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 86500, 0, 0, 0, NULL),
(866, '3', '14', '4', '12', 777.05, 271.97, 543.94, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 86600, 0, 0, 0, NULL),
(867, '3', '14', '5', '1', 773.51, 270.73, 541.46, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 86700, 0, 0, 0, NULL),
(868, '3', '14', '5', '2', 772.26, 270.29, 540.58, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 86800, 0, 0, 0, NULL),
(869, '3', '14', '5', '3', 771.01, 269.85, 539.71, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 86900, 0, 0, 0, NULL),
(870, '3', '14', '5', '4', 769.76, 269.42, 538.83, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 87000, 0, 0, 0, NULL),
(871, '3', '14', '5', '5', 768.51, 268.98, 537.96, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 87100, 0, 0, 0, NULL),
(872, '3', '14', '5', '6', 767.26, 268.54, 537.08, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 87200, 0, 0, 0, NULL),
(873, '3', '14', '5', '7', 772.53, 270.39, 540.77, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 87300, 0, 0, 0, NULL),
(874, '3', '14', '5', '8', 773.78, 270.82, 541.65, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 87400, 0, 0, 0, NULL),
(875, '3', '14', '5', '9', 775.03, 271.26, 542.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 87500, 0, 0, 0, NULL),
(876, '3', '14', '5', '10', 776.28, 271.7, 543.4, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 87600, 0, 0, 0, NULL),
(877, '3', '14', '5', '11', 777.53, 272.14, 544.27, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 87700, 0, 0, 0, NULL),
(878, '3', '14', '5', '12', 778.78, 272.57, 545.15, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 87800, 0, 0, 0, NULL),
(879, '3', '15', '1', '1', 895.57, 313.45, 626.9, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 87900, 0, 0, 0, NULL),
(880, '3', '15', '1', '2', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 88000, 0, 0, 0, NULL),
(881, '3', '15', '1', '3', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 88100, 0, 0, 0, NULL),
(882, '3', '15', '1', '4', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 88200, 0, 0, 0, NULL),
(883, '3', '15', '1', '5', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 88300, 0, 0, 0, NULL),
(884, '3', '15', '1', '6', 680.63, 238.22, 476.44, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 88400, 0, 0, 0, NULL),
(885, '3', '15', '1', '7', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 88500, 0, 0, 0, NULL),
(886, '3', '15', '1', '8', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 88600, 0, 0, 0, NULL),
(887, '3', '15', '1', '9', 680.63, 238.22, 476.44, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 88700, 0, 0, 0, NULL),
(888, '3', '15', '1', '10', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 88800, 0, 0, 0, NULL),
(889, '3', '15', '1', '11', 680.63, 238.22, 476.44, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 88900, 0, 0, 0, NULL),
(890, '3', '15', '1', '12', 895.57, 313.45, 626.9, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 89000, 0, 0, 0, NULL),
(891, '3', '15', '2', '1', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 89100, 0, 0, 0, NULL),
(892, '3', '15', '2', '2', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 89200, 0, 0, 0, NULL),
(893, '3', '15', '2', '3', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 89300, 0, 0, 0, NULL),
(894, '3', '15', '2', '4', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 89400, 0, 0, 0, NULL),
(895, '3', '15', '2', '5', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 89500, 0, 0, 0, NULL),
(896, '3', '15', '2', '6', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 89600, 0, 0, 0, NULL),
(897, '3', '15', '2', '7', 697.94, 244.28, 488.56, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 89700, 0, 0, 0, NULL),
(898, '3', '15', '2', '8', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 89800, 0, 0, 0, NULL),
(899, '3', '15', '2', '9', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 89900, 0, 0, 0, NULL),
(900, '3', '15', '2', '10', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 90000, 0, 0, 0, NULL),
(901, '3', '15', '2', '11', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 90100, 0, 0, 0, NULL),
(902, '3', '15', '2', '12', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 90200, 0, 0, 0, NULL),
(903, '3', '15', '3', '1', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 90300, 0, 0, 0, NULL),
(904, '3', '15', '3', '2', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 90400, 0, 0, 0, NULL),
(905, '3', '15', '3', '3', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 90500, 0, 0, 0, NULL),
(906, '3', '15', '3', '4', 716.46, 250.76, 501.52, 'HABITACIONAL', 2, '0000-00-00', 'BLOQUEADO', 90600, 0, 0, 0, NULL),
(907, '3', '15', '3', '5', 716.46, 250.76, 501.52, 'HABITACIONAL', 1, '0000-00-00', 'BLOQUEADO', 90700, 0, 0, 0, NULL),
(908, '3', '15', '3', '6', 716.46, 250.76, 501.52, 'HABITACIONAL', 3, '0000-00-00', 'BLOQUEADO', 90800, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `fecha_pago` date NOT NULL,
  `id_cuenta_bancaria` int(11) NOT NULL,
  `no_mensualidad` int(11) NOT NULL COMMENT 'Contador de las mensualidades del contrato',
  `cant_inicial` float NOT NULL,
  `monto_pagado` float NOT NULL,
  `divisa` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre de la moneda con la que se pagó',
  `tipo_cambio` int(11) NOT NULL COMMENT 'Valor de la moneda en la que se pagó',
  `abonado_capital` float NOT NULL COMMENT 'Cantidad que el cliente abona a capital con la mensualidad que está pagando',
  `abonado_interes` float NOT NULL COMMENT 'Cantidad que el cliente abona a interés con la mensualidad que paga',
  `diferencia` float NOT NULL,
  `id_estatus_pago` int(11) NOT NULL,
  `comentario` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_concepto` int(11) NOT NULL,
  `mensualidad_historica` float NOT NULL COMMENT 'Mensualidad que el cliente debió pagar en ese registro.',
  `fecha_mensualidad` date DEFAULT NULL COMMENT 'Fecha de la mensualidad a la que corresponde el pago',
  `fecha_captura` date NOT NULL COMMENT 'Es la fecha en la que se capturó el pago.',
  `balance_final` float NOT NULL COMMENT 'Cantidad que el cliente debe despues de realizar el pago',
  `estatus_contrato` varchar(100) NOT NULL COMMENT 'Es el estatus que tenía el contrato antes de realizar el pago.',
  `habilitado` int(1) NOT NULL COMMENT 'Indica si el pago está activo o si fue eliminado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pagos`
--

INSERT INTO `pagos` (`id_pago`, `id_contrato`, `fecha_pago`, `id_cuenta_bancaria`, `no_mensualidad`, `cant_inicial`, `monto_pagado`, `divisa`, `tipo_cambio`, `abonado_capital`, `abonado_interes`, `diferencia`, `id_estatus_pago`, `comentario`, `id_concepto`, `mensualidad_historica`, `fecha_mensualidad`, `fecha_captura`, `balance_final`, `estatus_contrato`, `habilitado`) VALUES
(1, 41, '0000-00-00', 1, 0, 0, 100, '', 0, 0, 0, 0, 1, '', 1, 0, NULL, '0000-00-00', 0, '', 0),
(100, 41, '0000-00-00', 1, 0, 0, 100, '', 0, 0, 0, 0, 1, '', 1, 0, NULL, '0000-00-00', 0, '', 0),
(101, 41, '2022-06-10', 2, 1, 900, 900, 'MEX', 1, 900, 0, 0, 1, '', 2, 900, '2022-07-10', '0000-00-00', -900, '2', 0),
(102, 41, '2022-06-10', 1, 1, 100, 100, 'EUR', 1, 88.3333, 11.6667, 400, 2, '', 1, 500, '2022-06-15', '0000-00-00', 6911.67, '2', 0),
(103, 41, '2022-06-09', 1, 1, 400, 400, 'EUR', 1, 388.333, 11.6667, 100, 2, '', 1, 500, '2022-06-15', '0000-00-00', 6611.67, '2', 1),
(104, 41, '2022-06-10', 1, 2, 100, 100, 'EUR', 1, 88.9806, 11.0195, 0, 1, '', 1, 100, '2022-07-15', '0000-00-00', 6522.69, '2', 1),
(105, 41, '2022-06-10', 1, 3, 100, 100, 'EUR', 1, 89.1289, 10.8712, 0, 1, '', 2, 100, '2022-08-15', '0000-00-00', 6433.56, '2', 1),
(106, 41, '2022-06-10', 1, 4, 100, 100, 'EUR', 1, 89.2774, 10.7226, 0, 1, '', 2, 100, '2022-09-15', '0000-00-00', 6344.28, '2', 1),
(107, 41, '2022-06-17', 1, 5, 700, 700, 'EUR', 1, 689.426, 10.5738, -600, 2, '', 2, 100, '2022-10-15', '0000-00-00', 5654.85, '2', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cat_cuentas_bancarias`
--
ALTER TABLE `cat_cuentas_bancarias`
  ADD PRIMARY KEY (`id_cuenta_bancaria`);

--
-- Indexes for table `cat_descuentos`
--
ALTER TABLE `cat_descuentos`
  ADD PRIMARY KEY (`id_descuento`);

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
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `uc` (`uc`),
  ADD KEY `uum` (`uum`);

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
  ADD KEY `id_lote` (`id_lote`),
  ADD KEY `uum` (`uum`),
  ADD KEY `uc` (`uc`);

--
-- Indexes for table `cuentas_usuario`
--
ALTER TABLE `cuentas_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indexes for table `descuentos_contrato`
--
ALTER TABLE `descuentos_contrato`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_contrato` (`id_contrato`),
  ADD KEY `id_descuento` (`id_descuento`);

--
-- Indexes for table `lotes`
--
ALTER TABLE `lotes`
  ADD PRIMARY KEY (`id_lote`),
  ADD KEY `id_tipo_lote` (`id_tipo_lote`),
  ADD KEY `uum` (`uum`);

--
-- Indexes for table `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `id_contrato` (`id_contrato`),
  ADD KEY `id_estatus_paga` (`id_estatus_pago`),
  ADD KEY `id_concepto` (`id_concepto`),
  ADD KEY `id_cuenta_bancaria` (`id_cuenta_bancaria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cat_cuentas_bancarias`
--
ALTER TABLE `cat_cuentas_bancarias`
  MODIFY `id_cuenta_bancaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cat_descuentos`
--
ALTER TABLE `cat_descuentos`
  MODIFY `id_descuento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cat_estatus_pago`
--
ALTER TABLE `cat_estatus_pago`
  MODIFY `id_estatus_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cat_estatus_venta`
--
ALTER TABLE `cat_estatus_venta`
  MODIFY `id_estatus_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `cliente_contrato`
--
ALTER TABLE `cliente_contrato`
  MODIFY `id_cliente_contrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12547;

--
-- AUTO_INCREMENT for table `concepto`
--
ALTER TABLE `concepto`
  MODIFY `id_concepto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contrato`
--
ALTER TABLE `contrato`
  MODIFY `id_contrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `cuentas_usuario`
--
ALTER TABLE `cuentas_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `descuentos_contrato`
--
ALTER TABLE `descuentos_contrato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `lotes`
--
ALTER TABLE `lotes`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=909;

--
-- AUTO_INCREMENT for table `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

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
  ADD CONSTRAINT `pagos_ibfk_2` FOREIGN KEY (`id_contrato`) REFERENCES `contrato` (`id_contrato`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pagos_ibfk_3` FOREIGN KEY (`id_estatus_pago`) REFERENCES `cat_estatus_pago` (`id_estatus_pago`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pagos_ibfk_4` FOREIGN KEY (`id_concepto`) REFERENCES `concepto` (`id_concepto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pagos_ibfk_5` FOREIGN KEY (`id_cuenta_bancaria`) REFERENCES `cat_cuentas_bancarias` (`id_cuenta_bancaria`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
