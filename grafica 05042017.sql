-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema grafica
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema grafica
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `grafica` DEFAULT CHARACTER SET utf8 ;
USE `grafica` ;

-- -----------------------------------------------------
-- Table `grafica`.`pais`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grafica`.`pais` (
  `CD_PAIS` INT NOT NULL AUTO_INCREMENT,
  `DS_PAIS` VARCHAR(45) NULL,
  PRIMARY KEY (`CD_PAIS`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grafica`.`estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grafica`.`estado` (
  `CD_ESTADO` INT NOT NULL AUTO_INCREMENT,
  `NM_ESTADO` VARCHAR(45) NULL,
  `DS_UF` VARCHAR(45) NULL,
  `CD_PAIS` INT NOT NULL,
  PRIMARY KEY (`CD_ESTADO`),
  INDEX `fk_estado_pais_idx` (`CD_PAIS` ASC),
  CONSTRAINT `fk_estado_pais`
    FOREIGN KEY (`CD_PAIS`)
    REFERENCES `grafica`.`pais` (`CD_PAIS`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grafica`.`cidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grafica`.`cidade` (
  `CD_CIDADE` INT NOT NULL AUTO_INCREMENT,
  `NM_CIDADE` VARCHAR(45) NULL,
  `CD_ESTADO` INT NOT NULL,
  PRIMARY KEY (`CD_CIDADE`),
  INDEX `fk_cidade_estado1_idx` (`CD_ESTADO` ASC),
  CONSTRAINT `fk_cidade_estado1`
    FOREIGN KEY (`CD_ESTADO`)
    REFERENCES `grafica`.`estado` (`CD_ESTADO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grafica`.`zona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grafica`.`zona` (
  `CD_ZONA` INT NOT NULL AUTO_INCREMENT,
  `DS_ZONA` VARCHAR(45) NULL,
  PRIMARY KEY (`CD_ZONA`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grafica`.`bairro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grafica`.`bairro` (
  `CD_BAIRRO` INT NOT NULL AUTO_INCREMENT,
  `NM_BAIRRO` VARCHAR(90) NULL,
  `CD_CIDADE` INT NOT NULL,
  `CD_ZONA` INT NOT NULL,
  PRIMARY KEY (`CD_BAIRRO`),
  INDEX `fk_bairro_cidade1_idx` (`CD_CIDADE` ASC),
  INDEX `fk_bairro_zona1_idx` (`CD_ZONA` ASC),
  CONSTRAINT `fk_bairro_cidade1`
    FOREIGN KEY (`CD_CIDADE`)
    REFERENCES `grafica`.`cidade` (`CD_CIDADE`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bairro_zona1`
    FOREIGN KEY (`CD_ZONA`)
    REFERENCES `grafica`.`zona` (`CD_ZONA`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grafica`.`tp_logradouro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grafica`.`tp_logradouro` (
  `CD_TP_LOGRADOURO` INT NOT NULL AUTO_INCREMENT,
  `DS_TP_LOGRADOURO` VARCHAR(45) NULL,
  PRIMARY KEY (`CD_TP_LOGRADOURO`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grafica`.`endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grafica`.`endereco` (
  `CD_ENDERECO` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `DS_LOGRADOURO` VARCHAR(120) NULL,
  `NR_CEP` VARCHAR(8) NOT NULL,
  `CD_BAIRRO` INT NOT NULL,
  `CD_TP_LOGRADOURO` INT NOT NULL,
  INDEX `fk_endereco_bairro1_idx` (`CD_BAIRRO` ASC),
  INDEX `fk_endereco_tp_logradouro1_idx` (`CD_TP_LOGRADOURO` ASC),
  PRIMARY KEY (`CD_ENDERECO`),
  CONSTRAINT `fk_endereco_bairro1`
    FOREIGN KEY (`CD_BAIRRO`)
    REFERENCES `grafica`.`bairro` (`CD_BAIRRO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_endereco_tp_logradouro1`
    FOREIGN KEY (`CD_TP_LOGRADOURO`)
    REFERENCES `grafica`.`tp_logradouro` (`CD_TP_LOGRADOURO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grafica`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grafica`.`cliente` (
  `CD_CLIENTE` INT NOT NULL AUTO_INCREMENT,
  `NM_RESPONSAVEL` VARCHAR(102) NOT NULL,
  `DS_NM_FANTASIA` VARCHAR(100) NULL,
  `NR_CPF_CNPJ` VARCHAR(15) NOT NULL,
  `DS_EMAIL` VARCHAR(45) NULL,
  `NR_CEP` VARCHAR(8) NULL,
  `NR_CASA` VARCHAR(45) NULL,
  `DS_COMPLEMENTO` VARCHAR(45) NULL,
  `DT_CADASTRO` DATE NULL,
  `DT_ATUALIZACAO` DATE NULL,
  PRIMARY KEY (`CD_CLIENTE`),
  UNIQUE INDEX `NR_CPF_UNIQUE` (`NR_CPF_CNPJ` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grafica`.`cargo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grafica`.`cargo` (
  `CD_CARGO` INT NOT NULL AUTO_INCREMENT,
  `DS_CARGO` VARCHAR(90) NULL,
  `OBS_CARGO` VARCHAR(255) NULL,
  PRIMARY KEY (`CD_CARGO`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grafica`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grafica`.`usuario` (
  `CD_USUARIO` INT NOT NULL AUTO_INCREMENT,
  `NM_USUARIO` VARCHAR(90) NULL,
  `NM_SOBRENOME` VARCHAR(90) NULL,
  `DS_LOGIN` VARCHAR(45) NULL,
  `DS_SENHA` VARCHAR(45) NULL,
  `SN_ATIVO` CHAR(1) NULL,
  `CD_CARGO` INT NOT NULL,
  `NR_CPF` VARCHAR(11) NOT NULL,
  `NR_RG` VARCHAR(8) NULL,
  `DS_FOTO` BLOB NULL,
  `SN_SENHA_ATUAL` CHAR(1) NULL,
  PRIMARY KEY (`CD_USUARIO`),
  INDEX `fk_usuario_cargo1_idx` (`CD_CARGO` ASC),
  CONSTRAINT `fk_usuario_cargo1`
    FOREIGN KEY (`CD_CARGO`)
    REFERENCES `grafica`.`cargo` (`CD_CARGO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grafica`.`tipo_contato`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grafica`.`tipo_contato` (
  `CD_TIPO_CONTATO` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `DS_TIPO_CONTATO` VARCHAR(50) NULL,
  PRIMARY KEY (`CD_TIPO_CONTATO`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grafica`.`fone_cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grafica`.`fone_cliente` (
  `CD_CLIENTE` INT NOT NULL,
  `NR_TELEFONE` VARCHAR(11) NOT NULL,
  `OBS_TELEFONE` VARCHAR(90) NULL,
  `NM_CONTATO` VARCHAR(90) NULL,
  `CD_TIPO_CONTATO` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`NR_TELEFONE`),
  INDEX `fk_telefone_tipo_contato1_idx` (`CD_TIPO_CONTATO` ASC),
  INDEX `fk_telefone_cliente1_idx` (`CD_CLIENTE` ASC),
  CONSTRAINT `fk_telefone_tipo_contato1`
    FOREIGN KEY (`CD_TIPO_CONTATO`)
    REFERENCES `grafica`.`tipo_contato` (`CD_TIPO_CONTATO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_telefone_cliente1`
    FOREIGN KEY (`CD_CLIENTE`)
    REFERENCES `grafica`.`cliente` (`CD_CLIENTE`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grafica`.`filial`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grafica`.`filial` (
  `CD_FILIAL` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `CD_CLIENTE` INT NOT NULL,
  `DS_FILIAL` VARCHAR(45) NULL,
  `NM_RESPONSAVEL` VARCHAR(90) NULL,
  `DS_NM_FANTASIA` VARCHAR(45) NULL,
  `NR_CEP` VARCHAR(45) NULL,
  `NR_CASA` VARCHAR(45) NULL,
  `DS_COMPLEMENTO` VARCHAR(45) NULL,
  PRIMARY KEY (`CD_FILIAL`),
  INDEX `fk_filial_cliente1_idx` (`CD_CLIENTE` ASC),
  CONSTRAINT `fk_filial_cliente1`
    FOREIGN KEY (`CD_CLIENTE`)
    REFERENCES `grafica`.`cliente` (`CD_CLIENTE`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grafica`.`departamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grafica`.`departamento` (
  `CD_DEPARTAMENTO` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `NM_RESPONSAVEL` VARCHAR(45) NULL,
  `DS_DEPARTAMENTO` VARCHAR(45) NULL,
  `CD_FILIAL` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`CD_DEPARTAMENTO`),
  INDEX `fk_departamento_filial1_idx` (`CD_FILIAL` ASC),
  CONSTRAINT `fk_departamento_filial1`
    FOREIGN KEY (`CD_FILIAL`)
    REFERENCES `grafica`.`filial` (`CD_FILIAL`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grafica`.`fone_filial`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grafica`.`fone_filial` (
  `CD_FILIAL` INT UNSIGNED NOT NULL,
  `NR_TELEFONE` VARCHAR(11) NOT NULL,
  `OBS_TELEFONE` VARCHAR(90) NULL,
  `NM_CONTATO` VARCHAR(90) NULL,
  `CD_TIPO_CONTATO` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`NR_TELEFONE`),
  INDEX `fk_telefone_tipo_contato1_idx` (`CD_TIPO_CONTATO` ASC),
  INDEX `fk_fone_filial_filial1_idx` (`CD_FILIAL` ASC),
  CONSTRAINT `fk_telefone_tipo_contato10`
    FOREIGN KEY (`CD_TIPO_CONTATO`)
    REFERENCES `grafica`.`tipo_contato` (`CD_TIPO_CONTATO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_fone_filial_filial1`
    FOREIGN KEY (`CD_FILIAL`)
    REFERENCES `grafica`.`filial` (`CD_FILIAL`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grafica`.`fone_departamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `grafica`.`fone_departamento` (
  `CD_DEPARTAMENTO` INT UNSIGNED NOT NULL,
  `NR_TELEFONE` VARCHAR(11) NOT NULL,
  `OBS_TELEFONE` VARCHAR(90) NULL,
  `NM_CONTATO` VARCHAR(90) NULL,
  `CD_TIPO_CONTATO` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`NR_TELEFONE`),
  INDEX `fk_telefone_tipo_contato1_idx` (`CD_TIPO_CONTATO` ASC),
  INDEX `fk_fone_departamento_departamento1_idx` (`CD_DEPARTAMENTO` ASC),
  CONSTRAINT `fk_telefone_tipo_contato100`
    FOREIGN KEY (`CD_TIPO_CONTATO`)
    REFERENCES `grafica`.`tipo_contato` (`CD_TIPO_CONTATO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_fone_departamento_departamento1`
    FOREIGN KEY (`CD_DEPARTAMENTO`)
    REFERENCES `grafica`.`departamento` (`CD_DEPARTAMENTO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
