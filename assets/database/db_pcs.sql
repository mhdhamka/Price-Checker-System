-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2026 at 01:14 PM
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
-- Table structure for table `aboutus`
--

CREATE TABLE `aboutus` (
  `aboutusID` int(11) NOT NULL,
  `aboutusName` varchar(255) NOT NULL,
  `aboutusCourse` varchar(255) NOT NULL,
  `aboutusDetails` varchar(255) NOT NULL,
  `aboutusIMG` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aboutus`
--

INSERT INTO `aboutus` (`aboutusID`, `aboutusName`, `aboutusCourse`, `aboutusDetails`, `aboutusIMG`) VALUES
(1, 'Mohammad Hamka Izzuddin Bin Mohamad Yahya', 'Final Year Project (FYP) student', 'A Final Year Project is a mandatory task for bachelor\'s degree students in their final year. It demonstrates their application of knowledge and skills, often involving research or software development.', '../../assets/images/hamka.jpg');

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
  `logStatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminFullname`, `adminUsername`, `adminEmail`, `adminPassword`, `adminIMG`, `logStatus`) VALUES
(1, 'MOHAMMAD HAMKA IZZUDDIN BIN MOHAMAD YAHYA', 'mdhamka', 'm.hamka017@gmail.com', 'abc123', 'assets/images/hamka.jpg', '0');

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
(1, 'Beverages', '../../assets/images/beverages.jpeg'),
(2, 'Biscuits', '../../assets/images/biscuit.jpg'),
(3, 'Noodles', '../../assets/images/noodles.jpeg');

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
  `ItemImage` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ItemID`, `ItemName`, `ItemPrice`, `ItemCategory`, `ItemDescription`, `StoreName`, `ItemImage`) VALUES
(1, 'Nescafe 3-in-1 Original', 13.90, 'Beverages', 'Instant coffee mix with rich coffee flavour.', 'e-Mart Summer Mall', '../../assets/images/noriginal.png'),
(2, 'Hup Seng Cream Crackers', 5.20, 'Biscuits', 'Crispy crackers suitable for snacks and meals.', 'e-Mart Summer Mall', '../../assets/images/hupseng.png'),
(3, 'Maggi Curry Noodles', 4.90, 'Noodles', 'Instant noodles with delicious curry flavour.', 'H&L Aiman Mall', '../../assets/images/maggi2.png'),
(4, 'Jacob\'s Cream Crackers', 11.50, 'Biscuits', 'Crunchy cream crackers in multipack packaging.', 'e-Mart Summer Mall', '../../assets/images/jacobs.png'),
(5, 'Milo Chocolate Drink', 18.99, 'Beverages', 'Chocolate malt drink rich in energy and nutrients.', 'H&L Aiman Mall', '../../assets/images/milo.png'),
(6, 'Maggi Asam Laksa Noodles', 5.50, 'Noodles', 'Instant noodles with spicy and sour laksa flavour.', 'e-Mart Summer Mall', '../../assets/images/asamlaksa1.png'),
(7, 'Maggi Asam Laksa Noodles', 4.99, 'Noodles', 'Quick noodles with authentic Asam Laksa taste.', 'H&L Aiman Mall', '../../assets/images/asamlaksa2.png'),
(8, 'Milo Powder Drink', 20.90, 'Beverages', 'Chocolate malt beverage for everyday enjoyment.', 'e-Mart Summer Mall', '../../assets/images/miloe.png'),
(9, 'Maggi Curry Noodles', 4.50, 'Noodles', 'Springy noodles with rich curry seasoning.', 'e-Mart Summer Mall', '../../assets/images/maggi.jpg'),
(10, 'Nescafe 3-in-1 Original', 13.99, 'Beverages', 'Convenient instant coffee with creamy taste.', 'H&L Aiman Mall', '../../assets/images/nescafe3in1.png'),
(11, 'Nescafe Classic Coffee', 23.15, 'Beverages', 'Premium instant coffee with rich aroma.', 'H&L Aiman Mall', '../../assets/images/nclassic.jpg'),
(12, 'Munchy\'s Cream Crackers', 5.10, 'Biscuits', 'Light and crispy crackers for snacking.', 'e-Mart Summer Mall', '../../assets/images/munchy.png'),
(13, 'Mi Sedaap Instant Noodles', 5.20, 'Noodles', 'Tasty noodles with rich seasoning flavour.', 'H&L Aiman Mall', '../../assets/images/misedap2.png'),
(14, 'Sun Valley Grenadine Syrup', 12.50, 'Beverages', 'Sweet grenadine syrup for refreshing drinks.', 'H&L Aiman Mall', '../../assets/images/sunvalley2.png'),
(15, 'BOH 3-in-1 Tea Mix', 14.90, 'Beverages', 'Instant tea mix with convenient preparation.', 'e-Mart Summer Mall', '../../assets/images/boh.png'),
(16, 'Mi Sedap', 4.90, 'Noodles', 'Mi Sedap instant noodles are known for their variety of delicious flavors, unique seasoning packets, firm texture, and quick, easy preparation.', 'e-Mart Summer Mall', '../../assets/images/misedap.png'),
(17, 'Sun Valley Grenadine Syrup', 10.90, 'Beverages', 'Sweet and refreshing drink syrup.', 'e-Mart Summer Mall', '../../assets/images/sunvalley.png'),
(18, 'BOH 3-in-1 Tea Mix', 23.15, 'Beverages', 'Instant tea beverage pack for daily use.', 'H&L Aiman Mall', '../../assets/images/boh.png'),
(19, 'Hup Seng Cream Crackers', 5.80, 'Biscuits', 'Crunchy crackers with classic taste.', 'H&L Aiman Mall', '../../assets/images/hupseng2.png'),
(20, 'Jacob\'s Cream Crackers', 11.00, 'Biscuits', 'Classic crispy crackers in multipack size.', 'H&L Aiman Mall', '../../assets/images/jacobs2.png'),
(21, '100PLUS Original', 4.20, 'Beverages', 'Refreshing isotonic drink for hydration.', 'e-Mart Summer Mall', '../../assets/images/100plus.png'),
(22, 'Munchy\'s Cream Crackers', 5.20, 'Biscuits', 'Crispy biscuits for snacks anytime.', 'H&L Aiman Mall', '../../assets/images/munchy2.png'),
(23, '100PLUS Original', 3.90, 'Beverages', 'Refreshing isotonic beverage with electrolytes.', 'H&L Aiman Mall', '../../assets/images/100plus2.png'),
(24, 'Nescafe Classic Coffee', 22.70, 'Beverages', 'Aromatic instant coffee with smooth flavour.', 'e-Mart Summer Mall', '../../assets/images/nclassic2.png'),
(25, 'BOH 3-in-1 Tea Mix', 16.60, 'Beverages', 'Convenient instant tea with balanced flavour.', 'H&L Aiman Mall', '../../assets/images/boh2.png');

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
(1, 'e-Mart Summer Mall', 'Offers a variety of electronics, appliances, fashion, beauty products, and groceries with competitive prices and convenient shopping.', '../../assets/images/emart.jpg'),
(2, 'H&L Aiman Mall', 'Provides fresh produce, groceries, and household items with quality products at affordable prices and a comfortable shopping experience.', '../../assets/images/hnl.jpg');

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
  `logStatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `fullName`, `username`, `email`, `password`, `studentIMG`, `logStatus`) VALUES
(1, 'Faizatul Fitri Bin Boestamam', 'fai', 'fai@gmail.com', 'abc123', '../../assets/images/profile/fai.jpg', '0'),
(2, 'Mohammad Amir Alam Bin Rahim Omar', 'amiromar', 'amir@gmail.com', 'abc123', '../../assets/images/profile/amir.jpg', '0'),
(3, 'Harith Zakwan Bin Zakaria', 'harith', 'harith@gmail.com', 'abc123', '../../assets/images/profile/harith.jpg', '0'),
(4, 'Mohamad Waqiuddin Bin Yahya', 'qiu', 'qiu@gmail.com', 'abc123', '../../assets/images/profile/qiu.jpeg', '0'),
(5, 'Iman Tarmizi Rosalina', 'iman', 'iman@gmail.com', 'abc123', '../../assets/images/profile/iman.jpg', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutus`
--
ALTER TABLE `aboutus`
  ADD PRIMARY KEY (`aboutusID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ItemID`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutus`
--
ALTER TABLE `aboutus`
  MODIFY `aboutusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `storeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1012;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
