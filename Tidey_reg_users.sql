CREATE TABLE IF NOT EXISTS `Tidey_reg_users` (

  `firstName` varchar(20) CHARACTER SET utf8 COLLATE utf8_swedish_ci,
  `lastName` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci,
  `emailAddr` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci,
  `pw` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci,
  `zip` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci,
  PRIMARY KEY (`emailAddr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
