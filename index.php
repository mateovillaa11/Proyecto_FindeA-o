<?php

	@session_start();

	if(!isset($_SESSION['nombre'])){

		header('Location: login.php');

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

  
  <body>  
    <div>
      <nav>
        <div class="nav-wrapper cyan absolute ">
          <a href="index.php" class="brand-logo black-text center white-text ">Empresa</a>
          <ul class="right hide-on-med-and-down">
        </div>
      </nav>
      </div>  
        <ul id="slide-out" class="sidenav">
          <li>
            <div class="user-view">
              <div class="background">
                <img src="./documentacion/Img/pexels-pixabay-269077.jpg">
              </div>
              <div>
                <a href="index.php"><img class="circle" src="./documentacion/Img/pexels-pixabay-269077.jpg"></a>
                <a><span class="black-text name"><?=$_SESSION['nombre']?></span></a>
                <a><span class="black-text email">Hola <?=$_SESSION['nombre']?></span></a>
              </div>
            </div> 
          </li>
          <?php
            if($_SESSION['rol'] == "administrador" || $_SESSION['rol'] == "encargado") {              
          ?>
          <li>
            <a class="waves-effect" href="index.php?r=cliente">Clientes</a>
          </li>
          <li>
            <div class="divider"></div>
          </li>
          <li>
            <a class="waves-effect" href="index.php?r=envios">Envios</a>
          </li>
          <li>
            <div class="divider"></div></li>
          </li>
          <li>
            <a class="waves-effect" href="index.php?r=funcionarios">Funcionarios</a>
          </li>
          <li>
            <div class="divider"></div>
          </li>
          <li>
            <a class="waves-effect waves-light modal-trigger red-text" href="#modal2">Cerrar Sesion</a>
          </li>
          <?php
            }
          ?>
          <?php
            if($_SESSION['rol'] == "recepcionista"){              
          ?>
          <li>
            <a class="waves-effect" href="index.php?r=cliente">Clientes</a>
          </li>
          <li>
            <div class="divider"></div>
          </li>
          <li>
            <a class="waves-effect" href="index.php?r=envios">Envios</a>
          </li>
          <li>
            <a class="waves-effect waves-light modal-trigger red-text" href="#modal2">Cerrar Sesion</a>
          </li>
          <?php
            }
          ?>
          <?php
            if($_SESSION['rol'] == "repartidor"){              
          ?>
          <li>
            <a class="waves-effect" href="index.php?r=envios">Envios</a>
          </li>
          <li>
            <div class="divider"></div>
          </li>
          <li>
            <a class="waves-effect waves-light modal-trigger red-text" href="#modal2">Cerrar Sesion</a>
          </li>
          <?php
            }
          ?>
        </ul>
      <div>
        <a href="#" data-target="slide-out" class="sidenav-trigger">
        <i class="material-icons">menu</i>
        </a>
      </div>
      <img src="/Img/pexels-pixabay-269077.jpg" alt="">
      <div id="modal2" class="modal">
        <div class="modal-content">
          <h4 class="center">Desea cerrar sesion <?=$_SESSION['nombre']?>?</h4>
        </div>
        <div class="modal-footer">
          <a href="logout.php" class="modal-close waves-effect waves-green btn-flat">Aceptar</a>
          <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
        </div>
        </div>
        <div class="container">
          <?php
			      include("rutas.php");
          ?>
        </div>
    </div>
        
      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="./materialize/materialize/js/materialize.min.js"></script>
      <script>			
        document.addEventListener('DOMContentLoaded', function() {
          M.AutoInit();        
          var elems = document.querySelectorAll('.dropdown-trigger');
          var instances = M.Dropdown.init(elems, options);
        });
      </script>
      
      <script>
          document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems, options);
        });

        // Initialize collapsible (uncomment the lines below if you use the dropdown variation)
        // var collapsibleElem = document.querySelector('.collapsible');
        // var collapsibleInstance = M.Collapsible.init(collapsibleElem, options);

        // Or with jQuery

        $(document).ready(function(){
          $('.sidenav').sidenav();
        });
      </script>
  
  </body>
</html>
