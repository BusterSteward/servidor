CREATE DATABASE  IF NOT EXISTS examen_de_ficheros;
USE examen_de_ficheros;

DROP TABLE IF EXISTS ficheros;
CREATE TABLE ficheros (
  id int(3) 	NOT NULL AUTO_INCREMENT,
  FICHERO 	varchar(25) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

LOCK TABLES ficheros WRITE;
INSERT INTO ficheros VALUES (1,'Fichero1.pdf'),(2,'Documento1.doc'),(3,'1.jpg'),(4,'2.jpg'),(5,'3.jpg'),(6,'4.jpg'),(7,'5.jpg');
UNLOCK TABLES;

DROP TABLE IF EXISTS historial;
CREATE TABLE historial (
  id int(3) 	NOT NULL AUTO_INCREMENT,
  ACCION varchar(5) NOT NULL,
  FICHERO 	varchar(25) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

LOCK TABLES historial WRITE;
INSERT INTO historial VALUES (1,'SUBE','10.pdf'),(2,'SUBE','11.doc'),(3,'BORRA','10.pdf'),(4,'BORRA','11.doc'),(5,'SUBE','Fichero1.pdf'),(6,'SUBE','Documento1.doc'),(7,'SUBE','1.jpg'),(8,'SUBE','2.jpg'),(9,'SUBE','3.jpg'),(10,'SUBE','4.jpg'),(11,'SUBE','5.jpg');
UNLOCK TABLES;