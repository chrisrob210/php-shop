-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql104.epizy.com
-- Generation Time: Jul 26, 2022 at 04:12 PM
-- Server version: 10.3.27-MariaDB
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
-- Database: `epiz_30164245_phpshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `ProductId` varchar(20) NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `Description` text DEFAULT NULL,
  `Image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`Id`, `Name`, `ProductId`, `Price`, `Description`, `Image`) VALUES
(1, 'Game Controller', 'F310', '20', 'Logitech F310 gamepad', 'shop/img/f310.jpg'),
(2, 'Chromebook', 'CB1337', '180', 'Google Chromebook', 'shop/img/chromebook-generic.jpg'),
(4, 'School Supplies Special', 'backtoschool1985', '20', 'School Supplies Bundle', 'shop/img/back-to-school-special-1955.jpg'),
(5, 'Learn PHP Coding Book', 'phpbook8', '40', 'PHP Coding Book', 'shop/img/php-original.svg'),
(6, 'HTML5 For Dummies', 'html5fd22', '16', 'HTML5 Basics', 'shop/img/html5-original-wordmark.svg'),
(7, 'Azure Web Services', 'AzureCloud2265', '225', 'Azure Web Services Bundle', 'shop/img/azure-original-wordmark.svg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
