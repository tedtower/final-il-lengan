CREATE DATABASE  IF NOT EXISTS `il-lengan3` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `il-lengan3`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: il-lengan3
-- ------------------------------------------------------
-- Server version	5.7.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `aID` int(11) NOT NULL AUTO_INCREMENT,
  `aType` enum('admin','barista','chef','customer') NOT NULL,
  `aUsername` varchar(25) NOT NULL,
  `aPassword` char(64) NOT NULL,
  `aIsOnline` enum('1','0') NOT NULL,
  `aStatus` enum('active','inactive','archived') NOT NULL,
  PRIMARY KEY (`aID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'admin','manager','manager','0','active'),(2,'barista','barista','barista','0','active'),(3,'chef','chef','chef','0','active'),(4,'customer','customer','customer','0','active');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activitylog`
--

DROP TABLE IF EXISTS `activitylog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activitylog` (
  `alID` int(11) NOT NULL AUTO_INCREMENT,
  `aID` int(11) NOT NULL,
  `alDate` datetime NOT NULL,
  `alDesc` varchar(120) NOT NULL,
  `alType` enum('add','update','archived') NOT NULL,
  `additionalRemarks` longtext,
  PRIMARY KEY (`alID`),
  KEY `activity log aID_idx` (`aID`),
  CONSTRAINT `activity log aID` FOREIGN KEY (`aID`) REFERENCES `accounts` (`aID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activitylog`
--

LOCK TABLES `activitylog` WRITE;
/*!40000 ALTER TABLE `activitylog` DISABLE KEYS */;
INSERT INTO `activitylog` VALUES (1,1,'2019-06-19 05:21:25','Admin added a stockitem spoilage.','add','Nabulok');
/*!40000 ALTER TABLE `activitylog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `addons`
--

DROP TABLE IF EXISTS `addons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addons` (
  `aoID` int(11) NOT NULL AUTO_INCREMENT,
  `aoName` varchar(45) NOT NULL,
  `aoCategory` enum('food','drinks') NOT NULL,
  `aoPrice` double NOT NULL,
  `aoStatus` enum('available','unavailable','archived') NOT NULL,
  PRIMARY KEY (`aoID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addons`
--

LOCK TABLES `addons` WRITE;
/*!40000 ALTER TABLE `addons` DISABLE KEYS */;
INSERT INTO `addons` VALUES (15,'Milk','drinks',20,'available'),(16,'Sugar','drinks',20,'archived'),(17,'Extra Rice','food',20,'available'),(18,'Extra Shot','drinks',20,'available');
/*!40000 ALTER TABLE `addons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `addonspoil`
--

DROP TABLE IF EXISTS `addonspoil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addonspoil` (
  `aoID` int(11) NOT NULL,
  `aosID` int(11) NOT NULL,
  `osID` int(11) NOT NULL,
  `aosQty` int(11) NOT NULL,
  `aosDate` date NOT NULL,
  `aosRemarks` longtext,
  PRIMARY KEY (`aoID`,`aosID`),
  KEY `addonspoil aoID_idx` (`aoID`),
  KEY `addons aosID_idx` (`aosID`),
  KEY `addons osID_idx` (`osID`),
  CONSTRAINT `addons aoID` FOREIGN KEY (`aoID`) REFERENCES `addons` (`aoID`) ON UPDATE CASCADE,
  CONSTRAINT `addons aosID` FOREIGN KEY (`aosID`) REFERENCES `aospoil` (`aosID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `addons osID` FOREIGN KEY (`osID`) REFERENCES `orderslips` (`osID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addonspoil`
--

LOCK TABLES `addonspoil` WRITE;
/*!40000 ALTER TABLE `addonspoil` DISABLE KEYS */;
/*!40000 ALTER TABLE `addonspoil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aospoil`
--

DROP TABLE IF EXISTS `aospoil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aospoil` (
  `aosID` int(11) NOT NULL AUTO_INCREMENT,
  `aosDateRecorded` datetime NOT NULL,
  `aosDate` date DEFAULT NULL,
  PRIMARY KEY (`aosID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aospoil`
--

LOCK TABLES `aospoil` WRITE;
/*!40000 ALTER TABLE `aospoil` DISABLE KEYS */;
INSERT INTO `aospoil` VALUES (1,'2019-04-29 10:00:00',NULL),(2,'2019-04-29 16:17:00',NULL),(3,'2019-04-30 00:00:00',NULL),(4,'2019-04-30 00:00:00',NULL),(5,'2019-05-08 00:00:00',NULL);
/*!40000 ALTER TABLE `aospoil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `ctID` int(11) NOT NULL AUTO_INCREMENT,
  `supcatID` int(11) DEFAULT NULL,
  `ctName` varchar(45) NOT NULL,
  `ctType` enum('menu','inventory') NOT NULL,
  `ctStatus` enum('active','archived') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`ctID`),
  KEY `super category_idx` (`supcatID`),
  CONSTRAINT `super category` FOREIGN KEY (`supcatID`) REFERENCES `categories` (`ctID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,NULL,'Meals','menu','active'),(2,NULL,'Drinks','menu','active'),(3,NULL,'Desserts','menu','active'),(4,1,'Pasta','menu','active'),(5,1,'Ala Carte','menu','active'),(6,1,'Combo (w/ Rice, Buttered Veggie & Egg)','menu','active'),(7,1,'Tamtaman (Samplers)','menu','active'),(8,1,'Gagay-yem (Barkada Meals)','menu','active'),(9,2,'Frappe','menu','active'),(10,2,'Espresso','menu','active'),(11,2,'French-Pressed (Brewed)','menu','active'),(12,2,'Hot and Cold Drinks','menu','active'),(13,NULL,'Sauce','inventory','active'),(14,NULL,'Syrup','inventory','active'),(15,NULL,'Powder','inventory','active'),(16,NULL,'Bean','inventory','active'),(17,NULL,'Tea','inventory','active'),(18,NULL,'Refreshment','inventory','active'),(19,18,'Soda','inventory','active'),(20,18,'Water','inventory','active'),(21,18,'Juice','inventory','active'),(22,NULL,'Meat','inventory','active'),(23,NULL,'Pasta','inventory','active'),(24,NULL,'Condiments','inventory','active'),(27,3,'Cakes','menu','active'),(28,NULL,'Cakes','inventory','active'),(29,NULL,'Frappe','inventory','active'),(30,22,'Pork','inventory','active');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consumed_items`
--

DROP TABLE IF EXISTS `consumed_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consumed_items` (
  `ciID` int(11) NOT NULL AUTO_INCREMENT,
  `cID` int(11) NOT NULL,
  PRIMARY KEY (`ciID`),
  KEY `consumption_items cID_idx` (`cID`),
  CONSTRAINT `consumption_items cID` FOREIGN KEY (`cID`) REFERENCES `consumption` (`cID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consumed_items`
--

LOCK TABLES `consumed_items` WRITE;
/*!40000 ALTER TABLE `consumed_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `consumed_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consumption`
--

DROP TABLE IF EXISTS `consumption`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consumption` (
  `cID` int(11) NOT NULL AUTO_INCREMENT,
  `cDate` date NOT NULL,
  `cDateRecorded` datetime NOT NULL,
  PRIMARY KEY (`cID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consumption`
--

LOCK TABLES `consumption` WRITE;
/*!40000 ALTER TABLE `consumption` DISABLE KEYS */;
/*!40000 ALTER TABLE `consumption` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discounts` (
  `pmID` int(11) NOT NULL,
  `dcName` varchar(45) NOT NULL,
  PRIMARY KEY (`pmID`),
  KEY `index2` (`pmID`),
  CONSTRAINT `discounts` FOREIGN KEY (`pmID`) REFERENCES `promos` (`pmID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discounts`
--

LOCK TABLES `discounts` WRITE;
/*!40000 ALTER TABLE `discounts` DISABLE KEYS */;
INSERT INTO `discounts` VALUES (1,'less 20%'),(3,'less 20%');
/*!40000 ALTER TABLE `discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `freebies`
--

DROP TABLE IF EXISTS `freebies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `freebies` (
  `pmID` int(11) NOT NULL,
  `fbName` varchar(45) NOT NULL,
  `isElective` enum('0','1') NOT NULL,
  PRIMARY KEY (`pmID`),
  CONSTRAINT `freebies pmID` FOREIGN KEY (`pmID`) REFERENCES `promos` (`pmID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `freebies`
--

LOCK TABLES `freebies` WRITE;
/*!40000 ALTER TABLE `freebies` DISABLE KEYS */;
INSERT INTO `freebies` VALUES (2,'Buy 1 take 1','0'),(3,'Buy 1 take 1','0');
/*!40000 ALTER TABLE `freebies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `mID` int(11) NOT NULL AUTO_INCREMENT,
  `ctID` int(11) NOT NULL,
  `mName` varchar(64) NOT NULL,
  `mDesc` varchar(120) DEFAULT NULL,
  `mAvailability` enum('available','unavailable','archived') NOT NULL,
  `mImage` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`mID`),
  KEY `menu ctID_idx` (`ctID`),
  CONSTRAINT `menu ctID` FOREIGN KEY (`ctID`) REFERENCES `categories` (`ctID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (4,8,'Set A: Nachos (Gaygay-yem)',NULL,'available','Nachos.jpg'),(5,8,'6pcs. Fried Chicken w/ Mojos',NULL,'unavailable',''),(6,8,'3pcs. Fried Chicken & 3pcs. Buffalo Chicken w/ Mojos',NULL,'available',NULL),(9,6,'2pc. Fried Chicken',NULL,'available','Chicken.jpg'),(10,6,'2pc. Buffalo Chicken',NULL,'available','Buffalo.jpg'),(16,5,'Animal Fries','fries  that is fried to look like animal','available','Animal.jpg'),(26,4,'Carbonara Pasta',NULL,'available','Carbonara.jpg'),(42,9,'Matcha Frappe',NULL,'available','MatchaIced.jpg'),(44,10,'Americano',NULL,'available','Coffee.jpg'),(50,11,'Benguet Coffee',NULL,'available','Black.jpg'),(57,12,'Coca Cola',NULL,'unavailable','Coke.jpeg'),(75,27,' Blueberry Cake','','available','Cake.jpg'),(76,27,'Chocolate Cake','w/ hazelnut','available','Cake2.jpg'),(77,12,'Fruity juice',NULL,'available','Fruit.jpg'),(78,12,'Lemon juice',NULL,'available','Lemon.jpg'),(79,10,'Cappuccino',NULL,'available','Cappuccino.jpg'),(80,12,'Hot Choco',NULL,'available','Choco.jpg'),(81,9,'Strawberry Frappe','Non-coffee based','available','Strawberry.jpg'),(82,27,'Wicked Oreos',NULL,'available','Oreos.jpg'),(83,27,'Crepe',NULL,'available','Crepe.jpg'),(84,27,'Turon ala Mode',NULL,'available','Turon.jpg'),(85,10,'Long Black / Americano',NULL,'available','Black.jpg'),(86,9,'Cafe Latte',NULL,'available','Frappe.jpg'),(87,4,'Pesto',NULL,'available','Pesto.jpg'),(88,5,'French Fries',NULL,'available','Fries.jpg'),(89,5,'Bacon Cheese Burger',NULL,'available','Burger.jpg'),(90,4,'Italian ',NULL,'available','Italian.jpg'),(91,5,'Fish Fillet ','w/ Mango Sauce','available','Fillet.jpg'),(92,5,'Chicken Quesadilla',NULL,'available','Quesadilla.jpg'),(93,5,'Fresh Lumpia',NULL,'available','Lumpia.jpg'),(94,5,'Fish and Chips',NULL,'available','Chips.jpg'),(95,5,'Clubhouse Sandwich',NULL,'available','Sandwich.png'),(96,5,'Waffles and Bacon',NULL,'available','Waffle.jpg'),(97,5,'Chicken Sandwich',NULL,'available','SandwichChick.jpg'),(98,6,'Baby back ribs',NULL,'available','Ribs.jpg'),(99,7,'Set A: Fries','','available','Fries.jpg'),(100,7,'Set A: Nachos','','available','Nachos.jpg'),(101,7,'Set B: Quesadilla','','available','Quesadilla.jpg'),(102,7,'Set B: Fries','','available','Fries.jpg'),(103,7,'Set B: Nachos','','available','Nachos.jpg'),(104,7,'Set C: Wicked Oreos',NULL,'available','Oreos.jpg'),(105,7,'Set C: Turon',NULL,'available','Turon.jpg'),(106,8,'Set A: Clubhouse (Gaygay-yem)',NULL,'available','Sandwich.png'),(107,8,'Set A: Fries (Gaygay-yem)',NULL,'available','Fries.jpg'),(108,8,'Set B: 6 pcs Fried Chicken (Gaygay-yem)',NULL,'available','Chicken.jpg'),(109,8,'Set C: 3 pcs Fried Chicken',NULL,'available','Chicken.jpg'),(110,8,'Set C: 3pcs Buffalo Chicken with Mojos',NULL,'available','Buffalo.jpg');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menuaddons`
--

DROP TABLE IF EXISTS `menuaddons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menuaddons` (
  `mID` int(11) NOT NULL,
  `aoID` int(11) NOT NULL,
  PRIMARY KEY (`mID`,`aoID`),
  KEY `menuaddons mID_idx` (`mID`),
  KEY `menuaddons aoID_idx` (`aoID`),
  CONSTRAINT `menuaddons aoID` FOREIGN KEY (`aoID`) REFERENCES `addons` (`aoID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menuaddons mID` FOREIGN KEY (`mID`) REFERENCES `menu` (`mID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menuaddons`
--

LOCK TABLES `menuaddons` WRITE;
/*!40000 ALTER TABLE `menuaddons` DISABLE KEYS */;
INSERT INTO `menuaddons` VALUES (9,17),(10,17),(44,18),(50,15),(79,15),(98,17);
/*!40000 ALTER TABLE `menuaddons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menudiscount`
--

DROP TABLE IF EXISTS `menudiscount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menudiscount` (
  `pmID` int(11) NOT NULL,
  `prID` int(11) NOT NULL,
  `dcAmount` double NOT NULL,
  PRIMARY KEY (`pmID`,`prID`),
  KEY `menudiscount prID_idx` (`prID`),
  CONSTRAINT `menudiscount pmID` FOREIGN KEY (`pmID`) REFERENCES `promos` (`pmID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menudiscount prID` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menudiscount`
--

LOCK TABLES `menudiscount` WRITE;
/*!40000 ALTER TABLE `menudiscount` DISABLE KEYS */;
/*!40000 ALTER TABLE `menudiscount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menufreebie`
--

DROP TABLE IF EXISTS `menufreebie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menufreebie` (
  `pmID` int(11) NOT NULL,
  `prID` int(11) NOT NULL,
  `fbQty` int(11) NOT NULL,
  PRIMARY KEY (`pmID`,`prID`),
  KEY `menufreebie prID_idx` (`prID`),
  CONSTRAINT `menufreebie pmID` FOREIGN KEY (`pmID`) REFERENCES `promos` (`pmID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menufreebie prID` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menufreebie`
--

LOCK TABLES `menufreebie` WRITE;
/*!40000 ALTER TABLE `menufreebie` DISABLE KEYS */;
/*!40000 ALTER TABLE `menufreebie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menuspoil`
--

DROP TABLE IF EXISTS `menuspoil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menuspoil` (
  `msID` int(11) NOT NULL AUTO_INCREMENT,
  `msDate` date DEFAULT NULL,
  `msDateRecorded` datetime NOT NULL,
  PRIMARY KEY (`msID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menuspoil`
--

LOCK TABLES `menuspoil` WRITE;
/*!40000 ALTER TABLE `menuspoil` DISABLE KEYS */;
INSERT INTO `menuspoil` VALUES (1,NULL,'2019-04-30 00:00:00');
/*!40000 ALTER TABLE `menuspoil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderaddons`
--

DROP TABLE IF EXISTS `orderaddons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderaddons` (
  `aoID` int(11) NOT NULL,
  `olID` int(11) NOT NULL,
  `aoQty` int(11) NOT NULL,
  `aoTotal` double NOT NULL,
  PRIMARY KEY (`aoID`,`olID`),
  KEY `orderaddons aoID_idx` (`aoID`),
  KEY `orderaddons olID_idx` (`olID`),
  CONSTRAINT `orderaddons aoID` FOREIGN KEY (`aoID`) REFERENCES `addons` (`aoID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orderaddons olID` FOREIGN KEY (`olID`) REFERENCES `orderlists` (`olID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderaddons`
--

LOCK TABLES `orderaddons` WRITE;
/*!40000 ALTER TABLE `orderaddons` DISABLE KEYS */;
INSERT INTO `orderaddons` VALUES (17,1,2,40);
/*!40000 ALTER TABLE `orderaddons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderlists`
--

DROP TABLE IF EXISTS `orderlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderlists` (
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
  KEY `orderlists osID_idx` (`osID`),
  CONSTRAINT `orderlists osID` FOREIGN KEY (`osID`) REFERENCES `orderslips` (`osID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orderlists prID` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderlists`
--

LOCK TABLES `orderlists` WRITE;
/*!40000 ALTER TABLE `orderlists` DISABLE KEYS */;
INSERT INTO `orderlists` VALUES (1,2,1,'',2,310,'served','I love it',310,0),(3,2,3,'2pc. Fried Chicken Normal',2,270,'pending','',135,0),(4,2,4,'2pc. Fried Chicken ',10,1350,'served',' ',135,0);
/*!40000 ALTER TABLE `orderlists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderslips`
--

DROP TABLE IF EXISTS `orderslips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderslips` (
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
  KEY `ordertableCode_idx` (`tableCode`),
  CONSTRAINT `ordertableCode` FOREIGN KEY (`tableCode`) REFERENCES `tables` (`tableCode`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderslips`
--

LOCK TABLES `orderslips` WRITE;
/*!40000 ALTER TABLE `orderslips` DISABLE KEYS */;
INSERT INTO `orderslips` VALUES (1,'t6','carla',310,'unpaid','2019-06-16 20:09:27','0000-00-00 00:00:00','2019-06-16 20:09:27',0),(2,'t5','',0,'unpaid','2019-06-17 00:44:11','0000-00-00 00:00:00','2019-06-17 00:44:11',0),(3,'t1','Ted',270,'unpaid','2019-06-19 05:02:37','0000-00-00 00:00:00','2019-06-19 05:02:37',0),(4,'t1','Marvin',4950,'paid','2019-06-25 00:00:00','2019-06-25 00:00:00','2019-06-25 12:20:04',0);
/*!40000 ALTER TABLE `orderslips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preferences`
--

DROP TABLE IF EXISTS `preferences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preferences` (
  `prID` int(11) NOT NULL AUTO_INCREMENT,
  `mID` int(11) NOT NULL,
  `prName` varchar(64) NOT NULL,
  `mTemp` enum('h','c','hc') DEFAULT NULL,
  `prPrice` double NOT NULL,
  `prStatus` enum('available','unavailable','archived') NOT NULL,
  PRIMARY KEY (`prID`),
  KEY `preferences mID_idx` (`mID`),
  CONSTRAINT `preferences mID` FOREIGN KEY (`mID`) REFERENCES `menu` (`mID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preferences`
--

LOCK TABLES `preferences` WRITE;
/*!40000 ALTER TABLE `preferences` DISABLE KEYS */;
INSERT INTO `preferences` VALUES (1,4,'Normal',NULL,90,'available'),(2,9,'Normal',NULL,135,'available'),(3,10,'Normal',NULL,135,'available'),(4,16,'Normal',NULL,135,'available'),(5,26,'Normal',NULL,125,'available'),(6,42,'Normal',NULL,110,'available'),(7,44,'Solo','h',85,'available'),(8,44,'Jumbo','h',180,'available'),(9,50,'Solo','h',85,'available'),(10,50,'Jumbo','h',180,'available'),(11,57,'Solo','c',25,'available'),(12,57,'Jumbo','c',50,'available'),(13,75,'Normal',NULL,125,'available'),(14,76,'Normal',NULL,130,'available'),(15,77,'Solo','c',55,'available'),(16,78,'Solo','c',55,'available'),(17,77,'Jumbo','c',125,'available'),(18,78,'Jumbo','c',125,'available'),(19,79,'Normal',NULL,95,'available'),(20,80,'Normal','h',95,'available'),(21,81,'Normal',NULL,105,'available'),(22,82,'Normal',NULL,95,'available'),(23,83,'Normal',NULL,125,'available'),(24,84,'Normal',NULL,105,'available'),(25,85,'Normal',NULL,95,'available'),(26,86,'Normal',NULL,110,'available'),(27,87,'Normal',NULL,130,'available'),(28,88,'Normal',NULL,125,'available'),(29,89,'Normal',NULL,125,'available'),(30,90,'Normal',NULL,130,'available'),(31,91,'Normal',NULL,120,'available'),(32,92,'Normal',NULL,125,'available'),(33,93,'Normal',NULL,110,'available'),(34,94,'Normal',NULL,110,'available'),(35,95,'Normal',NULL,110,'available'),(36,96,'Normal',NULL,110,'available'),(37,97,'Normal',NULL,120,'available'),(38,98,'Normal',NULL,135,'available'),(39,99,'Normal',NULL,95,'available'),(40,100,'Normal',NULL,95,'available'),(43,102,'Normal',NULL,95,'available'),(44,103,'Normal',NULL,95,'available'),(45,101,'Normal',NULL,95,'available'),(46,104,'Normal',NULL,95,'available'),(47,105,'Normal',NULL,95,'available'),(48,106,'Normal',NULL,90,'available'),(49,107,'Normal',NULL,90,'available'),(50,108,'Normal',NULL,90,'available'),(51,109,'Normal',NULL,90,'available'),(52,110,'Normal',NULL,90,'available');
/*!40000 ALTER TABLE `preferences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prefstock`
--

DROP TABLE IF EXISTS `prefstock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prefstock` (
  `prID` int(11) NOT NULL,
  `stID` int(11) NOT NULL,
  `prstQty` int(11) NOT NULL,
  PRIMARY KEY (`prID`,`stID`),
  KEY `affectedStock_idx` (`stID`),
  CONSTRAINT `affectedStock` FOREIGN KEY (`stID`) REFERENCES `stockitems` (`stID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `preferenceStock` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prefstock`
--

LOCK TABLES `prefstock` WRITE;
/*!40000 ALTER TABLE `prefstock` DISABLE KEYS */;
INSERT INTO `prefstock` VALUES (2,34,2),(3,34,2);
/*!40000 ALTER TABLE `prefstock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promoconstraint`
--

DROP TABLE IF EXISTS `promoconstraint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promoconstraint` (
  `pmID` int(11) NOT NULL,
  `prID` int(11) NOT NULL,
  `pcType` enum('f','d','fd') NOT NULL,
  `pcQty` int(11) NOT NULL,
  PRIMARY KEY (`pmID`,`prID`),
  KEY `promocons pmID_idx` (`pmID`),
  KEY `promocons mID_idx` (`prID`),
  CONSTRAINT `promoconstraint priD` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `promocontraint pmID` FOREIGN KEY (`pmID`) REFERENCES `promos` (`pmID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promoconstraint`
--

LOCK TABLES `promoconstraint` WRITE;
/*!40000 ALTER TABLE `promoconstraint` DISABLE KEYS */;
/*!40000 ALTER TABLE `promoconstraint` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promos`
--

DROP TABLE IF EXISTS `promos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promos` (
  `pmID` int(11) NOT NULL AUTO_INCREMENT,
  `pmName` varchar(64) NOT NULL,
  `pmStartDate` date NOT NULL,
  `pmEndDate` date NOT NULL,
  `freebie` char(1) DEFAULT NULL,
  `discount` char(1) DEFAULT NULL,
  `status` enum('enabled','disabled','archived') NOT NULL,
  PRIMARY KEY (`pmID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promos`
--

LOCK TABLES `promos` WRITE;
/*!40000 ALTER TABLE `promos` DISABLE KEYS */;
INSERT INTO `promos` VALUES (1,'Graduation Promo','2019-04-30','2019-05-01',NULL,'y','enabled'),(2,'Valentines Promo','2019-02-14','2019-02-15','y',NULL,'disabled'),(3,'Christmas Promo','2019-12-24','2019-12-25','y','y','disabled');
/*!40000 ALTER TABLE `promos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_items`
--

DROP TABLE IF EXISTS `purchase_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchase_items` (
  `piID` int(11) NOT NULL AUTO_INCREMENT,
  `pID` int(11) NOT NULL,
  `piStatus` enum('peding','partially delivered','delivered') DEFAULT NULL,
  PRIMARY KEY (`piID`),
  KEY `purchase_items pID_idx` (`pID`),
  CONSTRAINT `purchase_items pID` FOREIGN KEY (`pID`) REFERENCES `purchases` (`pID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_items`
--

LOCK TABLES `purchase_items` WRITE;
/*!40000 ALTER TABLE `purchase_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchases` (
  `pID` int(11) NOT NULL AUTO_INCREMENT,
  `spID` int(11) DEFAULT NULL,
  `receiptNo` varchar(45) DEFAULT NULL,
  `pType` enum('purchase order','delivery') NOT NULL,
  `pDate` date NOT NULL,
  `pDateRecorded` datetime NOT NULL,
  `spAltName` varchar(65) DEFAULT NULL,
  PRIMARY KEY (`pID`),
  KEY `purchases spID_idx` (`spID`),
  CONSTRAINT `purchases spID` FOREIGN KEY (`spID`) REFERENCES `supplier` (`spID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchases`
--

LOCK TABLES `purchases` WRITE;
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reconciliation`
--

DROP TABLE IF EXISTS `reconciliation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reconciliation` (
  `reID` int(11) NOT NULL AUTO_INCREMENT,
  `reDate` date NOT NULL,
  `reDateRecorded` datetime NOT NULL,
  PRIMARY KEY (`reID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reconciliation`
--

LOCK TABLES `reconciliation` WRITE;
/*!40000 ALTER TABLE `reconciliation` DISABLE KEYS */;
/*!40000 ALTER TABLE `reconciliation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `return`
--

DROP TABLE IF EXISTS `return`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `return` (
  `rID` int(11) NOT NULL AUTO_INCREMENT,
  `rDate` date NOT NULL,
  `rDateRecorded` datetime NOT NULL,
  `spID` int(11) NOT NULL,
  `spAltName` varchar(65) DEFAULT NULL,
  PRIMARY KEY (`rID`),
  KEY `return spID_idx` (`spID`),
  CONSTRAINT `return spID` FOREIGN KEY (`spID`) REFERENCES `supplier` (`spID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `return`
--

LOCK TABLES `return` WRITE;
/*!40000 ALTER TABLE `return` DISABLE KEYS */;
/*!40000 ALTER TABLE `return` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `return_items`
--

DROP TABLE IF EXISTS `return_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `return_items` (
  `riID` int(11) NOT NULL AUTO_INCREMENT,
  `rID` int(11) NOT NULL,
  `riStatus` enum('replaced','refunded','pending') NOT NULL,
  `returnReference` varchar(45) DEFAULT NULL,
  `replacementReference` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`riID`),
  KEY `return_items rID_idx` (`rID`),
  CONSTRAINT `return_items rID` FOREIGN KEY (`rID`) REFERENCES `return` (`rID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `return_items`
--

LOCK TABLES `return_items` WRITE;
/*!40000 ALTER TABLE `return_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `return_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spoilage`
--

DROP TABLE IF EXISTS `spoilage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spoilage` (
  `sID` int(11) NOT NULL AUTO_INCREMENT,
  `sDate` date NOT NULL,
  `sDateRecorded` datetime NOT NULL,
  PRIMARY KEY (`sID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spoilage`
--

LOCK TABLES `spoilage` WRITE;
/*!40000 ALTER TABLE `spoilage` DISABLE KEYS */;
/*!40000 ALTER TABLE `spoilage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spoiled_items`
--

DROP TABLE IF EXISTS `spoiled_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spoiled_items` (
  `siID` int(11) NOT NULL AUTO_INCREMENT,
  `sID` int(11) NOT NULL,
  PRIMARY KEY (`siID`),
  KEY `spoilage_items sID_idx` (`sID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spoiled_items`
--

LOCK TABLES `spoiled_items` WRITE;
/*!40000 ALTER TABLE `spoiled_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `spoiled_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spoiledmenu`
--

DROP TABLE IF EXISTS `spoiledmenu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spoiledmenu` (
  `prID` int(11) NOT NULL,
  `msID` int(11) NOT NULL,
  `osID` int(11) NOT NULL,
  `msQty` int(11) NOT NULL,
  `msDate` date NOT NULL,
  `msRemarks` longtext NOT NULL,
  PRIMARY KEY (`prID`,`msID`),
  KEY `spoiledmenuMsID_idx` (`msID`),
  KEY `spoiledmenuOsID_idx` (`osID`),
  CONSTRAINT `spoiledmenuMsID` FOREIGN KEY (`msID`) REFERENCES `menuspoil` (`msID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `spoiledmenuOsID` FOREIGN KEY (`osID`) REFERENCES `orderslips` (`osID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `spoiledmenuPrID` FOREIGN KEY (`prID`) REFERENCES `preferences` (`prID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spoiledmenu`
--

LOCK TABLES `spoiledmenu` WRITE;
/*!40000 ALTER TABLE `spoiledmenu` DISABLE KEYS */;
/*!40000 ALTER TABLE `spoiledmenu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `st_recon`
--

DROP TABLE IF EXISTS `st_recon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `st_recon` (
  `reID` int(11) NOT NULL,
  `reQty` int(11) NOT NULL,
  `reRemain` int(11) NOT NULL,
  `reDiscrepancy` int(11) NOT NULL,
  `reRemarks` longtext,
  `stID` int(11) NOT NULL,
  KEY `st_recon reID_idx` (`reID`),
  KEY `st_recon stID_idx` (`stID`),
  CONSTRAINT `st_recon reID` FOREIGN KEY (`reID`) REFERENCES `reconciliation` (`reID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `st_recon stID` FOREIGN KEY (`stID`) REFERENCES `stockitems` (`stID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `st_recon`
--

LOCK TABLES `st_recon` WRITE;
/*!40000 ALTER TABLE `st_recon` DISABLE KEYS */;
/*!40000 ALTER TABLE `st_recon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stockitems`
--

DROP TABLE IF EXISTS `stockitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stockitems` (
  `stID` int(11) NOT NULL AUTO_INCREMENT,
  `ctID` int(11) NOT NULL,
  `uomID` int(11) NOT NULL,
  `stName` varchar(64) NOT NULL,
  `stQty` int(11) NOT NULL,
  `stMin` int(11) NOT NULL,
  `stSize` varchar(24) NOT NULL,
  `stLocation` enum('kitchen','stockroom') NOT NULL,
  `stStatus` enum('available','unavailable','archived') NOT NULL,
  `stBqty` int(11) NOT NULL,
  `stType` enum('liquid','solid') NOT NULL,
  PRIMARY KEY (`stID`),
  KEY `stockCategoryID_idx` (`ctID`),
  KEY `stockUomID_idx` (`uomID`),
  CONSTRAINT `stockCategoryID` FOREIGN KEY (`ctID`) REFERENCES `categories` (`ctID`) ON UPDATE CASCADE,
  CONSTRAINT `stockUomID` FOREIGN KEY (`uomID`) REFERENCES `uom` (`uomID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stockitems`
--

LOCK TABLES `stockitems` WRITE;
/*!40000 ALTER TABLE `stockitems` DISABLE KEYS */;
INSERT INTO `stockitems` VALUES (1,21,3,'Chocolate Sauce',12,5,'1000mL','stockroom','available',20,'liquid'),(2,21,3,'Caramel Sauce',-12,5,'1000mL','stockroom','available',20,'liquid'),(3,14,3,'Hazelnut  Syrup 500 ml',29,5,'500 mL','stockroom','available',20,'liquid'),(4,14,3,'Vanilla Syrup 500 ml',25,5,'500 mL','stockroom','unavailable',25,'liquid'),(5,22,10,'Chicken Wings',15,10,'per piece','kitchen','available',15,'solid'),(6,24,4,'Milk ',16,5,'per carton','stockroom','available',16,'liquid'),(7,19,6,'Coca Cola Solo 250 mL',52,5,'','stockroom','available',20,'liquid'),(8,21,3,'Strawberry Milk Syrup',7,3,'500mL','kitchen','available',7,'liquid'),(10,19,8,'Matcha Powder',11,2,'800mg','kitchen','unavailable',11,'solid'),(13,21,8,'Tamarind Powder',13,3,'15mg','stockroom','available',13,'solid'),(14,17,7,'Honey-coated Lemon',10,5,'60kg','stockroom','available',10,'solid'),(15,21,3,'Strawberry Sauce',20,5,'1000mL','stockroom','available',20,'liquid'),(16,16,12,'Espresso Beans',10,3,' ','stockroom','available',10,'solid'),(17,16,12,'Benguet',10,3,' ','stockroom','available',10,'solid'),(18,16,12,'Kalinga',10,3,' ','stockroom','available',10,'solid'),(19,16,12,'Sagada',10,3,' ','stockroom','available',10,'solid'),(20,16,12,'Cordillera City (Medium) Roast',10,3,' ','stockroom','available',10,'solid'),(21,16,12,'Cordillera Vienna (Dark) Roast',10,3,' ','stockroom','available',10,'solid'),(22,17,7,'Chamomile',9,5,'60kg','stockroom','available',10,'solid'),(23,17,7,'Pakpakyaw (Butterfly) Pea',10,5,'60kg','stockroom','available',10,'solid'),(24,21,3,'Mango Canned Juice',10,5,' ','stockroom','available',10,'liquid'),(25,21,3,'Pineapple Canned Juice',10,5,' ','stockroom','available',10,'liquid'),(26,20,6,'Mineral Drinking Water',10,5,' ','stockroom','available',10,'liquid'),(27,28,3,'Frappe',10,5,' ','stockroom','available',10,'liquid'),(28,29,9,'Cakes',10,5,' ','stockroom','available',10,'solid'),(30,13,8,'Pesto Sauces',7,3,' ','kitchen','available',7,'liquid'),(31,13,8,'Carbonara Sauces',7,3,' ','kitchen','available',7,'liquid'),(32,13,8,'Italian Sauces',7,3,' ','kitchen','available',7,'liquid'),(33,22,10,'Baby Back',19,15,' ','kitchen','available',15,'liquid'),(34,22,10,'Chicken',-16,5,' ','kitchen','available',10,'solid'),(35,22,10,'Burger Patty',15,5,' ','kitchen','available',10,'solid'),(36,23,8,'Pasta',10,3,' ','kitchen','available',10,'solid'),(37,30,9,'Samgyupsal',0,5,'','kitchen','available',0,'solid'),(39,21,3,'Milo Syrup 100 ml',20,5,'100ml','stockroom','available',0,'liquid');
/*!40000 ALTER TABLE `stockitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier` (
  `spID` int(11) NOT NULL AUTO_INCREMENT,
  `spName` varchar(45) NOT NULL,
  `spContactNum` varchar(20) NOT NULL,
  `spEmail` varchar(45) DEFAULT NULL,
  `spStatus` enum('active','inactive','archived') NOT NULL,
  `spAddress` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`spID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES (1,'Coca Cola Inc.','09709052911','cocacola@email.com','active',NULL),(2,'Tiongsan','09454218542',NULL,'active','Latrinidad, Benguet'),(3,'Miya','09709052911',NULL,'active','Latrinidad, Benguet'),(4,'Roger','09709052911',NULL,'inactive','Bulacan'),(5,'Pomona','09817101281',NULL,'active','Baguio City');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliermerchandise`
--

DROP TABLE IF EXISTS `suppliermerchandise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suppliermerchandise` (
  `spmID` int(11) NOT NULL AUTO_INCREMENT,
  `spID` int(11) NOT NULL,
  `stID` int(11) NOT NULL,
  `uomID` int(11) NOT NULL,
  `spmName` varchar(45) NOT NULL,
  `spmPrice` double NOT NULL,
  PRIMARY KEY (`spmID`),
  KEY `suppliermerchandiseSpID_idx` (`spID`),
  KEY `suppliermerchandiseStID_idx` (`stID`),
  KEY `suppliermerchandiseUomID_idx` (`uomID`),
  CONSTRAINT `suppliermerchandiseSpID` FOREIGN KEY (`spID`) REFERENCES `supplier` (`spID`) ON UPDATE CASCADE,
  CONSTRAINT `suppliermerchandiseStID` FOREIGN KEY (`stID`) REFERENCES `stockitems` (`stID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `suppliermerchandiseUomID` FOREIGN KEY (`uomID`) REFERENCES `uom` (`uomID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliermerchandise`
--

LOCK TABLES `suppliermerchandise` WRITE;
/*!40000 ALTER TABLE `suppliermerchandise` DISABLE KEYS */;
INSERT INTO `suppliermerchandise` VALUES (1,1,2,6,'Ladys\' Choice Caramel Sauce 1000ml',350),(2,1,1,6,'Lady\'s Choice Chocolate Sauce 1000ml',350),(3,1,7,6,'Coca Cola Solo 250 ml 16',400),(4,1,3,3,'Bonus Strawberry Syrup 500ml 12',450),(5,3,10,5,'Ito Matcha Powder Box of 5',200),(6,3,13,5,'Mama Sita\'s Tamarind Powder of 5',180);
/*!40000 ALTER TABLE `suppliermerchandise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tables`
--

DROP TABLE IF EXISTS `tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tables` (
  `tableCode` varchar(11) NOT NULL,
  PRIMARY KEY (`tableCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tables`
--

LOCK TABLES `tables` WRITE;
/*!40000 ALTER TABLE `tables` DISABLE KEYS */;
INSERT INTO `tables` VALUES ('t1'),('t2'),('t3'),('t4'),('t5'),('t6'),('v10'),('v11'),('v12'),('v7'),('v8'),('v9');
/*!40000 ALTER TABLE `tables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transitems`
--

DROP TABLE IF EXISTS `transitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transitems` (
  `tiID` int(11) NOT NULL AUTO_INCREMENT,
  `tiType` enum('purchase order','restock','consumed','spoilage','other') NOT NULL,
  `tiQty` int(11) DEFAULT NULL,
  `tiActual` int(11) NOT NULL,
  `tiSubtotal` double DEFAULT NULL,
  `remainingQty` int(11) NOT NULL,
  `tiRemarks` longtext,
  `tiDate` date NOT NULL,
  `stID` int(11) DEFAULT NULL,
  `spmID` int(11) DEFAULT NULL,
  `riID` int(11) DEFAULT NULL,
  `piID` int(11) DEFAULT NULL,
  `ciID` int(11) DEFAULT NULL,
  `siID` int(11) DEFAULT NULL,
  PRIMARY KEY (`tiID`),
  KEY `transitems stID_idx` (`stID`),
  KEY `transitems spmID_idx` (`spmID`),
  KEY `transitems riID_idx` (`riID`),
  KEY `transitems piID_idx` (`piID`),
  KEY `transitems ciID_idx` (`ciID`),
  KEY `transitems siID_idx` (`siID`),
  CONSTRAINT `transitems ciID` FOREIGN KEY (`ciID`) REFERENCES `consumed_items` (`ciID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transitems piID` FOREIGN KEY (`piID`) REFERENCES `purchase_items` (`piID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transitems riID` FOREIGN KEY (`riID`) REFERENCES `return_items` (`riID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transitems siID` FOREIGN KEY (`siID`) REFERENCES `spoiled_items` (`siID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transitems spmID` FOREIGN KEY (`spmID`) REFERENCES `suppliermerchandise` (`spmID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transitems stID` FOREIGN KEY (`stID`) REFERENCES `stockitems` (`stID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transitems`
--

LOCK TABLES `transitems` WRITE;
/*!40000 ALTER TABLE `transitems` DISABLE KEYS */;
/*!40000 ALTER TABLE `transitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uom`
--

DROP TABLE IF EXISTS `uom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uom` (
  `uomID` int(11) NOT NULL AUTO_INCREMENT,
  `uomName` varchar(45) NOT NULL,
  `uomAbbreviation` varchar(45) NOT NULL,
  `uomVariant` enum('liquid','solid') DEFAULT NULL,
  `uomStore` enum('single','set') DEFAULT NULL,
  PRIMARY KEY (`uomID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uom`
--

LOCK TABLES `uom` WRITE;
/*!40000 ALTER TABLE `uom` DISABLE KEYS */;
INSERT INTO `uom` VALUES (1,'mililiter','ml','liquid',NULL),(2,'liter','l','liquid',NULL),(3,'bottle','bt',NULL,'single'),(4,'carton','ct',NULL,'set'),(5,'box','bx',NULL,'set'),(6,'case','cs',NULL,'set'),(7,'bag','bg',NULL,'single'),(8,'pack','pck',NULL,'single'),(9,'slice','sc',NULL,'single'),(10,'piece','pc',NULL,'single'),(11,'miligrams','mg','solid',NULL),(12,'kilograms','kg','solid',NULL);
/*!40000 ALTER TABLE `uom` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-29 22:50:46
