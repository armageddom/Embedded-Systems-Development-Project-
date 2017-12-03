import os
import glob
import time
import string
import paho.mqtt.client as mqtt

os.system('modprobe w1-gpio')
os.system('modprobe w1-therm')

base_dir = '/sys/bus/w1/devices/'

device_folder = glob.glob(base_dir + '28*')[0]
device_file = device_folder + '/w1_slave'



server = "m14.cloudmqtt.com"
user = "ielzboam"
password = "OBOVMmpfc_yL"
Port = 19422
client_id = "pythonMQTT-publish"


client = mqtt.Client(client_id)

client.username_pw_set(user,password)

client.connect(server,Port,keepalive=60,bind_address="")
client.loop_start()


def read_temp_raw():
    f = open(device_file, 'r')
    lines = f.readlines()
    f.close()
    return lines

def read_temp():
    lines = read_temp_raw()
    while lines[0].strip()[-3:] != 'YES':
        time.sleep(0.2)
        lines = read_temp_raw()
    equals_pos = lines[1].find('t=')
    if equals_pos != -1:
        temp_string = lines[1][equals_pos+2]
        temp_c = float(temp_string)
        return temp_c

while True:
    print(read_temp())
    temp = read_temp()
    client.publish("Lampotila", temp)
    time.sleep(1)
