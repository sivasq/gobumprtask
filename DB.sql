-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 30, 2019 at 01:24 PM
-- Server version: 8.0.15
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_db`
--
CREATE DATABASE IF NOT EXISTS `task_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `task_db`;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(24) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cities.city_name` (`city_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city_name`) VALUES
(2, 'Bangalore'),
(1, 'Chennai'),
(3, 'Hyderabad');

-- --------------------------------------------------------

--
-- Table structure for table `city_has_services`
--

DROP TABLE IF EXISTS `city_has_services`;
CREATE TABLE IF NOT EXISTS `city_has_services` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `city` int(3) NOT NULL,
  `service` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city` (`city`),
  KEY `service` (`service`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `city_has_services`
--

INSERT INTO `city_has_services` (`id`, `city`, `service`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 1, 18),
(19, 2, 1),
(20, 2, 2),
(21, 2, 3),
(22, 2, 4),
(23, 2, 5),
(24, 2, 6),
(25, 2, 7),
(26, 2, 8),
(27, 2, 9),
(28, 2, 10),
(29, 2, 11),
(30, 2, 12),
(31, 2, 13),
(32, 2, 14),
(33, 2, 15),
(34, 2, 16),
(35, 2, 17),
(36, 2, 18),
(37, 3, 1),
(38, 3, 2),
(39, 3, 3),
(40, 3, 4),
(41, 3, 5),
(42, 3, 6),
(43, 3, 7),
(44, 3, 8),
(45, 3, 9),
(46, 3, 10),
(47, 3, 11),
(48, 3, 12),
(49, 3, 13),
(50, 3, 14),
(51, 3, 15),
(52, 3, 16),
(53, 3, 17),
(54, 3, 18);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `vehicle_type` int(3) DEFAULT NULL,
  `service_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `price` float(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services.service_name` (`service_name`),
  KEY `services.vehicle_type` (`vehicle_type`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `vehicle_type`, `service_name`, `price`) VALUES
(1, 2, 'BIKE GENERAL SERVICE AND POLISH', 1299.00),
(2, 2, 'PREMIUM BIKE SERVICE AND POLISH', 1999.00),
(3, 2, 'PREMIUM BIKE DETAILING', 1499.00),
(4, 1, 'EXPRESS CAR SERVICE', 999.00),
(5, 1, 'COMPLETE CAR DETAILING', 2999.00),
(6, 1, 'CAR OIL SERVICE', 2999.00),
(7, 1, 'CAR DENT REMOVAL', 2999.00),
(8, 2, 'ENGINE REPAIR', 4999.00),
(9, 1, 'CAR AC SERVICE', 1999.00),
(10, 2, 'BIKE CERAMIC COATING', 4999.00),
(11, 1, 'CAR CERAMIC COATING', 19999.00),
(12, 1, 'UNDERCHASSIS RUST COATING', 2499.00),
(13, 1, 'CAR WASH & WAX', 999.00),
(14, 1, 'FULL BODY PAINTING', 24999.00),
(15, 1, 'COMPLETE CAR SPA', 1499.00),
(16, 1, 'CAR MACHINE POLISH', 1999.00),
(17, 1, 'INTERIOR DETAILING', 999.00),
(18, 1, 'BUMPER REPAINTING', 2499.00);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_types`
--

DROP TABLE IF EXISTS `vehicle_types`;
CREATE TABLE IF NOT EXISTS `vehicle_types` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `vehicle_type_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicle_type.vehicle_type_name` (`vehicle_type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `vehicle_types`
--

INSERT INTO `vehicle_types` (`id`, `vehicle_type_name`) VALUES
(2, 'Bike'),
(1, 'Car');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `city_has_services`
--
ALTER TABLE `city_has_services`
  ADD CONSTRAINT `city` FOREIGN KEY (`city`) REFERENCES `cities` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `service` FOREIGN KEY (`service`) REFERENCES `services` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services.vehicle_type` FOREIGN KEY (`vehicle_type`) REFERENCES `vehicle_types` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
