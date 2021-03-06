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

<body class="m-0 vh-100 row justify-content-around align-items-center">

	<div class="container border" style="height:100%;">
		<br>
		<h2 style="text-align: center;">Indicadores de radiacion por sonido</h2>
		<div class="row vh-100 justify-content-around">
			<div class="col-sm-3 text-center border" style="height:50%; margin-left:6%; margin-top:5%">
				
				<img id="img" src="" style="margin-top: 50px;">
			</div>
			<div class="col-sm-2 text-center border" style="height:50%; margin-left:6%; margin-top:5%">
				<label id="cont"></label>
				
			</div>	
			<div class="col-sm-4 text-center border" style="height:70%">
				<label id="containerCont" style="width:100%"></label>
			</div>

		</div>
	</div>

</body>

<script src="js/graficoConteo.js"></script>
<script type="text/javascript">
	var c = new JustGage({
		id: "cont",
		value: 0, 
		min: 0,
		max: 100,
		title: "Tasa de exposición uSv/h"
	});

	///////////ACCIONES
	conteo = 0;
	function onMessageArrived(message) {
		var topic = message.destinationName;
		var payload = message.payloadString;

		$('#ws').prepend('<br>' + topic + ' = ' + payload + '');

		if (message.destinationName == 'Conteo') {
			conteo = parseInt(message.payloadString);
			c.refresh(message.payloadString);
		}
		if (conteo<50) {
			document.getElementById("img").src = "img/radiacionv.png";
		}
		if (conteo>=50 && conteo<100) {
			document.getElementById("img").src = "img/radiaciona.png";
		}
		if (conteo>=100) {
			document.getElementById("img").src = "img/radiacionr.png";
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