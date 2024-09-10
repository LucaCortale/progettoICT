#include <DHT.h>
#include <WiFiS3.h>

#define DHTPIN 10
#define DHTTYPE DHT22
#define FAN_PIN 3
#define PUMP_PIN 11
#define FANPUMP_PIN 9

DHT dht(DHTPIN, DHTTYPE);

float hum;
float temp;

unsigned long t0, dt, timer = 0;
int statoPump = 0;
int statoFan = 0;
int statoFanPump = 0;

int comando = 0;
bool checkComando = false;


const char* ssid = "Wind3 HUB - B29FC4";
const char * pass = "44t3bc5ss36259hy";

WiFiClient client;
WiFiServer server(80);

const char* server1 = "192.168.1.23";
const int port = 80;

void setup() {
  Serial.begin(9600);
  dht.begin();

  WiFi.begin(ssid, pass);

  while (WiFi.status() != WL_CONNECTED){
    delay(1000);
    Serial.print("Connessione al WiFi...");
  }

  Serial.println("\nConnected to Wifi");
  
  
  pinMode(FAN_PIN, OUTPUT);
  pinMode(PUMP_PIN, OUTPUT);
  pinMode(FANPUMP_PIN, OUTPUT);

  server.begin();

}

void loop() {
  client = server.available();
  if (client) { 
    Serial.println("New Client connected");
    String request = client.readStringUntil('\r'); 
    Serial.println(request);
    client.flush();

    if (request.indexOf("/ventola?stato=on") != -1) {
      comando = 1;
      client.println("HTTP/1.1 200 OK");
      client.println("Content-Type: text/html");
      client.println("");
    } else if (request.indexOf("/ventola?stato=off") != -1) {
      comando = 2;
      client.println("HTTP/1.1 200 OK");
      client.println("Content-Type: text/html");
      client.println("");
    } else if (request.indexOf("/pompa?stato=on") != -1) {
      comando = 3;
      client.println("HTTP/1.1 200 OK");
      client.println("Content-Type: text/html");
      client.println("");
    } else if (request.indexOf("/pompa?stato=off") != -1) {
      comando = 4;
      client.println("HTTP/1.1 200 OK");
      client.println("Content-Type: text/html");
      client.println("");
    }

    delay(1);
    client.stop();
    Serial.println("Client disconnected");
  }

  // Serial.println(WiFi.localIP());

  dt = millis() - t0;

  if(comando == 1) {
    digitalWrite(FAN_PIN, HIGH);
    if (client.connect(server1, port)) {

      hum = dht.readHumidity();
      temp = dht.readTemperature();
      statoFan = digitalRead(FAN_PIN);
      if (digitalRead(PUMP_PIN) == HIGH){
        statoPump = digitalRead(PUMP_PIN);
      } else if (digitalRead(FANPUMP_PIN == HIGH)){
        statoPump = digitalRead(FANPUMP_PIN);
      } else {
        statoPump = digitalRead(PUMP_PIN);
      }

      String data = "umidita=" + String(hum) + "&temperatura=" + String(temp) + 
                    "&statofan=" + String(statoFan) + "&statopump=" + String(statoPump);

      client.println("POST /progettoIct/salvaDati.php HTTP/1.1");
      client.println("Host: " + String(server1));
      client.println("Content-Type: application/x-www-form-urlencoded");
      client.print("Content-Length: ");
      client.println(data.length());
      client.println("Connection: close");
      client.println();
      client.println(data);

      client.stop();
    } else {
      Serial.println("Connection to server failed");
    }

    if(!checkComando) {
      t0 = millis();
      checkComando = true;
    }

    if((millis() - t0) > 1,800,000){
      checkComando = false;
      comando = 0;
      t0 = millis();
    } 
  } else if (comando == 2) {
    digitalWrite(FAN_PIN, LOW);
    if (client.connect(server1, port)) {

      hum = dht.readHumidity();
      temp = dht.readTemperature();
      statoFan = digitalRead(FAN_PIN);
      if (digitalRead(PUMP_PIN) == HIGH){
        statoPump = digitalRead(PUMP_PIN);
      } else if (digitalRead(FANPUMP_PIN == HIGH)){
        statoPump = digitalRead(FANPUMP_PIN);
      } else {
        statoPump = digitalRead(PUMP_PIN);
      }

      String data = "umidita=" + String(hum) + "&temperatura=" + String(temp) + "&statofan=" + String(statoFan) + "&statopump=" + String(statoPump);

      client.println("POST /progettoIct/salvaDati.php HTTP/1.1");
      client.println("Host: " + String(server1));
      client.println("Content-Type: application/x-www-form-urlencoded");
      client.print("Content-Length: ");
      client.println(data.length());
      client.println("Connection: close");
      client.println();
      client.println(data);

      client.stop();
    } else {
      Serial.println("Connection to server failed");
    }
    if(!checkComando) {
      t0 = millis();
      checkComando = true;
    }

    if((millis() - t0) > 30000){
      checkComando = false;
      comando = 0;
      t0 = millis();
    }
  }else if (comando == 3) {
    digitalWrite(PUMP_PIN, HIGH);
    if (digitalRead(PUMP_PIN) == HIGH) {
      if (dt >= 3000){
        digitalWrite(PUMP_PIN, LOW);
        digitalWrite(FANPUMP_PIN, HIGH);
      }
    } else if(digitalRead(FANPUMP_PIN) == HIGH) {
      if(dt >= 9000){
        digitalWrite(FANPUMP_PIN, LOW);
      }
    }
    if (client.connect(server1, port)) {

      hum = dht.readHumidity();
      temp = dht.readTemperature();
      statoFan = digitalRead(FAN_PIN);
      if (digitalRead(PUMP_PIN) == HIGH){
        statoPump = digitalRead(PUMP_PIN);
      } else if (digitalRead(FANPUMP_PIN == HIGH)){
        statoPump = digitalRead(FANPUMP_PIN);
      } else {
        statoPump = digitalRead(PUMP_PIN);
      }

      String data = "umidita=" + String(hum) + "&temperatura=" + String(temp) + "&statofan=" + String(statoFan) + "&statopump=" + String(statoPump);

      client.println("POST /progettoIct/salvaDati.php HTTP/1.1");
      client.println("Host: " + String(server1));
      client.println("Content-Type: application/x-www-form-urlencoded");
      client.print("Content-Length: ");
      client.println(data.length());
      client.println("Connection: close");
      client.println();
      client.println(data);

      client.stop();
    } else {
      Serial.println("Connection to server failed");
    }
    if(!checkComando) {
      t0 = millis();
      checkComando = true;
    }

    if((millis() - t0) > 30000){
      checkComando = false;
      comando = 0;
      t0 = millis();
    }
  }else if (comando == 4) {
    digitalWrite(PUMP_PIN, LOW);
    digitalWrite(FANPUMP_PIN, LOW);
    if (client.connect(server1, port)) {

      hum = dht.readHumidity();
      temp = dht.readTemperature();
      statoFan = digitalRead(FAN_PIN);
      if (digitalRead(PUMP_PIN) == HIGH){
        statoPump = digitalRead(PUMP_PIN);
      } else if (digitalRead(FANPUMP_PIN == HIGH)){
        statoPump = digitalRead(FANPUMP_PIN);
      } else {
        statoPump = digitalRead(PUMP_PIN);
      }

      String data = "umidita=" + String(hum) + "&temperatura=" + String(temp) + "&statofan=" + String(statoFan) + "&statopump=" + String(statoPump);

      client.println("POST /progettoIct/salvaDati.php HTTP/1.1");
      client.println("Host: " + String(server1));
      client.println("Content-Type: application/x-www-form-urlencoded");
      client.print("Content-Length: ");
      client.println(data.length());
      client.println("Connection: close");
      client.println();
      client.println(data);

      client.stop();
    } else {
      Serial.println("Connection to server failed");
    }
    if(!checkComando) {
      t0 = millis();
      checkComando = true;
    }

    if((millis() - t0) > 30000){
      checkComando = false;
      comando = 0;
      t0 = millis();
    }
  }else{
    if (dt >= 300000){
      hum = dht.readHumidity();
      temp = dht.readTemperature();
      t0 = millis();

      if (isnan(hum) || isnan(temp)) {
        Serial.println("Errore nella lettura dei dati dal sensore DHT22!");
        return;
      }

      if ((temp > 24.0) || (temp > 18.0 && hum > 75.00)){
        digitalWrite(FAN_PIN, HIGH);
        digitalWrite(PUMP_PIN, HIGH);
      }else if (temp > 20.0){
        digitalWrite(FAN_PIN, HIGH);
        digitalWrite(PUMP_PIN, LOW);
      }else {
        digitalWrite(FAN_PIN, LOW);
        digitalWrite(PUMP_PIN, LOW);
      }

      statoFan = digitalRead(FAN_PIN);
      if (digitalRead(PUMP_PIN) == HIGH){
        statoPump = digitalRead(PUMP_PIN);
      } else if (digitalRead(FANPUMP_PIN == HIGH)){
        statoPump = digitalRead(FANPUMP_PIN);
      } else {
        statoPump = digitalRead(PUMP_PIN);
      }

      if (client.connect(server1, port)) {
      String data = "umidita=" + String(hum) + "&temperatura=" + String(temp) + "&statofan=" + String(statoFan) + "&statopump=" + String(statoPump);

      client.println("POST /progettoIct/salvaDati.php HTTP/1.1");
      client.println("Host: " + String(server1));
      client.println("Content-Type: application/x-www-form-urlencoded");
      client.print("Content-Length: ");
      client.println(data.length());
      client.println("Connection: close");
      client.println();
      client.println(data);

      client.stop();
      } else {
        Serial.println("Connection to server failed");
      }
      
      Serial.print("Umidità: ");
      Serial.print(hum);
      Serial.print(" %, Temp: ");
      Serial.print(temp);
      Serial.println(" Celsius");
      Serial.print("Fan State: ");
      Serial.println(statoFan == HIGH ? "On" : "Off");
      Serial.print("Pump State: ");
      Serial.println(statoPump == HIGH ? "On" : "Off");

    } else if (digitalRead(PUMP_PIN) == HIGH) {
      if (dt >= 30000){
        digitalWrite(PUMP_PIN, LOW);
        digitalWrite(FANPUMP_PIN, HIGH);
      }
    } else if(digitalRead(FANPUMP_PIN) == HIGH) {
      if(dt >= 240000){
        digitalWrite(FANPUMP_PIN, LOW);
      }
    }
  }

}
