CREATE DATABASE  IF NOT EXISTS portal_clientes;
USE portal_clientes;

--
-- Table structure for table clientes
--

DROP TABLE IF EXISTS clientes;
CREATE TABLE clientes (
  id 					int(3) NOT NULL AUTO_INCREMENT,
  nombre 		varchar(15) NOT NULL,
  provincia 	varchar(11) NOT NULL,
  edad 			int(3) NOT NULL,
  fecha 			date NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table clientes
--

LOCK TABLES clientes WRITE;
INSERT INTO clientes VALUES (1,'PEPE','CUENCA',34,'2019-04-05'),(2,'JUAN','TOLEDO',23,'2019-04-02'),(3,'MARTA','ALBACETE',45,'2019-04-25'),(4,'ALFONSO','GUADALAJARA',56,'2019-12-25'),(5,'MANUEL','TOLEDO',45,'2019-12-25'),(6,'PEPE','CUENCA',37,'2019-04-25'),(7,'ESTHER','ALBACETE',29,'2019-04-25'),(8,'LUIS','TOLEDO',61,'2019-04-25');
UNLOCK TABLES;
