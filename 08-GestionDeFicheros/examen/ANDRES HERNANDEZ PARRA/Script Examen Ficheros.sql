CREATE DATABASE  IF NOT EXISTS historial_ficheros;
USE historial_ficheros;

-- **************************************************************************************************************

DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
  id int(4) 		NOT NULL,
  ELUSUARIO 	varchar(10) NOT NULL,
  CARPETA 		varchar(10) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES usuarios WRITE;
INSERT INTO usuarios VALUES (1010,'USER1','CARPETA01'),(1020,'USER2','CARPETA02'),(1030,'USER3','CARPETA03'),(1040,'USER4','CARPETA04');
UNLOCK TABLES;

-- **************************************************************************************************************

DROP TABLE IF EXISTS historial;
CREATE TABLE historial (
  id int(3) 		NOT NULL AUTO_INCREMENT,
  USUARIO 		varchar(10) NOT NULL,
  ACTIVIDAD	varchar(40) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES historial WRITE;
INSERT INTO historial VALUES (1,'USER1','Borra Fichero: 9.jpg'),(2,'USER1','Descarga Fichero: Documento-1.jpg'),(3,'USER1','Sube Fichero: 1.jpg'),(4,'USER1','Sube Fichero: 2.jpg'),(5,'USER1','Sube Fichero: Documento1.doc'),(6,'USER1','Sube Fichero: Documento2.doc'),(7,'USER2','Borra Fichero: Clientes.pdf'),(8,'USER2','Borra Fichero: 10.jpg'),(9,'USER2','Sube Fichero: Foto-1.jpg'),(10,'USER2','Sube Fichero: Foto-2.jpg'),(11,'USER2','Sube Fichero: Foto-3.jpg');
UNLOCK TABLES;

