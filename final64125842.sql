-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 08, 2023 at 06:58 AM
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
-- Database: `final64125842`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bID` varchar(100) NOT NULL,
  `uID` varchar(100) NOT NULL,
  `cID` varchar(100) NOT NULL,
  `uDateFrom` date NOT NULL,
  `uDateTo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bID`, `uID`, `cID`, `uDateFrom`, `uDateTo`) VALUES
('3001', '2001', '1004', '2023-08-15', '2023-08-16'),
('3002', '2001', '1004', '2023-08-16', '2023-08-17'),
('3003', '2001', '1004', '2023-08-10', '2023-08-30'),
('3004', '2002', '1005', '2023-09-08', '2023-09-10'),
('64fa78569fcdc', '9999', '1003', '2023-09-08', '2023-09-11'),
('64fa8306b0c10', '9999', '1001', '2023-09-08', '2023-09-08'),
('64faa8df3598c', '9999', '1002', '2023-09-08', '2023-09-22');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `cID` varchar(10) NOT NULL,
  `cName` varchar(50) NOT NULL,
  `cBrand` varchar(25) NOT NULL,
  `cType` varchar(25) NOT NULL,
  `cPassengers` int(11) NOT NULL,
  `cImage` varchar(200) NOT NULL,
  `cPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`cID`, `cName`, `cBrand`, `cType`, `cPassengers`, `cImage`, `cPrice`) VALUES
('1001', 'Fit', 'Honda', 'Small', 5, 'https://content.r9cdn.net/rimg/carimages/generic/02_economy_white.png', 905),
('1002', 'Yaris', 'Toyota', 'Small', 5, 'https://content.r9cdn.net/rimg/carimages/generic/02_economy_red.png', 784),
('1003', 'Sentra', 'Nissan', 'Medium', 5, 'https://content.r9cdn.net/rimg/carimages/generic/02_economy_coolgrey.png', 1695),
('1004', 'X1', 'BMW', 'Large', 5, 'https://content.r9cdn.net/rimg/carimages/generic/05_suv-small_black.png', 3767),
('1005', 'Fortuner', 'Toyota', 'SUV', 7, 'https://content.r9cdn.net/rimg/carimages/generic/07_suv-large_white.png', 2647);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uID` varchar(100) NOT NULL,
  `uTelephone` varchar(100) NOT NULL,
  `uPassword` varchar(100) NOT NULL,
  `uName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uID`, `uTelephone`, `uPassword`, `uName`) VALUES
('2001', '0949922678', 'mobile123', 'Thanakorn'),
('2002', '0657210542', '123mobile', 'Pathompong'),
('2003', '0893219234', 'gradeA', 'Salinda'),
('9999', '123', '123', 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bID`),
  ADD KEY `fk_bookings_cars_cID` (`cID`),
  ADD KEY `fk_bookings_user_uID` (`uID`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`cID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_bookings_cars_cID` FOREIGN KEY (`cID`) REFERENCES `cars` (`cID`),
  ADD CONSTRAINT `fk_bookings_user_uID` FOREIGN KEY (`uID`) REFERENCES `user` (`uID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
