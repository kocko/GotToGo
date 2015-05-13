DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `code` char(3) NOT NULL DEFAULT '',
  `name` char(52) NOT NULL DEFAULT '',
  `continent` enum('Asia','Europe','North America','Africa','Oceania','Antarctica','South America') NOT NULL DEFAULT 'Asia',
  `region` char(26) NOT NULL DEFAULT '',
  `capital` int(11) DEFAULT NULL,
  `code2` char(2) NOT NULL DEFAULT '',
  PRIMARY KEY (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
