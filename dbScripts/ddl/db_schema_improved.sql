DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `fullname` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `country_code` char(3) NOT NULL DEFAULT '',
  `name` char(52) NOT NULL DEFAULT '',
  `continent` enum('Asia','Europe','North America','Africa','Oceania','Antarctica','South America') NOT NULL DEFAULT 'Asia',
  `capital` int(11) DEFAULT NULL,
  PRIMARY KEY (`country_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `city`;
CREATE TABLE `city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` char(3) NOT NULL DEFAULT '',
  `name` char(35) NOT NULL DEFAULT '',
  `district` char(20) NOT NULL DEFAULT '',
  `population` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`city_id`),
  KEY `country_code` (`country_code`),
  CONSTRAINT `city_fk_1` FOREIGN KEY (`country_code`) REFERENCES `country` (`country_code`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `trip`;
CREATE TABLE `trip` (
  `trip_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `city_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`trip_id`),
  UNIQUE KEY `unique_id` (`trip_id`),
  CONSTRAINT `user_fk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `city_fk_2` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `user` ADD column `role` enum ('admin', 'user') NOT NULL DEFAULT 'user';

ALTER TABLE `trip` ADD COLUMN `tourists_count` INTEGER(32) default 1;
AlTER TABLE `trip` ADD COLUMN `nights_count` INTEGER(32) default 1;

DROP TABLE IF EXISTS `baggage_category`;
CREATE TABLE IF NOT EXISTS `baggage_category` (
  `baggage_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(35) NOT NULL,
  PRIMARY KEY (`baggage_category_id`),
  UNIQUE KEY `baggage_category_id` (`baggage_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `predefined_baggage_item`;
CREATE TABLE `predefined_baggage_item` (
  `predefined_baggage_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(35) NOT NULL DEFAULT '',
  `category_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`predefined_baggage_item_id`),
  CONSTRAINT `baggage_category_fk_2` FOREIGN KEY (`category_id`) REFERENCES `baggage_category` (`baggage_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4080 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `baggage_item`;
CREATE TABLE `baggage_item`(
  `baggage_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `trip_id` int(11) NOT NULL DEFAULT '0',
  `predefined_baggage_item_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`baggage_item_id`),
  CONSTRAINT `predefined_baggage_item_fk_1` FOREIGN KEY (`predefined_baggage_item_id`) REFERENCES `predefined_baggage_item` (`predefined_baggage_item_id`),
  CONSTRAINT `trip_fk_3` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`trip_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `custom_baggage_item`;
CREATE TABLE `custom_baggage_item`(
  `custom_baggage_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `trip_id` int(11) NOT NULL DEFAULT '0',
  `name` char(35) NOT NULL DEFAULT '',
  `category_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`custom_baggage_item_id`),
  CONSTRAINT `trip_fk_4` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`trip_id`) ON DELETE CASCADE,
  CONSTRAINT `baggage_category_fk_1` FOREIGN KEY (`category_id`) REFERENCES `baggage_category` (`baggage_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `budget_category`;
CREATE TABLE IF NOT EXISTS `budget_category` (
  `budget_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(35) NOT NULL,
  PRIMARY KEY (`budget_category_id`),
  UNIQUE KEY `budget_category_id` (`budget_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `predefined_budget_item`;
CREATE TABLE `predefined_budget_item` (
  `predefined_budget_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `budget_category_id` int(11) NOT NULL DEFAULT '0',
  `name` char(35) NOT NULL DEFAULT '',
  `shared` enum ('0', '1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`predefined_budget_item_id`),
  CONSTRAINT `budget_category_fk_1` FOREIGN KEY (`budget_category_id`) REFERENCES `budget_category` (`budget_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4080 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `budget`;
CREATE TABLE `budget`(
  `budget_id` int(11) NOT NULL AUTO_INCREMENT,
  `trip_id` int(11) NOT NULL DEFAULT '0',
  `predefined_budget_item_id` int(11) NOT NULL DEFAULT '0',
  `cost` DECIMAL NOT NULL DEFAULT 0,
  PRIMARY KEY (`budget_id`),
  CONSTRAINT `predefined_budget_item_fk_1` FOREIGN KEY (`predefined_budget_item_id`) REFERENCES `predefined_budget_item` (`predefined_budget_item_id`),
  CONSTRAINT `trip_fk_5` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`trip_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `custom_budget`;
CREATE TABLE `custom_budget`(
  `custom_budget_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `trip_id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `name` char(35) NOT NULL DEFAULT '',
  `cost` DECIMAL NOT NULL DEFAULT 0,
  PRIMARY KEY (`custom_budget_item_id`),
  CONSTRAINT `trip_fk_6` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`trip_id`) ON DELETE CASCADE,
  CONSTRAINT `budget_category_fk_2` FOREIGN KEY (`category_id`) REFERENCES `budget_category` (`budget_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;