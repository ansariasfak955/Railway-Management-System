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
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int NOT NULL,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class`, `created_at`, `updated_at`) VALUES
(1, 'Anubhuti Class (EA)', '2024-12-18 04:33:19', '2024-12-18 04:33:19'),
(2, 'AC First Class (1A)', '2024-12-18 04:34:41', '2024-12-18 04:34:41'),
(3, 'Vistadome AC (EV)', '2024-12-18 04:34:59', '2024-12-18 04:34:59'),
(4, 'Exec. Chair Car (EC)', '2024-12-18 04:35:10', '2024-12-18 04:35:10'),
(5, 'AC 2 Tier (2A)', '2024-12-18 04:35:25', '2024-12-18 04:35:25'),
(6, 'First Class (FC)', '2024-12-18 04:35:34', '2024-12-18 04:35:34'),
(7, 'AC 3 Tier (3A)', '2024-12-18 04:35:44', '2024-12-18 04:35:44'),
(8, 'AC 3 Economy (3E)', '2024-12-18 04:37:58', '2024-12-18 04:37:58'),
(9, 'Vistadome Chair Car (VC)', '2024-12-18 04:38:13', '2024-12-18 04:38:13'),
(10, 'AC Chair car (CC)', '2024-12-18 04:38:34', '2024-12-18 04:38:34'),
(11, 'Sleeper (SL)', '2024-12-18 04:38:42', '2024-12-18 04:38:42'),
(12, 'Vistadome Non AC (VS)', '2024-12-18 04:38:50', '2024-12-18 04:38:50'),
(13, 'Second Sitting (2S)', '2024-12-18 04:38:57', '2024-12-18 04:38:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
