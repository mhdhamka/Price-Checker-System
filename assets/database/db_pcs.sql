-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2026 at 05:32 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pcs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `adminFullname` varchar(255) NOT NULL,
  `adminUsername` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPassword` varchar(255) NOT NULL,
  `adminIMG` varchar(255) NOT NULL,
  `logStatus` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminFullname`, `adminUsername`, `adminEmail`, `adminPassword`, `adminIMG`, `logStatus`, `created_at`) VALUES
(1, 'Mohd Hamka', 'mdhamka', 'hamka@gmail.com', 'abc123', '../../assets/images/admin/hamka.jpg', '0', '2024-02-15 13:21:25'),
(2, 'Liu Yang', 'liuyang', 'liuyang@gmail.com', '$2y$10$4Fg8Hj7Kp2Lm9Qs5Xz1NBuT6Yv3Wm8Rd9Lp5Qx7Za2Kf6Nc8Vb0Pw', '../../assets/images/admin/liu.png', '0', '2024-06-21 06:15:10'),
(3, 'Simone Biles', 'simone', 'simone@gmail.com', '$2y$10$9Lm3Xv7Qp5Rt8Nk2Hd6ZaUj4Bw1Cs9Fy7Wp3Mv6Xq8Kz2Nr5Gh0Aa', '../../assets/images/admin/simeone.png', '0', '2025-01-12 01:45:33'),
(4, 'Novak Djokovic', 'novakdjokovic', 'novak@gmail.com', '$2y$10$2Qa7Lm9Xv4Pc8Rt5Nz6HwUd3Jk1Bs9Fy7Wp5Mv6Xq8Kz2Nr5Gh0Bb', '../../assets/images/admin/novak.png', '0', '2025-08-30 08:20:45'),
(5, 'Yuzuru Hanyu', 'yuzuru', 'yuzuru@gmail.com', '$2y$10$7Lp5Xq9Vm3Rt8Nk2Hd6ZaUj4Bw1Cs9Fy7Wp5Mv6Xq8Kz2Nr5Gh0Cc', '../../assets/images/admin/yuzuru.png', '0', '2026-03-18 03:10:15'),
(6, 'Katie Ledecky', 'katie', 'katie@gmail.com', '$2y$10$5Rt8Nk2Hd6ZaUj4Bw1Cs9Fy7Wp5Mv6Xq8Kz2Nr5Gh0AaLm3Xv7Q', '../../assets/images/admin/katie.png', '0', '2026-05-22 05:35:50'),
(7, 'Armand Duplantis', 'armand', 'armand@gmail.com', '$2y$10$3Xv7Qp5Rt8Nk2Hd6ZaUj4Bw1Cs9Fy7Wp5Mv6Xq8Kz2Nr5Gh0AaLm', '../../assets/images/admin/armand.png', '0', '2026-07-10 00:25:30');

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `auditID` int(11) NOT NULL,
  `adminID` int(11) NOT NULL,
  `module` varchar(100) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `ipAddress` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`auditID`, `adminID`, `module`, `action`, `target`, `description`, `ipAddress`, `created_at`) VALUES
(13, 1, 'Authentication', 'LOGIN', 'Admin Account', 'Administrator successfully logged into the system.', '192.168.1.10', '2026-07-20 00:15:22'),
(14, 1, 'Product', 'CREATE', 'Coca Cola 1.5L', 'Added a new product with price RM5.80 under Beverage category.', '192.168.1.10', '2026-07-20 01:30:45'),
(15, 1, 'Product', 'UPDATE', 'Maggi Curry Noodles', 'Updated product information including price and description.', '192.168.1.10', '2026-07-20 02:45:12'),
(16, 1, 'Category', 'CREATE', 'Coffee', 'Created a new product category Coffee.', '192.168.1.15', '2026-07-21 03:20:33'),
(17, 1, 'Store', 'CREATE', 'H&L Supermarket', 'Added a new store into the Price Checker System.', '192.168.1.10', '2026-07-21 05:05:40'),
(18, 1, 'Student', 'DELETE', 'Student Account: Ahmad Rahman', 'Removed inactive student account from the system.', '192.168.1.15', '2026-07-22 01:12:18'),
(19, 1, 'Rating', 'DELETE', 'Product Rating ID #15', 'Removed inappropriate product rating submitted by student.', '192.168.1.10', '2026-07-22 06:30:55'),
(20, 1, 'Report', 'EXPORT', 'Item Report PDF', 'Generated and exported item analytics report in PDF format.', '192.168.1.10', '2026-07-23 02:05:26'),
(21, 1, 'Backup', 'CREATE', 'db_pcs_backup_20260723.sql', 'Created a database backup file successfully.', '192.168.1.15', '2026-07-23 07:40:10'),
(22, 1, 'Backup', 'RESTORE', 'db_pcs_backup_20260720.sql', 'Restored database using previous backup file.', '192.168.1.10', '2026-07-24 08:25:44'),
(23, 1, 'Report', 'EXPORT', 'Student Registration Report Excel', 'Exported monthly student registration analytics into Excel format.', '192.168.1.10', '2026-07-25 01:50:30'),
(24, 1, 'Authentication', 'LOGOUT', 'Admin Account', 'Administrator logged out from the system.', '192.168.1.15', '2026-07-25 09:10:05'),
(25, 1, 'Admin', 'LOGOUT', 'Admin Account', 'Admin logged out from the system', '::1', '2026-07-27 15:49:23'),
(26, 1, 'Admin', 'LOGIN', 'Admin Account', 'Admin logged into the system', '::1', '2026-07-27 15:49:56'),
(27, 1, 'Admin', 'LOGOUT', 'Admin Account', 'Admin logged out from the system', '127.0.0.1', '2026-07-27 15:52:10'),
(28, 1, 'Admin', 'LOGIN', 'Admin Account', 'Admin logged into the system', '127.0.0.1', '2026-07-27 15:52:18'),
(29, 1, 'Admin', 'LOGOUT', 'Admin Account', 'Admin logged out from the system', '127.0.0.1', '2026-07-27 15:59:27'),
(30, 1, 'Admin', 'LOGIN', 'Admin Account', 'Admin logged into the system', '127.0.0.1', '2026-07-27 15:59:36'),
(31, 1, 'Item', 'ADD', 'aaaaaa', 'Added new item aaaaaa', '127.0.0.1', '2026-07-27 16:08:44'),
(32, 1, 'Item', 'UPDATE', 'john cena bin chilling', 'Updated item from aaaaaa to john cena bin chilling', '127.0.0.1', '2026-07-27 16:10:24'),
(33, 1, 'Item', 'UPDATE', 'Ayam Brand Tomato Sardines', 'Updated item from Ayam Brand Sardines in Tomato Sauce to Ayam Brand Tomato Sardines', '127.0.0.1', '2026-07-27 16:11:26'),
(34, 1, 'Item', 'DELETE', 'aaaaaa', 'Deleted item aaaaaa', '127.0.0.1', '2026-07-27 16:12:25'),
(35, 1, 'Item', 'DELETE', 'john cena bin chilling', 'Deleted item john cena bin chilling', '127.0.0.1', '2026-07-27 16:12:56'),
(36, 1, 'Student', 'UPDATE', 'Faizatul Fitri Bin Boestamam', 'Reset password for student Faizatul Fitri Bin Boestamam', '127.0.0.1', '2026-07-27 16:18:08'),
(37, 1, 'Student', 'UPDATE', 'Faizatul Fitri Bin Boestamam', 'Enabled student account Faizatul Fitri Bin Boestamam', '127.0.0.1', '2026-07-27 16:18:56'),
(38, 1, 'Student', 'UPDATE', 'Faizatul Fitri Bin Boestamam', 'Disabled student account Faizatul Fitri Bin Boestamam', '127.0.0.1', '2026-07-27 16:19:01'),
(39, 1, 'Admin', 'UPDATE', 'Mohd Hamkas', 'Updated admin account from Mohd Hamkas to Mohd Hamkas', '127.0.0.1', '2026-07-27 16:28:21'),
(40, 1, 'Admin', 'UPDATE', 'Mohd Hamka', 'Updated admin account from Mohd Hamkas to Mohd Hamka', '127.0.0.1', '2026-07-27 16:28:38'),
(41, 1, 'Admin', 'ADD', 'sssssssss', 'Added new admin account sssssssss', '127.0.0.1', '2026-07-27 16:29:05'),
(42, 1, 'Admin', 'UPDATE', 'sssssssss', 'Reset password for admin sssssssss', '127.0.0.1', '2026-07-27 16:31:14'),
(43, 1, 'Admin', 'UPDATE', 'sssssssss', 'Disabled admin account sssssssss', '127.0.0.1', '2026-07-27 16:34:07'),
(44, 1, 'Store', 'UPDATE', 'e-Mart Summer Malls', 'Updated store from e-Mart Summer Mall to e-Mart Summer Malls', '127.0.0.1', '2026-07-27 16:42:36'),
(45, 1, 'Store', 'UPDATE', 'e-Mart Summer Mall', 'Updated store from e-Mart Summer Malls to e-Mart Summer Mall', '127.0.0.1', '2026-07-27 16:42:49'),
(46, 1, 'Store', 'ADD', 'dffszzfzf', 'Added new store dffszzfzf', '127.0.0.1', '2026-07-27 16:44:19'),
(47, 1, 'Store', 'DELETE', 'dffszzfzf', 'Deleted store dffszzfzf', '127.0.0.1', '2026-07-27 16:44:56'),
(48, 1, 'Report', 'EXPORT', 'Item Report PDF', 'Generated Item PDF report', '127.0.0.1', '2026-07-27 17:04:01'),
(49, 1, 'Report', 'EXPORT', 'Item Report PDF', 'Generated Item PDF report', '127.0.0.1', '2026-07-27 17:04:10'),
(50, 1, 'Report', 'EXPORT', 'Item Report PDF', 'Generated Item PDF report', '127.0.0.1', '2026-07-27 17:04:13'),
(51, 1, 'Report', 'EXPORT', 'Item Report CSV', 'Generated Item report in CSV format', '127.0.0.1', '2026-07-27 17:20:26'),
(52, 1, 'Report', 'EXPORT', 'Item Report CSV', 'Generated Item report in CSV format', '127.0.0.1', '2026-07-27 17:20:26'),
(53, 1, 'Backup', 'CREATE', 'database_20260727_192815.sql', 'Created database backup database_20260727_192815.sql', '127.0.0.1', '2026-07-27 17:28:15'),
(54, 1, 'Admin', 'UPDATE', 'mdhamka', 'Updated profile information from mdhamka to mdhamka', '127.0.0.1', '2026-07-27 17:34:46'),
(55, 1, 'Admin', 'UPDATE', 'mdhamka', 'Updated admin profile: fullname from Mohd Hamkas to Mohd Hamka', '127.0.0.1', '2026-07-27 17:38:02'),
(56, 1, 'Admin', 'UPDATE', 'mdhamka', 'Updated admin profile: email from hamka@gmail.com to hamkas@gmail.com', '127.0.0.1', '2026-07-27 17:38:14'),
(57, 1, 'Admin', 'UPDATE', 'mdhamka', 'Updated admin profile: email from hamkas@gmail.com to hamka@gmail.com', '127.0.0.1', '2026-07-27 17:38:25'),
(58, 1, 'Admin', 'UPDATE', 'mdhamka', 'Updated admin profile without changes', '127.0.0.1', '2026-07-27 17:38:31'),
(59, 1, 'Admin', 'UPDATE', 'mdhamka', 'Updated admin profile without changes', '127.0.0.1', '2026-07-27 17:39:14'),
(60, 1, 'Admin', 'UPDATE', 'starlord', 'Updated admin profile: username from mdhamka to starlord', '127.0.0.1', '2026-07-27 17:39:45'),
(61, 1, 'Admin', 'UPDATE', 'mdhamka', 'Updated admin profile: username from starlord to mdhamka', '127.0.0.1', '2026-07-27 17:39:52'),
(62, 1, 'Admin', 'LOGOUT', 'Admin Account', 'Admin logged out from the system', '127.0.0.1', '2026-07-27 17:45:29'),
(63, 1, 'Student', 'LOGIN', 'Student Account', 'Student fai logged into the system', '127.0.0.1', '2026-07-27 17:56:40'),
(64, 1, 'Authentication', 'LOGOUT', 'Student Account', 'Student logged out from the system', '127.0.0.1', '2026-07-27 18:07:20'),
(65, 2, 'Authentication', 'LOGIN', 'Student Account', 'Student amiromar logged into the system', '127.0.0.1', '2026-07-27 18:07:45'),
(66, 2, 'Authentication', 'LOGOUT', 'Student Account', 'Student logged out from the system', '127.0.0.1', '2026-07-27 18:08:04'),
(67, 1, 'Authentication', 'LOGIN', 'Admin Account', 'Admin logged into the system', '127.0.0.1', '2026-07-27 19:10:09'),
(68, 1, 'Authentication', 'LOGOUT', 'Admin Account', 'Admin logged out from the system', '127.0.0.1', '2026-07-27 20:42:53'),
(69, 1, 'Authentication', 'LOGIN', 'Student Account', 'Student fai logged into the system', '127.0.0.1', '2026-07-27 20:48:57'),
(70, 1, 'Authentication', 'LOGOUT', 'Student Account', 'Student logged out from the system', '127.0.0.1', '2026-07-27 21:26:28'),
(71, 1, 'Authentication', 'LOGIN', 'Student Account', 'Student fai logged into the system', '127.0.0.1', '2026-07-28 07:13:27'),
(72, 1, 'Authentication', 'LOGOUT', 'Student Account', 'Student logged out from the system', '127.0.0.1', '2026-07-28 22:30:20'),
(73, 1, 'Authentication', 'LOGIN', 'Admin Account', 'Admin logged into the system', '127.0.0.1', '2026-07-28 22:31:07'),
(74, 1, 'Authentication', 'LOGOUT', 'Admin Account', 'Admin logged out from the system', '127.0.0.1', '2026-07-29 08:22:09'),
(75, 1, 'Authentication', 'LOGIN', 'Student Account', 'Student fai logged into the system', '127.0.0.1', '2026-07-29 08:22:18'),
(76, 1, 'Authentication', 'LOGOUT', 'Student Account', 'Student logged out from the system', '127.0.0.1', '2026-07-29 13:39:00'),
(77, 1, 'Authentication', 'LOGIN', 'Admin Account', 'Admin logged into the system', '127.0.0.1', '2026-07-29 13:39:09'),
(78, 1, 'Authentication', 'LOGOUT', 'Admin Account', 'Admin logged out from the system', '127.0.0.1', '2026-07-29 15:31:50');

-- --------------------------------------------------------

--
-- Table structure for table `backups`
--

CREATE TABLE `backups` (
  `backupID` int(11) NOT NULL,
  `fileName` varchar(255) DEFAULT NULL,
  `backupDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `fileSize` varchar(50) DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `backupStatus` varchar(20) DEFAULT 'Completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `backups`
--

INSERT INTO `backups` (`backupID`, `fileName`, `backupDate`, `fileSize`, `createdBy`, `backupStatus`) VALUES
(3, 'database_20260726_111654.sql', '2026-07-26 09:16:55', '94.35 KB', 1, 'Completed'),
(4, 'database_20260727_192815.sql', '2026-07-27 17:28:15', '102.39 KB', 1, 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `backup_logs`
--

CREATE TABLE `backup_logs` (
  `logID` int(11) NOT NULL,
  `backupID` int(11) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `performedBy` int(11) DEFAULT NULL,
  `actionDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `backup_logs`
--

INSERT INTO `backup_logs` (`logID`, `backupID`, `action`, `performedBy`, `actionDate`) VALUES
(2, 3, 'Created Backup', 1, '2026-07-26 09:16:55'),
(3, 4, 'Created Backup', 1, '2026-07-27 17:28:15');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL,
  `categoryIMG` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`, `categoryIMG`) VALUES
(1, 'Beverages', '../../assets/images/category/beverages.jpeg'),
(2, 'Biscuits', '../../assets/images/category/biscuit.jpg'),
(3, 'Noodles', '../../assets/images/category/noodles.jpeg'),
(4, 'Snacks', '../../assets/images/category/snacks.jpg'),
(5, 'Dairy Products', '../../assets/images/category/dairy.png'),
(6, 'Frozen Foods', '../../assets/images/category/frozen-foods.png'),
(7, 'Bread & Bakery', '../../assets/images/category/bakery.jpg'),
(8, 'Canned Foods', '../../assets/images/category/canned-foods.jpg'),
(9, 'Confectionery', '../../assets/images/category/confectionery.png');

-- --------------------------------------------------------

--
-- Table structure for table `comparisonhistory`
--

CREATE TABLE `comparisonhistory` (
  `historyID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `comparedGroup` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comparisonhistory`
--

INSERT INTO `comparisonhistory` (`historyID`, `studentID`, `ItemID`, `comparedGroup`, `created_at`) VALUES
(1, 1, 1, 'CMP100001', '2026-07-20 01:15:00'),
(2, 1, 2, 'CMP100001', '2026-07-20 01:15:00'),
(3, 1, 3, 'CMP100001', '2026-07-20 01:15:00'),
(4, 1, 6, 'CMP100002', '2026-07-20 06:30:00'),
(5, 1, 7, 'CMP100002', '2026-07-20 06:30:00'),
(6, 1, 10, 'CMP100003', '2026-07-21 03:20:00'),
(7, 1, 11, 'CMP100003', '2026-07-21 03:20:00'),
(8, 1, 12, 'CMP100003', '2026-07-21 03:20:00'),
(9, 1, 15, 'CMP100004', '2026-07-22 10:10:00'),
(10, 1, 16, 'CMP100004', '2026-07-22 10:10:00'),
(11, 1, 18, 'CMP100005', '2026-07-23 01:40:00'),
(12, 1, 19, 'CMP100005', '2026-07-23 01:40:00'),
(13, 1, 20, 'CMP100005', '2026-07-23 01:40:00'),
(14, 1, 1, 'CMP6a616936a7e77', '2026-07-23 01:07:02'),
(15, 1, 10, 'CMP6a616936a7e77', '2026-07-23 01:07:02'),
(16, 1, 1, 'CMP6a61694010272', '2026-07-23 01:07:12'),
(17, 1, 10, 'CMP6a61694010272', '2026-07-23 01:07:12'),
(18, 1, 1, 'CMP6a616a97dbc49', '2026-07-23 01:12:55'),
(19, 1, 10, 'CMP6a616a97dbc49', '2026-07-23 01:12:55'),
(20, 1, 3, 'CMP6a616b0f2dbc2', '2026-07-23 01:14:55'),
(21, 1, 9, 'CMP6a616b0f2dbc2', '2026-07-23 01:14:55'),
(22, 1, 44, 'CMP6a616b0f2dbc2', '2026-07-23 01:14:55'),
(23, 1, 3, 'CMP6a616c92842de', '2026-07-23 01:21:22'),
(24, 1, 9, 'CMP6a616c92842de', '2026-07-23 01:21:22'),
(25, 1, 44, 'CMP6a616c92842de', '2026-07-23 01:21:22'),
(26, 1, 3, 'CMP6a616c9696951', '2026-07-23 01:21:26'),
(27, 1, 9, 'CMP6a616c9696951', '2026-07-23 01:21:26'),
(28, 1, 44, 'CMP6a616c9696951', '2026-07-23 01:21:26'),
(29, 1, 3, 'CMP6a616cbf4777f', '2026-07-23 01:22:07'),
(30, 1, 9, 'CMP6a616cbf4777f', '2026-07-23 01:22:07'),
(31, 1, 44, 'CMP6a616cbf4777f', '2026-07-23 01:22:07'),
(32, 1, 3, 'CMP6a616ddd66249', '2026-07-23 01:26:53'),
(33, 1, 9, 'CMP6a616ddd66249', '2026-07-23 01:26:53'),
(34, 1, 44, 'CMP6a616ddd66249', '2026-07-23 01:26:53'),
(35, 1, 1, 'CMP6a616e2961e15', '2026-07-23 01:28:09'),
(36, 1, 10, 'CMP6a616e2961e15', '2026-07-23 01:28:09'),
(37, 1, 62, 'CMP6a616e2961e15', '2026-07-23 01:28:09'),
(38, 1, 1, 'CMP6a617049241e0', '2026-07-23 01:37:13'),
(39, 1, 10, 'CMP6a617049241e0', '2026-07-23 01:37:13'),
(40, 1, 62, 'CMP6a617049241e0', '2026-07-23 01:37:13'),
(41, 1, 1, 'CMP6a617170a0882', '2026-07-23 01:42:08'),
(42, 1, 10, 'CMP6a617170a0882', '2026-07-23 01:42:08'),
(43, 1, 62, 'CMP6a617170a0882', '2026-07-23 01:42:08'),
(44, 1, 1, 'CMP6a61727abb937', '2026-07-23 01:46:34'),
(45, 1, 10, 'CMP6a61727abb937', '2026-07-23 01:46:34'),
(46, 1, 62, 'CMP6a61727abb937', '2026-07-23 01:46:34'),
(47, 1, 1, 'CMP6a617333c8960', '2026-07-23 01:49:39'),
(48, 1, 10, 'CMP6a617333c8960', '2026-07-23 01:49:39'),
(49, 1, 62, 'CMP6a617333c8960', '2026-07-23 01:49:39'),
(50, 1, 1, 'CMP6a6173382c938', '2026-07-23 01:49:44'),
(51, 1, 10, 'CMP6a6173382c938', '2026-07-23 01:49:44'),
(52, 1, 62, 'CMP6a6173382c938', '2026-07-23 01:49:44'),
(53, 1, 57, 'CMP6a67c48589377', '2026-07-27 20:50:13'),
(54, 1, 75, 'CMP6a67c48589377', '2026-07-27 20:50:13'),
(55, 1, 95, 'CMP6a67c48589377', '2026-07-27 20:50:13'),
(56, 1, 57, 'CMP6a67c619193b4', '2026-07-27 20:56:57'),
(57, 1, 75, 'CMP6a67c619193b4', '2026-07-27 20:56:57'),
(58, 1, 95, 'CMP6a67c619193b4', '2026-07-27 20:56:57'),
(59, 1, 57, 'CMP6a67c66a8587f', '2026-07-27 20:58:18'),
(60, 1, 75, 'CMP6a67c66a8587f', '2026-07-27 20:58:18'),
(61, 1, 95, 'CMP6a67c66a8587f', '2026-07-27 20:58:18'),
(62, 1, 57, 'CMP6a67c74a1458b', '2026-07-27 21:02:02'),
(63, 1, 75, 'CMP6a67c74a1458b', '2026-07-27 21:02:02'),
(64, 1, 95, 'CMP6a67c74a1458b', '2026-07-27 21:02:02'),
(65, 1, 57, 'CMP6a67c7a7308d4', '2026-07-27 21:03:35'),
(66, 1, 75, 'CMP6a67c7a7308d4', '2026-07-27 21:03:35'),
(67, 1, 95, 'CMP6a67c7a7308d4', '2026-07-27 21:03:35'),
(68, 1, 57, 'CMP6a67c8a03f6cc', '2026-07-27 21:07:44'),
(69, 1, 75, 'CMP6a67c8a03f6cc', '2026-07-27 21:07:44'),
(70, 1, 95, 'CMP6a67c8a03f6cc', '2026-07-27 21:07:44'),
(71, 1, 57, 'CMP6a67c977abd86', '2026-07-27 21:11:19'),
(72, 1, 75, 'CMP6a67c977abd86', '2026-07-27 21:11:19'),
(73, 1, 95, 'CMP6a67c977abd86', '2026-07-27 21:11:19'),
(74, 1, 57, 'CMP6a67ca027caaa', '2026-07-27 21:13:38'),
(75, 1, 75, 'CMP6a67ca027caaa', '2026-07-27 21:13:38'),
(76, 1, 95, 'CMP6a67ca027caaa', '2026-07-27 21:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `comparisonstats`
--

CREATE TABLE `comparisonstats` (
  `ItemID` int(11) NOT NULL,
  `totalCompared` int(11) DEFAULT 0,
  `lastCompared` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comparisonstats`
--

INSERT INTO `comparisonstats` (`ItemID`, `totalCompared`, `lastCompared`) VALUES
(1, 5, '2026-07-23 01:49:44'),
(10, 5, '2026-07-23 01:49:44'),
(57, 8, '2026-07-27 21:13:38'),
(62, 5, '2026-07-23 01:49:44'),
(75, 8, '2026-07-27 21:13:38'),
(95, 8, '2026-07-27 21:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `forumbookmarks`
--

CREATE TABLE `forumbookmarks` (
  `bookmarkID` int(11) NOT NULL,
  `topicID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `bookmarked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forumbookmarks`
--

INSERT INTO `forumbookmarks` (`bookmarkID`, `topicID`, `studentID`, `bookmarked_at`) VALUES
(2, 1, 1, '2026-07-24 15:45:03'),
(3, 2, 5, '2026-07-25 01:12:22'),
(4, 3, 8, '2026-07-25 02:30:15'),
(5, 4, 12, '2026-07-25 05:45:09'),
(6, 5, 15, '2026-07-25 07:20:44'),
(7, 6, 21, '2026-07-26 00:12:31'),
(8, 7, 3, '2026-07-26 01:45:27'),
(9, 8, 18, '2026-07-26 03:18:52'),
(10, 9, 25, '2026-07-26 06:33:10'),
(11, 10, 30, '2026-07-26 08:20:41'),
(12, 11, 33, '2026-07-26 10:05:22'),
(13, 12, 40, '2026-07-27 00:45:19'),
(14, 13, 45, '2026-07-27 02:22:33'),
(15, 1, 52, '2026-07-27 04:10:45'),
(16, 2, 60, '2026-07-27 05:55:28'),
(17, 4, 67, '2026-07-27 07:40:12'),
(18, 6, 9, '2026-07-27 09:25:55'),
(19, 7, 14, '2026-07-28 00:30:21'),
(20, 8, 22, '2026-07-28 01:50:16'),
(21, 10, 28, '2026-07-28 03:35:42'),
(22, 11, 35, '2026-07-28 05:20:37'),
(23, 12, 41, '2026-07-28 07:15:09'),
(24, 13, 48, '2026-07-28 08:40:28'),
(25, 3, 55, '2026-07-28 10:25:44'),
(26, 5, 62, '2026-07-29 00:15:30'),
(27, 7, 19, '2026-07-29 01:45:18'),
(28, 9, 27, '2026-07-29 02:55:36'),
(29, 10, 39, '2026-07-29 04:25:47'),
(30, 12, 50, '2026-07-29 06:10:29'),
(31, 1, 58, '2026-07-29 07:35:12'),
(32, 8, 64, '2026-07-29 09:05:51'),
(33, 2, 7, '2026-07-29 10:20:15'),
(34, 3, 11, '2026-07-29 10:45:32'),
(35, 5, 16, '2026-07-29 11:10:44'),
(36, 6, 24, '2026-07-29 11:35:18'),
(37, 9, 31, '2026-07-29 12:05:26'),
(38, 11, 37, '2026-07-29 12:25:41'),
(39, 13, 43, '2026-07-29 12:50:13'),
(40, 4, 51, '2026-07-29 13:15:36'),
(41, 1, 6, '2026-07-30 00:12:25'),
(42, 2, 13, '2026-07-30 00:40:19'),
(43, 3, 20, '2026-07-30 01:05:47'),
(44, 5, 29, '2026-07-30 01:35:22'),
(45, 7, 34, '2026-07-30 02:10:55'),
(46, 8, 46, '2026-07-30 02:45:33'),
(47, 10, 54, '2026-07-30 03:20:14'),
(48, 12, 61, '2026-07-30 03:55:40'),
(49, 13, 66, '2026-07-30 04:30:18'),
(50, 4, 17, '2026-07-30 05:05:29'),
(51, 6, 26, '2026-07-30 05:40:52'),
(52, 8, 32, '2026-07-30 06:15:37'),
(53, 9, 38, '2026-07-30 06:50:21'),
(54, 11, 44, '2026-07-30 07:25:46'),
(55, 1, 57, '2026-07-30 08:00:11'),
(56, 7, 63, '2026-07-30 08:35:28'),
(57, 2, 23, '2026-07-30 09:10:45'),
(58, 3, 36, '2026-07-30 09:45:39'),
(59, 5, 49, '2026-07-30 10:20:17'),
(60, 10, 56, '2026-07-30 10:55:31'),
(61, 12, 65, '2026-07-30 11:30:26'),
(62, 13, 59, '2026-07-30 12:05:42'),
(63, 1, 4, '2026-07-31 00:15:22'),
(64, 2, 10, '2026-07-31 00:42:35'),
(65, 3, 18, '2026-07-31 01:10:41'),
(66, 4, 27, '2026-07-31 01:35:18'),
(67, 5, 35, '2026-07-31 02:05:27'),
(68, 6, 42, '2026-07-31 02:30:52'),
(69, 7, 47, '2026-07-31 03:00:14'),
(70, 8, 53, '2026-07-31 03:25:39'),
(71, 9, 60, '2026-07-31 04:00:26'),
(72, 10, 15, '2026-07-31 04:35:44'),
(73, 11, 22, '2026-07-31 05:10:18'),
(74, 12, 30, '2026-07-31 05:45:33'),
(75, 13, 67, '2026-07-31 06:20:57'),
(76, 3, 52, '2026-07-31 06:55:12'),
(77, 5, 8, '2026-07-31 07:30:48'),
(78, 7, 25, '2026-07-31 08:05:21'),
(79, 9, 33, '2026-07-31 08:40:35'),
(80, 11, 41, '2026-07-31 09:15:42'),
(81, 13, 56, '2026-07-31 09:50:26'),
(82, 2, 64, '2026-07-31 10:25:39'),
(83, 4, 19, '2026-07-31 11:00:14'),
(84, 6, 36, '2026-07-31 11:35:28'),
(85, 8, 45, '2026-07-31 12:10:53'),
(86, 10, 62, '2026-07-31 12:45:17'),
(87, 12, 66, '2026-07-31 13:20:31'),
(88, 1, 28, '2026-08-01 00:10:45'),
(89, 3, 39, '2026-08-01 00:45:22'),
(90, 5, 50, '2026-08-01 01:20:36'),
(91, 8, 58, '2026-08-01 01:55:49'),
(92, 12, 63, '2026-08-01 02:30:15');

-- --------------------------------------------------------

--
-- Table structure for table `forumcategory`
--

CREATE TABLE `forumcategory` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(100) NOT NULL,
  `categoryDescription` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forumcategory`
--

INSERT INTO `forumcategory` (`categoryID`, `categoryName`, `categoryDescription`, `created_at`) VALUES
(1, 'General Discussion', 'General questions', '2026-07-22 15:57:26'),
(2, 'Price Discussion', 'Discuss product prices', '2026-07-22 15:57:26'),
(3, 'Shopping Tips', 'Money saving ideas', '2026-07-22 15:57:26'),
(4, 'Suggestions', 'System feedback', '2026-07-22 15:57:26'),
(5, 'Announcements', 'Official announcements', '2026-07-22 15:57:26');

-- --------------------------------------------------------

--
-- Table structure for table `forumlikes`
--

CREATE TABLE `forumlikes` (
  `likeID` int(11) NOT NULL,
  `topicID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `liked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forumlikes`
--

INSERT INTO `forumlikes` (`likeID`, `topicID`, `studentID`, `liked_at`) VALUES
(6, 1, 1, '2026-07-25 16:32:03'),
(12, 1, 5, '2026-07-26 01:00:12'),
(13, 1, 8, '2026-07-26 01:05:21'),
(14, 1, 14, '2026-07-26 01:11:44'),
(15, 1, 18, '2026-07-26 01:16:08'),
(16, 1, 25, '2026-07-26 01:20:35'),
(17, 1, 31, '2026-07-26 01:25:19'),
(18, 1, 42, '2026-07-26 01:33:51'),
(19, 2, 4, '2026-07-26 02:01:33'),
(20, 2, 9, '2026-07-26 02:05:10'),
(21, 2, 16, '2026-07-26 02:08:44'),
(22, 2, 27, '2026-07-26 02:12:18'),
(23, 2, 38, '2026-07-26 02:18:27'),
(24, 3, 6, '2026-07-26 02:40:42'),
(25, 3, 15, '2026-07-26 02:45:31'),
(26, 3, 24, '2026-07-26 02:48:55'),
(27, 3, 41, '2026-07-26 02:54:20'),
(28, 4, 3, '2026-07-26 03:02:41'),
(29, 4, 12, '2026-07-26 03:08:17'),
(30, 4, 20, '2026-07-26 03:14:23'),
(31, 4, 28, '2026-07-26 03:21:18'),
(32, 4, 36, '2026-07-26 03:26:44'),
(33, 4, 47, '2026-07-26 03:33:58'),
(34, 5, 7, '2026-07-26 04:00:12'),
(35, 5, 13, '2026-07-26 04:04:31'),
(36, 5, 22, '2026-07-26 04:08:42'),
(37, 5, 35, '2026-07-26 04:14:28'),
(38, 5, 51, '2026-07-26 04:20:55'),
(39, 6, 2, '2026-07-26 04:40:15'),
(40, 6, 19, '2026-07-26 04:46:21'),
(41, 6, 29, '2026-07-26 04:53:19'),
(42, 6, 46, '2026-07-26 04:58:33'),
(43, 7, 1, '2026-07-26 05:10:14'),
(44, 7, 17, '2026-07-26 05:14:48'),
(45, 7, 23, '2026-07-26 05:18:36'),
(46, 7, 40, '2026-07-26 05:24:27'),
(47, 7, 58, '2026-07-26 05:31:05'),
(48, 7, 63, '2026-07-26 05:37:52'),
(49, 8, 10, '2026-07-26 06:00:31'),
(50, 8, 21, '2026-07-26 06:06:48'),
(51, 8, 32, '2026-07-26 06:13:05'),
(52, 8, 44, '2026-07-26 06:19:40'),
(53, 8, 57, '2026-07-26 06:25:22'),
(54, 9, 11, '2026-07-26 07:00:10'),
(55, 9, 26, '2026-07-26 07:05:54'),
(56, 9, 39, '2026-07-26 07:11:37'),
(57, 9, 52, '2026-07-26 07:18:46'),
(58, 10, 30, '2026-07-26 08:02:08'),
(59, 10, 37, '2026-07-26 08:08:23'),
(60, 10, 48, '2026-07-26 08:14:59'),
(61, 10, 60, '2026-07-26 08:20:41'),
(62, 11, 33, '2026-07-26 09:01:12'),
(63, 11, 43, '2026-07-26 09:07:36'),
(64, 11, 54, '2026-07-26 09:13:19'),
(65, 11, 67, '2026-07-26 09:20:48'),
(66, 12, 34, '2026-07-26 10:01:15'),
(67, 12, 45, '2026-07-26 10:08:42'),
(68, 12, 56, '2026-07-26 10:14:56'),
(69, 12, 62, '2026-07-26 10:20:13'),
(70, 13, 49, '2026-07-26 11:00:41'),
(71, 13, 53, '2026-07-26 11:07:26'),
(72, 13, 59, '2026-07-26 11:14:11'),
(73, 13, 64, '2026-07-26 11:20:37'),
(74, 1, 33, '2026-07-27 00:01:14'),
(75, 1, 45, '2026-07-27 00:05:27'),
(76, 1, 52, '2026-07-27 00:11:43'),
(77, 1, 61, '2026-07-27 00:17:55'),
(78, 1, 67, '2026-07-27 00:24:11'),
(79, 2, 11, '2026-07-27 01:02:13'),
(80, 2, 23, '2026-07-27 01:06:55'),
(81, 2, 35, '2026-07-27 01:12:47'),
(82, 2, 50, '2026-07-27 01:18:30'),
(83, 2, 64, '2026-07-27 01:23:51'),
(84, 3, 12, '2026-07-27 02:01:16'),
(85, 3, 28, '2026-07-27 02:07:28'),
(86, 3, 36, '2026-07-27 02:12:39'),
(87, 3, 53, '2026-07-27 02:19:24'),
(88, 3, 66, '2026-07-27 02:26:10'),
(89, 4, 5, '2026-07-27 03:03:44'),
(90, 4, 18, '2026-07-27 03:08:57'),
(91, 4, 32, '2026-07-27 03:14:11'),
(92, 4, 43, '2026-07-27 03:20:18'),
(93, 4, 55, '2026-07-27 03:27:45'),
(94, 5, 8, '2026-07-27 04:01:32'),
(95, 5, 24, '2026-07-27 04:08:16'),
(96, 5, 39, '2026-07-27 04:13:28'),
(97, 5, 47, '2026-07-27 04:19:05'),
(98, 5, 63, '2026-07-27 04:25:44'),
(99, 6, 6, '2026-07-27 05:02:55'),
(100, 6, 15, '2026-07-27 05:08:47'),
(101, 6, 34, '2026-07-27 05:15:18'),
(102, 6, 49, '2026-07-27 05:20:56'),
(103, 6, 65, '2026-07-27 05:28:12'),
(104, 7, 9, '2026-07-27 06:01:26'),
(105, 7, 22, '2026-07-27 06:06:39'),
(106, 7, 31, '2026-07-27 06:11:55'),
(107, 7, 46, '2026-07-27 06:18:42'),
(108, 7, 54, '2026-07-27 06:24:58'),
(109, 8, 4, '2026-07-27 07:02:17'),
(110, 8, 16, '2026-07-27 07:07:41'),
(111, 8, 27, '2026-07-27 07:13:53'),
(112, 8, 41, '2026-07-27 07:20:36'),
(113, 8, 58, '2026-07-27 07:26:28'),
(114, 9, 3, '2026-07-27 08:01:58'),
(115, 9, 17, '2026-07-27 08:08:42'),
(116, 9, 30, '2026-07-27 08:14:31'),
(117, 9, 45, '2026-07-27 08:20:55'),
(118, 9, 57, '2026-07-27 08:27:19'),
(119, 10, 2, '2026-07-27 09:02:12'),
(120, 10, 20, '2026-07-27 09:08:28'),
(121, 10, 35, '2026-07-27 09:15:46'),
(122, 10, 51, '2026-07-27 09:21:33'),
(123, 10, 62, '2026-07-27 09:27:14'),
(124, 11, 7, '2026-07-27 10:03:16'),
(125, 11, 25, '2026-07-27 10:09:55'),
(126, 11, 38, '2026-07-27 10:16:37'),
(127, 11, 59, '2026-07-27 10:22:11'),
(128, 11, 60, '2026-07-27 10:28:04'),
(129, 12, 13, '2026-07-27 11:01:49'),
(130, 12, 26, '2026-07-27 11:07:28'),
(131, 12, 42, '2026-07-27 11:13:55'),
(132, 12, 48, '2026-07-27 11:20:16'),
(133, 12, 57, '2026-07-27 11:26:41'),
(134, 13, 14, '2026-07-27 12:02:07'),
(135, 13, 29, '2026-07-27 12:08:36'),
(136, 13, 37, '2026-07-27 12:15:48'),
(137, 13, 50, '2026-07-27 12:21:57'),
(138, 13, 65, '2026-07-27 12:28:19'),
(141, 13, 1, '2026-07-29 10:46:51');

-- --------------------------------------------------------

--
-- Table structure for table `forumreply`
--

CREATE TABLE `forumreply` (
  `replyID` int(11) NOT NULL,
  `topicID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `replyContent` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forumreply`
--

INSERT INTO `forumreply` (`replyID`, `topicID`, `studentID`, `replyContent`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'H&L has promotion this week.', '2026-07-22 15:59:42', '2026-07-28 19:21:08'),
(2, 1, 3, 'E-Mart is cheaper during weekends.', '2026-07-22 15:59:42', '2026-07-28 19:21:08'),
(3, 2, 1, 'I always compare prices before buying.', '2026-07-22 15:59:42', '2026-07-29 09:02:26'),
(5, 4, 12, 'I usually buy instant noodles from Emart because they often have bundle promotions.', '2026-07-23 02:12:11', '2026-07-23 02:12:11'),
(6, 4, 25, '99 Speedmart is quite affordable if you only buy a few packs.', '2026-07-23 02:34:22', '2026-07-23 02:34:22'),
(7, 4, 48, 'Farley supermarket had a discount on Indomie last weekend.', '2026-07-23 03:18:30', '2026-07-23 03:18:30'),
(8, 5, 31, 'I prefer Everrise because their vegetables are fresher.', '2026-07-23 05:02:45', '2026-07-23 05:02:45'),
(9, 5, 14, 'Emart usually restocks vegetables every morning.', '2026-07-23 05:41:18', '2026-07-23 05:41:18'),
(10, 5, 56, 'You should compare prices because some vegetables are cheaper at H&L.', '2026-07-23 06:05:59', '2026-07-23 06:05:59'),
(11, 6, 9, 'Frozen chicken is usually cheaper when there is a promotion.', '2026-07-23 09:02:15', '2026-07-23 09:02:15'),
(12, 6, 42, 'I always keep frozen nuggets in my hostel because they are convenient.', '2026-07-23 09:15:33', '2026-07-23 09:15:33'),
(13, 6, 60, 'Buying frozen food in bulk can save money.', '2026-07-23 10:04:11', '2026-07-23 10:04:11'),
(14, 7, 17, 'I recommend Nescafe Classic when it is on promotion.', '2026-07-24 01:10:55', '2026-07-24 01:10:55'),
(15, 7, 38, 'OldTown White Coffee is my favourite but it is expensive.', '2026-07-24 01:32:40', '2026-07-24 01:32:40'),
(16, 7, 65, 'I usually wait for supermarket promotions before buying coffee.', '2026-07-24 02:01:18', '2026-07-24 02:01:18'),
(17, 8, 22, 'Emart had good promotions for canned sardines this week.', '2026-07-24 07:08:23', '2026-07-24 07:08:23'),
(18, 8, 49, 'Ayam Brand tastes good although it is slightly more expensive.', '2026-07-24 07:36:18', '2026-07-24 07:36:18'),
(19, 8, 11, 'I usually buy canned tuna because it lasts longer.', '2026-07-24 08:01:47', '2026-07-24 08:01:47'),
(20, 9, 27, 'Weekend promotions are definitely worth checking.', '2026-07-24 11:15:10', '2026-07-24 11:15:10'),
(21, 9, 44, 'I compare prices using this system before going shopping.', '2026-07-24 11:55:42', '2026-07-24 11:55:42'),
(22, 9, 63, 'Sunday evenings usually have clearance discounts.', '2026-07-24 12:24:51', '2026-07-24 12:24:51'),
(23, 10, 16, 'Gardenia bread with peanut butter is my favourite budget snack.', '2026-07-25 03:05:18', '2026-07-25 03:05:18'),
(24, 10, 36, 'I usually buy biscuits because they are filling and affordable.', '2026-07-25 03:30:55', '2026-07-25 03:30:55'),
(25, 10, 58, 'RM10 is enough if you buy during promotions.', '2026-07-25 03:54:33', '2026-07-25 03:54:33'),
(26, 11, 20, 'I always prepare a shopping list before going to the supermarket.', '2026-07-25 06:28:44', '2026-07-25 06:28:44'),
(27, 11, 41, 'Avoid shopping when you are hungry because you will buy unnecessary items.', '2026-07-25 07:01:26', '2026-07-25 07:01:26'),
(28, 11, 67, 'Comparing prices between stores saves me quite a lot every month.', '2026-07-25 07:42:58', '2026-07-25 07:42:58'),
(29, 12, 5, 'Welcome everyone! Hope we can help each other save money.', '2026-07-25 10:12:14', '2026-07-25 10:12:14'),
(30, 12, 29, 'Hello! I am a first-year Software Engineering student.', '2026-07-25 10:40:37', '2026-07-25 10:40:37'),
(31, 12, 51, 'Nice to meet everyone. Looking forward to using this platform.', '2026-07-25 11:08:22', '2026-07-25 11:08:22'),
(32, 13, 24, 'Everrise usually has fresh bread in the morning.', '2026-07-26 02:20:11', '2026-07-26 02:20:11'),
(33, 13, 39, 'Gardenia bread is often cheaper at 99 Speedmart.', '2026-07-26 02:55:43', '2026-07-26 02:55:43'),
(34, 13, 62, 'I compare prices every week before buying bread.', '2026-07-26 03:23:59', '2026-07-26 03:23:59'),
(35, 1, 8, 'I found Milo cheaper at Everrise yesterday. You should check their weekly promotion.', '2026-07-26 01:05:11', '2026-07-26 01:05:11'),
(36, 1, 21, 'Emart also had a buy 2 save more promotion last weekend.', '2026-07-26 01:15:42', '2026-07-26 01:15:42'),
(37, 1, 54, 'The Price Checker system helped me compare before buying.', '2026-07-26 01:28:30', '2026-07-26 01:28:30'),
(38, 2, 13, 'I always compare prices before shopping because every ringgit counts as a student.', '2026-07-26 02:04:19', '2026-07-26 02:04:19'),
(39, 2, 37, 'Buying in bulk with friends can reduce the overall cost.', '2026-07-26 02:22:18', '2026-07-26 02:22:18'),
(40, 2, 46, 'I avoid impulse buying by making a shopping list first.', '2026-07-26 02:35:40', '2026-07-26 02:35:40'),
(41, 3, 18, 'Welcome everyone! Happy to join this community.', '2026-07-26 03:02:17', '2026-07-26 03:02:17'),
(42, 3, 59, 'Hope this forum grows because it is useful for students.', '2026-07-26 03:15:44', '2026-07-26 03:15:44'),
(43, 3, 7, 'Looking forward to sharing shopping deals with everyone.', '2026-07-26 03:28:13', '2026-07-26 03:28:13'),
(44, 4, 40, 'Farley usually has good promotions near the end of the month.', '2026-07-26 04:11:02', '2026-07-26 04:11:02'),
(45, 4, 61, 'I bought a carton of Indomie for much cheaper during a warehouse sale.', '2026-07-26 04:34:58', '2026-07-26 04:34:58'),
(46, 4, 2, 'The comparison feature makes finding the cheapest noodles much easier.', '2026-07-26 04:46:15', '2026-07-26 04:46:15'),
(47, 5, 35, 'Morning deliveries usually have the freshest vegetables.', '2026-07-26 05:18:33', '2026-07-26 05:18:33'),
(48, 5, 52, 'H&L has quality vegetables although some are slightly expensive.', '2026-07-26 05:37:45', '2026-07-26 05:37:45'),
(49, 5, 4, 'I normally shop after class around 6 PM and the vegetables are still fresh.', '2026-07-26 05:58:26', '2026-07-26 05:58:26'),
(50, 6, 26, 'Frozen food is convenient when assignments start piling up.', '2026-07-26 06:16:42', '2026-07-26 06:16:42'),
(51, 6, 57, 'Always check the expiry date before buying frozen products.', '2026-07-26 06:42:11', '2026-07-26 06:42:11'),
(52, 6, 30, 'Some supermarkets have student promotions on frozen food.', '2026-07-26 06:59:03', '2026-07-26 06:59:03'),
(53, 7, 19, 'I recommend buying coffee during payday promotions.', '2026-07-26 07:21:10', '2026-07-26 07:21:10'),
(54, 7, 64, 'Instant coffee sachets are usually cheaper than canned coffee.', '2026-07-26 07:45:08', '2026-07-26 07:45:08'),
(55, 7, 11, 'Compare the price per gram instead of just the package price.', '2026-07-26 07:58:17', '2026-07-26 07:58:17'),
(56, 8, 45, 'The canned tuna promotion at Everrise was really worth it.', '2026-07-26 08:14:32', '2026-07-26 08:14:32'),
(57, 8, 3, 'I stock up whenever there is a Buy 2 Free 1 promotion.', '2026-07-26 08:39:25', '2026-07-26 08:39:25'),
(58, 8, 55, 'Ayam Brand is expensive but the quality is excellent.', '2026-07-26 08:56:10', '2026-07-26 08:56:10'),
(59, 9, 10, 'Shopping early in the morning is less crowded.', '2026-07-26 09:18:19', '2026-07-26 09:18:19'),
(60, 9, 43, 'Weekend sales are perfect for buying household essentials.', '2026-07-26 09:37:44', '2026-07-26 09:37:44'),
(61, 9, 66, 'Always compare prices before checking out.', '2026-07-26 09:55:33', '2026-07-26 09:55:33'),
(62, 10, 23, 'RM10 can still buy quite a lot if you focus on promotions.', '2026-07-26 10:15:51', '2026-07-26 10:15:51'),
(63, 10, 47, 'I like buying biscuits because they last for several days.', '2026-07-26 10:32:16', '2026-07-26 10:32:16'),
(64, 10, 32, 'Chocolate wafers are usually discounted every month.', '2026-07-26 10:50:02', '2026-07-26 10:50:02'),
(65, 15, 15, 'I normally compare prices using this system before visiting the supermarket.', '2026-07-27 01:10:15', '2026-07-27 01:10:15'),
(66, 15, 34, 'Everrise had the lowest price when I checked yesterday.', '2026-07-27 01:24:37', '2026-07-27 01:24:37'),
(67, 16, 27, 'Buying store brands instead of famous brands helps me save money.', '2026-07-27 01:45:18', '2026-07-27 01:45:18'),
(68, 16, 58, 'I usually wait until there is a weekend promotion before shopping.', '2026-07-27 02:03:54', '2026-07-27 02:03:54'),
(69, 17, 6, 'I recommend checking the expiry date before buying discounted products.', '2026-07-27 02:18:29', '2026-07-27 02:18:29'),
(70, 17, 41, 'Bulk purchases are worth it if you share with your roommates.', '2026-07-27 02:41:12', '2026-07-27 02:41:12'),
(71, 18, 18, 'The bakery section usually has discounts after 8 PM.', '2026-07-27 03:02:46', '2026-07-27 03:02:46'),
(72, 18, 52, 'Gardenia bread is often cheaper at 99 Speedmart.', '2026-07-27 03:15:27', '2026-07-27 03:15:27'),
(73, 19, 13, 'I compare prices between Emart and Farley every week.', '2026-07-27 03:38:51', '2026-07-27 03:38:51'),
(74, 19, 46, 'This forum has helped me discover cheaper supermarkets.', '2026-07-27 03:57:10', '2026-07-27 03:57:10'),
(75, 20, 25, 'Frozen vegetables are cheaper and last much longer.', '2026-07-27 04:16:43', '2026-07-27 04:16:43'),
(76, 20, 60, 'I buy frozen food only during monthly promotions.', '2026-07-27 04:34:18', '2026-07-27 04:34:18'),
(77, 21, 7, 'Buying drinks in cartons instead of single bottles saves money.', '2026-07-27 05:01:35', '2026-07-27 05:01:35'),
(78, 21, 38, 'I usually compare the price per litre before deciding.', '2026-07-27 05:18:44', '2026-07-27 05:18:44'),
(79, 22, 11, 'The Price Checker website makes comparing products much easier.', '2026-07-27 05:42:16', '2026-07-27 05:42:16'),
(80, 22, 50, 'I found several cheaper alternatives thanks to the comparison feature.', '2026-07-27 06:03:27', '2026-07-27 06:03:27'),
(81, 23, 16, 'Shopping with friends allows us to split bulk purchases.', '2026-07-27 06:25:52', '2026-07-27 06:25:52'),
(82, 23, 44, 'Always compare unit prices instead of package prices.', '2026-07-27 06:43:38', '2026-07-27 06:43:38'),
(83, 24, 29, 'I usually prepare a shopping list before leaving my hostel.', '2026-07-27 07:01:19', '2026-07-27 07:01:19'),
(84, 24, 61, 'Avoid shopping when you are hungry because you tend to overspend.', '2026-07-27 07:22:40', '2026-07-27 07:22:40'),
(85, 25, 5, 'The weekly supermarket catalogue is useful for finding promotions.', '2026-07-27 07:46:55', '2026-07-27 07:46:55'),
(86, 25, 67, 'I always check for member discounts before paying.', '2026-07-27 08:03:28', '2026-07-27 08:03:28'),
(87, 26, 9, 'Buying local products is sometimes much cheaper than imported brands.', '2026-07-27 08:27:41', '2026-07-27 08:27:41'),
(88, 26, 53, 'Compare prices at different stores because promotions change every week.', '2026-07-27 08:49:14', '2026-07-27 08:49:14'),
(89, 27, 20, 'I prefer shopping early because popular promotional items sell out quickly.', '2026-07-27 09:11:56', '2026-07-27 09:11:56'),
(90, 27, 42, 'The search feature helps me find products much faster.', '2026-07-27 09:35:09', '2026-07-27 09:35:09'),
(91, 28, 33, 'Buying larger packs is cheaper if you have enough storage space.', '2026-07-27 09:58:45', '2026-07-27 09:58:45'),
(92, 28, 59, 'I usually compare prices before every grocery trip.', '2026-07-27 10:20:31', '2026-07-27 10:20:31'),
(93, 29, 22, 'Thanks for sharing this information. It really helps students save money.', '2026-07-27 10:43:12', '2026-07-27 10:43:12'),
(94, 29, 63, 'I hope more users continue sharing supermarket promotions here.', '2026-07-27 11:05:37', '2026-07-27 11:05:37'),
(95, 30, 12, 'I found better prices at Everrise compared to Emart this week.', '2026-07-28 01:05:18', '2026-07-28 01:05:18'),
(96, 30, 36, 'The comparison feature saved me quite a bit of money.', '2026-07-28 01:18:47', '2026-07-28 01:18:47'),
(97, 31, 7, 'I usually compare prices before deciding where to shop.', '2026-07-28 01:36:21', '2026-07-28 01:36:21'),
(98, 31, 45, 'Shopping early in the morning is less crowded and shelves are fully stocked.', '2026-07-28 01:52:40', '2026-07-28 01:52:40'),
(99, 32, 18, 'Buying supermarket own-brand products helps reduce my expenses.', '2026-07-28 02:11:33', '2026-07-28 02:11:33'),
(100, 32, 61, 'I usually wait for monthly promotions before stocking up.', '2026-07-28 02:24:59', '2026-07-28 02:24:59'),
(101, 33, 24, 'Farley often has good discounts on household essentials.', '2026-07-28 02:43:18', '2026-07-28 02:43:18'),
(102, 33, 56, 'Checking promotion catalogues before shopping really helps.', '2026-07-28 02:58:12', '2026-07-28 02:58:12'),
(103, 34, 3, 'I compare unit prices instead of package prices.', '2026-07-28 03:17:55', '2026-07-28 03:17:55'),
(104, 34, 42, 'Buying larger packs is cheaper if you consume them regularly.', '2026-07-28 03:34:48', '2026-07-28 03:34:48'),
(105, 35, 15, 'I found the cheapest drinks at 99 Speedmart last weekend.', '2026-07-28 03:53:17', '2026-07-28 03:53:17'),
(106, 35, 67, 'Always compare prices because promotions change every week.', '2026-07-28 04:08:46', '2026-07-28 04:08:46'),
(107, 36, 8, 'I normally buy groceries after class because there are fewer people.', '2026-07-28 04:29:54', '2026-07-28 04:29:54'),
(108, 36, 54, 'The website makes comparing supermarket prices much easier.', '2026-07-28 04:46:20', '2026-07-28 04:46:20'),
(109, 37, 29, 'Buying in bulk with housemates is a good way to save money.', '2026-07-28 05:05:37', '2026-07-28 05:05:37'),
(110, 37, 48, 'I usually focus on products that are on promotion first.', '2026-07-28 05:19:56', '2026-07-28 05:19:56'),
(111, 38, 17, 'Weekend promotions are usually better than weekday offers.', '2026-07-28 05:38:14', '2026-07-28 05:38:14'),
(112, 38, 63, 'I always compare prices using this platform before shopping.', '2026-07-28 05:54:31', '2026-07-28 05:54:31'),
(113, 39, 20, 'Buying frozen food is convenient during busy assignment weeks.', '2026-07-28 06:13:47', '2026-07-28 06:13:47'),
(114, 39, 58, 'Frozen vegetables last longer and reduce food waste.', '2026-07-28 06:28:25', '2026-07-28 06:28:25'),
(115, 40, 11, 'I always check the expiry date before buying discounted food.', '2026-07-28 06:45:53', '2026-07-28 06:45:53'),
(116, 40, 35, 'Some stores reduce prices in the evening for fresh products.', '2026-07-28 07:03:41', '2026-07-28 07:03:41'),
(117, 41, 27, 'I recommend comparing prices across at least three supermarkets.', '2026-07-28 07:21:16', '2026-07-28 07:21:16'),
(118, 41, 52, 'The search feature helps me find cheaper alternatives quickly.', '2026-07-28 07:37:58', '2026-07-28 07:37:58'),
(119, 42, 9, 'Planning meals before shopping helps reduce unnecessary spending.', '2026-07-28 07:56:44', '2026-07-28 07:56:44'),
(120, 42, 43, 'I stick to my shopping list to avoid impulse purchases.', '2026-07-28 08:12:39', '2026-07-28 08:12:39'),
(121, 43, 5, 'Student discounts are worth checking before making a purchase.', '2026-07-28 08:31:27', '2026-07-28 08:31:27'),
(122, 43, 39, 'The comparison history feature helps me track price changes.', '2026-07-28 08:48:18', '2026-07-28 08:48:18'),
(123, 44, 14, 'I hope more students continue sharing supermarket promotions here.', '2026-07-28 09:07:35', '2026-07-28 09:07:35'),
(124, 44, 62, 'This community has helped me save a lot on my weekly grocery budget.', '2026-07-28 09:24:49', '2026-07-28 09:24:49'),
(125, 45, 21, 'I usually compare prices between different stores before buying groceries.', '2026-07-29 01:02:14', '2026-07-29 01:02:14'),
(126, 45, 47, 'Some stores have better deals during their weekly promotions.', '2026-07-29 01:18:32', '2026-07-29 01:18:32'),
(127, 46, 16, 'I prefer shopping at Emart because many products are affordable.', '2026-07-29 01:35:47', '2026-07-29 01:35:47'),
(128, 46, 60, 'Checking multiple stores helps me avoid paying higher prices.', '2026-07-29 01:51:28', '2026-07-29 01:51:28'),
(129, 47, 4, 'I normally create a budget before going grocery shopping.', '2026-07-29 02:08:19', '2026-07-29 02:08:19'),
(130, 47, 33, 'Making a shopping list prevents unnecessary purchases.', '2026-07-29 02:23:55', '2026-07-29 02:23:55'),
(131, 48, 19, 'Promotions are useful but we should compare the original prices too.', '2026-07-29 02:41:36', '2026-07-29 02:41:36'),
(132, 48, 55, 'I always check whether discounts are actually worth it.', '2026-07-29 02:57:12', '2026-07-29 02:57:12'),
(133, 49, 10, 'The price comparison system makes shopping decisions easier.', '2026-07-29 03:14:48', '2026-07-29 03:14:48'),
(134, 49, 66, 'I use this forum to discover cheaper alternatives from other students.', '2026-07-29 03:31:24', '2026-07-29 03:31:24'),
(135, 50, 23, 'Buying snacks in bulk is cheaper for hostel students.', '2026-07-29 03:49:15', '2026-07-29 03:49:15'),
(136, 50, 51, 'I usually buy snacks during supermarket sales.', '2026-07-29 04:05:38', '2026-07-29 04:05:38'),
(137, 51, 28, 'Comparing prices helps me manage my monthly allowance better.', '2026-07-29 04:22:51', '2026-07-29 04:22:51'),
(138, 51, 64, 'Small savings every week can make a big difference.', '2026-07-29 04:39:44', '2026-07-29 04:39:44'),
(139, 30, 37, 'I recommend checking online promotions before visiting the store.', '2026-07-29 04:58:13', '2026-07-29 04:58:13'),
(140, 31, 53, 'Different supermarkets have different strengths depending on products.', '2026-07-29 05:15:26', '2026-07-29 05:15:26'),
(141, 32, 31, 'I usually compare brands because cheaper does not always mean worse.', '2026-07-29 05:32:41', '2026-07-29 05:32:41'),
(142, 33, 46, 'Weekend sales are usually the best time to buy household items.', '2026-07-29 05:49:58', '2026-07-29 05:49:58'),
(143, 34, 12, 'Checking price per gram is a useful shopping habit.', '2026-07-29 06:06:35', '2026-07-29 06:06:35'),
(144, 35, 59, 'I save money by avoiding unnecessary branded products.', '2026-07-29 06:24:17', '2026-07-29 06:24:17'),
(145, 36, 26, 'I usually shop after checking the latest promotions first.', '2026-07-29 06:41:52', '2026-07-29 06:41:52'),
(146, 37, 40, 'Sharing grocery expenses with friends can reduce costs.', '2026-07-29 06:58:36', '2026-07-29 06:58:36'),
(147, 38, 57, 'I think comparing prices should become a normal habit for students.', '2026-07-29 07:15:49', '2026-07-29 07:15:49'),
(148, 39, 22, 'Frozen food is useful when students have limited cooking time.', '2026-07-29 07:33:14', '2026-07-29 07:33:14'),
(149, 40, 49, 'Always check storage conditions before buying frozen products.', '2026-07-29 07:50:27', '2026-07-29 07:50:27'),
(150, 41, 34, 'I discovered cheaper products after comparing several stores.', '2026-07-29 08:08:45', '2026-07-29 08:08:45'),
(151, 42, 65, 'Budget planning helps prevent overspending during shopping trips.', '2026-07-29 08:25:18', '2026-07-29 08:25:18'),
(152, 43, 18, 'Student promotions are very helpful for saving money.', '2026-07-29 08:42:39', '2026-07-29 08:42:39'),
(153, 44, 56, 'I enjoy reading other students recommendations before buying.', '2026-07-29 08:59:51', '2026-07-29 08:59:51'),
(154, 45, 30, 'Supermarket comparison saves time because everything is easier to check.', '2026-07-29 09:17:24', '2026-07-29 09:17:24'),
(155, 46, 62, 'I normally compare prices when buying monthly necessities.', '2026-07-29 09:34:40', '2026-07-29 09:34:40'),
(156, 47, 8, 'Buying only what I need helps me save money.', '2026-07-29 09:51:33', '2026-07-29 09:51:33'),
(157, 48, 44, 'Promotions are useful but always check the expiry date.', '2026-07-29 10:09:12', '2026-07-29 10:09:12'),
(158, 49, 15, 'The forum provides useful information about local supermarkets.', '2026-07-29 10:26:57', '2026-07-29 10:26:57'),
(159, 50, 38, 'I usually prepare a budget before buying snacks and drinks.', '2026-07-29 10:44:21', '2026-07-29 10:44:21'),
(160, 51, 61, 'Saving small amounts regularly helps students manage expenses.', '2026-07-29 11:01:46', '2026-07-29 11:01:46'),
(161, 45, 36, 'Different stores offer different prices depending on the product category.', '2026-07-29 11:18:35', '2026-07-29 11:18:35'),
(162, 46, 17, 'I usually wait for discounts before buying expensive items.', '2026-07-29 11:35:48', '2026-07-29 11:35:48'),
(163, 47, 50, 'Tracking expenses helps me control my shopping habits.', '2026-07-29 11:52:14', '2026-07-29 11:52:14'),
(164, 48, 6, 'I agree that comparing prices can reduce unnecessary spending.', '2026-07-29 12:10:33', '2026-07-29 12:10:33'),
(165, 34, 15, 'I usually compare prices before visiting supermarkets because some items have big price differences.', '2026-07-29 01:12:21', '2026-07-29 01:12:21'),
(166, 34, 42, 'Checking several stores helps me find better deals every week.', '2026-07-29 01:24:18', '2026-07-29 01:24:18'),
(167, 35, 28, 'I prefer buying products during promotions because it helps reduce my monthly expenses.', '2026-07-29 01:38:42', '2026-07-29 01:38:42'),
(168, 35, 63, 'Store brands are sometimes cheaper and still have good quality.', '2026-07-29 01:55:10', '2026-07-29 01:55:10'),
(169, 36, 19, 'I always check the expiry date before buying discounted items.', '2026-07-29 02:11:33', '2026-07-29 02:11:33'),
(170, 36, 54, 'Frozen products are convenient for students staying in hostels.', '2026-07-29 02:26:45', '2026-07-29 02:26:45'),
(171, 37, 8, 'Bread prices are different depending on the supermarket location.', '2026-07-29 02:42:19', '2026-07-29 02:42:19'),
(172, 37, 37, 'I usually buy bakery items in the evening because there are discounts.', '2026-07-29 02:58:03', '2026-07-29 02:58:03'),
(173, 38, 26, 'Supermarket membership programs can provide extra savings.', '2026-07-29 03:15:26', '2026-07-29 03:15:26'),
(174, 38, 62, 'Weekly promotions are useful when planning grocery shopping.', '2026-07-29 03:32:51', '2026-07-29 03:32:51'),
(175, 39, 14, 'Making a shopping list prevents unnecessary spending.', '2026-07-29 03:48:09', '2026-07-29 03:48:09'),
(176, 39, 50, 'I save money by comparing prices before purchasing anything.', '2026-07-29 04:05:44', '2026-07-29 04:05:44'),
(177, 40, 21, 'Weekend promotions usually have better offers compared to normal days.', '2026-07-29 04:22:18', '2026-07-29 04:22:18'),
(178, 40, 66, 'I wait for discounts before buying expensive groceries.', '2026-07-29 04:39:57', '2026-07-29 04:39:57'),
(179, 41, 9, 'Shopping after class is more convenient because stores are less crowded.', '2026-07-29 04:55:26', '2026-07-29 04:55:26'),
(180, 41, 43, 'Buying together with friends can reduce delivery costs.', '2026-07-29 05:12:41', '2026-07-29 05:12:41'),
(181, 42, 17, 'I recommend comparing prices per unit instead of package prices.', '2026-07-29 05:28:16', '2026-07-29 05:28:16'),
(182, 42, 58, 'Small savings from every purchase can help students manage money.', '2026-07-29 05:44:53', '2026-07-29 05:44:53'),
(183, 43, 23, 'This forum is useful for sharing shopping experiences.', '2026-07-29 06:01:22', '2026-07-29 06:01:22'),
(184, 43, 46, 'Students can learn which stores provide better prices.', '2026-07-29 06:18:36', '2026-07-29 06:18:36'),
(185, 44, 31, 'I found cheaper products after comparing several supermarkets.', '2026-07-29 06:35:27', '2026-07-29 06:35:27'),
(186, 44, 53, 'Price checking before shopping saves both time and money.', '2026-07-29 06:52:14', '2026-07-29 06:52:14'),
(187, 45, 35, 'I usually buy canned food because it lasts longer.', '2026-07-29 07:08:39', '2026-07-29 07:08:39'),
(188, 45, 59, 'Always check the expiry date when buying canned products.', '2026-07-29 07:25:01', '2026-07-29 07:25:01'),
(189, 46, 18, 'Morning shopping is better because more fresh products are available.', '2026-07-29 07:41:45', '2026-07-29 07:41:45'),
(190, 46, 51, 'I prefer supermarkets with many choices and reasonable prices.', '2026-07-29 07:58:20', '2026-07-29 07:58:20'),
(191, 47, 7, 'Promotions make it easier for students to save money.', '2026-07-29 08:14:11', '2026-07-29 08:14:11'),
(192, 47, 39, 'I always compare before deciding where to shop.', '2026-07-29 08:30:48', '2026-07-29 08:30:48'),
(193, 48, 30, 'The price comparison system makes finding deals easier.', '2026-07-29 08:47:26', '2026-07-29 08:47:26'),
(194, 48, 61, 'Having product information available saves shopping time.', '2026-07-29 09:04:13', '2026-07-29 09:04:13');

-- --------------------------------------------------------

--
-- Table structure for table `forumreport`
--

CREATE TABLE `forumreport` (
  `reportID` int(11) NOT NULL,
  `topicID` int(11) DEFAULT NULL,
  `replyID` int(11) DEFAULT NULL,
  `studentID` int(11) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forumreport`
--

INSERT INTO `forumreport` (`reportID`, `topicID`, `replyID`, `studentID`, `reason`, `created_at`) VALUES
(1, 10, NULL, 1, 'Spam', '2026-07-29 13:15:20');

-- --------------------------------------------------------

--
-- Table structure for table `forumtopic`
--

CREATE TABLE `forumtopic` (
  `topicID` int(11) NOT NULL,
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
  `topicTags` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forumtopic`
--

INSERT INTO `forumtopic` (`topicID`, `studentID`, `categoryID`, `topicTitle`, `topicContent`, `views`, `isPinned`, `isLocked`, `status`, `created_at`, `updated_at`, `topicTags`) VALUES
(1, 1, 2, 'Cheapest Milo around UNIMAS?', 'Where can I get the cheapest Milo this week?', 47, 0, 0, 'Active', '2026-07-22 15:58:58', '2026-07-28 22:18:53', 'Milo,StudentBudget,PriceComparison'),
(2, 2, 3, 'Budget shopping tips', 'Share your shopping tips for students.', 18, 0, 0, 'Active', '2026-07-22 15:58:58', '2026-07-28 22:18:53', 'ShoppingTips,Budgeting,StudentLife'),
(3, 3, 1, 'Welcome everyone', 'Introduce yourself here.', 39, 0, 0, 'Active', '2026-07-22 15:58:58', '2026-07-28 22:18:53', 'Introduction,CampusLife,Community'),
(4, 4, 2, 'Best place to buy instant noodles?', 'I usually buy Maggi and Indomie every week. Which supermarket around Kota Samarahan has the cheapest prices recently?', 26, 0, 0, 'Active', '2026-07-23 01:15:20', '2026-07-28 22:18:53', 'InstantNoodles,CheapMeals,FoodDeals'),
(5, 7, 4, 'Which supermarket has the freshest vegetables?', 'I am looking for fresh vegetables at reasonable prices. Any recommendations near UNIMAS?', 33, 0, 0, 'Active', '2026-07-23 04:42:11', '2026-07-28 22:18:53', 'FreshFood,Supermarket,Groceries'),
(6, 2, 5, 'Is buying frozen food worth it?', 'I noticed frozen food is sometimes cheaper than fresh ingredients. Do you usually buy frozen products?', 18, 0, 0, 'Active', '2026-07-23 08:30:42', '2026-07-28 22:18:53', 'FrozenFood,BudgetMeals,SavingTips'),
(7, 9, 2, 'Cheapest coffee for students', 'Coffee prices have increased lately. Which brand offers the best value for money?', 54, 0, 0, 'Active', '2026-07-24 00:18:55', '2026-07-28 22:18:53', 'Coffee,StudentBudget,Drinks'),
(8, 5, 3, 'Best supermarket promotions this week', 'Has anyone found any good promotions for drinks, snacks, or groceries this week? Please share the best deals you have seen.', 45, 0, 0, 'Active', '2026-07-24 06:45:10', '2026-07-28 22:18:53', 'Promotions,BestDeals,Supermarket'),
(9, 10, 1, 'Weekend grocery shopping tips', 'Do you usually shop during weekends? Which supermarket has better promotions on Saturdays and Sundays?', 42, 0, 0, 'Active', '2026-07-24 10:21:17', '2026-07-28 22:18:53', 'GroceryTips,ShoppingTips,WeekendShopping'),
(10, 6, 5, 'Best snacks under RM10', 'I have a budget of RM10 for snacks every week. What are your favourite affordable snacks?', 62, 0, 0, 'Active', '2026-07-25 02:35:42', '2026-07-29 13:12:47', 'Snacks,RM10Challenge,BudgetFood'),
(11, 3, 4, 'How do you save money on groceries?', 'Share your best budgeting tips when buying groceries as a university student.', 77, 0, 0, 'Active', '2026-07-25 05:56:28', '2026-07-29 12:33:43', 'MoneySaving,Budgeting,GroceryTips'),
(12, 8, 1, 'Welcome new students!', 'Welcome to the Price Checker community! Introduce yourself and share your favourite supermarket around Kota Samarahan.', 88, 1, 1, 'Active', '2026-07-25 09:20:08', '2026-07-29 08:21:30', 'Welcome,NewStudents,CampusLife'),
(13, 1, 2, 'Where do you usually buy bread?', 'I often compare bread prices between Emart, Everrise, and 99 Speedmart. Which store offers the best deals?', 38, 0, 0, 'Active', '2026-07-26 01:42:13', '2026-07-28 22:18:53', 'Bread,Bakery,PriceComparison'),
(15, 11, 2, 'Cheapest bottled water near UNIMAS?', 'Which supermarket usually has the lowest price for bottled drinking water?', 24, 0, 0, 'Active', '2026-07-27 01:15:00', '2026-07-27 01:15:00', 'Water,Budget,PriceComparison'),
(16, 15, 3, 'Best weekly supermarket promotions', 'Have you found any good promotions for groceries this week? Please share them here.', 37, 0, 0, 'Active', '2026-07-27 03:20:00', '2026-07-27 03:20:00', 'Promotion,Discount,Groceries'),
(17, 22, 5, 'Affordable breakfast ideas', 'What breakfast items do you usually buy that are filling and affordable for students?', 41, 0, 0, 'Active', '2026-07-27 05:40:00', '2026-07-27 05:40:00', 'Breakfast,BudgetFood,Students'),
(18, 18, 4, 'Fresh fruits at reasonable prices', 'Which supermarket sells fresh fruits with the best value for money?', 29, 0, 0, 'Active', '2026-07-27 07:05:00', '2026-07-27 07:05:00', 'Fruits,HealthyFood,Groceries'),
(19, 30, 2, 'Instant coffee recommendations', 'I need an affordable instant coffee brand that still tastes good. Any suggestions?', 55, 0, 0, 'Active', '2026-07-27 09:30:00', '2026-07-27 09:30:00', 'Coffee,StudentBudget,Recommendation'),
(20, 26, 1, 'Hello from a new member!', 'Hi everyone! I just joined the Price Checker community. Looking forward to learning from all of you.', 18, 0, 0, 'Active', '2026-07-28 00:50:00', '2026-07-28 00:50:00', 'Introduction,Community,Students'),
(21, 34, 3, 'Where do you buy dairy products?', 'Milk and cheese seem expensive lately. Which supermarket has the best prices?', 48, 0, 0, 'Active', '2026-07-28 02:45:00', '2026-07-28 02:45:00', 'Dairy,Groceries,PriceComparison'),
(22, 12, 5, 'Budget snacks for study sessions', 'What snacks do you usually buy while studying without spending too much?', 63, 0, 0, 'Active', '2026-07-28 06:20:00', '2026-07-28 06:20:00', 'Snacks,StudyLife,Budget'),
(23, 45, 2, 'Which supermarket has the best loyalty rewards?', 'Do you use membership cards or reward programs when shopping? Which one gives the best value?', 33, 0, 0, 'Active', '2026-07-28 10:05:00', '2026-07-28 10:05:00', 'Membership,Rewards,Savings'),
(24, 52, 4, 'Saving money on monthly groceries', 'Share your best tips for reducing grocery expenses while maintaining a balanced diet.', 71, 1, 0, 'Active', '2026-07-29 01:10:00', '2026-07-29 01:10:00', 'Budgeting,GroceryTips,MoneySaving'),
(25, 13, 2, 'Best place to buy cooking oil?', 'Cooking oil prices seem different everywhere. Which supermarket has the cheapest options lately?', 35, 0, 0, 'Active', '2026-07-29 02:05:00', '2026-07-29 02:05:00', 'CookingOil,Groceries,Savings'),
(26, 21, 5, 'Healthy snacks under RM10', 'Can anyone recommend healthy snacks that cost less than RM10?', 47, 0, 0, 'Active', '2026-07-29 02:18:00', '2026-07-29 02:18:00', 'HealthyFood,Snacks,Budget'),
(27, 33, 3, 'Where do you shop every weekend?', 'I usually visit Emart on weekends. Where do you normally shop?', 26, 0, 0, 'Active', '2026-07-29 02:34:00', '2026-07-29 02:34:00', 'WeekendShopping,Groceries,Community'),
(28, 44, 4, 'Affordable frozen chicken brands', 'Which frozen chicken brand offers the best value for students?', 31, 0, 0, 'Active', '2026-07-29 02:46:00', '2026-07-29 02:46:00', 'FrozenFood,Chicken,Budget'),
(29, 17, 2, 'Cheapest rice available?', 'Rice prices have gone up recently. Which supermarket still sells affordable brands?', 58, 0, 0, 'Active', '2026-07-29 03:02:00', '2026-07-29 03:02:00', 'Rice,PriceComparison,Groceries'),
(30, 19, 1, 'Greetings from a new member', 'Hello everyone! I am excited to join this community and learn more about smart shopping.', 19, 0, 0, 'Active', '2026-07-29 03:15:00', '2026-07-29 03:15:00', 'Introduction,Community,Students'),
(31, 24, 5, 'Favorite instant noodle brand?', 'Which instant noodle brand tastes the best while staying affordable?', 66, 0, 0, 'Active', '2026-07-29 03:33:00', '2026-07-29 03:33:00', 'InstantNoodles,StudentBudget,Food'),
(32, 29, 3, 'Best drinks during promotions', 'Which beverages usually receive the biggest discounts during supermarket sales?', 28, 0, 0, 'Active', '2026-07-29 03:49:00', '2026-07-29 03:49:00', 'Promotion,Drinks,Discount'),
(33, 36, 4, 'Affordable frozen seafood', 'Does anyone know where to buy reasonably priced frozen seafood?', 42, 0, 0, 'Active', '2026-07-29 04:08:00', '2026-07-29 04:08:00', 'FrozenFood,Seafood,Groceries'),
(34, 41, 2, 'Best bread promotions', 'Which supermarket frequently offers discounts on bread and bakery products?', 39, 0, 0, 'Active', '2026-07-29 04:26:00', '2026-07-29 04:26:00', 'Bread,Promotion,Bakery'),
(35, 51, 5, 'Student grocery budget per month', 'How much do you usually spend on groceries every month as a university student?', 85, 0, 0, 'Active', '2026-07-29 04:42:00', '2026-07-29 15:25:49', 'Budgeting,Students,Groceries'),
(36, 54, 3, 'Any supermarket open late?', 'Sometimes I shop at night. Which supermarkets stay open until late?', 23, 0, 0, 'Active', '2026-07-29 05:05:00', '2026-07-29 05:05:00', 'Shopping,Supermarket,Convenience'),
(37, 61, 2, 'Cheapest eggs this week', 'Has anyone compared egg prices this week between major supermarkets?', 37, 0, 0, 'Active', '2026-07-29 05:19:00', '2026-07-29 05:19:00', 'Eggs,PriceComparison,Savings'),
(38, 27, 5, 'Good drinks for hot weather', 'What beverages do you usually buy during hot days that are still affordable?', 30, 0, 0, 'Active', '2026-07-29 05:34:00', '2026-07-29 05:34:00', 'Drinks,Weather,Budget'),
(39, 46, 4, 'Frozen vegetables recommendations', 'Are frozen vegetables worth buying compared to fresh ones?', 45, 0, 0, 'Active', '2026-07-29 05:48:00', '2026-07-29 05:48:00', 'FrozenFood,Vegetables,HealthyFood'),
(40, 63, 3, 'Share your biggest shopping savings', 'What is the biggest discount or promotion you have ever found while grocery shopping?', 73, 0, 0, 'Active', '2026-07-29 06:05:00', '2026-07-29 06:05:00', 'Savings,Promotion,Community'),
(41, 8, 1, 'Welcome to all first-year students', 'Feel free to introduce yourselves and share your favorite supermarkets around campus.', 113, 1, 1, 'Active', '2026-07-29 06:22:00', '2026-07-29 13:59:13', 'Welcome,Students,CampusLife'),
(42, 55, 2, 'Where do you buy cereal?', 'Breakfast cereal prices vary quite a bit. Which store has the best deals?', 27, 0, 0, 'Active', '2026-07-29 06:40:00', '2026-07-29 06:40:00', 'Breakfast,Cereal,PriceComparison'),
(43, 39, 5, 'Most underrated supermarket?', 'Which supermarket do you think deserves more attention because of its prices?', 49, 0, 0, 'Active', '2026-07-29 07:02:00', '2026-07-29 07:02:00', 'Supermarket,Recommendation,Savings'),
(44, 16, 4, 'Frozen pizza recommendations', 'Which frozen pizza offers the best taste without costing too much?', 36, 0, 0, 'Active', '2026-07-29 07:20:00', '2026-07-29 07:20:00', 'FrozenFood,Pizza,Budget'),
(45, 14, 2, 'Cheapest biscuits for students?', 'I am looking for affordable biscuit brands for daily snacks. Which supermarket usually has the best prices?', 34, 0, 0, 'Active', '2026-07-29 07:42:00', '2026-07-29 07:42:00', 'Biscuits,Budget,Snacks'),
(46, 25, 5, 'Best instant drinks to stock up', 'Which instant drink brands are worth buying when they are on promotion?', 46, 0, 0, 'Active', '2026-07-29 08:05:00', '2026-07-29 08:05:00', 'Drinks,Promotion,StudentBudget'),
(47, 37, 3, 'Which supermarket has the friendliest staff?', 'Besides prices, customer service is important. Which supermarket gives you the best shopping experience?', 22, 0, 0, 'Active', '2026-07-29 08:18:00', '2026-07-29 08:18:00', 'ShoppingExperience,Community,Supermarket'),
(48, 48, 4, 'Affordable frozen nuggets', 'Frozen nuggets are one of my favorite quick meals. Which brand offers the best value?', 53, 0, 0, 'Active', '2026-07-29 08:36:00', '2026-07-29 08:36:00', 'FrozenFood,Nuggets,BudgetMeals'),
(49, 58, 2, 'Where do you buy canned food?', 'I want to stock up on canned food for emergencies. Which supermarket has the lowest prices?', 31, 0, 0, 'Active', '2026-07-29 08:52:00', '2026-07-29 08:52:00', 'CannedFood,Groceries,PriceComparison'),
(50, 62, 5, 'Best bakery items under RM10', 'What bakery products do you usually buy that cost less than RM10?', 45, 0, 0, 'Active', '2026-07-29 09:14:00', '2026-07-29 15:25:39', 'Bakery,BudgetFood,Students'),
(51, 20, 1, 'Community shopping challenge!', 'Let us challenge ourselves to spend less than RM50 on groceries this week. Share what you bought and how much you saved!', 100, 1, 0, 'Active', '2026-07-29 09:30:00', '2026-07-29 15:27:31', 'Challenge,Community,Savings');

-- --------------------------------------------------------

--
-- Table structure for table `forumviews`
--

CREATE TABLE `forumviews` (
  `viewID` int(11) NOT NULL,
  `topicID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `viewed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forumviews`
--

INSERT INTO `forumviews` (`viewID`, `topicID`, `studentID`, `viewed_at`) VALUES
(1, 1, 1, '2026-07-24 08:17:29'),
(2, 3, 1, '2026-07-24 08:22:42'),
(3, 2, 1, '2026-07-24 09:05:58'),
(5, 12, 1, '2026-07-28 19:22:38'),
(6, 13, 1, '2026-07-28 19:22:51'),
(7, 8, 1, '2026-07-28 19:33:49'),
(8, 4, 1, '2026-07-28 21:58:04'),
(9, 11, 1, '2026-07-29 12:33:43'),
(10, 41, 1, '2026-07-29 12:44:48'),
(11, 35, 1, '2026-07-29 12:45:05'),
(12, 50, 1, '2026-07-29 12:45:53'),
(13, 10, 1, '2026-07-29 13:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `ItemID` int(10) NOT NULL,
  `ItemName` varchar(250) NOT NULL,
  `ItemPrice` double(10,2) NOT NULL,
  `ItemCategory` varchar(250) NOT NULL,
  `ItemDescription` varchar(3000) NOT NULL,
  `StoreName` varchar(250) NOT NULL,
  `ItemImage` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ItemID`, `ItemName`, `ItemPrice`, `ItemCategory`, `ItemDescription`, `StoreName`, `ItemImage`, `created_at`) VALUES
(1, 'Nescafe 3-in-1 Original', 13.90, 'Beverages', 'Instant coffee mix with rich coffee flavour.', 'e-Mart Summer Mall', '../../assets/images/item/noriginal.png', '2026-07-25 09:09:15'),
(2, 'Hup Seng Cream Crackers', 5.20, 'Biscuits', 'Crispy crackers suitable for snacks and meals.', 'e-Mart Summer Mall', '../../assets/images/item/hupseng.png', '2026-07-25 09:09:15'),
(3, 'Maggi Curry Noodles', 4.90, 'Noodles', 'Instant noodles with delicious curry flavour.', 'H&L Aiman Mall', '../../assets/images/item/maggi2.png', '2026-07-25 09:09:15'),
(4, 'Jacob\'s Cream Crackers', 11.50, 'Biscuits', 'Crunchy cream crackers in multipack packaging.', 'e-Mart Summer Mall', '../../assets/images/item/jacobs.png', '2026-07-25 09:09:15'),
(5, 'Milo Chocolate Drink', 18.99, 'Beverages', 'Chocolate malt drink rich in energy and nutrients.', 'H&L Aiman Mall', '../../assets/images/item/milo.png', '2026-07-25 09:09:15'),
(6, 'Maggi Asam Laksa Noodles', 5.50, 'Noodles', 'Instant noodles with spicy and sour laksa flavour.', 'e-Mart Summer Mall', '../../assets/images/item/asamlaksa1.png', '2026-07-25 09:09:15'),
(7, 'Maggi Asam Laksa Noodles', 4.99, 'Noodles', 'Quick noodles with authentic Asam Laksa taste.', 'H&L Aiman Mall', '../../assets/images/item/asamlaksa2.png', '2026-07-25 09:09:15'),
(8, 'Milo Powder Drink', 20.90, 'Beverages', 'Chocolate malt beverage for everyday enjoyment.', 'e-Mart Summer Mall', '../../assets/images/item/miloe.png', '2026-07-25 09:09:15'),
(9, 'Maggi Curry Noodles', 4.50, 'Noodles', 'Springy noodles with rich curry seasoning.', 'e-Mart Summer Mall', '../../assets/images/item/maggi.jpg', '2026-07-25 09:09:15'),
(10, 'Nescafe 3-in-1 Original', 13.99, 'Beverages', 'Convenient instant coffee with creamy taste.', 'H&L Aiman Mall', '../../assets/images/item/nescafe3in1.png', '2026-07-25 09:09:15'),
(11, 'Nescafe Classic Coffee', 23.15, 'Beverages', 'Premium instant coffee with rich aroma.', 'H&L Aiman Mall', '../../assets/images/item/nclassic.jpg', '2026-07-25 09:09:15'),
(12, 'Munchy\'s Cream Crackers', 5.10, 'Biscuits', 'Light and crispy crackers for snacking.', 'e-Mart Summer Mall', '../../assets/images/item/munchy.png', '2026-07-25 09:09:15'),
(13, 'Mi Sedaap Instant Noodles', 5.20, 'Noodles', 'Tasty noodles with rich seasoning flavour.', 'H&L Aiman Mall', '../../assets/images/item/misedap2.png', '2026-07-25 09:09:15'),
(14, 'Sun Valley Grenadine Syrup', 12.50, 'Beverages', 'Sweet grenadine syrup for refreshing drinks.', 'H&L Aiman Mall', '../../assets/images/item/sunvalley2.png', '2026-07-25 09:09:15'),
(15, 'BOH 3-in-1 Tea Mix', 14.90, 'Beverages', 'Instant tea mix with convenient preparation.', 'e-Mart Summer Mall', '../../assets/images/item/boh.png', '2026-07-25 09:09:15'),
(16, 'Mi Sedap', 4.90, 'Noodles', 'Mi Sedap instant noodles are known for their variety of delicious flavors, unique seasoning packets, firm texture, and quick, easy preparation.', 'e-Mart Summer Mall', '../../assets/images/item/misedap.png', '2026-07-25 09:09:15'),
(17, 'Sun Valley Grenadine Syrup', 10.90, 'Beverages', 'Sweet and refreshing drink syrup.', 'e-Mart Summer Mall', '../../assets/images/item/sunvalley.png', '2026-07-25 09:09:15'),
(18, 'BOH 3-in-1 Tea Mix', 23.15, 'Beverages', 'Instant tea beverage pack for daily use.', 'H&L Aiman Mall', '../../assets/images/item/boh.png', '2026-07-25 09:09:15'),
(19, 'Hup Seng Cream Crackers', 5.80, 'Biscuits', 'Crunchy crackers with classic taste.', 'H&L Aiman Mall', '../../assets/images/item/hupseng2.png', '2026-07-25 09:09:15'),
(20, 'Jacob\'s Cream Crackers', 11.00, 'Biscuits', 'Classic crispy crackers in multipack size.', 'H&L Aiman Mall', '../../assets/images/item/jacobs2.png', '2026-07-25 09:09:15'),
(21, '100PLUS Original', 4.20, 'Beverages', 'Refreshing isotonic drink for hydration.', 'e-Mart Summer Mall', '../../assets/images/item/100plus.png', '2026-07-25 09:09:15'),
(22, 'Munchy\'s Cream Crackers', 5.20, 'Biscuits', 'Crispy biscuits for snacks anytime.', 'H&L Aiman Mall', '../../assets/images/item/munchy2.png', '2026-07-25 09:09:15'),
(23, '100PLUS Original', 3.90, 'Beverages', 'Refreshing isotonic beverage with electrolytes.', 'H&L Aiman Mall', '../../assets/images/item/100plus2.png', '2026-07-25 09:09:15'),
(24, 'Nescafe Classic Coffee', 22.70, 'Beverages', 'Aromatic instant coffee with smooth flavour.', 'e-Mart Summer Mall', '../../assets/images/item/nclassic2.png', '2026-07-25 09:09:15'),
(25, 'BOH 3-in-1 Tea Mix', 16.60, 'Beverages', 'Convenient instant tea with balanced flavour.', 'H&L Aiman Mall', '../../assets/images/item/boh2.png', '2026-07-25 09:09:15'),
(26, 'Gardenia Original Classic Bread', 3.80, 'Bread & Bakery', 'Soft and fresh white bread suitable for breakfast and sandwiches.', 'Everrise Express', '../../assets/images/item/gardenia.png', '2026-07-25 09:09:15'),
(27, 'Dutch Lady Full Cream Milk 1L', 8.90, 'Dairy Products', 'Fresh full cream milk rich in calcium and vitamins.', 'Farley Supermarket', '../../assets/images/item/dutchlady.png', '2026-07-25 09:09:15'),
(28, 'Farm Fresh Fresh Milk', 9.50, 'Dairy Products', 'Pasteurized fresh milk with a creamy taste.', 'Choice Daily', '../../assets/images/item/farmfresh.png', '2026-07-25 09:09:15'),
(29, 'Ayamas Chicken Nuggets', 14.90, 'Frozen Foods', 'Frozen chicken nuggets perfect for quick meals.', 'Emart Express', '../../assets/images/item/nuggets.png', '2026-07-25 09:09:15'),
(30, 'Mister Potato Original Chips', 4.20, 'Snacks', 'Crunchy potato chips with classic original flavour.', '99 Speedmart', '../../assets/images/item/misterpotato.png', '2026-07-25 09:09:15'),
(31, 'Pringles Sour Cream & Onion', 8.90, 'Snacks', 'Imported potato crisps with sour cream and onion seasoning.', 'Servay Supermarket', '../../assets/images/item/pringles.png', '2026-07-25 09:09:15'),
(32, 'Ayam Brand Sardines in Tomato Sauce', 8.50, 'Canned Foods', 'Premium canned sardines in rich tomato sauce.', 'KK Super Mart', '../../assets/images/item/sardines.png', '2026-07-25 09:09:15'),
(33, 'Gardenia Butterscotch Bread', 12.90, 'Bread & Bakery', 'Soft butterscotch-flavoured bread suitable for breakfast and tea time.', 'Unaco Superstore', '../../assets/images/item/gardenia-butterscotch.png', '2026-07-25 09:09:15'),
(34, 'Cadbury Dairy Milk Chocolate', 5.50, 'Confectionery', 'Smooth milk chocolate bar made with fresh milk.', '7-Eleven', '../../assets/images/item/cadbury.png', '2026-07-25 09:09:15'),
(35, 'Kinder Bueno Chocolate', 6.80, 'Confectionery', 'Crispy wafer filled with hazelnut cream and covered in chocolate.', 'myNEWS', '../../assets/images/item/kinderbueno.png', '2026-07-25 09:09:15'),
(36, 'Oreo Original Cookies', 5.90, 'Biscuits', 'Classic chocolate sandwich cookies with vanilla cream filling.', 'Orange Convenience Store', '../../assets/images/item/oreo.png', '2026-07-25 09:09:15'),
(37, 'Coca-Cola 1.5L', 4.80, 'Beverages', 'Refreshing carbonated soft drink perfect for sharing.', 'Happy Farm Fresh Mart', '../../assets/images/item/cocacola.png', '2026-07-25 09:09:15'),
(38, 'Indomie Mi Goreng', 5.80, 'Noodles', 'Popular instant fried noodles with authentic Indonesian flavour.', 'Choice Semariang', '../../assets/images/item/indomie.png', '2026-07-25 09:09:15'),
(39, 'Mamee Monster BBQ', 2.20, 'Snacks', 'Crunchy noodle snack with smoky BBQ flavour.', 'Ninso Kota Samarahan', '../../assets/images/item/mamee.png', '2026-07-25 09:09:15'),
(40, 'Marigold Peel Fresh Orange Juice', 7.90, 'Beverages', 'Refreshing orange juice made from quality oranges.', 'Jaya Grocer Express', '../../assets/images/item/peelfresh.png', '2026-07-25 09:09:15'),
(41, 'Nescafe 3-in-1 Original', 13.50, 'Beverages', 'Instant coffee mix with rich coffee flavour.', 'Everrise Express', '../../assets/images/item/noriginal.png', '2026-07-25 09:09:15'),
(42, 'Milo Chocolate Drink', 18.50, 'Beverages', 'Chocolate malt drink rich in energy and nutrients.', 'Farley Supermarket', '../../assets/images/item/milo.png', '2026-07-25 09:09:15'),
(43, '100PLUS Original', 4.10, 'Beverages', 'Refreshing isotonic drink for hydration.', 'Choice Daily', '../../assets/images/item/100plus.png', '2026-07-25 09:09:15'),
(44, 'Maggi Curry Noodles', 4.80, 'Noodles', 'Instant noodles with delicious curry flavour.', '99 Speedmart', '../../assets/images/item/maggi2.png', '2026-07-25 09:09:15'),
(45, 'Mi Sedaap Instant Noodles', 5.10, 'Noodles', 'Tasty noodles with rich seasoning flavour.', 'Servay Hypermarket', '../../assets/images/item/misedap2.png', '2026-07-25 09:09:15'),
(46, 'Jacob\'s Cream Crackers', 10.80, 'Biscuits', 'Classic crispy crackers in multipack packaging.', 'KK Super Mart', '../../assets/images/item/jacobs.png', '2026-07-25 09:09:15'),
(47, 'Hup Seng Cream Crackers', 5.40, 'Biscuits', 'Crunchy crackers suitable for snacks and meals.', 'Unaco Superstore', '../../assets/images/item/hupseng.png', '2026-07-25 09:09:15'),
(48, 'Gardenia Original Classic Bread', 3.60, 'Bread & Bakery', 'Soft and fresh white bread suitable for breakfast and sandwiches.', 'Happy Farm Fresh Mart', '../../assets/images/item/gardenia.png', '2026-07-25 09:09:15'),
(49, 'Gardenia Butterscotch Bread', 4.20, 'Bread & Bakery', 'Soft butterscotch-flavoured bread suitable for breakfast and tea time.', 'Choice Semariang', '../../assets/images/item/gardenia-butterscotch.png', '2026-07-25 09:09:15'),
(50, 'Dutch Lady Full Cream Milk 1L', 8.70, 'Dairy Products', 'Fresh full cream milk rich in calcium and vitamins.', 'Jaya Grocer Express', '../../assets/images/item/dutchlady.png', '2026-07-25 09:09:15'),
(51, 'Farm Fresh Fresh Milk', 9.20, 'Dairy Products', 'Pasteurized fresh milk with a creamy taste.', 'Everrise Express', '../../assets/images/item/farmfresh.png', '2026-07-25 09:09:15'),
(52, 'Ayamas Chicken Nuggets', 14.50, 'Frozen Foods', 'Frozen chicken nuggets perfect for quick meals.', 'Servay Hypermarket', '../../assets/images/item/nuggets.png', '2026-07-25 09:09:15'),
(53, 'Cadbury Dairy Milk Chocolate', 5.30, 'Confectionery', 'Smooth milk chocolate bar made with fresh milk.', '99 Speedmart', '../../assets/images/item/cadbury.png', '2026-07-25 09:09:15'),
(54, 'Kinder Bueno Chocolate', 6.50, 'Confectionery', 'Crispy wafer filled with hazelnut cream and covered in chocolate.', '7-Eleven', '../../assets/images/item/kinderbueno.png', '2026-07-25 09:09:15'),
(55, 'Pringles Sour Cream & Onion', 8.70, 'Snacks', 'Imported potato crisps with sour cream and onion seasoning.', 'Choice Daily', '../../assets/images/item/pringles.png', '2026-07-25 09:09:15'),
(56, 'Mister Potato Original Chips', 3.90, 'Snacks', 'Crunchy potato chips with classic original flavour.', 'Orange Convenience Store', '../../assets/images/item/misterpotato.png', '2026-07-25 09:09:15'),
(57, 'Mamee Monster BBQ', 2.00, 'Snacks', 'Crunchy noodle snack with smoky BBQ flavour.', 'myNEWS', '../../assets/images/item/mamee.png', '2026-07-25 09:09:15'),
(58, 'Ayam Brand Sardines in Tomato Sauce', 8.20, 'Canned Foods', 'Premium canned sardines in rich tomato sauce.', 'Farley Supermarket', '../../assets/images/item/sardines.png', '2026-07-25 09:09:15'),
(59, 'Marigold Peel Fresh Orange Juice', 7.60, 'Beverages', 'Refreshing orange juice made from quality oranges.', 'Unaco Superstore', '../../assets/images/item/peelfresh.png', '2026-07-25 09:09:15'),
(60, 'Sun Valley Grenadine Syrup', 11.90, 'Beverages', 'Sweet grenadine syrup for refreshing drinks.', 'Jaya Grocer Express', '../../assets/images/item/sunvalley.png', '2026-07-25 09:09:15'),
(61, 'BOH 3-in-1 Tea Mix', 15.20, 'Beverages', 'Instant tea mix with convenient preparation.', 'Everrise Express', '../../assets/images/item/boh.png', '2026-07-25 09:09:15'),
(62, 'Nescafe Classic Coffee', 22.90, 'Beverages', 'Premium instant coffee with rich aroma.', 'Farley Supermarket', '../../assets/images/item/nclassic.jpg', '2026-07-25 09:09:15'),
(63, 'Coca-Cola 1.5L', 4.60, 'Beverages', 'Refreshing carbonated soft drink perfect for sharing.', '99 Speedmart', '../../assets/images/item/cocacola.png', '2026-07-25 09:09:15'),
(64, 'Milo Powder Drink', 20.50, 'Beverages', 'Chocolate malt beverage for everyday enjoyment.', 'Choice Semariang', '../../assets/images/item/miloe.png', '2026-07-25 09:09:15'),
(65, '100PLUS Original', 3.80, 'Beverages', 'Refreshing isotonic beverage with electrolytes.', 'Emart Express', '../../assets/images/item/100plus2.png', '2026-07-25 09:09:15'),
(66, 'Maggi Asam Laksa Noodles', 5.20, 'Noodles', 'Instant noodles with spicy and sour laksa flavour.', 'Everrise Express', '../../assets/images/item/asamlaksa1.png', '2026-07-25 09:09:15'),
(67, 'Maggi Curry Noodles', 4.70, 'Noodles', 'Springy noodles with rich curry seasoning.', 'Choice Daily', '../../assets/images/item/maggi.jpg', '2026-07-25 09:09:15'),
(68, 'Mi Sedap', 4.80, 'Noodles', 'Mi Sedap instant noodles are known for their delicious flavours.', 'Jaya Grocer Express', '../../assets/images/item/misedap.png', '2026-07-25 09:09:15'),
(69, 'Indomie Mi Goreng', 5.50, 'Noodles', 'Popular instant fried noodles with authentic Indonesian flavour.', '99 Speedmart', '../../assets/images/item/indomie.png', '2026-07-25 09:09:15'),
(70, 'Munchy\'s Cream Crackers', 5.00, 'Biscuits', 'Light and crispy crackers for snacking.', 'Everrise Express', '../../assets/images/item/munchy.png', '2026-07-25 09:09:15'),
(71, 'Jacob\'s Cream Crackers', 11.20, 'Biscuits', 'Crunchy cream crackers in multipack packaging.', 'Farley Supermarket', '../../assets/images/item/jacobs2.png', '2026-07-25 09:09:15'),
(72, 'Oreo Original Cookies', 5.70, 'Biscuits', 'Classic chocolate sandwich cookies with vanilla cream filling.', 'Choice Daily', '../../assets/images/item/oreo.png', '2026-07-25 09:09:15'),
(73, 'Pringles Sour Cream & Onion', 8.60, 'Snacks', 'Imported potato crisps with sour cream and onion seasoning.', '7-Eleven', '../../assets/images/item/pringles.png', '2026-07-25 09:09:15'),
(74, 'Mister Potato Original Chips', 4.00, 'Snacks', 'Crunchy potato chips with classic original flavour.', 'myNEWS', '../../assets/images/item/misterpotato.png', '2026-07-25 09:09:15'),
(75, 'Mamee Monster BBQ', 2.10, 'Snacks', 'Crunchy noodle snack with smoky BBQ flavour.', 'Orange Convenience Store', '../../assets/images/item/mamee.png', '2026-07-25 09:09:15'),
(76, 'Farm Fresh Fresh Milk', 9.30, 'Dairy Products', 'Pasteurized fresh milk with a creamy taste.', 'Happy Farm Fresh Mart', '../../assets/images/item/farmfresh.png', '2026-07-25 09:09:15'),
(77, 'Gardenia Original Classic Bread', 3.70, 'Bread & Bakery', 'Soft and fresh white bread suitable for breakfast and sandwiches.', 'Farley Supermarket', '../../assets/images/item/gardenia.png', '2026-07-25 09:09:15'),
(78, 'Ayamas Chicken Nuggets', 14.70, 'Frozen Foods', 'Frozen chicken nuggets perfect for quick meals.', 'Unaco Superstore', '../../assets/images/item/nuggets.png', '2026-07-25 09:09:15'),
(79, 'Cadbury Dairy Milk Chocolate', 5.40, 'Confectionery', 'Smooth milk chocolate bar made with fresh milk.', 'Ninso Kota Samarahan', '../../assets/images/item/cadbury.png', '2026-07-25 09:09:15'),
(80, 'Ayam Brand Sardines in Tomato Sauce', 8.40, 'Canned Foods', 'Premium canned sardines in rich tomato sauce.', 'Choice Semariang', '../../assets/images/item/sardines.png', '2026-07-25 09:09:15'),
(81, 'Nescafe 3-in-1 Original', 13.70, 'Beverages', 'Instant coffee mix with rich coffee flavour.', 'Servay Hypermarket', '../../assets/images/item/noriginal.png', '2026-07-25 09:09:15'),
(82, 'Milo Chocolate Drink', 19.20, 'Beverages', 'Chocolate malt drink rich in energy and nutrients.', 'Unaco Superstore', '../../assets/images/item/milo.png', '2026-07-25 09:09:15'),
(83, 'Marigold Peel Fresh Orange Juice', 8.10, 'Beverages', 'Refreshing orange juice made from quality oranges.', 'Choice Daily', '../../assets/images/item/peelfresh.png', '2026-07-25 09:09:15'),
(84, 'Sun Valley Grenadine Syrup', 11.50, 'Beverages', 'Sweet and refreshing drink syrup.', '99 Speedmart', '../../assets/images/item/sunvalley.png', '2026-07-25 09:09:15'),
(85, '100PLUS Original', 4.00, 'Beverages', 'Refreshing isotonic beverage with electrolytes.', 'Everrise Express', '../../assets/images/item/100plus2.png', '2026-07-25 09:09:15'),
(86, 'Maggi Curry Noodles', 4.60, 'Noodles', 'Instant noodles with delicious curry flavour.', 'Farley Supermarket', '../../assets/images/item/maggi2.png', '2026-07-25 09:09:15'),
(87, 'Maggi Asam Laksa Noodles', 5.30, 'Noodles', 'Quick noodles with authentic Asam Laksa taste.', 'Choice Semariang', '../../assets/images/item/asamlaksa2.png', '2026-07-25 09:09:15'),
(88, 'Mi Sedaap Instant Noodles', 5.30, 'Noodles', 'Tasty noodles with rich seasoning flavour.', 'Emart Express', '../../assets/images/item/misedap2.png', '2026-07-25 09:09:15'),
(89, 'Indomie Mi Goreng', 5.60, 'Noodles', 'Popular instant fried noodles with authentic Indonesian flavour.', 'Orange Convenience Store', '../../assets/images/item/indomie.png', '2026-07-25 09:09:15'),
(90, 'Hup Seng Cream Crackers', 5.60, 'Biscuits', 'Crunchy crackers suitable for snacks and meals.', 'Choice Daily', '../../assets/images/item/hupseng.png', '2026-07-25 09:09:15'),
(91, 'Jacob\'s Cream Crackers', 11.30, 'Biscuits', 'Classic crispy crackers in multipack packaging.', 'Everrise Express', '../../assets/images/item/jacobs.png', '2026-07-25 09:09:15'),
(92, 'Munchy\'s Cream Crackers', 5.30, 'Biscuits', 'Light and crispy crackers for snacking.', 'Farley Supermarket', '../../assets/images/item/munchy2.png', '2026-07-25 09:09:15'),
(93, 'Pringles Sour Cream & Onion', 8.80, 'Snacks', 'Imported potato crisps with sour cream and onion seasoning.', 'Jaya Grocer Express', '../../assets/images/item/pringles.png', '2026-07-25 09:09:15'),
(94, 'Mister Potato Original Chips', 4.10, 'Snacks', 'Crunchy potato chips with classic original flavour.', '7-Eleven', '../../assets/images/item/misterpotato.png', '2026-07-25 09:09:15'),
(95, 'Mamee Monster BBQ', 2.30, 'Snacks', 'Crunchy noodle snack with smoky BBQ flavour.', 'KK Super Mart', '../../assets/images/item/mamee.png', '2026-07-25 09:09:15'),
(96, 'Dutch Lady Full Cream Milk 1L', 8.80, 'Dairy Products', 'Fresh full cream milk rich in calcium and vitamins.', 'Happy Farm Fresh Mart', '../../assets/images/item/dutchlady.png', '2026-07-25 09:09:15'),
(97, 'Gardenia Butterscotch Bread', 4.00, 'Bread & Bakery', 'Soft butterscotch-flavoured bread suitable for breakfast and tea time.', 'Servay Hypermarket', '../../assets/images/item/gardenia-butterscotch.png', '2026-07-25 09:09:15'),
(98, 'Ayamas Chicken Nuggets', 14.80, 'Frozen Foods', 'Frozen chicken nuggets perfect for quick meals.', 'Choice Daily', '../../assets/images/item/nuggets.png', '2026-07-25 09:09:15'),
(99, 'Cadbury Dairy Milk Chocolate', 5.60, 'Confectionery', 'Smooth milk chocolate bar made with fresh milk.', 'Jaya Grocer Express', '../../assets/images/item/cadbury.png', '2026-07-25 09:09:15'),
(100, 'Ayam Brand Sardines in Tomato Sauce', 8.60, 'Canned Foods', 'Premium canned sardines in rich tomato sauce.', 'Everrise Express', '../../assets/images/item/sardines.png', '2026-07-25 09:09:15'),
(101, 'Dutch Lady Chocolate Milk 1L', 7.90, 'Dairy Products', 'Chocolate flavoured milk drink rich in calcium and nutrients.', 'Ninso Kota Samarahan', '../../assets/images/item/dutchlady-choco.png', '2026-07-25 09:09:15'),
(102, 'Farm Fresh Yogurt Drink', 5.90, 'Dairy Products', 'Refreshing cultured milk drink with a smooth fruity taste.', 'KK Super Mart', '../../assets/images/item/farmfresh-yogurt.png', '2026-07-25 09:09:15'),
(103, 'Dutch Lady Full Cream Milk 1L', 8.60, 'Dairy Products', 'Fresh full cream milk suitable for daily consumption.', 'Orange Convenience Store', '../../assets/images/item/dutchlady.png', '2026-07-25 09:09:15'),
(104, 'Ayamas Chicken Nuggets', 14.60, 'Frozen Foods', 'Frozen chicken nuggets perfect for quick meals.', 'Jaya Grocer Express', '../../assets/images/item/nuggets.png', '2026-07-25 09:09:15'),
(105, 'Ayamas Chicken Burger Patties', 16.90, 'Frozen Foods', 'Frozen chicken patties suitable for homemade burgers.', 'Happy Farm Fresh Mart', '../../assets/images/item/ayamaspatties.png', '2026-07-25 09:09:15'),
(106, 'Gardenia Original Classic Bread', 3.90, 'Bread & Bakery', 'Soft and fresh white bread suitable for breakfast and sandwiches.', '7-Eleven', '../../assets/images/item/gardenia.png', '2026-07-25 09:09:15'),
(107, 'Gardenia Butterscotch Bread', 4.30, 'Bread & Bakery', 'Sweet butterscotch-flavoured bread for snacks and breakfast.', 'myNEWS', '../../assets/images/item/gardenia-butterscotch.png', '2026-07-25 09:09:15'),
(108, 'Ayam Brand Tuna Chunks', 7.50, 'Canned Foods', 'Premium canned tuna suitable for meals and sandwiches.', 'KK Super Mart', '../../assets/images/item/tuna.png', '2026-07-25 09:09:15'),
(109, 'Ayam Brand Sardines in Tomato Sauce', 8.30, 'Canned Foods', 'Premium canned sardines in rich tomato sauce.', 'Ninso Kota Samarahan', '../../assets/images/item/sardines.png', '2026-07-25 09:09:15'),
(110, 'KitKat Chocolate Bar', 3.20, 'Confectionery', 'Crispy wafer chocolate bar with a smooth coating.', 'Orange Convenience Store', '../../assets/images/item/kitkat.png', '2026-07-25 09:09:15'),
(111, 'Kinder Bueno Chocolate', 6.60, 'Confectionery', 'Crispy wafer filled with hazelnut cream and covered in chocolate.', 'Choice Daily', '../../assets/images/item/kinderbueno.png', '2026-07-25 09:09:15'),
(112, 'Cadbury Dairy Milk Chocolate', 5.70, 'Confectionery', 'Smooth milk chocolate bar made with fresh milk.', 'KK Super Mart', '../../assets/images/item/cadbury.png', '2026-07-25 09:09:15'),
(113, 'Nescafe Classic Coffee', 22.50, 'Beverages', 'Aromatic instant coffee with smooth flavour.', 'Ninso Kota Samarahan', '../../assets/images/item/nclassic.jpg', '2026-07-25 09:09:15'),
(114, 'BOH 3-in-1 Tea Mix', 15.50, 'Beverages', 'Instant tea mix with convenient preparation.', 'Choice Semariang', '../../assets/images/item/boh.png', '2026-07-25 09:09:15'),
(115, 'Coca-Cola 1.5L', 4.70, 'Beverages', 'Refreshing carbonated soft drink perfect for sharing.', 'Happy Farm Fresh Mart', '../../assets/images/item/cocacola.png', '2026-07-25 09:09:15'),
(116, 'Oreo Original Cookies', 5.80, 'Biscuits', 'Classic chocolate sandwich cookies with vanilla cream filling.', '7-Eleven', '../../assets/images/item/oreo.png', '2026-07-25 09:09:15'),
(117, 'Roma Marie Biscuits', 4.50, 'Biscuits', 'Classic sweet biscuits suitable for tea time snacks.', 'myNEWS', '../../assets/images/item/roma.png', '2026-07-25 09:09:15'),
(118, 'Maggi Curry Noodles', 4.80, 'Noodles', 'Instant noodles with rich curry seasoning flavour.', 'Orange Convenience Store', '../../assets/images/item/maggi2.png', '2026-07-25 09:09:15'),
(119, 'Pringles Sour Cream & Onion', 8.70, 'Snacks', 'Imported potato crisps with sour cream and onion seasoning.', 'Ninso Kota Samarahan', '../../assets/images/item/pringles.png', '2026-07-25 09:09:15'),
(120, 'Mister Potato Original Chips', 4.00, 'Snacks', 'Crunchy potato chips with classic original flavour.', 'Choice Semariang', '../../assets/images/item/misterpotato.png', '2026-07-25 09:09:15'),
(121, 'Nescafe 3-in-1 Original', 13.80, 'Beverages', 'Instant coffee mix with rich coffee flavour.', 'Choice Semariang', '../../assets/images/item/noriginal.png', '2026-07-25 09:09:15'),
(122, 'Milo Chocolate Drink', 18.70, 'Beverages', 'Chocolate malt drink rich in energy and nutrients.', 'Servay Hypermarket', '../../assets/images/item/milo.png', '2026-07-25 09:09:15'),
(123, '100PLUS Original', 4.30, 'Beverages', 'Refreshing isotonic drink for hydration.', 'KK Super Mart', '../../assets/images/item/100plus.png', '2026-07-25 09:09:15'),
(124, 'Marigold Peel Fresh Orange Juice', 7.70, 'Beverages', 'Refreshing orange juice made from quality oranges.', '7-Eleven', '../../assets/images/item/peelfresh.png', '2026-07-25 09:09:15'),
(125, 'Sun Valley Grenadine Syrup', 12.00, 'Beverages', 'Sweet syrup for preparing refreshing drinks.', 'myNEWS', '../../assets/images/item/sunvalley.png', '2026-07-25 09:09:15'),
(126, 'Maggi Asam Laksa Noodles', 5.40, 'Noodles', 'Instant noodles with spicy and sour laksa flavour.', 'Farley Supermarket', '../../assets/images/item/asamlaksa1.png', '2026-07-25 09:09:15'),
(127, 'Maggi Curry Noodles', 4.60, 'Noodles', 'Instant noodles with delicious curry flavour.', 'Unaco Superstore', '../../assets/images/item/maggi2.png', '2026-07-25 09:09:15'),
(128, 'Mi Sedaap Instant Noodles', 5.00, 'Noodles', 'Tasty noodles with rich seasoning flavour.', 'KK Super Mart', '../../assets/images/item/misedap2.png', '2026-07-25 09:09:15'),
(129, 'Indomie Mi Goreng', 5.40, 'Noodles', 'Popular instant fried noodles with authentic Indonesian flavour.', 'Happy Farm Fresh Mart', '../../assets/images/item/indomie.png', '2026-07-25 09:09:15'),
(130, 'Mi Sedap', 4.70, 'Noodles', 'Instant noodles known for various delicious flavours.', 'Ninso Kota Samarahan', '../../assets/images/item/misedap.png', '2026-07-25 09:09:15'),
(131, 'Hup Seng Cream Crackers', 5.30, 'Biscuits', 'Crispy crackers suitable for snacks and meals.', 'Servay Hypermarket', '../../assets/images/item/hupseng.png', '2026-07-25 09:09:15'),
(132, 'Jacob\'s Cream Crackers', 11.40, 'Biscuits', 'Crunchy cream crackers in multipack packaging.', 'Choice Semariang', '../../assets/images/item/jacobs.png', '2026-07-25 09:09:15'),
(133, 'Munchy\'s Cream Crackers', 5.40, 'Biscuits', 'Light and crispy crackers for snacking.', 'KK Super Mart', '../../assets/images/item/munchy.png', '2026-07-25 09:09:15'),
(134, 'Oreo Original Cookies', 5.60, 'Biscuits', 'Chocolate sandwich cookies with vanilla cream filling.', 'Orange Convenience Store', '../../assets/images/item/oreo.png', '2026-07-25 09:09:15'),
(135, 'Roma Marie Biscuits', 4.30, 'Biscuits', 'Sweet biscuits suitable for tea time snacks.', 'Happy Farm Fresh Mart', '../../assets/images/item/roma.png', '2026-07-25 09:09:15'),
(136, 'Mister Potato Original Chips', 4.20, 'Snacks', 'Crunchy potato chips with classic original flavour.', 'Everrise Express', '../../assets/images/item/misterpotato.png', '2026-07-25 09:09:15'),
(137, 'Pringles Sour Cream & Onion', 8.50, 'Snacks', 'Imported potato crisps with sour cream and onion seasoning.', 'Unaco Superstore', '../../assets/images/item/pringles.png', '2026-07-25 09:09:15'),
(138, 'Mamee Monster BBQ', 2.40, 'Snacks', 'Crunchy noodle snack with smoky BBQ flavour.', '7-Eleven', '../../assets/images/item/mamee.png', '2026-07-25 09:09:15'),
(139, 'Cadbury Dairy Milk Chocolate', 5.40, 'Confectionery', 'Smooth milk chocolate bar made with fresh milk.', 'myNEWS', '../../assets/images/item/cadbury.png', '2026-07-25 09:09:15'),
(140, 'Kinder Bueno Chocolate', 6.70, 'Confectionery', 'Crispy wafer filled with hazelnut cream and chocolate coating.', 'Orange Convenience Store', '../../assets/images/item/kinderbueno.png', '2026-07-25 09:09:15'),
(141, 'Farm Fresh Fresh Milk', 9.40, 'Dairy Products', 'Pasteurized fresh milk with a creamy taste.', 'Servay Hypermarket', '../../assets/images/item/farmfresh.png', '2026-07-25 09:09:15'),
(142, 'Dutch Lady Full Cream Milk 1L', 8.80, 'Dairy Products', 'Fresh full cream milk rich in calcium and vitamins.', 'Unaco Superstore', '../../assets/images/item/dutchlady.png', '2026-07-25 09:09:15'),
(143, 'Ayamas Chicken Nuggets', 14.40, 'Frozen Foods', 'Frozen chicken nuggets perfect for quick meals.', '99 Speedmart', '../../assets/images/item/nuggets.png', '2026-07-25 09:09:15'),
(144, 'Ayamas Chicken Burger Patties', 16.50, 'Frozen Foods', 'Frozen chicken patties suitable for homemade burgers.', 'Choice Daily', '../../assets/images/item/ayamaspatties.png', '2026-07-25 09:09:15'),
(145, 'Gardenia Original Classic Bread', 3.70, 'Bread & Bakery', 'Soft and fresh white bread suitable for breakfast.', 'KK Super Mart', '../../assets/images/item/gardenia.png', '2026-07-25 09:09:15'),
(146, 'Gardenia Butterscotch Bread', 4.10, 'Bread & Bakery', 'Sweet bread suitable for breakfast and snacks.', 'Orange Convenience Store', '../../assets/images/item/gardenia-butterscotch.png', '2026-07-25 09:09:15'),
(147, 'Ayam Brand Tomato Sardines', 8.40, 'Canned Foods', 'Premium canned sardines in rich tomato sauce.', 'Servay Hypermarket', '../../assets/images/item/sardines.png', '2026-07-25 09:09:15'),
(148, 'Ayam Brand Tuna Chunks', 7.70, 'Canned Foods', 'Premium canned tuna suitable for meals.', 'Happy Farm Fresh Mart', '../../assets/images/item/tuna.png', '2026-07-25 09:09:15'),
(149, 'BOH 3-in-1 Tea Mix', 16.20, 'Beverages', 'Instant tea beverage pack for daily use.', 'Farley Supermarket', '../../assets/images/item/boh.png', '2026-07-25 09:09:15'),
(150, 'Nescafe Classic Coffee', 23.00, 'Beverages', 'Premium instant coffee with rich aroma.', 'Choice Daily', '../../assets/images/item/nclassic.jpg', '2026-07-25 09:09:15');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `ratingID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `comment` text DEFAULT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`ratingID`, `ItemID`, `studentID`, `rating`, `comment`, `dateCreated`) VALUES
(1, 1, 1, '5.0', 'Affordable and good quality', '2026-07-20 15:16:56'),
(2, 2, 2, '4.5', 'Worth buying', '2026-07-20 15:16:56'),
(3, 3, 3, '4.0', 'Good product', '2026-07-20 15:16:56'),
(4, 4, 4, '4.5', 'Good value for money.', '2026-07-22 08:07:10'),
(5, 5, 5, '5.0', 'Highly recommended!', '2026-07-22 08:07:10'),
(6, 6, 6, '3.5', 'Reasonable quality.', '2026-07-22 08:07:10'),
(7, 7, 7, '4.0', 'Affordable product.', '2026-07-22 08:07:10'),
(8, 8, 8, '4.5', 'Satisfied with this purchase.', '2026-07-22 08:07:10'),
(9, 9, 9, '3.0', 'Average but acceptable.', '2026-07-22 08:07:10'),
(10, 10, 10, '5.0', 'Excellent quality.', '2026-07-22 08:07:10'),
(11, 11, 11, '4.0', 'Nice product.', '2026-07-22 08:07:10'),
(12, 12, 12, '4.5', 'Worth every ringgit.', '2026-07-22 08:07:10'),
(13, 13, 13, '3.5', 'Quite useful.', '2026-07-22 08:07:10'),
(14, 14, 14, '5.0', 'One of my favourites.', '2026-07-22 08:07:10'),
(15, 15, 15, '4.0', 'Good overall.', '2026-07-22 08:07:10'),
(16, 16, 16, '4.5', 'Will buy again.', '2026-07-22 08:07:10'),
(17, 17, 17, '3.5', 'Meets expectations.', '2026-07-22 08:07:10'),
(18, 18, 18, '4.0', 'Good quality.', '2026-07-22 08:07:10'),
(19, 19, 19, '5.0', 'Excellent choice.', '2026-07-22 08:07:10'),
(20, 20, 20, '4.5', 'Fresh and affordable.', '2026-07-22 08:07:10'),
(21, 21, 21, '3.5', 'Not bad.', '2026-07-22 08:07:10'),
(22, 22, 22, '4.0', 'Reasonably priced.', '2026-07-22 08:07:10'),
(23, 23, 23, '5.0', 'Very satisfied.', '2026-07-22 08:07:10'),
(24, 24, 24, '4.5', 'Highly recommended.', '2026-07-22 08:07:10'),
(25, 25, 25, '3.5', 'Pretty decent.', '2026-07-22 08:07:10'),
(26, 26, 26, '4.0', 'Nice packaging.', '2026-07-22 08:07:10'),
(27, 27, 27, '4.5', 'Great purchase.', '2026-07-22 08:07:10'),
(28, 28, 28, '5.0', 'Excellent value.', '2026-07-22 08:07:10'),
(29, 29, 29, '3.0', 'Acceptable quality.', '2026-07-22 08:07:10'),
(30, 30, 30, '4.0', 'Worth trying.', '2026-07-22 08:07:10'),
(31, 31, 31, '4.5', 'Very affordable.', '2026-07-22 08:07:10'),
(32, 32, 32, '5.0', 'Love this product.', '2026-07-22 08:07:10'),
(33, 33, 33, '4.0', 'Good enough.', '2026-07-22 08:07:10'),
(34, 34, 34, '3.5', 'Satisfied overall.', '2026-07-22 08:07:10'),
(35, 35, 35, '4.5', 'Quality exceeded expectations.', '2026-07-22 08:07:10'),
(36, 36, 36, '5.0', 'Fantastic item.', '2026-07-22 08:07:10'),
(37, 37, 37, '3.5', 'Works as expected.', '2026-07-22 08:07:10'),
(38, 38, 38, '4.0', 'Pretty good.', '2026-07-22 08:07:10'),
(39, 39, 39, '4.5', 'Definitely recommended.', '2026-07-22 08:07:10'),
(40, 40, 40, '5.0', 'Excellent purchase.', '2026-07-22 08:07:10'),
(41, 41, 41, '3.5', 'Value for money.', '2026-07-22 08:07:10'),
(42, 42, 42, '4.0', 'Good choice.', '2026-07-22 08:07:10'),
(43, 43, 43, '4.5', 'Happy with the quality.', '2026-07-22 08:07:10'),
(44, 44, 44, '5.0', 'Will purchase again.', '2026-07-22 08:07:10'),
(45, 45, 45, '3.0', 'Okay product.', '2026-07-22 08:07:10'),
(46, 46, 46, '4.0', 'Worth the price.', '2026-07-22 08:07:10'),
(47, 47, 47, '4.5', 'Nice and affordable.', '2026-07-22 08:07:10'),
(48, 48, 48, '5.0', 'Highly satisfied.', '2026-07-22 08:07:10'),
(49, 49, 49, '3.5', 'Quite decent.', '2026-07-22 08:07:10'),
(50, 50, 50, '4.0', 'No complaints.', '2026-07-22 08:07:10'),
(51, 51, 51, '4.5', 'Very nice.', '2026-07-22 08:07:10'),
(52, 52, 52, '5.0', 'Excellent.', '2026-07-22 08:07:10'),
(53, 53, 53, '3.5', 'Can recommend.', '2026-07-22 08:07:10'),
(54, 54, 54, '4.0', 'Met my expectations.', '2026-07-22 08:07:10'),
(55, 55, 55, '4.5', 'Really good.', '2026-07-22 08:07:10'),
(56, 56, 56, '5.0', 'Fantastic quality.', '2026-07-22 08:07:10'),
(57, 57, 57, '3.5', 'Budget friendly.', '2026-07-22 08:07:10'),
(58, 58, 58, '4.0', 'Affordable and useful.', '2026-07-22 08:07:10'),
(59, 59, 59, '4.5', 'Impressive quality.', '2026-07-22 08:07:10'),
(60, 60, 60, '5.0', 'Great product.', '2026-07-22 08:07:10'),
(61, 61, 61, '3.5', 'Pretty satisfied.', '2026-07-22 08:07:10'),
(62, 62, 62, '4.0', 'Reliable product.', '2026-07-22 08:07:10'),
(63, 63, 63, '4.5', 'Recommended to friends.', '2026-07-22 08:07:10'),
(64, 64, 64, '5.0', 'Very impressive.', '2026-07-22 08:07:10'),
(65, 65, 65, '3.5', 'Nice experience.', '2026-07-22 08:07:10'),
(66, 66, 66, '4.0', 'Good for the price.', '2026-07-22 08:07:10'),
(67, 67, 67, '4.5', 'Excellent overall.', '2026-07-22 08:07:10'),
(68, 12, 1, '4.5', 'Worth buying.', '2026-07-22 08:10:41'),
(69, 45, 2, '3.5', 'Decent quality.', '2026-07-22 08:10:41'),
(70, 8, 3, '5.0', 'Highly recommended!', '2026-07-22 08:10:41'),
(71, 67, 4, '4.0', 'Good value for money.', '2026-07-22 08:10:41'),
(72, 91, 5, '4.5', 'Affordable and reliable.', '2026-07-22 08:10:41'),
(73, 15, 6, '3.0', 'Average product.', '2026-07-22 08:10:41'),
(74, 102, 7, '5.0', 'Excellent purchase.', '2026-07-22 08:10:41'),
(75, 38, 8, '4.0', 'Satisfied with it.', '2026-07-22 08:10:41'),
(76, 56, 9, '4.5', 'Fresh and affordable.', '2026-07-22 08:10:41'),
(77, 73, 10, '3.5', 'Pretty good overall.', '2026-07-22 08:10:41'),
(78, 5, 11, '5.0', 'Would buy again.', '2026-07-22 08:10:41'),
(79, 29, 12, '4.0', 'Nice quality.', '2026-07-22 08:10:41'),
(80, 88, 13, '4.5', 'Really worth the price.', '2026-07-22 08:10:41'),
(81, 110, 14, '3.5', 'Met expectations.', '2026-07-22 08:10:41'),
(82, 17, 15, '4.0', 'Good choice.', '2026-07-22 08:10:41'),
(83, 95, 16, '5.0', 'Excellent quality.', '2026-07-22 08:10:41'),
(84, 61, 17, '4.5', 'Very useful.', '2026-07-22 08:10:41'),
(85, 14, 18, '3.5', 'Reasonable price.', '2026-07-22 08:10:41'),
(86, 77, 19, '4.0', 'Happy with purchase.', '2026-07-22 08:10:41'),
(87, 118, 20, '5.0', 'Highly satisfied.', '2026-07-22 08:10:41'),
(88, 24, 21, '4.5', 'Good packaging.', '2026-07-22 08:10:41'),
(89, 84, 22, '3.5', 'Works well.', '2026-07-22 08:10:41'),
(90, 35, 23, '4.0', 'Nice item.', '2026-07-22 08:10:41'),
(91, 11, 24, '5.0', 'Fantastic!', '2026-07-22 08:10:41'),
(92, 59, 25, '4.5', 'Very affordable.', '2026-07-22 08:10:41'),
(93, 99, 26, '3.0', 'Acceptable quality.', '2026-07-22 08:10:41'),
(94, 70, 27, '4.0', 'Pretty decent.', '2026-07-22 08:10:41'),
(95, 27, 28, '5.0', 'Love this product.', '2026-07-22 08:10:41'),
(96, 114, 29, '4.5', 'Would recommend.', '2026-07-22 08:10:41'),
(97, 41, 30, '3.5', 'Good enough.', '2026-07-22 08:10:41'),
(98, 82, 31, '4.0', 'Reliable item.', '2026-07-22 08:10:41'),
(99, 7, 32, '5.0', 'Amazing value.', '2026-07-22 08:10:41'),
(100, 53, 33, '4.5', 'Very satisfied.', '2026-07-22 08:10:41'),
(101, 94, 34, '3.5', 'Not bad.', '2026-07-22 08:10:41'),
(102, 18, 35, '4.0', 'Quality is good.', '2026-07-22 08:10:41'),
(103, 106, 36, '5.0', 'Exceeded expectations.', '2026-07-22 08:10:41'),
(104, 47, 37, '4.5', 'Affordable.', '2026-07-22 08:10:41'),
(105, 31, 38, '3.5', 'Worth trying.', '2026-07-22 08:10:41'),
(106, 79, 39, '4.0', 'Happy overall.', '2026-07-22 08:10:41'),
(107, 3, 40, '5.0', 'Excellent.', '2026-07-22 08:10:41'),
(108, 66, 41, '4.5', 'Nice product.', '2026-07-22 08:10:41'),
(109, 120, 42, '3.5', 'Budget friendly.', '2026-07-22 08:10:41'),
(110, 22, 43, '4.0', 'Good quality.', '2026-07-22 08:10:41'),
(111, 86, 44, '5.0', 'One of my favourites.', '2026-07-22 08:10:41'),
(112, 58, 45, '4.5', 'Really good.', '2026-07-22 08:10:41'),
(113, 13, 46, '3.5', 'Fair for the price.', '2026-07-22 08:10:41'),
(114, 97, 47, '4.0', 'Good experience.', '2026-07-22 08:10:41'),
(115, 44, 48, '5.0', 'Highly recommend.', '2026-07-22 08:10:41'),
(116, 109, 49, '4.5', 'Very pleased.', '2026-07-22 08:10:41'),
(117, 32, 50, '3.5', 'Satisfied.', '2026-07-22 08:10:41'),
(118, 74, 51, '4.5', 'Excellent value for money.', '2026-07-22 08:11:16'),
(119, 16, 52, '3.5', 'Good enough for daily use.', '2026-07-22 08:11:16'),
(120, 103, 53, '5.0', 'Highly recommended!', '2026-07-22 08:11:16'),
(121, 48, 54, '4.0', 'Very satisfied with this product.', '2026-07-22 08:11:16'),
(122, 26, 55, '3.0', 'Average but acceptable.', '2026-07-22 08:11:16'),
(123, 81, 56, '4.5', 'Quality exceeded expectations.', '2026-07-22 08:11:16'),
(124, 112, 57, '5.0', 'Would definitely buy again.', '2026-07-22 08:11:16'),
(125, 39, 58, '4.0', 'Nice packaging and quality.', '2026-07-22 08:11:16'),
(126, 6, 59, '3.5', 'Affordable choice.', '2026-07-22 08:11:16'),
(127, 92, 60, '4.5', 'Really worth buying.', '2026-07-22 08:11:16'),
(128, 55, 61, '5.0', 'One of the best products.', '2026-07-22 08:11:16'),
(129, 20, 62, '4.0', 'Good quality overall.', '2026-07-22 08:11:16'),
(130, 115, 63, '3.5', 'Met my expectations.', '2026-07-22 08:11:16'),
(131, 64, 64, '4.5', 'Very good experience.', '2026-07-22 08:11:16'),
(132, 33, 65, '5.0', 'Fantastic product!', '2026-07-22 08:11:16'),
(133, 87, 66, '4.0', 'Will purchase again.', '2026-07-22 08:11:16'),
(134, 9, 67, '3.5', 'Reasonably priced.', '2026-07-22 08:11:16'),
(135, 117, 1, '5.0', 'Excellent quality.', '2026-07-22 08:11:16'),
(136, 51, 2, '4.5', 'Highly satisfied.', '2026-07-22 08:11:16'),
(137, 23, 3, '4.0', 'Good purchase.', '2026-07-22 08:11:16'),
(138, 100, 4, '3.5', 'Pretty decent.', '2026-07-22 08:11:16'),
(139, 71, 5, '5.0', 'Love this item.', '2026-07-22 08:11:16'),
(140, 30, 6, '4.0', 'Nice quality.', '2026-07-22 08:11:16'),
(141, 104, 7, '4.5', 'Worth every ringgit.', '2026-07-22 08:11:16'),
(142, 57, 8, '3.5', 'Works as expected.', '2026-07-22 08:11:16'),
(143, 19, 9, '5.0', 'Very impressive.', '2026-07-22 08:11:16'),
(144, 83, 10, '4.0', 'Good value.', '2026-07-22 08:11:16'),
(145, 40, 11, '4.5', 'Fresh and affordable.', '2026-07-22 08:11:16'),
(146, 108, 12, '3.0', 'Average quality.', '2026-07-22 08:11:16'),
(147, 63, 13, '5.0', 'Excellent purchase.', '2026-07-22 08:11:16'),
(148, 28, 14, '4.0', 'Good product.', '2026-07-22 08:11:16'),
(149, 116, 15, '4.5', 'Very useful item.', '2026-07-22 08:11:16'),
(150, 54, 16, '3.5', 'Budget friendly.', '2026-07-22 08:11:16'),
(151, 2, 17, '5.0', 'Absolutely recommended.', '2026-07-22 08:11:16'),
(152, 89, 18, '4.0', 'Happy with this purchase.', '2026-07-22 08:11:16'),
(153, 37, 19, '4.5', 'Very reliable.', '2026-07-22 08:11:16'),
(154, 107, 20, '3.5', 'Good enough.', '2026-07-22 08:11:16'),
(155, 69, 21, '5.0', 'Fantastic value.', '2026-07-22 08:11:16'),
(156, 10, 22, '4.0', 'Satisfied overall.', '2026-07-22 08:11:16'),
(157, 96, 23, '4.5', 'Nice product quality.', '2026-07-22 08:11:16'),
(158, 43, 24, '3.5', 'Worth trying.', '2026-07-22 08:11:16'),
(159, 80, 25, '5.0', 'Exceeded my expectations.', '2026-07-22 08:11:16'),
(160, 34, 26, '4.0', 'Really nice.', '2026-07-22 08:11:16'),
(161, 113, 27, '4.5', 'Would recommend to friends.', '2026-07-22 08:11:16'),
(162, 60, 28, '3.5', 'Fairly good.', '2026-07-22 08:11:16'),
(163, 25, 29, '5.0', 'One of my favourites.', '2026-07-22 08:11:16'),
(164, 105, 30, '4.0', 'Great quality.', '2026-07-22 08:11:16'),
(165, 76, 31, '4.5', 'Affordable and reliable.', '2026-07-22 08:11:16'),
(166, 50, 32, '3.5', 'Good item for students.', '2026-07-22 08:11:16'),
(167, 1, 33, '5.0', 'Excellent overall.', '2026-07-22 08:11:16'),
(168, 14, 34, '4.5', 'Good quality for the price.', '2026-07-22 08:12:17'),
(169, 62, 35, '3.5', 'Quite decent overall.', '2026-07-22 08:12:17'),
(170, 111, 36, '5.0', 'Excellent choice!', '2026-07-22 08:12:17'),
(171, 36, 37, '4.0', 'Worth buying.', '2026-07-22 08:12:17'),
(172, 85, 38, '4.5', 'Really satisfied.', '2026-07-22 08:12:17'),
(173, 18, 39, '3.0', 'Average but acceptable.', '2026-07-22 08:12:17'),
(174, 119, 40, '5.0', 'Fantastic product.', '2026-07-22 08:12:17'),
(175, 52, 41, '4.0', 'Affordable and useful.', '2026-07-22 08:12:17'),
(176, 21, 42, '4.5', 'Would recommend this.', '2026-07-22 08:12:17'),
(177, 90, 43, '3.5', 'Met expectations.', '2026-07-22 08:12:17'),
(178, 65, 44, '5.0', 'Very impressive quality.', '2026-07-22 08:12:17'),
(179, 8, 45, '4.0', 'Nice purchase.', '2026-07-22 08:12:17'),
(180, 97, 46, '4.5', 'Good value.', '2026-07-22 08:12:17'),
(181, 42, 47, '3.5', 'Happy with it.', '2026-07-22 08:12:17'),
(182, 75, 48, '5.0', 'One of the best items.', '2026-07-22 08:12:17'),
(183, 27, 49, '4.0', 'Pretty good.', '2026-07-22 08:12:17'),
(184, 114, 50, '4.5', 'Will buy again.', '2026-07-22 08:12:17'),
(185, 58, 51, '3.5', 'Reasonable quality.', '2026-07-22 08:12:17'),
(186, 12, 52, '5.0', 'Highly recommended.', '2026-07-22 08:12:17'),
(187, 93, 53, '4.0', 'Very useful.', '2026-07-22 08:12:17'),
(188, 31, 54, '4.5', 'Quality exceeded expectations.', '2026-07-22 08:12:17'),
(189, 107, 55, '3.5', 'Nice and affordable.', '2026-07-22 08:12:17'),
(190, 46, 56, '5.0', 'Excellent purchase.', '2026-07-22 08:12:17'),
(191, 82, 57, '4.0', 'Good enough.', '2026-07-22 08:12:17'),
(192, 5, 58, '4.5', 'Very happy with this.', '2026-07-22 08:12:17'),
(193, 101, 59, '3.5', 'Satisfied overall.', '2026-07-22 08:12:17'),
(194, 68, 60, '5.0', 'Amazing quality.', '2026-07-22 08:12:17'),
(195, 17, 61, '4.0', 'Worth the money.', '2026-07-22 08:12:17'),
(196, 116, 62, '4.5', 'Very reliable.', '2026-07-22 08:12:17'),
(197, 39, 63, '3.5', 'Decent item.', '2026-07-22 08:12:17'),
(198, 88, 64, '5.0', 'Loved this product.', '2026-07-22 08:12:17'),
(199, 24, 65, '4.0', 'Good packaging.', '2026-07-22 08:12:17'),
(200, 109, 66, '4.5', 'Very affordable.', '2026-07-22 08:12:17'),
(201, 57, 67, '3.0', 'Acceptable.', '2026-07-22 08:12:17'),
(202, 9, 1, '5.0', 'Fresh and good quality.', '2026-07-22 08:12:17'),
(203, 98, 2, '4.0', 'Would purchase again.', '2026-07-22 08:12:17'),
(204, 44, 3, '4.5', 'Excellent overall.', '2026-07-22 08:12:17'),
(205, 79, 4, '3.5', 'Works well.', '2026-07-22 08:12:17'),
(206, 2, 5, '5.0', 'Highly satisfied.', '2026-07-22 08:12:17'),
(207, 103, 6, '4.0', 'Very good product.', '2026-07-22 08:12:17'),
(208, 50, 7, '4.5', 'Great value.', '2026-07-22 08:12:17'),
(209, 15, 8, '3.5', 'Not bad at all.', '2026-07-22 08:12:17'),
(210, 84, 9, '5.0', 'Excellent item.', '2026-07-22 08:12:17'),
(211, 28, 10, '4.0', 'Good quality.', '2026-07-22 08:12:17'),
(212, 118, 11, '4.5', 'Definitely recommended.', '2026-07-22 08:12:17'),
(213, 61, 12, '3.5', 'Reasonably priced.', '2026-07-22 08:12:17'),
(214, 35, 13, '5.0', 'Fantastic experience.', '2026-07-22 08:12:17'),
(215, 95, 14, '4.0', 'Very nice.', '2026-07-22 08:12:17'),
(216, 53, 15, '4.5', 'Will recommend to others.', '2026-07-22 08:12:17'),
(217, 7, 16, '3.5', 'Good budget choice.', '2026-07-22 08:12:17'),
(218, 72, 17, '4.5', 'Very satisfied with this purchase.', '2026-07-22 08:13:09'),
(219, 11, 18, '3.5', 'Good product for students.', '2026-07-22 08:13:09'),
(220, 99, 19, '5.0', 'Excellent quality and price.', '2026-07-22 08:13:09'),
(221, 40, 20, '4.0', 'Pretty decent overall.', '2026-07-22 08:13:09'),
(222, 83, 21, '4.5', 'Definitely worth buying.', '2026-07-22 08:13:09'),
(223, 29, 22, '3.0', 'Average but useful.', '2026-07-22 08:13:09'),
(224, 115, 23, '5.0', 'Highly recommended!', '2026-07-22 08:13:09'),
(225, 56, 24, '4.0', 'Very affordable.', '2026-07-22 08:13:09'),
(226, 13, 25, '4.5', 'Good value for money.', '2026-07-22 08:13:09'),
(227, 91, 26, '3.5', 'Met my expectations.', '2026-07-22 08:13:09'),
(228, 48, 27, '5.0', 'Excellent purchase.', '2026-07-22 08:13:09'),
(229, 104, 28, '4.0', 'Satisfied with the quality.', '2026-07-22 08:13:09'),
(230, 66, 29, '4.5', 'Fresh and reliable.', '2026-07-22 08:13:09'),
(231, 20, 30, '3.5', 'Nice item.', '2026-07-22 08:13:09'),
(232, 87, 31, '5.0', 'One of the best products.', '2026-07-22 08:13:09'),
(233, 34, 32, '4.0', 'Worth trying.', '2026-07-22 08:13:09'),
(234, 120, 33, '4.5', 'Fantastic value.', '2026-07-22 08:13:09'),
(235, 63, 34, '3.5', 'Affordable choice.', '2026-07-22 08:13:09'),
(236, 6, 35, '5.0', 'Really impressed.', '2026-07-22 08:13:09'),
(237, 110, 36, '4.0', 'Good overall quality.', '2026-07-22 08:13:09'),
(238, 54, 37, '4.5', 'Will buy again.', '2026-07-22 08:13:09'),
(239, 26, 38, '3.5', 'Reasonably priced.', '2026-07-22 08:13:09'),
(240, 97, 39, '5.0', 'Excellent item.', '2026-07-22 08:13:09'),
(241, 45, 40, '4.0', 'Nice experience.', '2026-07-22 08:13:09'),
(242, 80, 41, '4.5', 'Very useful.', '2026-07-22 08:13:09'),
(243, 16, 42, '3.5', 'Pretty good.', '2026-07-22 08:13:09'),
(244, 113, 43, '5.0', 'Highly satisfied.', '2026-07-22 08:13:09'),
(245, 59, 44, '4.0', 'Good purchase.', '2026-07-22 08:13:09'),
(246, 8, 45, '4.5', 'Quality exceeded expectations.', '2026-07-22 08:13:09'),
(247, 102, 46, '3.5', 'Acceptable quality.', '2026-07-22 08:13:09'),
(248, 37, 47, '5.0', 'Excellent and affordable.', '2026-07-22 08:13:09'),
(249, 74, 48, '4.0', 'Happy with this product.', '2026-07-22 08:13:09'),
(250, 23, 49, '4.5', 'Recommended.', '2026-07-22 08:13:09'),
(251, 89, 50, '3.5', 'Works well.', '2026-07-22 08:13:09'),
(252, 51, 51, '5.0', 'Fantastic!', '2026-07-22 08:13:09'),
(253, 118, 52, '4.0', 'Very nice product.', '2026-07-22 08:13:09'),
(254, 32, 53, '4.5', 'Good quality.', '2026-07-22 08:13:09'),
(255, 94, 54, '3.5', 'Worth the price.', '2026-07-22 08:13:09'),
(256, 67, 55, '5.0', 'One of my favourites.', '2026-07-22 08:13:09'),
(257, 10, 56, '4.0', 'Satisfied overall.', '2026-07-22 08:13:09'),
(258, 108, 57, '4.5', 'Excellent quality.', '2026-07-22 08:13:09'),
(259, 42, 58, '3.5', 'Fairly good.', '2026-07-22 08:13:09'),
(260, 81, 59, '5.0', 'Would recommend to friends.', '2026-07-22 08:13:09'),
(261, 19, 60, '4.0', 'Nice and fresh.', '2026-07-22 08:13:09'),
(262, 100, 61, '4.5', 'Great purchase.', '2026-07-22 08:13:09'),
(263, 58, 62, '3.5', 'Good enough.', '2026-07-22 08:13:09'),
(264, 4, 63, '5.0', 'Amazing quality.', '2026-07-22 08:13:09'),
(265, 86, 64, '4.0', 'Very reliable.', '2026-07-22 08:13:09'),
(266, 30, 65, '4.5', 'Excellent value.', '2026-07-22 08:13:09'),
(267, 112, 66, '3.5', 'Budget friendly.', '2026-07-22 08:13:09'),
(268, 16, 51, '4.0', 'Good product for daily use.', '2026-07-22 08:54:47'),
(269, 72, 52, '4.5', 'Really satisfied with this purchase.', '2026-07-22 08:54:47'),
(270, 40, 53, '3.5', 'Quality is acceptable.', '2026-07-22 08:54:47'),
(271, 101, 54, '5.0', 'Excellent product and worth the money.', '2026-07-22 08:54:47'),
(272, 63, 55, '4.0', 'Good taste and affordable.', '2026-07-22 08:54:47'),
(273, 26, 56, '3.5', 'Average but still useful.', '2026-07-22 08:54:47'),
(274, 89, 57, '4.5', 'Great quality and fast to finish.', '2026-07-22 08:54:47'),
(275, 34, 58, '5.0', 'Definitely recommended to others.', '2026-07-22 08:54:47'),
(276, 116, 59, '4.0', 'Good item with reasonable price.', '2026-07-22 08:54:47'),
(277, 9, 60, '3.5', 'Quite good compared to others.', '2026-07-22 08:54:47'),
(278, 52, 61, '4.5', 'Very satisfied with the quality.', '2026-07-22 08:54:47'),
(279, 75, 62, '5.0', 'Amazing product, will buy again.', '2026-07-22 08:54:47'),
(280, 20, 63, '4.0', 'Worth the price paid.', '2026-07-22 08:54:47'),
(281, 68, 64, '3.5', 'Product is okay overall.', '2026-07-22 08:54:47'),
(282, 103, 65, '4.5', 'Good packaging and quality.', '2026-07-22 08:54:47'),
(283, 37, 66, '5.0', 'My favourite item so far.', '2026-07-22 08:54:47'),
(284, 81, 67, '4.0', 'Reliable and useful product.', '2026-07-22 08:54:47'),
(285, 6, 1, '3.5', 'Decent quality for the price.', '2026-07-22 08:54:47'),
(286, 54, 2, '4.5', 'Really enjoyed this product.', '2026-07-22 08:54:47'),
(287, 92, 3, '5.0', 'Highly recommended item.', '2026-07-22 08:54:47'),
(288, 28, 4, '4.0', 'Good value and nice quality.', '2026-07-22 08:54:47'),
(289, 119, 5, '3.5', 'Could be improved but acceptable.', '2026-07-22 08:54:47'),
(290, 48, 6, '4.5', 'Fresh and satisfying.', '2026-07-22 08:54:47'),
(291, 65, 7, '5.0', 'Excellent purchase experience.', '2026-07-22 08:54:47'),
(292, 19, 8, '4.0', 'Pretty good and useful.', '2026-07-22 08:54:47'),
(293, 87, 9, '3.5', 'Average product quality.', '2026-07-22 08:54:47'),
(294, 36, 10, '4.5', 'Worth purchasing again.', '2026-07-22 08:54:47'),
(295, 105, 11, '5.0', 'Very happy with this item.', '2026-07-22 08:54:47'),
(296, 50, 12, '4.0', 'Good quality product.', '2026-07-22 08:54:47'),
(297, 71, 13, '3.5', 'Fair quality for the price.', '2026-07-22 08:54:47'),
(298, 10, 14, '4.5', 'Satisfied with the purchase.', '2026-07-22 08:54:47'),
(299, 96, 15, '5.0', 'Excellent and highly recommended.', '2026-07-22 08:54:47'),
(300, 43, 16, '4.0', 'Works as expected.', '2026-07-22 08:54:47'),
(301, 115, 17, '3.5', 'Not bad for everyday usage.', '2026-07-22 08:54:47'),
(302, 60, 18, '4.5', 'Nice product with good quality.', '2026-07-22 08:54:47'),
(303, 25, 19, '5.0', 'Amazing product and affordable.', '2026-07-22 08:54:47'),
(304, 78, 20, '4.0', 'Good experience overall.', '2026-07-22 08:54:47'),
(305, 33, 21, '3.5', 'Decent item but average.', '2026-07-22 08:54:47'),
(306, 100, 22, '4.5', 'Very useful and convenient.', '2026-07-22 08:54:47'),
(307, 57, 23, '5.0', 'Perfect choice for students.', '2026-07-22 08:54:47'),
(308, 21, 24, '4.0', 'Good product at reasonable price.', '2026-07-22 08:54:47'),
(309, 85, 25, '3.5', 'Satisfactory purchase.', '2026-07-22 08:54:47'),
(310, 39, 26, '4.5', 'Good flavour and quality.', '2026-07-22 08:54:47'),
(311, 112, 27, '5.0', 'Would definitely recommend.', '2026-07-22 08:54:47'),
(312, 74, 28, '4.0', 'Affordable and reliable.', '2026-07-22 08:54:47'),
(313, 46, 29, '3.5', 'Product meets expectations.', '2026-07-22 08:54:47'),
(314, 98, 30, '4.5', 'Very pleased with the quality.', '2026-07-22 08:54:47'),
(315, 30, 31, '5.0', 'Excellent value for money.', '2026-07-22 08:54:47'),
(316, 64, 32, '4.0', 'Nice product overall.', '2026-07-22 08:54:47'),
(317, 117, 33, '4.5', 'Good item and worth buying.', '2026-07-22 08:54:47'),
(318, 4, 34, '4.5', 'Very tasty and worth buying again.', '2026-07-22 08:55:40'),
(319, 83, 35, '4.0', 'Good quality and reasonable price.', '2026-07-22 08:55:40'),
(320, 51, 36, '5.0', 'Excellent product, highly recommended.', '2026-07-22 08:55:40'),
(321, 23, 37, '3.5', 'Quite good but nothing special.', '2026-07-22 08:55:40'),
(322, 108, 38, '4.5', 'Satisfied with this purchase.', '2026-07-22 08:55:40'),
(323, 69, 39, '4.0', 'Useful product for everyday needs.', '2026-07-22 08:55:40'),
(324, 12, 40, '5.0', 'Really enjoyed this item.', '2026-07-22 08:55:40'),
(325, 76, 41, '3.5', 'Quality is acceptable for the price.', '2026-07-22 08:55:40'),
(326, 42, 42, '4.5', 'Good packaging and fresh product.', '2026-07-22 08:55:40'),
(327, 113, 43, '5.0', 'One of the best products I bought.', '2026-07-22 08:55:40'),
(328, 55, 44, '4.0', 'Good value for students.', '2026-07-22 08:55:40'),
(329, 90, 45, '3.5', 'Average quality but still okay.', '2026-07-22 08:55:40'),
(330, 15, 46, '4.5', 'Would recommend to friends.', '2026-07-22 08:55:40'),
(331, 104, 47, '5.0', 'Amazing quality and taste.', '2026-07-22 08:55:40'),
(332, 31, 48, '4.0', 'Satisfied with the overall experience.', '2026-07-22 08:55:40'),
(333, 67, 49, '3.5', 'Product is fine for casual use.', '2026-07-22 08:55:40'),
(334, 118, 50, '4.5', 'Affordable and good quality.', '2026-07-22 08:55:40'),
(335, 8, 51, '5.0', 'Excellent purchase decision.', '2026-07-22 08:55:40'),
(336, 73, 52, '4.0', 'Good product with nice quality.', '2026-07-22 08:55:40'),
(337, 49, 53, '3.5', 'Not bad but could improve.', '2026-07-22 08:55:40'),
(338, 94, 54, '4.5', 'Very happy with this item.', '2026-07-22 08:55:40'),
(339, 14, 55, '5.0', 'Highly recommended for everyone.', '2026-07-22 08:55:40'),
(340, 62, 56, '4.0', 'Good taste and affordable price.', '2026-07-22 08:55:40'),
(341, 35, 57, '3.5', 'Average product performance.', '2026-07-22 08:55:40'),
(342, 107, 58, '4.5', 'Really useful and convenient.', '2026-07-22 08:55:40'),
(343, 26, 59, '5.0', 'Fantastic product, will repurchase.', '2026-07-22 08:55:40'),
(344, 80, 60, '4.0', 'Works well and worth the money.', '2026-07-22 08:55:40'),
(345, 45, 61, '3.5', 'Acceptable quality overall.', '2026-07-22 08:55:40'),
(346, 121, 62, '4.5', 'Great product and affordable.', '2026-07-22 08:55:40'),
(347, 17, 63, '5.0', 'Excellent quality and service.', '2026-07-22 08:55:40'),
(348, 59, 64, '4.0', 'Good item for daily usage.', '2026-07-22 08:55:40'),
(349, 97, 65, '3.5', 'Fair quality for the price.', '2026-07-22 08:55:40'),
(350, 38, 66, '4.5', 'Very satisfied with this purchase.', '2026-07-22 08:55:40'),
(351, 11, 67, '5.0', 'Amazing and highly recommended.', '2026-07-22 08:55:40'),
(352, 70, 1, '4.0', 'Nice product and good value.', '2026-07-22 08:55:40'),
(353, 102, 2, '3.5', 'Product is okay overall.', '2026-07-22 08:55:40'),
(354, 53, 3, '4.5', 'Good quality and nice packaging.', '2026-07-22 08:55:40'),
(355, 29, 4, '5.0', 'Definitely worth purchasing.', '2026-07-22 08:55:40'),
(356, 86, 5, '4.0', 'Affordable and reliable item.', '2026-07-22 08:55:40'),
(357, 61, 6, '3.5', 'Meets my expectations.', '2026-07-22 08:55:40'),
(358, 99, 7, '4.5', 'Great experience using this product.', '2026-07-22 08:55:40'),
(359, 18, 8, '5.0', 'My favourite item so far.', '2026-07-22 08:55:40'),
(360, 77, 9, '4.0', 'Good quality and reasonable price.', '2026-07-22 08:55:40'),
(361, 46, 10, '3.5', 'Decent product for the price.', '2026-07-22 08:55:40'),
(362, 110, 11, '4.5', 'Very satisfied and recommended.', '2026-07-22 08:55:40'),
(363, 24, 12, '5.0', 'Excellent product quality.', '2026-07-22 08:55:40'),
(364, 66, 13, '4.0', 'Good purchase and useful item.', '2026-07-22 08:55:40'),
(365, 95, 14, '3.5', 'Quite acceptable overall.', '2026-07-22 08:55:40'),
(366, 32, 15, '4.5', 'Worth buying again.', '2026-07-22 08:55:40'),
(367, 114, 16, '5.0', 'Perfect product for students.', '2026-07-22 08:55:40'),
(368, 22, 17, '4.5', 'Good product and worth the price.', '2026-07-22 08:56:43'),
(369, 91, 18, '5.0', 'Excellent quality, highly recommended.', '2026-07-22 08:56:43'),
(370, 47, 19, '4.0', 'Good item for daily usage.', '2026-07-22 08:56:43'),
(371, 103, 20, '3.5', 'Quality is acceptable.', '2026-07-22 08:56:43'),
(372, 36, 21, '4.5', 'Really satisfied with this purchase.', '2026-07-22 08:56:43'),
(373, 68, 22, '5.0', 'Amazing product and great value.', '2026-07-22 08:56:43'),
(374, 13, 23, '4.0', 'Nice product with good quality.', '2026-07-22 08:56:43'),
(375, 84, 24, '3.5', 'Average but still useful.', '2026-07-22 08:56:43'),
(376, 56, 25, '4.5', 'Would definitely buy again.', '2026-07-22 08:56:43'),
(377, 109, 26, '5.0', 'One of my favourite products.', '2026-07-22 08:56:43'),
(378, 30, 27, '4.0', 'Affordable and reliable.', '2026-07-22 08:56:43'),
(379, 72, 28, '3.5', 'Good enough for the price.', '2026-07-22 08:56:43'),
(380, 18, 29, '4.5', 'Very satisfied overall.', '2026-07-22 08:56:43'),
(381, 97, 30, '5.0', 'Excellent purchase experience.', '2026-07-22 08:56:43'),
(382, 44, 31, '4.0', 'Product works well.', '2026-07-22 08:56:43'),
(383, 116, 32, '3.5', 'Could be improved but acceptable.', '2026-07-22 08:56:43'),
(384, 61, 33, '4.5', 'Great quality and nice packaging.', '2026-07-22 08:56:43'),
(385, 9, 34, '5.0', 'Highly recommended item.', '2026-07-22 08:56:43'),
(386, 75, 35, '4.0', 'Good value for money.', '2026-07-22 08:56:43'),
(387, 52, 36, '3.5', 'Quite decent product.', '2026-07-22 08:56:43'),
(388, 88, 37, '4.5', 'Very useful and convenient.', '2026-07-22 08:56:43'),
(389, 27, 38, '5.0', 'Perfect choice for students.', '2026-07-22 08:56:43'),
(390, 114, 39, '4.0', 'Satisfied with the quality.', '2026-07-22 08:56:43'),
(391, 40, 40, '3.5', 'Fair quality for the price.', '2026-07-22 08:56:43'),
(392, 66, 41, '4.5', 'Really enjoyed this product.', '2026-07-22 08:56:43'),
(393, 15, 42, '5.0', 'Amazing taste and quality.', '2026-07-22 08:56:43'),
(394, 101, 43, '4.0', 'Good product overall.', '2026-07-22 08:56:43'),
(395, 58, 44, '3.5', 'Not bad but average.', '2026-07-22 08:56:43'),
(396, 33, 45, '4.5', 'Worth purchasing again.', '2026-07-22 08:56:43'),
(397, 120, 46, '5.0', 'Excellent and affordable.', '2026-07-22 08:56:43'),
(398, 21, 47, '4.0', 'Good product with reasonable price.', '2026-07-22 08:56:43'),
(399, 79, 48, '3.5', 'Meets my expectations.', '2026-07-22 08:56:43'),
(400, 49, 49, '4.5', 'Very happy with this purchase.', '2026-07-22 08:56:43'),
(401, 93, 50, '5.0', 'Really recommended to others.', '2026-07-22 08:56:43'),
(402, 6, 51, '4.0', 'Nice quality and useful.', '2026-07-22 08:56:43'),
(403, 82, 52, '3.5', 'Average product performance.', '2026-07-22 08:56:43'),
(404, 37, 53, '4.5', 'Good quality and fresh.', '2026-07-22 08:56:43'),
(405, 105, 54, '5.0', 'Excellent product, will buy again.', '2026-07-22 08:56:43'),
(406, 25, 55, '4.0', 'Good item for everyday use.', '2026-07-22 08:56:43'),
(407, 70, 56, '3.5', 'Acceptable quality overall.', '2026-07-22 08:56:43'),
(408, 12, 57, '4.5', 'Very satisfied with the purchase.', '2026-07-22 08:56:43'),
(409, 98, 58, '5.0', 'Fantastic product and affordable.', '2026-07-22 08:56:43'),
(410, 54, 59, '4.0', 'Good experience using this item.', '2026-07-22 08:56:43'),
(411, 81, 60, '3.5', 'Decent product for the price.', '2026-07-22 08:56:43'),
(412, 45, 61, '4.5', 'Great value and quality.', '2026-07-22 08:56:43'),
(413, 111, 62, '5.0', 'Highly satisfied with this item.', '2026-07-22 08:56:43'),
(414, 63, 63, '4.0', 'Good product and reliable.', '2026-07-22 08:56:43'),
(415, 19, 64, '3.5', 'Product is okay overall.', '2026-07-22 08:56:43'),
(416, 96, 65, '4.5', 'Really good quality.', '2026-07-22 08:56:43'),
(417, 34, 66, '5.0', 'Excellent, highly recommended.', '2026-07-22 08:56:43'),
(418, 5, 67, '4.5', 'Really good product and worth buying.', '2026-07-22 08:57:10'),
(419, 76, 1, '5.0', 'Excellent quality and highly recommended.', '2026-07-22 08:57:10'),
(420, 42, 2, '4.0', 'Good product for everyday use.', '2026-07-22 08:57:10'),
(421, 95, 3, '3.5', 'Quality is acceptable for the price.', '2026-07-22 08:57:10'),
(422, 17, 4, '4.5', 'Satisfied with this purchase.', '2026-07-22 08:57:10'),
(423, 64, 5, '5.0', 'Amazing product and great value.', '2026-07-22 08:57:10'),
(424, 29, 6, '4.0', 'Nice item with good quality.', '2026-07-22 08:57:10'),
(425, 108, 7, '3.5', 'Average product but still useful.', '2026-07-22 08:57:10'),
(426, 53, 8, '4.5', 'Would definitely purchase again.', '2026-07-22 08:57:10'),
(427, 87, 9, '5.0', 'One of the best items I bought.', '2026-07-22 08:57:10'),
(428, 34, 10, '4.0', 'Good quality and affordable.', '2026-07-22 08:57:10'),
(429, 71, 11, '3.5', 'Decent product for daily usage.', '2026-07-22 08:57:10'),
(430, 14, 12, '4.5', 'Very satisfied with the quality.', '2026-07-22 08:57:10'),
(431, 100, 13, '5.0', 'Excellent product experience.', '2026-07-22 08:57:10'),
(432, 46, 14, '4.0', 'Works well and meets expectations.', '2026-07-22 08:57:10'),
(433, 83, 15, '3.5', 'Fair quality overall.', '2026-07-22 08:57:10'),
(434, 23, 16, '4.5', 'Good taste and nice packaging.', '2026-07-22 08:57:10'),
(435, 119, 17, '5.0', 'Highly recommended product.', '2026-07-22 08:57:10'),
(436, 57, 18, '4.0', 'Worth the money spent.', '2026-07-22 08:57:10'),
(437, 10, 19, '3.5', 'Product is okay but average.', '2026-07-22 08:57:10'),
(438, 69, 20, '4.5', 'Great quality and useful item.', '2026-07-22 08:57:10'),
(439, 38, 21, '5.0', 'Excellent value for money.', '2026-07-22 08:57:10'),
(440, 92, 22, '4.0', 'Good product and reliable.', '2026-07-22 08:57:10'),
(441, 26, 23, '3.5', 'Acceptable quality.', '2026-07-22 08:57:10'),
(442, 104, 24, '4.5', 'Really enjoyed this purchase.', '2026-07-22 08:57:10'),
(443, 60, 25, '5.0', 'Fantastic product, will buy again.', '2026-07-22 08:57:10'),
(444, 31, 26, '4.0', 'Good item for students.', '2026-07-22 08:57:10'),
(445, 78, 27, '3.5', 'Quite decent product.', '2026-07-22 08:57:10'),
(446, 16, 28, '4.5', 'Very useful and affordable.', '2026-07-22 08:57:10'),
(447, 113, 29, '5.0', 'Perfect choice and recommended.', '2026-07-22 08:57:10'),
(448, 50, 30, '4.0', 'Good quality product.', '2026-07-22 08:57:10'),
(449, 85, 31, '3.5', 'Could be better but acceptable.', '2026-07-22 08:57:10'),
(450, 41, 32, '4.5', 'Satisfied with this item.', '2026-07-22 08:57:10'),
(451, 98, 33, '5.0', 'Amazing quality and taste.', '2026-07-22 08:57:10'),
(452, 20, 34, '4.0', 'Good purchase experience.', '2026-07-22 08:57:10'),
(453, 67, 35, '3.5', 'Average quality but okay.', '2026-07-22 08:57:10'),
(454, 115, 36, '4.5', 'Really worth the price.', '2026-07-22 08:57:10'),
(455, 55, 37, '5.0', 'Excellent product overall.', '2026-07-22 08:57:10'),
(456, 8, 38, '4.0', 'Good and reliable item.', '2026-07-22 08:57:10'),
(457, 74, 39, '3.5', 'Meets my expectations.', '2026-07-22 08:57:10'),
(458, 39, 40, '4.5', 'Very satisfied with the purchase.', '2026-07-22 08:57:10'),
(459, 106, 41, '5.0', 'Highly recommended to everyone.', '2026-07-22 08:57:10'),
(460, 28, 42, '4.0', 'Nice product and affordable.', '2026-07-22 08:57:10'),
(461, 89, 43, '3.5', 'Average but still useful.', '2026-07-22 08:57:10'),
(462, 62, 44, '4.5', 'Great product quality.', '2026-07-22 08:57:10'),
(463, 12, 45, '5.0', 'Excellent and worth purchasing.', '2026-07-22 08:57:10'),
(464, 97, 46, '4.0', 'Good experience overall.', '2026-07-22 08:57:10'),
(465, 35, 47, '3.5', 'Fair price and acceptable quality.', '2026-07-22 08:57:10'),
(466, 117, 48, '4.5', 'Very good product.', '2026-07-22 08:57:10'),
(467, 51, 49, '5.0', 'My favourite item so far.', '2026-07-22 08:57:10'),
(468, 1, 50, '5.0', 'Excellent product and worth the price.', '2026-07-22 08:57:41'),
(469, 38, 51, '4.5', 'Very satisfied with this purchase.', '2026-07-22 08:57:41'),
(470, 70, 52, '4.0', 'Good quality and affordable.', '2026-07-22 08:57:41'),
(471, 95, 53, '5.0', 'Highly recommended product.', '2026-07-22 08:57:41'),
(472, 120, 54, '4.5', 'Great item with good value.', '2026-07-22 08:57:41'),
(473, 12, 55, '3.5', 'Quality is acceptable.', '2026-07-22 08:57:41'),
(474, 49, 56, '5.0', 'Amazing product, will buy again.', '2026-07-22 08:57:41'),
(475, 82, 57, '4.0', 'Useful product for daily needs.', '2026-07-22 08:57:41'),
(476, 33, 58, '4.5', 'Good packaging and quality.', '2026-07-22 08:57:41'),
(477, 105, 59, '5.0', 'Excellent experience using this item.', '2026-07-22 08:57:41'),
(478, 64, 60, '3.5', 'Decent product for the price.', '2026-07-22 08:57:41'),
(479, 27, 61, '4.5', 'Really enjoyed this product.', '2026-07-22 08:57:41'),
(480, 88, 62, '4.0', 'Good product overall.', '2026-07-22 08:57:41'),
(481, 15, 63, '5.0', 'One of my favourite items.', '2026-07-22 08:57:41'),
(482, 57, 64, '4.5', 'Affordable and reliable.', '2026-07-22 08:57:41'),
(483, 103, 65, '3.5', 'Average quality but still useful.', '2026-07-22 08:57:41'),
(484, 45, 66, '4.0', 'Satisfied with the purchase.', '2026-07-22 08:57:41'),
(485, 76, 67, '5.0', 'Excellent quality and taste.', '2026-07-22 08:57:41'),
(486, 20, 1, '4.5', 'Worth purchasing again.', '2026-07-22 08:57:41'),
(487, 91, 2, '4.0', 'Good item and reasonable price.', '2026-07-22 08:57:41'),
(488, 54, 3, '5.0', 'Fantastic product, highly recommended.', '2026-07-22 08:57:41'),
(489, 39, 4, '3.5', 'Product is okay overall.', '2026-07-22 08:57:41'),
(490, 110, 5, '4.5', 'Very good quality product.', '2026-07-22 08:57:41'),
(491, 68, 6, '5.0', 'Perfect choice for students.', '2026-07-22 08:57:41'),
(492, 24, 7, '4.0', 'Nice product and affordable.', '2026-07-22 08:57:41'),
(493, 99, 8, '4.5', 'Great value for money.', '2026-07-22 08:57:41'),
(494, 31, 9, '3.5', 'Could be improved but acceptable.', '2026-07-22 08:57:41'),
(495, 116, 10, '5.0', 'Excellent product experience.', '2026-07-22 08:57:41'),
(496, 52, 11, '4.0', 'Good and reliable item.', '2026-07-22 08:57:41'),
(497, 84, 12, '4.5', 'Satisfied with the quality.', '2026-07-22 08:57:41'),
(498, 18, 13, '5.0', 'Highly recommended and useful.', '2026-07-22 08:57:41'),
(499, 73, 14, '4.0', 'Good purchase overall.', '2026-07-22 08:57:41'),
(500, 42, 15, '4.5', 'Really worth the money.', '2026-07-22 08:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `report_logs`
--

CREATE TABLE `report_logs` (
  `reportID` int(11) NOT NULL,
  `adminID` int(11) DEFAULT NULL,
  `reportType` varchar(30) DEFAULT NULL,
  `format` varchar(20) DEFAULT NULL,
  `generatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report_logs`
--

INSERT INTO `report_logs` (`reportID`, `adminID`, `reportType`, `format`, `generatedAt`) VALUES
(1, 1, 'item', 'CSV', '2026-07-25 10:00:24'),
(2, 1, 'item', 'JSON', '2026-07-25 10:02:06'),
(3, 1, 'item', 'JSON', '2026-07-25 10:02:17'),
(4, 1, 'item', 'JSON', '2026-07-25 10:02:17'),
(5, 1, 'item', 'Excel', '2026-07-25 10:03:51'),
(6, 1, 'item', 'Excel', '2026-07-25 10:03:52'),
(7, 1, 'student', 'Excel', '2026-07-25 10:04:38'),
(8, 1, 'student', 'Excel', '2026-07-25 10:04:39'),
(9, 1, 'rating', 'Excel', '2026-07-25 10:05:16'),
(10, 1, 'rating', 'Excel', '2026-07-25 10:05:16'),
(11, 1, 'item', 'Excel', '2026-07-25 10:11:29'),
(12, 1, 'item', 'Excel', '2026-07-25 10:11:30'),
(13, 1, 'item', 'PDF', '2026-07-25 10:15:47'),
(14, 1, 'item', 'PDF', '2026-07-25 10:15:48'),
(15, 1, 'item', 'PDF', '2026-07-25 10:44:40'),
(16, 1, 'item', 'PDF', '2026-07-25 10:44:49'),
(17, 1, 'item', 'PDF', '2026-07-25 10:44:50'),
(18, 1, 'item', 'CSV', '2026-07-27 15:37:32'),
(19, 1, 'item', 'CSV', '2026-07-27 15:37:33'),
(20, 1, 'item', 'PDF', '2026-07-27 17:00:27'),
(21, 1, 'item', 'PDF', '2026-07-27 17:00:28'),
(22, 1, 'item', 'PDF', '2026-07-27 17:01:03'),
(23, 1, 'item', 'PDF', '2026-07-27 17:01:32'),
(24, 1, 'item', 'PDF', '2026-07-27 17:01:50'),
(25, 1, 'item', 'PDF', '2026-07-27 17:03:01'),
(26, 1, 'item', 'PDF', '2026-07-27 17:03:17'),
(27, 1, 'item', 'PDF', '2026-07-27 17:03:18'),
(28, 1, 'item', 'PDF', '2026-07-27 17:04:01'),
(29, 1, 'item', 'PDF', '2026-07-27 17:04:10'),
(30, 1, 'item', 'PDF', '2026-07-27 17:04:13'),
(31, 1, 'item', 'CSV', '2026-07-27 17:20:26'),
(32, 1, 'item', 'CSV', '2026-07-27 17:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `storeID` int(11) NOT NULL,
  `StoreName` varchar(255) NOT NULL,
  `desc1` varchar(255) NOT NULL,
  `storeIMG` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`storeID`, `StoreName`, `desc1`, `storeIMG`) VALUES
(1, 'e-Mart Summer Mall', 'Offers a variety of electronics, appliances, fashion, beauty products, and groceries with competitive prices and convenient shopping.', '../../assets/images/store/emart.jpg'),
(2, 'H&L Aiman Mall', 'Provides fresh produce, groceries, and household items with quality products at affordable prices and a comfortable shopping experience.', '../../assets/images/store/hnl.jpg'),
(3, 'Everrise Express', 'Convenience supermarket offering fresh groceries, beverages, snacks, and daily household essentials.', '../../assets/images/store/everrise.jpg'),
(4, 'Farley Supermarket', 'Neighborhood supermarket providing fresh produce, frozen food, groceries, and household necessities.', '../../assets/images/store/farley.jpg'),
(5, 'Choice Daily', 'Convenience store offering snacks, drinks, ready-to-eat meals, and everyday essentials.', '../../assets/images/store/choice-daily.jpg'),
(6, 'Emart Express', 'Local convenience store providing groceries, beverages, and household items for quick shopping.', '../../assets/images/store/emart-express.jpg'),
(7, '99 Speedmart', 'Mini market offering affordable groceries, beverages, personal care products, and household essentials.', '../../assets/images/store/99speedmart.jpg'),
(8, 'Servay Hypermarket', 'Supermarket providing fresh vegetables, meat, groceries, and daily necessities.', '../../assets/images/store/servay.jpg'),
(9, 'KK Super Mart', 'Convenience store selling groceries, snacks, drinks, frozen food, and household products.', '../../assets/images/store/kksupermart.jpg'),
(10, 'Unaco Superstore', 'Local supermarket providing groceries, fresh food, beverages, and daily household essentials.', '../../assets/images/store/unaco.jpg'),
(11, 'Eco-Shop', 'Value store offering household items, kitchenware, stationery, toys, and daily essentials at affordable prices.', '../../assets/images/store/ecoshop.png'),
(12, '7-Eleven', 'Convenience store providing beverages, snacks, ready-to-eat meals, and essential daily products.', '../../assets/images/store/7eleven.jpg'),
(13, 'myNEWS', 'Convenience store offering coffee, sandwiches, pastries, snacks, drinks, and convenience items.', '../../assets/images/store/mynews.jpg'),
(14, 'Orange Convenience Store', 'Neighborhood convenience store selling groceries, beverages, frozen food, and household essentials.', '../../assets/images/store/orange.jpg'),
(15, 'Happy Farm Fresh Mart ', 'Fresh market providing vegetables, seafood, meat, fruits, and local agricultural products.', '../../assets/images/store/happyfarm.jpg'),
(16, 'Jaya Grocer Express', 'Compact grocery store with fresh food, imported products, beverages, and household necessities.', '../../assets/images/store/jaya-grocer.jpg'),
(17, 'Ninso Kota Samarahan', 'Variety store offering household goods, snacks, kitchenware, stationery, toys, and affordable daily necessities.', '../../assets/images/store/ninso.jpg'),
(18, 'Choice Semariang', 'Supermarket providing fresh groceries, beverages, frozen food, household essentials, and personal care products.', '../../assets/images/store/choice-supermall.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `studentIMG` varchar(255) NOT NULL,
  `logStatus` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `fullName`, `username`, `email`, `password`, `studentIMG`, `logStatus`, `created_at`) VALUES
(1, 'Faizatul Fitri Bin Boestamam', 'fai', 'fai@gmail.com', 'abc123', '../../assets/images/profile/fai.jpg', '0', '2024-03-15 02:30:00'),
(2, 'Mohammad Amir Alam Bin Rahim Omar', 'amiromar', 'amir@gmail.com', 'abc123', '../../assets/images/profile/amir.jpg', '0', '2024-03-15 02:30:00'),
(3, 'Harith Zakwan Bin Zakaria', 'harith', 'harith@gmail.com', 'abc123', '../../assets/images/profile/harith.jpg', '0', '2024-03-15 02:30:00'),
(4, 'Mohamad Waqiuddin Bin Yahya', 'qiu', 'qiu@gmail.com', 'abc123', '../../assets/images/profile/qiu.jpeg', '0', '2024-03-15 02:30:00'),
(5, 'Iman Tarmizi Rosalina', 'iman', 'iman@gmail.com', 'abc123', '../../assets/images/profile/iman.jpg', '0', '2024-03-15 02:30:00'),
(6, 'John Cena', 'cena', 'john@gmail.com', 'wwe123', '../../assets/images/profile/cena.png', '0', '2024-03-15 02:30:00'),
(7, 'Syed Saddiq Syed Abdul Rahman', 'saddiq', 'saddiq@gmail.com', 'abc123', '../../assets/images/profile/saddiq.png', '0', '2025-02-20 01:15:00'),
(8, 'Nik Nazmi Nik Ahmad', 'nik', 'nik@gmail.com', 'abc123', '../../assets/images/profile/nik.png', '0', '2025-02-20 01:15:00'),
(9, 'Mohd Rafizi Bin Ramli', 'rafizi', 'rafizi@gmail.com', 'abc123', '../../assets/images/profile/rafizi.png', '0', '2025-02-20 01:15:00'),
(10, 'Syafiq Kyle', 'syafiq', 'syafiq@gmail.com', 'abc123', '../../assets/images/profile/syafiq.png', '0', '2025-02-20 01:15:00'),
(11, 'Mohammad Erling Haaland', 'erling', 'erling@gmail.com', 'abc123', '../../assets/images/profile/erling.png', '0', '2025-02-20 01:15:00'),
(12, 'Muhammad Firdaus Wong', 'firdaus', 'firdaus@gmail.com', 'abc123', '../../assets/images/profile/firdaus.png', '0', '2025-02-20 01:15:00'),
(13, 'Jamal Musiala', 'jamal', 'musiala@gmail.com', 'abc123', '../../assets/images/profile/musiala.png', '0', '2025-02-20 01:15:00'),
(14, 'Daniel Lee Zi Jia', 'daniel', 'daniel@gmail.com', 'abc123', '../../assets/images/profile/daniel.png', '0', '2025-02-20 01:15:00'),
(15, 'Nur Amirah Olsen', 'amirah', 'amirah@gmail.com', 'abc123', '../../assets/images/profile/amirah.png', '0', '2025-02-20 01:15:00'),
(16, 'Muhammad Danish Hojlund', 'danish', 'danish@gmail.com', 'abc123', '../../assets/images/profile/danish.png', '0', '2025-02-20 01:15:00'),
(17, 'Amelia Henderson', 'amelia', 'amelia@gmail.com', 'abc123', '../../assets/images/profile/amelia.png', '0', '2025-02-20 01:15:00'),
(18, 'Muhammad Izzat Sidek Bin Zainal Rasyid', 'izzat', 'izzat@gmail.com', 'abc123', '../../assets/images/profile/sidek.png', '0', '2025-02-20 01:15:00'),
(19, 'Siti Aina Scarlett Binti Yusof Johansson', 'aina', 'aina@gmail.com', 'abc123', '../../assets/images/profile/aina.png', '0', '2025-02-20 01:15:00'),
(20, 'Mohd Muhsin Hakim Bin al-Rahman', 'hakim', 'hakim@gmail.com', 'abc123', '../../assets/images/profile/hakim.png', '0', '2025-02-20 01:15:00'),
(21, 'Tracie Sindol', 'tracie', 'tracie@gmail.com', 'abc123', '../../assets/images/profile/tracie.png', '0', '2025-08-10 06:20:00'),
(22, 'Aedy Ashraf', 'aedy', 'aedy@gmail.com', 'abc123', '../../assets/images/profile/aedy.png', '0', '2025-08-10 06:20:00'),
(23, 'Daiyan Trisha', 'daiyan', 'daiyan@gmail.com', 'abc123', '../../assets/images/profile/daiyan.png', '0', '2025-08-10 06:20:00'),
(24, 'Jason Tan Chee Keong', 'jason', 'jason@gmail.com', 'abc123', '../../assets/images/profile/jasontan.png', '0', '2025-08-10 06:20:00'),
(25, 'Nur Sabrina Binti Salleh', 'sabrina', 'sabrina@gmail.com', 'abc123', '../../assets/images/profile/sabrina.png', '0', '2025-08-10 06:20:00'),
(26, 'Muhammad Arif Dabush Bin Kamarudin', 'dabush', 'dabush@gmail.com', 'abc123', '../../assets/images/profile/dabush.png', '0', '2025-08-10 06:20:00'),
(27, 'Angelina Chai Ka Yung', 'angel', 'angel@gmail.com', 'abc123', '../../assets/images/profile/angel.png', '0', '2025-08-10 06:20:00'),
(28, 'Muhammad Aiman Banna', 'aiman', 'aiman@gmail.com', 'abc123', '../../assets/images/profile/aiman.png', '0', '2025-08-10 06:20:00'),
(29, 'Siti Nabilah Binti Shukri', 'nabilah', 'nabilah@gmail.com', 'abc123', '../../assets/images/profile/nabilah.png', '0', '2025-08-10 06:20:00'),
(30, 'Mohd Jalal Bin Jalil', 'jalal', 'jalil@gmail.com', 'abc123', '../../assets/images/profile/jalil.png', '0', '2025-08-10 06:20:00'),
(31, 'Nur Izzah Anwar', 'izzah', 'izzah@gmail.com', 'abc123', '../../assets/images/profile/izzah.png', '0', '2025-08-10 06:20:00'),
(32, 'Muhammad Faiz Sharnaf', 'faiz', 'faiz@gmail.com', 'abc123', '../../assets/images/profile/sharnaf.png', '0', '2025-08-10 06:20:00'),
(33, 'Siti Sofia Binti Ibrahim', 'sofia', 'sofia@gmail.com', 'abc123', '../../assets/images/profile/sofia.png', '0', '2025-08-10 06:20:00'),
(34, 'Kelvin Wong Jun Hao', 'kelvin', 'kelvin@gmail.com', 'abc123', '../../assets/images/profile/kelvin.png', '0', '2025-08-10 06:20:00'),
(35, 'Fadhli Masoot', 'fadhli', 'fadhli@gmail.com', 'abc123', '../../assets/images/profile/fadhli.png', '0', '2025-08-10 06:20:00'),
(36, 'Ariffin Bin Zul', 'irfan', 'irfan@gmail.com', 'abc123', '../../assets/images/profile/ariffin.png', '0', '2025-08-10 06:20:00'),
(37, 'Iman Alysha', 'imanopie', 'imanopie@gmail.com', 'abc123', '../../assets/images/profile/imanopie.png', '0', '2025-08-10 06:20:00'),
(38, 'Mierul Haziq Aiman', 'haziq', 'haziq@gmail.com', 'abc123', '../../assets/images/profile/mierul.png', '0', '2025-08-10 06:20:00'),
(39, 'Siti Mariam Khadijah', 'mariam', 'mariam@gmail.com', 'abc123', '../../assets/images/profile/mariam.png', '0', '2025-08-10 06:20:00'),
(40, 'Mohd Amir Ahnaf', 'ahnaf', 'ahnaf@gmail.com', 'abc123', '../../assets/images/profile/amirahnaf.png', '0', '2025-08-10 06:20:00'),
(41, 'Nadhir Nassar', 'nadhir', 'nadhir@gmail.com', 'abc123', '../../assets/images/profile/nadhir.png', '0', '2026-01-12 03:00:00'),
(42, 'Ferran Torres', 'ferran', 'ferran@gmail.com', 'abc123', '../../assets/images/profile/ferran.png', '0', '2026-01-12 03:00:00'),
(43, 'Rodrigo Hernandez Cascante', 'rodri', 'rodri@gmail.com', 'abc123', '../../assets/images/profile/rodri.png', '0', '2026-01-12 03:00:00'),
(44, 'Tan Jia Wei', 'jiawei', 'jiawei@gmail.com', 'abc123', '../../assets/images/profile/tanjiawei.png', '0', '2026-01-12 03:00:00'),
(45, 'Nur Hanisah van Dyne', 'hanisah', 'hanisah@gmail.com', 'abc123', '../../assets/images/profile/hanisah.png', '0', '2026-01-12 03:00:00'),
(46, 'Muhammad Luqman Podolski', 'luqman', 'luqman@gmail.com', 'abc123', '../../assets/images/profile/luqman.png', '0', '2026-01-12 03:00:00'),
(47, 'Siti Hajar Harb', 'hajar', 'hajar@gmail.com', 'abc123', '../../assets/images/profile/hajar.png', '0', '2026-01-12 03:00:00'),
(48, 'Mohd Asyraf Bin Kane', 'asyraf', 'asyraf@gmail.com', 'abc123', '../../assets/images/profile/asyraf.png', '0', '2026-01-12 03:00:00'),
(49, 'Pau Cubarsi', 'pau', 'pau@gmail.com', 'abc123', '../../assets/images/profile/pau.png', '0', '2026-01-12 03:00:00'),
(50, 'Raj Kumar A/L Muniandy', 'rajkumar', 'rajkumar@gmail.com', 'abc123', '../../assets/images/profile/kumar.png', '0', '2026-01-12 03:00:00'),
(51, 'Sanjna Suri', 'suri', 'suri@gmail.com', 'abc123', '../../assets/images/profile/suri.png', '0', '2026-01-12 03:00:00'),
(52, 'Anthony Nazmi Taylor', 'nazmi', 'nazmi@gmail.com', 'abc123', '../../assets/images/profile/anthony.png', '0', '2026-01-12 03:00:00'),
(53, 'Anna Jobling', 'anna', 'anna@gmail.com', 'abc123', '../../assets/images/profile/jobling.png', '0', '2026-01-12 03:00:00'),
(54, 'Mohd Danial Bin Harun Naim', 'danial', 'danial@gmail.com', 'abc123', '../../assets/images/profile/danialnaim.png', '0', '2026-01-12 03:00:00'),
(55, 'Kylian Mbappe', 'mbappe', 'mbappe@gmail.com', 'abc123', '../../assets/images/profile/mbappe.png', '0', '2026-01-12 03:00:00'),
(56, 'Muhammad Faris Bin Yamal', 'faris', 'faris@gmail.com', 'abc123', '../../assets/images/profile/faris.png', '0', '2026-07-21 08:44:03'),
(57, 'Siti Humaira Brunnhilde', 'humaira', 'humaira@gmail.com', 'abc123', '../../assets/images/profile/humaira.png', '0', '2026-07-21 08:44:03'),
(58, 'Lim Wei Sheng', 'weisheng', 'weisheng@gmail.com', 'abc123', '../../assets/images/profile/limwei.png', '0', '2026-07-21 08:44:03'),
(59, 'Lionel Messi', 'messi', 'messi@gmail.com', 'abc123', '../../assets/images/profile/messi.png', '0', '2026-07-21 08:44:03'),
(60, 'Cristiano Ronaldo', 'ronaldo', 'ronaldo@gmail.com', 'abc123', '../../assets/images/profile/ronaldo.png', '0', '2026-07-21 08:44:03'),
(61, 'Nur Iman Carol Binti Danver', 'nuriman', 'nuriman@gmail.com', 'abc123', '../../assets/images/profile/nuriman.png', '0', '2026-07-21 08:44:03'),
(62, 'Cole Palmer', 'cole', 'cole@gmail.com', 'abc123', '../../assets/images/profile/cole.png', '0', '2026-07-21 08:44:03'),
(63, 'Siti Nur Aina Binti Iskandar', 'ainaiskandar', 'ainaiskandar@gmail.com', 'abc123', '../../assets/images/profile/sitiaina.png', '0', '2026-07-21 08:44:03'),
(64, 'Mohd Hafeez Bin Hamzah', 'hafeez', 'hafeez@gmail.com', 'abc123', '../../assets/images/profile/hafeezhamzah.png', '0', '2026-07-21 08:44:03'),
(65, 'Nur Shazana Binti Karim', 'shazana', 'shazana@gmail.com', 'abc123', '../../assets/images/profile/shazana.png', '0', '2026-07-21 08:44:03'),
(66, 'Muhammad Qayyum Bin Salleh', 'qayyum', 'qayyum@gmail.com', 'abc123', '../../assets/images/profile/qayyumsalleh.jpg', '0', '2026-07-21 08:44:03'),
(67, 'Priscilla Wong Mei Ling', 'priscilla', 'priscilla@gmail.com', 'abc123', '../../assets/images/profile/priscilla.jpg', '0', '2026-07-21 08:44:03');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlistID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlistID`, `studentID`, `ItemID`, `created_at`) VALUES
(8, 1, 2, '2026-07-23 02:35:42'),
(9, 1, 3, '2026-07-23 02:35:43'),
(10, 1, 4, '2026-07-23 02:35:45'),
(11, 1, 5, '2026-07-23 02:35:46'),
(14, 1, 106, '2026-07-23 18:11:54'),
(16, 1, 111, '2026-07-27 21:20:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`auditID`),
  ADD KEY `adminID` (`adminID`);

--
-- Indexes for table `backups`
--
ALTER TABLE `backups`
  ADD PRIMARY KEY (`backupID`);

--
-- Indexes for table `backup_logs`
--
ALTER TABLE `backup_logs`
  ADD PRIMARY KEY (`logID`),
  ADD KEY `backupID` (`backupID`),
  ADD KEY `performedBy` (`performedBy`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `comparisonhistory`
--
ALTER TABLE `comparisonhistory`
  ADD PRIMARY KEY (`historyID`),
  ADD KEY `studentID` (`studentID`),
  ADD KEY `ItemID` (`ItemID`);

--
-- Indexes for table `comparisonstats`
--
ALTER TABLE `comparisonstats`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `forumbookmarks`
--
ALTER TABLE `forumbookmarks`
  ADD PRIMARY KEY (`bookmarkID`),
  ADD UNIQUE KEY `unique_bookmark` (`topicID`,`studentID`),
  ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `forumcategory`
--
ALTER TABLE `forumcategory`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `forumlikes`
--
ALTER TABLE `forumlikes`
  ADD PRIMARY KEY (`likeID`),
  ADD UNIQUE KEY `topicID` (`topicID`,`studentID`),
  ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `forumreply`
--
ALTER TABLE `forumreply`
  ADD PRIMARY KEY (`replyID`),
  ADD KEY `topicID` (`topicID`),
  ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `forumreport`
--
ALTER TABLE `forumreport`
  ADD PRIMARY KEY (`reportID`),
  ADD KEY `topicID` (`topicID`),
  ADD KEY `replyID` (`replyID`),
  ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `forumtopic`
--
ALTER TABLE `forumtopic`
  ADD PRIMARY KEY (`topicID`),
  ADD KEY `studentID` (`studentID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `forumviews`
--
ALTER TABLE `forumviews`
  ADD PRIMARY KEY (`viewID`),
  ADD UNIQUE KEY `topicID` (`topicID`,`studentID`),
  ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`ratingID`),
  ADD KEY `fk_rating_item` (`ItemID`),
  ADD KEY `fk_rating_student` (`studentID`);

--
-- Indexes for table `report_logs`
--
ALTER TABLE `report_logs`
  ADD PRIMARY KEY (`reportID`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`storeID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlistID`),
  ADD UNIQUE KEY `unique_wishlist` (`studentID`,`ItemID`),
  ADD KEY `fk_wishlist_item` (`ItemID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2032;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `auditID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `backups`
--
ALTER TABLE `backups`
  MODIFY `backupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `backup_logs`
--
ALTER TABLE `backup_logs`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `comparisonhistory`
--
ALTER TABLE `comparisonhistory`
  MODIFY `historyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `forumbookmarks`
--
ALTER TABLE `forumbookmarks`
  MODIFY `bookmarkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `forumcategory`
--
ALTER TABLE `forumcategory`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `forumlikes`
--
ALTER TABLE `forumlikes`
  MODIFY `likeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `forumreply`
--
ALTER TABLE `forumreply`
  MODIFY `replyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT for table `forumreport`
--
ALTER TABLE `forumreport`
  MODIFY `reportID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `forumtopic`
--
ALTER TABLE `forumtopic`
  MODIFY `topicID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `forumviews`
--
ALTER TABLE `forumviews`
  MODIFY `viewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `ItemID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `ratingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=501;

--
-- AUTO_INCREMENT for table `report_logs`
--
ALTER TABLE `report_logs`
  MODIFY `reportID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `storeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1015;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_ibfk_1` FOREIGN KEY (`adminID`) REFERENCES `admin` (`adminID`);

--
-- Constraints for table `backup_logs`
--
ALTER TABLE `backup_logs`
  ADD CONSTRAINT `backup_logs_ibfk_1` FOREIGN KEY (`backupID`) REFERENCES `backups` (`backupID`),
  ADD CONSTRAINT `backup_logs_ibfk_2` FOREIGN KEY (`performedBy`) REFERENCES `admin` (`adminID`);

--
-- Constraints for table `comparisonhistory`
--
ALTER TABLE `comparisonhistory`
  ADD CONSTRAINT `comparisonhistory_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE,
  ADD CONSTRAINT `comparisonhistory_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ItemID`) ON DELETE CASCADE;

--
-- Constraints for table `comparisonstats`
--
ALTER TABLE `comparisonstats`
  ADD CONSTRAINT `comparisonstats_ibfk_1` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ItemID`) ON DELETE CASCADE;

--
-- Constraints for table `forumbookmarks`
--
ALTER TABLE `forumbookmarks`
  ADD CONSTRAINT `forumbookmarks_ibfk_1` FOREIGN KEY (`topicID`) REFERENCES `forumtopic` (`topicID`) ON DELETE CASCADE,
  ADD CONSTRAINT `forumbookmarks_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE;

--
-- Constraints for table `forumlikes`
--
ALTER TABLE `forumlikes`
  ADD CONSTRAINT `forumlikes_ibfk_1` FOREIGN KEY (`topicID`) REFERENCES `forumtopic` (`topicID`) ON DELETE CASCADE,
  ADD CONSTRAINT `forumlikes_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE;

--
-- Constraints for table `forumreply`
--
ALTER TABLE `forumreply`
  ADD CONSTRAINT `forumreply_ibfk_1` FOREIGN KEY (`topicID`) REFERENCES `forumtopic` (`topicID`) ON DELETE CASCADE,
  ADD CONSTRAINT `forumreply_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`);

--
-- Constraints for table `forumreport`
--
ALTER TABLE `forumreport`
  ADD CONSTRAINT `forumreport_ibfk_1` FOREIGN KEY (`topicID`) REFERENCES `forumtopic` (`topicID`),
  ADD CONSTRAINT `forumreport_ibfk_2` FOREIGN KEY (`replyID`) REFERENCES `forumreply` (`replyID`),
  ADD CONSTRAINT `forumreport_ibfk_3` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`);

--
-- Constraints for table `forumtopic`
--
ALTER TABLE `forumtopic`
  ADD CONSTRAINT `forumtopic_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`),
  ADD CONSTRAINT `forumtopic_ibfk_2` FOREIGN KEY (`categoryID`) REFERENCES `forumcategory` (`categoryID`);

--
-- Constraints for table `forumviews`
--
ALTER TABLE `forumviews`
  ADD CONSTRAINT `forumviews_ibfk_1` FOREIGN KEY (`topicID`) REFERENCES `forumtopic` (`topicID`) ON DELETE CASCADE,
  ADD CONSTRAINT `forumviews_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `fk_rating_item` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ItemID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rating_student` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `fk_wishlist_item` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ItemID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_wishlist_student` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
