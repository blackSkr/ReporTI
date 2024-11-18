-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
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


-- Dumping database structure for db_report
CREATE DATABASE IF NOT EXISTS `db_report` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_report`;

-- Dumping structure for table db_report.laporan
CREATE TABLE IF NOT EXISTS `laporan` (
  `id_laporan` int NOT NULL AUTO_INCREMENT,
  `jenis_laporan` varchar(50) NOT NULL,
  `nama_laporan` varchar(100) NOT NULL,
  `deskripsi_laporan` text,
  `dokumentasi` varchar(255) DEFAULT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `nidn` varchar(50) DEFAULT NULL,
  `tipe_pengguna` enum('mahasiswa','dosen') NOT NULL,
  `status` enum('pending','on progress','done') NOT NULL DEFAULT 'pending',
  `tanggal_dibuat` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_selesai` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_laporan`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
--
-- Dumping data for table db_report.laporan: ~30 rows (approximately)
REPLACE INTO `laporan` (`id_laporan`, `jenis_laporan`, `nama_laporan`, `deskripsi_laporan`, `dokumentasi`, `nim`, `nidn`, `tipe_pengguna`, `status`, `tanggal_dibuat`, `tanggal_selesai`) VALUES
	(62, 'Kinerja Dosen', 'Dosen tidak ada kabar, menghilang', 'dosen atas nama bapak A tidak ada hadir dalam pembelajaran pada hari Senin, 00 00 0000 tanpa kabar', 'LOGOTIBewarna.png', '236152039', NULL, 'mahasiswa', 'pending', '2024-11-18 06:19:02', NULL);

-- Dumping structure for table db_report.tb_admin
CREATE TABLE IF NOT EXISTS `tb_admin` (
  `noadmin` varchar(50) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`noadmin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_report.tb_admin: ~2 rows (approximately)
REPLACE INTO `tb_admin` (`noadmin`, `nama`, `email`, `password`) VALUES
	('12345', 'Budi', 'Budi@gmail.com', '$2y$10$ni4g7HjMbIaflO5q809DBOdPcADRHDBQ4m3IE9LD.4z7Kl..Glt.C'),
	('198506152009121002', 'Amira', 'amira@gmail.com', '$2y$10$FT3B.nnzjo7iq84nKIdWwuGddEqsE6jLUKQR7fwr1mAGS6hzd1d12');

-- Dumping structure for table db_report.tb_dosen
CREATE TABLE IF NOT EXISTS `tb_dosen` (
  `nidn` varchar(11) NOT NULL DEFAULT '',
  `nama` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nidn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_report.tb_dosen: ~2 rows (approximately)
REPLACE INTO `tb_dosen` (`nidn`, `nama`, `email`, `password`) VALUES
	('0310048501', 'Budianto', 'budianto@gmail.com', '$2y$10$cBwK/yKSgnHqVUgdXa4UhuSzZii17uhCALYg27f.KQcP96LygxJyW'),
	('1010028904', 'Olivia', 'olivia@gmail.com', '$2y$10$jQpHV26Q1JVMDhsR9eO12ee6TENJjiNAYIgqwrXjsPeP8BgoiZGdS');

-- Dumping structure for table db_report.tb_mahasiswa
CREATE TABLE IF NOT EXISTS `tb_mahasiswa` (
  `nim` varchar(50) NOT NULL DEFAULT '0',
  `nama` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_report.tb_mahasiswa: ~3 rows (approximately)
REPLACE INTO `tb_mahasiswa` (`nim`, `nama`, `email`, `password`) VALUES
	('236152020', 'dummy', 'dummy@gmail.com', '$2y$10$XRNBBpry/FsjtAtpQGWq5eyq2fqnHpZ3f0vl3kaoFbG1PdkZSvRF.'),
	('236152039', 'Satria', 'briliansatria6@gmail.com', '$2y$10$KtGsPudQIxpYFkMbbUQJ.u6o//ZupBKtsrCvZ1IIlNhTun9JRv4qC'),
	('236152040', 'Angga Dwi Prastyo', 'anggadwiprastyo12@gmail.com', '$2y$10$vieDMcCViXxG0E7PVoqXTeIOqwsC6NCQhsm0zv7.wfwlY0rVj3DHy');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
