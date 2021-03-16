<?php
include("Conexion.php");
$consultaTemp = "SELECT * FROM registros WHERE nombre = 'Temperatura'ORDER BY idRegistro DESC LIMIT 1";
$resultado = mysqli_query ($conexion, $consultaTemp);
$temperatura = mysqli_fetch_assoc($resultado);
$consultaHum = "SELECT * FROM registros WHERE nombre = 'Humedad'ORDER BY idRegistro DESC LIMIT 1";
$resultado = mysqli_query ($conexion, $consultaHum);
$humedad = mysqli_fetch_assoc($resultado);
$consultaCont = "SELECT * FROM registros WHERE nombre = 'Conteo'ORDER BY idRegistro DESC LIMIT 1";
$resultado = mysqli_query ($conexion, $consultaCont);
$conteo = mysqli_fetch_assoc($resultado);
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
    	
    	 	
        <label id="tempe"></label>
		<label id="hume"></label>
		<label id="cont"></label>
		<label id="contluz"></label>
       	
      </div>
        
       	<script type="text/javascript">
    	var t = new JustGage({
		    id: "tempe",
		    value: 0, //<?php echo $temperatura["valor"]?>,
		    min: 0,
		    max: 45,
		    title: "Temperatura"
		  });
		  var h = new JustGage({
		    id: "hume",
		    value: 0, //<?php echo $humedad["valor"]?>,
		    min: 0,
		    max: 100,		    
		    title: "Humedad"
		  });  
		  var c = new JustGage({
		    id: "cont",
		    value: 0, //<?php echo $conteo["valor"]?>,
		    min: 0,
		    max: 20,
		    title: "Conteo"
		  });  
		  var cl = new JustGage({
		    id: "contluz",
		    value: 0,
		    min: 0,
		    max: 20,
		    title: "Conteo Luz"
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
	    
	    temperaturas = "<?php echo $temperatura["valor"]?>";
		humedad = "<?php echo $humedad["valor"]?>";
		conteo ="<?php echo $conteo["valor"]?>";
		conteoluz = 0;

	    
		  

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
			if (message.destinationName == 'ConteoLuz') { 
				conteoluz = parseInt(message.payloadString);
				cl.refresh(message.payloadString);
			}

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

	    

	    $(document).ready(function() {
	        MQTTconnect();
	    });  
	    
	    
    </script>
       
	


</body>



</html>    