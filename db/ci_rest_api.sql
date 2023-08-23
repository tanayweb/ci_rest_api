-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 23, 2023 at 08:46 PM
-- Server version: 8.0.27
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_rest_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
(2, 'gagasg', 'test@mail.com', 127, NULL, NULL, NULL),
(3, 'gagasg', 'test@mail.com', 127, NULL, NULL, NULL),
(4, 'gagasg', 'test@mail.com', 127, '2023-08-19 04:44:15', '2023-08-19 04:44:15', NULL),
(5, 'gagasg', 'test@mail.com', 127, '2023-08-19 04:45:15', '2023-08-19 04:45:15', NULL),
(6, 'cat2', 'test@mail.com', 127, NULL, NULL, NULL),
(7, 'cat2', 'test@mail.com', 127, NULL, NULL, NULL),
(8, 'cat2', 'test@mail.com', 127, NULL, NULL, NULL),
(9, 'cat2rrrr', 'abcd', 127, NULL, NULL, 6),
(10, 'gagasggggg', 'test@mail.com', 127, NULL, NULL, 6);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `description` text,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `category_id`, `title`, `description`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(4, 0, 'gagasg', 'test@mail.com', 127, 1, '2023-08-19 04:58:58', '2023-08-19 04:58:58'),
(5, 0, 'gagasg', 'test@mail.com', 127, 1, '2023-08-19 05:01:37', '2023-08-19 05:01:37'),
(6, 0, 'gagasg', 'test@mail.com', 127, 1, '2023-08-21 06:14:48', '2023-08-21 06:14:48'),
(7, NULL, 'gagasg', 'test@mail.com', 127, 1, '2023-08-21 06:15:16', '2023-08-21 06:15:16'),
(8, 2, 'gagasg', 'test@mail.com', 127, 1, '2023-08-21 06:17:58', '2023-08-21 06:17:58'),
(9, 1, 'gagasg', 'test@mail.com', 127, 6, '2023-08-23 13:58:13', '2023-08-23 13:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(3, '2023-08-16-062841', 'App\\Database\\Migrations\\CreateUserTable', 'default', 'App', 1692174138, 1),
(4, '2023-08-19-101030', 'App\\Database\\Migrations\\CreateRolesTable', 'default', 'App', 1692440004, 2),
(5, '2023-08-19-102812', 'App\\Database\\Migrations\\CreateCategoriesTable', 'default', 'App', 1692441218, 3),
(7, '2023-08-19-103516', 'App\\Database\\Migrations\\CreateItemTable', 'default', 'App', 1692441702, 4),
(8, '2023-08-21-122658', 'App\\Database\\Migrations\\PermissionsTable', 'default', 'App', 1692621229, 5),
(9, '2023-08-21-124304', 'App\\Database\\Migrations\\RolePermissionTable', 'default', 'App', 1692621871, 6);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'user.create', NULL, NULL),
(3, 'user.view', NULL, NULL),
(4, 'user.delete', NULL, NULL),
(5, 'user.edit', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(5, 'SuperAdmin', 'Super Admin', 1, NULL, NULL),
(6, 'datg', 'test@mail.com', 127, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

DROP TABLE IF EXISTS `role_permissions`;
CREATE TABLE IF NOT EXISTS `role_permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 2, 2, NULL, NULL),
(3, 5, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `phone`, `address`, `status`, `created_at`, `updated_at`, `role_id`) VALUES
(3, 'User 3', 'test45@mail.com', '$2y$10$JFTLMGpPTNZMnI98Y6WaXuwRX10guk0pY9Pwbx5ACssZcsulZ/x0u', NULL, '304004054652', NULL, 1, NULL, NULL, NULL),
(4, 'User 3', 'test415@mail.com', '$2y$10$70safyB1vtGl0uNnzDuVyO95O9gZh9jDwJNoL6D/5WAjqsQDRbiEW', NULL, '304004054652', NULL, 1, NULL, NULL, NULL),
(5, 'User 3', 'test4145@mail.com', '$2y$10$VZibakG4T4ZzhC/qi/dvaOFZ50/qFnRpzgaald5EsLXw93eIiNweG', NULL, '304004054652', NULL, 1, NULL, NULL, 2),
(6, 'admin', 'admin@gmail.com', '$2a$12$9Yj5LX12C5DwmXHYRvkiwOcvZe3.Z9NBtBvC4AKQpFSJShrsJpisi', NULL, NULL, NULL, 1, NULL, NULL, 5),
(8, 'User 355', 'testf41ffffffffffff5@gmail.com', '$2y$10$0lNZKuhPphDmaOyOfnv5jerE5KQry94XRVhIUaJPeS15ZdtrzYlPe', NULL, '304004054652', NULL, 1, NULL, NULL, 2),
(9, 'New User', 'tanays@gmail.com', '$2y$10$MbfHden5zIqUwkGX/UVdp.ayEw.Coboxzx6ySt8JdRCkLO8oeaTqq', 'Male', '01737697395', 'Mirpur', 1, NULL, NULL, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
