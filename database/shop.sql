-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 14, 2017 at 10:43 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `description`) VALUES
(1, 'Clothing', 'Clothing'),
(2, 'Laptops', 'Laptops'),
(3, 'Electronics', 'Electronics'),
(4, 'Mobile', 'Mobile');

-- --------------------------------------------------------

--
-- Table structure for table `dispatch`
--

CREATE TABLE `dispatch` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `contacts` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `description` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dispatch`
--

INSERT INTO `dispatch` (`id`, `name`, `contacts`, `type`, `description`) VALUES
(1, 'john', '07889989', 'Rider', 'rider');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `item` text NOT NULL,
  `amount` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `dateordered` varchar(100) NOT NULL,
  `datedelivered` varchar(100) CHARACTER SET big5 NOT NULL,
  `trans_code` int(11) NOT NULL,
  `payment` varchar(10) NOT NULL,
  `mpesa_reference` varchar(45) DEFAULT NULL,
  `dispatch_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `contact`, `address`, `email`, `item`, `amount`, `status`, `dateordered`, `datedelivered`, `trans_code`, `payment`, `mpesa_reference`, `dispatch_id`) VALUES
(8, 'Ian Kipchirchir', '0723000000', '30443 Nairobi', 'ian@mail.com', '(1) hp Windows 10, ', '28000', 'confirmed', '11/20/16 01:25:25 PM', '11/20/16 02:32:41 PM', 99500, 'cash', '', 1),
(9, 'Ada Lovelace', '0721 121212', 'Nairobi, GPO', 'lada@mail.com', '(1) HTC Windows Phone, ', '14000', 'confirmed', '03/24/17 03:41:20 PM', '03/24/17 03:43:24 PM', 19254, 'cash', '', 1),
(10, 'Brian Fletcher', '0721 121212', 'Nairobi CBD', 'bfletcher@mail.com', '(1) HTC Windows Phone, ', '14000', 'confirmed', '03/29/17 08:15:24 PM', '03/29/17 08:46:53 PM', 72336, 'cash', '', 1),
(11, 'Ada Lovelace', '0723000000', 'Nairobi CBD', 'ada@mail.com', '(1) hp Windows 10, ', '28000', 'confirmed', '03/29/17 08:40:23 PM', '03/29/17 08:41:27 PM', 23660, 'cash', '', 1),
(12, 'Rasmus Lerdorf', '0721 121212', 'Nairobi CBD', 'rasmus@mail.com', '(1) hp Windows 10, ', '28000', 'confirmed', '03/29/17 08:43:39 PM', '03/29/17 08:44:14 PM', 51554, 'cash', '', 1),
(13, 'Kevin Mitnick', '0721 121212', 'Nairobi CBD', 'kevmitnick@mail.com', '(1) HTC Windows Phone, ', '14000', 'confirmed', '03/29/17 08:49:37 PM', '03/29/17 08:50:50 PM', 81105, 'cash', '', 1),
(14, 'Steve Wozniak', '0723000000', 'Nairobi CBD', 'woz@mail.com', '(1) hp Windows 10, ', '28000', 'confirmed', '03/29/17 09:03:52 PM', '03/29/17 09:04:29 PM', 66963, 'cash', '', 1),
(15, 'Owiti Obara', '28932039209', 'cbd', 'owiti@obara', '(1) hp Windows 10, ', '28000', 'unconfirmed', '11/14/17 12:14:42 PM', '', 26435, 'cash', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`) VALUES
(1, 8, 1),
(2, 9, 2),
(3, 10, 2),
(4, 11, 1),
(5, 12, 1),
(6, 13, 2),
(7, 14, 1),
(8, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `imgurl` varchar(45) NOT NULL,
  `product` varchar(45) NOT NULL,
  `description` mediumtext NOT NULL,
  `price` double NOT NULL,
  `qty_in_stock` int(11) NOT NULL,
  `contact_info` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `imgurl`, `product`, `description`, `price`, `qty_in_stock`, `contact_info`) VALUES
(1, 2, 'index.jpeg', 'hp Windows 10', 'hp Windows 10 in a perfect working condition', 28000, 26, '0723676898'),
(2, 4, 'mob.jpg', 'HTC Windows Phone', 'HTC Windows Phone in a perfect working condition', 14000, 52, '0700123456\r\nemail@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `full_name` varchar(45) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `role` varchar(45) DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `full_name`, `last_name`, `phone`, `role`) VALUES
(1, 'admin@admin.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Omollo Erick', '', '073656', 'Admin'),
(2, 'user@user.com', '12dea96fec20593566ab75692c9949596833adc9', 'Nancy', '', '07000', 'Manager'),
(3, 'ian@mail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Ian Kipchirchir', '', '+254723000000', 'User'),
(4, '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'ugali', '', 'a283', 'User'),
(10, 'mcdalinoluoch@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Dalin Oluoch', '', '823932723', 'User'),
(11, 'random@localhost.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'random', '', '902382898', 'User'),
(12, 'another@localhost.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'another one', '', '2390232332', 'User'),
(13, 'test@test.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'test', '', '8239928323', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dispatch`
--
ALTER TABLE `dispatch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_products_1_idx` (`order_id`),
  ADD KEY `fk_order_products_2_idx` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_1_idx` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_UNIQUE` (`phone`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dispatch`
--
ALTER TABLE `dispatch`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `fk_order_products_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_products_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
