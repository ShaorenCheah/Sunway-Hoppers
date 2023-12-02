-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2023 at 07:35 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`accountID`, `email`, `password`, `type`) VALUES
('A0001', 'weikean184@gmail.com', '$2y$10$rzrpwrbk0xIEPaxOUJaNSeW54jFQ2R64IsMn5LYFZJy2sXUpJFQ/6', 'Admin'),
('A0002', 'mwj@gmail.com', '$2y$10$wPue2X8O.Rmw66hRhb/eKuXok1qr32/6He/nxErfZtoz/N2RVhP7.', 'Passenger'),
('A0003', 'dionneteh44@gmail.com', '$2y$10$vN0HAZW/bT6cePy69l4ljevrZkgGIeqDeq8cTCm2ARqUSKsHA0zwu', 'Passenger'),
('A0004', 'shaorencheah@gmail.com', '$2y$10$eqPt4GFYLp/SnDWgUoMnTuu2iCaqGrpUPLq4yNRvQa2aCnpVlQxYe', 'Passenger'),
('A0005', 'driver@gmail.com', '$2y$10$VX4IuiYM6Ywyxfi7cI5DaelsbObrwC4tDHEaMw/bkxU4iuHD7msXW', 'Driver');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `accountID` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phoneNo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`accountID`, `name`, `phoneNo`) VALUES
('A0001', 'Wey Ken', '0123891239');

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
  `driverCredentials` varchar(255) DEFAULT NULL,
  `vehicleRules` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `carpool`
--

CREATE TABLE `carpool` (
  `carpoolID` varchar(255) NOT NULL,
  `accountID` varchar(255) NOT NULL,
  `carpoolDate` date DEFAULT NULL,
  `carpoolTime` time DEFAULT NULL,
  `passengerAmt` int(2) DEFAULT NULL,
  `toSunway` tinyint(1) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `neighborhood` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `isWomenOnly` tinyint(1) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carpool`
--

INSERT INTO `carpool` (`carpoolID`, `accountID`, `carpoolDate`, `carpoolTime`, `passengerAmt`, `toSunway`, `district`, `neighborhood`, `location`, `details`, `isWomenOnly`, `status`) VALUES
('C0001', 'A0002', '2023-11-28', '16:25:00', 3, 1, 'Petaling', 'Bandar Subang Jaya', 'Monash University', 'I\'m departing from USJ 11. Feel free to hop on if you\'re around USJ7 or Taipan!', 0, 'Active'),
('C0002', 'A0002', '2023-11-29', '16:34:00', 10, 0, 'Gombak', 'Pekan Batu 20', 'Sunway Medical Centre', 'Hop on yeahh', 1, 'Active'),
('C0003', 'A0002', '2023-11-08', '16:42:00', 1, 1, 'Ulu Selangor', 'Mukim Serendah', 'Sunway Pyramid', 'Heya', 0, 'Active'),
('C0004', 'A0002', '2023-11-28', '17:51:00', 7, 0, 'Kuala Langat', 'Mukim Tanjong Duabelas', 'Sunway Residence', 'Yoo', 1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `carpool_passenger`
--

CREATE TABLE `carpool_passenger` (
  `carpoolID` varchar(255) NOT NULL,
  `accountID` varchar(255) NOT NULL,
  `isApproved` tinyint(1) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `rating` float(2,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `district_neighborhood`
--

CREATE TABLE `district_neighborhood` (
  `district_name` varchar(255) NOT NULL,
  `neighborhood_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `district_neighborhood`
--

INSERT INTO `district_neighborhood` (`district_name`, `neighborhood_name`) VALUES
('Klang', 'Mukim Kapar'),
('Klang', 'Mukim Klang'),
('Klang', 'Bandar Klang'),
('Klang', 'Bandar Port Swettenham'),
('Klang', 'Bandar Sultan Sulaiman'),
('Klang', 'Bandar Shah Alam'),
('Klang', 'Pekan Bukit Kemuning'),
('Klang', 'Pekan Kapar'),
('Klang', 'Pekan Meru'),
('Klang', 'Pekan Telok Menegun'),
('Klang', 'Pekan Batu Empat'),
('Klang', 'Pekan Pandamaran'),
('Petaling', 'Mukim Bukit Raja'),
('Petaling', 'Mukim Damansara'),
('Petaling', 'Mukim Petaling'),
('Petaling', 'Mukim Sungai Buloh'),
('Petaling', 'Bandar Petaling Jaya'),
('Petaling', 'Bandar Shah Alam (Seksyen 1-24)'),
('Petaling', 'Bandar Damansara'),
('Petaling', 'Bandar Glenmarie'),
('Petaling', 'Bandar Petaling Jaya Selatan'),
('Petaling', 'Bandar Saujana'),
('Petaling', 'Bandar Sri Damansara'),
('Petaling', 'Bandar Subang Jaya'),
('Petaling', 'Bandar Sunway'),
('Petaling', 'Pekan Batu Tiga'),
('Petaling', 'Pekan Merbau Sempak'),
('Petaling', 'Pekan Puchong'),
('Petaling', 'Pekan Serdang'),
('Petaling', 'Pekan Sungai Buloh'),
('Petaling', 'Pekan Sungai Penchala'),
('Petaling', 'Pekan Cempaka'),
('Petaling', 'Pekan Country Height'),
('Petaling', 'Pekan Desa Puchong'),
('Petaling', 'Pekan Hicom'),
('Petaling', 'Pekan Kayu Ara'),
('Petaling', 'Pekan Kinrara'),
('Petaling', 'Pekan Baru Hicom'),
('Petaling', 'Pekan Baru Subang'),
('Petaling', 'Pekan Baru Sungai Besi'),
('Petaling', 'Pekan Baru Sungai Buloh'),
('Petaling', 'Pekan Penaga'),
('Petaling', 'Pekan Puchong Jaya'),
('Petaling', 'Pekan Puchong Perdana'),
('Petaling', 'Pekan Subang'),
('Petaling', 'Pekan Subang Jaya'),
('Gombak', 'Mukim Batu'),
('Gombak', 'Mukim Ulu Kelang'),
('Gombak', 'Mukim Rawang'),
('Gombak', 'Mukim Setapak'),
('Gombak', 'Bandar Batu Arang'),
('Gombak', 'Bandar Kuang'),
('Gombak', 'Bandar Rawang'),
('Gombak', 'Bandar Gombak Setia'),
('Gombak', 'Bandar Ulu Kelang'),
('Gombak', 'Bandar Kepong'),
('Gombak', 'Bandar Kundang'),
('Gombak', 'Bandar Selayang'),
('Gombak', 'Bandar Sungai Buloh'),
('Gombak', 'Bandar Sungai Pusu'),
('Gombak', 'Pekan Batu 20'),
('Gombak', 'Pekan Kuang'),
('Gombak', 'Pekan Mimaland'),
('Gombak', 'Pekan Pengkalan Kundang'),
('Gombak', 'Pekan Sungai Buloh'),
('Gombak', 'Pekan Templer'),
('Sepang', 'Mukim Dengkil'),
('Sepang', 'Mukim Labu'),
('Sepang', 'Mukim Sepang'),
('Sepang', 'Bandar Sepang'),
('Sepang', 'Bandar Baru Bangi'),
('Sepang', 'Bandar Baru Salak Tinggi'),
('Sepang', 'Bandar Lapangan Terbang Antarabangsa Sepang'),
('Sepang', 'Bandar Sungai Merab'),
('Sepang', 'Pekan Dengkil'),
('Sepang', 'Pekan Salak'),
('Sepang', 'Pekan Sungai Pelek'),
('Sepang', 'Pekan Batu 1 Sepang'),
('Sepang', 'Pekan Bukit Bisa'),
('Sepang', 'Pekan Bukit Prang'),
('Sepang', 'Pekan Dato Bakar Baginda'),
('Sepang', 'Pekan Baru Salak Tinggi'),
('Sepang', 'Pekan Sungai Merab'),
('Sepang', 'Pekan Tanjung Mas'),
('Ulu Langat', 'Mukim Beranang'),
('Ulu Langat', 'Mukim Cheras'),
('Ulu Langat', 'Mukim Ampang'),
('Ulu Langat', 'Mukim Ulu Langat'),
('Ulu Langat', 'Mukim Ulu Semenyih'),
('Ulu Langat', 'Mukim Kajang'),
('Ulu Langat', 'Mukim Semenyih'),
('Ulu Langat', 'Bandar Cheras'),
('Ulu Langat', 'Bandar Ulu Langat'),
('Ulu Langat', 'Bandar Kajang'),
('Ulu Langat', 'Bandar Semenyih'),
('Ulu Langat', 'Bandar Ampang'),
('Ulu Langat', 'Bandar Country Height'),
('Ulu Langat', 'Bandar Balakong'),
('Ulu Langat', 'Bandar Baru Bangi'),
('Ulu Langat', 'Bandar Batu 9, Cheras'),
('Ulu Langat', 'Bandar Batu 18, Semenyih'),
('Ulu Langat', 'Bandar Batu 26, Beranang'),
('Ulu Langat', 'Pekan Beranang'),
('Ulu Langat', 'Pekan Kacau'),
('Ulu Langat', 'Pekan Tarun'),
('Ulu Langat', 'Pekan Bangi Lama'),
('Ulu Langat', 'Pekan Batu 18, Ulu Langat'),
('Ulu Langat', 'Pekan Batu 23, Sungai Lalang'),
('Ulu Langat', 'Pekan Batu 26, Beranang'),
('Ulu Langat', 'Pekan Bukit Sungai Raya'),
('Ulu Langat', 'Pekan Cheras'),
('Ulu Langat', 'Pekan Desa Raya'),
('Ulu Langat', 'Pekan Dusun Tua Ulu Langat'),
('Ulu Langat', 'Pekan Kajang'),
('Ulu Langat', 'Pekan Kampong Pasir, Batu 14, Semenyih'),
('Ulu Langat', 'Pekan Kampong Sungai Tangkas'),
('Ulu Langat', 'Pekan Rumah Murah Sungai Lui'),
('Ulu Langat', 'Pekan Semenyih'),
('Ulu Langat', 'Pekan Simpang Balak'),
('Ulu Langat', 'Pekan Nanding'),
('Ulu Langat', 'Pekan Kembong Sungai Beranang'),
('Ulu Langat', 'Pekan Sungai Lui'),
('Ulu Langat', 'Pekan Sungai Makau'),
('Ulu Selangor', 'Mukim Batang Kali'),
('Ulu Selangor', 'Mukim Buloh Telor'),
('Ulu Selangor', 'Mukim Ampang Pechah'),
('Ulu Selangor', 'Mukim Ulu Bernam'),
('Ulu Selangor', 'Mukim Ulu Yam'),
('Ulu Selangor', 'Mukim Kalumpang'),
('Ulu Selangor', 'Mukim Kerling'),
('Ulu Selangor', 'Mukim Kuala Kalumpang'),
('Ulu Selangor', 'Mukim Peretak'),
('Ulu Selangor', 'Mukim Rasa'),
('Ulu Selangor', 'Mukim Serendah'),
('Ulu Selangor', 'Mukim Sungai Gumut'),
('Ulu Selangor', 'Mukim Sungai Tinggi'),
('Ulu Selangor', 'Bandar Ulu Yam'),
('Ulu Selangor', 'Bandar Ulu Yam Baharu'),
('Ulu Selangor', 'Bandar Kalumpang'),
('Ulu Selangor', 'Bandar Kuala Kubu Baharu'),
('Ulu Selangor', 'Bandar Rasa'),
('Ulu Selangor', 'Bandar Serendah'),
('Ulu Selangor', 'Bandar Batang Kali'),
('Ulu Selangor', 'Bandar Ulu Bernam I'),
('Ulu Selangor', 'Bandar Ulu Bernam II'),
('Ulu Selangor', 'Bandar Sungai Chik'),
('Ulu Selangor', 'Pekan Kerling'),
('Ulu Selangor', 'Pekan Peretak'),
('Ulu Selangor', 'Pekan Simpang Sungai Choh'),
('Kuala Langat', 'Mukim Bandar'),
('Kuala Langat', 'Mukim Batu'),
('Kuala Langat', 'Mukim Jugra'),
('Kuala Langat', 'Mukim Kelanang'),
('Kuala Langat', 'Mukim Morib'),
('Kuala Langat', 'Mukim Tanjong Duabelas'),
('Kuala Langat', 'Mukim Telok Panglima Garang'),
('Kuala Langat', 'Bandar Banting'),
('Kuala Langat', 'Bandar Jenjarom'),
('Kuala Langat', 'Bandar Sijangkang'),
('Kuala Langat', 'Bandar Tanjong Sepat'),
('Kuala Langat', 'Bandar Telok Panglima Garan'),
('Kuala Langat', 'Pekan Batu'),
('Kuala Langat', 'Pekan Bukit Changgang'),
('Kuala Langat', 'Pekan Chodoi'),
('Kuala Langat', 'Pekan Jenjarom'),
('Kuala Langat', 'Pekan Kanchong'),
('Kuala Langat', 'Pekan Kanchong Darat'),
('Kuala Langat', 'Pekan Kelanang Batu Enam'),
('Kuala Langat', 'Pekan Morib'),
('Kuala Langat', 'Pekan Permatang Pasir'),
('Kuala Langat', 'Pekan Sijangkang'),
('Kuala Langat', 'Pekan Simpang Morib'),
('Kuala Langat', 'Pekan Sungai Manggis'),
('Kuala Langat', 'Pekan Sungai Raba'),
('Kuala Langat', 'Pekan Tanjong Duabelas'),
('Kuala Langat', 'Pekan Tanjong Datok'),
('Kuala Langat', 'Pekan Tongkah'),
('Kuala Langat', 'Pekan Telok'),
('Kuala Selangor', 'Mukim Api-Api'),
('Kuala Selangor', 'Mukim Ujong Permatang'),
('Kuala Selangor', 'Mukim Ulu Tinggi'),
('Kuala Selangor', 'Mukim Ijok'),
('Kuala Selangor', 'Mukim Jeram'),
('Kuala Selangor', 'Mukim Kuala Selangor'),
('Kuala Selangor', 'Mukim Pasangan'),
('Kuala Selangor', 'Mukim Tanjong Karang'),
('Kuala Selangor', 'Mukim Bestari Jaya'),
('Kuala Selangor', 'Bandar Kuala Selangor'),
('Kuala Selangor', 'Bandar Tanjong Karang'),
('Kuala Selangor', 'Pekan Asam Jawa'),
('Kuala Selangor', 'Pekan Bukit Rotan'),
('Kuala Selangor', 'Pekan Jeram'),
('Kuala Selangor', 'Pekan Kampong Kuantan'),
('Kuala Selangor', 'Pekan Kuala Sungai Buloh'),
('Kuala Selangor', 'Pekan Pasir Penambang'),
('Kuala Selangor', 'Pekan Simpang Tiga'),
('Kuala Selangor', 'Pekan Tanjong Karang'),
('Kuala Selangor', 'Pekan Bukit Belimbing'),
('Kuala Selangor', 'Pekan Bukit Talang'),
('Kuala Selangor', 'Pekan Kampong Baru Hulu Tiram Buruk'),
('Kuala Selangor', 'Pekan Parit Mahang'),
('Kuala Selangor', 'Pekan Simpang Tiga Ijok'),
('Kuala Selangor', 'Pekan Sungai Sembilang'),
('Kuala Selangor', 'Pekan Taman PKNS'),
('Kuala Selangor', 'Pekan Tambak Jawa'),
('Kuala Selangor', 'Pekan Bestari Jaya'),
('Sabak Bernam', 'Mukim Nakhoda Omar'),
('Sabak Bernam', 'Mukim Panchang Bedena'),
('Sabak Bernam', 'Mukim Pasir Panjang'),
('Sabak Bernam', 'Mukim Sabak'),
('Sabak Bernam', 'Mukim Sungai Panjang'),
('Sabak Bernam', 'Pekan Bagan Terap'),
('Sabak Bernam', 'Pekan Parit Enam'),
('Sabak Bernam', 'Pekan Parit Sembilan'),
('Sabak Bernam', 'Pekan Sekinchan'),
('Sabak Bernam', 'Pekan Lima'),
('Sabak Bernam', 'Pekan Sungai Air Tawar'),
('Sabak Bernam', 'Pekan Sepintas'),
('Sabak Bernam', 'Pekan Bagan Nakhoda Omar'),
('Sabak Bernam', 'Pekan Parit Batu'),
('Sabak Bernam', 'Pekan Pasir Panjang'),
('Sabak Bernam', 'Pekan Sekinchan Site A'),
('Sabak Bernam', 'Pekan Sungai Besar'),
('Sabak Bernam', 'Pekan Haji Dorani'),
('Sabak Bernam', 'Pekan Sungai Nibong'),
('Kuala Lumpur', 'Mukim Ampang'),
('Kuala Lumpur', 'Mukim Batu'),
('Kuala Lumpur', 'Mukim Cheras'),
('Kuala Lumpur', 'Mukim Ulu Kelang'),
('Kuala Lumpur', 'Mukim Kuala Lumpur'),
('Kuala Lumpur', 'Mukim Petaling'),
('Kuala Lumpur', 'Mukim Setapak'),
('Kuala Lumpur', 'Bandar Kuala Lumpur'),
('Kuala Lumpur', 'Bandar Petaling Jaya'),
('Kuala Lumpur', 'Bandar Bandar Baharu Sungai Besi'),
('Kuala Lumpur', 'Pekan Batu'),
('Kuala Lumpur', 'Pekan Batu Caves'),
('Kuala Lumpur', 'Pekan Kepong'),
('Kuala Lumpur', 'Pekan Kuala Pauh'),
('Kuala Lumpur', 'Pekan Petaling'),
('Kuala Lumpur', 'Pekan Salak South'),
('Kuala Lumpur', 'Pekan Sungai Penchala'),
('Putrajaya', 'Bandar Putrajaya');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reward`
--

CREATE TABLE `reward` (
  `rewardID` varchar(255) NOT NULL,
  `rewardName` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reward`
--

INSERT INTO `reward` (`rewardID`, `rewardName`, `description`, `img`, `points`, `type`, `quantity`) VALUES
('R0001', 'Tealive', 'Kill the summer heat by enjoying a nice, cold beverage. Get RM10 off your favourite Tealive! ', '../images/uploads/6928e09c06c405bf03d642ca799460d2.png', 1000, 'fnb', '12'),
('R0002', 'Sunway Originals', 'Use it at Sunway Originals', '../images/uploads/5044c2acf6f482a6630204c3be4ed02b.png', 500, 'originals', '23');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `accountID` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phoneNo` varchar(255) NOT NULL,
  `gender` char(1) NOT NULL,
  `dob` date NOT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `rewardPoints` int(11) NOT NULL DEFAULT 0,
  `OTP` varchar(255) DEFAULT NULL,
  `rating` float NOT NULL DEFAULT 0,
  `carRules` varchar(255) DEFAULT NULL,
  `profilePic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`accountID`, `name`, `phoneNo`, `gender`, `dob`, `bio`, `rewardPoints`, `OTP`, `rating`, `carRules`, `profilePic`) VALUES
('A0002', 'Mak', '0163381806', 'm', '2023-11-20', NULL, 0, NULL, 0, NULL, NULL),
('A0003', 'Dionne', '0163381806', 'f', '2023-11-20', NULL, 0, NULL, 0, NULL, NULL),
('A0004', 'Cheah Shaoren', '0163381806', 'm', '2003-06-18', NULL, 0, NULL, 0, NULL, NULL),
('A0005', 'Jason', '0162882026', 'M', '2023-12-03', NULL, 0, NULL, 0, NULL, 'default.png');

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
  ADD PRIMARY KEY (`accountID`),
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
-- Indexes for table `carpool_passenger`
--
ALTER TABLE `carpool_passenger`
  ADD PRIMARY KEY (`carpoolID`,`accountID`),
  ADD KEY `carpoolID` (`carpoolID`),
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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`accountID`),
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
-- Constraints for table `carpool_passenger`
--
ALTER TABLE `carpool_passenger`
  ADD CONSTRAINT `carpool_passenger_ibfk_1` FOREIGN KEY (`carpoolID`) REFERENCES `carpool` (`carpoolID`),
  ADD CONSTRAINT `carpool_passenger_ibfk_2` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`);

--
-- Constraints for table `redemption`
--
ALTER TABLE `redemption`
  ADD CONSTRAINT `redemption_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`),
  ADD CONSTRAINT `redemption_ibfk_2` FOREIGN KEY (`rewardID`) REFERENCES `reward` (`rewardID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `account_user_fk` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
