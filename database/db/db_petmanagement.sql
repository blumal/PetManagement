-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-03-2022 a las 19:21:41
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_petmanagement`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_animales_perdidos`
--

CREATE TABLE `tbl_animales_perdidos` (
  `id_ape` int(11) NOT NULL,
  `nombre_ape` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion_ape` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_perdida_ape` date DEFAULT NULL,
  `id_usuario_fk` int(11) DEFAULT NULL,
  `direcicon_perdida_ape` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto_ape` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_estado_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_articulo_tienda`
--

CREATE TABLE `tbl_articulo_tienda` (
  `id_art` int(11) NOT NULL,
  `nombre_art` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precio_art` decimal(6,2) DEFAULT NULL,
  `codigobarras_art` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_foto_fk` int(11) DEFAULT NULL,
  `id_marca_fk` int(11) DEFAULT NULL,
  `id_tipo_articulo_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detallefactura_clinica`
--

CREATE TABLE `tbl_detallefactura_clinica` (
  `id_dfc` int(11) NOT NULL,
  `cant_dfc` int(3) DEFAULT NULL,
  `id_producto_fk` int(11) DEFAULT NULL,
  `id_factura_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detallefactura_tienda`
--

CREATE TABLE `tbl_detallefactura_tienda` (
  `id_dft` int(11) NOT NULL,
  `id_articulo_fk` int(11) DEFAULT NULL,
  `cantidad_dft` int(3) DEFAULT NULL,
  `id_factura_tienda_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_direccion`
--

CREATE TABLE `tbl_direccion` (
  `id_di` int(11) NOT NULL,
  `nombre_di` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero_di` int(3) DEFAULT NULL,
  `bloque_di` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `piso_di` int(2) DEFAULT NULL,
  `puerta_di` int(2) DEFAULT NULL,
  `cp_di` char(5) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado`
--

CREATE TABLE `tbl_estado` (
  `id_est` int(11) NOT NULL,
  `estado_est` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_factura_clinica`
--

CREATE TABLE `tbl_factura_clinica` (
  `id_fc` int(11) NOT NULL,
  `id_usuario_fk` int(11) DEFAULT NULL,
  `id_visita_fk` int(11) DEFAULT NULL,
  `id_promocion_fk` int(11) DEFAULT NULL,
  `total_fc` decimal(8,2) DEFAULT NULL,
  `fecha_fc` date DEFAULT NULL,
  `hora_fc` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_factura_tienda`
--

CREATE TABLE `tbl_factura_tienda` (
  `id_ft` int(11) NOT NULL,
  `fecha_ft` date DEFAULT NULL,
  `hora_ft` time DEFAULT NULL,
  `total_ft` decimal(8,2) DEFAULT NULL,
  `id_promocion_fk` int(11) DEFAULT NULL,
  `id_usuario_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_foto`
--

CREATE TABLE `tbl_foto` (
  `id_f` int(11) NOT NULL,
  `foto_f` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_marca`
--

CREATE TABLE `tbl_marca` (
  `id_ma` int(11) NOT NULL,
  `marca_ma` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pacienteanimal_clinica`
--

CREATE TABLE `tbl_pacienteanimal_clinica` (
  `id_pa` int(11) NOT NULL,
  `nombre_pa` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `peso_pa` decimal(3,1) DEFAULT NULL,
  `n_id_nacional` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto_pa` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `propietario_fk` int(11) DEFAULT NULL,
  `nombrecientifico_pa` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `raza_pa` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre_cientifico_pa` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_producto_clinica`
--

CREATE TABLE `tbl_producto_clinica` (
  `id_prod` int(11) NOT NULL,
  `producto_pro` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precio_pro` decimal(8,2) DEFAULT NULL,
  `codigobarras_pro` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_tipo_producto_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_promocion`
--

CREATE TABLE `tbl_promocion` (
  `id_pro` int(11) NOT NULL,
  `promocion_pro` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `porcentaje_pro` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_rol`
--

CREATE TABLE `tbl_rol` (
  `id_ro` int(11) NOT NULL,
  `rol_ro` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_sociedad`
--

CREATE TABLE `tbl_sociedad` (
  `id_s` int(11) NOT NULL,
  `nombre_s` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nif_s` char(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_s` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass_s` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_usuario_fk` int(11) DEFAULT NULL,
  `id_tipo_sociedad_fk` int(11) DEFAULT NULL,
  `id_direccion_fk` int(11) DEFAULT NULL,
  `id_telefono_fk` int(11) DEFAULT NULL,
  `horario_apertura_s` time DEFAULT NULL,
  `horario_cierre_s` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_stock`
--

CREATE TABLE `tbl_stock` (
  `id_st` int(11) NOT NULL,
  `id_articulo_fk` int(11) DEFAULT NULL,
  `cantidad_st` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_telefono`
--

CREATE TABLE `tbl_telefono` (
  `id_tel` int(11) NOT NULL,
  `contacto1_tel` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contacto2_tel` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_articulo`
--

CREATE TABLE `tbl_tipo_articulo` (
  `id_ta` int(11) NOT NULL,
  `tipo_articulo_ta` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_sociedad`
--

CREATE TABLE `tbl_tipo_sociedad` (
  `id_ts` int(11) NOT NULL,
  `sociedad_ts` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `id_us` int(11) NOT NULL,
  `nombre_us` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido1_us` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido2_us` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dni_us` char(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_us` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass_us` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_rol_fk` int(11) DEFAULT NULL,
  `id_telefono_fk` int(11) DEFAULT NULL,
  `id_direccion1_fk` int(11) DEFAULT NULL,
  `id_direccion2_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_visita`
--

CREATE TABLE `tbl_visita` (
  `id_vi` int(11) NOT NULL,
  `fecha_vi` date DEFAULT NULL,
  `hora_vi` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `asunto_vi` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `diagnostico_vi` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_pacienteanimal_fk` int(11) DEFAULT NULL,
  `id_usuario_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_animales_perdidos`
--
ALTER TABLE `tbl_animales_perdidos`
  ADD PRIMARY KEY (`id_ape`),
  ADD KEY `fk_animales_perdidos_usuario_idx` (`id_usuario_fk`),
  ADD KEY `fk_animales_perdidos_estado_idx` (`id_estado_fk`);

--
-- Indices de la tabla `tbl_articulo_tienda`
--
ALTER TABLE `tbl_articulo_tienda`
  ADD PRIMARY KEY (`id_art`),
  ADD KEY `fk_articulo_foto_idx` (`id_foto_fk`),
  ADD KEY `fk_articulo_marca_idx` (`id_marca_fk`),
  ADD KEY `fk_articulo_tipo_articulo_idx` (`id_tipo_articulo_fk`);

--
-- Indices de la tabla `tbl_detallefactura_clinica`
--
ALTER TABLE `tbl_detallefactura_clinica`
  ADD PRIMARY KEY (`id_dfc`),
  ADD KEY `fk_detallefactura_clinica_producto_idx` (`id_producto_fk`),
  ADD KEY `fk_detallefactura_clinica_factura_clinica_idx` (`id_factura_fk`);

--
-- Indices de la tabla `tbl_detallefactura_tienda`
--
ALTER TABLE `tbl_detallefactura_tienda`
  ADD PRIMARY KEY (`id_dft`),
  ADD KEY `fk_detallefactura_tienda_articulo_idx` (`id_articulo_fk`),
  ADD KEY `fk_detallefactura_tienda_factura_tienda_idx` (`id_factura_tienda_fk`);

--
-- Indices de la tabla `tbl_direccion`
--
ALTER TABLE `tbl_direccion`
  ADD PRIMARY KEY (`id_di`);

--
-- Indices de la tabla `tbl_estado`
--
ALTER TABLE `tbl_estado`
  ADD PRIMARY KEY (`id_est`);

--
-- Indices de la tabla `tbl_factura_clinica`
--
ALTER TABLE `tbl_factura_clinica`
  ADD PRIMARY KEY (`id_fc`),
  ADD KEY `fk_factura_visita_idx` (`id_visita_fk`),
  ADD KEY `fk_factura_promocion_idx` (`id_promocion_fk`),
  ADD KEY `fk_factura_usuario_idx` (`id_usuario_fk`);

--
-- Indices de la tabla `tbl_factura_tienda`
--
ALTER TABLE `tbl_factura_tienda`
  ADD PRIMARY KEY (`id_ft`),
  ADD KEY `fk_facturatienda_promocion_idx` (`id_promocion_fk`),
  ADD KEY `fk_facturatienda_usuario_idx` (`id_usuario_fk`);

--
-- Indices de la tabla `tbl_foto`
--
ALTER TABLE `tbl_foto`
  ADD PRIMARY KEY (`id_f`);

--
-- Indices de la tabla `tbl_marca`
--
ALTER TABLE `tbl_marca`
  ADD PRIMARY KEY (`id_ma`);

--
-- Indices de la tabla `tbl_pacienteanimal_clinica`
--
ALTER TABLE `tbl_pacienteanimal_clinica`
  ADD PRIMARY KEY (`id_pa`),
  ADD KEY `fk_usuario_pacienteanimal_idx` (`propietario_fk`);

--
-- Indices de la tabla `tbl_producto_clinica`
--
ALTER TABLE `tbl_producto_clinica`
  ADD PRIMARY KEY (`id_prod`),
  ADD KEY `fk_producto_clinica_tipo_articulo_idx` (`id_tipo_producto_fk`);

--
-- Indices de la tabla `tbl_promocion`
--
ALTER TABLE `tbl_promocion`
  ADD PRIMARY KEY (`id_pro`);

--
-- Indices de la tabla `tbl_rol`
--
ALTER TABLE `tbl_rol`
  ADD PRIMARY KEY (`id_ro`);

--
-- Indices de la tabla `tbl_sociedad`
--
ALTER TABLE `tbl_sociedad`
  ADD PRIMARY KEY (`id_s`),
  ADD KEY `fk_sociedad_usuario_idx` (`id_usuario_fk`),
  ADD KEY `fk_sociedad_direccion_idx` (`id_direccion_fk`),
  ADD KEY `fk_sociedad_tipo_sociedad_idx` (`id_tipo_sociedad_fk`),
  ADD KEY `fk_sociedad_telefono_idx` (`id_telefono_fk`);

--
-- Indices de la tabla `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD PRIMARY KEY (`id_st`),
  ADD KEY `fk_stock_articulo_idx` (`id_articulo_fk`);

--
-- Indices de la tabla `tbl_telefono`
--
ALTER TABLE `tbl_telefono`
  ADD PRIMARY KEY (`id_tel`);

--
-- Indices de la tabla `tbl_tipo_articulo`
--
ALTER TABLE `tbl_tipo_articulo`
  ADD PRIMARY KEY (`id_ta`);

--
-- Indices de la tabla `tbl_tipo_sociedad`
--
ALTER TABLE `tbl_tipo_sociedad`
  ADD PRIMARY KEY (`id_ts`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id_us`),
  ADD KEY `fk_usuario_rol_idx` (`id_rol_fk`),
  ADD KEY `fk_usuario_telefono_idx` (`id_telefono_fk`),
  ADD KEY `fk_usuario_direccion1_idx` (`id_direccion1_fk`),
  ADD KEY `fk_usuario_direccion2_idx` (`id_direccion2_fk`);

--
-- Indices de la tabla `tbl_visita`
--
ALTER TABLE `tbl_visita`
  ADD PRIMARY KEY (`id_vi`),
  ADD KEY `fk_visita_pacienteanimal_idx` (`id_pacienteanimal_fk`),
  ADD KEY `fk_visita_usuario_idx` (`id_usuario_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_animales_perdidos`
--
ALTER TABLE `tbl_animales_perdidos`
  MODIFY `id_ape` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_articulo_tienda`
--
ALTER TABLE `tbl_articulo_tienda`
  MODIFY `id_art` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_detallefactura_clinica`
--
ALTER TABLE `tbl_detallefactura_clinica`
  MODIFY `id_dfc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_detallefactura_tienda`
--
ALTER TABLE `tbl_detallefactura_tienda`
  MODIFY `id_dft` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_direccion`
--
ALTER TABLE `tbl_direccion`
  MODIFY `id_di` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_estado`
--
ALTER TABLE `tbl_estado`
  MODIFY `id_est` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_factura_clinica`
--
ALTER TABLE `tbl_factura_clinica`
  MODIFY `id_fc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_factura_tienda`
--
ALTER TABLE `tbl_factura_tienda`
  MODIFY `id_ft` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_foto`
--
ALTER TABLE `tbl_foto`
  MODIFY `id_f` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_marca`
--
ALTER TABLE `tbl_marca`
  MODIFY `id_ma` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_pacienteanimal_clinica`
--
ALTER TABLE `tbl_pacienteanimal_clinica`
  MODIFY `id_pa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_producto_clinica`
--
ALTER TABLE `tbl_producto_clinica`
  MODIFY `id_prod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_promocion`
--
ALTER TABLE `tbl_promocion`
  MODIFY `id_pro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_rol`
--
ALTER TABLE `tbl_rol`
  MODIFY `id_ro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_sociedad`
--
ALTER TABLE `tbl_sociedad`
  MODIFY `id_s` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `id_st` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_telefono`
--
ALTER TABLE `tbl_telefono`
  MODIFY `id_tel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_articulo`
--
ALTER TABLE `tbl_tipo_articulo`
  MODIFY `id_ta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_sociedad`
--
ALTER TABLE `tbl_tipo_sociedad`
  MODIFY `id_ts` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id_us` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_visita`
--
ALTER TABLE `tbl_visita`
  MODIFY `id_vi` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_animales_perdidos`
--
ALTER TABLE `tbl_animales_perdidos`
  ADD CONSTRAINT `fk_animales_perdidos_estado` FOREIGN KEY (`id_estado_fk`) REFERENCES `tbl_estado` (`id_est`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_animales_perdidos_usuario` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_us`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_articulo_tienda`
--
ALTER TABLE `tbl_articulo_tienda`
  ADD CONSTRAINT `fk_articulo_foto` FOREIGN KEY (`id_foto_fk`) REFERENCES `tbl_foto` (`id_f`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_articulo_marca` FOREIGN KEY (`id_marca_fk`) REFERENCES `tbl_marca` (`id_ma`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_articulo_tipo_articulo` FOREIGN KEY (`id_tipo_articulo_fk`) REFERENCES `tbl_tipo_articulo` (`id_ta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_detallefactura_clinica`
--
ALTER TABLE `tbl_detallefactura_clinica`
  ADD CONSTRAINT `fk_detallefactura_clinica_factura_clinica` FOREIGN KEY (`id_factura_fk`) REFERENCES `tbl_factura_clinica` (`id_fc`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detallefactura_clinica_producto` FOREIGN KEY (`id_producto_fk`) REFERENCES `tbl_producto_clinica` (`id_prod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_detallefactura_tienda`
--
ALTER TABLE `tbl_detallefactura_tienda`
  ADD CONSTRAINT `fk_detallefactura_tienda_articulo` FOREIGN KEY (`id_articulo_fk`) REFERENCES `tbl_articulo_tienda` (`id_art`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detallefactura_tienda_factura_tienda` FOREIGN KEY (`id_factura_tienda_fk`) REFERENCES `tbl_factura_tienda` (`id_ft`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_factura_clinica`
--
ALTER TABLE `tbl_factura_clinica`
  ADD CONSTRAINT `fk_factura_promocion` FOREIGN KEY (`id_promocion_fk`) REFERENCES `tbl_promocion` (`id_pro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_factura_usuario` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_us`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_factura_visita` FOREIGN KEY (`id_visita_fk`) REFERENCES `tbl_visita` (`id_vi`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_factura_tienda`
--
ALTER TABLE `tbl_factura_tienda`
  ADD CONSTRAINT `fk_facturatienda_promocion` FOREIGN KEY (`id_promocion_fk`) REFERENCES `tbl_promocion` (`id_pro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_facturatienda_usuario` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_us`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_pacienteanimal_clinica`
--
ALTER TABLE `tbl_pacienteanimal_clinica`
  ADD CONSTRAINT `fk_usuario_pacienteanimal` FOREIGN KEY (`propietario_fk`) REFERENCES `tbl_usuario` (`id_us`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_producto_clinica`
--
ALTER TABLE `tbl_producto_clinica`
  ADD CONSTRAINT `fk_producto_clinica_tipo_articulo` FOREIGN KEY (`id_tipo_producto_fk`) REFERENCES `tbl_tipo_articulo` (`id_ta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_sociedad`
--
ALTER TABLE `tbl_sociedad`
  ADD CONSTRAINT `fk_sociedad_direccion` FOREIGN KEY (`id_direccion_fk`) REFERENCES `tbl_direccion` (`id_di`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sociedad_telefono` FOREIGN KEY (`id_telefono_fk`) REFERENCES `tbl_telefono` (`id_tel`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sociedad_tipo_sociedad` FOREIGN KEY (`id_tipo_sociedad_fk`) REFERENCES `tbl_tipo_sociedad` (`id_ts`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sociedad_usuario` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_us`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD CONSTRAINT `fk_stock_articulo` FOREIGN KEY (`id_articulo_fk`) REFERENCES `tbl_articulo_tienda` (`id_art`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD CONSTRAINT `fk_usuario_direccion1` FOREIGN KEY (`id_direccion1_fk`) REFERENCES `tbl_direccion` (`id_di`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_direccion2` FOREIGN KEY (`id_direccion2_fk`) REFERENCES `tbl_direccion` (`id_di`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`id_rol_fk`) REFERENCES `tbl_rol` (`id_ro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_telefono` FOREIGN KEY (`id_telefono_fk`) REFERENCES `tbl_telefono` (`id_tel`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_visita`
--
ALTER TABLE `tbl_visita`
  ADD CONSTRAINT `fk_visita_pacienteanimal` FOREIGN KEY (`id_pacienteanimal_fk`) REFERENCES `tbl_pacienteanimal_clinica` (`id_pa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_visita_usuario` FOREIGN KEY (`id_usuario_fk`) REFERENCES `tbl_usuario` (`id_us`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
