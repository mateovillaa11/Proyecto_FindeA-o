<?php

	require_once("modelos/generico.php");

	class funcionarios extends generico{

		protected $ci;
		
		protected $nombre;
		
		protected $apellido;

		protected $telefono;

        protected $correo;

        protected $id_cargo;

		protected $estado;

		
		public function traerDocumento(){
			return $this->ci;
		}

		public function traerNombre(){
			return $this->nombre;
		}

		public function traerApellido(){
			return $this->apellido;
		}

		public function traerTelefono(){
			return $this->telefono;
		}

        public function traerCorreo(){
			return $this->correo;
		}
        public function traerCargo(){
			return $this->id_cargo;
		}
		

		public function constructor($arrayDatos = array()) {

			$this->ci		= $this->extarerDatos($arrayDatos,'ci');

			$this->nombre	= $this->extarerDatos($arrayDatos,'nombre');

			$this->apellido	= $this->extarerDatos($arrayDatos,'apellido');

			$this->telefono	= $this->extarerDatos($arrayDatos,'telefono');

            $this->correo	= $this->extarerDatos($arrayDatos,'correo');

            $this->id_cargo	= $this->extarerDatos($arrayDatos,'id_cargo');

		}

		public function cargarFuncionarios($CIFuncionarios){

			$sql= "SELECT * FROM funcionarios WHERE ci=:ci";

			$arrayDatos = array();
			$arrayDatos['ci'] = $CIFuncionarios;
			$respuesta= $this->cargarDatos($sql,$arrayDatos);
			
			foreach($respuesta as $funcionarios ){

				$this->ci		= $funcionarios['ci'];

				$this->nombre	= $funcionarios['nombre'];

				$this->apellido	= $funcionarios['apellido'];

				$this->telefono	= $funcionarios['telefono'];

                $this->correo   = $funcionarios['correo'];

                $this->id_cargo  = $funcionarios['id_cargo'];
			}

		}

		public function listarFuncionarios($filtros= array()){

			$sql= "SELECT funcionarios.ci,
						funcionarios.nombre,
						funcionarios.apellido,
						funcionarios.telefono,
						funcionarios.correo,
						cargo.nombre 'cargo'
					FROM funcionarios 
						inner join cargo on cargo.id  = funcionarios.id_cargo
						where funcionarios.estado = 1"; 

			if(isset($filtros['busqueda']) && $filtros['busqueda'] != ""){
			$sql .= " AND (funcionarios.nombre LIKE ('%".$filtros['busqueda']."%')";
			$sql .= " OR funcionarios.apellido LIKE ('%".$filtros['busqueda']."%')";
			$sql .= " OR cargo.nombre LIKE ('%".$filtros['busqueda']."%'))";
			
			}

			if(isset ($filtros['totalRegistros']) && $filtros['totalRegistros']>0){

				$origen = ($filtros['pagina'] -1) * $filtros['totalRegistros'];

				$sql .= " LIMIT ".$origen.",".$filtros["totalRegistros"];
			}

            $arraySql = array();
            $retorno = $this->cargarDatos($sql,$arraySql);
			return $retorno;
		}

		public function totalFuncionarios($filtros= array()){

			$sql= "SELECT COUNT(ci) AS total FROM funcionarios
					WHERE estado = 1"; 

			if(isset($filtros['busqueda']) && $filtros['busqueda'] != ""){
				$sql .= " AND (nombre LIKE ('%".$filtros['busqueda']."%')";
				$sql .= " OR apellido LIKE ('%".$filtros['busqueda']."%'))";
			}

            $arraySql = array();
			$retorno = 0;

            $respuesta = $this->cargarDatos($sql,$arraySql);
			foreach($respuesta as $total){
				$retorno = $total['total'];
			}

			return $retorno;
		}

		public function ingresarFuncionario() {

			$sqlInsert = "INSERT funcionarios SET
							ci 			= :ci,
							nombre 		= :nombre,
							apellido 	= :apellido,
							telefono 	= :telefono,
							correo 		= :correo,
							id_cargo	= :id_cargo,
							estado 		= 1";

			$arraySql = array(
							"ci" 		=> $this->ci,
							"nombre" 	=> $this->nombre,
							"apellido" 	=> $this->apellido,
							"telefono" 	=> $this->telefono,
							"correo" 	=> $this->correo,
							"id_cargo" 	=> $this->id_cargo,
						);

			$retorno = $this->imputarCambio($sqlInsert,$arraySql);

			return $retorno;

		}

		public function editarFuncionarios() {

			$sqlInsert = "UPDATE funcionarios SET
							nombre 		= :nombre,
							apellido 	= :apellido,
							telefono 	= :telefono,
                            correo  	= :correo,
                            id_cargo    = :id_cargo 
							WHERE ci	= :ci";

			$arraySql = array(
							"ci" 		=> $this->ci,
							"nombre" 	=> $this->nombre,
							"apellido" 	=> $this->apellido,
							"telefono" 	=> $this->telefono,
                            "correo" 	=> $this->correo,
							"id_cargo" 	=> $this->id_cargo,
						);
            $retorno = $this->imputarCambio($sqlInsert,$arraySql);
			return $retorno;

		}

		public function borrarFuncionarios() {

            $sqlInsert = "UPDATE funcionarios  SET estado = 0 WHERE ci =:ci";
            $arraySql = array(
                                "ci"=> $this->ci,
                            );
                
            $retorno = $this->imputarCambio($sqlInsert,$arraySql);
            return $retorno;
    
        }


	}
	

?>