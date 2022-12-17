create table administradores (
	id INT(5) auto_increment not null,
	nombre VARCHAR (50),
	mail VARCHAR(100),
	clave VARCHAR(100),
	estatus INT(1),
	primary key (id)
);