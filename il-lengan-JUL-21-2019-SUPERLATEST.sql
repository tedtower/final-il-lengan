-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 21, 2019 at 03:08 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `il-lengan`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `aID` int(11) NOT NULL AUTO_INCREMENT,
  `aType` enum('admin','barista','chef','customer') NOT NULL,
  `aUsername` varchar(25) NOT NULL,
  `aPassword` char(64) NOT NULL,
  `aIsOnline` enum('1','0') NOT NULL,
  `aStatus` enum('active','inactive','archived') NOT NULL,
  PRIMARY KEY (`aID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`aID`, `aType`, `aUsername`, `aPassword`, `aIsOnline`, `aStatus`) VALUES
(1, 'admin', 'manager', 'manager', '0', 'active'),
(2, 'barista', 'barista', 'barista', '0', 'active'),
(3, 'chef', 'chef', 'chef', '0', 'active'),
(4, 'customer', 'customer', 'customer', '0', 'active'),
(5, 'barista', 'Marvin', '12345', '1', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `activitylog`
--

DROP TABLE IF EXISTS `activitylog`;
CREATE TABLE IF NOT EXISTS `activitylog` (
  `alID` int(11) NOT NULL AUTO_INCREMENT,
  `aID` int(11) NOT NULL,
  `alDate` datetime NOT NULL,
  `alDesc` varchar(120) NOT NULL,
  `alType` enum('add','update','archived') NOT NULL,
  `additionalRemarks` longtext,
  PRIMARY KEY (`alID`),
  KEY `activity log aID_idx` (`aID`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activitylog`
--

INSERT INTO `activitylog` (`alID`, `aID`, `alDate`, `alDesc`, `alType`, `additionalRemarks`) VALUES
(1, 1, '2019-06-19 05:21:25', 'Admin added a stockitem spoilage.', 'add', 'Nabulok'),
(2, 1, '2019-07-11 14:23:31', 'Admin added a stockitem return.', 'add', ''),
(3, 1, '2019-07-11 14:24:32', 'Manager added a consumption.', 'add', ''),
(4, 1, '2019-07-11 14:53:29', 'Manager added a consumption.', 'add', ''),
(5, 1, '2019-07-11 14:53:56', 'Manager added a consumption.', 'add', ''),
(6, 1, '2019-07-11 14:54:07', 'Manager added a consumption.', 'add', ''),
(7, 1, '2019-07-11 14:57:22', 'Manager added a consumption.', 'add', ''),
(8, 1, '2019-07-11 15:20:34', 'Manager added a consumption.', 'add', ''),
(9, 1, '2019-07-11 15:24:04', 'Manager added a stock spoilage.', 'add', ''),
(10, 1, '2019-07-11 18:53:53', 'Manager added a consumption.', 'add', ''),
(11, 1, '2019-07-11 18:54:38', 'Manager added a consumption.', 'add', ''),
(12, 1, '2019-07-12 05:30:54', 'Manager added a consumption.', 'add', ''),
(13, 1, '2019-07-14 11:52:07', 'Manager added a consumption.', 'add', ''),
(14, 1, '2019-07-14 11:56:12', 'Manager added a stock spoilage.', 'add', ''),
(15, 1, '2019-07-15 22:16:28', 'Manager added a consumption.', 'add', ''),
(16, 1, '2019-07-15 22:29:39', 'Manager added account Marvin .', 'add', NULL),
(17, 1, '2019-07-15 22:39:27', 'Manager added category marvin .', 'add', NULL),
(18, 1, '2019-07-15 22:43:46', 'Manager added a new unit of measurement: gallon .', 'add', NULL),
(19, 1, '2019-07-15 22:55:57', 'Manager added a new menu: Pizza .', 'add', NULL),
(20, 1, '2019-07-15 23:10:01', 'Manager added a new stock item: Cagayan Coffee Beans .', 'add', NULL),
(21, 1, '2019-07-16 00:11:34', 'Manager added perorm a physical count.', 'add', NULL),
(22, 1, '2019-07-16 00:15:38', 'Manager performed physical count.', 'add', NULL),
(23, 1, '2019-07-16 14:40:38', 'Manager added a new supplier: Jessa .', 'add', NULL),
(24, 1, '2019-07-17 12:11:12', 'Manager added a consumption.', 'add', ''),
(25, 1, '2019-07-17 19:12:57', 'Manager updated the supplier details of Roger.', 'update', NULL),
(26, 1, '2019-07-18 12:42:07', 'Manager added a consumption.', 'add', ''),
(27, 1, '2019-07-18 13:02:27', 'Admin added a stockitem purchase.', 'add', NULL),
(28, 1, '2019-07-18 13:02:27', 'Admin added a stockitem purchase.', 'add', NULL),
(29, 1, '2019-07-18 13:16:12', 'Manager performed physical count.', 'add', NULL),
(30, 1, '2019-07-18 13:22:44', 'Manager performed physical count.', 'add', NULL),
(31, 1, '2019-07-18 13:42:53', 'Manager added a consumption.', 'add', ''),
(32, 1, '2019-07-18 13:57:51', 'Manager performed physical count.', 'add', NULL),
(33, 1, '2019-07-18 14:14:58', 'Manager added a consumption.', 'add', ''),
(34, 1, '2019-07-18 14:16:03', 'Manager added a stock spoilage.', 'add', NULL),
(35, 1, '2019-07-18 14:45:43', 'Admin added a stockitem purchase.', 'add', NULL),
(36, 1, '2019-07-18 14:45:43', 'Admin added a stockitem purchase.', 'add', NULL),
(37, 1, '2019-07-18 14:46:50', 'Manager updated a delivery receipt.', 'add', NULL),
(38, 1, '2019-07-18 15:29:43', 'Admin added a stockitem purchase.', 'add', NULL),
(39, 1, '2019-07-18 15:29:43', 'Admin added a stockitem purchase.', 'add', NULL),
(40, 1, '2019-07-21 14:24:49', 'Manager updated the supplier details of Coca Cola Inc..', 'update', NULL),
(41, 1, '2019-07-21 14:40:33', 'Manager updated the supplier details of Roger.', 'update', NULL),
(42, 1, '2019-07-21 14:43:02', 'Manager updated the supplier details of Coca Cola Inc..', 'update', NULL),
(43, 1, '2019-07-21 14:43:53', 'Manager added a new supplier: Marvin .', 'add', NULL),
(44, 1, '2019-07-21 14:47:29', 'Manager updated the supplier details of Coca Cola Inc..', 'update', NULL),
(45, 1, '2019-07-21 14:49:38', 'Manager updated the supplier details of Coca Cola Inc..', 'update', NULL),
(46, 1, '2019-07-21 14:50:33', 'Manager updated the supplier details of Coca Cola Inc..', 'update', NULL),
(47, 1, '2019-07-21 14:50:37', 'Manager updated the supplier details of Coca Cola Inc..', 'update', NULL),
(48, 1, '2019-07-21 14:51:04', 'Manager updated the supplier details of Coca Cola Inc..', 'update', NULL),
(49, 1, '2019-07-21 14:51:31', 'Manager updated the supplier details of Roger.', 'update', NULL),
(50, 1, '2019-07-21 21:08:00', 'Manager added a new supplier: Magnolia .', 'add', NULL),
(51, 1, '2019-07-21 21:52:31', 'Manager added a purchase order to 11 .', 'add', NULL),
(52, 1, '2019-07-21 21:54:27', 'Admin added a stockitem purchase.', 'add', NULL),
(53, 1, '2019-07-21 22:09:20', 'Manager added a purchase order to 11 .', 'add', NULL),
(54, 1, '2019-07-21 22:09:50', 'Admin added a stockitem purchase.', 'add', NULL),
(55, 1, '2019-07-21 22:11:06', 'Admin added a stockitem purchase.', 'add', NULL),
(56, 1, '2019-07-21 22:12:39', 'Admin added a stockitem purchase.', 'add', NULL),
(57, 1, '2019-07-21 22:17:35', 'Admin added a stockitem purchase.', 'add', NULL),
(58, 1, '2019-07-21 22:34:35', 'Admin added a stockitem purchase.', 'add', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `addons`
--

DROP TABLE IF EXISTS `addons`;
CREATE TABLE IF NOT EXISTS `addons` (
  `aoID` int(11) NOT NULL AUTO_INCREMENT,
  `aoName` varchar(45) NOT NULL,
  `aoCategory` enum('food','drinks') NOT NULL,
  `aoPrice` double NOT NULL,
  `aoStatus` enum('available','unavailable','archived') NOT NULL,
  PRIMARY KEY (`aoID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addons`
--

INSERT INTO `addons` (`aoID`, `aoName`, `aoCategory`, `aoPrice`, `aoStatus`) VALUES
(15, 'Milk', 'drinks', 20, 'available'),
(16, 'Sugar', 'drinks', 20, 'archived'),
(17, 'Extra Rice', 'food', 20, 'available'),
(18, 'Extra Shot', 'drinks', 20, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `addonspoil`
--

DROP TABLE IF EXISTS `addonspoil`;
CREATE TABLE IF NOT EXISTS `addonspoil` (
  `aoID` int(11) NOT NULL,
  `aosID` int(11) NOT NULL,
  `osID` int(11) DEFAULT NULL,
  `aosQty` int(11) NOT NULL,
  `aosDate` date NOT NULL,
  `aosRemarks` longtext,
  PRIMARY KEY (`aoID`,`aosID`),
  KEY `addonspoil aoID_idx` (`aoID`),
  KEY `addons aosID_idx` (`aosID`),
  KEY `addons osID_idx` (`osID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aospoil`
--

DROP TABLE IF EXISTS `aospoil`;
CREATE TABLE IF NOT EXISTS `aospoil` (
  `aosID` int(11) NOT NULL AUTO_INCREMENT,
  `aosDateRecorded` datetime NOT NULL,
  `aosDate` date DEFAULT NULL,
  PRIMARY KEY (`aosID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aospoil`
--

INSERT INTO `aospoil` (`aosID`, `aosDateRecorded`, `aosDate`) VALUES
(1, '2019-04-29 10:00:00', NULL),
(2, '2019-04-29 16:17:00', NULL),
(3, '2019-04-30 00:00:00', NULL),
(4, '2019-04-30 00:00:00', NULL),
(5, '2019-05-08 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `ctID` int(11) NOT NULL AUTO_INCREMENT,
  `supcatID` int(11) DEFAULT NULL,
  `ctName` varchar(45) NOT NULL,
  `ctType` enum('menu','inventory') NOT NULL,
  `ctStatus` enum('active','archived') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`ctID`),
  KEY `super category_idx` (`supcatID`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ctID`, `supcatID`, `ctName`, `ctType`, `ctStatus`) VALUES
(1, NULL, 'Meals', 'menu', 'active'),
(2, NULL, 'Drinks', 'menu', 'active'),
(3, NULL, 'Desserts', 'menu', 'active'),
(4, 1, 'Pasta', 'menu', 'active'),
(5, 1, 'Ala Carte', 'menu', 'active'),
(6, 1, 'Combo (w/ Rice, Buttered Veggie & Egg)', 'menu', 'active'),
(7, 1, 'Tamtaman (Samplers)', 'menu', 'active'),
(8, 1, 'Gagay-yem (Barkada Meals)', 'menu', 'active'),
(9, 2, 'Frappe', 'menu', 'active'),
(10, 2, 'Espresso', 'menu', 'active'),
(11, 2, 'French-Pressed (Brewed)', 'menu', 'active'),
(12, 2, 'Hot and Cold Drinks', 'menu', 'active'),
(13, NULL, 'Sauce', 'inventory', 'active'),
(14, NULL, 'Syrup', 'inventory', 'active'),
(15, NULL, 'Powder', 'inventory', 'active'),
(16, NULL, 'Bean', 'inventory', 'active'),
(17, NULL, 'Tea', 'inventory', 'active'),
(18, NULL, 'Refreshment', 'inventory', 'active'),
(22, NULL, 'Meat', 'inventory', 'active'),
(23, NULL, 'Pasta', 'inventory', 'active'),
(24, NULL, 'Condiments', 'inventory', 'active'),
(28, NULL, 'Cakes', 'inventory', 'active'),
(31, 3, 'Cakes', 'menu', 'active'),
(32, NULL, 'marvin', 'menu', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `consumed_items`
--

DROP TABLE IF EXISTS `consumed_items`;
CREATE TABLE IF NOT EXISTS `consumed_items` (
  `ciID` int(11) NOT NULL AUTO_INCREMENT,
  `cID` int(11) NOT NULL,
  PRIMARY KEY (`ciID`),
  KEY `consumption_items cID_idx` (`cID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consumed_items`
--

INSERT INTO `consumed_items` (`ciID`, `cID`) VALUES
(16, 16);

-- --------------------------------------------------------

--
-- Table structure for table `consumptions`
--

DROP TABLE IF EXISTS `consumptions`;
CREATE TABLE IF NOT EXISTS `consumptions` (
  `cID` int(11) NOT NULL AUTO_INCREMENT,
  `cDate` date NOT NULL,
  `cDateRecorded` datetime NOT NULL,
  PRIMARY KEY (`cID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consumptions`
--

INSERT INTO `consumptions` (`cID`, `cDate`, `cDateRecorded`) VALUES
(16, '2019-07-18', '2019-07-18 14:14:58');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

DROP TABLE IF EXISTS `deliveries`;
CREATE TABLE IF NOT EXISTS `deliveries` (
  `dID` int(11) NOT NULL AUTO_INCREMENT,
  `spID` int(11) DEFAULT NULL,
  `receiptNo` varchar(45) DEFAULT NULL,
  `dDate` date NOT NULL,
  `dDateRecorded` datetime NOT NULL,
  `spAltName` varchar(65) DEFAULT NULL,
  PRIMARY KEY (`dID`),
  KEY `spID` (`spID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`dID`, `spID`, `receiptNo`, `dDate`, `dDateRecorded`, `spAltName`) VALUES
(4, 11, 'ORUNA', '2019-07-21', '2019-07-21 22:12:39', NULL),
(5, 11, 'OR2ND', '2019-07-21', '2019-07-21 22:17:35', NULL),
(6, NULL, 'OR920394', '2019-07-21', '2019-07-21 22:34:35', 'Aling Mena');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_items`
--

DROP TABLE IF EXISTS `delivery_items`;
CREATE TABLE IF NOT EXISTS `delivery_items` (
  `diID` int(11) NOT NULL AUTO_INCREMENT,
  `dID` int(11) NOT NULL,
  `diStatus` enum('pending','partially delivered','delivered') NOT NULL,
  PRIMARY KEY (`diID`),
  KEY `dID` (`dID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_items`
--

INSERT INTO `delivery_items` (`diID`, `dID`, `diStatus`) VALUES
(3, 4, 'partially delivered'),
(4, 5, 'delivered'),
(5, 6, 'delivered');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
CREATE TABLE IF NOT EXISTS `discounts` (
  `pmID` int(11) NOT NULL,
  `dcName` varchar(45) NOT NULL,
  PRIMARY KEY (`pmID`),
  KEY `index2` (`pmID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`pmID`, `dcName`) VALUES
(1, 'less 20%'),
(3, 'less 20%');

-- --------------------------------------------------------

--
-- Table structure for table `freebies`
--

DROP TABLE IF EXISTS `freebies`;
CREATE TABLE IF NOT EXISTS `freebies` (
  `pmID` int(11) NOT NULL,
  `fbName` varchar(45) NOT NULL,
  `isElective` enum('0','1') NOT NULL,
  PRIMARY KEY (`pmID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `freebies`
--

INSERT INTO `freebies` (`pmID`, `fbName`, `isElective`) VALUES
(2, 'Buy 1 take 1', '0'),
(3, 'Buy 1 take 1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `mID` int(11) NOT NULL AUTO_INCREMENT,
  `ctID` int(11) NOT NULL,
  `mName` varchar(64) NOT NULL,
  `mDesc` varchar(120) DEFAULT NULL,
  `mAvailability` enum('available','unavailable','archived') NOT NULL,
  `mImage` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`mID`),
  KEY `menu ctID_idx` (`ctID`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`mID`, `ctID`, `mName`, `mDesc`, `mAvailability`, `mImage`) VALUES
(4, 8, 'Set A: Nachos (Gaygay-yem)', NULL, 'available', 'Nachos.jpg'),
(5, 8, '6pcs. Fried Chicken w/ Mojos', NULL, 'unavailable', ''),
(6, 8, '3pcs. Fried Chicken & 3pcs. Buffalo Chicken w/ Mojos', NULL, 'available', NULL),
(9, 6, '2pc. Fried Chicken', NULL, 'available', 'Chicken.jpg'),
(10, 6, '2pc. Buffalo Chicken', NULL, 'available', 'Buffalo.jpg'),
(16, 5, 'Animal Fries', 'fries  that is fried to look like animal', 'available', 'Animal.jpg'),
(26, 4, 'Carbonara Pasta', NULL, 'available', 'Carbonara.jpg'),
(42, 9, 'Matcha Frappe', NULL, 'available', 'MatchaIced.jpg'),
(44, 10, 'Americano', NULL, 'available', 'Coffee.jpg'),
(50, 11, 'Benguet Coffee', '', 'available', 'Black.jpg'),
(57, 12, 'Coca Cola', NULL, 'unavailable', 'Coke.jpeg'),
(77, 18, 'Mango Juice', NULL, 'available', ''),
(78, 18, 'Pineapple Juice', NULL, 'available', ''),
(79, 10, 'Cappuccino', NULL, 'available', 'Cappuccino.jpg'),
(80, 12, 'Hot Choco', NULL, 'available', 'Choco.jpg'),
(81, 9, 'Strawberry Frappe', 'Non-coffee based', 'available', 'Strawberry.jpg'),
(85, 10, 'Long Black / Americano', '', 'available', 'Black.jpg'),
(86, 9, 'Cafe Latte', NULL, 'available', 'Frappe.jpg'),
(87, 4, 'Pesto', NULL, 'available', 'Pesto.jpg'),
(88, 5, 'French Fries', NULL, 'available', 'Fries.jpg'),
(89, 5, 'Bacon Cheese Burger', NULL, 'available', 'Burger.jpg'),
(90, 4, 'Italian ', NULL, 'available', 'Italian.jpg'),
(91, 5, 'Fish Fillet ', 'w/ Mango Sauce', 'available', 'Fillet.jpg'),
(92, 5, 'Chicken Quesadilla', NULL, 'available', 'Quesadilla.jpg'),
(93, 5, 'Fresh Lumpia', NULL, 'available', 'Lumpia.jpg'),
(94, 5, 'Fish and Chips', NULL, 'available', 'Chips.jpg'),
(95, 5, 'Clubhouse Sandwich', NULL, 'available', 'Sandwich.png'),
(96, 5, 'Waffles and Bacon', NULL, 'available', 'Waffle.jpg'),
(97, 5, 'Chicken Sandwich', NULL, 'available', 'SandwichChick.jpg'),
(98, 6, 'Baby back ribs', NULL, 'available', 'Ribs.jpg'),
(99, 7, 'Set A: Fries', '', 'available', 'Fries.jpg'),
(100, 7, 'Set A: Nachos', '', 'available', 'Nachos.jpg'),
(101, 7, 'Set B: Quesadilla', '', 'available', 'Quesadilla.jpg'),
(102, 7, 'Set B: Fries', '', 'available', 'Fries.jpg'),
(103, 7, 'Set B: Nachos', '', 'available', 'Nachos.jpg'),
(104, 7, 'Set C: Wicked Oreos', NULL, 'available', 'Oreos.jpg'),
(105, 7, 'Set C: Turon', NULL, 'available', 'Turon.jpg'),
(106, 8, 'Set A: Clubhouse (Gaygay-yem)', NULL, 'available', 'Sandwich.png'),
(107, 8, 'Set A: Fries (Gaygay-yem)', NULL, 'available', 'Fries.jpg'),
(108, 8, 'Set B: 6 pcs Fried Chicken (Gaygay-yem)', NULL, 'available', 'Chicken.jpg'),
(109, 8, 'Set C: 3 pcs Fried Chicken', NULL, 'available', 'Chicken.jpg'),
(110, 8, 'Set C: 3pcs Buffalo Chicken with Mojos', NULL, 'available', 'Buffalo.jpg'),
(111, 32, 'Pizza', '', 'available', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menuaddons`
--

DROP TABLE IF EXISTS `menuaddons`;
CREATE TABLE IF NOT EXISTS `menuaddons` (
  `mID` int(11) NOT NULL,
  `aoID` int(11) NOT NULL,
  PRIMARY KEY (`mID`,`aoID`),
  KEY `menuaddons mID_idx` (`mID`),
  KEY `menuaddons aoID_idx` (`aoID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuaddons`
--

INSERT INTO `menuaddons` (`mID`, `aoID`) VALUES
(9, 17),
(10, 17),
(44, 15),
(44, 18),
(50, 15),
(79, 15),
(85, 15),
(98, 17);

-- --------------------------------------------------------

--
-- Table structure for table `menudiscount`
--

DROP TABLE IF EXISTS `menudiscount`;
CREATE TABLE IF NOT EXISTS `menudiscount` (
  `pmID` int(11) NOT NULL,
  `prID` int(11) NOT NULL,
  `dcAmount` double NOT NULL,
  PRIMARY KEY (`pmID`,`prID`),
  KEY `menudiscount prID_idx` (`prID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menufreebie`
--

DROP TABLE IF EXISTS `menufreebie`;
CREATE TABLE IF NOT EXISTS `menufreebie` (
  `pmID` int(11) NOT NULL,
  `prID` int(11) NOT NULL,
  `fbQty` int(11) NOT NULL,
  PRIMARY KEY (`pmID`,`prID`),
  KEY `menufreebie prID_idx` (`prID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menuspoil`
--

DROP TABLE IF EXISTS `menuspoil`;
CREATE TABLE IF NOT EXISTS `menuspoil` (
  `msID` int(11) NOT NULL AUTO_INCREMENT,
  `msDate` date DEFAULT NULL,
  `msDateRecorded` datetime NOT NULL,
  PRIMARY KEY (`msID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuspoil`
--

INSERT INTO `menuspoil` (`msID`, `msDate`, `msDateRecorded`) VALUES
(1, NULL, '2019-04-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orderaddons`
--

DROP TABLE IF EXISTS `orderaddons`;
CREATE TABLE IF NOT EXISTS `orderaddons` (
  `aoID` int(11) NOT NULL,
  `olID` int(11) NOT NULL,
  `aoQty` int(11) NOT NULL,
  `aoTotal` double NOT NULL,
  PRIMARY KEY (`aoID`,`olID`),
  KEY `orderaddons aoID_idx` (`aoID`),
  KEY `orderaddons olID_idx` (`olID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderaddons`
--

INSERT INTO `orderaddons` (`aoID`, `olID`, `aoQty`, `aoTotal`) VALUES
(17, 1, 1, 20),
(17, 9, 1, 20),
(17, 14, 1, 20),
(17, 17, 3, 60);

-- --------------------------------------------------------

--
-- Table structure for table `orderlists`
--

DROP TABLE IF EXISTS `orderlists`;
CREATE TABLE IF NOT EXISTS `orderlists` (
  `olID` int(11) NOT NULL AUTO_INCREMENT,
  `prID` int(11) NOT NULL,
  `osID` int(11) NOT NULL,
  `olDesc` varchar(120) NOT NULL,
  `olQty` int(11) NOT NULL,
  `olSubtotal` double NOT NULL,
  `olStatus` enum('pending','served') NOT NULL,
  `olRemarks` longtext,
  `olPrice` double DEFAULT '0',
  `olDiscount` double DEFAULT '0',
  PRIMARY KEY (`olID`),
  KEY `orderlists prID_idx` (`prID`),
  KEY `orderlists osID_idx` (`osID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderlists`
--

INSERT INTO `orderlists` (`olID`, `prID`, `osID`, `olDesc`, `olQty`, `olSubtotal`, `olStatus`, `olRemarks`, `olPrice`, `olDiscount`) VALUES
(1, 2, 1, '2pc. Fried Chicken ', 1, 135, 'served', ' ', 135, 0),
(2, 3, 1, '2pc. Buffalo Chicken ', 1, 135, 'served', ' ', 135, 0),
(3, 1, 1, 'Set A: Nachos (Gaygay-yem) ', 1, 90, 'served', ' ', 90, 0),
(4, 4, 1, 'Animal Fries ', 1, 135, 'served', ' ', 135, 0),
(5, 1, 2, 'Set A: Nachos (Gaygay-yem) ', 1, 90, 'served', ' ', 90, 0),
(6, 2, 3, '2pc. Fried Chicken ', 1, 135, 'served', ' ', 135, 0),
(7, 1, 3, 'Set A: Nachos (Gaygay-yem) ', 1, 90, 'served', ' ', 90, 0),
(8, 3, 4, '2pc. Buffalo Chicken ', 1, 135, 'served', ' ', 135, 0),
(9, 2, 4, '2pc. Fried Chicken ', 1, 135, 'served', ' ', 135, 0),
(10, 1, 4, 'Set A: Nachos (Gaygay-yem) ', 1, 90, 'served', ' ', 90, 0),
(11, 4, 4, 'Animal Fries ', 1, 135, 'served', ' ', 135, 0),
(12, 10, 5, 'Benguet Coffee, Jumbo', 1, 180, 'served', ' ', 180, 0),
(13, 9, 5, 'Benguet Coffee, Solo', 1, 85, 'served', ' ', 85, 0),
(14, 3, 6, '2pc. Buffalo Chicken ', 1, 135, 'served', ' ', 135, 0),
(15, 2, 6, '2pc. Fried Chicken ', 1, 135, 'served', ' ', 135, 0),
(16, 1, 7, 'Set A: Nachos (Gaygay-yem) ', 2, 180, 'served', ' ', 90, 0),
(17, 2, 7, '2pc. Fried Chicken ', 2, 270, 'served', ' ', 135, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orderslips`
--

DROP TABLE IF EXISTS `orderslips`;
CREATE TABLE IF NOT EXISTS `orderslips` (
  `osID` int(11) NOT NULL AUTO_INCREMENT,
  `tableCode` varchar(11) NOT NULL,
  `custName` varchar(45) DEFAULT NULL,
  `osTotal` double NOT NULL,
  `payStatus` enum('paid','unpaid') NOT NULL,
  `osDateTime` datetime NOT NULL,
  `osPayDateTime` datetime NOT NULL,
  `osDateRecorded` datetime NOT NULL,
  `osDiscount` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`osID`),
  KEY `ordertableCode_idx` (`tableCode`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderslips`
--

INSERT INTO `orderslips` (`osID`, `tableCode`, `custName`, `osTotal`, `payStatus`, `osDateTime`, `osPayDateTime`, `osDateRecorded`, `osDiscount`) VALUES
(1, 't2', 'Marvin', 515, 'paid', '2019-07-15 00:00:00', '2019-07-15 00:00:00', '2019-07-15 15:45:16', 0),
(2, 't2', 'Maria', 72, 'paid', '2019-07-15 00:00:00', '2019-07-15 00:00:00', '2019-07-15 15:56:24', 20),
(3, 't1', 'marvin', 180, 'paid', '2019-07-16 00:00:00', '2019-07-16 00:00:00', '2019-07-16 14:25:11', 20),
(4, 't1', '', 515, 'paid', '2019-07-16 00:00:00', '2019-07-16 00:00:00', '2019-07-16 14:25:48', 0),
(5, 't1', '', 265, 'paid', '2019-07-16 00:00:00', '2019-07-16 00:00:00', '2019-07-16 14:28:10', 0),
(6, 't1', 'mar', 232, 'paid', '2019-07-16 00:00:00', '2019-07-16 00:00:00', '2019-07-16 16:35:09', 20),
(7, 't1', '', 408, 'paid', '2019-07-17 00:00:00', '2019-07-17 00:00:00', '2019-07-17 09:47:31', 20);

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

DROP TABLE IF EXISTS `preferences`;
CREATE TABLE IF NOT EXISTS `preferences` (
  `prID` int(11) NOT NULL AUTO_INCREMENT,
  `mID` int(11) NOT NULL,
  `prName` varchar(64) NOT NULL,
  `mTemp` enum('h','c','hc') DEFAULT NULL,
  `prPrice` double NOT NULL,
  `prStatus` enum('available','unavailable','archived') NOT NULL,
  PRIMARY KEY (`prID`),
  KEY `preferences mID_idx` (`mID`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `preferences`
--

INSERT INTO `preferences` (`prID`, `mID`, `prName`, `mTemp`, `prPrice`, `prStatus`) VALUES
(1, 4, 'Normal', NULL, 90, 'available'),
(2, 9, 'Normal', NULL, 135, 'available'),
(3, 10, 'Normal', NULL, 135, 'available'),
(4, 16, 'Normal', NULL, 135, 'available'),
(5, 26, 'Normal', NULL, 125, 'available'),
(6, 42, 'Normal', NULL, 110, 'available'),
(7, 44, 'Normal', 'hc', 85, 'available'),
(8, 44, 'Normal', 'hc', 180, 'available'),
(9, 50, 'Solo', '', 85, 'available'),
(10, 50, 'Jumbo', '', 180, 'available'),
(11, 57, 'Normal', NULL, 25, 'available'),
(15, 77, 'Normal', NULL, 30, 'available'),
(16, 78, 'Normal', NULL, 30, 'available'),
(19, 79, 'Normal', NULL, 95, 'available'),
(20, 80, 'Normal', NULL, 95, 'available'),
(21, 81, 'Normal', NULL, 105, 'available'),
(26, 86, 'Normal', NULL, 110, 'available'),
(27, 87, 'Normal', NULL, 130, 'available'),
(28, 88, 'Normal', NULL, 125, 'available'),
(29, 89, 'Normal', NULL, 125, 'available'),
(30, 90, 'Normal', NULL, 130, 'available'),
(31, 91, 'Normal', NULL, 120, 'available'),
(32, 92, 'Normal', NULL, 125, 'available'),
(33, 93, 'Normal', NULL, 110, 'available'),
(34, 94, 'Normal', NULL, 110, 'available'),
(35, 95, 'Normal', NULL, 110, 'available'),
(36, 96, 'Normal', NULL, 110, 'available'),
(37, 97, 'Normal', NULL, 120, 'available'),
(38, 98, 'Normal', NULL, 135, 'available'),
(39, 99, 'Normal', NULL, 95, 'available'),
(40, 100, 'Normal', NULL, 95, 'available'),
(43, 102, 'Normal', NULL, 95, 'available'),
(44, 103, 'Normal', NULL, 95, 'available'),
(45, 101, 'Normal', NULL, 95, 'available'),
(46, 104, 'Normal', NULL, 95, 'available'),
(47, 105, 'Normal', NULL, 95, 'available'),
(48, 106, 'Normal', NULL, 90, 'available'),
(49, 107, 'Normal', NULL, 90, 'available'),
(50, 108, 'Normal', NULL, 90, 'available'),
(51, 109, 'Normal', NULL, 90, 'available'),
(52, 110, 'Normal', NULL, 90, 'available'),
(53, 85, '', 'hc', 90, 'available'),
(54, 111, '', '', 100, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `prefstock`
--

DROP TABLE IF EXISTS `prefstock`;
CREATE TABLE IF NOT EXISTS `prefstock` (
  `prID` int(11) NOT NULL,
  `stID` int(11) NOT NULL,
  `prstQty` int(11) NOT NULL,
  PRIMARY KEY (`prID`,`stID`),
  KEY `preferenceStock stID_idx` (`stID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `promoconstraint`
--

DROP TABLE IF EXISTS `promoconstraint`;
CREATE TABLE IF NOT EXISTS `promoconstraint` (
  `pmID` int(11) NOT NULL,
  `prID` int(11) NOT NULL,
  `pcType` enum('f','d','fd') NOT NULL,
  `pcQty` int(11) NOT NULL,
  PRIMARY KEY (`pmID`,`prID`),
  KEY `promocons pmID_idx` (`pmID`),
  KEY `promocons mID_idx` (`prID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

DROP TABLE IF EXISTS `promos`;
CREATE TABLE IF NOT EXISTS `promos` (
  `pmID` int(11) NOT NULL AUTO_INCREMENT,
  `pmName` varchar(64) NOT NULL,
  `pmStartDate` date NOT NULL,
  `pmEndDate` date NOT NULL,
  `freebie` char(1) DEFAULT NULL,
  `discount` char(1) DEFAULT NULL,
  `status` enum('enabled','disabled','archived') NOT NULL,
  PRIMARY KEY (`pmID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promos`
--

INSERT INTO `promos` (`pmID`, `pmName`, `pmStartDate`, `pmEndDate`, `freebie`, `discount`, `status`) VALUES
(1, 'Graduation Promo', '2019-04-30', '2019-05-01', NULL, 'y', 'enabled'),
(2, 'Valentines Promo', '2019-02-14', '2019-02-15', 'y', NULL, 'disabled'),
(3, 'Christmas Promo', '2019-12-24', '2019-12-25', 'y', 'y', 'disabled');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE IF NOT EXISTS `purchases` (
  `pID` int(11) NOT NULL AUTO_INCREMENT,
  `spID` int(11) NOT NULL,
  `pDate` date NOT NULL,
  `pDateRecorded` datetime NOT NULL,
  PRIMARY KEY (`pID`),
  KEY `purchases spID_idx` (`spID`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`pID`, `spID`, `pDate`, `pDateRecorded`) VALUES
(36, 11, '2019-07-21', '2019-07-21 22:09:20');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

DROP TABLE IF EXISTS `purchase_items`;
CREATE TABLE IF NOT EXISTS `purchase_items` (
  `piID` int(11) NOT NULL AUTO_INCREMENT,
  `piStatus` enum('pending','partially delivered','delivered') NOT NULL,
  PRIMARY KEY (`piID`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_items`
--

INSERT INTO `purchase_items` (`piID`, `piStatus`) VALUES
(49, 'delivered');

-- --------------------------------------------------------

--
-- Table structure for table `pur_items`
--

DROP TABLE IF EXISTS `pur_items`;
CREATE TABLE IF NOT EXISTS `pur_items` (
  `pID` int(11) NOT NULL,
  `piID` int(11) NOT NULL,
  PRIMARY KEY (`pID`,`piID`),
  KEY `puritems piID_idx` (`piID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pur_items`
--

INSERT INTO `pur_items` (`pID`, `piID`) VALUES
(36, 49);

-- --------------------------------------------------------

--
-- Table structure for table `reconciliation`
--

DROP TABLE IF EXISTS `reconciliation`;
CREATE TABLE IF NOT EXISTS `reconciliation` (
  `reID` int(11) NOT NULL AUTO_INCREMENT,
  `reDate` date NOT NULL,
  `reDateRecorded` datetime NOT NULL,
  PRIMARY KEY (`reID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reconciliation`
--

INSERT INTO `reconciliation` (`reID`, `reDate`, `reDateRecorded`) VALUES
(9, '2019-07-18', '2019-07-18 13:22:44'),
(10, '2019-07-18', '2019-07-18 13:57:51');

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

DROP TABLE IF EXISTS `returns`;
CREATE TABLE IF NOT EXISTS `returns` (
  `rID` int(11) NOT NULL AUTO_INCREMENT,
  `rDate` date NOT NULL,
  `rDateRecorded` datetime NOT NULL,
  `spID` int(11) NOT NULL,
  `spAltName` varchar(65) DEFAULT NULL,
  `rTotal` double NOT NULL,
  PRIMARY KEY (`rID`),
  KEY `return spID_idx` (`spID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `return_items`
--

DROP TABLE IF EXISTS `return_items`;
CREATE TABLE IF NOT EXISTS `return_items` (
  `riID` int(11) NOT NULL AUTO_INCREMENT,
  `rID` int(11) NOT NULL,
  `riStatus` enum('resolved','replaced','refunded','pending') NOT NULL,
  `returnReference` varchar(45) DEFAULT NULL,
  `replacementReference` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`riID`),
  KEY `return_items rID_idx` (`rID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spoiledmenu`
--

DROP TABLE IF EXISTS `spoiledmenu`;
CREATE TABLE IF NOT EXISTS `spoiledmenu` (
  `prID` int(11) NOT NULL,
  `msID` int(11) NOT NULL,
  `osID` int(11) DEFAULT NULL,
  `msQty` int(11) NOT NULL,
  `msDate` date NOT NULL,
  `msRemarks` longtext NOT NULL,
  PRIMARY KEY (`prID`,`msID`),
  KEY `spoiledmenuMsID_idx` (`msID`),
  KEY `spoiledmenuOsID_idx` (`osID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spoiledstock`
--

DROP TABLE IF EXISTS `spoiledstock`;
CREATE TABLE IF NOT EXISTS `spoiledstock` (
  `siID` int(11) NOT NULL AUTO_INCREMENT,
  `sID` int(11) NOT NULL,
  PRIMARY KEY (`siID`),
  KEY `spoilage_items sID_idx` (`sID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spoiledstock`
--

INSERT INTO `spoiledstock` (`siID`, `sID`) VALUES
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `stockitems`
--

DROP TABLE IF EXISTS `stockitems`;
CREATE TABLE IF NOT EXISTS `stockitems` (
  `stID` int(11) NOT NULL AUTO_INCREMENT,
  `ctID` int(11) NOT NULL,
  `uomID` int(11) NOT NULL,
  `stName` varchar(64) NOT NULL,
  `stQty` int(11) NOT NULL,
  `stMin` int(11) NOT NULL,
  `stSize` varchar(24) DEFAULT NULL,
  `stLocation` enum('kitchen','stockroom') NOT NULL,
  `stStatus` enum('available','unavailable','archived') NOT NULL,
  `stBqty` int(11) NOT NULL,
  `stType` enum('liquid','solid') NOT NULL,
  PRIMARY KEY (`stID`),
  KEY `stockCategoryID_idx` (`ctID`),
  KEY `stockUomID_idx` (`uomID`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stockitems`
--

INSERT INTO `stockitems` (`stID`, `ctID`, `uomID`, `stName`, `stQty`, `stMin`, `stSize`, `stLocation`, `stStatus`, `stBqty`, `stType`) VALUES
(34, 13, 3, 'Chocolate Sauce', 9, 5, '500ml', 'stockroom', 'available', 9, 'liquid'),
(35, 13, 3, 'Caramel Sauce', 9, 5, '500ml', 'stockroom', 'available', 9, 'liquid'),
(36, 13, 3, 'Strawberry Sauce', 9, 5, '500ml', 'stockroom', 'available', 9, 'liquid'),
(37, 14, 3, 'Hazelnut Syrup', 9, 5, '500ml', 'stockroom', 'available', 9, 'liquid'),
(38, 14, 3, 'Vanilla Syrup', 9, 5, '500ml', 'stockroom', 'available', 9, 'liquid'),
(39, 15, 7, 'Matcha Powder', 3, 2, '1kg', 'stockroom', 'available', 3, 'solid'),
(40, 16, 7, 'Espresso Coffee Beans', 7, 5, '1kg', 'stockroom', 'available', 9, 'solid'),
(41, 16, 7, 'Benguet Coffee Beans', 12, 5, '1kg', 'stockroom', 'available', 7, 'solid'),
(42, 16, 7, 'Kalinga Coffee Beans', 7, 5, '1kg', 'stockroom', 'available', 9, 'solid'),
(43, 16, 7, 'Sagada Coffee Beans', 7, 5, '1kg', 'stockroom', 'available', 9, 'solid'),
(44, 16, 7, 'Medium Roast Coffee Beans', 7, 5, '1kg', 'stockroom', 'available', 9, 'solid'),
(45, 16, 7, 'Dark Roast Coffee Beans', 7, 5, '1kg', 'stockroom', 'available', 9, 'solid'),
(46, 17, 7, 'Honey Coated Lemon Tea', 25, 10, '', 'stockroom', 'available', 25, 'solid'),
(47, 17, 7, 'Chamomile Tea', 25, 10, '', 'stockroom', 'available', 25, 'solid'),
(48, 17, 7, 'Pakpakyaw Pea Tea', 25, 10, '', 'stockroom', 'available', 25, 'solid'),
(49, 18, 13, 'Mango Juice', 31, 12, '250ml', 'stockroom', 'available', 31, 'liquid'),
(50, 18, 13, 'Pineapple Juice', 31, 12, '250ml', 'stockroom', 'available', 31, 'liquid'),
(51, 18, 3, 'Coke', 34, 12, '250ml', 'stockroom', 'available', 34, 'liquid'),
(52, 18, 3, 'Sprite', 31, 12, '250ml', 'stockroom', 'available', 31, 'liquid'),
(53, 18, 3, 'Royal', 31, 12, '250ml', 'stockroom', 'available', 31, 'liquid'),
(54, 18, 3, 'Purified Bottled Water', 31, 12, '500ml', 'stockroom', 'available', 31, 'liquid'),
(55, 24, 3, 'Frappe', 9, 3, '', 'stockroom', 'available', 9, 'solid'),
(56, 24, 4, 'Milk', 9, 5, '1l', 'stockroom', 'available', 9, 'liquid'),
(57, 28, 9, 'Chocolate Cake', 8, 0, '', 'stockroom', 'available', 8, 'solid'),
(58, 13, 8, 'Pesto Sauce', 1, 0, '', 'kitchen', 'available', 1, 'solid'),
(59, 13, 8, 'Carbonara Sauce', 1, 0, '', 'kitchen', 'available', 1, 'solid'),
(60, 13, 8, 'Italian Sauce', 1, 0, '', 'kitchen', 'available', 1, 'solid'),
(61, 22, 9, 'Baby Back', 8, 10, '', 'kitchen', 'available', 8, 'solid'),
(62, 22, 9, 'Chicken', 28, 10, '', 'kitchen', 'available', 28, 'solid'),
(63, 22, 9, 'Chicken Wings', 76, 10, '', 'kitchen', 'available', 28, 'solid'),
(64, 22, 10, 'Burger Patty', 28, 10, '', 'kitchen', 'available', 28, 'solid'),
(65, 23, 8, 'Spaghetti Pasta', 8, 5, '', 'kitchen', 'available', 8, 'solid'),
(66, 16, 7, 'Cagayan Coffee Beans', 9, 5, '1kg', 'stockroom', 'available', 9, 'solid');

-- --------------------------------------------------------

--
-- Table structure for table `stockspoil`
--

DROP TABLE IF EXISTS `stockspoil`;
CREATE TABLE IF NOT EXISTS `stockspoil` (
  `sID` int(11) NOT NULL AUTO_INCREMENT,
  `msID` int(11) DEFAULT NULL,
  `sDate` date NOT NULL,
  `sDateRecorded` datetime NOT NULL,
  PRIMARY KEY (`sID`),
  KEY `stockspoil msID_idx` (`msID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stockspoil`
--

INSERT INTO `stockspoil` (`sID`, `msID`, `sDate`, `sDateRecorded`) VALUES
(3, NULL, '2019-07-18', '2019-07-18 14:16:03');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `spID` int(11) NOT NULL AUTO_INCREMENT,
  `spName` varchar(45) NOT NULL,
  `spContactNum` varchar(20) NOT NULL,
  `spEmail` varchar(45) DEFAULT NULL,
  `spStatus` enum('active','inactive','archived') NOT NULL,
  `spAddress` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`spID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`spID`, `spName`, `spContactNum`, `spEmail`, `spStatus`, `spAddress`) VALUES
(11, 'Magnolia', '09212348331', 'magnolia@gmail.com', 'active', 'Manila Philippines Inc.');

-- --------------------------------------------------------

--
-- Table structure for table `suppliermerchandise`
--

DROP TABLE IF EXISTS `suppliermerchandise`;
CREATE TABLE IF NOT EXISTS `suppliermerchandise` (
  `spmID` int(11) NOT NULL AUTO_INCREMENT,
  `spID` int(11) NOT NULL,
  `stID` int(11) NOT NULL,
  `uomID` int(11) NOT NULL,
  `spmName` varchar(45) NOT NULL,
  `spmPrice` double NOT NULL,
  `spmActual` int(11) NOT NULL,
  PRIMARY KEY (`spmID`),
  KEY `suppliermerchandiseSpID_idx` (`spID`),
  KEY `suppliermerchandiseUomID_idx` (`uomID`),
  KEY `suppliermerchandisestID_idx` (`stID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliermerchandise`
--

INSERT INTO `suppliermerchandise` (`spmID`, `spID`, `stID`, `uomID`, `spmName`, `spmPrice`, `spmActual`) VALUES
(11, 11, 63, 12, 'Magnolia Chicken', 160, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

DROP TABLE IF EXISTS `tables`;
CREATE TABLE IF NOT EXISTS `tables` (
  `tableCode` varchar(11) NOT NULL,
  PRIMARY KEY (`tableCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`tableCode`) VALUES
('t1'),
('t2'),
('t3'),
('t4'),
('t5'),
('t6'),
('v10'),
('v11'),
('v12'),
('v7'),
('v8'),
('v9');

-- --------------------------------------------------------

--
-- Table structure for table `transitems`
--

DROP TABLE IF EXISTS `transitems`;
CREATE TABLE IF NOT EXISTS `transitems` (
  `tiID` int(11) NOT NULL AUTO_INCREMENT,
  `tiType` enum('purchase order','restock','consumed','spoilage','return','beginning','other') NOT NULL,
  `tiQty` int(11) DEFAULT NULL,
  `tiActual` int(11) NOT NULL,
  `tiSubtotal` double DEFAULT NULL,
  `remainingQty` int(11) DEFAULT NULL,
  `discrepancy` int(11) DEFAULT NULL,
  `tiRemarks` longtext,
  `tiDate` date NOT NULL,
  `dateRecorded` datetime NOT NULL,
  `tiDiscount` double DEFAULT NULL,
  `stID` int(11) DEFAULT NULL,
  `spmID` int(11) DEFAULT NULL,
  `riID` int(11) DEFAULT NULL,
  `piID` int(11) DEFAULT NULL,
  `ciID` int(11) DEFAULT NULL,
  `siID` int(11) DEFAULT NULL,
  `reID` int(11) DEFAULT NULL,
  `diID` int(11) DEFAULT NULL,
  PRIMARY KEY (`tiID`),
  KEY `transitems spmID_idx` (`spmID`),
  KEY `transitems riID_idx` (`riID`),
  KEY `transitems piID_idx` (`piID`),
  KEY `transitems ciID_idx` (`ciID`),
  KEY `transitems siID_idx` (`siID`),
  KEY `transitems reID_idx` (`reID`),
  KEY `transitems stID_idx` (`stID`),
  KEY `transitems diID_idx` (`diID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transitems`
--

INSERT INTO `transitems` (`tiID`, `tiType`, `tiQty`, `tiActual`, `tiSubtotal`, `remainingQty`, `discrepancy`, `tiRemarks`, `tiDate`, `dateRecorded`, `tiDiscount`, `stID`, `spmID`, `riID`, `piID`, `ciID`, `siID`, `reID`, `diID`) VALUES
(3, 'purchase order', 5, 20, 800, NULL, NULL, NULL, '2019-07-21', '0000-00-00 00:00:00', NULL, 63, 11, NULL, 49, NULL, NULL, NULL, NULL),
(6, 'restock', 3, 12, 480, 68, NULL, NULL, '2019-07-21', '2019-07-21 22:12:39', NULL, 63, 11, NULL, 49, NULL, NULL, NULL, 3),
(7, 'restock', 2, 8, 320, 76, NULL, NULL, '2019-07-21', '2019-07-21 22:17:35', NULL, 63, 11, NULL, 49, NULL, NULL, NULL, 4),
(8, 'restock', 5, 5, NULL, 12, NULL, NULL, '2019-07-21', '2019-07-21 22:34:35', NULL, 41, NULL, NULL, NULL, NULL, NULL, NULL, 5),
(9, 'restock', 5, 25, 120, 123, NULL, NULL, '2019-07-21', '2019-07-21 00:00:00', NULL, 41, NULL, NULL, NULL, NULL, NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `uom`
--

DROP TABLE IF EXISTS `uom`;
CREATE TABLE IF NOT EXISTS `uom` (
  `uomID` int(11) NOT NULL AUTO_INCREMENT,
  `uomName` varchar(45) NOT NULL,
  `uomAbbreviation` varchar(45) NOT NULL,
  `uomVariant` enum('liquid','solid') DEFAULT NULL,
  `uomStore` enum('single','set') DEFAULT NULL,
  PRIMARY KEY (`uomID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uom`
--

INSERT INTO `uom` (`uomID`, `uomName`, `uomAbbreviation`, `uomVariant`, `uomStore`) VALUES
(1, 'mililiter', 'ml', 'liquid', NULL),
(2, 'liter', 'l', 'liquid', NULL),
(3, 'bottle', 'bt', NULL, 'single'),
(4, 'carton', 'ct', NULL, 'set'),
(5, 'box', 'bx', NULL, 'set'),
(6, 'case', 'cs', NULL, 'set'),
(7, 'bag', 'bg', NULL, 'single'),
(8, 'pack', 'pck', NULL, 'single'),
(9, 'slice', 'sc', NULL, 'single'),
(10, 'piece', 'pc', NULL, 'single'),
(11, 'miligrams', 'mg', 'solid', NULL),
(12, 'kilograms', 'kg', 'solid', NULL),
(13, 'can', 'cn', 'liquid', 'single'),
(14, 'gallon', 'gl', 'liquid', 'single');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activitylog`
--
ALTER TABLE `activitylog`
  ADD CONSTRAINT `activity log aID` FOREIGN KEY (`aID`) REFERENCES `accounts` (`aID`) ON UPDATE CASCADE;

--
-- Constraints for table `addonspoil`
--
ALTER TABLE `addonspoil`
  ADD CONSTRAINT `addons aoID` FOREIGN KEY (`aoID`) REFERENCES `addons` (`aoID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `addons aosID` FOREIGN KEY (`aosID`) REFERENCES `aospoil` (`aosID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `addons osID` FOREIGN KEY (`osID`) REFERENCES `orderslips` (`osID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `super category` FOREIGN KEY (`supcatID`) REFERENCES `categories` (`ctID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `consumed_items`
--
ALTER TABLE `consumed_items`
  ADD CONSTRAINT `consumption_items cID` FOREIGN KEY (`cID`) REFERENCES `consumptions` (`cID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `spID` FOREIGN KEY (`spID`) REFERENCES `supplier` (`spID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `delivery_items`
--
ALTER TABLE `delivery_items`
  ADD CONSTRAINT `dID` FOREIGN KEY (`dID`) REFERENCES `deliveries` (`dID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts` FOREIGN KEY (`pmID`) REFERENCES `promos` (`pmID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `freebies`
--
ALTER TABLE `freebies`
  ADD CONSTRAINT `freebies pmID` FOREIGN KEY (`pmID`) REFERENCES `promos` (`pmID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu ctID` FOREIGN KEY (`ctID`) REFERENCES `categories` (`ctID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menuaddons`
--
ALTER TABLE `menuaddons`
  ADD CONSTRAINT `menuaddons aoID` FOREIGN KEY (`aoID`) REFERENCES `addons` (`aoID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menuaddons mID` FOREIGN KEY (`mID`) REFERENCES `menu` (`mID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menudiscount`
--
ALTER TABLE `menudiscount`
  ADD CONSTRAINT `menudiscount pmID` FOREIGN KEY (`pmID`) REFERENCES `promos` (`pmID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menudiscount prID` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menufreebie`
--
ALTER TABLE `menufreebie`
  ADD CONSTRAINT `menufreebie pmID` FOREIGN KEY (`pmID`) REFERENCES `promos` (`pmID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menufreebie prID` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderaddons`
--
ALTER TABLE `orderaddons`
  ADD CONSTRAINT `orderaddons aoID` FOREIGN KEY (`aoID`) REFERENCES `addons` (`aoID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderaddons olID` FOREIGN KEY (`olID`) REFERENCES `orderlists` (`olID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderlists`
--
ALTER TABLE `orderlists`
  ADD CONSTRAINT `orderlists osID` FOREIGN KEY (`osID`) REFERENCES `orderslips` (`osID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderlists prID` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON UPDATE CASCADE;

--
-- Constraints for table `orderslips`
--
ALTER TABLE `orderslips`
  ADD CONSTRAINT `ordertableCode` FOREIGN KEY (`tableCode`) REFERENCES `tables` (`tableCode`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `preferences`
--
ALTER TABLE `preferences`
  ADD CONSTRAINT `preferences mID` FOREIGN KEY (`mID`) REFERENCES `menu` (`mID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prefstock`
--
ALTER TABLE `prefstock`
  ADD CONSTRAINT `preferenceStock` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `preferenceStock stID` FOREIGN KEY (`stID`) REFERENCES `stockitems` (`stID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promoconstraint`
--
ALTER TABLE `promoconstraint`
  ADD CONSTRAINT `promoconstraint priD` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `promocontraint pmID` FOREIGN KEY (`pmID`) REFERENCES `promos` (`pmID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `spiD purchase` FOREIGN KEY (`spID`) REFERENCES `supplier` (`spID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pur_items`
--
ALTER TABLE `pur_items`
  ADD CONSTRAINT `puritems piID` FOREIGN KEY (`piID`) REFERENCES `purchase_items` (`piID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `puriyems pID` FOREIGN KEY (`pID`) REFERENCES `purchases` (`pID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `return spID` FOREIGN KEY (`spID`) REFERENCES `supplier` (`spID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `return_items`
--
ALTER TABLE `return_items`
  ADD CONSTRAINT `return_items rID` FOREIGN KEY (`rID`) REFERENCES `returns` (`rID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `spoiledmenu`
--
ALTER TABLE `spoiledmenu`
  ADD CONSTRAINT `spoiledmenuMsID` FOREIGN KEY (`msID`) REFERENCES `menuspoil` (`msID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `spoiledmenuOsID` FOREIGN KEY (`osID`) REFERENCES `orderslips` (`osID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `spoiledmenuPrID` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `spoiledstock`
--
ALTER TABLE `spoiledstock`
  ADD CONSTRAINT `spoiledstock` FOREIGN KEY (`sID`) REFERENCES `stockspoil` (`sID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stockitems`
--
ALTER TABLE `stockitems`
  ADD CONSTRAINT `stockCategoryID` FOREIGN KEY (`ctID`) REFERENCES `categories` (`ctID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `stockUomID` FOREIGN KEY (`uomID`) REFERENCES `uom` (`uomID`) ON UPDATE CASCADE;

--
-- Constraints for table `stockspoil`
--
ALTER TABLE `stockspoil`
  ADD CONSTRAINT `stockspoil msID` FOREIGN KEY (`msID`) REFERENCES `menuspoil` (`msID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `suppliermerchandise`
--
ALTER TABLE `suppliermerchandise`
  ADD CONSTRAINT `suppliermerchandiseSpID` FOREIGN KEY (`spID`) REFERENCES `supplier` (`spID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `suppliermerchandiseUomID` FOREIGN KEY (`uomID`) REFERENCES `uom` (`uomID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `suppliermerchandisestID` FOREIGN KEY (`stID`) REFERENCES `stockitems` (`stID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transitems`
--
ALTER TABLE `transitems`
  ADD CONSTRAINT `transitems ciID` FOREIGN KEY (`ciID`) REFERENCES `consumed_items` (`ciID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transitems diID` FOREIGN KEY (`diID`) REFERENCES `delivery_items` (`diID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transitems piID` FOREIGN KEY (`piID`) REFERENCES `purchase_items` (`piID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transitems reID` FOREIGN KEY (`reID`) REFERENCES `reconciliation` (`reID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transitems riID` FOREIGN KEY (`riID`) REFERENCES `return_items` (`riID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transitems siID` FOREIGN KEY (`siID`) REFERENCES `spoiledstock` (`siID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transitems spmID` FOREIGN KEY (`spmID`) REFERENCES `suppliermerchandise` (`spmID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transitems stID` FOREIGN KEY (`stID`) REFERENCES `stockitems` (`stID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
