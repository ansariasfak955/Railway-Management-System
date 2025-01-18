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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contact`, `address`, `gender`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'asfak', 'asfak@gmail.com', '', '', '', '$2y$10$UuatLETJ4lvLU.31pNnFDejuVDNxIK6SqpnopTK.G1aHeQfqAEqOa', 'user', '2024-12-16 05:52:50', '2024-12-16 05:52:50'),
(3, 'testing', 'testing@gmail.com', '', '', '', '$2y$10$M.E7bliJYb9ypnqbY6wbtOnJYSD6EWmctUOqydwyepwCcZC1D0VGK', 'user', '2024-12-16 05:54:01', '2024-12-16 05:54:01'),
(5, 'info', 'infoseek@gmail.com', '', '', '', '$2y$10$ems2uFuwFI2xQqX5WLXqn.RlW.VtBVBY592i6HOzmj98aAsymXd26', 'user', '2024-12-16 05:56:58', '2024-12-16 05:56:58'),
(6, 'test', 'test@gmail.com', '8989865565', 'awfdwe', '', '$2y$10$wKs3vy.T2UYtTJABVI1AM.E09Z4l8x4bXuB91crj3dhbfjaT0k71W', 'user', '2024-12-16 06:11:53', '2024-12-16 10:37:47'),
(7, 'admin ansari', 'admin@gmail.com', '6389862926', 'azamgarh azamatgarh alinagar  srvrdg', '', '$2y$10$OyR2dsmj8vXc2FugCKeRMeHOKSvZEVANJBzs4/mwcmtG1AjY2Rah.', 'admin', '2024-12-16 06:26:01', '2024-12-16 10:11:18'),
(8, 'ahmad', 'ahmad@gmail.com', '', '', '', '$2y$10$Kgcqkh6YjQhsx0ioZezJze979qCbBquxSEDjI0Utc028EkICs9XZG', 'user', '2024-12-17 04:05:55', '2024-12-17 04:05:55'),
(9, 'testinginfo', 'testinginfo@gmail.com', '898989898', '', 'Male', '$2y$10$luL2gUZeQ03kaxiC4xvIPurfdyOXOYnTq7aWHatropDIFElDnqA6u', 'user', '2024-12-17 06:00:38', '2024-12-17 06:00:38'),
(10, 'kbtest', 'kbtest@gmail.com', '8989566989', '', 'Female', '$2y$10$CpuWjGWXc2bRV0GagIPCcOvlXo.Q7uBgHS62e9Akwam8iVRxbQ0P.', 'user', '2024-12-17 12:47:42', '2024-12-17 12:47:42'),
(11, 'kabir', 'kabir@gmail.com', '1234567890', '', 'Male', '$2y$10$kpLA6pIRFSDTejb.i3kR7eKAoWqfcUarEgkHK.KaktlIzhrSuY/UK', 'user', '2024-12-17 13:01:25', '2024-12-17 13:01:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
