DROP DATABASE IF EXISTS modul133;
CREATE DATABASE modul133;
use modul133;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(200) NOT NULL,
  `vorname` VARCHAR(200) NOT NULL,
  `nachname` VARCHAR(200) NOT NULL,
  `email` VARCHAR(200) NOT NULL,
  `password` VARCHAR(200) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  `usertype` ENUM('user', 'moderator', 'admin') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`))
DEFAULT CHARACTER SET = utf8mb4;

CREATE TABLE IF NOT EXISTS `kxi_services` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(200) NOT NULL,
  `price` DECIMAL(20,2) NOT NULL,
  `image` VARCHAR(200) NOT NULL DEFAULT "https://images.unsplash.com/photo-1519049069275-dea996e1a314?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=375&q=80",
  `kuerzel` VARCHAR(200) NOT NULL,
  `description` VARCHAR(200),
  PRIMARY KEY (`id`)
);
CREATE TABLE IF NOT EXISTS `kxi_priorities` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `kuerzel` VARCHAR(200) NOT NULL,
  `title` VARCHAR(200) NOT NULL,
  `days` DECIMAL NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `kxi_auftraege` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `prioid` INT NOT NULL,
  `serviceid` INT NOT NULL,
  `request_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`userid`) REFERENCES `users`(`id`),
  CONSTRAINT `fk_prio_id` FOREIGN KEY (`prioid`) REFERENCES `kxi_priorities`(`id`),
  CONSTRAINT `fk_service_id` FOREIGN KEY (`serviceid`) REFERENCES `kxi_services`(`id`)
  )
DEFAULT CHARACTER SET = utf8mb4;

