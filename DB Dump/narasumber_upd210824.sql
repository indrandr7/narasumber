-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2024 at 06:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sion`
--

-- --------------------------------------------------------

--
-- Table structure for table `bagian`
--

CREATE TABLE `bagian` (
  `id_bagian` int(11) NOT NULL,
  `id_biro` int(11) DEFAULT NULL,
  `nama_bagian` varchar(200) DEFAULT NULL,
  `nama_pejabat` varchar(200) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bagian`
--

INSERT INTO `bagian` (`id_bagian`, `id_biro`, `nama_bagian`, `nama_pejabat`, `nip`) VALUES
(1, 1, 'Pokja Hukum dan Kepegawaian', 'Supriadi', '0987654321'),
(3, 2, 'Pokja Kebijakan Energi', 'Lisa Ambarsari, S.T., M.S.E.', '197404121999032002'),
(4, 1, 'Tim IT', 'Ricky Pratama', '199001212019021001');

-- --------------------------------------------------------

--
-- Table structure for table `bendahara`
--

CREATE TABLE `bendahara` (
  `id_bendahara` int(11) NOT NULL,
  `namalengkap` varchar(200) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `tahun` int(4) DEFAULT NULL,
  `is_delete` varchar(3) DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bendahara`
--

INSERT INTO `bendahara` (`id_bendahara`, `namalengkap`, `nip`, `tahun`, `is_delete`) VALUES
(2, 'Suprianto Rachman, S.E.', '198604222015031003', 2024, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `biro`
--

CREATE TABLE `biro` (
  `id_biro` int(11) NOT NULL,
  `nama_biro` varchar(250) DEFAULT NULL,
  `nama_pejabat` varchar(100) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `biro`
--

INSERT INTO `biro` (`id_biro`, `nama_biro`, `nama_pejabat`, `nip`) VALUES
(1, 'Biro Umum', 'M. Halim Sariwardana, S.T., M.M.', '197407072002121002'),
(2, 'Biro Fasilitasi Kebijakan Energi dan Persidangan', 'Ir. Yunus Saefulhak, M.M., M.T.', '196607301994031001'),
(3, 'Biro Fasilitasi Penanggulangan Krisis dan Pengawasan Energi', 'Ir. Sujatmiko', '196505191995031001');

-- --------------------------------------------------------

--
-- Table structure for table `eselon`
--

CREATE TABLE `eselon` (
  `id_eselon` int(11) NOT NULL,
  `eselon` varchar(50) DEFAULT NULL,
  `sbm` int(11) DEFAULT NULL,
  `tahun_` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eselon`
--

INSERT INTO `eselon` (`id_eselon`, `eselon`, `sbm`, `tahun_`) VALUES
(1, 'Pejabat Setingkat Menteri', 1700000, 2024),
(2, 'Eselon I', 1400000, 2024),
(3, 'Eselon II', 1000000, 2024),
(4, 'Eselon III', 900000, 2024),
(7, 'Eselon IV', 900000, NULL),
(8, 'Staff', 900000, NULL);

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
-- Table structure for table `golongan`
--

CREATE TABLE `golongan` (
  `id_golongan` int(11) NOT NULL,
  `golongan` varchar(50) DEFAULT NULL,
  `pph` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `golongan`
--

INSERT INTO `golongan` (`id_golongan`, `golongan`, `pph`) VALUES
(1, 'I', 0),
(2, 'II', 0),
(3, 'III', 5),
(4, 'IV', 15);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int(11) NOT NULL,
  `kode_kegiatan` varchar(50) DEFAULT NULL,
  `nama_kegiatan` text DEFAULT NULL,
  `id_mak` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `tempat` text DEFAULT NULL,
  `file_undangan` varchar(200) DEFAULT NULL,
  `file_laporankegiatan` varchar(200) DEFAULT NULL,
  `id_users` int(11) DEFAULT NULL,
  `id_bagian` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `kode_kegiatan`, `nama_kegiatan`, `id_mak`, `tanggal`, `tempat`, `file_undangan`, `file_laporankegiatan`, `id_users`, `id_bagian`, `created_at`, `updated_at`) VALUES
(37, '7iASkgF8px', 'Pembahasan rumusan rekomendasi langkah-langkah strategis yang akan mendukung implementasi kebijakan dan strategi dekarbonisasi sektor energi terkait Kebijakan Pengembangan dan Pemanfaatan Methanol dan Dimethyl Ether (DME)', 5, '2024-06-11', 'Ruang Rapat Serbaguna PT PLN (Persero) UIP2B,  Jalan JCC, Cinere, Depok, Jawa Barat', 'undangan 11 juni_1724054053.pdf', NULL, 6, 3, '2024-08-19 14:54:13', NULL),
(38, 'GjkJRb9ePY', 'Focus Group Discussion pembahasan Rancangan  Peraturan Pemerintah tentang Kebijakan Energi Nasional (RPP KEN)', 5, '2024-08-06', 'Ruang Rapat Serbaguna PT PLN (Persero) UIP2B,  Jalan JCC, Cinere, Depok, Jawa Barat', '509UND Rapat Teknis Persiapan FGD_1724054487.pdf', '2024.06.08 laporan KE Depok_1724054626.docx', 6, 3, '2024-08-19 15:01:27', '2024-08-19 15:03:46'),
(39, 'QDgrcHvyzw', 'Proses penyusunan policy paper terkait PLTN', 5, '2024-08-13', 'Ruang Rapat Inovasi PT PLN (Persero) UITJBB, Depok', 'Und 13 Juni lengkap_1724055399.pdf', NULL, 6, 3, '2024-08-19 15:16:39', NULL),
(40, 's6bc7iPvSr', 'Rapat Koordinasi penyusunan kajian komprehensif kesiapan dan rencana pembangunan PLTN dan pembentukan Tim Percepatan Pembangunan PLTN (NEPIO)', 5, '2024-08-09', 'Ruang Rapat Lantai 2 PPSDMA KESDM Bandung', '522UND Rapat Pembahasan PLTN_1724056871.pdf', NULL, 6, 3, '2024-08-19 15:41:11', '2024-08-19 15:59:42');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_detail`
--

CREATE TABLE `kegiatan_detail` (
  `id_kegiatandetail` int(11) NOT NULL,
  `id_narasumber` int(11) DEFAULT NULL,
  `kode_kegiatan` varchar(50) DEFAULT NULL,
  `jumlah_jam` int(11) DEFAULT NULL,
  `honor_satujam` int(11) DEFAULT NULL,
  `jumlahhonor` varchar(11) DEFAULT NULL,
  `pph` int(11) DEFAULT NULL,
  `potongan_pph` float DEFAULT NULL,
  `jumlah_bayar` float DEFAULT NULL,
  `file_surattugas` varchar(100) DEFAULT NULL,
  `is_sppd` varchar(3) DEFAULT NULL COMMENT 'yes,no',
  `nominal_sppd` int(11) DEFAULT 0,
  `file_kwitansi` varchar(100) DEFAULT NULL,
  `is_transfer` varchar(3) DEFAULT 'no' COMMENT 'yes,no',
  `no_spm` varchar(50) DEFAULT NULL,
  `tanggal_transfer` date DEFAULT NULL,
  `file_transfer` varchar(100) DEFAULT NULL,
  `is_verified` varchar(50) DEFAULT 'no' COMMENT 'yes,no',
  `verified_comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kegiatan_detail`
--

INSERT INTO `kegiatan_detail` (`id_kegiatandetail`, `id_narasumber`, `kode_kegiatan`, `jumlah_jam`, `honor_satujam`, `jumlahhonor`, `pph`, `potongan_pph`, `jumlah_bayar`, `file_surattugas`, `is_sppd`, `nominal_sppd`, `file_kwitansi`, `is_transfer`, `no_spm`, `tanggal_transfer`, `file_transfer`, `is_verified`, `verified_comment`, `created_at`, `updated_at`) VALUES
(46, 13, '7iASkgF8px', 2, 1000000, '2000000', 15, 300000, 1700000, '', 'no', NULL, '', 'no', NULL, NULL, NULL, 'no', NULL, '2024-08-19 07:57:32', NULL),
(47, 10, 'GjkJRb9ePY', 1, 900000, '900000', 15, 135000, 765000, 'Surat Tugas Komisi RPP KEN 060824_1724054516.pdf', 'no', 0, 'Surat Tugas Komisi RPP KEN 060824_1724054516.pdf', 'yes', '-', '2024-08-06', 'WhatsApp Image 2024-08-09 at 15.05.33_ad6b8802_1724054609.jpg', 'no', NULL, '2024-08-19 08:01:56', '2024-08-19 08:03:29'),
(48, 12, 'GjkJRb9ePY', 1, 900000, '900000', 15, 135000, 765000, 'Surat Tugas Komisi RPP KEN 060824_1724054527.pdf', 'no', 0, 'Surat Tugas Komisi RPP KEN 060824_1724054527.pdf', 'yes', '-', '2024-08-06', 'WhatsApp Image 2024-08-09 at 15.06.09_989788e9_1724054596.jpg', 'no', NULL, '2024-08-19 08:02:07', '2024-08-19 08:03:16'),
(49, 11, 'GjkJRb9ePY', 1, 900000, '900000', 15, 135000, 765000, 'Surat Tugas Komisi RPP KEN 060824_1724054535.pdf', 'no', 0, 'Surat Tugas Komisi RPP KEN 060824_1724054535.pdf', 'yes', '-', '2024-08-06', 'WhatsApp Image 2024-08-09 at 15.05.47_f05f2a1a_1724054580.jpg', 'no', NULL, '2024-08-19 08:02:15', '2024-08-19 08:03:00'),
(50, 15, 'QDgrcHvyzw', 2, 1000000, '2000000', 15, 300000, 1700000, 'ST Narsum_1724055517.pdf', 'no', NULL, '', 'no', NULL, NULL, NULL, 'no', NULL, '2024-08-19 08:18:37', NULL),
(51, 15, 's6bc7iPvSr', 3, 900000, '2700000', 15, 405000, 2295000, '', 'no', NULL, '', 'no', NULL, NULL, NULL, 'no', NULL, '2024-08-19 08:45:33', NULL),
(52, 17, 's6bc7iPvSr', 3, 1000000, '3000000', 15, 450000, 2550000, '', 'no', NULL, '', 'no', NULL, NULL, NULL, 'no', NULL, '2024-08-19 08:59:53', NULL),
(53, 16, 's6bc7iPvSr', 3, 1000000, '3000000', 15, 450000, 2550000, '', 'no', NULL, '', 'no', NULL, NULL, NULL, 'no', NULL, '2024-08-19 09:00:41', NULL),
(54, 18, 's6bc7iPvSr', 3, 1400000, '4200000', 15, 630000, 3570000, '', 'no', NULL, '', 'no', NULL, NULL, NULL, 'no', NULL, '2024-08-19 09:07:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mak`
--

CREATE TABLE `mak` (
  `id_mak` int(11) NOT NULL,
  `id_bagian` int(11) DEFAULT NULL,
  `kodemak` varchar(50) DEFAULT NULL,
  `namakegiatan` varchar(250) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mak`
--

INSERT INTO `mak` (`id_mak`, `id_bagian`, `kodemak`, `namakegiatan`, `tahun`) VALUES
(5, 3, '020.07.WA.6382.ABI.030.055.A.52151', 'Pembaruan KEN', 2024);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_19_050924_create_kegiatans_table', 2),
(6, '2024_03_22_030207_create_narsums_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `narasumber`
--

CREATE TABLE `narasumber` (
  `id_narasumber` int(11) NOT NULL,
  `namalengkap` varchar(100) DEFAULT NULL,
  `nomor_identitas` varchar(50) DEFAULT NULL,
  `status_kepegawaian` varchar(50) DEFAULT NULL COMMENT 'asn,nonasn',
  `jabatan` varchar(100) DEFAULT NULL,
  `id_eselon` int(11) DEFAULT NULL,
  `id_golongan` int(11) DEFAULT NULL,
  `nomor_telpon` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nama_bank` varchar(50) DEFAULT NULL,
  `nomor_rekening` varchar(50) DEFAULT NULL,
  `nama_rekening` varchar(100) DEFAULT NULL,
  `nomor_npwp` varchar(50) DEFAULT NULL,
  `file_npwp` varchar(50) DEFAULT NULL,
  `unitkerja` varchar(100) DEFAULT NULL,
  `alamat_unitkerja` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `narasumber`
--

INSERT INTO `narasumber` (`id_narasumber`, `namalengkap`, `nomor_identitas`, `status_kepegawaian`, `jabatan`, `id_eselon`, `id_golongan`, `nomor_telpon`, `email`, `nama_bank`, `nomor_rekening`, `nama_rekening`, `nomor_npwp`, `file_npwp`, `unitkerja`, `alamat_unitkerja`, `created_at`, `updated_at`) VALUES
(10, 'Dwiyanti Suhaili', '196903131990032002', 'asn', 'Kabag. Sekretariat, Komisi VII DPR RI', 4, 4, '081219482440', 'dwiyanti.suhaili@dpr.go.id', 'Mandiri', '1020000024221', 'Dwiyanti Suhaili', '49.965.379.8-035.001', 'Dwiyanti_1723175403.png', 'Sekretariat Jenderal Dewan Perwakilan Rakyat', 'JLN. JENDERAL GATOT SUBROTO JAKARTA', '2024-08-09 10:58:32', NULL),
(11, 'Rachmat Hidayansyah', '11-0697', 'nonasn', 'Tenaga Ahli, Komisi VII DPR RI', 7, 4, '081213777467', 'rachmat.hidayansyah@dpr.go.id', 'Mandiri', '1220004218999', 'Rachmat Hidayansyah', '68.988.770.1-451.000', 'Rachmat_1723175659.png', 'Sekretariat Jenderal Dewan Perwakilan Rakyat', 'JLN. JENDERAL GATOT SUBROTO JAKARTA', '2024-08-09 11:08:00', NULL),
(12, 'Misbakhul Hidayat', '196807041993021001', 'asn', 'Kasubbag Rapat Sekretariat Komisi VII DPR RI', 7, 4, '081288428729', 'misbakhul.hidayat@dpr.go.id', 'Mandiri', '1020000024270', 'Misbakhul Hidayat', '47.799.212.7-005.000', 'misbakhul_1723175848.png', 'Sekretariat Jenderal Dewan Perwakilan Rakyat', 'JLN. JENDERAL GATOT SUBROTO JAKARTA', '2024-08-09 10:58:07', NULL),
(13, 'Dr. Cuk Supriyadi Ali Nandar, S.T, M. Eng', '198001152006041004', 'asn', 'Kepala Pusat Riset Konversi dan Konservasi Energi', 3, 4, '081119333592', 'supriyandi.nandar@brin.go.id', 'Bank BRI', '176001000087538', 'Cuk Supriyadi Ali Nandar', '255963027524000', '', 'BRIN, Pusat Riset Konversi dan Konservasi Energi', 'Gedung 720 KST BJ. Habibie, Serpong, Setu, Tangerang Selatan', '2024-08-19 14:41:27', NULL),
(14, 'Dr. Ir. Erlan Rosyadi, M.Eng', '196709121995011001', 'asn', 'Perekayasa Ahli Madya', 4, 4, '-', 'erlan.rosyadi@brin.go.id', 'Bank BRI', '124201004574505', 'Erlan Rosyadi', '774045751411000', '', 'BRIN, Pusat Riset Konversi dan Konservasi Energi', 'Gedung 720 KST BJ. Habibie, Serpong, Setu, Tangerang Selatan', '2024-08-19 14:46:11', NULL),
(15, 'Ir. Sriyana, MT.', '196603191991111001', 'nonasn', 'Pelaksana', 4, 4, '08161342067', 'sriyana@brin.go.id', 'Bank Mandiri', '0700002101298', 'Sriyana', '473334647451000', 'Sriyana NPWP_1724055284.png', 'BRIN, Direktorat Lingkungan Hidup, Kemaritiman, Sumber Daya Alam, dan Ketenaganukliran', 'Gedung B.J. Habibie Jalan M.H. Thamrin Nomor 8, Jakarta Pusat', '2024-08-19 15:43:18', NULL),
(16, 'Dr. Suparman', '196311121991031006', 'asn', 'Pembina Utama Muda', 3, 4, '081311264919', 'suparman@brin.go.id', 'Bank Mandiri', '1260091053495', 'Suparman', '477760102035000', 'Suparman NPWP_1724057522.png', 'BRIN, Direktorat Lingkungan Hidup, Kemaritiman, Sumber Daya Alam, dan Ketenaganukliran', 'Gedung B.J. Habibie Jalan M.H. Thamrin Nomor 8, Jakarta Pusat', '2024-08-19 15:52:02', NULL),
(17, 'Ir. Yarianto Sugeng Budi Susilo, M.Si', '196601061993031004', 'nonasn', 'Pengembang Teknologi Nuklir Ahli Utama', 3, 4, '081286074714', 'yarianto.susilo@brin.go.id', 'Bank BRI', '034101030050500', 'Yarianto Sugeng Budi Susilo', '098145469412000', NULL, 'BRIN, Direktorat Lingkungan Hidup, Kemaritiman, Sumber Daya Alam, dan Ketenaganukliran', 'Gedung B.J. Habibie Jalan M.H. Thamrin Nomor 8, Jakarta Pusat', '2024-08-19 15:55:13', NULL),
(18, 'Zaenal Arifin', '-', 'asn', 'Deputi Perizinan Fasilitas Radiasi dan Zat Radioaktif Badan Pengawas Tenaga Nuklir Indonesia', 2, 4, '-', 'zaenal.arifin@bapeten.go.id', '-', '-', '-', '-', '', 'Bapeten', 'Jl. Gajah Mada No.8 1, RT.1/RW.2, Petojo Utara, Kecamatan Gambir, Kota Jakarta Pusat', '2024-08-19 16:06:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ppk`
--

CREATE TABLE `ppk` (
  `id_ppk` int(11) NOT NULL,
  `namalengkap` varchar(200) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `tahun` int(4) DEFAULT NULL,
  `is_delete` varchar(3) DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ppk`
--

INSERT INTO `ppk` (`id_ppk`, `namalengkap`, `nip`, `tahun`, `is_delete`) VALUES
(2, 'Dwi Usman Saputra, S.E., M.B.A.', '198510122014021003', 2024, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `id_user_level` int(11) DEFAULT NULL,
  `is_active` varchar(3) DEFAULT 'yes' COMMENT 'yes,no',
  `id_bagian` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `id_user_level`, `is_active`, `id_bagian`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', 'pratamaricky@gmail.com', NULL, '$2y$12$TpSJ77kBtTdlHK1a/CnBae9dQD3hJFcAtIcI1RDy1wT5X6.wg8xCG', NULL, 1, 'yes', 4, '2024-03-18 21:21:07', '2024-08-09 03:30:02'),
(3, 'Operator', 'operator', 'admin1@admin.com', NULL, '$2y$12$iC5z.vHeqnnDO2caZgHeWOUSWU95/.fRlzfx79OHa90oP1Pu5erM2', NULL, 2, 'yes', 3, '2024-04-15 07:47:18', '2024-08-09 03:30:21'),
(4, 'Verifikator', 'verifikator', 'admin2@admin.com', NULL, '$2y$12$cLsmDBPL6eAHkjzWp2YlPexTCIMw8LyJowOxTvSuwH0z3rDt4ctBu', NULL, 3, 'yes', 3, '2024-04-15 07:47:58', '2024-08-09 03:30:39'),
(6, 'Bevy Saragi Sitio, A.Md.', 'bevy', 'bevy.sitio@esdm.go.id', NULL, '$2y$12$szA8JQYgrrPgdD6MGHkgve1y4W5LCroDIYAbEgqFsblsdOsLTEgcC', NULL, 2, 'yes', 3, '2024-08-09 07:27:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_level`
--

CREATE TABLE `users_level` (
  `id_user_level` int(11) NOT NULL,
  `level` varchar(50) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_level`
--

INSERT INTO `users_level` (`id_user_level`, `level`, `keterangan`) VALUES
(1, 'administrator', NULL),
(2, 'operator', NULL),
(3, 'verifikator', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bagian`
--
ALTER TABLE `bagian`
  ADD PRIMARY KEY (`id_bagian`),
  ADD KEY `Ref_02` (`id_biro`);

--
-- Indexes for table `bendahara`
--
ALTER TABLE `bendahara`
  ADD PRIMARY KEY (`id_bendahara`);

--
-- Indexes for table `biro`
--
ALTER TABLE `biro`
  ADD PRIMARY KEY (`id_biro`);

--
-- Indexes for table `eselon`
--
ALTER TABLE `eselon`
  ADD PRIMARY KEY (`id_eselon`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`id_golongan`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`),
  ADD UNIQUE KEY `kode_kegiatan` (`kode_kegiatan`),
  ADD KEY `Ref_08` (`id_mak`);

--
-- Indexes for table `kegiatan_detail`
--
ALTER TABLE `kegiatan_detail`
  ADD PRIMARY KEY (`id_kegiatandetail`),
  ADD KEY `Ref_06` (`id_narasumber`);

--
-- Indexes for table `mak`
--
ALTER TABLE `mak`
  ADD PRIMARY KEY (`id_mak`),
  ADD KEY `fk_bagian` (`id_bagian`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `narasumber`
--
ALTER TABLE `narasumber`
  ADD PRIMARY KEY (`id_narasumber`),
  ADD KEY `Ref_04` (`id_golongan`),
  ADD KEY `Ref_05` (`id_eselon`);

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
-- Indexes for table `ppk`
--
ALTER TABLE `ppk`
  ADD PRIMARY KEY (`id_ppk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `fk_leveluser` (`id_user_level`),
  ADD KEY `fk_bagian2` (`id_bagian`);

--
-- Indexes for table `users_level`
--
ALTER TABLE `users_level`
  ADD PRIMARY KEY (`id_user_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bagian`
--
ALTER TABLE `bagian`
  MODIFY `id_bagian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bendahara`
--
ALTER TABLE `bendahara`
  MODIFY `id_bendahara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `biro`
--
ALTER TABLE `biro`
  MODIFY `id_biro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `eselon`
--
ALTER TABLE `eselon`
  MODIFY `id_eselon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `golongan`
--
ALTER TABLE `golongan`
  MODIFY `id_golongan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `kegiatan_detail`
--
ALTER TABLE `kegiatan_detail`
  MODIFY `id_kegiatandetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `mak`
--
ALTER TABLE `mak`
  MODIFY `id_mak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `narasumber`
--
ALTER TABLE `narasumber`
  MODIFY `id_narasumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ppk`
--
ALTER TABLE `ppk`
  MODIFY `id_ppk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_level`
--
ALTER TABLE `users_level`
  MODIFY `id_user_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bagian`
--
ALTER TABLE `bagian`
  ADD CONSTRAINT `Ref_02` FOREIGN KEY (`id_biro`) REFERENCES `biro` (`id_biro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD CONSTRAINT `Ref_08` FOREIGN KEY (`id_mak`) REFERENCES `mak` (`id_mak`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kegiatan_detail`
--
ALTER TABLE `kegiatan_detail`
  ADD CONSTRAINT `Ref_06` FOREIGN KEY (`id_narasumber`) REFERENCES `narasumber` (`id_narasumber`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mak`
--
ALTER TABLE `mak`
  ADD CONSTRAINT `fk_bagian` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id_bagian`);

--
-- Constraints for table `narasumber`
--
ALTER TABLE `narasumber`
  ADD CONSTRAINT `Ref_04` FOREIGN KEY (`id_golongan`) REFERENCES `golongan` (`id_golongan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Ref_05` FOREIGN KEY (`id_eselon`) REFERENCES `eselon` (`id_eselon`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_bagian2` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id_bagian`),
  ADD CONSTRAINT `fk_leveluser` FOREIGN KEY (`id_user_level`) REFERENCES `users_level` (`id_user_level`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
