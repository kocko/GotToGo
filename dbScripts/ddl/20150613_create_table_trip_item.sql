DROP TABLE IF EXISTS `trip_item`;
CREATE TABLE `trip_item`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trip_id` int(11) NOT NULL DEFAULT '0',
  `name` char(35) NOT NULL DEFAULT '-',
  `category` enum('Документи','Устройства','Облекло','Аксесоари','Козметични и гримове','За баня','Полезни','Занимателни','Допълнителни') NOT NULL,
  PRIMARY KEY (`ID`),
  CONSTRAINT `trip_fk_1` FOREIGN KEY (`trip_id`) REFERENCES `trip` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4080 DEFAULT CHARSET=utf8;
