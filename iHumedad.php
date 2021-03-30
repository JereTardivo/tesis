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
	
	<script src="js/conexionMQTT.js"></script>
	

    <script src="vendor/jquery/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/switch.css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<title>Inicio</title>
  
</head>

<body>
	<div class="container">
		<div class="row .align-items-start" style="margin-left: -95px;">
			
			<div class="col-auto">
				<table class="table table-hover">
					<tbody>
						<tr>
							<td align="center">
								<label id="humedad" style="width:100%"></label>
								<label id="color" style="width: 75px; height: 75px;border-radius: 50%; margin-top: 50px;"></label>
							</td>
							<td><label id="containerHum" style="width:100%"></label></td>
							
						</tr>
				</table>
			</div>
		</div>
	 	

</body>

<script src="js/graficoHumedad.js"></script>
<script type="text/javascript">
    	
		  var h = new JustGage({
		    id: "humedad",
		    value: 0,
		    min: 0,
		    max: 100,
		    title: "Humedad %"
		  });  
	    
	    
	    ///////////ACCIONES
	    
		humedad = 0;
	    
		  

			function onMessageArrived(message) {

			var topic = message.destinationName;
			var payload = message.payloadString;

			$('#ws').prepend('<br>' + topic + ' = ' + payload + '');
			
			
			if (message.destinationName == 'Humedad') { 
				humedad = parseInt(message.payloadString);
				h.refresh(message.payloadString);
			}
			if (humedad <= 65) { //acá coloco el topic
            	
                document.getElementById("color").style.backgroundColor = "green";
            }
            if (humedad > 65 && humedad <= 90) { //acá coloco el topic
            
                document.getElementById("color").style.backgroundColor = "yellow";
            }
            if (humedad > 90) { //acá coloco el topic
            
                document.getElementById("color").style.backgroundColor = "red";
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