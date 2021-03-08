


<?php
	session_start();
	
	error_reporting(0);
	$varsesion = $_SESSION['usuario'];
	$usuario = $_SESSION['usuario'];
	if($varsesion == null || $varsesion = '') {
		
		header("Location: ingreso.php");
		die();


	}
	
?>
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.bundle.min.js"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Inicio</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Acciones
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="botones.php">Opcion 1</a></li>
            <li><a class="dropdown-item" href="display.php">Opcion 2</a></li>
            
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Ver datos
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Opción 1</a></li>
            <li><a class="dropdown-item" href="#">Opcion 2</a></li>
            
          </ul>
        </li>
        
      </ul>
      <form class="d-flex">
             
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><?php echo $usuario?></a>
        <a href="cerrar_sesion.php" class="btn btn-outline-danger">Salir</a>
      </form>
    </div>
  </div>
</nav>