# Installere og oppdatere BMFK-temaet

Dette er rutinen for versjon 1.6.19 og nyere. Den tidligere migreringsutvidelsen er ferdig brukt og skal ikke installeres på nytt.

## Før oppdatering

1. Ta en fersk sikkerhetskopi av nettstedet og databasen.
2. Kontroller at **WP Dark Mode**, **Email Address Encoder**, **SuperPWA**, **Complianz** og **Really Simple Security** er aktive.
3. Last ned tema-ZIP-en fra nyeste utgivelse på [GitHub Releases](https://github.com/5olvik/bodomfk-wordpress/releases).

Filen skal hete omtrent `bodomfk-modern-theme-1.6.19.zip`. Ikke last opp «Source code (zip)»; den inneholder hele GitHub-prosjektet og kan ikke installeres direkte som tema.

## Oppdater i WordPress

1. Gå til **Utseende → Temaer → Legg til nytt tema → Last opp tema**.
2. Velg `bodomfk-modern-theme-1.6.19.zip`.
3. Trykk **Installer nå**.
4. Når WordPress finner den gamle versjonen, velg **Erstatt gjeldende med opplastet**.
5. Kontroller at **Bodø Modellflyklubb Modern 1.6.19** fortsatt er aktivt.

Temaet utfører nødvendige, små innholdsjusteringer automatisk første gang en administrator åpner kontrollpanelet. Dette oppdaterer utdaterte NLF-lenker og overskriftsnivåer, men kjører ikke den gamle innholdsmigreringen på nytt.

## Kontroller etter oppdatering

- Forsiden og banneret på PC og mobil.
- Mobilmenyen, tastaturfokus og Light/Dark-bryteren.
- At Facebook-valget ligger høyt på forsiden og åpner:
  - medlemsgruppen: `https://www.facebook.com/groups/bodomfk`
  - offentlig gruppe: `https://www.facebook.com/groups/bodomfksalg`
- At **Meld hendelse** åpner NLFs side for hendelsesrapportering.
- At klubbens eget webkamera og værstasjon vises riktig på forsiden.
- At Modellflyhåndboka åpnes via NLFs oppdaterte oversiktsside.
- At Flyplassregler tydelig skiller mellom flyging under NLFs sikkerhetssystem og flyging i åpen kategori.
- At Nytt medlem og Medlemsfordeler forklarer 16-årshovedregelen i åpen kategori uten å skjule unntakene, og at barn under 16 kan fly selvstendig i klubbregi etter bestått A-bevis.
- At Bestemorenga beskrives som rett utenfor femkilometersonen, og at flyging vest for rullebanen kan berøre sonen.
- At «Lokalt regelverk for Bestemorenga» viser regler om flysone, pilotområde, preflight, bemannet luftfart, FPV, åpningstider og beredskap.
- At kortversjonen av de lokale reglene vises på Nytt medlem-siden og i velkomstguiden.
- At FPV-lenkene åpner NLFs digitale sjekkliste og informasjon om teoriprøven.
- Gå til **Utseende → Dokumenttilgang**, sett det delte dokumentpassordet og noter det på et trygt sted.
- Åpne Flyplassregler i et privat nettleservindu og kontroller at feil passord avvises, mens riktig passord åpner både Avinor-avtalen og det historiske dokumentet.
- At den tidligere PDF-en med flyplass- og sikkerhetsregler er merket som historisk styredokument fra 2018 og ikke viser en direkte lenke før godkjenning.
- At `post@bodomfk.no` og `faktura@bodomfk.no` vises riktig på kontaktsiden og i bunnteksten.
- At Google Maps- og Grasrotandelen-lenkene nederst på siden åpner riktig klubbside.
- At `/personvern/` viser den Git-versjonerte personvernerklæringen, og at Personvern og Informasjonskapsler ligger i bunnteksten.
- Gå til **Innstillinger → Personvern** og kontroller at «Personvernerklæring» er valgt. Temaet velger siden automatisk dersom ingen annen personvernside allerede var valgt.
- Kjør Complianz-veiviseren og en ny cookie-skanning. For et norskspråklig klubbnettsted velges Norge/EØS og GDPR; flere språk eller regioner skal bare aktiveres dersom nettstedet faktisk retter seg mot dem.
- Kontroller at Complianz har publisert en erklæring om informasjonskapsler, og at lenken **Informasjonskapsler** i bunnteksten åpner denne erklæringen. Den skal ikke peke til forsiden eller Flyplassregler. Dette er en WordPress-/Complianz-innstilling og følger ikke automatisk med tema-ZIP-en.
- Kontroller at det offentlige webkamerabildets vinkel, avstand, oppløsning og personvernfilter gjør at enkeltpersoner ikke kan identifiseres. Dersom noen kan gjenkjennes, skal bildet ikke publiseres før løsningen er justert.
- Kontroller at kameraovervåkingen er tydelig skiltet før man går inn i området, med Bodø Modellflyklubb som behandlingsansvarlig, konkret formål og lenke eller QR-kode til `/personvern/`.
- Kontroller at Reolink NVR ikke tar opp lyd, at fjerntilgang er deaktivert, at bare et begrenset antall autoriserte personer har lokal tilgang, og at vanlige opptak overskrives automatisk etter inntil syv dager.
- Styret skal behandle og dokumentere nødvendighets- og interesseavveiningen for fortsatt 24/7-opptak, inkludert om tidsstyring, kameravinkel eller permanent maskering kan redusere personvernulempen.
- Hold `/webcam/` utenfor langsiktige sikkerhetskopier og bildearkiver, slik at midlertidige opplastinger eller tidligere stillbilder ikke får en utilsiktet lengre lagringstid.
- Tema-ZIP-en inneholder `assets/config/webcam-processor.php.txt` og `assets/config/webcam-protection.htaccess.txt` som dokumenterte maler. Følg `assets/config/README.txt` når de kopieres manuelt til `/webcam/`; en vanlig temaoppdatering overskriver ikke de aktive filene på webhotellet.
- At Nytt medlem, Medlemsfordeler, Klubbhytta, Kontakt oss, Flyplassregler og Personvernerklæring viser tekstene fra GitHub uten synlige strukturmarkører.
- At `/nytt-medlem/` er opprettet og inneholder hele den oppdaterte velkomstguiden. Guiden vedlikeholdes ikke som en separat PDF.
- At `superpwa-manifest.json` viser JSON og at `superpwa-sw.js` viser JavaScript uten en WordPress 404-side.
- At `start_url` i `superpwa-manifest.json` inneholder `?bmfk_pwa=webkamera`.
- Slett en tidligere installert BMFK-app fra hjemskjermen, åpne bodomfk.no i nettleseren og legg den til på nytt. Kontroller at appikonet åpner direkte ved `/#webkamera`.
- At webkamerabildet oppdateres i den installerte PWA-en og ikke hentes fra en gammel service-worker-cache.
- At `/bruk-som-app/` er opprettet og viser installasjonsveiledning for iPhone/iPad, Android og Chrome på datamaskin.
- At iPhone/iPad-veiledningen ber brukeren kontrollere `?bmfk_pwa=webkamera` i den grå adresselinjen før appen legges til.
- At den lille lenken under webkamera og vær åpner appveiledningen.
- At bunnteksten viser samme nettsideversjon som `Version` i temaets `style.css` og den aktuelle GitHub-utgivelsen.
- At kortene har god kontrast i både lys og mørk visning.

Tøm eventuell cache på webhotellet eller i WordPress hvis gamle farger eller filer fortsatt vises.

## Git-versjonerte sidetekster

Nytt medlem, Medlemsfordeler, Klubbhytta, Kontakt oss, Flyplassregler, Personvernerklæring og Bruk BMFK som app henter hovedinnholdet fra Markdown-filene i temaets `content/pages`-mappe. WordPress-innholdet brukes automatisk som reserve hvis en fil mangler. Endringer i WordPress-redigeringen overstyrer derfor ikke GitHub-teksten så lenge den tilhørende filen finnes. Se [INNHOLD-I-GITHUB.md](INNHOLD-I-GITHUB.md) for bidragsrutinen.

## Redigere klubbinformasjon

Gå til **Utseende → Tilpass → Klubbinformasjon** for å endre:

- innmeldingslenke;
- lokale regler;
- Facebook-grupper;
- åpningstider;
- kontakt- og fakturaadresse.

Det delte passordet til Avinor-avtalen og 2018-dokumentet styres separat under **Utseende → Dokumenttilgang**. Se [DOKUMENTTILGANG.md](DOKUMENTTILGANG.md).

## Utvidelser

Behold **WP Dark Mode**, **Email Address Encoder**, **SuperPWA**, **Complianz** og **Really Simple Security** aktive for hele oppsettet som brukes på bodomfk.no. Se [UTVIDELSESPLAN.md](UTVIDELSESPLAN.md) for roller, valgfrie hjelpeutvidelser og hva som kan fjernes.

Utvidelsen **BMFK Modern – oppsett og opprydding** er utfaset. Dersom den fremdeles finnes under **Utvidelser**, kan den deaktiveres og slettes etter at 1.4.0 er installert.

## Tilbakerulling

Hvis en oppdatering gir en alvorlig feil, aktiver et standardtema midlertidig eller gjenopprett siste sikkerhetskopi. Tidligere tema-ZIP-er ligger under [GitHub Releases](https://github.com/5olvik/bodomfk-wordpress/releases).
