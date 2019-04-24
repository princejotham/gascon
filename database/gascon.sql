-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2018 at 12:45 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gascon`
--

-- --------------------------------------------------------

--
-- Table structure for table `bottle`
--

CREATE TABLE `bottle` (
  `id` int(11) NOT NULL,
  `bottle_name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bottle`
--

INSERT INTO `bottle` (`id`, `bottle_name`, `price`) VALUES
(1, 'Water Jag', '40'),
(2, 'Container', '30');

-- --------------------------------------------------------

--
-- Table structure for table `bottle_sales`
--

CREATE TABLE `bottle_sales` (
  `id` int(11) NOT NULL,
  `stock_id` int(11) DEFAULT NULL,
  `b_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `tran_id` int(11) NOT NULL,
  `sales_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `refill` int(11) NOT NULL,
  `return_bot` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bottle_sales`
--

INSERT INTO `bottle_sales` (`id`, `stock_id`, `b_name`, `price`, `sub_total`, `qty`, `tran_id`, `sales_date`, `refill`, `return_bot`) VALUES
(1, 1, 'Water Jag', 40, '40', 1, 1, '2018-09-11 15:21:17', 0, 0),
(2, 2, 'Water Jag', 40, '40', 1, 1, '2018-09-11 15:21:18', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `i_code` varchar(255) NOT NULL,
  `i_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart_bottle`
--

CREATE TABLE `cart_bottle` (
  `c_id` int(11) NOT NULL,
  `b_name` varchar(255) NOT NULL,
  `b_no` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `refill` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Grocery'),
(2, 'Medicine');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `c_name`, `c_address`) VALUES
(1, 'John Doe', 'New York');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `expense` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `e_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense`, `price`, `e_date`) VALUES
(1, 'Transportion', '50', '2018-09-11 15:20:39');

-- --------------------------------------------------------

--
-- Table structure for table `expire`
--

CREATE TABLE `expire` (
  `ex_id` int(11) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_man` varchar(255) NOT NULL,
  `item_pur` varchar(255) NOT NULL,
  `item_ex` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `sell_price` varchar(255) NOT NULL,
  `buy_price` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `item_name`, `type`, `sell_price`, `buy_price`, `category_id`) VALUES
(1, 'Paracetamol', 'Tablet', '10', '5', 2),
(2, 'Mefenamic', 'Tablet', '20', '10', 2);

-- --------------------------------------------------------

--
-- Table structure for table `item_sales`
--

CREATE TABLE `item_sales` (
  `id` int(11) NOT NULL,
  `item_code` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `sales_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tran_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_sales`
--

INSERT INTO `item_sales` (`id`, `item_code`, `item_name`, `price`, `qty`, `sub_total`, `sales_date`, `tran_id`) VALUES
(1, 1, 'Paracetamol', 5, 3, 15, '2018-12-11 08:54:33', 2),
(2, 2, 'Mefenamic', 10, 1, 10, '2018-12-11 09:17:06', 3),
(3, 2, 'Mefenamic', 10, 1, 10, '2018-12-11 10:23:52', 4),
(4, 2, 'Mefenamic', 10, 1, 10, '2018-12-11 10:27:48', 5),
(5, 2, 'Mefenamic', 10, 1, 10, '2018-12-11 11:16:30', 6),
(6, 2, 'Mefenamic', 10, 1, 10, '2018-12-11 11:17:34', 6),
(7, 2, 'Mefenamic', 10, 2, 20, '2018-12-11 11:18:57', 7),
(8, 2, 'Mefenamic', 10, 1, 10, '2018-12-11 11:37:14', 8),
(9, 2, 'Mefenamic', 10, 1, 10, '2018-12-11 11:37:51', 9);

-- --------------------------------------------------------

--
-- Table structure for table `sales_trans`
--

CREATE TABLE `sales_trans` (
  `id` int(11) NOT NULL,
  `trans_no` varchar(255) NOT NULL,
  `date_tran` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cus_id` int(11) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `tendered` varchar(255) NOT NULL,
  `amountchange` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_trans`
--

INSERT INTO `sales_trans` (`id`, `trans_no`, `date_tran`, `cus_id`, `grand_total`, `tendered`, `amountchange`) VALUES
(1, '1', '2018-09-11 15:21:18', 1, '', '', ''),
(2, '2', '2018-12-11 08:54:33', 0, '', '', ''),
(3, '3', '2018-12-11 09:17:06', 0, '', '', ''),
(4, '4', '2018-12-11 10:23:52', 0, '', '', ''),
(5, '5', '2018-12-11 10:27:48', 0, '', '', ''),
(6, '6', '2018-12-11 11:17:34', 0, '10.00', '50.00', '40.00'),
(7, '7', '2018-12-11 11:18:57', 0, '20.00', '50.00', '30.00'),
(8, '8', '2018-12-11 11:37:14', 0, '10.00', '100.00', '90.00'),
(9, '9', '2018-12-11 11:37:51', 0, '10.00', '10.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `stock_bottle`
--

CREATE TABLE `stock_bottle` (
  `s_id` int(11) NOT NULL,
  `bottle_qty` int(11) NOT NULL,
  `bottle_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_bottle`
--

INSERT INTO `stock_bottle` (`s_id`, `bottle_qty`, `bottle_id`) VALUES
(1, 0, 1),
(2, 0, 1),
(3, 1, 1),
(4, 1, 1),
(5, 1, 1),
(6, 1, 2),
(7, 1, 2),
(8, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `stock_item`
--

CREATE TABLE `stock_item` (
  `id` int(11) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_man` varchar(255) NOT NULL,
  `item_pur` varchar(255) NOT NULL,
  `item_ex` varchar(255) NOT NULL,
  `sell_price` varchar(255) NOT NULL,
  `buy_price` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_item`
--

INSERT INTO `stock_item` (`id`, `item_qty`, `item_man`, `item_pur`, `item_ex`, `sell_price`, `buy_price`, `item_id`) VALUES
(1, 2, '2018-11-15', '2018-11-15', '2019-11-15', '10', '5', 1),
(2, 20, '2018-11-15', '2018-11-15', '2019-11-15', '20', '10', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_type`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'pharmacy', 'bf4e28785ab0560951dd0766f8059c4a', 2),
(3, 'water', '9460370bb0ca1c98a779b1bcc6861c2c', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bottle`
--
ALTER TABLE `bottle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bottle_sales`
--
ALTER TABLE `bottle_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_bottle`
--
ALTER TABLE `cart_bottle`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expire`
--
ALTER TABLE `expire`
  ADD PRIMARY KEY (`ex_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_sales`
--
ALTER TABLE `item_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_trans`
--
ALTER TABLE `sales_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_bottle`
--
ALTER TABLE `stock_bottle`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `stock_item`
--
ALTER TABLE `stock_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bottle`
--
ALTER TABLE `bottle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bottle_sales`
--
ALTER TABLE `bottle_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cart_bottle`
--
ALTER TABLE `cart_bottle`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expire`
--
ALTER TABLE `expire`
  MODIFY `ex_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_sales`
--
ALTER TABLE `item_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sales_trans`
--
ALTER TABLE `sales_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stock_bottle`
--
ALTER TABLE `stock_bottle`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stock_item`
--
ALTER TABLE `stock_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
