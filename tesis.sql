-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-03-2021 a las 02:45:37
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tesis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `id` int(11) NOT NULL,
  `chipid` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`id`, `chipid`, `fecha`, `UID`) VALUES
(1, 9066986, '2021-03-14 14:41:33', '20 01 98 A5'),
(2, 9066986, '2021-03-14 00:23:04', '20 01 98 A5'),
(3, 9066986, '2021-03-16 00:23:06', '20 01 98 A5'),
(4, 9066986, '2021-03-15 01:21:20', '20 01 98 A5'),
(5, 9066986, '2021-03-15 01:21:32', '20 01 98 A5'),
(6, 9066986, '2021-03-15 01:21:45', '20 01 98 A5'),
(7, 9066986, '2021-03-15 01:22:39', '20 01 98 A5'),
(8, 9066986, '2021-03-15 01:32:21', '20 01 98 A5'),
(9, 9066986, '2021-03-15 01:33:59', '20 01 98 A5'),
(10, 9066986, '2021-03-15 01:35:42', '20 01 98 A5'),
(11, 9066986, '2021-03-15 01:36:05', '20 01 98 A5'),
(12, 9066986, '2021-03-15 01:59:25', '20 01 98 A5'),
(13, 9066986, '2021-03-15 02:01:42', '20 01 98 A5'),
(14, 9066986, '2021-03-15 02:02:15', '20 01 98 A5'),
(15, 9066986, '2021-03-15 02:04:02', '20 01 98 A5'),
(16, 9066986, '2021-03-15 02:06:09', '20 01 98 A5'),
(17, 9066986, '2021-03-15 02:06:49', '20 01 98 A5'),
(18, 9066986, '2021-03-15 02:09:07', '20 01 98 A5'),
(19, 9066986, '2021-03-15 02:09:43', '20 01 98 A5'),
(20, 9066986, '2021-03-15 02:11:43', '20 01 98 A5'),
(21, 9066986, '2021-03-15 02:13:10', '20 01 98 A5'),
(22, 9066986, '2021-03-15 02:13:28', '20 01 98 A5'),
(23, 9066986, '2021-03-15 02:13:46', '20 01 98 A5'),
(24, 9066986, '2021-03-15 02:17:28', '20 01 98 A5'),
(25, 9066986, '2021-03-15 02:18:48', '20 01 98 A5'),
(26, 9066986, '2021-03-15 02:20:50', '20 01 98 A5'),
(27, 9066986, '2021-03-15 23:01:39', '20 01 98 A5'),
(28, 9066986, '2021-03-15 23:01:50', 'F6 49 BA 79'),
(29, 9066986, '2021-03-15 23:02:22', 'F6 49 BA 79'),
(30, 9066986, '2021-03-15 23:02:31', '20 01 98 A5'),
(31, 9066986, '2021-03-15 23:02:56', 'F6 49 BA 79'),
(32, 9066986, '2021-03-15 23:04:30', '20 01 98 A5'),
(33, 9066986, '2021-03-15 23:04:39', 'F6 49 BA 79'),
(34, 9066986, '2021-03-15 23:08:59', '20 01 98 A5'),
(35, 9066986, '2021-03-15 23:12:13', 'F6 49 BA 79'),
(36, 9066986, '2021-03-16 01:10:15', 'F6 49 BA 79'),
(37, 9066986, '2021-03-16 01:10:31', '20 01 98 A5'),
(38, 9066986, '2021-03-16 01:18:15', 'F6 49 BA 79'),
(39, 9066986, '2021-03-16 01:18:23', '20 01 98 A5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

CREATE TABLE `registros` (
  `idRegistro` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `valor` varchar(20) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `registros`
--

INSERT INTO `registros` (`idRegistro`, `nombre`, `valor`, `fecha`) VALUES
(2, '/R501/temperatura', '726', '2021-03-05 22:06:17'),
(3, '/R501/temperatura', '246', '2021-03-05 22:06:40'),
(4, '/R501/temperatura', '283', '2021-03-05 22:09:23'),
(5, '/R501/temperatura', '83', '2021-03-05 22:10:27'),
(6, '/R501/temperatura', '862', '2021-03-05 22:11:13'),
(7, 'Switch', 'ON', '2021-03-05 22:11:30'),
(8, 'Switch', 'OFF', '2021-03-05 22:11:31'),
(9, 'Switch', 'OFF', '2021-03-05 22:11:37'),
(10, 'Dato', '123', '2021-03-05 22:11:40'),
(11, 'Switch', 'ON', '2021-03-05 22:12:58'),
(12, 'Switch', 'Encendida', '2021-03-05 22:13:22'),
(13, 'Switch', 'Encendida', '2021-03-05 22:13:47'),
(14, 'Switch', 'Apagada', '2021-03-05 22:14:02'),
(15, 'Switch', 'Encendida', '2021-03-07 00:11:16'),
(16, 'Switch', 'Encendida', '2021-03-07 00:11:28'),
(17, 'Switch', 'Encendida', '2021-03-07 00:11:32'),
(18, 'Switch', 'Apagada', '2021-03-07 00:16:59'),
(19, 'Switch', 'Encendida', '2021-03-07 00:17:00'),
(20, 'Switch', 'Apagada', '2021-03-07 00:17:03'),
(21, 'Switch', 'ON', '2021-03-07 00:18:09'),
(22, 'Switch', 'OFF', '2021-03-07 00:18:09'),
(23, 'Switch', 'ON', '2021-03-07 00:18:39'),
(24, 'Switch', 'ON', '2021-03-07 00:19:02'),
(25, 'Switch', 'Encendida', '2021-03-07 00:19:53'),
(26, 'Switch', 'Apagada', '2021-03-07 00:20:02'),
(27, 'Switch', 'Encendida', '2021-03-07 00:20:04'),
(28, 'Switch', 'Apagada', '2021-03-07 02:35:40'),
(29, 'Switch', 'Encendida', '2021-03-07 02:35:53'),
(30, 'Switch', 'Apagada', '2021-03-07 02:36:39'),
(31, 'Switch', 'Encendida', '2021-03-07 02:36:41'),
(32, 'Switch', 'Apagada', '2021-03-07 02:36:53'),
(33, 'Switch', 'Encendida', '2021-03-07 02:36:54'),
(34, 'Switch', 'Apagada', '2021-03-07 02:37:39'),
(35, 'Switch', 'Encendida', '2021-03-07 02:37:41'),
(36, 'Switch', 'Apagada', '2021-03-07 02:37:42'),
(37, 'Switch', 'Encendida', '2021-03-07 02:38:25'),
(38, 'Switch', 'Apagada', '2021-03-07 02:38:52'),
(39, 'Switch', 'Encendida', '2021-03-07 02:38:53'),
(40, 'Switch', 'Apagada', '2021-03-07 02:38:55'),
(41, 'Switch', 'Encendida', '2021-03-07 02:39:56'),
(42, 'Switch', 'Apagada', '2021-03-07 02:40:07'),
(43, 'Switch', 'Encendida', '2021-03-07 02:40:07'),
(44, 'Switch', 'Apagada', '2021-03-07 02:40:08'),
(45, 'Switch', 'Encendida', '2021-03-07 02:40:08'),
(46, 'Switch', 'Apagada', '2021-03-07 02:40:08'),
(47, 'Switch', 'Encendida', '2021-03-07 02:40:09'),
(48, 'Switch', 'Apagada', '2021-03-07 02:40:09'),
(49, 'Switch', 'Encendida', '2021-03-07 02:40:09'),
(50, 'Switch', 'Apagada', '2021-03-07 02:40:10'),
(51, 'Switch', 'Encendida', '2021-03-07 02:40:10'),
(52, 'Switch', 'Apagada', '2021-03-07 02:40:10'),
(53, 'Switch', 'Encendida', '2021-03-07 02:40:11'),
(54, 'Switch', 'Apagada', '2021-03-07 12:56:27'),
(55, '/R501/temperatura', '440.0', '2021-03-07 12:56:29'),
(56, '/R501/sonido', '0', '2021-03-07 12:56:29'),
(57, 'Switch', 'Encendida', '2021-03-07 12:56:29'),
(58, 'Switch', 'Apagada', '2021-03-07 12:56:32'),
(59, 'Switch', 'Encendida', '2021-03-07 12:56:33'),
(60, 'Switch', 'Apagada', '2021-03-07 12:56:35'),
(61, '/R501/temperatura', '440.0', '2021-03-07 12:56:39'),
(62, '/R501/sonido', '0', '2021-03-07 12:56:39'),
(63, 'Switch', 'Encendida', '2021-03-07 12:56:44'),
(64, '/R501/temperatura', '440.0', '2021-03-07 12:56:49'),
(65, '/R501/sonido', '0', '2021-03-07 12:56:49'),
(66, '/R501/temperatura', '440.0', '2021-03-07 12:56:59'),
(67, '/R501/sonido', '0', '2021-03-07 12:56:59'),
(68, '/R501/temperatura', '549.0', '2021-03-07 16:58:18'),
(69, '/R501/sonido', '0', '2021-03-07 16:58:18'),
(70, '/R501/temperatura', '549.0', '2021-03-07 16:58:28'),
(71, '/R501/sonido', '0', '2021-03-07 16:58:28'),
(72, '/R501/temperatura', '549.0', '2021-03-07 16:58:38'),
(73, '/R501/sonido', '0', '2021-03-07 16:58:38'),
(74, '/R501/temperatura', '549.0', '2021-03-07 16:58:48'),
(75, '/R501/temperatura', '549.0', '2021-03-07 16:58:58'),
(76, '/R501/sonido', '0', '2021-03-07 16:58:58'),
(77, '/R501/temperatura', '549.0', '2021-03-07 16:59:08'),
(78, '/R501/sonido', '0', '2021-03-07 16:59:08'),
(79, 'Dato', '123', '2021-03-07 16:59:08'),
(80, 'Dato', '220', '2021-03-07 16:59:14'),
(81, '/R501/temperatura', '549.0', '2021-03-07 16:59:18'),
(82, '/R501/sonido', '0', '2021-03-07 16:59:18'),
(83, 'Dato', '630', '2021-03-07 16:59:18'),
(84, '/R501/temperatura', '663.0', '2021-03-08 22:49:26'),
(85, '/R501/temperatura', '663.0', '2021-03-08 22:49:31'),
(86, 'Switch', 'Apagada', '2021-03-08 22:49:32'),
(87, '/R501/temperatura', '663.0', '2021-03-08 22:49:36'),
(88, '/R501/temperatura', '663.0', '2021-03-08 22:49:41'),
(89, '/R501/temperatura', '663.0', '2021-03-08 22:49:46'),
(90, '/R501/temperatura', '663.0', '2021-03-08 22:49:51'),
(91, '/R501/sonido', '0', '2021-03-08 22:49:51'),
(92, 'Switch', 'Encendida', '2021-03-08 22:49:54'),
(93, '/R501/temperatura', '663.0', '2021-03-08 22:49:56'),
(94, 'Switch', 'Apagada', '2021-03-08 22:49:59'),
(95, '/R501/temperatura', '663.0', '2021-03-08 22:50:01'),
(96, '/R501/temperatura', '663.0', '2021-03-08 22:50:06'),
(97, '/R501/temperatura', '663.0', '2021-03-08 22:50:11'),
(98, 'Temperatura', '28', '2021-03-12 22:53:32'),
(99, 'Humedad', '67', '2021-03-12 22:53:32'),
(100, '', '', '2021-03-12 23:34:32'),
(101, 'Humedad', '60', '2021-03-12 23:34:32'),
(102, 'Conteo', '0', '2021-03-13 01:20:04'),
(103, 'Temperatura', '25', '2021-03-15 00:21:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `UID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `UID`) VALUES
(1, 'jose', '123', '20 01 98 A5'),
(2, 'jere', '321', 'F6 49 BA 79');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`idRegistro`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `idRegistro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
