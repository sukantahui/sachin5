-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 25, 2019 at 08:49 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prakash_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `district_name` varchar(50) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `district_name`, `state_id`) VALUES
(1, 'Alipurduar', 19),
(2, 'Bankura', 19),
(3, 'Birbhum', 19),
(4, 'Burdwan (Bardhaman)', 19),
(5, 'Cooch Behar', 19),
(6, 'Dakshin Dinajpur (South Dinajpur)', 19),
(7, 'Darjeeling', 19),
(8, 'Hooghly', 19),
(9, 'Howrah', 19),
(10, 'Jalpaiguri', 19),
(11, 'Kalimpong', 19),
(12, 'Kolkata', 19),
(13, 'Malda', 19),
(14, 'Murshidabad', 19),
(15, 'Nadia', 19),
(16, 'North 24 Parganas', 19),
(17, 'Paschim Medinipur (West Medinipur)', 19),
(18, 'Purba Medinipur (East Medinipur)', 19),
(19, 'Purulia', 19),
(20, 'South 24 Parganas', 19),
(21, 'Uttar Dinajpur (North Dinajpur)', 19);

-- --------------------------------------------------------

--
-- Table structure for table `maxtable`
--

CREATE TABLE `maxtable` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(50) DEFAULT NULL,
  `current_value` int(5) UNSIGNED ZEROFILL DEFAULT '00000',
  `prefix` varchar(10) DEFAULT NULL,
  `sufix` varchar(10) DEFAULT NULL,
  `financial_year` int(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `id` varchar(12) NOT NULL,
  `person_name` varchar(255) DEFAULT NULL,
  `mailing_name` varchar(255) DEFAULT NULL,
  `sex` varchar(6) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address_line1` varchar(255) DEFAULT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `po` varchar(100) DEFAULT NULL,
  `pin` varchar(12) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `contact_1` varchar(12) DEFAULT NULL,
  `contact_2` varchar(12) DEFAULT NULL,
  `person_category_id` int(11) DEFAULT NULL,
  `user_id` varchar(20) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `person_name`, `mailing_name`, `sex`, `email`, `address_line1`, `address_line2`, `city`, `po`, `pin`, `state`, `contact_1`, `contact_2`, `person_category_id`, `user_id`, `user_password`, `district`) VALUES
('st/0001/1718', 'Priyam Ghosh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 'hui', '917a34072663f9c8beea3b45e8f129c5', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `person_type`
--

CREATE TABLE `person_type` (
  `id` int(11) NOT NULL,
  `person_type_name` varchar(100) DEFAULT NULL,
  `inforce` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person_type`
--

INSERT INTO `person_type` (`id`, `person_type_name`, `inforce`) VALUES
(1, 'Admin', 1),
(2, 'Developer', 1),
(3, 'Staff', 1),
(4, 'Manager', 1),
(5, 'Customer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sale_master`
--

CREATE TABLE `sale_master` (
  `id` varchar(12) NOT NULL,
  `customer_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL DEFAULT '0',
  `state_name` varchar(30) DEFAULT NULL,
  `state_gst_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state_name`, `state_gst_code`) VALUES
(1, 'Jammu & Kashmir', 1),
(2, 'Himachal Pradesh', 2),
(3, 'Punjab', 3),
(4, 'Chandigarh', 4),
(5, 'Uttranchal', 5),
(6, 'Haryana', 6),
(7, 'Delhi', 7),
(8, 'Rajasthan', 8),
(9, 'Uttar Pradesh', 9),
(10, 'Bihar', 10),
(11, 'Sikkim', 11),
(12, 'Arunachal Pradesh', 12),
(13, 'Nagaland', 13),
(14, 'Manipur', 14),
(15, 'Mizoram', 15),
(16, 'Tripura', 16),
(17, 'Meghalaya', 17),
(18, 'Assam', 18),
(19, 'West Bengal', 19),
(20, 'Jharkhand', 20),
(21, 'Odisha (Formerly Orissa', 21),
(22, 'Chhattisgarh', 22),
(23, 'Madhya Pradesh', 23),
(24, 'Gujarat', 24),
(25, 'Daman & Diu', 25),
(26, 'Dadra & Nagar Haveli', 26),
(27, 'Maharashtra', 27),
(28, 'Andhra Pradesh', 28),
(29, 'Karnataka', 29),
(30, 'Goa', 30),
(31, 'Lakshdweep', 31),
(32, 'Kerala', 32),
(33, 'Tamil Nadu', 33),
(34, 'Pondicherry', 34),
(35, 'Andaman & Nicobar Islands', 35),
(36, 'Telangana', 36);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maxtable`
--
ALTER TABLE `maxtable`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Uni_key_maxtable` (`subject_name`,`financial_year`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_category_id` (`person_category_id`),
  ADD KEY `person_category_id_2` (`person_category_id`);

--
-- Indexes for table `person_type`
--
ALTER TABLE `person_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_master`
--
ALTER TABLE `sale_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `maxtable`
--
ALTER TABLE `maxtable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `person_ibfk_2` FOREIGN KEY (`person_category_id`) REFERENCES `person_type` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
