-- phpMyAdmin SQL Dump
-- version 4.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 22, 2013 at 05:49 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `student`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `date` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `role` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `username`, `password`, `email`, `date`, `status`, `role`) VALUES
(4, 'David', '21232f297a57a5a743894a0e4a801fc3', 'david@gmail.com', '2013-12-19 16:19:02', 0, 0),
(17, 'Patrik', 'a97bbdd6bf32edaa84f1cbebfdd5ae38', 'github.user@gmail.com', '2013-12-19 22:28:00', 0, 0),
(11, 'MiniNaim', '21232f297a57a5a743894a0e4a801fc3', 'mininaim@gmail.com', '2013-12-19 17:35:48', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) NOT NULL,
  `date` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `title`, `date`, `status`) VALUES
(34, 'Git', '2013-12-19 22:23:45', 0),
(33, 'Symfony2', '2013-12-19 22:23:21', 0),
(32, 'Scala', '2013-12-19 22:23:11', 0),
(31, 'Ruby on Rails', '2013-12-19 22:22:49', 0),
(30, 'AngularJS', '2013-12-19 22:22:35', 0),
(29, 'NodeJs', '2013-12-19 22:22:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `student_id` int(1) NOT NULL,
  `subject_id` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `student_id`, `subject_id`) VALUES
(40, 4, '29'),
(39, 4, '30'),
(38, 4, '31'),
(37, 4, '33');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
