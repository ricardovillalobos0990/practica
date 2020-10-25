-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 25-10-2020 a las 18:54:03
-- Versión del servidor: 8.0.21-0ubuntu0.20.04.4
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `practica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int NOT NULL,
  `idpersona` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lastsession` datetime NOT NULL,
  `active` int NOT NULL DEFAULT '1',
  `persis_idpersis` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `idpersona`, `email`, `phone`, `password`, `lastsession`, `active`, `persis_idpersis`) VALUES
(1, 11127712, 'ricardovillalobos0990@gmail.com', '3137595015', '$2y$10$EcboXzeotRE5ABcJEnk2b.pl8xSDTtTer3muWGHyhGQKcNf.XJERq', '2020-10-25 17:51:29', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` mediumint UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `precio` int DEFAULT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `imagen` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `descripcion`, `imagen`) VALUES
(2, 'sándwiches-vainilla', 7153, 'Postre Median', ''),
(3, 'guisos', 5106, 'Guiso', ''),
(4, 'sándwiches-verdura', 8504, 'Sandwich', ''),
(5, 'pasta', 2980, 'Pasta', ''),
(6, 'cereales', 9969, 'Cereales', ''),
(7, 'sopas', 2332, 'Sopas', ''),
(8, 'ensaladas', 3159, 'ensaladas', ''),
(9, 'empanadas', 7555, 'empanadas', ''),
(10, 'fideos', 7154, 'fideos', ''),
(107, 'Anchoas', 1600, 'Anchoas', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` mediumint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
