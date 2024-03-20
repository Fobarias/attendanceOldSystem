-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.27-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for etufarm
CREATE DATABASE IF NOT EXISTS `etufarm` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `etufarm`;

-- Dumping structure for table etufarm.attendance
CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `arrivalTime` varchar(50) DEFAULT NULL,
  `leavingTime` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `EmpID` (`uid`),
  CONSTRAINT `EmpID` FOREIGN KEY (`uid`) REFERENCES `employee` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=338 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table etufarm.attendance: ~17 rows (approximately)
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
INSERT INTO `attendance` (`id`, `uid`, `date`, `arrivalTime`, `leavingTime`) VALUES
	(260, 1, '2023-01-24', 'CO', 'CO'),
	(261, 2, '2023-01-24', 'CO', 'CO'),
	(262, 3, '2023-01-24', '08:46', '17:00'),
	(263, 4, '2023-01-24', '08:50', '17:02'),
	(267, 4, '2023-01-25', '08:55', '17:12'),
	(268, 1, '2023-01-25', '08:54', '17:03'),
	(269, 2, '2023-01-25', 'CO', 'CO'),
	(270, 3, '2023-01-25', '08:51', '17:05'),
	(271, 4, '2023-01-25', '08:57', '17:13'),
	(272, 1, '2023-01-25', '08:56', '17:07'),
	(273, 2, '2023-01-25', '08:47', '17:12'),
	(274, 3, '2023-01-25', '08:54', '17:03'),
	(275, 4, '2023-01-25', '08:46', '17:07'),
	(276, 1, '2023-01-25', '08:53', '17:10'),
	(277, 2, '2023-01-25', '08:58', '17:11'),
	(278, 3, '2023-01-25', '08:48', '17:02'),
	(335, 1, '2023-01-30', '08:59', ''),
	(336, 2, '2023-01-30', 'CO', 'CO'),
	(337, 3, '2023-01-30', '09:00', '17:34');
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;

-- Dumping structure for table etufarm.employee
CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `signature` varchar(64) DEFAULT NULL,
  `vacation` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table etufarm.employee: ~4 rows (approximately)
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` (`id`, `name`, `signature`, `vacation`) VALUES
	(1, 'Balmuș Adrian Daniel', 'balmus-7766695528.png', 0),
	(2, 'Ojică Ionuț - Florin', 'ojica-1658953433.png', 0),
	(3, 'Huc Adrian Ioan', 'huc-3859273064.png', 0),
	(4, 'Olaru Gabriel', 'olaru-5585339323.png', 0);
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
