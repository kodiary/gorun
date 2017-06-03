-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2016 at 05:35 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gorun`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

DROP TABLE IF EXISTS `tbl_events`;
CREATE TABLE IF NOT EXISTS `tbl_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_by` int(11) DEFAULT NULL,
  `event_type` int(11) DEFAULT NULL,
  `event_cat` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `website` text,
  `comrade_qualifier` int(11) NOT NULL DEFAULT '0',
  `logo` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `organizer` varchar(255) NOT NULL,
  `organizer_contact` varchar(255) DEFAULT NULL,
  `organizer_email` varchar(255) DEFAULT NULL,
  `organizer_website` varchar(255) DEFAULT NULL,
  `readcount` int(11) NOT NULL DEFAULT '1',
  `visible` tinyint(1) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_events`
--

INSERT INTO `tbl_events` (`id`, `created_by`, `event_type`, `event_cat`, `title`, `description`, `start_date`, `end_date`, `website`, `comrade_qualifier`, `logo`, `file`, `venue`, `longitude`, `latitude`, `province`, `organizer`, `organizer_contact`, `organizer_email`, `organizer_website`, `readcount`, `visible`, `slug`) VALUES
(1, 1261, 6, 3, 'Super Triathlon - South Africa - The triathlon begins', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '2016-09-28', '2016-09-30', 'http://www.lipsum.com/', 0, 'file_1474908088.jpg?rand=17591', '', '107 Albertina Sisulu Rd, Johannesburg, 2000, South Africa', '28.047305100000017', '-26.2041028', 'GP', 'Anwar Ali', '9851180423', 'justdoit2045@gmail.com', 'http://www.lipsum.com/', 0, 1, 'super-triathlon-sa'),
(2, 1261, 6, 3, 'Super Triathlon - South Africa - The triathlon begins', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '2016-09-28', '2016-09-30', 'http://www.lipsum.com/', 0, 'file_1474908309.jpg?rand=22515', '', '107 Albertina Sisulu Rd, Johannesburg, 2000, South Africa', '28.047305100000017', '-26.2041028', 'GP', 'Anwar Ali', '9851180423', 'justdoit2045@gmail.com', 'http://www.lipsum.com/', 0, 0, 'super-triathlon-sa-1'),
(3, 1261, 6, 3, 'Super Triathlon - South Africa - The triathlon begins', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '2016-09-27', '2016-09-30', 'http://www.lipsum.com/', 0, 'file_1474908712.jpg?rand=13348', '', '107 Albertina Sisulu Rd, Johannesburg, 2000, South Africa', '28.047305100000017', '-26.2041028', 'GP', 'Anwar Ali', '9851180423', 'justdoit2045@gmail.com', 'http://www.lipsum.com/', 0, 0, 'super-triathlon-sa-1-2'),
(4, 1261, 7, 3, 'Super Triathlon - South Africa - The triathlon begins', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '2016-09-28', '2016-09-30', 'http://www.lipsum.com/', 0, 'file_1474909247.jpg?rand=28298', '', '107 Albertina Sisulu Rd, Johannesburg, 2000, South Africa', '28.047305100000017', '-26.2041028', 'GP', 'Anwar Ali', '9851180423', 'justdoit2045@gmail.com', 'http://www.lipsum.com/', 0, 0, 'super-triathlon-sa-1-2-3'),
(5, 1261, 1, 1, 'Super Triathlon - South Africa - The triathlon begins', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '2016-09-27', '2016-09-28', 'http://www.lipsum.com/', 1, 'file_1474909818.jpg', '', 'Braamfontein Spruit Trail, Randburg, 2195, South Africa', '28.00576304677736', '-26.143095236943186', 'GP', 'Anwar Ali', '9851180423', 'justdoit2045@gmail.com', 'http://www.lipsum.com/', 0, 1, 'super-triathlon-sa-1-2-3-4'),
(6, 1261, 2, 1, 'Sample Event', '<p>If an object is converted to an array, the result is an array whose elements are the object&#39;s properties. The keys are the member variable names, with a few notable exceptions: integer properties are unaccessible; private variables have the class name prepended to the variable name; protected variables have a &#39;*&#39; prepended to the variable name. These prepended values have null bytes on either side.</p><p>If an object is converted to an array, the result is an array whose elements are the object&#39;s properties. The keys are the member variable names, with a few notable exceptions: integer properties are unaccessible; private variables have the class name prepended to the variable name; protected variables have a &#39;*&#39; prepended to the variable name. These prepended values have null bytes on either side.</p><p>If an object is converted to an array, the result is an array whose elements are the object&#39;s properties. The keys are the member variable names, with a few notable exceptions: integer properties are unaccessible; private variables have the class name prepended to the variable name; protected variables have a &#39;*&#39; prepended to the variable name. These prepended values have null bytes on either side.</p>', '2016-09-29', '2016-09-30', 'http://www.lipsum.com/', 1, 'file_1475135956.jpg', '', '107 Albertina Sisulu Rd, Johannesburg, 2000, South Africa', '28.047305100000017', '-26.2041028', 'GP', 'Anwar Ali', '9851180423', 'justdoit2045@gmail.com', 'http://www.lipsum.com/', 0, 0, 'sample-event');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events_category`
--

DROP TABLE IF EXISTS `tbl_events_category`;
CREATE TABLE IF NOT EXISTS `tbl_events_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `order_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_events_category`
--

INSERT INTO `tbl_events_category` (`id`, `title`, `order_by`) VALUES
(1, 'Run', 1),
(2, 'Bike', 2),
(3, 'Triathlon', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events_file`
--

DROP TABLE IF EXISTS `tbl_events_file`;
CREATE TABLE IF NOT EXISTS `tbl_events_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `mb` varchar(255) DEFAULT NULL,
  `added_on` varchar(255) DEFAULT NULL,
  `added_time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_events_file`
--

INSERT INTO `tbl_events_file` (`id`, `event_id`, `file`, `mb`, `added_on`, `added_time`) VALUES
(1, 1, 'file_1474908111.pdf', '0.06', '2016/09/26', '18:33'),
(2, 2, 'file_1474908505.pdf', '0.06', '2016/09/26', '18:25'),
(3, 3, 'file_1474908892.pdf', '0.06', '2016/09/26', '18:41'),
(4, 4, 'file_1474909265.pdf', '0.06', '2016/09/26', '19:08'),
(5, 5, 'file_1474910069.pdf', '0.06', '2016/09/26', '19:04'),
(6, 6, 'file_1475135977.pdf', '0.06', '2016/09/29', '09:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events_time`
--

DROP TABLE IF EXISTS `tbl_events_time`;
CREATE TABLE IF NOT EXISTS `tbl_events_time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `distance1` varchar(255) DEFAULT NULL,
  `distance2` varchar(255) DEFAULT NULL,
  `distance_swim_1` varchar(255) DEFAULT NULL,
  `distance_swim_2` varchar(255) DEFAULT NULL,
  `distance_bike_1` varchar(255) DEFAULT NULL,
  `distance_bike_2` varchar(255) DEFAULT NULL,
  `distance_run_1` varchar(255) DEFAULT NULL,
  `distance_run_2` varchar(255) DEFAULT NULL,
  `event_from_hour` varchar(255) DEFAULT NULL,
  `event_from_min` varchar(255) DEFAULT NULL,
  `event_cost` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_events_time`
--

INSERT INTO `tbl_events_time` (`id`, `event_id`, `distance1`, `distance2`, `distance_swim_1`, `distance_swim_2`, `distance_bike_1`, `distance_bike_2`, `distance_run_1`, `distance_run_2`, `event_from_hour`, `event_from_min`, `event_cost`) VALUES
(1, 1, NULL, NULL, '12', '1', '12', '12', '12', '12', '12', '12', '12'),
(2, 1, NULL, NULL, '12', '1', '12', '12', '12', '12', '12', '12', '12'),
(3, 2, NULL, NULL, '12', 'q12', '12', '12', '12', '12', '12', '12', '12'),
(4, 3, NULL, NULL, '12', '1', '12', '1', '12', '1', '12', '12', '12'),
(5, 3, NULL, NULL, '12', '1', '12', '1', '12', '1', '12', '12', '12'),
(6, 4, NULL, NULL, '12', '1', '12', '11', '12', '0', '12', '12', '12'),
(7, 5, '23', '2', NULL, NULL, NULL, NULL, NULL, NULL, '23', '23', '23'),
(8, 5, '12', '2', NULL, NULL, NULL, NULL, NULL, NULL, '12', '23', '12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events_type`
--

DROP TABLE IF EXISTS `tbl_events_type`;
CREATE TABLE IF NOT EXISTS `tbl_events_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `order_by` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_events_type`
--

INSERT INTO `tbl_events_type` (`id`, `title`, `order_by`, `cat_id`) VALUES
(1, 'Road Running', 1, 1),
(2, 'Park Run', 2, 1),
(3, 'Trial Running', 3, 1),
(4, 'Road Biking', 4, 2),
(5, 'Mountain Biking', 5, 2),
(6, 'Triathlon - 5150', 6, 3),
(7, 'Triathlon - Sprint', 7, 3),
(8, 'Triathlon - Olympic', 8, 3),
(9, 'Triathlon - Half Ironman', 9, 3),
(10, 'Triathlon - Ironman', 10, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
