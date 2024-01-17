-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for hotel_booking
CREATE DATABASE IF NOT EXISTS `hotel_booking` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `hotel_booking`;

-- Dumping structure for table hotel_booking.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hotel_booking.customers: ~0 rows (approximately)

-- Dumping structure for table hotel_booking.reservations
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `room_id` int DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `room_id` (`room_id`),
  CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hotel_booking.reservations: ~0 rows (approximately)

-- Dumping structure for table hotel_booking.rooms
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `picture` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `availability` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hotel_booking.rooms: ~3 rows (approximately)
INSERT INTO `rooms` (`id`, `name`, `description`, `picture`, `price`, `availability`) VALUES
	(1, 'Deluxe Suite', 'Spacious and luxurious suite with a view', 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 200.00, 1),
	(2, 'Standard Room', 'Comfortable room with essential amenities', 'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 100.00, 1),
	(3, 'Executive Suite', 'Exclusive suite with extra amenities', 'https://images.unsplash.com/photo-1631049035634-c04c637651b1?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 300.00, 1);

-- Dumping structure for table hotel_booking.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hotel_booking.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `username`, `password`) VALUES
	(1, 'es', '$2y$10$N6iXrY2jFuR6JMD8qm5fz.wl2r64a4Gdlf3mTMzNP5P1DXbXTxUEG'),
	(2, 'es', '$2y$10$spRvHhL83gIyKx73/3sD6eJ1AdFPND5R5ZIuxcqXF3awMo87cpQpu'),
	(3, 'es', '$2y$10$LZuO3eVG9nEopJ7aVVa6Vur0BYld3dT..6XtDLFwnwGYIVrgFH8Ym'),
	(4, 'es', '$2y$10$l4UsVRMBk1pMdtQlf2kDRePw2qwMRFnf/6uC9hw3BxJZN/cvVs7Yu'),
	(5, 'ess', '$2y$10$lWpX9mpjSSLdVIa6Rljgn.LEjtqnOfJ1XZS44hQjwFiJ.Facn9us2'),
	(6, '', '$2y$10$p4XjZ/No0DpVENbRhv08XerWvInLKbRgg6CAOmdvOjWxPCrcS6xt6'),
	(7, 'eee', '$2y$10$adgSLc91yMvNMUqorteYS.PnM8LiD3tE6GkaE3y29dDFeiHUy/2se'),
	(8, 'eeee', '$2y$10$ypBlOMZR1DW5I9Z6zHg71.UdKZX0.VmquIp0BQOh7TfpxQ7zJp4Jm'),
	(9, 'e1', '$2y$10$HGuNnlwXv9eJ5v.OQ/SIguGAlNOFW5O.WNL8qyibGsa3bVsEBQGui'),
	(10, 'e11', '$2y$10$BvXzMSCGA6VgdB8WpkRrV.i03hqHKHwHHKjbpbLiIYjU3I4Upv4ZO');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
