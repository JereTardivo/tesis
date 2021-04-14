<?php
include("Conexion.php");
include("navegacion.php");
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
	<script src="js/conexionMQTT.js"></script>

	<script src="vendor/jquery/jquery.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="css/switch.css">
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<title>Inicio</title>

</head>

<body class="m-0 vh-100 row justify-content-around align-items-center">

	<div class="container border" style="height:90%;">
		<br>
		<h2 style="text-align: center;">Medidor de Dispenser de Alcohol</h2>
		<div class="row vh-100 justify-content-around">
			<div class="col-sm-3 text-center border" style="height:50%; margin-left:5%; margin-top:5%">
				
				<img id="img" src="" style="margin-top: 50px;">
			</div>
			<div class="col-sm-6 text-center border" style="height:70%">
				
				<label id="containerUlt" style="width:100%"></label>
				
			</div>
			<label id="ult"></label>
		</div>
	</div>
	<div class="container border" style="height:90%;">
		<h2 style="text-align: center;">Estado Actual y Acciones</h2>
		<!-- Ejemplo, mostrar Luz amarilla cuando se haya activado la bomba X cantidad de veces 
		Luz Roja cuando ya este vacio y alerte que hay que reponer alcohol
		Luz verde cuando ese con capacidad mayor a tantas veces-->
	</div>

</body>
<script src="js/graficoDistancia.js"></script>

<script type="text/javascript">
	var u = new JustGage({
		id: "ult",
		value: 0,
		min: 0,
		max: 100,
		title: "Ultrasonico"
	});
	


	///////////ACCIONES

	ultrasonico = 0;
	cont = 0;
	

	function onMessageArrived(message) {

		var topic = message.destinationName;
		var payload = message.payloadString;

		$('#ws').prepend('<br>' + topic + ' = ' + payload + '');


		if (message.destinationName == 'Ultrasonico') {
			ultrasonico = parseInt(message.payloadString);
			
			u.refresh(cont);
			
		}
		
		if (ultrasonico == 0) { 
			document.getElementById("img").src = "img/dispenser1.jpg";
		}
		if (ultrasonico == 1) { 
			document.getElementById("img").src = "img/dispenser.jpg";
		}
		

	};

	function onConnect() {
		$('#status').val('Connected to ' + host + ':' + port + path);
		// Connection succeeded; subscribe to our topic
		mqtt.subscribe(topic, {
			qos: 0
		});
		$('#topic').val(topic);
	}

	function onConnectionLost(response) {
		setTimeout(MQTTconnect, reconnectTimeout);
		$('#status').val("connection lost: " + responseObject.errorMessage + ". Reconnecting");

	};

	$(document).ready(function() {
		MQTTconnect();
	});
</script>

</html>