SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';


CREATE SCHEMA IF NOT EXISTS `projetoImoveis` DEFAULT CHARACTER SET utf8 ;
USE projetoImoveis;

CREATE TABLE IF NOT EXISTS `projetoImoveis`.`usuarios` (
    `iduser` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `senha` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`iduser`) 
)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `projetoImoveis`.`imoveis` (
    `id_imovel` INT NOT NULL AUTO_INCREMENT,
    `endereco` VARCHAR(255) NOT NULL,
    `tipo` VARCHAR(50),
    `valor_aluguel` DECIMAL(10,2) NOT NULL,
    `status` VARCHAR(50) DEFAULT 'Disponível',
    PRIMARY KEY (`id_imovel`)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `projetoImoveis`.`proprietarios` (
    `id_proprietario` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(255) NOT NULL,
    `cpf` VARCHAR(14) NOT NULL,
    `telefone` VARCHAR(20) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id_proprietario`)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `projetoImoveis`.`locatarios` (
    `id_locatario` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(255) NOT NULL,
    `cpf` VARCHAR(14) NOT NULL,
    `telefone` VARCHAR(20) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id_locatario`)
)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `projetoImoveis`.`contratos` (
    `id_contrato` INT NOT NULL AUTO_INCREMENT,
    `data_inicio` DATE NOT NULL,
    `data_fim` DATE NOT NULL,
    `valor_mensal` DECIMAL(10,2) NOT NULL,
    `status` VARCHAR(50) NOT NULL,

    `imoveis_id_imovel` INT NOT NULL,
    `proprietarios_id_proprietario` INT NOT NULL,
    `locatarios_id_locatario` INT NOT NULL,

    PRIMARY KEY (`id_contrato`),

    FOREIGN KEY (`imoveis_id_imovel`) REFERENCES `imoveis` (`id_imovel`),
    FOREIGN KEY (`proprietarios_id_proprietario`) REFERENCES `proprietarios` (`id_proprietario`),
    FOREIGN KEY (`locatarios_id_locatario`) REFERENCES `locatarios` (`id_locatario`)
)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;