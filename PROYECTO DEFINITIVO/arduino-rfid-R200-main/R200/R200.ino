#include <WiFi.h>
#include <HTTPClient.h>
#include "R200.h"

const char* ssid = "MONTE FRIO";
const char* password = "eltinto12188";

const char* serverName = "http://192.168.80.16/rfid/guardar.php";

R200 rfid;

unsigned long lastReadTime = 0;
const unsigned long readInterval = 3000;
uint8_t lastUID[12] = {0};

void setup() {

  Serial.begin(115200);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.println("Conectando WiFi...");
  }

  Serial.println("WiFi conectado");

  rfid.begin(&Serial2, 115200, 16, 17);
  rfid.setMultiplePollingMode(true);
}

void loop() {

  rfid.loop();

  if(memcmp(rfid.uid, rfid.blankUid, sizeof(rfid.uid)) != 0){

    if(memcmp(rfid.uid, lastUID, sizeof(rfid.uid)) != 0){

      if(millis() - lastReadTime > readInterval){

        memcpy(lastUID, rfid.uid, sizeof(rfid.uid));
        lastReadTime = millis();

        String codigo = "";
        for(int i=0;i<12;i++){
          if(rfid.uid[i] < 0x10) codigo += "0";
          codigo += String(rfid.uid[i], HEX);
        }

        enviarCodigo(codigo);
      }
    }
  }
}

void enviarCodigo(String codigo){

  if(WiFi.status()== WL_CONNECTED){

    HTTPClient http;

    http.begin(serverName);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    String httpRequestData = "codigo=" + codigo;

    int httpResponseCode = http.POST(httpRequestData);

    Serial.print("Enviado: ");
    Serial.println(codigo);

    http.end();
  }
}