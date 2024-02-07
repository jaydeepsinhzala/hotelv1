-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2024 at 03:28 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(6) UNSIGNED NOT NULL,
  `cus_name` varchar(50) DEFAULT NULL,
  `cus_phone` bigint(20) DEFAULT NULL,
  `h_name` varchar(50) DEFAULT NULL,
  `h_location` varchar(50) DEFAULT NULL,
  `h_price` bigint(20) DEFAULT NULL,
  `no_of_rooms` int(11) DEFAULT NULL,
  `checkin_date` date DEFAULT NULL,
  `checkout_date` date DEFAULT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(6) UNSIGNED NOT NULL,
  `cus_name` varchar(50) DEFAULT NULL,
  `cus_phone` bigint(20) DEFAULT NULL,
  `cus_password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `cus_name`, `cus_phone`, `cus_password`) VALUES
(1, 'Nikita Sambari', 8777788878, 'Nikki@731');

-- --------------------------------------------------------

--
-- Table structure for table `hotels_list`
--

CREATE TABLE `hotels_list` (
  `id` int(6) UNSIGNED NOT NULL,
  `h_name` varchar(50) DEFAULT NULL,
  `h_location` varchar(50) DEFAULT NULL,
  `h_price` bigint(20) DEFAULT NULL,
  `h_description` varchar(255) DEFAULT NULL,
  `h_image` longblob DEFAULT NULL,
  `h_ratings` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels_list`
--

INSERT INTO `hotels_list` (`id`, `h_name`, `h_location`, `h_price`, `h_description`, `h_image`, `h_ratings`) VALUES
INSERT INTO `hotels_list` (`id`, `h_name`, `h_location`, `h_price`, `h_description`, `h_image`, `h_ratings`) VALUES
INSERT INTO `hotels_list` (`id`, `h_name`, `h_location`, `h_price`, `h_description`, `h_image`, `h_ratings`) VALUES

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cus_phone` (`cus_phone`);

--
-- Indexes for table `hotels_list`
--
ALTER TABLE `hotels_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hotels_list`
--
ALTER TABLE `hotels_list`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;