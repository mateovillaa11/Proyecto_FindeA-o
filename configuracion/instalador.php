<?php



	 function inputarCambio($sql){

		include("configuracion/configuracion.php");
		// Esto borrar solo para la clase en modo desmotrativo
		$DBDATABASE = "proyecto_1";

		$conexion = new PDO("mysql:host=".$DBHOST.":".$DBPORT.";dbname=".$DBDATABASE."", $DBUSER, $DBPASSWORD);                                
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		$mysqlPrepare = $conexion->prepare($sql);
		$respuesta = $mysqlPrepare->execute(array());
		$retorno = array();
		if($respuesta){
			$retorno['codigo'] = "Ok";
		}else{
			$retorno['codigo'] = "Error";
		}
		return $retorno;
	}



	$arraySQL = array();

	$arraySQL[] = "

		SET FOREIGN_KEY_CHECKS=0;
		DROP TABLE cargo;
		DROP TABLE cliente;
		DROP TABLE departamentos;
		DROP TABLE envios;
		DROP TABLE estado;
		DROP TABLE funcionarios;
		DROP TABLE facturas;
		DROP TABLE factura_libro;
		SET FOREIGN_KEY_CHECKS=1;

	";

	$arraySQL[] = "CREATE TABLE `cargo` (
                    `id` int(3) NOT NULL,
                    `nombre` varchar(50) NOT NULL,
                    PRIMARY KEY (`id`)
                    )";
	$arraySQL[] = "CREATE TABLE `cliente` (
                    `CI` int(20) NOT NULL,
                    `nombre` varchar(50) NOT NULL,
                    `apellido` varchar(50) NOT NULL,
                    `telefono` varchar(50) NOT NULL,
                    PRIMARY KEY (`CI`)
                    ) ";

	$arraySQL[] = "CREATE TABLE `departamentos` (
                    `id` int(19) NOT NULL,
                    `nombre` varchar(50) NOT NULL,
                    PRIMARY KEY (`id`)
                ) ";
	$arraySQL[] = "CREATE TABLE `envios` (
                    `id` int(50) NOT NULL AUTO_INCREMENT,
                    `CI_cliente` int(20) NOT NULL,
                    `destinatario` varchar(50) NOT NULL,
                    `id_departamentos` int(19) NOT NULL,
                    `calle` varchar(50) NOT NULL,
                    `puerta` int(50) NOT NULL,
                    `FechaRecibido` date NOT NULL,
                    `id_estado` int(3) NOT NULL,
                    PRIMARY KEY (`id`),
                    KEY `id_estado` (`id_estado`),
                    KEY `CI_cliente` (`CI_cliente`),
                    KEY `id_departamentos` (`id_departamentos`),
                    CONSTRAINT `fk_CI_cliente_CI` FOREIGN KEY (`CI_cliente`) REFERENCES `cliente` (`CI`),
                    CONSTRAINT `fk_id_departamentos_id` FOREIGN KEY (`id_departamentos`) REFERENCES `departamentos` (`id`),
                    CONSTRAINT `fk_id_estado_id` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`)
                ) ";

	$arraySQL[] = "CREATE TABLE `estado` (
                    `id` int(3) NOT NULL,
                    `nombre` varchar(50) NOT NULL,
                    PRIMARY KEY (`id`)
                ) ";
	$arraySQL[] = "CREATE TABLE `funcionarios` (
                    `ci` int(20) NOT NULL,
                    `nombre` varchar(50) NOT NULL,
                    `apellido` varchar(50) NOT NULL,
                    `telefono` varchar(50) NOT NULL,
                    `correo` varchar(50) NOT NULL,
                    `id_cargo` int(3) NOT NULL,
                    PRIMARY KEY (`ci`),
                    KEY `id_cargo` (`id_cargo`),
                    CONSTRAINT `fk_id_cargo_id` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id`)
                )";
                
	$arraySQL[] = "INSERT INTO `administradores` VALUES (1,'admin','mail@mail.com','21232f297a57a5a743894a0e4a801fc3',1);";


	foreach($arraySQL as $SQL){

		print_r($SQL."\n");
		inputarCambio($SQL);

	}













?>