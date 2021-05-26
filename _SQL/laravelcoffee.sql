-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2021 at 06:13 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravelcoffee`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `vendor_id`, `created_at`, `updated_at`) VALUES
(2, 6, 2, '2021-05-25 18:02:03', '2021-05-25 18:02:03');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_11_11_050759_create_vendors_table', 1),
(5, '2021_02_23_035720_create_likes_table', 1),
(6, '2021_03_03_005145_create_products_table', 1),
(7, '2021_04_22_011135_create_ratings_table', 1);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productDescription` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productPrice` decimal(8,2) NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `productName`, `productDescription`, `productPrice`, `vendor_id`, `created_at`, `updated_at`) VALUES
(1, 'consequatur', 'Eius officia quam quia ad.', '5.00', 3, '2021-05-25 17:03:39', '2021-05-25 17:03:39'),
(2, 'quo', 'Quae tenetur aperiam omnis quam aspernatur qui maxime omnis.', '5.00', 3, '2021-05-25 17:03:39', '2021-05-25 17:03:39'),
(3, 'ut', 'Tempora sit harum dolor quia cum.', '5.00', 2, '2021-05-25 17:03:39', '2021-05-25 17:03:39'),
(4, 'sit', 'Omnis non non corrupti ipsum officiis aspernatur voluptatem et.', '5.00', 3, '2021-05-25 17:03:39', '2021-05-25 17:03:39'),
(5, 'reprehenderit', 'Porro vel harum modi dolor ex quis.', '3.00', 2, '2021-05-25 17:03:39', '2021-05-25 17:03:39'),
(6, 'architecto', 'Et aut tempore similique velit.', '5.00', 3, '2021-05-25 17:03:39', '2021-05-25 17:03:39'),
(7, 'voluptatem', 'Ipsum ratione et quia est.', '6.00', 2, '2021-05-25 17:03:39', '2021-05-25 17:03:39'),
(8, 'odit', 'Aut molestiae reiciendis qui non ratione et nihil dolor.', '3.00', 1, '2021-05-25 17:03:39', '2021-05-25 17:03:39'),
(9, 'est', 'Cupiditate nulla dolores id et saepe ea.', '4.00', 3, '2021-05-25 17:03:39', '2021-05-25 17:03:39'),
(10, 'sit', 'Repellat nisi iusto cum non dolor ut.', '6.00', 3, '2021-05-25 17:03:39', '2021-05-25 17:03:39'),
(11, 'eligendi', 'Aut placeat accusantium ex ipsa.', '6.00', 2, '2021-05-25 17:03:39', '2021-05-25 17:03:39'),
(12, 'quas', 'In porro aut ut in reiciendis dolores dolores.', '4.00', 1, '2021-05-25 17:03:39', '2021-05-25 17:03:39'),
(13, 'repellendus', 'Totam magni inventore eos repudiandae in non velit.', '6.00', 3, '2021-05-25 17:03:39', '2021-05-25 17:03:39'),
(14, 'dolorum', 'Aliquam quia ut dolores aliquid atque maxime quia.', '4.00', 3, '2021-05-25 17:03:39', '2021-05-25 17:03:39'),
(15, 'vel', 'Aut in voluptates sequi vero corrupti harum aut.', '6.00', 2, '2021-05-25 17:03:39', '2021-05-25 17:03:39');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `rating` enum('1','2','3','4','5') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
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

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Eve Hane', 'omoore@example.net', '2021-05-25 17:03:39', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'quXz0MNWUI', '2021-05-25 17:03:39', '2021-05-25 17:03:39'),
(2, 'Misael Stokes', 'mhackett@example.org', '2021-05-25 17:03:39', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'OqEfC9FN7i', '2021-05-25 17:03:39', '2021-05-25 17:03:39'),
(3, 'Kole Cormier II', 'langosh.karianne@example.net', '2021-05-25 17:03:39', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'hKbU6USWfA', '2021-05-25 17:03:39', '2021-05-25 17:03:39'),
(4, 'Oswaldo Conroy', 'brody.donnelly@example.net', '2021-05-25 17:03:39', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'G6iZqGrvNh', '2021-05-25 17:03:39', '2021-05-25 17:03:39'),
(5, 'Raegan Wilderman', 'anissa53@example.org', '2021-05-25 17:03:39', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'F40eeRiPQv', '2021-05-25 17:03:39', '2021-05-25 17:03:39'),
(6, 'Glen Allen', 'glena072@gmail.com', NULL, '$2y$10$eyUwet643WKhyfCP6cQnzetZ5p5Fp4OFMnGLfsjRh1YSg3XQ05aRq', NULL, '2021-05-25 17:13:00', '2021-05-25 17:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suburb` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cardstamps` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `vendor_name`, `slug`, `contact_name`, `contact_lastname`, `email`, `mobile`, `address`, `suburb`, `pc`, `state`, `cardstamps`, `vendor_image`, `created_at`, `updated_at`) VALUES
(1, 'Lemke and Sons', 'Lebsack Group', 'Muhammad Kutch', 'Prof. Americo Koss V', 'mckenzie.mekhi@example.com', '6357.0341', '306 / 88 Reichert Gates\nNew Dandre, NSW 4821', 'St.', '2043', 'VIC', '10', 'cafe1.jpg', '2021-05-25 17:03:39', '2021-05-25 17:03:39'),
(2, 'Ferry, Collins and Hansen', 'Lowe Group', 'Mr. Winfield Sipes', 'Brook Kuvalis IV', 'wiley82@example.net', '+61 8 6582 3326', '08 Margarette Retreat\nSouth Noah, NSW 2964', 'Port', '2660', 'NT', '10', 'vendor_default.jpg', '2021-05-25 17:03:39', '2021-05-25 17:03:39'),
(3, 'Leannon and Sons', 'Hartmann-Cremin', 'Kamille Quitzon', 'Foster Conroy', 'gleichner.jairo@example.net', '07-9764-8722', '1 / 7 Eliane Artery\nOllieton, SA 2940', 'North', '0292', 'SA', '10', 'cafe2.jpg', '2021-05-25 17:03:39', '2021-05-25 17:03:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_user_id_foreign` (`user_id`),
  ADD KEY `likes_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_user_id_foreign` (`user_id`),
  ADD KEY `ratings_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendors_vendor_name_unique` (`vendor_name`),
  ADD UNIQUE KEY `vendors_slug_unique` (`slug`),
  ADD UNIQUE KEY `vendors_email_unique` (`email`),
  ADD UNIQUE KEY `vendors_mobile_unique` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
