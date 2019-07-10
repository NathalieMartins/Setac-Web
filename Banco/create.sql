-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema setac
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema setac
-- -----------------------------------------------------

#DROP DATABASE setac;

CREATE SCHEMA IF NOT EXISTS `setac` DEFAULT CHARACTER SET utf8 ;
USE `setac` ;

-- -----------------------------------------------------
-- Table `setac`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `setac`.`usuario` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NULL DEFAULT NULL,
  `senha` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `acesso` INT NULL DEFAULT NULL,
  `nome` VARCHAR(45) NULL DEFAULT NULL,
  `cpf` VARCHAR(45) NULL DEFAULT NULL,
  `telefone` CHAR(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `setac`.`aluno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `setac`.`aluno` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `registroAcademico` VARCHAR(45) NULL DEFAULT NULL,
  `usuario_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_aluno_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `setac`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `setac`.`atividade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `setac`.`atividade` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NULL DEFAULT NULL,
  `descricao` VARCHAR(45) NULL DEFAULT NULL,
  `limiteInscricao` INT NULL DEFAULT NULL,
  `lugar` VARCHAR(45) NULL DEFAULT NULL,
  `status` VARCHAR(45) NULL DEFAULT NULL,
  `cargaHoraria` VARCHAR(45) NULL DEFAULT NULL,
  `ministrador` VARCHAR(45) NULL DEFAULT NULL,
  `emailMinistrador` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `setac`.`professor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `setac`.`professor` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `siape` VARCHAR(45) NULL DEFAULT NULL,
  `qualificacao` VARCHAR(45) NULL DEFAULT NULL,
  `area` VARCHAR(45) NULL DEFAULT NULL,
  `usuario_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_professor_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `setac`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `setac`.`usuario_has_atividade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `setac`.`usuario_has_atividade` (
  `usuario_id` INT UNSIGNED NOT NULL,
  `atividade_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`usuario_id`, `atividade_id`),
  CONSTRAINT `fk_usuario_has_atividade_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `setac`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_atividade_atividade1`
    FOREIGN KEY (`atividade_id`)
    REFERENCES `setac`.`atividade` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

USE `setac` ;

-- -----------------------------------------------------
-- procedure insere_usuario
-- -----------------------------------------------------

DELIMITER //

CREATE PROCEDURE `insere_usuario`
(Ulogin VARCHAR(45), Usenha VARCHAR(45), Uemail VARCHAR(45), Uacesso VARCHAR(45), Unome VARCHAR(45), Ucpf VARCHAR(45), Utelefone VARCHAR(45))
BEGIN
	INSERT INTO usuario (login, senha, email, acesso, nome, cpf, telefone)
    VALUES (Ulogin, Usenha, Uemail, Uacesso, Unome, Ucpf, Utelefone);
	SELECT * FROM usuario WHERE id = LAST_INSERT_ID();
END//

-- -----------------------------------------------------
-- procedure insere_aluno
-- -----------------------------------------------------

CREATE PROCEDURE `insere_aluno`
(AregistroAcademico VARCHAR(45), AusuarioId INT)
BEGIN
	INSERT INTO aluno (registroAcademico, usuario_id)
    VALUES (AregistroAcademico, AusuarioId);
	SELECT * FROM aluno WHERE id = LAST_INSERT_ID();
END//

-- -----------------------------------------------------
-- procedure insere_professor
-- -----------------------------------------------------

CREATE PROCEDURE `insere_professor`
(Psiape VARCHAR(45), Pqualificacao VARCHAR(45), Parea VARCHAR(45), PusuarioId INT)
BEGIN
	INSERT INTO professor (siape, qualificacao, area, usuario_id)
    VALUES (Psiape, Pqualificacao, Parea, PusuarioId);
	SELECT * FROM professor WHERE id = LAST_INSERT_ID();
END//

-- -----------------------------------------------------
-- procedure insere_atividade
-- -----------------------------------------------------

CREATE PROCEDURE `insere_atividade`
(Atitulo VARCHAR(45), Adescricao VARCHAR(45), AlimiteInscricao INT, Alugar VARCHAR(45), Astatus VARCHAR(45), AcargaHoraria VARCHAR(45), Aministrador VARCHAR(45), AemailMinistrador VARCHAR(45))
BEGIN
	INSERT INTO atividade (titulo, descricao, limiteInscricao, lugar, status, cargaHoraria, ministrador, emailMinistrador)
    VALUES (Atitulo, Adescricao, AlimiteInscricao, Alugar, Astatus, AcargaHoraria, Aministrador, AemailMinistrador);
	SELECT * FROM atividade WHERE id = LAST_INSERT_ID();
END//

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
