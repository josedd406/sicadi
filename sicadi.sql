-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-07-2022 a las 16:50:30
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sicadi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(5) NOT NULL,
  `categoria` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(1, 'Portones'),
(2, 'Protecciones'),
(3, 'Puertas'),
(4, 'Ventanas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas_presupuestos`
--

CREATE TABLE `citas_presupuestos` (
  `id` int(5) NOT NULL,
  `id_user` int(5) NOT NULL,
  `id_galeria` int(5) NOT NULL,
  `id_status_cita` int(5) NOT NULL,
  `colonia` varchar(50) NOT NULL,
  `calle` varchar(50) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `referencia` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `detalle_pedido` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `citas_presupuestos`
--

INSERT INTO `citas_presupuestos` (`id`, `id_user`, `id_galeria`, `id_status_cita`, `colonia`, `calle`, `numero`, `referencia`, `descripcion`, `detalle_pedido`, `fecha`, `hora`, `status`) VALUES
(1, 84, 7, 1, 'Carrizal', 'Carrillo Puerto', '32', 'Frente a motel', 'Herreria para una casa de dos plantas', '', '2018-08-04', '10:00:00', 'pendiente'),
(2, 84, 1, 2, 'Tamulte', 'Mendez', '111', 'Frente a motel', 'HerrerÃ­a artÃ­stica', '', '2019-08-04', '10:00:00', 'pendiente'),
(3, 84, 1, 2, 'Carrizal', 'Carrillopuerto', '453', 'Frente a motel', 'HerrerÃ­a artÃ­stica', '', '2019-08-04', '10:00:00', 'pendiente'),
(4, 84, 1, 1, 'Atasta', 'Carlos Green', '123', 'Frente a motel', 'HerrerÃ­a artÃ­stica', '', '2019-08-04', '10:00:00', 'pendiente'),
(5, 84, 1, 1, 'Casa Blanca', 'Reforma', '234', 'Frente a motel', 'HerrerÃ­a artÃ­stica', '', '2019-08-04', '10:00:00', 'pendiente'),
(6, 84, 1, 1, 'Espejo II', 'Macuili', '82', 'Frente a motel', 'HerrerÃ­a artÃ­stica', '', '2019-08-04', '10:00:00', 'pendiente'),
(7, 84, 1, 1, 'Espejo I', 'Cedros', '282', 'Frente a motel', 'HerrerÃ­a artÃ­stica', '', '2019-08-04', '10:00:00', 'pendiente'),
(8, 84, 1, 1, 'Indeco', 'Principal', '23', 'Frente a motel', 'HerrerÃ­a artÃ­stica', '', '2019-08-04', '10:00:00', 'pendiente'),
(9, 84, 1, 1, 'Carrizal', 'Carrillopuerto', '265', 'Frente a motel', 'HerrerÃ­a artÃ­stica', '', '2019-08-04', '10:00:00', 'pendiente'),
(10, 84, 1, 2, 'Miguel Hidalgo', 'Bonanzas', '12', 'Frente a motel', 'asdf', '', '2019-08-05', '12:00:00', 'pendiente'),
(11, 84, 2, 1, 'Gaviotas Norte', 'Brasil', '125', 'Frente a motel', 'aswdasdasd', '', '2019-08-04', '14:00:00', 'pendiente'),
(32, 90, 1, 1, 'Colonia Carrizal', 'Comando Submario', '10', 'foafk', 'onekfnak\r\n', '', '2022-06-29', '10:00:00', 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_presupuesto`
--

CREATE TABLE `detalle_presupuesto` (
  `id_detalle_presupuesto` int(5) NOT NULL,
  `id_presupuesto` int(5) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `cantidad` int(5) NOT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galerias`
--

CREATE TABLE `galerias` (
  `id` int(5) NOT NULL,
  `id_categoria` int(5) NOT NULL,
  `galeria` varchar(20) NOT NULL,
  `costo_aprox` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `galerias`
--

INSERT INTO `galerias` (`id`, `id_categoria`, `galeria`, `costo_aprox`) VALUES
(1, 1, 'porton1.jpg', '2.30m x 2.20m = $7,600'),
(2, 1, 'porton2.jpg', '5m x 2.20m = $2,2000'),
(3, 1, 'porton3.jpg', '3.5m x 2.20m = $12,320'),
(5, 1, 'porton5.jpg', '6m x 2.30m = $1,7940'),
(6, 1, 'porton6.jpg', '5m x 2.50m = $1,6250'),
(7, 2, 'proteccion1.jpg', '1.3m x 2.10m = $3,276'),
(8, 2, 'proteccion2.jpg', '0.90m x 2.20m = $3,600'),
(9, 2, 'proteccion3.jpg', '1.2m x 1.20m = $1,728'),
(10, 2, 'proteccion4.jpg', '1.0m x 2.20m = $1,560'),
(11, 2, 'proteccion5.jpg', '2.0m x 1.40m = $4,480'),
(12, 2, 'proteccion6.jpg', '1.0m x 2.20m = $2,800'),
(13, 3, 'puerta1.jpg', '1.0m x 2.10m = $7,000'),
(14, 3, 'puerta2.jpg', '1.20m x 2.20m = $6,000'),
(15, 3, 'puerta3.jpg', '1.0m x 2.30m = $6,800'),
(16, 3, 'puerta4.jpg', '1.0m x 2.20m = $6,500'),
(17, 3, 'puerta5.jpg', '2.20m x 2.2m = $8,500'),
(18, 3, 'puerta6.jpg', '1.40m x 2.30m = $6,500'),
(19, 4, 'ventana1.jpg', '2.50m x 2.20m = $9,900'),
(20, 4, 'ventana2.jpg', '1.10m x 1.30m = $1,580'),
(21, 4, 'ventana3.jpg', '1m x 1.40m = $1,680'),
(22, 4, 'ventana4.jpg', '1.30m x 1.10m = $1,643'),
(23, 4, 'ventana5.jpg', '2m x 1.20m = $4,100'),
(24, 4, 'ventana6.jpg', '1.50m x 1.20m = $2,160');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestos`
--

CREATE TABLE `presupuestos` (
  `id` int(5) NOT NULL,
  `id_cita_presupuesto` int(5) NOT NULL,
  `fecha` date NOT NULL,
  `subtotal` double NOT NULL,
  `iva` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status_citas`
--

CREATE TABLE `status_citas` (
  `id` int(5) NOT NULL,
  `status_cita` varchar(20) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `status_citas`
--

INSERT INTO `status_citas` (`id`, `status_cita`, `descripcion`) VALUES
(1, 'Pendiente', 'Cita pendiente de ser procesada'),
(2, 'En proceso', 'Cita en proceso de ser asignada'),
(3, 'Atendida', 'Cita atendida'),
(4, 'Cancelada', 'Cita cancelada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `privilegios` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cliente',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `nombre`, `telefono`, `privilegios`, `username`) VALUES
(82, 'juan@mail.com', 'juan', 'juan', '1234567890', 'cliente', 'juanpg'),
(84, 'mariaBD@msn.com', 'root', 'Maria Bolaina DomÃ­nguez', '9932784247', 'admin', 'MariaBD'),
(87, 'jdaniel@msn.com', 'admin', 'Jairo Daniel', '9931337850', 'empleado', 'JDaniel'),
(89, 'josec@msn.com', '1234', 'Jose del Carmen', '9932784247', 'empleado', 'joseC'),
(90, 'jose@mail.com', 'spointer', 'jose', '9932784247', 'admin', 'josepg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `citas_presupuestos`
--
ALTER TABLE `citas_presupuestos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user_fk` (`id_user`),
  ADD KEY `id_galeria_fk` (`id_galeria`) USING BTREE,
  ADD KEY `id_status_cita_fk` (`id_status_cita`) USING BTREE;

--
-- Indices de la tabla `detalle_presupuesto`
--
ALTER TABLE `detalle_presupuesto`
  ADD PRIMARY KEY (`id_detalle_presupuesto`),
  ADD KEY `id_presupuesto_fk` (`id_presupuesto`) USING BTREE;

--
-- Indices de la tabla `galerias`
--
ALTER TABLE `galerias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria_fk` (`id_categoria`);

--
-- Indices de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cita_presupuesto_fk` (`id_cita_presupuesto`) USING BTREE;

--
-- Indices de la tabla `status_citas`
--
ALTER TABLE `status_citas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `citas_presupuestos`
--
ALTER TABLE `citas_presupuestos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `detalle_presupuesto`
--
ALTER TABLE `detalle_presupuesto`
  MODIFY `id_detalle_presupuesto` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `galerias`
--
ALTER TABLE `galerias`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `status_citas`
--
ALTER TABLE `status_citas`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas_presupuestos`
--
ALTER TABLE `citas_presupuestos`
  ADD CONSTRAINT `id_galeria_fk` FOREIGN KEY (`id_galeria`) REFERENCES `galerias` (`id`),
  ADD CONSTRAINT `id_status_cita_fk` FOREIGN KEY (`id_status_cita`) REFERENCES `status_citas` (`id`),
  ADD CONSTRAINT `id_user_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `detalle_presupuesto`
--
ALTER TABLE `detalle_presupuesto`
  ADD CONSTRAINT `id_presupuesto` FOREIGN KEY (`id_presupuesto`) REFERENCES `presupuestos` (`id`);

--
-- Filtros para la tabla `galerias`
--
ALTER TABLE `galerias`
  ADD CONSTRAINT `id_categoria_fk` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD CONSTRAINT `id_cita_presupuesto_fk` FOREIGN KEY (`id_cita_presupuesto`) REFERENCES `citas_presupuestos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
