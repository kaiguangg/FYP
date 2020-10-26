SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `password`
-- ----------------------------
DROP TABLE IF EXISTS `password`;
CREATE TABLE IF NOT EXISTS `password` (
	`password_id` int(11) NOT NULL AUTO_INCREMENT,
	`user_id` varchar(11) NOT NULL,
	`generated_password` varchar(255) NOT NULL,
	PRIMARY KEY (`password_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `question`
-- ----------------------------
DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
	`question_id` int(11) NOT NULL AUTO_INCREMENT,
	`question` varchar(255) NOT NULL,
	PRIMARY KEY (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
	`user_id` int(11) NOT NULL AUTO_INCREMENT,
	`first_name` varchar(50) NOT NULL,
	`last_name` varchar(50) NOT NULL,
	`email` varchar(100) NOT NULL,
	`password` varchar(255) NOT NULL,
	`verified` int(1) NOT NULL DEFAULT '0',
	`last_login` datetime NOT NULL,
	`rank` int(1) NOT NULL DEFAULT '1',
	`ip_last` varchar(50) DEFAULT '',
	`ip_reg` varchar(50) DEFAULT NULL,
	`token` varchar(255) DEFAULT NULL,
	`account_created` datetime NOT NULL,
	PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `users_saved_password`
-- ----------------------------
DROP TABLE IF EXISTS `users_saved_password`;
CREATE TABLE IF NOT EXISTS `users_saved_password` (
	`saved_password_id` int(11) NOT NULL AUTO_INCREMENT,
	`user_id` varchar(11) NOT NULL,
	`saved_password` varchar(255) NOT NULL,
	PRIMARY KEY (`saved_password_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `question` (`question_id`, `question`) VALUES (1, 'What is the name of your youngest child?');
INSERT INTO `question` (`question_id`, `question`) VALUES (2, 'What is the name of your school?');
INSERT INTO `question` (`question_id`, `question`) VALUES (3, 'What is the name of your favourite soccer team?');
INSERT INTO `question` (`question_id`, `question`) VALUES (4, 'What is the name of your pet?');
INSERT INTO `question` (`question_id`, `question`) VALUES (5, 'What is the name of your phone brand?');
INSERT INTO `question` (`question_id`, `question`) VALUES (6, 'What is the name of your favourite idol?');
INSERT INTO `question` (`question_id`, `question`) VALUES (7, 'What is the name of your favourite movie title?');
INSERT INTO `question` (`question_id`, `question`) VALUES (8, 'What is the name of your favourite local food?');
INSERT INTO `question` (`question_id`, `question`) VALUES (9, 'What is the name of your favourite country?');
INSERT INTO `question` (`question_id`, `question`) VALUES (10, 'What is the name of your favourite sport?');
INSERT INTO `question` (`question_id`, `question`) VALUES (11, 'What is the name of your favourite game?');