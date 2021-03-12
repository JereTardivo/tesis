<?php
include("Conexion.php");
$consultaSwitch = "SELECT * FROM registros WHERE nombre = 'Switch' ORDER BY idRegistro DESC LIMIT 1";
$resultado = mysqli_query($conexion, $consultaSwitch);
$Switch = mysqli_fetch_assoc($resultado);
?>
<!DOCTYPE html>
<html>

<head>

    <script src='js/mqttws31.js' type='text/javascript'></script>
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/config.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/switch.css">
    <title>Inicio</title>





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
    // 
    estadoSwitch = "<?php echo $Switch["valor"] ?>";

    function OnOff() {

        if (estadoSwitch == "Apagada") {
            message = new Paho.Message("Encendida"); //PAYLOAD
            message.destinationName = 'Switch'; //TOPIC
            mqtt.send(message);
        } else if (estadoSwitch == "Encendida") {
            message = new Paho.Message("Apagada");
            message.destinationName = 'Switch';
            mqtt.send(message);
        }


    };

    function onMessageArrived(message) {

        var topic = message.destinationName;
        var payload = message.payloadString;

        $('#ws').prepend('<br>' + topic + ' = ' + payload + '');

        if (message.destinationName == 'Switch') { //acá coloco el topic
            document.getElementById("switch").textContent = message.payloadString;
            estadoSwitch = message.payloadString;

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
</script>

<body>
    <?php
    include("navegacion.php");
    ?>

    <div align="center">
        <a>Pieza </a><br>
        <label class="switch-button">

            <input type="checkbox" name="switch-button" id="switch-label" class="switch-button__checkbox" onclick='OnOff()' <?php if ($Switch["valor"] === "Encendida") { ?> checked <?php } ?>>
            <label for="switch-label" class="switch-button__label"></label>



        </label><br>
        <a id="switch"><?php echo $Switch["valor"] ?></a>

    </div>


</body>

</html>