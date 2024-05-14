-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table db_dilg_web_ext.cms_category: ~18 rows (approximately)
INSERT INTO `cms_category` (`id`, `title`, `status_id`, `user_id`, `user_update_id`, `date_created`, `date_updated`) VALUES
	(1, 'Central News', 1, 1, NULL, '2024-03-21 10:23:24', '2024-04-16 06:59:07'),
	(2, 'Regional News', 1, 1, NULL, '2024-04-16 07:00:10', NULL),
	(3, 'Bids and Awards', 2, 1, 1, '2024-04-03 00:49:07', '2024-04-22 02:32:04'),
	(4, 'Advisory', 1, 1, NULL, '2024-03-11 05:22:15', '2024-04-22 02:32:06'),
	(5, 'Bills', 1, 1, NULL, '2024-03-20 06:44:43', '2024-04-22 02:32:08'),
	(6, 'Careers', 1, 1, NULL, '2024-03-21 10:17:59', '2024-04-22 02:32:11'),
	(7, 'Events', 1, 1, NULL, '2024-03-21 10:18:20', '2024-04-22 02:32:12'),
	(8, 'Facts and Figures', 1, 1, NULL, '2024-03-21 10:18:41', '2024-04-22 02:32:15'),
	(9, 'FAQ', 1, 1, NULL, '2024-03-21 10:19:18', '2024-04-22 02:32:17'),
	(10, 'Issuances', 1, 1, NULL, '2024-03-21 10:19:55', '2024-04-22 02:32:20'),
	(11, 'Key Officials', 1, 1, NULL, '2024-03-21 10:21:24', '2024-04-22 05:59:27'),
	(12, 'Legal Opinions', 1, 1, NULL, '2024-03-21 10:22:54', '2024-04-22 05:59:35'),
	(13, 'Programs and Projects', 1, 1, NULL, '2024-03-21 10:23:47', '2024-04-22 05:59:40'),
	(14, 'Related Links', 1, 1, NULL, '2024-03-21 10:24:28', '2024-04-22 05:59:43'),
	(15, 'Reportorial', 1, 1, NULL, '2024-03-21 10:24:47', '2024-04-22 05:59:46'),
	(16, 'Reports and Resources', 1, 1, NULL, '2024-03-21 10:25:11', '2024-04-22 06:00:01'),
	(17, 'Transparency', 1, 1, NULL, '2024-03-21 10:26:45', '2024-04-22 06:04:54'),
	(18, 'What\'s New', 1, 1, NULL, '2024-03-21 10:27:06', '2024-04-22 06:43:08');

-- Dumping data for table db_dilg_web_ext.cms_field: ~34 rows (approximately)
INSERT INTO `cms_field` (`id`, `label`, `data_type_id`, `widget_type_id`, `user_id`, `user_update_id`, `date_created`, `date_updated`) VALUES
	(1, 'Title', 1, 2, 1, 1, '2024-05-03 01:28:35', '2024-05-03 01:28:35'),
	(2, 'Content', 1, 1, 1, 1, '2024-05-03 01:28:37', '2024-05-03 01:28:37'),
	(3, 'File Upload', 2, 5, 1, 1, '2024-05-03 01:28:38', '2024-05-03 01:28:38'),
	(4, 'URL', 1, 2, 1, 1, '2024-05-03 01:28:42', '2024-05-03 01:28:42'),
	(5, 'Summary', 1, 2, 1, 1, '2024-05-03 01:28:45', '2024-05-03 01:28:45'),
	(6, 'Caption', 1, 2, 1, 1, '2024-05-03 01:28:47', '2024-05-03 01:28:47'),
	(8, 'Contact Person', 1, 2, 1, 1, '2024-05-14 01:17:15', '2024-05-14 01:17:15'),
	(15, 'Subject', 1, 2, 1, NULL, '2024-05-03 01:33:20', NULL),
	(16, 'Contact Information', 1, 2, 1, NULL, '2024-05-03 01:34:07', NULL),
	(17, 'Bids and Awards Category', 1, 3, 1, NULL, '2024-05-03 01:38:21', NULL),
	(18, 'Office Responsible', 1, 2, 1, NULL, '2024-05-03 01:40:13', NULL),
	(19, 'Position Type', 1, 3, 1, NULL, '2024-05-03 01:54:29', NULL),
	(20, 'Position Title', 1, 2, 1, NULL, '2024-05-03 02:18:01', NULL),
	(21, 'Person Needed', 2, 2, 1, 1, '2024-05-03 02:21:42', '2024-05-03 02:21:42'),
	(22, 'Item Number', 2, 2, 1, NULL, '2024-05-03 02:22:06', NULL),
	(23, 'Monthly Salary', 2, 2, 1, 1, '2024-05-03 02:22:35', '2024-05-03 02:22:35'),
	(24, 'Salary Grade', 2, 2, 1, NULL, '2024-05-03 02:24:50', NULL),
	(25, 'Agency', 1, 2, 1, NULL, '2024-05-03 02:25:12', NULL),
	(26, 'Place Assignment', 1, 2, 1, NULL, '2024-05-03 02:25:28', NULL),
	(27, 'Job Description', 1, 2, 1, NULL, '2024-05-03 02:25:53', NULL),
	(28, 'Education', 1, 2, 1, NULL, '2024-05-03 02:26:12', NULL),
	(29, 'Experience', 1, 2, 1, NULL, '2024-05-03 02:26:33', NULL),
	(30, 'Trainings', 1, 2, 1, NULL, '2024-05-03 02:26:47', NULL),
	(31, 'Eligibility', 1, 2, 1, NULL, '2024-05-03 02:27:01', NULL),
	(32, 'Application Link', 1, 2, 1, NULL, '2024-05-03 02:27:23', NULL),
	(33, 'Start Date', 3, 4, 1, NULL, '2024-05-03 02:27:59', NULL),
	(34, 'End Date', 3, 4, 1, NULL, '2024-05-03 02:28:11', NULL),
	(35, 'Upload Photo', 2, 5, 1, NULL, '2024-05-03 02:28:49', NULL),
	(36, 'Question', 1, 2, 1, 1, '2024-05-03 02:29:18', '2024-05-03 02:29:18'),
	(37, 'Answer', 1, 1, 1, NULL, '2024-05-03 02:29:31', NULL),
	(38, 'Issuance Type', 1, 3, 1, NULL, '2024-05-03 02:38:21', NULL),
	(39, 'FAQ Subject', 1, 3, 1, NULL, '2024-05-03 02:50:39', NULL),
	(40, 'Issuance Number', 1, 2, 1, NULL, '2024-05-03 02:51:12', NULL),
	(41, 'Department', 1, 2, 1, NULL, '2024-05-10 02:02:45', NULL),
	(48, 'Section', 1, 2, 1, NULL, '2024-05-14 03:22:07', NULL),
	(49, 'First Name', 1, 2, 1, NULL, '2024-05-14 03:22:34', NULL),
	(50, 'Middle Name', 1, 2, 1, NULL, '2024-05-14 03:22:50', NULL),
	(51, 'Last Name', 1, 2, 1, NULL, '2024-05-14 03:23:06', NULL),
	(52, 'Position Title', 1, 2, 1, NULL, '2024-05-14 03:23:23', NULL),
	(53, 'Email', 1, 2, 1, NULL, '2024-05-14 03:23:44', NULL),
	(54, 'Direct Line', 1, 2, 1, NULL, '2024-05-14 03:24:00', NULL),
	(55, 'Local Number', 1, 2, 1, NULL, '2024-05-14 03:24:18', NULL),
	(56, 'Order', 1, 2, 1, NULL, '2024-05-14 03:24:32', NULL),
	(57, 'Legal Opinions Category', 1, 3, 1, NULL, '2024-05-14 03:38:28', NULL),
	(58, 'Legal Opinions Category', 1, 3, 1, NULL, '2024-05-14 03:38:34', NULL),
	(59, 'Programs and Projects Type', 1, 3, 1, NULL, '2024-05-14 03:40:05', NULL),
	(60, 'Link Name', 1, 2, 1, NULL, '2024-05-14 05:03:00', NULL),
	(61, 'Reportorial Type', 1, 3, 1, NULL, '2024-05-14 05:05:33', NULL),
	(62, 'Reportorial Category', 1, 3, 1, NULL, '2024-05-14 05:11:23', NULL),
	(63, 'Order', 1, 2, 1, NULL, '2024-05-14 05:12:15', NULL),
	(64, 'Keyword', 1, 2, 1, NULL, '2024-05-14 05:12:29', NULL),
	(65, 'Reports Type', 1, 3, 1, NULL, '2024-05-14 05:15:28', NULL),
	(66, 'Reports Category', 1, 3, 1, NULL, '2024-05-14 05:23:57', NULL);

-- Dumping data for table db_dilg_web_ext.cms_form: ~5 rows (approximately)
INSERT INTO `cms_form` (`id`, `category_id`, `description`, `status_id`, `year`, `user_id`, `user_update_id`, `date_created`, `date_updated`) VALUES
	(60, 6, 'Advisory content for year 2024', 1, 2024, 1, NULL, '2024-04-05 07:26:35', NULL),
	(61, 1, 'Central News content for 2024', 1, 2024, 1, NULL, '2024-04-16 07:12:16', NULL),
	(62, 2, 'Regional News content for 2024', 1, 2024, 1, NULL, '2024-04-16 07:13:30', NULL),
	(63, 3, 'Bids and Awards content for year 2024', 1, 2024, 1, NULL, '2024-05-03 05:07:46', NULL),
	(64, 4, 'Advisory content for year 2024', 1, 2024, 1, NULL, '2024-05-09 01:21:13', NULL);

-- Dumping data for table db_dilg_web_ext.cms_form_field: ~37 rows (approximately)
INSERT INTO `cms_form_field` (`id`, `form_id`, `field_id`) VALUES
	(1, 55, 2),
	(2, 55, 4),
	(3, 55, 8),
	(4, 56, 2),
	(5, 56, 3),
	(6, 56, 7),
	(7, 56, 5),
	(8, 57, 2),
	(9, 57, 3),
	(10, 57, 5),
	(11, 58, 2),
	(12, 58, 4),
	(13, 58, 6),
	(14, 58, 10),
	(15, 60, 1),
	(16, 60, 4),
	(17, 60, 2),
	(18, 60, 3),
	(19, 61, 1),
	(20, 61, 2),
	(21, 61, 3),
	(22, 61, 6),
	(23, 62, 1),
	(24, 62, 2),
	(25, 62, 3),
	(26, 62, 6),
	(27, 63, 15),
	(28, 63, 18),
	(29, 63, 8),
	(30, 63, 16),
	(31, 63, 5),
	(32, 63, 3),
	(33, 64, 1),
	(34, 64, 4),
	(35, 64, 2),
	(36, 64, 3),
	(37, 64, 6);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
