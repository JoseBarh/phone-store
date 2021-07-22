-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-01-2021 a las 06:52:04
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_dcell`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_inventario_accesorios`
--

CREATE TABLE `t_inventario_accesorios` (
  `IDAccesorio` int(10) NOT NULL,
  `IDProvedor` int(10) NOT NULL,
  `Modelo` varchar(50) NOT NULL,
  `Producto` int(10) NOT NULL,
  `FechaEntrada` date NOT NULL,
  `PrecioCosto` int(11) NOT NULL,
  `PrecioVenta` int(11) NOT NULL,
  `Existencias` int(11) NOT NULL,
  `Detalles` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_inventario_celular`
--

CREATE TABLE `t_inventario_celular` (
  `IDCelular` int(11) NOT NULL,
  `IDProvedor` int(11) NOT NULL,
  `Modelo` varchar(100) NOT NULL,
  `Producto` int(11) NOT NULL,
  `FechaEntrada` date NOT NULL,
  `PrecioCosto` int(11) NOT NULL,
  `PrecioVenta` int(11) NOT NULL,
  `Existencias` int(11) NOT NULL,
  `Detalles` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_provedor`
--

CREATE TABLE `t_provedor` (
  `IDProvedores` int(10) NOT NULL,
  `Empresa` varchar(100) NOT NULL,
  `RTN` varchar(100) NOT NULL,
  `Telefono` varchar(100) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Correo` varchar(100) NOT NULL,
  `SitioWeb` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_registro_venta_accesorios`
--

CREATE TABLE `t_registro_venta_accesorios` (
  `IDVentaAccesorio` int(10) NOT NULL,
  `IDAccesorio` int(10) NOT NULL,
  `IDUsuario` int(10) NOT NULL,
  `TipoPago` int(10) NOT NULL,
  `FechaSalida` date NOT NULL,
  `CantidadVendida` int(11) NOT NULL,
  `Garantia` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_registro_venta_celular`
--

CREATE TABLE `t_registro_venta_celular` (
  `IDVentaCelular` int(10) NOT NULL,
  `IDCelular` int(10) NOT NULL,
  `IDUsuario` int(10) NOT NULL,
  `TipoPago` int(10) NOT NULL,
  `FechaSalida` date NOT NULL,
  `CantidadVendida` int(11) NOT NULL,
  `Garantia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_roles`
--

CREATE TABLE `t_roles` (
  `IDRol` int(10) NOT NULL,
  `Rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tipo_accesorio`
--

CREATE TABLE `t_tipo_accesorio` (
  `IDTipoAccesorio` int(10) NOT NULL,
  `Tipo_Accesorio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tipo_celular`
--

CREATE TABLE `t_tipo_celular` (
  `IDTipoCelular` int(10) NOT NULL,
  `Tipo_Celular` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tipo_genero`
--

CREATE TABLE `t_tipo_genero` (
  `IDGenero` int(10) NOT NULL,
  `Genero` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tipo_pago`
--

CREATE TABLE `t_tipo_pago` (
  `IDTipoPago` int(10) NOT NULL,
  `TipoPago` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_usuarios`
--

CREATE TABLE `t_usuarios` (
  `IDUsuarios` int(10) NOT NULL,
  `IDRol` int(10) DEFAULT '2',
  `Nombre` varchar(200) NOT NULL,
  `Telefono` varchar(50) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Genero` int(10) NOT NULL,
  `Correo` varchar(200) NOT NULL,
  `Contrasena` varchar(50) NOT NULL,
  `code` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `t_inventario_accesorios`
--
ALTER TABLE `t_inventario_accesorios`
  ADD PRIMARY KEY (`IDAccesorio`),
  ADD KEY `Producto` (`Producto`),
  ADD KEY `IDProvedor` (`IDProvedor`);

--
-- Indices de la tabla `t_inventario_celular`
--
ALTER TABLE `t_inventario_celular`
  ADD PRIMARY KEY (`IDCelular`),
  ADD KEY `IDProvedor` (`IDProvedor`),
  ADD KEY `Producto` (`Producto`);

--
-- Indices de la tabla `t_provedor`
--
ALTER TABLE `t_provedor`
  ADD PRIMARY KEY (`IDProvedores`);

--
-- Indices de la tabla `t_registro_venta_accesorios`
--
ALTER TABLE `t_registro_venta_accesorios`
  ADD PRIMARY KEY (`IDVentaAccesorio`),
  ADD KEY `IDAccesorio` (`IDAccesorio`),
  ADD KEY `IDCliente` (`IDUsuario`),
  ADD KEY `TipoPago` (`TipoPago`);

--
-- Indices de la tabla `t_registro_venta_celular`
--
ALTER TABLE `t_registro_venta_celular`
  ADD PRIMARY KEY (`IDVentaCelular`),
  ADD KEY `IDCelular` (`IDCelular`),
  ADD KEY `TipoPago` (`TipoPago`),
  ADD KEY `IDUsuario` (`IDUsuario`);

--
-- Indices de la tabla `t_roles`
--
ALTER TABLE `t_roles`
  ADD PRIMARY KEY (`IDRol`);

--
-- Indices de la tabla `t_tipo_accesorio`
--
ALTER TABLE `t_tipo_accesorio`
  ADD PRIMARY KEY (`IDTipoAccesorio`);

--
-- Indices de la tabla `t_tipo_celular`
--
ALTER TABLE `t_tipo_celular`
  ADD PRIMARY KEY (`IDTipoCelular`);

--
-- Indices de la tabla `t_tipo_genero`
--
ALTER TABLE `t_tipo_genero`
  ADD PRIMARY KEY (`IDGenero`);

--
-- Indices de la tabla `t_tipo_pago`
--
ALTER TABLE `t_tipo_pago`
  ADD PRIMARY KEY (`IDTipoPago`);

--
-- Indices de la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  ADD PRIMARY KEY (`IDUsuarios`),
  ADD KEY `IDRol` (`IDRol`),
  ADD KEY `Genero` (`Genero`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `t_inventario_accesorios`
--
ALTER TABLE `t_inventario_accesorios`
  MODIFY `IDAccesorio` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_inventario_celular`
--
ALTER TABLE `t_inventario_celular`
  MODIFY `IDCelular` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_provedor`
--
ALTER TABLE `t_provedor`
  MODIFY `IDProvedores` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_registro_venta_accesorios`
--
ALTER TABLE `t_registro_venta_accesorios`
  MODIFY `IDVentaAccesorio` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_registro_venta_celular`
--
ALTER TABLE `t_registro_venta_celular`
  MODIFY `IDVentaCelular` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_roles`
--
ALTER TABLE `t_roles`
  MODIFY `IDRol` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_tipo_accesorio`
--
ALTER TABLE `t_tipo_accesorio`
  MODIFY `IDTipoAccesorio` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_tipo_celular`
--
ALTER TABLE `t_tipo_celular`
  MODIFY `IDTipoCelular` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_tipo_genero`
--
ALTER TABLE `t_tipo_genero`
  MODIFY `IDGenero` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_tipo_pago`
--
ALTER TABLE `t_tipo_pago`
  MODIFY `IDTipoPago` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  MODIFY `IDUsuarios` int(10) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_inventario_accesorios`
--
ALTER TABLE `t_inventario_accesorios`
  ADD CONSTRAINT `FK_t_inventario_accesorios_t_provedor` FOREIGN KEY (`IDProvedor`) REFERENCES `t_provedor` (`IDProvedores`),
  ADD CONSTRAINT `FK_t_inventario_accesorios_t_tipo_accesorio` FOREIGN KEY (`Producto`) REFERENCES `t_tipo_accesorio` (`IDTipoAccesorio`);

--
-- Filtros para la tabla `t_inventario_celular`
--
ALTER TABLE `t_inventario_celular`
  ADD CONSTRAINT `FK_t_inventario_celular_t_provedor` FOREIGN KEY (`IDProvedor`) REFERENCES `t_provedor` (`IDProvedores`),
  ADD CONSTRAINT `FK_t_inventario_celular_t_tipo_celular` FOREIGN KEY (`Producto`) REFERENCES `t_tipo_celular` (`IDTipoCelular`);

--
-- Filtros para la tabla `t_registro_venta_accesorios`
--
ALTER TABLE `t_registro_venta_accesorios`
  ADD CONSTRAINT `FK_t_registro_venta_accesorios_t_inventario_accesorios` FOREIGN KEY (`IDAccesorio`) REFERENCES `t_inventario_accesorios` (`IDAccesorio`),
  ADD CONSTRAINT `FK_t_registro_venta_accesorios_t_tipo_pago` FOREIGN KEY (`TipoPago`) REFERENCES `t_tipo_pago` (`IDTipoPago`),
  ADD CONSTRAINT `FK_t_registro_venta_accesorios_t_usuarios` FOREIGN KEY (`IDUsuario`) REFERENCES `t_usuarios` (`IDUsuarios`);

--
-- Filtros para la tabla `t_registro_venta_celular`
--
ALTER TABLE `t_registro_venta_celular`
  ADD CONSTRAINT `FK_t_registro_venta_celular_t_inventario_celular` FOREIGN KEY (`IDCelular`) REFERENCES `t_inventario_celular` (`IDCelular`),
  ADD CONSTRAINT `FK_t_registro_venta_celular_t_tipo_pago` FOREIGN KEY (`TipoPago`) REFERENCES `t_tipo_pago` (`IDTipoPago`),
  ADD CONSTRAINT `FK_t_registro_venta_celular_t_usuarios` FOREIGN KEY (`IDUsuario`) REFERENCES `t_usuarios` (`IDUsuarios`);

--
-- Filtros para la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  ADD CONSTRAINT `FK_t_usuarios_t_roles` FOREIGN KEY (`IDRol`) REFERENCES `t_roles` (`IDRol`),
  ADD CONSTRAINT `FK_t_usuarios_t_tipo_genero` FOREIGN KEY (`Genero`) REFERENCES `t_tipo_genero` (`IDGenero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
