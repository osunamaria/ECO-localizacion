-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2022 a las 14:57:58
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `eco-localizacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(5) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `contrasena` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(35) NOT NULL,
  `dni` varchar(9) NOT NULL,
  `correo` varchar(20) NOT NULL,
  `telefono` int(9) NOT NULL,
  `tipo` enum('vendedor','cliente','administrador') NOT NULL DEFAULT 'cliente',
  `confirmado` tinyint(1) NOT NULL DEFAULT 0,
  `ciudad` varchar(30) NOT NULL,
  `localidad` varchar(30) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `cp` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `usuario`, `contrasena`, `nombre`, `apellidos`, `dni`, `correo`, `telefono`, `tipo`, `confirmado`, `ciudad`, `localidad`, `direccion`, `cp`) VALUES
(1, 'pepito', '1234', 'pepe', 'lopez lopez', '11111111G', 'hola@adios.com', 666666666, 'vendedor', 0, 'sevilla', 'sevilla', 'una calle', 41911),
(2, 'juan', '1234', 'juan', 'perez perez', '22222222P', 'hi@bye', 777777777, 'cliente', 0, 'sevilla', 'sevilla', 'otra calle', 41923),
(3, 'javi', '1234', 'javier', 'garcia garcia', '33333333L', 'hi@bye.com', 444444444, 'vendedor', 1, 'sevilla', 'sevilla', 'esa calle', 41934),
(4, 'maria', '1234', 'maria', 'osuna velasco', '44444444H', 'lala@lolo.es', 111111111, 'administrador', 1, 'sevilla', 'mairena del aljarafe', 'mi calle', 41927);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(8) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `mensaje` varchar(500) NOT NULL,
  `cerrado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `correo`, `mensaje`, `cerrado`) VALUES
(1, 'hola@adios.com', 'Todo muy bien, muy buena pagina', 0),
(2, 'hi@bye.com', 'Todo mal, adios', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios`
--

CREATE TABLE `precios` (
  `id_vendedor` int(5) NOT NULL,
  `id_producto` int(8) NOT NULL,
  `precio` float NOT NULL,
  `cantidad` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `precios`
--

INSERT INTO `precios` (`id_vendedor`, `id_producto`, `precio`, `cantidad`) VALUES
(3, 3, 1, 30),
(3, 2, 0.7, 80);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(8) NOT NULL,
  `producto` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `producto`) VALUES
(1, 'pera'),
(2, 'manzana'),
(3, 'brocoli'),
(4, 'zanahoria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(8) NOT NULL,
  `id_vendedor` int(5) NOT NULL,
  `id_cliente` int(5) NOT NULL,
  `id_producto` int(8) NOT NULL,
  `cantidad` int(5) NOT NULL,
  `confirmada` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `id_vendedor`, `id_cliente`, `id_producto`, `cantidad`, `confirmada`) VALUES
(1, 3, 2, 3, 20, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `precios`
--
ALTER TABLE `precios`
  ADD KEY `id_producto` (`id_producto`) USING BTREE,
  ADD KEY `id_vendedor` (`id_vendedor`) USING BTREE;

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vendedor` (`id_vendedor`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `precios`
--
ALTER TABLE `precios`
  ADD CONSTRAINT `id producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `id vendedor` FOREIGN KEY (`id_vendedor`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `id_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `id_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `id_vendedor` FOREIGN KEY (`id_vendedor`) REFERENCES `clientes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
