<?php
	$ruta 	= isset($_GET['r'])?$_GET['r']:"";
	$accion = isset($_GET['a'])?$_GET['a']:"";
	$IdEnvio= isset($_GET['CI'])?$_GET['CI']:"";
	$pagina =isset($_GET['pagina'])?$_GET['pagina']:"1";
	$busqueda =isset($_GET['busqueda'])?$_GET['busqueda']:"";

	require_once("./modelos/envios.php");
	require_once("./modelos/clientes.php");
	require_once("./modelos/departamentos.php");
	require_once("./modelos/estado.php");

	$objEnvio = new envios();
	$objCliente = new cliente();
	$objDepartamentos = new departamentos();
	$objEstado = new estado();

		

		if(isset($_POST['action']) && isset($_POST['action']) == "ingresar"){

			$arrayDatos	= $_POST;

			$objEnvio->constructor($arrayDatos);

			$respuesta = $objEnvio->ingresarEnvios();

		}

		if($accion == "editar" && $IdEnvio != ""){

			$objEnvio->cargarEnvios($IdEnvio);

		}

		if(isset($_POST['action-guardar'])){

			$arrayDatos	= $_POST;

			$objEnvio->constructor($arrayDatos);

			$respuesta = $objEnvio->editarEnvios();


		}


		if($accion == "borrar" && $IdEnvio != ""){

			$objEnvio->cargarEnvios($IdEnvio);

		}

		if(isset($_POST['action-borrar'])){

			$arrayDatos	= $_POST;

			$objEnvio->constructor($arrayDatos);

			$respuesta = $objEnvio->borrarEnvios();

		}


	$filtros = array("totalRegistros"=>3, "busqueda" => $busqueda);

	$totalEnvios = $objEnvio->totalEnvios($filtros);

	$totalPaginas = ceil($totalEnvios / $filtros['totalRegistros']);

	if($pagina > $totalPaginas){

		$pagina = $totalPaginas;
	}
	if($pagina < 1){

		$pagina = 1;
	}

	


	$paginaSiguiente = $pagina + 1;
	if($paginaSiguiente > $totalPaginas){

		$paginaSiguiente = $totalPaginas;
	}

	$paginaAnterior = $pagina - 1 ;
	if($paginaAnterior < 1){

		$paginaAnterior = 1;

	}

	$filtros['pagina']= $pagina ;

	$listaEnvios = $objEnvio->listarEnvios($filtros);
	$listaCliente = $objCliente->listarSelect($filtros);
	$listaDepartamentos = $objDepartamentos->listarSelect($filtros);
	$listaEstado = $objEstado->listarSelect($filtros);

?>


	<div>
		<h1 class="center"><a href="index.php?r=<?=$ruta?>" class="black-text">Envios</a></h1>

<?php

	if($accion == "editar" && $IdEnvio != ""){
?>
			<div class="card">
				<div class="card-content">
					<form action="index.php?r=<?=$ruta?>" method="POST" class="col s12">
						<div>
							<h4>Editar Envio</h4>
						</div>
						<br></br>
						<div class="input-field col s12">
    						<select name="CI_cliente">
      							<option value="" disabled selected>Documento Cliente</option>
      							
<?php
	foreach($listaCliente as $cliente){
?>
								<option value="<?=$cliente['CI']?>" <?php if($cliente ['CI'] == $objEnvio->traerCiCliente()){echo("selected");} ?> ><?=$cliente['nombre']?></option>



<?php
	}
?>

    						</select>
    							<label>Docuemnto del Cliente</label>
					</div>
						<div class="row">
							<div class="input-field col s12">
								<input id="destinatario" type="text" autocomplete="off" class="validate" name="destinatario" value="<?=$objEnvio->traerDestinatario()?>">
								<label for="destinatario">destinatario</label>
							</div>
						</div>
						<div class="row">
						<div class="input-field col s6">
    						<select name="id_departamentos">
      							<option value="" disabled selected>Departamentos</option>
      							
<?php
	foreach($listaDepartamentos as $departamento){
?>
								<option value="<?=$departamento['id']?>" <?php if($departamento ['id'] == $objEnvio->traerId_departamentos()){echo("selected");} ?>><?=$departamento['nombre']?></option>



<?php
	}
?>

    						</select>
    							<label>Envio a</label>
					</div>
							<div class="input-field col s6">
								<input id="calle" type="text" autocomplete="off" class="validate" name="calle" value="<?=$objEnvio->traerCalle()?>">
								<label for="calle">Calle</label>
							</div>
						</div>
						
						<div class="row">
							<div class="input-field col s12">
								<input id="puerta" type="number" autocomplete="off" class="validate" name="puerta" value="<?=$objEnvio->traerPuerta()?>">
								<label for="puerta">puerta</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s6">
								<input id="FechaRecibido" type="date" autocomplete="off" class="validate" name="FechaRecibido" value="<?=$objEnvio->traerFechaRecibido()?>">
								<label for="FechaRecibido">Fecha Recibido</label>
							</div>
						
							<div class="input-field col s6">
    						<select name="id_estado">
      							<option value="" disabled selected>Estado Paquete</option>
      							
<?php
	foreach($listaEstado as $estado){
?>
								<option value="<?=$estado['id']?>" <?php if($estado ['id'] == $objEnvio->traerIdEstado()){echo("selected");} ?> ><?=$estado['nombre']?></option>



<?php
	}
?>

    						</select>
    							<label>Estado</label>
							</div>
						</div>

						<div class="row">
							<input  type="hidden" name="id" value="<?=$objEnvio->traerIdEnvio()?>">
							
							<button class="btn waves-effect waves-light right cyan" type="submit" name="action-guardar" value="editar">Guardar
								<i class="material-icons right">save</i>
							</button>
						</div>
					
						
					</form>	
				</div>
			</div>
<?php
	}
?>


<?php
	if($accion == "borrar" && $IdEnvio != ""){

?>
			<div class="card">
				<div class="card-content">
					<form action="index.php?r=<?=$ruta?>" method="POST" class="col s12">
						<div class="center">
							<h4>borrar Envio</h4>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<h3>Estas seguro que quieres cancelar el envio para <?=$objEnvio->traerDestinatario()?></h3>
							</div>
						</div>

						<div class="row">
							<input  type="hidden" name="id" value="<?=$objEnvio->traerIdEnvio()?>">
							<div class="input-field col s2">
								<button class="btn waves-effect waves-light right red" type="submit" name="action-borrar" value="borrar">Borrar
									<i class="material-icons right">delete</i>
								</button>
							</div>

							<div class="input-field col s2">
								<button class="btn waves-effect waves-light right cyan" type="submit" name="" value="cancelar">Cancelar
									<i class="material-icons right">cancele</i>
								</button>
							</div>

						</div>
					
						
					</form>	
				</div>
			</div>
<?php
	}
?>

<?php
	if(isset($respuesta) && $respuesta['codigo'] == "Error"){
?>

		<div class="red center" style="height: 40px">
			<h4>Hubo algun error</h4>
		</div>
<?php

	}elseif(isset($respuesta) && $respuesta['codigo'] == "Ok"){
?>

		<div class="green center" style="height: 40px">
			<h4>Se realizo correctamente</h4>
		</div>
<?php
	}
?>

		<div class="row">
			<a class="btn-small btn-large waves-effect waves-light cyan modal-trigger right-aling" href="#modal1">Añadir Envio</a>

		</div>
		


		<div id="modal1" class="modal">
			<div class="center">
				<h4>
					Ingresar Envio
				</h4>
			</div>


			<div class="modal-content">
				<form action="index.php?r=<?=$ruta?>" method="POST" class="col s12">

					<div class="input-field col s12">
    						<select name="CI_cliente">
      							<option value="" disabled selected>Clientes</option>
      							
<?php
	foreach($listaCliente as $cliente){
?>
								<option value="<?=$cliente['CI']?>"><?=$cliente['nombre']?></option>



<?php
	}
?>

    						</select>
    							<label>Docuemnto del Cliente</label>
					</div>
					<div class="row">
						<div class="input-field col s6">
							<input id="destinatario" type="text" class="validate" name="destinatario" autocomplete="off">
							<label for="destinatario">Nombre Destinatario</label>
						</div>
						<div class="input-field col s6">
    						<select name="id_departamentos">
      							<option value="" disabled selected>Departamento</option>
      							
<?php
	foreach($listaDepartamentos as $departamento){
?>
								<option value="<?=$departamento['id']?>"><?=$departamento['nombre']?></option>



<?php
	}
?>

    						</select>
    							<label>Envio a</label>
					</div>
					</div>
					<div class="row">
						<div class="input-field col s3">
							<input id="calle" type="text" class="validate" name="calle" autocomplete="off">
							<label for="calle">Calle</label>
						</div>
						<div class="input-field col s3">
							<input id="puerta" type="number" class="validate" name="puerta" autocomplete="off">
							<label for="puerta">puerta</label>
						</div>
						<div class="input-field col s3">
							<input id="FechaRecibido" type="date" class="validate" name="FechaRecibido">
							<label for="FechaRecibido">Fecha Recibido</label>
						</div>
					</div>
					<div class="input-field col s6">
    						<select name="id_estado">
      							<option value="" disabled selected>Estado De Paquete</option>
      							
<?php
	foreach($listaEstado as $estado){
?>
								<option value="<?=$estado['id']?>"><?=$estado['nombre']?></option>



<?php
	}
?>

    						</select>
    							<label>Estado</label>
						<div class="col s6">
							<button class="btn waves-effect waves-light right cyan" type="submit" name="action" value="ingresar">ingresar
								<i class="material-icons right">save</i>
							</button>
						</div>
					</div>
					
    			</form>	
			</div>
		</div>
	</div>

	

	
	

	<table class="responsive-table highlight centered">
        <thead>
			
			<div class="nav-wrapper col s3">
				<form action="index.php?" method="GET">
					<div class="input-field ">
						<input type="hidden" name="r" value="<?=$ruta?>">
						<input id="search" type="search" name="busqueda" required autocomplete="off">
						<label class="label-icon" for="search">
							<i class="material-icons">search</i>
						</label>
						<i class="material-icons">close</i>
					</div>
				</form>
			</div>

		    <tr class="cyan white-text">
              <th>Documento Cliente</th>
              <th>Nombre Destinatario</th>
              <th>Departamento</th>
			  <th>Calle</th>
			  <th>Numero puerta</th>
			  <th>Fecha Recibido</th>
			  <th>Estado</th>
			  <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

<?php
	foreach($listaEnvios as $envios){

?>
			<tr>
			  	<td><?=$envios['CI_cliente']?></td>
				<td><?=$envios['destinatario']?></td>
				<td><?=$envios['departamentos']?></td>
				<td><?=$envios['calle']?></td>
				<td><?=$envios['puerta']?></td>
				<td><?=$envios['FechaRecibido']?></td>
				<td><?=$envios['EstadoPaquete']?></td>
				<td>
					<div class="right-aling">
                        <a href="index.php?r=<?=$ruta?>&a=editar&CI=<?=$envios['id']?>" class="waves-effect cyan btn-floating">
							<i class="material-icons left">edit</i>
						</a>
						
                        <a href="index.php?r=<?=$ruta?>&a=borrar&CI=<?=$envios['id']?>" class="waves-effect red btn-floating">
							<i class="material-icons left">delete</i>
						</a>
                    </div>
                </td>
			</tr> 

<?php
	}
?>
        </tbody>
    </table>
	<div class="row cyan" style="height: 80px">
		<div class="col s12 center">
			<ul class="pagination" id="pagina">
				<li class="waves-effect">
					<a href="index.php?r=<?=$ruta?>&pagina=<?=$paginaAnterior?>&busqueda=<?=$busqueda?>"><i class="material-icons">chevron_left</i></a>
				</li>

<?php
				for($i = ($pagina-3) ; $i <= ($pagina+3); $i++){

					if($i < 1 || $i > $totalPaginas){

						continue;

					}

					if($pagina == $i){
						$clase = "active black";
					}else{
						$clase = "waves-effect";
					}

?>	

				<li class="<?=$clase?>">
					<a href="index.php?r=<?=$ruta?>&pagina=<?=$i?>&busqueda=<?=$busqueda?>"><?=$i?></a>
				</li>

<?php
							}
?>
							
				<li class="waves-effect"> 
					<a href="index.php?r=<?=$ruta?>&pagina=<?=$paginaSiguiente?>&busqueda=<?=$busqueda?>"><i class="material-icons">chevron_right</i></a>
				</li>

			</ul>
		</div>
	</div>


