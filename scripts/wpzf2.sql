SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `wpzf2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `wpzf2` ;

-- -----------------------------------------------------
-- Table `wpzf2`.`countries`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wpzf2`.`countries` (
  `idcountry` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `id` VARCHAR(45) NULL,
  PRIMARY KEY (`idcountry`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wpzf2`.`states`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wpzf2`.`states` (
  `idstate` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `countries_idcountry` INT NOT NULL,
  PRIMARY KEY (`idstate`, `countries_idcountry`),
  INDEX `fk_states_countries1_idx` (`countries_idcountry` ASC),
  CONSTRAINT `fk_states_countries1`
    FOREIGN KEY (`countries_idcountry`)
    REFERENCES `wpzf2`.`countries` (`idcountry`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wpzf2`.`cities`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wpzf2`.`cities` (
  `idcity` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `postcode` VARCHAR(45) NULL,
  `states_idstate` INT NOT NULL,
  `states_countries_idcountry` INT NOT NULL,
  PRIMARY KEY (`idcity`, `states_idstate`, `states_countries_idcountry`),
  INDEX `fk_cities_states1_idx` (`states_countries_idcountry` ASC),
  CONSTRAINT `fk_cities_states1`
    FOREIGN KEY (`states_countries_idcountry`)
    REFERENCES `wpzf2`.`states` (`countries_idcountry`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wpzf2`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wpzf2`.`users` (
  `iduser` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `lastname` VARCHAR(45) NOT NULL,
  `pass` VARCHAR(45) NOT NULL,
  `cities_idcity` INT NOT NULL,
  `cities_states_idstate` INT NOT NULL,
  `cities_states_countries_idcountry` INT NOT NULL,
  PRIMARY KEY (`iduser`, `cities_idcity`, `cities_states_idstate`, `cities_states_countries_idcountry`),
  INDEX `fk_users_cities1_idx` (`cities_idcity` ASC, `cities_states_idstate` ASC, `cities_states_countries_idcountry` ASC),
  CONSTRAINT `fk_users_cities1`
    FOREIGN KEY (`cities_idcity` , `cities_states_idstate` , `cities_states_countries_idcountry`)
    REFERENCES `wpzf2`.`cities` (`idcity` , `states_idstate` , `states_countries_idcountry`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wpzf2`.`projects`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wpzf2`.`projects` (
  `idproject` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(45) NOT NULL,
  `budget` DOUBLE NULL,
  PRIMARY KEY (`idproject`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wpzf2`.`companies`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wpzf2`.`companies` (
  `idcompanie` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `id` VARCHAR(45) NULL,
  `address` VARCHAR(45) NULL,
  `phone` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `cities_idcity` INT NOT NULL,
  `cities_states_idstate` INT NOT NULL,
  `cities_states_countries_idcountry` INT NOT NULL,
  PRIMARY KEY (`idcompanie`, `cities_idcity`, `cities_states_idstate`, `cities_states_countries_idcountry`),
  INDEX `fk_companies_cities1_idx` (`cities_idcity` ASC, `cities_states_idstate` ASC, `cities_states_countries_idcountry` ASC),
  CONSTRAINT `fk_companies_cities1`
    FOREIGN KEY (`cities_idcity` , `cities_states_idstate` , `cities_states_countries_idcountry`)
    REFERENCES `wpzf2`.`cities` (`idcity` , `states_idstate` , `states_countries_idcountry`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wpzf2`.`acl_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wpzf2`.`acl_roles` (
  `idrole` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `description` VARCHAR(45) NULL,
  PRIMARY KEY (`idrole`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wpzf2`.`acl_actions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wpzf2`.`acl_actions` (
  `idaction` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `category` VARCHAR(45) NULL,
  `type` VARCHAR(45) NULL,
  `access` VARCHAR(45) NULL,
  PRIMARY KEY (`idaction`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wpzf2`.`transactions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wpzf2`.`transactions` (
  `idtransaction` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(45) NULL,
  `date` DATETIME NULL,
  `amount` DOUBLE NULL,
  PRIMARY KEY (`idtransaction`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wpzf2`.`contracts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wpzf2`.`contracts` (
  `idcontract` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL COMMENT '	',
  `description` VARCHAR(45) NULL,
  `date` VARCHAR(45) NULL,
  PRIMARY KEY (`idcontract`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wpzf2`.`contracts_conditions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wpzf2`.`contracts_conditions` (
  `idcondition` INT NOT NULL,
  `description` VARCHAR(45) NULL,
  `alias` VARCHAR(45) NULL,
  `startdate` VARCHAR(45) NULL,
  `budget` VARCHAR(45) NULL,
  PRIMARY KEY (`idcondition`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wpzf2`.`acl_roles_has_acl_actions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wpzf2`.`acl_roles_has_acl_actions` (
  `acl_roles_idrole` INT NOT NULL,
  `acl_actions_idaction` INT NOT NULL,
  PRIMARY KEY (`acl_roles_idrole`, `acl_actions_idaction`),
  INDEX `fk_acl_roles_has_acl_actions_acl_actions1_idx` (`acl_actions_idaction` ASC),
  INDEX `fk_acl_roles_has_acl_actions_acl_roles_idx` (`acl_roles_idrole` ASC),
  CONSTRAINT `fk_acl_roles_has_acl_actions_acl_roles`
    FOREIGN KEY (`acl_roles_idrole`)
    REFERENCES `wpzf2`.`acl_roles` (`idrole`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_acl_roles_has_acl_actions_acl_actions1`
    FOREIGN KEY (`acl_actions_idaction`)
    REFERENCES `wpzf2`.`acl_actions` (`idaction`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wpzf2`.`companies_has_projects`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wpzf2`.`companies_has_projects` (
  `companies_idcompanie` INT NOT NULL,
  `projects_idproject` INT NOT NULL,
  PRIMARY KEY (`companies_idcompanie`, `projects_idproject`),
  INDEX `fk_companies_has_projects_projects1_idx` (`projects_idproject` ASC),
  INDEX `fk_companies_has_projects_companies1_idx` (`companies_idcompanie` ASC),
  CONSTRAINT `fk_companies_has_projects_companies1`
    FOREIGN KEY (`companies_idcompanie`)
    REFERENCES `wpzf2`.`companies` (`idcompanie`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_companies_has_projects_projects1`
    FOREIGN KEY (`projects_idproject`)
    REFERENCES `wpzf2`.`projects` (`idproject`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wpzf2`.`users_has_companies`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wpzf2`.`users_has_companies` (
  `users_iduser` INT NOT NULL,
  `companies_idcompanie` INT NOT NULL,
  PRIMARY KEY (`users_iduser`, `companies_idcompanie`),
  INDEX `fk_users_has_companies_companies1_idx` (`companies_idcompanie` ASC),
  INDEX `fk_users_has_companies_users1_idx` (`users_iduser` ASC),
  CONSTRAINT `fk_users_has_companies_users1`
    FOREIGN KEY (`users_iduser`)
    REFERENCES `wpzf2`.`users` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_companies_companies1`
    FOREIGN KEY (`companies_idcompanie`)
    REFERENCES `wpzf2`.`companies` (`idcompanie`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wpzf2`.`users_has_acl_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wpzf2`.`users_has_acl_roles` (
  `users_iduser` INT NOT NULL,
  `acl_roles_idrole` INT NOT NULL,
  PRIMARY KEY (`users_iduser`, `acl_roles_idrole`),
  INDEX `fk_users_has_acl_roles_acl_roles1_idx` (`acl_roles_idrole` ASC),
  INDEX `fk_users_has_acl_roles_users1_idx` (`users_iduser` ASC),
  CONSTRAINT `fk_users_has_acl_roles_users1`
    FOREIGN KEY (`users_iduser`)
    REFERENCES `wpzf2`.`users` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_acl_roles_acl_roles1`
    FOREIGN KEY (`acl_roles_idrole`)
    REFERENCES `wpzf2`.`acl_roles` (`idrole`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wpzf2`.`contracts_has_contracts_conditions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wpzf2`.`contracts_has_contracts_conditions` (
  `contracts_idcontract` INT NOT NULL,
  `contracts_conditions_idcondition` INT NOT NULL,
  PRIMARY KEY (`contracts_idcontract`, `contracts_conditions_idcondition`),
  INDEX `fk_contracts_has_contracts_conditions_contracts_conditions1_idx` (`contracts_conditions_idcondition` ASC),
  INDEX `fk_contracts_has_contracts_conditions_contracts1_idx` (`contracts_idcontract` ASC),
  CONSTRAINT `fk_contracts_has_contracts_conditions_contracts1`
    FOREIGN KEY (`contracts_idcontract`)
    REFERENCES `wpzf2`.`contracts` (`idcontract`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contracts_has_contracts_conditions_contracts_conditions1`
    FOREIGN KEY (`contracts_conditions_idcondition`)
    REFERENCES `wpzf2`.`contracts_conditions` (`idcondition`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wpzf2`.`projects_has_transactions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `wpzf2`.`projects_has_transactions` (
  `projects_idproject` INT NOT NULL,
  `transactions_idtransaction` INT NOT NULL,
  `companies_idcompanie` INT NOT NULL,
  PRIMARY KEY (`projects_idproject`, `transactions_idtransaction`, `companies_idcompanie`),
  INDEX `fk_projects_has_transactions_transactions1_idx` (`transactions_idtransaction` ASC),
  INDEX `fk_projects_has_transactions_projects1_idx` (`projects_idproject` ASC),
  INDEX `fk_projects_has_transactions_companies1_idx` (`companies_idcompanie` ASC),
  CONSTRAINT `fk_projects_has_transactions_projects1`
    FOREIGN KEY (`projects_idproject`)
    REFERENCES `wpzf2`.`projects` (`idproject`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_projects_has_transactions_transactions1`
    FOREIGN KEY (`transactions_idtransaction`)
    REFERENCES `wpzf2`.`transactions` (`idtransaction`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_projects_has_transactions_companies1`
    FOREIGN KEY (`companies_idcompanie`)
    REFERENCES `wpzf2`.`companies` (`idcompanie`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
