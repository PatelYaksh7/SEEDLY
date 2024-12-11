-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 07:41 AM
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
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `product_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`, `product_type`) VALUES
(183, 17, 2, 'Corn Seeds', 75, 1, 's2 - Copy (3).jpg', 'seeds'),
(184, 17, 3, 'XYZ', 14, 1, 'nurserylive-plants-peace-lily-spathiphyllum-plant-1-124667_222x295.avif', 'plants');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(15, 17, 'Yaksh Patel', 'bitu4patel@gmail.com', '09978418569', 'asdasdasd'),
(16, 17, 'Yaksh Patel', 'admin@gmail.com', '09978418569', 'ssdfsdfsfd');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(32, 17, '', '', '', 'cash on delivery', 'flat no. , , ,  - ', ', Cabbage (1) ', 272, '11-Nov-2024', 'completed'),
(33, 17, '', '', '', 'cash on delivery', 'flat no. , , ,  - ', ', Corn Seeds (1) ', 75, '26-Nov-2024', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`id`, `name`, `details`, `price`, `image`) VALUES
(3, 'XYHelllo', '', 120, 'nurserylive-plants-peace-lily-spathiphyllum-plant-1-124667_222x295.avif'),
(4, 'XYZ', '', 14, 'nurserylive-plants-peace-lily-spathiphyllum-plant-1-124667_222x295.avif'),
(5, 'XYZ', '', 14, 'nurserylive-plants-peace-lily-spathiphyllum-plant-1-124667_222x295.avif'),
(6, 'XYZ', '', 14, 'nurserylive-plants-peace-lily-spathiphyllum-plant-1-124667_222x295.avif'),
(7, 'XYZ', '', 14, 'nurserylive-plants-peace-lily-spathiphyllum-plant-1-124667_222x295.avif');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(20) NOT NULL,
  `category` varchar(255) NOT NULL,
  `seed_type` varchar(255) NOT NULL,
  `item_type` enum('seed','plant') NOT NULL,
  `type` varchar(255) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `Address` text NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `user_id`, `name`, `email`, `number`, `category`, `seed_type`, `item_type`, `type`, `quantity`, `price`, `Address`, `status`, `created_at`, `image`) VALUES
(19, 17, 'Yaksh Patel', 'yaksh@gmail.com', '1234567890', 'Herbs', 'Cilantro', 'plant', '', 1.00, 200.00, '30 Tapovan Society , Near Sabar Cable , Sahkarijin Road ,Himatngar', 'approved', '2024-11-09 03:50:28', 'a05beb4680034da9.webp'),
(20, 17, 'Yaksh Patel', 'bitu4patel@gmail.com', '1234567890', 'Vegetables', 'Tomato', '', '', 100.00, 200.00, '30 Tapovan Society , Near Sabar Cable , Sahkarijin Road ,Himatngar', 'approved', '2024-11-10 09:09:13', '');

-- --------------------------------------------------------

--
-- Table structure for table `researcher_requests`
--

CREATE TABLE `researcher_requests` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `research_type` enum('Full Check','Only Soil Quality Check','Nutrient Analysis','Crop Suitability Check','Pest and Disease Assessment','Water Quality Check','Soil Fertility Assessment','Customized Consultation') NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Reject','Approved') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `researcher_requests`
--

INSERT INTO `researcher_requests` (`request_id`, `user_id`, `name`, `email`, `mobile_number`, `Address`, `research_type`, `request_date`, `status`) VALUES
(7, 17, 'Yaksh Patel', 'bitu4patel@gmail.com', '09978418569', '30 Tapovan Society , Near Sabar Cable , Sahkarijin Road ,Himatngar', 'Full Check', '2024-11-09 04:38:47', 'Approved'),
(8, 17, 'Yaksh Patel', 'bitu4patel@gmail.com', '09978418569', '30 Tapovan Society , Near Sabar Cable , Sahkarijin Road ,Himatngar', 'Full Check', '2024-11-10 10:17:27', 'Approved'),
(11, 17, 'Yaksh Patel', 'yaksh@gmail.com', '09978418569', '30 Tapovan Society , Near Sabar Cable , Sahkarijin Road ,Himatngar', 'Full Check', '2024-11-12 05:00:05', 'Approved'),
(12, 17, 'Yaksh Patel', 'Maharshi@gmail.com', '09978418569', '30 Tapovan Society , Near Sabar Cable , Sahkarijin Road ,Himatngar', 'Full Check', '2024-11-26 15:09:11', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `research_types`
--

CREATE TABLE `research_types` (
  `id` int(11) NOT NULL,
  `research_type` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `research_types`
--

INSERT INTO `research_types` (`id`, `research_type`, `price`) VALUES
(1, 'Full Check', 150);

-- --------------------------------------------------------

--
-- Table structure for table `seeds`
--

CREATE TABLE `seeds` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seeds`
--

INSERT INTO `seeds` (`id`, `name`, `details`, `price`, `image`) VALUES
(2, 'Corn Seeds', '', 75, 's2 - Copy (3).jpg'),
(3, 'Cucumber', '', 1651, 's1 - Copy (2).jpg'),
(4, 'Cabbage', '', 272, 's1 - Copy (3).jpg'),
(12, 'Sunflower  Seeds', 'Nature Prime Sunflower Seeds (250 Gm)', 150, 'images (2).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(14, 'user A', 'user01@gmail.com', '698d51a19d8a121ce581499d7b701668', 'user'),
(16, 'Yaksh Patel', 'bitu4patel@gmail.com', '02c75fb22c75b23dc963c7eb91a062cc', 'admin'),
(17, 'Yaksh Patel', 'bitupatel@gmail.com', '02c75fb22c75b23dc963c7eb91a062cc', 'user'),
(18, 'xyz', 'xyz@gmail.com', 'a130870ccaa6bb8f250dcbec777ed7df', 'user'),
(19, 'Researcher', 'xyzResearcher@gmail.com', '5ef26b5179f061e7668adbfad175db5f', 'researcher');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `product_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`, `product_type`) VALUES
(60, 14, 19, 'pink bouquet', 15, 'pink bouquet.jpg', ''),
(75, 17, 3, 'Cucumber', 1651, 's1 - Copy (2).jpg', 'seeds');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `researcher_requests`
--
ALTER TABLE `researcher_requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `research_types`
--
ALTER TABLE `research_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seeds`
--
ALTER TABLE `seeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `researcher_requests`
--
ALTER TABLE `researcher_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `research_types`
--
ALTER TABLE `research_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `seeds`
--
ALTER TABLE `seeds`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
