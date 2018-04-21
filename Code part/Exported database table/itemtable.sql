-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2017 at 12:43 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `category2`
--

-- --------------------------------------------------------

--
-- Table structure for table `itemtable`
--

CREATE TABLE IF NOT EXISTS `itemtable` (
  `itemId` int(11) NOT NULL,
  `itemName` varchar(25) NOT NULL,
  `itemPicture` varchar(10) NOT NULL,
  `itemDescription` varchar(100) NOT NULL,
  `postDate` date NOT NULL,
  `contractPeriod` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `itemType` varchar(4) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemtable`
--

INSERT INTO `itemtable` (`itemId`, `itemName`, `itemPicture`, `itemDescription`, `postDate`, `contractPeriod`, `quantity`, `price`, `itemType`, `userId`) VALUES
(1, 'Nike Shoes', 'NK', 'Size 42,high quality,made in vietnam', '2017-11-17', 5, 3, 1324, 'MS', 0),
(2, 'Nike Shoes', 'nm', 'Size 41,high quality,made in vietnam', '2017-11-17', 3, 5, 900, 'MS', 0),
(3, 'jeans', 'js', 'size 30 made in china skinny pants', '2017-11-18', 4, 10, 400, 'MC', 0),
(4, 'jeans', 'js', 'size 30 made in china skinny pants', '2017-11-18', 4, 10, 400, 'MC', 0),
(5, 'Dinner dress', 'ddr', 'made in europe,size 28 dinner dress for exclusive events', '2017-11-18', 4, 3, 1280, 'WC', 0),
(6, 'N Shoes', 'NK2', 'Size 42,high quality,made in USA at', '2017-11-17', 5, 30, 1324, 'MS', 0),
(7, 'N Shoes', 'nm', 'Size 41,high quality,made in USA', '2017-11-17', 3, 15, 900, 'MS', 0),
(8, 'Jeans Good', 'js', 'size 30 made in Ethiopia skinny pants', '2017-11-18', 4, 20, 400, 'MC', 0),
(9, 'Jeans Good', 'js', 'size 30 made in china skinny pants', '2017-11-18', 4, 25, 450, 'MC', 0),
(10, 'Innerwear ', 'ddr', 'made in europe,size 30 Innerwear for exclusive events', '2017-11-18', 4, 35, 1280, 'WC', 0),
(11, 'wool Jacket', 'NN', 'Heavy High Qualty Jacket', '2017-06-10', 30, 10, 1200, 'WC', 4),
(12, 'SP Shoes', 'NK20', 'Size 42,high quality,made in USA at', '2017-11-17', 5, 30, 1324, 'KS', 0),
(13, 'SP Shoes', 'nm1', 'Size 41,high quality,made in USA', '2017-11-17', 3, 15, 900, 'KS', 0),
(14, 'sweater Good', 'js1', 'size 30 made in Ethiopia skinny pants', '2017-11-18', 4, 20, 400, 'KC', 0),
(15, 'wool coat Good', 'js12', 'size 30 made in china skinny pants', '2017-11-18', 4, 25, 450, 'KC', 0),
(16, 'outerwear ', 'ddr1', 'made in europe,size 30 Innerwear for exclusive events', '2017-11-18', 4, 35, 1280, 'WC', 0),
(17, 'Mobile Phone', 'M20', 'SUmsung,high quality,made in USA at', '2017-11-17', 5, 30, 1324, 'MP', 0),
(18, 'Apple Phone', 'A1', 'Ram 4.5G,high quality,made in USA', '2017-11-17', 3, 15, 900, 'MP', 0),
(19, 'PC HP', 'js1', 'Proc. 2G made in Ethiopia skinny pants', '2017-11-18', 4, 20, 400, 'CO', 0),
(20, 'PC Toshiba', 'PC12', 'Hard disk 750G made in china skinny pants', '2017-11-18', 4, 25, 450, 'CO', 0),
(21, '18 in TV ', 'TV1', 'made in europe,', '2017-11-18', 4, 35, 1280, 'TV', 0),
(22, 'SP40 Shoes', 'NK20', 'Size 42,high quality,made in USA at', '2017-11-17', 5, 30, 1324, 'KS', 0),
(23, 'SP44 Shoes', 'nm1', 'Size 41,high quality,made in USA', '2017-11-17', 3, 15, 900, 'WS', 0),
(24, 'sweater ', 'js1', 'size 30 made in Ethiopia skinny pants', '2017-11-18', 4, 20, 400, 'KC', 0),
(25, 'Home Chair', 'hch12', 'size 30 made in china skinny pants', '2017-11-18', 4, 25, 450, 'FU', 0),
(26, 'outerwear Kids', 'ddr1', 'made in europe,size 30 Innerwear for exclusive events', '2017-11-18', 4, 35, 1280, 'KC', 0),
(27, 'Mobile Phone Reliable', 'M20', 'SUmsung,high quality,made in USA at', '2017-11-17', 5, 30, 1324, 'MP', 0),
(28, 'Apple Phone Reliable', 'A1', 'Ram 4.5G,high quality,made in USA', '2017-11-17', 3, 15, 900, 'MP', 0),
(29, 'PC HP High', 'js1', 'Proc. 2G made in Ethiopia skinny pants', '2017-11-18', 4, 20, 400, 'CO', 0),
(30, 'PC Toshiba High', 'PC12', 'Hard disk 750G made in china skinny pants', '2017-11-18', 4, 25, 450, 'CO', 0),
(31, 'Offic Table ', 'Tb1', 'made in Ethiopia,', '2017-11-18', 4, 35, 1280, 'FU', 0),
(32, 'Android Tablate', 'A1', 'Ram 4.5G,high quality,made in USA', '2017-11-17', 3, 15, 900, 'TA', 0),
(33, 'Love Up to ', 'js1', 'Proc. 2G made in Ethiopia skinny pants', '2017-11-18', 4, 20, 400, 'FI', 0),
(34, 'Thrown Power', 'PC12', 'Hard disk 750G made in china skinny pants', '2017-11-18', 4, 25, 750, 'SC', 0),
(35, ' Microelectronics', 'Tb1', 'made in Ethiopia,', '2017-11-18', 4, 35, 2280, 'SC', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `itemtable`
--
ALTER TABLE `itemtable`
  ADD PRIMARY KEY (`itemId`), ADD KEY `userId` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `itemtable`
--
ALTER TABLE `itemtable`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
