DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `to` varchar(200) NOT NULL,
  `from` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `time` varchar(200) NOT NULL,
  `sender_read` varchar(200) NOT NULL,
  `receiver_read` varchar(200) NOT NULL,
  `sender_deleted` varchar(200) NOT NULL,
  `receiver_deleted` varchar(200) NOT NULL,
  `file` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `chat_added_files`;
CREATE TABLE IF NOT EXISTS `chat_added_files` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `file` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `chat_vpb_online_users`;
CREATE TABLE IF NOT EXISTS `chat_vpb_online_users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `chat_vpb_users`;
CREATE TABLE IF NOT EXISTS `chat_vpb_users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `photo` text NOT NULL,
  `date` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `chat_vpb_users`
--

INSERT INTO `chat_vpb_users` (`id`, `fullname`, `username`, `password`, `photo`, `date`) VALUES
(1, 'Greg Joshua', 'victor', 'bd4fae4c48fe342d983a38218f97dad5', 'victor.gif', '02-01-2013'),
(2, 'Emmanuala Nero', 'emy', 'bd4fae4c48fe342d983a38218f97dad5', 'emy.gif', '02-01-2013'),
(3, 'Vasplus Blog', 'vasplus', 'bd4fae4c48fe342d983a38218f97dad5', '', '02-01-2013'),
(4, 'Kenneth Roggers', 'kenneth', 'bd4fae4c48fe342d983a38218f97dad5', 'kenneth.gif', '02-01-2013'),
(5, 'Greg Joshua Emi', 'emito', 'bd4fae4c48fe342d983a38218f97dad5', '', '02-01-2013'),
(6, 'Sydney Odell', 'sydney', 'bd4fae4c48fe342d983a38218f97dad5', '', '02-01-2013'),
(7, 'Justin Chukwu', 'justin', 'bd4fae4c48fe342d983a38218f97dad5', '', '02-01-2013'),
(8, 'James Edword', 'james', 'bd4fae4c48fe342d983a38218f97dad5', '', '04-01-2013'),
(9, 'Oluwa Depu', 'dupes', 'bd4fae4c48fe342d983a38218f97dad5', '', '05-01-2013');