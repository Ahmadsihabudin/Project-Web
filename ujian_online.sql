-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 01, 2025 at 01:09 PM
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
  `id_ujian` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_type`, `user_id`, `action`, `description`, `metadata`, `ip_address`, `user_agent`, `id_ujian`, `created_at`, `updated_at`) VALUES
(1, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', NULL, '2025-09-25 20:23:49', '2025-09-25 20:23:49'),
(2, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', NULL, '2025-09-25 20:26:21', '2025-09-25 20:26:21'),
(3, 'admin', 0, 'login_failed', 'Failed login attempt', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', NULL, '2025-09-25 20:56:54', '2025-09-25 20:56:54'),
(4, 'admin', 0, 'login_failed', 'Failed login attempt', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', NULL, '2025-09-25 20:57:16', '2025-09-25 20:57:16'),
(5, 'admin', 1, 'login_failed', 'Failed login attempt', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', NULL, '2025-09-25 20:57:56', '2025-09-25 20:57:56'),
(6, 'admin', 1, 'login_failed', 'Failed login attempt', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', NULL, '2025-09-25 20:57:59', '2025-09-25 20:57:59'),
(7, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', NULL, '2025-09-25 20:58:45', '2025-09-25 20:58:45'),
(8, 'admin', 1, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', NULL, '2025-09-25 21:01:56', '2025-09-25 21:01:56'),
(9, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', NULL, '2025-09-25 21:09:36', '2025-09-25 21:09:36'),
(10, 'admin', 1, 'logout', 'User logout', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', NULL, '2025-09-25 21:10:08', '2025-09-25 21:10:08'),
(11, 'peserta', 1, 'login_success', 'Successful peserta login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', NULL, '2025-09-25 21:10:30', '2025-09-25 21:10:30'),
(12, 'admin', 1, 'login_success', 'Successful admin login', '{\"os\": \"Windows\", \"device\": \"Unknown\", \"browser\": \"Firefox\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', NULL, '2025-10-01 05:43:45', '2025-10-01 05:43:45');

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id_batch` bigint UNSIGNED NOT NULL,
  `nama_batch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id_batch`, `nama_batch`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Ujian Semester Genap 2024', 'Ujian online untuk mata pelajaran Teknologi Informasi', '2025-09-25 20:10:05', '2025-09-25 20:10:05');

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
-- Table structure for table `face_logs`
--

CREATE TABLE `face_logs` (
  `id_face_log` bigint UNSIGNED NOT NULL,
  `id_peserta` bigint UNSIGNED NOT NULL,
  `id_ujian` bigint UNSIGNED NOT NULL,
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
  `id_ujian` bigint UNSIGNED NOT NULL,
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
  `id_ujian` bigint UNSIGNED NOT NULL,
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
(5, '2025_09_25_160429_create_batches_table', 1),
(6, '2025_09_25_160435_create_soal_table', 1),
(7, '2025_09_25_160448_create_ujian_table', 1),
(8, '2025_09_25_160512_create_jawaban_table', 1),
(9, '2025_09_25_160523_create_laporan_table', 1),
(11, '2025_09_25_160527_create_face_logs_table', 2),
(12, '2025_09_26_024715_create_activity_logs_table', 2),
(13, '2025_09_26_024733_create_soal_randomization_table', 2),
(14, '2025_09_26_024853_update_peserta_password_security', 3),
(15, '2025_09_26_031514_create_sessions_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` bigint UNSIGNED NOT NULL,
  `nomor_urut` int NOT NULL,
  `nama_peserta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_peserta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal_smk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `login_attempts` int NOT NULL DEFAULT '0',
  `locked_until` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `nomor_urut`, `nama_peserta`, `kode_peserta`, `password_hash`, `asal_smk`, `jurusan`, `created_at`, `updated_at`, `last_login_at`, `login_attempts`, `locked_until`, `remember_token`) VALUES
(1, 1, 'Ahmad Rizki', 'PT8VZWEF', '$2y$12$VeOGjUKII5DCLad.yXYzLewYXcVsnhcBLTB2sUE8//K3yUTim9sP2', 'SMK Negeri 1 Jakarta', 'Teknik Komputer dan Jaringan', '2025-09-25 20:10:06', '2025-09-25 21:10:30', '2025-09-25 21:10:30', 0, NULL, 'lfybzgunXv4ZNKZztqh2h3cAUKuururXUw5bBEf3IGmrY34wz4nyLEsrEHdDXsi0'),
(2, 2, 'Siti Nurhaliza', 'PV96AWRM', '$2y$12$BRuLp.YidkhU6frIN9v6ge6UQFkwrbH2HI6SaxSRp0HPQcyN.66MS', 'SMK Negeri 2 Bandung', 'Rekayasa Perangkat Lunak', '2025-09-25 20:10:06', '2025-09-25 20:10:06', NULL, 0, NULL, NULL),
(3, 3, 'Budi Santoso', 'PZDHT4PZ', '$2y$12$IQVOr/q9C7MnLhSETfpnaOt30t9Y5ssnVX8CFRPdszdqyGwEoOYBq', 'SMK Negeri 3 Surabaya', 'Multimedia', '2025-09-25 20:10:06', '2025-09-25 20:10:06', NULL, 0, NULL, NULL);

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
('1mgYufpZ0Px8P0tW5ULnBPdTOhzz9fShtNfxL5x4', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiOFdVTTZETW8yZUdWM0cwV0d6eXF0VHhLRm1WWGk3bWJXNmxmSjNRYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9wcm9qZWN0LXdlYi50ZXN0L2V4YW0iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjc6InVzZXJfaWQiO2k6MTtzOjk6InVzZXJfdHlwZSI7czo1OiJhZG1pbiI7czo5OiJ1c2VyX25hbWUiO3M6MTg6IkFkbWluIFVqaWFuIE9ubGluZSI7czoxMDoidXNlcl9lbWFpbCI7czoxNToiYWRtaW5AdWppYW4uY29tIjtzOjEzOiJzZXNzaW9uX3Rva2VuIjtzOjY0OiJ0TFl4cFNXbEpPWWRBWXIzZmxpZXgydTNQbG53RTRaVnJZTWcyM2c4V2YxcjZ5WERHR2dzNllwV3VZMXpudHVkIjt9', 1759322627),
('Hmh9X7wE6NSYYwRUlY0S4JmUjpHZNtuY6oXxXGUY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiS21PenFMbEF1MnJBZmo0Q0tobjNWNm1VMm5TUDh2RHFTU0dwRFVKZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9leGFtIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c2VyX2lkIjtpOjE7czo5OiJ1c2VyX3R5cGUiO3M6NToiYWRtaW4iO3M6OToidXNlcl9uYW1lIjtzOjE4OiJBZG1pbiBVamlhbiBPbmxpbmUiO3M6MTA6InVzZXJfZW1haWwiO3M6MTU6ImFkbWluQHVqaWFuLmNvbSI7czoxMzoic2Vzc2lvbl90b2tlbiI7czo2NDoiME9pdDhMN2d4dE91WERhakNkbUZjakxtbU96YkpQbXFMSGxPMzdXeFBKSjdJQkZ1ZlBSZ3NVSm5RRE1mOHg5dyI7fQ==', 1758857183),
('miRfy4Ov6wOUYRkaEKUrDrt0CPVr6JFyrjjFds1z', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:143.0) Gecko/20100101 Firefox/143.0', 'YTo4OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiRFdGMUZMMFJxbXhQU0VJM2xXM3JJMGg3M2VEbnRYODdpYTc1cTRuQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9leGFtL2NhbmRpZGF0ZSI7fXM6NzoidXNlcl9pZCI7aToxO3M6OToidXNlcl90eXBlIjtzOjc6InBlc2VydGEiO3M6OToidXNlcl9uYW1lIjtzOjExOiJBaG1hZCBSaXpraSI7czo5OiJ1c2VyX2NvZGUiO3M6ODoiUFQ4VlpXRUYiO3M6MTM6InNlc3Npb25fdG9rZW4iO3M6NjQ6ImxmeWJ6Z3VuWHY0Wk5LWnp0cWgyaDNjQVVLdXVydXJYVXc1YkJFZjNJR21yWTM0d3o0bnlMRXNyRUhkRFhzaTAiO30=', 1758860447);

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id_soal` bigint UNSIGNED NOT NULL,
  `id_batch` bigint UNSIGNED NOT NULL,
  `pertanyaan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_a` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_b` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_c` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opsi_d` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jawaban_benar` enum('a','b','c','d') COLLATE utf8mb4_unicode_ci NOT NULL,
  `poin` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `id_batch`, `pertanyaan`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `jawaban_benar`, `poin`, `created_at`, `updated_at`) VALUES
(1, 1, 'Apa yang dimaksud dengan HTML?', 'HyperText Markup Language', 'High Tech Modern Language', 'Home Tool Markup Language', 'Hyperlink and Text Markup Language', 'a', 10, '2025-09-25 20:10:05', '2025-09-25 20:10:05'),
(2, 1, 'Fungsi utama dari CSS adalah?', 'Membuat database', 'Menghias tampilan website', 'Membuat server', 'Mengelola data', 'b', 10, '2025-09-25 20:10:05', '2025-09-25 20:10:05'),
(3, 1, 'Apa kepanjangan dari PHP?', 'Personal Home Page', 'PHP: Hypertext Preprocessor', 'Private Home Protocol', 'Public Home Page', 'b', 15, '2025-09-25 20:10:05', '2025-09-25 20:10:05'),
(4, 1, 'Database yang paling populer untuk web adalah?', 'Oracle', 'MySQL', 'PostgreSQL', 'SQLite', 'b', 10, '2025-09-25 20:10:05', '2025-09-25 20:10:05'),
(5, 1, 'Framework PHP yang paling populer adalah?', 'CodeIgniter', 'Laravel', 'Symfony', 'Zend', 'b', 15, '2025-09-25 20:10:05', '2025-09-25 20:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `soal_randomization`
--

CREATE TABLE `soal_randomization` (
  `id` bigint UNSIGNED NOT NULL,
  `id_ujian` bigint UNSIGNED NOT NULL,
  `id_peserta` bigint UNSIGNED NOT NULL,
  `soal_order` json NOT NULL,
  `jawaban_order` json NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` bigint UNSIGNED NOT NULL,
  `id_batch` bigint UNSIGNED NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `durasi_menit` int NOT NULL,
  `status` enum('aktif','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ujian`
--

INSERT INTO `ujian` (`id_ujian`, `id_batch`, `tanggal_mulai`, `jam_mulai`, `jam_selesai`, `durasi_menit`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-09-27', '08:00:00', '10:00:00', 120, 'aktif', '2025-09-25 20:10:05', '2025-09-25 20:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `login_attempts` int NOT NULL DEFAULT '0',
  `locked_until` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `last_login_at`, `login_attempts`, `locked_until`) VALUES
(1, 'Admin Ujian Online', 'admin@ujian.com', '2025-09-25 20:01:55', '$2y$12$YckYa9uMer6/TZq2imzcM.iWFrNuAy1Cz9vWhajzB18WEPdOFotNK', 'admin', NULL, '2025-09-25 20:01:55', '2025-10-01 05:43:45', '2025-10-01 05:43:45', 0, NULL),
(3, 'Admin', 'admin', NULL, '$2y$12$YckYa9uMer6/TZq2imzcM.iWFrNuAy1Cz9vWhajzB18WEPdOFotNK', 'admin', NULL, '2025-10-01 13:05:05', '2025-10-01 13:05:05', NULL, 0, NULL),
(4, 'Peserta 1', 'PT8VZWEF', NULL, '$2y$12$gxKCBJku4pqqwk9AUOm74O1zS16i4duVqodrESYjAAWd572T6QXr6', 'user', NULL, '2025-10-01 13:05:30', '2025-10-01 13:05:30', NULL, 0, NULL),
(5, 'Peserta 2', 'PV96AWRM', NULL, '$2y$12$gxKCBJku4pqqwk9AUOm74O1zS16i4duVqodrESYjAAWd572T6QXr6', 'user', NULL, '2025-10-01 13:05:30', '2025-10-01 13:05:30', NULL, 0, NULL),
(6, 'Peserta 3', 'PZDHT4PZ', NULL, '$2y$12$gxKCBJku4pqqwk9AUOm74O1zS16i4duVqodrESYjAAWd572T6QXr6', 'user', NULL, '2025-10-01 13:05:30', '2025-10-01 13:05:30', NULL, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_id_ujian_foreign` (`id_ujian`),
  ADD KEY `activity_logs_user_type_user_id_index` (`user_type`,`user_id`),
  ADD KEY `activity_logs_action_created_at_index` (`action`,`created_at`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id_batch`);

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
-- Indexes for table `face_logs`
--
ALTER TABLE `face_logs`
  ADD PRIMARY KEY (`id_face_log`),
  ADD KEY `face_logs_id_peserta_foreign` (`id_peserta`),
  ADD KEY `face_logs_id_ujian_foreign` (`id_ujian`);

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
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `jawaban_id_ujian_foreign` (`id_ujian`),
  ADD KEY `jawaban_id_peserta_foreign` (`id_peserta`),
  ADD KEY `jawaban_id_soal_foreign` (`id_soal`);

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
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `laporan_id_ujian_foreign` (`id_ujian`),
  ADD KEY `laporan_id_peserta_foreign` (`id_peserta`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`),
  ADD KEY `soal_id_batch_foreign` (`id_batch`);

--
-- Indexes for table `soal_randomization`
--
ALTER TABLE `soal_randomization`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `soal_randomization_id_ujian_id_peserta_unique` (`id_ujian`,`id_peserta`),
  ADD KEY `soal_randomization_id_peserta_foreign` (`id_peserta`),
  ADD KEY `soal_randomization_id_ujian_is_active_index` (`id_ujian`,`is_active`);

--
-- Indexes for table `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id_ujian`),
  ADD KEY `ujian_id_batch_foreign` (`id_batch`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id_batch` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `soal_randomization`
--
ALTER TABLE `soal_randomization`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_id_ujian_foreign` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`) ON DELETE SET NULL;

--
-- Constraints for table `face_logs`
--
ALTER TABLE `face_logs`
  ADD CONSTRAINT `face_logs_id_peserta_foreign` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`) ON DELETE CASCADE,
  ADD CONSTRAINT `face_logs_id_ujian_foreign` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`) ON DELETE CASCADE;

--
-- Constraints for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban_id_peserta_foreign` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`) ON DELETE CASCADE,
  ADD CONSTRAINT `jawaban_id_soal_foreign` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id_soal`) ON DELETE CASCADE,
  ADD CONSTRAINT `jawaban_id_ujian_foreign` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`) ON DELETE CASCADE;

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_id_peserta_foreign` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`) ON DELETE CASCADE,
  ADD CONSTRAINT `laporan_id_ujian_foreign` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`) ON DELETE CASCADE;

--
-- Constraints for table `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `soal_id_batch_foreign` FOREIGN KEY (`id_batch`) REFERENCES `batches` (`id_batch`) ON DELETE CASCADE;

--
-- Constraints for table `soal_randomization`
--
ALTER TABLE `soal_randomization`
  ADD CONSTRAINT `soal_randomization_id_peserta_foreign` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`) ON DELETE CASCADE,
  ADD CONSTRAINT `soal_randomization_id_ujian_foreign` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`) ON DELETE CASCADE;

--
-- Constraints for table `ujian`
--
ALTER TABLE `ujian`
  ADD CONSTRAINT `ujian_id_batch_foreign` FOREIGN KEY (`id_batch`) REFERENCES `batches` (`id_batch`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
