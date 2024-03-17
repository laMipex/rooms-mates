-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2024 at 08:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `apartments`
--

CREATE TABLE `apartments` (
  `appID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `town` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `app_number` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `number_room` int(10) NOT NULL,
  `photo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apartments`
--

INSERT INTO `apartments` (`appID`, `userID`, `town`, `address`, `app_number`, `description`, `number_room`, `photo`) VALUES
(66, 71, 'Subotica', '123 Glavna ulica', 101, 'Ovaj udoban stan je savršen za opušten boravak.', 2, 'imgs/room_1'),
(67, 72, 'Subotica', '456 Ul. Brestova', 102, 'Uživajte u boravku u ovom šarmantnom stanu u Subotici.', 2, 'imgs/room_2'),
(68, 73, 'Subotica', '789 Ul. Hrastova', 103, 'Doživite udobnost i praktičnost u ovom stanu u Subotici.', 1, 'imgs/room_3'),
(69, 74, 'Subotica', '101 Ul. Borova', 104, 'Boravite u ovom divnom stanu i istražite Suboticu.', 2, 'imgs/room_4'),
(70, 83, 'Novi Sad', '111 Ul. Reka', 201, 'Otkrijte lepotu Novog Sada iz ovog modernog stana.', 2, 'imgs/room_5'),
(71, 84, 'Novi Sad', '222 Ul. Jezero', 202, 'Boravite u srcu Novog Sada u ovom modernom stanu.', 2, 'imgs/room_6'),
(72, 85, 'Novi Sad', '333 Ul. Šuma', 203, 'Doživite kulturu i istoriju Novog Sada iz ovog stana.', 1, 'imgs/room_7'),
(73, 86, 'Novi Sad', '444 Ul. Planina', 204, 'Opustite se i uživajte u ovom udobnom stanu u Novom Sadu.', 2, 'imgs/room_8'),
(74, 79, 'Nis', '555 Ul. Dolina', 301, 'Istražite znamenitosti Niša iz ovog centralno lociranog stana.', 1, 'imgs/room_9'),
(75, 80, 'Nis', '666 Ul. Brdo', 302, 'Uživajte u boravku u Nišu u ovom udobnom stanu.', 2, 'imgs/room_10'),
(76, 81, 'Nis', '777 Ul. Greben', 303, 'Otkrijte bogatu istoriju Niša iz ovog povoljno smeštenog stana.', 1, 'imgs/room_11'),
(77, 82, 'Nis', '888 Ul. Plaža', 304, 'Ostanite blizu svih dešavanja u Nišu u ovom modernom stanu.', 1, 'imgs/room_12'),
(78, 75, 'Belgrade', '999 Ul. Okean', 401, 'Doživite vibracije Beograda iz ovog stana.', 1, 'imgs/room_13'),
(79, 76, 'Belgrade', '123 Ul. Park', 402, 'Boravite u ovom elegantnom beogradskom stanu i istražite grad.', 2, 'imgs/room_14'),
(80, 77, 'Belgrade', '456 Ul. Bašta', 403, 'Uživajte u udobnosti i praktičnosti u ovom beogradskom stanu.', 2, 'imgs/room_15'),
(81, 78, 'Belgrade', '789 Ul. Trg', 404, 'Otkrijte šarm Beograda iz ovog centralno lociranog stana.', 2, 'imgs/room_16');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `u_fname` varchar(25) NOT NULL,
  `u_lname` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(64) NOT NULL,
  `city` varchar(25) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `jmbg` varchar(13) NOT NULL,
  `bio` varchar(50) DEFAULT NULL,
  `budget` decimal(10,0) DEFAULT NULL,
  `brTel` varchar(20) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `up` int(11) NOT NULL,
  `down` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `u_fname`, `u_lname`, `email`, `password`, `city`, `photo`, `age`, `jmbg`, `bio`, `budget`, `brTel`, `approved`, `up`, `down`) VALUES
(71, 'Marko', 'Petrovic', 'marko@example.com', '$2y$10$2fEsMP1QESq7yWlQ9s6sbuQZyVfofnrlNpbYIZen6Z1s4vY0t0cGG', 'Subotica', 'imgs/person_2.jpg', 25, '0101993782921', 'Marko je ljubitelj prirode i sporta.', 500, '0631466890', 1, 21, 2),
(72, 'Jovana', 'Djordjevic', 'jovana@example.com', '$2y$10$W2TSUXV52fPkBdGAP8cWfu0dAEzrBxpuSmkYKXm/gW.vNltFhlc/G', 'Subotica', 'imgs/person_1.jpg', 30, '0712965446123', 'Jovana je strastvena ljubiteljka knjiga i umetnost', 550, '0698766312', 0, 5, 0),
(73, 'Stefan', 'Nikolic', 'stefan@example.com', '$2y$10$dXmcNEs/3bPbJ8rgrKvkL.jX16CfD0TgAni/.RwNQQ7TRIiSsEehG', 'Subotica', 'imgs/person_4.jpg', 28, '1305902789154', 'Stefan je strucnjak za informacione tehnologije.', 450, '0681422378', 0, 1, 1),
(74, 'Ana', 'Jovanovic', 'ana@example.com', '$2y$10$M1pTTd1rNQWdOiVeDJp3WuFHY7vN2v9vYkCYTcdl0lqVSkx.j5mS2', 'Subotica', 'imgs/person_14.jpg', 32, '2503981295123', 'Ana je posvecena volonterka u lokalnoj zajednici.', 530, '0681422378', 0, 39, 3),
(75, 'Nikola', 'Milic', 'nikola@example.com', '$2y$10$7gRVF/bdIzK7XYgSvGIGBeqUgRlU8kXtM5H5Ay89XbzIL4ZDyINLC', 'Belgrade', 'imgs/person_5.jpg', 27, '3004978642123', 'Nikola je entuzijasta za putovanja i avanture.', 580, '0631466890', 0, 5, 5),
(76, 'Ivana', 'Popovic', 'ivana@example.com', '$2y$10$2tbUU5JVWUa9zZc8N7LpF.fMjwn1wG3y.3TD5x1y.EuTNRnAnP4xC', 'Belgrade', 'imgs/person_9.jpg', 29, '0404961453123', 'Ivana je strastvena kulinarka i voli da eksperimen', 590, '0681422378', 0, 43, 1),
(77, 'Aleksandar', 'Stojanovic', 'aleksandar@example.com', '$2y$10$MlRJf97/hq27xLpHXrdRuOCSpxzblpWWAnY1J7D7nJMVh1H42U4XK', 'Belgrade', 'imgs/person_7.jpg', 31, '1910943841123', 'Aleksandar je strucnjak za digitalni marketing.', 480, '0698766312', 0, 0, 2),
(78, 'Milica', 'Simic', 'milica@example.com', '$2y$10$HNL9LeCqz7GOLoI0OLuz9.3Ncb1pQHlFn2aQoC6aGXlfvlZSV.SFS', 'Belgrade', 'imgs/person_13.jpg', 26, '0806939344123', 'Milica je ljubiteljka mode i umetnosti.', 510, '0655432777', 0, 123, 2),
(79, 'Dejan', 'Stevanovic', 'dejan@example.com', '$2y$10$0oZ9Rn6gRYm6WJgvvzB9NeEYvIq7bqBsSJVm1lPtPeo/RyXpAV9/2', 'Nis', 'imgs/person_10.jpg', 33, '0511927283123', 'Dejan je strastveni sportista i rekreativac.', 560, '0681422378', 0, 76, 0),
(80, 'Marija', 'Stankovic', 'marija@example.com', '$2y$10$nITrDZ8PEI9TOnbU/FjfuOcIqrxcI3hlnUldNWG1.MohW5w7N0VGG', 'Nis', 'imgs/person_1.jpg', 35, '2111916472123', 'Marija je zaljubljenica u prirodu i aktivizam.', 520, '0631466890', 0, 432, 0),
(81, 'Nenad', 'Jankovic', 'nenad@example.com', '$2y$10$Tthu/n.fTzNtysW5dNJgDeOq.43bPRoQ/S9BWfHou0aU8NQUFEA8O', 'Nis', 'imgs/person_11.jpg', 29, '0609912711123', 'Nenad je zaljubljenik u knjige i filmove.', 470, '0681422378', 0, 14, 1),
(82, 'Katarina', 'Simic', 'katarina@example.com', '$2y$10$eI9q6dIbd0eqPZVHH0zRROO3D7tUw/0O2lN6VyfHj/8K9HgyK1no2', 'Nis', 'imgs/person_14.jpg', 31, '3107905134123', 'Katarina je strastveni putnik i avanturista.', 590, '0655432777', 0, 66, 6),
(83, 'Vladimir', 'Djordjevic', 'vladimir@example.com', '$2y$10$owuzl5v.Bb2AZNwO4o8ZyOmtPvYMDrY9iF5NtPjV7sZOOgeHZLDxK', 'Novi Sad', 'imgs/person_15.jpg', 28, '1105892137123', 'Vladimir je zaljubljenik u fotografiju i putovanja', 580, '062339904', 0, 432, 0),
(84, 'Jelena', 'Petrovic', 'jelena@example.com', '$2y$10$Zn5VxEZNlDej0uYBb5VQbu9PGLmCkmw7cd3K3wLHr6ghB2nWUsCqi', 'Novi Sad', 'imgs/person_9.jpg', 30, '2507894826123', 'Jelena je zaljubljenica u umetnost i knjizevnost.', 570, '0681422378', 0, 0, 1),
(85, 'Dusan', 'Markovic', 'dusan@example.com', '$2y$10$59RFw1Eyrck7dmQbCrx', 'Novi Sad', 'imgs/person_16.jpg', 32, '1803883182123', 'Dusan je strastveni gitarista i muzicki entuzijast', 490, '0631466890', 0, 54, 4),
(86, 'Milan', 'Jankovic', 'milan@example.com', '$2y$10$7iTxPY9d8Wwd7ev7d8FeAuB9c24QJ2JW4QzRKdDslMT.QAjDY0q3W', 'Novi Sad', 'imgs/person_10.jpg', 34, '2707885198123', 'Milan je zaljubljenik u fotografiju i prirodu.', 570, '0655432777', 0, 0, 4),
(91, 'Mihajlo', 'Baranovski', 'mihajlobar03@gmail.com', '$2y$10$Hfxs5.tepKFqY5mjpydSFeKQn9W./WEroy2obokLQIOt2/KTTYbDK', NULL, NULL, NULL, '2307003230018', NULL, NULL, NULL, 1, 23, 0),
(92, 'Vladimir', 'Djordjevic', 'vladimir@example.com', '$2y$10$owuzl5v.Bb2AZNwO4o8ZyOmtPvYMDrY9iF5NtPjV7sZOOgeHZLDxK', 'Novi Sad', 'imgs/person_15.jpg', 28, '1105892137123', 'Vladimir je zaljubljenik u fotografiju i putovanja', 580, '062339904', 0, 117, 0),
(93, 'Jelena', 'Petrovic', 'jelena@example.com', '$2y$10$Zn5VxEZNlDej0uYBb5VQbu9PGLmCkmw7cd3K3wLHr6ghB2nWUsCqi', 'Novi Sad', 'imgs/person_9.jpg', 30, '2507894826123', 'Jelena je zaljubljenica u umetnost i knjizevnost.', 570, '0681422378', 0, 54, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apartments`
--
ALTER TABLE `apartments`
  ADD PRIMARY KEY (`appID`),
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
-- AUTO_INCREMENT for table `apartments`
--
ALTER TABLE `apartments`
  MODIFY `appID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apartments`
--
ALTER TABLE `apartments`
  ADD CONSTRAINT `apartments_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
