DROP TABLE IF EXISTS `luggage_item`;
CREATE TABLE `luggage_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(35) NOT NULL DEFAULT '',
  `category` enum('Документи','Устройства','Облекло','Козметични и други','Полезни и занимателни', 'Непредметен багаж') NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4080 DEFAULT CHARSET=utf8;
