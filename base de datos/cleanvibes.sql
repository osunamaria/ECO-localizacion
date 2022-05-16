-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-02-2022 a las 18:29:06
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cleanvibes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contabilidad`
--

CREATE TABLE `contabilidad` (
  `gasto_evento` int(5) NOT NULL,
  `gasto_instalacion` int(5) NOT NULL,
  `gasto_otro` int(5) NOT NULL,
  `ingreso_cuotas` int(5) NOT NULL COMMENT 'Mensualidad de los clientes',
  `ingreso_reservas` int(5) NOT NULL COMMENT 'Alquiler de pistas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contabilidad`
--

INSERT INTO `contabilidad` (`gasto_evento`, `gasto_instalacion`, `gasto_otro`, `ingreso_cuotas`, `ingreso_reservas`) VALUES
(100, 50, 1000, 3000, 580);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento_noticia`
--

CREATE TABLE `evento_noticia` (
  `id` int(2) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `publicacion` enum('evento','noticia') NOT NULL,
  `tipo` enum('publico','privado') NOT NULL,
  `contenido` varchar(100) NOT NULL,
  `fecha` date NOT NULL COMMENT 'Fecha de publicación'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `evento_noticia`
--

INSERT INTO `evento_noticia` (`id`, `titulo`, `publicacion`, `tipo`, `contenido`, `fecha`) VALUES
(1, 'Torneo futbol', 'evento', 'publico', 'Torneín de futbol para mancos', '2022-02-08'),
(2, 'Se cae el techo del ala este', 'noticia', 'publico', 'Jezu ha tirado el techo del ala este', '2022-02-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instalaciones`
--

CREATE TABLE `instalaciones` (
  `id` int(2) NOT NULL,
  `tipo` enum('padel','tenis','futbol','baloncesto','barbacoa') NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `localizacion` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `instalaciones`
--

INSERT INTO `instalaciones` (`id`, `tipo`, `nombre`, `localizacion`) VALUES
(1, 'padel', 'casiopea', 'ala noreste'),
(2, 'padel', 'osa menor', 'ala sureste'),
(3, 'tenis', 'scorpio', 'ala sur'),
(4, 'tenis', 'osa mayor', 'ala norte'),
(5, 'futbol', 'capricornio', 'ala este'),
(6, 'baloncesto', 'taurus', 'ala oeste'),
(7, 'barbacoa', 'andromeda', 'ala suroeste');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_instalacion` int(2) NOT NULL,
  `id_socio` int(4) NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `num_socios` int(2) NOT NULL,
  `num_no_socios` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_instalacion`, `id_socio`, `fecha`, `hora_inicio`, `hora_fin`, `num_socios`, `num_no_socios`) VALUES
(1, 4, '2022-02-05', '18:00:00', '19:30:00', 1, 3),
(5, 4, '2022-02-03', '18:00:00', '19:30:00', 1, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE `socios` (
  `id` int(4) NOT NULL,
  `usuario` varchar(10) NOT NULL,
  `contrasena` varchar(15) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `dni` varchar(9) NOT NULL,
  `tipo` set('socio','presidente','administrador') NOT NULL DEFAULT 'socio' COMMENT 'Mínimo un rol',
  `correo` varchar(30) NOT NULL,
  `telefono` int(9) NOT NULL,
  `fecnac` date NOT NULL COMMENT 'Mayores de 14 (salvo autorización)',
  `num_miembros` int(2) NOT NULL DEFAULT 1,
  `cuota` int(2) NOT NULL DEFAULT 60 COMMENT 'Entre 2 y 5 = 70; entre 6 y 10 = 85; más de 10 = 90',
  `confirmado` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `socios`
--

INSERT INTO `socios` (`id`, `usuario`, `contrasena`, `nombre`, `apellidos`, `dni`, `tipo`, `correo`, `telefono`, `fecnac`, `num_miembros`, `cuota`, `confirmado`) VALUES
(1, 'paco', '1234', 'paco', 'palote', '55555555P', 'administrador', 'unervbrdsb@ionmebroirb.com', 666666666, '1978-09-14', 1, 60, 1),
(2, 'jezu', '1234', 'jezu', 'tontillo', '11111111H', 'presidente', 'gjtunbj@rghbrsh.com', 222222222, '1962-02-16', 1, 60, 1),
(3, 'rafi', '1234', 'rafi', 'ta', '77777777R', 'socio', 'biutnbt@hth.com', 888888888, '2012-02-01', 2, 70, 0),
(4, 'maria', '1234', 'maria', 'lamejon', '55555555E', 'socio', 'jojojo@jojo.es', 555555555, '1992-02-20', 1, 60, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `evento_noticia`
--
ALTER TABLE `evento_noticia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `instalaciones`
--
ALTER TABLE `instalaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
