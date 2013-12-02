DROP TABLE IF EXISTS `prefix_groups`;
CREATE TABLE `prefix_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `prefix_groups` (`id`, `name`, `description`) VALUES
	(1,'admin','Administrator'),
	(2,'members','General User');

DROP TABLE IF EXISTS `prefix_users`;
CREATE TABLE `prefix_users` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `modified_time` timestamp ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `initialize` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `fb_id` varchar(20) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  PRIMARY KEY (`id`), 
  UNIQUE (`email`)
);

DROP TABLE IF EXISTS `prefix_users_groups`;
CREATE TABLE `prefix_users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `prefix_login_attempts`;
CREATE TABLE `prefix_login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



