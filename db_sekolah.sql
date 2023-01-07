-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2021 at 11:28 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `legalisir`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nip` int(10) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `username`, `password`, `nama`, `nip`, `alamat`) VALUES
(1, 'admin', '123', 'Admin', 1902, 'Jombang');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_simpan`
--

CREATE TABLE `tbl_simpan` (
  `id_simpan` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `no_sertifikat` varchar(100) NOT NULL,
  `berkas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_simpan`
--

INSERT INTO `tbl_simpan` (`id_simpan`, `nis`, `id_transaksi`, `nama_file`, `no_sertifikat`, `berkas`) VALUES
(60, 2001, 41, 'Ijazah', '20031935326', 'ijazah fanani.pdf'),
(62, 2003, 40, 'SKCK', '200362984076', 'skck.docx'),
(63, 2003, 42, 'SKHUN', '200263985403', '2003 - SKHUN.pdf'),
(65, 2002, 43, 'Ijazah', '200265326563', '2002 - ijazah.pdf'),
(67, 2002, 54, 'SKHUN', '200411100142', 'Yoga Tirta - skhun yoga.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `berkas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `nis`, `nama`, `nama_file`, `status`, `berkas`) VALUES
(54, 2002, 'Yoga Tirta', 'SKHUN', 'selesai', 'skhun yoga.pdf'),
(57, 2003, 'Teguh Budi', 'Laporan', 'proses', 'laporan teguh.pdf'),
(58, 2002, 'Yoga Tirta', 'Ijazah', 'pending', 'ijazah yoga.pdf'),
(59, 2001, 'Ahmad Fanani', 'Proposal', 'tolak', 'proposal fanani.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `nis` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `alamat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`nis`, `username`, `password`, `nama`, `alamat`) VALUES
(2001, 'fanani', '123', 'Ahmad Fanani', 'Jombang'),
(2002, 'yoga', '123', 'Yoga Tirta', 'Mojokerto'),
(2003, 'teguh', '123', 'Teguh Budi', 'Lamongan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_simpan`
--
ALTER TABLE `tbl_simpan`
  ADD PRIMARY KEY (`id_simpan`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`nis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_simpan`
--
ALTER TABLE `tbl_simpan`
  MODIFY `id_simpan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD CONSTRAINT `tbl_transaksi_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `tbl_user` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
