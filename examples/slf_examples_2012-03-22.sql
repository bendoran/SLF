DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` tinytext,
  `last_name` tinytext,
  `gender` char(1) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `date_enrolled` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

LOCK TABLES `students` WRITE;

INSERT INTO `students` (`first_name`,`last_name`,`gender`,`dob`,`date_enrolled`)
VALUES
	('Joe','Bloggs','m','1981-05-16','2012-01-01'),
	('Joan','Bloggs','f','1980-04-12','2012-01-02');

UNLOCK TABLES;