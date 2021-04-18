-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2021 at 01:49 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `metizsoft`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(20) NOT NULL,
  `country_id` int(20) NOT NULL,
  `state_id` int(20) NOT NULL,
  `city_name` varchar(20) NOT NULL,
  `created_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `country_id`, `state_id`, `city_name`, `created_date`) VALUES
(1, 1, 1, 'Ahmedabad', '2021-04-16 11:44:09'),
(2, 1, 1, 'Surat', '2021-04-16 11:44:09'),
(3, 1, 2, 'Mumbai', '2021-04-16 11:44:09'),
(4, 1, 2, 'Pune', '2021-04-16 11:44:09'),
(5, 2, 3, 'Los Angeles', '2021-04-16 11:44:09'),
(6, 2, 3, 'San Francisco', '2021-04-16 11:44:09'),
(7, 2, 4, 'Houston', '2021-04-16 11:44:09'),
(8, 2, 4, 'Austin', '2021-04-16 11:44:09');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(10) NOT NULL,
  `country_name` varchar(20) NOT NULL,
  `created_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`, `created_date`) VALUES
(1, 'India', '2021-04-16 11:44:09'),
(2, 'USA', '2021-04-16 11:44:09');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(20) NOT NULL,
  `country_id` int(20) NOT NULL,
  `state_name` varchar(20) NOT NULL,
  `created_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `country_id`, `state_name`, `created_date`) VALUES
(1, 1, 'Gujarat', '2021-04-16 11:44:09'),
(2, 1, 'Maharashtra', '2021-04-16 11:44:09'),
(3, 2, 'California', '2021-04-16 11:44:09'),
(4, 2, 'Texas', '2021-04-16 11:44:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `country` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `gender` enum('male','female','other','') NOT NULL,
  `hobbies` varchar(100) NOT NULL,
  `user_image` varchar(100) NOT NULL,
  `created_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `mobile`, `email`, `password`, `address`, `country`, `state`, `city`, `zipcode`, `gender`, `hobbies`, `user_image`, `created_date`) VALUES
(2, 'poojan mehta', 'pm', '1234567894', 'poojan@gmail.com', '82404d6c94d57f94165f92f5f689cfc7', '																																																												USA																																																			', 2, 3, 5, 25025, 'male', 'Coding,Playing', '873772.png', '2021-04-17 06:47:06'),
(13, 'piyush', 'patel', '9785457858', 'piyush@gmail.com', '86f500cd7b7d38e5d4ae6cde3920f589', '																																			Talala					\r\n																																', 1, 1, 1, 385001, 'male', 'Coding,Playing,Reading', '936018.png', '2021-04-18 12:30:17'),
(14, 'dhaval', 'patel', '7984578585', 'dhaval@gmail.com', '975ef70ce2dd7ae8dd7de7c930d90d0d', 'Ahmedabad					\r\n				', 1, 1, 1, 385001, 'male', 'Coding', '4097813.jpg', '2021-04-18 12:45:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
