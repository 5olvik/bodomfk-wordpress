# Endringslogg

## 1.6.9 – 2026-07-24

- Legger de historiske flyplass- og sikkerhetsreglene fra 2018 bak samme delte passord som Avinor-avtalen.
- Fjerner den historiske PDF-lenken fra Flyplassregler-sidens opprinnelige HTML og henter den først etter godkjent passord.
- Låser automatisk opp begge dokumentpanelene når passordet godkjennes i ett av dem.
- Beholder eksisterende passord, hash, 30-dagers nettlesergodkjenning og administrasjon under **Utseende → Dokumenttilgang**.
- Merker 2018-dokumentet som historisk styredokument og oppdaterer testene og dokumentasjonen for begge dokumentportene.

## 1.6.8 – 2026-07-24

- Erstatter den korte, generelle omtalen med et komplett og tydelig merket lokalt regelverk for Bestemorenga.
- Samler regler om adgang og lokal orientering, flysone, forbudte områder, pilotområde, rullebane, trafikk og preflight-kontroll.
- Viderefører relevante lokale sikkerhetsrutiner fra 2018, blant annet felles pilotområde, tydelige rop, normalt maksimalt tre modeller i lufta og forbud mot overflyging av depot, hytte, parkering og publikum.
- Presiserer vikeplikten for bemannet luftfart, håndtering av instruks fra kontrolltårnet og krav ved flyging over 120 meter eller utenfor normal klubbaktivitet.
- Legger inn egne lokale regler for FPV, helikopter, multirotor, failsafe og automatiske funksjoner.
- Samkjører åpningstider, støyhensyn, bakke- og batterisikkerhet, beredskap, OBSREG og håndtering av regelbrudd.
- Legger en kortversjon av de lokale reglene på Nytt medlem-siden og i den nedlastbare velkomstguiden.
- Beholder 2018-dokumentet tydelig merket som historisk referanse.

## 1.6.7 – 2026-07-23

- Forklarer tydelig forskjellen mellom flyging under NLFs godkjente sikkerhetssystem og flyging i åpen kategori.
- Presiserer at A1/A3-kompetanse og operatørregistrering er to forskjellige krav.
- Opplyser at ikke-medlemmer ikke er omfattet av NLFs sikkerhetssystem eller klubbens avtale med kontrolltårnet.
- Retter plasseringen av Bestemorenga: selve modellflyplassen ligger rett utenfor femkilometersonen, mens flyging vest for rullebanen kan berøre sonen.
- Avgrenser tårnavtalen til flyging i regi av Bodø Modellflyklubb og under NLFs sikkerhetssystem.
- Legger inn NLFs digitale sjekkliste og informasjon om teoriprøven for FPV-flyging uten utkikksperson.
- Oppdaterer både Nytt medlem-siden og den nedlastbare velkomstguiden med samme forklaring.

## 1.6.6 – 2026-07-23

- Legger Avinor-avtalen bak et enkelt, delt medlemspassord på Flyplassregler-siden.
- Lagrer bare en enveis hash av passordet i WordPress; selve passordet legges aldri i temaet eller Git.
- Legger passordstyringen under **Utseende → Dokumenttilgang**, med støtte for å bytte eller fjerne passord.
- Husker godkjente nettlesere i 30 dager og gjør alle tidligere godkjenninger ugyldige når passordet endres.
- Henter PDF-lenken først etter godkjent passordkontroll, slik at den ikke finnes i sidens opprinnelige HTML.
- Dokumenterer at dette er en praktisk medlemsbarriere, ikke fullverdig beskyttelse av en PDF som fortsatt ligger i det offentlige temaarkivet.

## 1.6.5 – 2026-07-22

- Erstatter oppfordringen om å se webkameraet med en tydelig påminnelse om grundig preflight-sjekk før avgang.
- Nevner kontroll av modell, batteri eller drivstoffsystem, propell, rorutslag, radiosignal og failsafe.

## 1.6.4 – 2026-07-21

- Forenkler og presiserer beskrivelsen av Bestemorengas plassering i kontrollert luftrom og femkilometersonen.
- Tydeliggjør at klubbens avtale med kontrolltårnet kun gjelder organisert aktivitet på Bestemorenga.
- Oppdaterer den nedlastbare velkomstguiden med samme formulering.

## 1.6.3 – 2026-07-21

- Retter SuperPWA-rutene for manifest og service worker på webhotellet og bygger lenkereglene automatisk én gang.
- Fjerner utilsiktede linjeskift fra SuperPWAs cacheunntak og holder det levende webkamerakallet utenfor PWA-cachen.
- Presiserer på «Nytt medlem» at Bestemorenga ligger i kontrollert luftrom og i ytterkanten av femkilometersonen rundt Bodø lufthavn.
- Oppdaterer den nedlastbare velkomstguiden med samme formulering.

## 1.6.2 – 2026-07-21

- Legger til et vanlig BMFK-appikon i 192 × 192 og 512 × 512 piksler.
- Legger til et maskable PWA-ikon i 512 × 512 med trygg sikkerhetsmargin for rund og adaptiv beskjæring.
- Legger til et eget Apple Touch-ikon i 180 × 180 og kobler det til temaets sidehode.
- Dokumenterer senere SuperPWA-oppsett uten å aktivere service worker eller PWA-cache nå.

## 1.6.1 – 2026-07-21

- Setter værstasjonens lyse bakgrunn til 36 prosent gjennomsiktighet.
- Legger Google Maps-lenke til Bestemorenga og klubbens direkte Grasrotandelen-lenke i bunnteksten.
- Lar Webkamera-lenken i hovedmenyen åpne `/#webkamera` på klubbens egen forside.

## 1.6.0 – 2026-07-21

- Oppretter den nye Git-versjonerte siden «Nytt medlem» på `/nytt-medlem/`.
- Erstatter velkomstbrevet fra 2019 med en komplett guide om medlemskap, NLF, Min idrett, TMS, opplæring, forsikring, operatørregistrering og merking.
- Samler praktisk informasjon om Bestemorenga, åpningstider, første flydag, klubbhytta, Facebook-grupper, OBSREG og Grasrotandelen.
- Oppretter WordPress-siden automatisk dersom den ikke finnes fra før, uten å endre en eksisterende side.
- Legger «Nytt medlem» i forsidens snarveier, fallback-menyen, sidepanelet og bunnteksten.
- Tar med en datert og utskriftsvennlig PDF-versjon som kan sendes direkte til nye medlemmer.
- Oppdaterer dokumentasjonen og erstatter den utdaterte Yr-omtalen med klubbens egen værstasjon.
- Oppdaterer GitHub Actions til `actions/checkout@v6` for å fjerne varselet om utfaset Node.js 20.

## 1.5.12 – 2026-07-20

- Fjerner gradientfargen fra værstasjonens topp og bunn.
- Bruker ensfarget klubbmørkeblå `#04152F`, mens tekst, opacity, m/s og mørk logo beholdes.

## 1.5.11 – 2026-07-20

- Gir værstasjonens topp og bunn en gradient fra klubbens mørkeblå `#04152F` til logoblå `#1514B2`.
- Bruker nesten hvit tekst, mørk logo og vindhastighet i m/s.
- Øker den halvgjennomsiktige hvite målebakgrunnen til 59 prosent.

## 1.5.10 – 2026-07-20

- Setter værstasjonens topp og bunn til hvitt med svart tekst og mørk logo.
- Gir måleområdet en halvgjennomsiktig hvit bakgrunn som følger siden bedre i lys og mørk visning.
- Viser vindhastigheten i meter per sekund (m/s).

## 1.5.9 – 2026-07-20

- Forenkler direktedelen til én kort overskrift: «Direkte fra Bodø Modellflyklubb».
- Plasserer den kompakte værstasjonen til venstre for webkameraet på brede skjermer.
- Reduserer værwidgeten til 400 piksler og bruker WindNerd-visningens lyse standardutforming.
- Beholder webkameraets størrelse og lar rutene stables ryddig på mobil.

## 1.5.8 – 2026-07-20

- Erstatter Yr-kortet på forsiden med klubbens egen værstasjon fra WindNerd.
- Samler webkamera og levende vindmålinger i én ryddig kolonne ved siden av forklaringen.
- Tilpasser værwidgeten med klubbens mørkeblå profil, lyse og lesbare måledata samt vindhastighet i m/s.
- Legger inn en tydelig lenke til alle data fra værstasjonen.

## 1.5.7 – 2026-07-20

- Legger klubbmiljøet rundt bålet inn over medlemsknappen som et varmt, responsivt bildekort.

## 1.5.6 – 2026-07-20

- Oppdaterer tre forsidebilder med klubbens egne motiver: helikopterflyging, modellflyet på bakken og flyglede mellom generasjoner.
- Gir helikopterbildet et tettere utsnitt og oppdaterer beskrivende bildetekster for bedre tilgjengelighet.

## 1.5.5 – 2026-07-20

- Opplyser på Klubbhytta-siden at hytta kan brukes hver dag mellom kl. 08:00 og 00:00.
- Gjør webkameraruten litt større på brede skjermer uten å endre mobilvisningen.

## 1.5.4 – 2026-07-20

- Erstatter Windy-spilleren med klubbens eget kamerabilde i samme kamerarute.
- Leverer bildet gjennom et eget WordPress-endepunkt uten å publisere den opprinnelige filadressen.
- Krever en kontrollert POST-forespørsel med WordPress-sikkerhetskode, slik at endepunktet ikke viser bildet ved direkte besøk.
- Oppdaterer bare kamerabildet automatisk hvert femte minutt, uten å laste hele forsiden på nytt.
- Legger inn reservevisning dersom kamerafilen mangler eller er utilgjengelig.
- Tar med en `.htaccess`-mal som kan sperre direkte tilgang til `webcam.jpg` etter vellykket test.
- Lar Webkamera-lenken i den blå hovedmenyen bruke `https://webcam.bodomfk.no`.

## 1.5.3 – 2026-07-20

- Retter en Safari-feil som klippet den åpne mobilmenyen til høyden på toppfeltet.
- Gjør mobilmenyen heldekkende og rullbar, med støtte for sikkerhetsområdet nederst på iPhone.
- Skjuler Light/Dark-bryteren mens mobilmenyen er åpen, slik at den ikke dekker menypunkter.
- Fjerner det overflødige «Kamera tilgjengelig»-merket fra flyplassbildet.

## 1.5.1 – 2026-07-19

- Retter Webkamera-snarveien under toppbanneret slik at den går direkte til `#webkamera` i stedet for den generelle flyplassdelen.

## 1.5.0 – 2026-07-19

- Flytter de publiserte tekstene for Medlemsfordeler, Klubbhytta, Kontakt oss og Flyplassregler til egne Markdown-filer i GitHub.
- Gjør Git-versjonert innhold til hovedkilde for disse sidene, med eksisterende WordPress-innhold som automatisk reserve.
- Beholder sideutforming, kolonner, knapper, sitater og e-postbeskyttelse når Markdown-filene vises.
- Merker de aktuelle sidene med «Innhold fra GitHub» i WordPress og viser en tydelig redaktørmelding med lenke til riktig fil.
- Dokumenterer hvordan bidragsytere endrer tekster og sender pull request uten å håndtere databasekopier eller brukerdata.
- Utvider `.gitignore` slik at WordPress XML-eksporter ikke legges til ved et uhell.
- Tar med klubbens tidligere flyplass- og sikkerhetsregler fra 2018 som et tydelig merket historisk PDF-dokument.

## 1.4.3 – 2026-07-19

- Oppgraderer den eksisterende flyplassdelen med Windys offisielle timelapse-spiller og avslått automatisk avspilling.
- Bygger inn Yrs offisielle 24-timers værkort for Bestemorenga under overskriften til venstre.
- Beholder den opprinnelige flyplassruten og klubbmotivet urørt, og viser vær til venstre og kamera i en avrundet rute til høyre etter samme mal som velkomstfeltet.
- Legger inn tydelig lenke til det komplette værvarselet for Bestemorenga på Yr.
- Erstatter alle temalenker til kameraets direkteadresse med den offentlige Windy-siden.
- Lar Windy-spilleren beholde sitt opprinnelige 16:9-format, slik at kamerabildet ikke får en fast, duplisert stripe nederst.

## 1.4.2 – 2026-07-19

- Gjør alle vanlige H1–H4-overskrifter tydelig lesbare i Dark Mode.
- Gir innledningstekster og sitatblokker eksplisitte kontrastsikre mørkmodusfarger.
- Retter spesielt den mørke gallerioverskriften «Hobbyen ser best ut i lufta».

## 1.4.1 – 2026-07-19

- Gjør «Se medlemsfordelene» tydelig lesbar igjen i Dark Mode.
- Lar den sekundære knappen følge mørk modus som i versjon 1.3, med eksplisitt kontrastsikre farger som reserve.
- Flytter snarveikortene under banneret slik at teksten i klubbmotivet ikke dekkes på PC eller mobil.

## 1.4.0 – 2026-07-19

- Faser ut og fjerner den ferdigbrukte BMFK-migreringsutvidelsen.
- Retter «Meld hendelse» til NLFs nåværende side for hendelsesrapportering.
- Lenker Modellflyhåndboka via NLFs stabile oversiktsside.
- Forbedrer kortfarger, kontrast og WP Dark Mode-samspill uten å endre den etablerte designretningen.
- Flytter Light/Dark-bryteren bort fra innholdet på små skjermer og gir den norsk tilgjengelig navn.
- Forbedrer mobilmenyens statusmelding, Escape-håndtering og synlig tastaturfokus.
- Fjerner dobbelt aktivt menypunkt for Facebook-ankeret på forsiden.
- Legger inn sidebeskrivelser og metadata for deling i sosiale medier.
- Omdirigerer utdaterte vedleggssider og fjerner lenken til historiske regler fra 2018.
- Retter overskriftshierarki på kontakt- og medlemssidene.
- Gjør sidefeltets lenker kontekstavhengige og lenker kontaktsiden til klubbens ansvarlige.
- Prioriterer forsidebanneret og forbedrer bildeinnlasting.
- Legger til automatisk kontroll, pakking og GitHub-utgivelse av tema-ZIP.
