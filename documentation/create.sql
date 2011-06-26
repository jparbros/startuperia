SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `startuperia` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `startuperia` ;

-- -----------------------------------------------------
-- Table `startuperia`.`startups`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `startuperia`.`startups` ;

CREATE  TABLE IF NOT EXISTS `startuperia`.`startups` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `symbol` VARCHAR(45) NOT NULL ,
  `shares` INT NOT NULL DEFAULT 10000 ,
  `available_shares` INT NOT NULL DEFAULT 10000 ,
  `value_per_share` FLOAT NOT NULL DEFAULT 10 ,
  `funding` FLOAT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `startuperia`.`values_history`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `startuperia`.`values_history` ;

CREATE  TABLE IF NOT EXISTS `startuperia`.`values_history` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `startups_id` INT UNSIGNED NOT NULL ,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `value_per_share` FLOAT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_values_history_startups`
    FOREIGN KEY (`startups_id` )
    REFERENCES `startuperia`.`startups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_values_history_startups` ON `startuperia`.`values_history` (`startups_id` ASC) ;


-- -----------------------------------------------------
-- Table `startuperia`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `startuperia`.`users` ;

CREATE  TABLE IF NOT EXISTS `startuperia`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `credits` FLOAT NOT NULL DEFAULT 0 ,
  `username` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `password` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `email` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `activated` TINYINT(1) NOT NULL DEFAULT '1' ,
  `banned` TINYINT(1) NOT NULL DEFAULT '0' ,
  `ban_reason` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `new_password_key` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `new_password_requested` DATETIME NULL DEFAULT NULL ,
  `new_email` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `new_email_key` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `last_ip` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `last_login` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `created` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ,
  `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `startuperia`.`orders`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `startuperia`.`orders` ;

CREATE  TABLE IF NOT EXISTS `startuperia`.`orders` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `startups_id` INT UNSIGNED NOT NULL ,
  `users_id` INT(11) NOT NULL ,
  `status` ENUM('pending', 'accepted', 'cancel') NOT NULL DEFAULT 'pending' ,
  `type` ENUM('sell','buy') NOT NULL DEFAULT 'buy' ,
  `value` FLOAT NOT NULL ,
  `quantity` INT NOT NULL ,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_orders_startups1`
    FOREIGN KEY (`startups_id` )
    REFERENCES `startuperia`.`startups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_users1`
    FOREIGN KEY (`users_id` )
    REFERENCES `startuperia`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_orders_startups1` ON `startuperia`.`orders` (`startups_id` ASC) ;

CREATE INDEX `fk_orders_users1` ON `startuperia`.`orders` (`users_id` ASC) ;


-- -----------------------------------------------------
-- Table `startuperia`.`stocks`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `startuperia`.`stocks` ;

CREATE  TABLE IF NOT EXISTS `startuperia`.`stocks` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `startups_id` INT UNSIGNED NOT NULL ,
  `users_id` INT(11) NOT NULL ,
  `shares` INT NOT NULL ,
  `total_value` FLOAT NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_stocks_startups1`
    FOREIGN KEY (`startups_id` )
    REFERENCES `startuperia`.`startups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_stocks_users1`
    FOREIGN KEY (`users_id` )
    REFERENCES `startuperia`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_stocks_startups1` ON `startuperia`.`stocks` (`startups_id` ASC) ;

CREATE INDEX `fk_stocks_users1` ON `startuperia`.`stocks` (`users_id` ASC) ;


-- -----------------------------------------------------
-- Table `startuperia`.`news`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `startuperia`.`news` ;

CREATE  TABLE IF NOT EXISTS `startuperia`.`news` (
  `news_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `startups_id` INT UNSIGNED NOT NULL ,
  `title` VARCHAR(99) NOT NULL ,
  `description` VARCHAR(255) NOT NULL ,
  `percentage` INT NOT NULL DEFAULT 0 ,
  `type` ENUM('real','fake') NOT NULL DEFAULT 'real' ,
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`news_id`) ,
  CONSTRAINT `fk_news_startups1`
    FOREIGN KEY (`startups_id` )
    REFERENCES `startuperia`.`startups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_news_startups1` ON `startuperia`.`news` (`startups_id` ASC) ;


-- -----------------------------------------------------
-- Table `startuperia`.`ci_sessions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `startuperia`.`ci_sessions` ;

CREATE  TABLE IF NOT EXISTS `startuperia`.`ci_sessions` (
  `session_id` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL DEFAULT '0' ,
  `ip_address` VARCHAR(16) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL DEFAULT '0' ,
  `user_agent` VARCHAR(150) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `last_activity` INT(10) UNSIGNED NOT NULL DEFAULT '0' ,
  `user_data` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  PRIMARY KEY (`session_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `startuperia`.`login_attempts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `startuperia`.`login_attempts` ;

CREATE  TABLE IF NOT EXISTS `startuperia`.`login_attempts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `ip_address` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `login` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `startuperia`.`user_autologin`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `startuperia`.`user_autologin` ;

CREATE  TABLE IF NOT EXISTS `startuperia`.`user_autologin` (
  `key_id` CHAR(32) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `user_id` INT(11) NOT NULL DEFAULT '0' ,
  `user_agent` VARCHAR(150) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `last_ip` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `last_login` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`key_id`, `user_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;


-- -----------------------------------------------------
-- Table `startuperia`.`user_profiles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `startuperia`.`user_profiles` ;

CREATE  TABLE IF NOT EXISTS `startuperia`.`user_profiles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NOT NULL ,
  `country` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `website` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `credits` INT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
