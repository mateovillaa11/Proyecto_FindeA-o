<?php

require_once("modelos/generico.php");


class administradores extends generico {


	protected $nombre;

	protected $clave;

	protected $mail;


	public function traerNombre(){
		return $this->nombre;
	}

	public function traerMail(){
		return $this->mail;
	}




	public function login($usuario, $clave){


		$sql = "SELECT * FROM administradores 
					WHERE nombre = :nombre AND clave = :clave";
		$arrayDatos = array();
		$arrayDatos['nombre'] 	= $usuario;
		$arrayDatos['clave'] 	= md5($clave);
		$respuesta = $this->cargarDatos($sql, $arrayDatos);

		foreach($respuesta as $usuario){

			@session_start();
			$_SESSION['nombre'] = $usuario['nombre'];
			return "OK";

		}

		return "Error";

	}


}










?>