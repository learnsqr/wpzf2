<<<<<<< HEAD
CREATE TABLE IF NOT EXISTS `wpzf2`.`transactions` (
  `idtransaction` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(45) NULL,
  `date` DATETIME NULL,
  `amount` DOUBLE NULL,
  PRIMARY KEY (`idtransaction`))
=======
CREATE TABLE IF NOT EXISTS `wpzf2`.`transactions` (
  `idtransaction` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(45) NULL,
  `date` DATETIME NULL,
  `amount` DOUBLE NULL,
  PRIMARY KEY (`idtransaction`))
>>>>>>> 0eed4766ee212098381eb8b3b088adb595fd5e21
ENGINE = InnoDB