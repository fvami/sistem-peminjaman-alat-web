-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 04, 2026 at 08:25 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipelat`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Alat Pertukangan', '2026-04-06 02:18:37', '2026-04-06 02:18:37'),
(2, 'Alat Konstruksi', '2026-04-06 02:18:37', '2026-04-06 02:18:37'),
(3, 'Alat Listrik', '2026-04-06 02:18:37', '2026-04-06 02:18:37'),
(4, 'Sound System', '2026-04-06 02:18:37', '2026-04-06 02:18:37'),
(5, 'Multimedia', '2026-04-06 02:18:37', '2026-04-06 02:18:37');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `borrower_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `borrower_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `borrower_address` text COLLATE utf8mb4_unicode_ci,
  `status` enum('borrowed','returned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'borrowed',
  `loan_date` date NOT NULL,
  `return_plan` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `user_id`, `borrower_name`, `borrower_phone`, `borrower_address`, `status`, `loan_date`, `return_plan`, `created_at`, `updated_at`) VALUES
(1, 3, 'Nicholas', '081234567890', 'PIK 2', 'borrowed', '2026-04-06', '2026-04-11', '2026-04-06 03:29:54', '2026-04-06 03:29:54'),
(2, 3, 'Leonardo', '081234567890', 'PIK 2', 'returned', '2026-04-06', '2026-04-11', '2026-04-06 03:30:41', '2026-04-06 03:33:29'),
(3, 3, 'George', '081234567890', 'Tangerang Selatan', 'returned', '2026-04-06', '2026-04-18', '2026-04-06 03:31:20', '2026-04-06 03:33:23'),
(4, 3, 'Steven', '081234567890', 'Jakarta Selatan', 'borrowed', '2026-04-06', '2026-05-02', '2026-04-06 03:31:53', '2026-04-06 03:31:53'),
(5, 3, 'Timothy', '081234567890', 'PIK 2', 'borrowed', '2026-04-06', '2026-04-18', '2026-04-06 03:33:03', '2026-04-06 03:33:03');

-- --------------------------------------------------------

--
-- Table structure for table `loan_details`
--

CREATE TABLE `loan_details` (
  `id` bigint UNSIGNED NOT NULL,
  `loan_id` bigint UNSIGNED NOT NULL,
  `tool_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_details`
--

INSERT INTO `loan_details` (`id`, `loan_id`, `tool_id`, `qty`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 1, '2026-04-06 03:29:54', '2026-04-06 03:29:54'),
(2, 1, 7, 1, '2026-04-06 03:29:54', '2026-04-06 03:29:54'),
(3, 2, 1, 2, '2026-04-06 03:30:41', '2026-04-06 03:30:41'),
(4, 2, 6, 1, '2026-04-06 03:30:41', '2026-04-06 03:30:41'),
(5, 2, 3, 1, '2026-04-06 03:30:41', '2026-04-06 03:30:41'),
(6, 3, 9, 2, '2026-04-06 03:31:20', '2026-04-06 03:31:20'),
(7, 3, 8, 1, '2026-04-06 03:31:20', '2026-04-06 03:31:20'),
(8, 3, 11, 1, '2026-04-06 03:31:20', '2026-04-06 03:31:20'),
(9, 4, 1, 2, '2026-04-06 03:31:53', '2026-04-06 03:31:53'),
(10, 4, 6, 1, '2026-04-06 03:31:53', '2026-04-06 03:31:53'),
(11, 4, 7, 1, '2026-04-06 03:31:53', '2026-04-06 03:31:53'),
(12, 5, 7, 1, '2026-04-06 03:33:03', '2026-04-06 03:33:03'),
(13, 5, 8, 1, '2026-04-06 03:33:03', '2026-04-06 03:33:03'),
(14, 5, 9, 1, '2026-04-06 03:33:03', '2026-04-06 03:33:03'),
(15, 5, 11, 1, '2026-04-06 03:33:03', '2026-04-06 03:33:03'),
(16, 5, 10, 1, '2026-04-06 03:33:03', '2026-04-06 03:33:03');

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
(1, '2013_01_31_235443_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2026_02_01_003721_create_categories_table', 1),
(7, '2026_02_01_004003_create_tools_table', 1),
(8, '2026_02_01_010004_create_loans_table', 1),
(9, '2026_02_01_010033_create_loan_details_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Operator', '2026-02-13 05:25:01', '2026-02-13 05:25:01'),
(2, 'Administrator', '2026-02-13 05:25:01', '2026-02-13 05:25:01');

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE `tools` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `stock` int NOT NULL DEFAULT '0',
  `status` enum('available','unavailable','maintenance') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tools`
--

INSERT INTO `tools` (`id`, `category_id`, `name`, `description`, `stock`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bor Listrik', 'Bor listrik', 8, 'available', NULL, '2026-04-06 02:18:37', '2026-04-06 03:33:29'),
(2, 1, 'Gerinda', 'Gerinda tangan', 6, 'available', NULL, '2026-04-06 02:18:37', '2026-04-06 02:18:37'),
(3, 1, 'Obeng Set', 'Set obeng lengkap', 8, 'available', NULL, '2026-04-06 02:18:37', '2026-04-06 03:33:29'),
(4, 2, 'Molen Beton', 'Mesin aduk semen', 2, 'maintenance', NULL, '2026-04-06 02:18:37', '2026-04-06 02:18:37'),
(5, 2, 'Jack Hammer', 'Pemecah beton', 1, 'unavailable', NULL, '2026-04-06 02:18:37', '2026-04-06 02:18:37'),
(6, 3, 'Genset', 'Genset portable', 2, 'available', NULL, '2026-04-06 02:18:37', '2026-04-06 03:33:29'),
(7, 3, 'Kabel Roll', 'Kabel roll', 4, 'available', NULL, '2026-04-06 02:18:37', '2026-04-06 03:33:03'),
(8, 4, 'Speaker Aktif', 'Speaker', 3, 'available', NULL, '2026-04-06 02:18:37', '2026-04-06 03:33:23'),
(9, 4, 'Microphone', 'Mic kabel', 5, 'available', NULL, '2026-04-06 02:18:37', '2026-04-06 03:33:23'),
(10, 5, 'Proyektor', 'Proyektor', 1, 'available', NULL, '2026-04-06 02:18:37', '2026-04-06 03:33:03'),
(11, 5, 'Tripod', 'Tripod kamera', 4, 'available', NULL, '2026-04-06 02:18:37', '2026-04-06 03:33:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 2, 'Tmg', 'tmg@gmail.com', NULL, '$2y$10$msAn6i1w.9NB/UYfljb7HO34EcSSOgMNbeaH4KdmlCBLRFiAtC/Ge', NULL, '2026-04-06 01:37:00', '2026-04-06 02:56:05'),
(3, 1, 'Tvm', 'tvm@gmail.com', NULL, '$2y$10$.TOhCBHjYLMKFczjVkdpqumL5zPie5MmOrlB0uEoP1bSS6adibI9y', NULL, '2026-04-06 02:53:57', '2026-04-06 02:56:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loans_user_id_foreign` (`user_id`);

--
-- Indexes for table `loan_details`
--
ALTER TABLE `loan_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loan_details_loan_id_foreign` (`loan_id`),
  ADD KEY `loan_details_tool_id_foreign` (`tool_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tools_category_id_foreign` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `loan_details`
--
ALTER TABLE `loan_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tools`
--
ALTER TABLE `tools`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loan_details`
--
ALTER TABLE `loan_details`
  ADD CONSTRAINT `loan_details_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `loan_details_tool_id_foreign` FOREIGN KEY (`tool_id`) REFERENCES `tools` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tools`
--
ALTER TABLE `tools`
  ADD CONSTRAINT `tools_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
