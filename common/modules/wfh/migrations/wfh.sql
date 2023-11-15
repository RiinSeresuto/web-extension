-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.34-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_dilg_intranet_07242019
CREATE DATABASE IF NOT EXISTS `db_dilg_intranet_07242019` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_dilg_intranet_07242019`;

-- Dumping structure for table db_dilg_intranet_07242019.wfh_record
CREATE TABLE IF NOT EXISTS `wfh_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `time_in` datetime NOT NULL,
  `time_out` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_dilg_intranet_07242019.wfh_record: ~0 rows (approximately)
DELETE FROM `wfh_record`;
/*!40000 ALTER TABLE `wfh_record` DISABLE KEYS */;
/*!40000 ALTER TABLE `wfh_record` ENABLE KEYS */;

-- Dumping structure for table db_dilg_intranet_07242019.wfh_task
CREATE TABLE IF NOT EXISTS `wfh_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `status` enum('Ongoing','On Hold','Completed','Cancelled') NOT NULL,
  `description` mediumtext NOT NULL,
  `reason` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_dilg_intranet_07242019.wfh_task: ~0 rows (approximately)
DELETE FROM `wfh_task`;
/*!40000 ALTER TABLE `wfh_task` DISABLE KEYS */;
/*!40000 ALTER TABLE `wfh_task` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
