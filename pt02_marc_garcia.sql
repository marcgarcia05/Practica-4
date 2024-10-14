-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2024 a las 18:48:30
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pt02_marc_garcia`
--
CREATE DATABASE IF NOT EXISTS `pt02_marc_garcia` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pt02_marc_garcia`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `ID` int(11) NOT NULL,
  `Titol` varchar(255) NOT NULL,
  `Cos` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articles`
--

INSERT INTO `articles` (`ID`, `Titol`, `Cos`) VALUES
(13, 'iPhone 14', 'Smartphone con pantalla OLED de 6.1 pulgadas, procesador A15 Bionic y cámara dual de 12 MP.'),
(14, 'Samsung Galaxy S23', 'Teléfono Android con pantalla Dynamic AMOLED de 6.1 pulgadas y cámara de 50 MP.'),
(16, 'Dell XPS 13', 'Portátil ultraligero con procesador Intel Core i7, 16 GB de RAM y pantalla táctil de 13.3 pulgadas.'),
(17, 'Sony WH-1000XM5', 'Auriculares inalámbricos con cancelación de ruido y hasta 30 horas de autonomía.'),
(18, 'GoPro HERO11', 'Cámara de acción con grabación 5.3K y estabilización de imagen mejorada.'),
(19, 'Apple Watch Series 9', 'Smartwatch con pantalla Retina, seguimiento de salud y resistencia al agua hasta 50 metros.'),
(20, 'Samsung Galaxy Watch 6', 'Reloj inteligente con seguimiento de actividad, monitorización de sueño y pantalla AMOLED.'),
(21, 'Nike Air Max 270', 'Zapatillas deportivas con unidad Air visible para una mayor comodidad y amortiguación.'),
(22, 'Adidas Ultraboost 22', 'Zapatillas de running con tecnología Boost para una mayor respuesta de energía.'),
(23, 'The North Face Jacket', 'Chaqueta impermeable para actividades al aire libre, resistente al viento y transpirable.'),
(24, 'Levi\'s 501 Original Fit Jeans', 'Vaqueros clásicos de corte recto con cierre de botones y ajuste icónico.'),
(25, 'Ray-Ban Aviator', 'Gafas de sol de diseño clásico con montura metálica y lentes polarizadas.'),
(26, 'Apple AirPods Pro 2', 'Auriculares inalámbricos con cancelación de ruido activa y modo de transparencia.'),
(27, 'Bose SoundLink Revolve', 'Altavoz Bluetooth portátil con sonido envolvente de 360 grados y resistencia al agua.'),
(28, 'PlayStation 5', 'Consola de videojuegos de nueva generación con gráficos 4K y almacenamiento SSD ultrarrápido.'),
(29, 'Xbox Series X', 'Consola de videojuegos con soporte para juegos en 4K y una CPU de 8 núcleos a 3.8 GHz.'),
(30, 'Nintendo Switch OLED', 'Consola híbrida con pantalla OLED de 7 pulgadas y capacidad de juego en modo portátil o TV.'),
(31, 'Dyson V15 Detect', 'Aspiradora inalámbrica con sensor láser para detectar partículas de polvo y alta potencia de succión.'),
(33, 'Sony PlayStation VR2', 'Sistema de realidad virtual para PlayStation con gráficos avanzados y seguimiento de movimiento.'),
(34, 'Kindle Paperwhite', 'E-reader con pantalla antirreflejo de 6.8 pulgadas, luz ajustable y resistencia al agua.'),
(35, 'Fitbit Charge 5', 'Pulsera de actividad con monitorización de salud, GPS integrado y análisis de sueño.'),
(36, 'Huawei MateBook X Pro', 'Portátil ultrafino con pantalla táctil 3K, procesador Intel Core i7 y diseño premium.'),
(37, 'LG OLED C1 TV 55\"', 'Televisor OLED de 55 pulgadas con resolución 4K, HDR10 y compatibilidad con Dolby Vision.'),
(38, 'Canon EOS R6', 'Cámara mirrorless con sensor de 20 MP, grabación en 4K y estabilización de imagen en 5 ejes.'),
(39, 'Samsung Galaxy Tab S8', 'Tablet con pantalla de 11 pulgadas, procesador Snapdragon 8 Gen 1 y compatibilidad con S Pen.'),
(40, 'JBL Charge 5', 'Altavoz portátil Bluetooth con sonido potente, resistencia al agua y hasta 20 horas de autonomía.'),
(41, 'Fender Stratocaster', 'Guitarra eléctrica con cuerpo de aliso, mástil de arce y pastillas de bobina simple.'),
(42, 'Casio G-Shock', 'Reloj resistente a golpes con funciones de cronómetro, resistencia al agua y luz LED.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articles`
--
ALTER TABLE `articles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
