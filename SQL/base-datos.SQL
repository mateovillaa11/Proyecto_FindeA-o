

--Crear tabla// Tabla cliente--
CREATE TABLE cliente (
	CI INT(20) NOT NULL,
	nombre VARCHAR(50) NOT NULL,
	apellido VARCHAR(50) NOT NULL,
	telefono VARCHAR(50) not null,
	PRIMARY KEY(CI)
);  
 
SELECT * FROM cliente;
--FIN--

--INGRESO CLIENTE--
 INSERT cliente (ci, nombre, apellido,telefono)  
	VALUES ("11411115","Iryna", "Alvarado","093123223");
INSERT cliente (CI,nombre, apellido,telefono)  
	VALUES ("61611414","Guillem", "Mansilla","093123122");
INSERT cliente (CI,nombre, apellido,telefono)  
	VALUES ("41115113","Svetlana", "Puente","093123211");
INSERT cliente (CI,nombre, apellido, telefono)  
	VALUES ("35411432","Angela", "Maria Roig","094123325");
--FIN--

--Comienzo paquete--

CREATE TABLE paquete (
	codigo INT(50) NOT NULL AUTO_INCREMENT,
	destinatario VARCHAR(50) NOT NULL,
	ciudad VARCHAR(50) NOT NULL,
	calle VARCHAR(50) NOT NULL,
	puerta INT(50) NOT NULL,
	FechaRecibido DATE NOT NULL,
	PRIMARY KEY(codigo)
);

SELECT * FROM paquete;

--
 INSERT paquete(codigo, destinatario, ciudad,calle, puerta, FechaRecibido)  
	VALUES ("1","Mateo","Montevideo","18 de julio","4119","2022-11-20");
 INSERT paquete(destinatario, ciudad,calle, puerta, FechaRecibido)  
	VALUES ("Agustin","Montevideo","General Hornos","2131","2022-10-21");
 INSERT paquete(destinatario, ciudad,calle, puerta, FechaRecibido) 
	VALUES ("Marcos","Canelones","Avenida Canelones","2131","2022-11-23");
 INSERT paquete(destinatario, ciudad,calle, puerta, FechaRecibido) 
	VALUES ("Rodrigo","Artigas","Avenida Maldonado","2131","2022-11-22");
--FIN--


--Comienzo estado--

CREATE TABLE estado (
	id INT(50) NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(50) NOT NULL,
	PRIMARY KEY(id)
); 

 INSERT estado(id,nombre)  
	VALUES ();
 INSERT paquete(destinatario, ciudad,calle, puerta, FechaRecibido)  
	VALUES ("Agustin","Montevideo","General Hornos","2131","2022-10-21");
 INSERT paquete(destinatario, ciudad,calle, puerta, FechaRecibido) 
	VALUES ("Marcos","Canelones","Avenida Canelones","2131","2022-11-23");
 INSERT paquete(destinatario, ciudad,calle, puerta, FechaRecibido) 
	VALUES ("Rodrigo","Artigas","Avenida Maldonado","2131","2022-11-22");

SELECT * FROM estado;
--FIN--

--Funcionarios--
CREATE TABLE funcionarios (
	CI INT(20) NOT NULL,
	nombre VARCHAR(50) NOT NULL,
	apellido VARCHAR(50) NOT NULL,
	telefono VARCHAR(50) NOT NULL,
	correo VARCHAR(50) NOT NULL,
	cargo VARCHAR(50) NOT NULL,
	primary KEY (CI)
); 

SELECT * FROM funcionarios;
--FIN--

--
 INSERT cliente (ci, nombre, apellido,telefono)  
	VALUES ("11411115","Iryna", "Alvarado","093123223");
INSERT cliente (CI,nombre, apellido,telefono)  
	VALUES ("61611414","Guillem", "Mansilla","093123122");
INSERT cliente (CI,nombre, apellido,telefono)  
	VALUES ("41115113","Svetlana", "Puente","093123211");
INSERT cliente (CI,nombre, apellido, telefono)  
	VALUES ("35411432","Angela", "Maria Roig","094123325");
--FIN--

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

--eliminar tablas--
drop table paquete;