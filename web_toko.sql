-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2025 at 02:41 PM
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
-- Database: `web_toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(23, 'drink '),
(24, 'food');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `payment_method` enum('bank_transfer','cash_on_delivery') NOT NULL,
  `total` int(11) NOT NULL,
  `status` enum('pending','paid','shipped') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `address`, `phone`, `payment_method`, `total`, `status`, `created_at`) VALUES
(1, '', '', '4454567686', 'bank_transfer', 465000, 'pending', '2024-11-19 18:59:17'),
(2, '', '', '4454567686', 'cash_on_delivery', 65000, 'pending', '2024-11-19 19:01:25'),
(3, 'Jeyunie', 'jalan kelapa muda', '0987654567', 'cash_on_delivery', 15000, 'pending', '2024-11-19 19:29:11'),
(4, 'Jeyunie', 'Jalan jalan ke pasar asem, cakep', '0987654567', 'cash_on_delivery', 175000, 'pending', '2024-11-19 23:24:07'),
(5, 'Jeyunie', 'jalan jalan ke pantai', '0987654567', 'bank_transfer', 180000, 'pending', '2024-11-19 23:25:19'),
(6, 'Jeyunie', 'jalan kelapa gading', '0987654567', 'bank_transfer', 340000, 'pending', '2024-11-20 03:49:00'),
(7, 'budi', 'jalan jalan', '9087665', 'bank_transfer', 80000, 'pending', '2024-11-20 04:22:43'),
(8, 'saya', 'jaln rumah saya', '123456', 'bank_transfer', 35000, 'pending', '2024-11-20 05:22:41'),
(9, 'Jeyunie', 'Jalan kepala gading', '126872378', 'bank_transfer', 65000, 'pending', '2024-11-20 07:04:28'),
(10, 'Vany', 'Jl. Margodadi ', '0987654567', 'bank_transfer', 65000, 'pending', '2025-01-09 12:01:25');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `subtotal`) VALUES
(1, 1, 38, 1, 15000),
(2, 1, 41, 1, 150000),
(3, 1, 40, 1, 85000),
(4, 1, 42, 1, 80000),
(5, 1, 39, 1, 35000),
(6, 1, 43, 1, 35000),
(7, 1, 37, 1, 65000),
(8, 2, 37, 1, 65000),
(9, 3, 38, 1, 15000),
(10, 4, 37, 1, 65000),
(11, 4, 47, 1, 25000),
(12, 4, 40, 1, 85000),
(13, 5, 37, 1, 65000),
(14, 5, 40, 1, 85000),
(15, 5, 45, 1, 30000),
(16, 6, 37, 5, 325000),
(17, 6, 38, 1, 15000),
(18, 7, 38, 1, 15000),
(19, 7, 37, 1, 65000),
(20, 8, 43, 1, 35000),
(21, 9, 37, 1, 65000),
(22, 10, 37, 1, 65000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `ketersediaan_stok` enum('habis','tersedia') DEFAULT 'tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kategori_id`, `nama`, `harga`, `foto`, `detail`, `ketersediaan_stok`) VALUES
(37, 24, 'Cinnamon roll', 65000, 'lMQVnLbLvNlq08BxXmjb.jpeg', 'Manjakan diri dengan kelezatan cinnamon rolls hangat yang baru keluar dari oven. Rasakan sensasi hangat di tenggorokan dan aroma manis yang menyelimuti indra penciumanmu.', 'tersedia'),
(38, 24, 'Cookies', 15000, 'uyWxEEw0PjgMGXj2XKim.jpg', 'Manjakan diri dengan kelezatan cinnamon rolls hangat yang baru keluar dari oven. Rasakan sensasi hangat di tenggorokan dan aroma manis yang menyelimuti indra penciumanmu.', 'tersedia'),
(39, 24, 'Cupcake', 35000, '5f95AwNr6Mt5khYjnA3T.jpg', 'Manjakan diri dengan kelezatan cinnamon rolls hangat yang baru keluar dari oven. Rasakan sensasi hangat di tenggorokan dan aroma manis yang menyelimuti indra penciumanmu.', 'tersedia'),
(40, 24, 'Bagguete', 85000, 'FCV2i7eLzKuJwLN8IpHP.jpg', 'Manjakan diri dengan kelezatan cinnamon rolls hangat yang baru keluar dari oven. Rasakan sensasi hangat di tenggorokan dan aroma manis yang menyelimuti indra penciumanmu.', 'tersedia'),
(41, 24, 'Burnt CheeseCake', 150000, 'AYkEvjqfZAy5qiPnB3TP.jpg', 'Manjakan diri dengan kelezatan cinnamon rolls hangat yang baru keluar dari oven. Rasakan sensasi hangat di tenggorokan dan aroma manis yang menyelimuti indra penciumanmu.', 'tersedia'),
(42, 24, 'Pancake', 80000, '0aXLWAdfKFR8z3waKzj9.jpg', 'Manjakan diri dengan kelezatan cinnamon rolls hangat yang baru keluar dari oven. Rasakan sensasi hangat di tenggorokan dan aroma manis yang menyelimuti indra penciumanmu.', 'tersedia'),
(43, 23, 'Happy Sparkling', 35000, 'hA8eT0Cwvud8Taa05bYN.jpg', 'Manjakan diri dengan kelezatan cinnamon rolls hangat yang baru keluar dari oven. Rasakan sensasi hangat di tenggorokan dan aroma manis yang menyelimuti indra penciumanmu.', 'tersedia'),
(44, 23, 'Ice Americano', 25000, '7ZVE4fKSXHZI5rV8CrUL.png', 'Manjakan diri dengan kelezatan cinnamon rolls hangat yang baru keluar dari oven. Rasakan sensasi hangat di tenggorokan dan aroma manis yang menyelimuti indra penciumanmu.', 'tersedia'),
(45, 23, 'Matcha Latte', 30000, 'nicS6Ljk0FWwpLKEM9Gq.png', 'Manjakan diri dengan kelezatan cinnamon rolls hangat yang baru keluar dari oven. Rasakan sensasi hangat di tenggorokan dan aroma manis yang menyelimuti indra penciumanmu.', 'tersedia'),
(46, 23, 'Ice Cappucino', 27000, 'eZFYdRwu9xZuMJY3jHNQ.png', 'Manjakan diri dengan kelezatan cinnamon rolls hangat yang baru keluar dari oven. Rasakan sensasi hangat di tenggorokan dan aroma manis yang menyelimuti indra penciumanmu.', 'tersedia'),
(47, 23, 'Lemon Tea', 25000, 'oM14dj76xQMKMMAJOLD3.jpg', 'Manjakan diri dengan kelezatan cinnamon rolls hangat yang baru keluar dari oven. Rasakan sensasi hangat di tenggorokan dan aroma manis yang menyelimuti indra penciumanmu.', 'tersedia'),
(48, 23, 'Cookies and Cream', 37000, 'D8XEFwOCbMDx3rJkNIou.png', 'Manjakan diri dengan kelezatan cinnamon rolls hangat yang baru keluar dari oven. Rasakan sensasi hangat di tenggorokan dan aroma manis yang menyelimuti indra penciumanmu.', 'tersedia'),
(50, 24, 'Nasi', 12000, 'ATRnEiuWKhsGvej5nXpq.png', 'bla bla bla bla', 'tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `nama`, `username`, `password`, `role`) VALUES
('admin123@gmail.com', 'administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
('bycilembu16@gmail.com', 'Cilembu', 'Cilembu16', 'e10adc3949ba59abbe56e057f20f883e', 'user'),
('jakesim15@gmail.com', 'Jeyunie', 'Jeyunie', 'b2724d84c15ebcd7ad0c75d40f6beccc', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nama` (`nama`),
  ADD KEY `kategori_produk` (`kategori_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `produk` (`id`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `kategori_produk` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
