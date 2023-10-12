-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 05, 2022 at 02:41 PM
-- Server version: 8.0.27
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mb1591`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendee`
--

CREATE TABLE `attendee` (
  `idattendee` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendee`
--

INSERT INTO `attendee` (`idattendee`, `name`, `password`, `role`) VALUES
(71, 'user5', '5a39bead318f306939acb1d016647be2e38c6501c58367fdb3e9f52542aa2442', 3),
(70, 'user4', '5269ef980de47819ba3d14340f4665262c41e933dc92c1a27dd5d01b047ac80e', 3),
(68, 'user3', '5860faf02b6bc6222ba5aca523560f0e364ccd8b67bee486fe8bf7c01d492ccb', 3),
(66, 'user1', '0a041b9462caa4a31bac3567e0b6e6fd9100787db2ab433d96f6d178cabfce90', 3),
(67, 'user2', '6025d18fe48abd45168528f18a82e265dd98d421a7084aa09f61b341703901a3', 3),
(63, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1),
(72, 'manager1', '380f9771d2df8566ce2bd5b8ed772b0bb74fd6457fb803ab2d267c394d89c750', 2),
(73, 'manager2', '9d05b6092d975b0884c6ba7fadb283ced03da9822ebbd13cc6b6d1855a6495ec', 2),
(76, 'manager3', '42385b24804a6609a2744d414e0bf945704427b256ab79144b9ba93f278dbea7', 2);

-- --------------------------------------------------------

--
-- Table structure for table `attendee_event`
--

CREATE TABLE `attendee_event` (
  `event` int NOT NULL,
  `attendee` int NOT NULL,
  `paid` tinyint NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendee_session`
--

CREATE TABLE `attendee_session` (
  `session` int NOT NULL,
  `attendee` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendee_session`
--

INSERT INTO `attendee_session` (`session`, `attendee`) VALUES
(17, 45),
(18, 63),
(19, 66),
(19, 69),
(19, 73),
(19, 76),
(21, 73),
(23, 65),
(23, 66),
(23, 73),
(24, 65),
(25, 69),
(25, 73);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `idevent` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datestart` datetime NOT NULL,
  `dateend` datetime NOT NULL,
  `numberallowed` int NOT NULL,
  `venue` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`idevent`, `name`, `datestart`, `dateend`, `numberallowed`, `venue`) VALUES
(39, 'NorthWest IT Conference', '2022-09-16 00:03:00', '2022-09-18 04:03:00', 40, 12),
(43, 'JavaCon: 2022', '2022-09-23 00:00:00', '2022-09-24 00:00:00', 30, 12),
(44, 'Barbecue: Challenges and the Future', '2022-09-15 00:00:00', '2022-09-16 00:00:00', 44, 18),
(46, 'Pizza Event', '2022-09-15 00:00:00', '2022-09-15 00:00:00', 55, 12),
(47, 'Viva Mexico', '2022-09-16 00:00:00', '2022-09-17 00:00:00', 44, 12);

-- --------------------------------------------------------

--
-- Table structure for table `ipaddress`
--

CREATE TABLE `ipaddress` (
  `id` mediumint NOT NULL,
  `ip` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ipaddress`
--

INSERT INTO `ipaddress` (`id`, `ip`) VALUES
(1, '10.10.0.222');

-- --------------------------------------------------------

--
-- Table structure for table `manager_event`
--

CREATE TABLE `manager_event` (
  `event` int NOT NULL,
  `manager` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `id` mediumint NOT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `nick_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `last_name`, `first_name`, `nick_name`) VALUES
(1, 'Marasovic', 'Kristina', 'KM'),
(2, 'Ivic', 'Ivo', 'II'),
(3, 'Doe', 'Jane', 'JD');

-- --------------------------------------------------------

--
-- Table structure for table `phonenumber`
--

CREATE TABLE `phonenumber` (
  `id` mediumint NOT NULL,
  `phone_type` varchar(10) DEFAULT NULL,
  `country_code` varchar(4) DEFAULT NULL,
  `phone_number` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phonenumber`
--

INSERT INTO `phonenumber` (`id`, `phone_type`, `country_code`, `phone_number`) VALUES
(1, 'office', '+385', '92123456'),
(1, 'cell', '+385', '91123456'),
(2, 'office', '+384', '98123456');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `idrole` int NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`idrole`, `name`) VALUES
(1, 'admin'),
(2, 'event manager'),
(3, 'attendee');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `idsession` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numberallowed` int NOT NULL,
  `event` int NOT NULL,
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`idsession`, `name`, `numberallowed`, `event`, `startdate`, `enddate`) VALUES
(23, 'Session II', 200, 43, '2022-09-12 00:00:00', '2022-09-12 00:00:00'),
(22, 'Session I', 20, 43, '2022-09-10 00:00:00', '2022-09-10 00:00:00'),
(19, 'Session I', 100, 44, '2022-09-03 00:00:00', '2022-09-03 00:00:00'),
(21, 'Session II', 200, 44, '2022-09-03 00:00:00', '2022-09-03 12:00:00'),
(24, 'Session III', 20, 43, '2022-09-24 00:00:00', '2022-09-24 00:00:00'),
(25, 'Session IV', 40, 43, '2022-09-08 00:00:00', '2022-09-16 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `urole`
--

CREATE TABLE `urole` (
  `id` int NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `urole`
--

INSERT INTO `urole` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `uname` varchar(30) NOT NULL,
  `upassword` varchar(100) NOT NULL,
  `urole` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `uname`, `upassword`, `urole`) VALUES
(1, 'admin', 'admin', 1),
(2, 'km', 'km', 2);

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `idvenue` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`idvenue`, `name`, `capacity`) VALUES
(14, 'Atlantis', 50),
(13, 'Paradise Gardens', 30),
(12, 'The Avenuee', 40),
(15, 'The Blue Fin', 20),
(16, 'The Greenhouse', 42),
(17, 'Big Orchid', 40),
(18, 'Lotus Lakes', 120);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendee`
--
ALTER TABLE `attendee`
  ADD PRIMARY KEY (`idattendee`),
  ADD KEY `role_idx` (`role`);

--
-- Indexes for table `attendee_event`
--
ALTER TABLE `attendee_event`
  ADD PRIMARY KEY (`event`,`attendee`);

--
-- Indexes for table `attendee_session`
--
ALTER TABLE `attendee_session`
  ADD PRIMARY KEY (`session`,`attendee`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`idevent`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD KEY `venue_fk_idx` (`venue`);

--
-- Indexes for table `ipaddress`
--
ALTER TABLE `ipaddress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manager_event`
--
ALTER TABLE `manager_event`
  ADD PRIMARY KEY (`event`,`manager`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`idrole`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`idsession`);

--
-- Indexes for table `urole`
--
ALTER TABLE `urole`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`urole`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`idvenue`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendee`
--
ALTER TABLE `attendee`
  MODIFY `idattendee` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `idevent` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `ipaddress`
--
ALTER TABLE `ipaddress`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id` mediumint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `idrole` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `idsession` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `urole`
--
ALTER TABLE `urole`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `idvenue` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
