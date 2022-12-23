<?php


	require_once("modelos/generico.php");

	class cliente extends generico {

		protected $CI;
		
		protected $nombre;
		
		protected $apellido;

		protected $telefono;

		
		public function traerDocumento(){
			return $this->CI;
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
		

		public function constructor($arrayDatos = array()) {

			$this->CI		= $this->extarerDatos($arrayDatos,'CI');

			$this->nombre	= $this->extarerDatos($arrayDatos,'nombre');

			$this->apellido	= $this->extarerDatos($arrayDatos,'apellido');

			$this->telefono	= $this->extarerDatos($arrayDatos,'telefono');

		}

		public function cargarCliente($CICliente){

			$sql= "SELECT * FROM cliente WHERE CI=:CI";

			$arrayDatos = array();
			$arrayDatos['CI'] = $CICliente;
			$respuesta = $this->cargarDatos($sql,$arrayDatos);
			
			foreach($respuesta as $cliente ){

				$this->CI		= $cliente['CI'];

				$this->nombre	= $cliente['nombre'];

				$this->apellido	= $cliente['apellido'];

				$this->telefono	= $cliente['telefono'];
			}

		}

		public function listarClientes($filtros= array()){

			$sql= "SELECT * FROM cliente 
					WHERE estado = 1"; 

			if(isset($filtros['busqueda']) && $filtros['busqueda'] != ""){
			$sql .= " AND (nombre LIKE ('%".$filtros['busqueda']."%')";
			$sql .= " OR apellido LIKE ('%".$filtros['busqueda']."%'))";
			
			}

			if(isset ($filtros['totalRegistros']) && $filtros['totalRegistros']>0){

				$origen = ($filtros['pagina'] -1) * $filtros['totalRegistros'];

				$sql .= " LIMIT ".$origen.",".$filtros["totalRegistros"];
			}

			$arraySql = array();
            $retorno = $this->cargarDatos($sql,$arraySql);
			return $retorno;
		}

		public function totalClientes($filtros= array()){

			$sql= "SELECT COUNT(CI) AS total FROM cliente 
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

		public function ingresarCliente() {

			$sqlInsert = "INSERT cliente SET
							CI 			= :CI,
							nombre 		= :nombre,
							apellido 	= :apellido,
							telefono 	= :telefono,
							estado 		= 1";

			$arraySql = array(
							"CI" 		=> $this->CI,
							"nombre" 	=> $this->nombre,
							"apellido" 	=> $this->apellido,
							"telefono" 	=> $this->telefono,
						);

			$retorno = $this->imputarCambio($sqlInsert,$arraySql);

			return $retorno;

		}

		public function editarCliente() {

			$sqlInsert = "UPDATE cliente SET
							nombre 		= :nombre,
							apellido 	= :apellido,
							telefono 	= :telefono
							WHERE CI	= :CI";

			$arraySql = array(
							"CI" 		=> $this->CI,
							"nombre" 	=> $this->nombre,
							"apellido" 	=> $this->apellido,
							"telefono" 	=> $this->telefono,
						);

			
			$retorno = $this->imputarCambio($sqlInsert,$arraySql);
			return $retorno;

		}

		public function borrarCliente() {

			$sqlInsert = "UPDATE cliente  SET estado = 0 WHERE CI =:CI";
			$arraySql = array(
							"CI"=> $this->CI,
						);
			
			$retorno = $this->imputarCambio($sqlInsert,$arraySql);
			return $retorno;

		}

		public function listarSelect(){

            $sql= 'SELECT 
                        CI,
                        CONCAT(nombre, "-" , CI) AS nombre
                        FROM cliente
						WHERE estado = 1';
                    
            $arrayDatos = array();
            $retorno = $this->cargarDatos($sql, $arrayDatos);
            return $retorno;
        }


	}
	

?>