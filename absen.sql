-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 29, 2020 at 02:54 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absen`
--

-- --------------------------------------------------------

--
-- Table structure for table `histori_absen`
--

CREATE TABLE `histori_absen` (
  `id_history` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `timestamps` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `histori_absen`
--

INSERT INTO `histori_absen` (`id_history`, `id_user`, `id_jadwal`, `keterangan`, `timestamps`) VALUES
(1, 3, 4, 'hadir', '2020-12-29 16:19:02'),
(2, 5, 7, 'hadir', '2020-12-29 18:46:24'),
(3, 5, 8, 'hadir', '2020-12-29 18:52:46'),
(5, 7, 10, 'hadir', '2020-12-15 20:39:10'),
(6, 7, 10, 'hadir', '2020-12-22 20:39:45'),
(7, 7, 10, 'hadir', '2020-12-29 20:40:59');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `nama_mapel` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `nama_mapel`, `keterangan`) VALUES
(1, 'Produk kreatif dan kewirausahaan', ''),
(2, 'Administrasi infrastruktur jaringan', NULL),
(3, 'Bimbingan Konseling', ''),
(5, 'Administrasi server jaringan', ''),
(6, 'Teknologi layanan jaringan', ''),
(7, 'Bahasa indonesia', ''),
(8, 'Bahasa inggris', ''),
(9, 'Pendidikan kewarganegaraan', ''),
(10, 'Pendidikan lingkungan hidup', ''),
(11, 'Pendidikan agama islam', ''),
(12, 'Matematika', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text DEFAULT NULL,
  `jenis_kelamin` enum('l','p') NOT NULL,
  `role` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gambar` text NOT NULL DEFAULT 'avatar.png',
  `gaji` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `email`, `nip`, `tanggal_lahir`, `alamat`, `jenis_kelamin`, `role`, `password`, `gambar`, `gaji`) VALUES
(1, 'admin', 'admin@admin.com', '232342', '2020-12-28', 'xxx', 'l', 1, '$2y$10$VLdpxT3XpVuboQncpQd6b.KVQB7FmO99topNsZSiaobpfuP3uMzg6', 'usr1609135592.jpeg', 900000),
(3, 'guru', 'guru@guru.com', '123', '2021-11-27', 'xx', 'p', 2, '$2y$10$eY1XAKZngRi5Q2FkKojtM.ZglxWhuzzEu1aDAIBX3UTsxeGAI6u9m', 'usr1609142098.jpeg', 600000),
(4, 'cek', 'cek@cek.com', '978', '2019-11-30', 'eadaw', 'p', 2, '$2y$10$waS8GO6MZcZfZ59UxrgggO3yKVlLiSmM4fUJZfQ2mB5kxKxQtB4ou', 'usr1609216638.png', 400000),
(5, 'Agus Imam', 'imamagus@gmail.com', '123456', '2018-10-16', 'ciawi', 'p', 2, '$2y$10$QYNKPfHszUk.T0FhrlUI/u5kGQBT9hHjDHR3X3aWaWhwLb.YcTQBm', 'usr1609241937.png', 800000),
(7, 'Dilla Andini', 'andinidila@gmail.com', '96387676682', '1988-04-11', 'Bojong', 'p', 2, '$2y$10$RleSovow9dw1j7E6KhdPVOegszfdccESpE/m2di94RB/75fP.YQPy', 'usr1609248980.jpg', 600000);

-- --------------------------------------------------------

--
-- Table structure for table `user_mapel`
--

CREATE TABLE `user_mapel` (
  `id_umpel` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `jam` time NOT NULL,
  `waktu` int(11) NOT NULL,
  `qrcode` varchar(255) NOT NULL,
  `uuid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_mapel`
--

INSERT INTO `user_mapel` (`id_umpel`, `id_user`, `id_mapel`, `hari`, `jam`, `waktu`, `qrcode`, `uuid`) VALUES
(4, 3, 1, 'selasa', '15:30:43', 120, '1609215674.png', '5feaaeba360e3'),
(5, 4, 2, 'rabu', '11:30:00', 30, '1609216813.png', '5feab32d06126'),
(6, 3, 3, 'rabu', '17:48:00', 120, '1609238935.png', '5feb0997a237d'),
(7, 5, 2, 'selasa', '19:00:00', 120, '1609242025.png', '5feb15a9323cd'),
(8, 5, 1, 'selasa', '18:59:46', 60, '1609242577.png', '5feb17d1cc390'),
(10, 7, 6, 'selasa', '20:37:00', 60, '1609249040.png', '5feb311096f70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `histori_absen`
--
ALTER TABLE `histori_absen`
  ADD PRIMARY KEY (`id_history`),
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_mapel`
--
ALTER TABLE `user_mapel`
  ADD PRIMARY KEY (`id_umpel`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `histori_absen`
--
ALTER TABLE `histori_absen`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_mapel`
--
ALTER TABLE `user_mapel`
  MODIFY `id_umpel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `histori_absen`
--
ALTER TABLE `histori_absen`
  ADD CONSTRAINT `histori_absen_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `user_mapel` (`id_umpel`) ON DELETE CASCADE,
  ADD CONSTRAINT `histori_absen_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `user_mapel`
--
ALTER TABLE `user_mapel`
  ADD CONSTRAINT `user_mapel_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_mapel_ibfk_2` FOREIGN KEY (`id_mapel`) REFERENCES `mapel` (`id_mapel`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
