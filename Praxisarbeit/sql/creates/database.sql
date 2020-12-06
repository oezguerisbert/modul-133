DROP DATABASE IF EXISTS modul133;

CREATE DATABASE modul133;

use modul133;

DROP TABLE IF EXISTS `users`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(200) NOT NULL,
  `vorname` VARCHAR(200) NOT NULL,
  `nachname` VARCHAR(200) NOT NULL,
  `email` VARCHAR(200) NOT NULL,
  `password` VARCHAR(200) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  `usertype` ENUM('user', 'moderator', 'admin') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET = utf8mb4;