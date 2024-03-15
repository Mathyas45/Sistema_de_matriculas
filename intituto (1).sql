-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-03-2024 a las 02:04:20
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `intituto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `idAlumno` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`idAlumno`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '$2y$10$lV1jsCqnLIKgrb.XJgkNjumWnYTqvNVPJ6jjB9n7J.lFg2eMGaBD2'),
(2, 'cachetes@gmail.com', '$2y$10$lV1jsCqnLIKgrb.XJgkNjumWnYTqvNVPJ6jjB9n7J.lFg2eMGaBD2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE `aulas` (
  `idAula` int(11) NOT NULL,
  `nCapacidad` int(11) DEFAULT NULL,
  `docente` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`idAula`, `nCapacidad`, `docente`) VALUES
(1, 0, 'julio c tello'),
(2, 2, 'chibolin'),
(3, 2, 'greta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carritos`
--

CREATE TABLE `carritos` (
  `idCarrito` int(11) NOT NULL,
  `alumnoId` int(11) NOT NULL,
  `cursoId` int(11) NOT NULL,
  `aulaId` int(11) NOT NULL,
  `seccionId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `carritos`
--

INSERT INTO `carritos` (`idCarrito`, `alumnoId`, `cursoId`, `aulaId`, `seccionId`) VALUES
(15, 1, 3, 2, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `idCurso` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `seccionId` int(11) DEFAULT NULL,
  `alumnoId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`idCurso`, `descripcion`, `seccionId`, `alumnoId`) VALUES
(3, 'metalisteria', 4, 1),
(4, 'gerencia', 5, 1),
(13, 'nada de nada', 6, 1),
(14, 'prueba', 7, 2),
(15, 'anatomia', NULL, 1),
(16, 'introducción a ed.Fisica', 9, 2),
(17, 'tiktok', 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

CREATE TABLE `matriculas` (
  `idMatricula` int(11) NOT NULL,
  `alumnoId` int(11) NOT NULL,
  `aulaId` int(11) NOT NULL,
  `cursoId` int(11) NOT NULL,
  `SeccionId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `matriculas`
--

INSERT INTO `matriculas` (`idMatricula`, `alumnoId`, `aulaId`, `cursoId`, `SeccionId`) VALUES
(1, 1, 2, 3, 7),
(2, 1, 3, 4, 6),
(3, 1, 3, 13, 4),
(4, 2, 2, 14, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `idSeccion` int(11) NOT NULL,
  `aulaId` int(11) DEFAULT NULL,
  `cursoId` int(11) DEFAULT NULL,
  `turno` varchar(10) DEFAULT NULL,
  `horaInicio` time DEFAULT NULL,
  `horaFin` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`idSeccion`, `aulaId`, `cursoId`, `turno`, `horaInicio`, `horaFin`) VALUES
(4, 3, 13, 'mañana', '10:00:00', '11:00:00'),
(5, 2, 14, 'mañana', '09:00:00', '11:00:00'),
(6, 3, 4, 'tarde', '14:00:00', '16:00:00'),
(7, 2, 3, 'noche', '18:00:00', '20:00:00'),
(9, 1, 3, 'noche', '21:15:00', '22:45:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`idAlumno`);

--
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`idAula`);

--
-- Indices de la tabla `carritos`
--
ALTER TABLE `carritos`
  ADD PRIMARY KEY (`idCarrito`),
  ADD KEY `alumnoId` (`alumnoId`),
  ADD KEY `cursoId` (`cursoId`),
  ADD KEY `aulaId` (`aulaId`),
  ADD KEY `seccionId` (`seccionId`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`idCurso`),
  ADD KEY `seccionId` (`seccionId`),
  ADD KEY `alumnoId` (`alumnoId`);

--
-- Indices de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`idMatricula`),
  ADD KEY `alumnoId` (`alumnoId`),
  ADD KEY `aulaId` (`aulaId`),
  ADD KEY `cursoId` (`cursoId`),
  ADD KEY `SeccionId` (`SeccionId`);

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`idSeccion`),
  ADD KEY `aulaId` (`aulaId`),
  ADD KEY `cursoId` (`cursoId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `idAlumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `aulas`
--
ALTER TABLE `aulas`
  MODIFY `idAula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `carritos`
--
ALTER TABLE `carritos`
  MODIFY `idCarrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `idCurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `idMatricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `idSeccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carritos`
--
ALTER TABLE `carritos`
  ADD CONSTRAINT `carritos_ibfk_1` FOREIGN KEY (`alumnoId`) REFERENCES `alumnos` (`idAlumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carritos_ibfk_2` FOREIGN KEY (`cursoId`) REFERENCES `cursos` (`idCurso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carritos_ibfk_3` FOREIGN KEY (`aulaId`) REFERENCES `aulas` (`idAula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carritos_ibfk_4` FOREIGN KEY (`seccionId`) REFERENCES `secciones` (`idSeccion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`seccionId`) REFERENCES `secciones` (`idSeccion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cursos_ibfk_2` FOREIGN KEY (`alumnoId`) REFERENCES `alumnos` (`idAlumno`);

--
-- Filtros para la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `matriculas_ibfk_1` FOREIGN KEY (`alumnoId`) REFERENCES `alumnos` (`idAlumno`),
  ADD CONSTRAINT `matriculas_ibfk_2` FOREIGN KEY (`aulaId`) REFERENCES `aulas` (`idAula`),
  ADD CONSTRAINT `matriculas_ibfk_3` FOREIGN KEY (`cursoId`) REFERENCES `cursos` (`idCurso`),
  ADD CONSTRAINT `matriculas_ibfk_4` FOREIGN KEY (`alumnoId`) REFERENCES `alumnos` (`idAlumno`),
  ADD CONSTRAINT `matriculas_ibfk_5` FOREIGN KEY (`aulaId`) REFERENCES `aulas` (`idAula`),
  ADD CONSTRAINT `matriculas_ibfk_6` FOREIGN KEY (`cursoId`) REFERENCES `cursos` (`idCurso`),
  ADD CONSTRAINT `matriculas_ibfk_7` FOREIGN KEY (`SeccionId`) REFERENCES `secciones` (`idSeccion`);

--
-- Filtros para la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD CONSTRAINT `secciones_ibfk_1` FOREIGN KEY (`aulaId`) REFERENCES `aulas` (`idAula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `secciones_ibfk_2` FOREIGN KEY (`cursoId`) REFERENCES `cursos` (`idCurso`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `secciones_ibfk_3` FOREIGN KEY (`cursoId`) REFERENCES `cursos` (`idCurso`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
