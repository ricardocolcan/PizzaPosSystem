-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2023 at 11:07 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE `pizza_sales`;
USE `pizza_sales`;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizza_sales`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `postal_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`, `phone_number`, `address`, `postal_code`) VALUES
(1, 'Ricardo', '519111222', '1-1 King Str. Kitchener ON', 'A1B 2CD'),
(2, 'Marry', '5191118888', '10-1 King Str. Waterloo ON', 'J1B 8NM'),
(3, 'Jeremy', '5192223333', '2-2 Queen Str. Kitchener ON', 'B2H 1BN'),
(4, 'Mike', '5193334444', '3-3 Vellay Dr. Waterloo ON', 'C3N K89'),
(5, 'Amy', '5194445555', '4-4 Lake Dr. Kitchener ON', 'D4J 1N9'),
(6, 'Shawn', '5195556666', '5-5 Ocean Str. Waterloo ON', 'E1B 2DD'),
(7, 'Ricardo Parra', '5197812642', '1425 block line', 'N2C 0B9'),
(8, 'Jeremy Chua', '2266009793', 'Doon Campus', 'N3V 9Y7'),
(9, 'Jeremy Chua', '2266009793', 'Doon Campus', 'N3V 9Y7'),
(10, 'Natalia Tapias', '226675898', 'KR 34 Av 23', 'N4C 8U7');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_price` float NOT NULL,
  `payment_type` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `client_id`, `order_time`, `total_price`, `payment_type`, `user_id`) VALUES
(1, 1, '2023-04-20 18:06:08', 10, 2, 3),
(2, 3, '2023-04-20 18:06:50', 5, 1, 3),
(3, 2, '2023-04-20 18:06:24', 12, 3, 3),
(4, 5, '2023-04-20 18:06:31', 24, 1, 3),
(5, 6, '2023-04-20 18:06:41', 6, 1, 3),
(9, 7, '2023-04-20 17:49:38', 18, 2, 4),
(11, 9, '2023-04-20 18:37:04', 18, 3, 4),
(12, 10, '2023-04-20 20:09:24', 18, 3, 3),
(13, 10, '2023-04-20 20:21:47', 13, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`id`, `type`) VALUES
(1, 'Cash'),
(2, 'Debit'),
(3, 'Credit');

-- --------------------------------------------------------

--
-- Table structure for table `pizza`
--

CREATE TABLE `pizza` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `description` varchar(100) NOT NULL,
  `size` varchar(10) NOT NULL,
  `image` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pizza`
--

INSERT INTO `pizza` (`id`, `name`, `price`, `description`, `size`, `image`) VALUES
(1, 'Tomato Pizza', 7, 'It is made by Tomato', 'small', 'tomato.jpg'),
(2, 'Bacon Pizza', 6, 'It is made by Bacon', 'small', 'bacon.jpg'),
(3, 'Veggie Pizza', 5, 'It is made by Vegetable', 'small', 'veggie.png'),
(4, 'Meat Lovers Pizza', 9, 'It is made by multiple meat', 'small', 'meat.jpg'),
(5, 'Marinara Pizza', 8, 'It is made by seafood', 'small', 'marinara.jpg'),
(6, 'Margarita Pizza', 7, 'It is made by basil and cheese', 'small', 'margarita.jpg'),
(7, 'Pepperoni Pizza', 12, 'It is made with the best pepperoni.', 'Large', 'pepperoni.png'),
(8, 'French Fries', 3, 'Small French fires.', 'small', 'frenchfries.jpg'),
(9, 'French Fries', 5, 'Large French fries.', 'large', 'frenchfries.jpg'),
(10, 'Coke', 3, 'Small normal coke', 'small', 'coke.jpg'),
(11, 'Water Bottle', 5, 'Water prufied by Nestle', 'small', 'water.jpg'),
(12, 'Pepsi', 3, 'Small normal Pepsi', 'small', 'pepsi.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sub_order`
--

CREATE TABLE `sub_order` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `pizza_id` int(11) NOT NULL,
  `unit_price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_order`
--

INSERT INTO `sub_order` (`id`, `order_id`, `pizza_id`, `unit_price`) VALUES
(1, 1, 3, NULL),
(2, 1, 4, NULL),
(3, 2, 3, NULL),
(4, 2, 1, NULL),
(5, 3, 6, NULL),
(6, 4, 5, NULL),
(7, 5, 4, NULL),
(8, 5, 6, NULL),
(10, 9, 1, 7),
(11, 9, 2, 6),
(12, 9, 3, 5),
(13, 11, 2, 6),
(14, 11, 1, 7),
(15, 11, 3, 5),
(16, 12, 2, 6),
(17, 12, 8, 3),
(18, 12, 4, 9),
(19, 13, 1, 7),
(20, 13, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `type_user_id` int(11) NOT NULL,
  `user` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `full_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `type_user_id`, `user`, `password`, `full_name`) VALUES
(3, 4, 'admin', '123', 'Administrator App'),
(4, 5, 'cashier', '123', 'Cashier App');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `comments` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `type`, `comments`) VALUES
(4, 'Administrator', 'User admin to manage the app'),
(5, 'Employee', 'Cashier / waitress user to sell pizzas'),
(6, 'Customer', 'User to buy online in a future');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkey_client_id` (`client_id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_payment_type` (`payment_type`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pizza`
--
ALTER TABLE `pizza`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_order`
--
ALTER TABLE `sub_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkey_order_id` (`order_id`),
  ADD KEY `fkey_sub_pizza_id` (`pizza_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkey_type_user_id` (`type_user_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pizza`
--
ALTER TABLE `pizza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sub_order`
--
ALTER TABLE `sub_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_payment_type` FOREIGN KEY (`payment_type`) REFERENCES `payment_type` (`id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fkey_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `sub_order`
--
ALTER TABLE `sub_order`
  ADD CONSTRAINT `fkey_order_id` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `fkey_sub_pizza_id` FOREIGN KEY (`pizza_id`) REFERENCES `pizza` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fkey_type_user_id` FOREIGN KEY (`type_user_id`) REFERENCES `user_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
