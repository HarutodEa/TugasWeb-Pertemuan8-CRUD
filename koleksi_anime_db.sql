-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 11, 2026 at 12:53 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koleksi_anime_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_koleksi`
--

CREATE TABLE `daftar_koleksi` (
  `id` int NOT NULL,
  `judul` varchar(150) NOT NULL,
  `genre_id` int NOT NULL,
  `studio_id` int NOT NULL,
  `rating` decimal(3,1) NOT NULL,
  `jumlah_episode` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `daftar_koleksi`
--

INSERT INTO `daftar_koleksi` (`id`, `judul`, `genre_id`, `studio_id`, `rating`, `jumlah_episode`) VALUES
(1, 'Classroom of the Elite', 1, 1, '8.5', 38),
(2, 'Code Geass', 2, 2, '9.0', 50),
(3, 'Mobile Suit Gundam', 2, 2, '8.0', 43),
(4, '86 -Eighty Six-', 2, 5, '8.8', 23),
(5, 'Violet Evergarden', 4, 4, '8.9', 13),
(6, 'Mobile Suit Gundam OO Second Season', 2, 2, '8.0', 25),
(8, 'Mobile Suit Gundam OO', 2, 2, '8.1', 25);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int NOT NULL,
  `nama_genre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `nama_genre`) VALUES
(1, 'Psychological Thriller'),
(2, 'Mecha'),
(3, 'Dark Fantasy'),
(4, 'Slice of Life'),
(5, 'Action');

-- --------------------------------------------------------

--
-- Table structure for table `studio`
--

CREATE TABLE `studio` (
  `id` int NOT NULL,
  `nama_studio` varchar(100) NOT NULL,
  `asal_negara` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `studio`
--

INSERT INTO `studio` (`id`, `nama_studio`, `asal_negara`) VALUES
(1, 'Lerche', 'Jepang'),
(2, 'Sunrise', 'Jepang'),
(3, 'Kadokawa', 'Jepang'),
(4, 'Kyoto Animation', 'Jepang'),
(5, 'A-1 Pictures', 'Jepang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_koleksi`
--
ALTER TABLE `daftar_koleksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genre_id` (`genre_id`),
  ADD KEY `studio_id` (`studio_id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studio`
--
ALTER TABLE `studio`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_koleksi`
--
ALTER TABLE `daftar_koleksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `studio`
--
ALTER TABLE `studio`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_koleksi`
--
ALTER TABLE `daftar_koleksi`
  ADD CONSTRAINT `daftar_koleksi_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`),
  ADD CONSTRAINT `daftar_koleksi_ibfk_2` FOREIGN KEY (`studio_id`) REFERENCES `studio` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
