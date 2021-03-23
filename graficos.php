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

	<script src="js/jquery.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="css/switch.css">
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">


	<title>Inicio</title>


</head>

<body style="background-color: rgba(51,104,157)">
	
	<div class="container">
		<div class="row .align-items-start">
			<div class="col-auto">
				<table class="table table-striped table-bordered table-hover">
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
				<table class="table table-striped table-bordered table-hover">
					<tbody>
						<tr>
							<td><label id="containerCont"style="width:100%"></label></td>
							<td><label id="containerContLuz" style="width:100%"></label></td>
						</tr>
				</table>
			</div>

			<div class="w-100"></div>
			<div class="w-100"></div>

			<div class="col-auto">
				<table class="table table-striped table-bordered table-hover">
					<tbody>
						<tr>
							<td><label id="containerMov"style="width:100%"></label></td>
							<td><label id="containerUlt" style="width:100%"></label></td>
						</tr>
				</table>
			</div>
		</div>

		<script type="text/javascript">
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

			temperaturas = 0;
			humedad = 0;
			conteo = 0;
			conteoluz = 0;
			movimiento = 0;
			ultrasonico = 0;




			function onMessageArrived(message) {

				var topic = message.destinationName;
				var payload = message.payloadString;

				$('#ws').prepend('<br>' + topic + ' = ' + payload + '');

				if (message.destinationName == 'Temperatura') {
					temperaturas = parseInt(message.payloadString);

				}
				if (message.destinationName == 'Humedad') {
					humedad = parseInt(message.payloadString);

				}
				if (message.destinationName == 'Conteo') {
					conteo = parseInt(message.payloadString);

				}
				if (message.destinationName == 'ConteoLuz') {
					conteoluz = parseInt(message.payloadString);

				}
				if (message.destinationName == 'Movimiento') {
					movimiento = parseInt(message.payloadString);

				}
				if (message.destinationName == 'Ultrasonico') {
					ultrasonico = parseInt(message.payloadString);

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
			///////////////////HIGHCHART TEMPERATURA
			Highcharts.chart('containerTem', {
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
					text: 'Temperatura'
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
								y: 0
							});
						}
						return data;
					}())
				}]
			});
			//////////////////CHAR HUMEDAD
			Highcharts.chart('containerHum', {
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
									y = humedad;
								series.addPoint([x, y], true, true);
							}, 5000);
						}
					}
				},

				time: {
					useUTC: false
				},

				title: {
					text: 'Humedad'
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
								y: humedad
							});
						}
						return data;
					}())
				}]
			});
			///////////////////HIGHCHART CONTEO
			Highcharts.chart('containerCont', {
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
									y = conteo;
								series.addPoint([x, y], true, true);
							}, 5000);
						}
					}
				},

				time: {
					useUTC: false
				},

				title: {
					text: 'Conteo'
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

						for (i = -190; i <= 0; i += 1) {
							data.push({
								x: time + i * 1000,
								y: conteo
							});
						}
						return data;
					}())
				}]
			});
			///////////////////HIGHCHART CONTEO LUZ
			Highcharts.chart('containerContLuz', {
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
									y = conteoluz;
								series.addPoint([x, y], true, true);
							}, 5000);
						}
					}
				},

				time: {
					useUTC: false
				},

				title: {
					text: 'Conteo Luz'
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

						for (i = -200; i <= 0; i += 1) {
							data.push({
								x: time + i * 1000,
								y: conteoluz
							});
						}
						return data;
					}())
				}]
			});
			///////////////////HIGHCHART MOVIMIENTO
			Highcharts.chart('containerMov', {
				chart: {
					type: 'column',
					animation: Highcharts.svg, // don't animate in old IE
					marginRight: 10,
					events: {
						load: function() {

							// set up the updating of the chart each second
							var series = this.series[0];
							setInterval(function() {
								var x = (new Date()).getTime(), // current time
									y = movimiento;
								series.addPoint([x, y], true, true);
							}, 1000);
						}
					}
				},

				time: {
					useUTC: false
				},

				title: {
					text: 'Movimiento'
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

						for (i = -100; i <= 0; i += 1) {
							data.push({
								x: time + i * 1000,
								y: movimiento
							});
						}
						return data;
					}())
				}]
			});
			///////////////////HIGHCHART MOVIMIENTO
			Highcharts.chart('containerUlt', {
				chart: {
					type: 'column',
					animation: Highcharts.svg, // don't animate in old IE
					marginRight: 10,
					events: {
						load: function() {

							// set up the updating of the chart each second
							var series = this.series[0];
							setInterval(function() {
								var x = (new Date()).getTime(), // current time
									y = ultrasonico;
								series.addPoint([x, y], true, true);
							}, 1000);
						}
					}
				},

				time: {
					useUTC: false
				},

				title: {
					text: 'Ultrasonico'
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

						for (i = -100; i <= 0; i += 1) {
							data.push({
								x: time + i * 1000,
								y: ultrasonico
							});
						}
						return data;
					}())
				}]
			});
		</script>
		<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



</body>



</html>