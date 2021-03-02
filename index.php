<?php
include("Conexion.php");

?>
<!DOCTYPE html>
<html>
<head>
	
	<script src='js/mqttws31.js' type='text/javascript'></script>
	
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/config.js" type="text/javascript"></script>
	<title>Inicio</title>
	
    
    
    

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
    }
    
    ///////////////////aca va codigo nuevo
        function enviarSalidaAnalogica(){
        var dato = document.getElementById("myRange").value;
        message = new Paho.Message(dato);
        message.destinationName = '/R501/temperatura'
        mqtt.send(message);
      };
      function OnOff(dato){
        message = new Paho.Message(dato);
        message.destinationName = 'Switch'
        mqtt.send(message);
      };
      function captar(){
      	var x = document.getElementById("myDato").value;
        message = new Paho.Message(x);
        message.destinationName = 'Dato'
        mqtt.send(message);
      };
      function myFunction() {
      var x = document.getElementById("mySelect").value;
      if (x!="") {
      	message = new Paho.Message(x);
	    message.destinationName = 'Demo'
	    mqtt.send(message);
		}
	  
	}

      ///////////////////////////////

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
        if (message.destinationName == '/R501/' + 'temperatura') { //acá coloco el topic
            document.getElementById("temperatura").textContent = message.payloadString ;
        }
        if (message.destinationName == 'Switch') { //acá coloco el topic
            document.getElementById("switch").textContent = message.payloadString ;
        }
        if (message.destinationName == 'Demo') { //acá coloco el topic
            document.getElementById("demo").textContent = message.payloadString ;
        }
        if (message.destinationName == 'Dato') { //acá coloco el topic
            document.getElementById("dato").textContent = message.payloadString ;
        }
    };


    $(document).ready(function() {
        MQTTconnect();
    });

    </script>
</head>
<body>
	<?php 
	include("navegacion.php"); 
	?>
	
    <div>
        <a>Salida Analógica: </a>
        <input type="range" id="myRange" min="0" max="1023"  onmouseup="enviarSalidaAnalogica()">
        
      </div>
      <div>
        <a>Salida Digital: </a>
        <button type='button' onclick='OnOff("ON")'>ON</button>
        <button type='button' onclick='OnOff("OFF")'>OFF</button>
      </div>
      <div>
      	<select id="mySelect" onchange="myFunction()">
		  <option></option>
		  <option value="Rojo">Rojo</option>
		  <option value="Amarillo">Amarillo</option>
		  <option value="Verde">Verde</option>
		</select>
      </div>
      <div>
        <a>Salida Digital: </a>
        <input type="text" id="myDato" name="">
        <button type='button' onclick='captar()'>Enviar</button>
        
      </div>
      
      <div>
        <a>Temperatura: </a>
        <a id ="temperatura">-</a>
      </div>
      <div>
        <a>Switch: </a>
        <a id ="switch">-</a>
      </div>
      <div>
        <a>Color: </a>
        <a id ="demo">-</a>
      </div>
      <div>
        <a>Dato: </a>
        <a id ="dato">-</a>
      </div>
    
    

</body>

</html>