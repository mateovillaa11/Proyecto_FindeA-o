<?php
	$ruta 	= isset($_GET['r'])?$_GET['r']:"";
	$accion = isset($_GET['a'])?$_GET['a']:"";
	$CIFuncionarios= isset($_GET['CI'])?$_GET['CI']:"";
	$pagina =isset($_GET['pagina'])?$_GET['pagina']:"1";
	$busqueda =isset($_GET['busqueda'])?$_GET['busqueda']:"";

	require_once("./modelos/funcionarios.php");
	require_once("./modelos/cargo.php");

	$objFuncionarios = new funcionarios();
	$objCargo = new cargo();

		

		if(isset($_POST['action']) && isset($_POST['action']) == "ingresar"){

			$arrayDatos	= $_POST;

			$objFuncionarios->constructor($arrayDatos);

			$respuesta = $objFuncionarios->ingresarFuncionarios();

		}

		if($accion == "editar" && $CIFuncionarios != ""){

			$objFuncionarios->cargarFuncionarios($CIFuncionarios);

		}

		if(isset($_POST['action-guardar'])){

			$arrayDatos	= $_POST;

			$objFuncionarios->constructor($arrayDatos);

			$respuesta = $objFuncionarios->editarFuncionarios();


		}


		if($accion == "borrar" && $CIFuncionarios != ""){

			$objFuncionarios->cargarFuncionarios($CIFuncionarios);

		}

		if(isset($_POST['action-borrar'])){

			$arrayDatos	= $_POST;

			$objFuncionarios->constructor($arrayDatos);

			$respuesta = $objFuncionarios->borrarFuncionarios();

		}


	$filtros = array("totalRegistros"=>3, "busqueda" => $busqueda);

	$totalFuncionarios = $objFuncionarios->totalFuncionarios($filtros);

	$totalPaginas = ceil($totalFuncionarios / $filtros['totalRegistros']);

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

	$listaFuncionarios = $objFuncionarios->listarFuncionarios($filtros);
	$listaCargoSelect = $objCargo->listarSelect();

?>


	<div>
		<h1 class="center"><a href="index.php?r=<?=$ruta?>" class="black-text">Funcionarios</a></h1>

<?php

	if($accion == "editar" && $CIFuncionarios != ""){
?>
			<div class="card">
				<div class="card-content">
					<form action="index.php?r=<?=$ruta?>" method="POST" class="col s12">
						<div>
							<h4>Editar Funcionario</h4>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input id="ci" type="number" class="validate" name="ci" value="<?=$objFuncionarios->traerDocumento()?>">
								<label for="ci">CI</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s6">
								<input id="nombre" type="text" class="validate" name="nombre" value="<?=$objFuncionarios->traerNombre()?>" >
								<label for="nombre">Nombre</label>
							</div>
							<div class="input-field col s6">
								<input id="apellido" type="text" class="validate" name="apellido" value="<?=$objFuncionarios->traerApellido()?>">
								<label for="apellido">Apellido</label>
							</div>
						</div>
						
						<div class="row">
							<div class="input-field col s12">
								<input id="telefono" type="number" class="validate" name="telefono" value="<?=$objFuncionarios->traerTelefono()?>">
								<label for="telefono">telefono</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input id="correo" type="email" class="validate" name="correo" value="<?=$objFuncionarios->traerCorreo()?>">
								<label for="correo">Correo</label>
							</div>
						</div>
						<div class="input-field col s16">
    						<select>
								
      							<option value="" disabled selected><?=$objFuncionarios->traerCargo()?></option>
<?php
	foreach($listaCargoSelect as $cargo ){
?>
								<option value="<?=$cargo['id']?>"><?=$cargo['nombre']?></option>

<?php
	}
?>
    						
    						</select>
    						<label for="cargo">Cargos</label>
  						</div>

						<div class="row">
							<input  type="hidden" name="CI" value="<?=$objFuncionarios->traerDocumento()?>">
							
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
	if($accion == "borrar" && $CIFuncionarios != ""){

?>
			<div class="card">
				<div class="card-content">
					<form action="index.php?r=<?=$ruta?>" method="POST" class="col s12">
						<div class="center">
							<h4>borrar Funcionario</h4>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<h3>Estas seguro que quieres borrar al Funcionario <?=$objFuncionarios->traerNombre()?></h3>
							</div>
						</div>

						<div class="row">
							<input  type="hidden" name="CI" value="<?=$objFuncionarios->traerDocumento()?>">
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

		<div class="row">
			<div class="red center" style="height: 40px">
				<h4>Hubo algun error</h4>
			</div>
		</div>
<?php

	}elseif(isset($respuesta) && $respuesta['codigo'] == "Ok"){
?>

		<div class="row">
			<div class="green center" style="height: 40px">
				<h4>Se realizo correctamente</h4>
			</div>
		</div>
<?php
	}
?>

		<div class="row">
			<a class="btn-small btn-large waves-effect waves-light cyan modal-trigger right-aling" href="#modal1">Ingresar Funcionario</a>

		</div>
		


		<div id="modal1" class="modal">
			<div class="center">
				<h4>
					Ingresar Funcionario
				</h4>
			</div>


			<div class="modal-content">
				<form action="index.php?r=<?=$ruta?>" method="POST" class="col s12">

					<div class="row">
							<div class="input-field col s12">
								<input id="ci" type="number" class="validate" name="ci">
								<label for="ci">CI</label>
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
						<div class="input-field col s16">
							<input id="correo" type="email" class="validate" name="correo">
							<label for="correo">correo</label>
						</div>
						<div class="input-field col s16">
    						<select>
      							<option value="" disabled selected>cargo</option>
      							
<?php
	foreach($listaCargoSelect as $cargo ){
?>
								<option value="<?=$cargo['id']?>"><?=$cargo['nombre']?></option>

<?php
	}
?>
    						</select>
    						<label for="cargo">Cargos</label>
  						</div>
						<div>
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
			  <th>Correo</th>
			  <th>Cargo</th>

			  <th></th>
            </tr>
        </thead>

        <tbody>

<?php
	foreach($listaFuncionarios as $funcionario){

?>
			<tr>
			  	<td><?=$funcionario['ci']?></td>
				<td><?=$funcionario['nombre']?></td>
				<td><?=$funcionario['apellido']?></td>
				<td><?=$funcionario['telefono']?></td>
				<td><?=$funcionario['correo']?></td>
				<td ><?=$cargo['nombre']?></td>
				<td>
					<div class="right-aling">
                        <a href="index.php?r=<?=$ruta?>&a=editar&CI=<?=$funcionario['ci']?>" class="waves-effect cyan btn-floating">
							<i class="material-icons left">edit</i>
						</a>
                        <a href="index.php?r=<?=$ruta?>&a=borrar&CI=<?=$funcionario['ci']?>" class="waves-effect red btn-floating">
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
				for($i =1 ; $i <= $totalPaginas; $i++){

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