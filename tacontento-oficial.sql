-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-07-2021 a las 19:31:36
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tacontento-oficial`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `obtener_reservas` (IN `id_c` INT)  BEGIN

SELECT * FROM reservas WHERE reservas.id_cliente = id_c;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL DEFAULT '0',
  `descripcion` varchar(200) NOT NULL DEFAULT '0',
  `precio` int(11) NOT NULL DEFAULT 0,
  `tipo` varchar(50) NOT NULL DEFAULT '0',
  `img` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `nombre`, `descripcion`, `precio`, `tipo`, `img`) VALUES
(17, 'Tacos de pastor', 'deliciosos tacos de pastor con piña y queso derretido', 50, 'cena', 'cena5.jpg'),
(18, 'Hot Cakes', 'deliciosos Hot Cakes con mora (café incluido)', 45, 'desayuno', 'desayuno113.jpg'),
(19, 'Cuernitos', 'Deliciosos cuernitos rellenos de chocolates (café o jugo incluido)', 35, 'desayuno', 'desayuno10 .jpg'),
(20, 'huevos a la mexicana', 'huevos con aderezo de chipotle (jugo incluido)', 50, 'desayuno', 'desayuno1.JPG'),
(21, 'hamburguesa suprema', 'hamburguesa de pollo con pastor y queso derretido(refresco incluido)', 70, 'cena', 'cena5.jpg'),
(22, 'Hamburguesa sencilla', 'deliciosa hamburguesa con papas y refresco incluido', 50, 'cena', 'cena11.jpg'),
(24, 'Tacos de carnitas', 'tacos de carnitas con totopos y refresco incluidos', 50, 'cena', 'comida8.jpg'),
(25, 'tacos a la madera', 'finos tacos de cerdo con aderezo de chipotle (refresco incluido)', 50, 'cena', 'fondo2.jpg'),
(27, 'Almuerzo Pastor', 'platillo de pastor con piña (bebida incluida)', 50, 'comidas', 'almuerzo.jpg'),
(28, 'Tostadas', 'Ricas tostadas de tinga y pastor.', 35, 'comidas', 'almuerzo16.jpg'),
(29, 'Platillo Tacontento', 'pastor, carnitas, suadero, queso derretido y una gran sonrisa para hacer feliz a tu paladar', 45, 'comidas', 'almuerzo9.jpg'),
(30, 'Taco-Happy', 'platillo de taco de carnitas con un toque de TACONTENTO', 45, 'comidas', 'cena2.jpg'),
(34, 'Flautas', 'flautas de pollo con queso', 35, 'comidas', 'almuerzo3.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`id`, `titulo`, `descripcion`, `img`) VALUES
(3, 'MIERCOLES 2X1', 'en la compra de cualquier platillo, llévate otro totalmente gratis', 'comida2.jpg'),
(4, 'TACOS AL PASTOR', '10 tacos a solo $35, ¡TODOS LOS DÍAS!', 'shots.jpg'),
(8, 'TACO-FAMILIA', 'Sábados familiares, bailes folkloricos y música en vivo acompañado de unos buenos tacos', 'public.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL DEFAULT '0',
  `fecha` date NOT NULL,
  `cantidad` varchar(200) NOT NULL DEFAULT '0',
  `total` int(11) NOT NULL DEFAULT 0,
  `id_cliente` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `descripcion`, `fecha`, `cantidad`, `total`, `id_cliente`, `status`) VALUES
(33, '17,', '2019-08-03', '2,', 100, 7, 2),
(34, '17,', '2019-08-05', '2,', 100, 8, 1),
(35, '17,', '2019-08-05', '1,', 50, 8, 1),
(36, '17,', '2019-08-08', '2,', 100, 7, 2),
(37, '17,', '2019-08-09', '2,', 100, 5, 1),
(38, '21,', '2019-08-11', '2,', 140, 11, 1),
(39, '18,', '2019-08-11', '1,', 45, 11, 1),
(40, '17,', '2021-07-09', '3,', 150, 14, 1),
(41, '17,27,', '2021-07-09', '1,12,', 650, 14, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL DEFAULT 0,
  `personas` int(11) NOT NULL DEFAULT 0,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `id_cliente`, `personas`, `fecha`, `hora`) VALUES
(5, 7, 2, '2019-08-16', '12:08:00'),
(6, 8, 1, '2019-08-07', '03:08:00'),
(7, 7, 2, '2019-08-09', '04:08:00'),
(8, 7, 2, '2019-08-09', '04:08:00'),
(9, 7, 2, '2019-08-09', '04:08:00'),
(10, 7, 2, '2019-08-09', '04:08:00'),
(11, 5, 2, '2019-08-15', '03:08:00'),
(12, 5, 3, '2019-08-09', '12:08:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL DEFAULT '0',
  `apellidos` varchar(50) NOT NULL DEFAULT '0',
  `direccion` varchar(100) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '0',
  `edad` varchar(50) NOT NULL DEFAULT '0',
  `telefono` varchar(50) NOT NULL DEFAULT '0',
  `password` varchar(50) NOT NULL DEFAULT '0',
  `admin` varchar(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `direccion`, `email`, `edad`, `telefono`, `password`, `admin`) VALUES
(4, 'perla', 'nose', 'nose', 'perla@gmail.com', '19', '7581421221', '123', '1'),
(5, 'cliente', 'apellido cliente', 'zihuatanejo', 'cliente@cliente.com', '24', '7551301638', '123', '2'),
(7, 'wendy', 'santos', 'zihuatanejo', 'wendy@santos.com', '18', '77777777777', '123', '2'),
(8, 'Jimena ', 'Sánchez Cabrera', 'zihuatanejo', 'jirla@blue.com', '19', '75512374932', '123', '2'),
(9, 'Flautas', 'santos', 'zihuatanejo', 'cliente@clientes.com', '19', '77777777777', '12345678', '2'),
(10, 'Flautas', 'santos', 'efegwhulf', 'cliente@clientes.com', '43', '4uy4387rt4', '12345678', '2'),
(11, 'dylan jesus', 'chavarria', 'zihuatanejo', 'dylan@soy.com', '45', '1234567890', '12345678', '2'),
(12, 'Flautas', 'reyes', 'aqui', 'dylan@soy.com', '45', '1234567890', '12345678', '2'),
(13, 'peulo chencho mars', 'reyes', 'jij', 'dylan@soy.com', '19', '7551237493', '12345678', '2'),
(14, 'Jose Manuel', 'Silva', 'zihuatanejo', 'jose@gmail.com', '20', '75562232', 'password', '2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
