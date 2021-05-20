import paho.mqtt.client as mqtt
import time
import mysql.connector
from mysql.connector import errorcode


class SensorBase(object):

    def __init__(self, topico, valor):
        self.topico = topico
        self.valor = valor

    def mostrar(self):
        print(self.topico)
        print(self.valor)

    def guardar(self):

        config = {
            'user': 'admin',
            'password': '1234',
            'host': 'localhost',
            'database': 'tesis',
            'raise_on_warnings': True,
        }

        try:
            cnx = mysql.connector.connect(**config)
            cursor = cnx.cursor()
            add_registro = (
                "INSERT INTO `registros`(`nombre`, `valor`, `fecha`) VALUES (%s,%s,NOW())")
            data_registro = (self.topico, self.valor)
            cursor.execute(add_registro, data_registro)
            cnx.commit()
            cursor.close()
            cnx.close()
        except mysql.connector.Error as err:
            print(err)
        else:
            cnx.close()


def on_connect(client, userdata, flags, rc):
    client.subscribe("#")


def on_message(client, userdata, msg):
    # print(str(msg.payload))
    sensor = SensorBase(msg.topic, msg.payload)
    sensor.guardar()
    sensor.mostrar()


client = mqtt.Client()
client.on_connect = on_connect
client.on_message = on_message
print("Esperando...")
client.connect("192.168.100.16", 1883, 60)

client.loop_forever()
