DROP DATABASE IF EXISTS mis_contactos;
CREATE DATABASE mis_contactos;
USE mis_contactos;


CREATE TABLE contactos(
	email VARCHAR(50) NOT NULL,
	nombre VARCHAR(50) NOT NULL,
	sexo char(1),
	nacimiento DATE,
	telefono VARCHAR(13),
	pais VARCHAR(50) NOT NULL,
	imagen VARCHAR(50),
	PRIMARY KEY(email),
	--Algoritmo para busqueda de los parametros de 
	--los campos deseados, FECHA no es valida para la busqueda
	FULLTEXT KEY buscador(email,nombre,sexo,
	telefono,pais)
--Definir el tipo de motor de B.D, y el juego de caracteres latin1 para los acentos
)ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE pais(
	id_pais INT NOT NULL AUTO_INCREMENT,
	pais VARCHAR(50) NOT NULL,
	PRIMARY KEY(id_pais)
)ENGINE=MySAM DEFAULT CHARSET=latin1;

INSERT INTO pais(id_pais,pais) VALUES
	(1,"México"),
	(2,"Colombia"),
	(3,"Guatemala"),
	(4,"España"),
	(5,"Brasil"),
	(6,"Uruguay"),
	(7,"Perú"),
	(8,"Argentina"),
	(9,"Chile"),
	(10,"Paraguay");