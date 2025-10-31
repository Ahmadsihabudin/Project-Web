-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 31, 2025 at 02:35 PM
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
(116, 'peserta', 1, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-20 09:37:32', '2025-10-20 09:37:32'),
(117, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-22 03:54:30', '2025-10-22 03:54:30'),
(118, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-22 03:56:23', '2025-10-22 03:56:23'),
(119, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-22 17:25:11', '2025-10-22 17:25:11'),
(120, 'peserta', 1, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-22 17:35:25', '2025-10-22 17:35:25'),
(121, 'peserta', 1, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-22 17:38:25', '2025-10-22 17:38:25'),
(122, 'peserta', 0, 'login_failed', 'Failed peserta login attempt', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-22 17:38:30', '2025-10-22 17:38:30'),
(123, 'peserta', 0, 'login_failed', 'Failed peserta login attempt', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-22 17:43:22', '2025-10-22 17:43:22'),
(124, 'admin', 1, 'update_user', 'Updated user: Guru Bahasa Indonesia', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-22 19:24:28', '2025-10-22 19:24:28'),
(125, 'admin', 1, 'update_user', 'Updated user: STAFF AKTI', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-22 19:24:44', '2025-10-22 19:24:44'),
(126, 'admin', 1, 'update_user', 'Updated user: STAFF AKTI', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-22 19:25:03', '2025-10-22 19:25:03'),
(127, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-23 01:51:12', '2025-10-23 01:51:12'),
(128, 'admin', 1, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-23 01:57:03', '2025-10-23 01:57:03'),
(129, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-23 02:01:32', '2025-10-23 02:01:32'),
(130, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-28 20:53:26', '2025-10-28 20:53:26'),
(131, 'admin', 1, 'create_user', 'Created new staff: staff 1', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-28 23:41:55', '2025-10-28 23:41:55'),
(132, 'admin', 1, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-29 00:01:00', '2025-10-29 00:01:00'),
(133, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-29 00:06:00', '2025-10-29 00:06:00'),
(134, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-29 00:30:09', '2025-10-29 00:30:09'),
(135, 'peserta', 28, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-29 01:44:47', '2025-10-29 01:44:47'),
(136, 'peserta', 28, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-29 01:52:28', '2025-10-29 01:52:28'),
(137, 'peserta', 28, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-29 01:52:53', '2025-10-29 01:52:53'),
(138, 'peserta', 28, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-29 02:14:51', '2025-10-29 02:14:51'),
(139, 'peserta', 28, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-29 02:15:14', '2025-10-29 02:15:14'),
(140, 'peserta', 28, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-29 02:15:26', '2025-10-29 02:15:26'),
(141, 'peserta', 27, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-29 02:15:37', '2025-10-29 02:15:37'),
(142, 'peserta', 27, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-29 02:15:52', '2025-10-29 02:15:52'),
(143, 'peserta', 25, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-29 02:16:00', '2025-10-29 02:16:00'),
(144, 'peserta', 25, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-29 02:21:37', '2025-10-29 02:21:37'),
(145, 'peserta', 25, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-29 02:26:20', '2025-10-29 02:26:20'),
(146, 'peserta', 25, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-29 02:27:43', '2025-10-29 02:27:43'),
(147, 'peserta', 25, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-29 02:27:47', '2025-10-29 02:27:47'),
(148, 'peserta', 25, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-29 02:37:26', '2025-10-29 02:37:26'),
(149, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-29 02:37:49', '2025-10-29 02:37:49'),
(150, 'peserta', 25, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-29 02:38:07', '2025-10-29 02:38:07'),
(151, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-29 23:45:56', '2025-10-29 23:45:56'),
(152, 'admin', 1, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-29 23:47:29', '2025-10-29 23:47:29'),
(153, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-29 23:47:40', '2025-10-29 23:47:40'),
(154, 'admin', 1, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-29 23:52:25', '2025-10-29 23:52:25'),
(155, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-29 23:57:35', '2025-10-29 23:57:35'),
(156, 'admin', 1, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 01:10:40', '2025-10-30 01:10:40'),
(157, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 01:12:45', '2025-10-30 01:12:45'),
(158, 'admin', 1, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 01:13:33', '2025-10-30 01:13:33'),
(159, 'peserta', 0, 'login_failed', 'Failed peserta login attempt', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 01:14:47', '2025-10-30 01:14:47'),
(160, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 01:15:08', '2025-10-30 01:15:08'),
(161, 'admin', 1, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 01:15:32', '2025-10-30 01:15:32'),
(162, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 01:16:31', '2025-10-30 01:16:31'),
(163, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 01:22:15', '2025-10-30 01:22:15'),
(164, 'admin', 1, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 01:46:28', '2025-10-30 01:46:28'),
(165, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-30 01:46:50', '2025-10-30 01:46:50'),
(166, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-30 08:34:51', '2025-10-30 08:34:51'),
(167, 'peserta', 27, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 08:41:34', '2025-10-30 08:41:34'),
(168, 'peserta', 27, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 08:47:30', '2025-10-30 08:47:30'),
(169, 'peserta', 27, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 08:47:39', '2025-10-30 08:47:39'),
(170, 'peserta', 27, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 08:50:33', '2025-10-30 08:50:33'),
(171, 'peserta', 27, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 08:50:42', '2025-10-30 08:50:42'),
(172, 'peserta', 27, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 08:57:59', '2025-10-30 08:57:59'),
(173, 'peserta', 26, 'login_failed', 'Failed peserta login attempt', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 09:28:02', '2025-10-30 09:28:02');
INSERT INTO `activity_logs` (`id`, `user_type`, `user_id`, `action`, `description`, `metadata`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(174, 'admin', 1, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-30 09:28:51', '2025-10-30 09:28:51'),
(175, 'peserta', 28, 'login_failed', 'Failed peserta login attempt', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 09:29:21', '2025-10-30 09:29:21'),
(176, 'peserta', 28, 'login_failed', 'Failed peserta login attempt', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 09:29:38', '2025-10-30 09:29:38'),
(177, 'peserta', 28, 'login_failed', 'Failed peserta login attempt', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 09:30:59', '2025-10-30 09:30:59'),
(178, 'peserta', 27, 'login_failed', 'Failed peserta login attempt', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 09:31:11', '2025-10-30 09:31:11'),
(179, 'peserta', 27, 'login_failed', 'Failed peserta login attempt', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 09:32:21', '2025-10-30 09:32:21'),
(180, 'peserta', 27, 'login_failed', 'Failed peserta login attempt', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 09:35:09', '2025-10-30 09:35:09'),
(181, 'peserta', 28, 'login_failed', 'Failed peserta login attempt', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 09:35:33', '2025-10-30 09:35:33'),
(182, 'peserta', 28, 'login_failed', 'Failed peserta login attempt', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 09:36:25', '2025-10-30 09:36:25'),
(183, 'peserta', 28, 'login_failed', 'Failed peserta login attempt', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 09:40:25', '2025-10-30 09:40:25'),
(184, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 09:44:42', '2025-10-30 09:44:42'),
(185, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-30 18:25:10', '2025-10-30 18:25:10'),
(186, 'peserta', 27, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 18:44:01', '2025-10-30 18:44:01'),
(187, 'peserta', 27, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 19:08:16', '2025-10-30 19:08:16'),
(188, 'peserta', 27, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 19:08:20', '2025-10-30 19:08:20'),
(189, 'peserta', 27, 'logout', 'User logout', '{\"os\": \"Linux\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Linux; Android 8.0.0; SM-G955U Build/R16NW) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Mobile Safari/537.36', '2025-10-30 19:30:35', '2025-10-30 19:30:35'),
(190, 'peserta', 27, 'login_success', 'Successful peserta login', '{\"os\": \"Linux\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Linux; Android 8.0.0; SM-G955U Build/R16NW) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Mobile Safari/537.36', '2025-10-30 19:30:46', '2025-10-30 19:30:46'),
(191, 'peserta', 27, 'logout', 'User logout', '{\"os\": \"Linux\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Linux; Android 8.0.0; SM-G955U Build/R16NW) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Mobile Safari/537.36', '2025-10-30 20:26:58', '2025-10-30 20:26:58'),
(192, 'peserta', 27, 'login_success', 'Successful peserta login', '{\"os\": \"Linux\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Linux; Android 8.0.0; SM-G955U Build/R16NW) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Mobile Safari/537.36', '2025-10-30 20:27:02', '2025-10-30 20:27:02'),
(193, 'peserta', 27, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 21:02:35', '2025-10-30 21:02:35'),
(194, 'peserta', 27, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 21:02:38', '2025-10-30 21:02:38'),
(195, 'peserta', 27, 'logout', 'User logout', '{\"os\": \"Linux\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Linux; Android 8.0.0; SM-G955U Build/R16NW) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Mobile Safari/537.36', '2025-10-30 21:09:55', '2025-10-30 21:09:55'),
(196, 'peserta', 27, 'login_success', 'Successful peserta login', '{\"os\": \"Linux\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Linux; Android 8.0.0; SM-G955U Build/R16NW) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Mobile Safari/537.36', '2025-10-30 21:10:02', '2025-10-30 21:10:02'),
(197, 'peserta', 27, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 21:23:36', '2025-10-30 21:23:36'),
(198, 'peserta', 27, 'login_success', 'Successful peserta login', '{\"os\": \"Linux\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Linux; Android 8.0.0; SM-G955U Build/R16NW) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Mobile Safari/537.36', '2025-10-30 23:24:14', '2025-10-30 23:24:14'),
(199, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-30 23:25:04', '2025-10-30 23:25:04'),
(200, 'peserta', 27, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 23:36:17', '2025-10-30 23:36:17'),
(201, 'peserta', 27, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 23:36:57', '2025-10-30 23:36:57'),
(202, 'peserta', 27, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 23:38:41', '2025-10-30 23:38:41'),
(203, 'peserta', 27, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 23:38:57', '2025-10-30 23:38:57'),
(204, 'peserta', 27, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 23:39:54', '2025-10-30 23:39:54'),
(205, 'peserta', 27, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 23:40:01', '2025-10-30 23:40:01'),
(206, 'peserta', 27, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 23:40:11', '2025-10-30 23:40:11'),
(207, 'peserta', 27, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 23:52:10', '2025-10-30 23:52:10'),
(208, 'peserta', 27, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-30 23:52:16', '2025-10-30 23:52:16'),
(209, 'peserta', 27, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-31 00:27:31', '2025-10-31 00:27:31'),
(210, 'peserta', 27, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-31 00:29:31', '2025-10-31 00:29:31'),
(211, 'peserta', 27, 'submit_exam', 'Menyelesaikan ujian: Ujian Biologi, Geografi, Matematika, Pendidikan Kewarganegaraan, Teknologi Informasi (Skor: 60%)', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-31 00:44:12', '2025-10-31 00:44:12'),
(212, 'peserta', 27, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-31 00:59:27', '2025-10-31 00:59:27'),
(213, 'peserta', 27, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-31 00:59:29', '2025-10-31 00:59:29'),
(214, 'peserta', 27, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-31 00:59:52', '2025-10-31 00:59:52'),
(215, 'peserta', 27, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-31 01:03:03', '2025-10-31 01:03:03'),
(216, 'peserta', 27, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-31 01:05:57', '2025-10-31 01:05:57'),
(217, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-31 03:28:31', '2025-10-31 03:28:31'),
(218, 'peserta', 26, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-31 03:48:50', '2025-10-31 03:48:50'),
(219, 'peserta', 26, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-31 04:27:17', '2025-10-31 04:27:17'),
(220, 'peserta', 26, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-31 04:27:21', '2025-10-31 04:27:21'),
(221, 'peserta', 26, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-31 05:42:54', '2025-10-31 05:42:54'),
(222, 'peserta', 26, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-31 05:42:59', '2025-10-31 05:42:59'),
(223, 'peserta', 26, 'submit_exam', 'Menyelesaikan ujian: Ujian Biologi, Geografi, Matematika, Pendidikan Kewarganegaraan, Teknologi Informasi (Skor: 40%)', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-31 06:31:10', '2025-10-31 06:31:10'),
(224, 'peserta', 26, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-31 06:31:40', '2025-10-31 06:31:40'),
(225, 'peserta', 26, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-31 06:38:36', '2025-10-31 06:38:36'),
(226, 'peserta', 26, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-31 06:40:50', '2025-10-31 06:40:50'),
(227, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-31 06:41:23', '2025-10-31 06:41:23');

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `id_batch` bigint UNSIGNED NOT NULL,
  `nama_batch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id_batch`, `nama_batch`, `keterangan`) VALUES
(1, 'Batch 1', NULL),
(2, 'Batch 2', NULL),
(6, 'Batch 3', 'Batch untuk Batch 3');

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
  `nilai_essay` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `id_peserta`, `id_soal`, `jawaban_dipilih`, `status`, `nilai_essay`) VALUES
(1, 27, 15, 'A', 'benar', NULL),
(2, 27, 16, 'B', 'benar', NULL),
(3, 27, 17, 'Fotosintesis itu yahh gitu', 'salah', 1.30),
(4, 27, 18, 'Yahh gitu deh', 'salah', 0.00),
(5, 27, 19, 'A', 'benar', NULL),
(6, 26, 15, 'A', 'benar', NULL),
(7, 26, 16, 'B', 'benar', NULL),
(8, 26, 17, 'asdas', 'salah', 0.00),
(9, 26, 18, 'asdas', 'salah', 0.00),
(10, 26, 19, 'C', 'salah', NULL);

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
  `status_submit` enum('manual','cheat','auto_submit') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'manual'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `id_peserta`, `total_score`, `jumlah_benar`, `waktu_pengerjaan`, `status_submit`) VALUES
(1, 27, 60.00, 3, 1, 'manual'),
(2, 26, 40.00, 2, 1, 'manual');

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
(36, '2025_10_08_023932_update_users_role_enum', 16),
(37, '2025_10_23_010642_remove_unnecessary_columns_from_all_tables', 17),
(38, '2025_10_29_040822_add_timestamps_to_peserta_table', 18),
(39, '2025_10_29_044342_add_missing_fields_to_users_table', 19),
(40, '2025_10_29_064928_add_session_tracking_to_users_table', 20),
(41, '2025_10_29_065101_add_session_tracking_to_peserta_table', 21),
(42, '2025_10_30_000001_add_auth_fields_to_peserta_table', 22);

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locked_until` timestamp NULL DEFAULT NULL,
  `kode_peserta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_akses` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal_smk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aktif','tidak_aktif','berlangsung','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `login_attempts` int NOT NULL DEFAULT '0',
  `current_session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_logged_in` tinyint(1) NOT NULL DEFAULT '0',
  `last_activity_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `nomor_urut`, `nama_peserta`, `email`, `last_login_at`, `remember_token`, `locked_until`, `kode_peserta`, `kode_akses`, `asal_smk`, `jurusan`, `batch`, `status`, `created_at`, `updated_at`, `login_attempts`, `current_session_id`, `is_logged_in`, `last_activity_at`) VALUES
(24, 1, 'Ahmad Rizki Pratama', 'ahmad.rizki@smkn1.sch.id', NULL, NULL, NULL, 'RK001', 'password123', 'SMK Negeri 1 Jakarta', 'Teknik Komputer dan Jaringan', 'Batch 1', 'aktif', '2025-10-28 21:18:14', '2025-10-28 21:18:14', 0, NULL, 0, NULL),
(25, 2, 'Siti Nurhaliza', 'siti.nurhaliza@smkn2.sch.id', NULL, NULL, NULL, 'RK002', 'password123', 'SMK Negeri 2 Bandung', 'Rekayasa Perangkat Lunak', 'Batch 2', 'aktif', '2025-10-28 21:18:14', '2025-10-31 06:42:11', 0, 'TpxngUm8Dat1LnQzA4SEYHHRsJMgud6yf04UB3Ld', 1, '2025-10-29 02:38:07'),
(26, 3, 'Budi Santoso', 'budi.santoso@smkn3.sch.id', NULL, NULL, NULL, 'RK003', 'password123', 'SMK Negeri 3 Surabaya', 'Teknik Informatika', 'Batch 2', 'aktif', '2025-10-28 21:18:14', '2025-10-31 06:40:50', 0, NULL, 0, '2025-10-31 06:40:50'),
(27, 4, 'Dewi Kartika Sari', 'dewi.kartika@smkn4.sch.id', NULL, NULL, NULL, 'RK004', 'password123', 'SMK Negeri 4 Yogyakarta', 'Multimedia', 'Batch 2', 'aktif', '2025-10-28 21:18:14', '2025-10-31 01:05:57', 0, 'VlFRV0otxB6ROV5fuCbAsSMAktRLpdCDaZtYT14f', 1, '2025-10-31 01:05:57'),
(28, 5, 'Eko Prasetyo', 'eko.prasetyo@smkn5.sch.id', NULL, NULL, NULL, 'RK005', 'password123', 'SMK Negeri 5 Semarang', 'Teknik Elektronika', 'Batch 3', 'aktif', '2025-10-28 21:18:14', '2025-10-30 09:40:25', 0, NULL, 0, '2025-10-29 02:15:26');

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
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sesi_ujian`
--

INSERT INTO `sesi_ujian` (`id_sesi`, `id_ujian`, `id_batch`, `mata_pelajaran`, `deskripsi`, `tanggal_mulai`, `jam_mulai`, `jam_selesai`, `tanggal_selesai`, `durasi_menit`, `status`) VALUES
(4, 5, 2, 'Biologi, Geografi, Matematika, Pendidikan Kewarganegaraan, Teknologi Informasi', 'Semoga Sukses', '2025-10-31', '12:00:00', '13:00:00', '2025-11-01', 60, 'aktif');

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
('a46kwFBEn9vRTzk7aSgX7woWwD34KQq57Wwe4XA8', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoidXR2S1NkeWl3ZlhLbm1meGM3czBUNXVNZ0dnbkd0MVF5QTFGUjNZNiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wYXJ0aWNpcGFudHMvZGF0YSI7fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7czoxMToiU3VwZXIgQWRtaW4iO3M6MTA6InVzZXJfZW1haWwiO3M6MjE6ImFkbWluQHVqaWFub25saW5lLmNvbSI7czoxMzoic2Vzc2lvbl90b2tlbiI7czo2NDoiM01ySjlZTWE0ajZ6aWpTMFQ3bWNua0JSempBcU9FcDdETU4wbFl1NjhGb2RLekhvS0dOMFowcXZGREFzdWJvTyI7fQ==', 1761921143),
('VlFRV0otxB6ROV5fuCbAsSMAktRLpdCDaZtYT14f', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTozOntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im5ldyI7YTowOnt9czozOiJvbGQiO2E6MDp7fX1zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo2OiJfdG9rZW4iO3M6NDA6IkFvWXVSMGtiVmpGdGp6R3pHVGl5dEh4SVRzbWxabUVzUDE0U1R3OEQiO30=', 1761918051);

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
  `default_value` text COLLATE utf8mb4_unicode_ci
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
  `poin` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `batch`, `pertanyaan`, `mata_pelajaran`, `level_kesulitan`, `tipe_soal`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `opsi_f`, `jawaban_benar`, `umpan_balik`, `poin`) VALUES
(15, 'Batch 2', 'Apa ibukota Indonesia?', 'Geografi', 'sedang', 'pilihan_ganda', 'Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Semarang', 'Yogyakarta', 'a', 'Ibukota Indonesia adalah Jakarta', 10),
(16, 'Batch 2', '2 + 2 = ?', 'Matematika', 'sedang', 'pilihan_ganda', '3', '4', '5', '6', '', '', 'b', 'Hasil penjumlahan 2 + 2 adalah 4', 10),
(17, 'Batch 2', 'Jelaskan proses fotosintesis', 'Biologi', 'sedang', 'essay', '', '', '', '', '', '', 'Fotosintesis adalah proses dimana tumbuhan menggunakan cahaya matahari, air, dan karbon dioksida untuk membuat glukosa dan oksigen.', 'Fotosintesis adalah proses pembuatan makanan oleh tumbuhan', 15),
(18, 'Batch 2', 'Jelaskan kelebihan dan kekurangan sistem operasi Windows', 'Teknologi Informasi', 'sedang', 'essay', '', '', '', '', '', '', 'Windows memiliki kelebihan: user-friendly, kompatibilitas software tinggi, dukungan hardware luas. Kekurangan: rentan virus, lisensi berbayar, resource usage tinggi.', 'Windows memiliki kelebihan user-friendly tetapi rentan virus', 15),
(19, 'Batch 2', 'Siapa presiden Indonesia?', 'Pendidikan Kewarganegaraan', 'sedang', 'pilihan_ganda', 'Joko Widodo', 'Prabowo Subianto', 'Megawati', 'Susilo Bambang Yudhoyono', '', '', 'a', 'Presiden Indonesia saat ini adalah Joko Widodo', 5);

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` bigint UNSIGNED NOT NULL,
  `nama_ujian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mata_pelajaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ujian`
--

INSERT INTO `ujian` (`id_ujian`, `nama_ujian`, `mata_pelajaran`, `deskripsi`) VALUES
(1, 'as', 'Ujian Online', 'asd'),
(2, 'Ujian Matematika', 'Matematika', 'keren'),
(3, 'Ujian Biologi', 'Biologi', ''),
(4, 'Ujian Biologi, Geografi, IPA, Matematika, Pendidikan Kewarganegaraan, Teknologi Informasi', 'Biologi, Geografi, IPA, Matematika, Pendidikan Kewarganegaraan, Teknologi Informasi', ''),
(5, 'Ujian Biologi, Geografi, Matematika, Pendidikan Kewarganegaraan, Teknologi Informasi', 'Biologi, Geografi, Matematika, Pendidikan Kewarganegaraan, Teknologi Informasi', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','staff') COLLATE utf8mb4_unicode_ci DEFAULT 'admin',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `locked_until` timestamp NULL DEFAULT NULL,
  `current_session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_logged_in` tinyint(1) NOT NULL DEFAULT '0',
  `last_activity_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `role`, `status`, `phone`, `address`, `notes`, `last_login_at`, `locked_until`, `current_session_id`, `is_logged_in`, `last_activity_at`) VALUES
(1, 'Super Admin', 'admin@ujianonline.com', NULL, '2025-10-11 02:06:38', '$2y$12$kvFYIv.vVY8SeJhMHShqSumhYSbwLMvqSfmR/QnJzK25TanJtM5i2', 'admin', 'active', NULL, NULL, NULL, '2025-10-31 06:41:23', NULL, 'a46kwFBEn9vRTzk7aSgX7woWwD34KQq57Wwe4XA8', 1, '2025-10-31 06:41:23'),
(4, 'STAFF AKTI', 'staff@ujianonline.com', NULL, '2025-10-11 02:06:39', '$2y$12$cX/C18DGIS5iAxY64gJ1p.a2BJn7fxDvrD83tavCXCS8OFbEDaQca', 'staff', 'active', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(6, 'staff 1', 'staffakti@gmail.com', 'staff1', NULL, '$2y$12$74RzULEP57mur39EkuHEcOWXtqtteegpCw8L7WQR6AVnXL0pkWWXi', 'staff', 'active', '085694743168', 'Jl. Bendungan melayu', 'Staff Baru nih', NULL, NULL, NULL, 0, NULL);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `id_batch` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id_jawaban` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `sesi_ujian`
--
ALTER TABLE `sesi_ujian`
  MODIFY `id_sesi` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
