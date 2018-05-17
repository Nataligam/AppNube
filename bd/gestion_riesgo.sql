-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-05-2018 a las 01:59:39
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion_riesgo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id_proyecto` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `gerente` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id_proyecto`, `nombre`, `gerente`, `fecha_registro`) VALUES
(17, 'base de datos', 'omar', '2017-09-17 07:18:47'),
(18, 'somar', 'ender', '2017-09-19 11:35:39'),
(19, 'gestion de riesgos', 'gabriel', '2017-09-19 12:45:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `riesgo`
--

CREATE TABLE `riesgo` (
  `id_proyecto` int(11) NOT NULL,
  `id_riesgo` int(11) NOT NULL,
  `riesgo` text NOT NULL,
  `causas` text NOT NULL,
  `efectos` text NOT NULL,
  `como_impacta` text NOT NULL,
  `impacto` int(11) NOT NULL,
  `probabilidad` int(11) NOT NULL,
  `acciones` text NOT NULL,
  `responsable` text NOT NULL,
  `cronograma` text NOT NULL,
  `indicador` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `riesgo`
--

INSERT INTO `riesgo` (`id_proyecto`, `id_riesgo`, `riesgo`, `causas`, `efectos`, `como_impacta`, `impacto`, `probabilidad`, `acciones`, `responsable`, `cronograma`, `indicador`) VALUES
(18, 1, 'riesgo 1', 'causa 1', 'efecto1<br />\r\nefecto 2', 'negativamente', 2, 2, '', '', '', ''),
(18, 2, 'riesgo 2', 'causa 1<br />\r\ncausa 2<br />\r\ncausa 3', 'efecto 1<br />\r\nefecto 2', 'positivamente ', 4, 5, 'Estas son las opciones a seguir', 'este es el responsable', 'cronograma 1', 'esto es un indicador'),
(18, 3, 'riesgo', 'causa 1', 'EFECTO 2', 'oioi', 5, 3, '', '', '', ''),
(19, 4, 'Riesgo1', 'causa1<br />\r\ncausa2', 'efecto q', 'negativamente', 3, 4, '', '', '', ''),
(17, 5, 'riesgo1', 'causa 1<br />\r\ncausa 2', 'efecto', 'ender es marica', 5, 2, 'nueva accion', 'responsable', 'cronograma', 'indicador'),
(17, 6, 'riesgo 2', 'esto es una causa del riesgo 2', 'efecto del riesgo 2', 'negativamente', 4, 1, 'accion para riesgo2<br />\r\nesto es una accion', 'responsable de riesgos', 'cronograma de riesgos ', 'esto es un indicador '),
(17, 7, 'riesgo 3', 'causa de riesgo 3', 'efecto de riesgo 3', 'muy pero my negativamente', 3, 5, '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `username` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`username`, `password`) VALUES
('Natali', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id_proyecto`);

--
-- Indices de la tabla `riesgo`
--
ALTER TABLE `riesgo`
  ADD PRIMARY KEY (`id_riesgo`,`id_proyecto`),
  ADD KEY `cascada proyecto` (`id_proyecto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `riesgo`
--
ALTER TABLE `riesgo`
  MODIFY `id_riesgo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `riesgo`
--
ALTER TABLE `riesgo`
  ADD CONSTRAINT `cascada proyecto` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id_proyecto`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
