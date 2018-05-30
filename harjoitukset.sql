-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2018 at 11:51 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a1600545`
--

-- --------------------------------------------------------

--
-- Table structure for table `harjoitukset`
--

create database a1600545;
use a1600545;

CREATE TABLE `harjoitukset` (
  `id` int(10) UNSIGNED NOT NULL,
  `nimi` varchar(30) NOT NULL,
  `sukupuoli` varchar(10) NOT NULL,
  `hetu` varchar(50) NOT NULL,
  `pvm` varchar(50) NOT NULL,
  `tunnus` varchar(50) NOT NULL,
  `osoite` varchar(50) NOT NULL,
  `kommentti` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `harjoitukset`
--

INSERT INTO `harjoitukset` (`id`, `nimi`, `sukupuoli`, `hetu`, `pvm`, `tunnus`, `osoite`, `kommentti`) VALUES
(1, 'Marko', 'Mies', '131052-308T', '21.5.2018', '1111-2222-3333-4444', 'Hermannintie 1 A', 'Ei tästä mitään tule');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `harjoitukset`
--
ALTER TABLE `harjoitukset`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `harjoitukset`
--
ALTER TABLE `harjoitukset`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
