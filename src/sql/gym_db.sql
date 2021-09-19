-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 09, 2021 at 07:29 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounting`
--

DROP TABLE IF EXISTS `accounting`;
CREATE TABLE IF NOT EXISTS `accounting` (
  `client_code` int(5) NOT NULL,
  `membership_code` int(5) NOT NULL,
  `month` varchar(10) COLLATE utf8_bin NOT NULL,
  `paid` tinyint(1) NOT NULL,
  PRIMARY KEY (`client_code`,`membership_code`),
  KEY `membership_code` (`membership_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `accounting`
--

INSERT INTO `accounting` (`client_code`, `membership_code`, `month`, `paid`) VALUES
(11132, 5003, 'August', 1),
(12844, 5005, 'September', 0),
(12892, 5009, 'August', 0),
(12999, 5004, 'August', 0),
(13476, 5008, 'September', 0),
(14691, 5010, 'September', 1),
(15321, 5002, 'August', 1),
(16324, 5007, 'September', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `client_code` int(5) NOT NULL,
  `last_name` varchar(30) COLLATE utf8_bin NOT NULL,
  `first_name` varchar(30) COLLATE utf8_bin NOT NULL,
  `phone_number` varchar(13) COLLATE utf8_bin NOT NULL,
  `trainer_code` int(5) NOT NULL,
  PRIMARY KEY (`client_code`),
  KEY `trainer_code` (`trainer_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_code`, `last_name`, `first_name`, `phone_number`, `trainer_code`) VALUES
(11132, 'Connelly', 'Olive', '+380994935292', 3461),
(12844, 'Collier', 'Rida', '+380664065392', 3846),
(12892, 'Hayes', 'Enya', '+380980388964', 3534),
(12999, 'Nguyen', 'Adelaide', '+380930348961', 3199),
(13476, 'Goldsmith', 'Frazer', '+380934055523', 3592),
(14691, 'Pike', 'Edison', '+380981384561', 3933),
(15321, 'Gonzalez', 'Franklin', '+380680342961', 3832),
(16324, 'Vance', 'Craig', '+380734066699', 3765),
(18588, 'Mcgregor', 'Alyssia', '+380660342951', 3592),
(19643, 'Webber', 'Oskar', '+380994055392', 3846);

-- --------------------------------------------------------

--
-- Table structure for table `gyms`
--

DROP TABLE IF EXISTS `gyms`;
CREATE TABLE IF NOT EXISTS `gyms` (
  `gym_code` int(5) NOT NULL,
  `name` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`gym_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `gyms`
--

INSERT INTO `gyms` (`gym_code`, `name`) VALUES
(20, 'Yoga'),
(21, 'Exercise'),
(23, 'Pool'),
(24, 'Fitness'),
(26, 'Dancing'),
(27, 'Crossfit');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

DROP TABLE IF EXISTS `membership`;
CREATE TABLE IF NOT EXISTS `membership` (
  `membership_code` int(5) NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `price` int(5) NOT NULL,
  `gym_code` int(5) NOT NULL,
  PRIMARY KEY (`membership_code`),
  KEY `gym_code` (`gym_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`membership_code`, `description`, `price`, `gym_code`) VALUES
(5001, '2 times per week', 500, 20),
(5002, '3 times per week', 900, 26),
(5003, '1 time per week', 200, 24),
(5004, '2 times per week', 400, 24),
(5005, '1 time per week', 300, 26),
(5006, '2 times per week', 500, 21),
(5007, '3 times per week', 1050, 23),
(5008, '2 times per week', 700, 27),
(5009, '1 time per week', 350, 27),
(5010, '3 times per week', 750, 20);

-- --------------------------------------------------------

--
-- Stand-in structure for view `priceview`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `priceview`;
CREATE TABLE IF NOT EXISTS `priceview` (
`description` text
,`price` int(5)
,`name` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

DROP TABLE IF EXISTS `trainers`;
CREATE TABLE IF NOT EXISTS `trainers` (
  `trainer_code` int(5) NOT NULL,
  `trainer_full_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `salary` int(5) NOT NULL,
  PRIMARY KEY (`trainer_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`trainer_code`, `trainer_full_name`, `salary`) VALUES
(3199, 'Miles Moon', 7000),
(3461, 'Halimah Kelly', 3700),
(3534, 'Codie Yoder', 5500),
(3592, 'Leena Boyer', 8000),
(3765, 'Nadine Enriquez', 5800),
(3832, 'Elvis Kerr', 4900),
(3846, 'Annika Graham', 6000),
(3933, 'Bobby Finch', 6200);

-- --------------------------------------------------------

--
-- Structure for view `priceview`
--
DROP TABLE IF EXISTS `priceview`;

DROP VIEW IF EXISTS `priceview`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `priceview`  AS  select `membership`.`description` AS `description`,`membership`.`price` AS `price`,`gyms`.`name` AS `name` from (`membership` join `gyms` on((`membership`.`gym_code` = `gyms`.`gym_code`))) ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounting`
--
ALTER TABLE `accounting`
  ADD CONSTRAINT `accounting_ibfk_1` FOREIGN KEY (`membership_code`) REFERENCES `membership` (`membership_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accounting_ibfk_2` FOREIGN KEY (`client_code`) REFERENCES `clients` (`client_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`trainer_code`) REFERENCES `trainers` (`trainer_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `membership`
--
ALTER TABLE `membership`
  ADD CONSTRAINT `membership_ibfk_1` FOREIGN KEY (`gym_code`) REFERENCES `gyms` (`gym_code`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;