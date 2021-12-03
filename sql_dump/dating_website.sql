-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2021 at 05:48 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dating_website`
--
CREATE DATABASE IF NOT EXISTS `dating_website` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dating_website`;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE `favorites` (
  `user_id` int(11) NOT NULL,
  `favorite_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`user_id`, `favorite_user_id`) VALUES
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `message_id` int(10) NOT NULL,
  `sender_id` int(10) NOT NULL,
  `reciever_id` int(10) NOT NULL,
  `message_content` varchar(250) NOT NULL,
  `time_sent` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `read_unread` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `sender_id`, `reciever_id`, `message_content`, `time_sent`, `read_unread`) VALUES
(1, 1, 3, 'hello', '2021-11-29 22:37:00.000000', 1),
(2, 1, 3, 'how are you?', '2021-11-29 22:39:08.000000', 1),
(3, 3, 1, 'i am very good', '2021-11-29 22:42:45.000000', 1),
(4, 3, 1, 'have you seen any of my movies?', '2021-11-29 22:42:54.000000', 1),
(5, 3, 1, 'sdfhgnhmgj', '2021-12-02 19:24:51.000000', 1),
(6, 1, 3, 'wanna meet?', '2021-12-03 03:55:44.000000', 1),
(7, 1, 3, 'I know a cool place', '2021-12-03 03:56:02.000000', 1),
(8, 3, 1, 'ok', '2021-12-03 03:59:29.000000', 1),
(9, 1, 3, 'what kind of music do you listen to?', '2021-12-03 04:00:07.000000', 1),
(10, 3, 1, 'hip-hop', '2021-12-03 04:08:23.000000', 1),
(11, 3, 1, 'you?', '2021-12-03 04:08:30.000000', 1),
(12, 1, 3, 'same', '2021-12-03 04:08:58.000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `content` varchar(250) NOT NULL,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `sender_id`, `content`, `type`) VALUES
(2, 2, 3, ' ignored your wink :(', 1),
(21, 2, 1, ' added you to their Favorites List', 1),
(22, 3, 1, ' added you to their Favorites List', 1),
(23, 3, 1, ' removed you from their Favorites List', 1),
(24, 2, 1, ' removed you from their Favorites List', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `username`, `password`) VALUES
(1, 'Aakash', 'Singh', 'aaka98', 'randomPassword@123'),
(2, 'Harman', 'Harman', 'harmanUser', 'harmanUser@123'),
(3, 'Monica', 'Bellucci', 'missmalena', 'missmalenamanhunt'),
(4, 'Yagnesh', 'Patel', 'yagneskalagnes', 'thodabadapassword@123'),
(5, 'Ramesh', 'Patel', 'thisEmail@email', 'passpasspasspass');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE `user_details` (
  `user_id` int(10) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `interested_in` varchar(50) NOT NULL,
  `marital_status` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `profile_image` varchar(250) NOT NULL,
  `age` int(10) NOT NULL,
  `user_type` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `date_of_birth`, `gender`, `interested_in`, `marital_status`, `country`, `city`, `profile_image`, `age`, `user_type`) VALUES
(1, '1998-10-30', 'Male', 'Female', 'Single', 'Canada', 'Montreal', 'aakashprofile.jpeg', 23, 0),
(2, '1995-10-15', 'Male', 'Female', 'Divorced', 'Canada', 'Toronto', 'harmanprofile.jpg', 26, 0),
(3, '1988-10-30', 'Female', 'Male', 'Married', 'Italy', 'Rome', 'monicanewprofile-1638491614.jpg', 36, 1),
(4, '1997-10-20', 'Male', 'Female', 'Single', 'Canada', 'Toronto', 'yagneshprofile.jpg', 24, 0),
(5, '2000-05-09', 'Male', 'Female', 'Single', 'India', 'Vadodara', 'noImage.jpg', 22, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_images`
--

DROP TABLE IF EXISTS `user_images`;
CREATE TABLE `user_images` (
  `user_id` int(10) NOT NULL,
  `image_path` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_images`
--

INSERT INTO `user_images` (`user_id`, `image_path`) VALUES
(1, 'aakash1.jpg'),
(1, 'aakash2.jpg'),
(1, 'aakash3.jpg'),
(1, 'aakash4.jpg'),
(1, 'aakash5.jpg'),
(2, 'harman.jpg'),
(2, 'harman2.jpg'),
(2, 'harman3.jpg'),
(3, 'monica1.jpg'),
(3, 'monica2.jpg'),
(3, 'monica3.jpg'),
(3, 'monica4.jpg'),
(4, 'yagnesh1.jpg'),
(4, 'yagnesh2.jpeg'),
(4, 'yagnesh3.jpg'),
(4, 'yagnesh4.jpg'),
(1, 'hrithik_roshan.jpg'),
(3, 'monicaBelluci.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_interests`
--

DROP TABLE IF EXISTS `user_interests`;
CREATE TABLE `user_interests` (
  `user_id` int(10) NOT NULL,
  `interest` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_interests`
--

INSERT INTO `user_interests` (`user_id`, `interest`) VALUES
(1, 'chess'),
(1, 'movies'),
(1, 'comedy'),
(1, 'pets'),
(2, 'spirituality'),
(2, 'food'),
(2, 'programming'),
(2, 'gaming'),
(4, 'web development'),
(4, 'singing'),
(4, 'veganism'),
(3, '   acting'),
(3, 'singing'),
(3, 'pets'),
(3, 'comedy'),
(3, 'chess'),
(3, 'modeling  '),
(5, 'boxing');

-- --------------------------------------------------------

--
-- Table structure for table `winks`
--

DROP TABLE IF EXISTS `winks`;
CREATE TABLE `winks` (
  `wink_id` int(10) NOT NULL,
  `sender_id` int(10) NOT NULL,
  `reciever_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `winks`
--
ALTER TABLE `winks`
  ADD PRIMARY KEY (`wink_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `winks`
--
ALTER TABLE `winks`
  MODIFY `wink_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
