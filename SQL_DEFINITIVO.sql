-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 08-04-2022 a las 19:57:47
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pet_management`
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
  `direccion_perdida_ape` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto_ape` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_estado_fk` int(11) DEFAULT NULL,
  `cp_ape` char(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `calle_ape` int(3) DEFAULT NULL,
  `hora_des_ape` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_animales_perdidos`
--

INSERT INTO `tbl_animales_perdidos` (`id_ape`, `nombre_ape`, `descripcion_ape`, `fecha_perdida_ape`, `id_usuario_fk`, `direccion_perdida_ape`, `foto_ape`, `id_estado_fk`, `cp_ape`, `calle_ape`, `hora_des_ape`) VALUES
(2, 'Gerard', 'poLLA', '2022-04-09', 1, 'Rambla Marina', 'img/T0FxTlmtZPmormGaBnKNANHOJ8Kgy3rjKqrbkCpn.webp', 1, '08907', 200, '19:11:00');

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
  `id_tipo_articulo_fk` int(11) DEFAULT NULL,
  `descripcion_art` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto_art` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_articulo_tienda`
--

INSERT INTO `tbl_articulo_tienda` (`id_art`, `nombre_art`, `precio_art`, `codigobarras_art`, `id_foto_fk`, `id_marca_fk`, `id_tipo_articulo_fk`, `descripcion_art`, `foto_art`) VALUES
(1, 'Agua', '0.99', '45457363', NULL, NULL, 1, 'de', NULL),
(2, 'Cepillo Puas', '9.12', '63629336', NULL, 1, 2, 'de', NULL),
(3, 'Pienso Perro 500g', '2.99', '26422068', NULL, 1, 1, 'de', NULL),
(4, 'Coca cola perros', '1.99', '40215337', NULL, 2, 1, 'de', NULL),
(5, 'Rascador con poste de sisals color Marrón y Beige', '48.99', NULL, NULL, 22, 11, 'de', NULL),
(6, 'Patasbox tarta de cumpleaños de peluche para perros', '10.90', NULL, NULL, 4, 10, 'de', NULL),
(7, 'Comida de escamas para peces tropicales', '1.90', NULL, NULL, 19, 8, 'de', NULL),
(8, 'Kit terrario gecko cresta', '253.10', NULL, NULL, 10, 16, 'de', NULL);

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

--
-- Volcado de datos para la tabla `tbl_detallefactura_clinica`
--

INSERT INTO `tbl_detallefactura_clinica` (`id_dfc`, `cant_dfc`, `id_producto_fk`, `id_factura_fk`) VALUES
(1, 1, 1, 1),
(2, 3, 2, 1),
(6, 1, 2, 6),
(7, 2, 3, 6),
(8, 3, 2, 6),
(9, 1, 1, 7),
(10, 4, 2, 7);

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

--
-- Volcado de datos para la tabla `tbl_detallefactura_tienda`
--

INSERT INTO `tbl_detallefactura_tienda` (`id_dft`, `id_articulo_fk`, `cantidad_dft`, `id_factura_tienda_fk`) VALUES
(1, 1, 3, 2),
(2, 4, 2, 2),
(3, 2, 1, 3);

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

--
-- Volcado de datos para la tabla `tbl_direccion`
--

INSERT INTO `tbl_direccion` (`id_di`, `nombre_di`, `numero_di`, `bloque_di`, `piso_di`, `puerta_di`, `cp_di`) VALUES
(1, 'Avenida Norte', 12, NULL, 12, 1, '08765'),
(2, 'Avenida Sur', 451, NULL, 1, 9, '08456'),
(3, 'Rambla Marina', 200, NULL, NULL, NULL, '08907');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_estado`
--

CREATE TABLE `tbl_estado` (
  `id_est` int(11) NOT NULL,
  `estado_est` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_estado`
--

INSERT INTO `tbl_estado` (`id_est`, `estado_est`) VALUES
(1, NULL);

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

--
-- Volcado de datos para la tabla `tbl_factura_clinica`
--

INSERT INTO `tbl_factura_clinica` (`id_fc`, `id_usuario_fk`, `id_visita_fk`, `id_promocion_fk`, `total_fc`, `fecha_fc`, `hora_fc`) VALUES
(1, 1, 1, 2, '69.99', '2022-04-07', '19:32:58'),
(3, 1, 1, 1, '9.98', '2222-02-22', '11:11:00'),
(6, 1, 1, 2, '50.36', '2022-04-22', '02:43:00'),
(7, 1, 2, 2, '11.87', '2022-04-21', '15:49:00');

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

--
-- Volcado de datos para la tabla `tbl_factura_tienda`
--

INSERT INTO `tbl_factura_tienda` (`id_ft`, `fecha_ft`, `hora_ft`, `total_ft`, `id_promocion_fk`, `id_usuario_fk`) VALUES
(2, '2022-03-30', '17:32:25', '6.95', 2, 1),
(3, '2022-03-16', '17:32:21', '6.38', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_foto`
--

CREATE TABLE `tbl_foto` (
  `id_f` int(11) NOT NULL,
  `foto_f` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `articulo_tienda_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_marca`
--

CREATE TABLE `tbl_marca` (
  `id_ma` int(11) NOT NULL,
  `marca_ma` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_marca`
--

INSERT INTO `tbl_marca` (`id_ma`, `marca_ma`) VALUES
(1, 'Purina'),
(2, 'Royal Canin'),
(3, 'BreedUp'),
(4, 'Criadores'),
(5, 'VivaAnimals'),
(6, 'Advanced'),
(7, 'RoyalCanin'),
(8, 'Advantix'),
(9, 'Seresto'),
(10, 'Hills'),
(11, 'Summum'),
(12, 'Platinum'),
(13, 'ProPlan'),
(14, 'Acana'),
(15, 'TrueOrigins'),
(16, 'Nath'),
(17, 'Nutro'),
(18, 'Sanicat'),
(19, 'AlmoNature'),
(20, 'Tetra'),
(21, 'Applaws'),
(22, 'Cunipic'),
(23, 'ExoTerra');

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
  `raza_pa` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_pacienteanimal_clinica`
--

INSERT INTO `tbl_pacienteanimal_clinica` (`id_pa`, `nombre_pa`, `peso_pa`, `n_id_nacional`, `foto_pa`, `propietario_fk`, `nombrecientifico_pa`, `raza_pa`) VALUES
(1, 'Chispitas', '4.2', '876123456', 'https://i.gyazo.com/1a98baa3f626cebf9c7815c6575ca233.jpg', 1, 'Canis Latranis', NULL);

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

--
-- Volcado de datos para la tabla `tbl_producto_clinica`
--

INSERT INTO `tbl_producto_clinica` (`id_prod`, `producto_pro`, `precio_pro`, `codigobarras_pro`, `id_tipo_producto_fk`) VALUES
(1, 'Visita clínica', '4.99', '0000000001', 5),
(2, 'Parche algodon', '2.99', '28943734987', 4),
(3, 'Inyeccion Anestesia 50mg', '29.99', '12832123465', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_promocion`
--

CREATE TABLE `tbl_promocion` (
  `id_pro` int(11) NOT NULL,
  `promocion_pro` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `porcentaje_pro` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_promocion`
--

INSERT INTO `tbl_promocion` (`id_pro`, `promocion_pro`, `porcentaje_pro`) VALUES
(1, '-', 0),
(2, 'Primera compra', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_rol`
--

CREATE TABLE `tbl_rol` (
  `id_ro` int(11) NOT NULL,
  `rol_ro` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_rol`
--

INSERT INTO `tbl_rol` (`id_ro`, `rol_ro`) VALUES
(1, 'admin'),
(2, 'cliente'),
(3, 'trabajador');

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
  `horario_cierre_s` time DEFAULT NULL,
  `url_web` varchar(2100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto_sociedad` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto_icono_sociedad` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `operatividad_s` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_sociedad`
--

INSERT INTO `tbl_sociedad` (`id_s`, `nombre_s`, `nif_s`, `email_s`, `pass_s`, `id_usuario_fk`, `id_tipo_sociedad_fk`, `id_direccion_fk`, `id_telefono_fk`, `horario_apertura_s`, `horario_cierre_s`, `url_web`, `foto_sociedad`, `foto_icono_sociedad`, `operatividad_s`) VALUES
(1, 'Clinica Bellvitge', '10945474', 'bellvitge@clinica.es', '123', 1, 1, 2, 2, '17:35:23', '20:35:24', NULL, NULL, NULL, 0),
(2, 'Clinica Ruana1', '12345678', 'ruano@perico.com', NULL, NULL, 3, 3, 3, '08:00:00', '17:00:00', 'marca.com', 'img/c4YPJpCi4IT7FNIN9VAikxBrziFGRdUIqIWgiNnz.png', 'img/1dxxkFCfxHpaNCNM1B6vBpBH82N1IsJY8RDjdhgd.jpg', 1);

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

--
-- Volcado de datos para la tabla `tbl_telefono`
--

INSERT INTO `tbl_telefono` (`id_tel`, `contacto1_tel`, `contacto2_tel`) VALUES
(1, '93517847', '96675795'),
(2, '97467131', '92882222'),
(3, '600800900', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_articulo`
--

CREATE TABLE `tbl_tipo_articulo` (
  `id_ta` int(11) NOT NULL,
  `tipo_articulo_ta` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_tipo_articulo`
--

INSERT INTO `tbl_tipo_articulo` (`id_ta`, `tipo_articulo_ta`) VALUES
(1, 'Comida'),
(2, 'Cepillo'),
(3, 'Anestesia'),
(4, 'Gasas'),
(5, 'Servicio'),
(6, 'Comida para gato'),
(7, 'Roedores'),
(8, 'Peces'),
(9, 'Animales de Granja'),
(10, 'Accesorios para perro'),
(11, 'Accesorios para gato'),
(12, 'Repelentes para gato'),
(13, 'Snacks para perro'),
(14, 'Snacks para gato'),
(15, 'Pajaros'),
(16, 'Reptiles'),
(17, 'Caballos'),
(18, 'Higene para gato'),
(19, 'Higene para perro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_sociedad`
--

CREATE TABLE `tbl_tipo_sociedad` (
  `id_ts` int(11) NOT NULL,
  `sociedad_ts` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_tipo_sociedad`
--

INSERT INTO `tbl_tipo_sociedad` (`id_ts`, `sociedad_ts`) VALUES
(1, 'Clinica'),
(2, 'Protectora'),
(3, 'protectora');

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

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_us`, `nombre_us`, `apellido1_us`, `apellido2_us`, `dni_us`, `email_us`, `pass_us`, `id_rol_fk`, `id_telefono_fk`, `id_direccion1_fk`, `id_direccion2_fk`) VALUES
(1, 'Paco', 'Lopez', 'Lopez', '67896066S', 'paquito@mail.com', '123', 2, 1, 1, NULL),
(2, 'dani', 'ruano', 'ruano', '12378945', 'dani@e.com', '123', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_visita`
--

CREATE TABLE `tbl_visita` (
  `id_vi` int(11) NOT NULL,
  `fecha_vi` date DEFAULT NULL,
  `hora_vi` time DEFAULT NULL,
  `asunto_vi` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `diagnostico_vi` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_pacienteanimal_fk` int(11) DEFAULT NULL,
  `id_usuario_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_visita`
--

INSERT INTO `tbl_visita` (`id_vi`, `fecha_vi`, `hora_vi`, `asunto_vi`, `diagnostico_vi`, `id_pacienteanimal_fk`, `id_usuario_fk`) VALUES
(1, '2022-04-05', '19:31:09', 'Se le ha caido un Jose encima', 'Joder tio otar vez', 1, 1),
(2, '2022-04-10', '15:23:34', 'Que le ha pasao', 'Jose', 1, 1);

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
  ADD PRIMARY KEY (`id_f`),
  ADD KEY `artuclo_tienda_fk` (`articulo_tienda_fk`);

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
  MODIFY `id_ape` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_articulo_tienda`
--
ALTER TABLE `tbl_articulo_tienda`
  MODIFY `id_art` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tbl_detallefactura_clinica`
--
ALTER TABLE `tbl_detallefactura_clinica`
  MODIFY `id_dfc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tbl_detallefactura_tienda`
--
ALTER TABLE `tbl_detallefactura_tienda`
  MODIFY `id_dft` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_direccion`
--
ALTER TABLE `tbl_direccion`
  MODIFY `id_di` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_estado`
--
ALTER TABLE `tbl_estado`
  MODIFY `id_est` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_factura_clinica`
--
ALTER TABLE `tbl_factura_clinica`
  MODIFY `id_fc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_factura_tienda`
--
ALTER TABLE `tbl_factura_tienda`
  MODIFY `id_ft` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_foto`
--
ALTER TABLE `tbl_foto`
  MODIFY `id_f` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_marca`
--
ALTER TABLE `tbl_marca`
  MODIFY `id_ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `tbl_pacienteanimal_clinica`
--
ALTER TABLE `tbl_pacienteanimal_clinica`
  MODIFY `id_pa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_producto_clinica`
--
ALTER TABLE `tbl_producto_clinica`
  MODIFY `id_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_promocion`
--
ALTER TABLE `tbl_promocion`
  MODIFY `id_pro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_rol`
--
ALTER TABLE `tbl_rol`
  MODIFY `id_ro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_sociedad`
--
ALTER TABLE `tbl_sociedad`
  MODIFY `id_s` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `id_st` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_telefono`
--
ALTER TABLE `tbl_telefono`
  MODIFY `id_tel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_articulo`
--
ALTER TABLE `tbl_tipo_articulo`
  MODIFY `id_ta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_sociedad`
--
ALTER TABLE `tbl_tipo_sociedad`
  MODIFY `id_ts` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id_us` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_visita`
--
ALTER TABLE `tbl_visita`
  MODIFY `id_vi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Filtros para la tabla `tbl_foto`
--
ALTER TABLE `tbl_foto`
  ADD CONSTRAINT `artuclo_tienda_fk` FOREIGN KEY (`articulo_tienda_fk`) REFERENCES `tbl_articulo_tienda` (`id_art`);

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
