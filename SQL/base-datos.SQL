
-- //Crear tabla //
-- Tabla cliente//--
CREATE TABLE clientes (
	id INT(50) NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(50) NOT NULL,
	apellido VARCHAR(50) NOT NULL,
	documento VARCHAR(20) NOT NULL,
	telefono VARCHAR(20) not null,
	PRIMARY KEY(id)
);  --Fin--
 
SELECT * FROM clientes;

-- //INGRESO CLIENTES//--
 INSERT clientes (nombre, apellido, documento, telefono)  
	VALUES ("Iryna", "Alvarado", "1.141.111-5","093123223");
INSERT clientes (nombre, apellido, documento, telefono)  
	VALUES ("Guillem", "Mansilla", "6.161.141-4","093123122");
INSERT clientes (nombre, apellido, documento, telefono)  
	VALUES ("Svetlana", "Puente", "4.111.511-3","093123211");
INSERT clientes (nombre, apellido, documento, telefono)  
	VALUES ("Angela", "Maria Roig", "3.541.143-2","094123325");
-- //FIN--

-- //Comienzo Empleados//--

CREATE TABLE empleados (
	id INT(50) NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(50) NOT NULL,
	apellido VARCHAR(50) NOT NULL,
	cargo VARCHAR(50) NOT NULL,
	PRIMARY KEY(id)
); -- //Fin

-- //Comienzo Envios//

CREATE TABLE envios (
	id INT(50) NOT NULL AUTO_INCREMENT,
	nombre_cliente VARCHAR(50) NOT NULL,
	destinatario VARCHAR(50) NOT NULL,
	ciudad VARCHAR(50) NOT NULL,
	estado ENUM("Pendiente", "En camino", "Entregado"),
	PRIMARY KEY(id)
); --Fin--

--Nombres Empleados--
SELECT nombre FROM empleados;

--Nombre Clientes--
SELECT nombre FROM clientes;

--Nombre Clientes--
SELECT apellido FROM clientes; 

--Buscar cosas en tabla clienetes--
SELECT * FROM clientes WHERE nombre LIKE "%MA%";

--Buscar cosas en tabla empleados--
SELECT * FROM empleados WHERE nombre LIKE "%l%"; 