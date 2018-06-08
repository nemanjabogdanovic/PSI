-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2018 at 09:30 PM
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
-- Table structure for table `help`
--

CREATE TABLE `help` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `help`
--

INSERT INTO `help` (`id`) VALUES
(31);

-- --------------------------------------------------------

--
-- Table structure for table `help2`
--

CREATE TABLE `help2` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(11, 2),
(14, 3),
(31, 4),
(32, 5),
(33, 6);

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
(8, 2),
(15, 4),
(16, 4),
(17, 3),
(24, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2);

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

--
-- Dumping data for table `ocena`
--

INSERT INTO `ocena` (`id`, `predmetId`, `ucenikId`, `ocena`) VALUES
(8, 4, 12, 5),
(9, 10, 12, 2),
(10, 6, 18, 2),
(11, 4, 12, 5),
(12, 4, 12, 4),
(13, 6, 18, 3),
(14, 10, 12, 1);

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
(2, 'I/1', 2, 8),
(3, 'MI/1', 6, 15),
(4, 'I/2', 2, 37),
(5, 'I/3', 2, 36),
(6, 'II/1', 2, 35),
(7, 'II/2', 2, 34);

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
(4, 'Matematika', 8, '1', '1', 2),
(6, 'Francuski', 8, '4', '12', 3),
(7, 'Nemački', 24, '3', '12', 4),
(10, 'Srpski', 8, '3', '3', 2),
(11, 'Bugarski', 15, '2', '21', 3),
(12, 'Hemija', 24, '2', '4', 3),
(13, 'Engleski', 36, '2', '309', 2),
(14, 'Istorija', 37, '1', '2', 2),
(15, 'Fizika', 34, '2', '5', 2),
(16, 'Elektronika', 35, '1', '4', 2),
(17, 'Informatika', 35, '3', '6', 2),
(18, 'Fizicko', 34, '3', '131', 2);

-- --------------------------------------------------------

--
-- Table structure for table `raspored`
--

CREATE TABLE `raspored` (
  `id` int(11) NOT NULL,
  `odeljenjeId` int(25) NOT NULL,
  `dan` varchar(255) COLLATE latin2_croatian_ci NOT NULL,
  `brojCasa` int(11) NOT NULL,
  `nastavnikId` int(11) NOT NULL,
  `kabinet` varchar(255) COLLATE latin2_croatian_ci NOT NULL,
  `predmetId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `raspored`
--

INSERT INTO `raspored` (`id`, `odeljenjeId`, `dan`, `brojCasa`, `nastavnikId`, `kabinet`, `predmetId`) VALUES
(2, 3, 'utorak', 1, 8, '1', 4),
(3, 2, 'utorak', 1, 8, '2', 6),
(4, 2, 'sreda', 1, 17, '1', 7),
(5, 2, 'ponedeljak', 1, 8, '2', 10),
(6, 2, 'cetvrtak', 1, 15, '11', 6),
(8, 2, 'petak', 1, 8, '2', 4),
(9, 3, 'ponedeljak', 1, 16, '123', 11),
(10, 3, 'sreda', 1, 24, '12', 11),
(11, 3, 'cetvrtak', 1, 16, '2', 7),
(12, 3, 'petak', 1, 17, '2', 11),
(13, 3, 'utorak', 2, 8, '1', 4),
(14, 2, 'utorak', 2, 8, '2', 6),
(15, 2, 'sreda', 2, 17, '1', 7),
(16, 2, 'ponedeljak', 2, 8, '2', 10),
(17, 2, 'cetvrtak', 2, 15, '11', 6),
(18, 2, 'petak', 2, 8, '2', 4),
(19, 3, 'ponedeljak', 2, 16, '123', 11),
(20, 3, 'sreda', 2, 24, '12', 11),
(21, 3, 'cetvrtak', 2, 16, '2', 7),
(22, 3, 'petak', 2, 17, '2', 11),
(23, 4, 'ponedeljak', 1, 35, '4', 16),
(24, 4, 'ponedeljak', 2, 35, '4', 16),
(25, 4, 'ponedeljak', 3, 35, '6', 17),
(26, 4, 'ponedeljak', 4, 35, '6', 17),
(27, 4, 'utorak', 1, 36, '309', 13),
(28, 4, 'utorak', 2, 36, '309', 13),
(29, 4, 'utorak', 3, 37, '2', 14),
(30, 4, 'utorak', 4, 37, '2', 14),
(31, 4, 'sreda', 1, 8, '1', 4),
(32, 4, 'sreda', 2, 8, '1', 4),
(33, 4, 'sreda', 3, 34, '131', 18),
(34, 4, 'sreda', 4, 34, '131', 18),
(35, 4, 'petak', 1, 8, '3', 10),
(36, 4, 'petak', 2, 8, '3', 10),
(37, 2, 'ponedeljak', 3, 8, '131', 18),
(38, 2, 'ponedeljak', 4, 8, '131', 18),
(39, 2, 'cetvrtak', 3, 35, '6', 17),
(40, 2, 'cetvrtak', 4, 35, '6', 17),
(41, 5, 'utorak', 1, 35, '6', 17),
(42, 5, 'utorak', 2, 35, '6', 17),
(43, 5, 'cetvrtak', 3, 34, '5', 15),
(44, 5, 'cetvrtak', 4, 35, '5', 15),
(45, 5, 'cetvrtak', 5, 34, '131', 18),
(46, 5, 'cetvrtak', 6, 34, '131', 18),
(47, 6, 'ponedeljak', 3, 36, '309', 13),
(48, 6, 'ponedeljak', 4, 36, '309', 13),
(49, 6, 'sreda', 1, 37, '2', 14),
(50, 6, 'sreda', 2, 37, '2', 14),
(51, 6, 'sreda', 3, 8, '3', 10),
(52, 6, 'sreda', 4, 8, '3', 10),
(53, 6, 'petak', 1, 35, '4', 16),
(55, 6, 'petak', 2, 35, '4', 16),
(56, 6, 'petak', 3, 35, '6', 17),
(57, 6, 'petak', 4, 35, '6', 17),
(58, 7, 'utorak', 1, 34, '131', 18),
(59, 7, 'utorak', 2, 34, '131', 18),
(60, 7, 'utorak', 3, 8, '1', 4),
(61, 7, 'utorak', 4, 8, '1', 4),
(62, 7, 'sreda', 1, 8, '3', 10),
(63, 7, 'sreda', 2, 8, '3', 10),
(64, 2, 'petak', 3, 35, '6', 17),
(65, 7, 'petak', 4, 35, '6', 17),
(66, 7, 'petak', 3, 35, '6', 17);

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
(2, 'Prva beogradska gimnazija', 'Cara Dušana 61', 'Beograd'),
(3, 'Treća beogradska gimnazija', 'Njegoševa 61', 'Beograd'),
(4, 'Peta beogradska gimnazija', 'Ilije Garašanina 24', 'Belgrade'),
(5, 'Gimnazija Lazarevac', 'Miloja Bogdanovica 1', 'Lazarevac'),
(6, 'Matematicka gimnazija', 'Zeleni venac', 'Beograd');

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
(12, 2, 2),
(18, 3, 3),
(22, 3, 3),
(23, 2, 3),
(38, 2, 2),
(39, 2, 4),
(40, 2, 4),
(41, 2, 4),
(42, 2, 5),
(43, 2, 2),
(44, 2, 6),
(45, 2, 5),
(46, 2, 5),
(47, 2, 6),
(48, 2, 6),
(49, 2, 7),
(50, 2, 7),
(51, 2, 7);

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
(8, 'Vuk', 'Vukovic', 'vuk@mail.com', 'vuk_vukovic_1', '5a1001075d3205d010ef24413e6a1afd'),
(11, 'Branko', 'Brankovic', 'branko@live.com', 'branko_brankovic_1', 'fbee3d5b1def587f835e85a8a4c78195'),
(12, 'Goran', 'Goranovic', 'goran@gmail.com', 'goran_goranovic_1', '52ddd9ff1e957a1e6b15d329d8cefee7'),
(14, 'Elena', 'Elenic', 'elena@gmail.com', 'elena_elenic_1', 'f5c90d326bc375e17efee4325dc04b59'),
(15, 'Mica', 'Micovic', 'mica@mail.com', 'mica_micovic_1', '2ac8fad6f031fbd733007ff97b9ffcc7'),
(16, 'Mira', 'Miric', 'mira@mail.com', 'mira_miric_1', '83469ed2521f07cb27804061cf244132'),
(17, 'Žika', 'Žikić', 'zika@emai.com', 'zika_zikic_1', '234c992ccb4b1f60c4643ac2be57740f'),
(18, 'Zoran', 'Zorić', 'zoran@mail.com', 'zoran_zoric_1', '47e4b6fb92b60755791bd7a655d09191'),
(22, 'Milos', 'Vukovic', 'milos@mail.com', 'milos_milosevic_1', 'b82753180960205a4a62feff9c0f93f5'),
(23, 'Roki', 'Rokic', 'roki.rokic@mail.com', 'roki_rokic_1', '869b1b66b8cec6af9e434a98b8db30bf'),
(24, 'Bojan', 'Bojanic', 'bojan@mail.com', 'bojan_bojanic_1', '2a89afb221c007c2723065886371e4c9'),
(31, 'Aleksandar', 'Milic', 'aleksandar.milic24@gmail.com', 'aleksandar_milic_1', '78a9fb9298e6b7a50b8f99dd0d46feda'),
(32, 'Marko', 'Stojanovic', 'marko@student.etf.bg.ac.rs', 'marko_stojanovic_1', '26c7c9089e23c14396410bbc6675dbdf'),
(33, 'Milos', 'Teodosic', 'milosTeodosic@gmail.com', 'milos_teodosic_1', 'b82753180960205a4a62feff9c0f93f5'),
(34, 'Aleksa', 'Djekanovic', 'djeka@gmail.com', 'aleksa_djekanovic_1', 'f3071ec919ba79ea9d6fbe49c2c53a3d'),
(35, 'Stefan', 'Markovic', 'stefke@gmail.com', 'stefan_markovic_1', 'e42337a246c9864183d92125eb51d86c'),
(36, 'Jelena', 'Dobric', 'jeca@gmail.com', 'jelena_dobric_1', 'c62439ea56c71bf8b4760d507e0e646a'),
(37, 'Jovana', 'Dobrijevic', 'jovana@gmail.com', 'jovana_dobrijevic_1', 'd7c9aa725b1bdbf94b08502780f0341a'),
(38, 'Marko', 'Kraljevic', 'marko@gmail.com', 'marko_kraljevic_1', '26c7c9089e23c14396410bbc6675dbdf'),
(39, 'Veljko', 'Petrovic', 'veljko@gmail.com', 'veljko_petrovic_1', 'ece873523bc616811ee14bea46e654dd'),
(40, 'Janko', 'Stajcic', 'janko@gmail.com', 'janko_stajcic_1', '044879399025a6ac6f2c20fb8f86577d'),
(41, 'Jasmina', 'Simic', 'jasmina@gmail.com', 'jasmina_simic_1', '2a9bacea5a9a759c6337b40a17ace2f0'),
(42, 'Dusan', 'Aranitovic', 'dusan@gmail.com', 'dusan_aranitovic_1', 'f311cc41b56bb51f9d0bce464549da42'),
(43, 'Vesna', 'Markov', 'Vesna@gmail.com', 'vesna_markov_1', '14566edc95feb0b5207dfb078118028b'),
(44, 'Vera', 'Prodanov', 'vera@gmail.com', 'vera_prodanov_1', '79b013932a9a7efa4f9e7ee201b96aa7'),
(45, 'Aleksandar', 'Milicevic', 'aleksandar@gmail.com', 'aleksandar_milicevic_1', '78a9fb9298e6b7a50b8f99dd0d46feda'),
(46, 'Slobodan', 'Milosevic', 'sloba@gmail.com', 'slobodan_milosevic_1', '231bfe2424eb22ee64ff3e61c02406e4'),
(47, 'Desanka', 'Maksimovic', 'desa@gmail.com', 'desanka_maksimovic_1', '8d8e4cd6e6e8db4cc5c31c54c190cf98'),
(48, 'Milos', 'Obilic', 'milos@gmail.com', 'milos_obilic_1', 'b82753180960205a4a62feff9c0f93f5'),
(49, 'Goca', 'Trzan', 'goca@gmail.com', 'goca_trzan_1', 'b8567c70029d019374304fa3a63b0980'),
(50, 'Haris', 'Dzinovic', 'haris@gmail.com', 'haris_dzinovic_1', 'a724fe728a2b49d3f41a0c2120eb7780'),
(51, 'Jelena', 'Karleusa', 'jelena@gmail.com', 'jelena_karleusa_1', 'c62439ea56c71bf8b4760d507e0e646a');

-- --------------------------------------------------------

--
-- Table structure for table `vesti`
--

CREATE TABLE `vesti` (
  `id` int(11) NOT NULL,
  `naslov` varchar(255) COLLATE latin2_croatian_ci NOT NULL,
  `text` text COLLATE latin2_croatian_ci NOT NULL,
  `userLevel` varchar(30) COLLATE latin2_croatian_ci NOT NULL,
  `skolaId` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin2 COLLATE=latin2_croatian_ci;

--
-- Dumping data for table `vesti`
--

INSERT INTO `vesti` (`id`, `naslov`, `text`, `userLevel`, `skolaId`, `timestamp`) VALUES
(8, 'Obaveštenje za sve korisnike', 'Elektronskom Dnevniku će biti onemogućen pristup u petak između 01:00 i 05:00 zbog rutinskog održavanja sistema.', 'administrator_GLOBAL', 0, '2018-06-01 12:52:31'),
(19, 'Nova računarska oprema za našu školu', 'Projekat \"Stvaramo znanje\" deo je krovnog programa Telekoma Srbija \"Pokrećemo pokretače\" koji osnažuje institucije i pojedince da u svom okruženju pokreću pozitivne promene i motivišu druge da krenu tim putem. Pored opremanja informatičkih kabineta, čiji je cilj podizanje digitalne pismenosti kod dece i obezbeđivanje modernih uslova za rast i razvoj, kompanija ulaže u  sve pokretače novih i boljih društvenih promena i kroz projekte \"mts app konkurs\" i \"mts startap ubrzanje\" jer snažno veruje da stabilna podrška na samom početku može da im olakša put do novih saznanja i bude presudna za njihov dalji razvoj.', 'koordinator', 2, '2018-06-03 11:55:15'),
(20, 'Četvrtak, 07.07.', 'U četvrtak, 07.07.2018. škola neće raditi zbog velikih snežnih padavina.', 'koordinator', 3, '2018-06-03 11:57:38');

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
  ADD KEY `raspored_nastavnikFK` (`nastavnikId`),
  ADD KEY `raspored_predmetFK` (`predmetId`),
  ADD KEY `raspored_odeljenjeFK` (`odeljenjeId`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `odeljenje`
--
ALTER TABLE `odeljenje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `predmet`
--
ALTER TABLE `predmet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `raspored`
--
ALTER TABLE `raspored`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `skola`
--
ALTER TABLE `skola`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `vesti`
--
ALTER TABLE `vesti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  ADD CONSTRAINT `predmet_nastavnikFK` FOREIGN KEY (`nastavnik`) REFERENCES `nastavnik` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `predmet_skolaFK` FOREIGN KEY (`skolaId`) REFERENCES `skola` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `raspored`
--
ALTER TABLE `raspored`
  ADD CONSTRAINT `raspored_nastavnikFK` FOREIGN KEY (`nastavnikId`) REFERENCES `nastavnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `raspored_odeljenjeFK` FOREIGN KEY (`odeljenjeId`) REFERENCES `odeljenje` (`id`),
  ADD CONSTRAINT `raspored_predmetFK` FOREIGN KEY (`predmetId`) REFERENCES `predmet` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
