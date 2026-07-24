# Delt passord til beskyttede dokumenter

Avinor-avtalen og de historiske flyplassreglene fra 2018 vises på Flyplassregler-siden bak det samme delte passordet. Avinor-avtalen er et medlemsdokument, mens 2018-dokumentet er merket som historisk styredokument.

## Sett passordet

1. Logg inn i WordPress som administrator.
2. Gå til **Utseende → Dokumenttilgang**.
3. Skriv et passord på minst seks tegn i begge feltene.
4. Trykk **Lagre passord**.
5. Del passordet bare med dem som skal ha dokumenttilgang, uten å legge det på nettsiden eller i GitHub.

Passordet kan ikke hentes frem senere. WordPress lagrer bare en enveis hash. Hvis passordet glemmes, setter du et nytt på samme side.

## Bytt eller fjern passord

Et nytt passord lagres på samme side. Når passordet endres, blir alle tidligere godkjente nettlesere automatisk ugyldige.

Knappen **Fjern passordtilgang** deaktiverer opplåsingen. Ingen av dokumentene kan da åpnes fra passordpanelene før et nytt passord er satt.

## Slik fungerer tilgangen

- Ingen av PDF-lenkene ligger i Flyplassregler-sidens opprinnelige HTML.
- Etter riktig passord vises en knapp som åpner det aktuelle dokumentet i en ny fane.
- Begge panelene bruker samme passord. Låser du opp ett dokument, låses det andre opp automatisk på samme side.
- Den godkjente nettleseren huskes i 30 dager med en signert, HttpOnly-informasjonskapsel.
- Administratorer får tilgang uten medlemspassord når et passord er konfigurert.
- Passordkontrollen og PDF-lenken holdes utenfor vanlig side- og PWA-cache.

## Test etter en temaoppdatering

1. Åpne `/flyplassregler/#avinor-avtale` i et privat nettleservindu.
2. Kontroller at PDF-knappen ikke vises før innlogging.
3. Skriv et feil passord og kontroller at det avvises.
4. Skriv riktig passord og kontroller at Avinor-knappen vises og åpner riktig dokument.
5. Bla til `#historiske-regler-2018` og kontroller at også 2018-dokumentet er låst opp og åpner riktig PDF.
6. Last siden på nytt og kontroller at nettleseren fortsatt er godkjent for begge dokumentene.

## Begrensning

Dette er en praktisk sperre for å signalisere hvem dokumentene er beregnet for. PDF-ene er fortsatt offentlige temafiler og finnes også i Git-historikken. Løsningen hindrer derfor ikke en person som allerede kjenner den direkte filadressen. Full dokumentbeskyttelse krever at PDF-ene flyttes ut av offentlig webområde og leveres gjennom en tilgangskontrollert nedlasting.
