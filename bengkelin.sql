-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2022 at 05:28 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bengkelin`
--

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `id` int(11) NOT NULL,
  `platNomor` varchar(10) NOT NULL,
  `namaMotor` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`id`, `platNomor`, `namaMotor`) VALUES
(5, 'M 1843 HS', 'Suzuki Satria');

-- --------------------------------------------------------

--
-- Table structure for table `bayar`
--

CREATE TABLE `bayar` (
  `id` int(11) NOT NULL,
  `platNomor` varchar(16) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `idJasa` varchar(64) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `kasir` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bayar`
--

INSERT INTO `bayar` (`id`, `platNomor`, `nama`, `idJasa`, `tanggal`, `kasir`) VALUES
(1, 'M 3673 HS', '', '1,2', '2021-12-30 21:00:26', ''),
(2, 'L 8374 HY', 'Honda Vario 125', '4,6', '2021-12-30 21:02:26', ''),
(3, 'M 3673 HS', 'Yamah Mio', '1,2,3,4,6', '2022-01-01 22:07:12', 'moham'),
(4, 'M 1232 JH', 'Yamaha Jupiter', '1,3,4,6', '2022-01-04 07:14:41', 'moham');

-- --------------------------------------------------------

--
-- Table structure for table `jasa`
--

CREATE TABLE `jasa` (
  `id` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `biaya` int(11) NOT NULL,
  `hapus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jasa`
--

INSERT INTO `jasa` (`id`, `nama`, `biaya`, `hapus`) VALUES
(1, 'Tambah Ban', 12000, 0),
(2, 'Ganti Ban', 10000, 0),
(3, 'Pasang Velg', 60000, 0),
(4, 'Pasang Lampu sign', 20000, 0),
(6, 'pompa ban', 2000, 0),
(7, 'ganti oli', 10000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `password` varchar(256) NOT NULL,
  `rule` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `password`, `rule`) VALUES
(7, 'doni', '$2y$10$GKN4.Ov.n4aeQWKBp1CdnuTY838ZlQDSUkZApDMwy/AFb/jWxpYMC', 1),
(8, 'reni', '$2y$10$Zp6uUPHvzhmSSj0EHx37U.QwUpqh1izs4pwMfS3CJBEDs4tffRa/O', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bayar`
--
ALTER TABLE `bayar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bayar`
--
ALTER TABLE `bayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jasa`
--
ALTER TABLE `jasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
