DROP TABLE IF EXISTS `luggage_item`;
CREATE TABLE `luggage_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(35) NOT NULL DEFAULT '',
  `category` enum('Documents','Hand luggage','Clothes','Sport items','Devices', 'Medicines') NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4080 DEFAULT CHARSET=utf8;
