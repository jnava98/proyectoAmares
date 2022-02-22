-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-02-2022 a las 05:25:33
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cobranza_amares`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_estatus_pago`
--

CREATE TABLE `cat_estatus_pago` (
  `id_estatus_pago` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cat_estatus_pago`
--

INSERT INTO `cat_estatus_pago` (`id_estatus_pago`, `nombre`) VALUES
(1, 'Pagado'),
(2, 'Parcial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_estatus_venta`
--

CREATE TABLE `cat_estatus_venta` (
  `id_estatus_venta` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cat_estatus_venta`
--

INSERT INTO `cat_estatus_venta` (`id_estatus_venta`, `nombre`) VALUES
(1, 'Contrato firmado'),
(2, 'Enganche'),
(3, 'Reservado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_tipo_compra`
--

CREATE TABLE `cat_tipo_compra` (
  `id_tipo_compra` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cat_tipo_compra`
--

INSERT INTO `cat_tipo_compra` (`id_tipo_compra`, `nombre`) VALUES
(1, 'Financiado'),
(2, 'Contado'),
(3, 'Contado Comercial'),
(4, 'MSI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_tipo_lote`
--

CREATE TABLE `cat_tipo_lote` (
  `id_tipo_lote` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cat_tipo_lote`
--

INSERT INTO `cat_tipo_lote` (`id_tipo_lote`, `nombre`) VALUES
(1, 'Premium'),
(2, 'Estandar'),
(3, 'Plus');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido_paterno` varchar(50) NOT NULL,
  `apellido_materno` varchar(50) NOT NULL,
  `residencia` varchar(50) NOT NULL,
  `nacionalidad` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(13) NOT NULL,
  `estado_civil` varchar(50) NOT NULL,
  `act_economica` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellido_paterno`, `apellido_materno`, `residencia`, `nacionalidad`, `correo`, `telefono`, `estado_civil`, `act_economica`) VALUES
(1, 'Cesar Julian', 'Toraya ', 'Novelo', 'Mérida', 'Mexicana', 'cesartn12@gmail.com', '999 360 0284', 'Soltero', 'Desarrollador'),
(2, 'Jorge Carlos', 'Navarrete', 'Torres', 'Mérida', 'Mexicana', 'jorgecnt98@gmail.com', '999 579 9501', 'Casado', 'Desarrollador'),
(3, 'Maritzel Beatriz', 'Euan', 'Solis', 'Uman', 'Mexicana', 'maritzels@gmail.com', '9991409186', 'Soltera', 'Administrador de Proyectos'),
(4, 'Ana Carolina ', 'Martinez', 'Maza', 'Mocochá', 'Mexicana', 'karo@gmail.com', '999 397 1844', 'Soltera', 'Coordinadora ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_contrato`
--

CREATE TABLE `cliente_contrato` (
  `id_cliente_contrato` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente_contrato`
--

INSERT INTO `cliente_contrato` (`id_cliente_contrato`, `id_cliente`, `id_contrato`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE `contrato` (
  `id_contrato` int(11) NOT NULL,
  `fecha_contrato` date NOT NULL,
  `fecha_firma` date NOT NULL,
  `precio_venta` varchar(50) NOT NULL,
  `id_tipo_compra` int(11) NOT NULL,
  `cant_apartado` varchar(50) NOT NULL,
  `fecha_apartado` date NOT NULL,
  `cant_enganche` varchar(50) NOT NULL,
  `fecha_enganche` date NOT NULL,
  `mensualidades` varchar(50) NOT NULL,
  `monto_mensual` varchar(50) NOT NULL,
  `pago_final` varchar(50) NOT NULL,
  `id_estatus_venta` int(11) NOT NULL,
  `dia_pago` varchar(50) NOT NULL,
  `nombre_descuento` varchar(100) NOT NULL,
  `tasa` varchar(10) NOT NULL,
  `nombre_broker` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contrato`
--

INSERT INTO `contrato` (`id_contrato`, `fecha_contrato`, `fecha_firma`, `precio_venta`, `id_tipo_compra`, `cant_apartado`, `fecha_apartado`, `cant_enganche`, `fecha_enganche`, `mensualidades`, `monto_mensual`, `pago_final`, `id_estatus_venta`, `dia_pago`, `nombre_descuento`, `tasa`, `nombre_broker`) VALUES
(2, '2022-11-09', '2022-12-09', '100000', 2, '10000', '2022-11-25', '15000', '2022-11-30', '10', '12000', '17000', 3, '27', 'No aplica', '5', 'Jorge Perez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_usuario`
--

CREATE TABLE `cuentas_usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuentas_usuario`
--

INSERT INTO `cuentas_usuario` (`id_usuario`, `usuario`, `password`, `nombre`) VALUES
(1, 'admin', 'admin', 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes`
--

CREATE TABLE `lotes` (
  `id_lote` int(11) NOT NULL,
  `fase` varchar(50) NOT NULL,
  `super_manzana` varchar(50) NOT NULL,
  `mza` varchar(50) NOT NULL,
  `lote` varchar(50) NOT NULL,
  `m2` varchar(50) NOT NULL,
  `cos` varchar(50) NOT NULL,
  `cus` varchar(50) NOT NULL,
  `uso` varchar(50) NOT NULL,
  `id_tipo_lote` int(11) NOT NULL,
  `fecha_entrega` varchar(50) NOT NULL,
  `disponibilidad` varchar(50) NOT NULL,
  `precio_lista` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lotes`
--

INSERT INTO `lotes` (`id_lote`, `fase`, `super_manzana`, `mza`, `lote`, `m2`, `cos`, `cus`, `uso`, `id_tipo_lote`, `fecha_entrega`, `disponibilidad`, `precio_lista`) VALUES
(1, '1', '1', '3', '1', '1,080.30', '378.11', '756.21', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '100'),
(2, '1', '1', '3', '2', '841.31', '294.46', '588.92', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '200'),
(3, '1', '1', '3', '3', '841.31', '294.46', '588.92', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '300'),
(4, '1', '1', '3', '4', '785.99', '275.1', '550.19', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '400'),
(5, '1', '1', '3', '5', '919.45', '321.81', '643.62', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '500'),
(6, '1', '1', '3', '6', '845.18', '295.81', '591.63', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '600'),
(7, '1', '1', '3', '7', '712.93', '249.53', '499.05', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '700'),
(8, '1', '1', '3', '8', '749.37', '262.28', '524.56', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '800'),
(9, '1', '1', '3', '9', '749.37', '262.28', '524.56', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '900'),
(10, '1', '1', '3', '10', '988.36', '345.93', '691.85', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '1000'),
(11, '1', '1', '4', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '1100'),
(12, '1', '1', '4', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '1200'),
(13, '1', '1', '4', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '1300'),
(14, '1', '1', '4', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '1400'),
(15, '1', '1', '4', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '1500'),
(16, '1', '1', '4', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '1600'),
(17, '1', '1', '4', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '1700'),
(18, '1', '1', '4', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '1800'),
(19, '1', '1', '4', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '1900'),
(20, '1', '1', '4', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '2000'),
(21, '1', '1', '4', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '2100'),
(22, '1', '1', '4', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '2200'),
(23, '1', '1', '5', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '2300'),
(24, '1', '1', '5', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '2400'),
(25, '1', '1', '5', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '2500'),
(26, '1', '1', '5', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '2600'),
(27, '1', '1', '5', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '2700'),
(28, '1', '1', '5', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '2800'),
(29, '1', '1', '5', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '2900'),
(30, '1', '1', '5', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '3000'),
(31, '1', '1', '5', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '3100'),
(32, '1', '1', '5', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '3200'),
(33, '1', '1', '5', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '3300'),
(34, '1', '1', '5', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '3400'),
(35, '1', '1', '6', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '3500'),
(36, '1', '1', '6', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '3600'),
(37, '1', '1', '6', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '3700'),
(38, '1', '1', '6', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '3800'),
(39, '1', '1', '6', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '3900'),
(40, '1', '1', '6', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '4000'),
(41, '1', '1', '6', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '4100'),
(42, '1', '1', '6', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '4200'),
(43, '1', '1', '6', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '4300'),
(44, '1', '1', '6', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '4400'),
(45, '1', '1', '6', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '4500'),
(46, '1', '1', '6', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '4600'),
(47, '1', '1', '7', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '4700'),
(48, '1', '1', '7', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '4800'),
(49, '1', '1', '7', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '4900'),
(50, '1', '1', '7', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '5000'),
(51, '1', '1', '7', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '5100'),
(52, '1', '1', '7', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '5200'),
(53, '1', '1', '7', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '5300'),
(54, '1', '1', '7', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '5400'),
(55, '1', '1', '7', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '5500'),
(56, '1', '1', '7', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '5600'),
(57, '1', '1', '7', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '5700'),
(58, '1', '1', '7', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '5800'),
(59, '1', '1', '8', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '5900'),
(60, '1', '1', '8', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '6000'),
(61, '1', '1', '8', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '6100'),
(62, '1', '1', '8', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '6200'),
(63, '1', '1', '8', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '6300'),
(64, '1', '1', '8', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '6400'),
(65, '1', '1', '8', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '6500'),
(66, '1', '1', '8', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '6600'),
(67, '1', '1', '8', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '6700'),
(68, '1', '1', '8', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '6800'),
(69, '1', '1', '8', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '6900'),
(70, '1', '1', '8', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '7000'),
(71, '1', '1', '9', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '7100'),
(72, '1', '1', '9', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '7200'),
(73, '1', '1', '9', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '7300'),
(74, '1', '1', '9', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '7400'),
(75, '1', '1', '9', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '7500'),
(76, '1', '1', '9', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '7600'),
(77, '1', '1', '9', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '7700'),
(78, '1', '1', '9', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '7800'),
(79, '1', '1', '9', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '7900'),
(80, '1', '1', '9', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '8000'),
(81, '1', '1', '9', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '8100'),
(82, '1', '1', '9', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '8200'),
(83, '1', '1', '10', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '8300'),
(84, '1', '1', '10', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '8400'),
(85, '1', '1', '10', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '8500'),
(86, '1', '1', '10', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '8600'),
(87, '1', '1', '10', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '8700'),
(88, '1', '1', '10', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '8800'),
(89, '1', '1', '10', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '8900'),
(90, '1', '1', '10', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '9000'),
(91, '1', '1', '10', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '9100'),
(92, '1', '1', '10', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '9200'),
(93, '1', '1', '10', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '9300'),
(94, '1', '1', '10', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '9400'),
(95, '1', '1', '11', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '9500'),
(96, '1', '1', '11', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '9600'),
(97, '1', '1', '11', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '9700'),
(98, '1', '1', '11', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '9800'),
(99, '1', '1', '11', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '9900'),
(100, '1', '1', '11', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '10000'),
(101, '1', '1', '11', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '10100'),
(102, '1', '1', '11', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '10200'),
(103, '1', '1', '11', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '10300'),
(104, '1', '1', '11', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '10400'),
(105, '1', '1', '11', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '10500'),
(106, '1', '1', '11', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '10600'),
(107, '1', '1', '12', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '10700'),
(108, '1', '1', '12', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '10800'),
(109, '1', '1', '12', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '10900'),
(110, '1', '1', '12', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '11000'),
(111, '1', '1', '12', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '11100'),
(112, '1', '1', '12', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '11200'),
(113, '1', '1', '12', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '11300'),
(114, '1', '1', '12', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '11400'),
(115, '1', '1', '12', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '11500'),
(116, '1', '1', '12', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '11600'),
(117, '1', '1', '12', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '11700'),
(118, '1', '1', '12', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '11800'),
(119, '1', '1', '13', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '11900'),
(120, '1', '1', '13', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '12000'),
(121, '1', '1', '13', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '12100'),
(122, '1', '1', '13', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '12200'),
(123, '1', '1', '13', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '12300'),
(124, '1', '1', '13', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '12400'),
(125, '1', '1', '13', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '12500'),
(126, '1', '1', '13', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '12600'),
(127, '1', '1', '13', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '12700'),
(128, '1', '1', '13', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '12800'),
(129, '1', '1', '13', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '12900'),
(130, '1', '1', '13', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '13000'),
(131, '1', '1', '14', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '13100'),
(132, '1', '1', '14', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '13200'),
(133, '1', '1', '14', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '13300'),
(134, '1', '1', '14', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '13400'),
(135, '1', '1', '14', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '13500'),
(136, '1', '1', '14', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '13600'),
(137, '1', '1', '14', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '13700'),
(138, '1', '1', '14', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '13800'),
(139, '1', '1', '14', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '13900'),
(140, '1', '1', '14', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '14000'),
(141, '1', '1', '14', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '14100'),
(142, '1', '1', '14', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '14200'),
(143, '1', '1', '15', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 3, '15/05/2024', 'PARA VENTA', '14300'),
(144, '1', '1', '15', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, '15/05/2024', 'PARA VENTA', '14400'),
(145, '1', '1', '15', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, '15/05/2024', 'PARA VENTA', '14500'),
(146, '1', '1', '15', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, '15/05/2024', 'PARA VENTA', '14600'),
(147, '1', '1', '15', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 3, '15/05/2024', 'PARA VENTA', '14700'),
(148, '1', '1', '15', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 1, '15/05/2024', 'PARA VENTA', '14800'),
(149, '1', '1', '15', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 2, '15/05/2024', 'PARA VENTA', '14900'),
(150, '1', '1', '15', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 2, '15/05/2024', 'PARA VENTA', '15000'),
(151, '1', '1', '15', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, '15/05/2024', 'PARA VENTA', '15100'),
(152, '1', '1', '15', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, '15/05/2024', 'PARA VENTA', '15200'),
(153, '1', '1', '15', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, '15/05/2024', 'PARA VENTA', '15300'),
(154, '1', '1', '15', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 2, '15/05/2024', 'PARA VENTA', '15400'),
(155, '1', '1', '16', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 1, '15/05/2024', 'PARA VENTA', '15500'),
(156, '1', '1', '16', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, '15/05/2024', 'PARA VENTA', '15600'),
(157, '1', '1', '16', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, '15/05/2024', 'PARA VENTA', '15700'),
(158, '1', '1', '16', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, '15/05/2024', 'PARA VENTA', '15800'),
(159, '1', '1', '16', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 2, '15/05/2024', 'PARA VENTA', '15900'),
(160, '1', '1', '16', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 3, '15/05/2024', 'PARA VENTA', '16000'),
(161, '1', '1', '16', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 2, '15/05/2024', 'PARA VENTA', '16100'),
(162, '1', '1', '16', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 2, '15/05/2024', 'PARA VENTA', '16200'),
(163, '1', '1', '16', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, '15/05/2024', 'PARA VENTA', '16300'),
(164, '1', '1', '16', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, '15/05/2024', 'PARA VENTA', '16400'),
(165, '1', '1', '16', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, '15/05/2024', 'PARA VENTA', '16500'),
(166, '1', '1', '16', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 3, '15/05/2024', 'PARA VENTA', '16600'),
(167, '1', '1', '17', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 3, '15/06/2024', 'PARA VENTA', '16700'),
(168, '1', '1', '17', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, '15/06/2024', 'PARA VENTA', '16800'),
(169, '1', '1', '17', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, '15/06/2024', 'PARA VENTA', '16900'),
(170, '1', '1', '17', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, '15/06/2024', 'PARA VENTA', '17000'),
(171, '1', '1', '17', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 1, '15/06/2024', 'PARA VENTA', '17100'),
(172, '1', '1', '17', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 2, '15/06/2024', 'PARA VENTA', '17200'),
(173, '1', '1', '17', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 1, '15/06/2024', 'PARA VENTA', '17300'),
(174, '1', '1', '17', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 2, '15/06/2024', 'PARA VENTA', '17400'),
(175, '1', '1', '17', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, '15/06/2024', 'PARA VENTA', '17500'),
(176, '1', '1', '17', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, '15/06/2024', 'PARA VENTA', '17600'),
(177, '1', '1', '17', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, '15/06/2024', 'PARA VENTA', '17700'),
(178, '1', '1', '17', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 3, '15/06/2024', 'PARA VENTA', '17800'),
(179, '1', '1', '18', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 1, '15/06/2024', 'PARA VENTA', '17900'),
(180, '1', '1', '18', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, '15/06/2024', 'PARA VENTA', '18000'),
(181, '1', '1', '18', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, '15/06/2024', 'PARA VENTA', '18100'),
(182, '1', '1', '18', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, '15/06/2024', 'PARA VENTA', '18200'),
(183, '1', '1', '18', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 3, '15/06/2024', 'PARA VENTA', '18300'),
(184, '1', '1', '18', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 1, '15/06/2024', 'PARA VENTA', '18400'),
(185, '1', '1', '18', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 1, '15/06/2024', 'PARA VENTA', '18500'),
(186, '1', '1', '18', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 2, '15/06/2024', 'PARA VENTA', '18600'),
(187, '1', '1', '18', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, '15/06/2024', 'PARA VENTA', '18700'),
(188, '1', '1', '18', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, '15/06/2024', 'PARA VENTA', '18800'),
(189, '1', '1', '18', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, '15/06/2024', 'PARA VENTA', '18900'),
(190, '1', '1', '18', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 2, '15/06/2024', 'PARA VENTA', '19000'),
(191, '1', '2', '4', '1', '1,089.99', '381.5', '762.99', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '19100'),
(192, '1', '2', '4', '2', '829.4', '290.29', '580.58', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '19200'),
(193, '1', '2', '4', '3', '829.4', '290.29', '580.58', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '19300'),
(194, '1', '2', '4', '4', '766.74', '268.36', '536.72', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '19400'),
(195, '1', '2', '4', '5', '960.47', '336.16', '672.33', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '19500'),
(196, '1', '2', '4', '7', '766.05', '268.12', '536.24', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '19600'),
(197, '1', '2', '4', '8', '1,031.28', '360.95', '721.9', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '19700'),
(198, '1', '2', '5', '1', '917.02', '320.96', '641.91', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '19800'),
(199, '1', '2', '5', '2', '690.47', '241.66', '483.33', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '19900'),
(200, '1', '2', '5', '3', '690.47', '241.66', '483.33', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '20000'),
(201, '1', '2', '5', '4', '690.47', '241.66', '483.33', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '20100'),
(202, '1', '2', '5', '5', '624.13', '218.45', '436.89', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '20200'),
(203, '1', '2', '5', '6', '803.85', '281.35', '562.7', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '20300'),
(204, '1', '2', '5', '7', '711.55', '249.04', '498.09', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '20400'),
(205, '1', '2', '5', '8', '586.71', '205.35', '410.7', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '20500'),
(206, '1', '2', '5', '9', '630.92', '220.82', '441.64', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '20600'),
(207, '1', '2', '5', '10', '630.92', '220.82', '441.64', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '20700'),
(208, '1', '2', '5', '11', '630.92', '220.82', '441.64', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '20800'),
(209, '1', '2', '5', '12', '853.82', '298.84', '597.67', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '20900'),
(210, '1', '2', '6', '1', '871.07', '304.87', '609.75', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '21000'),
(211, '1', '2', '6', '2', '673.2', '235.62', '471.24', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '21100'),
(212, '1', '2', '6', '3', '673.2', '235.62', '471.24', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '21200'),
(213, '1', '2', '6', '4', '673.2', '235.62', '471.24', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '21300'),
(214, '1', '2', '6', '5', '619.62', '216.87', '433.73', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '21400'),
(215, '1', '2', '6', '6', '756.51', '264.78', '529.56', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '21500'),
(216, '1', '2', '6', '7', '690.69', '241.74', '483.48', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '21600'),
(217, '1', '2', '6', '8', '604.42', '211.55', '423.09', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '21700'),
(218, '1', '2', '6', '9', '636.75', '222.86', '445.73', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '21800'),
(219, '1', '2', '6', '10', '636.75', '222.86', '445.73', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '21900'),
(220, '1', '2', '6', '11', '636.75', '222.86', '445.73', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '22000'),
(221, '1', '2', '6', '12', '835.46', '292.41', '584.82', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '22100'),
(222, '1', '2', '7', '1', '795.83', '278.54', '557.08', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '22200'),
(223, '1', '2', '7', '2', '627.51', '219.63', '439.26', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '22300'),
(224, '1', '2', '7', '3', '627.51', '219.63', '439.26', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '22400'),
(225, '1', '2', '7', '4', '627.51', '219.63', '439.26', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '22500'),
(226, '1', '2', '7', '5', '585.62', '204.97', '409.93', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '22600'),
(227, '1', '2', '7', '6', '681.04', '238.36', '476.73', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '22700'),
(228, '1', '2', '7', '7', '707.47', '247.61', '495.23', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '22800'),
(229, '1', '2', '7', '8', '647.05', '226.47', '452.94', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '22900'),
(230, '1', '2', '7', '9', '669.4', '234.29', '468.58', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '23000'),
(231, '1', '2', '7', '10', '669.4', '234.29', '468.58', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '23100'),
(232, '1', '2', '7', '11', '669.4', '234.29', '468.58', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '23200'),
(233, '1', '2', '7', '12', '858.24', '300.38', '600.77', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '23300'),
(234, '1', '2', '8', '1', '821.19', '287.42', '574.83', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '23400'),
(235, '1', '2', '8', '2', '657.67', '230.18', '460.37', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '23500'),
(236, '1', '2', '8', '3', '657.67', '230.18', '460.37', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '23600'),
(237, '1', '2', '8', '4', '657.67', '230.18', '460.37', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '23700'),
(238, '1', '2', '8', '5', '625.7', '219', '437.99', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '23800'),
(239, '1', '2', '8', '6', '698.37', '244.43', '488.86', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '23900'),
(240, '1', '2', '8', '7', '641.3', '224.46', '448.91', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '24000'),
(241, '1', '2', '8', '8', '612.13', '214.25', '428.49', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '24100'),
(242, '1', '2', '8', '9', '626.77', '219.37', '438.74', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '24200'),
(243, '1', '2', '8', '10', '626.77', '219.37', '438.74', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '24300'),
(244, '1', '2', '8', '11', '626.77', '219.37', '438.74', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '24400'),
(245, '1', '2', '8', '12', '789.56', '276.35', '552.69', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '24500'),
(246, '1', '3', '1', '1', '895.57', '313.45', '626.9', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '24600'),
(247, '1', '3', '1', '2', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '24700'),
(248, '1', '3', '1', '3', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '24800'),
(249, '1', '3', '1', '4', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '24900'),
(250, '1', '3', '1', '5', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '25000'),
(251, '1', '3', '1', '6', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '25100'),
(252, '1', '3', '1', '7', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '25200'),
(253, '1', '3', '1', '8', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '25300'),
(254, '1', '3', '1', '9', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '25400'),
(255, '1', '3', '1', '10', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '25500'),
(256, '1', '3', '1', '11', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '25600'),
(257, '1', '3', '1', '12', '895.57', '313.45', '626.9', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '25700'),
(258, '1', '3', '2', '1', '895.57', '313.45', '626.9', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '25800'),
(259, '1', '3', '2', '2', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '25900'),
(260, '1', '3', '2', '3', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '26000'),
(261, '1', '3', '2', '4', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '26100'),
(262, '1', '3', '2', '5', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '26200'),
(263, '1', '3', '2', '6', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '26300'),
(264, '1', '3', '2', '7', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '26400'),
(265, '1', '3', '2', '8', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '26500'),
(266, '1', '3', '2', '9', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '26600'),
(267, '1', '3', '2', '10', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '26700'),
(268, '1', '3', '2', '11', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '26800'),
(269, '1', '3', '2', '12', '895.57', '313.45', '626.9', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '26900'),
(270, '1', '3', '3', '1', '895.57', '313.45', '626.9', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '27000'),
(271, '1', '3', '3', '2', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '27100'),
(272, '1', '3', '3', '3', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '27200'),
(273, '1', '3', '3', '4', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '27300'),
(274, '1', '3', '3', '5', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '27400'),
(275, '1', '3', '3', '6', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '27500'),
(276, '1', '3', '3', '7', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '27600'),
(277, '1', '3', '3', '8', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '27700'),
(278, '1', '3', '3', '9', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '27800'),
(279, '1', '3', '3', '10', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, '15/04/2024', 'PARA VENTA', '27900'),
(280, '1', '3', '3', '11', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/04/2024', 'PARA VENTA', '28000'),
(281, '1', '3', '3', '12', '895.57', '313.45', '626.9', 'HABITACIONAL', 1, '15/04/2024', 'PARA VENTA', '28100'),
(282, '1', '3', '4', '1', '895.57', '313.45', '626.9', 'HABITACIONAL', 1, '15/05/2024', 'PARA VENTA', '28200'),
(283, '1', '3', '4', '2', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, '15/05/2024', 'PARA VENTA', '28300'),
(284, '1', '3', '4', '3', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/05/2024', 'PARA VENTA', '28400'),
(285, '1', '3', '4', '4', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, '15/05/2024', 'PARA VENTA', '28500'),
(286, '1', '3', '4', '5', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/05/2024', 'PARA VENTA', '28600'),
(287, '1', '3', '4', '6', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, '15/05/2024', 'PARA VENTA', '28700'),
(288, '1', '3', '4', '7', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, '15/05/2024', 'PARA VENTA', '28800'),
(289, '1', '3', '4', '8', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, '15/05/2024', 'PARA VENTA', '28900'),
(290, '1', '3', '4', '9', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, '15/05/2024', 'PARA VENTA', '29000'),
(291, '1', '3', '4', '10', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/05/2024', 'PARA VENTA', '29100'),
(292, '1', '3', '4', '11', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, '15/05/2024', 'PARA VENTA', '29200'),
(293, '1', '3', '4', '12', '895.57', '313.45', '626.9', 'HABITACIONAL', 3, '15/05/2024', 'PARA VENTA', '29300'),
(294, '1', '3', '5', '1', '895.57', '313.45', '626.9', 'HABITACIONAL', 1, '15/06/2024', 'PARA VENTA', '29400'),
(295, '1', '3', '5', '2', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, '15/06/2024', 'PARA VENTA', '29500'),
(296, '1', '3', '5', '3', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/06/2024', 'PARA VENTA', '29600'),
(297, '1', '3', '5', '4', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/06/2024', 'PARA VENTA', '29700'),
(298, '1', '3', '5', '5', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, '15/06/2024', 'PARA VENTA', '29800'),
(299, '1', '3', '5', '6', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, '15/06/2024', 'PARA VENTA', '29900'),
(300, '1', '3', '5', '7', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/06/2024', 'PARA VENTA', '30000'),
(301, '1', '3', '5', '8', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/06/2024', 'PARA VENTA', '30100'),
(302, '1', '3', '5', '9', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, '15/06/2024', 'PARA VENTA', '30200'),
(303, '1', '3', '5', '10', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/06/2024', 'PARA VENTA', '30300'),
(304, '1', '3', '5', '11', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, '15/06/2024', 'PARA VENTA', '30400'),
(305, '1', '3', '5', '12', '895.57', '313.45', '626.9', 'HABITACIONAL', 1, '15/06/2024', 'PARA VENTA', '30500'),
(306, '1', '3', '6', '1', '895.57', '313.45', '626.9', 'HABITACIONAL', 1, '15/07/2024', 'PARA VENTA', '30600'),
(307, '1', '3', '6', '2', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, '15/07/2024', 'PARA VENTA', '30700'),
(308, '1', '3', '6', '3', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/07/2024', 'PARA VENTA', '30800'),
(309, '1', '3', '6', '4', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, '15/07/2024', 'PARA VENTA', '30900'),
(310, '1', '3', '6', '5', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, '15/07/2024', 'PARA VENTA', '31000'),
(311, '1', '3', '6', '6', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, '15/07/2024', 'PARA VENTA', '31100'),
(312, '1', '3', '6', '7', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, '15/07/2024', 'PARA VENTA', '31200'),
(313, '1', '3', '6', '8', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, '15/07/2024', 'PARA VENTA', '31300'),
(314, '1', '3', '6', '9', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/07/2024', 'PARA VENTA', '31400'),
(315, '1', '3', '6', '10', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, '15/07/2024', 'PARA VENTA', '31500'),
(316, '1', '3', '6', '11', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, '15/07/2024', 'PARA VENTA', '31600'),
(317, '1', '3', '6', '12', '895.57', '313.45', '626.9', 'HABITACIONAL', 1, '15/07/2024', 'PARA VENTA', '31700'),
(318, '1', '4', '2', '1', '10,000.00', '  ', '  ', 'AREA DE RESERVA', 1, 'N/A', 'N/A', '31800'),
(319, '1', '4', '3', '1', '467.88', '163.76', '327.52', 'HABITACIONAL', 3, '15/07/2024', 'PARA VENTA', '31900'),
(320, '1', '4', '3', '2', '612.58', '214.4', '428.81', 'HABITACIONAL', 3, '15/07/2024', 'PARA VENTA', '32000'),
(321, '1', '4', '3', '3', '662.46', '231.86', '463.72', 'HABITACIONAL', 2, '15/07/2024', 'PARA VENTA', '32100'),
(322, '1', '4', '3', '4', '690.03', '241.51', '483.02', 'HABITACIONAL', 3, '15/07/2024', 'PARA VENTA', '32200'),
(323, '1', '4', '3', '5', '717.59', '251.16', '502.31', 'HABITACIONAL', 1, '15/07/2024', 'PARA VENTA', '32300'),
(324, '1', '4', '3', '6', '745.16', '260.81', '521.61', 'HABITACIONAL', 2, '15/07/2024', 'PARA VENTA', '32400'),
(325, '1', '4', '3', '7', '745.16', '260.81', '521.61', 'HABITACIONAL', 1, '15/07/2024', 'PARA VENTA', '32500'),
(326, '1', '4', '3', '8', '717.59', '251.16', '502.31', 'HABITACIONAL', 2, '15/07/2024', 'PARA VENTA', '32600'),
(327, '1', '4', '3', '9', '690.03', '241.51', '483.02', 'HABITACIONAL', 3, '15/07/2024', 'PARA VENTA', '32700'),
(328, '1', '4', '3', '10', '662.46', '231.86', '463.72', 'HABITACIONAL', 2, '15/07/2024', 'PARA VENTA', '32800'),
(329, '1', '4', '3', '11', '633.5', '221.73', '443.45', 'HABITACIONAL', 2, '15/07/2024', 'PARA VENTA', '32900'),
(330, '1', '4', '3', '12', '526.56', '184.3', '368.59', 'HABITACIONAL', 1, '15/07/2024', 'PARA VENTA', '33000'),
(331, '1', '4', '4', '1', '651.32', '227.96', '455.92', 'HABITACIONAL', 2, '15/07/2024', 'PARA VENTA', '33100'),
(332, '1', '4', '4', '2', '671.02', '234.86', '469.71', 'HABITACIONAL', 2, '15/07/2024', 'PARA VENTA', '33200'),
(333, '1', '4', '4', '3', '690.71', '241.75', '483.5', 'HABITACIONAL', 3, '15/07/2024', 'PARA VENTA', '33300'),
(334, '1', '4', '4', '4', '710.41', '248.64', '497.29', 'HABITACIONAL', 3, '15/07/2024', 'PARA VENTA', '33400'),
(335, '1', '4', '4', '5', '730.1', '255.54', '511.07', 'HABITACIONAL', 1, '15/07/2024', 'PARA VENTA', '33500'),
(336, '1', '4', '4', '6', '749.79', '262.43', '524.85', 'HABITACIONAL', 1, '15/07/2024', 'PARA VENTA', '33600'),
(337, '1', '4', '4', '7', '749.79', '262.43', '524.85', 'HABITACIONAL', 3, '15/07/2024', 'PARA VENTA', '33700'),
(338, '1', '4', '4', '8', '730.1', '255.54', '511.07', 'HABITACIONAL', 1, '15/07/2024', 'PARA VENTA', '33800'),
(339, '1', '4', '4', '9', '710.41', '248.64', '497.29', 'HABITACIONAL', 3, '15/07/2024', 'PARA VENTA', '33900'),
(340, '1', '4', '4', '10', '690.71', '241.75', '483.5', 'HABITACIONAL', 1, '15/07/2024', 'PARA VENTA', '34000'),
(341, '1', '4', '4', '11', '671.02', '234.86', '469.71', 'HABITACIONAL', 3, '15/07/2024', 'PARA VENTA', '34100'),
(342, '1', '4', '4', '12', '651.32', '227.96', '455.92', 'HABITACIONAL', 1, '15/07/2024', 'PARA VENTA', '34200'),
(343, '1', '4', '5', '1', '677.87', '237.25', '474.51', 'HABITACIONAL', 2, '15/08/2024', 'PARA VENTA', '34300'),
(344, '1', '4', '5', '2', '693.2', '242.62', '485.24', 'HABITACIONAL', 1, '15/08/2024', 'PARA VENTA', '34400'),
(345, '1', '4', '5', '3', '708.53', '247.99', '495.97', 'HABITACIONAL', 1, '15/08/2024', 'PARA VENTA', '34500'),
(346, '1', '4', '5', '4', '723.86', '253.35', '506.7', 'HABITACIONAL', 2, '15/08/2024', 'PARA VENTA', '34600'),
(347, '1', '4', '5', '5', '739.19', '258.72', '517.43', 'HABITACIONAL', 3, '15/08/2024', 'PARA VENTA', '34700'),
(348, '1', '4', '5', '6', '754.51', '264.08', '528.16', 'HABITACIONAL', 2, '15/08/2024', 'PARA VENTA', '34800'),
(349, '1', '4', '5', '7', '754.51', '264.08', '528.16', 'HABITACIONAL', 2, '15/08/2024', 'PARA VENTA', '34900'),
(350, '1', '4', '5', '8', '739.19', '258.72', '517.43', 'HABITACIONAL', 1, '15/08/2024', 'PARA VENTA', '35000'),
(351, '1', '4', '5', '9', '723.86', '253.35', '506.7', 'HABITACIONAL', 3, '15/08/2024', 'PARA VENTA', '35100'),
(352, '1', '4', '5', '10', '708.53', '247.99', '495.97', 'HABITACIONAL', 2, '15/08/2024', 'PARA VENTA', '35200'),
(353, '1', '4', '5', '11', '693.2', '242.62', '485.24', 'HABITACIONAL', 2, '15/08/2024', 'PARA VENTA', '35300'),
(354, '1', '4', '5', '12', '677.87', '237.25', '474.51', 'HABITACIONAL', 3, '15/08/2024', 'PARA VENTA', '35400'),
(355, '2', '1', '21', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '35500'),
(356, '2', '1', '21', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '35600'),
(357, '2', '1', '21', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '35700'),
(358, '2', '1', '21', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '35800'),
(359, '2', '1', '21', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '35900'),
(360, '2', '1', '21', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '36000'),
(361, '2', '1', '21', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '36100'),
(362, '2', '1', '21', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '36200'),
(363, '2', '1', '21', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '36300'),
(364, '2', '1', '21', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '36400'),
(365, '2', '1', '21', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '36500'),
(366, '2', '1', '21', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '36600'),
(367, '2', '1', '22', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '36700'),
(368, '2', '1', '22', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '36800'),
(369, '2', '1', '22', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '36900'),
(370, '2', '1', '22', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '37000'),
(371, '2', '1', '22', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '37100'),
(372, '2', '1', '22', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '37200'),
(373, '2', '1', '22', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '37300'),
(374, '2', '1', '22', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '37400'),
(375, '2', '1', '22', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '37500'),
(376, '2', '1', '22', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '37600'),
(377, '2', '1', '22', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '37700'),
(378, '2', '1', '22', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '37800'),
(379, '2', '1', '23', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '37900'),
(380, '2', '1', '23', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '38000'),
(381, '2', '1', '23', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '38100'),
(382, '2', '1', '23', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '38200'),
(383, '2', '1', '23', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '38300'),
(384, '2', '1', '23', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '38400'),
(385, '2', '1', '23', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '38500'),
(386, '2', '1', '23', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '38600'),
(387, '2', '1', '23', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '38700'),
(388, '2', '1', '23', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '38800'),
(389, '2', '1', '23', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '38900'),
(390, '2', '1', '23', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '39000'),
(391, '2', '1', '24', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '39100'),
(392, '2', '1', '24', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '39200'),
(393, '2', '1', '24', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '39300'),
(394, '2', '1', '24', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '39400'),
(395, '2', '1', '24', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '39500'),
(396, '2', '1', '24', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '39600'),
(397, '2', '1', '24', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '39700'),
(398, '2', '1', '24', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '39800'),
(399, '2', '1', '24', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '39900'),
(400, '2', '1', '24', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '40000'),
(401, '2', '1', '24', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '40100'),
(402, '2', '1', '24', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '40200'),
(403, '2', '1', '25', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '40300'),
(404, '2', '1', '25', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '40400'),
(405, '2', '1', '25', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '40500'),
(406, '2', '1', '25', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '40600'),
(407, '2', '1', '25', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '40700'),
(408, '2', '1', '25', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '40800'),
(409, '2', '1', '25', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '40900'),
(410, '2', '1', '25', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '41000'),
(411, '2', '1', '25', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '41100'),
(412, '2', '1', '25', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '41200'),
(413, '2', '1', '25', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '41300'),
(414, '2', '1', '25', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '41400'),
(415, '2', '1', '26', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '41500'),
(416, '2', '1', '26', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '41600'),
(417, '2', '1', '26', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '41700'),
(418, '2', '1', '26', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '41800'),
(419, '2', '1', '26', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '41900'),
(420, '2', '1', '26', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '42000'),
(421, '2', '1', '26', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '42100'),
(422, '2', '1', '26', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '42200'),
(423, '2', '1', '26', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '42300'),
(424, '2', '1', '26', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '42400'),
(425, '2', '1', '26', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '42500'),
(426, '2', '1', '26', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '42600'),
(427, '2', '1', '27', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '42700'),
(428, '2', '1', '27', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '42800'),
(429, '2', '1', '27', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '42900'),
(430, '2', '1', '27', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '43000'),
(431, '2', '1', '27', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '43100'),
(432, '2', '1', '27', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '43200'),
(433, '2', '1', '27', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '43300'),
(434, '2', '1', '27', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '43400'),
(435, '2', '1', '27', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '43500'),
(436, '2', '1', '27', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '43600'),
(437, '2', '1', '27', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '43700'),
(438, '2', '1', '27', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '43800'),
(439, '2', '5', '1', '1', '895.57', '313.45', '626.9', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '43900'),
(440, '2', '5', '1', '2', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '44000'),
(441, '2', '5', '1', '3', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '44100'),
(442, '2', '5', '1', '4', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '44200'),
(443, '2', '5', '1', '5', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '44300'),
(444, '2', '5', '1', '6', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '44400'),
(445, '2', '5', '1', '7', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '44500'),
(446, '2', '5', '1', '8', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '44600'),
(447, '2', '5', '1', '9', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '44700'),
(448, '2', '5', '1', '10', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '44800'),
(449, '2', '5', '1', '11', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '44900'),
(450, '2', '5', '1', '12', '895.57', '313.45', '626.9', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '45000'),
(451, '2', '5', '2', '1', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '45100'),
(452, '2', '5', '2', '2', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '45200'),
(453, '2', '5', '2', '3', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '45300'),
(454, '2', '5', '2', '4', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '45400');
INSERT INTO `lotes` (`id_lote`, `fase`, `super_manzana`, `mza`, `lote`, `m2`, `cos`, `cus`, `uso`, `id_tipo_lote`, `fecha_entrega`, `disponibilidad`, `precio_lista`) VALUES
(455, '2', '5', '2', '5', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '45500'),
(456, '2', '5', '2', '6', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '45600'),
(457, '2', '5', '2', '7', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '45700'),
(458, '2', '5', '2', '8', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '45800'),
(459, '2', '5', '2', '9', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '45900'),
(460, '2', '5', '2', '10', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '46000'),
(461, '2', '5', '2', '11', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '46100'),
(462, '2', '5', '2', '12', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '46200'),
(463, '2', '5', '3', '1', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '46300'),
(464, '2', '5', '3', '2', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '46400'),
(465, '2', '5', '3', '3', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '46500'),
(466, '2', '5', '3', '4', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '46600'),
(467, '2', '5', '3', '5', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '46700'),
(468, '2', '5', '3', '6', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '46800'),
(469, '2', '5', '3', '7', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '46900'),
(470, '2', '5', '3', '8', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '47000'),
(471, '2', '5', '3', '9', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '47100'),
(472, '2', '5', '3', '10', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '47200'),
(473, '2', '5', '3', '11', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '47300'),
(474, '2', '5', '3', '12', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '47400'),
(475, '2', '5', '4', '1', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '47500'),
(476, '2', '5', '4', '2', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '47600'),
(477, '2', '5', '4', '3', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '47700'),
(478, '2', '5', '4', '4', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '47800'),
(479, '2', '5', '4', '5', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '47900'),
(480, '2', '5', '4', '6', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '48000'),
(481, '2', '5', '4', '7', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '48100'),
(482, '2', '5', '4', '8', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '48200'),
(483, '2', '5', '4', '9', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '48300'),
(484, '2', '5', '4', '10', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '48400'),
(485, '2', '5', '4', '11', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '48500'),
(486, '2', '5', '4', '12', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '48600'),
(487, '2', '5', '5', '1', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '48700'),
(488, '2', '5', '5', '2', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '48800'),
(489, '2', '5', '5', '3', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '48900'),
(490, '2', '5', '5', '4', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '49000'),
(491, '2', '5', '5', '5', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '49100'),
(492, '2', '5', '5', '6', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '49200'),
(493, '2', '5', '5', '7', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '49300'),
(494, '2', '5', '5', '8', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '49400'),
(495, '2', '5', '5', '9', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '49500'),
(496, '2', '5', '5', '10', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '49600'),
(497, '2', '5', '5', '11', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '49700'),
(498, '2', '5', '5', '12', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '49800'),
(499, '2', '5', '6', '1', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '49900'),
(500, '2', '5', '6', '2', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '50000'),
(501, '2', '5', '6', '3', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '50100'),
(502, '2', '5', '6', '4', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '50200'),
(503, '2', '5', '6', '5', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '50300'),
(504, '2', '5', '6', '6', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '50400'),
(505, '2', '5', '6', '7', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '50500'),
(506, '2', '5', '6', '8', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '50600'),
(507, '2', '5', '6', '9', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '50700'),
(508, '2', '5', '6', '10', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '50800'),
(509, '2', '5', '6', '11', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '50900'),
(510, '2', '5', '6', '12', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '51000'),
(511, '2', '5', '7', '1', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '51100'),
(512, '2', '5', '7', '2', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '51200'),
(513, '2', '5', '7', '3', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '51300'),
(514, '2', '5', '7', '4', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '51400'),
(515, '2', '5', '7', '5', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '51500'),
(516, '2', '5', '7', '6', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '51600'),
(517, '2', '5', '7', '7', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '51700'),
(518, '2', '5', '7', '8', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '51800'),
(519, '2', '5', '7', '9', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '51900'),
(520, '2', '5', '7', '10', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '52000'),
(521, '2', '5', '7', '11', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '52100'),
(522, '2', '5', '7', '12', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '52200'),
(523, '2', '5', '8', '1', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '52300'),
(524, '2', '5', '8', '2', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '52400'),
(525, '2', '5', '8', '3', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '52500'),
(526, '2', '5', '8', '4', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '52600'),
(527, '2', '5', '8', '5', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '52700'),
(528, '2', '5', '8', '6', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '52800'),
(529, '2', '5', '8', '7', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '52900'),
(530, '2', '5', '8', '8', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '53000'),
(531, '2', '5', '8', '9', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '53100'),
(532, '2', '5', '8', '10', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '53200'),
(533, '2', '5', '8', '11', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '53300'),
(534, '2', '5', '8', '12', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '53400'),
(535, '2', '5', '9', '1', '699.6', '244.86', '489.72', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '53500'),
(536, '2', '5', '9', '2', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '53600'),
(537, '2', '5', '9', '3', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '53700'),
(538, '2', '5', '9', '4', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '53800'),
(539, '2', '5', '9', '5', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '53900'),
(540, '2', '5', '9', '6', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '54000'),
(541, '2', '5', '9', '7', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '54100'),
(542, '2', '5', '9', '8', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '54200'),
(543, '2', '5', '9', '9', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '54300'),
(544, '2', '5', '9', '10', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '54400'),
(545, '2', '5', '9', '11', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '54500'),
(546, '2', '5', '9', '12', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '54600'),
(547, '2', '5', '10', '1', '895.57', '313.45', '626.9', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '54700'),
(548, '2', '5', '10', '2', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '54800'),
(549, '2', '5', '10', '3', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '54900'),
(550, '2', '5', '10', '4', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '55000'),
(551, '2', '5', '10', '5', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '55100'),
(552, '2', '5', '10', '6', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '55200'),
(553, '2', '5', '10', '7', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '55300'),
(554, '2', '5', '10', '8', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '55400'),
(555, '2', '5', '10', '9', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '55500'),
(556, '2', '5', '10', '10', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '55600'),
(557, '2', '5', '10', '11', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '55700'),
(558, '2', '5', '10', '12', '895.57', '313.45', '626.9', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '55800'),
(559, '2', '5', '11', '1', '895.57', '313.45', '626.9', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '55900'),
(560, '2', '5', '11', '2', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '56000'),
(561, '2', '5', '11', '3', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '56100'),
(562, '2', '5', '11', '4', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '56200'),
(563, '2', '5', '11', '5', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '56300'),
(564, '2', '5', '11', '6', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '56400'),
(565, '2', '5', '11', '7', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '56500'),
(566, '2', '5', '11', '8', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '56600'),
(567, '2', '5', '11', '9', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '56700'),
(568, '2', '5', '11', '10', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '56800'),
(569, '2', '5', '11', '11', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '56900'),
(570, '2', '5', '11', '12', '895.57', '313.45', '626.9', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '57000'),
(571, '2', '5', '12', '1', '895.57', '313.45', '626.9', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '57100'),
(572, '2', '5', '12', '2', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '57200'),
(573, '2', '5', '12', '3', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '57300'),
(574, '2', '5', '12', '4', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '57400'),
(575, '2', '5', '12', '5', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '57500'),
(576, '2', '5', '12', '6', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '57600'),
(577, '2', '5', '12', '7', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '57700'),
(578, '2', '5', '12', '8', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '57800'),
(579, '2', '5', '12', '9', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '57900'),
(580, '2', '5', '12', '10', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '58000'),
(581, '2', '5', '12', '11', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '58100'),
(582, '2', '5', '12', '12', '895.57', '313.45', '626.9', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '58200'),
(583, '2', '5', '13', '1', '895.57', '313.45', '626.9', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '58300'),
(584, '2', '5', '13', '2', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '58400'),
(585, '2', '5', '13', '3', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '58500'),
(586, '2', '5', '13', '4', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '58600'),
(587, '2', '5', '13', '5', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '58700'),
(588, '2', '5', '13', '6', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '58800'),
(589, '2', '5', '13', '7', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '58900'),
(590, '2', '5', '13', '8', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '59000'),
(591, '2', '5', '13', '9', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '59100'),
(592, '2', '5', '13', '10', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '59200'),
(593, '2', '5', '13', '11', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '59300'),
(594, '2', '5', '13', '12', '895.57', '313.45', '626.9', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '59400'),
(595, '2', '5', '14', '1', '895.57', '313.45', '626.9', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '59500'),
(596, '2', '5', '14', '2', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '59600'),
(597, '2', '5', '14', '3', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '59700'),
(598, '2', '5', '14', '4', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '59800'),
(599, '2', '5', '14', '5', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '59900'),
(600, '2', '5', '14', '6', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '60000'),
(601, '2', '5', '14', '7', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '60100'),
(602, '2', '5', '14', '8', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '60200'),
(603, '2', '5', '14', '9', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '60300'),
(604, '2', '5', '14', '10', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '60400'),
(605, '2', '5', '14', '11', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '60500'),
(606, '2', '5', '14', '12', '895.57', '313.45', '626.9', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '60600'),
(607, '2', '5', '15', '1', '895.57', '313.45', '626.9', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '60700'),
(608, '2', '5', '15', '2', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '60800'),
(609, '2', '5', '15', '3', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '60900'),
(610, '2', '5', '15', '4', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '61000'),
(611, '2', '5', '15', '5', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '61100'),
(612, '2', '5', '15', '6', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '61200'),
(613, '2', '5', '15', '7', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '61300'),
(614, '2', '5', '15', '8', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '61400'),
(615, '2', '5', '15', '9', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '61500'),
(616, '2', '5', '15', '10', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '61600'),
(617, '2', '5', '15', '11', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '61700'),
(618, '2', '5', '15', '12', '895.57', '313.45', '626.9', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '61800'),
(619, '2', '5', '16', '1', '895.57', '313.45', '626.9', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '61900'),
(620, '2', '5', '16', '2', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '62000'),
(621, '2', '5', '16', '3', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '62100'),
(622, '2', '5', '16', '4', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '62200'),
(623, '2', '5', '16', '5', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '62300'),
(624, '2', '5', '16', '6', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '62400'),
(625, '2', '5', '16', '7', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '62500'),
(626, '2', '5', '16', '8', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '62600'),
(627, '2', '5', '16', '9', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '62700'),
(628, '2', '5', '16', '10', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '62800'),
(629, '2', '5', '16', '11', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '62900'),
(630, '2', '5', '16', '12', '895.57', '313.45', '626.9', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '63000'),
(631, '2', '6', '2', '1', '10,000.00', '  ', '  ', 'AREA DE RESERVA', 2, 'N/A', 'N/A', '63100'),
(632, '2', '6', '3', '1', '10,000.00', '  ', '  ', 'AREA DE RESERVA', 1, 'N/A', 'N/A', '63200'),
(633, '2', '6', '4', '1', '785.65', '274.98', '549.96', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '63300'),
(634, '2', '6', '4', '2', '866.45', '303.26', '606.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '63400'),
(635, '2', '6', '4', '3', '866.45', '303.26', '606.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '63500'),
(636, '2', '6', '4', '4', '978.95', '342.63', '685.27', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '63600'),
(637, '2', '6', '4', '5', '978.95', '342.63', '685.27', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '63700'),
(638, '2', '6', '4', '6', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '63800'),
(639, '2', '6', '4', '7', '760.42', '266.15', '532.29', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '63900'),
(640, '2', '6', '4', '8', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '64000'),
(641, '2', '6', '4', '9', '760.42', '266.15', '532.29', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '64100'),
(642, '2', '6', '4', '10', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '64200'),
(643, '2', '6', '4', '11', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '64300'),
(644, '2', '6', '4', '12', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '64400'),
(645, '2', '6', '4', '13', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '64500'),
(646, '2', '6', '4', '14', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '64600'),
(647, '2', '6', '4', '15', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '64700'),
(648, '2', '6', '4', '16', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '64800'),
(649, '2', '6', '4', '17', '760.42', '266.15', '532.29', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '64900'),
(650, '2', '6', '4', '18', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '65000'),
(651, '2', '6', '4', '19', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '65100'),
(652, '2', '6', '4', '20', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '65200'),
(653, '2', '6', '4', '21', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '65300'),
(654, '2', '6', '4', '22', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '65400'),
(655, '2', '6', '4', '23', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '65500'),
(656, '2', '6', '4', '24', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '65600'),
(657, '2', '6', '4', '25', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '65700'),
(658, '2', '6', '4', '26', '760.42', '266.15', '532.29', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '65800'),
(659, '2', '6', '4', '27', '760.42', '266.15', '532.29', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '65900'),
(660, '2', '6', '4', '28', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '66000'),
(661, '2', '6', '4', '29', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '66100'),
(662, '2', '6', '4', '30', '760.42', '266.15', '532.29', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '66200'),
(663, '2', '6', '4', '31', '839.5', '293.83', '587.65', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '66300'),
(664, '2', '6', '4', '32', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '66400'),
(665, '2', '6', '4', '33', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '66500'),
(666, '2', '6', '4', '34', '839.5', '293.83', '587.65', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '66600'),
(667, '2', '6', '4', '35', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '66700'),
(668, '2', '6', '4', '36', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '66800'),
(669, '2', '6', '4', '37', '760.42', '266.15', '532.29', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '66900'),
(670, '2', '6', '4', '38', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '67000'),
(671, '2', '6', '4', '39', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '67100'),
(672, '2', '6', '4', '40', '760.42', '266.15', '532.29', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '67200'),
(673, '2', '6', '4', '41', '785.65', '274.98', '549.96', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '67300'),
(674, '2', '6', '4', '42', '785.65', '274.98', '549.96', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '67400'),
(675, '2', '6', '4', '43', '785.65', '274.98', '549.96', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '67500'),
(676, '2', '6', '4', '44', '785.65', '274.98', '549.96', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '67600'),
(677, '2', '6', '5', '1', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '67700'),
(678, '2', '6', '5', '2', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '67800'),
(679, '2', '6', '5', '3', '760.42', '266.15', '532.29', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '67900'),
(680, '2', '6', '5', '4', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '68000'),
(681, '2', '6', '5', '5', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '68100'),
(682, '2', '6', '5', '6', '760.42', '266.15', '532.29', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '68200'),
(683, '2', '6', '5', '7', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '68300'),
(684, '2', '6', '5', '8', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '68400'),
(685, '2', '6', '5', '9', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '68500'),
(686, '2', '6', '5', '10', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '68600'),
(687, '2', '6', '5', '11', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '68700'),
(688, '2', '6', '5', '12', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '68800'),
(689, '2', '6', '5', '13', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '68900'),
(690, '2', '6', '5', '14', '760.42', '266.15', '532.29', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '69000'),
(691, '2', '6', '5', '15', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '69100'),
(692, '2', '6', '5', '16', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '69200'),
(693, '2', '6', '5', '17', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '69300'),
(694, '2', '6', '5', '18', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '69400'),
(695, '2', '6', '5', '19', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '69500'),
(696, '2', '6', '5', '20', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '69600'),
(697, '2', '6', '5', '21', '760.42', '266.15', '532.29', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '69700'),
(698, '2', '6', '5', '22', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '69800'),
(699, '2', '6', '5', '23', '839.5', '293.83', '587.65', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '69900'),
(700, '2', '6', '5', '24', '839.5', '293.83', '587.65', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '70000'),
(701, '2', '6', '5', '25', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '70100'),
(702, '2', '6', '5', '26', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '70200'),
(703, '2', '6', '5', '27', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '70300'),
(704, '2', '6', '5', '28', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '70400'),
(705, '2', '6', '5', '29', '760.42', '266.15', '532.29', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '70500'),
(706, '2', '6', '5', '30', '760.42', '266.15', '532.29', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '70600'),
(707, '2', '6', '5', '31', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '70700'),
(708, '2', '6', '5', '32', '760.42', '266.15', '532.29', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '70800'),
(709, '2', '6', '5', '33', '760.42', '266.15', '532.29', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '70900'),
(710, '2', '6', '5', '34', '760.42', '266.15', '532.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '71000'),
(711, '3', '1', '28', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '71100'),
(712, '3', '1', '28', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '71200'),
(713, '3', '1', '28', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '71300'),
(714, '3', '1', '28', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '71400'),
(715, '3', '1', '28', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '71500'),
(716, '3', '1', '28', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '71600'),
(717, '3', '1', '28', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '71700'),
(718, '3', '1', '28', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '71800'),
(719, '3', '1', '28', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '71900'),
(720, '3', '1', '28', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '72000'),
(721, '3', '1', '28', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '72100'),
(722, '3', '1', '28', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '72200'),
(723, '3', '1', '29', '1', '874.08', '305.93', '611.86', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '72300'),
(724, '3', '1', '29', '2', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '72400'),
(725, '3', '1', '29', '3', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '72500'),
(726, '3', '1', '29', '4', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '72600'),
(727, '3', '1', '29', '5', '600.81', '210.28', '420.57', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '72700'),
(728, '3', '1', '29', '6', '723.05', '253.07', '506.14', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '72800'),
(729, '3', '1', '29', '7', '758.54', '265.49', '530.98', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '72900'),
(730, '3', '1', '29', '8', '608.31', '212.91', '425.82', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '73000'),
(731, '3', '1', '29', '9', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '73100'),
(732, '3', '1', '29', '10', '659.14', '230.7', '461.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '73200'),
(733, '3', '1', '29', '11', '659.14', '230.7', '461.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '73300'),
(734, '3', '1', '29', '12', '874.08', '305.93', '611.86', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '73400'),
(735, '3', '1', '30', '1', '895.57', '313.45', '626.9', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '73500'),
(736, '3', '1', '30', '2', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '73600'),
(737, '3', '1', '30', '3', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '73700'),
(738, '3', '1', '30', '4', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '73800'),
(739, '3', '1', '30', '5', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '73900'),
(740, '3', '1', '30', '6', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '74000'),
(741, '3', '1', '30', '7', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '74100'),
(742, '3', '1', '30', '8', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '74200'),
(743, '3', '1', '30', '9', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '74300'),
(744, '3', '1', '30', '10', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '74400'),
(745, '3', '1', '30', '11', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '74500'),
(746, '3', '1', '30', '12', '895.57', '313.45', '626.9', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '74600'),
(747, '3', '1', '31', '1', '954.28', '334', '668', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '74700'),
(748, '3', '1', '31', '2', '765.45', '267.91', '535.82', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '74800'),
(749, '3', '1', '31', '3', '771.64', '270.07', '540.15', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '74900'),
(750, '3', '1', '31', '4', '774.28', '271', '542', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '75000'),
(751, '3', '1', '31', '5', '773.36', '270.68', '541.35', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '75100'),
(752, '3', '1', '31', '6', '768.88', '269.11', '538.22', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '75200'),
(753, '3', '1', '31', '7', '765.45', '267.91', '535.82', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '75300'),
(754, '3', '1', '31', '8', '765.45', '267.91', '535.82', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '75400'),
(755, '3', '1', '31', '9', '765.45', '267.91', '535.82', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '75500'),
(756, '3', '1', '31', '10', '765.45', '267.91', '535.82', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '75600'),
(757, '3', '1', '31', '11', '765.45', '267.91', '535.82', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '75700'),
(758, '3', '1', '31', '12', '1,007.17', '352.51', '705.02', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '75800'),
(759, '3', '13', '1', '1', '759.38', '265.78', '531.57', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '75900'),
(760, '3', '13', '1', '2', '760.73', '266.26', '532.51', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '76000'),
(761, '3', '13', '1', '3', '762.08', '266.73', '533.46', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '76100'),
(762, '3', '13', '1', '4', '763.44', '267.2', '534.41', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '76200'),
(763, '3', '13', '1', '5', '764.79', '267.68', '535.35', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '76300'),
(764, '3', '13', '1', '6', '766.14', '268.15', '536.3', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '76400'),
(765, '3', '13', '1', '7', '766.16', '268.16', '536.31', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '76500'),
(766, '3', '13', '1', '8', '764.81', '267.68', '535.37', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '76600'),
(767, '3', '13', '1', '9', '763.45', '267.21', '534.42', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '76700'),
(768, '3', '13', '1', '10', '762.09', '266.73', '533.46', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '76800'),
(769, '3', '13', '1', '11', '760.73', '266.26', '532.51', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '76900'),
(770, '3', '13', '1', '12', '759.38', '265.78', '531.57', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '77000'),
(771, '3', '13', '2', '1', '768.44', '268.95', '537.91', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '77100'),
(772, '3', '13', '2', '2', '769.8', '269.43', '538.86', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '77200'),
(773, '3', '13', '2', '3', '771.15', '269.9', '539.81', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '77300'),
(774, '3', '13', '2', '4', '772.51', '270.38', '540.76', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '77400'),
(775, '3', '13', '2', '5', '773.87', '270.85', '541.71', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '77500'),
(776, '3', '13', '2', '6', '769.53', '269.34', '538.67', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '77600'),
(777, '3', '13', '2', '7', '769.57', '269.35', '538.7', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '77700'),
(778, '3', '13', '2', '8', '773.9', '270.87', '541.73', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '77800'),
(779, '3', '13', '2', '9', '772.54', '270.39', '540.78', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '77900'),
(780, '3', '13', '2', '10', '771.18', '269.91', '539.83', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '78000'),
(781, '3', '13', '2', '11', '769.82', '269.44', '538.87', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '78100'),
(782, '3', '13', '2', '12', '768.46', '268.96', '537.92', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '78200'),
(783, '3', '13', '3', '1', '782.42', '273.85', '547.69', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '78300'),
(784, '3', '13', '3', '2', '781.06', '273.37', '546.74', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '78400'),
(785, '3', '13', '3', '3', '779.71', '272.9', '545.8', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '78500'),
(786, '3', '13', '3', '4', '778.35', '272.42', '544.85', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '78600'),
(787, '3', '13', '3', '5', '777', '271.95', '543.9', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '78700'),
(788, '3', '13', '3', '6', '775.64', '271.47', '542.95', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '78800'),
(789, '3', '13', '3', '7', '775.64', '271.47', '542.95', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '78900'),
(790, '3', '13', '3', '8', '777', '271.95', '543.9', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '79000'),
(791, '3', '13', '3', '9', '778.35', '272.42', '544.85', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '79100'),
(792, '3', '13', '3', '10', '779.71', '272.9', '545.8', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '79200'),
(793, '3', '13', '3', '11', '781.06', '273.37', '546.74', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '79300'),
(794, '3', '13', '3', '12', '782.42', '273.85', '547.69', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '79400'),
(795, '3', '13', '4', '1', '865.04', '302.76', '605.53', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '79500'),
(796, '3', '13', '4', '2', '911.59', '319.06', '638.11', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '79600'),
(797, '3', '13', '4', '3', '958.89', '335.61', '671.22', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '79700'),
(798, '3', '13', '4', '4', '999.1', '349.69', '699.37', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '79800'),
(799, '3', '13', '4', '5', '1,031.37', '360.98', '721.96', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '79900'),
(800, '3', '13', '4', '6', '1,055.63', '369.47', '738.94', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '80000'),
(801, '3', '13', '4', '7', '1,071.85', '375.15', '750.3', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '80100'),
(802, '3', '13', '4', '8', '1,080.02', '378.01', '756.01', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '80200'),
(803, '3', '13', '4', '9', '1,080.12', '378.04', '756.08', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '80300'),
(804, '3', '13', '4', '10', '1,072.14', '375.25', '750.5', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '80400'),
(805, '3', '13', '4', '11', '1,056.11', '369.64', '739.28', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '80500'),
(806, '3', '13', '4', '12', '1,032.04', '361.21', '722.43', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '80600'),
(807, '3', '13', '5', '1', '790.55', '276.69', '553.39', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '80700'),
(808, '3', '13', '5', '2', '789.19', '276.22', '552.43', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '80800'),
(809, '3', '13', '5', '3', '787.84', '275.74', '551.49', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '80900'),
(810, '3', '13', '5', '4', '786.48', '275.27', '550.54', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '81000'),
(811, '3', '13', '5', '5', '785.13', '274.8', '549.59', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '81100'),
(812, '3', '13', '5', '6', '783.77', '274.32', '548.64', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '81200'),
(813, '3', '13', '5', '7', '783.77', '274.32', '548.64', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '81300'),
(814, '3', '13', '5', '8', '785.13', '274.8', '549.59', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '81400'),
(815, '3', '13', '5', '9', '786.48', '275.27', '550.54', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '81500'),
(816, '3', '13', '5', '10', '787.84', '275.74', '551.49', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '81600'),
(817, '3', '13', '5', '11', '789.19', '276.22', '552.43', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '81700'),
(818, '3', '13', '5', '12', '790.55', '276.69', '553.39', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '81800'),
(819, '3', '14', '1', '1', '845.4', '295.89', '591.78', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '81900'),
(820, '3', '14', '1', '2', '815.32', '285.36', '570.72', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '82000'),
(821, '3', '14', '1', '3', '785.24', '274.83', '549.67', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '82100'),
(822, '3', '14', '1', '4', '755.16', '264.31', '528.61', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '82200'),
(823, '3', '14', '1', '5', '725.08', '253.78', '507.56', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '82300'),
(824, '3', '14', '1', '6', '695', '243.25', '486.5', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '82400'),
(825, '3', '14', '1', '7', '794.34', '278.02', '556.04', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '82500'),
(826, '3', '14', '1', '8', '832.64', '291.42', '582.85', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '82600'),
(827, '3', '14', '1', '9', '870.94', '304.83', '609.66', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '82700'),
(828, '3', '14', '1', '10', '909.23', '318.23', '636.46', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '82800'),
(829, '3', '14', '1', '11', '947.53', '331.64', '663.27', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '82900'),
(830, '3', '14', '1', '12', '1,055.38', '369.38', '738.77', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '83000'),
(831, '3', '14', '2', '1', '697.41', '244.09', '488.19', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '83100'),
(832, '3', '14', '2', '2', '694.54', '243.09', '486.18', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '83200'),
(833, '3', '14', '2', '3', '691.67', '242.08', '484.17', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '83300'),
(834, '3', '14', '2', '4', '688.8', '241.08', '482.16', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '83400'),
(835, '3', '14', '2', '5', '685.93', '240.08', '480.15', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '83500'),
(836, '3', '14', '2', '6', '683.06', '239.07', '478.14', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '83600'),
(837, '3', '14', '2', '7', '830.54', '290.69', '581.38', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '83700'),
(838, '3', '14', '2', '8', '824.96', '288.74', '577.47', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '83800'),
(839, '3', '14', '2', '9', '819.38', '286.78', '573.57', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '83900'),
(840, '3', '14', '2', '10', '813.8', '284.83', '569.66', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '84000'),
(841, '3', '14', '2', '11', '808.21', '282.87', '565.75', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '84100'),
(842, '3', '14', '2', '12', '802.63', '280.92', '561.84', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '84200'),
(843, '3', '14', '3', '1', '799.9', '279.97', '559.93', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '84300'),
(844, '3', '14', '3', '2', '798.55', '279.49', '558.99', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '84400'),
(845, '3', '14', '3', '3', '797.19', '279.02', '558.03', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '84500'),
(846, '3', '14', '3', '4', '795.84', '278.54', '557.09', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '84600'),
(847, '3', '14', '3', '5', '794.48', '278.07', '556.14', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '84700'),
(848, '3', '14', '3', '6', '793.13', '277.6', '555.19', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '84800'),
(849, '3', '14', '3', '7', '793.13', '277.6', '555.19', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '84900'),
(850, '3', '14', '3', '8', '794.48', '278.07', '556.14', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '85000'),
(851, '3', '14', '3', '9', '795.84', '278.54', '557.09', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '85100'),
(852, '3', '14', '3', '10', '797.19', '279.02', '558.03', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '85200'),
(853, '3', '14', '3', '11', '798.55', '279.49', '558.99', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '85300'),
(854, '3', '14', '3', '12', '799.9', '279.97', '559.93', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '85400'),
(855, '3', '14', '4', '1', '895.32', '313.36', '626.72', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '85500'),
(856, '3', '14', '4', '2', '851.2', '297.92', '595.84', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '85600'),
(857, '3', '14', '4', '3', '813.55', '284.74', '569.49', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '85700'),
(858, '3', '14', '4', '4', '782.54', '273.89', '547.78', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '85800'),
(859, '3', '14', '4', '5', '758.22', '265.38', '530.75', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '85900'),
(860, '3', '14', '4', '6', '740.63', '259.22', '518.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '86000'),
(861, '3', '14', '4', '7', '729.79', '255.43', '510.85', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '86100'),
(862, '3', '14', '4', '8', '725.72', '254', '508', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '86200'),
(863, '3', '14', '4', '9', '728.42', '254.95', '509.89', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '86300'),
(864, '3', '14', '4', '10', '737.88', '258.26', '516.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '86400'),
(865, '3', '14', '4', '11', '754.1', '263.94', '527.87', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '86500'),
(866, '3', '14', '4', '12', '777.05', '271.97', '543.94', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '86600'),
(867, '3', '14', '5', '1', '773.51', '270.73', '541.46', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '86700'),
(868, '3', '14', '5', '2', '772.26', '270.29', '540.58', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '86800'),
(869, '3', '14', '5', '3', '771.01', '269.85', '539.71', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '86900'),
(870, '3', '14', '5', '4', '769.76', '269.42', '538.83', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '87000'),
(871, '3', '14', '5', '5', '768.51', '268.98', '537.96', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '87100'),
(872, '3', '14', '5', '6', '767.26', '268.54', '537.08', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '87200'),
(873, '3', '14', '5', '7', '772.53', '270.39', '540.77', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '87300'),
(874, '3', '14', '5', '8', '773.78', '270.82', '541.65', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '87400'),
(875, '3', '14', '5', '9', '775.03', '271.26', '542.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '87500'),
(876, '3', '14', '5', '10', '776.28', '271.7', '543.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '87600'),
(877, '3', '14', '5', '11', '777.53', '272.14', '544.27', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '87700'),
(878, '3', '14', '5', '12', '778.78', '272.57', '545.15', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '87800'),
(879, '3', '15', '1', '1', '895.57', '313.45', '626.9', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '87900'),
(880, '3', '15', '1', '2', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '88000'),
(881, '3', '15', '1', '3', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '88100'),
(882, '3', '15', '1', '4', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '88200'),
(883, '3', '15', '1', '5', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '88300'),
(884, '3', '15', '1', '6', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '88400'),
(885, '3', '15', '1', '7', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '88500'),
(886, '3', '15', '1', '8', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '88600'),
(887, '3', '15', '1', '9', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '88700'),
(888, '3', '15', '1', '10', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '88800'),
(889, '3', '15', '1', '11', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '88900'),
(890, '3', '15', '1', '12', '895.57', '313.45', '626.9', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '89000'),
(891, '3', '15', '2', '1', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '89100'),
(892, '3', '15', '2', '2', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '89200'),
(893, '3', '15', '2', '3', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '89300'),
(894, '3', '15', '2', '4', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '89400'),
(895, '3', '15', '2', '5', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '89500'),
(896, '3', '15', '2', '6', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '89600'),
(897, '3', '15', '2', '7', '697.94', '244.28', '488.56', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '89700'),
(898, '3', '15', '2', '8', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '89800'),
(899, '3', '15', '2', '9', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '89900'),
(900, '3', '15', '2', '10', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '90000'),
(901, '3', '15', '2', '11', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '90100'),
(902, '3', '15', '2', '12', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '90200'),
(903, '3', '15', '3', '1', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '90300'),
(904, '3', '15', '3', '2', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '90400'),
(905, '3', '15', '3', '3', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '90500'),
(906, '3', '15', '3', '4', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '90600'),
(907, '3', '15', '3', '5', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '90700'),
(908, '3', '15', '3', '6', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '90800');
INSERT INTO `lotes` (`id_lote`, `fase`, `super_manzana`, `mza`, `lote`, `m2`, `cos`, `cus`, `uso`, `id_tipo_lote`, `fecha_entrega`, `disponibilidad`, `precio_lista`) VALUES
(909, '3', '15', '3', '7', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '90900'),
(910, '3', '15', '3', '8', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '91000'),
(911, '3', '15', '3', '9', '716.46', '250.76', '501.52', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '91100'),
(912, '3', '15', '3', '10', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '91200'),
(913, '3', '15', '3', '11', '716.46', '250.76', '501.52', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '91300'),
(914, '3', '15', '3', '12', '716.46', '250.76', '501.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '91400'),
(915, '3', '15', '4', '1', '945.7', '331', '661.99', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '91500'),
(916, '3', '15', '4', '2', '948.92', '332.12', '664.24', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '91600'),
(917, '3', '15', '4', '3', '944.54', '330.59', '661.18', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '91700'),
(918, '3', '15', '4', '4', '932.56', '326.4', '652.79', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '91800'),
(919, '3', '15', '4', '5', '913.02', '319.56', '639.11', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '91900'),
(920, '3', '15', '4', '6', '885.89', '310.06', '620.12', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '92000'),
(921, '3', '15', '4', '7', '833.33', '291.67', '583.33', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '92100'),
(922, '3', '15', '4', '8', '833.33', '291.67', '583.33', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '92200'),
(923, '3', '15', '4', '9', '833.33', '291.67', '583.33', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '92300'),
(924, '3', '15', '4', '10', '833.33', '291.67', '583.33', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '92400'),
(925, '3', '15', '4', '11', '833.33', '291.67', '583.33', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '92500'),
(926, '3', '15', '4', '12', '833.33', '291.67', '583.33', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '92600'),
(927, '3', '15', '5', '1', '939.69', '328.89', '657.78', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '92700'),
(928, '3', '15', '5', '2', '782.28', '273.8', '547.6', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '92800'),
(929, '3', '15', '5', '3', '819.02', '286.66', '573.31', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '92900'),
(930, '3', '15', '5', '4', '848.9', '297.12', '594.23', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '93000'),
(931, '3', '15', '5', '5', '872.02', '305.21', '610.41', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '93100'),
(932, '3', '15', '5', '6', '888.46', '310.96', '621.92', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '93200'),
(933, '3', '15', '5', '7', '791.67', '277.08', '554.17', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '93300'),
(934, '3', '15', '5', '8', '791.67', '277.08', '554.17', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '93400'),
(935, '3', '15', '5', '9', '791.67', '277.08', '554.17', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '93500'),
(936, '3', '15', '5', '10', '791.67', '277.08', '554.17', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '93600'),
(937, '3', '15', '5', '11', '791.67', '277.08', '554.17', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '93700'),
(938, '3', '15', '5', '12', '1,041.67', '364.58', '729.17', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '93800'),
(939, '3', '15', '6', '1', '895.57', '313.45', '626.9', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '93900'),
(940, '3', '15', '6', '2', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '94000'),
(941, '3', '15', '6', '3', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '94100'),
(942, '3', '15', '6', '4', '680.63', '238.22', '476.44', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '94200'),
(943, '3', '15', '6', '5', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '94300'),
(944, '3', '15', '6', '6', '680.63', '238.22', '476.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '94400'),
(945, '3', '15', '6', '7', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '94500'),
(946, '3', '15', '6', '8', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '94600'),
(947, '3', '15', '6', '9', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '94700'),
(948, '3', '15', '6', '10', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '94800'),
(949, '3', '15', '6', '11', '680.63', '238.22', '476.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '94900'),
(950, '3', '15', '6', '12', '895.57', '313.45', '626.9', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '95000'),
(951, '3', '16', '4', '1', '675.95', '236.58', '473.17', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '95100'),
(952, '3', '16', '4', '2', '670.36', '234.63', '469.25', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '95200'),
(953, '3', '16', '4', '3', '654.92', '229.22', '458.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '95300'),
(954, '3', '16', '4', '4', '644.44', '225.55', '451.11', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '95400'),
(955, '3', '16', '4', '5', '638.92', '223.62', '447.24', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '95500'),
(956, '3', '16', '4', '6', '638.38', '223.43', '446.87', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '95600'),
(957, '3', '16', '4', '7', '670.46', '234.66', '469.32', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '95700'),
(958, '3', '16', '4', '8', '724.27', '253.49', '506.99', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '95800'),
(959, '3', '16', '4', '9', '766.91', '268.42', '536.84', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '95900'),
(960, '3', '16', '4', '10', '798.57', '279.5', '559', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '96000'),
(961, '3', '16', '4', '11', '819.42', '286.8', '573.59', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '96100'),
(962, '3', '16', '4', '12', '829.59', '290.36', '580.71', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '96200'),
(963, '3', '16', '5', '1', '689.01', '241.15', '482.31', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '96300'),
(964, '3', '16', '5', '2', '686.11', '240.14', '480.28', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '96400'),
(965, '3', '16', '5', '3', '683.57', '239.25', '478.5', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '96500'),
(966, '3', '16', '5', '4', '681.37', '238.48', '476.96', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '96600'),
(967, '3', '16', '5', '5', '679.51', '237.83', '475.66', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '96700'),
(968, '3', '16', '5', '6', '677.98', '237.29', '474.59', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '96800'),
(969, '3', '16', '5', '7', '676.77', '236.87', '473.74', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '96900'),
(970, '3', '16', '5', '8', '675.88', '236.56', '473.12', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '97000'),
(971, '3', '16', '5', '9', '675.3', '236.36', '472.71', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '97100'),
(972, '3', '16', '5', '10', '675.03', '236.26', '472.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '97200'),
(973, '3', '16', '5', '11', '675.08', '236.28', '472.56', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '97300'),
(974, '3', '16', '5', '12', '675.43', '236.4', '472.8', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '97400'),
(975, '3', '16', '5', '13', '676.09', '236.63', '473.26', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '97500'),
(976, '3', '16', '5', '14', '677.07', '236.97', '473.95', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '97600'),
(977, '3', '16', '5', '15', '733.33', '256.67', '513.33', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '97700'),
(978, '3', '16', '5', '16', '635.34', '222.37', '444.74', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '97800'),
(979, '3', '16', '5', '17', '677.36', '237.08', '474.15', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '97900'),
(980, '3', '16', '5', '18', '676.24', '236.68', '473.37', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '98000'),
(981, '3', '16', '5', '19', '675.49', '236.42', '472.84', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '98100'),
(982, '3', '16', '5', '20', '675.09', '236.28', '472.56', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '98200'),
(983, '3', '16', '5', '21', '675.04', '236.26', '472.53', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '98300'),
(984, '3', '16', '5', '22', '675.34', '236.37', '472.74', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '98400'),
(985, '3', '16', '5', '23', '676.01', '236.6', '473.21', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '98500'),
(986, '3', '16', '5', '24', '677.03', '236.96', '473.92', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '98600'),
(987, '3', '16', '5', '25', '678.41', '237.44', '474.89', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '98700'),
(988, '3', '16', '5', '26', '680.16', '238.06', '476.11', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '98800'),
(989, '3', '16', '5', '27', '682.29', '238.8', '477.6', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '98900'),
(990, '3', '16', '5', '28', '684.81', '239.68', '479.37', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '99000'),
(991, '3', '16', '5', '29', '687.74', '240.71', '481.42', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '99100'),
(992, '3', '16', '5', '30', '691.08', '241.88', '483.76', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '99200'),
(993, '3', '16', '5', '31', '633.1', '221.59', '443.17', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '99300'),
(994, '3', '16', '5', '32', '643.84', '225.34', '450.69', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '99400'),
(995, '3', '16', '5', '33', '668.19', '233.87', '467.73', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '99500'),
(996, '3', '16', '5', '34', '706.38', '247.23', '494.47', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '99600'),
(997, '3', '16', '5', '35', '758.71', '265.55', '531.1', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '99700'),
(998, '3', '16', '5', '36', '821.13', '287.4', '574.79', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '99800'),
(999, '3', '16', '5', '37', '879.6', '307.86', '615.72', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '99900'),
(1000, '3', '16', '5', '38', '931.92', '326.17', '652.34', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '100000'),
(1001, '3', '16', '5', '39', '978.46', '342.46', '684.92', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '100100'),
(1002, '3', '16', '5', '40', '1,019.55', '356.84', '713.69', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '100200'),
(1003, '3', '16', '5', '41', '1,055.43', '369.4', '738.8', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '100300'),
(1004, '3', '16', '5', '42', '536.27', '187.69', '375.39', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '100400'),
(1005, '3', '16', '5', '43', '629.99', '220.5', '440.99', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '100500'),
(1006, '3', '16', '5', '44', '573.69', '200.79', '401.58', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '100600'),
(1007, '3', '16', '5', '45', '731.54', '256.04', '512.08', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '100700'),
(1008, '3', '16', '5', '46', '939.57', '328.85', '657.7', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '100800'),
(1009, '3', '16', '5', '47', '630.39', '220.64', '441.27', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '100900'),
(1010, '3', '16', '5', '48', '687.72', '240.7', '481.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '101000'),
(1011, '3', '16', '5', '49', '549.98', '192.49', '384.99', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '101100'),
(1012, '3', '16', '6', '1', '583.89', '204.36', '408.72', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '101200'),
(1013, '3', '16', '6', '2', '703.81', '246.33', '492.67', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '101300'),
(1014, '3', '16', '6', '3', '720.86', '252.3', '504.6', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '101400'),
(1015, '3', '16', '6', '4', '728.24', '254.88', '509.77', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '101500'),
(1016, '3', '16', '6', '5', '727.5', '254.63', '509.25', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '101600'),
(1017, '3', '16', '6', '6', '718.62', '251.52', '503.03', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '101700'),
(1018, '3', '16', '6', '7', '688.17', '240.86', '481.72', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '101800'),
(1019, '3', '16', '6', '8', '657.87', '230.25', '460.51', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '101900'),
(1020, '3', '16', '6', '9', '651.72', '228.1', '456.2', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '102000'),
(1021, '3', '16', '6', '10', '669.52', '234.33', '468.66', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '102100'),
(1022, '3', '16', '6', '11', '711.26', '248.94', '497.88', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '102200'),
(1023, '3', '16', '6', '12', '777.13', '272', '543.99', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '102300'),
(1024, '3', '17', '5', '1', '820.43', '287.15', '574.3', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '102400'),
(1025, '3', '17', '5', '2', '698.6', '244.51', '489.02', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '102500'),
(1026, '3', '17', '5', '3', '698.6', '244.51', '489.02', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '102600'),
(1027, '3', '17', '5', '4', '698.6', '244.51', '489.02', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '102700'),
(1028, '3', '17', '5', '5', '698.6', '244.51', '489.02', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '102800'),
(1029, '3', '17', '5', '6', '698.6', '244.51', '489.02', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '102900'),
(1030, '3', '17', '5', '7', '698.6', '244.51', '489.02', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '103000'),
(1031, '3', '17', '5', '8', '698.6', '244.51', '489.02', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '103100'),
(1032, '3', '17', '5', '9', '946.33', '331.22', '662.43', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '103200'),
(1033, '3', '17', '5', '10', '722.34', '252.82', '505.64', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '103300'),
(1034, '3', '17', '5', '11', '665.28', '232.85', '465.7', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '103400'),
(1035, '3', '17', '5', '12', '665.28', '232.85', '465.7', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '103500'),
(1036, '3', '17', '5', '13', '665.28', '232.85', '465.7', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '103600'),
(1037, '3', '17', '5', '14', '665.28', '232.85', '465.7', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '103700'),
(1038, '3', '17', '5', '15', '665.28', '232.85', '465.7', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '103800'),
(1039, '3', '17', '5', '16', '665.28', '232.85', '465.7', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '103900'),
(1040, '3', '17', '5', '17', '886.15', '310.15', '620.31', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '104000'),
(1041, '3', '17', '5', '18', '727.59', '254.66', '509.31', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '104100'),
(1042, '3', '17', '5', '19', '665.28', '232.85', '465.7', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '104200'),
(1043, '3', '17', '5', '20', '665.28', '232.85', '465.7', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '104300'),
(1044, '3', '17', '5', '21', '665.28', '232.85', '465.7', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '104400'),
(1045, '3', '17', '5', '22', '665.28', '232.85', '465.7', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '104500'),
(1046, '3', '17', '5', '23', '665.28', '232.85', '465.7', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '104600'),
(1047, '3', '17', '5', '24', '855.7', '299.5', '598.99', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '104700'),
(1048, '3', '17', '5', '25', '672.05', '235.22', '470.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '104800'),
(1049, '3', '17', '5', '26', '755.96', '264.59', '529.17', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '104900'),
(1050, '3', '17', '5', '27', '755.96', '264.59', '529.17', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '105000'),
(1051, '3', '17', '5', '28', '755.96', '264.59', '529.17', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '105100'),
(1052, '3', '17', '5', '29', '755.96', '264.59', '529.17', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '105200'),
(1053, '3', '17', '5', '30', '718.76', '251.57', '503.13', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '105300'),
(1054, '3', '17', '5', '31', '858', '300.3', '600.6', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '105400'),
(1055, '3', '17', '5', '32', '911.47', '319.01', '638.03', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '105500'),
(1056, '3', '17', '5', '33', '863', '302.05', '604.1', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '105600'),
(1057, '3', '17', '5', '34', '829.03', '290.16', '580.32', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '105700'),
(1058, '3', '17', '5', '35', '809.33', '283.27', '566.53', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '105800'),
(1059, '3', '17', '5', '36', '647.38', '226.58', '453.17', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '105900'),
(1060, '4', '18', '19', '1', '563.29', '197.15', '394.3', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '106000'),
(1061, '4', '18', '19', '2', '570.85', '199.8', '399.6', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '106100'),
(1062, '4', '18', '19', '3', '584.38', '204.53', '409.07', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '106200'),
(1063, '4', '18', '19', '4', '603.9', '211.37', '422.73', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '106300'),
(1064, '4', '18', '19', '5', '629.47', '220.31', '440.63', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '106400'),
(1065, '4', '18', '19', '6', '661.13', '231.4', '462.79', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '106500'),
(1066, '4', '18', '19', '7', '1,188.79', '416.08', '832.15', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '106600'),
(1067, '4', '18', '19', '8', '1,261.01', '441.35', '882.71', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '106700'),
(1068, '4', '18', '19', '9', '828.48', '289.97', '579.94', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '106800'),
(1069, '4', '18', '19', '10', '845.96', '296.09', '592.17', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '106900'),
(1070, '4', '18', '19', '11', '840.57', '294.2', '588.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '107000'),
(1071, '4', '18', '19', '12', '816.3', '285.71', '571.41', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '107100'),
(1072, '4', '18', '19', '13', '1,242.60', '434.91', '869.82', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '107200'),
(1073, '4', '18', '19', '14', '1,213.22', '424.63', '849.25', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '107300'),
(1074, '4', '18', '19', '15', '694.96', '243.24', '486.47', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '107400'),
(1075, '4', '18', '19', '16', '670.69', '234.74', '469.48', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '107500'),
(1076, '4', '18', '19', '17', '646.42', '226.25', '452.49', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '107600'),
(1077, '4', '18', '19', '18', '622.15', '217.75', '435.51', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '107700'),
(1078, '4', '18', '19', '19', '597.88', '209.26', '418.52', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '107800'),
(1079, '4', '18', '19', '20', '573.62', '200.77', '401.53', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '107900'),
(1080, '4', '18', '19', '21', '747.94', '261.78', '523.56', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '108000'),
(1081, '4', '18', '19', '22', '747.94', '261.78', '523.56', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '108100'),
(1082, '4', '18', '19', '23', '747.94', '261.78', '523.56', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '108200'),
(1083, '4', '18', '19', '24', '747.94', '261.78', '523.56', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '108300'),
(1084, '4', '18', '19', '25', '747.94', '261.78', '523.56', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '108400'),
(1085, '4', '18', '19', '26', '747.94', '261.78', '523.56', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '108500'),
(1086, '4', '18', '19', '27', '747.94', '261.78', '523.56', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '108600'),
(1087, '4', '18', '19', '28', '747.94', '261.78', '523.56', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '108700'),
(1088, '4', '18', '19', '29', '747.94', '261.78', '523.56', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '108800'),
(1089, '4', '18', '19', '30', '747.94', '261.78', '523.56', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '108900'),
(1090, '4', '18', '19', '31', '747.94', '261.78', '523.56', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '109000'),
(1091, '4', '18', '19', '32', '747.94', '261.78', '523.56', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '109100'),
(1092, '4', '18', '19', '33', '747.94', '261.78', '523.56', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '109200'),
(1093, '4', '18', '19', '34', '747.94', '261.78', '523.56', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '109300'),
(1094, '4', '18', '19', '35', '747.94', '261.78', '523.56', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '109400'),
(1095, '4', '18', '19', '36', '747.94', '261.78', '523.56', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '109500'),
(1096, '4', '18', '19', '37', '747.94', '261.78', '523.56', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '109600'),
(1097, '4', '18', '19', '38', '747.94', '261.78', '523.56', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '109700'),
(1098, '4', '18', '19', '39', '747.94', '261.78', '523.56', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '109800'),
(1099, '4', '18', '19', '40', '747.94', '261.78', '523.56', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '109900'),
(1100, '4', '18', '19', '41', '747.94', '261.78', '523.56', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '110000'),
(1101, '4', '18', '19', '42', '747.94', '261.78', '523.56', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '110100'),
(1102, '4', '18', '19', '43', '747.94', '261.78', '523.56', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '110200'),
(1103, '4', '18', '19', '44', '747.94', '261.78', '523.56', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '110300'),
(1104, '4', '18', '19', '45', '747.94', '261.78', '523.56', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '110400'),
(1105, '4', '18', '19', '46', '747.94', '261.78', '523.56', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '110500'),
(1106, '4', '18', '19', '47', '747.94', '261.78', '523.56', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '110600'),
(1107, '4', '18', '19', '48', '747.94', '261.78', '523.56', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '110700'),
(1108, '4', '18', '19', '49', '747.94', '261.78', '523.56', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '110800'),
(1109, '4', '18', '19', '50', '747.94', '261.78', '523.56', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '110900'),
(1110, '4', '18', '19', '51', '747.94', '261.78', '523.56', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '111000'),
(1111, '4', '18', '19', '52', '747.94', '261.78', '523.56', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '111100'),
(1112, '4', '18', '19', '53', '747.94', '261.78', '523.56', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '111200'),
(1113, '4', '18', '19', '54', '747.94', '261.78', '523.56', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '111300'),
(1114, '4', '18', '19', '55', '747.94', '261.78', '523.56', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '111400'),
(1115, '4', '18', '19', '56', '747.94', '261.78', '523.56', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '111500'),
(1116, '4', '18', '20', '1', '844.05', '295.42', '590.84', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '111600'),
(1117, '4', '18', '20', '2', '872.18', '305.26', '610.53', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '111700'),
(1118, '4', '18', '20', '3', '894.9', '313.22', '626.43', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '111800'),
(1119, '4', '18', '20', '4', '912.22', '319.28', '638.55', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '111900'),
(1120, '4', '18', '20', '5', '924.16', '323.46', '646.91', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '112000'),
(1121, '4', '18', '20', '6', '930.76', '325.77', '651.53', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '112100'),
(1122, '4', '18', '20', '7', '932', '326.2', '652.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '112200'),
(1123, '4', '18', '20', '8', '927.91', '324.77', '649.54', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '112300'),
(1124, '4', '18', '20', '9', '918.48', '321.47', '642.94', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '112400'),
(1125, '4', '18', '20', '10', '903.72', '316.3', '632.6', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '112500'),
(1126, '4', '18', '20', '11', '883.61', '309.26', '618.53', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '112600'),
(1127, '4', '18', '20', '12', '1,054.29', '369', '738', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '112700'),
(1128, '4', '18', '20', '13', '798.76', '279.57', '559.13', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '112800'),
(1129, '4', '18', '20', '14', '798.9', '279.62', '559.23', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '112900'),
(1130, '4', '18', '20', '15', '799.05', '279.67', '559.34', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '113000'),
(1131, '4', '18', '20', '16', '799.19', '279.72', '559.43', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '113100'),
(1132, '4', '18', '20', '17', '799.34', '279.77', '559.54', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '113200'),
(1133, '4', '18', '20', '18', '799.49', '279.82', '559.64', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '113300'),
(1134, '4', '18', '20', '19', '799.63', '279.87', '559.74', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '113400'),
(1135, '4', '18', '20', '20', '799.78', '279.92', '559.85', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '113500'),
(1136, '4', '18', '20', '21', '799.93', '279.98', '559.95', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '113600'),
(1137, '4', '18', '20', '22', '800.07', '280.02', '560.05', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '113700'),
(1138, '4', '18', '20', '23', '893.44', '312.7', '625.41', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '113800'),
(1139, '4', '18', '20', '24', '912.77', '319.47', '638.94', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '113900'),
(1140, '4', '18', '20', '25', '670', '234.5', '469', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '114000'),
(1141, '4', '18', '20', '26', '670', '234.5', '469', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '114100'),
(1142, '4', '18', '20', '27', '646.61', '226.31', '452.63', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '114200'),
(1143, '4', '18', '20', '28', '859.51', '300.83', '601.66', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '114300'),
(1144, '4', '18', '20', '29', '1,113.65', '389.78', '779.56', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '114400'),
(1145, '4', '18', '20', '30', '848.56', '297', '593.99', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '114500'),
(1146, '4', '18', '20', '31', '670', '234.5', '469', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '114600'),
(1147, '4', '18', '20', '32', '709.98', '248.49', '496.99', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '114700'),
(1148, '4', '18', '20', '33', '712.21', '249.27', '498.55', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '114800'),
(1149, '4', '18', '20', '34', '693.43', '242.7', '485.4', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '114900'),
(1150, '4', '18', '20', '35', '708.18', '247.86', '495.73', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '115000'),
(1151, '4', '18', '20', '36', '756.75', '264.86', '529.73', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '115100'),
(1152, '4', '18', '20', '37', '715.89', '250.56', '501.12', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '115200'),
(1153, '4', '18', '20', '38', '693.41', '242.69', '485.39', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '115300'),
(1154, '4', '18', '20', '39', '920.08', '322.03', '644.06', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '115400'),
(1155, '4', '18', '20', '40', '869.6', '304.36', '608.72', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '115500'),
(1156, '4', '18', '20', '41', '812.14', '284.25', '568.5', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '115600'),
(1157, '4', '18', '20', '42', '653.35', '228.67', '457.35', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '115700'),
(1158, '4', '18', '20', '43', '647.37', '226.58', '453.16', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '115800'),
(1159, '4', '18', '20', '44', '647.37', '226.58', '453.16', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '115900'),
(1160, '4', '18', '20', '45', '616.81', '215.88', '431.77', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '116000'),
(1161, '4', '18', '20', '46', '616.81', '215.88', '431.77', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '116100'),
(1162, '4', '18', '20', '47', '616.81', '215.88', '431.77', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '116200'),
(1163, '4', '18', '20', '48', '616.81', '215.88', '431.77', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '116300'),
(1164, '4', '18', '20', '49', '785.41', '274.89', '549.79', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '116400'),
(1165, '4', '18', '20', '50', '1,024.72', '358.65', '717.3', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '116500'),
(1166, '4', '18', '20', '51', '702.03', '245.71', '491.42', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '116600'),
(1167, '4', '18', '20', '52', '616.81', '215.88', '431.77', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '116700'),
(1168, '4', '18', '20', '53', '643.45', '225.21', '450.42', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '116800'),
(1169, '4', '18', '20', '54', '586.16', '205.16', '410.31', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '116900'),
(1170, '4', '19', '3', '1', '717.17', '251.01', '502.02', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '117000'),
(1171, '4', '19', '3', '2', '716.88', '250.91', '501.82', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '117100'),
(1172, '4', '19', '3', '3', '716.66', '250.83', '501.66', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '117200'),
(1173, '4', '19', '3', '4', '716.5', '250.78', '501.55', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '117300'),
(1174, '4', '19', '3', '5', '716.42', '250.75', '501.49', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '117400'),
(1175, '4', '19', '3', '6', '716.4', '250.74', '501.48', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '117500'),
(1176, '4', '19', '3', '7', '716.4', '250.74', '501.48', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '117600'),
(1177, '4', '19', '3', '8', '716.42', '250.75', '501.49', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '117700'),
(1178, '4', '19', '3', '9', '716.5', '250.78', '501.55', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '117800'),
(1179, '4', '19', '3', '10', '716.65', '250.83', '501.66', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '117900'),
(1180, '4', '19', '3', '11', '716.86', '250.9', '501.8', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '118000'),
(1181, '4', '19', '3', '12', '717.14', '251', '502', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '118100'),
(1182, '4', '19', '4', '1', '716.15', '250.65', '501.31', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '118200'),
(1183, '4', '19', '4', '2', '830.59', '290.71', '581.41', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '118300'),
(1184, '4', '19', '4', '3', '716.71', '250.85', '501.7', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '118400'),
(1185, '4', '19', '4', '4', '717.04', '250.96', '501.93', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '118500'),
(1186, '4', '19', '4', '5', '717.44', '251.1', '502.21', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '118600'),
(1187, '4', '19', '4', '6', '717.37', '251.08', '502.16', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '118700'),
(1188, '4', '19', '4', '7', '716.99', '250.95', '501.89', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '118800'),
(1189, '4', '19', '4', '8', '716.68', '250.84', '501.68', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '118900'),
(1190, '4', '19', '4', '9', '830.57', '290.7', '581.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '119000'),
(1191, '4', '19', '4', '10', '716.15', '250.65', '501.31', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '119100'),
(1192, '4', '19', '5', '1', '715.25', '250.34', '500.68', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '119200'),
(1193, '4', '19', '5', '2', '715.78', '250.52', '501.05', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '119300'),
(1194, '4', '19', '5', '3', '716.38', '250.73', '501.47', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '119400'),
(1195, '4', '19', '5', '4', '717.05', '250.97', '501.94', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '119500'),
(1196, '4', '19', '5', '5', '717.79', '251.23', '502.45', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '119600'),
(1197, '4', '19', '5', '6', '717.95', '251.28', '502.57', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '119700'),
(1198, '4', '19', '5', '7', '721.12', '252.39', '504.78', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '119800'),
(1199, '4', '19', '5', '8', '714.18', '249.96', '499.93', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '119900'),
(1200, '4', '19', '5', '9', '716.88', '250.91', '501.82', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '120000'),
(1201, '4', '19', '5', '10', '716.24', '250.68', '501.37', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '120100'),
(1202, '4', '19', '5', '11', '715.67', '250.48', '500.97', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '120200'),
(1203, '4', '19', '5', '12', '715.16', '250.31', '500.61', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '120300'),
(1204, '4', '19', '6', '1', '718.33', '251.42', '502.83', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '120400'),
(1205, '4', '19', '6', '2', '717.49', '251.12', '502.24', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '120500'),
(1206, '4', '19', '6', '3', '716.78', '250.87', '501.75', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '120600'),
(1207, '4', '19', '6', '4', '716.18', '250.66', '501.33', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '120700'),
(1208, '4', '19', '6', '5', '715.68', '250.49', '500.98', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '120800'),
(1209, '4', '19', '6', '6', '715.28', '250.35', '500.7', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '120900'),
(1210, '4', '19', '6', '7', '715.32', '250.36', '500.72', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '121000'),
(1211, '4', '19', '6', '8', '715.75', '250.51', '501.03', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '121100'),
(1212, '4', '19', '6', '9', '716.28', '250.7', '501.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '121200'),
(1213, '4', '19', '6', '10', '716.92', '250.92', '501.84', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '121300'),
(1214, '4', '19', '6', '11', '717.67', '251.18', '502.37', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '121400'),
(1215, '4', '19', '6', '12', '718.56', '251.5', '502.99', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '121500'),
(1216, '4', '19', '7', '1', '960.8', '336.28', '672.56', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '121600'),
(1217, '4', '19', '7', '2', '944.67', '330.63', '661.27', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '121700'),
(1218, '4', '19', '7', '3', '944.67', '330.63', '661.27', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '121800'),
(1219, '4', '19', '7', '4', '944.67', '330.63', '661.27', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '121900'),
(1220, '4', '19', '7', '5', '944.67', '330.63', '661.27', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '122000'),
(1221, '4', '19', '7', '6', '1,177.06', '411.97', '823.94', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '122100'),
(1222, '4', '19', '7', '7', '1,175.99', '411.6', '823.19', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '122200'),
(1223, '4', '19', '7', '8', '945.04', '330.76', '661.53', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '122300'),
(1224, '4', '19', '7', '9', '945.04', '330.76', '661.53', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '122400'),
(1225, '4', '19', '7', '10', '945.04', '330.76', '661.53', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '122500'),
(1226, '4', '19', '7', '11', '945.04', '330.76', '661.53', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '122600'),
(1227, '4', '19', '7', '12', '961.17', '336.41', '672.82', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '122700'),
(1228, '4', '19', '8', '1', '747.66', '261.68', '523.36', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '122800'),
(1229, '4', '19', '8', '2', '747.65', '261.68', '523.36', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '122900'),
(1230, '4', '19', '8', '3', '747.64', '261.67', '523.35', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '123000'),
(1231, '4', '19', '8', '4', '747.62', '261.67', '523.33', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '123100'),
(1232, '4', '19', '8', '5', '747.59', '261.66', '523.31', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '123200'),
(1233, '4', '19', '8', '6', '1,007.93', '352.78', '705.55', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '123300'),
(1234, '4', '19', '8', '7', '1,085.08', '379.78', '759.56', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '123400'),
(1235, '4', '19', '8', '8', '833.75', '291.81', '583.63', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '123500'),
(1236, '4', '19', '8', '9', '833.76', '291.82', '583.63', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '123600'),
(1237, '4', '19', '8', '10', '833.77', '291.82', '583.64', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '123700'),
(1238, '4', '19', '8', '11', '833.77', '291.82', '583.64', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '123800'),
(1239, '4', '19', '8', '12', '833.78', '291.82', '583.65', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '123900'),
(1240, '4', '19', '9', '1', '835.04', '292.26', '584.53', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '124000'),
(1241, '4', '19', '9', '2', '834.17', '291.96', '583.92', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '124100'),
(1242, '4', '19', '9', '3', '833.42', '291.7', '583.39', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '124200'),
(1243, '4', '19', '9', '4', '832.8', '291.48', '582.96', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '124300'),
(1244, '4', '19', '9', '5', '832.31', '291.31', '582.62', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '124400'),
(1245, '4', '19', '9', '6', '831.94', '291.18', '582.36', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '124500'),
(1246, '4', '19', '9', '7', '831.96', '291.19', '582.37', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '124600'),
(1247, '4', '19', '9', '8', '832.35', '291.32', '582.65', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '124700'),
(1248, '4', '19', '9', '9', '832.88', '291.51', '583.02', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '124800'),
(1249, '4', '19', '9', '10', '833.54', '291.74', '583.48', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '124900'),
(1250, '4', '19', '9', '11', '834.33', '292.02', '584.03', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '125000'),
(1251, '4', '19', '9', '12', '835.26', '292.34', '584.68', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '125100'),
(1252, '4', '19', '10', '1', '831.61', '291.06', '582.13', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '125200'),
(1253, '4', '19', '10', '2', '832.35', '291.32', '582.65', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '125300'),
(1254, '4', '19', '10', '3', '833.2', '291.62', '583.24', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '125400'),
(1255, '4', '19', '10', '4', '834.17', '291.96', '583.92', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '125500'),
(1256, '4', '19', '10', '5', '834.89', '292.21', '584.42', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '125600'),
(1257, '4', '19', '10', '6', '834', '291.9', '583.8', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '125700'),
(1258, '4', '19', '10', '7', '834.28', '292', '584', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '125800'),
(1259, '4', '19', '10', '8', '834.85', '292.2', '584.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '125900'),
(1260, '4', '19', '10', '9', '833.92', '291.87', '583.74', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '126000'),
(1261, '4', '19', '10', '10', '833', '291.55', '583.1', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '126100'),
(1262, '4', '19', '10', '11', '832.2', '291.27', '582.54', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '126200'),
(1263, '4', '19', '10', '12', '831.5', '291.03', '582.05', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '126300'),
(1264, '4', '19', '11', '1', '827.45', '289.61', '579.22', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '126400'),
(1265, '4', '19', '11', '2', '827.53', '289.64', '579.27', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '126500'),
(1266, '4', '19', '11', '3', '1,037.92', '363.27', '726.54', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '126600'),
(1267, '4', '19', '11', '4', '828.4', '289.94', '579.88', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '126700'),
(1268, '4', '19', '11', '5', '828.91', '290.12', '580.24', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '126800'),
(1269, '4', '19', '11', '6', '828.83', '290.09', '580.18', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '126900'),
(1270, '4', '19', '11', '7', '828.35', '289.92', '579.85', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '127000'),
(1271, '4', '19', '11', '8', '1,029.66', '360.38', '720.76', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '127100'),
(1272, '4', '19', '11', '9', '827.52', '289.63', '579.26', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '127200'),
(1273, '4', '19', '11', '10', '827.45', '289.61', '579.22', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '127300'),
(1274, '4', '19', '12', '1', '834.48', '292.07', '584.14', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '127400'),
(1275, '4', '19', '12', '2', '833.88', '291.86', '583.72', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '127500'),
(1276, '4', '19', '12', '3', '833.39', '291.69', '583.37', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '127600'),
(1277, '4', '19', '12', '4', '833.02', '291.56', '583.11', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '127700'),
(1278, '4', '19', '12', '5', '832.76', '291.47', '582.93', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '127800'),
(1279, '4', '19', '12', '6', '832.61', '291.41', '582.83', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '127900'),
(1280, '4', '19', '12', '7', '832.6', '291.41', '582.82', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '128000'),
(1281, '4', '19', '12', '8', '832.75', '291.46', '582.93', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '128100'),
(1282, '4', '19', '12', '9', '832.99', '291.55', '583.09', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '128200'),
(1283, '4', '19', '12', '10', '833.35', '291.67', '583.35', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '128300'),
(1284, '4', '19', '12', '11', '833.23', '291.63', '583.26', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '128400'),
(1285, '4', '19', '12', '12', '833.47', '291.71', '583.43', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '128500'),
(1286, '4', '21', '5', '1', '671.04', '234.86', '469.73', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '128600'),
(1287, '4', '21', '5', '2', '670.56', '234.7', '469.39', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '128700'),
(1288, '4', '21', '5', '3', '670.14', '234.55', '469.1', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '128800'),
(1289, '4', '21', '5', '4', '669.79', '234.43', '468.85', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '128900'),
(1290, '4', '21', '5', '5', '669.51', '234.33', '468.66', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '129000'),
(1291, '4', '21', '5', '6', '669.29', '234.25', '468.5', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '129100'),
(1292, '4', '21', '5', '7', '669.14', '234.2', '468.4', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '129200'),
(1293, '4', '21', '5', '8', '669.06', '234.17', '468.34', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '129300'),
(1294, '4', '21', '5', '9', '669.04', '234.16', '468.33', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '129400'),
(1295, '4', '21', '5', '10', '669.09', '234.18', '468.36', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '129500'),
(1296, '4', '21', '5', '11', '669.05', '234.17', '468.34', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '129600'),
(1297, '4', '21', '5', '12', '669.17', '234.21', '468.42', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '129700'),
(1298, '4', '21', '5', '13', '669.42', '234.3', '468.59', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '129800'),
(1299, '4', '21', '5', '14', '669.79', '234.43', '468.85', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '129900'),
(1300, '4', '21', '5', '15', '670.28', '234.6', '469.2', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '130000'),
(1301, '4', '21', '5', '16', '670.9', '234.82', '469.63', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '130100'),
(1302, '4', '21', '5', '17', '671.04', '234.86', '469.73', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '130200'),
(1303, '4', '21', '5', '18', '670.4', '234.64', '469.28', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '130300'),
(1304, '4', '21', '5', '19', '669.87', '234.45', '468.91', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '130400'),
(1305, '4', '21', '5', '20', '669.43', '234.3', '468.6', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '130500'),
(1306, '4', '21', '5', '21', '669.1', '234.19', '468.37', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '130600'),
(1307, '4', '21', '5', '22', '668.86', '234.1', '468.2', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '130700'),
(1308, '4', '21', '5', '23', '668.72', '234.05', '468.1', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '130800'),
(1309, '4', '21', '5', '24', '669.04', '234.16', '468.33', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '130900'),
(1310, '4', '21', '5', '25', '669.06', '234.17', '468.34', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '131000'),
(1311, '4', '21', '5', '26', '669.14', '234.2', '468.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '131100'),
(1312, '4', '21', '5', '27', '669.28', '234.25', '468.5', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '131200'),
(1313, '4', '21', '5', '28', '669.49', '234.32', '468.64', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '131300'),
(1314, '4', '21', '5', '29', '669.76', '234.42', '468.83', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '131400'),
(1315, '4', '21', '5', '30', '670.1', '234.54', '469.07', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '131500'),
(1316, '4', '21', '5', '31', '670.49', '234.67', '469.34', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '131600'),
(1317, '4', '21', '5', '32', '670.96', '234.84', '469.67', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '131700'),
(1318, '4', '21', '5', '33', '1,814.91', '635.22', '1,270.44', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '131800'),
(1319, '4', '21', '5', '34', '1,029.26', '360.24', '720.48', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '131900'),
(1320, '4', '21', '5', '35', '916.57', '320.8', '641.6', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '132000'),
(1321, '4', '21', '5', '36', '857.14', '300', '600', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '132100'),
(1322, '4', '21', '5', '37', '785.92', '275.07', '550.14', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '132200'),
(1323, '4', '21', '5', '38', '719.28', '251.75', '503.5', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '132300'),
(1324, '4', '21', '5', '39', '657.2', '230.02', '460.04', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '132400'),
(1325, '4', '21', '5', '40', '599.65', '209.88', '419.76', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '132500'),
(1326, '4', '21', '5', '41', '1,044.69', '365.64', '731.28', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '132600'),
(1327, '4', '21', '5', '42', '865.85', '303.05', '606.1', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '132700'),
(1328, '4', '21', '5', '43', '697.93', '244.28', '488.55', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '132800'),
(1329, '4', '21', '5', '44', '814.11', '284.94', '569.88', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '132900'),
(1330, '4', '23', '3', '1', '768.78', '269.07', '538.15', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '133000'),
(1331, '4', '23', '3', '2', '770.5', '269.68', '539.35', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '133100'),
(1332, '4', '23', '3', '3', '772.81', '270.48', '540.97', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '133200'),
(1333, '4', '23', '3', '4', '770.57', '269.7', '539.4', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '133300'),
(1334, '4', '23', '3', '5', '1,275.76', '446.52', '893.03', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '133400'),
(1335, '4', '23', '3', '6', '1,277.09', '446.98', '893.96', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '133500'),
(1336, '4', '23', '3', '7', '768.74', '269.06', '538.12', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '133600'),
(1337, '4', '23', '3', '8', '771.28', '269.95', '539.9', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '133700'),
(1338, '4', '23', '3', '9', '772.73', '270.46', '540.91', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '133800'),
(1339, '4', '23', '3', '10', '770.52', '269.68', '539.36', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '133900'),
(1340, '4', '23', '4', '1', '836.79', '292.88', '585.75', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '134000'),
(1341, '4', '23', '4', '2', '835.06', '292.27', '584.54', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '134100'),
(1342, '4', '23', '4', '3', '833.54', '291.74', '583.48', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '134200'),
(1343, '4', '23', '4', '4', '832.22', '291.28', '582.55', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '134300'),
(1344, '4', '23', '4', '5', '831.09', '290.88', '581.76', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '134400'),
(1345, '4', '23', '4', '6', '830.17', '290.56', '581.12', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '134500'),
(1346, '4', '23', '4', '7', '830.31', '290.61', '581.22', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '134600'),
(1347, '4', '23', '4', '8', '831.31', '290.96', '581.92', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '134700'),
(1348, '4', '23', '4', '9', '832.52', '291.38', '582.76', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '134800'),
(1349, '4', '23', '4', '10', '833.95', '291.88', '583.77', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '134900'),
(1350, '4', '23', '4', '11', '835.59', '292.46', '584.91', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '135000'),
(1351, '4', '23', '4', '12', '837.46', '293.11', '586.22', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '135100'),
(1352, '4', '23', '5', '1', '834.02', '291.91', '583.81', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '135200');
INSERT INTO `lotes` (`id_lote`, `fase`, `super_manzana`, `mza`, `lote`, `m2`, `cos`, `cus`, `uso`, `id_tipo_lote`, `fecha_entrega`, `disponibilidad`, `precio_lista`) VALUES
(1353, '4', '23', '5', '2', '833.48', '291.72', '583.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '135300'),
(1354, '4', '23', '5', '3', '833.14', '291.6', '583.2', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '135400'),
(1355, '4', '23', '5', '4', '832.99', '291.55', '583.09', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '135500'),
(1356, '4', '23', '5', '5', '833.03', '291.56', '583.12', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '135600'),
(1357, '4', '23', '5', '6', '833.27', '291.64', '583.29', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '135700'),
(1358, '4', '23', '5', '7', '833.29', '291.65', '583.3', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '135800'),
(1359, '4', '23', '5', '8', '833.03', '291.56', '583.12', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '135900'),
(1360, '4', '23', '5', '9', '832.99', '291.55', '583.09', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '136000'),
(1361, '4', '23', '5', '10', '833.15', '291.6', '583.21', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '136100'),
(1362, '4', '23', '5', '11', '833.52', '291.73', '583.46', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '136200'),
(1363, '4', '23', '5', '12', '834.1', '291.94', '583.87', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '136300'),
(1364, '4', '23', '8', '1', '716.38', '250.73', '501.47', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '136400'),
(1365, '4', '23', '8', '2', '716.34', '250.72', '501.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '136500'),
(1366, '4', '23', '8', '3', '716.41', '250.74', '501.49', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '136600'),
(1367, '4', '23', '8', '4', '716.59', '250.81', '501.61', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '136700'),
(1368, '4', '23', '8', '5', '716.89', '250.91', '501.82', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '136800'),
(1369, '4', '23', '8', '6', '717.31', '251.06', '502.12', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '136900'),
(1370, '4', '23', '8', '7', '521.31', '182.46', '364.92', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '137000'),
(1371, '4', '23', '8', '8', '604.36', '211.53', '423.05', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '137100'),
(1372, '4', '23', '8', '9', '716.61', '250.81', '501.63', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '137200'),
(1373, '4', '23', '8', '10', '716.41', '250.74', '501.49', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '137300'),
(1374, '4', '23', '8', '11', '716.34', '250.72', '501.44', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '137400'),
(1375, '4', '23', '8', '12', '716.39', '250.74', '501.47', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '137500'),
(1376, '4', '23', '9', '1', '718.08', '251.33', '502.66', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '137600'),
(1377, '4', '23', '9', '2', '717.33', '251.07', '502.13', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '137700'),
(1378, '4', '23', '9', '3', '716.71', '250.85', '501.7', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '137800'),
(1379, '4', '23', '9', '4', '716.2', '250.67', '501.34', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '137900'),
(1380, '4', '23', '9', '5', '715.8', '250.53', '501.06', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '138000'),
(1381, '4', '23', '9', '6', '715.53', '250.44', '500.87', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '138100'),
(1382, '4', '23', '9', '7', '715.54', '250.44', '500.88', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '138200'),
(1383, '4', '23', '9', '8', '715.84', '250.54', '501.09', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '138300'),
(1384, '4', '23', '9', '9', '716.26', '250.69', '501.38', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '138400'),
(1385, '4', '23', '9', '10', '716.8', '250.88', '501.76', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '138500'),
(1386, '4', '23', '9', '11', '717.47', '251.11', '502.23', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '138600'),
(1387, '4', '23', '9', '12', '718.27', '251.39', '502.79', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '138700'),
(1388, '4', '23', '10', '1', '827.46', '289.61', '579.22', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '138800'),
(1389, '4', '23', '10', '2', '716.81', '250.88', '501.77', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '138900'),
(1390, '4', '23', '10', '3', '715.6', '250.46', '500.92', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '139000'),
(1391, '4', '23', '10', '4', '714.51', '250.08', '500.16', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '139100'),
(1392, '4', '23', '10', '5', '713.55', '249.74', '499.49', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '139200'),
(1393, '4', '23', '10', '6', '713.8', '249.83', '499.66', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '139300'),
(1394, '4', '23', '10', '7', '714.83', '250.19', '500.38', 'HABITACIONAL', 3, 'BLOQUEADO', 'BLOQUEADO', '139400'),
(1395, '4', '23', '10', '8', '716', '250.6', '501.2', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '139500'),
(1396, '4', '23', '10', '9', '717.29', '251.05', '502.1', 'HABITACIONAL', 2, 'BLOQUEADO', 'BLOQUEADO', '139600'),
(1397, '4', '23', '10', '10', '828.13', '289.85', '579.69', 'HABITACIONAL', 1, 'BLOQUEADO', 'BLOQUEADO', '139700');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes_contrato`
--

CREATE TABLE `lotes_contrato` (
  `id_lote_contrato` int(11) NOT NULL,
  `id_lote` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lotes_contrato`
--

INSERT INTO `lotes_contrato` (`id_lote_contrato`, `id_lote`, `id_contrato`) VALUES
(1, 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `fecha_pago` date NOT NULL,
  `mensualidad` varchar(50) NOT NULL,
  `monto_pagado` varchar(50) NOT NULL,
  `diferencia` varchar(50) NOT NULL,
  `id_estatus_pago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id_pago`, `id_cliente`, `id_contrato`, `fecha_pago`, `mensualidad`, `monto_pagado`, `diferencia`, `id_estatus_pago`) VALUES
(1, 1, 2, '2023-01-25', '1', '7000', '', 2),
(2, 1, 2, '2023-02-25', '2', '10000', '2000', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cat_estatus_pago`
--
ALTER TABLE `cat_estatus_pago`
  ADD PRIMARY KEY (`id_estatus_pago`);

--
-- Indices de la tabla `cat_estatus_venta`
--
ALTER TABLE `cat_estatus_venta`
  ADD PRIMARY KEY (`id_estatus_venta`);

--
-- Indices de la tabla `cat_tipo_compra`
--
ALTER TABLE `cat_tipo_compra`
  ADD PRIMARY KEY (`id_tipo_compra`);

--
-- Indices de la tabla `cat_tipo_lote`
--
ALTER TABLE `cat_tipo_lote`
  ADD PRIMARY KEY (`id_tipo_lote`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `cliente_contrato`
--
ALTER TABLE `cliente_contrato`
  ADD PRIMARY KEY (`id_cliente_contrato`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_contrato` (`id_contrato`);

--
-- Indices de la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`id_contrato`),
  ADD KEY `id_estatus_venta` (`id_estatus_venta`),
  ADD KEY `id_tipo_compra` (`id_tipo_compra`);

--
-- Indices de la tabla `cuentas_usuario`
--
ALTER TABLE `cuentas_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD PRIMARY KEY (`id_lote`),
  ADD KEY `id_tipo_lote` (`id_tipo_lote`);

--
-- Indices de la tabla `lotes_contrato`
--
ALTER TABLE `lotes_contrato`
  ADD PRIMARY KEY (`id_lote_contrato`),
  ADD KEY `id_lote` (`id_lote`),
  ADD KEY `id_contrato` (`id_contrato`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_contrato` (`id_contrato`),
  ADD KEY `id_estatus_paga` (`id_estatus_pago`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cat_estatus_pago`
--
ALTER TABLE `cat_estatus_pago`
  MODIFY `id_estatus_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cat_estatus_venta`
--
ALTER TABLE `cat_estatus_venta`
  MODIFY `id_estatus_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cat_tipo_compra`
--
ALTER TABLE `cat_tipo_compra`
  MODIFY `id_tipo_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cat_tipo_lote`
--
ALTER TABLE `cat_tipo_lote`
  MODIFY `id_tipo_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cliente_contrato`
--
ALTER TABLE `cliente_contrato`
  MODIFY `id_cliente_contrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `contrato`
--
ALTER TABLE `contrato`
  MODIFY `id_contrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cuentas_usuario`
--
ALTER TABLE `cuentas_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `lotes`
--
ALTER TABLE `lotes`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1398;

--
-- AUTO_INCREMENT de la tabla `lotes_contrato`
--
ALTER TABLE `lotes_contrato`
  MODIFY `id_lote_contrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente_contrato`
--
ALTER TABLE `cliente_contrato`
  ADD CONSTRAINT `cliente_contrato_ibfk_1` FOREIGN KEY (`id_contrato`) REFERENCES `contrato` (`id_contrato`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cliente_contrato_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `contrato_ibfk_2` FOREIGN KEY (`id_estatus_venta`) REFERENCES `cat_estatus_venta` (`id_estatus_venta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contrato_ibfk_4` FOREIGN KEY (`id_tipo_compra`) REFERENCES `cat_tipo_compra` (`id_tipo_compra`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD CONSTRAINT `lotes_ibfk_1` FOREIGN KEY (`id_tipo_lote`) REFERENCES `cat_tipo_lote` (`id_tipo_lote`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lotes_contrato`
--
ALTER TABLE `lotes_contrato`
  ADD CONSTRAINT `lotes_contrato_ibfk_1` FOREIGN KEY (`id_contrato`) REFERENCES `contrato` (`id_contrato`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lotes_contrato_ibfk_2` FOREIGN KEY (`id_lote`) REFERENCES `lotes` (`id_lote`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pagos_ibfk_2` FOREIGN KEY (`id_contrato`) REFERENCES `contrato` (`id_contrato`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pagos_ibfk_3` FOREIGN KEY (`id_estatus_pago`) REFERENCES `cat_estatus_pago` (`id_estatus_pago`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
