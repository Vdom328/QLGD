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


-- Dumping database structure for qlgd
CREATE DATABASE IF NOT EXISTS `qlgd` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `qlgd`;

-- Dumping structure for table qlgd.class
CREATE TABLE IF NOT EXISTS `class` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlgd.class: ~8 rows (approximately)
INSERT INTO `class` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'A1', 'sấd', 0, '2024-01-06 18:54:03', '2024-01-06 18:57:14'),
	(2, 'A2', NULL, 0, '2024-01-06 18:54:22', '2024-01-06 18:54:22'),
	(3, 'B1', NULL, 0, '2024-01-06 18:54:30', '2024-01-06 18:54:30'),
	(4, 'C1', NULL, 0, '2024-01-06 18:54:44', '2024-01-06 18:54:44'),
	(5, 'D1', NULL, 0, '2024-01-06 18:54:52', '2024-01-06 18:54:52'),
	(6, 'E1', NULL, 0, '2024-01-06 18:55:01', '2024-01-06 18:55:01'),
	(7, 'C2', NULL, 0, '2024-01-06 18:55:08', '2024-01-06 18:55:08'),
	(8, 'B2', NULL, 0, '2024-01-06 18:55:16', '2024-01-06 18:55:16');

-- Dumping structure for table qlgd.class_room
CREATE TABLE IF NOT EXISTS `class_room` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlgd.class_room: ~4 rows (approximately)
INSERT INTO `class_room` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'A501', 'Phòng học tầng 5 tên 501', 0, '2023-12-25 12:13:39', '2023-12-28 15:43:26'),
	(2, 'A502', NULL, 0, '2023-12-25 12:33:37', '2023-12-28 15:50:34'),
	(3, 'A503', NULL, 1, '2023-12-25 12:43:02', '2023-12-25 12:43:02'),
	(4, 'A505', NULL, 0, '2023-12-25 12:45:44', '2023-12-25 12:45:44'),
	(5, 'A506', NULL, 1, '2023-12-25 12:46:14', '2023-12-25 12:46:14'),
	(6, 'A5033', 'dsasdasdasdsad', 0, '2023-12-31 05:25:42', '2023-12-31 05:25:42');

-- Dumping structure for table qlgd.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlgd.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table qlgd.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlgd.migrations: ~19 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2023_09_05_122047_create_profiles_table', 1),
	(6, '2023_09_05_130514_create_roles_table', 1),
	(7, '2023_09_05_130527_create_role_user_table', 1),
	(8, '2023_09_05_130546_create_permissions_table', 1),
	(9, '2023_09_05_130704_create_permission_role_table', 1),
	(10, '2023_09_05_130715_create_permission_user_table', 1),
	(13, '2023_12_25_185649_create_class_room_table', 2),
	(16, '2023_12_28_234049_create_subject_table', 3),
	(17, '2023_12_30_021406_create_subject_labs_table', 4),
	(19, '2023_12_31_123417_create_teacher_subjects_table', 5),
	(20, '2024_01_03_001537_create_settings_table', 6),
	(21, '2024_01_03_001956_create_setting_credits_table', 6),
	(22, '2024_01_04_183906_create_schedule_table', 7),
	(23, '2024_01_04_184124_create_schedule_table_table', 7),
	(25, '2024_01_04_184555_create_schedule_error_table', 8),
	(26, '2024_01_06_233642_create_teacher_time_slots_table', 9),
	(27, '2024_01_07_014449_create_class_table', 10),
	(28, '2024_01_08_224914_create_student_subject_table', 11),
	(29, '2024_01_12_021342_add_column_to_schedule_table', 12);

-- Dumping structure for table qlgd.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlgd.password_reset_tokens: ~1 rows (approximately)
INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
	('vudat1328@gmail.com', '$2y$10$2ieT6tqxS55fDVZqU8L/BuXt7TAV/LUqOf4nErUdZ99.rB6u4f15e', '2023-12-31 06:08:29');

-- Dumping structure for table qlgd.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlgd.permissions: ~4 rows (approximately)
INSERT INTO `permissions` (`id`, `name`, `slug`, `description`, `model`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Can View Users', 'view.users', 'Can view users', 'Permission', '2023-12-25 06:24:35', '2023-12-25 06:24:35', NULL),
	(2, 'Can Create Users', 'create.users', 'Can create new users', 'Permission', '2023-12-25 06:24:35', '2023-12-25 06:24:35', NULL),
	(3, 'Can Edit Users', 'edit.users', 'Can edit users', 'Permission', '2023-12-25 06:24:35', '2023-12-25 06:24:35', NULL),
	(4, 'Can Delete Users', 'delete.users', 'Can delete users', 'Permission', '2023-12-25 06:24:35', '2023-12-25 06:24:35', NULL);

-- Dumping structure for table qlgd.permission_role
CREATE TABLE IF NOT EXISTS `permission_role` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int unsigned NOT NULL,
  `role_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlgd.permission_role: ~0 rows (approximately)

-- Dumping structure for table qlgd.permission_user
CREATE TABLE IF NOT EXISTS `permission_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_user_permission_id_index` (`permission_id`),
  KEY `permission_user_user_id_index` (`user_id`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlgd.permission_user: ~0 rows (approximately)

-- Dumping structure for table qlgd.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlgd.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table qlgd.profiles
CREATE TABLE IF NOT EXISTS `profiles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `staff_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profiles_user_id_index` (`user_id`),
  CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlgd.profiles: ~7 rows (approximately)
INSERT INTO `profiles` (`id`, `user_id`, `staff_no`, `first_name`, `last_name`, `avatar`, `phone`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, '0001', '1', 'last', NULL, '+84387190348', '2023-12-25 06:24:35', '2023-12-31 05:25:07', NULL),
	(2, 2, '0002', '2', 'last', NULL, NULL, '2023-12-25 06:24:35', '2023-12-25 06:24:35', NULL),
	(3, 3, '0003', '3', 'last', NULL, NULL, '2023-12-25 06:24:35', '2023-12-25 06:24:35', NULL),
	(4, 4, '0004', 'sad', 'vudat1328@', NULL, '0387190348', '2023-12-25 11:03:24', '2023-12-25 11:03:24', NULL),
	(5, 5, '0005', 'Giảng viên', 'A', '659036ca03532.jpg', '0387190348', '2023-12-30 17:27:06', '2023-12-30 17:27:06', NULL),
	(6, 6, '0006', 'â', 'â', NULL, '0387190348', '2023-12-31 05:17:05', '2023-12-31 05:17:05', NULL),
	(7, 7, '0007', 'sđ', 'sad', '6590df00ad8b5.jpg', '022252555', '2023-12-31 05:24:49', '2023-12-31 05:24:49', NULL),
	(8, 8, '0008', 'duc', 'xeko', '659157107b745.jpg', '0387190348', '2023-12-31 13:57:04', '2023-12-31 13:57:04', NULL);

-- Dumping structure for table qlgd.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlgd.roles: ~3 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `level`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Admin', 'admin', 'admin', 1, '2023-12-25 06:24:35', '2023-12-25 06:24:35', NULL),
	(2, 'Teacher', 'teacher', 'teacher', 2, '2023-12-25 06:24:35', '2023-12-25 06:24:35', NULL),
	(3, 'Student', 'student', 'student', 3, '2023-12-25 06:24:35', '2023-12-25 06:24:35', NULL);

-- Dumping structure for table qlgd.role_user
CREATE TABLE IF NOT EXISTS `role_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlgd.role_user: ~6 rows (approximately)
INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 1, '2023-12-25 06:24:35', '2023-12-25 06:24:35', NULL),
	(2, 2, 2, '2023-12-25 06:24:35', '2023-12-25 06:24:35', NULL),
	(3, 3, 3, '2023-12-25 06:24:35', '2023-12-25 06:24:35', NULL),
	(4, 2, 4, '2023-12-25 11:03:24', '2023-12-25 11:03:24', NULL),
	(5, 2, 5, '2023-12-30 17:27:06', '2023-12-30 17:27:06', NULL),
	(6, 1, 6, '2023-12-31 05:17:05', '2023-12-31 05:17:05', NULL),
	(7, 3, 7, '2023-12-31 05:24:48', '2023-12-31 05:24:48', NULL),
	(8, 1, 8, '2023-12-31 13:57:04', '2023-12-31 13:57:04', NULL);

-- Dumping structure for table qlgd.schedule
CREATE TABLE IF NOT EXISTS `schedule` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlgd.schedule: ~3 rows (approximately)
INSERT INTO `schedule` (`id`, `name`, `created_at`, `updated_at`, `status`) VALUES
	(33, 'TKB1', '2024-01-06 18:23:34', '2024-01-06 18:23:34', 1),
	(34, 'TKB2', '2024-01-06 18:23:39', '2024-01-06 18:23:39', 1),
	(35, 'TKB3', '2024-01-11 17:58:34', '2024-01-12 15:05:27', 0);

-- Dumping structure for table qlgd.schedule_error
CREATE TABLE IF NOT EXISTS `schedule_error` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `schedule_id` bigint unsigned NOT NULL,
  `error` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlgd.schedule_error: ~0 rows (approximately)

-- Dumping structure for table qlgd.schedule_table
CREATE TABLE IF NOT EXISTS `schedule_table` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `schedule_id` bigint unsigned NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_slots` int NOT NULL,
  `class_room_id` bigint unsigned NOT NULL,
  `teacher_subjects_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1210 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlgd.schedule_table: ~108 rows (approximately)
INSERT INTO `schedule_table` (`id`, `schedule_id`, `day`, `time_slots`, `class_room_id`, `teacher_subjects_id`, `created_at`, `updated_at`) VALUES
	(1048, 33, 'Thứ 2', 1, 2, 24, NULL, NULL),
	(1049, 33, 'Thứ 2', 1, 4, 34, NULL, NULL),
	(1050, 33, 'Thứ 2', 1, 6, 29, NULL, NULL),
	(1051, 33, 'Thứ 2', 2, 2, 24, NULL, NULL),
	(1052, 33, 'Thứ 2', 2, 4, 34, NULL, NULL),
	(1053, 33, 'Thứ 2', 2, 6, 29, NULL, NULL),
	(1054, 33, 'Thứ 2', 3, 1, 34, NULL, NULL),
	(1055, 33, 'Thứ 2', 3, 2, 24, NULL, NULL),
	(1056, 33, 'Thứ 2', 3, 4, 29, NULL, NULL),
	(1057, 33, 'Thứ 2', 4, 1, 34, NULL, NULL),
	(1058, 33, 'Thứ 2', 4, 2, 27, NULL, NULL),
	(1059, 33, 'Thứ 2', 4, 4, 29, NULL, NULL),
	(1060, 33, 'Thứ 2', 5, 2, 27, NULL, NULL),
	(1061, 33, 'Thứ 2', 6, 2, 27, NULL, NULL),
	(1062, 33, 'Thứ 2', 7, 6, 25, NULL, NULL),
	(1063, 33, 'Thứ 2', 8, 6, 25, NULL, NULL),
	(1064, 33, 'Thứ 2', 9, 2, 35, NULL, NULL),
	(1065, 33, 'Thứ 2', 10, 2, 35, NULL, NULL),
	(1066, 33, 'Thứ 3', 1, 1, 23, NULL, NULL),
	(1067, 33, 'Thứ 3', 1, 4, 33, NULL, NULL),
	(1068, 33, 'Thứ 3', 1, 6, 28, NULL, NULL),
	(1069, 33, 'Thứ 3', 2, 1, 23, NULL, NULL),
	(1070, 33, 'Thứ 3', 2, 4, 33, NULL, NULL),
	(1071, 33, 'Thứ 3', 2, 6, 28, NULL, NULL),
	(1072, 33, 'Thứ 3', 3, 1, 23, NULL, NULL),
	(1073, 33, 'Thứ 3', 3, 6, 28, NULL, NULL),
	(1074, 33, 'Thứ 3', 4, 1, 26, NULL, NULL),
	(1075, 33, 'Thứ 3', 5, 1, 26, NULL, NULL),
	(1076, 33, 'Thứ 3', 6, 1, 26, NULL, NULL),
	(1077, 33, 'Thứ 3', 7, 1, 30, NULL, NULL),
	(1078, 33, 'Thứ 3', 7, 2, 27, NULL, NULL),
	(1079, 33, 'Thứ 3', 8, 1, 30, NULL, NULL),
	(1080, 33, 'Thứ 3', 8, 2, 27, NULL, NULL),
	(1081, 33, 'Thứ 3', 9, 1, 30, NULL, NULL),
	(1082, 33, 'Thứ 3', 9, 2, 27, NULL, NULL),
	(1083, 33, 'Thứ 3', 10, 1, 35, NULL, NULL),
	(1084, 33, 'Thứ 3', 11, 1, 35, NULL, NULL),
	(1085, 33, 'Thứ 4', 1, 1, 23, NULL, NULL),
	(1086, 33, 'Thứ 4', 1, 2, 28, NULL, NULL),
	(1087, 33, 'Thứ 4', 2, 1, 23, NULL, NULL),
	(1088, 33, 'Thứ 4', 2, 2, 28, NULL, NULL),
	(1089, 33, 'Thứ 4', 3, 1, 23, NULL, NULL),
	(1090, 33, 'Thứ 4', 3, 2, 28, NULL, NULL),
	(1091, 33, 'Thứ 4', 4, 2, 24, NULL, NULL),
	(1092, 33, 'Thứ 4', 5, 2, 24, NULL, NULL),
	(1093, 33, 'Thứ 4', 6, 2, 24, NULL, NULL),
	(1094, 33, 'Thứ 4', 7, 1, 26, NULL, NULL),
	(1095, 33, 'Thứ 4', 7, 2, 30, NULL, NULL),
	(1096, 33, 'Thứ 4', 8, 1, 26, NULL, NULL),
	(1097, 33, 'Thứ 4', 8, 2, 30, NULL, NULL),
	(1098, 33, 'Thứ 4', 9, 1, 26, NULL, NULL),
	(1099, 33, 'Thứ 4', 9, 2, 30, NULL, NULL),
	(1100, 33, 'Thứ 4', 10, 6, 25, NULL, NULL),
	(1101, 33, 'Thứ 4', 11, 6, 25, NULL, NULL),
	(1102, 34, 'Thứ 2', 1, 2, 24, NULL, NULL),
	(1103, 34, 'Thứ 2', 1, 6, 30, NULL, NULL),
	(1104, 34, 'Thứ 2', 2, 2, 24, NULL, NULL),
	(1105, 34, 'Thứ 2', 2, 6, 30, NULL, NULL),
	(1106, 34, 'Thứ 2', 3, 2, 24, NULL, NULL),
	(1107, 34, 'Thứ 2', 3, 6, 30, NULL, NULL),
	(1108, 34, 'Thứ 2', 4, 1, 26, NULL, NULL),
	(1109, 34, 'Thứ 2', 5, 1, 26, NULL, NULL),
	(1110, 34, 'Thứ 2', 6, 1, 26, NULL, NULL),
	(1111, 34, 'Thứ 2', 7, 2, 27, NULL, NULL),
	(1112, 34, 'Thứ 2', 8, 2, 27, NULL, NULL),
	(1113, 34, 'Thứ 2', 9, 2, 27, NULL, NULL),
	(1114, 34, 'Thứ 2', 10, 1, 35, NULL, NULL),
	(1115, 34, 'Thứ 2', 11, 1, 35, NULL, NULL),
	(1116, 34, 'Thứ 3', 1, 1, 28, NULL, NULL),
	(1117, 34, 'Thứ 3', 2, 1, 28, NULL, NULL),
	(1118, 34, 'Thứ 3', 3, 1, 28, NULL, NULL),
	(1119, 34, 'Thứ 3', 4, 1, 23, NULL, NULL),
	(1120, 34, 'Thứ 3', 4, 2, 29, NULL, NULL),
	(1121, 34, 'Thứ 3', 5, 1, 23, NULL, NULL),
	(1122, 34, 'Thứ 3', 5, 2, 29, NULL, NULL),
	(1123, 34, 'Thứ 3', 6, 1, 23, NULL, NULL),
	(1124, 34, 'Thứ 3', 6, 4, 29, NULL, NULL),
	(1125, 34, 'Thứ 3', 7, 2, 24, NULL, NULL),
	(1126, 34, 'Thứ 3', 7, 4, 29, NULL, NULL),
	(1127, 34, 'Thứ 3', 8, 1, 30, NULL, NULL),
	(1128, 34, 'Thứ 3', 8, 2, 24, NULL, NULL),
	(1129, 34, 'Thứ 3', 9, 1, 30, NULL, NULL),
	(1130, 34, 'Thứ 3', 9, 2, 24, NULL, NULL),
	(1131, 34, 'Thứ 3', 10, 1, 30, NULL, NULL),
	(1132, 34, 'Thứ 3', 10, 6, 25, NULL, NULL),
	(1133, 34, 'Thứ 3', 11, 6, 25, NULL, NULL),
	(1134, 34, 'Thứ 4', 1, 1, 23, NULL, NULL),
	(1135, 34, 'Thứ 4', 1, 2, 28, NULL, NULL),
	(1136, 34, 'Thứ 4', 2, 1, 23, NULL, NULL),
	(1137, 34, 'Thứ 4', 2, 2, 28, NULL, NULL),
	(1138, 34, 'Thứ 4', 3, 1, 23, NULL, NULL),
	(1139, 34, 'Thứ 4', 3, 2, 28, NULL, NULL),
	(1140, 34, 'Thứ 4', 4, 1, 26, NULL, NULL),
	(1141, 34, 'Thứ 4', 4, 2, 33, NULL, NULL),
	(1142, 34, 'Thứ 4', 5, 1, 26, NULL, NULL),
	(1143, 34, 'Thứ 4', 5, 2, 33, NULL, NULL),
	(1144, 34, 'Thứ 4', 6, 1, 26, NULL, NULL),
	(1145, 34, 'Thứ 4', 6, 4, 34, NULL, NULL),
	(1146, 34, 'Thứ 4', 7, 2, 27, NULL, NULL),
	(1147, 34, 'Thứ 4', 7, 4, 34, NULL, NULL),
	(1148, 34, 'Thứ 4', 8, 2, 27, NULL, NULL),
	(1149, 34, 'Thứ 4', 9, 2, 27, NULL, NULL),
	(1150, 34, 'Thứ 4', 10, 1, 35, NULL, NULL),
	(1151, 34, 'Thứ 4', 10, 2, 34, NULL, NULL),
	(1152, 34, 'Thứ 4', 10, 4, 25, NULL, NULL),
	(1153, 34, 'Thứ 4', 11, 1, 35, NULL, NULL),
	(1154, 34, 'Thứ 4', 11, 2, 34, NULL, NULL),
	(1155, 34, 'Thứ 4', 11, 4, 25, NULL, NULL),
	(1156, 35, 'Thứ 2', 1, 1, 28, NULL, NULL),
	(1157, 35, 'Thứ 2', 2, 1, 28, NULL, NULL),
	(1158, 35, 'Thứ 2', 3, 1, 28, NULL, NULL),
	(1159, 35, 'Thứ 2', 4, 1, 23, NULL, NULL),
	(1160, 35, 'Thứ 2', 5, 1, 23, NULL, NULL),
	(1161, 35, 'Thứ 2', 6, 1, 23, NULL, NULL),
	(1162, 35, 'Thứ 2', 7, 2, 27, NULL, NULL),
	(1163, 35, 'Thứ 2', 8, 2, 27, NULL, NULL),
	(1164, 35, 'Thứ 2', 9, 2, 27, NULL, NULL),
	(1165, 35, 'Thứ 3', 1, 1, 28, NULL, NULL),
	(1166, 35, 'Thứ 3', 1, 2, 24, NULL, NULL),
	(1167, 35, 'Thứ 3', 1, 6, 34, NULL, NULL),
	(1168, 35, 'Thứ 3', 2, 1, 28, NULL, NULL),
	(1169, 35, 'Thứ 3', 2, 2, 24, NULL, NULL),
	(1170, 35, 'Thứ 3', 2, 6, 34, NULL, NULL),
	(1171, 35, 'Thứ 3', 3, 1, 28, NULL, NULL),
	(1172, 35, 'Thứ 3', 3, 2, 24, NULL, NULL),
	(1173, 35, 'Thứ 3', 3, 4, 34, NULL, NULL),
	(1174, 35, 'Thứ 3', 4, 2, 30, NULL, NULL),
	(1175, 35, 'Thứ 3', 4, 4, 34, NULL, NULL),
	(1176, 35, 'Thứ 3', 5, 2, 30, NULL, NULL),
	(1177, 35, 'Thứ 3', 6, 2, 30, NULL, NULL),
	(1178, 35, 'Thứ 3', 7, 6, 30, NULL, NULL),
	(1179, 35, 'Thứ 3', 8, 6, 30, NULL, NULL),
	(1180, 35, 'Thứ 3', 9, 6, 30, NULL, NULL),
	(1181, 35, 'Thứ 4', 1, 1, 23, NULL, NULL),
	(1182, 35, 'Thứ 4', 2, 1, 23, NULL, NULL),
	(1183, 35, 'Thứ 4', 3, 1, 23, NULL, NULL),
	(1184, 35, 'Thứ 5', 1, 1, 26, NULL, NULL),
	(1185, 35, 'Thứ 5', 2, 1, 26, NULL, NULL),
	(1186, 35, 'Thứ 5', 3, 1, 26, NULL, NULL),
	(1187, 35, 'Thứ 5', 4, 2, 27, NULL, NULL),
	(1188, 35, 'Thứ 5', 5, 2, 27, NULL, NULL),
	(1189, 35, 'Thứ 5', 6, 2, 27, NULL, NULL),
	(1190, 35, 'Thứ 6', 1, 2, 24, NULL, NULL),
	(1191, 35, 'Thứ 6', 2, 2, 24, NULL, NULL),
	(1192, 35, 'Thứ 6', 3, 2, 24, NULL, NULL),
	(1193, 35, 'Thứ 6', 4, 6, 35, NULL, NULL),
	(1194, 35, 'Thứ 6', 5, 6, 35, NULL, NULL),
	(1195, 35, 'Thứ 6', 6, 1, 35, NULL, NULL),
	(1196, 35, 'Thứ 6', 7, 1, 35, NULL, NULL),
	(1197, 35, 'Thứ 7', 1, 1, 26, NULL, NULL),
	(1198, 35, 'Thứ 7', 1, 6, 29, NULL, NULL),
	(1199, 35, 'Thứ 7', 2, 1, 26, NULL, NULL),
	(1200, 35, 'Thứ 7', 2, 6, 29, NULL, NULL),
	(1201, 35, 'Thứ 7', 3, 1, 26, NULL, NULL),
	(1202, 35, 'Thứ 7', 4, 1, 29, NULL, NULL),
	(1203, 35, 'Thứ 7', 4, 2, 25, NULL, NULL),
	(1204, 35, 'Thứ 7', 5, 1, 29, NULL, NULL),
	(1205, 35, 'Thứ 7', 5, 2, 25, NULL, NULL),
	(1206, 35, 'Thứ 7', 6, 1, 33, NULL, NULL),
	(1207, 35, 'Thứ 7', 6, 4, 25, NULL, NULL),
	(1208, 35, 'Thứ 7', 7, 1, 33, NULL, NULL),
	(1209, 35, 'Thứ 7', 7, 4, 25, NULL, NULL);

-- Dumping structure for table qlgd.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `time_slots` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paginate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlgd.settings: ~0 rows (approximately)
INSERT INTO `settings` (`id`, `time_slots`, `paginate`, `created_at`, `updated_at`) VALUES
	(1, '11', '4', '2024-01-02 17:51:38', '2024-01-02 18:10:00');

-- Dumping structure for table qlgd.setting_credits
CREATE TABLE IF NOT EXISTS `setting_credits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `quantity_credits` int NOT NULL,
  `subject_weekly_max` int NOT NULL,
  `subject_day_max` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlgd.setting_credits: ~4 rows (approximately)
INSERT INTO `setting_credits` (`id`, `quantity_credits`, `subject_weekly_max`, `subject_day_max`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, NULL, '2024-01-02 18:10:00'),
	(2, 2, 4, 2, NULL, '2024-01-02 18:10:00'),
	(3, 3, 6, 3, NULL, '2024-01-02 18:10:00'),
	(4, 4, 8, 4, NULL, '2024-01-02 18:10:00');

-- Dumping structure for table qlgd.student_subject
CREATE TABLE IF NOT EXISTS `student_subject` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `teacher_subject_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlgd.student_subject: ~0 rows (approximately)
INSERT INTO `student_subject` (`id`, `student_id`, `teacher_subject_id`, `created_at`, `updated_at`) VALUES
	(24, 3, 23, '2024-01-11 16:15:10', '2024-01-11 16:15:10'),
	(25, 3, 24, '2024-01-11 16:15:10', '2024-01-11 16:15:10'),
	(26, 3, 25, '2024-01-11 16:15:10', '2024-01-11 16:15:10'),
	(27, 3, 28, '2024-01-11 16:15:10', '2024-01-11 16:15:10'),
	(28, 3, 29, '2024-01-11 16:15:10', '2024-01-11 16:15:10'),
	(29, 3, 30, '2024-01-11 16:15:10', '2024-01-11 16:15:10'),
	(30, 3, 33, '2024-01-11 16:15:10', '2024-01-11 16:15:10'),
	(31, 3, 34, '2024-01-11 16:15:10', '2024-01-11 16:15:10');

-- Dumping structure for table qlgd.subjects
CREATE TABLE IF NOT EXISTS `subjects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `credits_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avoid_first_lesson` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Tranh tiet cuoi cho 1 so mon the duc, toan, van',
  `block` int NOT NULL DEFAULT '1' COMMENT 'So tiet tối thiểu lien tiep bat buoc, vi du Tin can 2 tiet',
  `require_spacing` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Tránh việc 2 ngày liên tiếp cùng học 1 môn',
  `require_class_room` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Là môn học cần phòng chỉ định',
  `quantity_credits` int NOT NULL COMMENT 'Độ ưu tiên',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlgd.subjects: ~8 rows (approximately)
INSERT INTO `subjects` (`id`, `name`, `status`, `credits_no`, `avoid_first_lesson`, `block`, `require_spacing`, `require_class_room`, `quantity_credits`, `created_at`, `updated_at`) VALUES
	(1, 'Code đại cương', 0, '0I6NE7D', 1, 2, 1, 0, 3, '2023-12-29 18:00:51', '2024-01-02 16:52:19'),
	(2, 'Tin đại cương', 0, '63H1HRC', 1, 1, 1, 0, 3, '2023-12-29 18:11:19', '2023-12-31 09:14:26'),
	(3, 'Giáo dục', 0, 'WB3W2QF', 1, 1, 1, 1, 2, '2023-12-29 18:11:47', '2023-12-29 18:11:47'),
	(4, 'Thể Dục', 0, 'ZAXQ5IG', 0, 2, 1, 1, 3, '2023-12-31 10:15:13', '2023-12-31 10:15:13'),
	(5, 'Văn hóa', 0, 'H87IJH3', 1, 2, 1, 1, 2, '2023-12-31 10:15:33', '2023-12-31 10:15:33'),
	(6, 'Xã hội', 0, 'B5YA355', 1, 2, 1, 1, 3, '2023-12-31 10:33:20', '2023-12-31 10:33:20'),
	(7, 'Môn A', 0, 'JPFZHWY', 1, 2, 1, 1, 1, '2023-12-31 14:20:24', '2023-12-31 14:20:24'),
	(8, 'Môn B', 0, '7YGIRH8', 1, 2, 0, 1, 2, '2024-01-02 09:32:58', '2024-01-02 09:32:58');

-- Dumping structure for table qlgd.subject_labs
CREATE TABLE IF NOT EXISTS `subject_labs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `subject_id` tinyint unsigned NOT NULL,
  `class_room_id` tinyint unsigned DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlgd.subject_labs: ~2 rows (approximately)
INSERT INTO `subject_labs` (`id`, `subject_id`, `class_room_id`, `description`, `created_at`, `updated_at`) VALUES
	(3, 1, 1, NULL, '2024-01-02 15:08:43', '2024-01-02 15:08:43'),
	(4, 2, 2, NULL, '2024-01-02 15:08:55', '2024-01-02 15:08:55');

-- Dumping structure for table qlgd.teacher_subjects
CREATE TABLE IF NOT EXISTS `teacher_subjects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` bigint unsigned NOT NULL,
  `subject_id` bigint unsigned NOT NULL,
  `class` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlgd.teacher_subjects: ~11 rows (approximately)
INSERT INTO `teacher_subjects` (`id`, `teacher_id`, `subject_id`, `class`, `color`, `created_at`, `updated_at`) VALUES
	(23, 2, 1, 'A1', '#b39500', '2024-01-02 12:51:41', '2024-01-02 12:51:49'),
	(24, 2, 2, 'B1', '#9a7810', '2024-01-02 12:51:41', '2024-01-02 12:51:51'),
	(25, 2, 3, 'C1', '#19fa42', '2024-01-02 12:51:41', '2024-01-02 12:51:52'),
	(26, 2, 1, 'D1', '#a05652', '2024-01-02 12:51:45', '2024-01-02 12:51:54'),
	(27, 2, 2, 'E1', '#fb4197', '2024-01-02 12:51:45', '2024-01-02 12:51:55'),
	(28, 4, 4, 'A2', '#215d99', '2024-01-02 12:52:05', '2024-01-02 12:52:17'),
	(29, 4, 5, 'C2', '#c254a3', '2024-01-02 12:52:05', '2024-01-02 12:52:19'),
	(30, 4, 6, 'B2', '#62d0e1', '2024-01-02 12:52:05', '2024-01-02 12:52:25'),
	(33, 5, 7, 'A1', '#b49811', '2024-01-02 12:52:44', '2024-01-02 12:52:47'),
	(34, 5, 8, 'A2', '#93a74e', '2024-01-02 12:52:44', '2024-01-02 12:52:50'),
	(35, 2, 5, '', '#146e39', '2024-01-03 15:37:59', '2024-01-03 15:37:59');

-- Dumping structure for table qlgd.teacher_time_slots
CREATE TABLE IF NOT EXISTS `teacher_time_slots` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` bigint unsigned NOT NULL,
  `time_slot` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlgd.teacher_time_slots: ~2 rows (approximately)
INSERT INTO `teacher_time_slots` (`id`, `teacher_id`, `time_slot`, `created_at`, `updated_at`) VALUES
	(10, 5, 1, '2024-01-06 17:45:37', NULL),
	(11, 5, 2, '2024-01-06 17:45:37', NULL);

-- Dumping structure for table qlgd.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signup_ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signup_confirmation_ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signup_sm_ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table qlgd.users: ~8 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `token`, `remember_token`, `signup_ip_address`, `signup_confirmation_ip_address`, `signup_sm_ip_address`, `admin_ip_address`, `updated_ip_address`, `deleted_ip_address`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'admin', 'admin@user.com', NULL, '$2y$10$dbeqGw0on4q38Zfzl188Y.rAN9o0yj0IlyUQPd24rstRzWnPZHOu6', 1, 'vr7CoCVHK0AJ1Mgx8Iu7S5F7Wb6vQDylXrZiP88PqOef4caSWCm5Uv5qMs5GIUeF', NULL, '38.96.48.69', '246.104.85.156', NULL, NULL, NULL, NULL, '2023-12-25 06:24:35', '2023-12-31 05:25:15', NULL),
	(2, 'teacher', 'teacher@user.com', NULL, '$2y$10$dbeqGw0on4q38Zfzl188Y.rAN9o0yj0IlyUQPd24rstRzWnPZHOu6', 1, 'MvWEQtrtqns0SwOrMceucJawwLEJbJskt5jgipZnSzRK3TYsPSsfmq5VzBUL0ljf', NULL, '34.52.179.223', '233.137.33.85', NULL, NULL, NULL, NULL, '2023-12-25 06:24:35', '2023-12-25 06:24:35', NULL),
	(3, 'student', 'student@user.com', NULL, '$2y$10$kko.w2CAdV.Yc6x9gi4XoOkcA6P9SyielRZ0gIIYkYUhmJxuBEAT2', 1, 'Zns2XNRwbBnH1aX1IjsHEltHzHspu9OGeyV77Vs7QtLcuFSMebTdtTfAWgET39Ja', NULL, '183.40.102.14', '15.211.135.105', NULL, NULL, NULL, NULL, '2023-12-25 06:24:35', '2023-12-25 06:24:35', NULL),
	(4, NULL, 'vudat328@gmail.com', NULL, '$2y$10$DRoR5sheUsigViV0m0KAB.yRagHm4AOU5zSKBd1f9ku9UCI7Au3xG', 1, 'Ap094HZgVX9z1rpJETsPTuq6ka5vJhccaSSSJ65RA3W3jp7qPUBpyaa4U6LjPzbi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-25 11:03:24', '2023-12-25 11:03:24', NULL),
	(5, NULL, 'vudat3328@gmail.com', NULL, '$2y$10$hKHPXV8jRjVzl/c8tGG1fe7vmEJ6aCE6FcIukC9fwR0cZbzde29z.', 1, 'om89cRq5rUIBG6on6j1fWfxYWWburIoMVzOx7xU9LNEIKNmmfLGSxrzV0PdlpCIr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-30 17:27:06', '2023-12-30 17:27:06', NULL),
	(6, NULL, 'vudat1328@gmail.com', NULL, '$2y$10$0TLNIdWWo2LoZl04/WUWB.G5v57FZ1k7iQOYryCz3ftIkSTvmZKJW', 1, 'jYynjm3jbXDPmWcusdxaQvb300p3lBFgBHZSS3pO71iKEIjZiz5qyFUswNwi606w', 'sOR0K1vg2qOe6vqztZVz5ZfWLonDmjtzaQCMExTOdszxf7lS24Tt15yx0d2w', NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-31 05:17:05', '2023-12-31 05:24:07', NULL),
	(7, NULL, 'vudat8@gmail.com', NULL, '$2y$10$6WNDFs7oT.szmWKw0HkFSOcQuIO47mZ7yUcrjjsesWPzE7bqEvPhq', 1, '1Dgg2Xj2GJmfZwwC302ufbhcQB4nJ2FriCaLkpa4UpYB8VLsqEpF2Dgy4u1u2jg1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-31 05:24:48', '2023-12-31 05:24:48', NULL),
	(8, NULL, 'ducxeko11245@gmail.com', NULL, '$2y$10$Kozifzpd74QAR2sXKrKqOuGBhOpw0pO/txmofD8dtGYFOQoNPiQKu', 1, 'JlOcyrXFie0LZPKzFenZQzYhlBD4qunGk7jnU1EX5Qa6K1i1751T826o6QL49hkW', 'HrEMfYLkZRhLg0y0ZXksPTrMbSSecOSNbH26SGprSLbjSTPTo0a7Ni4nbGog', NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-31 13:57:04', '2024-01-03 15:36:23', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
