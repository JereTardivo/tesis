var mqtt;
var reconnectTimeout = 2000;
var temperaturas = 0;
var humedad = 0;
var conteo = 0;
var conteoluz = 0;
var movimiento = 0;
var ultrasonico = 0;
var gas = 0;

var host = '192.168.100.16';	// hostname or IP address
var port = 9001;
var topic = '#';		// topic to subscribe to
var useTLS = false;
var username = null;
var password = null;
var cleansession = true;

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
    console.log("Host=" + host + ", port=" + port + ", path=" + path + " TLS = " + useTLS + " username=" + username + " password=" + password);
    mqtt.connect(options);
};

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
    if (message.destinationName == 'Gas') {
        gas = parseInt(message.payloadString);
        

    }

};

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

$(document).ready(function () {
    MQTTconnect();
});