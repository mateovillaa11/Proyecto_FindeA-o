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
    <header>
        <nav>
            <div class="nav-wrapper cyan ">
              <a href="index.php" class="brand-logo black-text center ">Logo</a>
              <ul class="right hide-on-med-and-down">
                <li>
                  <a class='dropdown-trigger btn' href='#' data-target='dropdown1'>
                    <i class="material-icons">person</i>
                  </a>
                </li>
              </ul>
              <ul id='dropdown1' class='dropdown-content'>
                <li>
                  <a href="#!">Perfil</a>
                </li>
                <li>
                  <a href="#!">Salir</a>
                </li>
                <li class="divider" tabindex="-1"></li>
                <li>
                  <a href="#!">Cancelar</a>
                </li>
              </ul>
            </div>
          
          
          <div>
              <ul id="slide-out" class="sidenav sidenav-fixed">
                <li>
                  <div class="user-view">
                    <div class="background">
                      <img src="" style="width:300px">
                    </div>
                    <a href="#user"><img class="circle" src="img/pexels-pixabay-269077.jpg"></a>
                    <a href="#name"><span class="black-text name">Admin</span></a>
                    <a href="#email"><span class="black-text email">administrador1@gmail.com</span></a>
                  </div>
                </li>
                <li>
                  <a href="index.php?r=clientes">
                    <i class="material-icons green-text text-darken-4">person</i>Clientes
                  </a>
                </li>
                <li>
                  <a href="index.php?r=envios">
                    <i class="material-icons green-text text-darken-4">time_to_leave</i>Envios
                  </a>
                </li>
                <li>
                  <a href="index.php?r=funcionarios">
                    <i class="material-icons green-text text-darken-4">contacts</i>Funcionarios
                  </a>
                </li>
              
              </ul>
            <div class="container">
          </div>
        </nav>     
    </header>

  
    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="./materialize/materialize/js/materialize.min.js"></script>
    <script>			
			document.addEventListener('DOMContentLoaded', function() {
				M.AutoInit();        
				var elems = document.querySelectorAll('.dropdown-trigger');
				var instances = M.Dropdown.init(elems, options);
			});
		</script>
  
  </body>
</html>
