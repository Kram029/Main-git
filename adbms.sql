-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2025 at 06:04 AM
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `CheckUserByEmail` (IN `p_email` VARCHAR(100))   BEGIN
    -- Validate input parameters
    IF p_email IS NULL OR p_email = '' THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Email cannot be empty';
    END IF;

    -- Check if user exists and return relevant information
    SELECT 
        id, 
        email, 
        username 
    FROM 
        table_users_registration 
    WHERE 
        email = p_email 
    LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CheckUserExistsByEmail` (IN `p_email` VARCHAR(100))   BEGIN
    -- Validate input parameters
    IF p_email IS NULL OR p_email = '' THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Email cannot be empty';
    END IF;

    -- Check if user exists and return user details
    SELECT 
        id, 
        email, 
        username 
    FROM 
        table_users_registration 
    WHERE 
        email = p_email 
    LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteSchedule` (IN `p_id` INT)   BEGIN
    DELETE FROM schedules WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_user` (IN `user_id` INT)   BEGIN
    DELETE FROM users WHERE id = user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertContact` (IN `p_name` VARCHAR(100), IN `p_email` VARCHAR(100), IN `p_message` TEXT)   BEGIN
    -- Validate input parameters
    IF p_name IS NULL OR p_name = '' THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Name cannot be empty';
    END IF;

    IF p_email IS NULL OR p_email = '' THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Email cannot be empty';
    END IF;

    IF p_message IS NULL OR p_message = '' THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Message cannot be empty';
    END IF;

    -- Insert the contact
    INSERT INTO contacts (name, email, message) 
    VALUES (p_name, p_email, p_message);

    -- Optionally, return the ID of the newly inserted contact
    SELECT LAST_INSERT_ID() AS contact_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertSchedule` (IN `p_barangay` VARCHAR(100), IN `p_date` DATE, IN `p_time` TIME, IN `p_status` VARCHAR(20))   BEGIN
    INSERT INTO schedules (barangay, date, time, status)
    VALUES (p_barangay, p_date, p_time, p_status);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_barangays` (IN `in_city_id` INT)   BEGIN
    SELECT barangay_id, barangay_name FROM table_barangay 
    WHERE municipality_id = in_city_id 
    ORDER BY barangay_name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_municipalities` ()   BEGIN
    SELECT municipality_id, municipality_name FROM table_municipality ORDER BY municipality_name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdatePasswordResetToken` (IN `p_email` VARCHAR(100), IN `p_reset_token` VARCHAR(255), IN `p_reset_expires` DATETIME)   BEGIN
    -- Validate input parameters
    IF p_email IS NULL OR p_email = '' THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Email cannot be empty';
    END IF;

    -- Update user's password reset token and expiration
    UPDATE table_users_registration
    SET 
        reset_token = p_reset_token,
        reset_token_expiry = p_reset_expires
    WHERE 
        email = p_email;

    -- Return a simple success indicator
    SELECT 1 AS success;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateSchedule` (IN `p_id` INT, IN `p_barangay` VARCHAR(255), IN `p_date` DATE, IN `p_time` TIME, IN `p_status` VARCHAR(50))   BEGIN
    UPDATE schedules
    SET barangay = p_barangay,
        date = p_date,
        time = p_time,
        status = p_status
    WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateUserPassword` (IN `p_email` VARCHAR(100), IN `p_new_password` VARCHAR(255))   BEGIN
    -- Validate input parameters
    IF p_email IS NULL OR p_email = '' THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Email cannot be empty';
    END IF;

    IF p_new_password IS NULL OR p_new_password = '' THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Password cannot be empty';
    END IF;

    -- Update user's password and clear reset token
    UPDATE table_users_registration
    SET password = p_new_password,
        reset_token = NULL,
        reset_token_expiry = NULL
    WHERE 
        email = p_email;

    -- Return the number of affected rows
    SELECT ROW_COUNT() AS affected_rows;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `VerifyResetToken` (IN `p_email` VARCHAR(100), IN `p_reset_token` VARCHAR(255))   BEGIN
    -- Validate input parameters
    IF p_email IS NULL OR p_email = '' THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Email cannot be empty';
    END IF;

    -- Check if reset token is valid and not expired
    SELECT 
        id, 
        email 
    FROM 
        table_users_registration 
    WHERE 
        email = p_email 
        AND reset_token = p_reset_token 
        AND reset_token_expiry > NOW();
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('adminArnigo', 'Fatima#26'),
('adminGepiga', 'Noemi#123'),
('adminHilario', 'Wena#456'),
('adminSaniel', 'Mark#789'),
('adminVillanueva', 'Laurenze#135'),
('adminVilloria', 'Nino#579'),
('adminArnigo', 'Fatima#26'),
('adminGepiga', 'Noemi#123'),
('adminHilario', 'Wena#456'),
('adminSaniel', 'Mark#789'),
('adminVillanueva', 'Laurenze#135'),
('adminVilloria', 'Nino#579'),
('adminArnigo', 'Fatima#26'),
('adminGepiga', 'Noemi#123'),
('adminHilario', 'Wena#456'),
('adminSaniel', 'Mark#789'),
('adminVillanueva', 'Laurenze#135'),
('adminVilloria', 'Nino#579');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(3, 'mj', 'mj01@gmail.com', 'Hi jhsdfukhikeurhftigukheriuthgikuftrh', '2025-05-10 07:48:01'),
(4, 'mjkvfh', 'kjnh@gmail.com', 'qswerfqwertyghujk', '2025-05-15 17:08:45'),
(5, 'qwe', 'arnigofatimabian@gmail.com', 'q2w3erfgwqert', '2025-05-15 17:09:00'),
(6, 'qwe', 'arnigofatimabian@gmail.com', 'q2w3erfgwqert', '2025-05-15 17:16:26'),
(7, 'qwe', 'arnigofatimabian@gmail.com', '1qq2wertgyhujk', '2025-05-15 17:17:57'),
(8, 'qwe', 'arnigofatimabian@gmail.com', 'qwertyuioil;&#039;wertgh', '2025-05-15 17:41:43'),
(9, 'qwe', 'arnigofatimabian@gmail.com', 'qwertyuioil039;wertgh', '2025-05-15 17:41:50'),
(10, 'qwe', 'arnigofatimabian@gmail.com', 'qwertyuioil039wertgh', '2025-05-15 17:41:54'),
(11, 'qwe', 'arnigofatimabian@gmail.com', 'sfbhjabflksmdkvsui', '2025-05-15 17:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `report_title` varchar(255) NOT NULL,
  `report_content` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
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
(5, 'anitpolo', '2025-05-14', '14:30:00', 'Pending'),
(4, 'pkawit', '2025-05-21', '13:21', 'Scheduled'),
(5, 'anitpolo', '2025-05-14', '14:30:00', 'Pending'),
(6, 'california', '2025-05-04', '17:00:00', 'Pending'),
(7, 'canada', '2025-05-10', '12:28:00', 'Pending'),
(4, 'pkawit', '2025-05-21', '13:21', 'Scheduled'),
(5, 'anitpolo', '2025-05-14', '14:30:00', 'Pending'),
(6, 'california', '2025-05-04', '17:00:00', 'Pending'),
(7, 'canada', '2025-05-10', '12:28:00', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `table_barangay`
--

CREATE TABLE `table_barangay` (
  `barangay_id` int(11) NOT NULL,
  `barangay_name` varchar(100) NOT NULL,
  `municipality_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_barangay`
--

INSERT INTO `table_barangay` (`barangay_id`, `barangay_name`, `municipality_id`) VALUES
(1, 'Adya', 1),
(2, 'Anilao', 1),
(3, 'Antipolo del Norte', 1),
(4, 'Antipolo del Sur', 1),
(5, 'Bagong Pook', 1),
(6, 'Balintawak', 1),
(7, 'Banay-banay', 1),
(8, 'Bangcal', 1),
(9, 'Bariw', 1),
(10, 'Bolbok', 1),
(11, 'Bugtong na Pulo', 1),
(12, 'Bulacnin', 1),
(13, 'Bulaklakan', 1),
(14, 'Dagatan', 1),
(15, 'Duhatan', 1),
(16, 'Halang', 1),
(17, 'Inosluban', 1),
(18, 'Kayumanggi', 1),
(19, 'Latag', 1),
(20, 'Lodlod', 1),
(21, 'Lumang Lipa', 1),
(22, 'Mabini', 1),
(23, 'Malagonlong', 1),
(24, 'Malitlit', 1),
(25, 'Marauoy', 1),
(26, 'Munting Pulo', 1),
(27, 'Pagolingin Bata', 1),
(28, 'Pagolingin East', 1),
(29, 'Pagolingin West', 1),
(30, 'Pinagtongulan', 1),
(31, 'Pinagkawitan', 1),
(32, 'Plaridel', 1),
(33, 'Poblacion Barangay 1', 1),
(34, 'Poblacion Barangay 2', 1),
(35, 'Poblacion Barangay 3', 1),
(36, 'Poblacion Barangay 4', 1),
(37, 'Poblacion Barangay 5', 1),
(38, 'Poblacion Barangay 6', 1),
(39, 'Poblacion Barangay 7', 1),
(40, 'Poblacion Barangay 8', 1),
(41, 'Poblacion Barangay 9', 1),
(42, 'Poblacion Barangay 10', 1),
(43, 'Poblacion Barangay 11', 1),
(44, 'Poblacion Barangay 12', 1),
(45, 'Poblacion Barangay 13', 1),
(46, 'Poblacion Barangay 14', 1),
(47, 'Poblacion Barangay 15', 1),
(48, 'Poblacion Barangay 16', 1),
(49, 'Poblacion Barangay 17', 1),
(50, 'Poblacion Barangay 18', 1),
(51, 'Poblacion Barangay 19', 1),
(52, 'Poblacion Barangay 20', 1),
(53, 'Poblacion Barangay 21', 1),
(54, 'Poblacion Barangay 22', 1),
(55, 'Pusil', 1),
(56, 'Quezon', 1),
(57, 'Rizal', 1),
(58, 'Sabang', 1),
(59, 'Sampaguita', 1),
(60, 'San Benito', 1),
(61, 'San Carlos', 1),
(62, 'San Francisco', 1),
(63, 'San Guillermo', 1),
(64, 'San Jose', 1),
(65, 'San Salvador', 1),
(66, 'Santa Cruz', 1),
(67, 'Santo Niño', 1),
(68, 'Santo Toribio', 1),
(69, 'Sapac', 1),
(70, 'Sico 1', 1),
(71, 'Sico 2', 1),
(72, 'Tambo', 1),
(73, 'Tangob', 1),
(74, 'Tanguay', 1),
(75, 'Tibig', 1),
(76, 'Tipacan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `table_municipality`
--

CREATE TABLE `table_municipality` (
  `municipality_id` int(11) NOT NULL,
  `municipality_name` varchar(100) NOT NULL,
  `province_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_municipality`
--

INSERT INTO `table_municipality` (`municipality_id`, `municipality_name`, `province_id`) VALUES
(1, 'Lipa City', 1);

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
  `city_id` int(11) DEFAULT NULL,
  `barangay_id` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `otp_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_users_registration`
--

INSERT INTO `table_users_registration` (`id`, `first_name`, `middle_name`, `last_name`, `suffix`, `email`, `contact`, `street`, `city_id`, `barangay_id`, `username`, `password`, `created_at`, `reset_token`, `reset_token_expiry`, `otp`, `otp_expiry`) VALUES
(4, 'wewewe', 'we', 'wewewewe', 'we', 'mojpokqwe@gmail.com', '09999999999', '', 1491, 39551, 'WewewewW', '$2y$10$Efqf12MO63P2eyK0ezDXWugKqGcX9LxvsFBe4wFDC5RyjuIqlrtu6', '2025-05-03 17:09:31', '57b26b5b423892b3da6fdff07a184fb0ffc476520c32d1764856fb567ab97cf4', '2025-05-13 17:14:49', NULL, NULL),
(8, 'Fatima', 'Bian', 'Arnigo', '', 'arnigofatimabian@gmail.com', '09953092014', 'wsdf', 1, 15, 'fatimabian', '$2y$10$i2NMe81/SER2S/6fqd69Buvytr2Df7YKycQRe5HpJAUdBXauNU00C', '2025-05-17 04:00:29', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_barangay`
--
ALTER TABLE `table_barangay`
  ADD PRIMARY KEY (`barangay_id`),
  ADD KEY `municipality_id` (`municipality_id`);

--
-- Indexes for table `table_municipality`
--
ALTER TABLE `table_municipality`
  ADD PRIMARY KEY (`municipality_id`),
  ADD KEY `province_id` (`province_id`);

--
-- Indexes for table `table_users_registration`
--
ALTER TABLE `table_users_registration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `table_barangay`
--
ALTER TABLE `table_barangay`
  MODIFY `barangay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `table_municipality`
--
ALTER TABLE `table_municipality`
  MODIFY `municipality_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `table_users_registration`
--
ALTER TABLE `table_users_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `table_barangay`
--
ALTER TABLE `table_barangay`
  ADD CONSTRAINT `table_barangay_ibfk_1` FOREIGN KEY (`municipality_id`) REFERENCES `table_municipality` (`municipality_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
