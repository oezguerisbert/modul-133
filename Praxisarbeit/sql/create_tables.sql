CREATE TABLE IF NOT EXISTS `modul307`.`sxi` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `prio` ENUM('express', 'standart', 'tief') NOT NULL,
  `service` ENUM('klein', 'gross', 'fell', 'wachs', 'montage', 'rennski') NOT NULL,
  `request_date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `userid` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4;


CREATE TABLE IF NOT EXISTS `modul307`.`user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `vorname` VARCHAR(200) NOT NULL,
  `nachname` VARCHAR(200) NOT NULL,
  `email` VARCHAR(200) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb4;