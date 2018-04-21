DROP TABLE IF EXISTS items2;

CREATE TABLE IF NOT EXISTS items2 (
  ItemID int(20) NOT NULL AUTO_INCREMENT,
  Itemname varchar(20) NOT NULL,
  description text NOT NULL,
  quantity int(11) NOT NULL,
  Model varchar(20) NOT NULL DEFAULT 'no model',
  Color varchar(20) NOT NULL DEFAULT 'none',
  Category varchar(20) NOT NULL,
  itemimage varchar(20) DEFAULT NULL,
  postdate date NOT NULL,
  contractPeriod int(11) NOT NULL,
  userId int(11) NOT NULL,
  Weight double DEFAULT NULL,
  price double NOT NULL,
  OldPrice double DEFAULT NULL,
  SplitPay tinyint(1) DEFAULT NULL,
  PRIMARY KEY (ItemID),
  FOREIGN KEY (Category) REFERENCES category(categoryName)
   ON DELETE CASCADE
     ON UPDATE CASCADE);
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ItemID`, `Itemname`, `description`, `quantity`, `Model`, `Color`, `Category`, `itemimage`, `postdate`, `contractPeriod`, `userId`, `Weight`, `price`, `OldPrice`, `SplitPay`) VALUES
(0, 'Apple S. Phone', 'Smart Ph', 28, 'no model', 'none', 'cell phones', 'RE', '2017-10-11', 39, 1, NULL, 5500, NULL, NULL),
(1, 'Hyundai Elantra', '', 0, 'Elantra', 'black', 'Automotives', NULL, '2017-11-08', 0, 0, 0, 800000, 0, 0),
(2, 'Nisan versa', '', 0, 'versa', 'Black', 'Automotives', NULL, '2017-11-08', 0, 0, 1, 500000, 0, 0),
(3, 'Tyota yaris', '', 0, 'yaris', 'white', 'Automotives', NULL, '2017-11-15', 0, 2, 0, 200000, 0, 0),
(4, 'Dinner dress', 'made in europe,size 28 dinner dress for exclusive events', 3, 'no model', 'none', 'cloth', 'ddr', '2017-11-21', 3, 10, NULL, 900, NULL, NULL),
(5, 'Beach chair', '', 0, '', '', 'Furniturs', NULL, '2017-11-08', 0, 4, 0, 1000, 0, 0),
(6, 'Bar stool', '', 0, '', '', 'Furniturs', NULL, '2017-11-08', 0, 5, 0, 400, 0, 0),
(7, 'samsung Galaxy C8', '', 0, 'galaxy C8', 'black', 'cell phones', NULL, '2017-11-05', 20191211, 3, 0, 10000, 0, 0),
(8, 'Samsung galaxy note ', '', 0, 'note 8', 'black', 'cell phones', NULL, '2017-11-14', 20200212, 6, 0, 13000, 0, 0),
(9, 'bow tie', '', 0, 'Men cloth', 'white', 'Fashion', NULL, '2017-11-06', 0, 7, 0, 100, 0, 0),
(10, 'Over Coat', '', 0, 'Men Cloth', 'black', 'Fashion', NULL, '2017-11-07', 0, 8, 0, 500, 0, 0),
(11, 'Suit Coat', '', 0, 'Men cloth', 'blue', 'Fashion', NULL, '2017-11-22', 0, 9, 0, 1500, 0, 0),
(12, 'Adding machine', '', 0, '', '', 'Office Equipment', NULL, '2017-11-07', 0, 11, 0, 120, 0, 0),
(13, 'desk pad', '', 0, '', '', 'Office Equipment', NULL, '2017-11-07', 0, 12, 0, 400, 0, 0),
(14, 'Tchno camon cx air', '', 0, 'camon cx air', 'black', 'cellphones', NULL, '2017-11-19', 20191119, 13, 0, 4000, 0, 0),
(15, 'Techno L8', '', 0, 'L8', 'white', 'cell phones', NULL, '2017-11-14', 20201216, 14, 0, 6000, 0, 0),
(16, 'Techno W5 Lite', '', 0, 'W5 LITE', 'black', 'cell phones', NULL, '2017-11-07', 20190425, 15, 0, 7000, 0, 0),
(17, 'Apple G88', 'Smart Apple Phone', 10, 'no model', 'none', 'cell phones', 'Y', '2017-02-09', 20, 0, NULL, 850, NULL, NULL);

