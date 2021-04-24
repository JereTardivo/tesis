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
    <title>Acciones Humedad</title>
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
    estadoRele = "0";

    estadoSemafoto = "";

    function OnOff() {

        if (estadoRele == "0") {
            message = new Paho.Message("1");
            message.destinationName = 'Rele1';
            mqtt.send(message);

        } else if (estadoRele == "1") {
            message = new Paho.Message("0");
            message.destinationName = 'Rele1';
            mqtt.send(message);

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

    function onMessageArrived(message) {

        var topic = message.destinationName;
        var payload = message.payloadString;

        $('#ws').prepend('<br>' + topic + ' = ' + payload + '');
        if (message.destinationName == 'Rele1') { //acá coloco el topic
            //document.getElementById("switch").textContent = message.payloadString ;
            estadoRele = message.payloadString;
            if (message.payloadString == '0') {
                document.getElementById("luz").style.backgroundColor = "#7e7e7e";
                document.getElementById("switch-label").checked = false;
            }
            if (message.payloadString == '1') {
                document.getElementById("luz").style.backgroundColor = "blue";
                document.getElementById("switch-label").checked = true;
            }

        }
        

       
    };

    $(document).ready(function() {
        MQTTconnect();
    });
</script>

<body class="justify-content-around align-items-center">
    <div class="container border" style="height: 30%;">
        <div class="row vh-100 justify-content-around">
            <div class="col-sm-3 text-center" style="margin-left: 5%;">
                    <br>
                    <h5>Interruptor ventilador</h5>
                    <label class="switch-button">
                        <input type="checkbox" name="switch-button" id="switch-label" class="switch-button__checkbox" onclick='OnOff()' <?php if ($Switch["valor"] === "Encendida") { ?> checked <?php } ?>>
                        <label for="switch-label" class="switch-button__label"></label>
                    </label>

                    <label id="luz" style="width: 50px; height: 50px;border-radius: 50%; margin-left: 50px;"></label>
                    <br>
            </div>
            
        </div>
    </div>
    

</body>

</html>