<?php
include("Conexion.php");
include("navegacion.php");

?>
<!DOCTYPE html>
<html>

<head>
    <script src='js/mqttws31.js' type='text/javascript'></script>
    <script src="vendor/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="js/config.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/switch.css">
    <title>Acciones Temperatura</title>
</head>

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
    
    Bocina = "0";
    Led = "0";
    estadoSemaforo = "Verde";
    

    
    function OnOffB(){

        if (Bocina == "0"){
          message = new Paho.Message("1");
          message.destinationName = 'Bocina';
          mqtt.send(message);
          
        }
        else if (Bocina == "1"){
          message = new Paho.Message("0");
          message.destinationName = 'Bocina';
          mqtt.send(message);
          
        }
  
      };
       function OnOffL(){

        if (Led == "0"){
          message = new Paho.Message("1");
          message.destinationName = 'Led';
          mqtt.send(message);
          
        }
        else if (Led == "1"){
          message = new Paho.Message("0");
          message.destinationName = 'Led';
          mqtt.send(message);
          
        }
  
      };

    function myFunction() {
        var x = document.getElementById("Select").value;
        if (x != "") {
            message = new Paho.Message(x);
            message.destinationName = 'Semaforo'
            mqtt.send(message);
        }

    }
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

    function onMessageArrived(message) {

        var topic = message.destinationName;
        var payload = message.payloadString;

        $('#ws').prepend('<br>' + topic + ' = ' + payload + '');
        
        if (message.destinationName == 'Led') { //acá coloco el topic
            //document.getElementById("switch").textContent = message.payloadString ;
            Led = message.payloadString;
            if (message.payloadString == '0') {
                document.getElementById("luz3").style.backgroundColor = "#7e7e7e";
                document.getElementById("switch-label2").checked = false;
            }
            if (message.payloadString == '1') {
                document.getElementById("luz3").style.backgroundColor = "green";
                document.getElementById("switch-label2").checked = true;
            }

        }
        if (message.destinationName == 'Bocina') { 
            
            Bocina = message.payloadString;
            if (message.payloadString == '0') {
                document.getElementById("luz1").src = "img/bocinano.jpg";
                document.getElementById("switch-label1").checked = false;
            }
            if (message.payloadString == '1') {
                document.getElementById("luz1").src = "img/bocina.jpg";
                document.getElementById("switch-label1").checked = true;
            }
            
        }
        if (message.destinationName == 'Semaforo') { //acá coloco el topic
            estadoSemaforo = message.payloadString;
            if (message.payloadString == 'Rojo') {
                
                document.getElementById("color").style.backgroundColor = "red";
            }
            if (message.payloadString == 'Amarillo') {
                
                document.getElementById("color").style.backgroundColor = "yellow";
            }
            if (message.payloadString == 'Verde') {
               
                document.getElementById("color").style.backgroundColor = "green";
            }

        }
        
        if (message.destinationName == 'Movimiento') { //acá coloco el topic
            if (message.payloadString == '1') {
               
                document.getElementById("color").style.backgroundColor = "red";
            }
            if (message.payloadString == '0') {
                
                document.getElementById("color").style.backgroundColor = "green";
            }
        }
    };

    $(document).ready(function() {
        MQTTconnect();
    });
</script>

<body class="justify-content-around align-items-center">
    <div class="container border" style="height: 50%;">
        <div class="row vh-100 justify-content-around">
            <div class="col-sm-3 text-center" style="margin-left: 5%;">
                <br>
                <h5>Interruptor Alarma Luminica</h5>
                
                <!--SWITCH DE LED VERDE -->
                <label class="switch-button" >
                    
                     <input type="checkbox" name="switch-button2" id="switch-label2" class="switch-button__checkbox" onclick='OnOffL()' >
                    <label for="switch-label2" class="switch-button__label"></label>
                </label>
                <label id="luz3" style="width: 50px; height:50px;border-radius: 50%; margin-left: 50px;"></label>
                <br>
                
                <br>
            </div>
            <!--SWITCH DE SEMAFORO -->
            <div class="col-sm-3 text-center" style="margin-left: 5%;">
                <br>
                <h5>Led en semaforo</h5>
                
                <label id="color" style="width: 50px; height: 50px;border-radius: 50%; margin-left: 50px"></label>
            </div>
            <!--SWITCH DE ALARMA -->
            <label class="switch-button" style="margin-top: 50px; ">
                    
                     <input type="checkbox" name="switch-button1" id="switch-label1" class="switch-button__checkbox" onclick='OnOffB()' >
                    <label for="switch-label1" class="switch-button__label"></label>
                </label>
                <img id="luz1" style="width: 100px; height:100px; margin-top: 50px; ">
                
                <br>
        </div>
        
    </div>
    

</body>

</html>