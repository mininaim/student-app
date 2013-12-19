
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
) ENGINE=MyISAM;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `username`, `password`, `email`, `date`, `status`, `role`) VALUES
(1, 'David', '21232f297a57a5a743894a0e4a801fc3', 'david@gmail.com', '2013-12-19 16:19:02', 1, 0),
(2, 'MiniNaim', '21232f297a57a5a743894a0e4a801fc3', 'mininaim@gmail.com', '2013-12-19 17:35:48', 0, 1);

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
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `student_id` int(1) NOT NULL,
  `subject_id` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;