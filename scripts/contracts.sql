CREATE TABLE IF NOT EXISTS `wpzf2`.`contracts` (
  `idcontract` INT NOT NULL,
  `name` VARCHAR(45) NULL COMMENT '	',
  `description` VARCHAR(45) NULL,
  `date` VARCHAR(45) NULL,
  PRIMARY KEY (`idcontract`))
ENGINE = InnoDB