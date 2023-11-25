-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2023 at 09:33 PM
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
('A0001', 'shaorencheah@gmail.com', '$2y$10$pOEoVHr3/QyMEAS/r8uwv.6UumWaMcyyHtCks/3Szqkt5DLAfdM2a', 'Passenger'),
('A0002', 'driver@gmail.com', '$2y$10$bwxoEPV4pfHoSWcHRN4ySesswB5JUiHEvXsGfXyt4Rs2OGeO/aLTC', 'Driver');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` varchar(255) NOT NULL,
  `accountID` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `rewardName` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `selangor_districts`
--

CREATE TABLE `selangor_districts` (
  `district_id` varchar(5) NOT NULL,
  `district_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `selangor_districts`
--

INSERT INTO `selangor_districts` (`district_id`, `district_name`) VALUES
('D0001', 'Klang'),
('D0002', 'Petaling'),
('D0003', 'Gombak'),
('D0004', 'Sepang'),
('D0005', 'Ulu Langat'),
('D0006', 'Ulu Selangor'),
('D0007', 'Kuala Langat'),
('D0008', 'Kuala Selangor'),
('D0009', 'Sabak Bernam'),
('D0010', 'Kuala Lumpur'),
('D0011', 'Putrajaya');

-- --------------------------------------------------------

--
-- Table structure for table `selangor_neighborhoods`
--

CREATE TABLE `selangor_neighborhoods` (
  `neighborhood_id` varchar(5) NOT NULL,
  `neighborhood_name` varchar(255) NOT NULL,
  `district_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `selangor_neighborhoods`
--

INSERT INTO `selangor_neighborhoods` (`neighborhood_id`, `neighborhood_name`, `district_id`) VALUES
('N0001', 'Mukim Kapar', 'D0001'),
('N0002', 'Mukim Klang', 'D0001'),
('N0003', 'Bandar Klang', 'D0001'),
('N0004', 'Bandar Port Swettenham', 'D0001'),
('N0005', 'Bandar Sultan Sulaiman', 'D0001'),
('N0006', 'Bandar Shah Alam', 'D0001'),
('N0007', 'Pekan Bukit Kemuning', 'D0001'),
('N0008', 'Pekan Kapar', 'D0001'),
('N0009', 'Pekan Meru', 'D0001'),
('N0010', 'Pekan Telok Menegun', 'D0001'),
('N0011', 'Pekan Batu Empat', 'D0001'),
('N0012', 'Pekan Pandamaran', 'D0001'),
('N0013', 'Mukim Bandar', 'D0007'),
('N0014', 'Mukim Batu', 'D0007'),
('N0015', 'Mukim Jugra', 'D0007'),
('N0016', 'Mukim Kelanang', 'D0007'),
('N0017', 'Mukim Morib', 'D0007'),
('N0018', 'Mukim Tanjong Duabelas', 'D0007'),
('N0019', 'Mukim Telok Panglima Garang', 'D0007'),
('N0020', 'Bandar Banting', 'D0007'),
('N0021', 'Bandar Jenjarom', 'D0007'),
('N0022', 'Bandar Sijangkang', 'D0007'),
('N0023', 'Bandar Tanjong Sepat', 'D0007'),
('N0024', 'Bandar Telok Panglima Garan', 'D0007'),
('N0025', 'Pekan Batu', 'D0007'),
('N0026', 'Pekan Bukit Changgang', 'D0007'),
('N0027', 'Pekan Chodoi', 'D0007'),
('N0028', 'Pekan Jenjarom', 'D0007'),
('N0029', 'Pekan Kanchong', 'D0007'),
('N0030', 'Pekan Kanchong Darat', 'D0007'),
('N0031', 'Pekan Kelanang Batu Enam', 'D0007'),
('N0032', 'Pekan Morib', 'D0007'),
('N0033', 'Pekan Permatang Pasir', 'D0007'),
('N0034', 'Pekan Sijangkang', 'D0007'),
('N0035', 'Pekan Simpang Morib', 'D0007'),
('N0036', 'Pekan Sungai Manggis', 'D0007'),
('N0037', 'Pekan Sungai Raba', 'D0007'),
('N0038', 'Pekan Tanjong Duabelas', 'D0007'),
('N0039', 'Pekan Tanjong Datok', 'D0007'),
('N0040', 'Pekan Tongkah', 'D0007'),
('N0041', 'Pekan Telok', 'D0007'),
('N0042', 'Mukim Api-Api', 'D0008'),
('N0043', 'Mukim Ujong Permatang', 'D0008'),
('N0044', 'Mukim Ulu Tinggi', 'D0008'),
('N0045', 'Mukim Ijok', 'D0008'),
('N0046', 'Mukim Jeram', 'D0008'),
('N0047', 'Mukim Kuala Selangor', 'D0008'),
('N0048', 'Mukim Pasangan', 'D0008'),
('N0049', 'Mukim Tanjong Karang', 'D0008'),
('N0050', 'Mukim Bestari Jaya', 'D0008'),
('N0051', 'Bandar Kuala Selangor', 'D0008'),
('N0052', 'Bandar Tanjong Karang', 'D0008'),
('N0053', 'Pekan Asam Jawa', 'D0008'),
('N0054', 'Pekan Bukit Rotan', 'D0008'),
('N0055', 'Pekan Jeram', 'D0008'),
('N0056', 'Pekan Kampong Kuantan', 'D0008'),
('N0057', 'Pekan Kuala Sungai Buloh', 'D0008'),
('N0058', 'Pekan Pasir Penambang', 'D0008'),
('N0059', 'Pekan Simpang Tiga', 'D0008'),
('N0060', 'Pekan Tanjong Karang', 'D0008'),
('N0061', 'Pekan Bukit Belimbing', 'D0008'),
('N0062', 'Pekan Bukit Talang', 'D0008'),
('N0063', 'Pekan Kampong Baru Hulu Tiram Buruk', 'D0008'),
('N0064', 'Pekan Parit Mahang', 'D0008'),
('N0065', 'Pekan Simpang Tiga Ijok', 'D0008'),
('N0066', 'Pekan Sungai Sembilang', 'D0008'),
('N0067', 'Pekan Taman PKNS', 'D0008'),
('N0068', 'Pekan Tambak Jawa', 'D0008'),
('N0069', 'Pekan Bestari Jaya', 'D0008'),
('N0070', 'Mukim Nakhoda Omar', 'D0009'),
('N0071', 'Mukim Panchang Bedena', 'D0009'),
('N0072', 'Mukim Pasir Panjang', 'D0009'),
('N0073', 'Mukim Sabak', 'D0009'),
('N0074', 'Mukim Sungai Panjang', 'D0009'),
('N0075', 'Pekan Bagan Terap', 'D0009'),
('N0076', 'Pekan Parit Enam', 'D0009'),
('N0077', 'Pekan Parit Sembilan', 'D0009'),
('N0078', 'Pekan Sekinchan', 'D0009'),
('N0079', 'Pekan Lima', 'D0009'),
('N0080', 'Pekan Sungai Air Tawar', 'D0009'),
('N0081', 'Pekan Sepintas', 'D0009'),
('N0082', 'Pekan Bagan Nakhoda Omar', 'D0009'),
('N0083', 'Pekan Parit Batu', 'D0009'),
('N0084', 'Pekan Pasir Panjang', 'D0009'),
('N0085', 'Pekan Sekinchan Site A', 'D0009'),
('N0086', 'Pekan Sungai Besar', 'D0009'),
('N0087', 'Pekan Haji Dorani', 'D0009'),
('N0088', 'Pekan Sungai Nibong', 'D0009'),
('N0089', 'Mukim Batang Kali', 'D0006'),
('N0090', 'Mukim Buloh Telor', 'D0006'),
('N0091', 'Mukim Ampang Pechah', 'D0006'),
('N0092', 'Mukim Ulu Bernam', 'D0006'),
('N0093', 'Mukim Ulu Yam', 'D0006'),
('N0094', 'Mukim Kalumpang', 'D0006'),
('N0095', 'Mukim Kerling', 'D0006'),
('N0096', 'Mukim Kuala Kalumpang', 'D0006'),
('N0097', 'Mukim Peretak', 'D0006'),
('N0098', 'Mukim Rasa', 'D0006'),
('N0099', 'Mukim Serendah', 'D0006'),
('N0100', 'Mukim Sungai Gumut', 'D0006'),
('N0101', 'Mukim Sungai Tinggi', 'D0006'),
('N0102', 'Bandar Ulu Yam', 'D0006'),
('N0103', 'Bandar Ulu Yam Baharu', 'D0006'),
('N0104', 'Bandar Kalumpang', 'D0006'),
('N0105', 'Bandar Kuala Kubu Baharu', 'D0006'),
('N0106', 'Bandar Rasa', 'D0006'),
('N0107', 'Bandar Serendah', 'D0006'),
('N0108', 'Bandar Batang Kali', 'D0006'),
('N0109', 'Bandar Ulu Bernam I', 'D0006'),
('N0110', 'Bandar Ulu Bernam II', 'D0006'),
('N0111', 'Bandar Sungai Chik', 'D0006'),
('N0112', 'Pekan Kerling', 'D0006'),
('N0113', 'Pekan Peretak', 'D0006'),
('N0114', 'Pekan Simpang Sungai Choh', 'D0006'),
('N0115', 'Mukim Beranang', 'D0005'),
('N0116', 'Mukim Cheras', 'D0005'),
('N0117', 'Mukim Ampang', 'D0005'),
('N0118', 'Mukim Ulu Langat', 'D0005'),
('N0119', 'Mukim Ulu Semenyih', 'D0005'),
('N0120', 'Mukim Kajang', 'D0005'),
('N0121', 'Mukim Semenyih', 'D0005'),
('N0122', 'Bandar Cheras', 'D0005'),
('N0123', 'Bandar Ulu Langat', 'D0005'),
('N0124', 'Bandar Kajang', 'D0005'),
('N0125', 'Bandar Semenyih', 'D0005'),
('N0126', 'Bandar Ampang', 'D0005'),
('N0127', 'Bandar Country Height', 'D0005'),
('N0128', 'Bandar Balakong', 'D0005'),
('N0129', 'Bandar Baru Bangi', 'D0005'),
('N0130', 'Bandar Batu 9, Cheras', 'D0005'),
('N0131', 'Bandar Batu 18, Semenyih', 'D0005'),
('N0132', 'Bandar Batu 26, Beranang', 'D0005'),
('N0133', 'Pekan Beranang', 'D0005'),
('N0134', 'Pekan Kacau', 'D0005'),
('N0135', 'Pekan Tarun', 'D0005'),
('N0136', 'Pekan Bangi Lama', 'D0005'),
('N0137', 'Pekan Batu 18, Ulu Langat', 'D0005'),
('N0138', 'Pekan Batu 23, Sungai Lalang', 'D0005'),
('N0139', 'Pekan Batu 26, Beranang', 'D0005'),
('N0140', 'Pekan Bukit Sungai Raya', 'D0005'),
('N0141', 'Pekan Cheras', 'D0005'),
('N0142', 'Pekan Desa Raya', 'D0005'),
('N0143', 'Pekan Dusun Tua Ulu Langat', 'D0005'),
('N0144', 'Pekan Kajang', 'D0005'),
('N0145', 'Pekan Kampong Pasir, Batu 14, Semenyih', 'D0005'),
('N0146', 'Pekan Kampong Sungai Tangkas', 'D0005'),
('N0147', 'Pekan Rumah Murah Sungai Lui', 'D0005'),
('N0148', 'Pekan Semenyih', 'D0005'),
('N0149', 'Pekan Simpang Balak', 'D0005'),
('N0150', 'Pekan Nanding', 'D0005'),
('N0151', 'Pekan Kembong Sungai Beranang', 'D0005'),
('N0152', 'Pekan Sungai Lui', 'D0005'),
('N0153', 'Pekan Sungai Makau', 'D0005'),
('N0154', 'Mukim Bukit Raja', 'D0002'),
('N0155', 'Mukim Damansara', 'D0002'),
('N0156', 'Mukim Petaling', 'D0002'),
('N0157', 'Mukim Sungai Buloh', 'D0002'),
('N0158', 'Bandar Petaling Jaya', 'D0002'),
('N0159', 'Bandar Shah Alam (Seksyen 1-24)', 'D0002'),
('N0160', 'Bandar Damansara', 'D0002'),
('N0161', 'Bandar Glenmarie', 'D0002'),
('N0162', 'Bandar Petaling Jaya Selatan', 'D0002'),
('N0163', 'Bandar Saujana', 'D0002'),
('N0164', 'Bandar Sri Damansara', 'D0002'),
('N0165', 'Bandar Subang Jaya', 'D0002'),
('N0166', 'Bandar Sunway', 'D0002'),
('N0167', 'Pekan Batu Tiga', 'D0002'),
('N0168', 'Pekan Merbau Sempak', 'D0002'),
('N0169', 'Pekan Puchong', 'D0002'),
('N0170', 'Pekan Serdang', 'D0002'),
('N0171', 'Pekan Sungai Buloh', 'D0002'),
('N0172', 'Pekan Sungai Penchala', 'D0002'),
('N0173', 'Pekan Cempaka', 'D0002'),
('N0174', 'Pekan Country Height', 'D0002'),
('N0175', 'Pekan Desa Puchong', 'D0002'),
('N0176', 'Pekan Hicom', 'D0002'),
('N0177', 'Pekan Kayu Ara', 'D0002'),
('N0178', 'Pekan Kinrara', 'D0002'),
('N0179', 'Pekan Baru Hicom', 'D0002'),
('N0180', 'Pekan Baru Subang', 'D0002'),
('N0181', 'Pekan Baru Sungai Besi', 'D0002'),
('N0182', 'Pekan Baru Sungai Buloh', 'D0002'),
('N0183', 'Pekan Penaga', 'D0002'),
('N0184', 'Pekan Puchong Jaya', 'D0002'),
('N0185', 'Pekan Puchong Perdana', 'D0002'),
('N0186', 'Pekan Subang', 'D0002'),
('N0187', 'Pekan Subang Jaya', 'D0002'),
('N0188', 'Mukim Batu', 'D0003'),
('N0189', 'Mukim Ulu Kelang', 'D0003'),
('N0190', 'Mukim Rawang', 'D0003'),
('N0191', 'Mukim Setapak', 'D0003'),
('N0192', 'Bandar Batu Arang', 'D0003'),
('N0193', 'Bandar Kuang', 'D0003'),
('N0194', 'Bandar Rawang', 'D0003'),
('N0195', 'Bandar Gombak Setia', 'D0003'),
('N0196', 'Bandar Ulu Kelang', 'D0003'),
('N0197', 'Bandar Kepong', 'D0003'),
('N0198', 'Bandar Kundang', 'D0003'),
('N0199', 'Bandar Selayang', 'D0003'),
('N0200', 'Bandar Sungai Buloh', 'D0003'),
('N0201', 'Bandar Sungai Pusu', 'D0003'),
('N0202', 'Pekan Batu 20', 'D0003'),
('N0203', 'Pekan Kuang', 'D0003'),
('N0204', 'Pekan Mimaland', 'D0003'),
('N0205', 'Pekan Pengkalan Kundang', 'D0003'),
('N0206', 'Pekan Sungai Buloh', 'D0003'),
('N0207', 'Pekan Templer', 'D0003'),
('N0208', 'Mukim Dengkil', 'D0004'),
('N0209', 'Mukim Labu', 'D0004'),
('N0210', 'Mukim Sepang', 'D0004'),
('N0211', 'Bandar Sepang', 'D0004'),
('N0212', 'Bandar Baru Bangi', 'D0004'),
('N0213', 'Bandar Baru Salak Tinggi', 'D0004'),
('N0214', 'Bandar Lapangan Terbang Antarabangsa Sepang', 'D0004'),
('N0215', 'Bandar Sungai Merab', 'D0004'),
('N0216', 'Pekan Dengkil', 'D0004'),
('N0217', 'Pekan Salak', 'D0004'),
('N0218', 'Pekan Sungai Pelek', 'D0004'),
('N0219', 'Pekan Batu 1 Sepang', 'D0004'),
('N0220', 'Pekan Bukit Bisa', 'D0004'),
('N0221', 'Pekan Bukit Prang', 'D0004'),
('N0222', 'Pekan Dato Bakar Baginda', 'D0004'),
('N0223', 'Pekan Baru Salak Tinggi', 'D0004'),
('N0224', 'Pekan Sungai Merab', 'D0004'),
('N0225', 'Pekan Tanjung Mas', 'D0004'),
('N0226', 'Mukim Ampang', 'D0010'),
('N0227', 'Mukim Batu', 'D0010'),
('N0228', 'Mukim Cheras', 'D0010'),
('N0229', 'Mukim Ulu Kelang', 'D0010'),
('N0230', 'Mukim Kuala Lumpur', 'D0010'),
('N0231', 'Mukim Petaling', 'D0010'),
('N0232', 'Mukim Setapak', 'D0010'),
('N0233', 'Bandar Kuala Lumpur', 'D0010'),
('N0234', 'Bandar Petaling Jaya', 'D0010'),
('N0235', 'Bandar Bandar Baharu Sungai Besi', 'D0010'),
('N0236', 'Pekan Batu', 'D0010'),
('N0237', 'Pekan Batu Caves', 'D0010'),
('N0238', 'Pekan Kepong', 'D0010'),
('N0239', 'Pekan Kuala Pauh', 'D0010'),
('N0240', 'Pekan Petaling', 'D0010'),
('N0241', 'Pekan Salak South', 'D0010'),
('N0242', 'Pekan Sungai Penchala', 'D0010'),
('N0243', 'Bandar Putrajaya', 'D0011');

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
  `isDriver` tinyint(1) NOT NULL DEFAULT 0,
  `rating` float NOT NULL DEFAULT 0,
  `carRules` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`accountID`, `name`, `phoneNo`, `gender`, `dob`, `bio`, `rewardPoints`, `OTP`, `isDriver`, `rating`, `carRules`) VALUES
('A0001', 'Shaoren', '0163381806', 'm', '2023-11-20', NULL, 0, NULL, 0, 0, NULL),
('A0002', 'Jason', '0163381806', 'M', '2023-11-15', NULL, 0, NULL, 0, 0, NULL);

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
-- Indexes for table `selangor_districts`
--
ALTER TABLE `selangor_districts`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `selangor_neighborhoods`
--
ALTER TABLE `selangor_neighborhoods`
  ADD PRIMARY KEY (`neighborhood_id`,`district_id`),
  ADD KEY `district_id` (`district_id`);

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
-- Constraints for table `selangor_neighborhoods`
--
ALTER TABLE `selangor_neighborhoods`
  ADD CONSTRAINT `selangor_neighborhoods_ibfk_1` FOREIGN KEY (`district_id`) REFERENCES `selangor_districts` (`district_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `account_user_fk` FOREIGN KEY (`accountID`) REFERENCES `account` (`accountID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
