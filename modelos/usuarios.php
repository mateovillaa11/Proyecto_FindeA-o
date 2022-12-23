<?php

require_once("modelos/generico.php");


class usuarios extends generico {


	protected $nombre;

	protected $clave;

	protected $mail;

    protected $rol;


	public function traerNombre(){
		return $this->nombre;
	}

	public function traerMail(){
		return $this->mail;
	}

    public function traerRol(){
		return $this->rol;
	}




	public function login($usuario, $clave){


		$sql = "SELECT * FROM usuarios 
					WHERE nombre = :nombre AND clave = :clave";
		$arrayDatos = array();
		$arrayDatos['nombre'] 	= $usuario;
		$arrayDatos['clave'] 	= md5($clave);
		$respuesta = $this->cargarDatos($sql, $arrayDatos);

		foreach($respuesta as $usuario){

			@session_start();
			$_SESSION['rol'] = $usuario['rol'];
			$_SESSION['nombre'] = $usuario['nombre'];
			return "OK";

		}

		return "Error";

	}


}










?>