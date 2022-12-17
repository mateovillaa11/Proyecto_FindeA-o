<?php
	


	$ruta = isset($_GET['r'])?$_GET['r']:"";

	if($ruta == "cliente"){
		include("vistas/clientes_vistas.php");
	}elseif($ruta == "envios"){
		include("vistas/envios_vistas.php");
	}elseif($ruta == "funcionarios"){
		include("vistas/funcionarios_vistas.php");
	}	


?>
