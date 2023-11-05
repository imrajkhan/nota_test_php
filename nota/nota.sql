-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2023 at 08:02 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nota`
--

-- --------------------------------------------------------

--
-- Table structure for table `wiki_sections`
--

CREATE TABLE `wiki_sections` (
  `id` int(11) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `title` varchar(230) DEFAULT NULL,
  `url` varchar(240) DEFAULT NULL,
  `picture` varchar(240) DEFAULT NULL,
  `abstract` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wiki_sections`
--
ALTER TABLE `wiki_sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`),
  ADD UNIQUE KEY `picture` (`picture`),
  ADD UNIQUE KEY `abstract` (`abstract`),
  ADD KEY `url_2` (`url`(100)),
  ADD KEY `picture_2` (`picture`(100)),
  ADD KEY `abstract_2` (`abstract`(100));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wiki_sections`
--
ALTER TABLE `wiki_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
