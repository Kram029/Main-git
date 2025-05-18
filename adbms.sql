-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2025 at 05:01 AM
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateAdminPassword` (IN `adminUsername` VARCHAR(50), IN `newPassword` VARCHAR(255))   BEGIN
    UPDATE admin 
    SET password = newPassword 
    WHERE username = adminUsername;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateUserEmailPassword` (IN `p_user_id` INT, IN `p_new_email` VARCHAR(150), IN `p_new_password` VARCHAR(255))   BEGIN
    UPDATE table_users_registration
    SET email = p_new_email,
        password = p_new_password
    WHERE id = p_user_id;
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
('adminSaniel', '12345678'),
('adminVillanueva', 'Laurenze#135'),
('adminVilloria', 'Nino#579'),
('adminArnigo', 'Fatima#26'),
('adminGepiga', 'Noemi#123'),
('adminHilario', 'Wena#456'),
('adminSaniel', '12345678'),
('adminVillanueva', 'Laurenze#135'),
('adminVilloria', 'Nino#579'),
('adminArnigo', 'Fatima#26'),
('adminGepiga', 'Noemi#123'),
('adminHilario', 'Wena#456'),
('adminSaniel', '12345678'),
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

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `report_title`, `report_content`, `created_at`) VALUES
(0, '5e6y4e56yte', '45eh636er6yhftyhuj67ty89o8p0', '0000-00-00 00:00:00'),
(0, 'ytuij6ytijt6y', '6tunr6t7ujy', '0000-00-00 00:00:00'),
(0, '568u67trij6y7ti9', '678km78ty8io79', '0000-00-00 00:00:00'),
(0, 'ty6iu6t79i', 't8i6t7i98790', '0000-00-00 00:00:00'),
(0, 'tfghnjytfghujytgi', 'ygtju7ikyguokl9', '0000-00-00 00:00:00'),
(0, 'tuyru', 'ru5t6y7u', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `barangay` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `barangay`, `date`, `time`, `status`) VALUES
(1, 'Bagong Pook', '2025-05-20', '10:58:00', 'Pending'),
(2, 'Antipolo del Norte', '2025-05-19', '10:00:00', 'Pending');

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
(10, 'Jane', 'Puso', 'doe', '', 'sanielmargie@gmail.com', '09999999999', '', 1, 0, 'Margie', '$2y$10$HTvOkheB.2BgDHPaTL1gsO.bwCBb96f9Zmncp.zGHjriHRytVZAme', '2025-05-17 23:16:45', '70f33f384eead4a789551a4c24f6631da62acd1dd333a91b3e31ad51a74cdd31', '2025-05-18 02:18:11', '979762', '2025-05-18 02:18:12'),
(11, 'Mark Joseph', 'Puso', 'Saniel', '', 'mjsaniel32@gmail.com', '09999999991', '', 1, 0, 'loading29_28', '$2y$10$6HON9mJYfgriQwr/wQXeyeyX0/QHBVpGToVXJmS3B5ixTOZo1sSl2', '2025-05-17 23:20:30', 'ded3cd12569eadec9b4a218856ed84ddf1c8508b8b6e8deeee7d1eb35112e3aa', '2025-05-18 02:32:02', NULL, NULL),
(12, 'John Mark', 'Puso', 'Saniel', '', 'mj029@gmail.com', '09999999992', '', 1, 7, '1122334455', '$2y$10$IBtRULJGCsa/WJKMf9U/t.HwyM4xxIafk10yd.QEDWFC9fM1rRaNS', '2025-05-18 01:08:16', NULL, NULL, NULL, NULL),
(13, 'Mark Joseph', 'Puso', 'Saniel', '', 'mj01@gmail.com', '09999999998', '', 1, 11, 'Kram123', '$2y$10$zohCkZXlNrYmo4ILSftB2uAPKY2CFb/xjirpPbm5M/6lm3n/xMAJi', '2025-05-18 02:02:18', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
    
