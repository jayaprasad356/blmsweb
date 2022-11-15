-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2022 at 12:04 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` text DEFAULT NULL,
  `password` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(250) NOT NULL,
  `branch_name` varchar(100) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `bankphonenumber` varchar(30) NOT NULL,
  `ifsc` varchar(20) NOT NULL,
  `dsacode` varchar(30) NOT NULL,
  `image` text NOT NULL,
  `address` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `products` varchar(100) NOT NULL,
  `type` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `data_imported_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `bank_name`, `branch_name`, `city`, `bankphonenumber`, `ifsc`, `dsacode`, `image`, `address`, `email`, `products`, `type`, `status`, `data_imported_on`) VALUES
(6, 'HDFC Bank', NULL, '', '', '', '', '', '', '', '', 1, 1, '2022-11-05 05:11:33'),
(9, 'Yes bank', NULL, '', '', '', '', '', '', '', '', 1, 1, '2022-11-04 05:11:33'),
(11, 'Kotak Bank', NULL, '', '', '', '', '', '', '', '', 1, 1, '2022-11-04 05:11:33'),
(12, 'Bandhan Bank Ltd.', NULL, '', '', '', '', '', '', '', '', 1, 1, '2022-11-04 05:11:33'),
(19, 'HDFC Bank Ltd', NULL, '', '', '', '', '', '', '', '', 1, 1, '2022-11-04 05:11:33'),
(20, 'ICICI Bank Ltd.', NULL, '', '', '', '', '', '', '', '', 1, 1, '2022-11-04 05:11:33'),
(21, 'IndusInd Bank Ltd', NULL, '', '', '', '', '', '', '', '', 1, 1, '2022-11-04 05:11:33'),
(22, 'IDFC FIRST Bank Limited', NULL, '', '', '', '', '', '', '', '', 1, 1, '2022-11-04 05:11:33'),
(50, 'ADITYA BIRLA', NULL, '', '', '', '', '', '', '', '', 1, 1, '2022-11-04 05:11:33'),
(52, 'SCB', NULL, '', '', '', '', '', '', '', '', 1, 1, '2022-11-04 05:11:33'),
(53, 'TATA CAPITAL', NULL, '', '', '', '', '', '', '', '', 1, 1, '2022-11-04 05:11:33'),
(54, 'AXIS BANK', NULL, '', '', '', '', '', '', '', '', 1, 1, '2022-11-04 05:11:33'),
(56, 'AXIS FINANCE', NULL, '', '', '', '', '', '', '', '', 1, 1, '2022-11-04 05:11:33'),
(57, 'poonawala', NULL, '', '', '', '', '', '', '', '', 1, 1, '2022-11-04 05:11:33'),
(60, 'Bandhan bank', NULL, '', '', '', '', '', '', '', '', 1, 1, '2022-11-04 05:11:33'),
(61, 'SCB CC', NULL, '', '', '', '', '', '', '', '', 1, 1, '2022-11-04 05:11:33'),
(62, 'testing', NULL, '', '', '', '', '', '', '', '', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `description`) VALUES
(1, 'Welcome', 'Hello Blms users we are heartly welcomes you');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email` text DEFAULT NULL,
  `mobile` text DEFAULT NULL,
  `gender` text DEFAULT NULL,
  `bank` text DEFAULT NULL,
  `bank_id` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `fcm_id` text DEFAULT NULL,
  `last_updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `dob`, `email`, `mobile`, `gender`, `bank`, `bank_id`, `address`, `image`, `fcm_id`, `last_updated_on`) VALUES
(1, 'praaad', '2022-11-06', 'prasad@gmail.com', '8778624681', 'Male', '', '60', 'chennai', NULL, 'er_1G6__Taik04x5EVstCI:APA91bFD_v1HOM8Qm0aCMfioKbnqeh1lch8xeZ0SF85j2xuGG_NnTPKsgkC50kZPd__XdUZNc3oTs7cdVAT4NMnc7teSHhJ11GgeFS5ZZ-0f8sz3TJUu9domyV2AS0hwqUB8F5rpKPcP', '2022-11-12 04:29:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
