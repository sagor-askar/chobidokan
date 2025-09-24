-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 24, 2025 at 08:50 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chobidokan`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '1' COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `logo`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Logo', 'uploads/categories/1755617202.jpg', 'test', 1, '2025-08-19 15:26:42', '2025-08-19 15:26:42'),
(2, 'Web & App Design', 'uploads/categories/1755625723.png', 'test', 1, '2025-08-19 17:48:43', '2025-08-19 17:48:43');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `info_setups`
--

CREATE TABLE `info_setups` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `licencings`
--

CREATE TABLE `licencings` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint UNSIGNED NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2022_11_10_000001_create_media_table', 1),
(4, '2022_11_10_000002_create_permissions_table', 1),
(5, '2022_11_10_000003_create_roles_table', 1),
(6, '2022_11_10_000004_create_users_table', 1),
(7, '2022_11_10_000019_create_permission_role_pivot_table', 1),
(8, '2022_11_10_000020_create_role_user_pivot_table', 1),
(9, '2025_03_30_094417_create_faqs_table', 1),
(10, '2025_04_04_043951_create_testimonials_table', 1),
(11, '2025_05_04_093515_create_categories_table', 1),
(12, '2025_05_04_104127_create_subscriptions_table', 1),
(13, '2025_05_05_154209_create_settings_table', 1),
(14, '2025_05_05_161626_create_privacy_policies_table', 1),
(15, '2025_05_05_163219_create_terms_table', 1),
(16, '2025_05_06_064841_create_licencings_table', 1),
(17, '2025_05_06_083652_create_search_tips_table', 1),
(18, '2025_05_12_061620_create_technical_infos_table', 1),
(19, '2025_05_12_063119_create_research_imgs_table', 1),
(20, '2025_05_14_065311_create_projects_table', 1),
(21, '2025_05_14_165350_create_orders_table', 1),
(22, '2025_05_15_203625_create_info_setups_table', 1),
(23, '2025_08_20_021101_add_expire_date_to_projects_table', 2),
(26, '2025_08_22_231135_create_project_submits_table', 3),
(27, '2025_08_23_030900_create_uploads_table', 3),
(28, '2025_09_05_180219_add_columns_to_subscriptions_table', 4),
(30, '2025_09_22_010012_add_status_to_uploads_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `subscription_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `amount` int NOT NULL DEFAULT '0',
  `card_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_txn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT '0=>Inproggress, 1=>Approved,2=Rejected',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `project_id`, `subscription_id`, `user_id`, `amount`, `card_type`, `bank_txn`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, 100, NULL, NULL, 0, '2025-08-19 17:29:25', '2025-08-19 17:29:25'),
(2, 2, 1, 3, 100, NULL, NULL, 0, '2025-08-19 20:19:08', '2025-08-19 20:19:08'),
(3, 3, 1, 3, 100, NULL, NULL, 0, '2025-09-05 12:42:44', '2025-09-05 12:42:44'),
(9, 66, 1, 3, 100, 'bKash-bKash', '1030000972407', 0, '2025-09-15 19:19:16', '2025-09-15 19:19:16');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user_management_access', NULL, NULL, NULL),
(2, 'permission_create', NULL, NULL, NULL),
(3, 'permission_edit', NULL, NULL, NULL),
(4, 'permission_show', NULL, NULL, NULL),
(5, 'permission_delete', NULL, NULL, NULL),
(6, 'permission_access', NULL, NULL, NULL),
(7, 'role_create', NULL, NULL, NULL),
(8, 'role_edit', NULL, NULL, NULL),
(9, 'role_show', NULL, NULL, NULL),
(10, 'role_delete', NULL, NULL, NULL),
(11, 'role_access', NULL, NULL, NULL),
(12, 'user_create', NULL, NULL, NULL),
(13, 'user_edit', NULL, NULL, NULL),
(14, 'user_show', NULL, NULL, NULL),
(15, 'user_delete', NULL, NULL, NULL),
(16, 'user_access', NULL, NULL, NULL),
(17, 'profile_password_edit', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `role_id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(2, 17);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policies`
--

CREATE TABLE `privacy_policies` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `project_description` longtext COLLATE utf8mb4_unicode_ci,
  `logo_description` longtext COLLATE utf8mb4_unicode_ci,
  `project_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1=>Active, 0=>Inactive,2=Completed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `category_id`, `project_description`, `logo_description`, `project_file`, `publish_date`, `expire_date`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Demo Project', 1, 'Looking for a graphic designer to design a brochure-like introduction of our real estate business', '<strong>AL QASR PROPERTIES LTD.</strong> is a new real estate investment business that is just starting. We are looking for the best graphic designer to present the company’s strategy to important stakeholders. This project is <strong>URGENT</strong>. See attachment.', 'uploads/project/17556245658294.jpg', '2025-08-19', '2025-09-26', 3, 1, '2025-08-19 17:29:25', '2025-09-21 19:14:15'),
(2, 'test', 2, 'test', 'test', 'uploads/project/17556347482431.png', '2025-08-20', '2025-08-27', 3, 1, '2025-08-19 20:19:08', '2025-08-19 20:19:08'),
(3, 'Roary Carrillo', 1, 'Tempore aspernatur', 'Quia cupidatat porro', 'uploads/project/17570761647002.pdf', '2025-09-05', '2025-09-12', 3, 1, '2025-09-05 12:42:44', '2025-09-21 19:56:29'),
(66, 'Leandra Castaneda', 2, 'Labore officia cupid', 'Similique cupidatat', 'uploads/project/17579639511052.pdf', '2025-09-16', '2025-09-23', 3, 1, '2025-09-15 19:19:11', '2025-09-15 19:19:11');

-- --------------------------------------------------------

--
-- Table structure for table `project_submits`
--

CREATE TABLE `project_submits` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT '1',
  `stock` tinyint(1) NOT NULL DEFAULT '0',
  `submit_date` date DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_submits`
--

INSERT INTO `project_submits` (`id`, `project_id`, `title`, `visibility`, `stock`, `submit_date`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'test logo project file', 1, 1, '2025-08-23', 2, '2025-08-22 21:55:48', '2025-08-22 21:55:48'),
(3, 1, 'fgfgfdg', 1, 1, '2025-09-05', 4, '2025-09-05 13:41:30', '2025-09-05 13:41:30'),
(4, 1, 'vcxv', 1, 1, '2025-09-05', 4, '2025-09-05 14:01:00', '2025-09-05 14:01:00'),
(5, 3, 'fdsfdsf', 1, 1, '2025-09-05', 4, '2025-09-05 14:02:43', '2025-09-05 14:02:43'),
(6, 1, 'latest submited', 1, 1, '2025-09-21', 2, '2025-09-21 17:47:44', '2025-09-21 17:47:44'),
(7, 1, 'fdsfdsfsdf', 1, 1, '2025-09-21', 2, '2025-09-21 17:48:40', '2025-09-21 17:48:40'),
(8, 1, 'gh', 1, 1, '2025-09-22', 2, '2025-09-21 18:32:28', '2025-09-21 18:32:28');

-- --------------------------------------------------------

--
-- Table structure for table `research_imgs`
--

CREATE TABLE `research_imgs` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', NULL, NULL, NULL),
(2, 'User', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `search_tips`
--

CREATE TABLE `search_tips` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `points` json DEFAULT NULL,
  `price` int NOT NULL,
  `designer` int DEFAULT NULL,
  `days` int DEFAULT NULL,
  `design` int DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `name`, `points`, `price`, `designer`, `days`, `design`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Weekly Package', '[\"Premium Design\", \"Quality Desgin\"]', 100, 5, 7, 15, NULL, NULL, 1, '2025-08-19 15:31:19', '2025-09-05 12:21:08');

-- --------------------------------------------------------

--
-- Table structure for table `technical_infos`
--

CREATE TABLE `technical_infos` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint UNSIGNED NOT NULL,
  `speech` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` bigint UNSIGNED NOT NULL,
  `project_submit_id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT '0=>Pending, 1=>Approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `project_submit_id`, `project_id`, `file_path`, `file_name`, `file_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'uploads/project/submit-file/1755899748_68a8e764cbfd0.png', '1755899748_68a8e764cbfd0.png', 'image/png', 0, '2025-08-22 21:55:48', '2025-08-22 21:55:48'),
(2, 1, 1, 'uploads/project/submit-file/1755899748_68a8e764d32b6.jpg', '1755899748_68a8e764d32b6.jpg', 'image/jpeg', 0, '2025-08-22 21:55:48', '2025-08-22 21:55:48'),
(4, 3, 1, 'uploads/project/submit-file/1757079690_68bae88a3dadb.png', '1757079690_68bae88a3dadb.png', 'image/png', 0, '2025-09-05 13:41:30', '2025-09-05 13:41:30'),
(5, 3, 1, 'uploads/project/submit-file/1757079690_68bae88a8b104.jpg', '1757079690_68bae88a8b104.jpg', 'image/jpeg', 0, '2025-09-05 13:41:30', '2025-09-05 13:41:30'),
(6, 4, 1, 'uploads/project/submit-file/1757080860_68baed1c83d90.png', '1757080860_68baed1c83d90.png', 'image/png', 0, '2025-09-05 14:01:00', '2025-09-05 14:01:00'),
(7, 5, 3, 'uploads/project/submit-file/1757080963_68baed8333dcd.png', '1757080963_68baed8333dcd.png', 'image/png', 1, '2025-09-05 14:02:43', '2025-09-21 19:56:29'),
(8, 5, 3, 'uploads/project/submit-file/1757080963_68baed8386a79.jpg', '1757080963_68baed8386a79.jpg', 'image/jpeg', 0, '2025-09-05 14:02:43', '2025-09-05 14:02:43'),
(9, 6, 1, 'uploads/project/submit-file/1758476864_68d03a40aefc4.png', '1758476864_68d03a40aefc4.png', 'image/png', 0, '2025-09-21 17:47:45', '2025-09-21 17:47:45'),
(10, 7, 1, 'uploads/project/submit-file/1758476920_68d03a78353cd.png', '1758476920_68d03a78353cd.png', 'image/png', 0, '2025-09-21 17:48:40', '2025-09-21 17:48:40'),
(11, 7, 1, 'uploads/project/submit-file/1758476920_68d03a783b5bc.jpg', '1758476920_68d03a783b5bc.jpg', 'image/jpeg', 0, '2025-09-21 17:48:40', '2025-09-21 17:48:40'),
(12, 7, 1, 'uploads/project/submit-file/1758476920_68d03a783f5e8.jpeg', '1758476920_68d03a783f5e8.jpeg', 'image/jpeg', 0, '2025-09-21 17:48:40', '2025-09-21 17:48:40'),
(13, 8, 1, 'uploads/project/submit-file/1758479548_68d044bc34e45.jpg', '1758479548_68d044bc34e45.jpg', 'image/jpeg', 1, '2025-09-21 18:32:28', '2025-09-21 19:14:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verification_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` int NOT NULL DEFAULT '0' COMMENT '0=>Unverified, 1=>Verified',
  `role_id` int NOT NULL,
  `is_banned` int NOT NULL DEFAULT '0' COMMENT '0=>Unbanned, 1=>Banned',
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` longtext COLLATE utf8mb4_unicode_ci,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_holder_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `routing_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_banking_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `verification_code`, `is_verified`, `role_id`, `is_banned`, `email_verified_at`, `password`, `remember_token`, `address`, `image`, `bio`, `bank_name`, `branch_name`, `account_holder_name`, `account_number`, `routing_no`, `account_type`, `mobile_banking_no`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, NULL, 0, 1, 0, NULL, '$2y$10$qEjQZHdTBu9EGW8wilQiFuZUyTS888bUSMnCnFagFr49uu5uBOwcC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Md. Shamim Al-Deen', 'shamimaldeen@gmail.com', '01738298666', NULL, 0, 2, 0, NULL, '$2y$10$DfJ8PFPV70BYWe/HDiqLbe4I.4azC4VrnaXavBydPjHFM9QDkoAqG', NULL, '15-Dhanmondhi,dhaka-1200,Bangladesh', NULL, NULL, 'fdgf', 'gfdgdfg', 'gfhgfhgfh', NULL, NULL, NULL, NULL, '2025-08-18 19:35:11', '2025-09-18 19:58:10', NULL),
(3, 'Al-Deen', 'aldeen298666@gmail.com', '01738298667', NULL, 0, 3, 0, NULL, '$2y$10$rZFWnfgeFFIWfyd0X4SI1eiPnbKUIyHZpn4EZBiEag0oVh2BMt3qy', NULL, '15-Dhanmondhi,dhaka-1200,Bangladesh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-18 19:37:44', '2025-08-18 19:37:44', NULL),
(4, 'designer1', 'designer1@gmail.com', '01738455455', NULL, 0, 2, 0, NULL, '$2y$10$e192oASPePQ.3kHXAFvVG.mqC52vyQc5To1la123I2uyLXFkIWQeu', NULL, '15-Dhanmondhi,dhaka-1200,Bangladesh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-05 13:38:24', '2025-09-05 13:38:24', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info_setups`
--
ALTER TABLE `info_setups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `licencings`
--
ALTER TABLE `licencings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_order_column_index` (`order_column`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD KEY `role_id_fk_7600178` (`role_id`),
  ADD KEY `permission_id_fk_7600178` (`permission_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_submits`
--
ALTER TABLE `project_submits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_submits_project_id_foreign` (`project_id`);

--
-- Indexes for table `research_imgs`
--
ALTER TABLE `research_imgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD KEY `user_id_fk_7600187` (`user_id`),
  ADD KEY `role_id_fk_7600187` (`role_id`);

--
-- Indexes for table `search_tips`
--
ALTER TABLE `search_tips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technical_infos`
--
ALTER TABLE `technical_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uploads_project_id_foreign` (`project_id`),
  ADD KEY `uploads_project_submit_id_foreign` (`project_submit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `info_setups`
--
ALTER TABLE `info_setups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `licencings`
--
ALTER TABLE `licencings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `project_submits`
--
ALTER TABLE `project_submits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `research_imgs`
--
ALTER TABLE `research_imgs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `search_tips`
--
ALTER TABLE `search_tips`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `technical_infos`
--
ALTER TABLE `technical_infos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_id_fk_7600178` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_id_fk_7600178` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_submits`
--
ALTER TABLE `project_submits`
  ADD CONSTRAINT `project_submits_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_id_fk_7600187` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id_fk_7600187` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `uploads`
--
ALTER TABLE `uploads`
  ADD CONSTRAINT `uploads_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `uploads_project_submit_id_foreign` FOREIGN KEY (`project_submit_id`) REFERENCES `project_submits` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
