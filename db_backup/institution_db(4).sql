-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 01, 2019 at 09:29 AM
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
-- Database: `institution_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission`
--

CREATE TABLE `admission` (
  `id` int(11) NOT NULL,
  `person_id` varchar(20) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `session` int(11) DEFAULT NULL,
  `fees` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT '0',
  `inforce` int(11) DEFAULT '1',
  `record_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admission`
--

INSERT INTO `admission` (`id`, `person_id`, `course_id`, `session`, `fees`, `discount`, `inforce`, `record_time`, `update_time`) VALUES
(1, 'st/0001/1718', 9, 1819, 2800, 0, 1, '2019-01-23 16:41:35', NULL),
(2, 'st/0002/1718', 2, 1819, 6000, 0, 1, '2019-01-23 16:42:30', NULL),
(3, 'st/0003/1718', 4, 1819, 35000, 0, 1, '2019-01-23 16:43:23', NULL),
(4, 'st/0004/1718', 3, 1819, 2000, 0, 1, '2019-01-23 16:43:44', NULL),
(5, 'st/0005/1718', 7, 1819, 3800, 0, 1, '2019-01-23 16:44:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `board`
--

CREATE TABLE `board` (
  `id` int(11) NOT NULL,
  `board_name` varchar(10) DEFAULT NULL,
  `inforce` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `board`
--

INSERT INTO `board` (`id`, `board_name`, `inforce`) VALUES
(1, 'CBSE', 1),
(2, 'ICSE/ISC', 1),
(3, 'WBSCTE', 1),
(4, 'OTHERS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `cource_name` varchar(100) DEFAULT NULL,
  `inforce` int(11) DEFAULT '1',
  `duration` varchar(20) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `cource_name`, `inforce`, `duration`) VALUES
(1, 'WBBSE 1 to 4', 1, '0'),
(2, 'WBBSE 5 to 8', 1, '0'),
(3, 'WBBSE 9 to 10', 1, '0'),
(4, 'WBBSE 11 to 12', 1, '0'),
(5, 'ICSE 1 to 4', 1, '0'),
(6, 'ICSE 5 to 8', 1, '0'),
(7, 'ISE 11 to 12', 1, '0'),
(8, 'C Language', 1, '18 classes'),
(9, 'Advanced C Language', 1, '24 classes');

-- --------------------------------------------------------

--
-- Table structure for table `fees_master`
--

CREATE TABLE `fees_master` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `fee` int(11) DEFAULT NULL,
  `mode_id` int(11) DEFAULT NULL,
  `session` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fees_master`
--

INSERT INTO `fees_master` (`id`, `course_id`, `fee`, `mode_id`, `session`) VALUES
(1, 8, 4500, 1, 1819),
(2, 9, 6000, 1, 1819),
(3, 1, 2000, 1, 1819),
(4, 2, 35000, 1, 1819),
(5, 3, 2500, 1, 1819),
(6, 4, 3200, 1, 1819),
(7, 5, 3800, 1, 1819),
(8, 6, 4200, 1, 1819),
(9, 7, 2800, 1, 1819);

-- --------------------------------------------------------

--
-- Table structure for table `fees_mode`
--

CREATE TABLE `fees_mode` (
  `id` int(11) NOT NULL,
  `fees_mode` varchar(20) DEFAULT NULL,
  `inforce` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fees_mode`
--

INSERT INTO `fees_mode` (`id`, `fees_mode`, `inforce`) VALUES
(1, 'monthly', 1),
(2, 'Single', 1);

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

--
-- Dumping data for table `maxtable`
--

INSERT INTO `maxtable` (`id`, `subject_name`, `current_value`, `prefix`, `sufix`, `financial_year`) VALUES
(5, 'student', 00089, 'ST', NULL, 1819);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `id` varchar(20) NOT NULL,
  `person_name` varchar(255) DEFAULT NULL,
  `sex` varchar(6) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address_line1` varchar(255) DEFAULT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `po` varchar(255) DEFAULT NULL,
  `pin` varchar(12) DEFAULT NULL,
  `contact1` varchar(12) DEFAULT NULL,
  `contact2` varchar(12) DEFAULT NULL,
  `school_id` int(255) DEFAULT NULL,
  `person_category_id` int(11) DEFAULT NULL,
  `user_id` varchar(20) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `person_name`, `sex`, `dob`, `father_name`, `mother_name`, `email`, `address_line1`, `address_line2`, `po`, `pin`, `contact1`, `contact2`, `school_id`, `person_category_id`, `user_id`, `user_password`) VALUES
('ST-00026-181', 'dghsd', 'Male', '2019-02-05', 'ghrtsh', 'dshsdh', '', 'hgsh', '', 'hshshs', '5675756', NULL, NULL, 6, 5, NULL, NULL),
('ST-00027-181', 'dghsd', 'Male', '2019-02-05', 'ghrtsh', 'dshsdh', '', 'hgsh', '', 'hshshs', '5675756', '5756756', '', 6, 5, NULL, NULL),
('ST-00028-181', 'abcde', 'Male', '2019-02-05', 'ghrtsh', 'dshsdh', '', 'hgsh', '', 'hshshs', '5675756', '5756756', '', 6, 5, NULL, NULL),
('ST-00029-181', 'abcde', 'Male', '2019-02-05', 'ghrtsh', 'dshsdh', '', 'hgsh', '', 'hshshs', '5675756', '5756756', '', 6, 5, NULL, NULL),
('ST-00032-181', 'dfgsdfg', 'Male', '2019-02-05', 'fdgsd', 'dgsgs', '', 'dsfg', 'dfgsd', 'dfgsd', '456456', '45645645645', '5654656456', 6, 5, NULL, NULL),
('ST-00033-181', 'dgdgdf', 'Male', '2019-02-27', 'gdsfgsdfg', 'dfgsdfsdf', '', 'dfgsdg', 'sdgsdfg', 'dgdsfgdsg', '6757567', '65765756', '7756756', 6, 5, NULL, NULL),
('ST-00037-181', 'avinash singh', 'Male', '2019-02-05', 'gdfgdsf', 'dgdsfg', '', 'dfgsdgsdg', '', 'dfgdsgdf', '546456', '546456546', '', 6, 5, NULL, NULL),
('ST-00039-181', 'subhash rao', 'Male', '2019-02-27', 'fgsdfg', 'dfgdfsg', '', 'dfgdfg', '', 'fgsdgsd', '546546', '45654654', '5464564', 8, 5, NULL, NULL),
('ST-00040-181', 'vikash singh', 'Male', '2019-02-26', 'sdfdfsdf', 'dsafasfs', '', 'dfhgfgh', '', 'fghf', '5756750', '67567567', '', 3, 5, NULL, NULL),
('ST-00041-181', 'vishnu das', 'Male', '2019-02-26', 'fdgdfg', 'gfdg', '', 'fdgfdg', 'dfgds', 'dfgdfg', '5454645', '645645', '54654', 7, 5, NULL, NULL),
('ST-00042-181', 'PRIYAM', 'Male', '2019-02-05', 'DFGDFG', 'DFGDG', '', 'dfgd', '', 'fhfgh', '45654', '45645645', '', 6, 5, NULL, NULL),
('ST-00043-181', 'BIJU', 'Male', '2019-02-24', 'DFDSF', 'DGDFGFD', '', 'ghfhf', '', 'hfgfhfg', '546456', '645654', '', 6, 5, NULL, NULL),
('ST-00046-181', 'SUBHAYAN', 'Male', '2019-02-12', 'IUBSDFB', 'GDFG', '', 'jhgfhghjg', 'ghjghjhg', 'hgjhgjhg', '556657', '657567567', '', 6, 5, NULL, NULL),
('ST-00047-181', 'TANIYA', 'Female', '2019-02-20', 'HRTHRTHR', 'THRTHRTH', '', 'tryrtyrt', 'rtytryr', 'ryertytry', '657675', '7567567567', '', 8, 5, NULL, NULL),
('ST-00049-181', 'PRABIR', 'Male', '2019-02-13', 'GDSFGD', 'BUB', '', 'ergerg', '', 'rgreger', '544546', '546546456', '456546546', 6, 5, NULL, NULL),
('ST-00050-181', 'PRABHAT', 'Male', '2019-02-07', 'FSDFG', 'CTCTU', '', 'sdfdsafsd', 'fsdfsdds', 'fdsfdsfdsf', '234234', '423432423', '342342', 9, 5, NULL, NULL),
('ST-00054-181', 'YHTYH', 'Male', '2019-02-26', 'THTYHRTH', 'TYHTYHTY', '', 'tyhtyhty', '', 'tyhythyt', '567576', '657657657', '657656557', 8, 5, NULL, NULL),
('ST-00056-181', 'ABCF', 'Male', '2019-03-20', 'SACSD', 'SDVSD', '', 'sdvsdv', '', 'vsdvsdv', '443534', NULL, NULL, 4, 5, NULL, NULL),
('ST-00057-181', 'ABCF', 'Male', '2019-03-20', 'SACSD', 'SDVSD', '', 'sdvsdv', '', 'vsdvsdv', '443534', NULL, NULL, 4, 5, NULL, NULL),
('ST-00058-181', 'ABCF', 'Male', '2019-03-20', 'SACSD', 'SDVSD', '', 'sdvsdv', '', 'vsdvsdv', '443534', NULL, NULL, 4, 5, NULL, NULL),
('ST-00059-181', 'ABCF', 'Male', '2019-03-20', 'SACSD', 'SDVSD', '', 'sdvsdv', '', 'vsdvsdv', '443534', NULL, NULL, 4, 5, NULL, NULL),
('ST-00060-181', 'SDVDS', 'Male', '2019-03-19', 'VSDVS', 'VVSV', '', 'vsvsdvsvvvvvvvvvvvvvvv', 'vvvvvvvvdvsdvsd', 'fdgfdgd', '345435', NULL, NULL, 4, 5, NULL, NULL),
('ST-00061-181', 'DGDG', 'Male', '2019-03-19', 'DGDFGDFG', 'DFGDFGF', '', 'fgdgd', 'dgdfg', 'fdgdfg', '56546', NULL, NULL, 4, 5, NULL, NULL),
('ST-00062-181', 'DGDG', 'Male', '2019-03-19', 'DGDFGDFG', 'DFGDFGF', '', 'fgdgd', 'dgdfg', 'frfergeg', '56546', NULL, NULL, 4, 5, NULL, NULL),
('ST-00063-181', 'DFGDG', 'Male', '2019-03-21', 'GFGFGD', 'DGDFGDF', '', 'dfgdfgdf', '', 'dfgdfgdf', '435454', '3453534535', '3453453545', 4, 5, NULL, NULL),
('ST-00064-181', 'Mou Podder3', 'Female', '2000-05-02', NULL, NULL, 'moupodder@gmail.com', 'Barrackpore', 'N C Pukur', 'n c pukur', '04508456', NULL, NULL, NULL, 5, NULL, NULL),
('ST-00065-181', 'abijit', 'Female', '2000-05-02', NULL, NULL, 'moupodder@gmail.com', 'Barrackpore', 'N C Pukur', 'n c pukur', '04508456', NULL, NULL, NULL, 5, NULL, NULL),
('ST-00066-181', 'atif', 'Female', '2000-05-02', NULL, NULL, 'moupodder@gmail.com', 'Barrackpore', 'N C Pukur', 'n c pukur', '04508456', NULL, NULL, NULL, 5, NULL, NULL),
('ST-00071-181', 'dsfsdf', NULL, NULL, NULL, NULL, '', 'fdssdfdasfd', 'fsdfsdf', NULL, '53454353', '34534534', '345345', 2, 5, NULL, NULL),
('ST-00072-181', 'dfgdfgdf', NULL, NULL, NULL, NULL, '', 'gdfgdfgd', 'fgdfgfdgfd', NULL, '54353451', '4534534', '534534534', 6, 5, NULL, NULL),
('ST-00073-181', 'hththth', NULL, NULL, NULL, NULL, '', 'thtrtrhrttrgsgses', 'gegergregre', NULL, '54654654645', '4564565465', '456456456', 5, 5, NULL, NULL),
('ST-00074-181', 'gerger', NULL, NULL, NULL, NULL, '', 'rgegerg', 'ergergerg', NULL, '534534', '43534534', '53453454353', 6, 5, NULL, NULL),
('ST-00075-181', 'fgsdgdfgdf', NULL, NULL, NULL, NULL, '', 'dfgdsfgdfgf', 'dgfdgsdfg', NULL, '5344353', '53453453', '453453453', 9, 5, NULL, NULL),
('ST-00076-181', 'dsdfsdf', NULL, NULL, NULL, NULL, '', 'sdfdsfsd', 'fsdfsdfsd', NULL, '3423423423', '4234234', '23423423435', 5, 5, NULL, NULL),
('ST-00077-181', 'werwerwe', NULL, NULL, NULL, NULL, '', 'rsdfgdg', 'fgdgee', NULL, '56456', '4654654654', '45654654', 6, 5, NULL, NULL),
('ST-00079-181', 'abcd', NULL, NULL, NULL, NULL, NULL, 'fsdfsdfsd', 'fsdfsdfsd', NULL, '5345341', '34534534', '5345345', 8, 5, NULL, NULL),
('ST-00080-181', 'abhirup', NULL, '2019-03-27', NULL, NULL, NULL, 'sefsefase', 'grefgerg', NULL, '34534534', '5345345', '345345', 5, 5, NULL, NULL),
('ST-00081-181', 'abhijaya', NULL, '2019-03-26', NULL, NULL, NULL, 'dfgdfgdf', 'gdfgdfgdfg', 'fghgfhfg', '654654654', '546546', '45654654', 4, 5, NULL, NULL),
('ST-00082-181', 'rdgrdgdrg', NULL, '2019-05-29', 'drgdgdrg', 'drgdrgdr', NULL, 'drgrdgd', 'gdrgdrg', NULL, '4654646', '46456456', '45654654', 4, 5, NULL, NULL),
('ST-00083-181', 'abcdefgh', 'Male', '2019-03-19', 'dsfdsf', 'dsfgdfgdfg', '', 'gdfgdg', 'dfgfdgdfg', 'dfgfdgdfg', '565465', '456546546', '5465465464', 6, 5, NULL, NULL),
('ST-00085-181', 'aqwer', 'Male', '2019-03-12', 'dfghdfg', 'fgfdgdgdf', '', 'fgfdgfdgdfg', '', 'dfgfdgfdgdf', '546456', '6546546546', '5465465465', 4, 5, NULL, NULL),
('ST-00086-181', 'asxz', 'Male', '2019-03-15', 'rfsfdsaf', 'afasdfasdfas', '', 'sdfasfafsa', '', 'sdafdsfsfs', '546456', '4565464564', '6456546445', 7, 5, NULL, NULL),
('ST-00087-181', 'gsdfgdfg', 'Male', '2019-03-06', 'dfgsdfgdf', 'gfsdgfdgsdg', '', 'fdgsdgsdfg', 'dgsdfgdf', 'gdfgdfgdfg', '465465', '6546546546', '6456546546', 9, 5, NULL, NULL),
('ST-00088-181', 'fghfghfgdh', 'Male', '2019-03-05', 'fhfghfgh', 'fghfghfgd', '', 'fghfdhfdghf', 'dhfghffhgfhdf', 'dgdfgsdgdfdg', '456546', '4564564564', NULL, 9, 5, NULL, NULL),
('st/0001/1718', 'Priyam Ghosh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 3, 'hui', '917a34072663f9c8beea3b45e8f129c5'),
('st/0002/1718', 'Pallaby Das', 'Female', '2019-03-12', 'regregre', 'ergerger', NULL, 'regergeg', 'regrege', 'bgffgdhgdfhfh', '534533', '4354353454', '5345345345', 1, 5, 'pallaby12', '917a34072663f9c8beea3b45e8f129c5'),
('st/0003/1718', 'tansi agarwal', 'Female', '2019-04-30', 'sfefewf', 'wefwefwef', NULL, 'wefegrtyruytjt', 'hfghrtergegrgdf', 'tertreg gfgreg', '546554', '4564565464', '6546456546', 5, 5, 'tansi12', '917a34072663f9c8beea3b45e8f129c5'),
('st/0004/1718', 'tanisa dey', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 5, 'tanisha12', '917a34072663f9c8beea3b45e8f129c5'),
('st/0005/1718', 'jitu ghosh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 5, 'jitu12', '917a34072663f9c8beea3b45e8f129c5');

-- --------------------------------------------------------

--
-- Table structure for table `person_category`
--

CREATE TABLE `person_category` (
  `id` int(11) NOT NULL,
  `person_type_name` varchar(100) DEFAULT NULL,
  `inforce` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person_category`
--

INSERT INTO `person_category` (`id`, `person_type_name`, `inforce`) VALUES
(1, 'Admin', 1),
(2, 'Developer', 1),
(3, 'Staff', 1),
(4, 'Manager', 1),
(5, 'Student', 1);

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
(5, 'Student', 1);

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int(11) NOT NULL,
  `school_name` varchar(100) DEFAULT NULL,
  `board_id` int(11) DEFAULT NULL,
  `inforce` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `school_name`, `board_id`, `inforce`) VALUES
(1, 'Douglas Memorial Higher Secondary School', 2, 1),
(2, 'S.T AUGUSTINE BARRACKPORE', 2, 1),
(3, 'S.T AUGUSTINE SHYAMNAGAR', 2, 1),
(4, 'KENDRA VIDIYALAY', 1, 1),
(5, 'MANMAATHANATH BOYS', 3, 1),
(6, 'MANMATHANATH GIRLS', 3, 1),
(7, 'CALCUTA UNIVERSITY', 4, 1),
(8, 'BARASAT UNIVERSITY', 4, 1),
(9, 'BHOLANANDA', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission`
--
ALTER TABLE `admission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`person_id`,`course_id`),
  ADD KEY `admission_ibfk_2` (`course_id`);

--
-- Indexes for table `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees_master`
--
ALTER TABLE `fees_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fees_master_ibfk_1` (`mode_id`);

--
-- Indexes for table `fees_mode`
--
ALTER TABLE `fees_mode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maxtable`
--
ALTER TABLE `maxtable`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subject_name` (`subject_name`,`financial_year`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `person_category_id` (`person_category_id`),
  ADD KEY `person_category_id_2` (`person_category_id`);

--
-- Indexes for table `person_category`
--
ALTER TABLE `person_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `person_type`
--
ALTER TABLE `person_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`),
  ADD KEY `board_id` (`board_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `board`
--
ALTER TABLE `board`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `maxtable`
--
ALTER TABLE `maxtable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admission`
--
ALTER TABLE `admission`
  ADD CONSTRAINT `admission_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `admission_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `fees_master`
--
ALTER TABLE `fees_master`
  ADD CONSTRAINT `fees_master_ibfk_1` FOREIGN KEY (`mode_id`) REFERENCES `fees_mode` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `school`
--
ALTER TABLE `school`
  ADD CONSTRAINT `school_ibfk_1` FOREIGN KEY (`board_id`) REFERENCES `board` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
