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
-- Database: `bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_account`
--

CREATE TABLE IF NOT EXISTS `bank_account` (
  `account_number` bigint(20) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `credit_card_number` int(11) DEFAULT NULL,
  `phone_number` bigint(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `balance` double DEFAULT NULL,
  PRIMARY KEY (`account_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_account`
--

INSERT INTO `bank_account` (`account_number`, `first_name`, `last_name`, `credit_card_number`, `phone_number`, `email`, `balance`) VALUES
(10000212540000, 'Shipper', 'fee', 458310002, 946835560, 'shipment@gmail.com', 9020.99),
(10000212542125, 'Kaleab', 'kassahun', 458310001, 904587964, 'kaleab@gmail.com', 7035.5412),
(10000212545645, 'Abel', 'tefera', 458310000, 904587946, 'abel@gmail.com', -500700),
(10000212548080, 'Kaleb', 'Birru', 458310003, 975123468, 'kaleb@gmail.com', 9000),
(10000212549999, 'Shola', 'ECommerce', 458319999, 911010101, 'shola@gmail.com', 9011843.597196002);

-- --------------------------------------------------------

--
-- Table structure for table `credit_card`
--

CREATE TABLE IF NOT EXISTS `credit_card` (
  `credit_card_number` int(11) NOT NULL,
  `zip_code` int(11) DEFAULT NULL,
  `account_number` bigint(20) DEFAULT NULL,
  `security_code` varchar(400) DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  PRIMARY KEY (`credit_card_number`),
  KEY `account_number` (`account_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credit_card`
--

INSERT INTO `credit_card` (`credit_card_number`, `zip_code`, `account_number`, `security_code`, `expiration_date`) VALUES
(458310000, 4583, 10000212545645, 'test', '2018-01-01'),
(458310001, 4583, 10000212542125, 'test', '2018-01-01'),
(458310002, 4583, 10000212540000, 'test', '2018-01-01'),
(458310003, 4583, 10000212548080, 'test', '2018-01-01'),
(458319999, 4583, 10000212549999, 'test', '2018-01-01');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `credit_card`
--
ALTER TABLE `credit_card`
  ADD CONSTRAINT `credit_card_ibfk_1` FOREIGN KEY (`account_number`) REFERENCES `bank_account` (`account_number`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
