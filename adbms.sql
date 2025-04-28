-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2025 at 08:57 AM
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
-- Database: `adbms`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `barangay` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `suffix`, `email`, `contact`, `street`, `region`, `province`, `city`, `barangay`, `username`, `password`, `created_at`) VALUES
(1, '', '', '', '', '', '', '', '', '', '', '', '', '$2y$10$sm6GhPGSimpI7Z4eVz2mpOzpMIkg/z8TBNgHq6otcf2V1czlVvjZe', '2025-04-18 08:27:22'),
(12, 'mj', 'dsds', 'fdgfdgd', 'sddsd', 'mj@gmail.com', '09746573458', 'lipa', 'Region', 'Province', 'City', 'Barangay', 'mjsaniel', '$2y$10$tUGYjZVeCYEL7hgEgUyRceb6XjhLPI670Lp4QaCErTKGQDYg3u8oO', '2025-04-18 08:42:58'),
(14, 'MarkJoseph', 'Puso', 'Saniel', 'P', 'mjsaniel32@gmail.com', '09999999999', 'lipa', 'Region', 'Province', 'City', 'Barangay', 'Kram_29', '$2y$10$YwgeaF01h9GfeDwwfblqTOEgMwSi9WuwDahVfR7Ed0XfswHUbejh2', '2025-04-23 11:43:43'),
(17, 'MarkJoseph', 'Puso', 'Saniel', 'P', 'mj01@gmail.com', '09999999999', 'lipa', 'Region', 'Province', 'City', 'Barangay', 'loading_29', '$2y$10$2EEmvozcC4873NwQUdrtyuTNOVvU7LQimN/NJTwFozLUkcaXGJL8e', '2025-04-23 11:49:22'),
(18, 'John', 'dsds', 'Doe', '', 'mj02@gmail.com', '09999999999', '', 'Region', 'Province', 'City', 'Barangay', 'Kram_99', NULL, '2025-04-24 07:46:34'),
(20, 'Fatima', 'Ramirez', 'Arnigo', 'dqfeq', 'arnigofatimabian@gmail.com', '09935048514', 'Purok', 'Region', 'Province', 'City', 'Barangay', 'fatimabian', 'Fatima#26', '2025-04-24 09:48:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
