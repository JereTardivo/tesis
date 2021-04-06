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
	<title>Inicio</title>

</head>

<body>

	<div style="margin-top: 0px;">
		<label id="mov" style="width: 14%;"></label>
	</div>

</body>

<script type="text/javascript">
	
	
	var m = new JustGage({
		id: "mov",
		value: 0,
		min: 0,
		max: 1,
		title: "Movimiento"
	});
	
	///////////ACCIONES

	movimiento = 0;

	function onMessageArrived(message) {

		var topic = message.destinationName;
		var payload = message.payloadString;

		$('#ws').prepend('<br>' + topic + ' = ' + payload + '');

		if (message.destinationName == 'Movimiento') {
			movimiento = parseInt(message.payloadString);
			m.refresh(message.payloadString);
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