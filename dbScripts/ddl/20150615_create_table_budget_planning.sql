DROP TABLE IF EXISTS `budget_planning`;
CREATE TABLE `budget_planning` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(35) NOT NULL DEFAULT '',
  `shared` enum ('0', '1') DEFAULT '0'  ,
  `category` enum('Преди пътуване', 'Общи', 'Транспорт', 'Хранения', 'Дейности и Забележителности') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
