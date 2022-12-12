CREATE DATABASE  IF NOT EXISTS nodejs;
USE nodejs;

DROP TABLE IF EXISTS tablanode;
CREATE TABLE tablanode (
  id 					int(3) NOT NULL AUTO_INCREMENT,
  nombre 		varchar(10) NOT NULL,
  edad 				int(3) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

LOCK TABLES tablanode WRITE;
INSERT INTO tablanode VALUES (1,'Juan',24),(2,'Marta',56),(3,'Alfonso',19),(4,'Armando',45);
UNLOCK TABLES;

