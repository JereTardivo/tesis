<?php
include("Conexion.php");
$consultaTemp = "SELECT * FROM registros WHERE nombre = 'Temperatura'ORDER BY idRegistro DESC LIMIT 1";
$resultado = mysqli_query($conexion, $consultaTemp);
$temperatura = mysqli_fetch_assoc($resultado);
$consultaHum = "SELECT * FROM registros WHERE nombre = 'Humedad'ORDER BY idRegistro DESC LIMIT 1";
$resultado = mysqli_query($conexion, $consultaHum);
$humedad = mysqli_fetch_assoc($resultado);
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

	<script src="js/jquery.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="css/switch.css">
	<title>Inicio</title>


</head>



<body>
	<?php
	include("navegacion.php")
	?>

	<div>
		<label id="tempe" style="width: 49%;"></label><br>
		<label id="container" style="width: 50%; height: 200px;"></label>
	</div>

	<label id="hume"></label>
	<label id="cont"></label>




	</div>

	<script type="text/javascript">
		var t = new JustGage({
			id: "tempe",
			value: <?php echo $temperatura["valor"] ?>,
			min: 0,
			max: 100,
			levelColors: ["blue"],
			title: "Temperatura"
		});
		var h = new JustGage({
			id: "hume",
			value: <?php echo $humedad["valor"] ?>,
			min: 0,
			max: 100,
			levelColors: ["red"],
			title: "Humedad"
		});
		var c = new JustGage({
			id: "cont",
			value: 0,
			min: 0,
			max: 100,
			levelColors: ["green"],
			title: "Conteo"
		});

		var mqtt;
		var reconnectTimeout = 2000;

		function MQTTconnect() {
			if (typeof path == "undefined") {
				path = '/mqtt';
			}
			mqtt = new Paho.Client(
				host,
				port,
				path,
				"web_" + parseInt(Math.random() * 100, 10)
			);
			var options = {
				timeout: 3,
				useSSL: useTLS,
				cleanSession: cleansession,
				onSuccess: onConnect,
				onFailure: function(message) {
					$('#status').val("Connection failed: " + message.errorMessage + "Retrying");
					setTimeout(MQTTconnect, reconnectTimeout);
				}
			};


			mqtt.onConnectionLost = onConnectionLost;
			mqtt.onMessageArrived = onMessageArrived;

			if (username != null) {
				options.userName = username;
				options.password = password;
			}
			console.log("Host=" + host + ", port=" + port + ", path=" + path + " TLS = " + useTLS + " username=" + username + " password=" + password);
			mqtt.connect(options);
		};
		///////////ACCIONES

		temperaturas = "<?php echo $temperatura["valor"] ?>";
		humedad = "<?php echo $humedad["valor"] ?>";
		conteo = "0";




		function onMessageArrived(message) {

			var topic = message.destinationName;
			var payload = message.payloadString;

			$('#ws').prepend('<br>' + topic + ' = ' + payload + '');

			if (message.destinationName == 'Temperatura') {
				temperaturas = parseInt(message.payloadString);
				t.refresh(message.payloadString);
			}
			if (message.destinationName == 'Humedad') {
				humedad = parseInt(message.payloadString);
				h.refresh(message.payloadString);
			}
			if (message.destinationName == 'Conteo') {
				conteo = parseInt(message.payloadString);
				c.refresh(message.payloadString);
			}

		};

		////////////////

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
		///////////////////HIGHCHART
		Highcharts.chart('container', {
			chart: {
				type: 'spline',
				animation: Highcharts.svg, // don't animate in old IE
				marginRight: 10,
				events: {
					load: function() {

						// set up the updating of the chart each second
						var series = this.series[0];
						setInterval(function() {
							var x = (new Date()).getTime(), // current time
								y = temperaturas;
							series.addPoint([x, y], true, true);
						}, 5000);
					}
				}
			},

			time: {
				useUTC: false
			},

			title: {
				text: 'Grafico'
			},

			accessibility: {
				announceNewData: {
					enabled: true,
					minAnnounceInterval: 15000,
					announcementFormatter: function(allSeries, newSeries, newPoint) {
						if (newPoint) {
							return 'New point added. Value: ' + newPoint.y;
						}
						return false;
					}
				}
			},

			xAxis: {
				type: 'datetime',
				tickPixelInterval: 150
			},

			yAxis: {
				title: {
					text: 'Value'
				},
				plotLines: [{
					value: 0,
					width: 1,
					color: '#808080'
				}]
			},

			tooltip: {
				headerFormat: '<b>{series.name}</b><br/>',
				pointFormat: '{point.x:%Y-%m-%d %H:%M:%S}<br/>{point.y:.2f}'
			},

			legend: {
				enabled: false
			},

			exporting: {
				enabled: false
			},

			series: [{
				name: 'Random data',
				data: (function() {
					// generate an array of random data
					var data = [],
						time = (new Date()).getTime(),
						i;

					for (i = -19; i <= 0; i += 1) {
						data.push({
							x: time + i * 1000,
							y: <?php echo $temperatura["valor"] ?>
						});
					}
					return data;
				}())
			}]
		});
	</script>




</body>



</html>