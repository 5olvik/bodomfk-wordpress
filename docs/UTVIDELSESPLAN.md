# Anbefalt utvidelsesplan

Den opplastede sikkerhetskopien har 20 aktive utvidelser. Det nye temaet er laget for å kunne drive den offentlige klubbnettsiden med WordPress-kjernen og svært få eller ingen presentasjonsutvidelser.

## Deaktiver etter innholdsmigreringen

| Utvidelse | Hvorfor den kan bort |
| --- | --- |
| GP Premium | Nytt tema er selvstendig og bruker ikke GeneratePress. |
| SiteOrigin Page Builder | Forsiden ligger i temaet, og undersidene migreres til WordPress-blokker. |
| SiteOrigin Widgets Bundle | Bare støttepakke for gammel sidebygger. |
| Ultimate Member | Offentlig innlogging og skjermet medlemsinnhold er ikke lenger i bruk. |
| UM Online | Tillegg til Ultimate Member. |
| UM reCAPTCHA | Tillegg til Ultimate Member. |
| Classic Editor | Det nye innholdet bruker blokkredigering. |
| Disable Comments | Migreringen lukker kommentarer direkte i WordPress. |
| Photo Gallery | Nytt galleri er innebygd i temaet. |
| Easy Video Player | Ingen nåværende offentlige sider trenger denne. |
| WP Dark Mode | Nytt design har en helhetlig marineblå profil uten plugin. |
| Jetpack | Temaet bruker ikke Jetpack-presentasjon eller galleri. Kontroller først at klubben ikke bruker en betalt Jetpack-tjeneste. |
| Email Address Encoder | Temaet bruker WordPress-funksjonen `antispambot`. |
| Disable auto-update emails | Unødvendig liten hjelpeplugin. |
| Burst Statistics | Kan bort dersom klubben ikke trenger besøksstatistikk. Gir mindre personvernarbeid. |
| Ninja Forms | Nåværende kontaktside bruker e-post/Facebook, ikke skjema. Eksporter eventuelle gamle innsendinger før sletting. |
| WP Maintenance Mode | Kan bort etter at den nye siden er lansert. |

## Kontroller før deaktivering

| Utvidelse | Anbefaling |
| --- | --- |
| Duplicator | Behold gjennom lanseringen. Fjern først etter fersk backup av den nye siden. |
| Really Simple SSL | Behold til `https://bodomfk.no`, HTTP→HTTPS og ingen blandet innhold er verifisert uten plugin. Mange webhotell håndterer dette direkte. |
| Complianz GDPR | Behold under første test. Hvis Burst/Jetpack fjernes og siden ikke laster tredjepartsinnhold før klikk, gjennomfør ny cookie-skanning. Fjern bare hvis siden faktisk ikke setter samtykkekrevende cookies. |

## Fullstendig fjerning

Deaktiver først. Test siden i minst noen dager. Slett deretter utvidelsene fra **Utvidelser → Installerte utvidelser**. Sletting bør utføres i små grupper med en rask kontroll av siden mellom hver gruppe.

Ultimate Member kan ha etterlatt tabeller og metadata i databasen. Ikke bruk automatiske database-cleanere uten en ny backup. Den viktigste gevinsten kommer allerede av å deaktivere og fjerne pluginfilene samt rydde brukerkontoene manuelt.

