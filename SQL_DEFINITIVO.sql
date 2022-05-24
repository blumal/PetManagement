--
-- Base de datos: `pet_management`
--

CREATE DATABASE `pet_management`;
USE `pet_management`;

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
(2, 'Gerard', 'poLLA', '2022-04-09', 1, 'Rambla Marina', 'img/T0FxTlmtZPmormGaBnKNANHOJ8Kgy3rjKqrbkCpn.webp', 1, '08907', 200, '19:11:00'),
(3, 'Gerard', 'Romero', '2022-04-14', 1, 'Rambla Marina', 'img/AWsQsbVbPWZWziPx6fVoEveXVTU1tVRnHBdtJFda.webp', 1, '08907', 100, '19:04:00');

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
  `descripcion_art` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto_art` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_categoria_art` enum('Peso','Capacidad','Medida','Cantidad') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_articulo_tienda`
--

INSERT INTO `tbl_articulo_tienda` (`id_art`, `nombre_art`, `precio_art`, `codigobarras_art`, `id_foto_fk`, `id_marca_fk`, `id_tipo_articulo_fk`, `descripcion_art`, `foto_art`, `tipo_categoria_art`) VALUES
(1, 'Agua', '0.99', '45457363', NULL, 11, 1, 'de', 'foto1.jpg', 'Capacidad'),
(2, 'Cepillo Puas', '9.12', '63629336', NULL, 1, 2, 'de', 'foto4.jpg', 'Medida'),
(3, 'Pienso Perro 500g', '2.99', '26422068', NULL, 1, 1, 'de', 'foto3.jpg', 'Peso'),
(4, 'Coca cola perros', '1.99', '40215337', NULL, 2, 1, 'de', 'foto2.jpg', 'Capacidad'),
(5, 'Rascador con poste de sisals color Marrón y Beige', '48.99', NULL, NULL, 22, 11, 'de', 'foto5.jpg', 'Cantidad'),
(6, 'Patasbox tarta de cumpleaños de peluche para perros', '10.90', NULL, NULL, 4, 10, 'de', 'foto6.jpg', 'Peso'),
(7, 'Comida de escamas para peces tropicales', '1.90', NULL, NULL, 19, 8, 'de', 'foto7.jpg', 'Medida'),
(8, 'Kit terrario gecko cresta', '253.10', NULL, NULL, 10, 16, 'de', 'foto8.jpg', 'Capacidad'),
(9, 'Pienso Criadores para perros adultos Cordero y arroz', '59.99', NULL, NULL, 6, 1, 'El pienso natural super premium Criadores Adulto con cordero y arroz está formulado especialmente para perros adultos ( 10 kg) con problemas digestivos o para animales con tendencia a desarrollar alergias alimentarias.', 'foto1.jpg', 'Peso'),
(10, 'Collar regulable CaponeTheDog para perros estampado Donuts', '13.95', NULL, NULL, 1, 10, '¿Moda y diversión de la mano? Bueno más bien de la pata. Lleva a tu mascota con las últimas tendencias con este fantástico collar con estampado frutal, porque a tu mascota a veces le gusta hacer el mono.', 'foto2.jpg', 'Medida'),
(11, 'Royal Canin Maxi Adult', '17.99', NULL, NULL, 7, 1, 'Royal Canin Maxi Adult es un alimento para perros de 26 a 44 kg, desde los 15 meses a los 5 años; que ayudará a tu mascota a mantener el peso ideal y un óptimo estado de salud, cubriendo las necesidades concretas de tu perro grande.', 'foto3.jpg', 'Peso'),
(12, 'Arena aglomerante para gatos olor a talco perfumado', '8.95', NULL, NULL, 14, 18, 'Si estás pensando en cuál es la mejor arena para tu gato, TK-Pet te da la opción de siempre, pero mejorada. Su nueva gama de arenas para felinos tiene una excelente calidad libre de polvo. ', 'foto4.jpg', 'Peso'),
(13, 'Rascador con poste de sisals color Marrón y Beige', '48.99', NULL, NULL, 22, 11, 'Con este rascador para gatos de alta calidad sus gatos podrán rascarse, posarse, esconderse, trepar y relajarse cuando quieran.Gracias a lo cual, estarán mucho más relajados y tranquilos, sin estrés ni perturbaciones siendo así más felices. Este rascador es un producto que se adapta a cualquier decoración.', 'foto5.jpg', 'Medida'),
(14, 'Patasbox tarta de cumpleaños de peluche para perros', '10.90', NULL, NULL, 4, 10, 'La tarta de peluche de patasbox se convertirá en el favorito de tu perro y no podía faltar en tu colección de juguetes. Además es un juguete 2 en 1 para que tu perro tenga el doble de diversión no sólo en su cumpleaños sino durante todo el año.', 'foto6.jpg', 'Medida'),
(15, 'Comida de escamas para peces tropicales', '1.90', NULL, NULL, 19, 8, 'La alimentación es muy importante para tus peces ya que gracias a ella tus peces pueden vivir cómodamente sin problemas de salud. Una alimentación específica es muy importante ya que influirá en factores como la actividad diaria que puedan tener tus peces, su vitalidad, sus colores.', 'foto7.jpg', 'Capacidad'),
(16, 'Kit terrario gecko cresta', '253.10', NULL, NULL, 10, 16, 'Todos los componentes del Kit Hábitat de Gecko Crestado se basan en conocimientos adquiridos durante un expedición al gecko crestado en combinación con información sobre la cría en cautividad de conocidos criadores de gecko crestado.', 'foto8.jpg', 'Medida'),
(17, 'Comida húmeda para perros Breed Up Senior de pavo con batata', '2.49', NULL, NULL, 3, 1, 'La comida húmeda para perros Breed Up Senior de pavo con batata es un alimento elaborado para aportar a tu mascota los nutrientes necesarios durante su edad madura.', 'foto9.jpg', 'Peso'),
(18, 'Pienso súperpremium para gatos Breed Up Adult Chicken con pollo', '15.99', NULL, NULL, 3, 6, 'Los gatos adultos necesitan un alimento completo que les aporte a diario toda la energía que necesitan para soportar sus largas jornadas de paseos y cacerías así como que los proteja de los problemas relacionados con la edad.', 'foto10.jpg', 'Peso'),
(19, 'Bebedero automático de volumen constante de aluminio', '39.99', NULL, NULL, 12, 9, 'Este bebedero es ideal para perros y gatos que pasan muchas horas solos en la casa o para un hogar con varios animales. Mantiene un nivel de agua constante, renovándola continuamente gracias a la válvula de nivel para alta presión.', 'foto11.jpg', 'Medida'),
(20, 'Comida húmeda Royal Canin Mini Adult', '4.09', NULL, NULL, 7, 1, 'La comida húmeda Royal Canin Mini Adult proporciona a tu perro todos los nutrientes que necesita para que goce de una salud óptima. Con una cantidad de energía adaptada a su edad y a su tamaño para que sus requerimientos energéticos estén cubiertos y tenga una gran vitalidad. La receta está formulada para perros adultos de raza pequeña, hasta 10 kg de peso.', 'foto12.jpg', 'Peso'),
(21, 'Royal Canin Sensitivity Control Húmedo Pollo', '3.29', NULL, NULL, 7, 1, 'Royal Canin Sensitivity Control es un alimento húmedo dietético medicado con bajo contenido de grasa, indicado para los perros con regímenes de eliminación, alergias alimentarias que tengan efectos dermatológicos o digestivos, intolerancia alimentaria y enfermedad inflamatoria crónica del intestino. Este alimento está formulado específicamente para reducir la intolerancia a ingredientes y nutrientes.', 'foto13.jpg', 'Peso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categoria_articulo`
--

CREATE TABLE `tbl_categoria_articulo` (
  `id_cat` int(11) NOT NULL,
  `texto_cat` varchar(50) DEFAULT NULL,
  `precio_cat` decimal(6,2) DEFAULT NULL,
  `articulo_fk` int(11) DEFAULT NULL,
  `cantidad` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_categoria_articulo`
--

INSERT INTO `tbl_categoria_articulo` (`id_cat`, `texto_cat`, `precio_cat`, `articulo_fk`, `cantidad`) VALUES
(1, '3 kg', '59.99', 1, 1000),
(2, '28-44 cm x 2,5 cm', '13.95', 2, 1000),
(3, '4 kg', '17.99', 3, 100),
(4, '10 kg', '8.95', 4, 1000),
(5, '44 cm x 40 cm x 50 cm', '48.99', 5, 1000),
(6, '17 cm x 8 cm x 7 cm', '10.90', 6, 1000),
(7, '100 mL', '1.90', 7, 1000),
(8, '30 cm x 30 cm x 45 cm', '253.10', 8, 1000),
(9, '400 g', '2.49', 9, 1000),
(10, '2.5 kg', '15.90', 10, 1000),
(11, '23 x 22 cm', '39.99', 11, 1000),
(12, '15 kg', '52.99', 3, 50),
(13, '8 kg', '30.99', 3, 80),
(14, '3 x 85 g', '4.09', 12, 1000),
(15, '420 g', '3.29', 13, 1000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_clientes_promo`
--

CREATE TABLE `tbl_clientes_promo` (
  `id_cli_pro` int(11) NOT NULL,
  `comprobar_cli_pro` tinyint(1) NOT NULL,
  `fk_id_us` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_clientes_promo`
--

INSERT INTO `tbl_clientes_promo` (`id_cli_pro`, `comprobar_cli_pro`, `fk_id_us`) VALUES
(1, 1, 5),
(2, 0, 4);

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
(10, 4, 2, 7),
(11, 1, 1, 3),
(12, 1, 1, 8),
(13, 3, 2, 8),
(30, 1, 1, 22),
(31, 1, 1, 23),
(32, 1, 1, 24),
(33, 1, 1, 25),
(34, 1, 1, 26),
(35, 1, 1, 27),
(36, 1, 1, 28);

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
(3, 2, 1, 3),
(9, 1, 2, 9),
(10, 2, 1, 9),
(11, 3, 1, 9),
(12, 4, 9, 9),
(14, 1, 4, 11),
(15, 3, 1, 11),
(16, 1, 1, 12),
(17, 1, 1, 13),
(18, 1, 1, 14),
(19, 1, 1, 15),
(20, 2, 1, 16),
(21, 2, 1, 17),
(22, 3, 1, 18),
(23, 7, 1, 18),
(24, 8, 1, 18),
(25, 1, 1, 19),
(26, 2, 1, 19),
(27, 1, 1, 20),
(28, 5, 1, 20),
(29, 6, 1, 20),
(30, 5, 1, 21),
(31, 2, 1, 21),
(32, 1, 1, 22),
(33, 3, 1, 23),
(34, 1, 1, 24),
(35, 7, 1, 25),
(36, 6, 1, 26),
(37, 2, 1, 27),
(38, 2, 1, 28),
(39, 2, 1, 29),
(40, 6, 1, 29),
(41, 2, 1, 30),
(42, 6, 1, 30),
(43, 2, 1, 31),
(44, 6, 1, 31),
(45, 2, 1, 32),
(46, 6, 1, 32),
(47, 2, 1, 33),
(48, 6, 1, 33),
(49, 2, 1, 34),
(50, 6, 1, 34),
(51, 2, 1, 35),
(52, 6, 1, 35),
(53, 2, 1, 36),
(54, 6, 1, 36),
(55, 2, 1, 37),
(56, 6, 1, 37),
(57, 3, 2, 38),
(58, 3, 2, 39),
(59, 3, 2, 40),
(60, 3, 2, 41),
(61, 3, 2, 42),
(62, 3, 2, 43),
(63, 3, 1, 44),
(64, 8, 1, 44),
(65, 3, 1, 45),
(66, 8, 1, 45),
(67, 3, 1, 46),
(68, 8, 1, 46),
(69, 3, 1, 47),
(70, 8, 1, 47),
(71, 6, 7, 48),
(72, 3, 2, 49),
(73, 2, 1, 49),
(74, 3, 2, 50),
(75, 2, 1, 50),
(76, 3, 2, 51),
(77, 2, 1, 51),
(78, 1, 5, 52),
(79, 1, 5, 53),
(80, 3, 1, 54),
(81, 3, 1, 55),
(82, 2, 1, 56),
(83, 3, 1, 57),
(84, 1, 1, 58),
(85, 4, 1, 59),
(86, 7, 1, 59),
(87, 6, 1, 60),
(88, 5, 1, 60),
(89, 4, 8, 61),
(90, 2, 1, 62),
(91, 5, 1, 63),
(92, 3, 1, 64),
(93, 3, 4, 65),
(94, 6, 1, 66),
(95, 2, 1, 67),
(96, 1, 1, 68),
(97, 1, 1, 69),
(98, 1, 1, 70),
(99, 3, 2, 71),
(100, 1, 1, 72),
(101, 1, 1, 73),
(102, 2, 1, 74),
(103, 2, 1, 75),
(104, 1, 1, 76),
(105, 1, 1, 77),
(106, 3, 2, 78),
(107, 3, 1, 79),
(108, 1, 1, 82),
(109, 1, 1, 83),
(110, 3, 1, 84),
(111, 3, 1, 85),
(112, 3, 1, 86),
(113, 1, 3, 87),
(114, 1, 3, 88),
(115, 1, 3, 89),
(116, 1, 3, 90),
(117, 1, 3, 91),
(118, 1, 3, 92),
(119, 1, 3, 93),
(120, 1, 3, 94),
(121, 1, 1, 95),
(122, 1, 1, 96),
(123, 2, 2, 97),
(124, 1, 1, 98),
(125, 1, 1, 99),
(126, 1, 1, 100),
(127, 4, 1, 101),
(128, 1, 1, 102),
(129, 4, 6, 103),
(130, 8, 8, 104),
(131, 5, 1, 105),
(132, 2, 1, 106);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_direccion`
--

CREATE TABLE `tbl_direccion` (
  `id_di` int(11) NOT NULL,
  `nombre_di` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `numero_di` int(3) DEFAULT NULL,
  `bloque_di` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `piso_di` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `puerta_di` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cp_di` char(5) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_direccion`
--

INSERT INTO `tbl_direccion` (`id_di`, `nombre_di`, `numero_di`, `bloque_di`, `piso_di`, `puerta_di`, `cp_di`) VALUES
(1, 'Avenida Norte', 12, NULL, '12', '1', '08765'),
(2, 'Avenida Sur', 451, NULL, NULL, NULL, '08457'),
(3, 'Rambla Marina', 200, NULL, NULL, NULL, '08907'),
(4, 'Rambla Marina', 300, NULL, NULL, NULL, '08907'),
(12, 'Rambla Marina', 311, NULL, NULL, NULL, '08907');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_direccion_geoguesser`
--

CREATE TABLE `tbl_direccion_geoguesser` (
  `id_dir_geo` int(11) NOT NULL,
  `codigo_pais_dir_geo` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fk_id_geo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_direccion_geoguesser`
--

INSERT INTO `tbl_direccion_geoguesser` (`id_dir_geo`, `codigo_pais_dir_geo`, `fk_id_geo`) VALUES
(1, 'IND', 1),
(3, 'THA', 1),
(4, 'USA', 2),
(5, 'NPL', 1),
(6, 'BGD', 1),
(7, 'MMR', 1),
(8, 'CHN', 1),
(9, 'RUS', 1),
(10, 'VNM', 1),
(11, 'IDN', 1),
(12, 'IRN', 1),
(13, 'KAZ', 1),
(14, 'MYS', 1),
(15, 'JPN', 1),
(16, 'RUS', 3),
(17, 'POL', 3),
(18, 'CZE', 3),
(19, 'DEU', 3),
(20, 'AUT', 3),
(21, 'MNG', 3),
(22, 'USA', 3),
(23, 'CAN', 3),
(24, 'AUS', 4),
(25, 'IND', 4),
(26, 'SOM', 4),
(27, 'ZAF', 4),
(28, 'MDG', 4),
(29, 'NAM', 5),
(30, 'AGO', 5),
(31, 'BDI', 5),
(32, 'COM', 5),
(33, 'ERI', 5),
(34, 'ETH', 5),
(35, 'KEN', 5),
(36, 'MDG', 5),
(37, 'MWI', 5),
(38, 'MUS', 5),
(39, 'MOZ', 5),
(40, 'RWA', 5),
(41, 'SYC', 5),
(42, 'SOM', 5),
(43, 'SDN', 5),
(44, 'SSD', 5),
(45, 'TZA', 5),
(46, 'UGA', 4),
(47, 'DJI', 5);

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
(1, 'Agendada'),
(2, 'En curso'),
(3, 'Finalizada');

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
  `hora_fc` time DEFAULT NULL,
  `id_veterinario_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_factura_clinica`
--

INSERT INTO `tbl_factura_clinica` (`id_fc`, `id_usuario_fk`, `id_visita_fk`, `id_promocion_fk`, `total_fc`, `fecha_fc`, `hora_fc`, `id_veterinario_fk`) VALUES
(1, 1, 1, 2, '9.76', '2022-04-07', '19:32:58', 3),
(3, 1, 1, 1, '9.98', '2222-02-22', '11:11:00', 3),
(6, 1, 1, 2, '50.36', '2022-04-20', '02:43:00', 3),
(7, 1, 2, 2, '11.87', '2022-04-21', '15:49:00', 3),
(8, 1, 1, 1, '13.96', '2022-04-15', '17:01:00', NULL),
(9, 3, 1, 1, '13.96', '2022-04-20', '18:13:00', NULL),
(22, 3, 3, 1, '4.99', '2022-05-05', '17:15:00', 3),
(23, 5, 8, 1, '4.99', '2022-05-10', '18:18:00', 3),
(24, 5, 5, 1, '4.99', '2022-05-06', '20:32:00', 3),
(25, 5, 9, 1, '4.99', '2022-05-22', '16:44:00', 3),
(26, 5, 7, 9, '4.64', '2022-05-19', '16:36:00', 3),
(27, 5, 7, 9, '4.64', '2022-05-19', '16:36:00', 3),
(28, 5, 14, 12, '4.24', '2022-05-26', '17:23:00', 3);

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
(2, '2022-04-06', '17:32:25', '4.87', 2, 1),
(3, '2022-03-16', '17:32:21', '6.38', 1, 1),
(9, '2022-05-03', '20:37:45', '32.00', 1, 1),
(11, '2022-05-09', '17:18:31', '6.95', 1, 1),
(12, '2022-05-09', '19:39:11', '0.99', 1, 3),
(13, '2022-05-09', '19:41:16', '0.99', 1, 3),
(14, '2022-05-09', '19:41:32', '0.99', 1, 3),
(15, '2022-05-09', '19:42:39', '0.99', 1, 3),
(16, '2022-05-09', '19:59:15', '9.12', 1, 3),
(17, '2022-05-09', '19:59:36', '9.12', 1, 3),
(18, '2022-05-09', '20:04:11', '257.99', 1, 3),
(19, '2022-05-09', '20:24:44', '10.11', 1, 5),
(20, '2022-05-09', '20:26:51', '60.88', 1, 5),
(21, '2022-05-09', '20:29:06', '58.11', 1, 5),
(22, '2022-05-09', '20:30:41', '0.99', 1, 5),
(23, '2022-05-09', '20:33:36', '2.99', 1, 5),
(24, '2022-05-09', '20:36:57', '0.99', 1, 5),
(25, '2022-05-09', '20:39:27', '1.90', 1, 5),
(26, '2022-05-09', '20:50:13', '10.90', 1, 5),
(27, '2022-05-10', '15:20:20', '9.12', 1, 5),
(28, '2022-05-10', '15:20:50', '9.12', 1, 5),
(29, '2022-05-10', '15:23:36', '20.02', 1, 5),
(30, '2022-05-10', '15:24:13', '20.02', 1, 5),
(31, '2022-05-10', '15:24:30', '20.02', 1, 5),
(32, '2022-05-10', '15:24:38', '20.02', 1, 5),
(33, '2022-05-10', '15:24:48', '20.02', 1, 5),
(34, '2022-05-10', '15:25:16', '20.02', 1, 5),
(35, '2022-05-10', '15:25:55', '20.02', 1, 5),
(36, '2022-05-10', '15:27:35', '20.02', 1, 5),
(37, '2022-05-10', '15:27:48', '20.02', 1, 5),
(38, '2022-05-10', '15:29:15', '5.98', 1, 5),
(39, '2022-05-10', '15:29:54', '5.98', 1, 5),
(40, '2022-05-10', '15:30:09', '5.98', 1, 5),
(41, '2022-05-10', '15:30:25', '5.98', 1, 5),
(42, '2022-05-10', '15:31:09', '5.98', 1, 5),
(43, '2022-05-10', '15:32:11', '5.98', 1, 5),
(44, '2022-05-10', '15:36:04', '256.09', 1, 5),
(45, '2022-05-10', '15:36:55', '256.09', 1, 5),
(46, '2022-05-10', '15:37:19', '256.09', 1, 5),
(47, '2022-05-10', '15:38:07', '256.09', 1, 5),
(48, '2022-05-10', '15:39:37', '76.30', 1, 5),
(49, '2022-05-10', '15:48:56', '15.10', 1, 5),
(50, '2022-05-10', '15:49:53', '15.10', 1, 5),
(51, '2022-05-10', '15:59:33', '15.10', 1, 5),
(52, '2022-05-10', '16:01:00', '4.95', 1, 5),
(53, '2022-05-10', '16:02:34', '4.95', 1, 5),
(54, '2022-05-10', '16:04:19', '2.99', 1, 5),
(55, '2022-05-10', '16:04:28', '2.99', 1, 5),
(56, '2022-05-10', '16:05:42', '9.12', 1, 5),
(57, '2022-05-10', '16:07:07', '2.99', 1, 5),
(58, '2022-05-10', '16:08:16', '0.99', 1, 5),
(59, '2022-05-10', '16:09:53', '3.89', 1, 5),
(60, '2022-05-10', '16:19:18', '59.89', 1, 5),
(61, '2022-05-10', '16:21:02', '15.92', 1, 5),
(62, '2022-05-10', '16:23:04', '9.12', 1, 5),
(63, '2022-05-10', '16:30:08', '48.99', 1, 5),
(64, '2022-05-10', '16:31:28', '2.99', 1, 5),
(65, '2022-05-10', '16:33:56', '11.96', 1, 5),
(66, '2022-05-10', '16:38:34', '10.90', 1, 5),
(67, '2022-05-10', '16:43:59', '9.12', 1, 5),
(68, '2022-05-10', '16:45:11', '0.99', 1, 5),
(69, '2022-05-10', '16:46:04', '0.99', 1, 5),
(70, '2022-05-10', '16:47:06', '0.99', 1, 5),
(71, '2022-05-10', '16:49:51', '5.98', 1, 5),
(72, '2022-05-10', '16:50:48', '0.99', 1, 5),
(73, '2022-05-10', '16:51:46', '0.99', 1, 5),
(74, '2022-05-10', '16:52:33', '9.12', 1, 5),
(75, '2022-05-10', '16:52:48', '9.12', 1, 5),
(76, '2022-05-10', '16:56:54', '0.99', 1, 5),
(77, '2022-05-13', '16:51:47', '0.99', 1, 3),
(78, '2022-05-13', '16:52:59', '5.98', 1, 5),
(79, '2022-05-13', '16:54:13', '2.99', 1, 5),
(82, '2022-05-13', '16:57:48', '0.99', 1, 5),
(83, '2022-05-13', '16:58:24', '0.99', 1, 5),
(84, '2022-05-19', '16:43:19', '2.99', 1, 3),
(85, '2022-05-19', '16:43:51', '2.99', 1, 3),
(86, '2022-05-19', '16:57:00', '2.99', 1, 3),
(87, '2022-05-19', '17:04:58', '2.97', 1, 5),
(88, '2022-05-19', '17:05:15', '2.97', 1, 5),
(89, '2022-05-19', '17:05:25', '2.97', 1, 5),
(90, '2022-05-19', '17:06:08', '2.97', 1, 5),
(91, '2022-05-19', '17:06:30', '2.97', 1, 5),
(92, '2022-05-19', '17:09:01', '2.97', 1, 5),
(93, '2022-05-19', '17:09:26', '2.97', 1, 5),
(94, '2022-05-19', '17:09:54', '2.97', 1, 5),
(95, '2022-05-19', '17:13:50', '0.99', 1, 5),
(96, '2022-05-19', '17:14:05', '0.99', 1, 5),
(97, '2022-05-19', '17:14:40', '18.24', 1, 5),
(98, '2022-05-19', '17:15:55', '0.99', 1, 5),
(99, '2022-05-19', '17:16:03', '0.99', 1, 5),
(100, '2022-05-19', '17:16:40', '0.99', 1, 5),
(101, '2022-05-19', '17:17:11', '1.99', 1, 5),
(102, '2022-05-19', '17:17:34', '0.99', 1, 5),
(103, '2022-05-19', '17:17:57', '11.94', 1, 5),
(104, '2022-05-19', '17:18:48', '2024.80', 1, 5),
(105, '2022-05-23', '15:49:27', '48.99', 1, 5),
(106, '2022-05-23', '16:20:15', '13.95', 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_foto`
--

CREATE TABLE `tbl_foto` (
  `id_f` int(11) NOT NULL,
  `foto_f` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `articulo_tienda_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_foto`
--

INSERT INTO `tbl_foto` (`id_f`, `foto_f`, `articulo_tienda_fk`) VALUES
(1, 'royal1.jpg', 3),
(2, 'royal2.jpg', 3),
(3, 'royal3.jpg', 3),
(4, 'royal4.jpg', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_geoguesser`
--

CREATE TABLE `tbl_geoguesser` (
  `id_geo` int(11) NOT NULL,
  `nombre_geo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_geo` varchar(2100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_geoguesser`
--

INSERT INTO `tbl_geoguesser` (`id_geo`, `nombre_geo`, `img_geo`) VALUES
(1, 'Tigre', 'https://imagenes.elpais.com/resizer/xqihRxHODZW7C0a44OtRWU2rMbw=/414x0/arc-anglerfish-eu-central-1-prod-prisa.s3.amazonaws.com/public/DTLGIVVRTSLEUO5UZI7LQPFKWM.jpg'),
(2, 'American Staffordshire terrier', 'https://junin24.com/wp-content/uploads/2021/06/pitbull.jpg'),
(3, 'Alce', 'https://upload.wikimedia.org/wikipedia/commons/4/47/Bigbullmoose.jpg'),
(4, 'Cocodrilo', 'https://www.dondevive.org/wp-content/uploads/2015/07/donde-vive-el-cocodrilo.jpg'),
(5, 'Impala', 'https://www.dondevive.org/wp-content/uploads/2016/11/impala.jpg');

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
-- Estructura de tabla para la tabla `tbl_opinion_articulo`
--

CREATE TABLE `tbl_opinion_articulo` (
  `id_op` int(11) NOT NULL,
  `texto_op` varchar(2000) DEFAULT NULL,
  `valoracion_op` int(1) DEFAULT NULL,
  `usuario_fk` int(11) DEFAULT NULL,
  `articulo_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_opinion_articulo`
--

INSERT INTO `tbl_opinion_articulo` (`id_op`, `texto_op`, `valoracion_op`, `usuario_fk`, `articulo_fk`) VALUES
(1, ' Le encanta este pienso y hace super bien sus cacas, el pelo le brilla y el perro está fuerte y con mucha energía. Lo recomiendo para los pastores alemanes, ya que lleva mucha proteína y condrosan para las articulaciones.', 3, 1, 3),
(2, 'Fenomenal, muy buen precio-calidad y a mis 3 perros grandes les encanta. Mi perro (que no suele comer por las mañanas porque no quiere levantarse del suelo), se lo come hasta tumbado.', 4, 1, 3),
(3, 'Mi veterinario me lo recomendó, lo come mi Golden retriver de 2 años y medio y le sienta genial, le brilla el pelo y esta fuerte como un toro!', 5, 2, 3),
(22, 'Composición ok, precio muy bien', 5, 2, 1),
(23, 'tu puta madre', 5, 1, 3),
(24, 'Jose', 3, 2, 10),
(25, 'Ahora peor', 2, 2, 10),
(26, 'Bien', 0, 2, 2),
(27, 'Muy bien', 5, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pacienteanimal_clinica`
--

CREATE TABLE `tbl_pacienteanimal_clinica` (
  `id_pa` int(11) NOT NULL,
  `nombre_pa` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `peso_pa` decimal(3,1) DEFAULT NULL,
  `n_id_nacional` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `foto_pa` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `propietario_fk` int(11) DEFAULT NULL,
  `nombrecientifico_pa` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `raza_pa` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_pacienteanimal_clinica`
--

INSERT INTO `tbl_pacienteanimal_clinica` (`id_pa`, `nombre_pa`, `peso_pa`, `n_id_nacional`, `fecha_nacimiento`, `foto_pa`, `propietario_fk`, `nombrecientifico_pa`, `raza_pa`, `activo`) VALUES
(1, 'Chispitas', '4.2', '876123456', '2016-02-07', 'uploads/lTbEnya3o3oIGsts9rZh7tW7yAWRJIYVHUc1gpSR.jpg', 1, 'Canis Latranis', 'Chihuahua', 1),
(2, 'Sapristi', '9.1', '129875', '2018-05-07', 'uploads/sPTjZUN8hK419WScpA9acE7UO38inbGUZPck0lgx.jpg', 1, 'Canis Latranis', 'Bulldog frances', 1),
(3, 'La Foca Agnes', '23.7', '12982', '2011-01-17', 'uploads/n4IqFtkG27VWsAsS5s1iQa6ooBmlfebVqqCqceIs.jpg', 1, 'Phoca vitulina', NULL, 1),
(4, 'Monito Lolo', '3.2', '12982', '2013-08-23', 'uploads/FwMDlXi25lbUjuZshS80JUKEFCmQoWW9oiYy7Lr5.webp', 1, 'Saimiri oerstedii', NULL, 1),
(5, 'Simba', '80.8', '345891481', '2013-02-07', 'uploads/cKiwmiZl5HqCzMczK1Xef8O2QuU819x0JiIP7Dih.png', 1, 'Panthera leo', NULL, 1),
(7, 'Calamar Jose juan', '1.8', NULL, '2022-04-04', 'uploads/2tftSuTo7kv7fpHxRYPkaaEmg3vaMsNRTSv7catw.jpg', 4, 'Loligo vulgaris', NULL, 1),
(15, 'Luna', '8.4', NULL, '2014-02-13', 'uploads/ATFNSQdY2kqsdq4YK4iQywLWYVxyip7Buxt4EuhX.jpg', 4, 'Canis Latranis', 'American Stanford', 1),
(16, 'Sardina Josefina', '0.3', NULL, '2022-04-25', 'uploads/gphv66CLXt827G4oylDFM3vF2PPKvNHjdhwzljOB.jpg', 5, 'Sardina pilchardus', NULL, 0);

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
(3, 'Inyeccion Anestesia 50mg', '29.99', '12832123465', 3),
(4, 'Anestesia 50mg', '6.99', NULL, 3),
(5, 'Placa titanio craneo moldeable', '599.00', NULL, 5),
(6, 'Cono antimordida', '39.00', NULL, 5),
(7, 'Puntos sutura', '2.99', NULL, 4),
(8, 'Sedante animal grande', '19.99', NULL, 3),
(9, 'Antibioticos animales pequeños/medianos', '4.99', NULL, 3),
(10, 'Radiografia', '29.99', NULL, 5),
(11, 'Rasuramiento de pelo', '4.99', NULL, 5),
(12, 'Esterilización', '49.99', NULL, 5),
(13, 'Metro esparadrapo', '1.99', NULL, 4),
(14, 'Chequeo médico general mascota', '49.99', NULL, 5),
(15, 'Chequeo médico general animal grande', '89.99', NULL, 5),
(16, 'Anti-parasitos 3 dosis', '19.99', NULL, 5),
(17, 'Combinado vitaminas', '5.99', NULL, 5),
(18, 'Limpiador oidos', '9.99', NULL, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_promocion`
--

CREATE TABLE `tbl_promocion` (
  `id_pro` int(11) NOT NULL,
  `promocion_pro` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `porcentaje_pro` int(3) DEFAULT NULL,
  `ruleta_pro` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_promocion`
--

INSERT INTO `tbl_promocion` (`id_pro`, `promocion_pro`, `porcentaje_pro`, `ruleta_pro`) VALUES
(1, '-', 0, NULL),
(2, 'Primera compra', 30, NULL),
(3, 'Familiar', 40, NULL),
(4, '5% Descuento', 5, 1),
(5, '1% de descuento', 1, 1),
(6, '3% de descuento', 3, 1),
(7, '2% de descuento', 2, 1),
(8, '6% de descuento', 6, 1),
(9, '7% de descuento', 7, 1),
(10, '13% de descuento', 13, 1),
(11, '20% de descuento', 20, 1),
(12, '15% de descuento', 15, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ranita`
--

CREATE TABLE `tbl_ranita` (
  `id` int(11) NOT NULL,
  `user` varchar(3) NOT NULL,
  `max_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_ranita`
--

INSERT INTO `tbl_ranita` (`id`, `user`, `max_score`) VALUES
(1, 'HOS', 3),
(2, 'GER', 2),
(3, 'ALF', 5),
(4, 'GER', 5),
(5, 'GER', 7),
(14, 'DAN', 3);

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
(2, 'Clinica Ruana1', '12345678', 'ruano@perico.com', NULL, NULL, 3, 3, 3, '08:00:00', '17:00:00', 'marca.com', 'img/c4YPJpCi4IT7FNIN9VAikxBrziFGRdUIqIWgiNnz.png', 'img/1dxxkFCfxHpaNCNM1B6vBpBH82N1IsJY8RDjdhgd.jpg', 1),
(3, 'Protectora Colillas', '12345623', 'colillas@colillas.com', NULL, NULL, 3, 4, 4, '08:00:00', '19:00:00', 'marca.com', 'img/neX4hK5Ekfrm1aiQFFGPRAX2jUtzTZHvtAPckv7P.png', 'img/M4EDdDY7ZoMVfawv2gBEBf6LRvvOxgJhI0HSOgSv.ico', 1);

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
(1, '93517841', '96675795'),
(2, '97467131', '92882222'),
(3, '600800900', NULL),
(4, '678123456', NULL),
(12, '935319662', NULL);

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
(3, 'Protectora');

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
  `pass_us` varchar(129) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_rol_fk` int(11) DEFAULT NULL,
  `id_telefono_fk` int(11) DEFAULT NULL,
  `id_direccion1_fk` int(11) DEFAULT NULL,
  `id_direccion2_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_us`, `nombre_us`, `apellido1_us`, `apellido2_us`, `dni_us`, `email_us`, `pass_us`, `id_rol_fk`, `id_telefono_fk`, `id_direccion1_fk`, `id_direccion2_fk`) VALUES
(1, 'Paco', 'Lopez', 'Lopez', '67896066S', 'paquito@mail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 2, 1, 1, NULL),
(2, 'dani', 'ruano', 'ruano', '12378945', 'dani@e.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 1, NULL, NULL, NULL),
(3, 'Eric', 'Martín', NULL, '1223124', 'traba@jador.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 3, 3, 3, NULL),
(4, 'Marina', 'Martinez', 'Lopez', '1234566S', 'Marina@mail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 2, 3, 3, NULL),
(5, 'Gerard', 'Gomez', 'Monterroso', '1234566S', 'gomezmonterroso14@gmail.com', 'b9f3daea9961ce7544e5680220a1fac28fc673d4c53cf5dd078f341889b3074fc377ce63043023bdd168ed3eba7075d70011b9e88b8f92cce37afd1f1b3b9108', 2, 1, 2, NULL),
(8, 'Gerard', 'Gomez', NULL, '21782389D', 'gomezmonterroso141@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 2, 12, 12, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios_promos_activas`
--

CREATE TABLE `tbl_usuarios_promos_activas` (
  `id_pa` int(11) NOT NULL,
  `fk_id_usr` int(11) NOT NULL,
  `fk_id_promo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_usuarios_promos_activas`
--

INSERT INTO `tbl_usuarios_promos_activas` (`id_pa`, `fk_id_usr`, `fk_id_promo`) VALUES
(1, 1, 7),
(2, 1, 10),
(3, 1, 6),
(4, 1, 5),
(5, 1, 10),
(6, 1, 4),
(7, 1, 3),
(8, 1, 6),
(10, 5, 11),
(11, 5, 6);

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
  `id_usuario_fk` int(11) DEFAULT NULL,
  `id_estado_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_visita`
--

INSERT INTO `tbl_visita` (`id_vi`, `fecha_vi`, `hora_vi`, `asunto_vi`, `diagnostico_vi`, `id_pacienteanimal_fk`, `id_usuario_fk`, `id_estado_fk`) VALUES
(1, '2022-04-05', '19:31:09', 'Se le ha caido un Jose encima', 'Reservado', 1, 1, 1),
(2, '2022-04-10', '15:23:34', 'Que le ha pasao', 'Jose', 1, 2, 1),
(3, '2022-04-05', '18:05:00', 'Yes', 'mas de 8 carac', 15, 1, 1),
(4, '2022-04-26', '20:06:00', 'Asuntillo', NULL, 15, 4, 1),
(5, '2022-05-11', '13:00:00', 'Esta gordita', 'Ya está buena', 3, 5, 3),
(6, '2022-05-12', '10:00:00', 'Pene', NULL, 16, 5, 3),
(7, '2022-05-19', '07:00:00', 'Joder', 'Mala de la barriga', 16, 5, 3),
(8, '2022-05-10', '17:00:00', 'Jolinbo', 'Nada test', 16, 5, 1),
(9, '2022-05-13', '17:00:00', 'Tiene diarrea', 'dede', 16, 5, 3),
(10, '2022-05-15', '03:00:00', 'Que le pasa algo', NULL, 16, 5, 1),
(11, '2022-05-17', '03:00:00', 'Maria', NULL, 16, 5, 1),
(12, '2022-05-18', '03:00:00', 'Mrio', NULL, 16, 5, 1),
(13, '2022-05-26', '03:00:00', 'Mentira', NULL, 16, 5, 3),
(14, '2022-05-21', '13:00:00', 'Esta malita', 'Jejej', 16, 5, 3),
(15, '2022-05-19', '17:00:00', '1', NULL, 16, 5, 2),
(16, '2022-05-19', '18:00:00', '2', NULL, 16, 5, 2),
(17, '2022-05-19', '19:00:00', '3', NULL, 16, 5, 2);

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
  ADD KEY `fk_articulo_tipo_articulo_idx` (`id_tipo_articulo_fk`),
  ADD KEY `fk_articulo_foto` (`id_foto_fk`);

--
-- Indices de la tabla `tbl_categoria_articulo`
--
ALTER TABLE `tbl_categoria_articulo`
  ADD PRIMARY KEY (`id_cat`),
  ADD KEY `articulo_categoria_fk` (`articulo_fk`);

--
-- Indices de la tabla `tbl_clientes_promo`
--
ALTER TABLE `tbl_clientes_promo`
  ADD PRIMARY KEY (`id_cli_pro`),
  ADD KEY `fk_id_us` (`fk_id_us`);

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
-- Indices de la tabla `tbl_direccion_geoguesser`
--
ALTER TABLE `tbl_direccion_geoguesser`
  ADD PRIMARY KEY (`id_dir_geo`),
  ADD KEY `tbl_direccion_geoguesser_ibfk_1` (`fk_id_geo`);

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
  ADD KEY `fk_factura_usuario_idx` (`id_usuario_fk`),
  ADD KEY `fk_veterinario` (`id_veterinario_fk`);

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
-- Indices de la tabla `tbl_geoguesser`
--
ALTER TABLE `tbl_geoguesser`
  ADD PRIMARY KEY (`id_geo`);

--
-- Indices de la tabla `tbl_marca`
--
ALTER TABLE `tbl_marca`
  ADD PRIMARY KEY (`id_ma`);

--
-- Indices de la tabla `tbl_opinion_articulo`
--
ALTER TABLE `tbl_opinion_articulo`
  ADD PRIMARY KEY (`id_op`),
  ADD KEY `articulo_opinion_fk` (`articulo_fk`),
  ADD KEY `usuario_opinion_fk` (`usuario_fk`);

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
-- Indices de la tabla `tbl_ranita`
--
ALTER TABLE `tbl_ranita`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `tbl_usuarios_promos_activas`
--
ALTER TABLE `tbl_usuarios_promos_activas`
  ADD PRIMARY KEY (`id_pa`),
  ADD KEY `fk_id_usr` (`fk_id_usr`),
  ADD KEY `fk_id_promo` (`fk_id_promo`);

--
-- Indices de la tabla `tbl_visita`
--
ALTER TABLE `tbl_visita`
  ADD PRIMARY KEY (`id_vi`),
  ADD KEY `fk_visita_pacienteanimal_idx` (`id_pacienteanimal_fk`),
  ADD KEY `fk_visita_usuario_idx` (`id_usuario_fk`),
  ADD KEY `fk_visita_estado` (`id_estado_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_animales_perdidos`
--
ALTER TABLE `tbl_animales_perdidos`
  MODIFY `id_ape` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_articulo_tienda`
--
ALTER TABLE `tbl_articulo_tienda`
  MODIFY `id_art` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `tbl_categoria_articulo`
--
ALTER TABLE `tbl_categoria_articulo`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tbl_clientes_promo`
--
ALTER TABLE `tbl_clientes_promo`
  MODIFY `id_cli_pro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_detallefactura_clinica`
--
ALTER TABLE `tbl_detallefactura_clinica`
  MODIFY `id_dfc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `tbl_detallefactura_tienda`
--
ALTER TABLE `tbl_detallefactura_tienda`
  MODIFY `id_dft` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT de la tabla `tbl_direccion`
--
ALTER TABLE `tbl_direccion`
  MODIFY `id_di` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tbl_direccion_geoguesser`
--
ALTER TABLE `tbl_direccion_geoguesser`
  MODIFY `id_dir_geo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `tbl_estado`
--
ALTER TABLE `tbl_estado`
  MODIFY `id_est` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_factura_clinica`
--
ALTER TABLE `tbl_factura_clinica`
  MODIFY `id_fc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `tbl_factura_tienda`
--
ALTER TABLE `tbl_factura_tienda`
  MODIFY `id_ft` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT de la tabla `tbl_foto`
--
ALTER TABLE `tbl_foto`
  MODIFY `id_f` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_geoguesser`
--
ALTER TABLE `tbl_geoguesser`
  MODIFY `id_geo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_marca`
--
ALTER TABLE `tbl_marca`
  MODIFY `id_ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `tbl_opinion_articulo`
--
ALTER TABLE `tbl_opinion_articulo`
  MODIFY `id_op` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `tbl_pacienteanimal_clinica`
--
ALTER TABLE `tbl_pacienteanimal_clinica`
  MODIFY `id_pa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tbl_producto_clinica`
--
ALTER TABLE `tbl_producto_clinica`
  MODIFY `id_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tbl_promocion`
--
ALTER TABLE `tbl_promocion`
  MODIFY `id_pro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tbl_ranita`
--
ALTER TABLE `tbl_ranita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tbl_rol`
--
ALTER TABLE `tbl_rol`
  MODIFY `id_ro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_sociedad`
--
ALTER TABLE `tbl_sociedad`
  MODIFY `id_s` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `id_st` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_telefono`
--
ALTER TABLE `tbl_telefono`
  MODIFY `id_tel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_articulo`
--
ALTER TABLE `tbl_tipo_articulo`
  MODIFY `id_ta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_sociedad`
--
ALTER TABLE `tbl_tipo_sociedad`
  MODIFY `id_ts` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


