-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2017 at 09:36 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bilansa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'jasminko', 'wtwtwt');

-- --------------------------------------------------------

--
-- Table structure for table `klijenti`
--

CREATE TABLE `klijenti` (
  `id` int(11) NOT NULL,
  `naziv` varchar(40) COLLATE utf8_slovenian_ci NOT NULL,
  `telefon` varchar(11) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_slovenian_ci NOT NULL,
  `jib` varchar(13) COLLATE utf8_slovenian_ci NOT NULL,
  `adresa` varchar(40) COLLATE utf8_slovenian_ci NOT NULL,
  `opcina` varchar(30) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `klijenti`
--

INSERT INTO `klijenti` (`id`, `naziv`, `telefon`, `email`, `jib`, `adresa`, `opcina`) VALUES
(1, 'TEST KLIJENT 1', '061/434-124', 'darkvalkirion@gmail.com', '4336930485617', 'Bosanska bb', 'Fojnica'),
(2, 'TEST KLIJENT 2', '030/831-447', 'jasminko.v@hotmail.com', '423693644449', 'Ferhadija 5', 'Sarajevo'),
(3, 'TEST KLIJENT 3', '062/473-182', 'jv15163@etf.unsa.ba', '4336930000000', 'Talića Brdo bb', 'Zenica');

-- --------------------------------------------------------

--
-- Table structure for table `mailing_lista`
--

CREATE TABLE `mailing_lista` (
  `id` int(11) NOT NULL,
  `online_klijent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `mailing_lista`
--

INSERT INTO `mailing_lista` (`id`, `online_klijent_id`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `online_klijenti`
--

CREATE TABLE `online_klijenti` (
  `id` int(11) NOT NULL,
  `klijent_id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `online_klijenti`
--

INSERT INTO `online_klijenti` (`id`, `klijent_id`, `username`, `password`) VALUES
(1, 1, 'testklijent1', 'jasminvid'),
(2, 2, 'testklijent2', 'vidjasmin'),
(3, 3, 'testklijent3', 'xxxyyy');

-- --------------------------------------------------------

--
-- Table structure for table `poruke`
--

CREATE TABLE `poruke` (
  `id` int(11) NOT NULL,
  `posiljaoc` varchar(40) COLLATE utf8_slovenian_ci NOT NULL,
  `telefon` varchar(11) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_slovenian_ci NOT NULL,
  `ocjena` varchar(1) COLLATE utf8_slovenian_ci NOT NULL,
  `tekst` varchar(100) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klijenti`
--
ALTER TABLE `klijenti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mailing_lista`
--
ALTER TABLE `mailing_lista`
  ADD PRIMARY KEY (`id`),
  ADD KEY `online_klijent_id` (`online_klijent_id`);

--
-- Indexes for table `online_klijenti`
--
ALTER TABLE `online_klijenti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `klijent_id` (`klijent_id`);

--
-- Indexes for table `poruke`
--
ALTER TABLE `poruke`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `klijenti`
--
ALTER TABLE `klijenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mailing_lista`
--
ALTER TABLE `mailing_lista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `online_klijenti`
--
ALTER TABLE `online_klijenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `poruke`
--
ALTER TABLE `poruke`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `mailing_lista`
--
ALTER TABLE `mailing_lista`
  ADD CONSTRAINT `fkfk` FOREIGN KEY (`online_klijent_id`) REFERENCES `online_klijenti` (`id`);

--
-- Constraints for table `online_klijenti`
--
ALTER TABLE `online_klijenti`
  ADD CONSTRAINT `fk` FOREIGN KEY (`klijent_id`) REFERENCES `klijenti` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
