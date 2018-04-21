-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2017 at 01:27 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

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
  `end_date` date NOT NULL,
  PRIMARY KEY (`ad_id`),
  KEY `user_id` (`user_id`),
  KEY `item_id` (`item_id`)
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
  `receipt_number` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`receipt_number`),
  KEY `user_id` (`user_id`),
  KEY `advertisement_id` (`advertisement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `receipt_number` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`receipt_number`),
  KEY `user_id` (`user_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bid_report`
--

CREATE TABLE IF NOT EXISTS `bid_report` (
  `bid_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `bidder` varchar(60) NOT NULL,
  `bid_date_time` varchar(60) NOT NULL,
  `bid_amount` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`bid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `receipt_number` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`receipt_number`),
  KEY `user_id` (`user_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`,`category_name`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(1, 'Electronics'),
(3, 'Fashion'),
(8, 'Food'),
(6, 'Household Equipment'),
(7, 'Vehicles');

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
  `expire_date` date NOT NULL,
  PRIMARY KEY (`offer_id`),
  KEY `item_id` (`item_id`),
  KEY `free_item_id` (`free_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `credit_card_history`
--

CREATE TABLE IF NOT EXISTS `credit_card_history` (
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `credit_card_number` int(11) NOT NULL,
  `expiration_date` date DEFAULT NULL,
  PRIMARY KEY (`credit_card_number`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credit_card_history`
--

INSERT INTO `credit_card_history` (`user_id`, `user_name`, `credit_card_number`, `expiration_date`) VALUES
(6, 'abela', 458310000, '2018-01-01'),
(2, 'buyer', 458310001, '2018-01-01'),
(3, 'shipment', 458310002, '2018-01-01'),
(1, 'user_name', 458310003, '2018-01-01'),
(4, 'sholaStore', 458319999, '2018-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `currencyconvertertable`
--

CREATE TABLE IF NOT EXISTS `currencyconvertertable` (
  `country_name` varchar(50) NOT NULL,
  `rate` double NOT NULL,
  PRIMARY KEY (`country_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currencyconvertertable`
--

INSERT INTO `currencyconvertertable` (`country_name`, `rate`) VALUES
('ETB', 27.26),
('EUR', 0.84),
('GBP', 0.75),
('USD', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `birth_date` date NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone_number` (`phone_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`user_id`, `first_name`, `last_name`, `user_name`, `password`, `email`, `phone_number`, `country`, `city`, `birth_date`) VALUES
(1, 'Abel', 'Tefera', 'Abel', '098f6bcd4621d373cade4e832627b4f6', 'abelteferany@gmail.com', '938392729', 'Ethiopia', 'Addis Ababa', '2017-11-28'),
(2, 'Jhon', 'Belay', 'Jhon', '098f6bcd4621d373cade4e832627b4f6', 'John@gmail.com', '938928723', 'Ethiopia', 'Addis Ababa', '0000-00-00'),
(3, 'Kirubel', 'Teferi', 'Kirubel', '098f6bcd4621d373cade4e832627b4f6', 'Kirubel@gmail.com', '93873973', 'Ethiopia', 'Addis Ababa', '0000-00-00'),
(4, 'mikias', 'dude', 'Mikias', '098f6bcd4621d373cade4e832627b4f6', 'miki@gmail.com', '9383929829', 'Ethiopia', 'Addis', '2017-12-01'),
(5, 'Kal', 'dude', 'Kakidan', '098f6bcd4621d373cade4e832627b4f6', 'kal@gmail.com', '2382983298', 'Ethiopia', 'Addis', '2017-12-01'),
(6, 'Yonatan', 'dude', 'Yonatan', '098f6bcd4621d373cade4e832627b4f6', 'yon@gmail.com', '9839872987', 'Ethiopia', 'Addis', '2017-12-01'),
(7, 'Yonas', 'Hagos', 'a@b.com', '098f6bcd4621d373cade4e832627b4f6', 'a@b.com', '98739287', 'Ethiopia', 'Addis', '2017-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `debt`
--

CREATE TABLE IF NOT EXISTS `debt` (
  `debt_id` int(11) NOT NULL AUTO_INCREMENT,
  `interest_rate` double DEFAULT NULL,
  `item_name` varchar(50) DEFAULT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `remaining_debt` double DEFAULT NULL,
  PRIMARY KEY (`debt_id`),
  KEY `user_id` (`user_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `debt`
--

INSERT INTO `debt` (`debt_id`, `interest_rate`, `item_name`, `user_name`, `item_id`, `user_id`, `remaining_debt`) VALUES
(1, 0.1, 'Ferrari', 'Abel', 5, 1, 500),
(2, 0.1, 'burger', 'kaleb', 2, 2, 300);

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
  `a_datetime` varchar(25) NOT NULL DEFAULT '',
  KEY `a_id` (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE IF NOT EXISTS `forum` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `post_date` datetime DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  KEY `user_name` (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fquestions`
--

CREATE TABLE IF NOT EXISTS `fquestions` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `topic` varchar(255) NOT NULL DEFAULT '',
  `detail` longtext NOT NULL,
  `name` varchar(65) NOT NULL DEFAULT '',
  `email` varchar(65) NOT NULL DEFAULT '',
  `datetime` varchar(25) NOT NULL DEFAULT '',
  `view` int(4) NOT NULL DEFAULT '0',
  `reply` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fquestions`
--

INSERT INTO `fquestions` (`id`, `topic`, `detail`, `name`, `email`, `datetime`, `view`, `reply`) VALUES
(1, 'price increase', 'have u noticed?					', 'Abel Tefera', 'abelteferany@gmail.com', '28/11/17 05:14:06', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `hit_count` int(11) DEFAULT '0',
  PRIMARY KEY (`item_id`),
  KEY `uploader_id` (`uploader_id`),
  KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `description`, `quantity`, `model`, `color`, `category`, `post_date`, `contract_period`, `uploader_id`, `weight`, `price`, `old_price`, `split_pay`, `release_date`, `sell_count`, `hit_count`) VALUES
(1, 'Iphone X', 'new iphone', 15, 'Model X', 'Silver', 'Electronics', '2017-11-28', 365, 1, 0.05, 1000, NULL, 0, '2017-11-28', 3, 0),
(2, 'Nike Shoes', 'New Airmax shoes.', 10, 'Airmax', 'Blue', 'Fashion', '0000-00-00', 365, 2, 300, 150, 150, 0, '0000-00-00', 5, 0),
(3, 'Dishes', 'Dishes to serve food', 50, '-', 'silver', 'Household Equipment', '0000-00-00', 365, 3, 500, 25, 25, 0, '0000-00-00', 5, 0),
(4, 'Bugatti', 'In a new bugatti', 10, 'veron', 'burgendi', 'Vehicles', '2017-11-29', 365, 3, 500, 1500000, 1500000, 0, '2017-11-29', 5, 0),
(5, 'Ferrari', 'In a new Ferrari', 10, 'Ferari', 'Red', 'Vehicles', '2017-11-29', 365, 2, 500, 500000, 500000, 0, '2017-11-29', 1, 0);

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
  `dicounted_price` double NOT NULL,
  PRIMARY KEY (`discount_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_image`
--

CREATE TABLE IF NOT EXISTS `item_image` (
  `item_id` int(11) NOT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `main_image` tinyint(1) DEFAULT '0',
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_image`
--

INSERT INTO `item_image` (`item_id`, `image_url`, `main_image`) VALUES
(1, 'a.jpg', 1),
(2, 'b.jpg', 1),
(3, 'c.jpg', 1),
(4, 'd.jpg', 1),
(5, 'e.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `msg_notifs`
--

CREATE TABLE IF NOT EXISTS `msg_notifs` (
  `msg_notifs_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` varchar(11) NOT NULL,
  `msg_not_if` varchar(300) NOT NULL,
  `date_created` varchar(60) NOT NULL,
  PRIMARY KEY (`msg_notifs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `my_coupons`
--

CREATE TABLE IF NOT EXISTS `my_coupons` (
  `coupon_code` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  UNIQUE KEY `coupon_code` (`coupon_code`),
  KEY `user_id` (`user_id`),
  KEY `offer_id` (`offer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_notification_count`
--

CREATE TABLE IF NOT EXISTS `new_notification_count` (
  `user_id` int(11) NOT NULL,
  `new_notif_count` int(11) DEFAULT '0',
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `new_notification_count`
--

INSERT INTO `new_notification_count` (`user_id`, `new_notif_count`) VALUES
(1, 0),
(4, 0),
(5, 0),
(6, 0),
(7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `notif_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `notification` text,
  `notif_date` datetime DEFAULT NULL,
  PRIMARY KEY (`notif_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE IF NOT EXISTS `parents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(64) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL,
  `code` varchar(10) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `user`, `text`, `date`, `code`, `item_id`) VALUES
(1, 'Abel', 'It is a nice phone. I enjoyed it.', '2017-12-01 20:32:48', 'XJYLhZ', 1),
(25, 'Abel', 'How', '2017-12-03 01:53:37', 'mliHIg', 3),
(26, 'Abel', 'How', '2017-12-03 01:53:37', 'kvUhot', 3),
(27, 'Abel', 'Nice Iphone', '2017-12-03 02:14:59', '15pPpp', 1),
(28, 'Abel', 'nice', '2017-12-03 02:17:59', '0CHuQX', 2),
(29, 'Abel', 'nice color', '2017-12-03 02:22:10', 'vKiver', 5),
(30, 'Abel', 'Its really good', '2017-12-03 02:22:30', 'fim3sF', 5),
(31, 'a@b.com', 'sd', '2017-12-03 03:42:57', 'i3cXP2', 1),
(32, 'a@b.com', 'Hell', '2017-12-03 03:43:09', 'eGzuP3', 1),
(33, 'a@b.com', 'Hell', '2017-12-03 03:43:09', 'hQwlBJ', 1),
(34, 'a@b.com', 'asdf', '2017-12-03 03:44:52', 'J88gIa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_name` varchar(30) NOT NULL,
  `category_id` int(11) NOT NULL,
  `pro_description` varchar(300) NOT NULL,
  `starting_bid` int(11) NOT NULL,
  `prod_image` varchar(100) NOT NULL,
  `date_posted` date NOT NULL,
  `due_date` date NOT NULL,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE IF NOT EXISTS `product_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `cat_image` varchar(100) NOT NULL,
  `category_des` varchar(250) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `prod_id` (`prod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `receipt_number` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`receipt_number`),
  KEY `user_id` (`user_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `receipt_number` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`receipt_number`),
  KEY `user_id` (`user_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `tracking_number` int(11) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_distance`
--

CREATE TABLE IF NOT EXISTS `shipping_distance` (
  `subcity` varchar(20) NOT NULL,
  `distance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_distance`
--

INSERT INTO `shipping_distance` (`subcity`, `distance`) VALUES
('Kolfe', 32),
('Bole', 53),
('yeka', 20);

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
  `receipt_number` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`receipt_number`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE IF NOT EXISTS `shopping_cart` (
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT '0',
  KEY `user_id` (`user_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`user_id`, `item_id`, `quantity`) VALUES
(1, 2, 1),
(1, 3, 1),
(1, 4, 1),
(1, 1, 1),
(7, 1, 1);

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
  `receipt_number` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`receipt_number`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `store_reply`
--

CREATE TABLE IF NOT EXISTS `store_reply` (
  `post_id` int(11) DEFAULT NULL,
  `reply` text NOT NULL,
  `name_of_replier` varchar(40) NOT NULL,
  `reply_date` datetime DEFAULT NULL,
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE IF NOT EXISTS `user_data` (
  `user_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `score` double DEFAULT '0',
  `updated` datetime DEFAULT NULL,
  UNIQUE KEY `user_id` (`user_id`,`category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_preference`
--

CREATE TABLE IF NOT EXISTS `user_preference` (
  `user_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `score` double DEFAULT '0',
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
