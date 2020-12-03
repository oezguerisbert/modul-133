DROP DATABASE IF EXISTS modul133;
CREATE DATABASE modul133;
use modul133;
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(200) NOT NULL,
  `vorname` VARCHAR(200) NOT NULL,
  `nachname` VARCHAR(200) NOT NULL,
  `email` VARCHAR(200) NOT NULL,
  `password` VARCHAR(200) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  `usertype` ENUM('user', 'moderator', 'admin') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

DROP TABLE IF EXISTS `kxi_auftraege`;
CREATE TABLE IF NOT EXISTS `kxi_auftraege` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `prio` ENUM('express', 'standart', 'tief') NOT NULL,
  `service` ENUM('klein', 'gross', 'fell', 'wachs', 'montage', 'rennski') NOT NULL,
  `request_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`userid`) REFERENCES `users`(`id`)
  )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;
