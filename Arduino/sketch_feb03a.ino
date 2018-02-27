#include <Adafruit_Sensor.h>
#include <Ethernet2.h>
#include <SPI.h>
#include <DHT.h>
#include <DHT_u.h>

byte mac[] = {
  0x90, 0xA2, 0xDA, 0x11, 0x05, 0xCD
}; // MAC Address for the network adapter

EthernetClient client; // Let's define 'client' as an ethernet client

#define DHTPIN 2 // Sensor PIN
#define DHTTYPE DHT21 // Sensor Type

DHT dht(DHTPIN, DHTTYPE); // Initialize sensor

long previousMillis = 0; // Big variable for milliseconds
unsigned long currentMillis = 0; // Big variable for milliseconds
long interval = 250000; // READING Interval

int t = 0; // Temperature variable, integer-type
int h = 0; // Humidity variable, integer-type

String data; // Let's define variable data as a string

void setup() {
  // put your setup code here, to run once:
  Serial.begin(115200); // Let's add serial output capabilities

  if (Ethernet.begin(mac) == 0) { 
     Serial.println("Failed to configure Ethernet using DHCP"); // Ethernet setup
  }

  dht.begin(); // Start the DHT sensor
  delay(10000); // Wait for the initialization

  h = (int) dht.readHumidity(); // Read Humidity into an integer variable h
  t = (int) dht.readTemperature(); // Read temperature into an integer variable t

  data = ""; // Let's nullify data variable
}

void loop() {
  // put your main code here, to run repeatedly:
  currentMillis = millis();
  if(currentMillis - previousMillis > interval) { // Read only once per interval
    previousMillis = currentMillis; // Move current milliseconds into previous milliseconds
    h = (int) dht.readHumidity(); // Read humidity again
    t = (int) dht.readTemperature(); // Read temperature again
  }

  data = String("temp1=")+t+"&hum1="+h; // Let's create the data variable for output (Useless actually)

  if (client.connect("172.31.0.47",80)) { // Server address, continue only if you can connect
    client.print("GET /add.php?"); // Let's make a POST request!
    Serial.print("GET /add.php?"); // Replicate the post request to serial output
    client.print("temp1="); // Add temp variable text into the GET message
    Serial.print("temp1="); // Replicate previous text into Serial output
    client.print(t); // Add temperature into the URL
    Serial.print(t); // Replicate temperature into serial output
    client.print("&hum1="); // Add humidity variable text into the get message
    Serial.print("&hum1="); // Replicate
    client.println(h); // Let's print the humidity data and add <cr><lf>
    Serial.println(h); // Replicate
  }

  if (client.connected()) {
    client.stop(); // Let's disconnect!
  }

  delay(15000); // Loop delay of 15 seconds

}
