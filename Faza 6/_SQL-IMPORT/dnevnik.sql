-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2018 at 11:36 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dnevnik`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `koordinator`
--

CREATE TABLE `koordinator` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `koordinator`
--

INSERT INTO `koordinator` (`id`) VALUES
(2);

-- --------------------------------------------------------

--
-- Table structure for table `nastavnik`
--

CREATE TABLE `nastavnik` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `nastavnik`
--

INSERT INTO `nastavnik` (`id`) VALUES
(3);

-- --------------------------------------------------------

--
-- Table structure for table `predmet`
--

CREATE TABLE `predmet` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) COLLATE latin2_croatian_ci NOT NULL,
  `nastavnik` varchar(500) COLLATE latin2_croatian_ci NOT NULL,
  `skolskaGodina` varchar(30) COLLATE latin2_croatian_ci NOT NULL,
  `kabineti` varchar(50) COLLATE latin2_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `predmet`
--

INSERT INTO `predmet` (`id`, `ime`, `nastavnik`, `skolskaGodina`, `kabineti`) VALUES
(1, 'mata', 'misa', '92', '12'),
(2, 'engleski', 'aca', '4', '123'),
(3, 'engleski2', 'aca2', '42', '123');

-- --------------------------------------------------------

--
-- Table structure for table `ucenik`
--

CREATE TABLE `ucenik` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `ucenik`
--

INSERT INTO `ucenik` (`id`) VALUES
(4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE latin2_croatian_ci NOT NULL,
  `surname` varchar(255) COLLATE latin2_croatian_ci NOT NULL,
  `email` varchar(255) COLLATE latin2_croatian_ci NOT NULL,
  `username` varchar(255) COLLATE latin2_croatian_ci NOT NULL,
  `password` varchar(255) COLLATE latin2_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `username`, `password`) VALUES
(1, 'Aleksa', 'Aleksic', 'aleksa@gmail.com', 'aleksa_aleksic_1', 'f3071ec919ba79ea9d6fbe49c2c53a3d'),
(2, 'Branko', 'Brankovic', 'branko@live.com', 'branko_brankovic_1', 'ff2cd722ad15b013cb7a5ecbf8d1e12f'),
(3, 'Vuk', 'Vukovic', 'vuk@yahoo.com', 'vuk_vukovic_1', '5a1001075d3205d010ef24413e6a1afd'),
(4, 'Goran', 'Goranovic', 'goran@gmail.com', 'goran_goranovic_1', '52ddd9ff1e957a1e6b15d329d8cefee7'),
(5, 'Djura', 'Djurisic', 'djura@hotmail.com', 'djura_djurisic_1', '9362293c8751865cdfce81d241259a1c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD KEY `administrator_foreignKey` (`id`);

--
-- Indexes for table `koordinator`
--
ALTER TABLE `koordinator`
  ADD KEY `koordinator_foreignKey` (`id`);

--
-- Indexes for table `nastavnik`
--
ALTER TABLE `nastavnik`
  ADD KEY `nastavnik_foreignKey` (`id`);

--
-- Indexes for table `predmet`
--
ALTER TABLE `predmet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ucenik`
--
ALTER TABLE `ucenik`
  ADD KEY `ucenik_foreignKey` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `predmet`
--
ALTER TABLE `predmet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrator`
--
ALTER TABLE `administrator`
  ADD CONSTRAINT `administrator_foreignKey` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `koordinator`
--
ALTER TABLE `koordinator`
  ADD CONSTRAINT `koordinator_foreignKey` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nastavnik`
--
ALTER TABLE `nastavnik`
  ADD CONSTRAINT `nastavnik_foreignKey` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ucenik`
--
ALTER TABLE `ucenik`
  ADD CONSTRAINT `ucenik_foreignKey` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
