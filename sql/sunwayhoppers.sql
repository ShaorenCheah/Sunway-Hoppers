-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2023 at 07:22 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

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
('A0001', 'admin@gmail.com', '$2y$10$sO0pOOA0mVrkmHZmUsX0P.uol4lhA3E1KtLXfgtwpiYCyZEcCd7aa', 'Admin'),
('A0002', 'weyken@gmail.com', '$2y$10$QXzONuYXtiwZiCV2GdVJOu.WhEPVyOEXPynFTn0qqyxt72T6r/GgC', 'Admin'),
('A0003', 'johndoe@imail.sunway.edu.my', '$2y$10$9ASFf78NiNrXYUoNfx1TIu0bSFTENAo2QW1plvuThUA7Wzf.Jllee', 'Driver'),
('A0004', 'celinewong@imail.sunway.edu.my', '$2y$10$or7r8YlE7I03OKpqNBnt9Ojw/pVCChfSkYcBh6rsZQcQ0KhlsQXJ6', 'Driver'),
('A0005', 'jolene12@imail.sunway.edu.my', '$2y$10$wuNrnC2VRRr.4kBQRJcPPuFxvuhbk78GRr.ifuA6U9nI0nrqcWBeS', 'Passenger'),
('A0006', 'mwj@imail.sunway.edu.my', '$2y$10$AvlIp90P8wZekyUKgnYgO.nY51AN1ofpFUo63.zYF7qMsMpEl7JcG', 'Driver');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `accountID` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phoneNo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`accountID`, `name`, `phoneNo`) VALUES
('A0001', 'Admin', '0164783956'),
('A0002', 'Wey Ken', '0175590375');

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
  `status` varchar(255) DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`applicationID`, `accountID`, `vehicleNo`, `vehicleType`, `vehicleColour`, `driverCredentials`, `vehicleRules`, `status`) VALUES
('APP0001', 'A0003', 'ABC1234', 'Myvi', 'Red', 'http://localhost/sunwayhoppers/uploads/applications/7d8f52fbef0e2f06325fc4e5b4b13118.zip', '1. No food\r\n2. No smoking (no vape either)\r\n3. Let\'s chit chat during the ride!\r\n', 'Approved'),
('APP0002', 'A0005', 'BAC321', 'Avanza', 'Pink', 'http://localhost/sunwayhoppers/uploads/applications/f2c516de44e11d090669acbebeb6f719.zip', 'Drinks and food are okay but make sure you do not spill any!\r\nYou can play your Spotify playlist during the ride, I like to know others\' music taste!', 'Rejected'),
('APP0003', 'A0004', 'PNG3794', 'Perodua Axia', 'Black', 'http://localhost/sunwayhoppers/uploads/applications/7c45e47f422afe241525da3cafe57da3.zip', 'Strictly no smoking and alcohol in my car. If you aren\'t the talkative type do stop me from talking. I respect introverts :D', 'Approved'),
('APP0004', 'A0006', 'MWJ123', 'Avanza', 'Gray', 'http://localhost/sunwayhoppers/uploads/applications/b961b42d82eb1d23cfdd6fd8c8016979.zip', 'I drive sometimes.', 'Approved');

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
  `pointsEarned` int(10) NOT NULL DEFAULT 0,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carpool`
--

INSERT INTO `carpool` (`carpoolID`, `accountID`, `carpoolDate`, `carpoolTime`, `passengerAmt`, `toSunway`, `district`, `neighborhood`, `location`, `details`, `isWomenOnly`, `pointsEarned`, `status`) VALUES
('C0001', 'A0003', '2023-12-16', '17:30:00', 4, 1, 'Gombak', 'Bandar Sungai Pusu', 'Sunway Pyramid', 'Going to Pyramid for dinner. Anyone wants to go there too?', 0, 0, 'Active'),
('C0002', 'A0003', '2023-12-10', '17:30:00', 4, 1, 'Kuala Langat', 'Pekan Chodoi', 'Monash University', 'Going to school on a Sunday :( Hop on along if you have event on that day too haha', 0, 100, 'Completed'),
('C0003', 'A0003', '2023-12-18', '11:00:00', 4, 0, 'Petaling', 'Mukim Damansara', 'Monash University', 'Class ending early. Can fetch a few people to Petaling ;)', 0, 0, 'Active'),
('C0004', 'A0003', '2023-11-27', '14:30:00', 3, 0, 'Petaling', 'Mukim Damansara', 'Sunway Pyramid', 'Leaving Pyramid after lunch time. Going to Petaling area. Join me if you live there too. ', 0, 50, 'Completed'),
('C0005', 'A0004', '2023-12-16', '12:00:00', 3, 1, 'Gombak', 'Bandar Gombak Setia', 'Sunway Mentari', 'Going to Fluffed for their waffles. Anyone wants to go there too? We can also eat together :3 I like to make new friends~', 1, 0, 'Active'),
('C0006', 'A0004', '2023-12-18', '08:00:00', 3, 1, 'Gombak', 'Bandar Gombak Setia', 'Sunway University', 'Heading to Sunway Uni. Hop on if you have 10am class as well', 0, 0, 'Active'),
('C0007', 'A0004', '2023-12-27', '20:00:00', 4, 0, 'Gombak', 'Bandar Gombak Setia', 'Sunway University', 'Heading back from the Discord Bot Talk event. Since it is kinda late, let me drive you girlies home. #StaySafeGirls', 1, 0, 'Active'),
('C0008', 'A0003', '2023-12-15', '15:00:00', 4, 0, 'Petaling', 'Bandar Damansara', 'Monash University', 'Heading home! Quick join my carpool.', 0, 0, 'Active'),
('C0009', 'A0004', '2023-12-14', '14:00:00', 2, 1, 'Gombak', 'Bandar Gombak Setia', 'Sunway Geo', 'Donkas Lab here i comeeeee. Anyone?', 0, 100, 'Completed'),
('C0010', 'A0004', '2023-12-13', '15:00:00', 4, 0, 'Klang', 'Mukim Klang', 'Sunway Geo', 'Going for Bak Kut Teh. Can drop a few people nearby there.', 0, 100, 'Completed'),
('C0011', 'A0004', '2023-12-18', '12:00:00', 2, 1, 'Kuala Lumpur', 'Mukim Cheras', 'Sunway Residence', 'Will buy some stuff from IKEA and move to my friend\'s house at SUR. Might be a bit cramped but if you don\'t mind come join my carpool!', 1, 0, 'Active'),
('C0012', 'A0004', '2023-12-27', '17:00:00', 4, 0, 'Gombak', 'Bandar Gombak Setia', 'Sunway University', 'Peak hour, would be stuck in jam. Join me and we can talk to kill the time while being stuck in traffic :)', 1, 0, 'Active'),
('C0013', 'A0006', '2023-12-20', '12:30:00', 3, 1, 'Kuala Lumpur', 'Pekan Kepong', 'Sunway Pinnacle', 'Hop on.', 0, 0, 'Active'),
('C0014', 'A0006', '2023-12-21', '12:30:00', 4, 1, 'Kuala Lumpur', 'Pekan Kepong', 'Sunway Pinnacle', 'Going to Pinnacle again', 0, 0, 'Active'),
('C0015', 'A0006', '2023-12-20', '19:00:00', 3, 0, 'Kuala Lumpur', 'Pekan Kepong', 'Sunway Pinnacle', 'Going home', 0, 0, 'Active');

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
  `rating` float(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carpool_passenger`
--

INSERT INTO `carpool_passenger` (`carpoolID`, `accountID`, `isApproved`, `code`, `status`, `rating`) VALUES
('C0001', 'A0004', 1, '02O10', 'Accepted', NULL),
('C0001', 'A0005', 1, 'A4H5Q', 'Accepted', NULL),
('C0001', 'A0006', 1, '99GLS', 'Accepted', NULL),
('C0002', 'A0004', 1, '2ORHJ', 'Completed', 5),
('C0002', 'A0005', 1, '9HAXE', 'Completed', 5),
('C0003', 'A0004', 0, NULL, 'Rejected', NULL),
('C0003', 'A0005', 1, '6TZXB', 'Accepted', NULL),
('C0004', 'A0004', 1, 'X38I4', 'Completed', 5),
('C0005', 'A0005', 1, '8AV9F', 'Accepted', NULL),
('C0006', 'A0003', 1, 'X68J4', 'Accepted', NULL),
('C0006', 'A0005', 1, 'H08FK', 'Accepted', NULL),
('C0006', 'A0006', 1, 'CPRP3', 'Accepted', NULL),
('C0007', 'A0005', 0, NULL, 'Pending', NULL),
('C0008', 'A0005', 1, 'V77T7', 'Accepted', NULL),
('C0008', 'A0006', 1, '6ME0D', 'Accepted', NULL),
('C0009', 'A0003', 1, '13K3N', 'Completed', 5),
('C0009', 'A0006', 1, 'SXR5S', 'Completed', 5),
('C0010', 'A0003', 1, '9QLRH', 'Completed', 5),
('C0010', 'A0006', 1, 'X1C6O', 'Completed', 5),
('C0011', 'A0005', 0, NULL, 'Rejected', NULL),
('C0013', 'A0003', 1, '56OE0', 'Accepted', NULL),
('C0013', 'A0004', 1, 'C5KUL', 'Accepted', NULL),
('C0014', 'A0003', 1, '48JQM', 'Accepted', NULL),
('C0015', 'A0005', 1, '5R7OU', 'Accepted', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `district_neighborhood`
--

CREATE TABLE `district_neighborhood` (
  `district_name` varchar(255) NOT NULL,
  `neighborhood_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notificationID` int(10) NOT NULL,
  `senderID` varchar(255) NOT NULL,
  `recipientID` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `dateTime` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `seen` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notificationID`, `senderID`, `recipientID`, `type`, `title`, `message`, `dateTime`, `seen`) VALUES
(8, 'A0004', 'A0003', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from Celine', '2023-12-15 01:29:54.000000', 1),
(9, 'A0004', 'A0003', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from Celine', '2023-12-15 01:30:02.000000', 1),
(10, 'A0004', 'A0003', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from Celine', '2023-12-15 01:30:09.000000', 1),
(11, 'A0004', 'A0003', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from Celine', '2023-12-15 01:30:16.000000', 1),
(12, 'A0005', 'A0004', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from Jolene', '2023-12-15 01:36:20.000000', 1),
(13, 'A0005', 'A0003', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from Jolene', '2023-12-15 01:36:30.000000', 1),
(14, 'A0005', 'A0003', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from Jolene', '2023-12-15 01:36:42.000000', 1),
(15, 'A0003', 'A0004', 'manageRequest', 'Carpool Request Accepted', 'John has accepted your carpool request', '2023-12-15 01:37:37.000000', 1),
(16, 'A0003', 'A0004', 'manageRequest', 'Carpool Request Rejected', 'John has rejected your carpool request', '2023-12-15 01:37:42.000000', 1),
(17, 'A0003', 'A0004', 'manageRequest', 'Carpool Request Accepted', 'John has accepted your carpool request', '2023-12-15 01:37:46.000000', 1),
(18, 'A0003', 'A0005', 'manageRequest', 'Carpool Request Accepted', 'John has accepted your carpool request', '2023-12-15 01:37:48.000000', 1),
(19, 'A0003', 'A0004', 'manageRequest', 'Carpool Request Accepted', 'John has accepted your carpool request', '2023-12-15 01:37:52.000000', 1),
(20, 'A0003', 'A0005', 'manageRequest', 'Carpool Request Accepted', 'John has accepted your carpool request', '2023-12-15 01:37:53.000000', 1),
(21, 'A0003', 'A0004', 'redeemCode', 'Code Redeemed', 'John has redeemed your carpool code. You\'ve received 20 points.', '2023-12-15 01:38:55.000000', 1),
(22, 'A0003', 'A0004', 'redeemCode', 'Code Redeemed', 'John has redeemed your carpool code. You\'ve received 20 points.', '2023-12-15 01:39:54.000000', 1),
(23, 'A0003', 'A0005', 'redeemCode', 'Code Redeemed', 'John has redeemed your carpool code. You\'ve received 20 points.', '2023-12-15 01:40:11.000000', 1),
(24, 'A0004', 'A0003', 'submitRating', 'New Rating', 'Celine has rated you 5 stars.', '2023-12-15 01:42:46.000000', 1),
(25, 'A0004', 'A0003', 'submitRating', 'New Rating', 'Celine has rated you 5 stars.', '2023-12-15 01:42:52.000000', 1),
(26, 'A0004', 'A0005', 'manageRequest', 'Carpool Request Accepted', 'Celine has accepted your carpool request', '2023-12-15 01:43:31.000000', 1),
(27, 'A0005', 'A0003', 'submitRating', 'New Rating', 'Jolene has rated you 5 stars.', '2023-12-15 01:50:38.000000', 1),
(28, 'A0005', 'A0004', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from Jolene', '2023-12-15 01:51:00.000000', 1),
(29, 'A0005', 'A0004', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from Jolene', '2023-12-15 01:51:12.000000', 1),
(30, 'A0005', 'A0003', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from Jolene', '2023-12-15 01:51:24.000000', 1),
(31, 'A0005', 'A0003', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from Jolene', '2023-12-15 01:51:34.000000', 1),
(32, 'A0003', 'A0005', 'manageRequest', 'Carpool Request Accepted', 'John has accepted your carpool request', '2023-12-15 01:53:12.000000', 1),
(33, 'A0003', 'A0005', 'manageRequest', 'Carpool Request Accepted', 'John has accepted your carpool request', '2023-12-15 01:53:15.000000', 1),
(34, 'A0003', 'A0004', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from John', '2023-12-15 01:53:24.000000', 1),
(35, 'A0003', 'A0004', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from John', '2023-12-15 01:53:36.000000', 1),
(36, 'A0003', 'A0004', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from John', '2023-12-15 01:53:43.000000', 1),
(37, 'A0006', 'A0003', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from Mak', '2023-12-15 01:56:32.000000', 1),
(38, 'A0006', 'A0003', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from Mak', '2023-12-15 01:56:52.000000', 1),
(39, 'A0006', 'A0004', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from Mak', '2023-12-15 01:56:59.000000', 1),
(40, 'A0006', 'A0004', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from Mak', '2023-12-15 01:57:09.000000', 1),
(41, 'A0006', 'A0004', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from Mak', '2023-12-15 01:57:20.000000', 1),
(42, 'A0004', 'A0003', 'manageRequest', 'Carpool Request Accepted', 'Celine has accepted your carpool request', '2023-12-15 01:57:50.000000', 1),
(43, 'A0004', 'A0006', 'manageRequest', 'Carpool Request Accepted', 'Celine has accepted your carpool request', '2023-12-15 01:57:52.000000', 1),
(44, 'A0004', 'A0003', 'manageRequest', 'Carpool Request Accepted', 'Celine has accepted your carpool request', '2023-12-15 01:57:55.000000', 1),
(45, 'A0004', 'A0006', 'manageRequest', 'Carpool Request Accepted', 'Celine has accepted your carpool request', '2023-12-15 01:57:56.000000', 1),
(46, 'A0004', 'A0005', 'manageRequest', 'Carpool Request Accepted', 'Celine has accepted your carpool request', '2023-12-15 01:58:00.000000', 1),
(47, 'A0004', 'A0006', 'manageRequest', 'Carpool Request Accepted', 'Celine has accepted your carpool request', '2023-12-15 01:58:02.000000', 1),
(48, 'A0004', 'A0005', 'manageRequest', 'Carpool Request Rejected', 'Celine has rejected your carpool request', '2023-12-15 01:58:06.000000', 1),
(49, 'A0003', 'A0006', 'manageRequest', 'Carpool Request Accepted', 'John has accepted your carpool request', '2023-12-15 01:59:06.000000', 1),
(50, 'A0003', 'A0006', 'manageRequest', 'Carpool Request Accepted', 'John has accepted your carpool request', '2023-12-15 01:59:11.000000', 1),
(51, 'A0004', 'A0003', 'manageRequest', 'Carpool Request Accepted', 'Celine has accepted your carpool request', '2023-12-15 02:00:29.000000', 1),
(52, 'A0004', 'A0003', 'redeemCode', 'Code Redeemed', 'Celine has redeemed your carpool code. You\'ve received 20 points.', '2023-12-15 02:01:12.000000', 1),
(53, 'A0004', 'A0003', 'redeemCode', 'Code Redeemed', 'Celine has redeemed your carpool code. You\'ve received 20 points.', '2023-12-15 02:01:30.000000', 1),
(54, 'A0004', 'A0006', 'redeemCode', 'Code Redeemed', 'Celine has redeemed your carpool code. You\'ve received 20 points.', '2023-12-15 02:02:35.000000', 1),
(55, 'A0004', 'A0006', 'redeemCode', 'Code Redeemed', 'Celine has redeemed your carpool code. You\'ve received 20 points.', '2023-12-15 02:02:45.000000', 1),
(56, 'A0006', 'A0004', 'submitRating', 'New Rating', 'Mak has rated you 5 stars.', '2023-12-15 02:06:02.000000', 1),
(57, 'A0006', 'A0004', 'submitRating', 'New Rating', 'Mak has rated you 5 stars.', '2023-12-15 02:06:18.000000', 1),
(58, 'A0003', 'A0004', 'submitRating', 'New Rating', 'John has rated you 5 stars.', '2023-12-15 02:11:45.000000', 1),
(59, 'A0003', 'A0006', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from John', '2023-12-15 02:11:57.000000', 1),
(60, 'A0003', 'A0004', 'submitRating', 'New Rating', 'John has rated you 5 stars.', '2023-12-15 02:12:08.000000', 1),
(61, 'A0003', 'A0006', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from John', '2023-12-15 02:12:20.000000', 1),
(62, 'A0004', 'A0006', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from Celine', '2023-12-15 02:15:49.000000', 1),
(63, 'A0005', 'A0006', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from Jolene', '2023-12-15 02:16:54.000000', 1),
(64, 'A0005', 'A0004', 'joinCarpool', 'New Carpool Request', 'You have a new carpool request from Jolene', '2023-12-15 02:17:06.000000', 0),
(65, 'A0006', 'A0003', 'manageRequest', 'Carpool Request Accepted', 'Mak has accepted your carpool request', '2023-12-15 02:17:56.000000', 0),
(66, 'A0006', 'A0003', 'manageRequest', 'Carpool Request Accepted', 'Mak has accepted your carpool request', '2023-12-15 02:18:01.000000', 0),
(67, 'A0006', 'A0004', 'manageRequest', 'Carpool Request Accepted', 'Mak has accepted your carpool request', '2023-12-15 02:18:02.000000', 0),
(68, 'A0006', 'A0005', 'manageRequest', 'Carpool Request Accepted', 'Mak has accepted your carpool request', '2023-12-15 02:18:06.000000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `redemption`
--

CREATE TABLE `redemption` (
  `redemptionID` varchar(255) NOT NULL,
  `accountID` varchar(255) NOT NULL,
  `rewardID` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `redemptionDate` date NOT NULL,
  `expiryDate` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `redemption`
--

INSERT INTO `redemption` (`redemptionID`, `accountID`, `rewardID`, `code`, `redemptionDate`, `expiryDate`, `status`) VALUES
('RD0001', 'A0003', 'R0001', '03I1118F', '2023-12-14', '2024-12-14', 'Active'),
('RD0002', 'A0004', 'R0006', '6ADKU1E1', '2023-12-14', '2024-12-14', 'Active');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reward`
--

INSERT INTO `reward` (`rewardID`, `rewardName`, `description`, `img`, `points`, `type`, `quantity`) VALUES
('R0001', 'Tealive', 'Kill the summer heat by enjoying a nice, cold beverage. Get RM10 off your favourite Tealive! ', './uploads/rewards/7d76bce2c89dd130435e2463abdcfeba.png', 1000, 'Food & Beverage', '20'),
('R0002', 'GrabFood', 'Satisfy every craving and order your meal at GrabFood. Receive RM10 off your bill with no minimum spend required.', './uploads/rewards/19f1ea4c53a1875d0c0050248e14fbaf.png', 1000, 'Food & Beverage', '30'),
('R0003', 'foodpanda', 'Get RM50 off food delivered to your doorstep by foodpanda. No minimum spend required.', './uploads/rewards/9e4ab4dc960788f6811dd034fad5d526.png', 5000, 'Food & Beverage', '34'),
('R0004', 'KFC', 'Enjoy finger lickin good chicken with KFC today and get RM5 off your bill.', './uploads/rewards/c90e84ffec251addb90deddfcbed6039.png', 500, 'Food & Beverage', '38'),
('R0005', 'llaollao', 'Dive into the delectable world of llao llao! Grab any medium tub for just RM11 with our exclusive voucher. Treat yourself to swirls of frozen yogurt perfection! ', './uploads/rewards/24036c192fc28322b3fd424e1f207aba.png', 600, 'Food & Beverage', '42'),
('R0006', 'Petronas', '\r\nFuel your journey with Petronas! Enjoy savings with our RM50 voucher on fuel purchases. Drive further, pay less. Grab your voucher and hit the road today! ', './uploads/rewards/54b7b46b223dc269a8f17cf6b24f64b3.png', 5000, 'Petrol', '23'),
('R0007', 'Caltex', 'Rev up your savings! Unlock a RM20 voucher for Caltex fuel. Terms and conditions apply. Fuel up and hit the road with extra savings today! â›½ðŸ’³ðŸš—', './uploads/rewards/ec084b9991735753c40cb5c45fefb00e.png', 2000, 'Petrol', '34'),
('R0008', 'Petron', 'Power up your ride and more with a Petron RM50 voucher! Use it for fuel or snag cool merchandise. Versatility at its best. T&Cs apply. â›½ðŸ›ï¸ðŸ’³', './uploads/rewards/eebf563503a7d8e47e2c38439b51c518.png', 5000, 'Petrol', '46'),
('R0009', 'Sunway Originals', 'Unlock creativity at Sunway Originals! Enjoy RM5 off at our campus store. Explore stationery, Sunway merch, and unique gifts. Let your campus style shine! ðŸ“šðŸ‘•ðŸŽ', './uploads/rewards/76bce98b005310d9c515741624d0dbae.png', 500, 'Sunway Originals', '34'),
('R0010', 'Sunway Originals', 'Unlock creativity at Sunway Originals! Enjoy RM10 off at our campus store. Explore stationery, Sunway merch, and unique gifts. Let your campus style shine! ðŸ“šðŸ‘•ðŸŽ', './uploads/rewards/6d833a6caac10ff156c5d4963a9345a9.png', 1000, 'Sunway Originals', '55'),
('R0011', 'Sunway Originals', 'Unlock creativity at Sunway Originals! Enjoy RM20 off at our campus store. Explore stationery, Sunway merch, and unique gifts. Let your campus style shine! ðŸ“šðŸ‘•ðŸŽ', './uploads/rewards/ebcea574d66439118509a4b795f02030.png', 2000, 'Sunway Originals', '34'),
('R0012', 'Sunway Originals', 'Unlock creativity at Sunway Originals! Enjoy RM50 off at our campus store. Explore stationery, Sunway merch, and unique gifts. Let your campus style shine! ðŸ“šðŸ‘•ðŸŽ', './uploads/rewards/0e2febc87ab321e60e611c08191665f5.png', 5000, 'Sunway Originals', '10');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `accountID` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phoneNo` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `rewardPoints` int(11) NOT NULL DEFAULT 0,
  `rating` float(3,2) NOT NULL DEFAULT 0,
  `ratingsAmt` int(4) NOT NULL DEFAULT 0,
  `carRules` varchar(255) DEFAULT NULL,
  `profilePic` varchar(255) DEFAULT './images/person.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`accountID`, `name`, `phoneNo`, `gender`, `dob`, `bio`, `rewardPoints`, `rating`, `ratingsAmt`, `carRules`, `profilePic`) VALUES
('A0003', 'John', '01124823082', 'Male', '2002-07-01', 'Body-building maniac. Loves to drive. We can talk about driving or body-building! ', 3190, 5.0, 3, '1. No food\r\n2. No smoking (no vape either)\r\n3. Let\'s chit chat during the ride!\r\n', './uploads/profile_pics/4f82eaaf378db67d303635377c1c2c78.jpg'),
('A0004', 'Celine', '0175590372', 'Female', '2002-08-24', 'Currently studying Mass Com in Sunway. Let\'s talk about your favourite singer and food during the ride! ', 2640, 5.0, 4, 'Strictly no smoking and alcohol in my car. If you aren\'t the talkative type do stop me from talking. I respect introverts :D', './uploads/profile_pics/4f132a1637b2129d2880262e0801a1fa.jpg'),
('A0005', 'Jolene', '0178273913', 'Female', '2001-04-26', 'I love anime and could talk about it for hours! Currently studying A-Levels in Sunway :3', 220, 0, 0, NULL, './uploads/profile_pics/5044ecfdd2fac39d2c7a4615db12a630.jpeg'),
('A0006', 'Mak', '0129938493', 'Male', '2003-11-22', 'I don\'t like driving so i carpool with others.', 40, 0, 0, 'I drive sometimes.', './uploads/profile_pics/4e51f057248080a1443cf31d71cc049d.jpg');

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
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notificationID`),
  ADD KEY `senderID` (`senderID`),
  ADD KEY `recipientID` (`recipientID`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notificationID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

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
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`senderID`) REFERENCES `account` (`accountID`),
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`recipientID`) REFERENCES `account` (`accountID`);

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
