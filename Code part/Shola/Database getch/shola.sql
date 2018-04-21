-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2017 at 09:19 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shola`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `AdminName` varchar(20) NOT NULL,
  `AdminID` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  PRIMARY KEY (`AdminID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminName`, `AdminID`, `Password`) VALUES
('Kelem Negasi', 'ATR/4534/07', 'work hard play hard');

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

DROP TABLE IF EXISTS `advertisement`;
CREATE TABLE IF NOT EXISTS `advertisement` (
  `UserID` varchar(20) NOT NULL,
  `ItemID` varchar(20) NOT NULL,
  `Advertisementprice` double NOT NULL,
  `Showdate` date NOT NULL,
  `Enddate` date NOT NULL,
  KEY `UserID` (`UserID`),
  KEY `ItemID` (`ItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advertisement`
--

INSERT INTO `advertisement` (`UserID`, `ItemID`, `Advertisementprice`, `Showdate`, `Enddate`) VALUES
('ATR/1451/07', 'TL8', 3000, '2017-11-22', '2017-12-13'),
('ATR/4072/07', 'ANV', 10000, '2017-11-16', '2017-12-16'),
('ATR/4488/07', 'GC8', 3000, '2017-11-16', '2017-11-30'),
('ATR/4072/07', 'MCBT', 5000, '2017-11-16', '2017-11-30'),
('atr/4884/07', 'FBS', 2300, '2017-11-07', '2017-12-13');

-- --------------------------------------------------------

--
-- Table structure for table `auctionbid`
--

DROP TABLE IF EXISTS `auctionbid`;
CREATE TABLE IF NOT EXISTS `auctionbid` (
  `UserID` varchar(20) NOT NULL,
  `ItemID` varchar(20) NOT NULL,
  `Placedbidprice` double NOT NULL,
  `Currentbiddate` date NOT NULL,
  KEY `UserID` (`UserID`),
  KEY `ItemID` (`ItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auctionbid`
--

INSERT INTO `auctionbid` (`UserID`, `ItemID`, `Placedbidprice`, `Currentbiddate`) VALUES
('ATR/1451/07', 'AHE', 250000, '2017-11-22'),
('atr/4884/07', 'TL8', 6000, '2017-11-21'),
('ATR/8941/07', 'MCOC', 700, '2017-11-23'),
('atr/4884/07', 'OEAM', 300, '2017-11-28'),
('atr/4884/07', 'GC8', 10000, '2017-11-20');

-- --------------------------------------------------------

--
-- Table structure for table `auctionitem`
--

DROP TABLE IF EXISTS `auctionitem`;
CREATE TABLE IF NOT EXISTS `auctionitem` (
  `ItemID` varchar(20) NOT NULL,
  `Startingprice` double NOT NULL,
  `Openingdate` date NOT NULL,
  `Closingdate` date NOT NULL,
  PRIMARY KEY (`ItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auctionitem`
--

INSERT INTO `auctionitem` (`ItemID`, `Startingprice`, `Openingdate`, `Closingdate`) VALUES
('AHE', 200000, '2017-11-15', '2017-11-30'),
('GC8', 7000, '2017-11-15', '2017-12-06'),
('MCOC', 300, '2017-11-08', '2017-11-30'),
('OEAM', 100, '2017-11-30', '2017-12-20'),
('TL8', 5000, '2017-11-15', '2017-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(25) NOT NULL,
  PRIMARY KEY (`id`,`categoryName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

DROP TABLE IF EXISTS `coupon`;
CREATE TABLE IF NOT EXISTS `coupon` (
  `CouponID` varchar(20) NOT NULL,
  `Couponcode` int(11) NOT NULL,
  `DiscountID` varchar(20) NOT NULL,
  `Discountrate` double NOT NULL,
  `Discountstatus` varchar(20) NOT NULL,
  `DiscountStartDATE` date NOT NULL,
  `Discountexpiry` date NOT NULL,
  PRIMARY KEY (`CouponID`),
  KEY `DiscountID` (`DiscountID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `currencyexchage`
--

DROP TABLE IF EXISTS `currencyexchage`;
CREATE TABLE IF NOT EXISTS `currencyexchage` (
  `Currencyname` varchar(20) NOT NULL,
  `Country` varchar(20) NOT NULL,
  `RateofexchageinBirr` double NOT NULL,
  PRIMARY KEY (`Currencyname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currencyexchage`
--

INSERT INTO `currencyexchage` (`Currencyname`, `Country`, `RateofexchageinBirr`) VALUES
('Dollar', 'USA', 27.66),
('Euro', 'EU', 36.01),
('Pound', 'Britain', 34.55);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `UserID` varchar(20) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `Country` varchar(20) NOT NULL,
  `City` varchar(20) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`UserID`, `FirstName`, `LastName`, `Password`, `Email`, `PhoneNumber`, `Country`, `City`) VALUES
('ATR/1451/07', 'Getamesay ', 'Kassahun', '2345', 'geta3646@gmail.com', '', 'Etiopia', 'Addis Ababa'),
('ATR/2738/07', 'kidanemaryam', 'Tesfaye', '1234', 'kidanemaryamtesfaye@gmail.com', '0948133731', 'Etiopia', 'Addis Ababa'),
('ATR/3398/07', 'Birhane ', 'giday', '5678', 'brhane5giday@gmail.com', '', 'Etiopia', 'Addis Ababa'),
('ATR/3819/07', 'Bisrat', 'Tegegn', '4567', 'bisrattegegn8@gmail.', '', 'Etiopia', 'Addis Ababa'),
('ATR/4072/07', 'Samuel ', 'Negash', '1011', 'samuelnegash56@gmail.com', '', 'Etiopia', 'Addis Ababa'),
('ATR/4488/07', 'Getnet ', 'Endaylalu', '6789', 'getendye@gmail.com', '', 'Etiopia', 'Addis Ababa'),
('atr/4884/07', 'Luel', 'Tesfa', '8910', 'leultsfg7@gmail.com', '', 'Etiopia', 'Addis Ababa'),
('ATR/6466/07', 'Meles', 'Kidane', '9101', 'meleskidaneamare84@gmail.com', '', 'Etiopia', 'Addis Ababa'),
('ATR/8201/07', 'Latera', 'Tesfaye', '7891', 'latera.tesfaye@yahoo.com', '', 'Etiopia', 'Addis Ababa'),
('ATR/8941/07', 'Atnatiyos ', 'Tefera', '3456', 'atnatiyostefera999@g', '', 'Etiopia', 'Addis Ababa');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

DROP TABLE IF EXISTS `discount`;
CREATE TABLE IF NOT EXISTS `discount` (
  `DiscountID` varchar(20) NOT NULL,
  `ItemID` varchar(20) NOT NULL,
  `DiscountRate` double NOT NULL,
  `Startdate` date NOT NULL,
  `Discountexpirydate` date NOT NULL,
  `Discountedcost` double NOT NULL,
  `Discountstatus` varchar(20) NOT NULL,
  PRIMARY KEY (`DiscountID`),
  KEY `ItemID` (`ItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

DROP TABLE IF EXISTS `forum`;
CREATE TABLE IF NOT EXISTS `forum` (
  `UserID` varchar(20) NOT NULL,
  `PostedID` varchar(20) NOT NULL,
  `Massage` varchar(20) NOT NULL,
  `Posteddate` date NOT NULL,
  `Reply` varchar(20) NOT NULL,
  PRIMARY KEY (`PostedID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `itemreviwes`
--

DROP TABLE IF EXISTS `itemreviwes`;
CREATE TABLE IF NOT EXISTS `itemreviwes` (
  `UserID` varchar(20) NOT NULL,
  `ItemID` varchar(20) NOT NULL,
  `Rating` varchar(20) NOT NULL,
  `Reviwes` varchar(20) NOT NULL,
  `Reviwesdate` date NOT NULL,
  KEY `UserID` (`UserID`),
  KEY `ItemID` (`ItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemreviwes`
--

INSERT INTO `itemreviwes` (`UserID`, `ItemID`, `Rating`, `Reviwes`, `Reviwesdate`) VALUES
('ATR/1451/07', 'AHE', '*****', 'very good', '2017-11-14'),
('ATR/2738/07', 'FBC', '***', 'good', '2017-11-16'),
('ATR/3398/07', 'ANV', '****', 'very good', '2017-11-16'),
('ATR/3819/07', 'FBC', '**', 'not good', '2017-11-23'),
('ATR/6466/07', 'TL8', '*****', 'very good', '2017-11-21');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `ItemID` varchar(20) NOT NULL,
  `Itemname` varchar(20) NOT NULL,
  `Model` varchar(20) NOT NULL,
  `Color` varchar(20) NOT NULL,
  `Category` varchar(20) NOT NULL,
  `ItemImage` blob,
  `Dateofarrival` date NOT NULL,
  `ExpirationDate` date NOT NULL,
  `Weight` double NOT NULL,
  `NewPrice` double NOT NULL,
  `OldPrice` double NOT NULL,
  `SplitPay` tinyint(1) NOT NULL,
  PRIMARY KEY (`ItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ItemID`, `Itemname`, `Model`, `Color`, `Category`, `ItemImage`, `Dateofarrival`, `ExpirationDate`, `Weight`, `NewPrice`, `OldPrice`, `SplitPay`) VALUES
('AHE', 'Hyundai Elantra', 'Elantra', 'black', 'Automotives', NULL, '2017-11-08', '0000-00-00', 0, 800000, 0, 0),
('ANV', 'Nisan versa', 'versa', 'Black', 'Automotives', NULL, '2017-11-08', '0000-00-00', 0, 500000, 0, 0),
('ATY', 'Tyota yaris', 'yaris', 'white', 'Automotives', NULL, '2017-11-15', '0000-00-00', 0, 200000, 0, 0),
('FBC', 'Beach chair', '', '', 'Furniturs', NULL, '2017-11-08', '0000-00-00', 0, 1000, 0, 0),
('FBS', 'Bar stool', '', '', 'Furniturs', NULL, '2017-11-08', '0000-00-00', 0, 400, 0, 0),
('GC8', 'samsung Galaxy C8', 'galaxy C8', 'black', 'cell phones', NULL, '2017-11-05', '2019-12-11', 0, 10000, 0, 0),
('GN8', 'Samsung galaxy note ', 'note 8', 'black', 'cell phones', NULL, '2017-11-14', '2020-02-12', 0, 13000, 0, 0),
('MCBT', 'bow tie', 'Men cloth', 'white', 'Fashion', NULL, '2017-11-06', '0000-00-00', 0, 100, 0, 0),
('MCOC', 'Over Coat', 'Men Cloth', 'black', 'Fashion', NULL, '2017-11-07', '0000-00-00', 0, 500, 0, 0),
('MCSC', 'Suit Coat', 'Men cloth', 'blue', 'Fashion', NULL, '2017-11-22', '0000-00-00', 0, 1500, 0, 0),
('OEAM', 'Adding machine', '', '', 'Office Equipment', NULL, '2017-11-07', '0000-00-00', 0, 120, 0, 0),
('OEDP', 'desk pad', '', '', 'Office Equipment', NULL, '2017-11-07', '0000-00-00', 0, 400, 0, 0),
('TCCX-AIR', 'Tchno camon cx air', 'camon cx air', 'black', 'cellphones', NULL, '2017-11-19', '2019-11-19', 0, 4000, 0, 0),
('TL8', 'Techno L8', 'L8', 'white', 'cell phones', NULL, '2017-11-14', '2020-12-16', 0, 6000, 0, 0),
('TW5-LITE', 'Techno W5 Lite', 'W5 LITE', 'black', 'cell phones', NULL, '2017-11-07', '2019-04-25', 0, 7000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

DROP TABLE IF EXISTS `orderdetail`;
CREATE TABLE IF NOT EXISTS `orderdetail` (
  `UserID` varchar(20) NOT NULL,
  `ItemID` varchar(20) NOT NULL,
  `OrderID` varchar(20) NOT NULL,
  `Recivername` varchar(20) NOT NULL,
  `Dateofpurchse` date NOT NULL,
  `Homenumber` varchar(20) NOT NULL,
  PRIMARY KEY (`OrderID`),
  KEY `UserID` (`UserID`),
  KEY `ItemID` (`ItemID`),
  KEY `Homenumber` (`Homenumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`UserID`, `ItemID`, `OrderID`, `Recivername`, `Dateofpurchse`, `Homenumber`) VALUES
('ATR/1451/07', 'AHE', '1000', 'kelem', '2017-11-15', '11-12-134'),
('ATR/2738/07', 'ANV', '1001', 'kidane', '2017-11-16', '11-14-156'),
('ATR/3398/07', 'ATY', '1002', 'meles', '2017-11-17', '12-14-156'),
('ATR/3819/07', 'FBC', '1003', 'luel', '2017-11-19', '12-15-167'),
('ATR/4072/07', 'OEAM', '1004', 'kelem', '2017-11-23', '12-13145');

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

DROP TABLE IF EXISTS `place`;
CREATE TABLE IF NOT EXISTS `place` (
  `Homenumber` varchar(20) NOT NULL,
  `Kebele` varchar(20) NOT NULL,
  `Wereda` varchar(20) NOT NULL,
  `Subcity` varchar(20) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Distancefromstore` double NOT NULL,
  PRIMARY KEY (`Homenumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `place`
--

INSERT INTO `place` (`Homenumber`, `Kebele`, `Wereda`, `Subcity`, `City`, `Distancefromstore`) VALUES
('11-12-134', '04', '', 'adis-ketema', 'Addis Ababa', 8),
('11-14-156', '05', '', 'kality', 'Addis Ababa', 15),
('12-13145', '01', '', 'kirkos', 'Addis Ababa', 6),
('12-14-156', '02', '', 'arada', 'Addis Ababa', 5),
('12-15-167', '03', '', 'bole', 'Addis Ababa', 9);

-- --------------------------------------------------------

--
-- Table structure for table `purchasehistory`
--

DROP TABLE IF EXISTS `purchasehistory`;
CREATE TABLE IF NOT EXISTS `purchasehistory` (
  `UserID` varchar(20) NOT NULL,
  `ItemID` varchar(20) NOT NULL,
  `Dateofpurchse` date NOT NULL,
  `OrderID` varchar(20) NOT NULL,
  `Quatity` int(11) NOT NULL,
  `Price` double NOT NULL,
  PRIMARY KEY (`UserID`,`ItemID`),
  KEY `ItemID` (`ItemID`),
  KEY `OrderID` (`OrderID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchasehistory`
--

INSERT INTO `purchasehistory` (`UserID`, `ItemID`, `Dateofpurchse`, `OrderID`, `Quatity`, `Price`) VALUES
('ATR/1451/07', 'AHE', '2017-11-14', '1000', 1, 200000),
('ATR/2738/07', 'ANV', '2017-11-23', '1001', 1, 500000),
('ATR/3398/07', 'ATY', '2017-11-22', '1003', 2, 1000000),
('ATR/3819/07', 'GN8', '2017-11-22', '1002', 1, 8000),
('atr/4884/07', 'MCOC', '2017-11-23', '1004', 3, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `UserID` varchar(20) NOT NULL,
  `Askedquestion` varchar(20) NOT NULL,
  `Answer` varchar(20) NOT NULL,
  `Quatity` int(11) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

DROP TABLE IF EXISTS `receipt`;
CREATE TABLE IF NOT EXISTS `receipt` (
  `UserID` varchar(20) NOT NULL,
  `ItemID` varchar(20) NOT NULL,
  `Quatity` int(11) NOT NULL,
  `Totalprice` double NOT NULL,
  `Dateofpurchse` date NOT NULL,
  `Sholacut` double NOT NULL,
  KEY `UserID` (`UserID`),
  KEY `ItemID` (`ItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`UserID`, `ItemID`, `Quatity`, `Totalprice`, `Dateofpurchse`, `Sholacut`) VALUES
('ATR/2738/07', 'GN8', 1, 8000, '2017-11-22', 500),
('ATR/1451/07', 'AHE', 1, 200000, '2017-11-15', 1000),
('ATR/3819/07', 'MCSC', 4, 6000, '2017-11-22', 500),
('ATR/4488/07', 'ANV', 1, 500000, '2017-11-22', 10000),
('ATR/8941/07', 'TL8', 1, 5000, '2017-11-21', 500);

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

DROP TABLE IF EXISTS `shipping`;
CREATE TABLE IF NOT EXISTS `shipping` (
  `UserID` varchar(20) NOT NULL,
  `ItemID` varchar(20) NOT NULL,
  `Homenumber` varchar(20) NOT NULL,
  `Arrivaldate` date NOT NULL,
  `Dateofpurchse` date NOT NULL,
  `Shippingprice` double NOT NULL,
  `Trackingnumber` int(11) NOT NULL,
  KEY `UserID` (`UserID`),
  KEY `ItemID` (`ItemID`),
  KEY `Homenumber` (`Homenumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`UserID`, `ItemID`, `Homenumber`, `Arrivaldate`, `Dateofpurchse`, `Shippingprice`, `Trackingnumber`) VALUES
('ATR/1451/07', 'AHE', '11-12-134', '2017-11-15', '2017-11-17', 500, 111),
('ATR/1451/07', 'ANV', '12-14-156', '2017-11-17', '2017-11-20', 5000, 344),
('ATR/3398/07', 'ATY', '12-14-156', '2017-11-08', '2017-11-13', 2000, 555),
('ATR/3819/07', 'FBC', '12-14-156', '2017-11-15', '2017-11-18', 4000, 786),
('ATR/4072/07', 'GC8', '12-13145', '2017-11-14', '2017-11-16', 3000, 345);

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcartitem`
--

DROP TABLE IF EXISTS `shoppingcartitem`;
CREATE TABLE IF NOT EXISTS `shoppingcartitem` (
  `UserID` varchar(20) NOT NULL,
  `ItemID` varchar(20) NOT NULL,
  `Quatity` int(11) NOT NULL,
  `Price` double NOT NULL,
  `Date` date NOT NULL,
  KEY `UserID` (`UserID`),
  KEY `ItemID` (`ItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shoppingcartitem`
--

INSERT INTO `shoppingcartitem` (`UserID`, `ItemID`, `Quatity`, `Price`, `Date`) VALUES
('ATR/1451/07', 'MCBT', 5, 1000, '2017-11-14'),
('ATR/2738/07', 'MCOC', 6, 1500, '2017-11-22'),
('ATR/3819/07', 'TW5-LITE', 1, 5000, '2017-11-28'),
('ATR/4488/07', 'GN8', 1, 8000, '2017-11-22'),
('ATR/8201/07', 'AHE', 1, 500000, '2017-11-15');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `UserID` varchar(20) NOT NULL,
  `ItemID` varchar(20) NOT NULL,
  KEY `UserID` (`UserID`),
  KEY `ItemID` (`ItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`UserID`, `ItemID`) VALUES
('ATR/1451/07', 'AHE'),
('ATR/2738/07', 'ANV'),
('ATR/3398/07', 'ATY'),
('ATR/3819/07', 'OEDP'),
('ATR/8941/07', 'TL8');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD CONSTRAINT `advertisement_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `customer` (`UserID`),
  ADD CONSTRAINT `advertisement_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ItemID`);

--
-- Constraints for table `auctionbid`
--
ALTER TABLE `auctionbid`
  ADD CONSTRAINT `auctionbid_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `customer` (`UserID`),
  ADD CONSTRAINT `auctionbid_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `auctionitem` (`ItemID`);

--
-- Constraints for table `auctionitem`
--
ALTER TABLE `auctionitem`
  ADD CONSTRAINT `auctionitem_ibfk_1` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ItemID`);

--
-- Constraints for table `coupon`
--
ALTER TABLE `coupon`
  ADD CONSTRAINT `coupon_ibfk_1` FOREIGN KEY (`DiscountID`) REFERENCES `discount` (`DiscountID`);

--
-- Constraints for table `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `discount_ibfk_1` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ItemID`);

--
-- Constraints for table `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forum_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `customer` (`UserID`);

--
-- Constraints for table `itemreviwes`
--
ALTER TABLE `itemreviwes`
  ADD CONSTRAINT `itemreviwes_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `customer` (`UserID`),
  ADD CONSTRAINT `itemreviwes_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ItemID`);

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `customer` (`UserID`),
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ItemID`),
  ADD CONSTRAINT `orderdetail_ibfk_3` FOREIGN KEY (`Homenumber`) REFERENCES `place` (`Homenumber`);

--
-- Constraints for table `purchasehistory`
--
ALTER TABLE `purchasehistory`
  ADD CONSTRAINT `purchasehistory_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `customer` (`UserID`),
  ADD CONSTRAINT `purchasehistory_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ItemID`),
  ADD CONSTRAINT `purchasehistory_ibfk_3` FOREIGN KEY (`OrderID`) REFERENCES `orderdetail` (`OrderID`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `customer` (`UserID`);

--
-- Constraints for table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `receipt_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `customer` (`UserID`),
  ADD CONSTRAINT `receipt_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ItemID`);

--
-- Constraints for table `shipping`
--
ALTER TABLE `shipping`
  ADD CONSTRAINT `shipping_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `customer` (`UserID`),
  ADD CONSTRAINT `shipping_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ItemID`),
  ADD CONSTRAINT `shipping_ibfk_3` FOREIGN KEY (`Homenumber`) REFERENCES `place` (`Homenumber`);

--
-- Constraints for table `shoppingcartitem`
--
ALTER TABLE `shoppingcartitem`
  ADD CONSTRAINT `shoppingcartitem_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `customer` (`UserID`),
  ADD CONSTRAINT `shoppingcartitem_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ItemID`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `customer` (`UserID`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ItemID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
