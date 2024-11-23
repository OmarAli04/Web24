-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2023 at 09:42 PM
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
-- Database: `exotic-rentals`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `pickup` date NOT NULL,
  `dropoff` date NOT NULL,
  `car` varchar(255) NOT NULL,
  `customername` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `pickup`, `dropoff`, `car`, `customername`, `phone`, `username`) VALUES
(1035, '2023-04-26', '2023-04-30', 'Lamborghini Huracán EVO Spyder', 'mohamed saleh', '0111256598', 'mohamed'),
(1036, '2023-04-26', '2023-04-30', 'Lamborghini Huracán EVO Spyder', 'mohamed saleh', '011112565658', 'mohamed'),
(1037, '2023-04-26', '2023-04-30', 'Rolls-Royce Ghost', 'omar ali', '011119811553', 'omar'),
(1038, '2023-04-26', '2023-04-30', 'Cadillac Escalade Sport Platinum', 'Omar', '+201111981553', 'omar'),
(1039, '2023-04-26', '2023-04-30', 'Lamborghini Urus', 'youssef ossama', '0124548485', 'youssef'),
(1040, '2023-04-26', '2023-04-30', 'Rolls-Royce Ghost Series II', 'youssef ossama', '124548485', 'youssef'),
(1041, '4334-05-31', '2023-11-24', 'Ferrari Roma', 'karim haitham mourad', '0183123012892', 'omar');

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) NOT NULL,
  `customername` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usermessage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `customername`, `email`, `usermessage`) VALUES
(1, 'asdasda', 'omar@gmail.com', 'asda'),
(2, 'asdasda', 'omar@gmail.com', 'asda'),
(3, 'asdasda', 'omar@gmail.com', 'asda'),
(4, 'omar', 'omarfins@outlook.com', 'problem testin, 123'),
(5, 'Omar Ali', 'omarali112k4@gmail.com', 'Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing,Testing'),
(6, 'omar', 'omarfins@outlook.com', 'mohamed not ga'),
(7, 'test', 'asda@gmail.com', 'asdadasdadas'),
(8, 'test', 'asda@gmail.com', 'asdadasdadas'),
(9, 'test2222222', 'asda@gmail.com', 'omar /'),
(10, 'testing 202020', 'omar@gmail.com22', 'sanitized 2 2 2'),
(11, 'testing 202020', 'omar@gmail.com22', 'sanitized 2 2 2'),
(12, 'test2222222', 'adsada@gmail.com', 'asdads');

-- --------------------------------------------------------

--
-- Table structure for table `cred`
--

CREATE TABLE `cred` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pswd` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mfa_pin` int(255) NOT NULL,
  `rol` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cred`
--

INSERT INTO `cred` (`id`, `username`, `pswd`, `email`, `mfa_pin`, `rol`) VALUES
(60, 'admin', '2023webcw', '', 99999999, 'admin'),
(61, 'omar', 'Omar123123', 'omar@gmail.com', 5922562, 'user'),
(65, 'employee', 'Member123', 'emp@rentals.com', 56590486, 'employee'),
(66, 'test', '1212OOoamsr', 'omar@otm.com', 24644902, 'user'),
(67, 'test1123', 'omarOO238478', 'omar@otm.com22', 76252388, 'user'),
(68, 'omar2020', 'Omar2020202020', 'omar@gmail.com3', 69938413, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cred`
--
ALTER TABLE `cred`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1042;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cred`
--
ALTER TABLE `cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
