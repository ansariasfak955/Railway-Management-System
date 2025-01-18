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
-- Table structure for table `stations`
--

CREATE TABLE `stations` (
  `id` int NOT NULL,
  `station` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`id`, `station`, `created_at`, `updated_at`) VALUES
(1, 'Badshahnagar', '2024-12-17 04:41:53', '2024-12-17 04:41:53'),
(3, 'Gomti Nagar (Lucknow)', '2024-12-17 04:43:42', '2024-12-17 04:43:42'),
(4, 'Aishbagh', '2024-12-17 04:43:53', '2024-12-17 04:43:53'),
(5, 'Lucknow City', '2024-12-17 04:44:04', '2024-12-17 04:44:04'),
(6, 'Mohibullapur', '2024-12-17 04:44:15', '2024-12-17 04:44:15'),
(7, 'Lucknow Junction NER', '2024-12-17 04:44:24', '2024-12-17 04:44:24'),
(8, 'Kanpur Central', '2024-12-17 04:44:34', '2024-12-17 04:44:34'),
(9, 'Varanasi Junction', '2024-12-17 04:44:41', '2024-12-17 04:44:41'),
(10, 'Gonda Junction', '2024-12-17 04:44:50', '2024-12-17 04:44:50'),
(12, 'Azamgarh Station | AMH | Grade C Station', '2024-12-17 04:53:29', '2024-12-17 04:53:29'),
(13, 'Chakra Road (CKYD) Dist - Mau (Uttar Pradesh)', '2024-12-17 04:54:00', '2024-12-17 04:54:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stations`
--
ALTER TABLE `stations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
