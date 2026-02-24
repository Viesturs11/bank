-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 24, 2026 at 10:19 AM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `amount`, `description`, `created_at`) VALUES
(1, 1, '100.00', 'Sākuma depozīts', '2026-02-24 09:27:11'),
(2, 2, '100.00', 'Sākuma depozīts', '2026-02-24 09:44:51'),
(3, 1, '-10.00', 'Par plumem', '2026-02-24 09:45:40'),
(4, 2, '10.00', 'Par plumem', '2026-02-24 09:45:40'),
(5, 1, '-15.00', 'Par plumem', '2026-02-24 09:56:29'),
(6, 2, '15.00', 'Par plumem', '2026-02-24 09:56:29'),
(7, 1, '-5.00', 'Par zemenem', '2026-02-24 10:00:12'),
(8, 2, '5.00', 'Par zemenem', '2026-02-24 10:00:12'),
(9, 1, '-3.00', 'TestPrece', '2026-02-24 10:16:08'),
(10, 2, '3.00', 'TestPrece', '2026-02-24 10:16:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `account_number`) VALUES
(1, 'viesturs.karlivans@va.lv', '$2y$10$UcZm.Wo3WS/LfkAQcd0mke3hc8SvDqtxfQWIIsLkFhaKlczW1QCoa', 'LV12BANK0000000001'),
(2, 'info@mezabite.lv', '$2y$10$NGsxRnSzN4.njaK6wCZQZeQQvYxXNGUwFbS1rZTWSKEdi3pg00hZW', 'LV12BANK0000000002');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
