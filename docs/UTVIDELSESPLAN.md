# Anbefalt utvidelsesplan

BMFK-nettsiden er ferdig migrert. Temaet er selvstendig og trenger ikke GeneratePress, GP Premium, SiteOrigin, Ultimate Member eller den tidligere BMFK-migreringsutvidelsen.

## Behold aktive

| Utvidelse | Hvorfor |
| --- | --- |
| WP Dark Mode | Gir besøkende valget mellom lys og mørk visning. Temaet låser egne kort og knapper til kontrastsikre farger. |
| Email Address Encoder | Gir ekstra koding av `post@bodomfk.no` og `faktura@bodomfk.no`. Temaet bruker også WordPress-beskyttelse som reserve. |
| SuperPWA | Gjør nettstedet installerbart som app. Temaet inneholder ikoner og kompatibilitetsregler for manifest, service worker og webkamera. |
| Complianz GDPR | Håndterer cookie-skanning, samtykkebanner og erklæring om informasjonskapsler. Den separate personvernerklæringen ligger i temaet og velges som WordPress-personvernside. |
| Really Simple Security | Gir sikkerhetsherding, innloggingsbeskyttelse og tofaktor for administratorer. Gratisutgaven kan beholdes så lenge funksjonene brukes og sikkerhetsloggene har en fornuftig lagringstid. |

## Bare dersom det fortsatt er nødvendig

| Utvidelse | Vurdering |
| --- | --- |
| Duplicator | Kan brukes til manuelle sikkerhetskopier, men ferdige pakker og `installer.php` må aldri legges i GitHub eller være offentlig tilgjengelige. |

## Utfaset

**BMFK Modern – oppsett og opprydding** ble brukt til den opprinnelige innholdsmigreringen og er ikke lenger nødvendig. Fra tema 1.4.0 ligger eventuelle små, versjonerte vedlikeholdsjusteringer i temaet og kjører én gang.

Gamle sidebyggere, medlemsinnlogging, gallerier og presentasjonsutvidelser skal ikke installeres igjen med mindre en ny funksjon er besluttet og gjennomgått.

**Webcam Viewer free** er ikke nødvendig fra tema 1.5.4. Temaet viser og oppdaterer kamerabildet selv, uten Windy eller en egen kamerautvidelse.

Det delte passordet til Avinor-avtalen og de historiske reglene fra 2018 håndteres av temaet. Det skal ikke installeres en egen passord- eller medlemsutvidelse for denne funksjonen.

## Ved fremtidige utvidelser

Før en ny utvidelse installeres:

1. Avklar hvilket konkret behov den løser.
2. Kontroller at funksjonen ikke allerede finnes i WordPress eller temaet.
3. Vurder personvern, oppdateringshistorikk og påvirkning på ytelse.
4. Ta backup og test på staging dersom endringen er omfattende.
5. Dokumenter hvorfor utvidelsen skal beholdes.
