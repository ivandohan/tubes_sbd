-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2022 at 04:30 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tubessbd_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `customerId` int(11) NOT NULL,
  `province` varchar(20) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `details` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`customerId`, `province`, `city`, `details`) VALUES
(2, 'Sumatera Utara', 'Tapanuli Utara', 'Jalan Duku Nomor 76 Perumnas, Pagarbatu'),
(3, 'DKI Jakarta', 'Jakarta', 'Tester Place');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `authorId` int(11) NOT NULL,
  `authorName` varchar(50) NOT NULL,
  `authorImage` varchar(50) DEFAULT NULL,
  `fb` varchar(100) DEFAULT NULL,
  `ig` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `linkedIn` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`authorId`, `authorName`, `authorImage`, `fb`, `ig`, `twitter`, `linkedIn`) VALUES
(1, 'Yohana Nainggolan', 'yohana.jpg', NULL, NULL, NULL, NULL),
(2, 'Maria Anggraini Natio', 'maria.jpeg', NULL, NULL, NULL, NULL),
(3, 'Muhammad Ilham', 'ilham.jpg', NULL, NULL, NULL, NULL),
(4, 'Geboy Donny Aurora Sinaga', 'geboy.jpeg', NULL, NULL, NULL, NULL),
(5, 'Ivandohan Samuel Siregar', 'ivando.jpg', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` varchar(5) NOT NULL,
  `categoryName` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `categoryName`) VALUES
('a', 'anak'),
('b', 'bayi'),
('p', 'pria'),
('w', 'wanita');

-- --------------------------------------------------------

--
-- Table structure for table `customerinfo`
--

CREATE TABLE `customerinfo` (
  `customerId` int(11) NOT NULL,
  `customerName` varchar(50) NOT NULL,
  `birthDay` date DEFAULT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customerinfo`
--

INSERT INTO `customerinfo` (`customerId`, `customerName`, `birthDay`, `phoneNumber`, `gender`) VALUES
(1, 'Ivandohan Samuel Siregar', NULL, NULL, NULL),
(2, 'Jeri Jovanna', NULL, NULL, NULL),
(3, 'User (Tester)', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `messageEmail` varchar(50) NOT NULL,
  `messagePhone` varchar(20) NOT NULL,
  `messageContent` text DEFAULT NULL,
  `rate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL,
  `shippedTo` varchar(150) DEFAULT NULL,
  `paymentMethod` varchar(50) DEFAULT NULL,
  `statusOrder` varchar(10) DEFAULT 'pending',
  `emailOrder` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`orderId`, `productId`, `price`, `quantity`, `phoneNumber`, `shippedTo`, `paymentMethod`, `statusOrder`, `emailOrder`) VALUES
(3, 2, 155000, 1, '082279767813', 'Sumatera Utara, Tapanuli Utara, Details : Jalan Duku Nomor 76 Perumnas, Pagarbatu, 22452', 'cash on delivery', 'completed', 'jerijovana@gmail.com'),
(6, 6, 200000, 1, '082279767813', 'Sumatera Utara, Tapanuli Utara, Details : Jalan Duku Nomor 76 Perumnas, Pagarbatu, 22452', 'cash on delivery', 'completed', 'srgivando@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `shippedBy` varchar(5) DEFAULT 'SP001',
  `orderDate` datetime NOT NULL DEFAULT current_timestamp(),
  `shipVia` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `customerId`, `shippedBy`, `orderDate`, `shipVia`) VALUES
(3, 2, 'SP005', '2022-05-25 19:35:22', NULL),
(4, 2, 'SP004', '2022-05-25 19:38:12', NULL),
(5, 2, 'SP004', '2022-05-25 19:44:46', NULL),
(6, 2, 'SP003', '2022-05-25 20:34:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productId` int(11) NOT NULL,
  `categoryId` varchar(10) NOT NULL,
  `subCategoryId` varchar(10) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productPrice` int(11) NOT NULL,
  `productImage` varchar(200) DEFAULT NULL,
  `productQuantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `categoryId`, `subCategoryId`, `productName`, `productPrice`, `productImage`, `productQuantity`) VALUES
(2, 'a', 'sc01', 'AIRism Katun T-shirt Grafis Lengan Pendek', 155000, 'KIDSAIRismKatunT-shirtGrafisLenganPendek.jpg', 100),
(3, 'a', 'sc01', 'AIRsm Jaket Mesh Hoodie UV Protection', 160000, 'KIDSAIRsmJaketMeshHoodieUVProtection.jpg', 100),
(4, 'a', 'sc01', 'GIRLS T-shirt Katun Lembut Frill Lengan Pendek', 150000, 'KIDSGIRLST-shirtKatunLembutFrillLenganPendek.jpg', 100),
(5, 'a', 'sc01', 'UT Mickey Stand Lengan Pendek', 180000, 'KIDSUTMickeyStandLenganPendek.jpg', 100),
(6, 'b', 'sc01', 'TODDLER AIRism Katun Cardigan UV Protection', 200000, 'BABIESTODDLERAIRismKatunCardiganUVProtection.jpg', 100),
(7, 'b', 'sc01', 'TODDLER AIRism Katun T-shirt Biru Kantong Crew Neck', 155000, 'BABIESTODDLERAIRismKatunT-shirtBiruKantongCrewNeck.jpg', 100),
(8, 'b', 'sc01', 'TODDLER AIRism Katun T-shirt Crew Neck Bayi Frill', 165000, 'BABIESTODDLERAIRismKatunT-shirtCrewNeckBayiFrill.jpg', 100),
(9, 'b', 'sc01', 'TODDLER ARism Katun T-shirt Crew Neck Bayi', 170000, 'BABIESTODDLERARismKatunT-shirtCrewNeckBayi.jpg', 100),
(10, 'b', 'sc01', 'TODDLER UT Disney Lengan Pendek', 185000, 'BABIESTODDLERUTDisneyLenganPendek.jpg', 100),
(11, 'p', 'sc01', 'Kaos Polo DRY-EX Lengan Pendek', 160000, 'MENKaosPoloDRY-EXLenganPendek.jpg', 100),
(12, 'p', 'sc01', 'T-shirt DRY-EX Crew Neck Mapping', 170000, 'MENT-shirtDRY-EXCrewNeckMapping.jpg', 100),
(13, 'p', 'sc01', 'T-shirt Oversized Garis Biru Crew Neck Lengan Half', 168000, 'MENT-shirtOversizedGarisBiruCrewNeckLenganHalf.jpg', 100),
(14, 'p', 'sc01', 'T-shirt Oversized Garis Crew Neck Lengan Half', 189000, 'MENT-shirtOversizedGarisCrewNeckLenganHalf.jpg', 100),
(15, 'w', 'sc01', 'AIRism T-shirt Mapping Crew Neck', 156000, 'WOMENAIRismT-shirtMappingCrewNeck.jpg', 100),
(16, 'w', 'sc01', 'T-shirt Crew Neck Lengan Pendek UniqloU', 175000, 'WOMENT-shirtCrewNeckLenganPendekUniqloU.jpg', 100),
(17, 'w', 'sc01', 'T-shirt Crop Jersey Slub Garis Crew Neckr', 190000, 'WOMENT-shirtCropJerseySlubGarisCrewNeck.jpg', 100),
(18, 'w', 'sc01', 'T-shirt Crop Rib Lengan Pendek', 160000, 'WOMENT-shirtCropRibLenganPendek.jpg', 100),
(19, 'w', 'sc01', 'T-shirt Oversized Lengan Half', 180000, 'WOMENT-shirtOversizedLenganHalf.jpg', 100),
(20, 'a', 'sc02', 'Celana Pendek Relax(YACHT)', 165000, 'KIDSCelanaPendekRelax(YACHT).jpg', 100),
(21, 'a', 'sc02', 'Celana Pendek Relax Smithsonian', 178000, 'KIDSCelanaPendekRelaxSmithsonian.jpg', 100),
(22, 'a', 'sc02', 'Celana Pendek Relax Smithsonian Hijau Lumut', 170000, 'KIDSCelanaPendekRelaxSmithsonianHijauLumut.jpg', 100),
(23, 'a', 'sc02', 'GIRLS Celana Pendek Relax Dry Seersucker', 159000, 'KIDSGIRLSCelanaPendekRelaxDrySeersucker.jpg', 100),
(24, 'b', 'sc02', 'TODDLER Celana Legging Crop(Starfish)', 157000, 'BABIESSTODDLERCelanaLeggingCrop(Starfish).jpg', 100),
(25, 'b', 'sc02', 'TODDLER Celana Legging Crop', 180000, 'BABIESSTODDLERCelanaLeggingCrop.jpg', 100),
(26, 'b', 'sc02', 'TODDLER Celana Legging Crop Paul&Joe', 160000, 'BABIESSTODDLERCelanaLeggingCropPaul&Joe.jpg', 100),
(27, 'b', 'sc02', 'TODDLER Celana Pendek Relax Dry(Motif)', 168000, 'BABIESSTODDLERCelanaPendeKRelaxDry(Motif).jpg', 100),
(28, 'b', 'sc02', 'TODDLE RCelana Pendek Relax Dry Cream(Motif)', 190000, 'BABIESSTODDLERCelanaPendekRelaxDryCream(Motif).jpg', 100),
(29, 'p', 'sc02', 'Celana Pendek Relax Katun Ringan(LEAF)', 160000, 'MENCelanaPendekRelaxKatunRingan(LEAF).jpg', 100),
(30, 'p', 'sc02', 'Celana Pendek Relax Katun Ringan(SLUB)', 170000, 'MENCelanaPendekRelaxKatunRingan(SLUB).jpg', 100),
(31, 'p', 'sc02', 'Celana Pendek Relax Ultra Light UNIQLOX THEORY', 180000, 'MENCelanaPendekRelaxUltraLightUNIQLOXTHEORY.jpg', 100),
(32, 'p', 'sc02', 'Celana Pendek Relax Washed Jersey', 175000, 'MENCelanaPendekRelaxWashedJersey.jpg', 100),
(33, 'p', 'sc02', 'Light Cotton Easy Shorts', 150000, 'MENLightCottonEasyShorts.jpg', 100),
(34, 'w', 'sc02', 'Celana Lebar Bermuda Linen Blend', 179000, 'WOMENCelanaLebarBermudaLinenBlend.jpg', 100),
(35, 'w', 'sc02', 'Celana Lebar Lipit Linen Blend', 180000, 'WOMENCelanaLebarLipitLinenBlend.jpg', 100),
(36, 'w', 'sc02', 'CelanaPendekLinenKatun', 150000, 'WOMENCelanaPendekLinenKatun.jpg', 100),
(37, 'w', 'sc02', 'CelanaPendekSmartKotak', 198000, 'WOMENCelanaPendekSmartKotak.jpg', 100),
(38, 'w', 'sc02', 'CelanaTaperedLinenKatun', 186000, 'WOMENCelanaTaperedLinenKatun.jpg', 100),
(39, 'a', 'sc03', 'AIRism Jaket Mesh Hoodie UV Protection', 170000, 'KIDSAIRismJaketMeshHoodieUVProtection.jpg', 100),
(40, 'a', 'sc03', 'GIRLS Cardigan UV Protection Crew Neck', 190000, 'KIDSGIRLSCardiganUVProtectionCrewNeck.jpg', 100),
(41, 'a', 'sc03', 'GIRLS Cardigan UV Protection CrewNeck PINKXCREAM', 160000, 'KIDSGIRLSCardiganUVProtectionCrewNeckPINKXCREAM.jpg', 100),
(42, 'a', 'sc03', 'Jaket Parka Saku UV Protection', 185000, 'KIDSJaketParkaSakuUVProtection.jpg', 100),
(43, 'a', 'sc03', 'Jaket Sweat Dry Ultra Stretch Hoodie Resleting', 175000, 'KIDSJaketSweatDryUltraStretchHoodieResleting.jpg', 100),
(44, 'p', 'sc03', 'AIRism Jaket Hoodie Resleting UV Protection', 150000, 'MENAIRismJaketHoodieResletingUVProtection.jpg', 100),
(45, 'p', 'sc03', 'BLOCKTECH Jaket Parka', 165000, 'MENBLOCKTECH aketParka.jpg', 100),
(46, 'p', 'sc03', 'Jaket Parka Saku Anorak UV Protection', 165000, 'MENJaketParkaSakuAnorakUVProtection.jpg', 100),
(47, 'p', 'sc03', 'Jaket Parka Saku Anorak UV Protection BIRU', 185000, 'MENJaketParkaSakuAnorakUVProtectionBIRU.jpg', 100),
(48, 'p', 'sc03', 'Jaket Parka Saku Katun Seersucker', 150000, 'MENJaketParkaSakuKatunSeersucker.jpg', 100),
(49, 'w', 'sc03', 'AIRism aketMeshHoodieUVProtection', 170000, 'WOMENAIRism aketMeshHoodieUVProtection.jpg', 100),
(50, 'w', 'sc03', 'Jaket Parka Saku UV Protection(Motif)', 180000, 'WOMENJaketParkaSakuUVProtection(Motif).jpg', 100),
(51, 'w', 'sc03', 'Jaket Parka Saku UV Protection', 178000, 'WOMENJaketParkaSakuUVProtection.jpg', 100),
(52, 'w', 'sc03', 'Jaket Parka Saku UV Protection UNGU', 180000, 'WOMENJaketParkaSakuUVProtectionUNGU.jpg', 100),
(53, 'w', 'sc03', 'Jaket Pendek Jersey', 193000, 'WOMENJaketPendekJersey.jpg', 100),
(54, 'a', 'sc04', 'AIRism Masker', 150000, 'KIDSAIRismMasker.jpg', 100),
(55, 'a', 'sc04', 'Gift Bag', 160000, 'KIDSGiftBag.jpg', 100),
(56, 'a', 'sc04', 'Gift Bag Kanvas', 170000, 'KIDSGiftBagKanvas.jpg', 100),
(57, 'a', 'sc04', 'Tas Tote Kanvas', 180000, 'KIDSTasToteKanvas.jpg', 100),
(58, 'a', 'sc04', 'Topi Reyn Spooner', 190000, 'KIDSTopiReynSpooner.jpg', 100),
(59, 'b', 'sc04', 'Kaos Kaki Pendek 2 pack', 170000, 'BABIESKaosKakiPendek2pack.jpg', 100),
(60, 'b', 'sc04', 'Kaos Kaki Pendek 2 Reguler Pack Warna', 160000, 'BABIESKaosKakiPendek2RegulerPackWarna.jpg', 100),
(61, 'b', 'sc04', 'NEWBORN Topi Joy Of Print', 180000, 'BABIESNEWBORNTopiJoyOfPrint.jpg', 100),
(62, 'b', 'sc04', 'NEWBORN Topi Joy Of Print Gambar Beruang Kecil', 150000, 'BABIESKaosKakiPendek2pack.jpg', 100),
(63, 'b', 'sc04', 'NEWBORN Topi Joy Of Print Stroberi Pink', 175000, 'BABIESNEWBORNTopiJoyOfPrintStroberiPink.jpg', 100),
(64, 'p', 'sc04', 'AIRism Seprai(Double)', 185000, 'MENAIRismSeprai(Double).jpg', 100),
(65, 'p', 'sc04', 'Ikat Pinggang Italian Leather Saddle Narrow', 190000, 'MENIkatPinggangItalianLeatherSaddleNarrow.jpg', 100),
(66, 'p', 'sc04', 'Kacamata Sport Rim Half', 155000, 'MENKacamataSportRimHalf.jpg', 100),
(67, 'p', 'sc04', 'Payung Compact UV Protection', 156000, 'MENPayungCompactUVProtection.jpg', 100),
(68, 'p', 'sc04', 'Tas Singlestrap', 150000, 'MENTasSinglestrap.jpg', 100),
(69, 'w', 'sc04', '2 WAY Strectch UV Protection', 200000, 'WOMEN2WAYStrectchUVProtection.jpg', 100),
(71, 'w', 'sc04', 'AIRism Masker', 175000, 'WOMENAIRismMasker.jpg', 100),
(72, 'w', 'sc04', 'AIRism Dalaman Hijab HANATAJIMA FOR UNIQLO', 155000, 'WOMENAIRismDalamanHijabHANATAJIMAFORUNIQLO.jpg', 100),
(73, 'w', 'sc04', 'Topi Bucket UV Protection WOMEN AIRism Bandana', 185000, 'WOMENTopiBucketUVProtection.jpg', 100);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `subCategoryId` varchar(5) NOT NULL,
  `subCategoryName` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`subCategoryId`, `subCategoryName`) VALUES
('sc01', 'Atasan'),
('sc02', 'Bawahan'),
('sc03', 'Luaran'),
('sc04', 'Aksesoris');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplierId` varchar(5) NOT NULL,
  `supplierName` varchar(30) NOT NULL,
  `detailAddress` varchar(100) NOT NULL,
  `storeType` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplierId`, `supplierName`, `detailAddress`, `storeType`) VALUES
('SP001', 'TIM10 23 PASKAL', 'Jl. Pasirkaliki,Komplek Paskal Hypersquare, Andir, Bandung', 'Large Store'),
('SP002', 'TIM10 AEON MALL BSD CITY', 'Jl. Grand Boulevard BSD City Tangerang, Banten', 'Large Store'),
('SP003', 'TIM10 CIPUTRA WORLD SURABAYA', 'Gunung Sari, Dukuhpakis, Surabaya City, East Java', 'Large Store'),
('SP004', 'TIM10 DELIPARK MALL', 'Jl. Putri Hijau No.1, Kesawan, OPQ, Kota Medan, Sumatera Utara', 'Large Store'),
('SP005', 'TIM10 BONTANI SQUARE MALL', 'Jl. Raya Pajajaran No.40, Tugu Kujang, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat', 'Large Store'),
('SP006', 'TIM10 EMPORIUM PLUIT MALL', 'Jl. Pluit Selatan Raya, Penjaringan, Kec. Penjaringan, Kota Jkt Utara, DKI Jakarta', 'Large Store');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `userLevel` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `userLevel`) VALUES
(1, 'srgivando@gmail.com', 'a3dcb4d229de6fde0db5686dee47145d', 'admin'),
(2, 'jerijovana@gmail.com', 'a3dcb4d229de6fde0db5686dee47145d', 'user'),
(3, 'test@test.id', 'a3dcb4d229de6fde0db5686dee47145d', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`authorId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `fk_cart_customers` (`customerId`),
  ADD KEY `fk_cart_products` (`productId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `customerinfo`
--
ALTER TABLE `customerinfo`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageId`),
  ADD KEY `fk_messages_customers` (`customerId`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD KEY `fk_orderDetail_orders` (`orderId`),
  ADD KEY `fk_orderDetail_products` (`productId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `fk_orders_customers` (`customerId`),
  ADD KEY `fk_orders_suppliers` (`shippedBy`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `fk_products_category` (`categoryId`),
  ADD KEY `fk_products_subCategory` (`subCategoryId`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`subCategoryId`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplierId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `authorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `fk_address_customers` FOREIGN KEY (`customerId`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_customers` FOREIGN KEY (`customerId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_cart_products` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`);

--
-- Constraints for table `customerinfo`
--
ALTER TABLE `customerinfo`
  ADD CONSTRAINT `fk_customerInfo_customers` FOREIGN KEY (`customerId`) REFERENCES `users` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_messages_customers` FOREIGN KEY (`customerId`) REFERENCES `users` (`id`);

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `fk_orderDetail_orders` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`),
  ADD CONSTRAINT `fk_orderDetail_products` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_customers` FOREIGN KEY (`customerId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_orders_suppliers` FOREIGN KEY (`shippedBy`) REFERENCES `suppliers` (`supplierId`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_category` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`),
  ADD CONSTRAINT `fk_products_subCategory` FOREIGN KEY (`subCategoryId`) REFERENCES `subcategory` (`subCategoryId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
