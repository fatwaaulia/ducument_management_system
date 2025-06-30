-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 13, 2025 at 04:01 AM
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
-- Database: `ci4_lab`
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
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int NOT NULL,
  `created_by` bigint NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(260) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sampul` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `konten` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `viewed` bigint NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `created_by`, `judul`, `slug`, `sampul`, `konten`, `viewed`, `created_at`, `updated_at`) VALUES
(2, 1, 'Sertifikat Propeka Dengan Penyelenggara Dari Lembaga Sertifikasi Profesi (LSP)', 'sertifikat-propeka-dengan-penyelenggara-dari-lembaga-sertifikasi-profesi-lsp', '1717770190_6690a2921adfacc2e870.jpg', '<p><span style=\"font-size: 16px;\">Sertifikat Propeka adalah sertifikat kompetensi profesi yang diberikan oleh Lembaga Sertifikasi Profesi (LSP) Propeka kepada individu yang telah memenuhi standar kompetensi tertentu dalam bidang keahlian mereka. Sertifikat ini bertujuan untuk meningkatkan daya saing dan profesionalisme tenaga kerja di Indonesia.</span><br></p>', 43, '2024-06-07 21:23:10', '2024-10-25 07:42:20'),
(6, 1, 'Om Putin Semringah Karena Yo Ndak Tau, Rusian Army Go War III', 'om-putin-semringah-karena-yo-ndak-tau-rusian-army-go-war-iii', '1721448111_7eb01e0f3e9643dfd9dd.jpg', '<p>asdlakl asndlkadlkm alksdlasdlk maslkdmlaks mdlasmdklmaslkdmlka mlsdsadamslkd masld lksajdkl jaslkdj lkasdlk asd kalsjdlk ajsdlkj alksjd askl jdasd lkasjdlk jaslkdjlka sasldakl <span style=\"font-size: 15px; color: var(--dark-theme-white-color); background-color: var(--bs-card-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">asdlakl asndlkadlkm alksdlasdlk maslkdmlaks mdlasmdklmaslkdmlka mlsdsadamslkd masld lksajdkl jaslkdj lkasdlk asd kalsjdlk ajsdlkj alksjd askl jdasd lkasjdlk jaslkdjlka sasldakl </span><span style=\"font-size: 15px; color: var(--dark-theme-white-color); background-color: var(--bs-card-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">asdlakl asndlkadlkm alksdlasdlk maslkdmlaks mdlasmdklmaslkdmlka mlsdsadamslkd masld lksajdkl jaslkdj lkasdlk asd kalsjdlk ajsdlkj alksjd askl jdasd lkasjdlk jaslkdjlka sasldakl</span></p>', 81, '2024-07-20 11:01:51', '2024-12-20 18:06:16'),
(7, 1, 'Kerja Kerja Kerja Semangat', 'kerja-kerja-kerja-semangat', '1729669040_b4d321cf5771f0cf0f36.jpg', '<p><img src=\"http://localhost:8080/assets/uploads/berita/content_images/34b999caa9e3e395-0.jpg\" data-filename=\"yann-maignan-rRiAzFkJPMo-unsplash.jpg\" style=\"width: 25%;\"><br><br>percobaan dulu ygy.</p>', 1, '2024-10-23 14:36:00', '2024-11-12 14:34:47'),
(8, 2, 'Indonesia Juara Dunia FIFA World Cup 2026', 'indonesia-juara-dunia-fifa-world-cup-2026', '1734504761_d7482ee54f7540cff502.jpg', '<p><b>Breaking News!</b><br><br>Secara mengejutkan timnas indonesia mampu menjuarai Piala Dunia.</p>', 3, '2024-12-18 13:51:00', '2025-02-20 10:27:26'),
(9, 1, 'Indonesia Juara Dunia FIFA World Cup 2026', 'indonesia-juara-dunia-fifa-world-cup-2026-scwym', '1734521401_487e30b3df3e68e30971.jpg', '<p>asdasdasd</p>', 25, '2024-12-18 18:28:00', '2025-05-05 08:42:46'),
(10, 2, 'Suprime Leader Kim Jong Unch', 'suprime-leader-kim-jong-unch', '1734732623_d686e12737caef0615e2.jpg', '<p>Aselole, lorem ipsum dolor <span style=\"font-size: 15px; color: var(--dark-theme-white-color); background-color: var(--bs-card-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">lorem ipsum dolor </span><span style=\"font-size: 15px; color: var(--dark-theme-white-color); background-color: var(--bs-card-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">lorem ipsum dolor </span><span style=\"font-size: 15px; color: var(--dark-theme-white-color); background-color: var(--bs-card-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">lorem ipsum dolor </span><span style=\"font-size: 15px; color: var(--dark-theme-white-color); background-color: var(--bs-card-bg); font-weight: var(--bs-body-font-weight); text-align: var(--bs-body-text-align);\">lorem ipsum dolor</span></p>', 4, '2024-12-21 04:35:00', '2025-04-29 21:42:03');

-- --------------------------------------------------------

--
-- Table structure for table `form_input`
--

CREATE TABLE `form_input` (
  `id` bigint NOT NULL,
  `kode` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
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
(12, 'EHU7P', 'Similique velit veniam alias itaqu', '', 243739, '', '', '', '2025-01-22 07:57:49', '', '', 'Tidak', '2025-02-13 21:13:30', '2025-05-04 10:13:37'),
(13, 'GSAUL', 'Veniam sunt qui eos facere qui', '', 213190, '', '', '', '2025-02-04 13:07:23', '', '', 'Iya', '2025-02-13 21:13:30', '2025-02-13 21:13:30'),
(14, 'TFKTO', 'Consequuntur temporibus doloribus ducimus', '', 19004, '', '', '', '2025-02-12 22:02:44', '', '', 'Iya', '2025-02-13 21:13:30', '2025-02-13 21:13:30'),
(15, 'PAXDQ', 'Vitae sit eosss', '', 160586, '', '', '', '2025-01-17 02:03:28', '', '', 'Iya', '2025-02-13 21:13:30', '2025-05-04 10:03:58');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` bigint NOT NULL,
  `created_by` bigint NOT NULL,
  `gambar` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `judul` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tautan` varchar(2048) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `created_by`, `gambar`, `judul`, `tautan`, `created_at`, `updated_at`) VALUES
(1, 1, 'dummy_592535212.jpg', 'Molestiae sunt deleniti velit et.', 'http://purnawati.go.id/magnam-et-qui-vero-vel-ut-voluptas-et', '2024-12-19 20:11:35', '2024-12-19 20:11:35'),
(2, 2, 'dummy_1916795239.jpg', 'Ex consequatur.', 'http://mandala.net/ut-enim-quasi-quia-deleniti-aperiam.html', '2024-12-19 20:11:35', '2024-12-19 20:11:35'),
(3, 2, 'dummy_1402639638.jpg', 'Molestiae sapiente vel nobis', 'https://www.gunawan.my.id/consequatur-quo-architecto-fugit-aliquid-dolorum-natus', '2024-12-20 05:30:28', '2024-12-20 05:30:28'),
(5, 2, 'dummy_438974928.jpg', 'Omnis beatae recusandae', 'http://www.nasyiah.sch.id/iusto-cumque-unde-est-ad', '2024-12-20 05:31:41', '2024-12-20 05:31:41'),
(6, 1, 'dummy_1613145720.jpg', 'Nulla error nihil rerum', 'http://www.sudiati.net/autem-ut-et-qui-et-et.html', '2024-12-20 05:31:41', '2024-12-20 05:31:41'),
(7, 1, 'dummy_753756337.jpg', 'Omnis nihil ut voluptates ipsa aut', 'http://kuswandari.mil.id/corporis-temporibus-aut-aliquam-repudiandae.html', '2024-12-20 05:31:41', '2024-12-20 05:31:41'),
(8, 2, 'dummy_1730095792.jpg', 'Doloribus neque ratione', 'http://www.rahmawati.net/', '2024-12-20 05:31:41', '2024-12-20 05:31:41'),
(9, 2, 'dummy_171867886.jpg', 'Tempora nostrum magnam eos', 'http://www.gunarto.sch.id/', '2024-12-20 05:31:41', '2024-12-20 05:31:41'),
(10, 1, 'dummy_1695308228.jpg', 'Est aut quis unde', 'http://www.hassanah.sch.id/', '2024-12-20 05:31:41', '2024-12-20 05:31:41'),
(11, 1, 'dummy_1358457529.jpg', 'Voluptate beatae sint eum facilis', 'http://www.latupono.go.id/', '2024-12-20 05:31:41', '2024-12-20 05:31:41'),
(12, 2, 'dummy_1637443188.jpg', 'Iusto harum eius cupiditate', 'http://www.halim.name/', '2024-12-20 05:31:41', '2024-12-20 05:31:41'),
(13, 1, 'dummy_532169034.jpg', 'Aliquid occaecati omnis autem', 'http://haryanto.id/tempore-facilis-totam-dolorem-incidunt-incidunt-distinctio', '2024-12-20 05:31:41', '2024-12-20 05:31:41'),
(14, 1, 'dummy_486249263.jpg', 'Dolorem suscipit unde molestiae', 'http://maryati.biz/', '2024-12-20 05:31:41', '2024-12-20 05:31:41'),
(15, 1, 'dummy_2037382616.jpg', 'Fugit iusto quaerat', 'http://www.andriani.co.id/', '2024-12-20 05:31:41', '2024-12-20 05:31:41'),
(16, 2, 'dummy_1636745884.jpg', 'Ut non dolorem porro', 'https://prakasa.my.id/error-repudiandae-voluptatum-dolorum-labore-labore-excepturi.html', '2024-12-20 05:31:41', '2024-12-20 05:31:41'),
(17, 1, 'dummy_45114566.jpg', 'Voluptatum et et', 'http://www.sudiati.co.id/iure-non-quis-non-esse-quo', '2024-12-20 05:31:41', '2024-12-20 05:31:41'),
(18, 1, 'dummy_999165819.jpg', 'Et ullam occaecati adipisci voluptas', 'https://halim.sch.id/voluptate-illo-aut-voluptate-sit-rerum-similique.html', '2024-12-20 05:31:41', '2024-12-20 05:31:41'),
(19, 1, 'dummy_417981656.jpg', 'Quisquam est non', 'http://farida.sch.id/at-quod-molestiae-asperiores-rerum-eaque', '2024-12-20 05:31:41', '2024-12-20 05:31:41'),
(20, 1, 'dummy_1371343165.jpg', 'Voluptatum sint maxime hic modi', 'http://zulaika.ac.id/repudiandae-sed-nobis-omnis-inventore-saepe-tenetur-amet', '2024-12-20 05:31:41', '2024-12-20 05:31:41'),
(21, 1, 'dummy_635125427.jpg', 'Fugit nam ut', 'http://sitompul.net/perferendis-eligendi-iure-natus-nesciunt-doloribus-neque-quos', '2024-12-20 05:31:41', '2024-12-20 05:31:41'),
(22, 2, 'dummy_191539101.jpg', 'Quidem illo est', 'https://pratiwi.co/ea-non-maiores-sed-et-voluptatem.html', '2024-12-20 05:31:41', '2024-12-20 05:31:41'),
(23, 2, 'dummy_1551580354.jpg', 'Architecto modi ipsa quibusdam autem placeat cupiditate', 'https://nashiruddin.or.id/totam-officiis-beatae-et.html', '2024-12-20 05:31:41', '2024-12-20 05:31:41'),
(24, 2, 'dummy_461552369.jpg', 'Voluptas quibusdam veniam omnis et aut omnis', 'http://uwais.go.id/quas-facere-voluptas-labore-corrupti-soluta.html', '2024-12-20 05:31:41', '2024-12-20 05:31:41'),
(25, 1, 'dummy_1171947159.jpg', 'Iste similique nulla reiciendis aut et voluptates', 'http://www.haryanto.co.id/et-occaecati-exercitationem-sit', '2024-12-20 05:44:39', '2025-04-23 19:04:15'),
(26, 2, 'dummy_1759333613.jpg', 'Mollitia aut dolore reprehenderit omnis delectus repudiandae', 'http://mahendra.in/voluptatem-sequi-velit-omnis-occaecati-non-laudantium-eum-non', '2024-12-20 05:44:39', '2024-12-20 05:44:39'),
(27, 2, 'dummy_493500076.jpg', 'Maiores quam et', 'http://www.pudjiastuti.net/', '2024-12-20 05:44:39', '2024-12-20 05:44:39'),
(29, 2, 'dummy_193632911.jpg', 'Ut et repellat', 'http://www.safitri.in/et-autem-est-laborum-quo-molestias-sit-at', '2024-12-20 05:44:39', '2024-12-20 05:44:39');

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
(1, 'Balitaa', '2024-02-04 20:24:55', '2025-04-26 08:27:22'),
(2, 'PAUD', '2024-05-10 11:06:54', '2025-04-23 14:01:47'),
(3, 'TK', '2024-05-10 11:06:59', '2025-03-18 06:23:58'),
(4, 'SD', '2024-05-10 11:07:05', '2025-02-04 06:42:08'),
(5, 'SMP', '2024-05-10 11:07:22', '2025-03-18 06:24:05'),
(6, 'SMA', '2024-05-10 11:07:26', '2024-05-10 11:07:26'),
(7, 'D3', '2024-05-10 11:07:45', '2024-05-10 11:07:52'),
(8, 'D4 / S1', '2024-05-10 11:08:02', '2024-05-10 11:08:02'),
(9, 'S2', '2024-05-10 11:08:07', '2024-05-10 11:08:07'),
(10, 'S3', '2024-05-10 11:08:13', '2025-02-08 10:23:49'),
(11, 'Kelurahan', '2024-05-10 11:08:26', '2024-05-10 11:08:26'),
(12, 'Kecamatan', '2024-05-10 11:08:31', '2024-05-10 11:08:31'),
(13, 'Sore', '2024-05-10 11:13:17', '2024-05-10 11:13:17'),
(14, 'siang', '2024-05-10 11:13:23', '2024-05-10 11:13:23'),
(15, 'Sekola', '2024-05-10 11:13:38', '2024-05-10 11:13:38'),
(17, 'Bokeso', '2024-05-10 11:14:03', '2024-05-10 11:14:03'),
(18, 'Bass', '2024-05-10 11:14:16', '2024-05-10 11:14:16'),
(19, 'Surabaya', '2024-06-10 08:38:59', '2024-06-10 08:38:59'),
(20, 'Kokoko', '2024-06-10 08:50:06', '2024-06-10 08:50:06'),
(21, 'Jakarta', '2024-06-10 08:50:14', '2024-06-10 08:50:14'),
(22, 'Bandung', '2024-10-17 08:34:20', '2024-10-26 07:28:39'),
(25, 'Apaan tuh', '2024-10-26 08:34:34', '2024-11-17 21:29:16');

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
(39, 1, 1, 'Superadmin', 'superadmin', '::1', 'Success', '2025-06-13 10:41:06', '2025-06-13 10:41:06');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` tinyint NOT NULL,
  `nama` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
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

INSERT INTO `users` (`id`, `id_role`, `nama`, `username`, `email`, `password`, `foto`, `jenis_kelamin`, `alamat`, `no_hp`, `token_reset_password`, `token_reset_password_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Superadmin', 'superadmin', '', '$2y$10$mVEvojJB5S6yx0DpBklmYOFSmvI6k8WqqKuAZxLu7w3dFGBXxXLqa', '1701744923_ef8be205f9a3eefa1576.png', 'Laki-laki', '', '', '', NULL, '2022-10-21 14:14:28', '2025-05-17 07:02:32'),
(2, 2, 'Admin', 'admin', '', '$2y$10$n/OatAFPw/Bto8O/Iu1bHOLAkVnjsXSbT/W.ciOGMPhUge0r.1AyK', '', 'Laki-laki', '', '', '', NULL, '2022-10-21 12:13:48', '2025-06-13 10:08:26'),
(3, 3, 'Fatwa Aulia', '', 'fatwaaulia.fy@gmail.com', '$2y$10$efUkysj0Aln.eesYy1Ft1.C6IS3XrS/PJK87Z8ZE/Otq0MHPS4LKi', '', 'Perempuan', 'Dsn. Lidah RT/RW 002/003', '', 'o8i2DhlfYzwQ6HOF1IGceJDxRv92LGVm', '2024-10-25 05:04:14', '2024-04-27 20:10:01', '2025-04-27 16:55:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_input`
--
ALTER TABLE `form_input`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
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
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `form_input`
--
ALTER TABLE `form_input`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `log_login`
--
ALTER TABLE `log_login`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
