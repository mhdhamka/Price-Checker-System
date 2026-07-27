-- MariaDB dump 10.19  Distrib 10.4.22-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: db_pcs
-- ------------------------------------------------------
-- Server version	10.4.22-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL AUTO_INCREMENT,
  `adminFullname` varchar(255) NOT NULL,
  `adminUsername` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPassword` varchar(255) NOT NULL,
  `adminIMG` varchar(255) NOT NULL,
  `logStatus` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`adminID`)
) ENGINE=InnoDB AUTO_INCREMENT=2032 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'Mohd Hamka','mdhamka','hamka@gmail.com','abc123','../../assets/images/admin/hamka.jpg','1','2024-02-15 13:21:25'),(2,'Liu Yang','liuyang','liuyang@gmail.com','$2y$10$4Fg8Hj7Kp2Lm9Qs5Xz1NBuT6Yv3Wm8Rd9Lp5Qx7Za2Kf6Nc8Vb0Pw','../../assets/images/admin/liu.png','0','2024-06-21 06:15:10'),(3,'Simone Biles','simone','simone@gmail.com','$2y$10$9Lm3Xv7Qp5Rt8Nk2Hd6ZaUj4Bw1Cs9Fy7Wp3Mv6Xq8Kz2Nr5Gh0Aa','../../assets/images/admin/simeone.png','0','2025-01-12 01:45:33'),(4,'Novak Djokovic','novakdjokovic','novak@gmail.com','$2y$10$2Qa7Lm9Xv4Pc8Rt5Nz6HwUd3Jk1Bs9Fy7Wp5Mv6Xq8Kz2Nr5Gh0Bb','../../assets/images/admin/novak.png','0','2025-08-30 08:20:45'),(5,'Yuzuru Hanyu','yuzuru','yuzuru@gmail.com','$2y$10$7Lp5Xq9Vm3Rt8Nk2Hd6ZaUj4Bw1Cs9Fy7Wp5Mv6Xq8Kz2Nr5Gh0Cc','../../assets/images/admin/yuzuru.png','0','2026-03-18 03:10:15'),(2029,'Katie Ledecky','katie','katie@gmail.com','$2y$10$5Rt8Nk2Hd6ZaUj4Bw1Cs9Fy7Wp5Mv6Xq8Kz2Nr5Gh0AaLm3Xv7Q','../../assets/images/admin/katie.png','0','2026-05-22 05:35:50'),(2030,'Armand Duplantis','armand','armand@gmail.com','$2y$10$3Xv7Qp5Rt8Nk2Hd6ZaUj4Bw1Cs9Fy7Wp5Mv6Xq8Kz2Nr5Gh0AaLm','../../assets/images/admin/armand.png','0','2026-07-10 00:25:30'),(2031,'sssssssss','ssssss','sssssss@gmail.com','$2y$10$iXJTWT/Fod3vfiG6cjnVuuCcVz.djUEuB9x2OhDHZD05cHlrshAN6','../../assets/images/admin/cena.png','0','2026-07-27 16:29:05');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_logs`
--

DROP TABLE IF EXISTS `audit_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audit_logs` (
  `auditID` int(11) NOT NULL AUTO_INCREMENT,
  `adminID` int(11) NOT NULL,
  `module` varchar(100) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `ipAddress` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`auditID`),
  KEY `adminID` (`adminID`),
  CONSTRAINT `audit_logs_ibfk_1` FOREIGN KEY (`adminID`) REFERENCES `admin` (`adminID`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_logs`
--

LOCK TABLES `audit_logs` WRITE;
/*!40000 ALTER TABLE `audit_logs` DISABLE KEYS */;
INSERT INTO `audit_logs` VALUES (13,1,'Authentication','LOGIN','Admin Account','Administrator successfully logged into the system.','192.168.1.10','2026-07-20 00:15:22'),(14,1,'Product','CREATE','Coca Cola 1.5L','Added a new product with price RM5.80 under Beverage category.','192.168.1.10','2026-07-20 01:30:45'),(15,1,'Product','UPDATE','Maggi Curry Noodles','Updated product information including price and description.','192.168.1.10','2026-07-20 02:45:12'),(16,1,'Category','CREATE','Coffee','Created a new product category Coffee.','192.168.1.15','2026-07-21 03:20:33'),(17,1,'Store','CREATE','H&L Supermarket','Added a new store into the Price Checker System.','192.168.1.10','2026-07-21 05:05:40'),(18,1,'Student','DELETE','Student Account: Ahmad Rahman','Removed inactive student account from the system.','192.168.1.15','2026-07-22 01:12:18'),(19,1,'Rating','DELETE','Product Rating ID #15','Removed inappropriate product rating submitted by student.','192.168.1.10','2026-07-22 06:30:55'),(20,1,'Report','EXPORT','Item Report PDF','Generated and exported item analytics report in PDF format.','192.168.1.10','2026-07-23 02:05:26'),(21,1,'Backup','CREATE','db_pcs_backup_20260723.sql','Created a database backup file successfully.','192.168.1.15','2026-07-23 07:40:10'),(22,1,'Backup','RESTORE','db_pcs_backup_20260720.sql','Restored database using previous backup file.','192.168.1.10','2026-07-24 08:25:44'),(23,1,'Report','EXPORT','Student Registration Report Excel','Exported monthly student registration analytics into Excel format.','192.168.1.10','2026-07-25 01:50:30'),(24,1,'Authentication','LOGOUT','Admin Account','Administrator logged out from the system.','192.168.1.15','2026-07-25 09:10:05'),(25,1,'Admin','LOGOUT','Admin Account','Admin logged out from the system','::1','2026-07-27 15:49:23'),(26,1,'Admin','LOGIN','Admin Account','Admin logged into the system','::1','2026-07-27 15:49:56'),(27,1,'Admin','LOGOUT','Admin Account','Admin logged out from the system','127.0.0.1','2026-07-27 15:52:10'),(28,1,'Admin','LOGIN','Admin Account','Admin logged into the system','127.0.0.1','2026-07-27 15:52:18'),(29,1,'Admin','LOGOUT','Admin Account','Admin logged out from the system','127.0.0.1','2026-07-27 15:59:27'),(30,1,'Admin','LOGIN','Admin Account','Admin logged into the system','127.0.0.1','2026-07-27 15:59:36'),(31,1,'Item','ADD','aaaaaa','Added new item aaaaaa','127.0.0.1','2026-07-27 16:08:44'),(32,1,'Item','UPDATE','john cena bin chilling','Updated item from aaaaaa to john cena bin chilling','127.0.0.1','2026-07-27 16:10:24'),(33,1,'Item','UPDATE','Ayam Brand Tomato Sardines','Updated item from Ayam Brand Sardines in Tomato Sauce to Ayam Brand Tomato Sardines','127.0.0.1','2026-07-27 16:11:26'),(34,1,'Item','DELETE','aaaaaa','Deleted item aaaaaa','127.0.0.1','2026-07-27 16:12:25'),(35,1,'Item','DELETE','john cena bin chilling','Deleted item john cena bin chilling','127.0.0.1','2026-07-27 16:12:56'),(36,1,'Student','UPDATE','Faizatul Fitri Bin Boestamam','Reset password for student Faizatul Fitri Bin Boestamam','127.0.0.1','2026-07-27 16:18:08'),(37,1,'Student','UPDATE','Faizatul Fitri Bin Boestamam','Enabled student account Faizatul Fitri Bin Boestamam','127.0.0.1','2026-07-27 16:18:56'),(38,1,'Student','UPDATE','Faizatul Fitri Bin Boestamam','Disabled student account Faizatul Fitri Bin Boestamam','127.0.0.1','2026-07-27 16:19:01'),(39,1,'Admin','UPDATE','Mohd Hamkas','Updated admin account from Mohd Hamkas to Mohd Hamkas','127.0.0.1','2026-07-27 16:28:21'),(40,1,'Admin','UPDATE','Mohd Hamka','Updated admin account from Mohd Hamkas to Mohd Hamka','127.0.0.1','2026-07-27 16:28:38'),(41,1,'Admin','ADD','sssssssss','Added new admin account sssssssss','127.0.0.1','2026-07-27 16:29:05'),(42,1,'Admin','UPDATE','sssssssss','Reset password for admin sssssssss','127.0.0.1','2026-07-27 16:31:14'),(43,1,'Admin','UPDATE','sssssssss','Disabled admin account sssssssss','127.0.0.1','2026-07-27 16:34:07'),(44,1,'Store','UPDATE','e-Mart Summer Malls','Updated store from e-Mart Summer Mall to e-Mart Summer Malls','127.0.0.1','2026-07-27 16:42:36'),(45,1,'Store','UPDATE','e-Mart Summer Mall','Updated store from e-Mart Summer Malls to e-Mart Summer Mall','127.0.0.1','2026-07-27 16:42:49'),(46,1,'Store','ADD','dffszzfzf','Added new store dffszzfzf','127.0.0.1','2026-07-27 16:44:19'),(47,1,'Store','DELETE','dffszzfzf','Deleted store dffszzfzf','127.0.0.1','2026-07-27 16:44:56'),(48,1,'Report','EXPORT','Item Report PDF','Generated Item PDF report','127.0.0.1','2026-07-27 17:04:01'),(49,1,'Report','EXPORT','Item Report PDF','Generated Item PDF report','127.0.0.1','2026-07-27 17:04:10'),(50,1,'Report','EXPORT','Item Report PDF','Generated Item PDF report','127.0.0.1','2026-07-27 17:04:13'),(51,1,'Report','EXPORT','Item Report CSV','Generated Item report in CSV format','127.0.0.1','2026-07-27 17:20:26'),(52,1,'Report','EXPORT','Item Report CSV','Generated Item report in CSV format','127.0.0.1','2026-07-27 17:20:26');
/*!40000 ALTER TABLE `audit_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backup_logs`
--

DROP TABLE IF EXISTS `backup_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backup_logs` (
  `logID` int(11) NOT NULL AUTO_INCREMENT,
  `backupID` int(11) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `performedBy` int(11) DEFAULT NULL,
  `actionDate` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`logID`),
  KEY `backupID` (`backupID`),
  KEY `performedBy` (`performedBy`),
  CONSTRAINT `backup_logs_ibfk_1` FOREIGN KEY (`backupID`) REFERENCES `backups` (`backupID`),
  CONSTRAINT `backup_logs_ibfk_2` FOREIGN KEY (`performedBy`) REFERENCES `admin` (`adminID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup_logs`
--

LOCK TABLES `backup_logs` WRITE;
/*!40000 ALTER TABLE `backup_logs` DISABLE KEYS */;
INSERT INTO `backup_logs` VALUES (2,3,'Created Backup',1,'2026-07-26 09:16:55');
/*!40000 ALTER TABLE `backup_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backups`
--

DROP TABLE IF EXISTS `backups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backups` (
  `backupID` int(11) NOT NULL AUTO_INCREMENT,
  `fileName` varchar(255) DEFAULT NULL,
  `backupDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `fileSize` varchar(50) DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `backupStatus` varchar(20) DEFAULT 'Completed',
  PRIMARY KEY (`backupID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backups`
--

LOCK TABLES `backups` WRITE;
/*!40000 ALTER TABLE `backups` DISABLE KEYS */;
INSERT INTO `backups` VALUES (3,'database_20260726_111654.sql','2026-07-26 09:16:55','94.35 KB',1,'Completed');
/*!40000 ALTER TABLE `backups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(255) NOT NULL,
  `categoryIMG` varchar(255) NOT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Beverages','../../assets/images/category/beverages.jpeg'),(2,'Biscuits','../../assets/images/category/biscuit.jpg'),(3,'Noodles','../../assets/images/category/noodles.jpeg'),(4,'Snacks','../../assets/images/category/snacks.jpg'),(5,'Dairy Products','../../assets/images/category/dairy.png'),(6,'Frozen Foods','../../assets/images/category/frozen-foods.png'),(7,'Bread & Bakery','../../assets/images/category/bakery.jpg'),(8,'Canned Foods','../../assets/images/category/canned-foods.jpg'),(9,'Confectionery','../../assets/images/category/confectionery.png');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comparisonhistory`
--

DROP TABLE IF EXISTS `comparisonhistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comparisonhistory` (
  `historyID` int(11) NOT NULL AUTO_INCREMENT,
  `studentID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `comparedGroup` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`historyID`),
  KEY `studentID` (`studentID`),
  KEY `ItemID` (`ItemID`),
  CONSTRAINT `comparisonhistory_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE,
  CONSTRAINT `comparisonhistory_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ItemID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comparisonhistory`
--

LOCK TABLES `comparisonhistory` WRITE;
/*!40000 ALTER TABLE `comparisonhistory` DISABLE KEYS */;
INSERT INTO `comparisonhistory` VALUES (1,1,1,'CMP100001','2026-07-20 01:15:00'),(2,1,2,'CMP100001','2026-07-20 01:15:00'),(3,1,3,'CMP100001','2026-07-20 01:15:00'),(4,1,6,'CMP100002','2026-07-20 06:30:00'),(5,1,7,'CMP100002','2026-07-20 06:30:00'),(6,1,10,'CMP100003','2026-07-21 03:20:00'),(7,1,11,'CMP100003','2026-07-21 03:20:00'),(8,1,12,'CMP100003','2026-07-21 03:20:00'),(9,1,15,'CMP100004','2026-07-22 10:10:00'),(10,1,16,'CMP100004','2026-07-22 10:10:00'),(11,1,18,'CMP100005','2026-07-23 01:40:00'),(12,1,19,'CMP100005','2026-07-23 01:40:00'),(13,1,20,'CMP100005','2026-07-23 01:40:00'),(14,1,1,'CMP6a616936a7e77','2026-07-23 01:07:02'),(15,1,10,'CMP6a616936a7e77','2026-07-23 01:07:02'),(16,1,1,'CMP6a61694010272','2026-07-23 01:07:12'),(17,1,10,'CMP6a61694010272','2026-07-23 01:07:12'),(18,1,1,'CMP6a616a97dbc49','2026-07-23 01:12:55'),(19,1,10,'CMP6a616a97dbc49','2026-07-23 01:12:55'),(20,1,3,'CMP6a616b0f2dbc2','2026-07-23 01:14:55'),(21,1,9,'CMP6a616b0f2dbc2','2026-07-23 01:14:55'),(22,1,44,'CMP6a616b0f2dbc2','2026-07-23 01:14:55'),(23,1,3,'CMP6a616c92842de','2026-07-23 01:21:22'),(24,1,9,'CMP6a616c92842de','2026-07-23 01:21:22'),(25,1,44,'CMP6a616c92842de','2026-07-23 01:21:22'),(26,1,3,'CMP6a616c9696951','2026-07-23 01:21:26'),(27,1,9,'CMP6a616c9696951','2026-07-23 01:21:26'),(28,1,44,'CMP6a616c9696951','2026-07-23 01:21:26'),(29,1,3,'CMP6a616cbf4777f','2026-07-23 01:22:07'),(30,1,9,'CMP6a616cbf4777f','2026-07-23 01:22:07'),(31,1,44,'CMP6a616cbf4777f','2026-07-23 01:22:07'),(32,1,3,'CMP6a616ddd66249','2026-07-23 01:26:53'),(33,1,9,'CMP6a616ddd66249','2026-07-23 01:26:53'),(34,1,44,'CMP6a616ddd66249','2026-07-23 01:26:53'),(35,1,1,'CMP6a616e2961e15','2026-07-23 01:28:09'),(36,1,10,'CMP6a616e2961e15','2026-07-23 01:28:09'),(37,1,62,'CMP6a616e2961e15','2026-07-23 01:28:09'),(38,1,1,'CMP6a617049241e0','2026-07-23 01:37:13'),(39,1,10,'CMP6a617049241e0','2026-07-23 01:37:13'),(40,1,62,'CMP6a617049241e0','2026-07-23 01:37:13'),(41,1,1,'CMP6a617170a0882','2026-07-23 01:42:08'),(42,1,10,'CMP6a617170a0882','2026-07-23 01:42:08'),(43,1,62,'CMP6a617170a0882','2026-07-23 01:42:08'),(44,1,1,'CMP6a61727abb937','2026-07-23 01:46:34'),(45,1,10,'CMP6a61727abb937','2026-07-23 01:46:34'),(46,1,62,'CMP6a61727abb937','2026-07-23 01:46:34'),(47,1,1,'CMP6a617333c8960','2026-07-23 01:49:39'),(48,1,10,'CMP6a617333c8960','2026-07-23 01:49:39'),(49,1,62,'CMP6a617333c8960','2026-07-23 01:49:39'),(50,1,1,'CMP6a6173382c938','2026-07-23 01:49:44'),(51,1,10,'CMP6a6173382c938','2026-07-23 01:49:44'),(52,1,62,'CMP6a6173382c938','2026-07-23 01:49:44');
/*!40000 ALTER TABLE `comparisonhistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comparisonstats`
--

DROP TABLE IF EXISTS `comparisonstats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comparisonstats` (
  `ItemID` int(11) NOT NULL,
  `totalCompared` int(11) DEFAULT 0,
  `lastCompared` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ItemID`),
  CONSTRAINT `comparisonstats_ibfk_1` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ItemID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comparisonstats`
--

LOCK TABLES `comparisonstats` WRITE;
/*!40000 ALTER TABLE `comparisonstats` DISABLE KEYS */;
INSERT INTO `comparisonstats` VALUES (1,5,'2026-07-23 01:49:44'),(10,5,'2026-07-23 01:49:44'),(62,5,'2026-07-23 01:49:44');
/*!40000 ALTER TABLE `comparisonstats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forumbookmarks`
--

DROP TABLE IF EXISTS `forumbookmarks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forumbookmarks` (
  `bookmarkID` int(11) NOT NULL AUTO_INCREMENT,
  `topicID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `bookmarked_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`bookmarkID`),
  UNIQUE KEY `unique_bookmark` (`topicID`,`studentID`),
  KEY `studentID` (`studentID`),
  CONSTRAINT `forumbookmarks_ibfk_1` FOREIGN KEY (`topicID`) REFERENCES `forumtopic` (`topicID`) ON DELETE CASCADE,
  CONSTRAINT `forumbookmarks_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forumbookmarks`
--

LOCK TABLES `forumbookmarks` WRITE;
/*!40000 ALTER TABLE `forumbookmarks` DISABLE KEYS */;
INSERT INTO `forumbookmarks` VALUES (2,1,1,'2026-07-24 15:45:03'),(13,4,1,'2026-07-25 16:55:35');
/*!40000 ALTER TABLE `forumbookmarks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forumcategory`
--

DROP TABLE IF EXISTS `forumcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forumcategory` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(100) NOT NULL,
  `categoryDescription` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forumcategory`
--

LOCK TABLES `forumcategory` WRITE;
/*!40000 ALTER TABLE `forumcategory` DISABLE KEYS */;
INSERT INTO `forumcategory` VALUES (1,'General Discussion','General questions','2026-07-22 15:57:26'),(2,'Price Discussion','Discuss product prices','2026-07-22 15:57:26'),(3,'Shopping Tips','Money saving ideas','2026-07-22 15:57:26'),(4,'Suggestions','System feedback','2026-07-22 15:57:26'),(5,'Announcements','Official announcements','2026-07-22 15:57:26');
/*!40000 ALTER TABLE `forumcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forumlikes`
--

DROP TABLE IF EXISTS `forumlikes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forumlikes` (
  `likeID` int(11) NOT NULL AUTO_INCREMENT,
  `topicID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `liked_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`likeID`),
  UNIQUE KEY `topicID` (`topicID`,`studentID`),
  KEY `studentID` (`studentID`),
  CONSTRAINT `forumlikes_ibfk_1` FOREIGN KEY (`topicID`) REFERENCES `forumtopic` (`topicID`) ON DELETE CASCADE,
  CONSTRAINT `forumlikes_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forumlikes`
--

LOCK TABLES `forumlikes` WRITE;
/*!40000 ALTER TABLE `forumlikes` DISABLE KEYS */;
INSERT INTO `forumlikes` VALUES (6,1,1,'2026-07-25 16:32:03'),(8,4,1,'2026-07-25 16:55:43'),(9,2,1,'2026-07-25 16:55:54');
/*!40000 ALTER TABLE `forumlikes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forumreply`
--

DROP TABLE IF EXISTS `forumreply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forumreply` (
  `replyID` int(11) NOT NULL AUTO_INCREMENT,
  `topicID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `replyContent` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`replyID`),
  KEY `topicID` (`topicID`),
  KEY `studentID` (`studentID`),
  CONSTRAINT `forumreply_ibfk_1` FOREIGN KEY (`topicID`) REFERENCES `forumtopic` (`topicID`) ON DELETE CASCADE,
  CONSTRAINT `forumreply_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forumreply`
--

LOCK TABLES `forumreply` WRITE;
/*!40000 ALTER TABLE `forumreply` DISABLE KEYS */;
INSERT INTO `forumreply` VALUES (1,1,2,'H&L has promotion this week.','2026-07-22 15:59:42'),(2,1,3,'E-Mart is cheaper during weekends.','2026-07-22 15:59:42'),(3,2,1,'I always compare prices before buying.','2026-07-22 15:59:42');
/*!40000 ALTER TABLE `forumreply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forumreport`
--

DROP TABLE IF EXISTS `forumreport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forumreport` (
  `reportID` int(11) NOT NULL AUTO_INCREMENT,
  `topicID` int(11) DEFAULT NULL,
  `replyID` int(11) DEFAULT NULL,
  `studentID` int(11) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`reportID`),
  KEY `topicID` (`topicID`),
  KEY `replyID` (`replyID`),
  KEY `studentID` (`studentID`),
  CONSTRAINT `forumreport_ibfk_1` FOREIGN KEY (`topicID`) REFERENCES `forumtopic` (`topicID`),
  CONSTRAINT `forumreport_ibfk_2` FOREIGN KEY (`replyID`) REFERENCES `forumreply` (`replyID`),
  CONSTRAINT `forumreport_ibfk_3` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forumreport`
--

LOCK TABLES `forumreport` WRITE;
/*!40000 ALTER TABLE `forumreport` DISABLE KEYS */;
/*!40000 ALTER TABLE `forumreport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forumtopic`
--

DROP TABLE IF EXISTS `forumtopic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forumtopic` (
  `topicID` int(11) NOT NULL AUTO_INCREMENT,
  `studentID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `topicTitle` varchar(200) NOT NULL,
  `topicContent` text NOT NULL,
  `views` int(11) DEFAULT 0,
  `isPinned` tinyint(1) DEFAULT 0,
  `isLocked` tinyint(1) DEFAULT 0,
  `status` enum('Active','Hidden') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`topicID`),
  KEY `studentID` (`studentID`),
  KEY `categoryID` (`categoryID`),
  CONSTRAINT `forumtopic_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`),
  CONSTRAINT `forumtopic_ibfk_2` FOREIGN KEY (`categoryID`) REFERENCES `forumcategory` (`categoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forumtopic`
--

LOCK TABLES `forumtopic` WRITE;
/*!40000 ALTER TABLE `forumtopic` DISABLE KEYS */;
INSERT INTO `forumtopic` VALUES (1,1,2,'Cheapest Milo around UNIMAS?','Where can I get the cheapest Milo this week?',46,0,0,'Active','2026-07-22 15:58:58','2026-07-25 18:23:30'),(2,2,3,'Budget shopping tips','Share your shopping tips for students.',18,0,0,'Active','2026-07-22 15:58:58','2026-07-25 18:33:44'),(3,3,1,'Welcome everyone','Introduce yourself here.',39,0,0,'Active','2026-07-22 15:58:58','2026-07-25 18:23:26'),(4,1,1,'hello','ssssss',10,0,0,'Active','2026-07-25 11:31:32','2026-07-26 04:02:25');
/*!40000 ALTER TABLE `forumtopic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forumviews`
--

DROP TABLE IF EXISTS `forumviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forumviews` (
  `viewID` int(11) NOT NULL AUTO_INCREMENT,
  `topicID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `viewed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`viewID`),
  UNIQUE KEY `topicID` (`topicID`,`studentID`),
  KEY `studentID` (`studentID`),
  CONSTRAINT `forumviews_ibfk_1` FOREIGN KEY (`topicID`) REFERENCES `forumtopic` (`topicID`) ON DELETE CASCADE,
  CONSTRAINT `forumviews_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forumviews`
--

LOCK TABLES `forumviews` WRITE;
/*!40000 ALTER TABLE `forumviews` DISABLE KEYS */;
INSERT INTO `forumviews` VALUES (1,1,1,'2026-07-24 08:17:29'),(2,3,1,'2026-07-24 08:22:42'),(3,2,1,'2026-07-24 09:05:58'),(4,4,1,'2026-07-25 13:07:14');
/*!40000 ALTER TABLE `forumviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `ItemID` int(10) NOT NULL AUTO_INCREMENT,
  `ItemName` varchar(250) NOT NULL,
  `ItemPrice` double(10,2) NOT NULL,
  `ItemCategory` varchar(250) NOT NULL,
  `ItemDescription` varchar(3000) NOT NULL,
  `StoreName` varchar(250) NOT NULL,
  `ItemImage` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ItemID`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (1,'Nescafe 3-in-1 Original',13.90,'Beverages','Instant coffee mix with rich coffee flavour.','e-Mart Summer Mall','../../assets/images/item/noriginal.png','2026-07-25 09:09:15'),(2,'Hup Seng Cream Crackers',5.20,'Biscuits','Crispy crackers suitable for snacks and meals.','e-Mart Summer Mall','../../assets/images/item/hupseng.png','2026-07-25 09:09:15'),(3,'Maggi Curry Noodles',4.90,'Noodles','Instant noodles with delicious curry flavour.','H&L Aiman Mall','../../assets/images/item/maggi2.png','2026-07-25 09:09:15'),(4,'Jacob\'s Cream Crackers',11.50,'Biscuits','Crunchy cream crackers in multipack packaging.','e-Mart Summer Mall','../../assets/images/item/jacobs.png','2026-07-25 09:09:15'),(5,'Milo Chocolate Drink',18.99,'Beverages','Chocolate malt drink rich in energy and nutrients.','H&L Aiman Mall','../../assets/images/item/milo.png','2026-07-25 09:09:15'),(6,'Maggi Asam Laksa Noodles',5.50,'Noodles','Instant noodles with spicy and sour laksa flavour.','e-Mart Summer Mall','../../assets/images/item/asamlaksa1.png','2026-07-25 09:09:15'),(7,'Maggi Asam Laksa Noodles',4.99,'Noodles','Quick noodles with authentic Asam Laksa taste.','H&L Aiman Mall','../../assets/images/item/asamlaksa2.png','2026-07-25 09:09:15'),(8,'Milo Powder Drink',20.90,'Beverages','Chocolate malt beverage for everyday enjoyment.','e-Mart Summer Mall','../../assets/images/item/miloe.png','2026-07-25 09:09:15'),(9,'Maggi Curry Noodles',4.50,'Noodles','Springy noodles with rich curry seasoning.','e-Mart Summer Mall','../../assets/images/item/maggi.jpg','2026-07-25 09:09:15'),(10,'Nescafe 3-in-1 Original',13.99,'Beverages','Convenient instant coffee with creamy taste.','H&L Aiman Mall','../../assets/images/item/nescafe3in1.png','2026-07-25 09:09:15'),(11,'Nescafe Classic Coffee',23.15,'Beverages','Premium instant coffee with rich aroma.','H&L Aiman Mall','../../assets/images/item/nclassic.jpg','2026-07-25 09:09:15'),(12,'Munchy\'s Cream Crackers',5.10,'Biscuits','Light and crispy crackers for snacking.','e-Mart Summer Mall','../../assets/images/item/munchy.png','2026-07-25 09:09:15'),(13,'Mi Sedaap Instant Noodles',5.20,'Noodles','Tasty noodles with rich seasoning flavour.','H&L Aiman Mall','../../assets/images/item/misedap2.png','2026-07-25 09:09:15'),(14,'Sun Valley Grenadine Syrup',12.50,'Beverages','Sweet grenadine syrup for refreshing drinks.','H&L Aiman Mall','../../assets/images/item/sunvalley2.png','2026-07-25 09:09:15'),(15,'BOH 3-in-1 Tea Mix',14.90,'Beverages','Instant tea mix with convenient preparation.','e-Mart Summer Mall','../../assets/images/item/boh.png','2026-07-25 09:09:15'),(16,'Mi Sedap',4.90,'Noodles','Mi Sedap instant noodles are known for their variety of delicious flavors, unique seasoning packets, firm texture, and quick, easy preparation.','e-Mart Summer Mall','../../assets/images/item/misedap.png','2026-07-25 09:09:15'),(17,'Sun Valley Grenadine Syrup',10.90,'Beverages','Sweet and refreshing drink syrup.','e-Mart Summer Mall','../../assets/images/item/sunvalley.png','2026-07-25 09:09:15'),(18,'BOH 3-in-1 Tea Mix',23.15,'Beverages','Instant tea beverage pack for daily use.','H&L Aiman Mall','../../assets/images/item/boh.png','2026-07-25 09:09:15'),(19,'Hup Seng Cream Crackers',5.80,'Biscuits','Crunchy crackers with classic taste.','H&L Aiman Mall','../../assets/images/item/hupseng2.png','2026-07-25 09:09:15'),(20,'Jacob\'s Cream Crackers',11.00,'Biscuits','Classic crispy crackers in multipack size.','H&L Aiman Mall','../../assets/images/item/jacobs2.png','2026-07-25 09:09:15'),(21,'100PLUS Original',4.20,'Beverages','Refreshing isotonic drink for hydration.','e-Mart Summer Mall','../../assets/images/item/100plus.png','2026-07-25 09:09:15'),(22,'Munchy\'s Cream Crackers',5.20,'Biscuits','Crispy biscuits for snacks anytime.','H&L Aiman Mall','../../assets/images/item/munchy2.png','2026-07-25 09:09:15'),(23,'100PLUS Original',3.90,'Beverages','Refreshing isotonic beverage with electrolytes.','H&L Aiman Mall','../../assets/images/item/100plus2.png','2026-07-25 09:09:15'),(24,'Nescafe Classic Coffee',22.70,'Beverages','Aromatic instant coffee with smooth flavour.','e-Mart Summer Mall','../../assets/images/item/nclassic2.png','2026-07-25 09:09:15'),(25,'BOH 3-in-1 Tea Mix',16.60,'Beverages','Convenient instant tea with balanced flavour.','H&L Aiman Mall','../../assets/images/item/boh2.png','2026-07-25 09:09:15'),(26,'Gardenia Original Classic Bread',3.80,'Bread & Bakery','Soft and fresh white bread suitable for breakfast and sandwiches.','Everrise Express','../../assets/images/item/gardenia.png','2026-07-25 09:09:15'),(27,'Dutch Lady Full Cream Milk 1L',8.90,'Dairy Products','Fresh full cream milk rich in calcium and vitamins.','Farley Supermarket','../../assets/images/item/dutchlady.png','2026-07-25 09:09:15'),(28,'Farm Fresh Fresh Milk',9.50,'Dairy Products','Pasteurized fresh milk with a creamy taste.','Choice Daily','../../assets/images/item/farmfresh.png','2026-07-25 09:09:15'),(29,'Ayamas Chicken Nuggets',14.90,'Frozen Foods','Frozen chicken nuggets perfect for quick meals.','Emart Express','../../assets/images/item/nuggets.png','2026-07-25 09:09:15'),(30,'Mister Potato Original Chips',4.20,'Snacks','Crunchy potato chips with classic original flavour.','99 Speedmart','../../assets/images/item/misterpotato.png','2026-07-25 09:09:15'),(31,'Pringles Sour Cream & Onion',8.90,'Snacks','Imported potato crisps with sour cream and onion seasoning.','Servay Supermarket','../../assets/images/item/pringles.png','2026-07-25 09:09:15'),(32,'Ayam Brand Sardines in Tomato Sauce',8.50,'Canned Foods','Premium canned sardines in rich tomato sauce.','KK Super Mart','../../assets/images/item/sardines.png','2026-07-25 09:09:15'),(33,'Gardenia Butterscotch Bread',12.90,'Bread & Bakery','Soft butterscotch-flavoured bread suitable for breakfast and tea time.','Unaco Superstore','../../assets/images/item/gardenia-butterscotch.png','2026-07-25 09:09:15'),(34,'Cadbury Dairy Milk Chocolate',5.50,'Confectionery','Smooth milk chocolate bar made with fresh milk.','7-Eleven','../../assets/images/item/cadbury.png','2026-07-25 09:09:15'),(35,'Kinder Bueno Chocolate',6.80,'Confectionery','Crispy wafer filled with hazelnut cream and covered in chocolate.','myNEWS','../../assets/images/item/kinderbueno.png','2026-07-25 09:09:15'),(36,'Oreo Original Cookies',5.90,'Biscuits','Classic chocolate sandwich cookies with vanilla cream filling.','Orange Convenience Store','../../assets/images/item/oreo.png','2026-07-25 09:09:15'),(37,'Coca-Cola 1.5L',4.80,'Beverages','Refreshing carbonated soft drink perfect for sharing.','Happy Farm Fresh Mart','../../assets/images/item/cocacola.png','2026-07-25 09:09:15'),(38,'Indomie Mi Goreng',5.80,'Noodles','Popular instant fried noodles with authentic Indonesian flavour.','Choice Semariang','../../assets/images/item/indomie.png','2026-07-25 09:09:15'),(39,'Mamee Monster BBQ',2.20,'Snacks','Crunchy noodle snack with smoky BBQ flavour.','Ninso Kota Samarahan','../../assets/images/item/mamee.png','2026-07-25 09:09:15'),(40,'Marigold Peel Fresh Orange Juice',7.90,'Beverages','Refreshing orange juice made from quality oranges.','Jaya Grocer Express','../../assets/images/item/peelfresh.png','2026-07-25 09:09:15'),(41,'Nescafe 3-in-1 Original',13.50,'Beverages','Instant coffee mix with rich coffee flavour.','Everrise Express','../../assets/images/item/noriginal.png','2026-07-25 09:09:15'),(42,'Milo Chocolate Drink',18.50,'Beverages','Chocolate malt drink rich in energy and nutrients.','Farley Supermarket','../../assets/images/item/milo.png','2026-07-25 09:09:15'),(43,'100PLUS Original',4.10,'Beverages','Refreshing isotonic drink for hydration.','Choice Daily','../../assets/images/item/100plus.png','2026-07-25 09:09:15'),(44,'Maggi Curry Noodles',4.80,'Noodles','Instant noodles with delicious curry flavour.','99 Speedmart','../../assets/images/item/maggi2.png','2026-07-25 09:09:15'),(45,'Mi Sedaap Instant Noodles',5.10,'Noodles','Tasty noodles with rich seasoning flavour.','Servay Hypermarket','../../assets/images/item/misedap2.png','2026-07-25 09:09:15'),(46,'Jacob\'s Cream Crackers',10.80,'Biscuits','Classic crispy crackers in multipack packaging.','KK Super Mart','../../assets/images/item/jacobs.png','2026-07-25 09:09:15'),(47,'Hup Seng Cream Crackers',5.40,'Biscuits','Crunchy crackers suitable for snacks and meals.','Unaco Superstore','../../assets/images/item/hupseng.png','2026-07-25 09:09:15'),(48,'Gardenia Original Classic Bread',3.60,'Bread & Bakery','Soft and fresh white bread suitable for breakfast and sandwiches.','Happy Farm Fresh Mart','../../assets/images/item/gardenia.png','2026-07-25 09:09:15'),(49,'Gardenia Butterscotch Bread',4.20,'Bread & Bakery','Soft butterscotch-flavoured bread suitable for breakfast and tea time.','Choice Semariang','../../assets/images/item/gardenia-butterscotch.png','2026-07-25 09:09:15'),(50,'Dutch Lady Full Cream Milk 1L',8.70,'Dairy Products','Fresh full cream milk rich in calcium and vitamins.','Jaya Grocer Express','../../assets/images/item/dutchlady.png','2026-07-25 09:09:15'),(51,'Farm Fresh Fresh Milk',9.20,'Dairy Products','Pasteurized fresh milk with a creamy taste.','Everrise Express','../../assets/images/item/farmfresh.png','2026-07-25 09:09:15'),(52,'Ayamas Chicken Nuggets',14.50,'Frozen Foods','Frozen chicken nuggets perfect for quick meals.','Servay Hypermarket','../../assets/images/item/nuggets.png','2026-07-25 09:09:15'),(53,'Cadbury Dairy Milk Chocolate',5.30,'Confectionery','Smooth milk chocolate bar made with fresh milk.','99 Speedmart','../../assets/images/item/cadbury.png','2026-07-25 09:09:15'),(54,'Kinder Bueno Chocolate',6.50,'Confectionery','Crispy wafer filled with hazelnut cream and covered in chocolate.','7-Eleven','../../assets/images/item/kinderbueno.png','2026-07-25 09:09:15'),(55,'Pringles Sour Cream & Onion',8.70,'Snacks','Imported potato crisps with sour cream and onion seasoning.','Choice Daily','../../assets/images/item/pringles.png','2026-07-25 09:09:15'),(56,'Mister Potato Original Chips',3.90,'Snacks','Crunchy potato chips with classic original flavour.','Orange Convenience Store','../../assets/images/item/misterpotato.png','2026-07-25 09:09:15'),(57,'Mamee Monster BBQ',2.00,'Snacks','Crunchy noodle snack with smoky BBQ flavour.','myNEWS','../../assets/images/item/mamee.png','2026-07-25 09:09:15'),(58,'Ayam Brand Sardines in Tomato Sauce',8.20,'Canned Foods','Premium canned sardines in rich tomato sauce.','Farley Supermarket','../../assets/images/item/sardines.png','2026-07-25 09:09:15'),(59,'Marigold Peel Fresh Orange Juice',7.60,'Beverages','Refreshing orange juice made from quality oranges.','Unaco Superstore','../../assets/images/item/peelfresh.png','2026-07-25 09:09:15'),(60,'Sun Valley Grenadine Syrup',11.90,'Beverages','Sweet grenadine syrup for refreshing drinks.','Jaya Grocer Express','../../assets/images/item/sunvalley.png','2026-07-25 09:09:15'),(61,'BOH 3-in-1 Tea Mix',15.20,'Beverages','Instant tea mix with convenient preparation.','Everrise Express','../../assets/images/item/boh.png','2026-07-25 09:09:15'),(62,'Nescafe Classic Coffee',22.90,'Beverages','Premium instant coffee with rich aroma.','Farley Supermarket','../../assets/images/item/nclassic.jpg','2026-07-25 09:09:15'),(63,'Coca-Cola 1.5L',4.60,'Beverages','Refreshing carbonated soft drink perfect for sharing.','99 Speedmart','../../assets/images/item/cocacola.png','2026-07-25 09:09:15'),(64,'Milo Powder Drink',20.50,'Beverages','Chocolate malt beverage for everyday enjoyment.','Choice Semariang','../../assets/images/item/miloe.png','2026-07-25 09:09:15'),(65,'100PLUS Original',3.80,'Beverages','Refreshing isotonic beverage with electrolytes.','Emart Express','../../assets/images/item/100plus2.png','2026-07-25 09:09:15'),(66,'Maggi Asam Laksa Noodles',5.20,'Noodles','Instant noodles with spicy and sour laksa flavour.','Everrise Express','../../assets/images/item/asamlaksa1.png','2026-07-25 09:09:15'),(67,'Maggi Curry Noodles',4.70,'Noodles','Springy noodles with rich curry seasoning.','Choice Daily','../../assets/images/item/maggi.jpg','2026-07-25 09:09:15'),(68,'Mi Sedap',4.80,'Noodles','Mi Sedap instant noodles are known for their delicious flavours.','Jaya Grocer Express','../../assets/images/item/misedap.png','2026-07-25 09:09:15'),(69,'Indomie Mi Goreng',5.50,'Noodles','Popular instant fried noodles with authentic Indonesian flavour.','99 Speedmart','../../assets/images/item/indomie.png','2026-07-25 09:09:15'),(70,'Munchy\'s Cream Crackers',5.00,'Biscuits','Light and crispy crackers for snacking.','Everrise Express','../../assets/images/item/munchy.png','2026-07-25 09:09:15'),(71,'Jacob\'s Cream Crackers',11.20,'Biscuits','Crunchy cream crackers in multipack packaging.','Farley Supermarket','../../assets/images/item/jacobs2.png','2026-07-25 09:09:15'),(72,'Oreo Original Cookies',5.70,'Biscuits','Classic chocolate sandwich cookies with vanilla cream filling.','Choice Daily','../../assets/images/item/oreo.png','2026-07-25 09:09:15'),(73,'Pringles Sour Cream & Onion',8.60,'Snacks','Imported potato crisps with sour cream and onion seasoning.','7-Eleven','../../assets/images/item/pringles.png','2026-07-25 09:09:15'),(74,'Mister Potato Original Chips',4.00,'Snacks','Crunchy potato chips with classic original flavour.','myNEWS','../../assets/images/item/misterpotato.png','2026-07-25 09:09:15'),(75,'Mamee Monster BBQ',2.10,'Snacks','Crunchy noodle snack with smoky BBQ flavour.','Orange Convenience Store','../../assets/images/item/mamee.png','2026-07-25 09:09:15'),(76,'Farm Fresh Fresh Milk',9.30,'Dairy Products','Pasteurized fresh milk with a creamy taste.','Happy Farm Fresh Mart','../../assets/images/item/farmfresh.png','2026-07-25 09:09:15'),(77,'Gardenia Original Classic Bread',3.70,'Bread & Bakery','Soft and fresh white bread suitable for breakfast and sandwiches.','Farley Supermarket','../../assets/images/item/gardenia.png','2026-07-25 09:09:15'),(78,'Ayamas Chicken Nuggets',14.70,'Frozen Foods','Frozen chicken nuggets perfect for quick meals.','Unaco Superstore','../../assets/images/item/nuggets.png','2026-07-25 09:09:15'),(79,'Cadbury Dairy Milk Chocolate',5.40,'Confectionery','Smooth milk chocolate bar made with fresh milk.','Ninso Kota Samarahan','../../assets/images/item/cadbury.png','2026-07-25 09:09:15'),(80,'Ayam Brand Sardines in Tomato Sauce',8.40,'Canned Foods','Premium canned sardines in rich tomato sauce.','Choice Semariang','../../assets/images/item/sardines.png','2026-07-25 09:09:15'),(81,'Nescafe 3-in-1 Original',13.70,'Beverages','Instant coffee mix with rich coffee flavour.','Servay Hypermarket','../../assets/images/item/noriginal.png','2026-07-25 09:09:15'),(82,'Milo Chocolate Drink',19.20,'Beverages','Chocolate malt drink rich in energy and nutrients.','Unaco Superstore','../../assets/images/item/milo.png','2026-07-25 09:09:15'),(83,'Marigold Peel Fresh Orange Juice',8.10,'Beverages','Refreshing orange juice made from quality oranges.','Choice Daily','../../assets/images/item/peelfresh.png','2026-07-25 09:09:15'),(84,'Sun Valley Grenadine Syrup',11.50,'Beverages','Sweet and refreshing drink syrup.','99 Speedmart','../../assets/images/item/sunvalley.png','2026-07-25 09:09:15'),(85,'100PLUS Original',4.00,'Beverages','Refreshing isotonic beverage with electrolytes.','Everrise Express','../../assets/images/item/100plus2.png','2026-07-25 09:09:15'),(86,'Maggi Curry Noodles',4.60,'Noodles','Instant noodles with delicious curry flavour.','Farley Supermarket','../../assets/images/item/maggi2.png','2026-07-25 09:09:15'),(87,'Maggi Asam Laksa Noodles',5.30,'Noodles','Quick noodles with authentic Asam Laksa taste.','Choice Semariang','../../assets/images/item/asamlaksa2.png','2026-07-25 09:09:15'),(88,'Mi Sedaap Instant Noodles',5.30,'Noodles','Tasty noodles with rich seasoning flavour.','Emart Express','../../assets/images/item/misedap2.png','2026-07-25 09:09:15'),(89,'Indomie Mi Goreng',5.60,'Noodles','Popular instant fried noodles with authentic Indonesian flavour.','Orange Convenience Store','../../assets/images/item/indomie.png','2026-07-25 09:09:15'),(90,'Hup Seng Cream Crackers',5.60,'Biscuits','Crunchy crackers suitable for snacks and meals.','Choice Daily','../../assets/images/item/hupseng.png','2026-07-25 09:09:15'),(91,'Jacob\'s Cream Crackers',11.30,'Biscuits','Classic crispy crackers in multipack packaging.','Everrise Express','../../assets/images/item/jacobs.png','2026-07-25 09:09:15'),(92,'Munchy\'s Cream Crackers',5.30,'Biscuits','Light and crispy crackers for snacking.','Farley Supermarket','../../assets/images/item/munchy2.png','2026-07-25 09:09:15'),(93,'Pringles Sour Cream & Onion',8.80,'Snacks','Imported potato crisps with sour cream and onion seasoning.','Jaya Grocer Express','../../assets/images/item/pringles.png','2026-07-25 09:09:15'),(94,'Mister Potato Original Chips',4.10,'Snacks','Crunchy potato chips with classic original flavour.','7-Eleven','../../assets/images/item/misterpotato.png','2026-07-25 09:09:15'),(95,'Mamee Monster BBQ',2.30,'Snacks','Crunchy noodle snack with smoky BBQ flavour.','KK Super Mart','../../assets/images/item/mamee.png','2026-07-25 09:09:15'),(96,'Dutch Lady Full Cream Milk 1L',8.80,'Dairy Products','Fresh full cream milk rich in calcium and vitamins.','Happy Farm Fresh Mart','../../assets/images/item/dutchlady.png','2026-07-25 09:09:15'),(97,'Gardenia Butterscotch Bread',4.00,'Bread & Bakery','Soft butterscotch-flavoured bread suitable for breakfast and tea time.','Servay Hypermarket','../../assets/images/item/gardenia-butterscotch.png','2026-07-25 09:09:15'),(98,'Ayamas Chicken Nuggets',14.80,'Frozen Foods','Frozen chicken nuggets perfect for quick meals.','Choice Daily','../../assets/images/item/nuggets.png','2026-07-25 09:09:15'),(99,'Cadbury Dairy Milk Chocolate',5.60,'Confectionery','Smooth milk chocolate bar made with fresh milk.','Jaya Grocer Express','../../assets/images/item/cadbury.png','2026-07-25 09:09:15'),(100,'Ayam Brand Sardines in Tomato Sauce',8.60,'Canned Foods','Premium canned sardines in rich tomato sauce.','Everrise Express','../../assets/images/item/sardines.png','2026-07-25 09:09:15'),(101,'Dutch Lady Chocolate Milk 1L',7.90,'Dairy Products','Chocolate flavoured milk drink rich in calcium and nutrients.','Ninso Kota Samarahan','../../assets/images/item/dutchlady-choco.png','2026-07-25 09:09:15'),(102,'Farm Fresh Yogurt Drink',5.90,'Dairy Products','Refreshing cultured milk drink with a smooth fruity taste.','KK Super Mart','../../assets/images/item/farmfresh-yogurt.png','2026-07-25 09:09:15'),(103,'Dutch Lady Full Cream Milk 1L',8.60,'Dairy Products','Fresh full cream milk suitable for daily consumption.','Orange Convenience Store','../../assets/images/item/dutchlady.png','2026-07-25 09:09:15'),(104,'Ayamas Chicken Nuggets',14.60,'Frozen Foods','Frozen chicken nuggets perfect for quick meals.','Jaya Grocer Express','../../assets/images/item/nuggets.png','2026-07-25 09:09:15'),(105,'Ayamas Chicken Burger Patties',16.90,'Frozen Foods','Frozen chicken patties suitable for homemade burgers.','Happy Farm Fresh Mart','../../assets/images/item/ayamaspatties.png','2026-07-25 09:09:15'),(106,'Gardenia Original Classic Bread',3.90,'Bread & Bakery','Soft and fresh white bread suitable for breakfast and sandwiches.','7-Eleven','../../assets/images/item/gardenia.png','2026-07-25 09:09:15'),(107,'Gardenia Butterscotch Bread',4.30,'Bread & Bakery','Sweet butterscotch-flavoured bread for snacks and breakfast.','myNEWS','../../assets/images/item/gardenia-butterscotch.png','2026-07-25 09:09:15'),(108,'Ayam Brand Tuna Chunks',7.50,'Canned Foods','Premium canned tuna suitable for meals and sandwiches.','KK Super Mart','../../assets/images/item/tuna.png','2026-07-25 09:09:15'),(109,'Ayam Brand Sardines in Tomato Sauce',8.30,'Canned Foods','Premium canned sardines in rich tomato sauce.','Ninso Kota Samarahan','../../assets/images/item/sardines.png','2026-07-25 09:09:15'),(110,'KitKat Chocolate Bar',3.20,'Confectionery','Crispy wafer chocolate bar with a smooth coating.','Orange Convenience Store','../../assets/images/item/kitkat.png','2026-07-25 09:09:15'),(111,'Kinder Bueno Chocolate',6.60,'Confectionery','Crispy wafer filled with hazelnut cream and covered in chocolate.','Choice Daily','../../assets/images/item/kinderbueno.png','2026-07-25 09:09:15'),(112,'Cadbury Dairy Milk Chocolate',5.70,'Confectionery','Smooth milk chocolate bar made with fresh milk.','KK Super Mart','../../assets/images/item/cadbury.png','2026-07-25 09:09:15'),(113,'Nescafe Classic Coffee',22.50,'Beverages','Aromatic instant coffee with smooth flavour.','Ninso Kota Samarahan','../../assets/images/item/nclassic.jpg','2026-07-25 09:09:15'),(114,'BOH 3-in-1 Tea Mix',15.50,'Beverages','Instant tea mix with convenient preparation.','Choice Semariang','../../assets/images/item/boh.png','2026-07-25 09:09:15'),(115,'Coca-Cola 1.5L',4.70,'Beverages','Refreshing carbonated soft drink perfect for sharing.','Happy Farm Fresh Mart','../../assets/images/item/cocacola.png','2026-07-25 09:09:15'),(116,'Oreo Original Cookies',5.80,'Biscuits','Classic chocolate sandwich cookies with vanilla cream filling.','7-Eleven','../../assets/images/item/oreo.png','2026-07-25 09:09:15'),(117,'Roma Marie Biscuits',4.50,'Biscuits','Classic sweet biscuits suitable for tea time snacks.','myNEWS','../../assets/images/item/roma.png','2026-07-25 09:09:15'),(118,'Maggi Curry Noodles',4.80,'Noodles','Instant noodles with rich curry seasoning flavour.','Orange Convenience Store','../../assets/images/item/maggi2.png','2026-07-25 09:09:15'),(119,'Pringles Sour Cream & Onion',8.70,'Snacks','Imported potato crisps with sour cream and onion seasoning.','Ninso Kota Samarahan','../../assets/images/item/pringles.png','2026-07-25 09:09:15'),(120,'Mister Potato Original Chips',4.00,'Snacks','Crunchy potato chips with classic original flavour.','Choice Semariang','../../assets/images/item/misterpotato.png','2026-07-25 09:09:15'),(121,'Nescafe 3-in-1 Original',13.80,'Beverages','Instant coffee mix with rich coffee flavour.','Choice Semariang','../../assets/images/item/noriginal.png','2026-07-25 09:09:15'),(122,'Milo Chocolate Drink',18.70,'Beverages','Chocolate malt drink rich in energy and nutrients.','Servay Hypermarket','../../assets/images/item/milo.png','2026-07-25 09:09:15'),(123,'100PLUS Original',4.30,'Beverages','Refreshing isotonic drink for hydration.','KK Super Mart','../../assets/images/item/100plus.png','2026-07-25 09:09:15'),(124,'Marigold Peel Fresh Orange Juice',7.70,'Beverages','Refreshing orange juice made from quality oranges.','7-Eleven','../../assets/images/item/peelfresh.png','2026-07-25 09:09:15'),(125,'Sun Valley Grenadine Syrup',12.00,'Beverages','Sweet syrup for preparing refreshing drinks.','myNEWS','../../assets/images/item/sunvalley.png','2026-07-25 09:09:15'),(126,'Maggi Asam Laksa Noodles',5.40,'Noodles','Instant noodles with spicy and sour laksa flavour.','Farley Supermarket','../../assets/images/item/asamlaksa1.png','2026-07-25 09:09:15'),(127,'Maggi Curry Noodles',4.60,'Noodles','Instant noodles with delicious curry flavour.','Unaco Superstore','../../assets/images/item/maggi2.png','2026-07-25 09:09:15'),(128,'Mi Sedaap Instant Noodles',5.00,'Noodles','Tasty noodles with rich seasoning flavour.','KK Super Mart','../../assets/images/item/misedap2.png','2026-07-25 09:09:15'),(129,'Indomie Mi Goreng',5.40,'Noodles','Popular instant fried noodles with authentic Indonesian flavour.','Happy Farm Fresh Mart','../../assets/images/item/indomie.png','2026-07-25 09:09:15'),(130,'Mi Sedap',4.70,'Noodles','Instant noodles known for various delicious flavours.','Ninso Kota Samarahan','../../assets/images/item/misedap.png','2026-07-25 09:09:15'),(131,'Hup Seng Cream Crackers',5.30,'Biscuits','Crispy crackers suitable for snacks and meals.','Servay Hypermarket','../../assets/images/item/hupseng.png','2026-07-25 09:09:15'),(132,'Jacob\'s Cream Crackers',11.40,'Biscuits','Crunchy cream crackers in multipack packaging.','Choice Semariang','../../assets/images/item/jacobs.png','2026-07-25 09:09:15'),(133,'Munchy\'s Cream Crackers',5.40,'Biscuits','Light and crispy crackers for snacking.','KK Super Mart','../../assets/images/item/munchy.png','2026-07-25 09:09:15'),(134,'Oreo Original Cookies',5.60,'Biscuits','Chocolate sandwich cookies with vanilla cream filling.','Orange Convenience Store','../../assets/images/item/oreo.png','2026-07-25 09:09:15'),(135,'Roma Marie Biscuits',4.30,'Biscuits','Sweet biscuits suitable for tea time snacks.','Happy Farm Fresh Mart','../../assets/images/item/roma.png','2026-07-25 09:09:15'),(136,'Mister Potato Original Chips',4.20,'Snacks','Crunchy potato chips with classic original flavour.','Everrise Express','../../assets/images/item/misterpotato.png','2026-07-25 09:09:15'),(137,'Pringles Sour Cream & Onion',8.50,'Snacks','Imported potato crisps with sour cream and onion seasoning.','Unaco Superstore','../../assets/images/item/pringles.png','2026-07-25 09:09:15'),(138,'Mamee Monster BBQ',2.40,'Snacks','Crunchy noodle snack with smoky BBQ flavour.','7-Eleven','../../assets/images/item/mamee.png','2026-07-25 09:09:15'),(139,'Cadbury Dairy Milk Chocolate',5.40,'Confectionery','Smooth milk chocolate bar made with fresh milk.','myNEWS','../../assets/images/item/cadbury.png','2026-07-25 09:09:15'),(140,'Kinder Bueno Chocolate',6.70,'Confectionery','Crispy wafer filled with hazelnut cream and chocolate coating.','Orange Convenience Store','../../assets/images/item/kinderbueno.png','2026-07-25 09:09:15'),(141,'Farm Fresh Fresh Milk',9.40,'Dairy Products','Pasteurized fresh milk with a creamy taste.','Servay Hypermarket','../../assets/images/item/farmfresh.png','2026-07-25 09:09:15'),(142,'Dutch Lady Full Cream Milk 1L',8.80,'Dairy Products','Fresh full cream milk rich in calcium and vitamins.','Unaco Superstore','../../assets/images/item/dutchlady.png','2026-07-25 09:09:15'),(143,'Ayamas Chicken Nuggets',14.40,'Frozen Foods','Frozen chicken nuggets perfect for quick meals.','99 Speedmart','../../assets/images/item/nuggets.png','2026-07-25 09:09:15'),(144,'Ayamas Chicken Burger Patties',16.50,'Frozen Foods','Frozen chicken patties suitable for homemade burgers.','Choice Daily','../../assets/images/item/ayamaspatties.png','2026-07-25 09:09:15'),(145,'Gardenia Original Classic Bread',3.70,'Bread & Bakery','Soft and fresh white bread suitable for breakfast.','KK Super Mart','../../assets/images/item/gardenia.png','2026-07-25 09:09:15'),(146,'Gardenia Butterscotch Bread',4.10,'Bread & Bakery','Sweet bread suitable for breakfast and snacks.','Orange Convenience Store','../../assets/images/item/gardenia-butterscotch.png','2026-07-25 09:09:15'),(147,'Ayam Brand Tomato Sardines',8.40,'Canned Foods','Premium canned sardines in rich tomato sauce.','Servay Hypermarket','../../assets/images/item/sardines.png','2026-07-25 09:09:15'),(148,'Ayam Brand Tuna Chunks',7.70,'Canned Foods','Premium canned tuna suitable for meals.','Happy Farm Fresh Mart','../../assets/images/item/tuna.png','2026-07-25 09:09:15'),(149,'BOH 3-in-1 Tea Mix',16.20,'Beverages','Instant tea beverage pack for daily use.','Farley Supermarket','../../assets/images/item/boh.png','2026-07-25 09:09:15'),(150,'Nescafe Classic Coffee',23.00,'Beverages','Premium instant coffee with rich aroma.','Choice Daily','../../assets/images/item/nclassic.jpg','2026-07-25 09:09:15');
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ratings` (
  `ratingID` int(11) NOT NULL AUTO_INCREMENT,
  `ItemID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `comment` text DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ratingID`),
  KEY `fk_rating_item` (`ItemID`),
  KEY `fk_rating_student` (`studentID`),
  CONSTRAINT `fk_rating_item` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ItemID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_rating_student` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=501 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratings`
--

LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
INSERT INTO `ratings` VALUES (1,1,1,5.0,'Affordable and good quality','2026-07-20 15:16:56'),(2,2,2,4.5,'Worth buying','2026-07-20 15:16:56'),(3,3,3,4.0,'Good product','2026-07-20 15:16:56'),(4,4,4,4.5,'Good value for money.','2026-07-22 08:07:10'),(5,5,5,5.0,'Highly recommended!','2026-07-22 08:07:10'),(6,6,6,3.5,'Reasonable quality.','2026-07-22 08:07:10'),(7,7,7,4.0,'Affordable product.','2026-07-22 08:07:10'),(8,8,8,4.5,'Satisfied with this purchase.','2026-07-22 08:07:10'),(9,9,9,3.0,'Average but acceptable.','2026-07-22 08:07:10'),(10,10,10,5.0,'Excellent quality.','2026-07-22 08:07:10'),(11,11,11,4.0,'Nice product.','2026-07-22 08:07:10'),(12,12,12,4.5,'Worth every ringgit.','2026-07-22 08:07:10'),(13,13,13,3.5,'Quite useful.','2026-07-22 08:07:10'),(14,14,14,5.0,'One of my favourites.','2026-07-22 08:07:10'),(15,15,15,4.0,'Good overall.','2026-07-22 08:07:10'),(16,16,16,4.5,'Will buy again.','2026-07-22 08:07:10'),(17,17,17,3.5,'Meets expectations.','2026-07-22 08:07:10'),(18,18,18,4.0,'Good quality.','2026-07-22 08:07:10'),(19,19,19,5.0,'Excellent choice.','2026-07-22 08:07:10'),(20,20,20,4.5,'Fresh and affordable.','2026-07-22 08:07:10'),(21,21,21,3.5,'Not bad.','2026-07-22 08:07:10'),(22,22,22,4.0,'Reasonably priced.','2026-07-22 08:07:10'),(23,23,23,5.0,'Very satisfied.','2026-07-22 08:07:10'),(24,24,24,4.5,'Highly recommended.','2026-07-22 08:07:10'),(25,25,25,3.5,'Pretty decent.','2026-07-22 08:07:10'),(26,26,26,4.0,'Nice packaging.','2026-07-22 08:07:10'),(27,27,27,4.5,'Great purchase.','2026-07-22 08:07:10'),(28,28,28,5.0,'Excellent value.','2026-07-22 08:07:10'),(29,29,29,3.0,'Acceptable quality.','2026-07-22 08:07:10'),(30,30,30,4.0,'Worth trying.','2026-07-22 08:07:10'),(31,31,31,4.5,'Very affordable.','2026-07-22 08:07:10'),(32,32,32,5.0,'Love this product.','2026-07-22 08:07:10'),(33,33,33,4.0,'Good enough.','2026-07-22 08:07:10'),(34,34,34,3.5,'Satisfied overall.','2026-07-22 08:07:10'),(35,35,35,4.5,'Quality exceeded expectations.','2026-07-22 08:07:10'),(36,36,36,5.0,'Fantastic item.','2026-07-22 08:07:10'),(37,37,37,3.5,'Works as expected.','2026-07-22 08:07:10'),(38,38,38,4.0,'Pretty good.','2026-07-22 08:07:10'),(39,39,39,4.5,'Definitely recommended.','2026-07-22 08:07:10'),(40,40,40,5.0,'Excellent purchase.','2026-07-22 08:07:10'),(41,41,41,3.5,'Value for money.','2026-07-22 08:07:10'),(42,42,42,4.0,'Good choice.','2026-07-22 08:07:10'),(43,43,43,4.5,'Happy with the quality.','2026-07-22 08:07:10'),(44,44,44,5.0,'Will purchase again.','2026-07-22 08:07:10'),(45,45,45,3.0,'Okay product.','2026-07-22 08:07:10'),(46,46,46,4.0,'Worth the price.','2026-07-22 08:07:10'),(47,47,47,4.5,'Nice and affordable.','2026-07-22 08:07:10'),(48,48,48,5.0,'Highly satisfied.','2026-07-22 08:07:10'),(49,49,49,3.5,'Quite decent.','2026-07-22 08:07:10'),(50,50,50,4.0,'No complaints.','2026-07-22 08:07:10'),(51,51,51,4.5,'Very nice.','2026-07-22 08:07:10'),(52,52,52,5.0,'Excellent.','2026-07-22 08:07:10'),(53,53,53,3.5,'Can recommend.','2026-07-22 08:07:10'),(54,54,54,4.0,'Met my expectations.','2026-07-22 08:07:10'),(55,55,55,4.5,'Really good.','2026-07-22 08:07:10'),(56,56,56,5.0,'Fantastic quality.','2026-07-22 08:07:10'),(57,57,57,3.5,'Budget friendly.','2026-07-22 08:07:10'),(58,58,58,4.0,'Affordable and useful.','2026-07-22 08:07:10'),(59,59,59,4.5,'Impressive quality.','2026-07-22 08:07:10'),(60,60,60,5.0,'Great product.','2026-07-22 08:07:10'),(61,61,61,3.5,'Pretty satisfied.','2026-07-22 08:07:10'),(62,62,62,4.0,'Reliable product.','2026-07-22 08:07:10'),(63,63,63,4.5,'Recommended to friends.','2026-07-22 08:07:10'),(64,64,64,5.0,'Very impressive.','2026-07-22 08:07:10'),(65,65,65,3.5,'Nice experience.','2026-07-22 08:07:10'),(66,66,66,4.0,'Good for the price.','2026-07-22 08:07:10'),(67,67,67,4.5,'Excellent overall.','2026-07-22 08:07:10'),(68,12,1,4.5,'Worth buying.','2026-07-22 08:10:41'),(69,45,2,3.5,'Decent quality.','2026-07-22 08:10:41'),(70,8,3,5.0,'Highly recommended!','2026-07-22 08:10:41'),(71,67,4,4.0,'Good value for money.','2026-07-22 08:10:41'),(72,91,5,4.5,'Affordable and reliable.','2026-07-22 08:10:41'),(73,15,6,3.0,'Average product.','2026-07-22 08:10:41'),(74,102,7,5.0,'Excellent purchase.','2026-07-22 08:10:41'),(75,38,8,4.0,'Satisfied with it.','2026-07-22 08:10:41'),(76,56,9,4.5,'Fresh and affordable.','2026-07-22 08:10:41'),(77,73,10,3.5,'Pretty good overall.','2026-07-22 08:10:41'),(78,5,11,5.0,'Would buy again.','2026-07-22 08:10:41'),(79,29,12,4.0,'Nice quality.','2026-07-22 08:10:41'),(80,88,13,4.5,'Really worth the price.','2026-07-22 08:10:41'),(81,110,14,3.5,'Met expectations.','2026-07-22 08:10:41'),(82,17,15,4.0,'Good choice.','2026-07-22 08:10:41'),(83,95,16,5.0,'Excellent quality.','2026-07-22 08:10:41'),(84,61,17,4.5,'Very useful.','2026-07-22 08:10:41'),(85,14,18,3.5,'Reasonable price.','2026-07-22 08:10:41'),(86,77,19,4.0,'Happy with purchase.','2026-07-22 08:10:41'),(87,118,20,5.0,'Highly satisfied.','2026-07-22 08:10:41'),(88,24,21,4.5,'Good packaging.','2026-07-22 08:10:41'),(89,84,22,3.5,'Works well.','2026-07-22 08:10:41'),(90,35,23,4.0,'Nice item.','2026-07-22 08:10:41'),(91,11,24,5.0,'Fantastic!','2026-07-22 08:10:41'),(92,59,25,4.5,'Very affordable.','2026-07-22 08:10:41'),(93,99,26,3.0,'Acceptable quality.','2026-07-22 08:10:41'),(94,70,27,4.0,'Pretty decent.','2026-07-22 08:10:41'),(95,27,28,5.0,'Love this product.','2026-07-22 08:10:41'),(96,114,29,4.5,'Would recommend.','2026-07-22 08:10:41'),(97,41,30,3.5,'Good enough.','2026-07-22 08:10:41'),(98,82,31,4.0,'Reliable item.','2026-07-22 08:10:41'),(99,7,32,5.0,'Amazing value.','2026-07-22 08:10:41'),(100,53,33,4.5,'Very satisfied.','2026-07-22 08:10:41'),(101,94,34,3.5,'Not bad.','2026-07-22 08:10:41'),(102,18,35,4.0,'Quality is good.','2026-07-22 08:10:41'),(103,106,36,5.0,'Exceeded expectations.','2026-07-22 08:10:41'),(104,47,37,4.5,'Affordable.','2026-07-22 08:10:41'),(105,31,38,3.5,'Worth trying.','2026-07-22 08:10:41'),(106,79,39,4.0,'Happy overall.','2026-07-22 08:10:41'),(107,3,40,5.0,'Excellent.','2026-07-22 08:10:41'),(108,66,41,4.5,'Nice product.','2026-07-22 08:10:41'),(109,120,42,3.5,'Budget friendly.','2026-07-22 08:10:41'),(110,22,43,4.0,'Good quality.','2026-07-22 08:10:41'),(111,86,44,5.0,'One of my favourites.','2026-07-22 08:10:41'),(112,58,45,4.5,'Really good.','2026-07-22 08:10:41'),(113,13,46,3.5,'Fair for the price.','2026-07-22 08:10:41'),(114,97,47,4.0,'Good experience.','2026-07-22 08:10:41'),(115,44,48,5.0,'Highly recommend.','2026-07-22 08:10:41'),(116,109,49,4.5,'Very pleased.','2026-07-22 08:10:41'),(117,32,50,3.5,'Satisfied.','2026-07-22 08:10:41'),(118,74,51,4.5,'Excellent value for money.','2026-07-22 08:11:16'),(119,16,52,3.5,'Good enough for daily use.','2026-07-22 08:11:16'),(120,103,53,5.0,'Highly recommended!','2026-07-22 08:11:16'),(121,48,54,4.0,'Very satisfied with this product.','2026-07-22 08:11:16'),(122,26,55,3.0,'Average but acceptable.','2026-07-22 08:11:16'),(123,81,56,4.5,'Quality exceeded expectations.','2026-07-22 08:11:16'),(124,112,57,5.0,'Would definitely buy again.','2026-07-22 08:11:16'),(125,39,58,4.0,'Nice packaging and quality.','2026-07-22 08:11:16'),(126,6,59,3.5,'Affordable choice.','2026-07-22 08:11:16'),(127,92,60,4.5,'Really worth buying.','2026-07-22 08:11:16'),(128,55,61,5.0,'One of the best products.','2026-07-22 08:11:16'),(129,20,62,4.0,'Good quality overall.','2026-07-22 08:11:16'),(130,115,63,3.5,'Met my expectations.','2026-07-22 08:11:16'),(131,64,64,4.5,'Very good experience.','2026-07-22 08:11:16'),(132,33,65,5.0,'Fantastic product!','2026-07-22 08:11:16'),(133,87,66,4.0,'Will purchase again.','2026-07-22 08:11:16'),(134,9,67,3.5,'Reasonably priced.','2026-07-22 08:11:16'),(135,117,1,5.0,'Excellent quality.','2026-07-22 08:11:16'),(136,51,2,4.5,'Highly satisfied.','2026-07-22 08:11:16'),(137,23,3,4.0,'Good purchase.','2026-07-22 08:11:16'),(138,100,4,3.5,'Pretty decent.','2026-07-22 08:11:16'),(139,71,5,5.0,'Love this item.','2026-07-22 08:11:16'),(140,30,6,4.0,'Nice quality.','2026-07-22 08:11:16'),(141,104,7,4.5,'Worth every ringgit.','2026-07-22 08:11:16'),(142,57,8,3.5,'Works as expected.','2026-07-22 08:11:16'),(143,19,9,5.0,'Very impressive.','2026-07-22 08:11:16'),(144,83,10,4.0,'Good value.','2026-07-22 08:11:16'),(145,40,11,4.5,'Fresh and affordable.','2026-07-22 08:11:16'),(146,108,12,3.0,'Average quality.','2026-07-22 08:11:16'),(147,63,13,5.0,'Excellent purchase.','2026-07-22 08:11:16'),(148,28,14,4.0,'Good product.','2026-07-22 08:11:16'),(149,116,15,4.5,'Very useful item.','2026-07-22 08:11:16'),(150,54,16,3.5,'Budget friendly.','2026-07-22 08:11:16'),(151,2,17,5.0,'Absolutely recommended.','2026-07-22 08:11:16'),(152,89,18,4.0,'Happy with this purchase.','2026-07-22 08:11:16'),(153,37,19,4.5,'Very reliable.','2026-07-22 08:11:16'),(154,107,20,3.5,'Good enough.','2026-07-22 08:11:16'),(155,69,21,5.0,'Fantastic value.','2026-07-22 08:11:16'),(156,10,22,4.0,'Satisfied overall.','2026-07-22 08:11:16'),(157,96,23,4.5,'Nice product quality.','2026-07-22 08:11:16'),(158,43,24,3.5,'Worth trying.','2026-07-22 08:11:16'),(159,80,25,5.0,'Exceeded my expectations.','2026-07-22 08:11:16'),(160,34,26,4.0,'Really nice.','2026-07-22 08:11:16'),(161,113,27,4.5,'Would recommend to friends.','2026-07-22 08:11:16'),(162,60,28,3.5,'Fairly good.','2026-07-22 08:11:16'),(163,25,29,5.0,'One of my favourites.','2026-07-22 08:11:16'),(164,105,30,4.0,'Great quality.','2026-07-22 08:11:16'),(165,76,31,4.5,'Affordable and reliable.','2026-07-22 08:11:16'),(166,50,32,3.5,'Good item for students.','2026-07-22 08:11:16'),(167,1,33,5.0,'Excellent overall.','2026-07-22 08:11:16'),(168,14,34,4.5,'Good quality for the price.','2026-07-22 08:12:17'),(169,62,35,3.5,'Quite decent overall.','2026-07-22 08:12:17'),(170,111,36,5.0,'Excellent choice!','2026-07-22 08:12:17'),(171,36,37,4.0,'Worth buying.','2026-07-22 08:12:17'),(172,85,38,4.5,'Really satisfied.','2026-07-22 08:12:17'),(173,18,39,3.0,'Average but acceptable.','2026-07-22 08:12:17'),(174,119,40,5.0,'Fantastic product.','2026-07-22 08:12:17'),(175,52,41,4.0,'Affordable and useful.','2026-07-22 08:12:17'),(176,21,42,4.5,'Would recommend this.','2026-07-22 08:12:17'),(177,90,43,3.5,'Met expectations.','2026-07-22 08:12:17'),(178,65,44,5.0,'Very impressive quality.','2026-07-22 08:12:17'),(179,8,45,4.0,'Nice purchase.','2026-07-22 08:12:17'),(180,97,46,4.5,'Good value.','2026-07-22 08:12:17'),(181,42,47,3.5,'Happy with it.','2026-07-22 08:12:17'),(182,75,48,5.0,'One of the best items.','2026-07-22 08:12:17'),(183,27,49,4.0,'Pretty good.','2026-07-22 08:12:17'),(184,114,50,4.5,'Will buy again.','2026-07-22 08:12:17'),(185,58,51,3.5,'Reasonable quality.','2026-07-22 08:12:17'),(186,12,52,5.0,'Highly recommended.','2026-07-22 08:12:17'),(187,93,53,4.0,'Very useful.','2026-07-22 08:12:17'),(188,31,54,4.5,'Quality exceeded expectations.','2026-07-22 08:12:17'),(189,107,55,3.5,'Nice and affordable.','2026-07-22 08:12:17'),(190,46,56,5.0,'Excellent purchase.','2026-07-22 08:12:17'),(191,82,57,4.0,'Good enough.','2026-07-22 08:12:17'),(192,5,58,4.5,'Very happy with this.','2026-07-22 08:12:17'),(193,101,59,3.5,'Satisfied overall.','2026-07-22 08:12:17'),(194,68,60,5.0,'Amazing quality.','2026-07-22 08:12:17'),(195,17,61,4.0,'Worth the money.','2026-07-22 08:12:17'),(196,116,62,4.5,'Very reliable.','2026-07-22 08:12:17'),(197,39,63,3.5,'Decent item.','2026-07-22 08:12:17'),(198,88,64,5.0,'Loved this product.','2026-07-22 08:12:17'),(199,24,65,4.0,'Good packaging.','2026-07-22 08:12:17'),(200,109,66,4.5,'Very affordable.','2026-07-22 08:12:17'),(201,57,67,3.0,'Acceptable.','2026-07-22 08:12:17'),(202,9,1,5.0,'Fresh and good quality.','2026-07-22 08:12:17'),(203,98,2,4.0,'Would purchase again.','2026-07-22 08:12:17'),(204,44,3,4.5,'Excellent overall.','2026-07-22 08:12:17'),(205,79,4,3.5,'Works well.','2026-07-22 08:12:17'),(206,2,5,5.0,'Highly satisfied.','2026-07-22 08:12:17'),(207,103,6,4.0,'Very good product.','2026-07-22 08:12:17'),(208,50,7,4.5,'Great value.','2026-07-22 08:12:17'),(209,15,8,3.5,'Not bad at all.','2026-07-22 08:12:17'),(210,84,9,5.0,'Excellent item.','2026-07-22 08:12:17'),(211,28,10,4.0,'Good quality.','2026-07-22 08:12:17'),(212,118,11,4.5,'Definitely recommended.','2026-07-22 08:12:17'),(213,61,12,3.5,'Reasonably priced.','2026-07-22 08:12:17'),(214,35,13,5.0,'Fantastic experience.','2026-07-22 08:12:17'),(215,95,14,4.0,'Very nice.','2026-07-22 08:12:17'),(216,53,15,4.5,'Will recommend to others.','2026-07-22 08:12:17'),(217,7,16,3.5,'Good budget choice.','2026-07-22 08:12:17'),(218,72,17,4.5,'Very satisfied with this purchase.','2026-07-22 08:13:09'),(219,11,18,3.5,'Good product for students.','2026-07-22 08:13:09'),(220,99,19,5.0,'Excellent quality and price.','2026-07-22 08:13:09'),(221,40,20,4.0,'Pretty decent overall.','2026-07-22 08:13:09'),(222,83,21,4.5,'Definitely worth buying.','2026-07-22 08:13:09'),(223,29,22,3.0,'Average but useful.','2026-07-22 08:13:09'),(224,115,23,5.0,'Highly recommended!','2026-07-22 08:13:09'),(225,56,24,4.0,'Very affordable.','2026-07-22 08:13:09'),(226,13,25,4.5,'Good value for money.','2026-07-22 08:13:09'),(227,91,26,3.5,'Met my expectations.','2026-07-22 08:13:09'),(228,48,27,5.0,'Excellent purchase.','2026-07-22 08:13:09'),(229,104,28,4.0,'Satisfied with the quality.','2026-07-22 08:13:09'),(230,66,29,4.5,'Fresh and reliable.','2026-07-22 08:13:09'),(231,20,30,3.5,'Nice item.','2026-07-22 08:13:09'),(232,87,31,5.0,'One of the best products.','2026-07-22 08:13:09'),(233,34,32,4.0,'Worth trying.','2026-07-22 08:13:09'),(234,120,33,4.5,'Fantastic value.','2026-07-22 08:13:09'),(235,63,34,3.5,'Affordable choice.','2026-07-22 08:13:09'),(236,6,35,5.0,'Really impressed.','2026-07-22 08:13:09'),(237,110,36,4.0,'Good overall quality.','2026-07-22 08:13:09'),(238,54,37,4.5,'Will buy again.','2026-07-22 08:13:09'),(239,26,38,3.5,'Reasonably priced.','2026-07-22 08:13:09'),(240,97,39,5.0,'Excellent item.','2026-07-22 08:13:09'),(241,45,40,4.0,'Nice experience.','2026-07-22 08:13:09'),(242,80,41,4.5,'Very useful.','2026-07-22 08:13:09'),(243,16,42,3.5,'Pretty good.','2026-07-22 08:13:09'),(244,113,43,5.0,'Highly satisfied.','2026-07-22 08:13:09'),(245,59,44,4.0,'Good purchase.','2026-07-22 08:13:09'),(246,8,45,4.5,'Quality exceeded expectations.','2026-07-22 08:13:09'),(247,102,46,3.5,'Acceptable quality.','2026-07-22 08:13:09'),(248,37,47,5.0,'Excellent and affordable.','2026-07-22 08:13:09'),(249,74,48,4.0,'Happy with this product.','2026-07-22 08:13:09'),(250,23,49,4.5,'Recommended.','2026-07-22 08:13:09'),(251,89,50,3.5,'Works well.','2026-07-22 08:13:09'),(252,51,51,5.0,'Fantastic!','2026-07-22 08:13:09'),(253,118,52,4.0,'Very nice product.','2026-07-22 08:13:09'),(254,32,53,4.5,'Good quality.','2026-07-22 08:13:09'),(255,94,54,3.5,'Worth the price.','2026-07-22 08:13:09'),(256,67,55,5.0,'One of my favourites.','2026-07-22 08:13:09'),(257,10,56,4.0,'Satisfied overall.','2026-07-22 08:13:09'),(258,108,57,4.5,'Excellent quality.','2026-07-22 08:13:09'),(259,42,58,3.5,'Fairly good.','2026-07-22 08:13:09'),(260,81,59,5.0,'Would recommend to friends.','2026-07-22 08:13:09'),(261,19,60,4.0,'Nice and fresh.','2026-07-22 08:13:09'),(262,100,61,4.5,'Great purchase.','2026-07-22 08:13:09'),(263,58,62,3.5,'Good enough.','2026-07-22 08:13:09'),(264,4,63,5.0,'Amazing quality.','2026-07-22 08:13:09'),(265,86,64,4.0,'Very reliable.','2026-07-22 08:13:09'),(266,30,65,4.5,'Excellent value.','2026-07-22 08:13:09'),(267,112,66,3.5,'Budget friendly.','2026-07-22 08:13:09'),(268,16,51,4.0,'Good product for daily use.','2026-07-22 08:54:47'),(269,72,52,4.5,'Really satisfied with this purchase.','2026-07-22 08:54:47'),(270,40,53,3.5,'Quality is acceptable.','2026-07-22 08:54:47'),(271,101,54,5.0,'Excellent product and worth the money.','2026-07-22 08:54:47'),(272,63,55,4.0,'Good taste and affordable.','2026-07-22 08:54:47'),(273,26,56,3.5,'Average but still useful.','2026-07-22 08:54:47'),(274,89,57,4.5,'Great quality and fast to finish.','2026-07-22 08:54:47'),(275,34,58,5.0,'Definitely recommended to others.','2026-07-22 08:54:47'),(276,116,59,4.0,'Good item with reasonable price.','2026-07-22 08:54:47'),(277,9,60,3.5,'Quite good compared to others.','2026-07-22 08:54:47'),(278,52,61,4.5,'Very satisfied with the quality.','2026-07-22 08:54:47'),(279,75,62,5.0,'Amazing product, will buy again.','2026-07-22 08:54:47'),(280,20,63,4.0,'Worth the price paid.','2026-07-22 08:54:47'),(281,68,64,3.5,'Product is okay overall.','2026-07-22 08:54:47'),(282,103,65,4.5,'Good packaging and quality.','2026-07-22 08:54:47'),(283,37,66,5.0,'My favourite item so far.','2026-07-22 08:54:47'),(284,81,67,4.0,'Reliable and useful product.','2026-07-22 08:54:47'),(285,6,1,3.5,'Decent quality for the price.','2026-07-22 08:54:47'),(286,54,2,4.5,'Really enjoyed this product.','2026-07-22 08:54:47'),(287,92,3,5.0,'Highly recommended item.','2026-07-22 08:54:47'),(288,28,4,4.0,'Good value and nice quality.','2026-07-22 08:54:47'),(289,119,5,3.5,'Could be improved but acceptable.','2026-07-22 08:54:47'),(290,48,6,4.5,'Fresh and satisfying.','2026-07-22 08:54:47'),(291,65,7,5.0,'Excellent purchase experience.','2026-07-22 08:54:47'),(292,19,8,4.0,'Pretty good and useful.','2026-07-22 08:54:47'),(293,87,9,3.5,'Average product quality.','2026-07-22 08:54:47'),(294,36,10,4.5,'Worth purchasing again.','2026-07-22 08:54:47'),(295,105,11,5.0,'Very happy with this item.','2026-07-22 08:54:47'),(296,50,12,4.0,'Good quality product.','2026-07-22 08:54:47'),(297,71,13,3.5,'Fair quality for the price.','2026-07-22 08:54:47'),(298,10,14,4.5,'Satisfied with the purchase.','2026-07-22 08:54:47'),(299,96,15,5.0,'Excellent and highly recommended.','2026-07-22 08:54:47'),(300,43,16,4.0,'Works as expected.','2026-07-22 08:54:47'),(301,115,17,3.5,'Not bad for everyday usage.','2026-07-22 08:54:47'),(302,60,18,4.5,'Nice product with good quality.','2026-07-22 08:54:47'),(303,25,19,5.0,'Amazing product and affordable.','2026-07-22 08:54:47'),(304,78,20,4.0,'Good experience overall.','2026-07-22 08:54:47'),(305,33,21,3.5,'Decent item but average.','2026-07-22 08:54:47'),(306,100,22,4.5,'Very useful and convenient.','2026-07-22 08:54:47'),(307,57,23,5.0,'Perfect choice for students.','2026-07-22 08:54:47'),(308,21,24,4.0,'Good product at reasonable price.','2026-07-22 08:54:47'),(309,85,25,3.5,'Satisfactory purchase.','2026-07-22 08:54:47'),(310,39,26,4.5,'Good flavour and quality.','2026-07-22 08:54:47'),(311,112,27,5.0,'Would definitely recommend.','2026-07-22 08:54:47'),(312,74,28,4.0,'Affordable and reliable.','2026-07-22 08:54:47'),(313,46,29,3.5,'Product meets expectations.','2026-07-22 08:54:47'),(314,98,30,4.5,'Very pleased with the quality.','2026-07-22 08:54:47'),(315,30,31,5.0,'Excellent value for money.','2026-07-22 08:54:47'),(316,64,32,4.0,'Nice product overall.','2026-07-22 08:54:47'),(317,117,33,4.5,'Good item and worth buying.','2026-07-22 08:54:47'),(318,4,34,4.5,'Very tasty and worth buying again.','2026-07-22 08:55:40'),(319,83,35,4.0,'Good quality and reasonable price.','2026-07-22 08:55:40'),(320,51,36,5.0,'Excellent product, highly recommended.','2026-07-22 08:55:40'),(321,23,37,3.5,'Quite good but nothing special.','2026-07-22 08:55:40'),(322,108,38,4.5,'Satisfied with this purchase.','2026-07-22 08:55:40'),(323,69,39,4.0,'Useful product for everyday needs.','2026-07-22 08:55:40'),(324,12,40,5.0,'Really enjoyed this item.','2026-07-22 08:55:40'),(325,76,41,3.5,'Quality is acceptable for the price.','2026-07-22 08:55:40'),(326,42,42,4.5,'Good packaging and fresh product.','2026-07-22 08:55:40'),(327,113,43,5.0,'One of the best products I bought.','2026-07-22 08:55:40'),(328,55,44,4.0,'Good value for students.','2026-07-22 08:55:40'),(329,90,45,3.5,'Average quality but still okay.','2026-07-22 08:55:40'),(330,15,46,4.5,'Would recommend to friends.','2026-07-22 08:55:40'),(331,104,47,5.0,'Amazing quality and taste.','2026-07-22 08:55:40'),(332,31,48,4.0,'Satisfied with the overall experience.','2026-07-22 08:55:40'),(333,67,49,3.5,'Product is fine for casual use.','2026-07-22 08:55:40'),(334,118,50,4.5,'Affordable and good quality.','2026-07-22 08:55:40'),(335,8,51,5.0,'Excellent purchase decision.','2026-07-22 08:55:40'),(336,73,52,4.0,'Good product with nice quality.','2026-07-22 08:55:40'),(337,49,53,3.5,'Not bad but could improve.','2026-07-22 08:55:40'),(338,94,54,4.5,'Very happy with this item.','2026-07-22 08:55:40'),(339,14,55,5.0,'Highly recommended for everyone.','2026-07-22 08:55:40'),(340,62,56,4.0,'Good taste and affordable price.','2026-07-22 08:55:40'),(341,35,57,3.5,'Average product performance.','2026-07-22 08:55:40'),(342,107,58,4.5,'Really useful and convenient.','2026-07-22 08:55:40'),(343,26,59,5.0,'Fantastic product, will repurchase.','2026-07-22 08:55:40'),(344,80,60,4.0,'Works well and worth the money.','2026-07-22 08:55:40'),(345,45,61,3.5,'Acceptable quality overall.','2026-07-22 08:55:40'),(346,121,62,4.5,'Great product and affordable.','2026-07-22 08:55:40'),(347,17,63,5.0,'Excellent quality and service.','2026-07-22 08:55:40'),(348,59,64,4.0,'Good item for daily usage.','2026-07-22 08:55:40'),(349,97,65,3.5,'Fair quality for the price.','2026-07-22 08:55:40'),(350,38,66,4.5,'Very satisfied with this purchase.','2026-07-22 08:55:40'),(351,11,67,5.0,'Amazing and highly recommended.','2026-07-22 08:55:40'),(352,70,1,4.0,'Nice product and good value.','2026-07-22 08:55:40'),(353,102,2,3.5,'Product is okay overall.','2026-07-22 08:55:40'),(354,53,3,4.5,'Good quality and nice packaging.','2026-07-22 08:55:40'),(355,29,4,5.0,'Definitely worth purchasing.','2026-07-22 08:55:40'),(356,86,5,4.0,'Affordable and reliable item.','2026-07-22 08:55:40'),(357,61,6,3.5,'Meets my expectations.','2026-07-22 08:55:40'),(358,99,7,4.5,'Great experience using this product.','2026-07-22 08:55:40'),(359,18,8,5.0,'My favourite item so far.','2026-07-22 08:55:40'),(360,77,9,4.0,'Good quality and reasonable price.','2026-07-22 08:55:40'),(361,46,10,3.5,'Decent product for the price.','2026-07-22 08:55:40'),(362,110,11,4.5,'Very satisfied and recommended.','2026-07-22 08:55:40'),(363,24,12,5.0,'Excellent product quality.','2026-07-22 08:55:40'),(364,66,13,4.0,'Good purchase and useful item.','2026-07-22 08:55:40'),(365,95,14,3.5,'Quite acceptable overall.','2026-07-22 08:55:40'),(366,32,15,4.5,'Worth buying again.','2026-07-22 08:55:40'),(367,114,16,5.0,'Perfect product for students.','2026-07-22 08:55:40'),(368,22,17,4.5,'Good product and worth the price.','2026-07-22 08:56:43'),(369,91,18,5.0,'Excellent quality, highly recommended.','2026-07-22 08:56:43'),(370,47,19,4.0,'Good item for daily usage.','2026-07-22 08:56:43'),(371,103,20,3.5,'Quality is acceptable.','2026-07-22 08:56:43'),(372,36,21,4.5,'Really satisfied with this purchase.','2026-07-22 08:56:43'),(373,68,22,5.0,'Amazing product and great value.','2026-07-22 08:56:43'),(374,13,23,4.0,'Nice product with good quality.','2026-07-22 08:56:43'),(375,84,24,3.5,'Average but still useful.','2026-07-22 08:56:43'),(376,56,25,4.5,'Would definitely buy again.','2026-07-22 08:56:43'),(377,109,26,5.0,'One of my favourite products.','2026-07-22 08:56:43'),(378,30,27,4.0,'Affordable and reliable.','2026-07-22 08:56:43'),(379,72,28,3.5,'Good enough for the price.','2026-07-22 08:56:43'),(380,18,29,4.5,'Very satisfied overall.','2026-07-22 08:56:43'),(381,97,30,5.0,'Excellent purchase experience.','2026-07-22 08:56:43'),(382,44,31,4.0,'Product works well.','2026-07-22 08:56:43'),(383,116,32,3.5,'Could be improved but acceptable.','2026-07-22 08:56:43'),(384,61,33,4.5,'Great quality and nice packaging.','2026-07-22 08:56:43'),(385,9,34,5.0,'Highly recommended item.','2026-07-22 08:56:43'),(386,75,35,4.0,'Good value for money.','2026-07-22 08:56:43'),(387,52,36,3.5,'Quite decent product.','2026-07-22 08:56:43'),(388,88,37,4.5,'Very useful and convenient.','2026-07-22 08:56:43'),(389,27,38,5.0,'Perfect choice for students.','2026-07-22 08:56:43'),(390,114,39,4.0,'Satisfied with the quality.','2026-07-22 08:56:43'),(391,40,40,3.5,'Fair quality for the price.','2026-07-22 08:56:43'),(392,66,41,4.5,'Really enjoyed this product.','2026-07-22 08:56:43'),(393,15,42,5.0,'Amazing taste and quality.','2026-07-22 08:56:43'),(394,101,43,4.0,'Good product overall.','2026-07-22 08:56:43'),(395,58,44,3.5,'Not bad but average.','2026-07-22 08:56:43'),(396,33,45,4.5,'Worth purchasing again.','2026-07-22 08:56:43'),(397,120,46,5.0,'Excellent and affordable.','2026-07-22 08:56:43'),(398,21,47,4.0,'Good product with reasonable price.','2026-07-22 08:56:43'),(399,79,48,3.5,'Meets my expectations.','2026-07-22 08:56:43'),(400,49,49,4.5,'Very happy with this purchase.','2026-07-22 08:56:43'),(401,93,50,5.0,'Really recommended to others.','2026-07-22 08:56:43'),(402,6,51,4.0,'Nice quality and useful.','2026-07-22 08:56:43'),(403,82,52,3.5,'Average product performance.','2026-07-22 08:56:43'),(404,37,53,4.5,'Good quality and fresh.','2026-07-22 08:56:43'),(405,105,54,5.0,'Excellent product, will buy again.','2026-07-22 08:56:43'),(406,25,55,4.0,'Good item for everyday use.','2026-07-22 08:56:43'),(407,70,56,3.5,'Acceptable quality overall.','2026-07-22 08:56:43'),(408,12,57,4.5,'Very satisfied with the purchase.','2026-07-22 08:56:43'),(409,98,58,5.0,'Fantastic product and affordable.','2026-07-22 08:56:43'),(410,54,59,4.0,'Good experience using this item.','2026-07-22 08:56:43'),(411,81,60,3.5,'Decent product for the price.','2026-07-22 08:56:43'),(412,45,61,4.5,'Great value and quality.','2026-07-22 08:56:43'),(413,111,62,5.0,'Highly satisfied with this item.','2026-07-22 08:56:43'),(414,63,63,4.0,'Good product and reliable.','2026-07-22 08:56:43'),(415,19,64,3.5,'Product is okay overall.','2026-07-22 08:56:43'),(416,96,65,4.5,'Really good quality.','2026-07-22 08:56:43'),(417,34,66,5.0,'Excellent, highly recommended.','2026-07-22 08:56:43'),(418,5,67,4.5,'Really good product and worth buying.','2026-07-22 08:57:10'),(419,76,1,5.0,'Excellent quality and highly recommended.','2026-07-22 08:57:10'),(420,42,2,4.0,'Good product for everyday use.','2026-07-22 08:57:10'),(421,95,3,3.5,'Quality is acceptable for the price.','2026-07-22 08:57:10'),(422,17,4,4.5,'Satisfied with this purchase.','2026-07-22 08:57:10'),(423,64,5,5.0,'Amazing product and great value.','2026-07-22 08:57:10'),(424,29,6,4.0,'Nice item with good quality.','2026-07-22 08:57:10'),(425,108,7,3.5,'Average product but still useful.','2026-07-22 08:57:10'),(426,53,8,4.5,'Would definitely purchase again.','2026-07-22 08:57:10'),(427,87,9,5.0,'One of the best items I bought.','2026-07-22 08:57:10'),(428,34,10,4.0,'Good quality and affordable.','2026-07-22 08:57:10'),(429,71,11,3.5,'Decent product for daily usage.','2026-07-22 08:57:10'),(430,14,12,4.5,'Very satisfied with the quality.','2026-07-22 08:57:10'),(431,100,13,5.0,'Excellent product experience.','2026-07-22 08:57:10'),(432,46,14,4.0,'Works well and meets expectations.','2026-07-22 08:57:10'),(433,83,15,3.5,'Fair quality overall.','2026-07-22 08:57:10'),(434,23,16,4.5,'Good taste and nice packaging.','2026-07-22 08:57:10'),(435,119,17,5.0,'Highly recommended product.','2026-07-22 08:57:10'),(436,57,18,4.0,'Worth the money spent.','2026-07-22 08:57:10'),(437,10,19,3.5,'Product is okay but average.','2026-07-22 08:57:10'),(438,69,20,4.5,'Great quality and useful item.','2026-07-22 08:57:10'),(439,38,21,5.0,'Excellent value for money.','2026-07-22 08:57:10'),(440,92,22,4.0,'Good product and reliable.','2026-07-22 08:57:10'),(441,26,23,3.5,'Acceptable quality.','2026-07-22 08:57:10'),(442,104,24,4.5,'Really enjoyed this purchase.','2026-07-22 08:57:10'),(443,60,25,5.0,'Fantastic product, will buy again.','2026-07-22 08:57:10'),(444,31,26,4.0,'Good item for students.','2026-07-22 08:57:10'),(445,78,27,3.5,'Quite decent product.','2026-07-22 08:57:10'),(446,16,28,4.5,'Very useful and affordable.','2026-07-22 08:57:10'),(447,113,29,5.0,'Perfect choice and recommended.','2026-07-22 08:57:10'),(448,50,30,4.0,'Good quality product.','2026-07-22 08:57:10'),(449,85,31,3.5,'Could be better but acceptable.','2026-07-22 08:57:10'),(450,41,32,4.5,'Satisfied with this item.','2026-07-22 08:57:10'),(451,98,33,5.0,'Amazing quality and taste.','2026-07-22 08:57:10'),(452,20,34,4.0,'Good purchase experience.','2026-07-22 08:57:10'),(453,67,35,3.5,'Average quality but okay.','2026-07-22 08:57:10'),(454,115,36,4.5,'Really worth the price.','2026-07-22 08:57:10'),(455,55,37,5.0,'Excellent product overall.','2026-07-22 08:57:10'),(456,8,38,4.0,'Good and reliable item.','2026-07-22 08:57:10'),(457,74,39,3.5,'Meets my expectations.','2026-07-22 08:57:10'),(458,39,40,4.5,'Very satisfied with the purchase.','2026-07-22 08:57:10'),(459,106,41,5.0,'Highly recommended to everyone.','2026-07-22 08:57:10'),(460,28,42,4.0,'Nice product and affordable.','2026-07-22 08:57:10'),(461,89,43,3.5,'Average but still useful.','2026-07-22 08:57:10'),(462,62,44,4.5,'Great product quality.','2026-07-22 08:57:10'),(463,12,45,5.0,'Excellent and worth purchasing.','2026-07-22 08:57:10'),(464,97,46,4.0,'Good experience overall.','2026-07-22 08:57:10'),(465,35,47,3.5,'Fair price and acceptable quality.','2026-07-22 08:57:10'),(466,117,48,4.5,'Very good product.','2026-07-22 08:57:10'),(467,51,49,5.0,'My favourite item so far.','2026-07-22 08:57:10'),(468,1,50,5.0,'Excellent product and worth the price.','2026-07-22 08:57:41'),(469,38,51,4.5,'Very satisfied with this purchase.','2026-07-22 08:57:41'),(470,70,52,4.0,'Good quality and affordable.','2026-07-22 08:57:41'),(471,95,53,5.0,'Highly recommended product.','2026-07-22 08:57:41'),(472,120,54,4.5,'Great item with good value.','2026-07-22 08:57:41'),(473,12,55,3.5,'Quality is acceptable.','2026-07-22 08:57:41'),(474,49,56,5.0,'Amazing product, will buy again.','2026-07-22 08:57:41'),(475,82,57,4.0,'Useful product for daily needs.','2026-07-22 08:57:41'),(476,33,58,4.5,'Good packaging and quality.','2026-07-22 08:57:41'),(477,105,59,5.0,'Excellent experience using this item.','2026-07-22 08:57:41'),(478,64,60,3.5,'Decent product for the price.','2026-07-22 08:57:41'),(479,27,61,4.5,'Really enjoyed this product.','2026-07-22 08:57:41'),(480,88,62,4.0,'Good product overall.','2026-07-22 08:57:41'),(481,15,63,5.0,'One of my favourite items.','2026-07-22 08:57:41'),(482,57,64,4.5,'Affordable and reliable.','2026-07-22 08:57:41'),(483,103,65,3.5,'Average quality but still useful.','2026-07-22 08:57:41'),(484,45,66,4.0,'Satisfied with the purchase.','2026-07-22 08:57:41'),(485,76,67,5.0,'Excellent quality and taste.','2026-07-22 08:57:41'),(486,20,1,4.5,'Worth purchasing again.','2026-07-22 08:57:41'),(487,91,2,4.0,'Good item and reasonable price.','2026-07-22 08:57:41'),(488,54,3,5.0,'Fantastic product, highly recommended.','2026-07-22 08:57:41'),(489,39,4,3.5,'Product is okay overall.','2026-07-22 08:57:41'),(490,110,5,4.5,'Very good quality product.','2026-07-22 08:57:41'),(491,68,6,5.0,'Perfect choice for students.','2026-07-22 08:57:41'),(492,24,7,4.0,'Nice product and affordable.','2026-07-22 08:57:41'),(493,99,8,4.5,'Great value for money.','2026-07-22 08:57:41'),(494,31,9,3.5,'Could be improved but acceptable.','2026-07-22 08:57:41'),(495,116,10,5.0,'Excellent product experience.','2026-07-22 08:57:41'),(496,52,11,4.0,'Good and reliable item.','2026-07-22 08:57:41'),(497,84,12,4.5,'Satisfied with the quality.','2026-07-22 08:57:41'),(498,18,13,5.0,'Highly recommended and useful.','2026-07-22 08:57:41'),(499,73,14,4.0,'Good purchase overall.','2026-07-22 08:57:41'),(500,42,15,4.5,'Really worth the money.','2026-07-22 08:57:41');
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_logs`
--

DROP TABLE IF EXISTS `report_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report_logs` (
  `reportID` int(11) NOT NULL AUTO_INCREMENT,
  `adminID` int(11) DEFAULT NULL,
  `reportType` varchar(30) DEFAULT NULL,
  `format` varchar(20) DEFAULT NULL,
  `generatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`reportID`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_logs`
--

LOCK TABLES `report_logs` WRITE;
/*!40000 ALTER TABLE `report_logs` DISABLE KEYS */;
INSERT INTO `report_logs` VALUES (1,1,'item','CSV','2026-07-25 10:00:24'),(2,1,'item','JSON','2026-07-25 10:02:06'),(3,1,'item','JSON','2026-07-25 10:02:17'),(4,1,'item','JSON','2026-07-25 10:02:17'),(5,1,'item','Excel','2026-07-25 10:03:51'),(6,1,'item','Excel','2026-07-25 10:03:52'),(7,1,'student','Excel','2026-07-25 10:04:38'),(8,1,'student','Excel','2026-07-25 10:04:39'),(9,1,'rating','Excel','2026-07-25 10:05:16'),(10,1,'rating','Excel','2026-07-25 10:05:16'),(11,1,'item','Excel','2026-07-25 10:11:29'),(12,1,'item','Excel','2026-07-25 10:11:30'),(13,1,'item','PDF','2026-07-25 10:15:47'),(14,1,'item','PDF','2026-07-25 10:15:48'),(15,1,'item','PDF','2026-07-25 10:44:40'),(16,1,'item','PDF','2026-07-25 10:44:49'),(17,1,'item','PDF','2026-07-25 10:44:50'),(18,1,'item','CSV','2026-07-27 15:37:32'),(19,1,'item','CSV','2026-07-27 15:37:33'),(20,1,'item','PDF','2026-07-27 17:00:27'),(21,1,'item','PDF','2026-07-27 17:00:28'),(22,1,'item','PDF','2026-07-27 17:01:03'),(23,1,'item','PDF','2026-07-27 17:01:32'),(24,1,'item','PDF','2026-07-27 17:01:50'),(25,1,'item','PDF','2026-07-27 17:03:01'),(26,1,'item','PDF','2026-07-27 17:03:17'),(27,1,'item','PDF','2026-07-27 17:03:18'),(28,1,'item','PDF','2026-07-27 17:04:01'),(29,1,'item','PDF','2026-07-27 17:04:10'),(30,1,'item','PDF','2026-07-27 17:04:13'),(31,1,'item','CSV','2026-07-27 17:20:26'),(32,1,'item','CSV','2026-07-27 17:20:26');
/*!40000 ALTER TABLE `report_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store`
--

DROP TABLE IF EXISTS `store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `store` (
  `storeID` int(11) NOT NULL AUTO_INCREMENT,
  `StoreName` varchar(255) NOT NULL,
  `desc1` varchar(255) NOT NULL,
  `storeIMG` varchar(255) NOT NULL,
  PRIMARY KEY (`storeID`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store`
--

LOCK TABLES `store` WRITE;
/*!40000 ALTER TABLE `store` DISABLE KEYS */;
INSERT INTO `store` VALUES (1,'e-Mart Summer Mall','Offers a variety of electronics, appliances, fashion, beauty products, and groceries with competitive prices and convenient shopping.','../../assets/images/store/emart.jpg'),(2,'H&L Aiman Mall','Provides fresh produce, groceries, and household items with quality products at affordable prices and a comfortable shopping experience.','../../assets/images/store/hnl.jpg'),(3,'Everrise Express','Convenience supermarket offering fresh groceries, beverages, snacks, and daily household essentials.','../../assets/images/store/everrise.jpg'),(4,'Farley Supermarket','Neighborhood supermarket providing fresh produce, frozen food, groceries, and household necessities.','../../assets/images/store/farley.jpg'),(5,'Choice Daily','Convenience store offering snacks, drinks, ready-to-eat meals, and everyday essentials.','../../assets/images/store/choice-daily.jpg'),(6,'Emart Express','Local convenience store providing groceries, beverages, and household items for quick shopping.','../../assets/images/store/emart-express.jpg'),(7,'99 Speedmart','Mini market offering affordable groceries, beverages, personal care products, and household essentials.','../../assets/images/store/99speedmart.jpg'),(8,'Servay Hypermarket','Supermarket providing fresh vegetables, meat, groceries, and daily necessities.','../../assets/images/store/servay.jpg'),(9,'KK Super Mart','Convenience store selling groceries, snacks, drinks, frozen food, and household products.','../../assets/images/store/kksupermart.jpg'),(10,'Unaco Superstore','Local supermarket providing groceries, fresh food, beverages, and daily household essentials.','../../assets/images/store/unaco.jpg'),(11,'Eco-Shop','Value store offering household items, kitchenware, stationery, toys, and daily essentials at affordable prices.','../../assets/images/store/ecoshop.png'),(12,'7-Eleven','Convenience store providing beverages, snacks, ready-to-eat meals, and essential daily products.','../../assets/images/store/7eleven.jpg'),(13,'myNEWS','Convenience store offering coffee, sandwiches, pastries, snacks, drinks, and convenience items.','../../assets/images/store/mynews.jpg'),(14,'Orange Convenience Store','Neighborhood convenience store selling groceries, beverages, frozen food, and household essentials.','../../assets/images/store/orange.jpg'),(15,'Happy Farm Fresh Mart ','Fresh market providing vegetables, seafood, meat, fruits, and local agricultural products.','../../assets/images/store/happyfarm.jpg'),(16,'Jaya Grocer Express','Compact grocery store with fresh food, imported products, beverages, and household necessities.','../../assets/images/store/jaya-grocer.jpg'),(17,'Ninso Kota Samarahan','Variety store offering household goods, snacks, kitchenware, stationery, toys, and affordable daily necessities.','../../assets/images/store/ninso.jpg'),(18,'Choice Semariang','Supermarket providing fresh groceries, beverages, frozen food, household essentials, and personal care products.','../../assets/images/store/choice-supermall.jpg');
/*!40000 ALTER TABLE `store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `studentID` int(11) NOT NULL AUTO_INCREMENT,
  `fullName` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `studentIMG` varchar(255) NOT NULL,
  `logStatus` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`studentID`)
) ENGINE=InnoDB AUTO_INCREMENT=1015 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,'Faizatul Fitri Bin Boestamam','fai','fai@gmail.com','$2y$10$hS27L5TGPBWYjTagWAf4i.RZL4zvEB3Z0eoG50xcQgXTE./0LTUD2','../../assets/images/profile/fai.jpg','0','2024-03-15 02:30:00'),(2,'Mohammad Amir Alam Bin Rahim Omar','amiromar','amir@gmail.com','abc123','../../assets/images/profile/amir.jpg','0','2024-03-15 02:30:00'),(3,'Harith Zakwan Bin Zakaria','harith','harith@gmail.com','abc123','../../assets/images/profile/harith.jpg','0','2024-03-15 02:30:00'),(4,'Mohamad Waqiuddin Bin Yahya','qiu','qiu@gmail.com','abc123','../../assets/images/profile/qiu.jpeg','0','2024-03-15 02:30:00'),(5,'Iman Tarmizi Rosalina','iman','iman@gmail.com','abc123','../../assets/images/profile/iman.jpg','0','2024-03-15 02:30:00'),(6,'John Cena','cena','john@gmail.com','wwe123','../../assets/images/profile/cena.png','0','2024-03-15 02:30:00'),(7,'Syed Saddiq Syed Abdul Rahman','saddiq','saddiq@gmail.com','abc123','../../assets/images/profile/saddiq.png','0','2025-02-20 01:15:00'),(8,'Nik Nazmi Nik Ahmad','nik','nik@gmail.com','abc123','../../assets/images/profile/nik.png','0','2025-02-20 01:15:00'),(9,'Mohd Rafizi Bin Ramli','rafizi','rafizi@gmail.com','abc123','../../assets/images/profile/rafizi.png','0','2025-02-20 01:15:00'),(10,'Syafiq Kyle','syafiq','syafiq@gmail.com','abc123','../../assets/images/profile/syafiq.png','0','2025-02-20 01:15:00'),(11,'Mohammad Erling Haaland','erling','erling@gmail.com','abc123','../../assets/images/profile/erling.png','0','2025-02-20 01:15:00'),(12,'Muhammad Firdaus Wong','firdaus','firdaus@gmail.com','abc123','../../assets/images/profile/firdaus.png','0','2025-02-20 01:15:00'),(13,'Jamal Musiala','jamal','musiala@gmail.com','abc123','../../assets/images/profile/musiala.png','0','2025-02-20 01:15:00'),(14,'Daniel Lee Zi Jia','daniel','daniel@gmail.com','abc123','../../assets/images/profile/daniel.png','0','2025-02-20 01:15:00'),(15,'Nur Amirah Olsen','amirah','amirah@gmail.com','abc123','../../assets/images/profile/amirah.png','0','2025-02-20 01:15:00'),(16,'Muhammad Danish Hojlund','danish','danish@gmail.com','abc123','../../assets/images/profile/danish.png','0','2025-02-20 01:15:00'),(17,'Amelia Henderson','amelia','amelia@gmail.com','abc123','../../assets/images/profile/amelia.png','0','2025-02-20 01:15:00'),(18,'Muhammad Izzat Sidek Bin Zainal Rasyid','izzat','izzat@gmail.com','abc123','../../assets/images/profile/sidek.png','0','2025-02-20 01:15:00'),(19,'Siti Aina Scarlett Binti Yusof Johansson','aina','aina@gmail.com','abc123','../../assets/images/profile/aina.png','0','2025-02-20 01:15:00'),(20,'Mohd Muhsin Hakim Bin al-Rahman','hakim','hakim@gmail.com','abc123','../../assets/images/profile/hakim.png','0','2025-02-20 01:15:00'),(21,'Tracie Sindol','tracie','tracie@gmail.com','abc123','../../assets/images/profile/tracie.png','0','2025-08-10 06:20:00'),(22,'Aedy Ashraf','aedy','aedy@gmail.com','abc123','../../assets/images/profile/aedy.png','0','2025-08-10 06:20:00'),(23,'Daiyan Trisha','daiyan','daiyan@gmail.com','abc123','../../assets/images/profile/daiyan.png','0','2025-08-10 06:20:00'),(24,'Jason Tan Chee Keong','jason','jason@gmail.com','abc123','../../assets/images/profile/jasontan.png','0','2025-08-10 06:20:00'),(25,'Nur Sabrina Binti Salleh','sabrina','sabrina@gmail.com','abc123','../../assets/images/profile/sabrina.png','0','2025-08-10 06:20:00'),(26,'Muhammad Arif Dabush Bin Kamarudin','dabush','dabush@gmail.com','abc123','../../assets/images/profile/dabush.png','0','2025-08-10 06:20:00'),(27,'Angelina Chai Ka Yung','angel','angel@gmail.com','abc123','../../assets/images/profile/angel.png','0','2025-08-10 06:20:00'),(28,'Muhammad Aiman Banna','aiman','aiman@gmail.com','abc123','../../assets/images/profile/aiman.png','0','2025-08-10 06:20:00'),(29,'Siti Nabilah Binti Shukri','nabilah','nabilah@gmail.com','abc123','../../assets/images/profile/nabilah.png','0','2025-08-10 06:20:00'),(30,'Mohd Jalal Bin Jalil','jalal','jalil@gmail.com','abc123','../../assets/images/profile/jalil.png','0','2025-08-10 06:20:00'),(31,'Nur Izzah Anwar','izzah','izzah@gmail.com','abc123','../../assets/images/profile/izzah.png','0','2025-08-10 06:20:00'),(32,'Muhammad Faiz Sharnaf','faiz','faiz@gmail.com','abc123','../../assets/images/profile/sharnaf.png','0','2025-08-10 06:20:00'),(33,'Siti Sofia Binti Ibrahim','sofia','sofia@gmail.com','abc123','../../assets/images/profile/sofia.png','0','2025-08-10 06:20:00'),(34,'Kelvin Wong Jun Hao','kelvin','kelvin@gmail.com','abc123','../../assets/images/profile/kelvin.png','0','2025-08-10 06:20:00'),(35,'Fadhli Masoot','fadhli','fadhli@gmail.com','abc123','../../assets/images/profile/fadhli.png','0','2025-08-10 06:20:00'),(36,'Ariffin Bin Zul','irfan','irfan@gmail.com','abc123','../../assets/images/profile/ariffin.png','0','2025-08-10 06:20:00'),(37,'Iman Alysha','imanopie','imanopie@gmail.com','abc123','../../assets/images/profile/imanopie.png','0','2025-08-10 06:20:00'),(38,'Mierul Haziq Aiman','haziq','haziq@gmail.com','abc123','../../assets/images/profile/mierul.png','0','2025-08-10 06:20:00'),(39,'Siti Mariam Khadijah','mariam','mariam@gmail.com','abc123','../../assets/images/profile/mariam.png','0','2025-08-10 06:20:00'),(40,'Mohd Amir Ahnaf','ahnaf','ahnaf@gmail.com','abc123','../../assets/images/profile/amirahnaf.png','0','2025-08-10 06:20:00'),(41,'Nadhir Nassar','nadhir','nadhir@gmail.com','abc123','../../assets/images/profile/nadhir.png','0','2026-01-12 03:00:00'),(42,'Ferran Torres','ferran','ferran@gmail.com','abc123','../../assets/images/profile/ferran.png','0','2026-01-12 03:00:00'),(43,'Rodrigo Hernandez Cascante','rodri','rodri@gmail.com','abc123','../../assets/images/profile/rodri.png','0','2026-01-12 03:00:00'),(44,'Tan Jia Wei','jiawei','jiawei@gmail.com','abc123','../../assets/images/profile/tanjiawei.png','0','2026-01-12 03:00:00'),(45,'Nur Hanisah van Dyne','hanisah','hanisah@gmail.com','abc123','../../assets/images/profile/hanisah.png','0','2026-01-12 03:00:00'),(46,'Muhammad Luqman Podolski','luqman','luqman@gmail.com','abc123','../../assets/images/profile/luqman.png','0','2026-01-12 03:00:00'),(47,'Siti Hajar Harb','hajar','hajar@gmail.com','abc123','../../assets/images/profile/hajar.png','0','2026-01-12 03:00:00'),(48,'Mohd Asyraf Bin Kane','asyraf','asyraf@gmail.com','abc123','../../assets/images/profile/asyraf.png','0','2026-01-12 03:00:00'),(49,'Pau Cubarsi','pau','pau@gmail.com','abc123','../../assets/images/profile/pau.png','0','2026-01-12 03:00:00'),(50,'Raj Kumar A/L Muniandy','rajkumar','rajkumar@gmail.com','abc123','../../assets/images/profile/kumar.png','0','2026-01-12 03:00:00'),(51,'Sanjna Suri','suri','suri@gmail.com','abc123','../../assets/images/profile/suri.png','0','2026-01-12 03:00:00'),(52,'Anthony Nazmi Taylor','nazmi','nazmi@gmail.com','abc123','../../assets/images/profile/anthony.png','0','2026-01-12 03:00:00'),(53,'Anna Jobling','anna','anna@gmail.com','abc123','../../assets/images/profile/jobling.png','0','2026-01-12 03:00:00'),(54,'Mohd Danial Bin Harun Naim','danial','danial@gmail.com','abc123','../../assets/images/profile/danialnaim.png','0','2026-01-12 03:00:00'),(55,'Kylian Mbappe','mbappe','mbappe@gmail.com','abc123','../../assets/images/profile/mbappe.png','0','2026-01-12 03:00:00'),(56,'Muhammad Faris Bin Yamal','faris','faris@gmail.com','abc123','../../assets/images/profile/faris.png','0','2026-07-21 08:44:03'),(57,'Siti Humaira Brunnhilde','humaira','humaira@gmail.com','abc123','../../assets/images/profile/humaira.png','0','2026-07-21 08:44:03'),(58,'Lim Wei Sheng','weisheng','weisheng@gmail.com','abc123','../../assets/images/profile/limwei.png','0','2026-07-21 08:44:03'),(59,'Lionel Messi','messi','messi@gmail.com','abc123','../../assets/images/profile/messi.png','0','2026-07-21 08:44:03'),(60,'Cristiano Ronaldo','ronaldo','ronaldo@gmail.com','abc123','../../assets/images/profile/ronaldo.png','0','2026-07-21 08:44:03'),(61,'Nur Iman Carol Binti Danver','nuriman','nuriman@gmail.com','abc123','../../assets/images/profile/nuriman.png','0','2026-07-21 08:44:03'),(62,'Cole Palmer','cole','cole@gmail.com','abc123','../../assets/images/profile/cole.png','0','2026-07-21 08:44:03'),(63,'Siti Nur Aina Binti Iskandar','ainaiskandar','ainaiskandar@gmail.com','abc123','../../assets/images/profile/sitiaina.png','0','2026-07-21 08:44:03'),(64,'Mohd Hafeez Bin Hamzah','hafeez','hafeez@gmail.com','abc123','../../assets/images/profile/hafeezhamzah.png','0','2026-07-21 08:44:03'),(65,'Nur Shazana Binti Karim','shazana','shazana@gmail.com','abc123','../../assets/images/profile/shazana.png','0','2026-07-21 08:44:03'),(66,'Muhammad Qayyum Bin Salleh','qayyum','qayyum@gmail.com','abc123','../../assets/images/profile/qayyumsalleh.jpg','0','2026-07-21 08:44:03'),(67,'Priscilla Wong Mei Ling','priscilla','priscilla@gmail.com','abc123','../../assets/images/profile/priscilla.jpg','0','2026-07-21 08:44:03');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wishlist` (
  `wishlistID` int(11) NOT NULL AUTO_INCREMENT,
  `studentID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`wishlistID`),
  UNIQUE KEY `unique_wishlist` (`studentID`,`ItemID`),
  KEY `fk_wishlist_item` (`ItemID`),
  CONSTRAINT `fk_wishlist_item` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ItemID`) ON DELETE CASCADE,
  CONSTRAINT `fk_wishlist_student` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlist`
--

LOCK TABLES `wishlist` WRITE;
/*!40000 ALTER TABLE `wishlist` DISABLE KEYS */;
INSERT INTO `wishlist` VALUES (8,1,2,'2026-07-23 02:35:42'),(9,1,3,'2026-07-23 02:35:43'),(10,1,4,'2026-07-23 02:35:45'),(11,1,5,'2026-07-23 02:35:46'),(14,1,106,'2026-07-23 18:11:54'),(15,1,1,'2026-07-27 13:43:57');
/*!40000 ALTER TABLE `wishlist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-07-28  1:28:15
