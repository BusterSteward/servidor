CREATE DATABASE IF NOT EXISTS API_nodejs_V1;

USE API_nodejs_V1;

DROP TABLE IF EXISTS empleados;
CREATE TABLE empleados (
	id 			INT(11) NOT NULL AUTO_INCREMENT,
	nombre 	VARCHAR(15) DEFAULT NULL,
	salario 	INT(10) DEFAULT NULL, 
  PRIMARY KEY(id)
);

-- DESCRIBE empleados;

INSERT INTO empleados values 
  (1, 'PEPE', 20000),
  (2, 'LUIS', 40000),
  (3, 'MARTA', 50000),
  (4, 'MANOLO', 15000),
  (5, 'ALFONSO', 40000),
  (6, 'CARLA', 50000);

-- SELECT * FROM empleados;

-- Procedimiento para dar de alta o modificar un empleado
DROP procedure IF EXISTS empleadoAdd_Edit;
DELIMITER $$
CREATE PROCEDURE empleadoAdd_Edit(IN idx INT, IN nombrex VARCHAR(45), IN salariox INT(10))
BEGIN 
	  IF idx = 0 THEN
			INSERT INTO empleados (nombre, salario) VALUES (nombrex, salariox);
	  ELSE
			UPDATE empleados
			SET
			nombre = nombrex,
			salario = salariox
			WHERE id = idx;
	  END IF;
END$$
DELIMITER ;

