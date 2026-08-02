# Prosjektstatus for bodomfk.no

Dette dokumentet er den korte, varige overleveringen til nye bidragsytere og
Codex-chatter. Historiske detaljer ligger i `CHANGELOG.md`. Gjeldende kode og
konfigurasjonsmaler i repositoryet er alltid fasit dersom dette dokumentet blir
utdatert.

## Formål og arkitektur

- Repository: `5olvik/bodomfk-wordpress`.
- Produksjon: [bodomfk.no](https://bodomfk.no/).
- Aktivt tema: `themes/bodomfk-modern-theme/`.
- Temaet er selvstendig og bruker ikke GeneratePress, GP Premium, SiteOrigin,
  Ultimate Member eller en sidebygger.
- WordPress-kjerne, database, brukere, opplastinger og webhotellfiler er ikke en
  del av Git-repositoryet.
- Temaet bruker vanlig PHP, CSS og JavaScript uten lokal byggeprosess.

## Visuell retning

- Klubbens hovedfarge er marineblå `#04152F`, med blå og oransje aksenter.
- Det store BMFK-banneret og etablert kortdesign skal bevares med mindre en
  konkret redesign er bestilt.
- WP Dark Mode gir besøksstyrt Light/Dark. Temaet har egne kontrastsikre farger
  for kort og knapper.
- Light/Dark-bryteren ligger nederst til venstre på PC og mobil og skjules mens
  mobilmenyen er åpen.
- «Finn riktig Facebook-kanal» er en prioritert seksjon høyt på forsiden.
- Forsiden skal fungere responsivt uten horisontal rulling eller overlappende
  flytende kontroller.

## Viktige adresser og kontaktpunkter

- Medlemsgruppe: `https://www.facebook.com/groups/bodomfk`.
- Offentlig kjøp/salg- og hobbygruppe:
  `https://www.facebook.com/groups/bodomfksalg`.
- Innmelding: `https://blimedlem.bodomfk.no/` som standard.
- Webkameraseksjon: `https://bodomfk.no/#webkamera`.
- Kart: `https://maps.app.goo.gl/mJBsZmK8oP1wWTuy7`.
- Grasrotandelen bruker organisasjonsnummer `993 764 299`.
- Kontakt: `post@bodomfk.no`; faktura: `faktura@bodomfk.no`. Adressene skal
  fortsatt beskyttes av temaet og Email Address Encoder.

Flere verdier kan endres under **Utseende → Tilpass → Klubbinformasjon**. Ikke
hardkod en ny verdi et annet sted uten å kontrollere tilhørende plassholder.

## Git-versjonert innhold

Disse sidene henter hovedinnholdet fra Markdown i `content/pages/`:

- Nytt medlem
- Medlemsfordeler
- Klubbhytta
- Kontakt oss
- Flyplassregler
- Personvernerklæring
- Bruk BMFK som app

WordPress-innhold er reserve dersom en fil mangler. Endring i WordPress-
redigeringen overstyrer ikke en eksisterende Git-fil. Forsiden ligger i temaet,
mens vanlige innlegg, brukere og øvrig WordPress-innhold ligger i databasen.

Velkomstguiden og PWA-veiledningen vedlikeholdes som nettsider, ikke som separate
PDF-kopier. Se `docs/INNHOLD-I-GITHUB.md` for strukturmarkører og plassholdere.

## Flyplassregler og dokumenttilgang

- Flyplassreglene skiller mellom organisert flyging under BMFK/NLFs
  sikkerhetssystem og flyging etter Luftfartstilsynets regler i åpen kategori.
- Bestemorenga beskrives som rett utenfor femkilometersonen rundt Bodø lufthavn;
  aktivitet vest for banen kan berøre sonen.
- Lokale operative regler skal samsvare mellom Flyplassregler og kortversjonen
  på Nytt medlem.
- Avinor-/tårnavtalen og det historiske dokumentet fra 2018 bruker samme delte
  passord, satt under **Utseende → Dokumenttilgang**.
- Passordpanelet er en praktisk sperre, ikke full dokumentbeskyttelse. PDF-ene er
  offentlige temafiler og finnes i Git-historikken.
- Passord, medlemslister og andre private data skal aldri inn i Git.

## Webkamera og kameraovervåking

- Forsiden viser klubbens personvernbehandlede stillbilde gjennom WordPress-
  endepunktet `?bmfk_webcam=1`; JavaScript viser bildet som en `blob:`-adresse.
- Direkte HTTP-tilgang til `/webcam/webcam.jpg` skal være sperret av
  `/webcam/.htaccess`.
- Aktiv `webcam.php`, `.htaccess`, NVR-opplasting og cron ligger på webhotellet,
  utenfor temaet. Temaet inneholder bare dokumenterte maler i `assets/config/`.
- Behandlingsscriptet venter på ferdig NVR-opplasting, kontrollerer JPEG, bruker
  prosesslås, skalerer og personvernbehandler bildet og erstatter `webcam.jpg`
  atomisk. Dette hindrer halvferdige eller grå bilder ved cron hvert minutt.
- NVR-opptak er en separat, lokal sikkerhetsløsning. Oppsettet er dokumentert på
  personvernsiden som uten lyd og appbasert fjerntilgang, med automatisk
  overskriving etter inntil sju dager og tilgang bare for særskilt autoriserte.
- Styrets nødvendighets- og interesseavveining, skilting, tilgangsliste og
  videre bruk av døgnopptak er organisatoriske oppgaver utenfor Git.

## Værstasjon

Gjeldende tema bruker WindNerd-widgeten `bhpgk` ved webkameraet, med vind i m/s,
marineblå topp, lys tekst og hvit bakgrunn med 36 prosent opasitet. Holfuy
Keiservarden og Vindnå/Bestemorenga er undersøkt som mulige alternativer, men er
ikke implementert. En eventuell erstatning må testes visuelt og vurderes for
stabilitet, personvern og tredjepartsavhengighet før WindNerd fjernes.

## PWA

- SuperPWA leverer manifest og service worker.
- Startadressen er `/?bmfk_pwa=webkamera`; både `webkamera` og `webkamera/`
  godtas. Temaet ruller til `/#webkamera` etter oppstart.
- `?bmfk_webcam=1` holdes utenfor service-worker-cache.
- Appikoner ligger i `assets/images/` og bruker bakgrunnsfargen `#04152F`.
- Offentlig installasjonsveiledning ligger på `/bruk-som-app/`.

## Aktivt utvidelsesoppsett

Det avtalte oppsettet bruker:

- WP Dark Mode
- Email Address Encoder
- SuperPWA
- Complianz GDPR/CCPA Cookie Consent
- Really Simple Security

Duplicator er bare valgfri for manuell sikkerhetskopi og trenger ikke være aktiv
mellom sikkerhetskopier. Se `docs/UTVIDELSESPLAN.md` før en utvidelse fjernes
eller en ny installeres.

## Release og levering

- `Version` i `style.css` og `BMFK_THEME_VERSION` i `functions.php` skal alltid
  være identiske.
- Hver Git-leveranse får et nytt patchnummer; gamle versjoner gjenbrukes ikke.
- GitHub Actions kontrollerer PHP, JavaScript, innhold, dokumenttilgang og PWA og
  lager en release med ferdig tema-ZIP.
- Git-oppdaterings-ZIP til GitHub Desktop har repositoryinnholdet direkte i
  roten, uten en ekstra omsluttende mappe.
- Tema-ZIP til WordPress har én toppmappe: `bodomfk-modern-theme/`.
- Produksjon oppdateres manuelt ved å installere tema-ZIP-en i WordPress og
  godta erstatning av gjeldende tema.

## Sikkerhetsgrenser

Repositoryet skal ikke inneholde `wp-config.php`, `.env`, autentiseringstoken,
FTP-opplysninger, passord, SQL/XML-eksporter, Duplicator-arkiver,
`installer.php`, medlemslister, WordPress-brukere eller private opptak. Behandle
bilder, dokumenter og andre opplastinger som offentlige dersom de legges i Git.

## Første oppgave i en ny Codex-chat

Bruk denne meldingen:

> Les AGENTS.md, README.md, CHANGELOG.md og docs/PROSJEKTSTATUS.md. Kjør git
> status, hent siste main og kontroller gjeldende versjon. Oppsummer status og
> eventuelle lokale endringer før du endrer eller pusher noe.
