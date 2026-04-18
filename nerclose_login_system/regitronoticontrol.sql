-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-04-2026 a las 15:55:12
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `regitronoticontrol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE `datos` (
  `usuario` varchar(20) NOT NULL,
  `codigo_institucion` varchar(4) NOT NULL,
  `contraseña` varchar(8) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `fecha_reg` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datos`
--

INSERT INTO `datos` (`usuario`, `codigo_institucion`, `contraseña`, `correo`, `fecha_reg`) VALUES
('20078', '2335', '56789', 'valericastilor@gmail.com', '2026-04-08 11:33:19'),
('23456', '2007', '23456', 'valericastilor@gmail.com', '2026-04-07 17:57:35'),
('3456', '2345', '12345678', 'valericastilor@gmail.com', '2026-04-08 08:55:54'),
('valeri.castillo', '1234', '12345', 'valericastilor@gmail.com', '2026-04-13 21:31:12'),
('valericastillo', '6789', '1234567', 'valericastilor@gmail.com', '2026-04-13 11:34:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_accesos`
--

CREATE TABLE `historial_accesos` (
  `id_acceso` int(11) NOT NULL,
  `uid_tag` varchar(50) NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(11) NOT NULL,
  `uid_tag` varchar(50) DEFAULT NULL,
  `nombre_paciente` varchar(100) DEFAULT NULL,
  `piso_habitacion` varchar(100) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `uid_tag`, `nombre_paciente`, `piso_habitacion`, `fecha_registro`) VALUES
(1, '0x806995000060040F7789D41B', 'Valeri Castillo Rivera', 'Habitación 305', '2026-04-08 13:25:58');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos`
--
ALTER TABLE `datos`
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `historial_accesos`
--
ALTER TABLE `historial_accesos`
  ADD PRIMARY KEY (`id_acceso`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`),
  ADD UNIQUE KEY `id_paciente` (`id_paciente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `historial_accesos`
--
ALTER TABLE `historial_accesos`
  MODIFY `id_acceso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
