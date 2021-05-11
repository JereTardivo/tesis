<?php
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
$usuario = $_SESSION['usuario'];
$nivel = $_SESSION['nivel'];

if ($varsesion == null || $varsesion = '') {
  header("Location: ingreso.php");
  die();
}
session_abort();
?>




<link href="css/style.css" rel="stylesheet">
<link href="img/favicon.png" rel="icon">
<link href="img/apple-touch-icon.png" rel="apple-touch-icon">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="vendor/icofont/icofont.min.css" rel="stylesheet">
<link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="vendor/venobox/venobox.css" rel="stylesheet">
<link href="vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">



<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center">
    <h1 class="logo mr-auto"><a href="general.php">MT Seguridad</a></h1>
    <nav class="nav-menu d-none d-lg-block">
      <ul>
        <li class="active"><a href="general.php">Home</a></li>
        
          <li class="drop-down"><a href="#">Seguridad</a>
            <ul>
              <li class="drop-down"><a href="#">Temperatura</a>
                <ul>
                  <?php if ($nivel !== 'operario') { ?>
                  <li><a href="iTemperatura.php">Indicadores</a></li>
                  <?php if ($nivel === 'admin') { ?>
                    <li><a href="accionesTemperatura.php">Acciones</a></li>
                  <?php }} ?>
                  <li><a href="registrosTemperatura.php">Registros</a></li>
                </ul>
              </li>
              <li class="drop-down"><a href="#">Movimiento</a>
                <ul>
                  <?php if ($nivel !== 'operario') { ?>
                  <li><a href="iMovimiento.php">Indicadores</a></li>
                  <?php if ($nivel === 'admin') { ?>
                    <li><a href="accionesMovimiento.php">Acciones</a></li>
                  <?php }} ?>
                  <li><a href="registrosTemperatura.php">Registros</a></li>
                </ul>
              </li>
              <li class="drop-down"><a href="#">Humedad</a>
                <ul>
                  <?php if ($nivel !== 'operario') { ?>
                  <li><a href="iHumedad.php">Indicadores</a></li>
                  <?php if ($nivel === 'admin') { ?>
                    <li><a href="accionesHumedad.php">Acciones</a></li>
                  <?php }} ?>
                  <li><a href="registrosHumedad.php">Registros</a></li>
                </ul>
              </li>
              <li class="drop-down"><a href="#">Gas</a>
                <ul>
                  <?php if ($nivel !== 'operario') { ?>
                  <li><a href="iGas.php">Indicadores</a></li>
                  <?php if ($nivel === 'admin') { ?>
                    <li><a href="accionesGas.php">Acciones</a></li>
                  <?php }} ?>
                  <li><a href="registrosGas.php">Registros</a></li>
                </ul>
              </li>
              <?php if ($nivel !== 'operario') { ?>
              <li class="drop-down"><a href="#">Sonido</a>
                <ul>

                  <li><a href="iSonido.php">Indicadores</a></li>
                </ul>
              </li>
            <?php } ?>
              <li class="drop-down"><a href="#">Datos Generales</a>
                <ul>
                  <li><a href="datosregistros.php">Registros</a></li>
                  <li><a href="grafico2.php">Grafico</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="drop-down"><a href="#">Higiene</a>
            <ul>
              <li><a href="dispenser.php">Dispenser</a></li>
            </ul>
          </li>
        
        <li class="drop-down"><a href="#">Usuarios</a>
          <ul>
            <li class="drop-down"><a href="#">Tablas</a>
              <ul>
                <li><a href="datosingreso.php">Ver Ingresos</a></li>
              </ul>
            </li>
            <li class="drop-down"><a href="#">Graficos</a>
              <ul>
                <li><a href="grafico1.php">Cantidad de ingresos</a></li>
                <li><a href="grafico3.php">Cantidad de ingresos por zona</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="drop-down get-started-btn"><a> <?php echo ucfirst($usuario) ?> </a>
          <ul>
            <li><a href="cerrar_sesion.php">Salir</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</header>

<script src="vendor/aos/aos.js"> </script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/main.js"></script>

<div style="width: 100%; height: 75px; background: #37517e;"></div>