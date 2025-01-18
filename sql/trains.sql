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
-- Table structure for table `trains`
--

CREATE TABLE `trains` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `train_number` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trains`
--

INSERT INTO `trains` (`id`, `name`, `train_number`, `created_at`, `updated_at`) VALUES
(9, 'GANGASUTLEJ EXP', '27489', '2024-12-18 05:57:10', '2024-12-18 05:57:10'),
(10, 'BIHAR S KRANTI', '54221', '2024-12-18 05:57:17', '2024-12-18 05:57:17'),
(11, 'VAISHALI EXP', '78944', '2024-12-18 05:57:27', '2024-12-18 05:57:27'),
(12, 'GORAKHPUR EXP', '24804', '2024-12-18 05:57:48', '2024-12-18 05:57:48'),
(13, 'KUSHINAGAR EXP', '68551', '2024-12-18 05:57:55', '2024-12-18 05:57:55'),
(14, 'Lucknow EXP', '97294', '2024-12-18 05:58:03', '2024-12-18 05:58:03'),
(15, 'Awadh EXP', '54103', '2024-12-25 12:35:32', '2024-12-25 12:35:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `trains`
--
ALTER TABLE `trains`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trains`
--
ALTER TABLE `trains`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
