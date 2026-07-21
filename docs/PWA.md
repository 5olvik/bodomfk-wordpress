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

Temaet legger automatisk `/?bmfk_webcam=1` til listen over adresser som ikke skal hurtigbufres. Det fjerner også utilsiktede linjeskift fra SuperPWAs eget felt for cacheunntak, slik at service worker-filen forblir gyldig JavaScript. WordPress-innlogging og administrasjon holdes utenfor cachen av SuperPWA.

Versjon 1.6.3 legger inn korrekte WordPress-ruter for `superpwa-manifest.json` og `superpwa-sw.js`. Lenkereglene bygges automatisk én gang når en administrator åpner kontrollpanelet med SuperPWA aktivert.

## Kontroll etter oppdatering

- `https://bodomfk.no/superpwa-manifest.json` skal vise JSON.
- `https://bodomfk.no/superpwa-sw.js` skal vise JavaScript.
- Ingen av adressene skal åpne WordPress-siden «Fant ikke siden».
- Webkamerabildet skal oppdateres når PWA-en er på nett.

Hvis gamle svar fortsatt vises, tøm både Performance Cache og CDN Cache hos one.com. Installerte PWA-er kan trenge å lukkes helt og åpnes på nytt før en oppdatert service worker overtar.
