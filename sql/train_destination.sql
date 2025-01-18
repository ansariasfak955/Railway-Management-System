-- phpMyAdmin SQL Dump
-- version 5.2.1deb1+jammy2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 18, 2025 at 12:21 PM
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
-- Table structure for table `train_destination`
--

CREATE TABLE `train_destination` (
  `id` int NOT NULL,
  `from_station` varchar(255) NOT NULL,
  `to_station` varchar(255) NOT NULL,
  `trainName` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `train_destination`
--

INSERT INTO `train_destination` (`id`, `from_station`, `to_station`, `trainName`, `destination`, `price`, `created_at`, `updated_at`) VALUES
(1, '1', '3', '9', '50', '25', '2024-12-18 06:09:55', '2024-12-18 06:09:55'),
(2, '3', '4', '10', '100', '50', '2024-12-18 06:15:46', '2024-12-18 06:15:46'),
(3, '4', '5', '11', '150', '75', '2024-12-18 06:15:59', '2024-12-18 06:15:59'),
(4, '5', '6', '12', '80', '40', '2024-12-18 06:16:12', '2024-12-18 06:16:12'),
(5, '6', '7', '13', '70', '35', '2024-12-18 06:16:29', '2024-12-18 06:16:29'),
(6, '7', '8', '14', '120', '60', '2024-12-18 06:16:51', '2024-12-18 06:16:51'),
(7, '3', '8', '10', '150', '75', '2024-12-19 05:06:54', '2024-12-19 05:06:54'),
(8, '3', '10', '14', '50', '25', '2024-12-19 05:07:23', '2024-12-19 05:07:23'),
(9, '8', '12', '11', '150', '75', '2024-12-19 09:54:10', '2024-12-19 09:54:10'),
(10, '9', '12', '14', '120', '60', '2024-12-19 09:58:32', '2024-12-19 09:58:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `train_destination`
--
ALTER TABLE `train_destination`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `train_destination`
--
ALTER TABLE `train_destination`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
