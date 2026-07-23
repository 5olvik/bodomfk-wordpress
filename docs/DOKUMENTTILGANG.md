# Medlemspassord til Avinor-avtalen

Fra tema 1.6.6 vises Avinor-avtalen på Flyplassregler-siden bak et enkelt, delt medlemspassord.

## Sett passordet

1. Logg inn i WordPress som administrator.
2. Gå til **Utseende → Dokumenttilgang**.
3. Skriv et passord på minst seks tegn i begge feltene.
4. Trykk **Lagre passord**.
5. Del passordet med klubbens medlemmer uten å legge det på nettsiden eller i GitHub.

Passordet kan ikke hentes frem senere. WordPress lagrer bare en enveis hash. Hvis passordet glemmes, setter du et nytt på samme side.

## Bytt eller fjern passord

Et nytt passord lagres på samme side. Når passordet endres, blir alle tidligere godkjente nettlesere automatisk ugyldige.

Knappen **Fjern passordtilgang** deaktiverer opplåsingen. Avtalen kan da ikke åpnes fra passordpanelet før et nytt passord er satt.

## Slik fungerer tilgangen

- Avinor-lenken ligger ikke i Flyplassregler-sidens opprinnelige HTML.
- Etter riktig passord vises en knapp som åpner PDF-en i en ny fane.
- Den godkjente nettleseren huskes i 30 dager med en signert, HttpOnly-informasjonskapsel.
- Administratorer får tilgang uten medlemspassord når et passord er konfigurert.
- Passordkontrollen og PDF-lenken holdes utenfor vanlig side- og PWA-cache.

## Test etter en temaoppdatering

1. Åpne `/flyplassregler/#avinor-avtale` i et privat nettleservindu.
2. Kontroller at PDF-knappen ikke vises før innlogging.
3. Skriv et feil passord og kontroller at det avvises.
4. Skriv riktig passord og kontroller at PDF-knappen vises og åpner riktig dokument.
5. Last siden på nytt og kontroller at nettleseren fortsatt er godkjent.

## Begrensning

Dette er en praktisk sperre for å signalisere at avtalen er et medlemsdokument. PDF-en er fortsatt en offentlig temafil og finnes også i Git-historikken. Løsningen hindrer derfor ikke en person som allerede kjenner den direkte filadressen. Full dokumentbeskyttelse krever at PDF-en flyttes ut av offentlig webområde og leveres gjennom en tilgangskontrollert nedlasting.
