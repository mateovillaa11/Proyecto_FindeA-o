<?php

	require_once("modelos/usuarios.php");

	$nombre = isset($_POST['nombre'])?$_POST['nombre']:"";
	$clave = isset($_POST['clave'])?$_POST['clave']:"";

	if($nombre != "" && $clave != "" && isset($_POST['action']) && $_POST['action'] == "login"){

		$objUsuarios= new usuarios();
		$respuesta = $objUsuarios->login($nombre, $clave);

		if($respuesta == "OK"){
			header('Location: index.php');
		}

	}

?>




<!DOCTYPE html>
<html>
    <head>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="./materialize/materialize/css/materialize.min.css"  media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body class="cyan">
        <br></br>
        <br></br>
        <div class="container">
            <div class="card">
                <div class="row">

                    <div class="col s10 m6 offset-s1 offset-m3">
                        <form action="login.php" method="POST" class="col s12">
                            <div class="row">
                                <h3 class="center">Iniciar Sesion</h3>
                            </div>
<?php
if(isset($respuesta) && $respuesta == "Error"){
?>
					        <div class="row">
						        <div class="input-field col s12 red center">
							        <h5>Error al ingresar datos</h5>
						        </div>
					        </div>
<?php
		}
?>
					        <div class="row">
						        <div class="input-field col s12">
							        <input id="nombre" type="text" class="validate" name="nombre" autocomplete="off">
							        <label for="nombre">Nombre</label>
                                </div>
					        </div>

					        <div class="row">					
						        <div class="input-field col s12">
							        <input id="clave" type="password" class="validate" name="clave" autocomplete="off">
							        <label for="clave">Clave</label>
						        </div>
					        </div>

					        <div class="row">					
						        <button class="btn waves-effect waves-light right cyan" type="submit" name="action" value="login">Iniciar Sesion
							        <i class="material-icons right"></i>
						        </button>
					        </div>
				        </form>
			        </div>

                </div>
		    </div>
        </div>
       

        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="./materialize/materialize/js/materialize.min.js"></script>
    </body>
</html>