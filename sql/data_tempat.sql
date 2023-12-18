-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 18, 2023 at 01:52 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ku`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_tempat`
--

CREATE TABLE `data_tempat` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_tempat` varchar(100) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `waktu` date NOT NULL,
  `foto` varchar(100) NOT NULL,
  `link_gmaps` varchar(255) NOT NULL,
  `browser` varchar(20) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `provinsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_tempat`
--

INSERT INTO `data_tempat` (`id`, `id_user`, `nama_tempat`, `kategori`, `waktu`, `foto`, `link_gmaps`, `browser`, `ip`, `provinsi`) VALUES
(16, 1, 'Pantai Sorake', 'Pantai', '2023-12-18', '1.jpg', 'https://www.google.com/', 'Chrome', '::1', 'Sumatera Utara'),
(17, 1, 'Pantai Sorake', 'Pantai', '2023-12-18', '2.jpg', 'https://www.google.com/', 'Chrome', '::1', 'Sumatera Utara'),
(18, 1, 'Pantai Sorake', 'Pantai', '2023-12-18', '3.jpg', 'https://www.google.com/', 'Chrome', '::1', 'Sumatera Utara'),
(19, 1, 'Pantai Sorake', 'Pantai', '2023-12-18', '4.jpg', 'https://www.google.com/', 'Chrome', '::1', 'Sumatera Utara'),
(20, 1, 'Pantai Sorake', 'Pantai', '2023-12-18', '5.jpg', 'https://www.google.com/', 'Chrome', '::1', 'Sumatera Utara'),
(21, 1, 'Pantai Sorake', 'Pantai', '2023-12-18', '6.jpg', 'https://www.google.com/', 'Chrome', '::1', 'Sumatera Utara'),
(22, 1, 'Pantai Sorake', 'Pantai', '2023-12-18', '7.jpg', 'https://www.google.com/', 'Chrome', '::1', 'Sumatera Utara'),
(23, 1, 'Pantai Sorake', 'Pantai', '2023-12-18', '8.jpg', 'https://www.google.com/', 'Chrome', '::1', 'Sumatera Utara'),
(24, 1, 'Pantai Sorake', 'Pantai', '2023-12-18', '9.jpg', 'https://www.google.com/', 'Chrome', '::1', 'Sumatera Utara'),
(25, 1, 'Pantai Sorake', 'Pantai', '2023-12-18', '10.jpg', 'https://www.google.com/', 'Chrome', '::1', 'Sumatera Utara');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_tempat`
--
ALTER TABLE `data_tempat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_tempat`
--
ALTER TABLE `data_tempat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_tempat`
--
ALTER TABLE `data_tempat`
  ADD CONSTRAINT `data_tempat_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
