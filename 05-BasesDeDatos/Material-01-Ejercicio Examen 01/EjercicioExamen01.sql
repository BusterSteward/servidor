CREATE DATABASE  IF NOT EXISTS EjercicioExamen01;
USE EjercicioExamen01;

DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
  CODIGO 	int(4) NOT NULL,
  NOMBRE 	varchar(10) NOT NULL,
  EDAD 		int(3) NOT NULL,

  PRIMARY KEY (CODIGO)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
