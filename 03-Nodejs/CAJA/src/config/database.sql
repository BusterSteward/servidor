CREATE DATABASE  IF NOT EXISTS login_nodejs;
USE login_nodejs;

--
-- Table structure for table usuarios
--

DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users (
	  id 						int(5) NOT NULL AUTO_INCREMENT,
	  nombre			varchar(10) NOT NULL,
	  apellido	 		varchar(10) NOT NULL,
	  movil     			int(9) NOT NULL,
	  user_name 	varchar(20) NOT NULL,
	  password 		varchar(255) NOT NULL,
	  imagen1 			longblob NOT NULL,
	  imagen2 			varchar(40) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


