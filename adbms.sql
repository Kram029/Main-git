-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2025 at 07:02 AM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddSchedule` (IN `p_barangay` VARCHAR(100), IN `p_date` DATE, IN `p_time` TIME, IN `p_status` VARCHAR(50))   BEGIN
    INSERT INTO schedules (barangay, date, time, status)
    VALUES (p_barangay, p_date, p_time, p_status);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteSchedule` (IN `p_id` INT)   BEGIN
    DELETE FROM schedules WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_user` (IN `user_id` INT)   BEGIN
    DELETE FROM users WHERE id = user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertSchedule` (IN `p_barangay` VARCHAR(100), IN `p_date` DATE, IN `p_time` TIME, IN `p_status` VARCHAR(20))   BEGIN
    INSERT INTO schedules (barangay, date, time, status)
    VALUES (p_barangay, p_date, p_time, p_status);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateSchedule` (IN `p_id` INT, IN `p_barangay` VARCHAR(255), IN `p_date` DATE, IN `p_time` TIME, IN `p_status` VARCHAR(50))   BEGIN
    UPDATE schedules
    SET barangay = p_barangay,
        date = p_date,
        time = p_time,
        status = p_status
    WHERE id = p_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `file` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) UNSIGNED NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `date` varchar(25) NOT NULL,
  `time` varchar(25) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `barangay`, `date`, `time`, `status`) VALUES
(1, 'antips', '2025-05-04', '16:00:00', 'Scheduled'),
(4, 'pkawit', '2025-05-21', '13:21', 'Scheduled'),
(5, 'anitpolo', '2025-05-14', '14:30:00', 'Pending');

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
(12, 'mj', 'dsds', 'fdgfdgd', 'sddsd', 'mj@gmail.com', '09746573458', 'lipa', 'Region', 'Province', 'City', 'Barangay', 'mjsaniel', '$2y$10$tUGYjZVeCYEL7hgEgUyRceb6XjhLPI670Lp4QaCErTKGQDYg3u8oO', '2025-04-18 08:42:58'),
(14, 'MarkJoseph', 'Puso', 'Saniel', 'P', 'mjsaniel32@gmail.com', '09999999999', 'lipa', 'Region', 'Province', 'City', 'Barangay', 'Kram_29', '$2y$10$YwgeaF01h9GfeDwwfblqTOEgMwSi9WuwDahVfR7Ed0XfswHUbejh2', '2025-04-23 11:43:43'),
(17, 'MarkJoseph', 'Puso', 'Saniel', 'P', 'mj01@gmail.com', '09999999999', 'lipa', 'Region', 'Province', 'City', 'Barangay', 'loading_29', '$2y$10$2EEmvozcC4873NwQUdrtyuTNOVvU7LQimN/NJTwFozLUkcaXGJL8e', '2025-04-23 11:49:22'),
(18, 'John', 'dsds', 'Doe', '', 'mj02@gmail.com', '09999999999', '', 'Region', 'Province', 'City', 'Barangay', 'Kram_99', '$2y$10$ZC9DGy0pMiZuTfkAM7Pc3eBtIliWDOqeYnmoaGAcZ2Z2DEooO35nG', '2025-04-24 07:46:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
