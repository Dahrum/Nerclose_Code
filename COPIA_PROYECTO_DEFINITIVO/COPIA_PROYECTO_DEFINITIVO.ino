#include "R200.h"

R200 rfid;
float curDelay = 0;
float start_time = 0;

void setup() {
  Serial.begin(115200);
  rfid.begin(&Serial2, 115200, 16, 17);

  // Activar modo lectura continua
  rfid.setMultiplePollingMode(true);
  Serial.println("Lector listo. Acerque una tarjeta...");
}

void loop() {
  curDelay = millis() - start_time;

  if (curDelay != millis() && curDelay > 600) //600 es tu tiempo de espera entre lectura
    start_time = 0;
    
  if (start_time == 0)
  {
    rfid.loop();

      if(memcmp(rfid.uid, rfid.blankUid, sizeof(rfid.uid)) != 0) {
      Serial.print("TAG detectado: ");
      rfid.dumpUIDToSerial();
      Serial.println();
      start_time = millis();
    }
  }
}