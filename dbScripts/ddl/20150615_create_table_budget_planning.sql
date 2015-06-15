DROP TABLE IF EXISTS `budget_planning`;
CREATE TABLE `budget_planning` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(35) NOT NULL DEFAULT '',
  `shared` enum ('0', '1') DEFAULT '0',
  `category` enum('Документи','Устройства','Облекло','Аксесоари','Козметични и гримове','За баня','Полезни','Занимателни','Допълнителни') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
