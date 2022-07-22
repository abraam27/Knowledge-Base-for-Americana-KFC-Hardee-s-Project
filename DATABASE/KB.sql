-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2022 at 09:17 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorycomment`
--

CREATE TABLE `categorycomment` (
  `categorycommentID` int(5) NOT NULL,
  `comment` varchar(500) CHARACTER SET utf8 NOT NULL,
  `category` int(2) NOT NULL,
  `brand` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorycomment`
--

INSERT INTO `categorycomment` (`categorycommentID`, `comment`, `category`, `brand`) VALUES
(1, 'Abraam', 1, 1),
(2, 'ابرام', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentID` int(5) NOT NULL,
  `comment` varchar(200) CHARACTER SET utf8 NOT NULL,
  `mealID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `dcumentID` int(5) NOT NULL,
  `documentName` varchar(50) CHARACTER SET utf8 NOT NULL,
  `fileName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `type` int(2) NOT NULL,
  `createdDate` varchar(10) CHARACTER SET utf8 NOT NULL,
  `createdTime` varchar(10) CHARACTER SET utf8 NOT NULL,
  `createdBy` varchar(10) CHARACTER SET utf8 NOT NULL,
  `updatedDate` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `updatedTime` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `updatedBy` varchar(10) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

CREATE TABLE `ingredient` (
  `ingredientID` int(5) NOT NULL,
  `ingredient` varchar(200) CHARACTER SET utf8 NOT NULL,
  `mealID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ingredient`
--

INSERT INTO `ingredient` (`ingredientID`, `ingredient`, `mealID`) VALUES
(4, 'tttttttttttttt1\r\n111111', 35),
(5, 'ttttttttttttttt2', 35);

-- --------------------------------------------------------

--
-- Table structure for table `meal`
--

CREATE TABLE `meal` (
  `mealID` int(5) NOT NULL,
  `mealName` varchar(50) CHARACTER SET utf8 NOT NULL,
  `channel` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `mainoffer` int(2) NOT NULL,
  `availability` int(2) NOT NULL,
  `taste` int(2) NOT NULL,
  `category` int(2) NOT NULL,
  `brand` int(2) NOT NULL,
  `mealImage` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meal`
--

INSERT INTO `meal` (`mealID`, `mealName`, `channel`, `mainoffer`, `availability`, `taste`, `category`, `brand`, `mealImage`) VALUES
(35, 'tttttttttt', 'Online', 1, 1, 2, 1, 2, '165544271111193353_692734530830039_1466515386336079048_n.png'),
(36, 'aaa', 'app', 1, 1, 1, 1, 1, ''),
(37, 'aaa', 'app', 1, 1, 1, 1, 1, ''),
(38, 'aaa', 'app', 1, 1, 1, 1, 1, ''),
(39, 'aaa', 'App', 1, 1, 1, 1, 1, '165723320011193353_692734530830039_1466515386336079048_n.png'),
(40, 'aaa', 'App', 1, 1, 1, 1, 1, '165723324411193353_692734530830039_1466515386336079048_n.png'),
(41, 'aaa', 'App', 1, 1, 1, 1, 1, '165723357411193353_692734530830039_1466515386336079048_n.png'),
(42, 'aaa', 'App', 1, 1, 1, 1, 1, '165723362311193353_692734530830039_1466515386336079048_n.png'),
(43, 'aaa', 'App', 1, 1, 1, 1, 1, '165723400511193353_692734530830039_1466515386336079048_n.png');

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `priceID` int(5) NOT NULL,
  `size` int(2) NOT NULL,
  `price` int(5) NOT NULL,
  `mealID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`priceID`, `size`, `price`, `mealID`) VALUES
(10, 1, 11, 35),
(11, 2, 22, 35),
(12, 1, 1, 36),
(13, 2, 2, 36),
(14, 3, 3, 36),
(15, 1, 1, 37),
(16, 2, 2, 37),
(17, 3, 3, 37),
(18, 1, 1, 38),
(19, 2, 2, 38),
(20, 3, 3, 38),
(21, 1, 11, 39),
(22, 2, 22, 39),
(23, 1, 11, 40),
(24, 2, 22, 40),
(25, 1, 11, 41),
(26, 2, 22, 41),
(27, 1, 11, 42),
(28, 2, 22, 42),
(29, 1, 11, 43),
(30, 2, 22, 43);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(5) NOT NULL,
  `userName` varchar(10) CHARACTER SET utf8 NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 NOT NULL,
  `type` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorycomment`
--
ALTER TABLE `categorycomment`
  ADD PRIMARY KEY (`categorycommentID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `mealID` (`mealID`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`dcumentID`);

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`ingredientID`),
  ADD KEY `mealID` (`mealID`);

--
-- Indexes for table `meal`
--
ALTER TABLE `meal`
  ADD PRIMARY KEY (`mealID`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`priceID`),
  ADD KEY `mealID` (`mealID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorycomment`
--
ALTER TABLE `categorycomment`
  MODIFY `categorycommentID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `dcumentID` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `ingredientID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `meal`
--
ALTER TABLE `meal`
  MODIFY `mealID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `priceID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(5) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`mealID`) REFERENCES `meal` (`mealID`);

--
-- Constraints for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD CONSTRAINT `ingredient_ibfk_1` FOREIGN KEY (`mealID`) REFERENCES `meal` (`mealID`);

--
-- Constraints for table `price`
--
ALTER TABLE `price`
  ADD CONSTRAINT `price_ibfk_1` FOREIGN KEY (`mealID`) REFERENCES `meal` (`mealID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
