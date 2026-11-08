-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.0.30 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk db_manajemen_klub
CREATE DATABASE IF NOT EXISTS `db_manajemen_klub` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_manajemen_klub`;

-- membuang struktur untuk table db_manajemen_klub.klub
CREATE TABLE IF NOT EXISTS `klub` (
  `id_klub` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_klub` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stadion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_berdiri` smallint unsigned DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id_klub`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_manajemen_klub.klub: ~3 rows (lebih kurang)
INSERT INTO `klub` (`id_klub`, `nama_klub`, `kota`, `stadion`, `tahun_berdiri`, `deskripsi`) VALUES
	(1, 'Manchester United', 'Manchester', 'Old Trafford', '1878', 'Klub sepak bola profesional Inggris yang berbasis di Manchester.'),
	(2, 'Manchester City', 'Manchester', 'Etihad Stadium', '1880', 'Klub sepak bola profesional Inggris yang berbasis di Manchester.'),
	(3, 'Liverpool FC', 'Liverpool', 'Anfield', '1892', 'Klub sepak bola profesional Inggris yang berbasis di Liverpool.');

-- membuang struktur untuk table db_manajemen_klub.pelatih
CREATE TABLE IF NOT EXISTS `pelatih` (
  `id_pelatih` int unsigned NOT NULL AUTO_INCREMENT,
  `id_klub` int unsigned NOT NULL,
  `nama_pelatih` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kewarganegaraan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_pelatih`),
  KEY `fk_pelatih_klub` (`id_klub`),
  CONSTRAINT `fk_pelatih_klub` FOREIGN KEY (`id_klub`) REFERENCES `klub` (`id_klub`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_manajemen_klub.pelatih: ~15 rows (lebih kurang)
INSERT INTO `pelatih` (`id_pelatih`, `id_klub`, `nama_pelatih`, `jabatan`, `kewarganegaraan`) VALUES
	(1, 1, 'Michael Carrick', 'Manajer Utama', 'Inggris'),
	(2, 1, 'Carlos Fernandes', 'Asisten Pelatih', 'Portugal'),
	(3, 1, 'Jorge Vital', 'Pelatih Kiper', 'Portugal'),
	(4, 1, 'Sam Erith', 'Pelatih Fisik', 'Inggris'),
	(5, 1, 'Darren Fletcher', 'Pelatih Pengembangan Pemain', 'Skotlandia'),
	(6, 2, 'Enzo Maresca', 'Manajer Utama', 'Italia'),
	(7, 2, 'Juanma Lillo', 'Asisten Pelatih', 'Spanyol'),
	(8, 2, 'Xabier Mancisidor', 'Pelatih Kiper', 'Spanyol'),
	(9, 2, 'Lorenzo Buenaventura', 'Pelatih Fisik', 'Spanyol'),
	(10, 2, 'Kolo Toure', 'Asisten Pelatih', 'Pantai Gading'),
	(11, 3, 'Andoni Iraola', 'Manajer Utama', 'Spanyol'),
	(12, 3, 'Sipke Hulshoff', 'Asisten Pelatih', 'Belanda'),
	(13, 3, 'John Achterberg', 'Pelatih Kiper', 'Belanda'),
	(14, 3, 'Conall Murtagh', 'Pelatih Fisik', 'Irlandia'),
	(15, 3, 'Johnny Heitinga', 'Asisten Pelatih', 'Belanda');

-- membuang struktur untuk table db_manajemen_klub.pemain
CREATE TABLE IF NOT EXISTS `pemain` (
  `id_pemain` int unsigned NOT NULL AUTO_INCREMENT,
  `id_klub` int unsigned NOT NULL,
  `nama_pemain` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posisi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_punggung` smallint unsigned DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `kewarganegaraan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_pemain`),
  UNIQUE KEY `uq_nomor_punggung` (`id_klub`,`nomor_punggung`),
  CONSTRAINT `fk_pemain_klub` FOREIGN KEY (`id_klub`) REFERENCES `klub` (`id_klub`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel db_manajemen_klub.pemain: ~45 rows (lebih kurang)
INSERT INTO `pemain` (`id_pemain`, `id_klub`, `nama_pemain`, `posisi`, `nomor_punggung`, `tanggal_lahir`, `kewarganegaraan`) VALUES
	(1, 1, 'Bruno Fernandes', 'Gelandang', 8, '1994-09-08', 'Portugal'),
	(2, 1, 'Marcus Rashford', 'Penyerang', 10, '1997-10-31', 'Inggris'),
	(3, 1, 'Mason Mount', 'Gelandang', 7, '1999-01-10', 'Inggris'),
	(4, 1, 'Kobbie Mainoo', 'Gelandang', 37, '2005-04-19', 'Inggris'),
	(5, 1, 'Harry Maguire', 'Bek', 5, '1993-03-05', 'Inggris'),
	(6, 1, 'Lisandro Martinez', 'Bek', 6, '1998-01-18', 'Argentina'),
	(7, 1, 'Diogo Dalot', 'Bek', 20, '1999-03-18', 'Portugal'),
	(8, 1, 'Luke Shaw', 'Bek', 23, '1995-07-12', 'Inggris'),
	(9, 1, 'Andre Onana', 'Penjaga Gawang', 24, '1996-04-02', 'Kamerun'),
	(10, 1, 'Amad Diallo', 'Penyerang', 16, '2002-07-11', 'Pantai Gading'),
	(11, 1, 'Alejandro Garnacho', 'Penyerang', 17, '2004-07-01', 'Argentina'),
	(12, 1, 'Rasmus Hojlund', 'Penyerang', 9, '2003-02-04', 'Denmark'),
	(13, 1, 'Noussair Mazraoui', 'Bek', 3, '1997-11-14', 'Maroko'),
	(14, 1, 'Leny Yoro', 'Bek', 15, '2005-11-13', 'Prancis'),
	(15, 1, 'Altay Bayindir', 'Penjaga Gawang', 1, '1998-04-14', 'Turki'),
	(16, 2, 'Erling Haaland', 'Penyerang', 9, '2000-07-21', 'Norwegia'),
	(17, 2, 'Phil Foden', 'Gelandang', 47, '2000-05-28', 'Inggris'),
	(18, 2, 'Kevin De Bruyne', 'Gelandang', 17, '1991-06-28', 'Belgia'),
	(19, 2, 'Bernardo Silva', 'Gelandang', 20, '1994-08-10', 'Portugal'),
	(20, 2, 'Rodri', 'Gelandang', 16, '1996-06-22', 'Spanyol'),
	(21, 2, 'Ruben Dias', 'Bek', 3, '1997-05-14', 'Portugal'),
	(22, 2, 'John Stones', 'Bek', 5, '1994-05-28', 'Inggris'),
	(23, 2, 'Josko Gvardiol', 'Bek', 24, '2002-01-23', 'Kroasia'),
	(24, 2, 'Manuel Akanji', 'Bek', 25, '1995-07-19', 'Swiss'),
	(25, 2, 'Ederson', 'Penjaga Gawang', 31, '1993-08-17', 'Brasil'),
	(26, 2, 'Mateo Kovacic', 'Gelandang', 8, '1994-05-06', 'Kroasia'),
	(27, 2, 'Jack Grealish', 'Penyerang', 10, '1995-09-10', 'Inggris'),
	(28, 2, 'Savinho', 'Penyerang', 26, '2004-04-10', 'Brasil'),
	(29, 2, 'Jeremy Doku', 'Penyerang', 11, '2002-05-27', 'Belgia'),
	(30, 2, 'Nathan Ake', 'Bek', 6, '1995-02-18', 'Belanda'),
	(31, 3, 'Mohamed Salah', 'Penyerang', 11, '1992-06-15', 'Mesir'),
	(32, 3, 'Virgil van Dijk', 'Bek', 4, '1991-07-08', 'Belanda'),
	(33, 3, 'Alisson Becker', 'Penjaga Gawang', 1, '1992-10-02', 'Brasil'),
	(34, 3, 'Trent Alexander-Arnold', 'Bek', 66, '1998-10-07', 'Inggris'),
	(35, 3, 'Andrew Robertson', 'Bek', 26, '1994-03-11', 'Skotlandia'),
	(36, 3, 'Alexis Mac Allister', 'Gelandang', 10, '1998-12-24', 'Argentina'),
	(37, 3, 'Dominik Szoboszlai', 'Gelandang', 8, '2000-10-25', 'Hungaria'),
	(38, 3, 'Ryan Gravenberch', 'Gelandang', 38, '2002-05-16', 'Belanda'),
	(39, 3, 'Luis Diaz', 'Penyerang', 7, '1997-01-13', 'Kolombia'),
	(40, 3, 'Diogo Jota', 'Penyerang', 20, '1996-12-04', 'Portugal'),
	(41, 3, 'Darwin Nunez', 'Penyerang', 9, '1999-06-24', 'Uruguay'),
	(42, 3, 'Cody Gakpo', 'Penyerang', 18, '1999-05-07', 'Belanda'),
	(43, 3, 'Ibrahima Konate', 'Bek', 5, '1999-05-25', 'Prancis'),
	(44, 3, 'Curtis Jones', 'Gelandang', 17, '2001-01-30', 'Inggris'),
	(45, 3, 'Joe Gomez', 'Bek', 2, '1997-05-23', 'Inggris');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
