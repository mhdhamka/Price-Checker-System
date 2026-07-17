-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2024 at 06:31 AM
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
(1, 'Mohammad Hamka Izzuddin Bin Mohamad Yahya', 'Final Year Project (FYP) student', 'A Final Year Project is a mandatory task for bachelor\'s degree students in their final year. It demonstrates their application of knowledge and skills, often involving research or software development.', 'assets/images/hamka.jpg');

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
(1, 'Beverages', 'assets/images/beverages.jpeg'),
(2, 'Biscuits', 'assets/images/biscuit.jpg'),
(3, 'Noodles', 'assets/images/noodles.jpeg');

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
(1, 'Nescafe 3 in1 Original', 13.90, 'Beverages', 'Nescafe 3 in 1 Original is an instant coffee mix that blends coffee, sugar, and creamer in a single packet for a rich and creamy coffee experience with balanced sweetness.', 'e-Mart Summer Mall', 'assets/images/noriginal.png'),
(2, 'Hup Seng Cream Cracker', 5.20, 'Biscuits', 'Hup Seng Cream Crackers are crispy, square-shaped biscuits with a delightful buttery taste, ideal for snacking or pairing with various toppings.', 'e-Mart Summer Mall', 'assets/images/hupseng.png'),
(3, 'Maggi Mee Curry', 4.90, 'Noodles', 'Maggi Mee Curry offers springy noodles in a flavorful curry broth, infused with traditional spices for a quick and satisfying meal with a spicy twist.', 'H&L Aiman Mall', 'assets/images/maggi2.png'),
(4, 'Kraft Jacob\'s Multipack Original Cream Crackers 600g', 11.50, 'Biscuits', 'Jacob\'s biscuits are known for their crunchy texture and wholesome flavor, crafted with high-quality ingredients for a nutritious snack option.', 'e-Mart Summer Mall', 'assets/images/jacobs.png'),
(5, 'Nestle Milo ', 18.99, 'Beverages', 'Nestle Milo Refill 1 kg is a delicious, chocolate malt drink mix enriched with vitamins and minerals, providing sustained energy and essential nutrients.', 'H&L Aiman Mall', 'assets/images/milo.png'),
(6, 'Maggi Asam Laksa ', 5.50, 'Noodles', 'Maggi Asam Laksa is a quick and convenient instant noodle meal featuring the tangy and spicy flavors of traditional Malaysian Asam Laksa, combining savory broth with fish and tamarind flavors, noodles, and a blend of authentic spices.', 'e-Mart Summer Mall', 'assets/images/asamlaksa1.png'),
(7, 'Maggi Asam Laksa', 4.99, 'Noodles', 'Maggi Asam Laksa is an instant noodle dish that offers the authentic, tangy, and spicy taste of Malaysian Asam Laksa, featuring a rich fish-based broth with tamarind and traditional spices for a flavorful and convenient meal.', 'H&L Aiman Mall', 'assets/images/asamlaksa2.png'),
(8, 'Nestle Milo ', 20.90, 'Beverages', 'Nestle Milo Drink is a powdered beverage rich in vitamins and minerals, providing sustained energy and a delicious chocolate malt flavor, perfect for enjoying hot or cold.', 'e-Mart Summer Mall', 'assets/images/miloe.png'),
(9, 'Maggi Mee Curry', 4.50, 'Noodles', 'Maggi Mee Curry features springy noodles in a rich curry-flavored broth, enhanced with a blend of traditional spices for a quick and flavorful meal with a spicy kick.', 'e-Mart Summer Mall', 'assets/images/maggi.jpg'),
(10, 'Nescafe 3 in 1 Original', 13.99, 'Beverages', 'Nescafe 3 in 1 Original is an instant coffee mix that combines rich coffee, creamy milk, and the right amount of sugar, providing a perfectly balanced and smooth coffee experience in every cup.', 'H&L Aiman Mall', 'assets/images/nescafe3in1.png'),
(11, 'Nescafe Classic', 23.15, 'Beverages', 'Nescafe Classic is a premium instant coffee made from carefully selected roasted coffee beans, delivering a rich, full-bodied flavor and invigorating aroma in every cup.', 'H&L Aiman Mall', 'assets/images/nclassic.jpg'),
(12, 'Munchy\'s Cream Crackers', 5.10, 'Biscuits', 'Munchy\'s Cream Crackers are thin, crispy, square-shaped crackers enjoyed plain or with toppings, known for their versatile flavor and texture.', 'e-Mart Summer Mall', 'assets/images/munchy.png'),
(13, 'Mi Sedap', 5.20, 'Noodles', 'Mi Sedap instant noodles are known for their variety of delicious flavors, unique seasoning packets, firm texture, and quick, easy preparation.', 'H&L Aiman Mall', 'assets/images/misedap2.png'),
(14, 'F&N Sun Valley Grenadine 2L', 12.50, 'Beverages', 'Sunvalley Grenadine syrup is a sweet and tangy flavoring made from pomegranate juice, perfect for adding a fruity twist to various beverages.', 'H&L Aiman Mall', 'assets/images/sunvalley2.png'),
(15, 'BOH 3 in 1 Original Instant Tea Mix 30pcs x 20g', 14.90, 'Beverages', 'BOH 3 in 1 Original is a convenient instant beverage combining BOH tea, sugar, and creamer for a rich, creamy, and satisfying tea experience.', 'e-Mart Summer Mall', 'assets/images/boh.png'),
(16, 'Mi Sedap', 4.90, 'Noodles', 'Mi Sedap instant noodles are known for their variety of delicious flavors, unique seasoning packets, firm texture, and quick, easy preparation.', 'e-Mart Summer Mall', 'assets/images/misedap.png'),
(17, 'F&N Sun Valley Grenadine 2L', 10.90, 'Beverages', 'Sunvalley Grenadine syrup is a sweet and tangy flavoring made from pomegranate juice, perfect for adding a fruity twist to various beverages.', 'e-Mart Summer Mall', 'assets/images/sunvalley.png'),
(18, 'BOH 3 in 1 Original Instant Tea Mix 30pcs x 20g', 23.15, 'Beverages', 'BOH 3 in 1 Original is a convenient instant beverage combining BOH tea, sugar, and creamer for a rich, creamy, and satisfying tea experience.', 'H&L Aiman Mall', 'assets/images/boh.png'),
(19, 'Hup Seng Cream Cracker', 5.80, 'Biscuits', 'Hup Seng Cream Crackers offer a crunchy texture and rich buttery flavor, perfect for enjoying on their own or complementing with spreads.', 'H&L Aiman Mall', 'assets/images/hupseng2.png'),
(20, 'Kraft Jacob\'s Multipack Original Cream Crackers 600g', 11.00, 'Biscuits', 'Jacob\'s biscuits are famous for their crisp texture and rich taste, made with premium ingredients to provide a healthy and tasty snack choice.', 'H&L Aiman Mall', 'assets/images/jacobs2.png'),
(21, '100 plus Original', 4.20, 'Beverages', '100 Plus Original is a refreshing isotonic drink that helps rehydrate and replenish essential electrolytes lost during physical activity, providing a crisp and refreshing taste.', 'e-Mart Summer Mall', 'assets/images/100plus.png'),
(22, 'Munchy\'s Cream Crackers', 5.20, 'Biscuits', 'Munchy\'s Cream Crackers are light, crispy biscuits with a mild, buttery flavor, perfect for snacking or pairing with your favorite toppings.', 'H&L Aiman Mall', 'assets/images/munchy2.png'),
(23, '100 plus', 3.90, 'Beverages', '100 Plus Original is a refreshing isotonic drink that helps replenish lost fluids and electrolytes, providing quick hydration and energy.', 'H&L Aiman Mall', 'assets/images/100plus2.png'),
(24, 'Nescafe Classic', 22.70, 'Beverages', 'Nescafe Classic is a rich and aromatic instant coffee made from quality coffee beans, offering a smooth and satisfying coffee experience.', 'e-Mart Summer Mall', 'assets/images/nclassic2.png'),
(25, 'BOH 3 in 1 Original Instant Tea Mix ', 16.60, 'Beverages', 'BOH 3 in 1 Original Instant Tea Mix is a convenient blend of tea, sugar, and creamer, delivering a rich and creamy tea experience in every cup.', 'H&L Aiman Mall', 'assets/images/boh2.png');

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
(1, 'e-Mart Summer Mall', 'e-Mart offers a wide selection of electronics, home appliances, fashion, beauty products, and groceries, featuring a user-friendly interface, secure payments, competitive prices, and dedicated customer service.', 'assets/images/emart.jpg'),
(2, 'H&L Aiman Mall', 'H&L Supermarket offers a wide range of products, including fresh produce, groceries, and household items, ensuring high-quality products at competitive prices and a comfortable shopping experience.', 'assets/images/hnl.jpg');

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
(7, 'Faizatul Fitri Bin Boestamam', 'fai', 'fai@gmail.com', 'abc123', 'assets/images/fai.jpg', '0'),
(1006, 'Taufiq Syahid Bin Ibrahim', 'pikkskurt', 'taufiq@gmail.com', 'abc123', 'assets/images/fai.jpg', '0'),
(1007, 'Mohammad Amir Alam Bin Rahim Omar', 'amiromar', 'amir@gmail.com', 'abc123', 'assets/images/amir.jpg', '0'),
(1008, 'Harith Zakwan Bin Zakaria', 'harith', 'harith@gmail.com', 'abc123', 'assets/images/harith.jpg', '0'),
(1009, 'Mohamad Waqiuddin Bin Yahya', 'qiu', 'qiu@gmail.com', 'abc123', 'assets/images/qiu.jpeg', '0'),
(1010, 'Iman Tarmizi Rosalina', 'iman', 'iman@gmail.com', 'abc123', 'assets/images/iman.jpg', '0');

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
