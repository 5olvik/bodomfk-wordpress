# PWA-oppsett

Nettsiden bruker SuperPWA til manifest, installasjon og service-worker-cache. Temaet leverer klubbikonene og et lite kompatibilitetslag for webhotellets WordPress-ruter. Temaet aktiverer ingen PWA dersom SuperPWA ikke er installert.

## Ikoner

- Vanlig appikon: `themes/bodomfk-modern-theme/assets/images/bmfk-pwa-icon-192.png`
- Stort app- og splashikon: `themes/bodomfk-modern-theme/assets/images/bmfk-pwa-icon-512.png`
- Maskable ikon: `themes/bodomfk-modern-theme/assets/images/bmfk-pwa-maskable-512.png`
- Apple Touch-ikon: `themes/bodomfk-modern-theme/assets/images/bmfk-apple-touch-icon-180.png`

Alle ikonene har bakgrunnsfargen `#04152F`. Det maskable ikonet har ekstra luft rundt klubbmerket slik at motivet ikke beskjæres av runde eller adaptive appikoner.

## SuperPWA-oppsett

- Programnavn: `Bodø Modellflyklubb`
- Kortnavn: `BMFK`
- Temafarge: `#04152F`
- Bakgrunnsfarge: `#04152F`
- Visning: `Standalone`
- Retning: `Any` eller `Portrait`

Temaet overstyrer SuperPWAs startside automatisk. Manifestet bruker den stabile adressen `/?bmfk_pwa=webkamera`, og temaets JavaScript ruller deretter direkte til webkameraseksjonen og rydder adressen til `/#webkamera`. SuperPWA kan normalisere manifestadressen til `/?bmfk_pwa=webkamera/`; temaet godtar begge variantene. Dette er mer pålitelig enn å lagre en fragmentadresse direkte som `start_url`, spesielt på iPhone og iPad. Det er derfor ikke nødvendig å velge en egen startside manuelt i SuperPWA.

Den offentlige installasjonsveiledningen ligger på `/bruk-som-app/`. Forsiden lenker dit med en liten tekstlenke under webkamera og vær, og bunnteksten har en fast snarvei. Veiledningen vedlikeholdes som Git-versjonert nettsideinnhold og skal ikke dupliseres som PDF.

På iPhone og iPad skal vinduet «Hjem-skjerm» vise `https://bodomfk.no/?bmfk_pwa=webkamera` i den grå adresselinjen før brukeren trykker «Legg til». En avsluttende skråstrek etter `webkamera` er også gyldig. Hvis bare `https://bodomfk.no/` vises, skal installasjonen avbrytes og forsøkes på nytt etter at siden er lastet på nytt.

Temaet legger automatisk `/?bmfk_webcam=1` til listen over adresser som ikke skal hurtigbufres. Det fjerner også utilsiktede linjeskift fra SuperPWAs eget felt for cacheunntak, slik at service worker-filen forblir gyldig JavaScript. WordPress-innlogging og administrasjon holdes utenfor cachen av SuperPWA.

Versjon 1.6.3 legger inn korrekte WordPress-ruter for `superpwa-manifest.json` og `superpwa-sw.js`. Lenkereglene bygges automatisk én gang når en administrator åpner kontrollpanelet med SuperPWA aktivert.

Versjon 1.6.13 bygger manifestet på nytt én gang når en administrator åpner kontrollpanelet. En app som allerede er installert på telefonen beholder vanligvis den gamle startadressen. Slett derfor BMFK-ikonet fra hjemskjermen og legg nettsiden til på nytt etter oppdateringen.

## Kontroll etter oppdatering

- `https://bodomfk.no/superpwa-manifest.json` skal vise JSON.
- `https://bodomfk.no/superpwa-sw.js` skal vise JavaScript.
- Ingen av adressene skal åpne WordPress-siden «Fant ikke siden».
- Manifestets `start_url` skal inneholde `?bmfk_pwa=webkamera`.
- En nyinstallert app skal åpne direkte ved `https://bodomfk.no/#webkamera`.
- Webkamerabildet skal oppdateres når PWA-en er på nett.

Hvis gamle svar fortsatt vises, tøm både Performance Cache og CDN Cache hos one.com. Installerte PWA-er kan trenge å lukkes helt og åpnes på nytt før en oppdatert service worker overtar.
