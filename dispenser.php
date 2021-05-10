<?php
include("Conexion.php");
include("navegacion.php");
$consulta = "SELECT COUNT(*) FROM registros WHERE nombre = 'Ultrasonico'";
$resultado = mysqli_query($conexion, $consulta);
$ultrasonico = mysqli_fetch_assoc($resultado);
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
			<div class="col-sm-2 text-center border" style="height:50%; margin-left:5%; margin-top:5%">
				
				<img id="img" src="" style="margin-top: 50px;">
			</div>
			<div class="col-sm-5 text-center border" style="height:70%">
				
				<label id="containerUlt" style="width:100%"></label>
				
			</div>
			<div class="col-sm-2 text-center border" style="height:70%">
				
				<label id="ult"></label>
				
			</div>
			
			
		</div>
	</div>
	

</body>
<script src="js/graficoDistancia.js"></script>

<script type="text/javascript">
	var u = new JustGage({
		id: "ult",
		value: "<?php echo $ultrasonico ["COUNT(*)"]; ?>",
		min: 0,
		max: 100,
		title: "Ultrasonico"
	});
	


	///////////ACCIONES

	ultrasonico = 0;
	cont = <?php echo $ultrasonico ["COUNT(*)"]; ?>;
	

	function onMessageArrived(message) {

		var topic = message.destinationName;
		var payload = message.payloadString;

		$('#ws').prepend('<br>' + topic + ' = ' + payload + '');


			if (message.destinationName == 'Ultrasonico') {
				ultrasonico = parseInt(message.payloadString);
				

			if (ultrasonico == 0) { 
				document.getElementById("img").src = "img/dispenser1.jpg";

				u.refresh(cont);
			}
			if (ultrasonico == 1) { 
				document.getElementById("img").src = "img/dispenser.jpg";
				cont = cont + 0.5;
			}
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