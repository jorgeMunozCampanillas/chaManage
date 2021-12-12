-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-12-2021 a las 19:34:03
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `id_pasillo` int(2) NOT NULL,
  `id_columna` int(3) NOT NULL,
  `id_item` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(4) NOT NULL,
  `contrasenia` varchar(500) NOT NULL,
  `tipo` int(1) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `contrasenia`, `tipo`, `nombre`, `fecha`) VALUES
(1, '81dc9bdb52d04dc20036dbd8313ed055', 1, 'jorge', '2021-11-03'),
(2, '81dc9bdb52d04dc20036dbd8313ed055', 2, 'canela', '2021-11-25'),
(8, '81dc9bdb52d04dc20036dbd8313ed055', 2, 'juanpee', '2021-11-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item`
--

CREATE TABLE `item` (
  `id_item` int(4) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `precio` double NOT NULL,
  `stock` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `item`
--

INSERT INTO `item` (`id_item`, `nombre`, `descripcion`, `precio`, `stock`) VALUES
(10, 'Alicates', 'Con esto to se agarra mejor         ', 10, 1),
(11, 'Destornillador', 'Destornillador punta plana          ', 10, 8),
(12, 'Destornillador', 'Destornillador punta estrella aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa   ', 11, 21),
(13, 'Martillo', 'Martillo pa pega martillazo  ', 20, 8),
(14, 'Radia', 'Con esto lo pues corta to', 70, 12),
(15, 'Cemento', '25Kg', 18, 15),
(16, 'Serrucho', 'Corta     ', 25, 19),
(17, 'Pala', 'Pala grande', 30, 23),
(18, 'Carrilloo', 'lleva cosas     a     ', 50, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(6) NOT NULL,
  `id_empleado` int(4) NOT NULL,
  `valor` double DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `id_empleado`, `valor`, `fecha`) VALUES
(39, 1, 150, '2021-12-04'),
(46, 2, 146, '2021-12-05'),
(47, 2, 240, '2021-12-05'),
(48, 2, 30, '2021-12-05'),
(49, 8, 195, '2021-12-05'),
(50, 8, 31, '2021-12-05'),
(51, 2, 0, '0000-00-00'),
(52, 1, 74, '2021-12-06'),
(53, 8, 273, '2021-12-05'),
(54, 8, 0, '0000-00-00'),
(57, 1, 13, '2021-12-06'),
(61, 1, 36, '2021-12-06'),
(76, 1, 666, '2021-12-06'),
(80, 1, 160, '2021-12-08'),
(81, 1, 40, '2021-12-11'),
(82, 1, 162, '2021-12-12'),
(83, 1, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventaitem`
--

CREATE TABLE `ventaitem` (
  `id_item` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `cantidad` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventaitem`
--

INSERT INTO `ventaitem` (`id_item`, `id_venta`, `cantidad`) VALUES
(18, 39, 3),
(13, 46, 3),
(15, 46, 2),
(16, 46, 2),
(14, 47, 2),
(18, 47, 2),
(17, 48, 1),
(14, 49, 1),
(16, 49, 1),
(18, 49, 2),
(11, 50, 2),
(12, 50, 1),
(15, 51, 2),
(10, 52, 4),
(12, 52, 2),
(10, 53, 3),
(11, 53, 1),
(12, 53, 1),
(13, 53, 1),
(14, 53, 1),
(15, 53, 1),
(16, 53, 1),
(17, 53, 1),
(18, 53, 1),
(10, 57, 1),
(10, 61, 2),
(11, 61, 1),
(10, 64, 2),
(10, 76, 2),
(11, 76, 1),
(13, 76, 6),
(14, 76, 6),
(15, 76, 5),
(11, 80, 2),
(14, 80, 2),
(11, 81, 4),
(11, 82, 1),
(12, 82, 1),
(15, 82, 2),
(16, 82, 3),
(17, 82, 1),
(10, 83, 1),
(12, 83, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `fk_venta_empleado` (`id_empleado`);

--
-- Indices de la tabla `ventaitem`
--
ALTER TABLE `ventaitem`
  ADD PRIMARY KEY (`id_venta`,`id_item`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_empleado` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
