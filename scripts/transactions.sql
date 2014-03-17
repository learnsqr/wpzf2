CREATE TABLE IF NOT EXISTS `wpzf2`.`transactions` (
  `idtransaction` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(45) NULL,
  `date` DATETIME NULL,
  `amount` DOUBLE NULL,
  PRIMARY KEY (`idtransaction`))
ENGINE = InnoDB