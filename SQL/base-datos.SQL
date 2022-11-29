
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

--Comienzo envios--
CREATE TABLE envios (
	id INT (50) NOT NULL auto_increment,
	CI_cliente INT(20) not null,
	destinatario VARCHAR(50) NOT NULL,
	id_departamentos int(19) NOT NULL,
	calle VARCHAR(50) NOT NULL,
	puerta INT(50) NOT NULL,
	FechaRecibido DATE NOT NULL,
	id_estado INT(3) not NULL,
	PRIMARY KEY(id),
	KEY id_estado(id_estado),
	constraint fk_id_estado_id foreign key (id_estado) references estado(id),
	key CI_cliente(CI_cliente),
	constraint fk_CI_cliente_CI foreign key (CI_cliente) references cliente(CI),
	key id_departamentos(id_departamentos),
	constraint fk_id_departamentos_id foreign key (id_departamentos) references departamentos(id)
	
);

SELECT * FROM envios;

--
INSERT envios(CI_cliente,destinatario, id_departamentos,calle, puerta, FechaRecibido,id_estado)  
	VALUES ("11411115","Mateo","1","18 de julio","4119","2022-11-20","2");
 INSERT envios(CI_cliente,destinatario, id_departamentos,calle, puerta, FechaRecibido,id_estado)
	VALUES ("61611414","Agustin","1","General Hornos","2131","2022-10-21","3");
INSERT envios(CI_cliente,destinatario, id_departamentos,calle, puerta, FechaRecibido,id_estado)
	VALUES ("41115113","Marcos","2","Avenida Canelones","2131","2022-11-23","1");
INSERT envios(CI_cliente,destinatario, id_departamentos,calle, puerta, FechaRecibido,id_estado)  
	VALUES ("35411432","Rodrigo","4","Avenida Maldonado","2131","2022-11-22","2");
--FIN--

--Departamento--

SELECT * FROM departamentos;

create table departamentos (
	id INT(19) not null,
	nombre VARCHAR(50) not null,
	primary key(id)
);


insert into departamentos (id,nombre)
	values
	("1","Montevideo"),
	("2","canelones"),
	("3","San José"),
	("4","Maldonado"),
	("5","Rocha"),
	("6","Colonia"),
	("7","Lavalleja"),
	("8","Florida"),
	("9","Flores"),
	("10","Soriano"),
	("11","Río Negro"),
	("12","Durazno"),
	("13","Treinta y Tres"),
	("14","Cerro Largo"),
	("15","Paysandú"),
	("16","Tacuarembó"),
	("17","Rivera"),
	("18","Salto"),
	("19","Artigas");



--Comienzo estado--


CREATE TABLE estado (
	id INT(3) NOT NULL,
	nombre VARCHAR(50) NOT NULL,
	PRIMARY KEY(id)
); 

 INSERT estado(id,nombre)  
	VALUES ("1","pendiente");
insert estado(id,nombre)
	values ("2","enviado");
insert estado(id,nombre)
	values ("3","recibido");


SELECT * FROM estado;
--FIN--

--Funcionarios--
CREATE TABLE funcionarios (
	ci INT(20) NOT NULL,
	nombre VARCHAR(50) NOT NULL,
	apellido VARCHAR(50) NOT NULL,
	telefono VARCHAR(50) NOT NULL,
	correo VARCHAR(50) NOT NULL,
	id_cargo INT(3) NOT NULL,
	primary KEY (CI),
	KEY id_cargo(id_cargo),
	constraint fk_id_cargo_id foreign key (id_cargo) references cargo(id)
); 

SELECT * FROM funcionarios;
--FIN--

--Info Funcionarios
 INSERT funcionarios (ci, nombre, apellido,telefono,correo,id_cargo)  
	VALUES ("12221112","Guillermo", "Mendez","092453223","Guille@gmail.com","3");
INSERT funcionarios (ci, nombre, apellido,telefono,correo,id_cargo)  
	VALUES ("2121343","Marisa", "Da Luz","093723892","Marisa@gmail.com","2");
INSERT funcionarios(ci, nombre, apellido,telefono,correo,id_cargo) 
	VALUES ("44565432","Laura", "Fuentes","091623271","Laura@gmail.com","2");
INSERT funcionarios (ci, nombre, apellido,telefono,correo,id_cargo) 
	VALUES ("32221112","Valeria", "Rodriguez","095124323","Vale@gmail.com","1");
--FIN--

--Comienzo Cargo
CREATE TABLE cargo (
	id INT(3) NOT NULL,
	nombre VARCHAR(50) NOT NULL,
	PRIMARY KEY(id)
); 

--Cargos
 INSERT cargo(id,nombre)  
	VALUES ("1","Recepcionista");
insert cargo(id,nombre)
	values ("2","Encargado");
insert cargo(id,nombre)
	values ("3","Repartidor");

SELECT * FROM cargo;

--FIN




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
drop table estado;
drop table envios;
drop table funcionarios;
