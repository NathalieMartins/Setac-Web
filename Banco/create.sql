-- MySQL Workbench Forward Engineering

#DROP DATABASE setac;

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema setac
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema setac
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `setac` DEFAULT CHARACTER SET utf8 ;
-- -----------------------------------------------------
-- Schema setac
-- -----------------------------------------------------
USE `setac` ;

-- -----------------------------------------------------
-- Table `setac`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `setac`.`Usuario` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NULL,
  `senha` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `acesso` INT NULL,
  `nome` VARCHAR(45) NULL,
  `cpf` VARCHAR(45) NULL,
  `telefone` CHAR(11) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `setac`.`Atividade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `setac`.`Atividade` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NULL,
  `descricao` VARCHAR(45) NULL,
  `limiteInscricao` INT NULL,
  `lugar` VARCHAR(45) NULL,
  `status` VARCHAR(45) NULL,
  `cargaHoraria` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `setac`.`Professor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `setac`.`Professor` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `siape` VARCHAR(45) NULL,
  `qualificacao` VARCHAR(45) NULL,
  `area` VARCHAR(45) NULL,
  `Usuario_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `Usuario_id`),
  CONSTRAINT `fk_Professor_Usuario1`
    FOREIGN KEY (`Usuario_id`)
    REFERENCES `setac`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `setac`.`Aluno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `setac`.`Aluno` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `registroAcademico` VARCHAR(45) NULL,
  `Usuario_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `Usuario_id`),
  CONSTRAINT `fk_Aluno_Usuario1`
    FOREIGN KEY (`Usuario_id`)
    REFERENCES `setac`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `setac`.`Usuario_has_Atividade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `setac`.`Usuario_has_Atividade` (
  `Usuario_id` INT UNSIGNED NOT NULL,
  `Atividade_id` INT NOT NULL,
  PRIMARY KEY (`Usuario_id`, `Atividade_id`),
  CONSTRAINT `fk_Usuario_has_Atividade_Usuario`
    FOREIGN KEY (`Usuario_id`)
    REFERENCES `setac`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_has_Atividade_Atividade1`
    FOREIGN KEY (`Atividade_id`)
    REFERENCES `setac`.`Atividade` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
