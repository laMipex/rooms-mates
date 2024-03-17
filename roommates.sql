-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2024 at 01:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roommates`
--

-- --------------------------------------------------------

--
-- Table structure for table `appartment`
--

CREATE TABLE `appartment` (
                              `appID` int(11) NOT NULL,
                              `userID` int(11) NOT NULL,
                              `city` varchar(25) NOT NULL,
                              `address` varchar(40) NOT NULL,
                              `photo` varchar(50) DEFAULT NULL,
                              `rent` decimal(10,0) NOT NULL,
                              `number_rooms` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mates`
--

CREATE TABLE `mates` (
                         `roommateID` int(11) NOT NULL,
                         `userID` int(11) NOT NULL,
                         `age` int(3) NOT NULL,
                         `city` varchar(40) NOT NULL,
                         `photo` varchar(40) DEFAULT NULL,
                         `budget` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
                        `userID` int(11) NOT NULL,
                        `u_fname` varchar(25) NOT NULL,
                        `u_lname` varchar(25) NOT NULL,
                        `email` varchar(50) NOT NULL,
                        `password` varchar(50) NOT NULL,
                        `city` varchar(25) DEFAULT NULL,
                        `photo` varchar(50) DEFAULT NULL,
                        `age` int(3) DEFAULT NULL,
                        `JMBG` varchar(13) NOT NULL,
                        `bio` varchar(50) DEFAULT NULL,
                        `budget` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `u_fname`, `u_lname`, `email`, `password`, `city`, `photo`, `age`, `JMBG`, `bio`, `budget`) VALUES
    (14, 'Stefan56', 'stefa', 'stefangrbintsa@gmail.com', 'uuu', NULL, NULL, NULL, '1234567891111', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appartment`
--
ALTER TABLE `appartment`
    ADD PRIMARY KEY (`appID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `mates`
--
ALTER TABLE `mates`
    ADD PRIMARY KEY (`roommateID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
    ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appartment`
--
ALTER TABLE `appartment`
    MODIFY `appID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mates`
--
ALTER TABLE `mates`
    MODIFY `roommateID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
    MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appartment`
--
ALTER TABLE `appartment`
    ADD CONSTRAINT `appartment_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mates`
--
ALTER TABLE `mates`
    ADD CONSTRAINT `mates_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
