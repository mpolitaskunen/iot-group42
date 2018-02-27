# iot-group42

Code implementation of Project Pink

Licensing under GPLv2, only for the codes inside the project. 
External libraries follow their licensing.

Frontend uses Morris.JS (http://morrisjs.github.io/morris.js/), specifically, version 0.5.0

Tested on GNU/Linux:
- CentOS 6.9
- Apache 2.2.15
- PHP 7.0.27
- MariaDB 10.1.31

Group 42:
- Seppo Taskunen
- Timo Ukonmaanaho

Includes the Backend (MariaDB table design), Frontend (Code to generate the chart) and the collector, not forgetting the INO file for the Arduino itself.

Device configuration:
- iDuino Mega (compatible with Arduino Mega 2560)
- Arduino Ethernet Shield V2
- DHT21 sensor connected to +3.3V, GND and D2 pin on the Ethernet Shield.

