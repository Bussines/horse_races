-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.12 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for hcompetition
CREATE DATABASE IF NOT EXISTS `hcompetition` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `hcompetition`;

-- Dumping structure for table hcompetition.horse
CREATE TABLE IF NOT EXISTS `horse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `speed` double NOT NULL,
  `strength` double NOT NULL,
  `endurance` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hcompetition.horse: ~32 rows (approximately)
DELETE FROM `horse`;
/*!40000 ALTER TABLE `horse` DISABLE KEYS */;
INSERT INTO `horse` (`id`, `name`, `speed`, `strength`, `endurance`) VALUES
	(137, 'Horse_OmRJJ1aPFR', 8.69, 3, 6),
	(138, 'Horse_ae5oy3MUPK', 4, 1, 5),
	(139, 'Horse_w7Ua2crm0v', 8.75, 8, 8),
	(140, 'Horse_uuOTBDbzQy', 6, 6, 5),
	(141, 'Horse_gq4ldxLmsg', 7.92, 5, 9),
	(142, 'Horse_ZHmM0thKYv', 9.46, 7, 8),
	(143, 'Horse_U8uPpFkLMk', 3.37, 5, 8),
	(144, 'Horse_PDXZOUJsfo', 6.44, 0, 4),
	(145, 'Horse_PI2rQJ07hJ', 7.91, 8, 4),
	(146, 'Horse_4rQWn3W2qF', 8.41, 5, 3),
	(147, 'Horse_ZtOVuaDYrg', 6.08, 8, 2),
	(148, 'Horse_FfHMBMWzoG', 6.14, 5, 6),
	(149, 'Horse_pDp80BBJca', 8.72, 1, 9),
	(150, 'Horse_M0gsi5S38D', 3.9, 0, 4),
	(151, 'Horse_yBGasvgJAr', 8.02, 7, 5),
	(152, 'Horse_oLbX9ln8Kj', 4.97, 8, 5),
	(153, 'Horse_eohEsArWYY', 1.25, 5, 8),
	(154, 'Horse_fJskb4nYJJ', 8.31, 1, 8),
	(155, 'Horse_uiDZYWgydm', 3.37, 8, 9),
	(156, 'Horse_Zd81Btq76U', 7.65, 8, 6),
	(157, 'Horse_JXpHfeqTNr', 7.11, 2, 9),
	(158, 'Horse_ZJshKesSuW', 6.04, 0, 5),
	(159, 'Horse_lxrVYThVr2', 8.28, 9, 2),
	(160, 'Horse_ep7D67WLPA', 1.69, 1, 1),
	(161, 'Horse_GqjYBOOtKT', 7.19, 7, 3),
	(162, 'Horse_eDE9qqfvk3', 6.53, 5, 4),
	(163, 'Horse_lzcxX1EI2X', 3.71, 6, 4),
	(164, 'Horse_j2eEGqt8Zq', 5.41, 6, 6),
	(165, 'Horse_ciL1LLa96h', 7.92, 0, 7),
	(166, 'Horse_FqIZyBoMzS', 7.33, 0, 8),
	(167, 'Horse_pxcUWP89Zg', 8.2, 0, 9),
	(168, 'Horse_W4sYI3d5Er', 4.93, 1, 1),
	(169, 'Horse_kuGZkaTMvy', 5.03, 3.68, 7.49),
	(170, 'Horse_dckFUzGi9l', 2.76, 2.31, 5.9),
	(171, 'Horse_UsB08qvRz3', 4, 6.53, 6.76),
	(172, 'Horse_JLjSoorWNp', 8, 4.24, 4.95),
	(173, 'Horse_oTALTr0AVv', 1.23, 7.48, 3.5),
	(174, 'Horse_sQbuw6QtFy', 6.57, 9.31, 9.09),
	(175, 'Horse_w4rhjzebKV', 6.57, 6.21, 1.73),
	(176, 'Horse_7OGzixykLq', 6.38, 2.77, 5.53),
	(177, 'Horse_jcplOJYm1E', 4, 9.37, 3.91),
	(178, 'Horse_dxEhIqUrt5', 7.55, 9.64, 7.14),
	(179, 'Horse_h7svzcNCt2', 9.11, 0.99, 4),
	(180, 'Horse_9kaF24AvQk', 7.72, 2.91, 0.92),
	(181, 'Horse_rjf0aFoxaw', 7.02, 6.15, 1.44),
	(182, 'Horse_TrXBdkp1SO', 4.39, 7.9, 5.23),
	(183, 'Horse_TTYalb6lTM', 2.72, 5.98, 4.34),
	(184, 'Horse_odODxQUZGp', 9.55, 0.65, 6.59),
	(185, 'Horse_q3VAs4SLtx', 9.83, 3.1, 1.23),
	(186, 'Horse_nTuBv7X7va', 8.15, 7.41, 6.41),
	(187, 'Horse_QX68VLOeja', 5.7, 5.33, 6.08),
	(188, 'Horse_bLHKw2PAXw', 1.77, 1.51, 3.72),
	(189, 'Horse_DWY3xeqw5f', 4.68, 9.19, 4.36),
	(190, 'Horse_nLuPpVIqvX', 8.53, 4.42, 7.84),
	(191, 'Horse_ma9GwTXuLZ', 4.07, 8.64, 8.86),
	(192, 'Horse_1hs0MxgIAD', 1.86, 4.8, 5.12),
	(193, 'Horse_H4SqokzJN6', 8.64, 8.98, 1.42),
	(194, 'Horse_gl3lXVCWgp', 2.82, 6.71, 3.89),
	(195, 'Horse_paX3NxyKUs', 9.51, 1.15, 3.65),
	(196, 'Horse_EXfW4ttEtE', 8.8, 4.67, 8.95),
	(197, 'Horse_FRnzGAjoki', 2.88, 7.36, 5.42),
	(198, 'Horse_vOA3EfoeMr', 6.02, 5.68, 3.82),
	(199, 'Horse_wWNrpw5zVX', 3.68, 7.84, 9.63),
	(200, 'Horse_Lr87J3zWUd', 4.95, 4.28, 8.19);
/*!40000 ALTER TABLE `horse` ENABLE KEYS */;

-- Dumping structure for table hcompetition.migration_versions
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hcompetition.migration_versions: ~5 rows (approximately)
DELETE FROM `migration_versions`;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
	('20190720123854', '2019-07-20 12:39:33'),
	('20190721045657', '2019-07-21 04:57:19'),
	('20190722122653', '2019-07-22 12:27:03'),
	('20190723050221', '2019-07-23 05:03:02'),
	('20190723050240', '2019-07-23 05:03:02');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;

-- Dumping structure for table hcompetition.race
CREATE TABLE IF NOT EXISTS `race` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` int(11) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hcompetition.race: ~4 rows (approximately)
DELETE FROM `race`;
/*!40000 ALTER TABLE `race` DISABLE KEYS */;
INSERT INTO `race` (`id`, `timestamp`, `status`) VALUES
	(18, 1360, 'finished'),
	(19, 610, 'finished'),
	(20, 360, 'finished'),
	(21, 520, 'finished'),
	(22, 830, 'in_progress'),
	(23, 830, 'in_progress'),
	(24, 420, 'finished'),
	(25, 0, 'ready_to_start');
/*!40000 ALTER TABLE `race` ENABLE KEYS */;

-- Dumping structure for table hcompetition.race_horse
CREATE TABLE IF NOT EXISTS `race_horse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `race_id_id` int(11) NOT NULL,
  `horse_id_id` int(11) NOT NULL,
  `position` double NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_84A40E09997ABF46` (`race_id_id`),
  KEY `IDX_84A40E09C0C65466` (`horse_id_id`),
  CONSTRAINT `FK_84A40E09997ABF46` FOREIGN KEY (`race_id_id`) REFERENCES `race` (`id`),
  CONSTRAINT `FK_84A40E09C0C65466` FOREIGN KEY (`horse_id_id`) REFERENCES `horse` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hcompetition.race_horse: ~32 rows (approximately)
DELETE FROM `race_horse`;
/*!40000 ALTER TABLE `race_horse` DISABLE KEYS */;
INSERT INTO `race_horse` (`id`, `race_id_id`, `horse_id_id`, `position`, `time`) VALUES
	(105, 18, 137, 1500, 102),
	(106, 18, 138, 1500, 252),
	(107, 18, 139, 1500, 105),
	(108, 18, 140, 1500, 1349),
	(109, 18, 141, 1500, 110),
	(110, 18, 142, 1500, 98),
	(111, 18, 143, 1500, 201),
	(112, 18, 144, 1500, 121),
	(113, 19, 145, 1500, 136),
	(114, 19, 146, 1500, 116),
	(115, 19, 147, 1500, 598),
	(116, 19, 148, 1500, 144),
	(117, 19, 149, 1500, 97),
	(118, 19, 150, 1500, 160),
	(119, 19, 151, 1500, 124),
	(120, 19, 152, 1500, 219),
	(121, 20, 153, 1500, 352),
	(122, 20, 154, 1500, 101),
	(123, 20, 155, 1500, 219),
	(124, 20, 156, 1500, 128),
	(125, 20, 157, 1500, 115),
	(126, 20, 158, 1500, 126),
	(127, 20, 159, 1500, 154),
	(128, 20, 160, 1500, 256),
	(129, 21, 161, 1500, 154),
	(130, 21, 162, 1500, 145),
	(131, 21, 163, 1500, 511),
	(132, 21, 164, 1500, 166),
	(133, 21, 165, 1500, 104),
	(134, 21, 166, 1500, 110),
	(135, 21, 167, 1500, 101),
	(136, 21, 168, 1500, 153),
	(137, 22, 169, 1500, 154),
	(138, 22, 170, 1500, 211),
	(139, 22, 171, 1500, 457),
	(140, 22, 172, 1500, 114),
	(141, 22, 173, 930.3648, 830),
	(142, 22, 174, 1500, 135),
	(143, 22, 175, 1500, 174),
	(144, 22, 176, 1500, 132),
	(145, 23, 177, 1354.0464, 830),
	(146, 23, 178, 1500, 132),
	(147, 23, 179, 1500, 95),
	(148, 23, 180, 1500, 122),
	(149, 23, 181, 1500, 158),
	(150, 23, 182, 1500, 250),
	(151, 23, 183, 1500, 442),
	(152, 23, 184, 1500, 90),
	(153, 24, 185, 1500, 98),
	(154, 24, 186, 1500, 117),
	(155, 24, 187, 1500, 154),
	(156, 24, 188, 1500, 252),
	(157, 24, 189, 1500, 340),
	(158, 24, 190, 1500, 104),
	(159, 24, 191, 1500, 198),
	(160, 24, 192, 1500, 413),
	(161, 25, 193, 0, 0),
	(162, 25, 194, 0, 0),
	(163, 25, 195, 0, 0),
	(164, 25, 196, 0, 0),
	(165, 25, 197, 0, 0),
	(166, 25, 198, 0, 0),
	(167, 25, 199, 0, 0),
	(168, 25, 200, 0, 0);
/*!40000 ALTER TABLE `race_horse` ENABLE KEYS */;

-- Dumping structure for table hcompetition.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table hcompetition.user: ~2 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
	(8, 'admin@test.com', '["ROLE_ADMIN", "ROLE_USER"]', '$argon2i$v=19$m=65536,t=6,p=1$c2ZacEJ2SnlCZHhIRGVRbg$yw0io0s7Ht4wdAxAJi6Ja3aQkVPwBhNCykJKmN6aULQ'),
	(14, 'test@test.com', '["ROLE_USER"]', '$argon2i$v=19$m=65536,t=6,p=1$SFoxY3ZSY0YxRGtoeUc4VA$CG/Iq8m7bo0I9QdSc2HimnXeEAyBX3e96tqgB5fv8UY');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
