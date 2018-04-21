-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2017 at 08:44 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shola`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE IF NOT EXISTS `administrator` (
  `admin_name` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE IF NOT EXISTS `advertisement` (
  `ad_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `advertisement_price` double NOT NULL,
  `show_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `advertisement_receipt`
--

CREATE TABLE IF NOT EXISTS `advertisement_receipt` (
  `time_of_purchase` date DEFAULT NULL,
  `seller_name` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `advertisement_id` int(11) DEFAULT NULL,
  `advertisement_duration` int(11) DEFAULT NULL,
  `cost_per_hour` double DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `receipt_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auction_entrance_receipt`
--

CREATE TABLE IF NOT EXISTS `auction_entrance_receipt` (
  `item_id` int(11) DEFAULT NULL,
  `item_name` varchar(50) DEFAULT NULL,
  `time_of_purchase` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `buyer_name` varchar(50) DEFAULT NULL,
  `entrance_fee` double DEFAULT NULL,
  `receipt_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bid_report`
--

CREATE TABLE IF NOT EXISTS `bid_report` (
  `bid_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `bidder` varchar(60) NOT NULL,
  `bid_date_time` varchar(60) NOT NULL,
  `bid_amount` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `buyer_receipt`
--

CREATE TABLE IF NOT EXISTS `buyer_receipt` (
  `item_id` int(11) DEFAULT NULL,
  `item_name` varchar(50) DEFAULT NULL,
  `item_cost` double DEFAULT NULL,
  `item_quantity` int(11) DEFAULT NULL,
  `time_of_purchase` date DEFAULT NULL,
  `seller_name` varchar(50) DEFAULT NULL,
  `seller_address` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `buyer_name` varchar(50) DEFAULT NULL,
  `buyer_address` varchar(100) DEFAULT NULL,
  `shipment_arrival` date DEFAULT NULL,
  `tracking_number` bigint(20) DEFAULT NULL,
  `shipment_fee` double DEFAULT NULL,
  `spilt_pay` tinyint(1) DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `receipt_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(1, 'Auto'),
(5, 'Cars'),
(2, 'Cloth'),
(10, 'Computer accessory'),
(6, 'Laptops'),
(4, 'Machinery'),
(9, 'New-Fashion '),
(7, 'Phones'),
(3, 'Shoes'),
(8, 'Work Stations');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_create`
--

CREATE TABLE IF NOT EXISTS `coupon_create` (
  `offer_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_amount` int(11) NOT NULL,
  `free_item_id` int(11) NOT NULL,
  `free_item_amount` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `expire_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `credit_card_history`
--

CREATE TABLE IF NOT EXISTS `credit_card_history` (
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `credit_card_number` int(11) NOT NULL,
  `expiration_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `birth_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`user_id`, `first_name`, `last_name`, `user_name`, `password`, `email`, `phone_number`, `country`, `city`, `birth_date`) VALUES
(1, 'sat', 'lus', 'sat lus', 'atr/21@12', 'sat@gmail.com', '0921438765', 'Uganda', 'erd', '1980-12-05'),
(2, 'Belayneh', 'Mathewos', 'Belayneh Mathewos', '827ccb0eea8a706c4c34a16891f84e7b', 'belaynehm3@gmail.com', '0932198302', 'Ethiopia', 'Addis', '2017-11-26');

-- --------------------------------------------------------

--
-- Table structure for table `debt`
--

CREATE TABLE IF NOT EXISTS `debt` (
  `debt_id` int(11) NOT NULL,
  `interest_rate` double DEFAULT NULL,
  `item_name` varchar(50) DEFAULT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `remaining_debt` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fanswer`
--

CREATE TABLE IF NOT EXISTS `fanswer` (
  `question_id` int(4) NOT NULL DEFAULT '0',
  `a_id` int(4) NOT NULL DEFAULT '0',
  `a_name` varchar(65) NOT NULL DEFAULT '',
  `a_email` varchar(65) NOT NULL DEFAULT '',
  `a_answer` longtext NOT NULL,
  `a_datetime` varchar(25) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE IF NOT EXISTS `forum` (
  `post_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `post_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fquestions`
--

CREATE TABLE IF NOT EXISTS `fquestions` (
  `id` int(4) NOT NULL,
  `topic` varchar(255) NOT NULL DEFAULT '',
  `detail` longtext NOT NULL,
  `name` varchar(65) NOT NULL DEFAULT '',
  `email` varchar(65) NOT NULL DEFAULT '',
  `datetime` varchar(25) NOT NULL DEFAULT '',
  `view` int(4) NOT NULL DEFAULT '0',
  `reply` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `model` varchar(50) NOT NULL DEFAULT 'no model',
  `color` varchar(30) NOT NULL DEFAULT 'none',
  `category` varchar(50) NOT NULL,
  `post_date` date NOT NULL,
  `contract_period` int(11) NOT NULL,
  `uploader_id` int(11) NOT NULL,
  `weight` double DEFAULT NULL,
  `price` double NOT NULL,
  `old_price` double DEFAULT NULL,
  `split_pay` tinyint(1) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `sell_count` int(11) DEFAULT '0',
  `hit_count` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `description`, `quantity`, `model`, `color`, `category`, `post_date`, `contract_period`, `uploader_id`, `weight`, `price`, `old_price`, `split_pay`, `release_date`, `sell_count`, `hit_count`) VALUES
(7, 'cell phones', 'Sumsung smart Handy 4G', 50, 'no model', 'none', 'Phones', '2018-02-04', 60, 1, NULL, 20000, NULL, NULL, NULL, 0, 0),
(8, 'pc Toshiba', 'Smart pc with 750GB', 10, 'no model', 'none', 'Laptops', '2017-11-26', 60, 2, NULL, 50000, NULL, NULL, NULL, 0, 0),
(9, 'pc Toshiba', 'Smart pc with 750GB', 10, 'no model', 'none', 'Laptops', '2017-11-26', 60, 2, NULL, 50000, NULL, NULL, NULL, 0, 0),
(10, 'cell phones', 'Iphone smart Handy 4G', 40, 'no model', 'none', 'Phones', '2018-02-04', 60, 2, NULL, 30000, NULL, NULL, NULL, 0, 0),
(13, 'pc HP', 'smart Handy 650G', 40, 'no model', 'none', 'Laptops', '2018-02-04', 60, 2, NULL, 30000, NULL, NULL, NULL, 0, 0),
(15, 'pc Apple', 'smart Handy 650G', 40, 'no model', 'none', 'Laptops', '2018-02-04', 60, 1, NULL, 30000, NULL, NULL, NULL, 0, 0),
(16, 'Apple phone 88', 'hhua', 10, 'no model', 'none', 'Phones', '2017-11-26', 10, 2, NULL, 2000, NULL, NULL, NULL, 0, 0),
(17, 'Apple phone 22', 'hhua', 10, 'no model', 'none', 'Phones', '2017-11-26', 10, 2, NULL, 2000, NULL, NULL, NULL, 0, 0),
(18, 'Apple phone 20', 'hhua', 10, 'no model', 'none', 'Phones', '2017-11-26', 10, 2, NULL, 2000, NULL, NULL, NULL, 0, 0),
(19, 'shoe NIKE', 'sad', 100, 'no model', 'none', 'Shoes', '2017-11-26', 23, 2, NULL, 20000, NULL, NULL, NULL, 0, 0),
(20, 'shoe sma', 'suit', 100, 'no model', 'none', 'Shoes', '2017-11-26', 23, 2, NULL, 20000, NULL, NULL, NULL, 0, 0),
(21, 'shoe belay', 'suit', 100, 'no model', 'none', 'Shoes', '2017-11-26', 23, 2, NULL, 20000, NULL, NULL, NULL, 0, 0),
(22, 'edftghy', 'srdtfgyuh', 4567, 'no model', 'none', 'Laptops', '2017-11-26', 567, 2, NULL, 457, NULL, NULL, NULL, 0, 0),
(23, 'apple pc', 'weqqw', 100, 'no model', 'none', 'Laptops', '2017-11-26', 34, 2, NULL, 10000, NULL, NULL, NULL, 0, 0),
(24, 'Jacket', 'weeqq', 23, 'no model', 'none', 'Cloth', '2017-11-26', 23, 2, NULL, 2222, NULL, NULL, NULL, 0, 0),
(25, 'NotePade', 'swa', 21, 'no model', 'none', 'Auto', '2017-11-26', 23, 2, NULL, 111111111, NULL, NULL, NULL, 0, 0),
(26, 'women dress', 'dsadws', 11, 'no model', 'none', 'New-Fashion ', '2017-11-26', 11, 2, NULL, 10000, NULL, NULL, NULL, 0, 0),
(27, 'hard disck', 'qwe', 3, 'no model', 'none', 'Computer accessory', '2017-11-26', 30, 2, NULL, 10000, NULL, NULL, NULL, 0, 0),
(28, 'T-shirt', 'wesd', 6, 'no model', 'none', 'Cloth', '2017-11-27', 90, 2, NULL, 2000, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_discount`
--

CREATE TABLE IF NOT EXISTS `item_discount` (
  `discount_id` int(11) NOT NULL,
  `discount_code` varchar(20) NOT NULL,
  `discount_amount` double NOT NULL,
  `discount_type` varchar(20) NOT NULL,
  `create_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `item_id` int(11) NOT NULL,
  `dicounted_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_image`
--

CREATE TABLE IF NOT EXISTS `item_image` (
  `item_id` int(11) NOT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `main_image` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `msg_notifs`
--

CREATE TABLE IF NOT EXISTS `msg_notifs` (
  `msg_notifs_id` int(11) NOT NULL,
  `from_id` varchar(11) NOT NULL,
  `msg_not_if` varchar(300) NOT NULL,
  `date_created` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `my_coupons`
--

CREATE TABLE IF NOT EXISTS `my_coupons` (
  `coupon_code` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_notification_count`
--

CREATE TABLE IF NOT EXISTS `new_notification_count` (
  `user_id` int(11) NOT NULL,
  `new_notif_count` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `new_notification_count`
--

INSERT INTO `new_notification_count` (`user_id`, `new_notif_count`) VALUES
(2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `notif_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `notification` text,
  `notif_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL,
  `prod_name` varchar(30) NOT NULL,
  `category_id` int(11) NOT NULL,
  `pro_description` varchar(300) NOT NULL,
  `starting_bid` int(11) NOT NULL,
  `prod_image` varchar(100) NOT NULL,
  `date_posted` date NOT NULL,
  `due_date` date NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE IF NOT EXISTS `product_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `cat_image` varchar(100) NOT NULL,
  `category_des` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `item_id` int(11) NOT NULL,
  `asked_quesiton` text NOT NULL,
  `answer` text NOT NULL,
  `frequency` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seller_receipt`
--

CREATE TABLE IF NOT EXISTS `seller_receipt` (
  `item_id` int(11) DEFAULT NULL,
  `item_name` varchar(50) DEFAULT NULL,
  `item_cost` double DEFAULT NULL,
  `item_quantity` int(11) DEFAULT NULL,
  `time_of_purchase` date DEFAULT NULL,
  `seller_name` varchar(50) DEFAULT NULL,
  `seller_address` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `buyer_name` varchar(50) DEFAULT NULL,
  `buyer_address` varchar(100) DEFAULT NULL,
  `spilt_pay` tinyint(1) DEFAULT NULL,
  `receipt_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shipper_receipt`
--

CREATE TABLE IF NOT EXISTS `shipper_receipt` (
  `item_id` int(11) DEFAULT NULL,
  `item_name` varchar(50) DEFAULT NULL,
  `item_quantity` int(11) DEFAULT NULL,
  `time_of_purchase` date DEFAULT NULL,
  `seller_name` varchar(50) DEFAULT NULL,
  `seller_address` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `buyer_name` varchar(50) DEFAULT NULL,
  `buyer_address` varchar(100) DEFAULT NULL,
  `shipment_arrival` date DEFAULT NULL,
  `tracking_number` bigint(20) DEFAULT NULL,
  `shipment_fee` double DEFAULT NULL,
  `spilt_pay` tinyint(1) DEFAULT NULL,
  `receipt_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE IF NOT EXISTS `shipping` (
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `home_number` varchar(20) NOT NULL,
  `arrival_date` date NOT NULL,
  `date_of_purchase` date NOT NULL,
  `distance_from_store` int(11) NOT NULL,
  `shipping_price` double NOT NULL,
  `tracking_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_distance`
--

CREATE TABLE IF NOT EXISTS `shipping_distance` (
  `subcity` varchar(20) NOT NULL,
  `distance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shola_receipt`
--

CREATE TABLE IF NOT EXISTS `shola_receipt` (
  `item_id` int(11) DEFAULT NULL,
  `item_quantity` int(11) DEFAULT NULL,
  `time_of_purchase` date DEFAULT NULL,
  `seller_user_id` int(11) DEFAULT NULL,
  `buyer_user_id` int(11) DEFAULT NULL,
  `shipper_user_id` int(11) DEFAULT NULL,
  `tracking_number` bigint(20) DEFAULT NULL,
  `item_cost` double DEFAULT NULL,
  `shipment_fee` double DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `shola_cut` double DEFAULT NULL,
  `spilt_pay` tinyint(1) DEFAULT NULL,
  `receipt_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE IF NOT EXISTS `shopping_cart` (
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`user_id`, `item_id`, `quantity`) VALUES
(2, 24, 1),
(2, 9, 1),
(2, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `split_pay_receipt`
--

CREATE TABLE IF NOT EXISTS `split_pay_receipt` (
  `item_id` int(11) DEFAULT NULL,
  `item_name` varchar(50) DEFAULT NULL,
  `item_quantity` int(11) DEFAULT NULL,
  `time_of_purchase` date DEFAULT NULL,
  `seller_user_id` int(11) DEFAULT NULL,
  `seller_name` varchar(50) DEFAULT NULL,
  `shipper_user_id` int(11) DEFAULT NULL,
  `shipper_name` varchar(50) DEFAULT NULL,
  `buyer_user_id` int(11) DEFAULT NULL,
  `buyer_name` varchar(50) DEFAULT NULL,
  `current_debt` double DEFAULT NULL,
  `already_paid_seller` double DEFAULT NULL,
  `already_paid_shipper` double DEFAULT NULL,
  `already_paid_shola` double DEFAULT NULL,
  `interest_rate` double DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `receipt_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `store_reply`
--

CREATE TABLE IF NOT EXISTS `store_reply` (
  `post_id` int(11) DEFAULT NULL,
  `reply` text NOT NULL,
  `name_of_replier` varchar(40) NOT NULL,
  `reply_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE IF NOT EXISTS `user_data` (
  `user_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `score` double DEFAULT '0',
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_preference`
--

CREATE TABLE IF NOT EXISTS `user_preference` (
  `user_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `score` double DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD PRIMARY KEY (`ad_id`), ADD KEY `user_id` (`user_id`), ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `advertisement_receipt`
--
ALTER TABLE `advertisement_receipt`
  ADD PRIMARY KEY (`receipt_number`), ADD KEY `user_id` (`user_id`), ADD KEY `advertisement_id` (`advertisement_id`);

--
-- Indexes for table `auction_entrance_receipt`
--
ALTER TABLE `auction_entrance_receipt`
  ADD PRIMARY KEY (`receipt_number`), ADD KEY `user_id` (`user_id`), ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `bid_report`
--
ALTER TABLE `bid_report`
  ADD PRIMARY KEY (`bid_id`);

--
-- Indexes for table `buyer_receipt`
--
ALTER TABLE `buyer_receipt`
  ADD PRIMARY KEY (`receipt_number`), ADD KEY `user_id` (`user_id`), ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`,`category_name`), ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `coupon_create`
--
ALTER TABLE `coupon_create`
  ADD PRIMARY KEY (`offer_id`), ADD KEY `item_id` (`item_id`), ADD KEY `free_item_id` (`free_item_id`);

--
-- Indexes for table `credit_card_history`
--
ALTER TABLE `credit_card_history`
  ADD PRIMARY KEY (`credit_card_number`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `user_name` (`user_name`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `debt`
--
ALTER TABLE `debt`
  ADD PRIMARY KEY (`debt_id`), ADD KEY `user_id` (`user_id`), ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `fanswer`
--
ALTER TABLE `fanswer`
  ADD KEY `a_id` (`a_id`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`post_id`), ADD KEY `user_name` (`user_name`);

--
-- Indexes for table `fquestions`
--
ALTER TABLE `fquestions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`), ADD KEY `uploader_id` (`uploader_id`), ADD KEY `category` (`category`);

--
-- Indexes for table `item_discount`
--
ALTER TABLE `item_discount`
  ADD PRIMARY KEY (`discount_id`), ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `item_image`
--
ALTER TABLE `item_image`
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `msg_notifs`
--
ALTER TABLE `msg_notifs`
  ADD PRIMARY KEY (`msg_notifs_id`);

--
-- Indexes for table `my_coupons`
--
ALTER TABLE `my_coupons`
  ADD UNIQUE KEY `coupon_code` (`coupon_code`), ADD KEY `user_id` (`user_id`), ADD KEY `offer_id` (`offer_id`);

--
-- Indexes for table `new_notification_count`
--
ALTER TABLE `new_notification_count`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notif_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `seller_receipt`
--
ALTER TABLE `seller_receipt`
  ADD PRIMARY KEY (`receipt_number`), ADD KEY `user_id` (`user_id`), ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `shipper_receipt`
--
ALTER TABLE `shipper_receipt`
  ADD PRIMARY KEY (`receipt_number`), ADD KEY `user_id` (`user_id`), ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD KEY `user_id` (`user_id`), ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `shola_receipt`
--
ALTER TABLE `shola_receipt`
  ADD PRIMARY KEY (`receipt_number`), ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD KEY `user_id` (`user_id`), ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `split_pay_receipt`
--
ALTER TABLE `split_pay_receipt`
  ADD PRIMARY KEY (`receipt_number`), ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `store_reply`
--
ALTER TABLE `store_reply`
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD UNIQUE KEY `user_id` (`user_id`,`category`);

--
-- Indexes for table `user_preference`
--
ALTER TABLE `user_preference`
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisement_receipt`
--
ALTER TABLE `advertisement_receipt`
  MODIFY `receipt_number` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `auction_entrance_receipt`
--
ALTER TABLE `auction_entrance_receipt`
  MODIFY `receipt_number` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bid_report`
--
ALTER TABLE `bid_report`
  MODIFY `bid_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `buyer_receipt`
--
ALTER TABLE `buyer_receipt`
  MODIFY `receipt_number` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `debt`
--
ALTER TABLE `debt`
  MODIFY `debt_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fquestions`
--
ALTER TABLE `fquestions`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `msg_notifs`
--
ALTER TABLE `msg_notifs`
  MODIFY `msg_notifs_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `seller_receipt`
--
ALTER TABLE `seller_receipt`
  MODIFY `receipt_number` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shipper_receipt`
--
ALTER TABLE `shipper_receipt`
  MODIFY `receipt_number` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shola_receipt`
--
ALTER TABLE `shola_receipt`
  MODIFY `receipt_number` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `split_pay_receipt`
--
ALTER TABLE `split_pay_receipt`
  MODIFY `receipt_number` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertisement`
--
ALTER TABLE `advertisement`
ADD CONSTRAINT `advertisement_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `advertisement_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `advertisement_receipt`
--
ALTER TABLE `advertisement_receipt`
ADD CONSTRAINT `advertisement_receipt_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `advertisement_receipt_ibfk_2` FOREIGN KEY (`advertisement_id`) REFERENCES `advertisement` (`ad_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auction_entrance_receipt`
--
ALTER TABLE `auction_entrance_receipt`
ADD CONSTRAINT `auction_entrance_receipt_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `auction_entrance_receipt_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `buyer_receipt`
--
ALTER TABLE `buyer_receipt`
ADD CONSTRAINT `buyer_receipt_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `buyer_receipt_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `coupon_create`
--
ALTER TABLE `coupon_create`
ADD CONSTRAINT `coupon_create_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `coupon_create_ibfk_2` FOREIGN KEY (`free_item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `credit_card_history`
--
ALTER TABLE `credit_card_history`
ADD CONSTRAINT `credit_card_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `debt`
--
ALTER TABLE `debt`
ADD CONSTRAINT `debt_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `debt_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `forum`
--
ALTER TABLE `forum`
ADD CONSTRAINT `forum_ibfk_1` FOREIGN KEY (`user_name`) REFERENCES `customer` (`user_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`uploader_id`) REFERENCES `customer` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`category`) REFERENCES `category` (`category_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_discount`
--
ALTER TABLE `item_discount`
ADD CONSTRAINT `item_discount_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_image`
--
ALTER TABLE `item_image`
ADD CONSTRAINT `item_image_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `my_coupons`
--
ALTER TABLE `my_coupons`
ADD CONSTRAINT `my_coupons_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`),
ADD CONSTRAINT `my_coupons_ibfk_2` FOREIGN KEY (`offer_id`) REFERENCES `coupon_create` (`offer_id`);

--
-- Constraints for table `new_notification_count`
--
ALTER TABLE `new_notification_count`
ADD CONSTRAINT `new_notification_count_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seller_receipt`
--
ALTER TABLE `seller_receipt`
ADD CONSTRAINT `seller_receipt_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `seller_receipt_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shipper_receipt`
--
ALTER TABLE `shipper_receipt`
ADD CONSTRAINT `shipper_receipt_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `shipper_receipt_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shipping`
--
ALTER TABLE `shipping`
ADD CONSTRAINT `shipping_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `shipping_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shola_receipt`
--
ALTER TABLE `shola_receipt`
ADD CONSTRAINT `shola_receipt_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`),
ADD CONSTRAINT `shopping_cart_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`);

--
-- Constraints for table `split_pay_receipt`
--
ALTER TABLE `split_pay_receipt`
ADD CONSTRAINT `split_pay_receipt_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `store_reply`
--
ALTER TABLE `store_reply`
ADD CONSTRAINT `store_reply_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `forum` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_data`
--
ALTER TABLE `user_data`
ADD CONSTRAINT `user_data_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_preference`
--
ALTER TABLE `user_preference`
ADD CONSTRAINT `user_preference_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
