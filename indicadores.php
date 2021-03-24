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
	      <label id="tempe" style="width: 15%; "></label>
		  <label id="hume" style="width: 15%;"></label>
		  <label id="cont" style="width: 15%;"></label>
		  <label id="contluz" style="width: 15%;"></label>
		  <label id="mov" style="width: 15%;"></label>
		  <label id="ult" style="width: 15%;"></label>
	</div>	 	

</body>

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
		    title: "Conteo Sonido"
		  });  
		  var cl = new JustGage({
		    id: "contluz",
		    value: 0,
		    min: 0,
		    max: 20,
		    title: "Conteo Luz"
		  });  
		  var m = new JustGage({
		    id: "mov",
		    value: 0,
		    min: 0,
		    max: 1,
		    title: "Movimiento"
		  });  
		  var u = new JustGage({
		    id: "ult",
		    value: 0,
		    min: 0,
		    max: 1,
		    title: "Ultrasonico"
		  });  
	    
	    
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
			if (message.destinationName == 'Movimiento') { 
				movimiento = parseInt(message.payloadString);
				m.refresh(message.payloadString);
			}
			if (message.destinationName == 'Ultrasonico') { 
				ultrasonico = parseInt(message.payloadString);
				u.refresh(message.payloadString);
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

</html>    