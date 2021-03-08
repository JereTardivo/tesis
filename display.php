<?php
include("Conexion.php");
$consultaSwitch = "SELECT * FROM registros WHERE nombre = 'Switch' ORDER BY idRegistro DESC LIMIT 1";
$resultado = mysqli_query ($conexion, $consultaSwitch);
$Switch = mysqli_fetch_assoc($resultado);
$consultaTemp = "SELECT * FROM registros WHERE nombre = '/R501/temperatura'ORDER BY idRegistro DESC LIMIT 1";
$resultado = mysqli_query ($conexion, $consultaTemp);
$temperatura = mysqli_fetch_assoc($resultado);
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
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/config.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/switch.css">
	<title>Inicio</title>

    
    </head>
    
    

    <body>
    	<?php 
    	include("navegacion.php")
    	 ?>
    	
    	 	<div style="float: left; margin-left: 30%;">
		        <a>Pieza </a><br>
		        <label class="switch-button" >
		            
		                <input type="checkbox" name="switch-button" id="switch-label" class="switch-button__checkbox" onclick='OnOff()' <?php if ($Switch["valor"] === "Encendida") {?> checked <?php } ?> >
		                <label for="switch-label" class="switch-button__label"></label>
		                
		        </label><br>
		        <a id ="switch"><?php echo $Switch["valor"] ?></a><br><br>

		        
	        </div>
        <div id="gauge" style="float: right; margin-right: 30%;"></div>
       	<div id="container" style="width: 100%; height: 400px;"></div>
        

        <a>Temperatura: </a>
        <a id ="temperatura"><?php echo $temperatura["valor"] ?></a>
      </div>
        
       	<script type="text/javascript">
    	var g = new JustGage({
		    id: "gauge",
		    value: <?php echo $temperatura["valor"]?>,
		    min: 0,
		    max: 1000,
		    title: "Temperatura"
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
	            onFailure: function (message) {
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
	        console.log("Host="+ host + ", port=" + port + ", path=" + path + " TLS = " + useTLS + " username=" + username + " password=" + password);
	        mqtt.connect(options);
	    };
	    ///////////ACCIONES
	    estadoSwitch = "<?php echo $Switch["valor"]?>";
	    temperaturas = "<?php echo $temperatura["valor"]?>";

	    function OnOff(){

	        if (estadoSwitch == "Apagada"){
	          message = new Paho.Message("Encendida");
	          message.destinationName = 'Switch';
	          mqtt.send(message);
	        }
	        else if (estadoSwitch == "Encendida"){
	          message = new Paho.Message("Apagada");
	          message.destinationName = 'Switch';
	          mqtt.send(message);
	        }


	      };
	      function enviarSalidaAnalogica(){
	        var dato = document.getElementById("myRange").value;
	        message = new Paho.Message(dato);
	        message.destinationName = '/R501/temperatura'
	        mqtt.send(message);
	      };
	    ////////////////
	    
	    function onConnect() {
	        $('#status').val('Connected to ' + host + ':' + port + path);
	        // Connection succeeded; subscribe to our topic
	        mqtt.subscribe(topic, {qos: 0});
	        $('#topic').val(topic);
	    }

	    

	    function onConnectionLost(response) {
	        setTimeout(MQTTconnect, reconnectTimeout);
	        $('#status').val("connection lost: " + responseObject.errorMessage + ". Reconnecting");

	    };

	    function onMessageArrived(message) {

	        var topic = message.destinationName;
	        var payload = message.payloadString;

	        $('#ws').prepend('<br>' + topic + ' = ' + payload + '');
	        if (message.destinationName == 'Switch') { //acá coloco el topic
	            document.getElementById("switch").textContent = message.payloadString ;
	            estadoSwitch = message.payloadString;
	            
	        }
	        if (message.destinationName == '/R501/temperatura') { //acá coloco el topic
	            document.getElementById("temperatura").textContent = message.payloadString ;
	            temperaturas = parseInt(message.payloadString);
	            g.refresh(message.payloadString);
	        }

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
	            load: function () {

	                // set up the updating of the chart each second
	                var series = this.series[0];
	                setInterval(function () {
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
	            announcementFormatter: function (allSeries, newSeries, newPoint) {
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
	        data: (function () {
	            // generate an array of random data
	            var data = [],
	                time = (new Date()).getTime(),
	                i;

	            for (i = -19; i <= 0; i += 1) {
	                data.push({
	                    x: time + i * 1000,
	                    y: <?php echo $temperatura["valor"]?>
	                });
	            }
	            return data;
	        }())
	    }]
	});
	    
    </script>
       
	


</body>



</html>    