<?php

    require_once("modelos/generico.php");


    class cargo extends generico {


        protected $id;

        protected $nombre;


        public function traerId(){
            return $this->id;
        }

        public function traerNombre(){
            return $this->nombre;
        }

        public function constructor($arrayDatos = array()) {

            $this->CI		= $this->extarerDatos($arrayDatos,'id');

            $this->nombre	= $this->extarerDatos($arrayDatos,'nombre');


        }

        public function listarSelect(){

            $sql= 'SELECT 
                        id,
                        CONCAT(nombre) AS nombre
                        FROM cargo';
                    
            $arrayDatos = array();
            $retorno = $this->cargarDatos($sql, $arrayDatos);
            return $retorno;
        }

    
     }


?>