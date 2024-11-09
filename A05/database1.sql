-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2024 at 01:10 PM
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
-- Database: `database1`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `addressID` int(10) NOT NULL,
  `userInfoID` int(10) NOT NULL,
  `cityID` int(10) NOT NULL,
  `provinceID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`addressID`, `userInfoID`, `cityID`, `provinceID`) VALUES
(0, 0, 0, 0),
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `cityID` int(10) NOT NULL,
  `NAME` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`cityID`, `NAME`) VALUES
(0, 'Tanauan City'),
(1, 'New York City');

-- --------------------------------------------------------

--
-- Table structure for table `closefriends`
--

CREATE TABLE `closefriends` (
  `closeFriendID` int(10) NOT NULL,
  `ownerID` int(10) NOT NULL,
  `userID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `closefriends`
--

INSERT INTO `closefriends` (`closeFriendID`, `ownerID`, `userID`) VALUES
(0, 0, 0),
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentID` int(10) NOT NULL,
  `dateTime` varchar(30) NOT NULL,
  `content` varchar(100) NOT NULL,
  `userID` int(10) NOT NULL,
  `postID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `dateTime`, `content`, `userID`, `postID`) VALUES
(0, '2004-05-01', 'this is a content', 0, 0),
(1, '2004-05-01', 'this is a content', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `friendID` int(10) NOT NULL,
  `requestID` int(10) NOT NULL,
  `requesteeID` int(10) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`friendID`, `requestID`, `requesteeID`, `status`) VALUES
(0, 0, 0, 'Accepted'),
(1, 1, 1, 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `gcmembers`
--

CREATE TABLE `gcmembers` (
  `gcMembersID` int(10) NOT NULL,
  `groupChatID` int(10) NOT NULL,
  `userID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gcmembers`
--

INSERT INTO `gcmembers` (`gcMembersID`, `groupChatID`, `userID`) VALUES
(0, 0, 0),
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `groupchats`
--

CREATE TABLE `groupchats` (
  `groupChatID` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `theme` varchar(100) NOT NULL,
  `adminID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groupchats`
--

INSERT INTO `groupchats` (`groupChatID`, `name`, `picture`, `theme`, `adminID`) VALUES
(0, 'groupChat name', 'image.jpg', 'dark', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `senderID` int(10) NOT NULL,
  `messageID` int(100) NOT NULL,
  `receiverID` int(100) NOT NULL,
  `dateTime` varchar(40) NOT NULL,
  `isRead` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL,
  `attachment` varchar(100) NOT NULL,
  `groupchatID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`senderID`, `messageID`, `receiverID`, `dateTime`, `isRead`, `status`, `attachment`, `groupchatID`) VALUES
(0, 0, 0, '01-05-2024', 'yes', 'delivered', 'this is an attachment', '0'),
(1, 1, 0, '01-05-2024', 'yes', 'delivered', 'this is an attachment', '1');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `content` varchar(100) NOT NULL,
  `dateTime` varchar(20) NOT NULL,
  `privacy` varchar(20) NOT NULL,
  `isDeleted` varchar(10) NOT NULL,
  `attachment` varchar(100) NOT NULL,
  `cityID` int(10) NOT NULL,
  `provinceID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `userID`, `content`, `dateTime`, `privacy`, `isDeleted`, `attachment`, `cityID`, `provinceID`) VALUES
(0, 0, 'this is a content', '01-05-2004', 'public', 'yes', 'this is an attachment', 0, 0),
(1, 1, 'this is a content', '01-05-2004', 'public', 'yes', 'this is an attachment', 1, 1),
(2, 2, 'hi there!', '12-12-2004', 'public', 'no', 'attachment sha', 2, 2),
(3, 3, 'Ako si content', '10-31-2024', 'public', 'no', 'yaz', 2, 2),
(4, 4, 'aku si content din', '10-31-2024', 'public', 'no', 'gorabels', 4, 4),
(5, 5, 'trueness palakpak', '10-31-2024', 'public', 'no', 'gorabels', 5, 5),
(6, 6, 'grabe na ites', '10-31-2024', 'public', 'no', 'totooo', 6, 6),
(7, 7, 'uu trulala', '10-31-2024', 'public', 'no', 'totooo', 7, 7),
(8, 8, 'wala nakong maisip pa', '10-31-2024', 'public', 'no', 'oki', 8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `provinceID` int(10) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`provinceID`, `name`) VALUES
(0, 'Batangas'),
(1, 'Quezon'),
(2, 'Calamba');

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

CREATE TABLE `reactions` (
  `reactionID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `postID` int(10) NOT NULL,
  `kind` varchar(10) NOT NULL,
  `commentID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reactions`
--

INSERT INTO `reactions` (`reactionID`, `userID`, `postID`, `kind`, `commentID`) VALUES
(0, 0, 0, 'yes', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `userInfoID` int(10) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(15) NOT NULL,
  `userID` int(10) NOT NULL,
  `addressID` int(10) NOT NULL,
  `birthday` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`userInfoID`, `firstName`, `lastName`, `userID`, `addressID`, `birthday`) VALUES
(0, 'Janna', 'Macatangay', 0, 0, '01-05-2004'),
(1, 'Mark Joseph', 'Dela Torre', 1, 1, '04-28-2003'),
(2, 'Althea', 'Alberto', 2, 2, '04-04-2004'),
(3, 'Jomari', 'Castillo', 3, 3, '09-8-2001'),
(4, 'Allen', 'Endaya', 4, 4, '03-3-2004'),
(5, 'Jermaine', 'Rianzares', 5, 5, '05-14-2004'),
(6, 'Bryan', 'Reano', 6, 6, '12-5-2004'),
(7, 'Christian', 'Coronado', 7, 7, '12-15-2004'),
(8, 'John Stephen', 'Galaritta', 8, 8, '12-23-2004');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(10) NOT NULL,
  `username` varchar(10) NOT NULL,
  `userInfoID` int(10) NOT NULL,
  `password` varchar(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `willRemember` varchar(20) NOT NULL,
  `isOnline` varchar(20) NOT NULL,
  `messageID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `userInfoID`, `password`, `email`, `phoneNumber`, `willRemember`, `isOnline`, `messageID`) VALUES
(0, 'jannamae5', 0, 'janna-mae-5', 'janna@gmail.com', '09561599121', 'yes', 'active', 0),
(1, 'jannamae6', 1, 'janna-mae65', 'janna6@gmail.com', '09561599122', 'yes', 'active', 1),
(2, 'jannerch7', 2, 'haluwelkam', 'janna5@gmail.com', '09561599121', 'yes', 'active', 2),
(3, 'jannerch8', 3, 'basta', 'janna8@gmail.com', '09561599121', 'yes', 'active', 3),
(4, 'jannerch9', 3, 'basta1', 'janna9@gmail.com', '09561599121', 'yes', 'active', 4),
(5, 'jannerch10', 5, 'basta5', 'janna10@gmail.com', '09561599121', 'yes', 'active', 5),
(6, 'jannerch11', 6, 'basta6', 'janna11@gmail.com', '09561599121', 'yes', 'active', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`addressID`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`cityID`);

--
-- Indexes for table `closefriends`
--
ALTER TABLE `closefriends`
  ADD PRIMARY KEY (`closeFriendID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`friendID`);

--
-- Indexes for table `gcmembers`
--
ALTER TABLE `gcmembers`
  ADD PRIMARY KEY (`gcMembersID`);

--
-- Indexes for table `groupchats`
--
ALTER TABLE `groupchats`
  ADD PRIMARY KEY (`groupChatID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postID`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`provinceID`);

--
-- Indexes for table `reactions`
--
ALTER TABLE `reactions`
  ADD PRIMARY KEY (`reactionID`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`userInfoID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `addressID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `cityID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `friendID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gcmembers`
--
ALTER TABLE `gcmembers`
  MODIFY `gcMembersID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groupchats`
--
ALTER TABLE `groupchats`
  MODIFY `groupChatID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `provinceID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reactions`
--
ALTER TABLE `reactions`
  MODIFY `reactionID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `userInfoID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
