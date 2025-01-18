-- phpMyAdmin SQL Dump
-- version 5.2.1deb1+jammy2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 18, 2025 at 12:20 PM
-- Server version: 8.0.40-0ubuntu0.22.04.1
-- PHP Version: 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `railway_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `from_station_id` varchar(55) NOT NULL,
  `to_station_id` varchar(55) NOT NULL,
  `train_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `seat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `classes` varchar(55) NOT NULL,
  `pnr` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `otp` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `name`, `age`, `email`, `date`, `gender`, `contact`, `from_station_id`, `to_station_id`, `train_id`, `seat`, `classes`, `pnr`, `status`, `otp`, `is_verified`, `created_at`) VALUES
(1, 10, 'asfak ansari', '24', 'asfaque@gmail.com', '2024-12-27', 'male', '8787545458', '1', '5', '9', '1', '11', '2872697101', 'cancel', '', 0, '2024-12-19 10:32:22'),
(2, 10, 'kabir', '21', 'testkushal2@gmail.com', '2024-12-19', 'male', '8787545458', '8', '8', '11', '1', '12', '2858152919', 'confirm', '', 0, '2024-12-19 11:07:46'),
(3, 10, 'asfak', '23', 'testkushal2@gmail.com', '2024-11-29', 'male', '8989865565', '8', '8', '11', '2', '10', '6028780468', 'confirm', '', 0, '2024-12-19 11:10:35'),
(4, 10, 'saniya', '25', 'testkushal2@gmail.com', '2024-12-19', 'other', '8787545458', '8', '8', '11', '3', '9', '2693557004', 'confirm', '', 0, '2024-12-19 11:11:19'),
(5, 10, 'shahriyar', '23', 'testkushal2@gmail.com', '2024-12-20', 'male', '6389862926', '8', '7', '11', '4', '10', '1913473060', 'cancel', '', 0, '2024-12-19 11:11:50'),
(6, 10, 'saniya', '23', 'testkushal2@gmail.com', '2024-12-19', 'male', '8787545458', '8', '7', '11', '5', '-- Select class --', '8219315994', 'cancel', '', 0, '2024-12-19 11:13:14'),
(7, 10, 'asfak', '23', 'testkushal2@gmail.com', '2024-12-19', 'male', '8989865565', '8', '8', '11', '5', '9', '1174781123', 'confirm', '', 0, '2024-12-19 11:13:47'),
(8, 10, 'asfak ansari', '24', 'asfaque@gmail.com', '2024-12-28', 'male', '6389862926', '8', '13', '11', '4', '12', '9709682834', 'cancel', '', 0, '2024-12-19 12:35:34'),
(9, 10, 'saniya', '26', 'testkushal2@gmail.com', '2024-12-19', 'male', '8787545458', '8', '13', '11', '4', '11', '5675633860', 'confirm', '', 0, '2024-12-19 13:01:09'),
(10, 10, 'alfahad', '21', 'alfahad@gmail.com', '2024-12-20', 'male', '6389862926', '5', '10', '12', '1', '11', '7287202708', 'confirm', '', 0, '2024-12-20 04:52:39'),
(42, 10, 'alfahad', '23', 'mohdalfahad5@gmail.com', '2024-12-20', 'male', '8787545458', '5', '12', '12', '3', '10', '8339810889', 'confirm', '163328', 1, '2024-12-20 10:05:58'),
(43, 10, 'alfahad', '22', 'mohdalfahad5@gmail.com', '2024-12-20', 'male', '8787545458', '4', '9', '11', '1', '11', '7990675137', 'confirm', '208325', 1, '2024-12-20 10:56:52'),
(44, 10, 'alfahad', '22', 'mohdalfahad5@gmail.com', '2024-12-20', 'male', '8787545458', '4', '10', '11', NULL, '12', '2030945015', 'waiting', '285703', 1, '2024-12-20 10:58:54'),
(46, 10, 'asfak ansari', '25', 'ansariasfak955@gmail.com', '2024-12-20', 'male', '8787545458', '5', '10', '12', '4', '7', '4642366794', 'confirm', '361972', 1, '2024-12-20 11:28:38'),
(47, 10, 'asfak', '24', 'asfak.thinkdebug@gmail.com', '2024-12-20', 'female', '8866998855', '3', '10', '10', '1', '11', '5295334638', 'confirm', '805328', 1, '2024-12-20 11:29:57'),
(48, 10, 'awefef sddw', '24', 'ansariasfak955@gmail.com', '2024-12-20', 'male', '8787545458', '6', '12', '13', '1', '12', '5625058989', 'confirm', '579409', 1, '2024-12-20 11:37:21'),
(49, 10, 'saniya khan', '23', 'asfak.thinkdebug@gmail.com', '2024-12-20', 'female', '8787545458', '3', '10', '10', '2', '11', '3479422576', 'confirm', '704803', 1, '2024-12-20 11:44:51'),
(50, 10, 'abulkaish', '23', 'ansariasfak955@gmail.com', '2024-12-20', 'male', '8787545458', '3', '12', '10', '3', '11', '3810385517', 'confirm', '102400', 1, '2024-12-20 12:09:50'),
(51, 10, 'kabir', '21', 'kabir.infoseek@gmail.com', '2024-12-20', 'male', '1234567890', '5', '3', '12', '5', '10', '7609171158', 'confirm', '323997', 1, '2024-12-20 12:45:13'),
(52, 10, 'test', '25', 'samarm.infoseek@gmail.com', '2024-12-23', 'female', '8787545458', '5', '9', '12', '6', '10', '4890857694', 'confirm', '750589', 1, '2024-12-23 04:08:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
