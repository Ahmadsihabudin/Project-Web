-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 20, 2025 at 12:13 PM
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
(92, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', '2025-10-20 02:35:16', '2025-10-20 02:35:16');

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
(1, 'Batch 1', NULL, '2025-10-11 09:15:23');

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
(1, 1, 'Ahmadd', 'ahmadd.rizki@smkn1.sch.id', '2025-10-16 21:24:01', 0, NULL, 'E5ArQb5GUWGA040AN9YWZh594HQTxFZmnHYEPruB7cySpwtdmB0mWwhl4njB9TR9', 'RK00111', '123456', 'SMK Negeri 1 Jakarta', 'Teknik Komputer dan Jaringan', 'Batch 1', 'aktif', '2025-10-11 02:19:06', '2025-10-16 21:24:01'),
(2, 2, 'Yusuf Maulana', 'ymchannel35@gmail.com', NULL, 0, NULL, NULL, 'RK00002', '123456', 'SMK KARAWANG 1', 'Teknik Informatika', 'Batch 1', 'aktif', '2025-10-14 02:42:38', '2025-10-14 02:42:38');

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
(2, 2, 1, 'Matematika', 'jgjgj', '2025-10-17', '20:00:00', '17:00:00', '2025-10-18', 70, 'aktif', '2025-10-16 10:16:57', '2025-10-16 18:42:20');

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
('0DDQlXmCg6MsDV2UluWP8BpFvj2gRxI96WbNtHGO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiWk9jUDk2VzFCSEc2OVl1bDZkUlZFa09tdFFKSWhRY0VTRW5tTXA1NCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9xdWVzdGlvbnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjc6InVzZXJfaWQiO2k6MTtzOjk6InVzZXJfdHlwZSI7czo1OiJhZG1pbiI7czo5OiJ1c2VyX25hbWUiO047czoxMDoidXNlcl9lbWFpbCI7czoyMToiYWRtaW5AdWppYW5vbmxpbmUuY29tIjtzOjEzOiJzZXNzaW9uX3Rva2VuIjtzOjY0OiJYVVFabkJ4WEJkdndpVjAxUVBHanZKdHNMZnJ6akR4dTlad24yVjA3RllRaEtBYU1DVmZ6YVlhbzVYbW42ZFR4Ijt9', 1760950556),
('0TjAbTyM8Df8RoSQ6qenxIWDYtxQYZOQ5DvWOW7I', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiOTlqeDlyZE1JdklxZDZqOFViU3B1OUN1ak9DZW0wMUJnRWxjRHNEbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9wYXJ0aWNpcGFudHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjc6InVzZXJfaWQiO2k6MTtzOjk6InVzZXJfdHlwZSI7czo1OiJhZG1pbiI7czo5OiJ1c2VyX25hbWUiO047czoxMDoidXNlcl9lbWFpbCI7czoyMToiYWRtaW5AdWppYW5vbmxpbmUuY29tIjtzOjEzOiJzZXNzaW9uX3Rva2VuIjtzOjY0OiJrcXlpb3FPaWQzNTdPWldGanZ5eDF0eVBPOVJhSThYR1F0U1BHb2ppZGRlMlZjblhhN0lGSzdOTExkSDB3eVg4Ijt9', 1760951385),
('10tx1gxm60CbC2DDlnxIy4krQkSu0vh1I7RmtL6N', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiajNKbVZBMFpRWHNncm1JZTJCQTJKVkU0OFl6N1EyaWh1TmlBUWpiTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9zZXR0aW5ncyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6Ilh4VTU3WmlOMUJFUllGQTJtTjRSTzlYbEtrZXdaYzFuMUlmTW9DWUxGZzhsaDlWREw2emxnNTFqTk4xSms0MVYiO30=', 1760950514),
('1NfWDTk4eUSSmEpdLU8l9VRKkB0NoN1xHNR47ndD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoicjN6elhhbmdjUlllc1hXTW1DVE5iRTlnU2FoTHFxRFJWb2s3aUFWbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi91c2Vycy9kYXRhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c2VyX2lkIjtpOjE7czo5OiJ1c2VyX3R5cGUiO3M6NToiYWRtaW4iO3M6OToidXNlcl9uYW1lIjtOO3M6MTA6InVzZXJfZW1haWwiO3M6MjE6ImFkbWluQHVqaWFub25saW5lLmNvbSI7czoxMzoic2Vzc2lvbl90b2tlbiI7czo2NDoiWXRia1hrOE5HZ0Z4b3dNUjh1SEpmM3JWYWRPa0Z6SVV6ZXBrbXZldzlKdXE4djJoUlFoMlJZUmVnUlNyUHVncCI7fQ==', 1760951070),
('2TNTRxSNH1pZd13xy4NiILx7IDemBDItBmew5nDK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiMmtoVWJvZ21iQzh5Mzc4MVFNU0JoNGtrM0pudlo5SE9KODlSVXU1OCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9xdWVzdGlvbnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjc6InVzZXJfaWQiO2k6MTtzOjk6InVzZXJfdHlwZSI7czo1OiJhZG1pbiI7czo5OiJ1c2VyX25hbWUiO047czoxMDoidXNlcl9lbWFpbCI7czoyMToiYWRtaW5AdWppYW5vbmxpbmUuY29tIjtzOjEzOiJzZXNzaW9uX3Rva2VuIjtzOjY0OiJNM2thNDJEZjlIUWsyQTV2RXhSQldwM1IxMkhybWtXaWs2NTRKNFRLWW1VQ3NSWW5BbW53YkIxRlRzaXdUS1FYIjt9', 1760950476),
('3SasssNhCFdkfI1iLLb9JZnLIabh900SREKUcaPM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiWDU1SXdWbVJmVWt5ZkNnRXdYNVlWU2dMQXdYUTNha2JBRjMyUVg5SyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9xdWVzdGlvbnMvZGF0YSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6InlxYW9VTGdleGUzTWJEQkNnRm5CUVh2T3h3NmxTWmhQOTBXNWM4anNtV2d6OVo4UmFva1BHNjJZUTA1cjhhS28iO30=', 1760948152),
('3VDPzPIP9u1nI6rqNw8CQmmlWb8SsShw3Ogg4DRt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoicmUzMUpIUHp0YzQ1S0d3VFdZWlo5T05UNTdZakhFZExXWWpSaGhtWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9zZXR0aW5ncyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6IjM2UE54MlZtRXFEa2RXSms4YW9sTGZLTUNXWE9XUno0aU5vMmRVOWdwNGNGQ25JUVBJdUYzOFNqVkFhZGI1dEEiO30=', 1760949747),
('4s8AlWFr9EPWBDUKB7q2i1klhUjfTIrhCx1zBn16', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiZHhYaXVRUDlvWkR3dVBMamRmTkt6YUxIZEJ5cGlQRVE2YmtKV0ZBYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9wYXJ0aWNpcGFudHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjc6InVzZXJfaWQiO2k6MTtzOjk6InVzZXJfdHlwZSI7czo1OiJhZG1pbiI7czo5OiJ1c2VyX25hbWUiO047czoxMDoidXNlcl9lbWFpbCI7czoyMToiYWRtaW5AdWppYW5vbmxpbmUuY29tIjtzOjEzOiJzZXNzaW9uX3Rva2VuIjtzOjY0OiJxbWJqZjVXRkw3clEwZERSUnUyYm5BbFpPVFZQSmVMVFZnM1VsekpmVEl2MnVWR0o2ekRpZGEwU3QxczJWMTFQIjt9', 1760950970),
('81GZhjBibWQDWWHYwvLGRTc2kzDcwJJutm4kC6xb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaDNNQ2toSlIwaDFJenpRMUw3aFhrT1V5V0Y4YjRicXZDT01sbmRCMiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1760952611),
('8gEAEsBI5BFcR7j5pEpTHMaODkmfRpvhtcHAbvBZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNk12cWh5ZXNIck5ETWRqSEk5U0dZUnhkSnZBeU9lWnA4VFFab201bSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1760952905),
('8sbK6oUwRThH0hzzfRRdCzaxaygaSQjwgVh66Qvl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoia0lQRVdzRjhvMXl3V1I5RzhCUkwzWWlRWmJKT1FRbmdxZDhDeGR0VCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9kYXNoYm9hcmQvZGF0YSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6IkxYMGhWVExjY0hWeTVSbzVwa05zSVU3OGtqNzBkWXVMZEFUblR1NUxuQlFzSncxYUFrR1VZY3JsTUFGMEpsUWgiO30=', 1760947654),
('9dWYE7uZTR2TwuD9eabRCTKVGz9lLSOPw44zSoRj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiZGh3cm55OVFuRkFibmlmMDFyYnBZbXltNVBpaDI4N0ZyeGlKWUpIaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi91c2VycyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6IkFxOWZGNFlrRjVyWDdoa0lRaXh4YTFiWU9UQ3ZSeUFXNDVJWTJqMkNRRlY5SE1Zb2NEb2pxZGZDWlNuNlNnMGkiO30=', 1760951452),
('AyhPw2VAsPVQkSCYdT9WAk9Hd2p0Se4kOObN1MQs', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRmN1empKdXpuTlNNalBhVGtFZ0JMMXlSVk0yNTh4QlBRODdERHREYiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1760952236),
('BHltyTk7NUESbRtJICRx1w1pFJ91cYDrS8fnVoAx', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiNWQzTkhZTHFZMlp3emNlZnhLbmpHRWFGSzd0dlN2YmNESEVpUFFvRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9wYXJ0aWNpcGFudHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjc6InVzZXJfaWQiO2k6MTtzOjk6InVzZXJfdHlwZSI7czo1OiJhZG1pbiI7czo5OiJ1c2VyX25hbWUiO047czoxMDoidXNlcl9lbWFpbCI7czoyMToiYWRtaW5AdWppYW5vbmxpbmUuY29tIjtzOjEzOiJzZXNzaW9uX3Rva2VuIjtzOjY0OiJKcUJsRGM5WE5TWkc3R0pBYm5hV3daMWhNaHdUdTRGTTJ4OUMzUktRWE9zVUdtd2czSmNzc25ja1MwYU5QelNtIjt9', 1760951040),
('BzOOxBxP8hhpBxUT8XNlDRgUthRQYASVEOPsrGpw', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiYmZtOFRHMXJ6ZFhLZ0ZoSXdGWmpHa2dySzV4ZUw3T1pKVDhuTmV3YSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9xdWVzdGlvbnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjc6InVzZXJfaWQiO2k6MTtzOjk6InVzZXJfdHlwZSI7czo1OiJhZG1pbiI7czo5OiJ1c2VyX25hbWUiO047czoxMDoidXNlcl9lbWFpbCI7czoyMToiYWRtaW5AdWppYW5vbmxpbmUuY29tIjtzOjEzOiJzZXNzaW9uX3Rva2VuIjtzOjY0OiJMWTZuVmxUendjdER3OExGTzNVQVVZbUxTclZ5ZURSVEFMQm9Oakd5Y3VjTmlyYWQyWkU0Q1llOW8wc1ZDbWkzIjt9', 1760951659),
('EFN8b2eNbXHRIa2e2IeHhqI5wtr8AT3KnYY9MbEk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiSXJmdWxWMEtERGpYd3pqOEFZaHZYWko5QVd6OWFEcTJKaGJ0WVJjeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9kYXNoYm9hcmQvZGF0YSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6ImFaNkFMZkhSdWZvUnB3SWc0OXV1NXFPTHZ1U01Cc1hhS3EzcnZsa0VOWFVHdHZ6V0hWMW9wSWJnazR2SlhqNkIiO30=', 1760947597),
('eXFZ4pKYdeWXxjkdaMNC9hls8ijSifHASgSSBhHV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY2dxR2pRV09mdWlxeVFWMEFtVnlONkpYMVZIUU8xdHhSYXpvYUtkTyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1760952544),
('F1KcMlrlfu1uOi6yLhW2uOzDZka1m8yIvYMh785l', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiUTNxMmFINVAzZzlURHNBOVpvZUxwMU04UXNFQm9EanJYWnVqUlZPZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9zZXR0aW5ncyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6IkZpRU1EWjJ3VHZVT2VnaVo3bmJPUzRrU0JYTzNURWExYjlTSUVVMmI1VVhaSEZKb2hUNkVocnpqU05RYTQzR1QiO30=', 1760952205),
('fbY1v6eTcOqPmt7MUSvdkpOYvERgImt4b9vNsPGp', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoieHdiV1JDRW5GTExybWZRZ2lCZ0VucWNHOUczZWlmemlVckFFOHk3QiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9wYXJ0aWNpcGFudHMvZGF0YSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6IjVXUE5sN2F4Slh4VDZ2U3pVOHlxbzZNalRFT1N1ZEZyS09HaXQ2UFVCaXhmeWdadjBXRGJqczlWQ0lOUDNYaG0iO30=', 1760950921),
('FyhJun0ce20BbwPoyWveGlR0yZmnscxmL7Jp6xT8', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZGE2Vm01YVgzeEZPbjhWOFVvdGhJV0l5ckNITlM4bHV2Ymxra2k2UiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1760952927),
('hHENbvZPCsisKK472OmdAs5xAeppp3Owm8gOChd2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiS0JRUFdiZ01kWXAxQ0tPeFFFc3lUVHVoQTdaaDdRVEFaelF0bEJSYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9xdWVzdGlvbnMvZGF0YSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6InhxY09QNDdSNUZKRG1PNDRLYTJkdHRKUUpVUVM0cmNIMTB3dkR4bDN4SnNjdEFZWlNRWjBiSHhEZzBiOFVXQzEiO30=', 1760953357),
('hIU3XT6gaftnQPniFHXII7Q9SfXXfBSL8ROsjOIE', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia0RXWWdMMG9UYVlCYW9hZDhYbFF6TXVxUkhYS3kxNktZTnl4WVJoRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1760952610),
('HUdW7vrEGWxukzT2sXCKBk4FIdPSsG2KIbst8v4q', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiZUJvSmtjZk0ySGpaYzJFU2NYMndnRzZqRGVlVTBLMlJOblZ2aUVkTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9wYXJ0aWNpcGFudHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjc6InVzZXJfaWQiO2k6MTtzOjk6InVzZXJfdHlwZSI7czo1OiJhZG1pbiI7czo5OiJ1c2VyX25hbWUiO047czoxMDoidXNlcl9lbWFpbCI7czoyMToiYWRtaW5AdWppYW5vbmxpbmUuY29tIjtzOjEzOiJzZXNzaW9uX3Rva2VuIjtzOjY0OiJrcjRIRTJ2Yms4dUJIdEJqNDJzMWkwdFNBR3JUakd6WUhoNEtWT0dlRmpDVEN5TmpwWHBWUDVSc3JSTUN5NDRsIjt9', 1760950907),
('J2xmfvDQABop6JAhSCQkoapBBJdlpTzO5JQX8TTZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiNU1Gc2p1b3M5c21OenpEMDlLN21hU0xIYlpHcm9BUUdqRjB6VFZRTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9xdWVzdGlvbnMvZGF0YSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6IjE0QkZIakNmYTVYOGYxaXBpcG5vcUczc1dzekNUR1JKb1Rkd3BmRkpUakl6QW1oczRvT043ZXVMUkFUVHliQ1QiO30=', 1760948060),
('JcxbwCsLcHWZZu0WXGLT6AqZZj1SeIi0HpWHYMOq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiOEhaem1wN0JXdUx2QUhTOGFmdGFHc2hjTlVvUkV5Rjk1ZEgyOGN2NiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9xdWVzdGlvbnMvZGF0YSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6IkplNlh2bjNNcGFQTm1jRFVWR1c2cVkycjUxQzJ5b3ZhSjRTMjFDdnZ4OEpSSjF3WUVNb29jeHQ5VkNYNUczd04iO30=', 1760948114),
('kX5lRLVYOPyhQPW65AasJOm7UEuyb1KFr0hrSzxo', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiVzlrUm9VTHU3TkJTVTh3eDBOY0g0ZmUwODVNd1BCQjlhVEEyZ3RobSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9xdWVzdGlvbnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjc6InVzZXJfaWQiO2k6MTtzOjk6InVzZXJfdHlwZSI7czo1OiJhZG1pbiI7czo5OiJ1c2VyX25hbWUiO047czoxMDoidXNlcl9lbWFpbCI7czoyMToiYWRtaW5AdWppYW5vbmxpbmUuY29tIjtzOjEzOiJzZXNzaW9uX3Rva2VuIjtzOjY0OiJCaG9NeTB4SVU1ajZ2dlhaMzBpTEVpWXMzS3YzTURscFZKb3VkR2dwTWhlOFJKbWJrZ2s0cHpQNFJQOEd0eGVsIjt9', 1760950444),
('l0wMVVg8N9OdHO0HXfAiyegFeP7FbFx5iyRRhJpd', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYUtRY0lNOHVSMGIzNldiN21hNk1XYlM5YmlpaWhEckRuUHJGaFNzWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1760945612),
('l3HhQAGRCYRYcTCpkueLqbdzwgeOLtmGgnu7kvhs', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWGN3VjMwdno2Nmxwd3VhWnlJZ2dLY1paOERwWjN6a1dkVUdUWGFTTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1760945565),
('lSG1OksfyjXHx2kFQsIErhFfVYa1kkEK3YoNYePe', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiamxISHQ0RjdydFFXR3RyRTJIdkNHYjFqVmNZQ3U4djBWNW1lTlQyRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9zZXR0aW5ncyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6IjNia2ZYT2s5cXNoN1Q3dVFHdG5ka0xZb0FFbXZMOExqOWFZQktnbUgzQm81QzlYY0s3MzRsREs3YUowTkRaR1EiO30=', 1760949605),
('lxUDOJ8haje1wZxKQR0nXUSsI5e5uL813IDHx8wb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoicHdoSE11MlRxcU5RSExmb2xIbUkwTm1xZUI0N2FPaHI2YmVzNDJUNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9kYXNoYm9hcmQvZGF0YSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6IlNZS2pjbGVIaXlVY1Y0ZXJycDFLVUg3M1hpakpkZU1nR2plY0kwbnVhOTVFYTF2TkE3NHlUTExvVTZMb2ExZGUiO30=', 1760947706),
('mYeb37wxbFsy5Ya0HrceLzmiuRRyOSQ703OfSo8r', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiUDhHRHRNNXdEQlQzc0wzWEo0MHhOVzlxQ0ZYdFkxdno1MDZuT1BnZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9wYXJ0aWNpcGFudHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjc6InVzZXJfaWQiO2k6MTtzOjk6InVzZXJfdHlwZSI7czo1OiJhZG1pbiI7czo5OiJ1c2VyX25hbWUiO047czoxMDoidXNlcl9lbWFpbCI7czoyMToiYWRtaW5AdWppYW5vbmxpbmUuY29tIjtzOjEzOiJzZXNzaW9uX3Rva2VuIjtzOjY0OiJHR3BBdk14THY1QXN4NGt6QW85QUJtbVpaZWQ5SjVQY0tOZVVTSUdLZDY1WHVTekVyZ05LdTloaFRkdURpNHltIjt9', 1760950312),
('ndncyFdnf0sEf7j9zHTGZSnenwvAZ0Duam7zWEjt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoibm0zdVo0RzRLMEhRY3M4RDF3OTlVOVBQdWVFNGFhdjhldVd4VG5hTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9zZXR0aW5ncyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6IjNUTHZ6NXNFOG41VWUzdGJWUjZOS2FNZnJwQ2NKYUw4ZDBzNm9tcU1yck45Y2NRTUliS0FKbFJVQlNNbXEyZG4iO30=', 1760950580),
('oMmrCAb5rL0c5IUuZQmKtDZeIlfNrknfswwlffke', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoicXJWNHdZeHBUNW5zMDF6R1luNFJzdEZ4YzhjR0czaU9lbTJzaG5BbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9xdWVzdGlvbnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjc6InVzZXJfaWQiO2k6MTtzOjk6InVzZXJfdHlwZSI7czo1OiJhZG1pbiI7czo5OiJ1c2VyX25hbWUiO047czoxMDoidXNlcl9lbWFpbCI7czoyMToiYWRtaW5AdWppYW5vbmxpbmUuY29tIjtzOjEzOiJzZXNzaW9uX3Rva2VuIjtzOjY0OiJKR0xWQ1N4UUtiQjNndlh2Vm5NT1pSdzc4ZzNOSFY0b2djbGpMeE12bm1FeXVnVkpyZE9ETjRmOFM1U2kydk80Ijt9', 1760950404),
('pe9WLbsNRL1eEHVnsNuonFtSeGAT5zzRQHGLPuOo', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiT2tQd3o0UTlzcFFTdXJ2QTcwQ2d4RGVCQzRtY3JKQW1OTnZGQ3IxTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi91c2Vycy9kYXRhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c2VyX2lkIjtpOjE7czo5OiJ1c2VyX3R5cGUiO3M6NToiYWRtaW4iO3M6OToidXNlcl9uYW1lIjtOO3M6MTA6InVzZXJfZW1haWwiO3M6MjE6ImFkbWluQHVqaWFub25saW5lLmNvbSI7czoxMzoic2Vzc2lvbl90b2tlbiI7czo2NDoiYjI5SXBVcWxpMzlCbmh1aUlRZTVzWndoTUF5OElvNmtxUzFwc3RWamhRWmZvVW1OSkVKcnAzaEM0SGJaTGNVViI7fQ==', 1760948002),
('pxUZ8oPQIvTnpEk3aMyk7k9byuD604m277osTaqP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoibXZHSkx2S3RlY2dEdlhUeDh5VjV0SXRBZVltZjJERVRMQkxWYWZ4RCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi91c2VycyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6InBCREZzMUcxS2FWR2xabWNYelphYThBUnJORGVmcldpRFhtZTV3V3BtbGF3eUZnNkN4aFBDWTU3ODltUzVDZWgiO30=', 1760951407),
('pZk8SRgMjAV6B8qWqxnWXHMKSAqAvtk2JXCiUmNP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiaUg1Z1k0TDN1dFF3OU9ITjJkSkVIUURTS1dRSGpzc3c5UjRKeTFaeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi91c2VycyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6InZjN1ZTeGt6cEM3UFF0ajRVQlRNR1ZQbFFtd2Q3Z0ZSd0xmbXRKNHJxZXZLQmxUWEpMYUc3bTZabDFIeDFFSnEiO30=', 1760951054),
('QdATTmc6tNOhpD4j2GLmjujebzIOjwOYBTysJ5XU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidmJmQkhFdWlUa2xBWm1nTWo4d0ZsWDMzYzF3SnQwRmxJeFAxcDRGZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1760952234),
('QRhnWVqPiOMKk0zteywNuiSr69y2bqhwlyzCg7pw', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiRndmYWVzaVNiSGc5akRUMFlwQTI4UmRjSGR0TTV2bjlicXNiSWRrWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi91c2Vycy9kYXRhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c2VyX2lkIjtpOjE7czo5OiJ1c2VyX3R5cGUiO3M6NToiYWRtaW4iO3M6OToidXNlcl9uYW1lIjtOO3M6MTA6InVzZXJfZW1haWwiO3M6MjE6ImFkbWluQHVqaWFub25saW5lLmNvbSI7czoxMzoic2Vzc2lvbl90b2tlbiI7czo2NDoiRnFLU0tNSm1uaUdoclpWS2dIWnBzUDdZT3ZwV0IzNHdoYUJsMnI5Y01iT0Nza1BReGk2UzE3WXh2Zm1JQ0pESCI7fQ==', 1760951596),
('QVebm6mVEiJk6qnLGpdgagSVPtdWxFJRsYNO1zJ6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoid0hJZnRBRk8xVE9QRkt0UXFNcWg5Vkd4YXlMU0pyZW5MRzRVTmRzdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9wYXJ0aWNpcGFudHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjc6InVzZXJfaWQiO2k6MTtzOjk6InVzZXJfdHlwZSI7czo1OiJhZG1pbiI7czo5OiJ1c2VyX25hbWUiO047czoxMDoidXNlcl9lbWFpbCI7czoyMToiYWRtaW5AdWppYW5vbmxpbmUuY29tIjtzOjEzOiJzZXNzaW9uX3Rva2VuIjtzOjY0OiJBUm9sYjJJSEdQZ2JVRHNVVk1HSWlNUmRMM3Z0elQ4TUVvNHo4Ulh1M0NZTEtSQjdlTjdvQ3B2ZEJRV1AzWnVEIjt9', 1760951636),
('rOy6WfqaS88tTfkOgevtjhhEghSdkCLmPc5Qovax', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMFh0SG82ZHJqeWZreEdxZjlkSW1Sam42a2xhcWw3YlBqODVCc0s1diI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1760952608),
('rzLxnbGjNSPCdiIb9lG9i3SUWJP6xYiHp6uzvIjO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiRHY4SnFsYnpJYXU2Y21nQzBUQmxMbXdTNkpxT3dDT0hJbVR6UGxiSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9zZXR0aW5ncyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6IjJKR0Q2cG1rcnd5bElYZXZMRHN3TFJRMzZ4azJRWXhDejNhWlBMNmVDbUhCYkQyNkw1QWU2Y0l5cHZ1cVFENjQiO30=', 1760952916),
('s2awUmTYwqgHvoc3Odkbq0Y5VZrJFOl8JvdWRO88', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiajJ2MmxLWHZjRFVyM0xFQ1dIWVdWcEVKVFE4czVoVGpPbmV6NWFBRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9xdWVzdGlvbnMvZGF0YSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6IkVjUHRxdmFCajlSdVprdThTczU3NDJMM3M2STBib0doTURnMTR6emFUU3N6Z3RXRDhlS055R1JJbHNmREp6TE4iO30=', 1760948012),
('SF01lQaHFmf5qyONz29KRrdkNUDBC48ZpcvC4xKH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiMUNuTHdYYjBueXJWRmpKd3RCZ0loSEtVMFVwRUlMNUhFUDY4Y2lEdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9zZXR0aW5ncyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6IldNZmxBNHhCenBIRFRjRzJQeGNZOVZ1eDV3aEFHRXRpTlJxd0pCRWJrS2JtMjg4VGNFMGJQWjdVWkRvQ3dmMmkiO30=', 1760951679),
('SnkXVcjVPB35FZHpI2tCS1hmlqkdVszOaJ5pUb4i', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiQVB6VTFRUGg2WmRBUUVxSzFHd1NWU2c5N3pQdkcwZWlwOHN6RjFySiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9wYXJ0aWNpcGFudHMvZGF0YSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6IlpZMEE2TmFhaDRCUkpPaWVSNnlnd3g1N29rQnhGVWd6dHRzZnhTbGUxZlJrc0ZLTHJVOUMwYjFZeld0Y1J2ZGkiO30=', 1760947992),
('twavwO4wjhTYzAG50tvXw4Cgu9QEvQNzePfkSDT9', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNXVkRExLSXhwdldJQ1E4TUJrc25SQW5mYWJOTU4yZ0NYejZLekFpVCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1760952926),
('udWrveOyKlMHa109WJtBkrmRCi7Z1Xcyr0R5xzxL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOEVXWjV0cm1Xa3B0RDI5dVkwNkU1VWFzemVXMm5UT1VaRjB1RDVtUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1760952886),
('UnA8rpxZTFvJZWyZLX6MzoJagAfbHTQ9VbhSuQSj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaU1naDJaUEZFbHZZcHljUUVoU1lQc1ZWaE1kM1o4T01OR0FlcVZPcyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1760952217),
('upb1DQ0BGPWcmMPcwZgKuXuDmG3iavBZPMirOY0y', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicjhrS0k1VGttRjlkOFNvQXNwUDJBdktaTlNkNHlmU0ZrUUgweVpOYyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1760952893),
('VFiqEElFxSrF4j68BcxMq77GZ82PsmXo9QmQVw3y', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoick93ZjJlRVNYNXpVTUJkZW9zM1g0ZUxVRm5yWDNmMkJCVzhiYkVnaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9wYXJ0aWNpcGFudHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjc6InVzZXJfaWQiO2k6MTtzOjk6InVzZXJfdHlwZSI7czo1OiJhZG1pbiI7czo5OiJ1c2VyX25hbWUiO047czoxMDoidXNlcl9lbWFpbCI7czoyMToiYWRtaW5AdWppYW5vbmxpbmUuY29tIjtzOjEzOiJzZXNzaW9uX3Rva2VuIjtzOjY0OiJ6VE9uenhvR2NZYW1TbkY2SVE0bXduYmlsQnMwWTRUcG9TS2huTVBYV1JmMXJ5ZjV3d1d5M0F3Yko3a2ZoOG8yIjt9', 1760950984),
('vK3uWDEf5jT3kBUAIrlG3Wqd01s98njlFadwUAjO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiV2lFbDR6eEhMRW83RnMzbEgxZTNlTmRzNmxLV1FweW9BNFFxTjFreSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi91c2VycyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6IkZSMmxRUXduSHU1dGtsdWlReDNjWUNxQkJFTXBOT1FHYTZpQWk0WElFbXA4RmFJZ2tzTXlQYzBIenRNQWVUb2kiO30=', 1760951518),
('xfUJwM6TzJDuCyTtuQKEWnAy1NPKyVotcisKL7jQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiYXRCaUhuaTh6alpxbHlVYUJvT1h4MXJDc1NMRkFYOFExRUY0SU1ZUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi91c2VycyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6ImcyZ3V6SjUyRUMxUERXdVBqcXpUMHJYMWI1a05oMzhXS3JlU29KQ0VYUjBYQm84bURaZEZSTkVkNlQxTE1JZ2kiO30=', 1760951575),
('XKPhuG6rEwK4fVvct56qjpsoNroSXtkzRGL55Xfm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiYXBzeFc2WmVRQ0ZlWGFTN3FGcnhNdmFDVVlDZERXaTQ5Q0IxczM1MCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi91c2Vycy9kYXRhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c2VyX2lkIjtpOjE7czo5OiJ1c2VyX3R5cGUiO3M6NToiYWRtaW4iO3M6OToidXNlcl9uYW1lIjtOO3M6MTA6InVzZXJfZW1haWwiO3M6MjE6ImFkbWluQHVqaWFub25saW5lLmNvbSI7czoxMzoic2Vzc2lvbl90b2tlbiI7czo2NDoiQnpPTEZEODZJenlqSnpzOUxLcWExMUdOdU0xdnNseVZVOEN5ZGNNTktjSlgxOGd1NW9CbTBXelFPd3phemhmTCI7fQ==', 1760951323),
('XQCN1VL7FKE47AZfStJsrNU6SJ0ElJq6Ec3uESga', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiblZtazgxTnBVWXRjZ3JxYVdpSUU2OEVITFc5dXVDWFlweVp0Z0RQMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1760952862),
('yulcpzZj62Qcxe3gwFWSmyB7sIO4ouHYbToe3IOi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVVpZb2ZZRmZwczFHTG0wRU95NU9vQlJhYXd0cXFEbVZFQmFINHlyYSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1760952216),
('ZKXaHNpHMSsBpLSopCzhj6rxo9L7hqqFO7ugTu2q', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiNkNsUVI5MTc5YlJqSEQ3OXpSaGJBbFpYUGRRaGxraEtUTHV1aEJIOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi91c2VycyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6IkNLUEtVaVRHcHZZSHJVZ0MxQ05MYTlmSGdpRURST2QzMUpnQmNFUDk0U3ZpSnNyRTM5c2x5RVR5YXhVdGNxcHYiO30=', 1760951303),
('ZrLG88eXb42HcLTFGKRDvE7PiW4VO2UI0MvXqgOX', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoicjJibjhRc2d3MlViMEhrNDNQdmZLQ0V2b2Y3OFhDT3NHQ1NDMVlQYyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi91c2Vycy9kYXRhIjt9czo3OiJ1c2VyX2lkIjtpOjE7czo5OiJ1c2VyX3R5cGUiO3M6NToiYWRtaW4iO3M6OToidXNlcl9uYW1lIjtOO3M6MTA6InVzZXJfZW1haWwiO3M6MjE6ImFkbWluQHVqaWFub25saW5lLmNvbSI7czoxMzoic2Vzc2lvbl90b2tlbiI7czo2NDoicnNkbkk1WG9GelZadG9rYUpTVHlyenBmazlzTE1CTEVjZmQxT2lyN2RtSlA4OGpBQ0JnU0pWZkhqUHh0WUdDdSI7fQ==', 1760950613),
('ZtvAeD0DP0D17OHNH67oc6H6tGTrzXl0psBCOAdr', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.1', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoicGdqbjAyRklyc2VVUUk4dE9ESnc1RmNiR0I4d21tUUc0S1NZM1FkUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi91c2VycyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7TjtzOjEwOiJ1c2VyX2VtYWlsIjtzOjIxOiJhZG1pbkB1amlhbm9ubGluZS5jb20iO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6InphWVF5aW5RTUdxckV4Q0JtSUxTQjgwRXlOTUhSRFlNSzJVQUlEbGo5R245SkgzNFgyY25GNEdiUG5oSnFPTVUiO30=', 1760951260);

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
(1, 'Super Admin', 'admin@ujianonline.com', '2025-10-11 02:06:38', '$2y$12$kvFYIv.vVY8SeJhMHShqSumhYSbwLMvqSfmR/QnJzK25TanJtM5i2', 'admin', NULL, '2025-10-20 02:35:16', 0, NULL, '2025-10-11 02:06:38', '2025-10-20 02:35:16'),
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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `id_batch` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
