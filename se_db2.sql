-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2024 at 09:16 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `se_db2`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_total`
--

CREATE TABLE `cart_total` (
  `cart_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_total`
--

INSERT INTO `cart_total` (`cart_id`, `username`, `total_price`) VALUES
(1, 'b4', '0.00'),
(2, 'b4', '0.00'),
(3, 'b4', '100000.00'),
(4, 'b4', '100000.00'),
(5, 'b4', '100000.00'),
(6, 'b4', '0.00'),
(7, 'b4', '0.00'),
(8, 'b4', '0.00'),
(9, 'b4', '100000.00'),
(10, 'b4', '100000.00'),
(11, 'b4', '100000.00'),
(12, 'b4', '100000.00'),
(13, 'b4', '100000.00'),
(14, 'b4', '100000.00'),
(15, 'b4', '50000.00'),
(16, 'b4', '50000.00'),
(17, 'b4', '100000.00'),
(18, 'b4', '50000.00'),
(19, 'b4', '50000.00'),
(20, 'b4', '50000.00'),
(21, 'b4', '100000.00'),
(22, 'angel', '78000.00'),
(23, 'angel', '303000.00'),
(24, 'angel', '225000.00'),
(25, 'angel', '0.00'),
(26, 'angel', '78000.00'),
(27, 'angel', '303000.00'),
(28, 'angel', '78000.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `birthdate` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `phone`, `birthdate`, `password`, `created_at`) VALUES
(1, 'luxyn_zhie4', '08138653080403', '2004-06-09', 'm4h', '2024-04-27 02:09:43'),
(2, 'student22', '08122', '2004-06-22', 'm4hdianib', '2024-04-27 03:26:15'),
(3, 'luxyn_zhie21', '0812381273', '2004-06-23', 'm4hdianib22', '2024-04-27 03:29:06'),
(4, 'b4', '09210', '2004-06-22', '$2y$10$ZpNUJtYI3TciZ6ycGlFeE.O0MqAV7y7BbzLS5qfxZ7/2RcIS14ghy', '2024-04-27 03:31:49'),
(5, 'briza22', '01290391', '2004-06-21', 'm4hdia', '2024-04-27 03:32:41'),
(6, 'ab', '0129301', '2004-06-21', 'm4h', '2024-04-27 03:37:44'),
(7, 'luxynzhie22', '1290381039', '2004-06-22', 'm4hdianib', '2024-04-27 03:38:41'),
(8, 'brizaa22', '019230193', '2004-06-22', '', '2024-04-27 11:01:03'),
(9, 'angel', '012345678910', '2004-10-10', '$2y$10$q/nvCBsJV8NBY1eKPyLUju0EwmK5Go0gNM15SxSYEljRtCZpogXva', '2024-04-28 14:29:31');

-- --------------------------------------------------------

--
-- Table structure for table `user_carts`
--

CREATE TABLE `user_carts` (
  `id` int(11) NOT NULL,
  `game_id` varchar(255) NOT NULL,
  `server` varchar(255) NOT NULL,
  `items` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_carts`
--

INSERT INTO `user_carts` (`id`, `game_id`, `server`, `items`, `price`, `created_at`, `username`) VALUES
(1, '22062004', 'Asia', '257', '0.00', '2024-04-28 01:43:52', NULL),
(2, '02913091', 'Asia', '1115', '225000.00', '2024-04-28 01:48:20', NULL),
(3, '02913091', 'Asia', '257', '50000.00', '2024-04-28 01:50:42', NULL),
(4, '22062004', 'Asia', 'Diamond 257', '50000.00', '2024-04-28 01:51:00', NULL),
(5, '218319', 'Asia', '300 Diamond', '78000.00', '2024-04-28 05:51:49', NULL),
(6, '782191', 'Asia', '257 Diamond', '50000.00', '2024-04-28 05:52:40', NULL),
(7, '22062004', 'Asia', '257 Diamond', '50000.00', '2024-04-28 06:46:34', 'b4'),
(8, '8024686469', 'Asia', '257 Diamond', '50000.00', '2024-04-28 07:11:48', NULL),
(9, '802468', 'Asia', '257 Diamond', '50000.00', '2024-04-28 07:17:29', NULL),
(10, '802468', 'Asia', '300 Diamond', '78000.00', '2024-04-28 14:29:48', 'angel'),
(11, '802468', 'Asia', '1115 Diamond', '225000.00', '2024-04-28 14:29:53', 'angel');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_total`
--
ALTER TABLE `cart_total`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_carts`
--
ALTER TABLE `user_carts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_total`
--
ALTER TABLE `cart_total`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_carts`
--
ALTER TABLE `user_carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
