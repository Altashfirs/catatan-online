-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql313.infinityfree.com
-- Generation Time: Jun 12, 2023 at 11:56 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_34349350_db_hutang`
--

-- --------------------------------------------------------

--
-- Table structure for table `catatan`
--

CREATE TABLE `catatan` (
  `id_peminjam` int(20) NOT NULL,
  `tanggal` date NOT NULL,
  `pemasukan` int(11) NOT NULL,
  `pengeluaran_prtl` int(11) NOT NULL,
  `pengeluaran_snk` int(11) NOT NULL,
  `keterangan` varchar(256) NOT NULL,
  `qty` int(11) NOT NULL,
  `id_hutang` bigint(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catatan`
--

INSERT INTO `catatan` (`id_peminjam`, `tanggal`, `pemasukan`, `pengeluaran_prtl`, `pengeluaran_snk`, `keterangan`, `qty`, `id_hutang`) VALUES
(1, '2023-06-12', 96000, 46000, 0, '', 1, 1236543),
(1, '2023-06-12', 30000, 10000, 5000, 'Balon', 0, 2306120014569),
(1, '2023-06-12', 100, 30, 0, '', 0, 2306120156373),
(1, '2023-06-12', 100, 30, 0, '', 0, 2306121576004);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`) VALUES
(1, 'elias', '81dc9bdb52d04dc20036dbd8313ed055', 'Elias Abdurrahman');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catatan`
--
ALTER TABLE `catatan`
  ADD KEY `id_peminjam` (`id_peminjam`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `catatan`
--
ALTER TABLE `catatan`
  ADD CONSTRAINT `catatan_ibfk_1` FOREIGN KEY (`id_peminjam`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
