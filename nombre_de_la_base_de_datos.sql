-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-12-2024 a las 15:18:35
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
-- Base de datos: `nombre_de_la_base_de_datos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `direccion`, `telefono`, `email`) VALUES
(1, 'brian', 'fegeaga', 'ok@xd', 'leopoldodmo0@gmail.com'),
(2, 'Prueba', 'fegeagagege', 'ok@xdveg', 'leopoldodmo0@gmail.comge'),
(3, 'Prueba', 'fegeagagege', 'ok@xdveg', 'leopoldodmo0@gmail.comge'),
(4, 'Prueba', 'fegeagagege', 'ok@xdveg', 'leopoldodmo0@gmail.comge'),
(5, 'XD', 'fegeagagegef', 'ok@xdveg', 'leopoldodmo0@gmail.comge'),
(6, 'BrianPrueba', 'bahea', 'fe@fdeg', 'heahahea@gfegaf'),
(7, 'brian', 'vega', '0707217', 'heahahea@gfega'),
(8, 'Carmen', 'pruebaultima', '041287', 'leopoldodmo0@gmail.com'),
(9, 'Carmen', 'pruebaultima', '041287', 'leopoldodmo0@gmail.com'),
(10, 'Carmen', 'gagaba', '041248', 'heahahea@gfega'),
(13, 'MATERNOCLEIDO', 'muy mal servicio', '04127236264', 'leopoldodmo0@gmail.com'),
(14, 'xd', 'xd', 'xd', 'heahahea@gfega'),
(15, 'JOSEPÉD', 'geaghaha', 'defgag', 'leopoldodmo0@gmail.com'),
(16, 'xd', 'gaba', '0707217', 'beha@geagae'),
(17, 'XD', 'baeabafae', 'fea', 'faeea@xeafea');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios`
--

CREATE TABLE `envios` (
  `id` int(11) NOT NULL,
  `factura_id` int(11) NOT NULL,
  `latitud` decimal(10,8) NOT NULL,
  `longitud` decimal(11,8) NOT NULL,
  `lugar_envio` text NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `producto_id` int(11) DEFAULT 1,
  `estado` varchar(50) DEFAULT 'Pendiente',
  `imagen_comprobante` varchar(255) DEFAULT NULL,
  `precio_a_pagar` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id`, `codigo`, `total`, `fecha`, `usuario`, `producto_id`, `estado`, `imagen_comprobante`, `precio_a_pagar`) VALUES
(1, 'FAC6722B18321814', 3300.00, '2024-10-30 23:21:55', 'Brian', 66, 'Confirmada', NULL, NULL),
(2, 'FAC6722B282C1208', 1300.00, '2024-10-30 23:26:10', 'brian1', 66, 'Confirmada', NULL, NULL),
(3, 'FAC6722B2BBE59A5', 100.00, '2024-10-30 23:27:07', 'brian1', 66, 'Confirmada', NULL, NULL),
(4, 'FAC6722BDFB54F0D', 37509.00, '2024-10-31 00:15:07', 'carlos', 65, 'Confirmada', NULL, NULL),
(5, 'FAC67305674B5884', 55.00, '2024-11-10 07:45:08', 'xd', 71, 'Confirmada', NULL, NULL),
(6, 'FAC673059650CAFB', 75.00, '2024-11-10 07:57:41', 'Brian', 71, 'Confirmada', NULL, NULL),
(7, 'FAC673697D53AC8F', 35.00, '2024-11-15 01:37:41', 'xd', 70, 'Confirmada', NULL, NULL),
(8, 'FAC6736A19B1726A', 45.00, '2024-11-15 02:19:23', 'xd', 71, 'Confirmada', NULL, NULL),
(9, 'FAC6736A26A3E52A', 75.00, '2024-11-15 02:22:50', 'xd', 71, 'Confirmada', NULL, NULL),
(10, 'FAC6736A27558D6E', 30.00, '2024-11-15 02:23:01', 'xd', 71, 'Confirmada', NULL, NULL),
(11, 'FAC6736A28ED6889', 745.00, '2024-11-15 02:23:26', 'xd', 71, 'Confirmada', NULL, NULL),
(12, 'FAC6736A62765D9E', 255.00, '2024-11-15 02:38:47', 'xd', 71, 'Confirmada', NULL, NULL),
(13, 'FAC6736C096399F1', 310.00, '2024-11-15 04:31:34', 'xd', 72, 'Confirmada', NULL, NULL),
(14, 'FAC67394AECA35E6', 10.00, '2024-11-17 02:46:20', 'Brian', 72, 'Confirmada', NULL, NULL),
(15, 'FAC673C0143C971F', 10.00, '2024-11-19 04:08:51', 'xd', 72, 'pendiente', NULL, NULL),
(16, 'FAC673C131CDCAB0', 40.00, '2024-11-19 05:25:00', 'xd', 72, 'pendiente', NULL, NULL),
(17, 'FAC673C18FC55275', 120.00, '2024-11-19 05:50:04', 'xd', 70, 'pendiente', NULL, NULL),
(18, 'FAC673C1ABDB01D9', 320.00, '2024-11-19 05:57:33', 'xd', 70, 'Denegada', NULL, NULL),
(19, 'FAC673C2538010B7', 380.00, '2024-11-19 06:42:16', 'xd', 70, 'Denegada', NULL, NULL),
(20, 'FAC673DF757CC88D', 10.00, '2024-11-20 15:51:03', 'sss', 72, 'Confirmada', NULL, NULL),
(21, 'FAC673DF75D7C152', 10.00, '2024-11-20 15:51:09', 'sss', 72, 'pendiente', NULL, NULL),
(22, 'FAC673DF77B7E437', 0.00, '2024-11-20 15:51:39', 'sss', 0, 'pendiente', NULL, NULL),
(23, 'FAC673DF77EC1BCB', 0.00, '2024-11-20 15:51:42', 'sss', 0, 'pendiente', NULL, NULL),
(24, 'FAC673DF7916A347', 0.00, '2024-11-20 15:52:01', 'sss', 0, 'pendiente', NULL, NULL),
(25, 'FAC673DF92473856', 0.00, '2024-11-20 15:58:44', 'sss', 0, 'pendiente', NULL, NULL),
(26, 'FAC673DF931CF1DB', 15.00, '2024-11-20 15:58:57', 'sss', 71, 'pendiente', NULL, NULL),
(27, 'FAC673DF933E8137', 15.00, '2024-11-20 15:58:59', 'sss', 71, 'pendiente', NULL, NULL),
(28, 'FAC673DFA10CC826', 45.00, '2024-11-20 16:02:40', 'sss', 71, 'pendiente', NULL, NULL),
(29, 'FAC673DFA7F0E7C3', 0.00, '2024-11-20 16:04:31', 'sss', 0, 'pendiente', NULL, NULL),
(30, 'FAC673DFB16B54C0', 15.00, '2024-11-20 16:07:02', 'sss', 71, 'pendiente', NULL, NULL),
(31, 'FAC673DFB2050901', 0.00, '2024-11-20 16:07:12', 'sss', 0, 'pendiente', NULL, NULL),
(32, 'FAC673FDCDB2BE86', 200.00, '2024-11-22 02:22:35', 'sss', 77, 'pendiente', NULL, NULL),
(33, 'FAC673FEB5E786AB', 110.00, '2024-11-22 03:24:30', 'sss', 78, 'pendiente', NULL, NULL),
(34, 'FAC67413927C8573', 91.00, '2024-11-23 03:08:39', 'Carlos', 88, 'pendiente', NULL, NULL),
(35, 'FAC67413946C15DC', 48.00, '2024-11-23 03:09:10', 'Carlos', 88, 'Confirmada', NULL, NULL),
(36, 'FAC67414011BB1E7', 14.00, '2024-11-23 03:38:09', 'sss', 88, 'pendiente', NULL, NULL),
(37, 'FAC6741403AC30B3', 14.00, '2024-11-23 03:38:50', 'sss', 88, 'pendiente', NULL, NULL),
(38, 'FAC6741403ECE987', 14.00, '2024-11-23 03:38:54', 'sss', 88, 'pendiente', NULL, NULL),
(39, 'FAC6741408680321', 14.00, '2024-11-23 03:40:06', 'sss', 88, 'pendiente', NULL, NULL),
(40, 'FAC6741408758244', 14.00, '2024-11-23 03:40:07', 'sss', 88, 'pendiente', NULL, NULL),
(41, 'FAC674140ACD406A', 5.00, '2024-11-23 03:40:44', 'sss', 88, 'pendiente', NULL, NULL),
(42, 'FAC674140D7BECFD', 5.00, '2024-11-23 03:41:27', 'sss', 88, 'pendiente', NULL, NULL),
(43, 'FAC674140D9EB90A', 5.00, '2024-11-23 03:41:29', 'sss', 88, 'pendiente', NULL, NULL),
(44, 'FAC67414107CC02E', 5.00, '2024-11-23 03:42:15', 'sss', 88, 'pendiente', NULL, NULL),
(45, 'FAC67414125EC21E', 5.00, '2024-11-23 03:42:45', 'sss', 88, 'pendiente', NULL, NULL),
(46, 'FAC6741415415DF2', 5.00, '2024-11-23 03:43:32', 'sss', 88, 'pendiente', NULL, NULL),
(47, 'FAC6741415C5476D', 5.00, '2024-11-23 03:43:40', 'sss', 88, 'pendiente', NULL, NULL),
(48, 'FAC6741416543C10', 15.00, '2024-11-23 03:43:49', 'sss', 88, 'pendiente', NULL, NULL),
(49, 'FAC6741495D688C0', 5.00, '2024-11-23 04:17:49', 'sss', 83, 'pendiente', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas1`
--

CREATE TABLE `facturas1` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` datetime NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `estado` varchar(50) DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_productos`
--

CREATE TABLE `facturas_productos` (
  `factura_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarios`
--

CREATE TABLE `inventarios` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad_disponible` int(11) NOT NULL,
  `ultima_actualizacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `usuario` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `rol` varchar(10) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `celular` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`usuario`, `pass`, `rol`, `correo`, `celular`) VALUES
('1224', '1224', 'Admin', '1224@1224', 'xd1474'),
('admin1', '1234', 'Admin', 'admin@gui', '041278541'),
('Brian', '2424', 'Admin', '', ''),
('Brian147', '$2y$10$4MtY7cpYQKYlVOGgmLdUmudCl1QV7kMhT.Ju7UXfwbx', 'Usuario', 'leopoldodmo@gmai.com', '0412723614'),
('Carlos', 'carlos', 'Usuario', 'carloscarlita@gmail.com', '04165555555'),
('sss', 'sss', 'Usuario', 'sss@s', 'sss'),
('vf', '$2y$10$zvNY1Si38BL45zL2qdYf8.m0E7e2Jun9zLv9cfPETcp', 'Usuario', 'gffgfg@gmaicf', 'hfhfhf'),
('xd', 'xd', 'Usuario', 'xd@xd', 'xd1474'),
('xd1', '$2y$10$109Qmzd5Hoqy47AEbfAgDO90VSWztd7fyDnCwaa8EAu', 'Usuario', 'xd@xd', 'xd1474');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_pago`
--

CREATE TABLE `metodos_pago` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `metodos_pago`
--

INSERT INTO `metodos_pago` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Pago Móvil', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `factura_id` int(11) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha_pago` datetime NOT NULL,
  `metodo_pago_id` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `factura_id`, `monto`, `fecha_pago`, `metodo_pago_id`, `descripcion`) VALUES
(4, 2, 1300.00, '2024-11-15 03:38:53', 1, NULL),
(6, 12, 35.00, '2024-11-15 04:29:08', 1, 'Re45717'),
(7, 12, 310.00, '2024-11-15 04:33:10', 1, 'xdf'),
(8, 12, 310.00, '2024-11-15 04:35:31', 1, 'xdf'),
(11, 12, 35.00, '2024-11-15 04:51:48', 1, '7787154854'),
(19, 15, 10.00, '2024-11-19 04:09:07', 1, 'fefgeg'),
(20, 15, 10.00, '2024-11-19 04:15:54', 1, '14157'),
(21, 15, 10.00, '2024-11-19 04:15:57', 1, '14157'),
(22, 16, 40.00, '2024-11-19 05:25:45', 1, 'prueba'),
(23, 16, 40.00, '2024-11-19 05:25:48', 1, 'prueba'),
(24, 18, 320.00, '2024-11-19 05:57:56', 1, 'ultimaprueba'),
(25, 18, 320.00, '2024-11-19 05:59:54', 1, 'ultimaprueba'),
(27, 13, 310.00, '2024-11-19 06:04:30', 1, 'XGFE'),
(28, 13, 310.00, '2024-11-19 06:07:28', 1, 'defeegbe'),
(30, 13, 310.00, '2024-11-19 06:15:11', 1, 'fege'),
(31, 13, 310.00, '2024-11-19 06:16:44', 1, 'Maldet'),
(32, 15, 10.00, '2024-11-19 06:20:45', 1, 'ULTIMAPRUEBA'),
(33, 15, 10.00, '2024-11-19 06:24:40', 1, 'ddeegeg'),
(34, 15, 10.00, '2024-11-19 06:25:37', 1, 'ddeegeg'),
(36, 15, 10.00, '2024-11-19 06:33:34', 1, 'xd'),
(42, 15, 10.00, '2024-11-19 06:39:45', 1, 'xd'),
(43, 15, 10.00, '2024-11-19 06:40:00', 1, 'XXXXX'),
(44, 15, 10.00, '2024-11-19 06:41:44', 1, 'OENDFE'),
(45, 19, 380.00, '2024-11-19 06:42:29', 1, 'PROPALYER'),
(46, 19, 380.00, '2024-11-19 06:43:24', 1, 'WTF'),
(47, 17, 120.00, '2024-11-19 16:54:46', 1, 'scscdfdgdg'),
(48, 18, 320.00, '2024-11-19 17:02:37', 1, 'XEFEGE'),
(49, 18, 320.00, '2024-11-19 17:07:26', 1, 'XEFEGE'),
(50, 25, 0.00, '2024-11-20 16:05:17', 1, 'fegaega'),
(51, 32, 200.00, '2024-11-22 02:23:17', 1, 'pago reealizado '),
(52, 32, 200.00, '2024-11-22 02:23:53', 1, 'fino'),
(53, 32, 200.00, '2024-11-22 02:30:54', 1, 'fino'),
(54, 32, 200.00, '2024-11-22 02:42:31', 1, 'fino'),
(55, 32, 200.00, '2024-11-22 02:43:30', 1, 'fino'),
(56, 32, 200.00, '2024-11-22 02:48:35', 1, 'PRUEBADEFINITIVA'),
(57, 32, 200.00, '2024-11-22 02:49:47', 1, 'PRUEBADEFINITIVA'),
(58, 32, 200.00, '2024-11-22 02:50:20', 1, 'PRUEBADEFINITIVA'),
(59, 32, 200.00, '2024-11-22 02:50:30', 1, 'PRUEBADEFINITIVA'),
(60, 32, 200.00, '2024-11-22 02:56:48', 1, 'PRUEBADEFINITIVA'),
(61, 32, 200.00, '2024-11-22 02:57:17', 1, 'PRUEBADEFINITIVA'),
(62, 25, 0.00, '2024-11-22 02:58:30', 1, 'pagoxd'),
(63, 25, 0.00, '2024-11-22 03:00:15', 1, 'pagoxd'),
(64, 25, 0.00, '2024-11-22 03:06:41', 1, 'pagoxd'),
(65, 25, 0.00, '2024-11-22 03:07:07', 1, 'pagoxd'),
(66, 33, 110.00, '2024-11-22 03:24:53', 1, 'xgfea'),
(67, 35, 48.00, '2024-11-23 03:10:49', 1, 'puta'),
(68, 49, 5.00, '2024-11-23 04:18:00', 1, 'xgegag');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `imagen`, `descripcion`, `stock`) VALUES
(81, 'Memoria Ram Ddr2 laptop', 8.00, 'unidad ram.jpg', 'Capacidad total: 2 GB\n', 10),
(83, 'Memoria Ram Ddr3', 5.00, 'Memoria Ram Ddr3.jpg', 'Capacidad total: 2 GB\r\n\r\n', 9),
(84, 'Micro Sd 128gb ', 9.00, 'Micro SD.jpg', 'Capacidad: 128 GB  Formato de la tarjeta: MicroSDXC velocidad de lectura: 100 MB/s\r\n\r\n\r\n', 10),
(86, 'Memoria Ram Ddr4', 28.00, 'Memoria ram DDR4.jpg', 'Tecnología:Ddr4-3200 8gb Kingston Fury Beast Gaming Udimm', 8),
(87, 'Memoria Ram Ddr4 Laptop', 39.00, 'DRR4 laptop.jpg', 'Tecnología: DDR4 Velocidad: 3200 MHz 16gb 3200 Mushkin Laptop\r\n\r\n \r\n\r\n', 11),
(88, 'Pendrive 32gb', 5.00, 'Pendrive .jpg', 'Capacidad de almacenamiento de datos: 32 GB\r\n\r\n\r\n \r\n\r\n', 10),
(92, 'Disco Duro Solido', 43.00, 'disco sdd.jpg', 'Ssd Kingston 480gb', 9),
(94, 'Teclado  usb', 7.00, 'teclado12.jpg', 'Teclado Alámbrico Con Cable Usb Para Pc ', 11),
(95, 'Case', 54.00, 'case.jpg', 'Case Aerocool Cs-107-a-bk-v2 Mini Torre Micro Atx/mini-itx', 8),
(96, 'Case', 54.00, 'case1.jpg', 'Case Aerocool Scape Media Torre Atx/micro-atx/mini-itx', 2),
(97, 'Case', 59.00, 'case3.jpg', 'Case Aerocool Zauron\r\n', 7),
(98, 'Mause', 5.00, 'mause.jpg', 'Mouse Gaming Hp ', 10),
(99, 'preuba', 100.00, 'geageag.jpg', 'efaegae', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos1`
--

CREATE TABLE `productos1` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `contacto` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `Latitud` varchar(1000) NOT NULL,
  `Longitud` varchar(1000) NOT NULL,
  `Lugar_de_Envio` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`Latitud`, `Longitud`, `Lugar_de_Envio`) VALUES
('10.5054208', '-66.912256', 'okxdfe'),
('10.5054208', '-66.912256', 'marcol digaca'),
('10.5054208', '-66.912256', 'marcol digaca'),
('10.5054208', '-66.912256', 'xsfsg'),
('10.5054208', '-66.912256', '8418'),
('10.5054208', '-66.912256', '8418'),
('10.5054208', '-66.912256', 'DEGAEGEA'),
('10.5054208', '-66.912256', 'pagoxd'),
('10.5054208', '-66.912256', 'ULTIMA'),
('10.5054208', '-66.912256', 'geagea'),
('10.5054208', '-66.912256', 'españa'),
('10.5054208', '-66.912256', 'geagae');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `factura_id` (`factura_id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facturas1`
--
ALTER TABLE `facturas1`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indices de la tabla `facturas_productos`
--
ALTER TABLE `facturas_productos`
  ADD PRIMARY KEY (`factura_id`,`producto_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `inventarios`
--
ALTER TABLE `inventarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`usuario`);

--
-- Indices de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `factura_id` (`factura_id`),
  ADD KEY `metodo_pago_id` (`metodo_pago_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos1`
--
ALTER TABLE `productos1`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `proveedor_id` (`proveedor_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `envios`
--
ALTER TABLE `envios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `facturas1`
--
ALTER TABLE `facturas1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventarios`
--
ALTER TABLE `inventarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `productos1`
--
ALTER TABLE `productos1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `envios`
--
ALTER TABLE `envios`
  ADD CONSTRAINT `envios_ibfk_1` FOREIGN KEY (`factura_id`) REFERENCES `facturas` (`id`);

--
-- Filtros para la tabla `facturas1`
--
ALTER TABLE `facturas1`
  ADD CONSTRAINT `facturas1_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturas_productos`
--
ALTER TABLE `facturas_productos`
  ADD CONSTRAINT `facturas_productos_ibfk_1` FOREIGN KEY (`factura_id`) REFERENCES `facturas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `facturas_productos_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventarios`
--
ALTER TABLE `inventarios`
  ADD CONSTRAINT `inventarios_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`factura_id`) REFERENCES `facturas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pagos_ibfk_2` FOREIGN KEY (`metodo_pago_id`) REFERENCES `metodos_pago` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos1`
--
ALTER TABLE `productos1`
  ADD CONSTRAINT `productos1_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `productos1_ibfk_2` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
