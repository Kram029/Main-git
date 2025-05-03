-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2025 at 07:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mysql`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_users_registration`
--

CREATE TABLE `table_users_registration` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `suffix` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `barangay_id` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_users_registration`
--

INSERT INTO `table_users_registration` (`id`, `first_name`, `middle_name`, `last_name`, `suffix`, `email`, `contact`, `street`, `region_id`, `province_id`, `city_id`, `barangay_id`, `username`, `password`, `created_at`) VALUES
(1, 'wewewe', 'we', 'wewewewe', 'we', 'mojpokqwe@gmail.com', '09999999999', '', 17, 74, 1491, 39551, 'WewewewW', '$2y$10$yClo10TApGwoNgz9.OV94uzlt6ZvuG.0.qYoUMjBDXKIra1wVPg2q', '2025-05-03 17:09:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_users_registration`
--
ALTER TABLE `table_users_registration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_users_registration`
--
ALTER TABLE `table_users_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
