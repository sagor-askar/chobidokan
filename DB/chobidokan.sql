-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2025 at 12:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `designer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comment` text NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'What is Chobi Dokan?', 'Chobi Dokan is an online platform that connects photographers, designers, and creative professionals with clients. You can explore portfolios, hire talent, and manage projects all in one place.', '2025-09-21 07:44:44', '2025-09-21 07:44:44'),
(2, 'How do I hire a photographer or designer?', 'Simply use the search bar or category filters to find a creative professional. View their profile, check their portfolio, and click on the Hire/Contact button to start a project.', '2025-09-21 07:45:01', '2025-09-21 07:45:01'),
(3, 'How do payments work?', 'Payments are made securely through our platform. Funds are only released to the creator after the project is delivered and approved by the client.', '2025-09-21 07:45:18', '2025-09-21 07:45:18'),
(4, 'Can I update my profile after registration?', 'Yes. Once logged in, go to Manage Profile in your dashboard to update your name, email, phone, portfolio, and other details anytime.', '2025-09-21 07:45:35', '2025-09-21 07:45:35'),
(5, 'What if I have an issue with a project?', 'If there’s a problem, first try resolving it directly with the creator or client. If needed, contact Chobi Dokan Support, and our team will help mediate the issue.', '2025-09-21 07:45:50', '2025-09-21 07:45:50');

-- --------------------------------------------------------

--
-- Table structure for table `info_setups`
--

CREATE TABLE `info_setups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `info_setups`
--

INSERT INTO `info_setups` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Welcome to Chobi Dokan', '<p><strong>Welcome to Chobi Dokan</strong> – your one-stop destination for creative photography and design services.<br>We connect talented photographers, designers, and artists with clients who are looking for quality, creativity, and professionalism.</p><p>At <strong>Chobi Dokan</strong>, we believe every picture tells a story, and every design leaves an impression. Our platform makes it simple for you to explore portfolios, manage your profile, and collaborate with clients or service providers.<br><br>✨ What We Offer</p><p>&nbsp; &nbsp; &nbsp; &nbsp; - Professional Photography Services (Events, Products, Portraits, Lifestyle)</p><p>&nbsp; &nbsp; &nbsp; &nbsp; - Creative Graphic &amp; Digital Design</p><p>&nbsp; &nbsp; &nbsp; &nbsp; - Portfolio Management for Artists &amp; Designers</p><p>&nbsp; &nbsp; &nbsp; &nbsp; - Easy Client–Designer Collaboration</p><p>&nbsp; &nbsp; &nbsp; &nbsp; - Secure &amp; Hassle-Free Transactions<br>&nbsp;</p><h4>💡 Why Choose Chobi Dokan?</h4><p>&nbsp; &nbsp; &nbsp; &nbsp; - A growing community of trusted creatives.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; - Transparent and user-friendly platform.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; - Focus on quality, reliability, and client satisfaction.</p><p>&nbsp; &nbsp; &nbsp; &nbsp; - Designed to help both professionals and clients succeed.<br>&nbsp;</p><h4>🚀 Our Mission</h4><p>To empower creative professionals by providing them a platform to showcase their talent, while helping businesses and individuals find the right experts to bring their ideas to life.</p>', '2025-09-21 06:10:08', '2025-09-21 06:14:22');

-- --------------------------------------------------------

--
-- Table structure for table `licencings`
--

CREATE TABLE `licencings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `licencings`
--

INSERT INTO `licencings` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, '📜 Licensing – Chobi Dokan', '<p>At <strong>Chobi Dokan</strong>, we value creativity and respect intellectual property. To ensure clarity and trust between clients and designers/photographers, all works on our platform follow these licensing terms:<br>&nbsp;</p><h4>1. Ownership of Work</h4><p>&nbsp; &nbsp; &nbsp;The creator (photographer/designer) retains original ownership of their work unless otherwise agreed upon in writing.</p><p>&nbsp; &nbsp; &nbsp; Clients receive the <strong>usage rights</strong> to the work once the project is completed and payment is confirmed.</p><h4>2. Standard License</h4><p>&nbsp; &nbsp; &nbsp; Clients may use the delivered work for <strong>personal or business purposes</strong>, including websites, social media, advertisements, and print materials.</p><p>&nbsp; &nbsp; &nbsp; Redistribution, resale, or sublicensing of the work is <strong>not allowed</strong> without explicit permission from the creator.</p><h4>3. Extended / Custom License</h4><p>&nbsp; &nbsp; &nbsp; If a client requires broader rights (such as resale, mass distribution, or exclusive ownership), they must request a <strong>custom license agreement</strong> with the creator.</p><p>&nbsp; &nbsp; &nbsp; Extended licensing terms and fees are set by the creator and agreed upon before project delivery.</p><h4>4. Prohibited Uses</h4><p>&nbsp; &nbsp; &nbsp;Works may not be used in illegal, defamatory, or harmful content.</p><p>&nbsp; &nbsp; &nbsp;Unauthorized duplication, resale, or redistribution of creative works violates our policy and may result in account suspension or legal action.</p><h4>5. Disputes</h4><p>&nbsp; &nbsp; &nbsp;In case of licensing disputes, <strong>Chobi Dokan</strong> will review the agreement between the client and creator and take necessary steps to resolve the issue fairly.</p>', '2025-09-21 06:22:48', '2025-09-21 06:22:48');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `collection_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `disk` varchar(255) NOT NULL,
  `conversions_disk` varchar(255) DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`generated_conversions`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
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
(30, '2025_09_22_010012_add_status_to_uploads_table', 5),
(31, '2025_09_26_015757_create_order_details_table', 6),
(32, '2025_09_27_072333_create_comments_table', 7),
(35, '2025_10_13_021759_create_payments_table', 8),
(36, '2025_10_03_213147_create_products_table', 9),
(37, '2025_11_24_114618_add_tag_to_products_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `card_type` varchar(255) DEFAULT NULL,
  `bank_txn` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=>Inproggress, 1=>Approved,2=Rejected',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `project_id`, `subscription_id`, `user_id`, `amount`, `card_type`, `bank_txn`, `status`, `created_at`, `updated_at`) VALUES
(10, 67, 1, 3, 100, 'nagad', '1004203119626', 1, '2025-10-10 16:13:26', '2025-10-16 15:19:03');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `project_id`, `order_id`, `user_id`, `file_path`, `file_name`, `file_type`, `created_at`, `updated_at`) VALUES
(5, 67, 10, 2, 'uploads/project/approved-file/126-500x800_imresizer_68e95ce89ad92.jpg', '126-500x800_imresizer_68e95ce89ad92.jpg', 'image/jpeg', '2025-10-10 19:22:17', '2025-10-10 19:22:17');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'user = Designer',
  `amount` int(11) NOT NULL DEFAULT 0,
  `card_type` varchar(255) DEFAULT NULL,
  `bank_txn` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `project_id`, `product_id`, `user_id`, `amount`, `card_type`, `bank_txn`, `created_at`, `updated_at`) VALUES
(2, 10, 67, NULL, 2, 80, 'DBBL-MobileBanking', '1074473429886', '2025-10-16 15:19:03', '2025-10-16 15:19:03');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
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
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policies`
--

CREATE TABLE `privacy_policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privacy_policies`
--

INSERT INTO `privacy_policies` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, '🔒 Privacy Policy – Chobi Dokan', '<p>Your privacy is important to us. This Privacy Policy explains how <strong>Chobi Dokan</strong> collects, uses, and protects your personal information when you use our platform.</p><p>1. Information We Collect</p><ul><li>We may collect the following types of information:</li><li><strong>Personal Information</strong>: Name, email, phone number, address, profile details.</li><li><strong>Account Information</strong>: Login credentials, preferences, and settings.</li><li><strong>Transaction Data</strong>: Payment details, billing history, and project records.</li><li><strong>Usage Data</strong>: Device information, IP address, browser type, and platform activity.</li></ul><p>2. How We Use Your Information</p><ul><li>Your data is used to:</li><li>Provide and improve our services.</li><li>Process payments and manage transactions.</li><li>Communicate with you regarding projects, updates, or support.</li><li>Ensure platform security and prevent fraudulent activity.</li><li>Personalize your experience on <strong>Chobi Dokan</strong>.</li></ul><p>3. Sharing of Information</p><ul><li>We do not sell or rent your personal information.<br>We may share limited data with:</li><li><strong>Service Providers</strong> (e.g., payment gateways, hosting services) for operational purposes.</li><li><strong>Legal Authorities</strong>, if required by law or to protect rights, safety, or property.</li></ul><p>4. Data Security</p><ul><li>We use industry-standard measures (encryption, firewalls, secure servers) to protect your data.</li><li>However, no method of online transmission is 100% secure, and we cannot guarantee absolute security.</li></ul><p>5. Cookies &amp; Tracking</p><ul><li><strong>Chobi Dokan</strong> uses cookies to enhance your experience (e.g., remembering login, saving preferences).</li><li>You can disable cookies in your browser settings, but some features may not function properly.</li></ul><p>6. Your Rights</p><ul><li>You have the right to:</li><li>Access, update, or delete your personal data.</li><li>Request a copy of the information we hold about you.</li><li>Withdraw consent for certain data uses (e.g., marketing emails).</li></ul><p>7. Retention of Data</p><ul><li>We retain personal information only as long as necessary for legal, accounting, or business purposes.</li></ul><p>8. Third-Party Links</p><ul><li>Our platform may contain links to external sites. We are not responsible for their privacy practices.</li></ul><p>9. Updates to Policy</p><ul><li>We may update this Privacy Policy from time to time. Changes will be posted here, and continued use of our platform means you accept the updated terms.</li></ul><p>10. Contact Us</p><p>&nbsp; &nbsp; &nbsp;If you have questions about this Privacy Policy, contact us at:<br>&nbsp; &nbsp; &nbsp;📧 <strong>support@chobidokan.com</strong></p>', '2025-09-21 07:42:12', '2025-09-21 07:42:12');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1 COMMENT '1=>Image, 2=>Video',
  `tags` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `title`, `category_id`, `price`, `type`, `tags`, `file_path`, `file_name`, `file_type`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Natural Image 1', 2, 500.00, 1, NULL, 'uploads/products/1760648855_68f15e971f32c.jpg', '1760648855_68f15e971f32c.jpg', 'image/jpeg', NULL, 1, '2025-10-16 21:07:35', '2025-10-16 21:07:35'),
(4, 2, 'Natural Image 2', 2, 600.00, 1, '[\"natural\",\"natural image\",\"beautiful image\"]', 'uploads/products/1763964330_6923f5aa99e65.png', '1763964330_6923f5aa99e65.png', 'image/png', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', 1, '2025-11-24 06:05:30', '2025-11-24 07:00:19'),
(6, 2, 'Natural Image 3', 2, 800.00, 1, '[\"natural\",\"beautiful\"]', 'uploads/products/natural2-1763978272.png', 'natural2-1763978272.png', 'image/png', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', 1, '2025-11-24 09:57:52', '2025-11-24 09:57:52'),
(7, 2, 'Technology Video', 2, 1000.00, 2, '[\"Technology\",\"Videos\",\"Technology Video\"]', 'uploads/products/293917_small-1763979925.mp4', '293917_small-1763979925.mp4', 'video/mp4', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>', 1, '2025-11-24 10:25:25', '2025-11-24 10:25:25');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `project_description` longtext DEFAULT NULL,
  `logo_description` longtext DEFAULT NULL,
  `project_file` varchar(255) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive,2=Completed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `category_id`, `project_description`, `logo_description`, `project_file`, `publish_date`, `expire_date`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(67, 'Test Project', 2, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'uploads/project/17601127926327.pdf', '2025-10-10', '2025-10-17', 3, 2, '2025-10-10 16:13:12', '2025-10-10 19:24:56');

-- --------------------------------------------------------

--
-- Table structure for table `project_submits`
--

CREATE TABLE `project_submits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT 1,
  `stock` tinyint(1) NOT NULL DEFAULT 0,
  `submit_date` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_submits`
--

INSERT INTO `project_submits` (`id`, `project_id`, `title`, `visibility`, `stock`, `submit_date`, `user_id`, `created_at`, `updated_at`) VALUES
(9, 67, 'Test Project', 1, 1, '2025-10-11', 2, '2025-10-10 19:20:08', '2025-10-10 19:20:08'),
(10, 67, 'Test Project', 1, 1, '2025-10-11', 4, '2025-10-10 20:10:52', '2025-10-10 20:10:52');

-- --------------------------------------------------------

--
-- Table structure for table `research_imgs`
--

CREATE TABLE `research_imgs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
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
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `search_tips`
--

INSERT INTO `search_tips` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, '🔍 Search Tips – Chobi Dokan', '<p>Finding the right creative work or service is simple with our search tools. Here are some tips to help you get the best results:</p><p>1. Use Specific Keywords</p><ul><li>Instead of searching <strong>“photo”</strong>, try <strong>“wedding photography”</strong> or <strong>“product shoot”</strong>.</li><li>For design, search <strong>“logo design”</strong> or <strong>“social media banner”</strong>.</li></ul><p>2. Filter Your Results</p><ul><li>Use filters like <strong>Category, Price, Ratings, or Location</strong> to narrow down your search.</li><li>Sorting by <strong>Newest</strong> or <strong>Most Popular</strong> helps you explore different options.</li></ul><p>3. Check Profiles &amp; Portfolios</p><ul><li>Click on a creator’s profile to view their past work.</li><li>Read reviews to understand their style and reliability.</li></ul><p>4. Try Different Terms</p><ul><li>If you don’t find what you’re looking for, try synonyms or related terms.<br>Example: <i>“branding”</i> instead of <i>“logo”</i>.</li></ul><p>5. Save &amp; Compare</p><ul><li>Use the <strong>Save to Favorites</strong> feature for projects or creators you like.</li><li>Compare multiple options before making a decision.</li></ul><p>6. Contact Creators Directly</p><ul><li>If you’re unsure, message the creator for clarification before booking.</li><li>Discuss project details, pricing, and deadlines to avoid misunderstandings.</li></ul><p>✅ With these tips, you’ll find the right designer, photographer, or creative service on <strong>Chobi Dokan</strong> quickly and easily.</p>', '2025-09-21 07:43:59', '2025-09-21 07:43:59');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `site_title` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `site_title`, `email`, `phone`, `address`, `facebook`, `twitter`, `instagram`, `linkedin`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Chobi Dokan', 'Chobi Dokan', 'info@chobidokan.com', '01712345678', 'Dhaka, Bangladesh', NULL, NULL, NULL, NULL, 'uploads/settings/17583900896224.png', '2025-09-20 17:41:29', '2025-09-20 17:41:31');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `points` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`points`)),
  `price` int(11) NOT NULL,
  `designer` int(11) DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `design` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1=>Active, 0=>Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `name`, `points`, `price`, `designer`, `days`, `design`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Weekly Package', '[\"Premium Design\", \"Quality Desgin\"]', 100, 2, 7, 6, NULL, NULL, 1, '2025-08-19 15:31:19', '2025-10-10 19:07:34');

-- --------------------------------------------------------

--
-- Table structure for table `technical_infos`
--

CREATE TABLE `technical_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, '📑 Terms of Use – Chobi Dokan', '<p>Welcome to <strong>Chobi Dokan</strong>. By using our website, services, or platform, you agree to the following Terms of Use. Please read them carefully before proceeding.</p><p>&nbsp;</p><p>1. Acceptance of Terms</p><p>&nbsp; &nbsp; By accessing or using <strong>Chobi Dokan</strong>, you confirm that you have read, understood, and agree to be bound by these Terms, as well as our <strong>Privacy Policy</strong> and &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong>Licensing Policy</strong>.</p><p>2. Eligibility</p><p>&nbsp; &nbsp; You must be at least <strong>18 years old</strong> or have parental/guardian consent to use our platform.</p><p>&nbsp; &nbsp; You are responsible for ensuring that your use of our services complies with all applicable laws and regulations.</p><p>3. User Accounts</p><p>&nbsp; &nbsp; You are responsible for maintaining the confidentiality of your account credentials.</p><p>&nbsp; &nbsp; All activities that occur under your account are your responsibility.</p><p>&nbsp; &nbsp; You must provide accurate, current, and complete information when registering.</p><p>4. Use of Services</p><p><strong>&nbsp; &nbsp; Clients</strong> may hire creatives (photographers/designers) for personal or business projects.</p><p><strong>&nbsp; &nbsp; Creators</strong> may showcase and sell their work through the platform.</p><p>&nbsp; &nbsp; You agree not to misuse the platform (e.g., fraud, spamming, hacking, unauthorized resale).</p><p>5. Payments</p><p>&nbsp; &nbsp; Payments must be made through approved methods on the platform.</p><p>&nbsp; &nbsp; Chobi Dokan may charge service fees for transactions, which will be clearly communicated.</p><p>&nbsp; &nbsp; Refunds and disputes are handled according to our <strong>Refund Policy</strong> (if applicable).</p><p>6. Intellectual Property</p><p>&nbsp; &nbsp; All works remain the property of their respective creators unless otherwise agreed.</p><p>&nbsp; &nbsp; Unauthorized copying, resale, or distribution of content is strictly prohibited.</p><p>&nbsp; &nbsp; Users must respect copyright and licensing terms as outlined in our <strong>Licensing Policy</strong>.</p><p>7. Termination</p><p>&nbsp; &nbsp; Chobi Dokan may suspend or terminate accounts for violations of these Terms.</p><p>&nbsp; &nbsp; Users may also request account deletion at any time.</p><p>8. Limitation of Liability</p><p>&nbsp; &nbsp; Chobi Dokan provides a platform for clients and creators but is <strong>not responsible</strong> for the outcome of individual projects.</p><p>&nbsp; &nbsp; We are not liable for damages, losses, or disputes arising from the use of our services.</p><p>9. Changes to Terms&nbsp;</p><p>&nbsp; &nbsp; We may update these Terms from time to time. Users will be notified of significant changes, and continued use of the platform means you accept the updated Terms.</p><p>10. Contact</p><p>&nbsp; &nbsp; For questions about these Terms, contact us at:<br>&nbsp; &nbsp; 📧 <strong>support@chobidokan.com</strong></p>', '2025-09-21 06:40:14', '2025-09-21 07:40:09');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `speech` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `speech`, `name`, `designation`, `created_at`, `updated_at`) VALUES
(1, '\"Chobi Dokan made it so easy to find a professional photographer for our wedding event. The platform is intuitive, and the creatives are highly talented. Highly recommended!\"', 'Sara Rahman', 'Event Organizer', '2025-09-21 07:47:26', '2025-09-21 07:47:26'),
(2, '\"I needed a logo and some social media graphics for my business. Chobi Dokan helped me connect with a designer who understood my vision perfectly. Amazing service and fast delivery!\"', 'Tanvir Hossain', 'Small Business Owner', '2025-09-21 07:47:51', '2025-09-21 07:47:51'),
(3, '\"As a creator, Chobi Dokan has given me the opportunity to showcase my work and reach clients I couldn’t have found otherwise. The platform is smooth, secure, and supportive.\"', 'Afsana Karim', 'Freelance Photographer', '2025-09-21 07:48:13', '2025-09-21 07:48:13');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_submit_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=>Pending, 1=>Approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `project_submit_id`, `project_id`, `file_path`, `file_name`, `file_type`, `status`, `created_at`, `updated_at`) VALUES
(14, 9, 67, 'uploads/project/submit-file/1760124008_68e95c68f0f45.jpg', '1760124008_68e95c68f0f45.jpg', 'image/jpeg', 0, '2025-10-10 19:20:10', '2025-10-10 19:20:10'),
(15, 9, 67, 'uploads/project/submit-file/1760124010_68e95c6a2160c.jpg', '1760124010_68e95c6a2160c.jpg', 'image/jpeg', 0, '2025-10-10 19:20:10', '2025-10-10 19:20:10'),
(16, 9, 67, 'uploads/project/submit-file/1760124010_68e95c6ad0abe.jpg', '1760124010_68e95c6ad0abe.jpg', 'image/jpeg', 1, '2025-10-10 19:20:11', '2025-10-10 19:21:09'),
(17, 10, 67, 'uploads/project/submit-file/1760127052_68e9684c19b71.jpg', '1760127052_68e9684c19b71.jpg', 'image/jpeg', 0, '2025-10-10 20:10:52', '2025-10-10 20:10:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `verification_code` varchar(255) DEFAULT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0 COMMENT '0=>Unverified, 1=>Verified',
  `role_id` int(11) NOT NULL,
  `is_banned` int(11) NOT NULL DEFAULT 0 COMMENT '0=>Unbanned, 1=>Banned',
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `bio` longtext DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `account_holder_name` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `routing_no` varchar(255) DEFAULT NULL,
  `account_type` varchar(255) DEFAULT NULL,
  `mobile_banking_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `verification_code`, `is_verified`, `role_id`, `is_banned`, `email_verified_at`, `password`, `remember_token`, `address`, `image`, `bio`, `bank_name`, `branch_name`, `account_holder_name`, `account_number`, `routing_no`, `account_type`, `mobile_banking_no`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, NULL, 0, 1, 0, NULL, '$2y$10$qEjQZHdTBu9EGW8wilQiFuZUyTS888bUSMnCnFagFr49uu5uBOwcC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Md. Shamim Al-Deen', 'shamimaldeen@gmail.com', '01738298666', NULL, 0, 2, 0, NULL, '$2y$10$fgNROc8u560fl59BxKLjjeOKQR2Jjc9WumHJykSmki1X9VA0GXCsS', NULL, '15-Dhanmondhi,dhaka-1200,Bangladesh', 'uploads/designer/1759437246_68dee1be965fa.jpg', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'ABC Bank Ltd', 'gfdgdfg', 'Md. Shamim Al-Deen', '341243546567', '5432532', 'Card', '01738298666', '2025-08-18 19:35:11', '2025-10-02 21:01:23', NULL),
(3, 'Al-Deen', 'aldeen298666@gmail.com', '01738298666', NULL, 0, 3, 0, NULL, '$2y$10$OPd4kGtlvs9goxYIiKlZ9e4q1wgu47ks.WfqbIiDdyRL1UU8v5f/q', NULL, '15-Dhanmondhi,dhaka-1200,Bangladesh', 'uploads/user/1759269347_68dc51e3ef620.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'ABC Bank Ltd', 'Banani', 'Al-Deen', '34124354656', '54654', 'Card', '01738298667', '2025-08-18 19:37:44', '2025-09-30 22:05:43', NULL),
(4, 'designer1', 'designer1@gmail.com', '01738455455', NULL, 0, 2, 0, NULL, '$2y$10$e192oASPePQ.3kHXAFvVG.mqC52vyQc5To1la123I2uyLXFkIWQeu', NULL, '15-Dhanmondhi,dhaka-1200,Bangladesh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-05 13:38:24', '2025-10-03 19:59:39', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_project_id_foreign` (`project_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_designer_id_foreign` (`designer_id`),
  ADD KEY `comments_parent_id_foreign` (`parent_id`);

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
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_project_id_foreign` (`project_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `info_setups`
--
ALTER TABLE `info_setups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `licencings`
--
ALTER TABLE `licencings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `project_submits`
--
ALTER TABLE `project_submits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `research_imgs`
--
ALTER TABLE `research_imgs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `search_tips`
--
ALTER TABLE `search_tips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `technical_infos`
--
ALTER TABLE `technical_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_designer_id_foreign` FOREIGN KEY (`designer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

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
