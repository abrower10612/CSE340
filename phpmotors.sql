-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 05, 2021 at 08:34 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int(11) NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used'),
(46, 'Luxury');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(49, 'Andrew', 'Brower', 'abrower10612@gmail.com', '$2y$10$Kw3ZzFCw6s1cJ7QKxlCPQOT/SZOCz/XlfeS/mbsZFTKPUynTb8ul.', '1', NULL),
(51, 'Admin', 'User', 'admin@cse340.net', '$2y$10$qYzvQc8Pd0YAj3LsLf09Nu7ZsYA.3d0mKthf5wrfEl81X5c8Wgm3e', '3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) CHARACTER SET latin1 NOT NULL,
  `imgPath` varchar(150) CHARACTER SET latin1 NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `imgPrimary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(96, 2, 'ford-model-t.png', '/phpmotors/images/vehicles/ford-model-t.png', '2021-03-20 18:54:30', 1),
(97, 2, 'ford-model-t-tn.png', '/phpmotors/images/vehicles/ford-model-t-tn.png', '2021-03-20 18:54:30', 1),
(98, 3, 'adventadorr.jpg', '/phpmotors/images/vehicles/adventadorr.jpg', '2021-03-20 18:54:42', 1),
(99, 3, 'adventadorr-tn.jpg', '/phpmotors/images/vehicles/adventadorr-tn.jpg', '2021-03-20 18:54:42', 1),
(100, 4, 'monster.jpg', '/phpmotors/images/vehicles/monster.jpg', '2021-03-20 18:54:54', 1),
(101, 4, 'monster-tn.jpg', '/phpmotors/images/vehicles/monster-tn.jpg', '2021-03-20 18:54:54', 1),
(102, 5, 'mechanic.jpg', '/phpmotors/images/vehicles/mechanic.jpg', '2021-03-20 18:55:04', 1),
(103, 5, 'mechanic-tn.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '2021-03-20 18:55:04', 1),
(104, 6, 'batmobile.jpg', '/phpmotors/images/vehicles/batmobile.jpg', '2021-03-20 18:55:16', 1),
(105, 6, 'batmobile-tn.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '2021-03-20 18:55:16', 1),
(106, 7, 'mystery.jpg', '/phpmotors/images/vehicles/mystery.jpg', '2021-03-20 18:55:31', 1),
(107, 7, 'mystery-tn.jpg', '/phpmotors/images/vehicles/mystery-tn.jpg', '2021-03-20 18:55:31', 1),
(108, 8, 'fire.jpg', '/phpmotors/images/vehicles/fire.jpg', '2021-03-20 18:55:45', 1),
(109, 8, 'fire-tn.jpg', '/phpmotors/images/vehicles/fire-tn.jpg', '2021-03-20 18:55:45', 1),
(110, 9, 'crown.jpg', '/phpmotors/images/vehicles/crown.jpg', '2021-03-20 18:56:00', 1),
(111, 9, 'crown-tn.jpg', '/phpmotors/images/vehicles/crown-tn.jpg', '2021-03-20 18:56:00', 1),
(112, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2021-03-20 18:56:15', 1),
(113, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2021-03-20 18:56:15', 1),
(114, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2021-03-20 18:56:27', 1),
(115, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2021-03-20 18:56:27', 1),
(116, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2021-03-20 18:56:39', 1),
(117, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2021-03-20 18:56:39', 1),
(118, 13, 'aerocara.jpg', '/phpmotors/images/vehicles/aerocara.jpg', '2021-03-20 18:56:52', 1),
(119, 13, 'aerocara-tn.jpg', '/phpmotors/images/vehicles/aerocara-tn.jpg', '2021-03-20 18:56:52', 1),
(120, 14, 'fbi.jpg', '/phpmotors/images/vehicles/fbi.jpg', '2021-03-20 18:57:03', 1),
(121, 14, 'fbi-tn.jpg', '/phpmotors/images/vehicles/fbi-tn.jpg', '2021-03-20 18:57:03', 1),
(124, 87, 'crossfire.jpg', '/phpmotors/images/vehicles/crossfire.jpg', '2021-03-20 18:57:37', 1),
(125, 87, 'crossfire-tn.jpg', '/phpmotors/images/vehicles/crossfire-tn.jpg', '2021-03-20 18:57:37', 1),
(130, 2, 'ford-model-t2.jpeg', '/phpmotors/images/vehicles/ford-model-t2.jpeg', '2021-03-20 19:03:07', 0),
(131, 2, 'ford-model-t2-tn.jpeg', '/phpmotors/images/vehicles/ford-model-t2-tn.jpeg', '2021-03-20 19:03:07', 0),
(132, 87, 'crossfire2.jpeg', '/phpmotors/images/vehicles/crossfire2.jpeg', '2021-03-20 19:03:25', 0),
(133, 87, 'crossfire2-tn.jpeg', '/phpmotors/images/vehicles/crossfire2-tn.jpeg', '2021-03-20 19:03:25', 0),
(136, 99, 'wrangler.jpg', '/phpmotors/images/vehicles/wrangler.jpg', '2021-03-23 05:26:15', 1),
(137, 99, 'wrangler-tn.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '2021-03-23 05:26:15', 1),
(146, 15, 'no-image.jpg', '/phpmotors/images/vehicles/no-image.jpg', '2021-04-03 22:51:09', 1),
(147, 15, 'no-image-tn.jpg', '/phpmotors/images/vehicles/no-image-tn.jpg', '2021-04-03 22:51:09', 1),
(160, 107, 'car2.jpg', '/phpmotors/images/vehicles/car2.jpg', '2021-04-04 02:06:28', 1),
(161, 107, 'car2-tn.jpg', '/phpmotors/images/vehicles/car2-tn.jpg', '2021-04-04 02:06:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text DEFAULT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` decimal(10,2) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want as long as it', '/phpmotors/images/ford-model-t.png', '/phpmotors/images/ford-model-t.png', '30000.00', 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws. ', '/phpmotors/images/vehicles/adventadorr.jpg', '/phpmotors/images/adventadorr.jpg', '417650.00', 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. this beast comes with 60in tires giving you tracktions needed to jump and roll in the mud.', '/phpmotors/images/vehicles/monster.jpg', '/phpmotors/images/monster.jpg', '150000.00', 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. however with a little tlc it will run as good a new.', '/phpmotors/images/vehicles/mechanic.jpg', '/phpmotors/images/mechanic.jpg', '100.00', 200, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a super hero? now you can with the batmobile. This car allows you to switch to bike mode allowing you to easily maneuver through trafic during rush hour.', '/phpmotors/images/vehicles/batmobile.jpg', '/phpmotors/images/batmobile.jpg', '65000.00', 2, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of there 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/vehicles/mystery.jpg', '/phpmotors/images/mystery.jpg', '10000.00', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000 gallon tank.', '/phpmotors/images/vehicles/fire.jpg', '/phpmotors/images/fire.jpg', '50000.00', 2, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equiped with the siren which is convenient for college students running late to class.', '/phpmotors/images/vehicles/crown.jpg', '/phpmotors/images/crown.jpg', '10000.00', 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the ar you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/vehicles/camaro.jpg', '/phpmotors/images/camaro.jpg', '25000.00', 10, 'Silver', 3),
(11, 'Cadilac', 'Escalade', 'This stylin car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/vehicles/escalade.jpg', '/phpmotors/images/escalade.jpg', '75195.00', 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go offroading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/vehicles/hummer.jpg', '/phpmotors/images/hummer.jpg', '58800.00', 5, 'Yellow', 5),
(13, 'Aerocar Intl.', 'Aerocar', 'Are you sick of rushhour trafic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get them while they last!', '/phpmotors/images/vehicles/aerocara.jpg', '/phpmotors/images/aerocara.jpg', '1000000.00', 6, 'Red', 2),
(14, 'FBI', 'Survalence Van', 'do you like police shows? You', '/phpmotors/images/vehicles/fbi.jpg', '/phpmotors/images/fbi.jpg', '20000.00', 1, 'Green', 1),
(15, 'Dog ', 'Car', 'Do you like dogs? Well this car is for you straight from the 90s from Aspen, Colorado we have the orginal Dog Car complete with fluffy ears.  ', '/phpmotors/images/vehicles/dog-car.jpg', '/phpmotors/images/dog-car.jpg', '35000.00', 101, 'Brown', 2),
(87, 'Chrysler', 'Crossfire', 'Super fast and super sporty', '/phpmotors/images/vehicles/crossfire.jpg', '/phpmotors/images/vehicles/crossfire-tn.jpg', '10000.00', 1, 'White', 46),
(99, 'Jeep', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. Its great for everyday driving as well as offroading weather that be on the the rocks or in the mud!', '/phpmotors/images/no-image.png', '/phpmotors/images/no-image.png', '28045.00', 4, 'Orange', 1),
(107, 'DMC', 'Delorean', 'Super fast and super sporty', '/phpmotors/images/vehicles/no-image.jpg', '/phpmotors/images/vehicles/no-image-tn.jpg', '10000000.00', 15, 'Silver', 46);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text CHARACTER SET latin1 NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `invId` int(10) UNSIGNED NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(52, 'The Model T with the old four in it you can safely get a good 50mph out of it in high ruckstool. braking is scary even with the newly installed rocky mountain brakes. it holds up really well and if maintained runs great! Its almost 100 years old of course it squeaks and rattles. It is a great looking Model T one of the best in the area especially from the brass era. Its really fun to drive because of the attention but definitely challenging to drive!', '2021-04-02 03:01:52', 2, 49),
(54, 'Overall I really like this car. First I will list my DOWNSIDES: 1) Oil changes are very expensive. 2.) OK it&#39;s a real sports car, but I wish it had a spare tire, hard to do since it has different size wheels on the back 19 inch and 18 inch on the front, Oh well I can live with it. 3.) It has a joke for a cup holder, I would not have put one in if it had to be the one it&#39;s got. 4.) You really have to be aware of what is on the back sides of you because the visibility is pretty poor out the back window with the convertible top up, but again it is a true sports roadster. 5.) You have to put premium gas in it. NOW the UPSIDES: 1.) Very fun to drive. 2.) The exterior style is exceptional. 2.) It is a head turner. 3.) Fast out of the gate. 4.) I love the way the drop top works. 5.) The small roll bars behind each seat are very stylish. 5.) The Tires and wheels are cool along with the 19 inch in the back and 18 inch in the front. 6.) Did I say it is fun to drive? yes I did in my first point. 7.) I love it and I am very happy to own it.', '2021-04-02 03:05:59', 87, 49),
(55, 'I think the name Lamborghini, it self means perfection. the interior design is amazing, you haven&#39;t seen any thing like that. This car is the combination of power and beauty. This car really make your money worthy. in case of performance there&#39;s no doubt in it. Lamborghini has the best engine ever made and can reach to its full power in 8 seconds.it is very reliable. the design of Lamborghini is the best design ever made.', '2021-04-02 03:06:51', 3, 49),
(63, 'Love the police interceptor version of this car. I have owned 2 of these previously. I got 26 mpg driving from Indiana to North Carolina. Best used car for the money that you can buy.', '2021-04-03 22:40:47', 9, 49),
(64, 'Great car to drive. Handles the road like a dream. Still some sight line issues but added anti collision safety features help. Power in the SS is massive and steady.', '2021-04-03 22:41:49', 10, 51),
(65, 'Fantastic automobile a must see if you are considering a true American muscle car with stylish ways. And a proven brand that will stand behind there products.', '2021-04-03 22:42:06', 10, 51);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `invId` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `invId` (`invId`),
  ADD KEY `clientId` (`clientId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
