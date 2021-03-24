<?php
include("Conexion.php");
include("navegacion.php")
?>
<!DOCTYPE html>
<html>

<head>
	<!-- HIGHCHART -->
	<script src="js/highcharts.js"></script>

	<!-- GAGE -->
	<script src="js/raphael-2.1.4.min.js"></script>
	<script src="js/justgage.js"></script>
	<!-- RPARA MQTT -->
	<script src='js/mqttws31.js' type='text/javascript'></script>
	<script src="js/config.js" type="text/javascript"></script>
	<script src="js/conexionMQTT.js"></script>

	<script src="vendor/jquery/jquery.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="css/switch.css">
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


	<title>Inicio</title>


</head>

<body style="background-color: rgba(51,104,157)">

	<div class="container">
		<div class="row .align-items-start" style="margin-left: -95px;">
			<div class="col-auto">
				<table class="table table-hover" >
					<tbody>
						<tr>
							<td><label id="containerTem" style="width:105%"></label></td>
							<td><label id="containerHum" style="width:105%"></label></td>
						</tr>
				</table>
			</div>

			<div class="w-100"></div>
			<div class="w-100"></div>

			<div class="col-auto">
				<table class="table table-hover">
					<tbody>
						<tr>
							<td><label id="containerCont" style="width:100%"></label></td>
							<td><label id="containerContLuz" style="width:100%"></label></td>
						</tr>
				</table>
			</div>

			<div class="w-100"></div>
			<div class="w-100"></div>

			<div class="col-auto">
				<table class="table table-hover">
					<tbody>
						<tr>
							<td><label id="containerMov" style="width:100%"></label></td>
							<td><label id="containerUlt" style="width:100%"></label></td>
						</tr>
				</table>
			</div>
		</div>


		<script src="js/graficoConteo.js"></script>
		<script src="js/graficoConteoLuz.js"></script>
		<script src="js/graficoDistancia.js"></script>
		<script src="js/graficoHumedad.js"></script>
		<script src="js/graficoMovimiento.js"></script>
		<script src="js/graficoTemperatura.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



</body>



</html>