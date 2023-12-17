-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2023 at 03:41 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `Address_ID` varchar(50) NOT NULL,
  `Address_Line_1` varchar(100) NOT NULL,
  `Address_Line_2` varchar(100) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` varchar(20) NOT NULL,
  `Postal_Code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`Address_ID`, `Address_Line_1`, `Address_Line_2`, `City`, `State`, `Postal_Code`) VALUES
('6T4uDteQ8h', '1', '1', 'Lap-Lapu City', 'Cebu', '6015');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_ID` int(50) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_ID`, `Name`) VALUES
(1, 'Clothes'),
(2, 'Shoes'),
(3, 'Jackets'),
(6, 'Cosmetics');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `Order_ID` int(50) NOT NULL,
  `User_ID` varchar(50) NOT NULL,
  `Payment_ID` int(50) NOT NULL DEFAULT 0,
  `User_Address` int(50) NOT NULL,
  `Order_Date` date NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `Order_Items_ID` int(50) NOT NULL,
  `User_ID` varchar(50) NOT NULL,
  `Product_ID` int(50) NOT NULL,
  `Total_Price` int(50) NOT NULL,
  `Quantity` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_ID` int(50) NOT NULL,
  `User_ID` varchar(50) NOT NULL,
  `Account_Number` int(12) NOT NULL,
  `Account_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_ID`, `User_ID`, `Account_Number`, `Account_Name`) VALUES
(12, 'test', 1234, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_ID` int(50) NOT NULL,
  `Category_ID` int(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Image` varchar(100) NOT NULL,
  `Price` int(50) NOT NULL,
  `Stocks_Available` int(50) NOT NULL,
  `SKU` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_ID`, `Category_ID`, `Name`, `Description`, `Image`, `Price`, `Stocks_Available`, `SKU`) VALUES
(1, 2, 'Adidas Superstar', 'Built for basketball, adopted by hip hop and skate, the classic leather Superstar changed the game.', 'adidas_superstar.avif', 55, 50, 2),
(2, 2, 'Adidas Campus 00s Shoes', 'These adidas shoes take the iconic elements of the Campus 80s and give them a next-gen, skateboarding-inspired twist. Known for its durability and the way it moulds to your foot over time, suede helps provide longevity and solid footing. New collegiate colourblocking, graphics and branding create a fresh identity for the next generation to own and style.\r\n\r\n', 'adidas_campus.avif', 100, 40, 2),
(3, 2, 'Grand Court TD Casual Shoes', 'It\'s time to build — or fill in the gaps — in your retro sneaker collection. Let\'s start with these Grand Court shoes. The designers have revisited every element, adding a sturdy cupsole that offers grip in the wettest weather. Of course, these shoes stay true to their adidas roots too. The smooth, synthetic leather upper lets everyone know you\'re Team 3-Stripes.\r\n\r\nMade with a series of recycled materials, this upper features at least 50% recycled content.\r\n\r\n', 'adidas_grandcourt.avif', 50, 50, 1),
(6, 1, 'ADICOLOR CLASSICS TREFOIL TEE\n', 'The Trefoil logo is steeped in sport and style history. But it\'s about more than that. It represents a fearless energy and a clan of creators striving to be their best at every step. Slip into the comfort of this adidas t-shirt and show it off. By buying cotton products from us, you\'re supporting more sustainable cotton farming.', 'shirt2.avif', 50, 19, 2),
(10, 1, 'test', 'test', 'shirt4.avif', 1, 1, 1),
(11, 1, 'Adidas Shirt 4', 'This is an adidas shirt', 'shirt3.avif', 110, 69, 2),
(15, 3, 'ADICOLOR TRACK JACKET', 'This is an adidas track jacket.', 'Adicolor_Classics_Firebird.avif', 120, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_config`
--

CREATE TABLE `product_config` (
  `Product_Config_ID` int(50) NOT NULL,
  `Product_ID` int(50) NOT NULL,
  `Variation_Option_ID` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_config`
--

INSERT INTO `product_config` (`Product_Config_ID`, `Product_ID`, `Variation_Option_ID`) VALUES
(1, 1, 2),
(2, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_variation`
--

CREATE TABLE `product_variation` (
  `Variation_ID` int(50) NOT NULL,
  `Category_ID` int(50) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_variation`
--

INSERT INTO `product_variation` (`Variation_ID`, `Category_ID`, `Name`) VALUES
(1, 1, 'Small'),
(2, 2, 'Small'),
(3, 1, 'Medium'),
(4, 2, 'Medium');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_ID` varchar(50) NOT NULL,
  `password` varchar(12) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Middle_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone_Number` bigint(12) NOT NULL,
  `usertype` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_ID`, `password`, `First_Name`, `Middle_Name`, `Last_Name`, `Email`, `Phone_Number`, `usertype`) VALUES
('account', 'account', 'account', 'account', 'account', 'account@hotmail.com', 1234, 0),
('admin', 'admin', 'admin', 'a', 'admin', 'admin@hotmail.com', 123, 1),
('test', 'test', 'Zeke', 'Dane', 'Meñoso', 'menosohezekiahdane@gmail.com', 9126480555, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `User_Address` int(50) NOT NULL,
  `User_ID` varchar(50) NOT NULL,
  `Address_ID` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`User_Address`, `User_ID`, `Address_ID`) VALUES
(1, '', 0),
(2, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `variation_option`
--

CREATE TABLE `variation_option` (
  `Variation_Option_ID` int(50) NOT NULL,
  `Variation_ID` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `variation_option`
--

INSERT INTO `variation_option` (`Variation_Option_ID`, `Variation_ID`) VALUES
(1, 1),
(2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`Address_ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_ID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`Order_ID`),
  ADD KEY `fk_order_product_id` (`Payment_ID`),
  ADD KEY `fk_user_id` (`User_ID`),
  ADD KEY `fk_user_address` (`User_Address`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`Order_Items_ID`),
  ADD KEY `fk_order_items_product_id` (`Product_ID`),
  ADD KEY `fk_order_items_cart_user_id` (`User_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_ID`),
  ADD KEY `fk_user_payment` (`User_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_ID`),
  ADD KEY `fk_category` (`Category_ID`);

--
-- Indexes for table `product_config`
--
ALTER TABLE `product_config`
  ADD PRIMARY KEY (`Product_Config_ID`),
  ADD KEY `fk_product` (`Product_ID`),
  ADD KEY `fk_variation_option` (`Variation_Option_ID`);

--
-- Indexes for table `product_variation`
--
ALTER TABLE `product_variation`
  ADD PRIMARY KEY (`Variation_ID`),
  ADD KEY `fk_category1` (`Category_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`User_Address`),
  ADD KEY `fk_user` (`User_ID`),
  ADD KEY `fk_address` (`Address_ID`);

--
-- Indexes for table `variation_option`
--
ALTER TABLE `variation_option`
  ADD PRIMARY KEY (`Variation_Option_ID`),
  ADD KEY `fk_variation` (`Variation_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `Order_ID` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `Order_Items_ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Product_ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product_config`
--
ALTER TABLE `product_config`
  MODIFY `Product_Config_ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `User_Address` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `variation_option`
--
ALTER TABLE `variation_option`
  MODIFY `Variation_Option_ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_product_id` FOREIGN KEY (`Payment_ID`) REFERENCES `product` (`Product_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_address` FOREIGN KEY (`User_Address`) REFERENCES `user_address` (`User_Address`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_order_items_cart_user_id` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_items_product_id` FOREIGN KEY (`Product_ID`) REFERENCES `product` (`Product_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_user_payment` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`Category_ID`) REFERENCES `category` (`Category_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_config`
--
ALTER TABLE `product_config`
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`Product_ID`) REFERENCES `product` (`Product_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_variation_option` FOREIGN KEY (`Variation_Option_ID`) REFERENCES `variation_option` (`Variation_Option_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_variation`
--
ALTER TABLE `product_variation`
  ADD CONSTRAINT `fk_category1` FOREIGN KEY (`Category_ID`) REFERENCES `category` (`Category_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `variation_option`
--
ALTER TABLE `variation_option`
  ADD CONSTRAINT `fk_variation` FOREIGN KEY (`Variation_ID`) REFERENCES `product_variation` (`Variation_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
