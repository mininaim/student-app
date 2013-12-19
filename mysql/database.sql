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


INSERT INTO `students` (`id`, `username`, `password`, `email`, `date`, `status`, `role`) VALUES
(4, 'David Bandeta', '21232f297a57a5a743894a0e4a801fc3', 'david@gmail.com', '2013-12-11 16:19:02', 0, 0),
(3, 'Mini Naim', 'f96f33f1d64913dd98c76da40ebb572f', 'mininaim@gmail.com', '2013-12-11 15:51:53', 0, 1),
(8, 'Rachid Meksoub', 'e10adc3949ba59abbe56e057f20f883e', 'rachid@gmail.com', '2013-12-11 15:56:47', 0, 0);


CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) NOT NULL,
  `date` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;


INSERT INTO `subjects` (`id`, `title`, `date`, `status`) VALUES
(20, 'Commerce', '2013-12-11 15:57:49', 0),
(19, 'Physics', '2013-12-11 15:57:49', 0),
(17, 'Design', '2013-12-11 15:57:49', 0),
(18, 'Maths', '2013-12-11 15:57:49', 0),
(21, 'Politique', '2013-12-11 15:57:49', 0),
(16, 'Programming', '2013-12-11 15:57:49', 0);


CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `student_id` int(1) NOT NULL,
  `subject_id` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;



INSERT INTO `tags` (`id`, `student_id`, `subject_id`) VALUES
(19, 4, '20');
