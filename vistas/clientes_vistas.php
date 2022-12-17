<?php
	$ruta 	= isset($_GET['r'])?$_GET['r']:"";
	$accion = isset($_GET['a'])?$_GET['a']:"";
	$CICliente= isset($_GET['CI'])?$_GET['CI']:"";
	$pagina =isset($_GET['pagina'])?$_GET['pagina']:"1";
	$busqueda =isset($_GET['busqueda'])?$_GET['busqueda']:"";

	require_once("./modelos/clientes.php");

	$objClientes = new cliente();

		

		if(isset($_POST['action']) && isset($_POST['action']) == "ingresar"){

			$arrayDatos	= $_POST;

			$objClientes->constructor($arrayDatos);

			$respuesta = $objClientes->ingresarCliente();

		}

		if($accion == "editar" && $CICliente != ""){

			$objClientes->cargarCliente($CICliente);

		}

		if(isset($_POST['action-guardar'])){

			$arrayDatos	= $_POST;

			$objClientes->constructor($arrayDatos);

			$respuesta = $objClientes->editarCliente();


		}


		if($accion == "borrar" && $CICliente != ""){

			$objClientes->cargarCliente($CICliente);

		}

		if(isset($_POST['action-borrar'])){

			$arrayDatos	= $_POST;

			$objClientes->constructor($arrayDatos);

			$respuesta = $objClientes->borrarCliente();

		}


	$filtros = array("totalRegistros"=>4, "busqueda" => $busqueda);

	$totalClientes = $objClientes->totalClientes($filtros);

	$totalPaginas = ceil($totalClientes / $filtros['totalRegistros']);

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

	$listaClientes = $objClientes->listarClientes($filtros);

?>


	<div>
		<h1 class="center"><a href="index.php?r=<?=$ruta?>" class="black-text">Clientes</a></h1>

<?php

	if($accion == "editar" && $CICliente != ""){
?>
			<div class="card">
				<div class="card-content">
					<form action="index.php?r=<?=$ruta?>" method="POST" class="col s12">
						<div>
							<h4>Editar Cliente</h4>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input id="CI" type="number" class="validate" name="CI" value="<?=$objClientes->traerDocumento()?>">
								<label for="CI">CI</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s6">
								<input id="nombre" type="text" class="validate" name="nombre" value="<?=$objClientes->traerNombre()?>" >
								<label for="nombre">Nombre</label>
							</div>
							<div class="input-field col s6">
								<input id="apellido" type="text" class="validate" name="apellido" value="<?=$objClientes->traerApellido()?>">
								<label for="apellido">Apellido</label>
							</div>
						</div>
						
						<div class="row">
							<div class="input-field col s12">
								<input id="telefono" type="number" class="validate" name="telefono" value="<?=$objClientes->traerTelefono()?>">
								<label for="telefono">telefono</label>
							</div>
						</div>

						<div class="row">
							<input  type="hidden" name="CI" value="<?=$objClientes->traerDocumento()?>">
							
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
	if($accion == "borrar" && $CICliente != ""){

?>
			<div class="card">
				<div class="card-content">
					<form action="index.php?r=<?=$ruta?>" method="POST" class="col s12">
						<div class="center">
							<h4>borrar Cliente</h4>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<h3>Estas seguro que quieres borrar al cliente <?=$objClientes->traerNombre()?></h3>
							</div>
						</div>

						<div class="row">
							<input  type="hidden" name="CI" value="<?=$objClientes->traerDocumento()?>">
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
			<a class="btn-small btn-large waves-effect waves-light cyan modal-trigger right-aling" href="#modal1">Ingresar Clientes</a>

		</div>
		


		<div id="modal1" class="modal">
			<div class="center">
				<h4>
					Ingresar Cliente
				</h4>
			</div>


			<div class="modal-content">
				<form action="index.php?r=<?=$ruta?>" method="POST" class="col s12">

					<div class="row">
							<div class="input-field col s12">
								<input id="CI" type="number" class="validate" name="CI">
								<label for="CI">CI</label>
							</div>
					</div>
					<div class="row">
						<div class="input-field col s6">
							<input id="nombre" type="text" class="validate" name="nombre">
							<label for="nombre">Nombre</label>
						</div>
						<div class="input-field col s6">
							<input id="apellido" type="text" class="validate" name="apellido">
							<label for="apellido">Apellido</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<input id="telefono" type="number" class="validate" name="telefono">
							<label for="telefono">telefono</label>
						</div>
						<button class="btn waves-effect waves-light right cyan" type="submit" name="action" value="ingresar">ingresar
							<i class="material-icons right">save</i>
						</button>
					</div>
    			</form>	
			</div>
		</div>
	</div>

	

	
	

	<table class="responsive-table highlight centered">
        <thead>
			
			<div class="nav-wrapper col s6">
				<form action="index.php?" method="GET">
					<div class="input-field ">
						<input type="hidden" name="r" value="<?=$ruta?>">
						<input id="search" type="search" name="busqueda" required>
						<label class="label-icon" for="search">
							<i class="material-icons">search</i>
						</label>
						<i class="material-icons">close</i>
					</div>
				</form>
			</div>

		    <tr class="cyan white-text">
              <th>Documento</th>
              <th>Nombre</th>
              <th>Apellido</th>
			  <th>Teléfono</th>
			  <th></th>
            </tr>
        </thead>

        <tbody>

<?php
	foreach($listaClientes as $cliente){

?>
			<tr>
			  	<td><?=$cliente['CI']?></td>
				<td><?=$cliente['nombre']?></td>
				<td><?=$cliente['apellido']?></td>
				<td><?=$cliente['telefono']?></td>
				<td>
					<div class="right-aling">
                        <a href="index.php?r=<?=$ruta?>&a=editar&CI=<?=$cliente['CI']?>" class="waves-effect cyan btn-floating">
							<i class="material-icons left">edit</i>
						</a>
                        <a href="index.php?r=<?=$ruta?>&a=borrar&CI=<?=$cliente['CI']?>" class="waves-effect red btn-floating">
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


