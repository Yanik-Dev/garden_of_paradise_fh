-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2017 at 09:07 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gardenfh_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `name`, `description`) VALUES
(5, 'Testing', ''),
(6, 'Shoul', ''),
(7, 'going', ''),
(8, 'TE', ''),
(9, 'jdhf', ''),
(10, 'sa', ''),
(11, 'aaaaaas', ''),
(12, 'asdd', ''),
(13, 'mmm', ''),
(15, 'jkk', '<p>One of the best funerals.&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fh_users`
--

CREATE TABLE `fh_users` (
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `salt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fh_users`
--

INSERT INTO `fh_users` (`username`, `password`, `salt`) VALUES
('admin', 'f012960e46e809d0097424d206859be166d343795704af8490aca6d5de596687', '15f343');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `path` text NOT NULL,
  `fk_album_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `path`, `fk_album_id`) VALUES
(10, 'mininalism.jpg', 15);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `is_activate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `obituaries`
--

CREATE TABLE `obituaries` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `details` text NOT NULL,
  `date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obituaries`
--

INSERT INTO `obituaries` (`id`, `photo`, `name`, `details`, `date`) VALUES
(1, 'mininalism.jpg', 'Joe Barne', '<p>An Inventory management software system was proposed to be developed to manage and keep track of all data currently being stored on spread sheets. The solution should store all data in a centralized location that is accessible to all users of the system. The system will manage and keep track of:</p><ol><li><p>Inventory Information</p></li></ol><p>The system will also have the following features:</p><ol><li><p>A notification system</p></li><li><p>Generation of reports for the Inventory System</p></li></ol>', 'July 12, 2000 - June 3, 2005'),
(2, NULL, 'Joe Barnes', '<p>An Inventory management software system was proposed to be developed to manage and keep track of all data currently being stored on spread sheets. The solution should store all data in a centralized location that is accessible to all users of the system. The system will manage and keep track of:</p><ol><li><p>Inventory Information</p></li></ol><p>The system will also have the following features:</p><ol><li><p>A notification system</p></li><li><p>Generation of reports for the Inventory System</p></li></ol>', 'July 12, 2000 - June 3, 2005'),
(3, 'blank-profile-picture-973460_960_720.png', 'bghhg', '<p>fhjhjh</p>', 'dgd');

-- --------------------------------------------------------

--
-- Table structure for table `testimonies`
--

CREATE TABLE `testimonies` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonies`
--

INSERT INTO `testimonies` (`id`, `name`, `comment`) VALUES
(2, 'Kate Lately', 'Excellent Service.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_album_id` (`fk_album_id`);

--
-- Indexes for table `obituaries`
--
ALTER TABLE `obituaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonies`
--
ALTER TABLE `testimonies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `obituaries`
--
ALTER TABLE `obituaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `testimonies`
--
ALTER TABLE `testimonies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`fk_album_id`) REFERENCES `albums` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
