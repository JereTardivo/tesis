<?php
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
$usuario = $_SESSION['usuario'];
if ($varsesion == null || $varsesion = '') {
  header("Location: ingreso.php");
  die();
}
session_abort();
?>

<link href="css/style.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="vendor/icofont/icofont.min.css" rel="stylesheet">


<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center">
    <h1 class="logo mr-auto"><a href="general.php">MT Security</a></h1> 
<nav class="nav-menu d-none d-lg-block">
  <ul>
    <li class="active"><a href="general.php">Home</a></li>
    <li class="drop-down"><a href="#">Seguridad</a>
      <ul>
        <li><a href="botones.php">Botones</a></li>
        <li><a href="indicadores.php">Indicadores</a></li>
        <li><a href="graficos.php">Graficos</a></li>
        <li class="drop-down"><a href="#">Sub-Opciones</a>
          <ul>
            <li><a href="#">Sub-Opcion 1</a></li>
            <li><a href="#">Sub-Opcion 2</a></li>
            <li><a href="#">Sub-Opcion 3</a></li>
            <li><a href="#">Sub-Opcion 4</a></li>
            <li><a href="#">Sub-Opcion 5</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li class="drop-down"><a href="#">Higiene</a>
      <ul>
        <li><a href="display.php">Displays</a></li>
        
        
      </ul>
    </li>
    <li class="drop-down"><a href="#">Usuarios</a>
      <ul>
        <li class="drop-down"><a href="#">Tablas</a>
          <ul>
            <li><a href="datosingreso.php">Ver Ingresos</a></li>
            <li><a href="datosregistros.php">Ver Registros</a></li>
            
          </ul>
        </li>
        <li class="drop-down"><a href="#">Graficos</a>
          <ul>
            <li><a href="grafico1.php">Cantidad de ingresos</a></li>
            <li><a href="grafico2.php">Cantidad de registros</a></li>
            
          </ul>
        </li>
        
      </ul>
    </li>
    <li class="drop-down get-started-btn"><a> <?php echo $usuario ?> </a>
      <ul>
        <li><a href="cerrar_sesion.php">Salir</a></li>
      </ul>
    </li>
  </ul>
</nav>

  </div>
</header>
<div style="width: 100%; height: 75px; background: #37517e;"></div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/main.js"></script>