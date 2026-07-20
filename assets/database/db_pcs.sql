-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2026 at 05:46 PM
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
  `logStatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminFullname`, `adminUsername`, `adminEmail`, `adminPassword`, `adminIMG`, `logStatus`) VALUES
(1, 'MOHD HAMKA', 'mdhamka', 'm.hamka017@gmail.com', 'abc123', '../../assets/images/profile/hamka.jpg', '1');

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
(2, 'Biscuits', '../../assets/images/biscuit.jpg'),
(3, 'Noodles', '../../assets/images/noodles.jpeg'),
(4, 'Snacks', '../../assets/images/category/snacks.jpg'),
(5, 'Dairy Products', '../../assets/images/category/dairy.png'),
(6, 'Frozen Foods', '../../assets/images/category/frozen-foods.png'),
(7, 'Bread & Bakery', '../../assets/images/category/bakery.jpg'),
(8, 'Canned Foods', '../../assets/images/category/canned-foods.jpg'),
(9, 'Confectionery', '../../assets/images/category/confectionery.png');

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
(1, 'Nescafe 3-in-1 Original', 13.90, 'Beverages', 'Instant coffee mix with rich coffee flavour.', 'e-Mart Summer Mall', '../../assets/images/item/noriginal.png'),
(2, 'Hup Seng Cream Crackers', 5.20, 'Biscuits', 'Crispy crackers suitable for snacks and meals.', 'e-Mart Summer Mall', '../../assets/images/item/hupseng.png'),
(3, 'Maggi Curry Noodles', 4.90, 'Noodles', 'Instant noodles with delicious curry flavour.', 'H&L Aiman Mall', '../../assets/images/item/maggi2.png'),
(4, 'Jacob\'s Cream Crackers', 11.50, 'Biscuits', 'Crunchy cream crackers in multipack packaging.', 'e-Mart Summer Mall', '../../assets/images/item/jacobs.png'),
(5, 'Milo Chocolate Drink', 18.99, 'Beverages', 'Chocolate malt drink rich in energy and nutrients.', 'H&L Aiman Mall', '../../assets/images/item/milo.png'),
(6, 'Maggi Asam Laksa Noodles', 5.50, 'Noodles', 'Instant noodles with spicy and sour laksa flavour.', 'e-Mart Summer Mall', '../../assets/images/item/asamlaksa1.png'),
(7, 'Maggi Asam Laksa Noodles', 4.99, 'Noodles', 'Quick noodles with authentic Asam Laksa taste.', 'H&L Aiman Mall', '../../assets/images/item/asamlaksa2.png'),
(8, 'Milo Powder Drink', 20.90, 'Beverages', 'Chocolate malt beverage for everyday enjoyment.', 'e-Mart Summer Mall', '../../assets/images/item/miloe.png'),
(9, 'Maggi Curry Noodles', 4.50, 'Noodles', 'Springy noodles with rich curry seasoning.', 'e-Mart Summer Mall', '../../assets/images/item/maggi.jpg'),
(10, 'Nescafe 3-in-1 Original', 13.99, 'Beverages', 'Convenient instant coffee with creamy taste.', 'H&L Aiman Mall', '../../assets/images/item/nescafe3in1.png'),
(11, 'Nescafe Classic Coffee', 23.15, 'Beverages', 'Premium instant coffee with rich aroma.', 'H&L Aiman Mall', '../../assets/images/item/nclassic.jpg'),
(12, 'Munchy\'s Cream Crackers', 5.10, 'Biscuits', 'Light and crispy crackers for snacking.', 'e-Mart Summer Mall', '../../assets/images/item/munchy.png'),
(13, 'Mi Sedaap Instant Noodles', 5.20, 'Noodles', 'Tasty noodles with rich seasoning flavour.', 'H&L Aiman Mall', '../../assets/images/item/misedap2.png'),
(14, 'Sun Valley Grenadine Syrup', 12.50, 'Beverages', 'Sweet grenadine syrup for refreshing drinks.', 'H&L Aiman Mall', '../../assets/images/item/sunvalley2.png'),
(15, 'BOH 3-in-1 Tea Mix', 14.90, 'Beverages', 'Instant tea mix with convenient preparation.', 'e-Mart Summer Mall', '../../assets/images/item/boh.png'),
(16, 'Mi Sedap', 4.90, 'Noodles', 'Mi Sedap instant noodles are known for their variety of delicious flavors, unique seasoning packets, firm texture, and quick, easy preparation.', 'e-Mart Summer Mall', '../../assets/images/item/misedap.png'),
(17, 'Sun Valley Grenadine Syrup', 10.90, 'Beverages', 'Sweet and refreshing drink syrup.', 'e-Mart Summer Mall', '../../assets/images/item/sunvalley.png'),
(18, 'BOH 3-in-1 Tea Mix', 23.15, 'Beverages', 'Instant tea beverage pack for daily use.', 'H&L Aiman Mall', '../../assets/images/item/boh.png'),
(19, 'Hup Seng Cream Crackers', 5.80, 'Biscuits', 'Crunchy crackers with classic taste.', 'H&L Aiman Mall', '../../assets/images/item/hupseng2.png'),
(20, 'Jacob\'s Cream Crackers', 11.00, 'Biscuits', 'Classic crispy crackers in multipack size.', 'H&L Aiman Mall', '../../assets/images/item/jacobs2.png'),
(21, '100PLUS Original', 4.20, 'Beverages', 'Refreshing isotonic drink for hydration.', 'e-Mart Summer Mall', '../../assets/images/item/100plus.png'),
(22, 'Munchy\'s Cream Crackers', 5.20, 'Biscuits', 'Crispy biscuits for snacks anytime.', 'H&L Aiman Mall', '../../assets/images/item/munchy2.png'),
(23, '100PLUS Original', 3.90, 'Beverages', 'Refreshing isotonic beverage with electrolytes.', 'H&L Aiman Mall', '../../assets/images/item/100plus2.png'),
(24, 'Nescafe Classic Coffee', 22.70, 'Beverages', 'Aromatic instant coffee with smooth flavour.', 'e-Mart Summer Mall', '../../assets/images/item/nclassic2.png'),
(25, 'BOH 3-in-1 Tea Mix', 16.60, 'Beverages', 'Convenient instant tea with balanced flavour.', 'H&L Aiman Mall', '../../assets/images/item/boh2.png'),
(26, 'Gardenia Original Classic Bread', 3.80, 'Bread & Bakery', 'Soft and fresh white bread suitable for breakfast and sandwiches.', 'Everrise Express', '../../assets/images/item/gardenia.png'),
(27, 'Dutch Lady Full Cream Milk 1L', 8.90, 'Dairy Products', 'Fresh full cream milk rich in calcium and vitamins.', 'Farley Supermarket', '../../assets/images/item/dutchlady.png'),
(28, 'Farm Fresh Fresh Milk', 9.50, 'Dairy Products', 'Pasteurized fresh milk with a creamy taste.', 'Choice Daily', '../../assets/images/item/farmfresh.png'),
(29, 'Ayamas Chicken Nuggets', 14.90, 'Frozen Foods', 'Frozen chicken nuggets perfect for quick meals.', 'Emart Express', '../../assets/images/item/nuggets.png'),
(30, 'Mister Potato Original Chips', 4.20, 'Snacks', 'Crunchy potato chips with classic original flavour.', '99 Speedmart', '../../assets/images/item/misterpotato.png'),
(31, 'Pringles Sour Cream & Onion', 8.90, 'Snacks', 'Imported potato crisps with sour cream and onion seasoning.', 'Servay Supermarket', '../../assets/images/item/pringles.png'),
(32, 'Ayam Brand Sardines in Tomato Sauce', 8.50, 'Canned Foods', 'Premium canned sardines in rich tomato sauce.', 'KK Super Mart', '../../assets/images/item/sardines.png'),
(33, 'Gardenia Butterscotch Bread', 12.90, 'Bread & Bakery', 'Soft butterscotch-flavoured bread suitable for breakfast and tea time.', 'Unaco Superstore', '../../assets/images/item/gardenia-butterscotch.png'),
(34, 'Cadbury Dairy Milk Chocolate', 5.50, 'Confectionery', 'Smooth milk chocolate bar made with fresh milk.', '7-Eleven', '../../assets/images/item/cadbury.png'),
(35, 'Kinder Bueno Chocolate', 6.80, 'Confectionery', 'Crispy wafer filled with hazelnut cream and covered in chocolate.', 'myNEWS', '../../assets/images/item/kinderbueno.png'),
(36, 'Oreo Original Cookies', 5.90, 'Biscuits', 'Classic chocolate sandwich cookies with vanilla cream filling.', 'Orange Convenience Store', '../../assets/images/item/oreo.png'),
(37, 'Coca-Cola 1.5L', 4.80, 'Beverages', 'Refreshing carbonated soft drink perfect for sharing.', 'Happy Farm Fresh Mart', '../../assets/images/item/cocacola.png'),
(38, 'Indomie Mi Goreng', 5.80, 'Noodles', 'Popular instant fried noodles with authentic Indonesian flavour.', 'Choice Super Mall Samariang', '../../assets/images/item/indomie.png'),
(39, 'Mamee Monster BBQ', 2.20, 'Snacks', 'Crunchy noodle snack with smoky BBQ flavour.', 'Ninso Kota Samarahan', '../../assets/images/item/mamee.png'),
(40, 'Marigold Peel Fresh Orange Juice', 7.90, 'Beverages', 'Refreshing orange juice made from quality oranges.', 'Jaya Grocer Express', '../../assets/images/item/peelfresh.png'),
(41, 'Nescafe 3-in-1 Original', 13.50, 'Beverages', 'Instant coffee mix with rich coffee flavour.', 'Everrise Express', '../../assets/images/item/noriginal.png'),
(42, 'Milo Chocolate Drink', 18.50, 'Beverages', 'Chocolate malt drink rich in energy and nutrients.', 'Farley Supermarket', '../../assets/images/item/milo.png'),
(43, '100PLUS Original', 4.10, 'Beverages', 'Refreshing isotonic drink for hydration.', 'Choice Daily', '../../assets/images/item/100plus.png'),
(44, 'Maggi Curry Noodles', 4.80, 'Noodles', 'Instant noodles with delicious curry flavour.', '99 Speedmart', '../../assets/images/item/maggi2.png'),
(45, 'Mi Sedaap Instant Noodles', 5.10, 'Noodles', 'Tasty noodles with rich seasoning flavour.', 'Servay Hypermarket', '../../assets/images/item/misedap2.png'),
(46, 'Jacob\'s Cream Crackers', 10.80, 'Biscuits', 'Classic crispy crackers in multipack packaging.', 'KK Super Mart', '../../assets/images/item/jacobs.png'),
(47, 'Hup Seng Cream Crackers', 5.40, 'Biscuits', 'Crunchy crackers suitable for snacks and meals.', 'Unaco Superstore', '../../assets/images/item/hupseng.png'),
(48, 'Gardenia Original Classic Bread', 3.60, 'Bread & Bakery', 'Soft and fresh white bread suitable for breakfast and sandwiches.', 'Happy Farm Fresh Mart', '../../assets/images/item/gardenia.png'),
(49, 'Gardenia Butterscotch Bread', 4.20, 'Bread & Bakery', 'Soft butterscotch-flavoured bread suitable for breakfast and tea time.', 'Choice Super Mall Samariang', '../../assets/images/item/gardenia-butterscotch.png'),
(50, 'Dutch Lady Full Cream Milk 1L', 8.70, 'Dairy Products', 'Fresh full cream milk rich in calcium and vitamins.', 'Jaya Grocer Express', '../../assets/images/item/dutchlady.png'),
(51, 'Farm Fresh Fresh Milk', 9.20, 'Dairy Products', 'Pasteurized fresh milk with a creamy taste.', 'Everrise Express', '../../assets/images/item/farmfresh.png'),
(52, 'Ayamas Chicken Nuggets', 14.50, 'Frozen Foods', 'Frozen chicken nuggets perfect for quick meals.', 'Servay Hypermarket', '../../assets/images/item/nuggets.png'),
(53, 'Cadbury Dairy Milk Chocolate', 5.30, 'Confectionery', 'Smooth milk chocolate bar made with fresh milk.', '99 Speedmart', '../../assets/images/item/cadbury.png'),
(54, 'Kinder Bueno Chocolate', 6.50, 'Confectionery', 'Crispy wafer filled with hazelnut cream and covered in chocolate.', '7-Eleven', '../../assets/images/item/kinderbueno.png'),
(55, 'Pringles Sour Cream & Onion', 8.70, 'Snacks', 'Imported potato crisps with sour cream and onion seasoning.', 'Choice Daily', '../../assets/images/item/pringles.png'),
(56, 'Mister Potato Original Chips', 3.90, 'Snacks', 'Crunchy potato chips with classic original flavour.', 'Orange Convenience Store', '../../assets/images/item/misterpotato.png'),
(57, 'Mamee Monster BBQ', 2.00, 'Snacks', 'Crunchy noodle snack with smoky BBQ flavour.', 'myNEWS', '../../assets/images/item/mamee.png'),
(58, 'Ayam Brand Sardines in Tomato Sauce', 8.20, 'Canned Foods', 'Premium canned sardines in rich tomato sauce.', 'Farley Supermarket', '../../assets/images/item/sardines.png'),
(59, 'Marigold Peel Fresh Orange Juice', 7.60, 'Beverages', 'Refreshing orange juice made from quality oranges.', 'Unaco Superstore', '../../assets/images/item/peelfresh.png'),
(60, 'Sun Valley Grenadine Syrup', 11.90, 'Beverages', 'Sweet grenadine syrup for refreshing drinks.', 'Jaya Grocer Express', '../../assets/images/item/sunvalley.png'),
(61, 'BOH 3-in-1 Tea Mix', 15.20, 'Beverages', 'Instant tea mix with convenient preparation.', 'Everrise Express', '../../assets/images/item/boh.png'),
(62, 'Nescafe Classic Coffee', 22.90, 'Beverages', 'Premium instant coffee with rich aroma.', 'Farley Supermarket', '../../assets/images/item/nclassic.jpg'),
(63, 'Coca-Cola 1.5L', 4.60, 'Beverages', 'Refreshing carbonated soft drink perfect for sharing.', '99 Speedmart', '../../assets/images/item/cocacola.png'),
(64, 'Milo Powder Drink', 20.50, 'Beverages', 'Chocolate malt beverage for everyday enjoyment.', 'Choice Super Mall Samariang', '../../assets/images/item/miloe.png'),
(65, '100PLUS Original', 3.80, 'Beverages', 'Refreshing isotonic beverage with electrolytes.', 'Emart Express', '../../assets/images/item/100plus2.png'),
(66, 'Maggi Asam Laksa Noodles', 5.20, 'Noodles', 'Instant noodles with spicy and sour laksa flavour.', 'Everrise Express', '../../assets/images/item/asamlaksa1.png'),
(67, 'Maggi Curry Noodles', 4.70, 'Noodles', 'Springy noodles with rich curry seasoning.', 'Choice Daily', '../../assets/images/item/maggi.jpg'),
(68, 'Mi Sedap', 4.80, 'Noodles', 'Mi Sedap instant noodles are known for their delicious flavours.', 'Jaya Grocer Express', '../../assets/images/item/misedap.png'),
(69, 'Indomie Mi Goreng', 5.50, 'Noodles', 'Popular instant fried noodles with authentic Indonesian flavour.', '99 Speedmart', '../../assets/images/item/indomie.png'),
(70, 'Munchy\'s Cream Crackers', 5.00, 'Biscuits', 'Light and crispy crackers for snacking.', 'Everrise Express', '../../assets/images/item/munchy.png'),
(71, 'Jacob\'s Cream Crackers', 11.20, 'Biscuits', 'Crunchy cream crackers in multipack packaging.', 'Farley Supermarket', '../../assets/images/item/jacobs2.png'),
(72, 'Oreo Original Cookies', 5.70, 'Biscuits', 'Classic chocolate sandwich cookies with vanilla cream filling.', 'Choice Daily', '../../assets/images/item/oreo.png'),
(73, 'Pringles Sour Cream & Onion', 8.60, 'Snacks', 'Imported potato crisps with sour cream and onion seasoning.', '7-Eleven', '../../assets/images/item/pringles.png'),
(74, 'Mister Potato Original Chips', 4.00, 'Snacks', 'Crunchy potato chips with classic original flavour.', 'myNEWS', '../../assets/images/item/misterpotato.png'),
(75, 'Mamee Monster BBQ', 2.10, 'Snacks', 'Crunchy noodle snack with smoky BBQ flavour.', 'Orange Convenience Store', '../../assets/images/item/mamee.png'),
(76, 'Farm Fresh Fresh Milk', 9.30, 'Dairy Products', 'Pasteurized fresh milk with a creamy taste.', 'Happy Farm Fresh Mart', '../../assets/images/item/farmfresh.png'),
(77, 'Gardenia Original Classic Bread', 3.70, 'Bread & Bakery', 'Soft and fresh white bread suitable for breakfast and sandwiches.', 'Farley Supermarket', '../../assets/images/item/gardenia.png'),
(78, 'Ayamas Chicken Nuggets', 14.70, 'Frozen Foods', 'Frozen chicken nuggets perfect for quick meals.', 'Unaco Superstore', '../../assets/images/item/nuggets.png'),
(79, 'Cadbury Dairy Milk Chocolate', 5.40, 'Confectionery', 'Smooth milk chocolate bar made with fresh milk.', 'Ninso Kota Samarahan', '../../assets/images/item/cadbury.png'),
(80, 'Ayam Brand Sardines in Tomato Sauce', 8.40, 'Canned Foods', 'Premium canned sardines in rich tomato sauce.', 'Choice Super Mall Samariang', '../../assets/images/item/sardines.png'),
(81, 'Nescafe 3-in-1 Original', 13.70, 'Beverages', 'Instant coffee mix with rich coffee flavour.', 'Servay Hypermarket', '../../assets/images/item/noriginal.png'),
(82, 'Milo Chocolate Drink', 19.20, 'Beverages', 'Chocolate malt drink rich in energy and nutrients.', 'Unaco Superstore', '../../assets/images/item/milo.png'),
(83, 'Marigold Peel Fresh Orange Juice', 8.10, 'Beverages', 'Refreshing orange juice made from quality oranges.', 'Choice Daily', '../../assets/images/item/peelfresh.png'),
(84, 'Sun Valley Grenadine Syrup', 11.50, 'Beverages', 'Sweet and refreshing drink syrup.', '99 Speedmart', '../../assets/images/item/sunvalley.png'),
(85, '100PLUS Original', 4.00, 'Beverages', 'Refreshing isotonic beverage with electrolytes.', 'Everrise Express', '../../assets/images/item/100plus2.png'),
(86, 'Maggi Curry Noodles', 4.60, 'Noodles', 'Instant noodles with delicious curry flavour.', 'Farley Supermarket', '../../assets/images/item/maggi2.png'),
(87, 'Maggi Asam Laksa Noodles', 5.30, 'Noodles', 'Quick noodles with authentic Asam Laksa taste.', 'Choice Super Mall Samariang', '../../assets/images/item/asamlaksa2.png'),
(88, 'Mi Sedaap Instant Noodles', 5.30, 'Noodles', 'Tasty noodles with rich seasoning flavour.', 'Emart Express', '../../assets/images/item/misedap2.png'),
(89, 'Indomie Mi Goreng', 5.60, 'Noodles', 'Popular instant fried noodles with authentic Indonesian flavour.', 'Orange Convenience Store', '../../assets/images/item/indomie.png'),
(90, 'Hup Seng Cream Crackers', 5.60, 'Biscuits', 'Crunchy crackers suitable for snacks and meals.', 'Choice Daily', '../../assets/images/item/hupseng.png'),
(91, 'Jacob\'s Cream Crackers', 11.30, 'Biscuits', 'Classic crispy crackers in multipack packaging.', 'Everrise Express', '../../assets/images/item/jacobs.png'),
(92, 'Munchy\'s Cream Crackers', 5.30, 'Biscuits', 'Light and crispy crackers for snacking.', 'Farley Supermarket', '../../assets/images/item/munchy2.png'),
(93, 'Pringles Sour Cream & Onion', 8.80, 'Snacks', 'Imported potato crisps with sour cream and onion seasoning.', 'Jaya Grocer Express', '../../assets/images/item/pringles.png'),
(94, 'Mister Potato Original Chips', 4.10, 'Snacks', 'Crunchy potato chips with classic original flavour.', '7-Eleven', '../../assets/images/item/misterpotato.png'),
(95, 'Mamee Monster BBQ', 2.30, 'Snacks', 'Crunchy noodle snack with smoky BBQ flavour.', 'KK Super Mart', '../../assets/images/item/mamee.png'),
(96, 'Dutch Lady Full Cream Milk 1L', 8.80, 'Dairy Products', 'Fresh full cream milk rich in calcium and vitamins.', 'Happy Farm Fresh Mart', '../../assets/images/item/dutchlady.png'),
(97, 'Gardenia Butterscotch Bread', 4.00, 'Bread & Bakery', 'Soft butterscotch-flavoured bread suitable for breakfast and tea time.', 'Servay Hypermarket', '../../assets/images/item/gardenia-butterscotch.png'),
(98, 'Ayamas Chicken Nuggets', 14.80, 'Frozen Foods', 'Frozen chicken nuggets perfect for quick meals.', 'Choice Daily', '../../assets/images/item/nuggets.png'),
(99, 'Cadbury Dairy Milk Chocolate', 5.60, 'Confectionery', 'Smooth milk chocolate bar made with fresh milk.', 'Jaya Grocer Express', '../../assets/images/item/cadbury.png'),
(100, 'Ayam Brand Sardines in Tomato Sauce', 8.60, 'Canned Foods', 'Premium canned sardines in rich tomato sauce.', 'Everrise Express', '../../assets/images/item/sardines.png'),
(101, 'Dutch Lady Chocolate Milk 1L', 7.90, 'Dairy Products', 'Chocolate flavoured milk drink rich in calcium and nutrients.', 'Ninso Kota Samarahan', '../../assets/images/item/dutchlady-choco.png'),
(102, 'Farm Fresh Yogurt Drink', 5.90, 'Dairy Products', 'Refreshing cultured milk drink with a smooth fruity taste.', 'KK Super Mart', '../../assets/images/item/farmfresh-yogurt.png'),
(103, 'Dutch Lady Full Cream Milk 1L', 8.60, 'Dairy Products', 'Fresh full cream milk suitable for daily consumption.', 'Orange Convenience Store', '../../assets/images/item/dutchlady.png'),
(104, 'Ayamas Chicken Nuggets', 14.60, 'Frozen Foods', 'Frozen chicken nuggets perfect for quick meals.', 'Jaya Grocer Express', '../../assets/images/item/nuggets.png'),
(105, 'Ayamas Chicken Burger Patties', 16.90, 'Frozen Foods', 'Frozen chicken patties suitable for homemade burgers.', 'Happy Farm Fresh Mart', '../../assets/images/item/ayamaspatties.png'),
(106, 'Gardenia Original Classic Bread', 3.90, 'Bread & Bakery', 'Soft and fresh white bread suitable for breakfast and sandwiches.', '7-Eleven', '../../assets/images/item/gardenia.png'),
(107, 'Gardenia Butterscotch Bread', 4.30, 'Bread & Bakery', 'Sweet butterscotch-flavoured bread for snacks and breakfast.', 'myNEWS', '../../assets/images/item/gardenia-butterscotch.png'),
(108, 'Ayam Brand Tuna Chunks', 7.50, 'Canned Foods', 'Premium canned tuna suitable for meals and sandwiches.', 'KK Super Mart', '../../assets/images/item/tuna.png'),
(109, 'Ayam Brand Sardines in Tomato Sauce', 8.30, 'Canned Foods', 'Premium canned sardines in rich tomato sauce.', 'Ninso Kota Samarahan', '../../assets/images/item/sardines.png'),
(110, 'KitKat Chocolate Bar', 3.20, 'Confectionery', 'Crispy wafer chocolate bar with a smooth coating.', 'Orange Convenience Store', '../../assets/images/item/kitkat.png'),
(111, 'Kinder Bueno Chocolate', 6.60, 'Confectionery', 'Crispy wafer filled with hazelnut cream and covered in chocolate.', 'Choice Daily', '../../assets/images/item/kinderbueno.png'),
(112, 'Cadbury Dairy Milk Chocolate', 5.70, 'Confectionery', 'Smooth milk chocolate bar made with fresh milk.', 'KK Super Mart', '../../assets/images/item/cadbury.png'),
(113, 'Nescafe Classic Coffee', 22.50, 'Beverages', 'Aromatic instant coffee with smooth flavour.', 'Ninso Kota Samarahan', '../../assets/images/item/nclassic.jpg'),
(114, 'BOH 3-in-1 Tea Mix', 15.50, 'Beverages', 'Instant tea mix with convenient preparation.', 'Choice Super Mall Samariang', '../../assets/images/item/boh.png'),
(115, 'Coca-Cola 1.5L', 4.70, 'Beverages', 'Refreshing carbonated soft drink perfect for sharing.', 'Happy Farm Fresh Mart', '../../assets/images/item/cocacola.png'),
(116, 'Oreo Original Cookies', 5.80, 'Biscuits', 'Classic chocolate sandwich cookies with vanilla cream filling.', '7-Eleven', '../../assets/images/item/oreo.png'),
(117, 'Roma Marie Biscuits', 4.50, 'Biscuits', 'Classic sweet biscuits suitable for tea time snacks.', 'myNEWS', '../../assets/images/item/roma.png'),
(118, 'Maggi Curry Noodles', 4.80, 'Noodles', 'Instant noodles with rich curry seasoning flavour.', 'Orange Convenience Store', '../../assets/images/item/maggi2.png'),
(119, 'Pringles Sour Cream & Onion', 8.70, 'Snacks', 'Imported potato crisps with sour cream and onion seasoning.', 'Ninso Kota Samarahan', '../../assets/images/item/pringles.png'),
(120, 'Mister Potato Original Chips', 4.00, 'Snacks', 'Crunchy potato chips with classic original flavour.', 'Choice Super Mall Samariang', '../../assets/images/item/misterpotato.png'),
(121, 'Nescafe 3-in-1 Original', 13.80, 'Beverages', 'Instant coffee mix with rich coffee flavour.', 'Choice Super Mall Samariang', '../../assets/images/item/noriginal.png'),
(122, 'Milo Chocolate Drink', 18.70, 'Beverages', 'Chocolate malt drink rich in energy and nutrients.', 'Servay Hypermarket', '../../assets/images/item/milo.png'),
(123, '100PLUS Original', 4.30, 'Beverages', 'Refreshing isotonic drink for hydration.', 'KK Super Mart', '../../assets/images/item/100plus.png'),
(124, 'Marigold Peel Fresh Orange Juice', 7.70, 'Beverages', 'Refreshing orange juice made from quality oranges.', '7-Eleven', '../../assets/images/item/peelfresh.png'),
(125, 'Sun Valley Grenadine Syrup', 12.00, 'Beverages', 'Sweet syrup for preparing refreshing drinks.', 'myNEWS', '../../assets/images/item/sunvalley.png'),
(126, 'Maggi Asam Laksa Noodles', 5.40, 'Noodles', 'Instant noodles with spicy and sour laksa flavour.', 'Farley Supermarket', '../../assets/images/item/asamlaksa1.png'),
(127, 'Maggi Curry Noodles', 4.60, 'Noodles', 'Instant noodles with delicious curry flavour.', 'Unaco Superstore', '../../assets/images/item/maggi2.png'),
(128, 'Mi Sedaap Instant Noodles', 5.00, 'Noodles', 'Tasty noodles with rich seasoning flavour.', 'KK Super Mart', '../../assets/images/item/misedap2.png'),
(129, 'Indomie Mi Goreng', 5.40, 'Noodles', 'Popular instant fried noodles with authentic Indonesian flavour.', 'Happy Farm Fresh Mart', '../../assets/images/item/indomie.png'),
(130, 'Mi Sedap', 4.70, 'Noodles', 'Instant noodles known for various delicious flavours.', 'Ninso Kota Samarahan', '../../assets/images/item/misedap.png'),
(131, 'Hup Seng Cream Crackers', 5.30, 'Biscuits', 'Crispy crackers suitable for snacks and meals.', 'Servay Hypermarket', '../../assets/images/item/hupseng.png'),
(132, 'Jacob\'s Cream Crackers', 11.40, 'Biscuits', 'Crunchy cream crackers in multipack packaging.', 'Choice Super Mall Samariang', '../../assets/images/item/jacobs.png'),
(133, 'Munchy\'s Cream Crackers', 5.40, 'Biscuits', 'Light and crispy crackers for snacking.', 'KK Super Mart', '../../assets/images/item/munchy.png'),
(134, 'Oreo Original Cookies', 5.60, 'Biscuits', 'Chocolate sandwich cookies with vanilla cream filling.', 'Orange Convenience Store', '../../assets/images/item/oreo.png'),
(135, 'Roma Marie Biscuits', 4.30, 'Biscuits', 'Sweet biscuits suitable for tea time snacks.', 'Happy Farm Fresh Mart', '../../assets/images/item/roma.png'),
(136, 'Mister Potato Original Chips', 4.20, 'Snacks', 'Crunchy potato chips with classic original flavour.', 'Everrise Express', '../../assets/images/item/misterpotato.png'),
(137, 'Pringles Sour Cream & Onion', 8.50, 'Snacks', 'Imported potato crisps with sour cream and onion seasoning.', 'Unaco Superstore', '../../assets/images/item/pringles.png'),
(138, 'Mamee Monster BBQ', 2.40, 'Snacks', 'Crunchy noodle snack with smoky BBQ flavour.', '7-Eleven', '../../assets/images/item/mamee.png'),
(139, 'Cadbury Dairy Milk Chocolate', 5.40, 'Confectionery', 'Smooth milk chocolate bar made with fresh milk.', 'myNEWS', '../../assets/images/item/cadbury.png'),
(140, 'Kinder Bueno Chocolate', 6.70, 'Confectionery', 'Crispy wafer filled with hazelnut cream and chocolate coating.', 'Orange Convenience Store', '../../assets/images/item/kinderbueno.png'),
(141, 'Farm Fresh Fresh Milk', 9.40, 'Dairy Products', 'Pasteurized fresh milk with a creamy taste.', 'Servay Hypermarket', '../../assets/images/item/farmfresh.png'),
(142, 'Dutch Lady Full Cream Milk 1L', 8.80, 'Dairy Products', 'Fresh full cream milk rich in calcium and vitamins.', 'Unaco Superstore', '../../assets/images/item/dutchlady.png'),
(143, 'Ayamas Chicken Nuggets', 14.40, 'Frozen Foods', 'Frozen chicken nuggets perfect for quick meals.', '99 Speedmart', '../../assets/images/item/nuggets.png'),
(144, 'Ayamas Chicken Burger Patties', 16.50, 'Frozen Foods', 'Frozen chicken patties suitable for homemade burgers.', 'Choice Daily', '../../assets/images/item/ayamaspatties.png'),
(145, 'Gardenia Original Classic Bread', 3.70, 'Bread & Bakery', 'Soft and fresh white bread suitable for breakfast.', 'KK Super Mart', '../../assets/images/item/gardenia.png'),
(146, 'Gardenia Butterscotch Bread', 4.10, 'Bread & Bakery', 'Sweet bread suitable for breakfast and snacks.', 'Orange Convenience Store', '../../assets/images/item/gardenia-butterscotch.png'),
(147, 'Ayam Brand Sardines in Tomato Sauce', 8.40, 'Canned Foods', 'Premium canned sardines in rich tomato sauce.', 'Servay Hypermarket', '../../assets/images/item/sardines.png'),
(148, 'Ayam Brand Tuna Chunks', 7.70, 'Canned Foods', 'Premium canned tuna suitable for meals.', 'Happy Farm Fresh Mart', '../../assets/images/item/tuna.png'),
(149, 'BOH 3-in-1 Tea Mix', 16.20, 'Beverages', 'Instant tea beverage pack for daily use.', 'Farley Supermarket', '../../assets/images/item/boh.png'),
(150, 'Nescafe Classic Coffee', 23.00, 'Beverages', 'Premium instant coffee with rich aroma.', 'Choice Daily', '../../assets/images/item/nclassic.jpg');

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
(3, 3, 3, '4.0', 'Good product', '2026-07-20 15:16:56');

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
(18, 'Choice Super Mall Samariang', 'Supermarket providing fresh groceries, beverages, frozen food, household essentials, and personal care products.', '../../assets/images/store/choice-supermall.jpg');

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
(1, 'Faizatul Fitri Bin Boestamam', 'fai', 'fai@gmail.com', 'dummy123', '../../assets/images/profile/fai.jpg', '0'),
(2, 'Mohammad Amir Alam Bin Rahim Omar', 'amiromar', 'amir@gmail.com', 'abc123', '../../assets/images/profile/amir.jpg', '0'),
(3, 'Harith Zakwan Bin Zakaria', 'harith', 'harith@gmail.com', 'abc123', '../../assets/images/profile/harith.jpg', '0'),
(4, 'Mohamad Waqiuddin Bin Yahya', 'qiu', 'qiu@gmail.com', 'abc123', '../../assets/images/profile/qiu.jpeg', '0'),
(5, 'Iman Tarmizi Rosalina', 'iman', 'iman@gmail.com', 'abc123', '../../assets/images/profile/iman.jpg', '0'),
(6, 'John Cena', 'cena', 'john@gmail.com', 'wwe123', '../../assets/images/profile/default.png', '0'),
(7, 'Nur Aisyah Binti Ahmad', 'aisyah', 'aisyah@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(8, 'Muhammad Hafiz Bin Ismail', 'hafiz', 'hafiz@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(9, 'Siti Nur Ain Binti Rahman', 'ain', 'ain@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(10, 'Ahmad Syafiq Bin Abdullah', 'syafiq', 'syafiq@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(11, 'Nurul Huda Binti Hassan', 'huda', 'huda@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(12, 'Muhammad Firdaus Bin Hamzah', 'firdaus', 'firdaus@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(13, 'Siti Khadijah Binti Ali', 'khadijah', 'khadijah@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(14, 'Daniel Lee Wei Jian', 'daniel', 'daniel@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(15, 'Nur Amirah Binti Zulkifli', 'amirah', 'amirah@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(16, 'Muhammad Danish Bin Roslan', 'danish', 'danish@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(17, 'Nur Syazana Binti Mohd Noor', 'syazana', 'syazana@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(18, 'Muhammad Izzat Bin Zainal', 'izzat', 'izzat@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(19, 'Siti Aina Binti Yusof', 'aina', 'aina@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(20, 'Mohd Hakim Bin Rahman', 'hakim', 'hakim@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(21, 'Nur Farhana Binti Karim', 'farhana', 'farhana@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(22, 'Muhammad Aqil Bin Azman', 'aqil', 'aqil@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(23, 'Siti Balqis Binti Hamdan', 'balqis', 'balqis@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(24, 'Jason Tan Chee Keong', 'jason', 'jason@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(25, 'Nur Sabrina Binti Salleh', 'sabrina', 'sabrina@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(26, 'Muhammad Arif Bin Kamarudin', 'arif', 'arif@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(27, 'Nur Alya Binti Razak', 'alya', 'alya@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(28, 'Muhammad Aiman Bin Iskandar', 'aiman', 'aiman@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(29, 'Siti Nabilah Binti Shukri', 'nabilah', 'nabilah@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(30, 'Mohd Fikri Bin Jalil', 'fikri', 'fikri@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(31, 'Nur Izzah Binti Osman', 'izzah', 'izzah@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(32, 'Muhammad Faiz Bin Latif', 'faiz', 'faiz@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(33, 'Siti Sofia Binti Ibrahim', 'sofia', 'sofia@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(34, 'Kelvin Wong Jun Hao', 'kelvin', 'kelvin@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(35, 'Nur Atiqah Binti Mahmud', 'atiqah', 'atiqah@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(36, 'Muhammad Irfan Bin Rashid', 'irfan', 'irfan@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(37, 'Nurul Syafiqah Binti Azmi', 'syafiqah', 'syafiqah@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(38, 'Muhammad Haziq Bin Rosli', 'haziq', 'haziq@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(39, 'Siti Mariam Binti Hassan', 'mariam', 'mariam@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(40, 'Mohd Azri Bin Salleh', 'azri', 'azri@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(41, 'Nur Nadhirah Binti Rahim', 'nadhirah', 'nadhirah@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(42, 'Muhammad Shahril Bin Ahmad', 'shahril', 'shahril@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(43, 'Siti Zulaikha Binti Mohd Noor', 'zulaikha', 'zulaikha@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(44, 'Tan Jia Wei', 'jiawei', 'jiawei@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(45, 'Nur Hanisah Binti Ismail', 'hanisah', 'hanisah@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(46, 'Muhammad Luqman Bin Yahya', 'luqman', 'luqman@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(47, 'Siti Hajar Binti Osman', 'hajar', 'hajar@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(48, 'Mohd Asyraf Bin Rahman', 'asyraf', 'asyraf@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(49, 'Nur Aqilah Binti Zainuddin', 'aqilah', 'aqilah@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(50, 'Raj Kumar A/L Muniandy', 'rajkumar', 'rajkumar@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(51, 'Nur Afiqah Binti Hamid', 'afiqah', 'afiqah@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(52, 'Muhammad Nazmi Bin Azlan', 'nazmi', 'nazmi@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(53, 'Siti Fatin Binti Kamarul', 'fatin', 'fatin@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(54, 'Mohd Danial Bin Harun', 'danial', 'danial@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(55, 'Nurul Ain Binti Suhaimi', 'nurulain', 'nurulain@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(56, 'Muhammad Faris Bin Jamal', 'faris', 'faris@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(57, 'Siti Humaira Binti Roslan', 'humaira', 'humaira@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(58, 'Lim Wei Sheng', 'weisheng', 'weisheng@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(59, 'Nur Athirah Binti Khalid', 'athirah', 'athirah@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(60, 'Muhammad Rizwan Bin Ibrahim', 'rizwan', 'rizwan@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(61, 'Nur Iman Binti Rahman', 'nuriman', 'nuriman@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(62, 'Muhammad Akmal Bin Zulkifli', 'akmal', 'akmal@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(63, 'Siti Nur Aina Binti Iskandar', 'ainaiskandar', 'ainaiskandar@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(64, 'Mohd Hafeez Bin Hamzah', 'hafeez', 'hafeez@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(65, 'Nur Shazana Binti Karim', 'shazana', 'shazana@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(66, 'Muhammad Qayyum Bin Salleh', 'qayyum', 'qayyum@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0'),
(67, 'Priscilla Wong Mei Ling', 'priscilla', 'priscilla@gmail.com', 'abc123', '../../assets/images/profile/default.png', '0');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`ratingID`),
  ADD KEY `fk_rating_item` (`ItemID`),
  ADD KEY `fk_rating_student` (`studentID`);

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
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `ItemID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `ratingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `storeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1013;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `fk_rating_item` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ItemID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rating_student` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
