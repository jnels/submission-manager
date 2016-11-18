-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2016 at 02:54 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `submission-database`
--

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genre_id` int(2) NOT NULL,
  `genre` varchar(29) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `genre`) VALUES
(1, 'Poetry'),
(2, 'Creative Non-Fiction'),
(3, 'Fiction'),
(4, 'Playwriting');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `reader_id` int(11) NOT NULL,
  `submission_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `rating_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`reader_id`, `submission_id`, `rating`, `rating_id`) VALUES
(1, 62, 1, 42),
(1, 64, 1, 41),
(1, 57, 3, 38),
(1, 56, 1, 37),
(1, 58, 5, 36),
(2, 56, 4, 35);

-- --------------------------------------------------------

--
-- Table structure for table `submission_info`
--

CREATE TABLE `submission_info` (
  `submission_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `submission_date` varchar(10) NOT NULL,
  `title` varchar(29) NOT NULL,
  `genre` varchar(29) NOT NULL,
  `cover_letter` varchar(250) NOT NULL,
  `file_path` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `submission_info`
--

INSERT INTO `submission_info` (`submission_id`, `user_id`, `submission_date`, `title`, `genre`, `cover_letter`, `file_path`) VALUES
(56, 26, '11/10/16', 'Fuddy Duddy Doo', 'Playwriting', 'Your mom said you would like this.', 'uploads/1116/Test_doc.docx'),
(64, 38, '11/17/16', 'Ergonomic Word Filth', 'Creative Non-Fiction', 'Fork in short yourself.', 'uploads/1116/Test4_doc.docx'),
(62, 37, '11/16/16', 'Faster than Jimmy Johns', 'Fiction', 'Zippety do da.', 'uploads/1116/Test3_txt.txt'),
(61, 35, '11/15/16', 'The Cow Who Tipped Me', 'Fiction', 'Y&#39;all better read this.', 'uploads/1116/Test3_doc.docx'),
(60, 34, '11/15/16', 'Office Chair', 'Playwriting', '', 'uploads/1116/Test2_txt.txt'),
(59, 33, '11/13/16', 'How to Con the Nation', 'Creative Non-Fiction', 'Bwahhahahaha...suck it, America.', 'uploads/1116/Test2_doc.docx'),
(58, 32, '11/13/16', 'How to Kill a Coyote', 'Fiction', 'Beep beep', 'uploads/1116/Test_txt.txt'),
(57, 25, '11/10/16', 'Yolo OMG', 'Poetry', 'This is a good submission. Take my word for it.', 'uploads/1116/Test_rtf.rtf');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(2) NOT NULL,
  `name` varchar(29) NOT NULL,
  `address1` varchar(29) NOT NULL,
  `address2` varchar(29) NOT NULL,
  `city` varchar(19) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(49) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `name`, `address1`, `address2`, `city`, `state`, `zip`, `phone`, `email`) VALUES
(38, 'Testy Tester', '10100 Redding Rd.', '', 'Cincinnati', 'OH', '45241', '5135694682', 'test.tester@estyester.com'),
(37, 'Jack B Nimble', '12 Quick Ave', '', 'Fast', 'AR', '18635', '785-963-4566', 'jack.b.nimble@fast.com'),
(35, 'Lonesome Cowboy', '15 Brokeback Ln', '', 'Butte', 'MT', '12384', '586-365-3689', 'lonesome1@yahoo.com'),
(34, 'Ergo Nomic', '3 Back Rd', '', 'Comfy Cushion', 'AL', '00979', '562-123-5453', 'ergo@nomic.net'),
(33, 'Donald Trump', '1 Trump Tower', '', 'New York', 'NY', '66666', '666-123-4567', 'thedubiousdonald@yahoo.com'),
(32, 'Road Runner', '4 Road Rd', '', 'Yolo', 'NE', '45671', '4024612350', 'roger.rabbit@acme.com'),
(26, 'Elmer Fudd', '123 Four', '', 'Last', 'PA', '15626', '458-899-9982', 'elmer@fuddinc.com'),
(25, 'Jerd Nerlson', '12 Ferd Rd', '', 'Gerdville', 'KY', '40123', '270-156-9856', 'omijerd@gmailcom');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `submission_info`
--
ALTER TABLE `submission_info`
  ADD PRIMARY KEY (`submission_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `submission_info`
--
ALTER TABLE `submission_info`
  MODIFY `submission_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
