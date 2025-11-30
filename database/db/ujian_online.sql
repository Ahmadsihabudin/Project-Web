-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2025 at 03:09 PM
-- Server version: 11.7.2-MariaDB
-- PHP Version: 8.2.12

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
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
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
(227, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-31 06:41:23', '2025-10-31 06:41:23'),
(228, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-31 21:01:00', '2025-10-31 21:01:00'),
(229, 'admin', 1, 'create_user', 'Created new staff: yusuf', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0', '2025-10-31 21:09:18', '2025-10-31 21:09:18'),
(230, 'peserta', 24, 'login_failed', 'Failed peserta login attempt', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-31 21:26:20', '2025-10-31 21:26:20'),
(231, 'peserta', 24, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-31 21:26:51', '2025-10-31 21:26:51'),
(232, 'peserta', 24, 'submit_exam', 'Menyelesaikan ujian: Ujian Biologi, Geografi, Matematika, Pendidikan Kewarganegaraan, Teknologi Informasi (Skor: 33.333333333333%)', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-31 21:30:26', '2025-10-31 21:30:26'),
(233, 'peserta', 24, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-31 21:32:10', '2025-10-31 21:32:10'),
(234, 'peserta', 25, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Chrome\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', '2025-10-31 21:49:03', '2025-10-31 21:49:03'),
(235, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-12 06:14:26', '2025-11-12 06:14:26'),
(236, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-12 06:24:06', '2025-11-12 06:24:06'),
(237, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-12 07:05:50', '2025-11-12 07:05:50'),
(238, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-12 07:07:40', '2025-11-12 07:07:40'),
(239, 'admin', 1, 'logout', 'User logout', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-12 07:10:18', '2025-11-12 07:10:18'),
(240, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-12 07:10:43', '2025-11-12 07:10:43'),
(241, 'admin', 1, 'logout', 'User logout', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-12 07:37:42', '2025-11-12 07:37:42'),
(242, 'peserta', 30, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-12 07:37:51', '2025-11-12 07:37:51'),
(243, 'peserta', 30, 'submit_exam', 'Menyelesaikan ujian: Ujian Biologi, Geografi, Matematika, Pendidikan Kewarganegaraan, Teknologi Informasi (Skor: 30.769230769231%)', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-12 07:39:03', '2025-11-12 07:39:03'),
(244, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-12 07:39:16', '2025-11-12 07:39:16'),
(245, 'admin', 1, 'logout', 'User logout', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-12 07:44:29', '2025-11-12 07:44:29'),
(246, 'peserta', 30, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-12 07:44:39', '2025-11-12 07:44:39'),
(247, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-12 07:45:34', '2025-11-12 07:45:34'),
(248, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-13 07:45:33', '2025-11-13 07:45:33'),
(249, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-14 10:10:39', '2025-11-14 10:10:39'),
(250, 'admin', 1, 'logout', 'User logout', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-14 10:46:31', '2025-11-14 10:46:31'),
(251, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-14 10:46:36', '2025-11-14 10:46:36'),
(252, 'peserta', 60, 'login_failed', 'Failed peserta login attempt', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-14 11:36:01', '2025-11-14 11:36:01'),
(253, 'peserta', 60, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-14 11:36:18', '2025-11-14 11:36:18'),
(254, 'peserta', 60, 'submit_exam', 'Menyelesaikan ujian: Ujian Psikotes Verbal (Skor: 6.6666666666667%)', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-14 11:36:49', '2025-11-14 11:36:49'),
(255, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-14 11:38:24', '2025-11-14 11:38:24'),
(256, 'peserta', 59, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-14 11:38:46', '2025-11-14 11:38:46'),
(257, 'peserta', 59, 'submit_exam', 'Menyelesaikan ujian: Ujian Psikotes Verbal (Skor: 6.6666666666667%)', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-14 11:39:19', '2025-11-14 11:39:19'),
(258, 'peserta', 59, 'logout', 'User logout', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-14 11:44:53', '2025-11-14 11:44:53'),
(259, 'peserta', 59, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-14 11:45:08', '2025-11-14 11:45:08'),
(260, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-14 11:45:19', '2025-11-14 11:45:19'),
(261, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-16 09:19:20', '2025-11-16 09:19:20'),
(262, 'peserta', 59, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-16 09:20:36', '2025-11-16 09:20:36'),
(263, 'peserta', 58, 'login_failed', 'Failed peserta login attempt', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-16 09:20:56', '2025-11-16 09:20:56'),
(264, 'peserta', 58, 'login_failed', 'Failed peserta login attempt', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-16 09:21:05', '2025-11-16 09:21:05'),
(265, 'peserta', 58, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-16 09:21:12', '2025-11-16 09:21:12'),
(266, 'peserta', 58, 'submit_exam', 'Menyelesaikan ujian: Ujian Psikotes Verbal (Skor: 6.6666666666667%)', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-16 09:22:41', '2025-11-16 09:22:41'),
(267, 'peserta', 58, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-17 00:23:41', '2025-11-17 00:23:41'),
(268, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-17 00:24:30', '2025-11-17 00:24:30'),
(269, 'peserta', 56, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-17 00:25:27', '2025-11-17 00:25:27'),
(270, 'peserta', 55, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-17 00:26:44', '2025-11-17 00:26:44'),
(271, 'peserta', 55, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-17 05:00:26', '2025-11-17 05:00:26'),
(272, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-17 20:22:26', '2025-11-17 20:22:26'),
(273, 'peserta', 55, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-17 20:22:59', '2025-11-17 20:22:59'),
(274, 'peserta', 55, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-18 06:48:28', '2025-11-18 06:48:28'),
(275, 'peserta', 55, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-18 07:02:18', '2025-11-18 07:02:18'),
(276, 'peserta', 55, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-18 07:02:59', '2025-11-18 07:02:59'),
(277, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-18 07:10:53', '2025-11-18 07:10:53'),
(278, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-19 05:40:27', '2025-11-19 05:40:27'),
(279, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-19 06:11:39', '2025-11-19 06:11:39'),
(280, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-19 07:21:32', '2025-11-19 07:21:32'),
(281, 'peserta', 56, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-19 07:26:40', '2025-11-19 07:26:40'),
(282, 'peserta', 56, 'logout', 'User logout', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-19 07:28:41', '2025-11-19 07:28:41'),
(283, 'peserta', 56, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-19 07:29:29', '2025-11-19 07:29:29'),
(284, 'peserta', 56, 'logout', 'User logout', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-19 07:29:39', '2025-11-19 07:29:39'),
(285, 'peserta', 56, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-19 07:29:47', '2025-11-19 07:29:47'),
(286, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-20 20:18:04', '2025-11-20 20:18:04'),
(287, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-20 22:50:34', '2025-11-20 22:50:34'),
(288, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-21 05:47:28', '2025-11-21 05:47:28'),
(289, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-23 17:23:58', '2025-11-23 17:23:58'),
(290, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-23 17:53:51', '2025-11-23 17:53:51'),
(291, 'admin', 1, 'logout', 'User logout', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-23 17:55:44', '2025-11-23 17:55:44'),
(292, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-23 17:56:07', '2025-11-23 17:56:07'),
(293, 'admin', 1, 'logout', 'User logout', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-23 17:56:30', '2025-11-23 17:56:30'),
(294, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-23 17:56:40', '2025-11-23 17:56:40'),
(295, 'peserta', 55, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-23 17:56:54', '2025-11-23 17:56:54'),
(296, 'peserta', 55, 'logout', 'User logout', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-23 18:03:24', '2025-11-23 18:03:24'),
(297, 'peserta', 55, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-23 18:03:28', '2025-11-23 18:03:28'),
(298, 'peserta', 55, 'logout', 'User logout', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-23 18:03:36', '2025-11-23 18:03:36'),
(299, 'peserta', 55, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-23 18:04:23', '2025-11-23 18:04:23'),
(300, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-25 17:38:01', '2025-11-25 17:38:01'),
(301, 'peserta', 0, 'login_failed', 'Failed peserta login attempt', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-25 17:43:15', '2025-11-25 17:43:15'),
(302, 'peserta', 61, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-25 17:43:22', '2025-11-25 17:43:22'),
(303, 'peserta', 0, 'login_failed', 'Failed peserta login attempt', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-25 17:52:17', '2025-11-25 17:52:17'),
(304, 'peserta', 61, 'logout', 'User logout', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-25 17:52:37', '2025-11-25 17:52:37'),
(305, 'peserta', 61, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-25 17:52:41', '2025-11-25 17:52:41'),
(306, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-25 17:53:47', '2025-11-25 17:53:47'),
(307, 'peserta', 61, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-25 18:08:44', '2025-11-25 18:08:44'),
(308, 'peserta', 61, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-25 20:48:35', '2025-11-25 20:48:35'),
(309, 'peserta', 61, 'logout', 'User logout', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-25 21:03:29', '2025-11-25 21:03:29'),
(310, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-25 21:03:53', '2025-11-25 21:03:53'),
(311, 'peserta', 62, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-25 21:07:56', '2025-11-25 21:07:56'),
(312, 'peserta', 62, 'logout', 'User logout', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-25 21:46:47', '2025-11-25 21:46:47'),
(313, 'peserta', 62, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-25 21:46:50', '2025-11-25 21:46:50'),
(314, 'peserta', 62, 'logout', 'User logout', '{\"browser\":\"Chrome\",\"os\":\"Linux\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36', '2025-11-25 21:49:41', '2025-11-25 21:49:41'),
(315, 'peserta', 62, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Linux\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36', '2025-11-25 21:49:44', '2025-11-25 21:49:44'),
(316, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-28 11:28:05', '2025-11-28 11:28:05'),
(317, 'admin', 1, 'login_success', 'Successful admin login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', '2025-11-30 04:52:17', '2025-11-30 04:52:17'),
(318, 'peserta', 62, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 04:56:48', '2025-11-30 04:56:48'),
(319, 'peserta', 62, 'logout', 'User logout', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 04:56:58', '2025-11-30 04:56:58'),
(320, 'peserta', 62, 'login_success', 'Successful peserta login', '{\"browser\":\"Chrome\",\"os\":\"Windows\",\"device\":\"Unknown\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-30 05:04:13', '2025-11-30 05:04:13');

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `id_batch` bigint(20) UNSIGNED NOT NULL,
  `nama_batch` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL
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
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-participant_creation_127.0.0.1', 'b:1;', 1764130121),
('laravel-cache-participant_import_127.0.0.1', 'b:1;', 1763145619);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_schedules`
--

CREATE TABLE `exam_schedules` (
  `id_schedule` bigint(20) UNSIGNED NOT NULL,
  `nama_ujian` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `id_batch` varchar(255) NOT NULL,
  `tanggal_ujian` date DEFAULT NULL,
  `jam_mulai` datetime NOT NULL,
  `jam_selesai` datetime NOT NULL,
  `durasi_menit` int(11) DEFAULT NULL,
  `status` enum('aktif','nonaktif','selesai') NOT NULL DEFAULT 'aktif',
  `soal_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`soal_ids`)),
  `instruksi` text DEFAULT NULL,
  `max_attempts` int(11) DEFAULT NULL,
  `randomize_questions` tinyint(1) NOT NULL DEFAULT 0,
  `show_results_immediately` tinyint(1) NOT NULL DEFAULT 0,
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
  `id_face_log` bigint(20) UNSIGNED NOT NULL,
  `id_peserta` bigint(20) UNSIGNED NOT NULL,
  `jumlah_orang` int(11) NOT NULL DEFAULT 1,
  `peringatan_ke` int(11) NOT NULL DEFAULT 0,
  `detected_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` bigint(20) UNSIGNED NOT NULL,
  `id_peserta` bigint(20) UNSIGNED NOT NULL,
  `id_soal` bigint(20) UNSIGNED NOT NULL,
  `jawaban_dipilih` varchar(255) DEFAULT NULL,
  `status` enum('benar','salah','pending') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `id_peserta`, `id_soal`, `jawaban_dipilih`, `status`) VALUES
(1, 27, 15, 'A', 'benar'),
(2, 27, 16, 'B', 'benar'),
(3, 27, 17, 'Fotosintesis itu yahh gitu', 'salah'),
(4, 27, 18, 'Yahh gitu deh', 'salah'),
(5, 27, 19, 'A', 'benar'),
(6, 26, 15, 'A', 'benar'),
(7, 26, 16, 'B', 'benar'),
(8, 26, 17, 'asdas', 'salah'),
(9, 26, 18, 'asdas', 'salah'),
(10, 26, 19, 'C', 'salah'),
(11, 24, 15, 'A', 'benar'),
(12, 24, 17, 'abc', 'salah'),
(13, 24, 18, 'abc', 'salah'),
(14, 24, 19, 'A', 'benar'),
(15, 30, 15, 'A', 'benar'),
(16, 30, 16, 'A', 'salah'),
(17, 30, 19, 'B', 'salah'),
(18, 30, 20, 'A', 'benar'),
(19, 60, 31, 'A', 'salah'),
(20, 60, 34, 'C', 'benar'),
(21, 59, 22, 'B', 'benar'),
(22, 59, 23, 'B', 'salah'),
(23, 59, 25, 'D', 'salah'),
(24, 58, 28, 'B', 'benar');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` bigint(20) UNSIGNED NOT NULL,
  `id_peserta` bigint(20) UNSIGNED NOT NULL,
  `batch_saat_ujian` varchar(255) DEFAULT NULL,
  `total_score` decimal(5,2) NOT NULL DEFAULT 0.00,
  `jumlah_benar` int(11) NOT NULL DEFAULT 0,
  `jumlah_salah` int(11) NOT NULL DEFAULT 0,
  `waktu_pengerjaan` int(11) NOT NULL DEFAULT 0,
  `status_submit` enum('manual','cheat','auto_submit') NOT NULL DEFAULT 'manual'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `id_peserta`, `batch_saat_ujian`, `total_score`, `jumlah_benar`, `jumlah_salah`, `waktu_pengerjaan`, `status_submit`) VALUES
(5, 60, NULL, 6.67, 1, 0, 0, 'manual'),
(6, 59, NULL, 6.67, 1, 0, 0, 'manual'),
(7, 58, NULL, 6.67, 1, 0, 1, 'manual');

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
(43, '2025_10_20_075357_create_activity_logs_table', 22),
(44, '2025_10_22_091946_add_jumlah_salah_to_laporan_table', 23),
(45, '2025_10_22_094201_add_batch_saat_ujian_to_laporan_table', 24),
(46, '2025_10_30_000001_add_auth_fields_to_peserta_table', 24),
(47, '2025_11_04_015555_add_login_attempts_to_users_table_if_missing', 24),
(48, '2025_11_04_023644_add_contact_fields_to_peserta_table', 24),
(49, '2025_11_04_035856_add_gambar_to_soal_table', 24),
(50, '2025_11_04_080039_add_hide_fields_to_sesi_ujian_table', 24),
(51, '2025_11_04_083332_add_durasi_soal_to_soal_table', 24),
(52, '2025_11_05_022807_remove_essay_system_from_database', 24),
(53, '2025_11_05_060845_add_scoring_fields_to_soal_table', 25),
(54, '2025_11_21_055934_add_foto_to_peserta_table', 26);

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` bigint(20) UNSIGNED NOT NULL,
  `nomor_urut` int(11) NOT NULL DEFAULT 0,
  `nama_peserta` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `kode_peserta` varchar(255) NOT NULL,
  `kode_akses` varchar(255) NOT NULL,
  `asal_smk` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `kota_kabupaten` varchar(100) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `batch` varchar(255) DEFAULT NULL,
  `status` enum('aktif','tidak_aktif','berlangsung','selesai') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `login_attempts` int(11) NOT NULL DEFAULT 0,
  `locked_until` timestamp NULL DEFAULT NULL,
  `current_session_id` varchar(255) DEFAULT NULL,
  `is_logged_in` tinyint(1) NOT NULL DEFAULT 0,
  `last_activity_at` timestamp NULL DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `nomor_urut`, `nama_peserta`, `email`, `foto`, `no_hp`, `nik`, `kode_peserta`, `kode_akses`, `asal_smk`, `jurusan`, `kota_kabupaten`, `provinsi`, `batch`, `status`, `created_at`, `updated_at`, `login_attempts`, `locked_until`, `current_session_id`, `is_logged_in`, `last_activity_at`, `last_login_at`, `remember_token`) VALUES
(51, 1, 'Rian Aditya Putra', 'rian.aditya@smkn1.sch.id', NULL, '081234560001', '3201010101010001', 'RK202511141801', 'pass123', 'SMK Negeri 1 Jakarta', 'Teknik Komputer dan Jaringan', 'Jakarta', 'DKI Jakarta', 'Batch 1', 'aktif', '2025-11-14 11:35:19', '2025-11-14 11:35:19', 0, NULL, NULL, 0, NULL, NULL, NULL),
(52, 2, 'Melani Salsabila', 'melani.s@smkn2.sch.id', NULL, '081234560002', '3201010101010002', 'RK202511141802', 'pass124', 'SMK Negeri 2 Bandung', 'Rekayasa Perangkat Lunak', 'Bandung', 'Jawa Barat', 'Batch 1', 'aktif', '2025-11-14 11:35:19', '2025-11-14 11:35:19', 0, NULL, NULL, 0, NULL, NULL, NULL),
(53, 3, 'Fuad Ramadhani', 'fuad.ramadhani@smkn3.sch.id', NULL, '081234560003', '3201010101010003', 'RK202511141803', 'pass125', 'SMK Negeri 3 Surabaya', 'Teknik Informatika', 'Surabaya', 'Jawa Timur', 'Batch 1', 'aktif', '2025-11-14 11:35:19', '2025-11-14 11:35:19', 0, NULL, NULL, 0, NULL, NULL, NULL),
(54, 4, 'Lilis Dwi Maharani', 'lilis.dwi@smkn4.sch.id', NULL, '081234560004', '3201010101010004', 'RK202511141804', 'pass126', 'SMK Negeri 4 Yogyakarta', 'Multimedia', 'Yogyakarta', 'DIY Yogyakarta', 'Batch 1', 'aktif', '2025-11-14 11:35:19', '2025-11-14 11:35:19', 0, NULL, NULL, 0, NULL, NULL, NULL),
(55, 5, 'Danu Prasetyo', 'danu.prasetyo@smkn5.sch.id', 'photos/participants/DTqgiJVrii8BVqtRkxH93QevxJXGb7TiqeeyvKHA.jpg', '081234560005', '3201010101010005', 'RK202511141805', 'pass127', 'SMK Negeri 5 Semarang', 'Teknik Elektronika', 'Semarang', 'Jawa Tengah', 'Batch 1', 'aktif', '2025-11-14 11:35:19', '2025-11-23 18:04:23', 0, NULL, 'S9ZKZV88Fg6mrPSK6UMlZnIYxFtOgjyolFfhXjXc', 1, '2025-11-23 18:04:23', NULL, NULL),
(56, 6, 'Farah Indriani', 'farah.indriani@smkn6.sch.id', NULL, '081234560006', '3201010101010006', 'RK202511141806', 'pass128', 'SMK Negeri 6 Bekasi', 'Akuntansi', 'Bekasi', 'Jawa Barat', 'Batch 1', 'aktif', '2025-11-14 11:35:19', '2025-11-19 07:29:47', 0, NULL, 'eQVW4O3S68nFbtI5o3tNH2t1dhYRn57vwJ8fwjqT', 1, '2025-11-19 07:29:47', NULL, NULL),
(57, 7, 'Arif Kurniawan', 'arif.kurniawan@smkn7.sch.id', NULL, '081234560007', '3201010101010007', 'RK202511141807', 'pass129', 'SMK Negeri 7 Malang', 'Teknik Mesin', 'Malang', 'Jawa Timur', 'Batch 1', 'aktif', '2025-11-14 11:35:19', '2025-11-14 11:35:19', 0, NULL, NULL, 0, NULL, NULL, NULL),
(58, 8, 'Siska Larasati', 'siska.larasati@smkn8.sch.id', NULL, '081234560008', '3201010101010008', 'RK202511141808', 'pass130', 'SMK Negeri 8 Medan', 'Perbankan', 'Medan', 'Sumatera Utara', 'Batch 1', 'aktif', '2025-11-14 11:35:19', '2025-11-17 00:23:41', 2, NULL, 'eupiXBy9crGbPvIwiXP1SMPPjbroV3Q2UBR4oiKa', 1, '2025-11-17 00:23:41', NULL, NULL),
(59, 9, 'Joko Prihadi', 'joko.prihadi@smkn9.sch.id', NULL, '081234560009', '3201010101010009', 'RK202511141809', 'pass131', 'SMK Negeri 9 Bali', 'Pariwisata', 'Denpasar', 'Bali', 'Batch 1', 'aktif', '2025-11-14 11:35:19', '2025-11-16 09:20:36', 0, NULL, 'f7C2cAVbYVcS5XpReq5qtprd9mnlKuAXyKNkcq2S', 1, '2025-11-16 09:20:36', NULL, NULL),
(60, 10, 'Wulan Tri Handayani', 'wulan.tri@smkn10.sch.id', NULL, '081234560010', '3201010101010010', 'RK202511141810', 'pass132', 'SMK Negeri 10 Makassar', 'Administrasi Perkantoran', 'Makassar', 'Sulawesi Selatan', 'Batch 1', 'aktif', '2025-11-14 11:35:19', '2025-11-14 11:36:18', 1, NULL, 'n6sh0iivuMVIioNc5VqQI0CgKe9zpMlP6SLE4nIZ', 1, '2025-11-14 11:36:18', NULL, NULL),
(61, 11, 'Kurniawan', 'kurniawan@smkn7.sch.id', 'photos/participants/RBP0TK8XqHATWSGX2X3K9rkkjL2q0aLoEfyIbOV4.jpg', '081234560007', '3201010101010006', 'RK2025111418', 'pass1', 'SMK Negeri 7 Malang', 'Teknik Mesin', 'Brebes', 'Jawa Tengah', 'Batch 1', 'aktif', '2025-11-25 17:42:52', '2025-11-25 21:03:29', 0, NULL, NULL, 0, '2025-11-25 21:03:29', NULL, NULL),
(62, 12, 'kherul amin', 'kherulamiin@gmail.com', 'photos/participants/HgjW0jcOwQb4elp5hteeUdyh8fgUOeBbHO7mAx4Z.jpg', '081234560007', '3201010101010006', 'RK000001', 'pass1', 'SMK Negeri 1 Adiwerna', 'Teknik Instalasi Tenaga Listrik', 'Tegal', 'Jawa Tengah', 'Batch 1', 'aktif', '2025-11-25 21:07:42', '2025-11-30 05:04:13', 0, NULL, 'CStgi4TxMuAMyMtNClS9yFGcKv7HyDZHMFEeIIIo', 1, '2025-11-30 05:04:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sesi_ujian`
--

CREATE TABLE `sesi_ujian` (
  `id_sesi` bigint(20) UNSIGNED NOT NULL,
  `id_ujian` bigint(20) UNSIGNED NOT NULL,
  `id_batch` bigint(20) UNSIGNED NOT NULL,
  `mata_pelajaran` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `durasi_menit` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `hide_nomor_urut` tinyint(1) NOT NULL DEFAULT 0,
  `hide_poin` tinyint(1) NOT NULL DEFAULT 0,
  `hide_mata_pelajaran` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sesi_ujian`
--

INSERT INTO `sesi_ujian` (`id_sesi`, `id_ujian`, `id_batch`, `mata_pelajaran`, `deskripsi`, `tanggal_mulai`, `jam_mulai`, `jam_selesai`, `tanggal_selesai`, `durasi_menit`, `status`, `hide_nomor_urut`, `hide_poin`, `hide_mata_pelajaran`) VALUES
(5, 6, 1, 'Psikotes Verbal', 'selamat Mengerjakan', '2025-11-30', '12:02:00', '13:02:00', '2025-12-02', 30, 'aktif', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('CStgi4TxMuAMyMtNClS9yFGcKv7HyDZHMFEeIIIo', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo5OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im5ldyI7YTowOnt9czozOiJvbGQiO2E6MDp7fX1zOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czozOToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3N0dWRlbnQvZXhhbS9kYXRhIjtzOjU6InJvdXRlIjtzOjE3OiJzdHVkZW50LmV4YW0uZGF0YSI7fXM6NjoiX3Rva2VuIjtzOjQwOiJMUlBiMXo5a1BOUjF5NDFCYkNMdmtxaUhCaEsxZ2kyVWNlQ1N4MEV0IjtzOjc6InVzZXJfaWQiO2k6NjI7czo5OiJ1c2VyX3R5cGUiO3M6NzoicGVzZXJ0YSI7czo5OiJ1c2VyX25hbWUiO3M6MTE6ImtoZXJ1bCBhbWluIjtzOjk6InVzZXJfY29kZSI7czo4OiJSSzAwMDAwMSI7czoxMzoic2Vzc2lvbl90b2tlbiI7czo2NDoic0s2MGV1Zlh3RE5RTVd5bjIyMjhHTGx2NWlaeVJrM2tPUDVwcnhwUkhvSlVGQ3hiNkJ1VzZkcHBkQ09qNldIZiI7czoyOToibmVlZHNfdmVyaWZpY2F0aW9uX2Zvcl9leGFtXzUiO2I6MTt9', 1764504267),
('Mf08uVp4JqaRrjR5K4k5d0Ljy3zNuVDqWExQSYun', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoia1B4OVJNYU9oS2owY2VBQmVuOTIwd2haSldydWF3cDExTFNhb25VOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9yZXBvcnRzL2RhdGEiO3M6NToicm91dGUiO3M6MTg6ImFkbWluLnJlcG9ydHMuZGF0YSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjU6ImFkbWluIjtzOjk6InVzZXJfbmFtZSI7czoxMToiU3VwZXIgQWRtaW4iO3M6MTA6InVzZXJfZW1haWwiO3M6MjE6ImFkbWluQHVqaWFub25saW5lLmNvbSI7czoxMzoic2Vzc2lvbl90b2tlbiI7czo2NDoid1BCSDFwMmNNOUsxUTAwRE9mTk5rVVRmY3h3T2pSWmN2SVJTMmtEV2hrakRkU2Y5UEExQzdQRENsQldyRDVUSyI7fQ==', 1764504158);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `description` text DEFAULT NULL,
  `category` enum('general','exam','security','notification','email','system') NOT NULL,
  `type` enum('string','integer','boolean','json','array') NOT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT 0,
  `is_encrypted` tinyint(1) NOT NULL DEFAULT 0,
  `validation_rules` varchar(255) DEFAULT NULL,
  `default_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id_soal` bigint(20) UNSIGNED NOT NULL,
  `batch` varchar(255) DEFAULT NULL,
  `pertanyaan` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `mata_pelajaran` varchar(255) DEFAULT NULL,
  `level_kesulitan` enum('mudah','sedang','sulit') NOT NULL DEFAULT 'sedang',
  `tipe_soal` enum('pilihan_ganda','benar_salah') NOT NULL DEFAULT 'pilihan_ganda',
  `opsi_a` varchar(255) NOT NULL,
  `opsi_b` varchar(255) NOT NULL,
  `opsi_c` varchar(255) NOT NULL,
  `opsi_d` varchar(255) NOT NULL,
  `opsi_e` varchar(255) DEFAULT NULL,
  `opsi_f` varchar(255) DEFAULT NULL,
  `jawaban_benar` text NOT NULL,
  `umpan_balik` text DEFAULT NULL,
  `poin` int(11) NOT NULL DEFAULT 1,
  `jenis_penilaian` enum('normal','pengurangan_poin') NOT NULL DEFAULT 'normal',
  `poin_benar` int(11) DEFAULT NULL,
  `poin_salah` int(11) NOT NULL DEFAULT 0,
  `durasi_soal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `batch`, `pertanyaan`, `gambar`, `mata_pelajaran`, `level_kesulitan`, `tipe_soal`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `opsi_f`, `jawaban_benar`, `umpan_balik`, `poin`, `jenis_penilaian`, `poin_benar`, `poin_salah`, `durasi_soal`) VALUES
(15, 'Batch 2', 'Apa ibukota Indonesia?', NULL, 'Geografi', 'sedang', 'pilihan_ganda', 'Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Semarang', 'Yogyakarta', 'a', 'Ibukota Indonesia adalah Jakarta', 10, 'normal', NULL, 0, NULL),
(16, 'Batch 2', '2 + 2 = ?', NULL, 'Matematika', 'sedang', 'pilihan_ganda', '3', '4', '5', '6', '', '', 'b', 'Hasil penjumlahan 2 + 2 adalah 4', 10, 'normal', NULL, 0, NULL),
(18, 'Batch 2', '8 + 2 =...', NULL, 'Teknologi Informasi', 'sedang', 'pilihan_ganda', '2', '10', '29', '11', '12', '', 'b', '10', 15, 'normal', NULL, 0, 1),
(19, 'Batch 2', 'Siapa presiden Indonesia?', NULL, 'Pendidikan Kewarganegaraan', 'sedang', 'pilihan_ganda', 'Joko Widodo', 'Prabowo Subianto', 'Megawati', 'Susilo Bambang Yudhoyono', '', '', 'a', 'Presiden Indonesia saat ini adalah Joko Widodo', 5, 'normal', NULL, 0, NULL),
(20, 'Batch 2', '1 + 1', NULL, 'Matematika', 'sedang', 'pilihan_ganda', '2', '1', '3', '5', '4', '6', 'a', '', 10, 'normal', NULL, 0, NULL),
(21, 'Batch 1', 'Sinonim dari kata \'Arif\' adalah...', NULL, 'Psikotes Verbal', 'sedang', 'pilihan_ganda', 'Bodoh', 'Bijaksana', 'Cepat', 'Keras', 'Tegas', 'Cuek', 'b', 'Arif berarti bijaksana atau pandai mengambil keputusan.', 5, 'normal', NULL, 0, 2),
(22, 'Batch 1', 'Antonim dari kata \'Baik\' adalah...', NULL, 'Psikotes Verbal', 'sedang', 'pilihan_ganda', 'Sopan', 'Jahat', 'Ramah', 'Santun', 'Lembut', 'Tenang', 'b', 'Lawan kata dari \'Baik\' adalah \'Jahat\'.', 5, 'normal', NULL, 0, 2),
(23, 'Batch 1', 'Sinonim dari kata \'Cerdas\' adalah...', NULL, 'Psikotes Verbal', 'sedang', 'pilihan_ganda', 'Bodoh', 'Lamban', 'Pintar', 'Lalai', 'Pasif', 'Lugu', 'c', '\'Cerdas\' sinonim dengan \'Pintar\'.', 5, 'normal', NULL, 0, 2),
(24, 'Batch 1', 'Antonim dari kata \'Tinggi\' adalah...', NULL, 'Psikotes Verbal', 'sedang', 'pilihan_ganda', 'Panjang', 'Lebar', 'Pendek', 'Dalam', 'Kecil', 'Rendah', 'c', 'Lawan kata dari \'Tinggi\' adalah \'Pendek\'.', 5, 'normal', NULL, 0, 2),
(25, 'Batch 1', 'Sinonim dari kata \'Murung\' adalah...', NULL, 'Psikotes Verbal', 'sedang', 'pilihan_ganda', 'Sedih', 'Senang', 'Bahagia', 'Ceria', 'Gembira', 'Muram', 'a', '\'Murung\' berarti sedih atau muram.', 5, 'normal', NULL, 0, 2),
(26, 'Batch 1', 'Antonim dari kata \'Keras\' adalah...', NULL, 'Psikotes Verbal', 'sedang', 'pilihan_ganda', 'Kuat', 'Lembut', 'Kasar', 'Bulat', 'Tegas', 'Kokoh', 'b', 'Lawan kata \'Keras\' adalah \'Lembut\'.', 5, 'normal', NULL, 0, 2),
(27, 'Batch 1', 'Sinonim dari kata \'Gigih\' adalah...', NULL, 'Psikotes Verbal', 'sedang', 'pilihan_ganda', 'Malas', 'Tekun', 'Putus asa', 'Lalai', 'Lemah', 'Ragu', 'b', '\'Gigih\' berarti tekun dan pantang menyerah.', 5, 'normal', NULL, 0, 2),
(28, 'Batch 1', 'Antonim dari kata \'Cepat\' adalah...', NULL, 'Psikotes Verbal', 'sedang', 'pilihan_ganda', 'Gesit', 'Lambat', 'Tepat', 'Ringan', 'Segera', 'Cermat', 'b', 'Lawan kata dari \'Cepat\' adalah \'Lambat\'.', 5, 'normal', NULL, 0, 2),
(29, 'Batch 1', 'Sinonim dari kata \'Angkuh\' adalah...', NULL, 'Psikotes Verbal', 'sedang', 'pilihan_ganda', 'Sombong', 'Rendah hati', 'Ramah', 'Sopan', 'Santun', 'Bijak', 'a', '\'Angkuh\' sama artinya dengan \'Sombong\'.', 5, 'normal', NULL, 0, 2),
(30, 'Batch 1', 'Antonim dari kata \'Kaya\' adalah...', NULL, 'Psikotes Verbal', 'sedang', 'pilihan_ganda', 'Miskin', 'Berhasil', 'Makmur', 'Berkecukupan', 'Sejahtera', 'Berkelas', 'a', 'Lawan kata dari \'Kaya\' adalah \'Miskin\'.', 5, 'normal', NULL, 0, 2),
(31, 'Batch 1', 'Sinonim dari kata \'Indah\' adalah...', NULL, 'Psikotes Verbal', 'sedang', 'pilihan_ganda', 'Jelek', 'Cantik', 'Buruk', 'Kasat', 'Asing', 'Mempesona', 'b', '\'Indah\' sinonim dengan \'Cantik\'.', 5, 'normal', NULL, 0, 2),
(32, 'Batch 1', 'Antonim dari kata \'Berani\' adalah...', NULL, 'Psikotes Verbal', 'sedang', 'pilihan_ganda', 'Takut', 'Kuat', 'Tegas', 'Tabah', 'Gigih', 'Cemas', 'a', 'Lawan kata dari \'Berani\' adalah \'Takut\'.', 5, 'normal', NULL, 0, 2),
(33, 'Batch 1', 'Sinonim dari kata \'Tenang\' adalah...', NULL, 'Psikotes Verbal', 'sedang', 'pilihan_ganda', 'Gelisah', 'Panik', 'Santai', 'Cemas', 'Resah', 'Stabil', 'c', '\'Tenang\' berarti \'Santai\' atau \'Tidak tegang\'.', 5, 'normal', NULL, 0, 2),
(34, 'Batch 1', 'Antonim dari kata \'Gelap\' adalah...', NULL, 'Psikotes Verbal', 'sedang', 'pilihan_ganda', 'Buram', 'Pudar', 'Terang', 'Redup', 'Suram', 'Lembut', 'c', 'Lawan kata \'Gelap\' adalah \'Terang\'.', 5, 'normal', NULL, 0, 2),
(35, 'Batch 1', 'Sinonim dari kata \'Rajin\' adalah...', NULL, 'Psikotes Verbal', 'sedang', 'pilihan_ganda', 'Malas', 'Lalai', 'Tekun', 'Lambat', 'Pasif', 'Aktif', 'c', '\'Rajin\' sinonim dengan \'Tekun\'.', 5, 'normal', NULL, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` bigint(20) UNSIGNED NOT NULL,
  `nama_ujian` varchar(255) NOT NULL,
  `mata_pelajaran` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ujian`
--

INSERT INTO `ujian` (`id_ujian`, `nama_ujian`, `mata_pelajaran`, `deskripsi`) VALUES
(1, 'as', 'Ujian Online', 'asd'),
(2, 'Ujian Matematika', 'Matematika', 'keren'),
(3, 'Ujian Biologi', 'Biologi', ''),
(4, 'Ujian Biologi, Geografi, IPA, Matematika, Pendidikan Kewarganegaraan, Teknologi Informasi', 'Biologi, Geografi, IPA, Matematika, Pendidikan Kewarganegaraan, Teknologi Informasi', ''),
(5, 'Ujian Biologi, Geografi, Matematika, Pendidikan Kewarganegaraan, Teknologi Informasi', 'Biologi, Geografi, Matematika, Pendidikan Kewarganegaraan, Teknologi Informasi', ''),
(6, 'Ujian Psikotes Verbal', 'Psikotes Verbal', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff') DEFAULT 'admin',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `login_attempts` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `locked_until` timestamp NULL DEFAULT NULL,
  `current_session_id` varchar(255) DEFAULT NULL,
  `is_logged_in` tinyint(1) NOT NULL DEFAULT 0,
  `last_activity_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `role`, `status`, `phone`, `address`, `notes`, `last_login_at`, `login_attempts`, `locked_until`, `current_session_id`, `is_logged_in`, `last_activity_at`) VALUES
(1, 'Super Admin', 'admin@ujianonline.com', NULL, '2025-10-11 02:06:38', '$2y$12$kvFYIv.vVY8SeJhMHShqSumhYSbwLMvqSfmR/QnJzK25TanJtM5i2', 'admin', 'active', NULL, NULL, NULL, '2025-11-30 04:52:17', 0, NULL, 'Mf08uVp4JqaRrjR5K4k5d0Ljy3zNuVDqWExQSYun', 1, '2025-11-30 04:52:17'),
(4, 'STAFF AKTI', 'staff@ujianonline.com', NULL, '2025-10-11 02:06:39', '$2y$12$cX/C18DGIS5iAxY64gJ1p.a2BJn7fxDvrD83tavCXCS8OFbEDaQca', 'staff', 'active', NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL),
(6, 'staff 1', 'staffakti@gmail.com', 'staff1', NULL, '$2y$12$74RzULEP57mur39EkuHEcOWXtqtteegpCw8L7WQR6AVnXL0pkWWXi', 'staff', 'active', '085694743168', 'Jl. Bendungan melayu', 'Staff Baru nih', NULL, 0, NULL, NULL, 0, NULL),
(7, 'yusuf', 'yusuf@gmail.com', 'yusuf123', NULL, '$2y$12$epJue7iGza0AtBl6yZDzRetW5tAxZH393bX3dEiRwVupBVdWU0gbW', 'staff', 'active', '0811123456', '`123', '123', NULL, 0, NULL, NULL, 0, NULL);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `id_batch` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `exam_schedules`
--
ALTER TABLE `exam_schedules`
  MODIFY `id_schedule` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `face_logs`
--
ALTER TABLE `face_logs`
  MODIFY `id_face_log` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `sesi_ujian`
--
ALTER TABLE `sesi_ujian`
  MODIFY `id_sesi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
