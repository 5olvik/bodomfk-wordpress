# Arbeidsregler for BMFK-nettsiden

Disse reglene gjelder for hele repositoryet. Les også `README.md`,
`CHANGELOG.md` og `docs/PROSJEKTSTATUS.md` før en endring planlegges.

## Før arbeidet starter

1. Kjør `git status` og kontroller at eksisterende endringer ikke tilhører en annen.
2. Hent siste `main` og alle tagger før gjeldende versjon bestemmes.
3. Les `Version` i `themes/bodomfk-modern-theme/style.css` og
   `BMFK_THEME_VERSION` i `functions.php`. De skal være identiske.
4. Arbeid aldri videre fra en eldre lokal ZIP, patch eller temakopi når GitHub har
   en nyere versjon.
5. Oppsummer planlagt omfang før større design-, sikkerhets- eller innholdsendringer.

## Versjonering

- Hver ny leveranse til GitHub skal få et nytt patchnummer. En eksisterende
  versjon skal aldri bygges eller leveres på nytt med annet innhold.
- Oppdater minst `style.css`, `BMFK_THEME_VERSION`, nyeste filnavn i `README.md`
  og `docs/INSTALLASJON.md`, samt en ny post øverst i `CHANGELOG.md`.
- Historiske migrerings- og innholdsversjoner i funksjonsnavn eller WordPress-
  alternativer skal ikke endres mekanisk ved en vanlig versjonsøkning.
- Versjonen i bunnteksten hentes fra `BMFK_THEME_VERSION` og skal samsvare med
  GitHub-taggen og tema-ZIP-en.

## Endringsomfang og design

- Bevar den etablerte visuelle utformingen. Ikke gjør en bred redesign eller
  endre farger, kort, bilder, plasseringer eller tekst som ikke inngår i oppgaven.
- Kontroller berørte områder i både Light og Dark, på PC og mobil.
- Light/Dark-bryteren skal være synlig nederst til venstre når mobilmenyen er
  lukket. Den skal ikke flyttes opp for å rydde plass til andre kontroller.
- Facebook-valget skal fortsatt ligge høyt på forsiden.
- Mobilmeny, webkamera, PWA-start og kontaktlenker er regresjonsutsatte områder.
- Bruk temaets eksisterende komponenter og CSS-variabler før nye mønstre lages.

## Kilder og innhold

- De sju Git-versjonerte informasjonssidene ligger i
  `themes/bodomfk-modern-theme/content/pages/`. Se `docs/INNHOLD-I-GITHUB.md`.
- Behold strukturmarkører, plassholdere og dokumentmarkører i Markdown-filene.
- Endringer i operative flyplassregler krever kontroll av styret eller klubbens
  sikkerhetsansvarlige. Oppdater kortversjonen på «Nytt medlem» samtidig.
- Juridiske, personvernmessige, NLF- og Luftfartstilsyn-relaterte påstander skal
  verifiseres mot oppdaterte primærkilder før de endres.
- Ikke legg passord, medlemsdata, WordPress-brukere, nøkler, konfigurasjonsfiler,
  databaser, XML-eksporter, Duplicator-pakker eller `installer.php` i Git.

## Webkamera og eksterne tjenester

- Temaet leverer webkamerabildet gjennom WordPress. Den direkte JPG-adressen
  skal ikke eksponeres eller gjøres offentlig tilgjengelig igjen.
- Filene under `assets/config/` er ikke-kjørbare distribusjonsmaler. Aktiv
  `webcam.php`, `.htaccess`, NVR-oppsett og cron ligger på webhotellet og blir
  ikke automatisk oppdatert av en temaoppdatering.
- Bevar filalderkontroll, JPEG-kontroll, prosesslås og atomisk erstatning i
  webkamerabehandlingen.
- SuperPWA-starten `/?bmfk_pwa=webkamera` og cacheunntaket for
  `?bmfk_webcam=1` skal bevares.
- Eksterne widgeter og personvernrelevante tjenester skal vurderes før nye
  tredjepartsscript legges inn.

## Kontroller før levering

Kjør så langt miljøet tillater:

```text
find themes/bodomfk-modern-theme -name "*.php" -print0 | xargs -0 -n1 php -l
php -l themes/bodomfk-modern-theme/assets/config/webcam-processor.php.txt
node --check themes/bodomfk-modern-theme/assets/js/site.js
php tests/test-content-pages.php
php tests/test-document-access.php
php tests/test-pwa-start.php
node tests/test-pwa-start.js
git diff --check
```

Hvis PHP ikke finnes lokalt, skal dette opplyses. GitHub Actions skal fortsatt
kjøre PHP-kontrollene før utgivelsen blir regnet som ferdig.

## Pakking og GitHub

- Git-oppdaterings-ZIP: repositoryfilene skal ligge direkte i ZIP-roten. Ingen
  mappe som `build-*`, `work`, `repo-main-*` eller tilsvarende skal omslutte dem.
- Tema-ZIP: skal ha nøyaktig én toppmappe, `bodomfk-modern-theme/`, slik
  WordPress krever.
- Ingen ZIP skal inneholde `.git/`, `dist/`, operativ webhotellkonfigurasjon,
  sikkerhetskopier eller hemmeligheter.
- Test begge arkivene med `unzip -t` og kontroller versjonen inne i arkivet.
- Ikke commit, push, opprett tag eller publiser en GitHub-utgivelse uten at
  brukeren uttrykkelig har bedt om det.

## Ferdig betyr

- Endringen er avgrenset til avtalt omfang.
- Versjon og dokumentasjon samsvarer.
- Relevante tester er kjørt eller eventuelle begrensninger er oppgitt.
- Git-diff og ZIP-struktur er kontrollert.
- Leveransen beskriver kort hva som ble endret og hva brukeren skal gjøre videre.
