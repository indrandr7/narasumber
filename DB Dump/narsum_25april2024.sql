-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.28-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for narsum
CREATE DATABASE IF NOT EXISTS `narsum` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `narsum`;

-- Dumping structure for table narsum.bagian
CREATE TABLE IF NOT EXISTS `bagian` (
  `id_bagian` int(11) NOT NULL AUTO_INCREMENT,
  `id_biro` int(11) DEFAULT NULL,
  `nama_bagian` varchar(200) DEFAULT NULL,
  `nama_pejabat` varchar(200) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_bagian`),
  KEY `Ref_02` (`id_biro`),
  CONSTRAINT `Ref_02` FOREIGN KEY (`id_biro`) REFERENCES `biro` (`id_biro`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table narsum.bagian: ~1 rows (approximately)
INSERT INTO `bagian` (`id_bagian`, `id_biro`, `nama_bagian`, `nama_pejabat`, `nip`) VALUES
	(1, 1, 'Pokja Hukum dan Kepegawaian', 'Supriadi', NULL);

-- Dumping structure for table narsum.bendahara
CREATE TABLE IF NOT EXISTS `bendahara` (
  `id_bendahara` int(11) NOT NULL AUTO_INCREMENT,
  `namalengkap` varchar(200) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `tahun` int(4) DEFAULT NULL,
  `is_delete` varchar(3) DEFAULT 'no',
  PRIMARY KEY (`id_bendahara`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table narsum.bendahara: ~0 rows (approximately)
INSERT INTO `bendahara` (`id_bendahara`, `namalengkap`, `nip`, `tahun`, `is_delete`) VALUES
	(2, 'Suprianto Rachman', '1989xxx', 2024, 'no');

-- Dumping structure for table narsum.biro
CREATE TABLE IF NOT EXISTS `biro` (
  `id_biro` int(11) NOT NULL AUTO_INCREMENT,
  `nama_biro` varchar(250) DEFAULT NULL,
  `nama_pejabat` varchar(100) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_biro`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table narsum.biro: ~3 rows (approximately)
INSERT INTO `biro` (`id_biro`, `nama_biro`, `nama_pejabat`, `nip`) VALUES
	(1, 'Biro Umum', 'M. Halim Sariwardana', NULL),
	(2, 'Biro Fasilitasi Kebijakan Energi dan Persidangan', 'Yunus Saefulhak', NULL),
	(3, 'Biro Fasilitasi Penanggulangan Krisis dan Pengawasan Energi', 'Sujatmiko', NULL);

-- Dumping structure for table narsum.eselon
CREATE TABLE IF NOT EXISTS `eselon` (
  `id_eselon` int(11) NOT NULL AUTO_INCREMENT,
  `eselon` varchar(50) DEFAULT NULL,
  `sbm` int(11) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_eselon`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table narsum.eselon: ~4 rows (approximately)
INSERT INTO `eselon` (`id_eselon`, `eselon`, `sbm`, `tahun`) VALUES
	(1, 'Pejabat Setingkat Menteri', 17000000, 2024),
	(2, 'Eselon I', 1400000, 2024),
	(3, 'Eselon II', 1000000, 2024),
	(4, 'Eselon III', 900000, 2024);

-- Dumping structure for table narsum.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table narsum.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table narsum.golongan
CREATE TABLE IF NOT EXISTS `golongan` (
  `id_golongan` int(11) NOT NULL AUTO_INCREMENT,
  `golongan` varchar(50) DEFAULT NULL,
  `pph` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_golongan`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table narsum.golongan: ~4 rows (approximately)
INSERT INTO `golongan` (`id_golongan`, `golongan`, `pph`) VALUES
	(1, 'I', 0),
	(2, 'II', 0),
	(3, 'III', 5),
	(4, 'IV', 15);

-- Dumping structure for table narsum.kegiatan
CREATE TABLE IF NOT EXISTS `kegiatan` (
  `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kegiatan` varchar(50) DEFAULT NULL,
  `nama_kegiatan` varchar(50) DEFAULT NULL,
  `id_mak` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `tempat` varchar(200) DEFAULT NULL,
  `file_undangan` varchar(200) DEFAULT NULL,
  `file_laporankegiatan` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_kegiatan`),
  UNIQUE KEY `kode_kegiatan` (`kode_kegiatan`),
  KEY `Ref_08` (`id_mak`),
  CONSTRAINT `Ref_08` FOREIGN KEY (`id_mak`) REFERENCES `mak` (`id_mak`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table narsum.kegiatan: ~5 rows (approximately)
INSERT INTO `kegiatan` (`id_kegiatan`, `kode_kegiatan`, `nama_kegiatan`, `id_mak`, `tanggal`, `tempat`, `file_undangan`, `file_laporankegiatan`, `created_at`, `updated_at`) VALUES
	(17, 'rMX5N0hj3W', 'Test', 2, '2024-03-01', 'Pondok Ranji', 'Invoice-4152722_1713161585.pdf', 'laporan-monitoring-capaian_1713161585.pdf', '2024-04-15 06:12:40', '2024-04-15 06:39:05'),
	(18, 'v0H1N5O5j9', 'OKe', 2, '2024-03-07', 'Yes', '', NULL, '2024-04-15 07:10:20', NULL),
	(19, 'ILp2xla4Ar', 'Lomba Makan Krupuk', 2, '2024-04-15', 'Bandung', 'close-up-environment-project_1713165402.jpg', NULL, '2024-04-15 07:16:42', NULL),
	(20, 'gV8eacIt4a', 'Rapat Edit', 2, '2024-04-16', 'Bandung', 'generate-qrcode_1713246212.xlsx', NULL, '2024-04-16 05:43:32', '2024-04-18 03:06:04'),
	(21, 'VItr6uS38E', 'Rapat Ketahanan Energi', 1, '2024-04-18', 'Bandung', 'laporan-monitoring-capaian_1713425486.pdf', NULL, '2024-04-18 07:31:26', NULL);

-- Dumping structure for table narsum.kegiatan_detail
CREATE TABLE IF NOT EXISTS `kegiatan_detail` (
  `id_kegiatandetail` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kegiatandetail`),
  KEY `Ref_06` (`id_narasumber`),
  CONSTRAINT `Ref_06` FOREIGN KEY (`id_narasumber`) REFERENCES `narasumber` (`id_narasumber`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table narsum.kegiatan_detail: ~10 rows (approximately)
INSERT INTO `kegiatan_detail` (`id_kegiatandetail`, `id_narasumber`, `kode_kegiatan`, `jumlah_jam`, `honor_satujam`, `jumlahhonor`, `pph`, `potongan_pph`, `jumlah_bayar`, `file_surattugas`, `is_sppd`, `nominal_sppd`, `file_kwitansi`, `is_transfer`, `no_spm`, `tanggal_transfer`, `file_transfer`, `is_verified`, `verified_comment`, `created_at`, `updated_at`) VALUES
	(16, 1, 'rMX5N0hj3W', 1, 1000000, '1000000', 15, 150000, 850000, NULL, 'no', 0, NULL, 'no', NULL, NULL, NULL, 'no', NULL, '2024-04-14 23:15:33', '2024-04-14 23:23:36'),
	(17, 2, 'rMX5N0hj3W', 2, 900000, '1800000', 5, 90000, 1710000, NULL, 'yes', 1000000, NULL, 'yes', '022/SPM/2024', '2024-04-16', 'WhatsApp Image 2024-02-27 at 09.55.32_1713163846.jpeg', 'yes', 'aaaaa', '2024-04-14 23:24:48', '2024-04-18 00:53:37'),
	(18, 3, 'v0H1N5O5j9', 1, 1400000, '1400000', 15, 210000, 1190000, NULL, 'no', 0, NULL, 'yes', '88', '2024-04-17', NULL, 'no', NULL, '2024-04-15 00:10:29', '2024-04-15 00:10:53'),
	(19, 1, 'ILp2xla4Ar', 1, 1000000, '1000000', 15, 150000, 850000, 'FORM-ABSEN_1713165425.docx', 'no', 0, 'FORM-ABSEN_1713165425.docx', 'yes', '022/SPM/2024', '2024-04-16', 'manohara-hotel_1713165446.PNG', 'no', NULL, '2024-04-15 00:17:05', '2024-04-15 00:17:26'),
	(20, 2, 'ILp2xla4Ar', 1, 900000, '900000', 5, 45000, 855000, NULL, 'yes', 2000000, NULL, 'yes', '88', '2024-04-17', 'manohara-hotel_1713165510.PNG', 'no', NULL, '2024-04-15 00:18:06', '2024-04-15 00:18:30'),
	(21, 1, 'gV8eacIt4a', 1, 1000000, '1000000', 15, 150000, 850000, NULL, 'no', 0, NULL, 'yes', '022/SPM/2024', '2024-04-17', NULL, 'no', NULL, '2024-04-15 22:44:17', '2024-04-15 22:45:38'),
	(22, 8, 'VItr6uS38E', 1, 1000000, '1000000', 15, 150000, 850000, '', 'no', NULL, '', 'no', NULL, NULL, NULL, 'no', NULL, '2024-04-18 00:31:41', NULL),
	(23, 2, 'VItr6uS38E', 1, 900000, '900000', 5, 45000, 855000, '', 'no', NULL, '', 'no', NULL, NULL, NULL, 'no', NULL, '2024-04-18 00:31:49', NULL),
	(24, 3, 'VItr6uS38E', 1, 1400000, '1400000', 15, 210000, 1190000, '', 'no', NULL, '', 'no', NULL, NULL, NULL, 'no', NULL, '2024-04-18 00:31:56', NULL),
	(25, 1, 'VItr6uS38E', 1, 1000000, '1000000', 15, 150000, 850000, '', 'no', NULL, '', 'no', NULL, NULL, NULL, 'no', NULL, '2024-04-18 00:32:03', NULL);

-- Dumping structure for table narsum.mak
CREATE TABLE IF NOT EXISTS `mak` (
  `id_mak` int(11) NOT NULL AUTO_INCREMENT,
  `id_bagian` int(11) DEFAULT NULL,
  `kodemak` varchar(50) DEFAULT NULL,
  `namakegiatan` varchar(250) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mak`),
  KEY `fk_bagian` (`id_bagian`),
  CONSTRAINT `fk_bagian` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id_bagian`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table narsum.mak: ~2 rows (approximately)
INSERT INTO `mak` (`id_mak`, `id_bagian`, `kodemak`, `namakegiatan`, `tahun`) VALUES
	(1, 1, '1234567890', 'Pendukung Prolegnas', 2024),
	(2, 1, '23424212', 'Mendukung Kegiatan Anggota DEN', 2024);

-- Dumping structure for table narsum.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table narsum.migrations: ~6 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_03_19_050924_create_kegiatans_table', 2),
	(6, '2024_03_22_030207_create_narsums_table', 3);

-- Dumping structure for table narsum.narasumber
CREATE TABLE IF NOT EXISTS `narasumber` (
  `id_narasumber` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_narasumber`),
  KEY `Ref_04` (`id_golongan`),
  KEY `Ref_05` (`id_eselon`),
  CONSTRAINT `Ref_04` FOREIGN KEY (`id_golongan`) REFERENCES `golongan` (`id_golongan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Ref_05` FOREIGN KEY (`id_eselon`) REFERENCES `eselon` (`id_eselon`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table narsum.narasumber: ~4 rows (approximately)
INSERT INTO `narasumber` (`id_narasumber`, `namalengkap`, `nomor_identitas`, `status_kepegawaian`, `jabatan`, `id_eselon`, `id_golongan`, `nomor_telpon`, `email`, `nama_bank`, `nomor_rekening`, `nama_rekening`, `nomor_npwp`, `file_npwp`, `unitkerja`, `alamat_unitkerja`, `created_at`, `updated_at`) VALUES
	(1, 'Valentino Rossi', NULL, NULL, NULL, 3, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Kemenkeu', NULL, NULL, NULL),
	(2, 'Michael Schumacher', NULL, NULL, NULL, 4, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Kemendagri', NULL, NULL, NULL),
	(3, 'Mika Hakinen', NULL, NULL, NULL, 2, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL),
	(8, 'Alex Baros', '03333222111', 'asn', 'Kepala Bagian', 3, 4, '08737373737', 'alexbaros@gmail.com', 'Mandiri', '07000228828282', 'Alex Baros', '08828282828', 'laporan-monitoring-capaian_1713236702.pdf', 'Kementerian Pertanian', 'Jakarta', '2024-04-16 03:17:26', NULL);

-- Dumping structure for table narsum.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table narsum.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table narsum.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table narsum.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table narsum.ppk
CREATE TABLE IF NOT EXISTS `ppk` (
  `id_ppk` int(11) NOT NULL AUTO_INCREMENT,
  `namalengkap` varchar(200) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `tahun` int(4) DEFAULT NULL,
  `is_delete` varchar(3) DEFAULT 'no',
  PRIMARY KEY (`id_ppk`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table narsum.ppk: ~0 rows (approximately)
INSERT INTO `ppk` (`id_ppk`, `namalengkap`, `nip`, `tahun`, `is_delete`) VALUES
	(2, 'Usman Saputra', '1989xxx', 2024, 'no');

-- Dumping structure for table narsum.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `fk_leveluser` (`id_user_level`),
  KEY `fk_bagian2` (`id_bagian`),
  CONSTRAINT `fk_bagian2` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id_bagian`),
  CONSTRAINT `fk_leveluser` FOREIGN KEY (`id_user_level`) REFERENCES `users_level` (`id_user_level`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table narsum.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `id_user_level`, `is_active`, `id_bagian`, `created_at`, `updated_at`) VALUES
	(1, 'Administrator', 'admin', 'admin@admin.com', NULL, '$2y$12$XJMlozVXK17ciZvcmQrIyuHWl5DAtlJR0M.TFCLtLRR8rZI2eJ3i2', NULL, 1, 'yes', 1, '2024-03-18 21:21:07', '2024-03-18 21:21:07'),
	(3, 'Operator', 'operator', 'admin1@admin.com', NULL, '$2y$10$FlPQGDjSv.1eVQ53n8.JPeHPLSvY30PRvp.W0eBQxFnNB8A8Z.Wua', NULL, 2, 'yes', 1, '2024-04-15 07:47:18', NULL),
	(4, 'Verifikator', 'verifikator', 'admin2@admin.com', NULL, '$2y$10$FlPQGDjSv.1eVQ53n8.JPeHPLSvY30PRvp.W0eBQxFnNB8A8Z.Wua', NULL, 3, 'yes', NULL, '2024-04-15 07:47:58', NULL);

-- Dumping structure for table narsum.users_level
CREATE TABLE IF NOT EXISTS `users_level` (
  `id_user_level` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(50) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_user_level`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table narsum.users_level: ~2 rows (approximately)
INSERT INTO `users_level` (`id_user_level`, `level`, `keterangan`) VALUES
	(1, 'administrator', NULL),
	(2, 'operator', NULL),
	(3, 'verifikator', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
