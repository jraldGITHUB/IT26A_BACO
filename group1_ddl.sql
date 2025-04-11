-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2025 at 04:03 AM
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
-- Database: `group1_ddl`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(20) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `customer_id` int(20) NOT NULL,
  `customer` varchar(50) DEFAULT NULL,
  `order_date` date NOT NULL,
  `shipped_date` date NOT NULL,
  `shipper_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orderdetail`
--

CREATE TABLE `tbl_orderdetail` (
  `orderDetail_id` int(50) NOT NULL,
  `quantity` int(50) NOT NULL,
  `unit_price` decimal(10,10) NOT NULL,
  `discount` decimal(10,10) DEFAULT NULL,
  `status_id` int(50) DEFAULT NULL,
  `order_id` int(20) NOT NULL,
  `product_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(50) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `standard_cost` decimal(10,2) NOT NULL,
  `list_price` decimal(10,2) NOT NULL,
  `reorder_level` int(50) NOT NULL,
  `target_level` int(50) DEFAULT NULL,
  `quantity_per_unit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_orderdetail`
--
ALTER TABLE `tbl_orderdetail`
  ADD PRIMARY KEY (`orderDetail_id`),
  ADD KEY `fk1` (`order_id`),
  ADD KEY `fk2` (`product_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_orderdetail`
--
ALTER TABLE `tbl_orderdetail`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`order_id`) REFERENCES `tbl_order` (`order_id`),
  ADD CONSTRAINT `fk2` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
