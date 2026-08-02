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

Duplicator trenger ikke stå aktiv mellom sikkerhetskopier. Oppdater utvidelsen før bruk, lag en kontrollert sikkerhetskopi og deaktiver den igjen dersom den ikke inngår i en fast backup-rutine.

## Kan deaktiveres og slettes

| Utvidelse | Hvorfor den ikke er nødvendig |
| --- | --- |
| Klassisk redigering | De Git-versjonerte informasjonssidene redigeres i Markdown på GitHub. WordPress' blokkredigering er tilstrekkelig for annet innhold. |
| LightStart / Maintenance Mode | Trengs bare når nettstedet bevisst skal settes i vedlikeholds- eller «kommer snart»-modus. |
| Disable auto-update Email Notifications | Endrer bare varsel-e-post og tilfører ingen funksjon nettstedet trenger. Behold heller normale oppdateringsvarsler. |

Deaktiver først og kontroller nettstedet før en utvidelse slettes. Ingen av utvidelsene i tabellen over brukes av BMFK-temaet.

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
