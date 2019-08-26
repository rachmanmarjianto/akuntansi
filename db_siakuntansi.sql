-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2019 at 03:24 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_siakuntansi`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenisakun`
--

CREATE TABLE `jenisakun` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenisakun`
--

INSERT INTO `jenisakun` (`id`, `nama`) VALUES
(1, 'aset'),
(2, 'liabilitas'),
(3, 'ekuitas'),
(4, 'beban'),
(5, 'pendapatan');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `id_jurnal` varchar(12) NOT NULL,
  `id_namaAkun` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `nominal` int(11) NOT NULL,
  `jenisTransaksi` tinyint(1) NOT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `jurnal`
--
DELIMITER $$
CREATE TRIGGER `id_jurnal` BEFORE INSERT ON `jurnal` FOR EACH ROW BEGIN
DECLARE nr integer DEFAULT 0;

set nr=(select count(*) from jurnal where tanggal = CURRENT_DATE)+1;
set new.id_jurnal=concat("jrl",DATE_FORMAT(CURRENT_DATE, '%y%m%d'), LPAD((select nr),3,'0'));
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `namaakun`
--

CREATE TABLE `namaakun` (
  `id` int(11) NOT NULL,
  `id_jenisAkun` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tambahDengan` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `namaakun`
--

INSERT INTO `namaakun` (`id`, `id_jenisAkun`, `nama`, `tambahDengan`, `status`) VALUES
(1, 1, 'bank', 1, 0),
(2, 1, 'bank bca', 1, 1),
(3, 1, 'bank mandiri', 1, 1),
(4, 2, 'Hutang Gaji', 0, 1),
(5, 3, 'Modal', 0, 1),
(6, 3, 'Laba Ditahan', 0, 1),
(7, 5, 'Penjualan', 0, 1),
(8, 4, 'Beban Gaji', 1, 1),
(9, 4, 'Beban Listrik', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenisakun`
--
ALTER TABLE `jenisakun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id_jurnal`),
  ADD KEY `id_namaAkun` (`id_namaAkun`);

--
-- Indexes for table `namaakun`
--
ALTER TABLE `namaakun`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`),
  ADD KEY `id_jenisAkun` (`id_jenisAkun`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenisakun`
--
ALTER TABLE `jenisakun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `namaakun`
--
ALTER TABLE `namaakun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD CONSTRAINT `jurnal_ibfk_1` FOREIGN KEY (`id_namaAkun`) REFERENCES `namaakun` (`id`);

--
-- Constraints for table `namaakun`
--
ALTER TABLE `namaakun`
  ADD CONSTRAINT `namaakun_ibfk_1` FOREIGN KEY (`id_jenisAkun`) REFERENCES `jenisakun` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
