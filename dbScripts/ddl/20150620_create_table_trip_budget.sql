DROP TABLE IF EXISTS `trip_budget`;
CREATE TABLE `trip_budget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trip_id` int(11) NOT NULL DEFAULT '0',
  `name` char(35) NOT NULL DEFAULT '',
  `category` char(35) NOT NULL DEFAULT '',
  `cost` DECIMAL NOT NULL DEFAULT 0,
  `shared` enum ('0', '1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_id` (`id`),
  CONSTRAINT `trip_fk_2` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
