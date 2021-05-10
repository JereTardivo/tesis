<?php
include("Conexion.php");
include("navegacion.php");
$consultaSwitch = "SELECT * FROM registros WHERE nombre = 'Switch' ORDER BY idRegistro DESC LIMIT 1";
$resultado = mysqli_query($conexion, $consultaSwitch);
$Switch = mysqli_fetch_assoc($resultado);
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
    estadoSwitch = "<?php echo $Switch["valor"] ?>";
    Bocina = "0";
    Led = "0";
    estadoSemaforo = "Verde";
    

    function OnOff() {

        if (estadoSwitch == "Apagada") {
            message = new Paho.Message("Encendida");
            message.destinationName = 'Switch';
            mqtt.send(message);

        } else if (estadoSwitch == "Encendida") {
            message = new Paho.Message("Apagada");
            message.destinationName = 'Switch';
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
        if (message.destinationName == 'Switch') { 
            estadoSwitch = message.payloadString;
            if (message.payloadString == 'Apagada') {
                document.getElementById("luz").style.backgroundColor = "#7e7e7e";
                document.getElementById("switch-label").checked = false;
            }
            if (message.payloadString == 'Encendida') {
                document.getElementById("luz").style.backgroundColor = "blue";
                document.getElementById("switch-label").checked = true;
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
                <!--SWITCH INTERNO -->
                <label class="switch-button">
                    <input type="checkbox" name="switch-button" id="switch-label" class="switch-button__checkbox" onclick='OnOff()' <?php if ($Switch["valor"] === "Encendida") { ?> checked <?php } ?>>
                    <label for="switch-label" class="switch-button__label"></label>
                </label>

                <label id="luz" style="width: 50px; height: 50px;border-radius: 50%; margin-left: 50px; 
                   <?php if ($Switch["valor"] === "Apagada") { ?> background: #7e7e7e; <?php } ?>
                   <?php if ($Switch["valor"] === "Encendida") { ?> background: blue; <?php } ?>"></label>
                <br>
                
            </div>
            <!--SWITCH DE SEMAFORO -->
            <div class="col-sm-3 text-center" style="margin-left: 5%;">
                <br>
                <h5>Establecer Criticidad Luminica</h5>
                <select id="Select" onchange="myFunction()">
                    <option></option>
                    <option value="Rojo" style="background-color: red;">PELIGRO</option>
                    <option value="Amarillo" style="background-color: yellow;">CUIDADO</option>
                    <option value="Verde" style="background-color: green;">NORMAL</option>
                </select>
                <label id="color" style="width: 50px; height: 50px;border-radius: 50%; margin-left: 50px"></label>
            </div>
            
        </div>
        
    </div>
    

</body>

</html>