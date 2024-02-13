-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2023 at 04:17 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `broadcasts`
--

CREATE TABLE `broadcasts` (
  `id` int(11) NOT NULL,
  `flag` enum('to','cc','bcc','') DEFAULT NULL,
  `dashboards_id` int(11) DEFAULT NULL,
  `recipients_id` int(11) DEFAULT NULL,
  `is_active` enum('yes','no','','') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Prepaid'),
(2, 'Postpaid'),
(3, 'CVM'),
(4, 'FMC'),
(5, 'Digital');

-- --------------------------------------------------------

--
-- Table structure for table `dashboard`
--

CREATE TABLE `dashboard` (
  `dashboard_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `dashboard_name` varchar(225) NOT NULL,
  `description` text NOT NULL,
  `embed_url` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `dashboard_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dashboard`
--

INSERT INTO `dashboard` (`dashboard_id`, `category_id`, `dashboard_name`, `description`, `embed_url`, `image`, `dashboard_status`, `created_at`) VALUES
(1, 5, 'Digital Broadband', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse consequat vel metus vel auctor.', '<div class=\'tableauPlaceholder\' id=\'viz1691737512228\' style=\'position: relative\'><noscript><a href=\'#\'><img alt=\'Sheet 2 \' src=\'https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;or&#47;order_16917374782070&#47;Sheet2&#47;1_rss.png\' style=\'border: none\' /></a></noscript><object class=\'tableauViz\'  style=\'display:none;\'><param name=\'host_url\' value=\'https%3A%2F%2Fpublic.tableau.com%2F\' /> <param name=\'embed_code_version\' value=\'3\' /> <param name=\'site_root\' value=\'\' /><param name=\'name\' value=\'order_16917374782070&#47;Sheet2\' /><param name=\'tabs\' value=\'no\' /><param name=\'toolbar\' value=\'yes\' /><param name=\'static_image\' value=\'https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;or&#47;order_16917374782070&#47;Sheet2&#47;1.png\' /> <param name=\'animate_transition\' value=\'yes\' /><param name=\'display_static_image\' value=\'yes\' /><param name=\'display_spinner\' value=\'yes\' /><param name=\'display_overlay\' value=\'yes\' /><param name=\'display_count\' value=\'yes\' /><param name=\'language\' value=\'en-US\' /></object></div>                <script type=\'text/javascript\'>                    var divElement = document.getElementById(\'viz1691737512228\');                    var vizElement = divElement.getElementsByTagName(\'object\')[0];                    vizElement.style.width=\'100%\';vizElement.style.height=(divElement.offsetWidth*0.75)+\'px\';                    var scriptElement = document.createElement(\'script\');                    scriptElement.src = \'https://public.tableau.com/javascripts/api/viz_v1.js\';                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>', '1692095588_1691655583_broadband.png', 1, '2023-08-18 04:47:37'),
(2, 2, 'Postpaid Performance', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse consequat vel metus vel auctor.', '<div class=\'tableauPlaceholder\' id=\'viz1691737512228\' style=\'position: relative\'><noscript><a href=\'#\'><img alt=\'Sheet 2 \' src=\'https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;or&#47;order_16917374782070&#47;Sheet2&#47;1_rss.png\' style=\'border: none\' /></a></noscript><object class=\'tableauViz\'  style=\'display:none;\'><param name=\'host_url\' value=\'https%3A%2F%2Fpublic.tableau.com%2F\' /> <param name=\'embed_code_version\' value=\'3\' /> <param name=\'site_root\' value=\'\' /><param name=\'name\' value=\'order_16917374782070&#47;Sheet2\' /><param name=\'tabs\' value=\'no\' /><param name=\'toolbar\' value=\'yes\' /><param name=\'static_image\' value=\'https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;or&#47;order_16917374782070&#47;Sheet2&#47;1.png\' /> <param name=\'animate_transition\' value=\'yes\' /><param name=\'display_static_image\' value=\'yes\' /><param name=\'display_spinner\' value=\'yes\' /><param name=\'display_overlay\' value=\'yes\' /><param name=\'display_count\' value=\'yes\' /><param name=\'language\' value=\'en-US\' /></object></div>                <script type=\'text/javascript\'>                    var divElement = document.getElementById(\'viz1691737512228\');                    var vizElement = divElement.getElementsByTagName(\'object\')[0];                    vizElement.style.width=\'100%\';vizElement.style.height=(divElement.offsetWidth*0.75)+\'px\';                    var scriptElement = document.createElement(\'script\');                    scriptElement.src = \'https://public.tableau.com/javascripts/api/viz_v1.js\';                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>', '1692095661_1690970518_dashboard2.jpg', 1, '2023-08-16 06:28:12'),
(3, 1, 'Prepaid Performance', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse consequat vel metus vel auctor.', '<div class=\'tableauPlaceholder\' id=\'viz1691737512228\' style=\'position: relative\'><noscript><a href=\'#\'><img alt=\'Sheet 2 \' src=\'https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;or&#47;order_16917374782070&#47;Sheet2&#47;1_rss.png\' style=\'border: none\' /></a></noscript><object class=\'tableauViz\'  style=\'display:none;\'><param name=\'host_url\' value=\'https%3A%2F%2Fpublic.tableau.com%2F\' /> <param name=\'embed_code_version\' value=\'3\' /> <param name=\'site_root\' value=\'\' /><param name=\'name\' value=\'order_16917374782070&#47;Sheet2\' /><param name=\'tabs\' value=\'no\' /><param name=\'toolbar\' value=\'yes\' /><param name=\'static_image\' value=\'https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;or&#47;order_16917374782070&#47;Sheet2&#47;1.png\' /> <param name=\'animate_transition\' value=\'yes\' /><param name=\'display_static_image\' value=\'yes\' /><param name=\'display_spinner\' value=\'yes\' /><param name=\'display_overlay\' value=\'yes\' /><param name=\'display_count\' value=\'yes\' /><param name=\'language\' value=\'en-US\' /></object></div>                <script type=\'text/javascript\'>                    var divElement = document.getElementById(\'viz1691737512228\');                    var vizElement = divElement.getElementsByTagName(\'object\')[0];                    vizElement.style.width=\'100%\';vizElement.style.height=(divElement.offsetWidth*0.75)+\'px\';                    var scriptElement = document.createElement(\'script\');                    scriptElement.src = \'https://public.tableau.com/javascripts/api/viz_v1.js\';                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>', '1692095702_1691082718_dashboard1.png', 1, '2023-08-16 06:28:17');

-- --------------------------------------------------------

--
-- Table structure for table `dashboards`
--

CREATE TABLE `dashboards` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `category` varchar(128) NOT NULL,
  `is_active` enum('yes','no','','') NOT NULL,
  `description` text NOT NULL,
  `pic` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dashboards`
--

INSERT INTO `dashboards` (`id`, `name`, `category`, `is_active`, `description`, `pic`) VALUES
(1, 'Hourly Dashboard - Combo Tracking Result', 'Hourly', 'yes', 'Sample Description', 'Dani Wika'),
(2, 'Hourly Dashboard Internet Sakti', 'Hourly', 'yes', 'Sample Description', 'Fikri Thauli'),
(3, 'Daily Monitoring Tabel Multidim VS Pre DD', 'Alert', 'yes', 'Sample Description', 'Dani Wika, S'),
(4, 'Alert Hadoop Usage', 'Alert', 'yes', 'Sample Description', 'Dani Wika'),
(5, 'Alert Payload UPCC', 'Alert', 'yes', 'Sample Description', 'Fikri Thauli');

-- --------------------------------------------------------

--
-- Table structure for table `detail_logins`
--

CREATE TABLE `detail_logins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_login_browser` text NOT NULL,
  `last_login_ip` text NOT NULL,
  `last_login_location` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_logins`
--

INSERT INTO `detail_logins` (`id`, `user_id`, `last_login_browser`, `last_login_ip`, `last_login_location`, `created_at`, `updated_at`) VALUES
(23, 3, 'Chrome on Windows', '::1', 'Indonesia', '2023-08-23 16:13:52', '2023-08-23 16:13:52'),
(24, 3, 'Chrome on Windows', '::1', 'Indonesia', '2023-08-23 18:43:27', '2023-08-23 18:43:27'),
(25, 3, 'Chrome on Windows', '127.0.0.1', 'Indonesia', '2023-08-23 19:05:52', '2023-08-23 19:05:52'),
(26, 3, 'Chrome on Windows', '::1', 'Indonesia', '2023-08-24 09:04:18', '2023-08-24 09:04:18'),
(27, 3, 'Chrome on Windows', '::1', 'Indonesia', '2023-08-24 10:32:27', '2023-08-24 10:32:27'),
(28, 3, 'Chrome on Windows', '::1', 'Indonesia', '2023-08-24 12:18:53', '2023-08-24 12:18:53'),
(29, 3, 'Chrome on Windows', '127.0.0.1', 'Indonesia', '2023-08-24 12:19:33', '2023-08-24 12:19:33'),
(30, 3, 'Chrome on Windows', '::1', 'Indonesia', '2023-08-24 12:20:36', '2023-08-24 12:20:36'),
(31, 3, 'Chrome on Windows', '::1', 'Indonesia', '2023-08-24 12:20:59', '2023-08-24 12:20:59'),
(32, 3, 'Chrome on Windows', '::1', 'Indonesia', '2023-08-24 12:21:59', '2023-08-24 12:21:59'),
(33, 3, 'Chrome on Windows', '::1', 'Indonesia', '2023-08-24 14:56:14', '2023-08-24 14:56:14'),
(34, 3, 'Chrome on Windows', '127.0.0.1', 'Indonesia', '2023-08-24 18:56:46', '2023-08-24 18:56:46'),
(35, 3, 'Chrome on Windows', '::1', 'Indonesia', '2023-08-24 20:38:14', '2023-08-24 20:38:14'),
(36, 3, 'Chrome on Windows', '::1', 'Indonesia', '2023-08-24 21:38:56', '2023-08-24 21:38:56'),
(37, 3, 'Chrome on Windows', '::1', 'Indonesia', '2023-08-25 04:59:53', '2023-08-25 04:59:53'),
(38, 3, 'Chrome on Windows', '::1', 'Indonesia', '2023-08-25 09:22:35', '2023-08-25 09:22:35'),
(39, 3, 'Chrome on Windows', '::1', 'Indonesia', '2023-08-25 14:04:57', '2023-08-25 14:04:57'),
(40, 3, 'Chrome on Windows', '::1', 'Indonesia', '2023-08-28 05:39:54', '2023-08-28 05:39:54'),
(41, 3, 'Chrome on Windows', '::1', 'Indonesia', '2023-08-28 14:56:15', '2023-08-28 14:56:15'),
(42, 3, 'Chrome on Windows', '::1', 'Indonesia', '2023-08-28 21:07:10', '2023-08-28 21:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `dashboard_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permission_request`
--

CREATE TABLE `permission_request` (
  `request_id` bigint(20) NOT NULL,
  `dashboard_id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `departement` varchar(225) NOT NULL,
  `reason` text NOT NULL,
  `request_status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permission_request`
--

INSERT INTO `permission_request` (`request_id`, `dashboard_id`, `name`, `departement`, `reason`, `request_status`, `created_at`, `updated_at`) VALUES
(14, 1, 'Abieza Syahdilla', 'Accounting', 'sample', 2, '2023-08-18 02:31:13', '2023-08-23 09:14:39');

-- --------------------------------------------------------

--
-- Table structure for table `recipients`
--

CREATE TABLE `recipients` (
  `id` int(11) NOT NULL,
  `name` varchar(225) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `job_title` text DEFAULT NULL,
  `is_active` enum('yes','no','','') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `microsoft_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `google_id`, `microsoft_id`, `avatar`, `job_title`, `role_id`, `created_at`, `updated_at`) VALUES
(3, 'Dani Wika', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, NULL, 1, '2023-07-31 07:32:28', '2023-08-18 11:09:59'),
(12, 'Abieza Syahdilla', 'abieza.eresha@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, '3b381b9e73e59335', NULL, 'Software Engineer', 2, '2023-08-14 04:09:14', '2023-08-15 07:39:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `broadcasts`
--
ALTER TABLE `broadcasts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `dashboard`
--
ALTER TABLE `dashboard`
  ADD PRIMARY KEY (`dashboard_id`);

--
-- Indexes for table `dashboards`
--
ALTER TABLE `dashboards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_logins`
--
ALTER TABLE `detail_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_request`
--
ALTER TABLE `permission_request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `recipients`
--
ALTER TABLE `recipients`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `broadcasts`
--
ALTER TABLE `broadcasts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `dashboard`
--
ALTER TABLE `dashboard`
  MODIFY `dashboard_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dashboards`
--
ALTER TABLE `dashboards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detail_logins`
--
ALTER TABLE `detail_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permission_request`
--
ALTER TABLE `permission_request`
  MODIFY `request_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `recipients`
--
ALTER TABLE `recipients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
