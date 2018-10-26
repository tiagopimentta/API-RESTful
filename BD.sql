create database repositorios;
use repositorios;

CREATE TABLE IF NOT EXISTS `repositorios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

INSERT INTO repositorios (id, nome) VALUES (1,'repositorio 1'),(2,'repositorio 2'),(3,'repositorio 3');