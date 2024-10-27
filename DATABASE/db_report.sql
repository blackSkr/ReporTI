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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_report.laporan: ~4 rows (approximately)
REPLACE INTO `laporan` (`id_laporan`, `jenis_laporan`, `nama_laporan`, `deskripsi_laporan`, `dokumentasi`, `nim`, `nidn`, `tipe_pengguna`, `status`, `tanggal_dibuat`, `tanggal_selesai`) VALUES
	(24, 'Pelaksanaan Mata Kuliah', 'Jam Mata kuliah tabrakan ', 'Pada tanggal 00-00-0000, jam hh.hh bertabarakan antara matkul a dengan matkul b', 'LOGOTIBewarna.png', '236152039', NULL, 'mahasiswa', 'on progress', '2024-10-17 16:26:05', '2024-10-17 08:32:57'),
	(25, 'Pelaksanaan Mata Kuliah', 'Tabrakan', 'Pada tanggal 00-00-0000, jam hh.hh bertabarakan antara matkul a dengan matkul b', 'LOGOTIBewarna.png', '236152022', NULL, 'mahasiswa', 'done', '2024-10-17 16:26:41', '2024-10-17 08:32:32'),
	(26, 'Kekurangan Fasilitas', 'Wifi tidak ada sinyal', 'dari Ruangan L.Kom 4 tidak mendapatkan sinyal dari Wifi TIgedunglama', 'LOGOTIBewarna.png', '236152028', NULL, 'mahasiswa', 'done', '2024-10-17 16:28:00', '2024-10-17 08:33:50'),
	(27, 'Kekurangan Fasilitas', 'kekurangan kursi', 'kekurangan kursi pada ruangan L.Digital', 'LOGOTIBewarna.png', '236152029', NULL, 'mahasiswa', 'done', '2024-10-17 16:28:39', '2024-10-17 08:33:59'),
	(28, 'Kinerja Dosen', 'Dosen tidak ada kabar', 'dosen atas nama bapak A tidak ada hadir dalam pembelajaran pada hari Senin, 00 00 0000 tanpa kabar', 'LOGOTIBewarna.png', '236152040', NULL, 'mahasiswa', 'done', '2024-10-17 16:30:25', '2024-10-17 08:34:18'),
	(29, 'Pelaksanaan Mata Kuliah', 'Tabrakan', 'Pada tanggal 00-00-0000, jam hh.hh bertabarakan antara matkul a dengan matkul b', 'LOGOTIBewarna.png', '236152039', NULL, 'mahasiswa', 'done', '2023-10-21 05:33:13', '2023-10-20 21:36:27'),
	(30, 'Kinerja Dosen', 'Dosen tidak ada kabar', 'dosen atas nama bapak A tidak ada hadir dalam pembelajaran pada hari Senin, 00 00 0000 tanpa kabar', 'LOGOTIBewarna.png', '236152039', NULL, 'mahasiswa', 'done', '2024-10-21 07:33:19', '2024-10-20 23:34:26');

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
	('0000', 'rano', 'admingacor@gmail.com', '$2y$10$5Hu0JX2N.yirz6iUFsbCO.T9J9wTh6HvW/wSf.EalUvx.XPEvz/om'),
	('0811', 'admin1', 'admin1@gmail.com', '$2y$10$5GqwyVtMtQfwuFL2B7SOcuK4VzWHkiFLtMHKom8/eNKZVEBsXj9LK'),
	('0812', 'udin', 'udin@gmail.com', '$2y$10$1o1OG957i6u8DCNcVYHgse67rU/DqWAhFZ3uc6xB33FSp.15bOzr2');

-- Dumping structure for table db_report.tb_dosen
CREATE TABLE IF NOT EXISTS `tb_dosen` (
  `nidn` varchar(11) NOT NULL DEFAULT '',
  `nama` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nidn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_report.tb_dosen: ~0 rows (approximately)
REPLACE INTO `tb_dosen` (`nidn`, `nama`, `email`, `password`) VALUES
	('0123456789', 'Rudi', 'rudi@example.com', '$2y$10$ln/OEHE9cLVOrLX7hFyPn.6C3rIc72HaS9tEkIcCX8Peza.T1wbPG'),
	('02913142', 'BIBIR', 'cvdhskjashasd02@gmail.com', '$2y$10$mBBZ0R5AK.LHZ7ByFTHL7eOyq3IQltrnbj1rnU5k7Ovn8FVeeM6y2');

-- Dumping structure for table db_report.tb_mahasiswa
CREATE TABLE IF NOT EXISTS `tb_mahasiswa` (
  `nim` varchar(50) NOT NULL DEFAULT '0',
  `nama` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_report.tb_mahasiswa: ~4 rows (approximately)
REPLACE INTO `tb_mahasiswa` (`nim`, `nama`, `email`, `password`) VALUES
	('236152022', 'Rendy Jonathan Aritonang', 'rendyaritonang10@gmail.com', '$2y$10$vThFNWo1xNWfl3FouP2/6OKRsdLGSH7qzVs1W8IDsiX/X2oAUi9Eq'),
	('236152028', 'Divink Gigatus Utomo', 'dipink131@gmail.com', '$2y$10$GDC1Pku/NLLgY.dP7T5tr.Bw2TD9Kd9ukp1RQkBlOuYcO10xYhW.6'),
	('236152029', 'Elang Densa Airlangga', 'elangdensaerlangga02@gmail.com', '$2y$10$tToyD5Dq7oFEYS0VSA5Ap.To2jBp/j9ewLg.VP61Cr0xobGEQlKTu'),
	('236152039', 'Brilian Satria Pamungkas', 'briliansatria3@gmail.com', '$2y$10$5Mn1nkS9PmZSYga4FQO7Ue5FVPLXq5S1lOtkxTKczeRsT8aM4fgN6'),
	('236152040', 'Angga Dwi Prastyo', 'anggadwiprastyo12@gmail.com', '$2y$10$5kYnlN3BiVPIY5leWrZI0uZQigzVSJrbhgKUZjbzdFmGiteUFJAxS');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
