-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 04:40 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sunwayhoppers`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `accountID` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`accountID`, `email`, `password`, `type`) VALUES
('', 'shaorencheah@gmail.com', '$2y$10$pOEoVHr3/QyMEAS/r8uwv.6UumWaMcyyHtCks/3Szqkt5DLAfdM2a', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` varchar(255) NOT NULL,
  `accountID` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `applicationID` varchar(255) NOT NULL,
  `accountID` varchar(255) NOT NULL,
  `vehicleNo` varchar(255) DEFAULT NULL,
  `vehicleType` varchar(255) DEFAULT NULL,
  `vehicleColour` varchar(255) DEFAULT NULL,
  `driverCredentials` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carpool`
--

CREATE TABLE `carpool` (
  `carpoolID` varchar(255) NOT NULL,
  `accountID` varchar(255) NOT NULL,
  `isApproved` tinyint(1) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `rating` float(2,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `redemption`
--

CREATE TABLE `redemption` (
  `redemptionID` varchar(255) NOT NULL,
  `accountID` varchar(255) NOT NULL,
  `rewardID` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `expiryDate` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reward`
--

CREATE TABLE `reward` (
  `rewardID` varchar(255) NOT NULL,
  `rewardName` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `carpoolID` varchar(255) NOT NULL,
  `accountID` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `passengerAmt` int(1) DEFAULT NULL,
  `isWomenOnly` tinyint(1) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phoneNo` varchar(255) NOT NULL,
  `gender` char(1) NOT NULL,
  `dob` date NOT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `rewardPoints` int(11) NOT NULL DEFAULT 0,
  `OTP` varchar(255) DEFAULT NULL,
  `isDriver` tinyint(1) NOT NULL DEFAULT 0,
  `rating` float NOT NULL DEFAULT 0,
  `carRules` varchar(255) DEFAULT NULL,
  `accountID` varchar(255) NOT NULL,
  `profilePic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `name`, `phoneNo`, `gender`, `dob`, `bio`, `rewardPoints`, `OTP`, `isDriver`, `rating`, `carRules`, `accountID`) VALUES
('', 'Shaoren', '0163381806', 'm', '2023-11-20', NULL, 0, NULL, 0, 0, NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`accountID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`),
  ADD KEY `accountID` (`accountID`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`applicationID`),
  ADD KEY `accountID` (`accountID`);

--
-- Indexes for table `carpool`
--
ALTER TABLE `carpool`
  ADD PRIMARY KEY (`carpoolID`),
  ADD KEY `accountID` (`accountID`);

--
-- Indexes for table `redemption`
--
ALTER TABLE `redemption`
  ADD PRIMARY KEY (`redemptionID`),
  ADD KEY `accountID` (`accountID`),
  ADD KEY `rewardID` (`rewardID`);

--
-- Indexes for table `reward`
--
ALTER TABLE `reward`
  ADD PRIMARY KEY (`rewardID`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`carpoolID`,`accountID`),
  ADD KEY `accountID` (`accountID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `account_user_fk` (`accountID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`);

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`);

--
-- Constraints for table `carpool`
--
ALTER TABLE `carpool`
  ADD CONSTRAINT `carpool_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`);

--
-- Constraints for table `redemption`
--
ALTER TABLE `redemption`
  ADD CONSTRAINT `redemption_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`),
  ADD CONSTRAINT `redemption_ibfk_2` FOREIGN KEY (`rewardID`) REFERENCES `reward` (`rewardID`);

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`carpoolID`) REFERENCES `carpool` (`carpoolID`),
  ADD CONSTRAINT `session_ibfk_2` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `account_user_fk` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
