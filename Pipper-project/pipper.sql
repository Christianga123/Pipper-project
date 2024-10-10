-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2024 at 11:22 PM
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
-- Database: `pipper`
--

-- --------------------------------------------------------

--
-- Table structure for table `pips`
--

CREATE TABLE `pips` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(280) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pips`
--

INSERT INTO `pips` (`id`, `user_id`, `content`, `created_at`) VALUES
(83, 1, 'Hello this is my first time writing anything on Pipper!\r\n', '2024-10-10 20:55:52'),
(84, 1, 'Click the \"Create pip\" button on the panel to get easy access to create a pip!', '2024-10-10 20:56:47'),
(85, 1, 'Click the \"Create pip\" button on the panel to get easy access to create a pip!', '2024-10-10 20:56:47'),
(86, 1, 'Use the search function in the header to search for both users and specific pips\r\n', '2024-10-10 20:57:22'),
(87, 1, 'Use the search function in the header to search for both users and specific pips\r\n', '2024-10-10 21:02:43'),
(88, 1, 'Use the search function in the header to search for both users and specific pips\r\n', '2024-10-10 21:03:04'),
(89, 1, 'Use the search function in the header to search for both users and specific pips\r\n', '2024-10-10 21:04:06'),
(90, 1, 'Use the search function in the header to search for both users and specific pips\r\n', '2024-10-10 21:04:16'),
(91, 1, 'Use the search function in the header to search for both users and specific pips\r\n', '2024-10-10 21:05:31'),
(92, 1, 'Use the search function in the header to search for both users and specific pips\r\n', '2024-10-10 21:05:32'),
(93, 1, 'Use the search function in the header to search for both users and specific pips\r\n', '2024-10-10 21:06:30'),
(94, 1, 'Use the search function in the header to search for both users and specific pips\r\n', '2024-10-10 21:06:31'),
(95, 1, 'Use the search function in the header to search for both users and specific pips\r\n', '2024-10-10 21:08:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `avatar_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `avatar_url`) VALUES
(1, 'Christian', 'christianga.2001@gmail.com', '$2y$10$IY8O3hbacspW3AtfeLiYE.d0K7LIqhPdNoPcuKdC8DuH2i58fpP/.', '2024-10-09 15:57:36', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pips`
--
ALTER TABLE `pips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pips`
--
ALTER TABLE `pips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pips`
--
ALTER TABLE `pips`
  ADD CONSTRAINT `pips_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
