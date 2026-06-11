-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2026 a las 09:09:42
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bolsadb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id_departamento` int(11) NOT NULL,
  `departamento` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id_departamento`, `departamento`) VALUES
(1, 'Ahuachapán'),
(2, 'Cabañas'),
(3, 'Chalatenango'),
(4, 'Cuscatlán'),
(5, 'La Libertad'),
(6, 'La Paz'),
(7, 'La Unión'),
(8, 'Morazán'),
(9, 'San Miguel'),
(10, 'San Salvador'),
(11, 'San Vicente'),
(12, 'Santa Ana'),
(13, 'Sonsonate'),
(14, 'Usulután');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distritos`
--

CREATE TABLE `distritos` (
  `id_distrito` int(11) NOT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `distrito` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `distritos`
--

INSERT INTO `distritos` (`id_distrito`, `id_departamento`, `distrito`) VALUES
(1, 1, 'Ahuachapán Norte'),
(2, 1, 'Ahuachapán Centro'),
(3, 1, 'Ahuachapán Sur'),
(4, 2, 'Cabañas Oeste'),
(5, 2, 'Cabañas Este'),
(6, 3, 'Chalatenango Norte'),
(7, 3, 'Chalatenango Centro'),
(8, 3, 'Chalatenango Sur'),
(9, 4, 'Cojutepeque'),
(10, 4, 'Suchitoto'),
(11, 5, 'La Libertad Norte'),
(12, 5, 'La Libertad Centro'),
(13, 5, 'La Libertad Este'),
(14, 5, 'La Libertad Oeste'),
(15, 5, 'La Libertad Sur'),
(16, 5, 'Nueva San Salvador'),
(17, 6, 'La Paz Oeste'),
(18, 6, 'La Paz Centro'),
(19, 6, 'La Paz Este'),
(20, 7, 'La Unión Norte'),
(21, 7, 'La Unión Centro'),
(22, 7, 'La Unión Sur'),
(23, 8, 'Morazán Norte'),
(24, 8, 'Morazán Centro'),
(25, 8, 'Morazán Sur'),
(26, 9, 'San Miguel Norte'),
(27, 9, 'San Miguel Centro'),
(28, 9, 'San Miguel Oeste'),
(29, 10, 'San Salvador Norte'),
(30, 10, 'San Salvador Oeste'),
(31, 10, 'San Salvador Este'),
(32, 10, 'San Salvador Centro'),
(33, 11, 'San Vicente Norte'),
(34, 11, 'San Vicente Sur'),
(35, 12, 'Santa Ana Norte'),
(36, 12, 'Santa Ana Centro'),
(37, 12, 'Santa Ana Este'),
(38, 13, 'Sonsonate Norte'),
(39, 13, 'Sonsonate Centro'),
(40, 13, 'Sonsonate Sur'),
(41, 13, 'Sonsonate Este'),
(42, 14, 'Usulután Norte'),
(43, 14, 'Usulután Centro'),
(44, 14, 'Usulután Este'),
(45, 14, 'Usulután Oeste');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id_empresa` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `nombre_empresa` varchar(150) NOT NULL,
  `correo_empresa` varchar(100) NOT NULL,
  `telefono_empresa` varchar(20) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `fecha_registro_empresa` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrevistas`
--

CREATE TABLE `entrevistas` (
  `id_entrevista` int(11) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `id_postulacion` int(11) DEFAULT NULL,
  `fecha_hora` datetime NOT NULL,
  `tipo` enum('presencial','virtual','telefonica') DEFAULT NULL,
  `estado` enum('programada','realizada','cancelada') DEFAULT 'programada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudios`
--

CREATE TABLE `estudios` (
  `id_estudio` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_nivel_academico` int(11) DEFAULT NULL,
  `titulo` varchar(150) DEFAULT NULL,
  `fecha_logro` date DEFAULT NULL,
  `institucion` varchar(150) NOT NULL,
  `estado` enum('En curso','Finalizado','Suspendido') DEFAULT 'Finalizado',
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudios`
--

INSERT INTO `estudios` (`id_estudio`, `id_usuario`, `id_nivel_academico`, `titulo`, `fecha_logro`, `institucion`, `estado`, `descripcion`, `created_at`) VALUES
(2, 1, NULL, 'Bachiller General', '2026-06-18', 'INJI', 'Finalizado', 'dfghjkl;', '2026-06-11 04:23:49'),
(3, 1, NULL, 'Bachiller General', '2026-06-18', 'INJI', 'Finalizado', 'lol', '2026-06-11 04:45:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencia`
--

CREATE TABLE `experiencia` (
  `id_experiencia` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `empresa` varchar(150) NOT NULL,
  `puesto` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `experiencia`
--

INSERT INTO `experiencia` (`id_experiencia`, `id_usuario`, `empresa`, `puesto`, `descripcion`, `fecha_inicio`, `fecha_fin`) VALUES
(5, 1, 'Texaco', 'Cajera', 'hola', '2026-06-10', '2026-06-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habilidades`
--

CREATE TABLE `habilidades` (
  `id_habilidad` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `habilidad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habilidades`
--

INSERT INTO `habilidades` (`id_habilidad`, `id_usuario`, `habilidad`) VALUES
(1, 1, 'trabajo en equipo'),
(2, 1, 'lol');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id_municipio` int(11) NOT NULL,
  `id_distrito` int(11) DEFAULT NULL,
  `municipio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id_municipio`, `id_distrito`, `municipio`) VALUES
(1, 1, 'Ahuachapán'),
(2, 1, 'Apaneca'),
(3, 1, 'Atiquizaya'),
(4, 1, 'El Refugio'),
(5, 1, 'San Lorenzo'),
(6, 1, 'Turín'),
(7, 2, 'Concepción de Ataco'),
(8, 2, 'Guaymango'),
(9, 2, 'Tacuba'),
(10, 3, 'Jujutla'),
(11, 3, 'San Francisco Menéndez'),
(12, 3, 'San Pedro Puxtla'),
(13, 4, 'Cinquera'),
(14, 4, 'Ilobasco'),
(15, 4, 'Jutiapa'),
(16, 4, 'Tejutepeque'),
(17, 5, 'Dolores'),
(18, 5, 'Guacotecti'),
(19, 5, 'San Isidro'),
(20, 5, 'Sensuntepeque'),
(21, 5, 'Victoria'),
(22, 6, 'Agua Caliente'),
(23, 6, 'Arcatao'),
(24, 6, 'Azacualpa'),
(25, 6, 'Citalá'),
(26, 6, 'El Carrizal'),
(27, 6, 'La Laguna'),
(28, 6, 'La Palma'),
(29, 6, 'Las Vueltas'),
(30, 6, 'Nombre de Jesús'),
(31, 6, 'Nueva Trinidad'),
(32, 6, 'San Fernando'),
(33, 6, 'San Francisco Lempa'),
(34, 6, 'San Ignacio'),
(35, 6, 'San Luis del Carmen'),
(36, 7, 'Chalatenango'),
(37, 7, 'Comalapa'),
(38, 7, 'Concepción Quezaltepeque'),
(39, 7, 'Dulce Nombre de María'),
(40, 7, 'El Paraíso'),
(41, 7, 'La Reina'),
(42, 7, 'Nueva Concepción'),
(43, 7, 'Ojos de Agua'),
(44, 7, 'Potonico'),
(45, 7, 'San Antonio de la Cruz'),
(46, 7, 'San Antonio Los Ranchos'),
(47, 7, 'San Francisco Morazán'),
(48, 7, 'San José Cancasque'),
(49, 7, 'San Miguel de Mercedes'),
(50, 7, 'San Rafael'),
(51, 8, 'Tejutla'),
(52, 8, 'San Juan Tejutla'),
(53, 9, 'Cojutepeque'),
(54, 9, 'Monte San Juan'),
(55, 9, 'El Carmen'),
(56, 9, 'El Rosario'),
(57, 9, 'Oratorio de Concepción'),
(58, 9, 'San Cristóbal'),
(59, 9, 'San Pedro Perulapán'),
(60, 9, 'San Rafael Cedros'),
(61, 9, 'Santa Cruz Analquito'),
(62, 9, 'Santa Cruz Michapa'),
(63, 9, 'Suchitoto'),
(64, 9, 'San José Guayabal'),
(65, 10, 'Suchitoto'),
(66, 10, 'San Bartolomé Perulapía'),
(67, 11, 'Quezaltepeque'),
(68, 11, 'San Pablo Tacachico'),
(69, 11, 'San Juan Opico'),
(70, 11, 'Ciudad Arce'),
(71, 12, 'Colón'),
(72, 12, 'Jayaque'),
(73, 12, 'Sacacoyo'),
(74, 12, 'Tepecoyo'),
(75, 12, 'Talnique'),
(76, 13, 'Antiguo Cuscatlán'),
(77, 13, 'Huizúcar'),
(78, 13, 'San José Villanueva'),
(79, 13, 'Zaragoza'),
(80, 14, 'Chiltiupán'),
(81, 14, 'Jicalapa'),
(82, 14, 'La Libertad'),
(83, 14, 'Tamanique'),
(84, 14, 'Teotepeque'),
(85, 15, 'San Luis Talpa'),
(86, 15, 'Comasagua'),
(87, 16, 'Santa Tecla'),
(88, 16, 'Nuevo Cuscatlán'),
(89, 17, 'Cuyultitán'),
(90, 17, 'El Rosario'),
(91, 17, 'Olocuilta'),
(92, 17, 'San Juan Talpa'),
(93, 17, 'San Luis Talpa'),
(94, 17, 'San Pedro Masahuat'),
(95, 17, 'Santa María Ostuma'),
(96, 17, 'Santiago Nonualco'),
(97, 18, 'San Juan Nonualco'),
(98, 18, 'San Rafael Obrajuelo'),
(99, 18, 'Santa Lucía'),
(100, 18, 'Zacatecoluca'),
(101, 19, 'Jerusalén'),
(102, 19, 'Mercedes La Ceiba'),
(103, 19, 'San Antonio Masahuat'),
(104, 19, 'San Emigdio'),
(105, 19, 'San Francisco Chinameca'),
(106, 19, 'San Miguel Tepezontes'),
(107, 19, 'San Pedro Nonualco'),
(108, 19, 'Santa Elena'),
(109, 20, 'Concepción de Oriente'),
(110, 20, 'El Sauce'),
(111, 20, 'Lislique'),
(112, 20, 'Nueva Esparta'),
(113, 20, 'Polorós'),
(114, 20, 'Santa Rosa de Lima'),
(115, 21, 'Anamorós'),
(116, 21, 'Bolívar'),
(117, 21, 'El Carmen'),
(118, 21, 'Pasaquina'),
(119, 21, 'San José La Fuente'),
(120, 21, 'Yayantique'),
(121, 21, 'Yucuaiquín'),
(122, 22, 'Conchagua'),
(123, 22, 'Intipucá'),
(124, 22, 'La Unión'),
(125, 22, 'Meanguera del Golfo'),
(126, 22, 'San Alejo'),
(127, 23, 'Arambala'),
(128, 23, 'Cacaopera'),
(129, 23, 'Corinto'),
(130, 23, 'El Rosario'),
(131, 23, 'Gualococti'),
(132, 23, 'Joateca'),
(133, 23, 'Meanguera'),
(134, 23, 'Perquín'),
(135, 23, 'San Fernando'),
(136, 23, 'San Isidro'),
(137, 23, 'Torola'),
(138, 24, 'Chilanga'),
(139, 24, 'Delicias de Concepción'),
(140, 24, 'El Divisadero'),
(141, 24, 'Guatajiagua'),
(142, 24, 'Jocoaitique'),
(143, 24, 'Lolotiquillo'),
(144, 24, 'Osicala'),
(145, 24, 'San Carlos'),
(146, 24, 'San Francisco Gotera'),
(147, 24, 'San Simón'),
(148, 24, 'Sensembra'),
(149, 24, 'Sociedad'),
(150, 24, 'Yamabal'),
(151, 24, 'Yoloaiquín'),
(152, 25, 'Chapeltique'),
(153, 25, 'San Augusto'),
(154, 26, 'Ciudad Barrios'),
(155, 26, 'Nuevo Edén de San Juan'),
(156, 26, 'San Antonio'),
(157, 26, 'San Luis de la Reina'),
(158, 26, 'Sesori'),
(159, 27, 'Carolina'),
(160, 27, 'Chapeltique'),
(161, 27, 'Chinameca'),
(162, 27, 'Chirilagua'),
(163, 27, 'El Tránsito'),
(164, 27, 'Moncagua'),
(165, 27, 'Nueva Guadalupe'),
(166, 27, 'Quelepa'),
(167, 27, 'San Miguel'),
(168, 27, 'San Rafael Oriente'),
(169, 28, 'Comacarán'),
(170, 28, 'Uluazapa'),
(171, 29, 'Apopa'),
(172, 29, 'Guazapa'),
(173, 29, 'Nejapa'),
(174, 30, 'Cuscatancingo'),
(175, 30, 'El Paisnal'),
(176, 30, 'Mejicanos'),
(177, 30, 'San Marcos'),
(178, 30, 'San Martín'),
(179, 30, 'Tonacatepeque'),
(180, 31, 'Ilopango'),
(181, 31, 'San Salvador'),
(182, 31, 'Soyapango'),
(183, 32, 'Aguilares'),
(184, 32, 'Ayutuxtepeque'),
(185, 32, 'Delgado'),
(186, 32, 'Panchimalco'),
(187, 32, 'Rosario de Mora'),
(188, 32, 'San Salvador'),
(189, 32, 'Santiago Texacuangos'),
(190, 32, 'Santo Tomás'),
(191, 32, 'Santo Tomás'),
(192, 33, 'Apastepeque'),
(193, 33, 'Guadalupe'),
(194, 33, 'San Cayetano Istepeque'),
(195, 33, 'San Esteban Catarina'),
(196, 33, 'San Ildefonso'),
(197, 33, 'San Lorenzo'),
(198, 33, 'San Sebastián'),
(199, 33, 'Santa Clara'),
(200, 33, 'Santo Domingo'),
(201, 34, 'San Vicente'),
(202, 34, 'Tecoluca'),
(203, 34, 'Tepetitán'),
(204, 34, 'Verapaz'),
(205, 35, 'Metapán'),
(206, 35, 'Santa Rosa Guachipilín'),
(207, 35, 'Texistepeque'),
(208, 36, 'Candelaria de la Frontera'),
(209, 36, 'Coatepeque'),
(210, 36, 'El Congo'),
(211, 36, 'El Porvenir'),
(212, 36, 'Masahuat'),
(213, 36, 'Santa Ana'),
(214, 37, 'Chalchuapa'),
(215, 37, 'San Antonio Pajonal'),
(216, 37, 'San Sebastián Salitrillo'),
(217, 37, 'Santiago de la Frontera'),
(218, 38, 'Armenia'),
(219, 38, 'Caluco'),
(220, 38, 'Cuisnahuat'),
(221, 38, 'Izalco'),
(222, 38, 'Nahuizalco'),
(223, 38, 'Nahulingo'),
(224, 38, 'Salcoatitán'),
(225, 38, 'San Antonio del Monte'),
(226, 38, 'San Julián'),
(227, 38, 'Santa Catarina Masahuat'),
(228, 38, 'Santa Isabel Ishuatán'),
(229, 38, 'Santo Domingo de Guzmán'),
(230, 38, 'Sonsonate'),
(231, 38, 'Sonzacate'),
(232, 39, 'Acajutla'),
(233, 40, 'Cuisnahuat'),
(234, 40, 'San Pedro Puxtla'),
(235, 41, 'Juayúa'),
(236, 41, 'Apaneca'),
(237, 42, 'Alegría'),
(238, 42, 'Berlín'),
(239, 42, 'California'),
(240, 42, 'Jucuapa'),
(241, 42, 'Mercedes Umaña'),
(242, 42, 'Nueva Granada'),
(243, 42, 'San Buenaventura'),
(244, 42, 'Santiago de María'),
(245, 42, 'Tecapán'),
(246, 43, 'Concepción Batres'),
(247, 43, 'El Triunfo'),
(248, 43, 'Ereguayquín'),
(249, 43, 'Estanzuelas'),
(250, 43, 'Jiquilisco'),
(251, 43, 'Ozatlán'),
(252, 43, 'Puerto El Triunfo'),
(253, 43, 'San Agustín'),
(254, 43, 'San Dionisio'),
(255, 43, 'Santa Elena'),
(256, 43, 'Usulután'),
(257, 44, 'Chirilagua'),
(258, 44, 'Jucuarán'),
(259, 44, 'San Francisco Javier'),
(260, 45, 'Colomoncagua'),
(261, 45, 'Santa María');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_notificacion` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `mensaje` text NOT NULL,
  `fecha_envio` datetime DEFAULT current_timestamp(),
  `leida` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta_empleos`
--

CREATE TABLE `oferta_empleos` (
  `id_oferta` int(11) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `id_distrito` int(11) DEFAULT NULL,
  `id_municipio` int(11) DEFAULT NULL,
  `titulo` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `tipo_contrato` enum('Tiempo completo','Medio tiempo','Temporal','Freelance') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_empresa`
--

CREATE TABLE `perfil_empresa` (
  `id_perfil_empresa` int(11) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `sector` varchar(100) DEFAULT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `id_distrito` int(11) DEFAULT NULL,
  `id_municipio` int(11) DEFAULT NULL,
  `sitio_web` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_usuario`
--

CREATE TABLE `perfil_usuario` (
  `id_perfil` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `id_distrito` int(11) DEFAULT NULL,
  `id_municipio` int(11) DEFAULT NULL,
  `id_profesion` int(11) DEFAULT NULL,
  `id_experiencia` int(11) DEFAULT NULL,
  `id_habilidades` int(11) DEFAULT NULL,
  `nacionalidad` varchar(50) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `genero` enum('M','F','O') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfil_usuario`
--

INSERT INTO `perfil_usuario` (`id_perfil`, `id_usuario`, `id_departamento`, `id_distrito`, `id_municipio`, `id_profesion`, `id_experiencia`, `id_habilidades`, `nacionalidad`, `telefono`, `foto`, `genero`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Honduras', '60722336', '', 'F');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permisos` int(11) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `titulo_permiso` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postulaciones`
--

CREATE TABLE `postulaciones` (
  `id_postulacion` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_oferta` int(11) DEFAULT NULL,
  `fecha_postulacion` datetime DEFAULT current_timestamp(),
  `estado` enum('pendiente','revisada','aceptada','rechazada') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesion`
--

CREATE TABLE `profesion` (
  `id_profesion` int(11) NOT NULL,
  `profesion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referencias`
--

CREATE TABLE `referencias` (
  `id_referencias` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre_referencia` varchar(100) NOT NULL,
  `telefono_contacto` varchar(20) DEFAULT NULL,
  `correo_contacto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `referencias`
--

INSERT INTO `referencias` (`id_referencias`, `id_usuario`, `nombre_referencia`, `telefono_contacto`, `correo_contacto`) VALUES
(1, 1, 'Margarita Santana', '60722336', 'margot@gmail.com'),
(2, 1, 'Margarita Santana', '60722336', 'margot@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `rol` enum('admin','usuario') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'admin'),
(2, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `id_rol` int(11) NOT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `correo`, `password`, `estado`, `id_rol`, `fecha_registro`) VALUES
(1, 'Margarita Santana', 'Margarita Santana', '', '', 'activo', 2, '2026-06-10 19:53:03');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id_departamento`);

--
-- Indices de la tabla `distritos`
--
ALTER TABLE `distritos`
  ADD PRIMARY KEY (`id_distrito`),
  ADD KEY `id_departamento` (`id_departamento`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresa`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `entrevistas`
--
ALTER TABLE `entrevistas`
  ADD PRIMARY KEY (`id_entrevista`),
  ADD KEY `id_empresa` (`id_empresa`),
  ADD KEY `id_postulacion` (`id_postulacion`);

--
-- Indices de la tabla `estudios`
--
ALTER TABLE `estudios`
  ADD PRIMARY KEY (`id_estudio`),
  ADD KEY `fk_estudios_perfil_usuario` (`id_usuario`),
  ADD KEY `fk_estudios_nivel_academico` (`id_nivel_academico`);

--
-- Indices de la tabla `experiencia`
--
ALTER TABLE `experiencia`
  ADD PRIMARY KEY (`id_experiencia`),
  ADD KEY `fk_experiencia_usuario` (`id_usuario`);

--
-- Indices de la tabla `habilidades`
--
ALTER TABLE `habilidades`
  ADD PRIMARY KEY (`id_habilidad`),
  ADD KEY `fk_habilidad_usuario` (`id_usuario`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id_municipio`),
  ADD KEY `id_distrito` (`id_distrito`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id_notificacion`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `oferta_empleos`
--
ALTER TABLE `oferta_empleos`
  ADD PRIMARY KEY (`id_oferta`),
  ADD KEY `id_empresa` (`id_empresa`),
  ADD KEY `id_departamento` (`id_departamento`),
  ADD KEY `id_municipio` (`id_municipio`),
  ADD KEY `fk_oferta_empleos_distrito` (`id_distrito`);

--
-- Indices de la tabla `perfil_empresa`
--
ALTER TABLE `perfil_empresa`
  ADD PRIMARY KEY (`id_perfil_empresa`),
  ADD KEY `id_empresa` (`id_empresa`),
  ADD KEY `fk_perfil_empresa_departamento` (`id_departamento`),
  ADD KEY `fk_perfil_empresa_distrito` (`id_distrito`),
  ADD KEY `fk_perfil_empresa_municipio` (`id_municipio`);

--
-- Indices de la tabla `perfil_usuario`
--
ALTER TABLE `perfil_usuario`
  ADD PRIMARY KEY (`id_perfil`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_departamento` (`id_departamento`),
  ADD KEY `id_distrito` (`id_distrito`),
  ADD KEY `id_municipio` (`id_municipio`),
  ADD KEY `id_profesion` (`id_profesion`),
  ADD KEY `id_experiencia` (`id_experiencia`),
  ADD KEY `id_habilidades` (`id_habilidades`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permisos`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `postulaciones`
--
ALTER TABLE `postulaciones`
  ADD PRIMARY KEY (`id_postulacion`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_oferta` (`id_oferta`);

--
-- Indices de la tabla `profesion`
--
ALTER TABLE `profesion`
  ADD PRIMARY KEY (`id_profesion`);

--
-- Indices de la tabla `referencias`
--
ALTER TABLE `referencias`
  ADD PRIMARY KEY (`id_referencias`),
  ADD KEY `fk_referencia_usuario` (`id_usuario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `distritos`
--
ALTER TABLE `distritos`
  MODIFY `id_distrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entrevistas`
--
ALTER TABLE `entrevistas`
  MODIFY `id_entrevista` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estudios`
--
ALTER TABLE `estudios`
  MODIFY `id_estudio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `experiencia`
--
ALTER TABLE `experiencia`
  MODIFY `id_experiencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `habilidades`
--
ALTER TABLE `habilidades`
  MODIFY `id_habilidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id_notificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `oferta_empleos`
--
ALTER TABLE `oferta_empleos`
  MODIFY `id_oferta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `perfil_empresa`
--
ALTER TABLE `perfil_empresa`
  MODIFY `id_perfil_empresa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `perfil_usuario`
--
ALTER TABLE `perfil_usuario`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permisos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `postulaciones`
--
ALTER TABLE `postulaciones`
  MODIFY `id_postulacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `profesion`
--
ALTER TABLE `profesion`
  MODIFY `id_profesion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `referencias`
--
ALTER TABLE `referencias`
  MODIFY `id_referencias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `distritos`
--
ALTER TABLE `distritos`
  ADD CONSTRAINT `distritos_ibfk_1` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id_departamento`) ON DELETE SET NULL;

--
-- Filtros para la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `empresas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL;

--
-- Filtros para la tabla `entrevistas`
--
ALTER TABLE `entrevistas`
  ADD CONSTRAINT `entrevistas_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`) ON DELETE CASCADE,
  ADD CONSTRAINT `entrevistas_ibfk_2` FOREIGN KEY (`id_postulacion`) REFERENCES `postulaciones` (`id_postulacion`) ON DELETE CASCADE;

--
-- Filtros para la tabla `estudios`
--
ALTER TABLE `estudios`
  ADD CONSTRAINT `fk_estudios_nivel_academico` FOREIGN KEY (`id_nivel_academico`) REFERENCES `profesion` (`id_profesion`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_estudios_perfil_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `experiencia`
--
ALTER TABLE `experiencia`
  ADD CONSTRAINT `fk_experiencia_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `habilidades`
--
ALTER TABLE `habilidades`
  ADD CONSTRAINT `fk_habilidad_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `municipios_ibfk_1` FOREIGN KEY (`id_distrito`) REFERENCES `distritos` (`id_distrito`) ON DELETE SET NULL;

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `oferta_empleos`
--
ALTER TABLE `oferta_empleos`
  ADD CONSTRAINT `fk_oferta_empleos_distrito` FOREIGN KEY (`id_distrito`) REFERENCES `distritos` (`id_distrito`) ON DELETE SET NULL,
  ADD CONSTRAINT `oferta_empleos_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`) ON DELETE CASCADE,
  ADD CONSTRAINT `oferta_empleos_ibfk_2` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id_departamento`) ON DELETE SET NULL,
  ADD CONSTRAINT `oferta_empleos_ibfk_3` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id_municipio`) ON DELETE SET NULL;

--
-- Filtros para la tabla `perfil_empresa`
--
ALTER TABLE `perfil_empresa`
  ADD CONSTRAINT `fk_perfil_empresa_departamento` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id_departamento`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_perfil_empresa_distrito` FOREIGN KEY (`id_distrito`) REFERENCES `distritos` (`id_distrito`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_perfil_empresa_municipio` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id_municipio`) ON DELETE SET NULL,
  ADD CONSTRAINT `perfil_empresa_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`) ON DELETE CASCADE;

--
-- Filtros para la tabla `perfil_usuario`
--
ALTER TABLE `perfil_usuario`
  ADD CONSTRAINT `perfil_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `perfil_usuario_ibfk_2` FOREIGN KEY (`id_departamento`) REFERENCES `departamentos` (`id_departamento`) ON DELETE SET NULL,
  ADD CONSTRAINT `perfil_usuario_ibfk_3` FOREIGN KEY (`id_distrito`) REFERENCES `distritos` (`id_distrito`) ON DELETE SET NULL,
  ADD CONSTRAINT `perfil_usuario_ibfk_4` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id_municipio`) ON DELETE SET NULL,
  ADD CONSTRAINT `perfil_usuario_ibfk_5` FOREIGN KEY (`id_profesion`) REFERENCES `profesion` (`id_profesion`) ON DELETE SET NULL,
  ADD CONSTRAINT `perfil_usuario_ibfk_6` FOREIGN KEY (`id_experiencia`) REFERENCES `experiencia` (`id_experiencia`) ON DELETE SET NULL,
  ADD CONSTRAINT `perfil_usuario_ibfk_7` FOREIGN KEY (`id_habilidades`) REFERENCES `habilidades` (`id_habilidad`) ON DELETE SET NULL;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE;

--
-- Filtros para la tabla `postulaciones`
--
ALTER TABLE `postulaciones`
  ADD CONSTRAINT `postulaciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `postulaciones_ibfk_2` FOREIGN KEY (`id_oferta`) REFERENCES `oferta_empleos` (`id_oferta`) ON DELETE CASCADE;

--
-- Filtros para la tabla `referencias`
--
ALTER TABLE `referencias`
  ADD CONSTRAINT `fk_referencia_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



-- actualizacion 11/06/2026

-- Ajuste de tablas para usar id_perfil

-- ESTUDIOS
ALTER TABLE estudios
DROP FOREIGN KEY fk_estudios_perfil_usuario;
ALTER TABLE estudios
DROP COLUMN id_usuario;
ALTER TABLE estudios
ADD COLUMN id_perfil INT;
ALTER TABLE estudios
ADD CONSTRAINT fk_estudios_perfil
FOREIGN KEY (id_perfil) REFERENCES perfil_usuario(id_perfil);

-- REFERENCIAS
ALTER TABLE referencias
DROP FOREIGN KEY fk_referencia_usuario;
ALTER TABLE referencias
DROP COLUMN id_usuario;
ALTER TABLE referencias
ADD COLUMN id_perfil INT;
ALTER TABLE referencias
ADD CONSTRAINT fk_referencias_perfil
FOREIGN KEY (id_perfil) REFERENCES perfil_usuario(id_perfil);

-- PROFESION (no tenía id_usuario)
ALTER TABLE profesion
ADD COLUMN id_perfil INT;
ALTER TABLE profesion
ADD CONSTRAINT fk_profesion_perfil
FOREIGN KEY (id_perfil) REFERENCES perfil_usuario(id_perfil);

-- HABILIDADES
ALTER TABLE habilidades
DROP FOREIGN KEY fk_habilidad_usuario;
ALTER TABLE habilidades
DROP COLUMN id_usuario;
ALTER TABLE habilidades
ADD COLUMN id_perfil INT;
ALTER TABLE habilidades
ADD CONSTRAINT fk_habilidades_perfil
FOREIGN KEY (id_perfil) REFERENCES perfil_usuario(id_perfil);

-- cambiarlas a posición después del las columnas pk


-- ESTUDIOS
ALTER TABLE estudios
MODIFY COLUMN id_perfil INT AFTER id_estudio;

-- REFERENCIAS
ALTER TABLE referencias
MODIFY COLUMN id_perfil INT AFTER id_referencias;

-- PROFESION
ALTER TABLE profesion
MODIFY COLUMN id_perfil INT AFTER id_profesion;

-- HABILIDADES
ALTER TABLE habilidades
MODIFY COLUMN id_perfil INT AFTER id_habilidad;
