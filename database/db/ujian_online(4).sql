-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 20, 2025 at 10:30 PM
-- Server version: 8.0.40
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujian_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `metadata` json DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_type`, `user_id`, `action`, `description`, `metadata`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Unknown\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', NULL, '2025-10-11 02:06:44', '2025-10-11 02:06:44'),
(2, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-11 02:09:14', '2025-10-11 02:09:14'),
(3, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-11 03:24:59', '2025-10-11 03:24:59'),
(4, 'admin', 0, 'login_failed', 'Failed login attempt', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-13 02:32:41', '2025-10-13 02:32:41'),
(5, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-13 02:32:46', '2025-10-13 02:32:46'),
(6, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-13 04:42:35', '2025-10-13 04:42:35'),
(7, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-13 04:56:45', '2025-10-13 04:56:45'),
(8, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-13 22:00:46', '2025-10-13 22:00:46'),
(9, 'peserta', 1, 'login_failed', 'Failed peserta login attempt', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-13 23:48:37', '2025-10-13 23:48:37'),
(10, 'peserta', 1, 'login_success', 'Successful peserta login', '{\"os\": \"Unknown\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', NULL, NULL, '2025-10-13 23:51:54', '2025-10-13 23:51:54'),
(11, 'peserta', 1, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-13 23:54:31', '2025-10-13 23:54:31'),
(12, 'peserta', 1, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-14 02:30:00', '2025-10-14 02:30:00'),
(13, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-14 02:31:28', '2025-10-14 02:31:28'),
(14, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-14 02:41:48', '2025-10-14 02:41:48'),
(15, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-14 17:36:30', '2025-10-14 17:36:30'),
(16, 'peserta', 1, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-14 21:45:49', '2025-10-14 21:45:49'),
(17, 'peserta', 1, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-14 21:46:02', '2025-10-14 21:46:02'),
(18, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-14 21:46:16', '2025-10-14 21:46:16'),
(19, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-15 05:22:01', '2025-10-15 05:22:01'),
(20, 'admin', 1, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-15 07:52:15', '2025-10-15 07:52:15'),
(21, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-15 07:53:18', '2025-10-15 07:53:18'),
(22, 'peserta', 1, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-15 07:54:26', '2025-10-15 07:54:26'),
(23, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-15 17:35:55', '2025-10-15 17:35:55'),
(24, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-15 20:23:02', '2025-10-15 20:23:02'),
(25, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-15 20:27:48', '2025-10-15 20:27:48'),
(26, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-15 21:27:12', '2025-10-15 21:27:12'),
(27, 'admin', 1, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-15 21:39:28', '2025-10-15 21:39:28'),
(28, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-15 21:39:54', '2025-10-15 21:39:54'),
(29, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-16 01:55:24', '2025-10-16 01:55:24'),
(30, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', '2025-10-16 05:27:47', '2025-10-16 05:27:47'),
(31, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-16 09:01:18', '2025-10-16 09:01:18'),
(32, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-16 09:27:55', '2025-10-16 09:27:55'),
(33, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-16 18:17:14', '2025-10-16 18:17:14'),
(34, 'peserta', 0, 'login_failed', 'Failed peserta login attempt', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-16 18:53:01', '2025-10-16 18:53:01'),
(35, 'peserta', 1, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-16 18:53:28', '2025-10-16 18:53:28'),
(36, 'peserta', 1, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-16 19:09:16', '2025-10-16 19:09:16'),
(37, 'peserta', 1, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-16 19:10:28', '2025-10-16 19:10:28'),
(38, 'peserta', 1, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-16 19:48:53', '2025-10-16 19:48:53'),
(39, 'peserta', 1, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-16 19:48:56', '2025-10-16 19:48:56'),
(40, 'peserta', 1, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-16 19:56:43', '2025-10-16 19:56:43'),
(41, 'peserta', 1, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-16 20:00:01', '2025-10-16 20:00:01'),
(42, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-16 20:00:06', '2025-10-16 20:00:06'),
(43, 'peserta', 1, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-16 20:11:05', '2025-10-16 20:11:05'),
(44, 'peserta', 1, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-16 20:12:01', '2025-10-16 20:12:01'),
(45, 'peserta', 1, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-16 20:13:44', '2025-10-16 20:13:44'),
(46, 'peserta', 1, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-16 20:14:01', '2025-10-16 20:14:01'),
(47, 'peserta', 1, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-16 20:55:31', '2025-10-16 20:55:31'),
(48, 'peserta', 1, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-16 20:56:51', '2025-10-16 20:56:51'),
(49, 'peserta', 1, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-16 21:23:56', '2025-10-16 21:23:56'),
(50, 'peserta', 1, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-16 21:24:01', '2025-10-16 21:24:01'),
(51, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 01:06:37', '2025-10-20 01:06:37'),
(52, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 01:07:34', '2025-10-20 01:07:34'),
(53, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 01:08:26', '2025-10-20 01:08:26'),
(54, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-20 01:08:55', '2025-10-20 01:08:55'),
(55, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 01:13:11', '2025-10-20 01:13:11'),
(56, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 01:13:22', '2025-10-20 01:13:22'),
(57, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 01:13:32', '2025-10-20 01:13:32'),
(58, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 01:14:20', '2025-10-20 01:14:20'),
(59, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 01:15:14', '2025-10-20 01:15:14'),
(60, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 01:15:50', '2025-10-20 01:15:50'),
(61, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 01:40:05', '2025-10-20 01:40:05'),
(62, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 01:42:26', '2025-10-20 01:42:26'),
(63, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 01:51:47', '2025-10-20 01:51:47'),
(64, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 01:53:20', '2025-10-20 01:53:20'),
(65, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 01:53:58', '2025-10-20 01:53:58'),
(66, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 01:54:34', '2025-10-20 01:54:34'),
(67, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 01:55:12', '2025-10-20 01:55:12'),
(68, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 01:55:55', '2025-10-20 01:55:55'),
(69, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 01:56:17', '2025-10-20 01:56:17'),
(70, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-20 01:57:21', '2025-10-20 01:57:21'),
(71, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 02:01:47', '2025-10-20 02:01:47'),
(72, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 02:02:01', '2025-10-20 02:02:01'),
(73, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 02:02:50', '2025-10-20 02:02:50'),
(74, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 02:03:03', '2025-10-20 02:03:03'),
(75, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 02:03:59', '2025-10-20 02:03:59'),
(76, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 02:04:14', '2025-10-20 02:04:14'),
(77, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 02:04:30', '2025-10-20 02:04:30'),
(78, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 02:07:38', '2025-10-20 02:07:38'),
(79, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 02:08:23', '2025-10-20 02:08:23'),
(80, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 02:08:42', '2025-10-20 02:08:42'),
(81, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 02:09:43', '2025-10-20 02:09:43'),
(82, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 02:10:06', '2025-10-20 02:10:06'),
(83, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 02:10:51', '2025-10-20 02:10:51'),
(84, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 02:11:57', '2025-10-20 02:11:57'),
(85, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 02:12:54', '2025-10-20 02:12:54'),
(86, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 02:13:15', '2025-10-20 02:13:15'),
(87, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 02:13:55', '2025-10-20 02:13:55'),
(88, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 02:14:18', '2025-10-20 02:14:18'),
(89, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 02:14:38', '2025-10-20 02:14:38'),
(90, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 02:23:25', '2025-10-20 02:23:25'),
(91, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-20 02:31:47', '2025-10-20 02:31:47'),
(92, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 02:35:16', '2025-10-20 02:35:16'),
(93, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-20 05:22:03', '2025-10-20 05:22:03'),
(94, 'peserta', 2, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 05:29:59', '2025-10-20 05:29:59'),
(95, 'peserta', 2, 'login_success', 'Successful peserta login', '{\"os\": \"Linux\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Linux; Android 8.0.0; SM-G955U Build/R16NW) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Mobile Safari/537.36', '2025-10-20 05:30:46', '2025-10-20 05:30:46'),
(96, 'peserta', 2, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 05:34:17', '2025-10-20 05:34:17'),
(97, 'peserta', 2, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-20 05:53:33', '2025-10-20 05:53:33'),
(98, 'peserta', 2, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-20 05:53:36', '2025-10-20 05:53:36'),
(99, 'peserta', 2, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-20 07:27:50', '2025-10-20 07:27:50'),
(100, 'peserta', 2, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-20 07:27:53', '2025-10-20 07:27:53'),
(101, 'peserta', 2, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-20 08:24:47', '2025-10-20 08:24:47'),
(102, 'peserta', 2, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-20 08:24:50', '2025-10-20 08:24:50'),
(103, 'peserta', 2, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-20 08:48:17', '2025-10-20 08:48:17'),
(104, 'peserta', 2, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-20 08:48:20', '2025-10-20 08:48:20'),
(105, 'peserta', 2, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-20 08:48:27', '2025-10-20 08:48:27'),
(106, 'peserta', 2, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-20 08:50:12', '2025-10-20 08:50:12'),
(107, 'peserta', 2, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-20 08:59:04', '2025-10-20 08:59:04'),
(108, 'peserta', 2, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-20 08:59:12', '2025-10-20 08:59:12'),
(109, 'peserta', 2, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-20 08:59:33', '2025-10-20 08:59:33'),
(110, 'peserta', 2, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-20 09:12:03', '2025-10-20 09:12:03'),
(111, 'peserta', 2, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-20 09:13:01', '2025-10-20 09:13:01'),
(112, 'peserta', 2, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-20 09:22:16', '2025-10-20 09:22:16'),
(113, 'peserta', 2, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-20 09:22:19', '2025-10-20 09:22:19'),
(114, 'peserta', 2, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-20 09:36:06', '2025-10-20 09:36:06'),
(115, 'peserta', 2, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-20 09:37:19', '2025-10-20 09:37:19'),
(116, 'peserta', 1, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-20 09:37:32', '2025-10-20 09:37:32');

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `id_batch` bigint UNSIGNED NOT NULL,
  `nama_batch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id_batch`, `nama_batch`, `keterangan`, `created_at`) VALUES
(1, 'Batch 1', NULL, '2025-10-11 09:15:23'),
(2, 'Batch 2', NULL, '2025-10-20 16:10:32');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_schedules`
--

CREATE TABLE `exam_schedules` (
  `id_schedule` bigint UNSIGNED NOT NULL,
  `nama_ujian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `id_batch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_ujian` date DEFAULT NULL,
  `jam_mulai` datetime NOT NULL,
  `jam_selesai` datetime NOT NULL,
  `durasi_menit` int DEFAULT NULL,
  `status` enum('aktif','nonaktif','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `soal_ids` json DEFAULT NULL,
  `instruksi` text COLLATE utf8mb4_unicode_ci,
  `max_attempts` int DEFAULT NULL,
  `randomize_questions` tinyint(1) NOT NULL DEFAULT '0',
  `show_results_immediately` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_schedules`
--

INSERT INTO `exam_schedules` (`id_schedule`, `nama_ujian`, `deskripsi`, `id_batch`, `tanggal_ujian`, `jam_mulai`, `jam_selesai`, `durasi_menit`, `status`, `soal_ids`, `instruksi`, `max_attempts`, `randomize_questions`, `show_results_immediately`, `created_at`, `updated_at`) VALUES
(2, 'Ujian Matematika', 'Ujian untuk batch 1', '1', NULL, '2025-10-13 12:00:00', '2025-10-14 12:00:00', NULL, 'aktif', NULL, NULL, NULL, 0, 1, '2025-10-11 11:22:21', '2025-10-11 04:49:35');

-- --------------------------------------------------------

--
-- Table structure for table `face_logs`
--

CREATE TABLE `face_logs` (
  `id_face_log` bigint UNSIGNED NOT NULL,
  `id_peserta` bigint UNSIGNED NOT NULL,
  `jumlah_orang` int NOT NULL DEFAULT '1',
  `peringatan_ke` int NOT NULL DEFAULT '0',
  `detected_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` bigint UNSIGNED NOT NULL,
  `id_peserta` bigint UNSIGNED NOT NULL,
  `id_soal` bigint UNSIGNED NOT NULL,
  `jawaban_dipilih` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('benar','salah','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `nilai_essay` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` bigint UNSIGNED NOT NULL,
  `id_peserta` bigint UNSIGNED NOT NULL,
  `total_score` decimal(5,2) NOT NULL DEFAULT '0.00',
  `jumlah_benar` int NOT NULL DEFAULT '0',
  `waktu_pengerjaan` int NOT NULL DEFAULT '0',
  `status_submit` enum('manual','cheat','auto_submit') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'manual',
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
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_09_25_160410_create_users_table', 1),
(4, '2025_09_25_160423_create_peserta_table', 1),
(5, '2025_09_25_160435_create_soal_table', 1),
(6, '2025_09_25_160512_create_jawaban_table', 1),
(7, '2025_09_25_160523_create_laporan_table', 1),
(8, '2025_09_25_160527_create_face_logs_table', 1),
(9, '2025_09_26_024715_create_activity_logs_table', 1),
(10, '2025_09_26_031514_create_sessions_table', 1),
(11, '2025_10_09_030706_add_status_to_peserta_table', 1),
(12, '2025_10_09_064919_add_id_ujian_to_soal_table', 1),
(13, '2025_10_09_083925_add_email_to_peserta_table', 1),
(14, '2025_10_09_090058_add_question_fields_to_soal_table', 1),
(15, '2025_10_09_090516_modify_jawaban_benar_column_in_soal_table', 1),
(16, '2025_10_10_031117_add_batch_to_peserta_table', 1),
(17, '2025_10_11_000001_create_batch_table', 1),
(18, '2025_10_11_000002_create_ujian_table', 1),
(19, '2025_10_11_000003_create_sesi_ujian_table', 1),
(20, '2025_10_11_084717_add_security_columns_to_users_table', 1),
(21, '2025_10_11_091739_add_security_columns_to_peserta_table', 2),
(22, '2025_10_11_105530_create_exam_schedules_table', 3),
(23, '2025_10_11_124659_create_sesi_ujian_table', 4),
(24, '2025_10_13_112107_create_settings_table', 5),
(25, '2025_10_14_062510_rename_password_to_kode_akses_in_participants_table', 6),
(27, '2025_10_14_093518_fix_nomor_urut_default_value_in_peserta_table', 7),
(28, '2025_10_15_120748_add_missing_fields_to_soal_table', 8),
(29, '2025_10_16_004849_remove_comments_from_soal_table', 9),
(30, '2025_10_16_011843_remove_id_peserta_from_soal_table', 10),
(31, '2025_10_16_013326_remove_kategori_from_soal_table', 11),
(32, '2025_10_16_014203_remove_status_from_soal_table', 12),
(33, '2025_10_16_161731_remove_id_ujian_from_soal_table', 13),
(34, '2025_10_16_162630_add_mata_pelajaran_to_sesi_ujian_table', 14),
(35, '2025_10_17_013632_add_deskripsi_to_sesi_ujian_table', 15),
(36, '2025_10_08_023932_update_users_role_enum', 16);

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` bigint UNSIGNED NOT NULL,
  `nomor_urut` int NOT NULL DEFAULT '0',
  `nama_peserta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `login_attempts` int UNSIGNED NOT NULL DEFAULT '0',
  `locked_until` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_peserta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_akses` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal_smk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aktif','tidak_aktif','berlangsung','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `nomor_urut`, `nama_peserta`, `email`, `last_login_at`, `login_attempts`, `locked_until`, `remember_token`, `kode_peserta`, `kode_akses`, `asal_smk`, `jurusan`, `batch`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Test Update', 'test@update.com', '2025-10-20 09:37:32', 0, NULL, 'U3owWULl5HPWbiWk0Dm4TStvN2RuM1AnpwQ5qMVsHiBYAR2Ik7A4Zl4BVPQeNYxM', 'RK00111', '123456', 'SMK Test Update', 'Teknik Informatika Update', 'Batch 1', 'aktif', '2025-10-11 02:19:06', '2025-10-20 09:37:32'),
(2, 2, 'Yusuf Maulana Updated', 'ymchannel35@gmail.com', '2025-10-20 09:36:06', 0, NULL, 'PnMGDhEZuFAv6opXHxYKf2BYCSZpiQZie90ugMxqSeJLJ5xhfcahU7YZ8asiVbsW', 'RK00002', '123456', 'SMK KARAWANG 1', 'Teknik Informatika', 'Batch 2', 'aktif', '2025-10-14 02:42:38', '2025-10-20 09:36:06');

-- --------------------------------------------------------

--
-- Table structure for table `sesi_ujian`
--

CREATE TABLE `sesi_ujian` (
  `id_sesi` bigint UNSIGNED NOT NULL,
  `id_ujian` bigint UNSIGNED NOT NULL,
  `id_batch` bigint UNSIGNED NOT NULL,
  `mata_pelajaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `tanggal_mulai` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `durasi_menit` int UNSIGNED DEFAULT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sesi_ujian`
--

INSERT INTO `sesi_ujian` (`id_sesi`, `id_ujian`, `id_batch`, `mata_pelajaran`, `deskripsi`, `tanggal_mulai`, `jam_mulai`, `jam_selesai`, `tanggal_selesai`, `durasi_menit`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Matematika', 'keren', '2025-10-17', '12:00:00', '13:00:00', '2025-10-18', 60, 'aktif', '2025-10-13 02:34:00', '2025-10-16 18:49:30'),
(2, 2, 1, 'Matematika', 'jgjgj', '2025-10-20', '20:00:00', '17:00:00', '2025-10-21', 70, 'aktif', '2025-10-16 10:16:57', '2025-10-20 08:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('7iDA57Dt4ItzAibmFFU31gCzFaATd02JEOuXuxzU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo4OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im5ldyI7YTowOnt9czozOiJvbGQiO2E6MDp7fX1zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozOToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3N0dWRlbnQvZXhhbS9kYXRhIjt9czo2OiJfdG9rZW4iO3M6NDA6ImtYU3kxMktoMmlSV0VzRnhFS3laSmdEY25ndXZVM2hNUElWa2txR1giO3M6NzoidXNlcl9pZCI7aToyO3M6OToidXNlcl90eXBlIjtzOjc6InBlc2VydGEiO3M6OToidXNlcl9uYW1lIjtzOjIxOiJZdXN1ZiBNYXVsYW5hIFVwZGF0ZWQiO3M6OToidXNlcl9jb2RlIjtzOjc6IlJLMDAwMDIiO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6IkFWNWhkenExU0hnVFltTnhzajdnYW9sRTZFOWxscDFiM1pxOHdIS2h1RW95TnpUVXVyN2JzdW55d2o5WWdDcDQiO30=', 1760977342),
('81omFgBFQwhPQKVXo3A4wnrYJvIqdpngHLAGOnXh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidjBwM1ZJYTBkaW55VXdPN2t3SVpWY3A1cWpBRXdFTTVhSlBFdFhSMCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1760970108),
('wBxRJv2YTmxhkMyaIKVSP77wIIpjQvRS8kd4mDoq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiYkJ1cWxibjV6bXBCSXRFSmhEWDNmSWs5eEc0MDcxTW1BYkFXZWtLWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wYXJ0aWNpcGFudHMvZGF0YSI7fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6InR0dWxYT0FtSUpGTE1TQjZraFpsdDNOOEpZS1ozRW03T1E5SVFaME9mRDRabjE2U3ZmMG9WN1dIRXVndVQwT1IiO30=', 1760977384),
('WRvok9M13Y2wc2uVrHIfRMSUmfIjqYjConR6nDqv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo4OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im5ldyI7YTowOnt9czozOiJvbGQiO2E6MDp7fX1zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo1ODoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3N0dWRlbnQvZXhhbS8yL3F1ZXN0aW9ucy1jb21wb3NpdGlvbiI7fXM6NjoiX3Rva2VuIjtzOjQwOiJBTkdLbEM3WE9yM0tUdXI0WnA5VmZ5VHhaSXlwbGs5SEUxend4UDNsIjtzOjc6InVzZXJfaWQiO2k6MTtzOjk6InVzZXJfdHlwZSI7czo3OiJwZXNlcnRhIjtzOjk6InVzZXJfbmFtZSI7czoxMToiVGVzdCBVcGRhdGUiO3M6OToidXNlcl9jb2RlIjtzOjc6IlJLMDAxMTEiO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6IlUzb3dXVUxsNUhQV2JpV2swRG00VFN0dk4yUnVNMUFucHdRNXFNVnNIaUJZQVIySWs3QTRabDRCVlBRZU5ZeE0iO30=', 1760979937);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `category` enum('general','exam','security','notification','email','system') COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('string','integer','boolean','json','array') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT '0',
  `is_encrypted` tinyint(1) NOT NULL DEFAULT '0',
  `validation_rules` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id_soal` bigint UNSIGNED NOT NULL,
  `batch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pertanyaan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mata_pelajaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level_kesulitan` enum('mudah','sedang','sulit') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sedang',
  `tipe_soal` enum('pilihan_ganda','essay','benar_salah') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pilihan_ganda',
  `opsi_a` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_b` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_c` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_d` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_e` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opsi_f` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jawaban_benar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `umpan_balik` text COLLATE utf8mb4_unicode_ci,
  `poin` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `batch`, `pertanyaan`, `mata_pelajaran`, `level_kesulitan`, `tipe_soal`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `opsi_f`, `jawaban_benar`, `umpan_balik`, `poin`, `created_at`, `updated_at`) VALUES
(1, 'Batch 1', 'Kenapa Indonesia Bisa Maju', 'Matematika', 'sedang', 'pilihan_ganda', 'Karena ALLAH', 'Karena Yusuf', 'Karena Prabowo', 'Karena Purbaya', '', '', 'a', 'keren', 20, '2025-10-13 06:06:40', '2025-10-15 18:49:22'),
(3, 'Batch 1', 'INDONESIA EMAS KAPAN?', 'MATEMATIKA', 'sedang', 'pilihan_ganda', '1945', '1978', '1966', '2045', '1111', '3131', 'd', 'dfds', 10, '2025-10-15 06:10:56', '2025-10-15 17:42:18'),
(4, 'Batch 1', 'sdad', 'IPA', 'sedang', 'pilihan_ganda', 'asd', 'asdas', 'asda', 'sdad', 'asdas', 'asdas', 'a', 'wow', 10, '2025-10-15 18:23:11', '2025-10-15 19:16:18'),
(10, 'Batch 1', 'Apa ibukota Indonesia?', 'Geografi', 'sedang', 'pilihan_ganda', 'Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Semarang', 'Yogyakarta', 'a', 'Ibukota Indonesia adalah Jakarta', 10, '2025-10-15 19:57:49', '2025-10-15 19:57:49'),
(11, 'Batch 1', '2 + 2 = ?', 'Matematika', 'sedang', 'pilihan_ganda', '3', '4', '5', '6', '', '', 'b', 'Hasil penjumlahan 2 + 2 adalah 4', 10, '2025-10-15 19:57:49', '2025-10-15 19:57:49'),
(12, 'Batch 2', 'Jelaskan proses fotosintesis', 'Biologi', 'sedang', 'essay', '', '', '', '', '', '', 'Fotosintesis adalah proses dimana tumbuhan menggunakan cahaya matahari, air, dan karbon dioksida untuk membuat glukosa dan oksigen.', 'Fotosintesis adalah proses pembuatan makanan oleh tumbuhan', 15, '2025-10-15 19:57:49', '2025-10-15 19:57:49'),
(13, 'Batch 2', 'Jelaskan kelebihan dan kekurangan sistem operasi Windows', 'Teknologi Informasi', 'sedang', 'essay', '', '', '', '', '', '', 'Windows memiliki kelebihan: user-friendly, kompatibilitas software tinggi, dukungan hardware luas. Kekurangan: rentan virus, lisensi berbayar, resource usage tinggi.', 'Windows memiliki kelebihan user-friendly tetapi rentan virus', 15, '2025-10-15 19:57:49', '2025-10-15 19:57:49'),
(14, 'Batch 1', 'Siapa presiden Indonesia?', 'Pendidikan Kewarganegaraan', 'sedang', 'pilihan_ganda', 'Joko Widodo', 'Prabowo Subianto', 'Megawati', 'Susilo Bambang Yudhoyono', '', '', 'a', 'Presiden Indonesia saat ini adalah Joko Widodo', 5, '2025-10-15 19:57:49', '2025-10-15 19:57:49');

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` bigint UNSIGNED NOT NULL,
  `nama_ujian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mata_pelajaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ujian`
--

INSERT INTO `ujian` (`id_ujian`, `nama_ujian`, `mata_pelajaran`, `deskripsi`, `created_at`) VALUES
(1, 'as', 'Ujian Online', 'asd', '2025-10-13 09:34:00'),
(2, 'Ujian Matematika', 'Matematika', 'keren', '2025-10-16 17:16:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','staff') COLLATE utf8mb4_unicode_ci DEFAULT 'admin',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `login_attempts` int UNSIGNED NOT NULL DEFAULT '0',
  `locked_until` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `last_login_at`, `login_attempts`, `locked_until`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@ujianonline.com', '2025-10-11 02:06:38', '$2y$12$kvFYIv.vVY8SeJhMHShqSumhYSbwLMvqSfmR/QnJzK25TanJtM5i2', 'admin', NULL, '2025-10-20 05:22:03', 0, NULL, '2025-10-11 02:06:38', '2025-10-20 05:22:03'),
(4, 'Guru Bahasa Indonesia', 'guru.bahasa@ujianonline.com', '2025-10-11 02:06:39', '$2y$12$Mylz6kwXUD02GcHbku6yN.RzDDWzkf7VXDMLdqYz8P/ScBWOyoRaO', 'staff', NULL, NULL, 0, NULL, '2025-10-11 02:06:39', '2025-10-11 02:06:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_type_user_id_index` (`user_type`,`user_id`),
  ADD KEY `activity_logs_action_created_at_index` (`action`,`created_at`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`id_batch`),
  ADD UNIQUE KEY `batch_nama_batch_unique` (`nama_batch`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `exam_schedules`
--
ALTER TABLE `exam_schedules`
  ADD PRIMARY KEY (`id_schedule`),
  ADD KEY `exam_schedules_status_index` (`status`),
  ADD KEY `exam_schedules_tanggal_ujian_index` (`tanggal_ujian`),
  ADD KEY `exam_schedules_jam_mulai_jam_selesai_index` (`jam_mulai`,`jam_selesai`);

--
-- Indexes for table `face_logs`
--
ALTER TABLE `face_logs`
  ADD PRIMARY KEY (`id_face_log`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD UNIQUE KEY `peserta_kode_peserta_unique` (`kode_peserta`);

--
-- Indexes for table `sesi_ujian`
--
ALTER TABLE `sesi_ujian`
  ADD PRIMARY KEY (`id_sesi`),
  ADD KEY `sesi_ujian_id_ujian_index` (`id_ujian`),
  ADD KEY `sesi_ujian_id_batch_index` (`id_batch`),
  ADD KEY `sesi_ujian_status_index` (`status`),
  ADD KEY `sesi_ujian_tanggal_mulai_tanggal_selesai_index` (`tanggal_mulai`,`tanggal_selesai`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id_ujian`),
  ADD KEY `ujian_mata_pelajaran_index` (`mata_pelajaran`),
  ADD KEY `ujian_nama_ujian_index` (`nama_ujian`);

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
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `id_batch` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exam_schedules`
--
ALTER TABLE `exam_schedules`
  MODIFY `id_schedule` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `face_logs`
--
ALTER TABLE `face_logs`
  MODIFY `id_face_log` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sesi_ujian`
--
ALTER TABLE `sesi_ujian`
  MODIFY `id_sesi` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sesi_ujian`
--
ALTER TABLE `sesi_ujian`
  ADD CONSTRAINT `sesi_ujian_id_batch_foreign` FOREIGN KEY (`id_batch`) REFERENCES `batch` (`id_batch`) ON DELETE CASCADE,
  ADD CONSTRAINT `sesi_ujian_id_ujian_foreign` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
