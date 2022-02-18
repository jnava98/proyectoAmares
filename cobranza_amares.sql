-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-02-2022 a las 02:22:40
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.4.15

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
-- Estructura de tabla para la tabla `cat_descuento`
--

CREATE TABLE `cat_descuento` (
  `id_descuento` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tasa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_estatus_pago`
--

CREATE TABLE `cat_estatus_pago` (
  `id_estatus_pago` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_estatus_venta`
--

CREATE TABLE `cat_estatus_venta` (
  `id_estatus_venta` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_tipo_compra`
--

CREATE TABLE `cat_tipo_compra` (
  `id_tipo_compra` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_tipo_lote`
--

CREATE TABLE `cat_tipo_lote` (
  `id_tipo_lote` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido_paterno` varchar(50) NOT NULL,
  `apellido materno` varchar(50) NOT NULL,
  `residencia` varchar(50) NOT NULL,
  `nacionalidad` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(13) NOT NULL,
  `estado_civil` varchar(50) NOT NULL,
  `act_economica` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `id_lote` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_estatus_venta` int(11) NOT NULL,
  `dia_pago` varchar(50) NOT NULL,
  `id_descuento` int(11) NOT NULL,
  `nombre_broker` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `id_tipo_lote` varchar(50) NOT NULL,
  `fecha_entrega` varchar(50) NOT NULL,
  `disponibilidad` varchar(50) NOT NULL,
  `precio_lista` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `id_estatus_paga` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cat_descuento`
--
ALTER TABLE `cat_descuento`
  ADD PRIMARY KEY (`id_descuento`);

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
-- Indices de la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`id_contrato`);

--
-- Indices de la tabla `cuentas_usuario`
--
ALTER TABLE `cuentas_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `lotes`
--
ALTER TABLE `lotes`
  ADD PRIMARY KEY (`id_lote`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cat_descuento`
--
ALTER TABLE `cat_descuento`
  MODIFY `id_descuento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cat_estatus_pago`
--
ALTER TABLE `cat_estatus_pago`
  MODIFY `id_estatus_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cat_estatus_venta`
--
ALTER TABLE `cat_estatus_venta`
  MODIFY `id_estatus_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cat_tipo_compra`
--
ALTER TABLE `cat_tipo_compra`
  MODIFY `id_tipo_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cat_tipo_lote`
--
ALTER TABLE `cat_tipo_lote`
  MODIFY `id_tipo_lote` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contrato`
--
ALTER TABLE `contrato`
  MODIFY `id_contrato` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuentas_usuario`
--
ALTER TABLE `cuentas_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `lotes`
--
ALTER TABLE `lotes`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
