-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 09, 2025 at 07:02 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `document_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
  `id` tinyint NOT NULL,
  `nama_aplikasi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_perusahaan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `logo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `favicon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_hp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `maps` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `app_settings`
--

INSERT INTO `app_settings` (`id`, `nama_aplikasi`, `nama_perusahaan`, `deskripsi`, `logo`, `favicon`, `no_hp`, `alamat`, `maps`, `created_at`, `updated_at`) VALUES
(1, 'Web App', 'Humasoft Studio Teknologi', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus aspernatur quasi, magnam porro labore placeat! At reiciendis voluptates non perferendis suscipit rem placeat, voluptatum ea, saepe, eligendi error cum minima.', 'logo.png', 'favicon.png', '0', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Possimus aspernatur quasi.', '', '2024-09-17 13:06:51', '2025-05-29 06:38:25');

-- --------------------------------------------------------

--
-- Table structure for table `dokumen`
--

CREATE TABLE `dokumen` (
  `id` bigint NOT NULL,
  `kategori` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ringkasan` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `dokumen` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_user_tingkat_1` bigint NOT NULL,
  `status_tingkat_1` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at_tingkat_1` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_by` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokumen`
--

INSERT INTO `dokumen` (`id`, `kategori`, `judul`, `ringkasan`, `dokumen`, `id_user_tingkat_1`, `status_tingkat_1`, `updated_at_tingkat_1`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 'INV', 'Penawaran Harga Sistem POS', '', '1751328571_f31e28c2bdaedd7f7584.pdf', 1, 'MENUNGGU PERSETUJUAN', NULL, '2025-07-01 07:09:31', '2025-07-01 07:09:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `form_input`
--

CREATE TABLE `form_input` (
  `id` bigint NOT NULL,
  `kode` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga` int NOT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dokumen_pendukung` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gambar` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_kegiatan` datetime DEFAULT NULL,
  `select_multiple` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `checkbox` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `persetujuan` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_input`
--

INSERT INTO `form_input` (`id`, `kode`, `nama`, `slug`, `harga`, `deskripsi`, `dokumen_pendukung`, `gambar`, `tanggal_kegiatan`, `select_multiple`, `checkbox`, `persetujuan`, `created_at`, `updated_at`) VALUES
(3, 'UDKKB', 'In quiaaa qqdi aasdsd', '', 500000, '', '1747798596_f9372998bacb805caa65.pdf', '', '2025-02-07 20:05:28', '', '', 'Tidak', '2025-02-13 15:57:36', '2025-05-27 18:05:56'),
(4, 'JL4EN', 'Quae cumque aliquam', '', 339796, '', '', '', '2025-01-21 08:35:24', '', '', 'Iya', '2025-02-13 15:57:36', '2025-05-03 20:33:29'),
(5, 'IE7JZ', 'Aut at sequi', '', 479237, '', '', '', '2025-01-27 22:38:55', '', '', 'Tidak', '2025-02-13 15:57:36', '2025-05-04 10:20:31'),
(6, 'KHHZV', 'Inventore porro enim', '', 425992, '', '', '', '2025-01-27 07:02:40', '', '', 'Tidak', '2025-02-13 15:57:36', '2025-05-04 10:12:24'),
(7, 'H9KE2', 'Neque repellendus qui', '', 45687, '', '', '', '2025-02-02 02:09:26', '', '', 'Tidak', '2025-02-13 15:57:36', '2025-05-05 08:44:42'),
(8, 'LFIBG', 'Voluptates asper', '', 262717, '', '', '', '2025-02-13 02:47:09', '', '', 'Iya', '2025-02-13 15:57:36', '2025-05-05 08:44:37'),
(9, 'J8HYS', 'Rerum rem possimus dolorem aut', '', 251047, '', '', '', '2025-02-11 05:25:05', '', '', 'Tidak', '2025-02-13 21:13:30', '2025-02-13 21:13:30'),
(10, 'EWHQF', 'In necessitatibus ipsa quam', '', 190738, '', '', '', '2025-01-28 00:04:37', '', '', 'Tidak', '2025-02-13 21:13:30', '2025-05-03 15:56:50'),
(11, '2LKAN', 'Est illum temporibu', '', 145998, '', '', '', '2025-02-11 02:19:22', '', '', 'Tidak', '2025-02-13 21:13:30', '2025-05-04 10:12:47'),
(13, 'GSAUL', 'Veniam sunt qui eos facere qui', '', 213190, '', '', '', '2025-02-04 13:07:23', '', '', 'Iya', '2025-02-13 21:13:30', '2025-02-13 21:13:30'),
(14, 'TFKTO', 'Consequuntur temporibus doloribus ducimus', '', 19004, '', '', '', '2025-02-12 22:02:44', '', '', 'Iya', '2025-02-13 21:13:30', '2025-02-13 21:13:30'),
(15, 'PAXDQ', 'Vitae sit eosss', '', 160586, '', '', '', '2025-01-17 02:03:28', '', '', 'Iya', '2025-02-13 21:13:30', '2025-05-04 10:03:58');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'INV', '2025-07-01 05:50:27', '2025-07-01 11:58:15'),
(2, 'ATK', '2025-07-01 05:57:07', '2025-07-01 11:58:24');

-- --------------------------------------------------------

--
-- Table structure for table `log_login`
--

CREATE TABLE `log_login` (
  `id` bigint NOT NULL,
  `id_user` bigint NOT NULL,
  `id_role` tinyint NOT NULL,
  `nama_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_login`
--

INSERT INTO `log_login` (`id`, `id_user`, `id_role`, `nama_user`, `username`, `ip_address`, `status`, `created_at`, `updated_at`) VALUES
(6, 0, 0, '', 'superadminasd', '::1', 'Failed', '2025-04-20 11:06:27', '2025-04-20 11:06:27'),
(7, 1, 1, 'Superadmin', 'superadmin', '::1', 'Success', '2025-04-20 11:06:31', '2025-04-20 11:06:31'),
(8, 0, 0, '', 'fatwaaulia@gmail.com', '::1', 'Failed', '2025-04-20 11:07:25', '2025-04-20 11:07:25'),
(9, 1, 1, 'Superadmin', 'superadmin', '::1', 'Success', '2025-04-20 11:07:31', '2025-04-20 11:07:31'),
(10, 1, 1, 'Superadmin', 'superadmin', '::1', 'Success', '2025-04-20 22:08:33', '2025-04-20 22:08:33'),
(12, 2, 2, 'Admin', 'admin', '::1', 'Success', '2025-04-27 16:18:51', '2025-04-27 16:18:51'),
(13, 0, 0, '', 'adminqqqq', '::1', 'Failed', '2025-04-27 16:27:40', '2025-04-27 16:27:40'),
(14, 3, 3, 'Fatwa Aulia', 'fatwaaulia.fy@gmail.com', '::1', 'Success', '2025-04-27 16:29:37', '2025-04-27 16:29:37'),
(15, 2, 2, 'Admin', 'admin', '::1', 'Success', '2025-04-29 19:49:27', '2025-04-29 19:49:27'),
(16, 2, 2, 'Admin', 'admin', '::1', 'Success', '2025-05-01 05:45:54', '2025-05-01 05:45:54'),
(17, 2, 2, 'Admin', 'admin', '::1', 'Success', '2025-05-01 06:47:27', '2025-05-01 06:47:27'),
(18, 2, 2, 'Admin', 'admin', '::1', 'Success', '2025-05-03 06:00:59', '2025-05-03 06:00:59'),
(19, 2, 2, 'Admin', 'admin', '::1', 'Success', '2025-05-05 09:05:37', '2025-05-05 09:05:37'),
(20, 2, 2, 'Admin', 'admin', '::1', 'Success', '2025-05-21 13:26:52', '2025-05-21 13:26:52'),
(21, 3, 3, 'Fatwa Aulia', 'fatwaaulia.fy@gmail.com', '::1', 'Success', '2025-05-21 13:28:07', '2025-05-21 13:28:07'),
(22, 0, 0, '', 'dmin', '::1', 'Failed', '2025-05-22 12:38:16', '2025-05-22 12:38:16'),
(23, 2, 2, 'Admin', 'admin', '::1', 'Success', '2025-05-22 12:38:20', '2025-05-22 12:38:20'),
(24, 2, 2, 'Admin', 'admin', '::1', 'Success', '2025-05-22 12:43:08', '2025-05-22 12:43:08'),
(25, 0, 0, '', 'rnt@himatekkits.com', '::1', 'Failed', '2025-06-01 12:35:38', '2025-06-01 12:35:38'),
(26, 0, 0, '', 'rnt@himatekkits.com', '::1', 'Failed', '2025-06-01 12:35:40', '2025-06-01 12:35:40'),
(27, 2, 2, 'Admin', 'admin', '::1', 'Success', '2025-06-01 12:44:12', '2025-06-01 12:44:12'),
(28, 1, 1, 'Superadmin', 'superadmin', '::1', 'Success', '2025-06-08 22:28:56', '2025-06-08 22:28:56'),
(29, 2, 2, 'Admin', 'admin', '::1', 'Failed', '2025-06-11 11:35:59', '2025-06-11 11:35:59'),
(30, 2, 2, 'Admin', 'admin', '::1', 'Failed', '2025-06-11 11:36:07', '2025-06-11 11:36:07'),
(31, 2, 2, 'Admin', 'admin', '::1', 'Failed', '2025-06-11 11:36:10', '2025-06-11 11:36:10'),
(32, 0, 0, '', 'adminqqq', '::1', 'Failed', '2025-06-11 11:55:55', '2025-06-11 11:55:55'),
(33, 2, 2, 'Admin', 'admin', '::1', 'Success', '2025-06-11 11:55:59', '2025-06-11 11:55:59'),
(34, 2, 2, 'Admin', 'admin', '::1', 'Success', '2025-06-11 11:56:05', '2025-06-11 11:56:05'),
(35, 2, 2, 'Admin', 'admin', '::1', 'Success', '2025-06-11 12:08:44', '2025-06-11 12:08:44'),
(36, 2, 2, 'Admin', 'admin', '::1', 'Success', '2025-06-12 18:10:22', '2025-06-12 18:10:22'),
(37, 2, 2, 'Admin', 'admin', '::1', 'Success', '2025-06-13 05:07:33', '2025-06-13 05:07:33'),
(38, 1, 1, 'Superadmin', 'superadmin', '::1', 'Success', '2025-06-13 10:09:02', '2025-06-13 10:09:02'),
(39, 1, 1, 'Superadmin', 'superadmin', '::1', 'Success', '2025-06-13 10:41:06', '2025-06-13 10:41:06'),
(40, 1, 1, 'Superadmin', 'superadmin', '::1', 'Success', '2025-06-24 09:47:47', '2025-06-24 09:47:47'),
(41, 1, 1, 'Superadmin', 'superadmin', '::1', 'Success', '2025-06-25 07:25:53', '2025-06-25 07:25:53'),
(42, 1, 1, 'Superadmin', 'superadmin', '::1', 'Success', '2025-06-25 13:06:16', '2025-06-25 13:06:16'),
(43, 1, 1, 'Superadmin', 'superadmin', '::1', 'Success', '2025-06-25 19:51:43', '2025-06-25 19:51:43'),
(44, 1, 1, 'Superadmin', 'superadmin', '::1', 'Success', '2025-06-26 10:22:59', '2025-06-26 10:22:59'),
(45, 1, 1, 'Superadmin', 'superadmin', '::1', 'Success', '2025-06-29 05:08:34', '2025-06-29 05:08:34'),
(46, 1, 1, 'Superadmin', 'superadmin', '::1', 'Success', '2025-06-29 11:49:38', '2025-06-29 11:49:38'),
(47, 1, 1, 'Superadmin', 'superadmin', '::1', 'Success', '2025-06-29 16:39:18', '2025-06-29 16:39:18'),
(48, 1, 1, 'Superadmin', 'superadmin', '::1', 'Success', '2025-06-30 14:27:09', '2025-06-30 14:27:09'),
(49, 1, 1, 'Superadmin', 'superadmin', '::1', 'Success', '2025-06-30 20:27:32', '2025-06-30 20:27:32'),
(50, 1, 1, 'Superadmin', 'superadmin', '::1', 'Success', '2025-07-01 04:45:16', '2025-07-01 04:45:16'),
(51, 1, 1, 'Superadmin', 'superadmin', '::1', 'Success', '2025-07-09 13:52:38', '2025-07-09 13:52:38');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` tinyint NOT NULL,
  `nama` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `nama`, `slug`) VALUES
(1, 'Superadmin', 'superadmin'),
(2, 'Admin', 'admin'),
(3, 'Started', 'started');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint NOT NULL,
  `id_role` tinyint NOT NULL,
  `nama_role` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `slug_role` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_hp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token_reset_password` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `token_reset_password_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_role`, `nama_role`, `slug_role`, `nama`, `username`, `email`, `password`, `foto`, `jenis_kelamin`, `alamat`, `no_hp`, `token_reset_password`, `token_reset_password_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Superadmin', 'superadmin', 'Superadmin', 'superadmin', '', '$2y$10$mVEvojJB5S6yx0DpBklmYOFSmvI6k8WqqKuAZxLu7w3dFGBXxXLqa', '1701744923_ef8be205f9a3eefa1576.jpg', 'Laki-laki', '', '', '', NULL, '2022-10-21 14:14:28', '2025-07-09 13:57:19'),
(2, 2, 'Admin', 'admin', 'Admin', 'admin', '', '$2y$10$n/OatAFPw/Bto8O/Iu1bHOLAkVnjsXSbT/W.ciOGMPhUge0r.1AyK', '', 'Laki-laki', '', '', '', NULL, '2022-10-21 12:13:48', '2025-07-09 13:57:23'),
(3, 3, 'Started', 'started', 'Fatwa Aulia', '', 'fatwaaulia.fy@gmail.com', '$2y$10$efUkysj0Aln.eesYy1Ft1.C6IS3XrS/PJK87Z8ZE/Otq0MHPS4LKi', '', 'Perempuan', 'Dsn. Lidah RT/RW 002/003', '', 'o8i2DhlfYzwQ6HOF1IGceJDxRv92LGVm', '2024-10-25 05:04:14', '2024-04-27 20:10:01', '2025-07-09 13:57:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_input`
--
ALTER TABLE `form_input`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_login`
--
ALTER TABLE `log_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `form_input`
--
ALTER TABLE `form_input`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log_login`
--
ALTER TABLE `log_login`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` tinyint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
