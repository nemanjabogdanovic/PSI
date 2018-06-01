-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2018 at 04:30 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

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
-- Table structure for table `cas`
--

CREATE TABLE `cas` (
  `id` int(11) NOT NULL,
  `predmetId` int(11) NOT NULL,
  `tema` varchar(255) COLLATE latin2_croatian_ci NOT NULL,
  `redniBroj` int(11) NOT NULL,
  `komentari` varchar(255) COLLATE latin2_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `izostanci`
--

CREATE TABLE `izostanci` (
  `id` int(11) NOT NULL,
  `ucenikId` int(11) NOT NULL,
  `brojIzostanaka` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `koordinator`
--

CREATE TABLE `koordinator` (
  `id` int(11) NOT NULL,
  `skolaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `koordinator`
--

INSERT INTO `koordinator` (`id`, `skolaId`) VALUES
(11, 2);

-- --------------------------------------------------------

--
-- Table structure for table `nastavnik`
--

CREATE TABLE `nastavnik` (
  `id` int(11) NOT NULL,
  `skolaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `nastavnik`
--

INSERT INTO `nastavnik` (`id`, `skolaId`) VALUES
(8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ocena`
--

CREATE TABLE `ocena` (
  `id` int(11) NOT NULL,
  `predmetId` int(11) NOT NULL,
  `ucenikId` int(11) NOT NULL,
  `ocena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `odeljenje`
--

CREATE TABLE `odeljenje` (
  `id` int(11) NOT NULL,
  `oznaka` varchar(10) COLLATE latin2_croatian_ci NOT NULL,
  `skolaId` int(11) NOT NULL,
  `nastavnikId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `odeljenje`
--

INSERT INTO `odeljenje` (`id`, `oznaka`, `skolaId`, `nastavnikId`) VALUES
(2, 'I/1', 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `predmet`
--

CREATE TABLE `predmet` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) COLLATE latin2_croatian_ci NOT NULL,
  `nastavnik` int(11) NOT NULL,
  `skolskaGodina` varchar(30) COLLATE latin2_croatian_ci NOT NULL,
  `kabineti` varchar(50) COLLATE latin2_croatian_ci NOT NULL,
  `skolaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `predmet`
--

INSERT INTO `predmet` (`id`, `ime`, `nastavnik`, `skolskaGodina`, `kabineti`, `skolaId`) VALUES
(4, 'Matematika', 8, '1', '1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `raspored`
--

CREATE TABLE `raspored` (
  `id` int(11) NOT NULL,
  `odeljenje` varchar(255) COLLATE latin2_croatian_ci NOT NULL,
  `dan` varchar(255) COLLATE latin2_croatian_ci NOT NULL,
  `brojCasa` int(11) NOT NULL,
  `nastavnik` int(11) NOT NULL,
  `kabinet` varchar(255) COLLATE latin2_croatian_ci NOT NULL,
  `predmet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skola`
--

CREATE TABLE `skola` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) COLLATE latin2_croatian_ci NOT NULL,
  `adresa` varchar(255) COLLATE latin2_croatian_ci NOT NULL,
  `grad` varchar(255) COLLATE latin2_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `skola`
--

INSERT INTO `skola` (`id`, `ime`, `adresa`, `grad`) VALUES
(2, 'Prva beogradska gimnazija', 'Cara Dušana 61', 'Beograd');

-- --------------------------------------------------------

--
-- Table structure for table `ucenik`
--

CREATE TABLE `ucenik` (
  `id` int(11) NOT NULL,
  `skolaId` int(11) NOT NULL,
  `odeljenjeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `ucenik`
--

INSERT INTO `ucenik` (`id`, `skolaId`, `odeljenjeId`) VALUES
(12, 2, 2);

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
(8, 'Vuk', 'Vukovic', 'vuk@yahoo.com', 'vuk_vukovic_1', '5a1001075d3205d010ef24413e6a1afd'),
(11, 'Branko', 'Brankovic', 'branko@live.com', 'branko_brankovic_1', 'fbee3d5b1def587f835e85a8a4c78195'),
(12, 'Goran', 'Goranovic', 'goran@gmail.com', 'goran_goranovic_1', '52ddd9ff1e957a1e6b15d329d8cefee7');

-- --------------------------------------------------------

--
-- Table structure for table `vesti`
--

CREATE TABLE `vesti` (
  `id` int(11) NOT NULL,
  `naslov` varchar(255) COLLATE latin2_croatian_ci NOT NULL,
  `text` text COLLATE latin2_croatian_ci NOT NULL,
  `userLevel` varchar(30) COLLATE latin2_croatian_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `vesti`
--

INSERT INTO `vesti` (`id`, `naslov`, `text`, `userLevel`, `timestamp`) VALUES
(8, 'Obaveštenje za sve korisnike', 'Elektronskom Dnevniku će biti onemogućen pristup u petak između 01:00 i 05:00 zbog rutinskog održavanja sistema.', 'administrator_GLOBAL', '2018-06-01 12:52:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD KEY `administrator_foreignKey` (`id`);

--
-- Indexes for table `cas`
--
ALTER TABLE `cas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cas_predmetFK` (`predmetId`);

--
-- Indexes for table `izostanci`
--
ALTER TABLE `izostanci`
  ADD KEY `izostanci_ucenikFK` (`ucenikId`);

--
-- Indexes for table `koordinator`
--
ALTER TABLE `koordinator`
  ADD KEY `koordinator_foreignKey` (`id`),
  ADD KEY `koordinator_SkolaFK` (`skolaId`);

--
-- Indexes for table `nastavnik`
--
ALTER TABLE `nastavnik`
  ADD KEY `nastavnik_foreignKey` (`id`),
  ADD KEY `nastavnik_skolaFK` (`skolaId`);

--
-- Indexes for table `ocena`
--
ALTER TABLE `ocena`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ocena_predmetFK` (`predmetId`),
  ADD KEY `ocena_ucenikFK` (`ucenikId`);

--
-- Indexes for table `odeljenje`
--
ALTER TABLE `odeljenje`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `odeljenje_skolaFK` (`skolaId`),
  ADD KEY `odeljenje_nastavnikFK` (`nastavnikId`);

--
-- Indexes for table `predmet`
--
ALTER TABLE `predmet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `predmet_skolaFK` (`skolaId`),
  ADD KEY `predmet_nastavnikFK` (`nastavnik`);

--
-- Indexes for table `raspored`
--
ALTER TABLE `raspored`
  ADD PRIMARY KEY (`id`),
  ADD KEY `raspored_nastavnikFK` (`nastavnik`),
  ADD KEY `raspored_predmetFK` (`predmet`);

--
-- Indexes for table `skola`
--
ALTER TABLE `skola`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ucenik`
--
ALTER TABLE `ucenik`
  ADD KEY `ucenik_foreignKey` (`id`),
  ADD KEY `ucenik_skolaFK` (`skolaId`),
  ADD KEY `ucenik_odeljenjeFK` (`odeljenjeId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vesti`
--
ALTER TABLE `vesti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cas`
--
ALTER TABLE `cas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ocena`
--
ALTER TABLE `ocena`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `odeljenje`
--
ALTER TABLE `odeljenje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `predmet`
--
ALTER TABLE `predmet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `raspored`
--
ALTER TABLE `raspored`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skola`
--
ALTER TABLE `skola`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vesti`
--
ALTER TABLE `vesti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrator`
--
ALTER TABLE `administrator`
  ADD CONSTRAINT `administrator_foreignKey` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cas`
--
ALTER TABLE `cas`
  ADD CONSTRAINT `cas_predmetFK` FOREIGN KEY (`predmetId`) REFERENCES `predmet` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `izostanci`
--
ALTER TABLE `izostanci`
  ADD CONSTRAINT `izostanci_ucenikFK` FOREIGN KEY (`ucenikId`) REFERENCES `ucenik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `koordinator`
--
ALTER TABLE `koordinator`
  ADD CONSTRAINT `koordinator_SkolaFK` FOREIGN KEY (`skolaId`) REFERENCES `skola` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `koordinator_foreignKey` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nastavnik`
--
ALTER TABLE `nastavnik`
  ADD CONSTRAINT `nastavnik_foreignKey` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nastavnik_skolaFK` FOREIGN KEY (`skolaId`) REFERENCES `skola` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ocena`
--
ALTER TABLE `ocena`
  ADD CONSTRAINT `ocena_predmetFK` FOREIGN KEY (`predmetId`) REFERENCES `predmet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ocena_ucenikFK` FOREIGN KEY (`ucenikId`) REFERENCES `ucenik` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `odeljenje`
--
ALTER TABLE `odeljenje`
  ADD CONSTRAINT `odeljenje_nastavnikFK` FOREIGN KEY (`nastavnikId`) REFERENCES `nastavnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `odeljenje_skolaFK` FOREIGN KEY (`skolaId`) REFERENCES `skola` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `predmet`
--
ALTER TABLE `predmet`
  ADD CONSTRAINT `predmet_nastavnikFK` FOREIGN KEY (`nastavnik`) REFERENCES `nastavnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `predmet_skolaFK` FOREIGN KEY (`skolaId`) REFERENCES `skola` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `raspored`
--
ALTER TABLE `raspored`
  ADD CONSTRAINT `raspored_nastavnikFK` FOREIGN KEY (`nastavnik`) REFERENCES `nastavnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `raspored_predmetFK` FOREIGN KEY (`predmet`) REFERENCES `predmet` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ucenik`
--
ALTER TABLE `ucenik`
  ADD CONSTRAINT `ucenik_foreignKey` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ucenik_odeljenjeFK` FOREIGN KEY (`odeljenjeId`) REFERENCES `odeljenje` (`id`),
  ADD CONSTRAINT `ucenik_skolaFK` FOREIGN KEY (`skolaId`) REFERENCES `skola` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
