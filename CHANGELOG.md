# Endringslogg

## 1.6.24 – 2026-08-07

- Endrer lenken ved værpanelet til WeatherLinks mer informative fullskjermvisning for Bestemorenga.
- Endrer lenketeksten til «Se værstasjonen på Bestemorenga», mens WeatherLink fortsatt bare åpnes frivillig i en ny fane.
- Bevarer det egen-designede værpanelet og unngår innbygging, bakgrunnslasting og scraping av udokumenterte WeatherLink-endepunkter.

## 1.6.23 – 2026-08-06

- Oppdaterer værverdiene straks forsiden åpnes, deretter hvert femte minutt og når en eldre, skjult fane tas fram igjen.
- Legger til et offentlig, skrivebeskyttet WordPress-endepunkt som bare returnerer ferdig formatert værinnhold fra temaets eksisterende server-side mellomlager.
- Beholder sist viste verdier dersom en oppfriskning feiler, og omgår nettleser- og mellomproxycache uten at nettleseren kontakter MET eller AviationWeather.gov direkte.
- Formaterer alle værtidspunkter eksplisitt i `Europe/Oslo`, slik at både sommer- og vintertid blir riktig uavhengig av WordPress' tidssoneoppsett.
- Legger automatisk oppfriskning til i GitHub Actions og utvider regresjonskontrollene for værpanelet.

## 1.6.22 – 2026-08-06

- Gjør «Bodø-vinden» til den ordinære værmodulen og fjerner synlig testmerking og teknisk iframe-tekst fra forsiden.
- Legger temperatur til alle tre værreferansene og viser forventet nedbør neste time for prognosene fra Bestemorenga og Keiservarden.
- Legger inn en frivillig lenke til WeatherLinks offisielle, mobilvennlige livevisning for den faktiske målestasjonen på Bestemorenga uten å bygge den inn eller laste den i bakgrunnen.
- Oppdaterer personvern- og medlemstekster slik at den utgående værleverandøren ikke lenger omtales på offentlige informasjonssider.
- Bevarer skillet mellom prognoser og fysiske målinger, m/s som hovedverdi og den kompakte utformingen på PC og mobil.

## 1.6.21 – 2026-08-06

- Erstatter tidligere eksterne widgetforsøk med et egen-designet «Bodø-vinden»-panel uten vær-iframe.
- Viser åpne MET-prognoser for Bestemorenga (109 moh.) og Keiservarden (366 moh.), samt en faktisk METAR-måling fra Bodø lufthavn (ENBO).
- Holder prognoser og fysisk måling tydelig atskilt, viser vind og kast i m/s, retning, tidspunkt og markerer eldre reserveverdier.
- Henter værdata på WordPress-serveren med identifisert User-Agent, lokal mellomlagring og siste-gode-verdi ved korte leverandørfeil.
- Unngår at besøkendes nettlesere kontakter værleverandørene før de eventuelt åpner en frivillig kildelenke.
- Tilpasser det kompakte værpanelet til Light/Dark, PC og mobil uten å endre webkameraet eller resten av forsiden.

## 1.6.20 – 2026-08-06

- Prøver leverandørens offisielle vertikale widget for Keiservarden, med vindhastighet og vindkast i m/s.
- Holder værkortet kompakt med en responsiv ramme rundt widgetens 200 piksler brede innhold og en høyde på 460 piksler i stedet for leverandørens foreslåtte 550 piksler.
- Legger inn en tydelig kildelenke til Keiservarden hos Holfuy og begrenser referrer til bodomfk.no-opprinnelsen.
- Dokumenterer at Holfuy krever registrert domene, og at domenegodkjenning og Complianz-skanning må kontrolleres før produksjonsbruk.
- Dokumenterer at Vindnå/Bestemorenga ikke har en funnet, dokumentert innbyggingsmetode og derfor ikke bygges inn eller skrapes.
- Endrer ikke webkameraet, PWA-starten, Light/Dark-bryteren eller øvrig forsideutforming.

## 1.6.19 – 2026-08-02

- Legger inn `AGENTS.md` med faste regler for Codex og andre kodeagenter om versjonering, avgrenset designarbeid, sikkerhet, testing og korrekt ZIP-struktur.
- Legger inn `docs/PROSJEKTSTATUS.md` som en varig overlevering av temaets arkitektur, designvalg, innholdskilder, webkamera, vær, PWA, utvidelser og releaseprosess.
- Lenker prosjektreglene og statusdokumentet fra README, slik at nye bidragsytere ikke er avhengige av historikken i én bestemt samtale.
- Endrer ingen offentlige funksjoner eller designelementer utover versjonsnummeret.

## 1.6.18 – 2026-08-02

- Flytter Light/Dark-bryteren tilbake til nederste venstre hjørne på både PC og mobil, og sørger for at den ikke skjules av temaets Complianz-tilpasning.
- Fjerner den ekstra side- og bunnluften som versjon 1.6.17 reserverte i bunnteksten for flytende kontroller.

## 1.6.17 – 2026-08-02

- Dokumenterer alle fem aktive utvidelser i README, installasjonsveiledningen og utvidelsesplanen: WP Dark Mode, Email Address Encoder, SuperPWA, Complianz og Really Simple Security.
- Presiserer at Duplicator bare er valgfri ved manuelle sikkerhetskopier, og at Klassisk redigering, LightStart og utvidelsen som deaktiverer oppdateringsvarsler ikke brukes av temaet.
- Hindrer at WP Dark Mode-bryteren dekker Complianz-kontroller og reserverer plass til bryteren nederst på siden.
- Retter overskriftsrekkefølgen på forsiden, de Git-versjonerte regelssidene og den eldre siden med gruppeansvarlige uten å endre den visuelle utformingen.
- Fjerner den separate velkomstguiden som PDF. «Nytt medlem» på nettsiden er nå eneste versjon som skal vedlikeholdes.
- Legger den aktive webkamerabehandlingen inn som en ikke-kjørbar distribusjonsmal sammen med `.htaccess`-mal og egen driftsveiledning.
- Herder webkamerabehandlingen med låsing, minste filalder, filstørrelseskontroll og kontroll av fullført JPEG før behandling, slik at cron ikke publiserer en halvferdig NVR-opplasting.

## 1.6.16 – 2026-08-01

- Viser den eksakte PWA-startadressen `https://bodomfk.no/?bmfk_pwa=webkamera` tydelig i appveiledningen.
- Ber iPhone- og iPad-brukere kontrollere den grå adresselinjen i vinduet «Hjem-skjerm» før de trykker «Legg til».
- Forklarer at SuperPWAs variant med avsluttende skråstrek også er gyldig, og hva brukeren skal gjøre dersom bare den vanlige forsiden vises.

## 1.6.15 – 2026-08-01

- Oppretter den Git-versjonerte siden «Bruk BMFK som app» på `/bruk-som-app/` med veiledning for iPhone, iPad, Android og Chrome på datamaskin.
- Oppretter siden automatisk i WordPress uten å endre en eventuell eksisterende side.
- Legger en liten, diskret app-lenke under webkamera og vær på forsiden, samt en snarvei i bunnteksten.
- Viser aktiv nettsideversjon helt nederst og henter nummeret direkte fra temaets `BMFK_THEME_VERSION`, med lenke til tilsvarende GitHub-utgivelse.
- Holder installasjonsveiledningen samlet på nettsiden slik at klubben slipper å vedlikeholde en separat PDF-kopi.

## 1.6.14 – 2026-08-01

- Retter PWA-starten etter at SuperPWA viste seg å legge en avsluttende skråstrek i parameterverdien og levere `?bmfk_pwa=webkamera/`.
- Normaliserer verdien før den kontrolleres, slik at både `webkamera` og `webkamera/` åpner direkte ved `/#webkamera`.
- Legger til en JavaScript-regresjonstest som kjører begge variantene i GitHub Actions.

## 1.6.13 – 2026-08-01

- Lar SuperPWA starte på en robust intern webkamerarute i stedet for den generelle forsiden.
- Ruller startmarkøren automatisk ned til seksjonen «Direkte fra Bodø Modellflyklubb» og rydder adressen til `/#webkamera` uten en ekstra sideinnlasting.
- Bygger SuperPWA-manifestet på nytt én gang etter oppdateringen, uten at startsidefeltet må endres manuelt i kontrollpanelet.
- Legger riktig avstand under den klebrige hovedmenyen når webkameraet åpnes via direkte lenke eller appikon.
- Dokumenterer at en allerede installert app må slettes og legges til på hjemskjermen på nytt for å ta i bruk den nye startadressen.
- Legger til en automatisk kontroll av PWA-filteret, startadressen og manifestoppdateringen i GitHub Actions.

## 1.6.12 – 2026-07-31

- Skiller tydelig mellom det offentlige, personvernbehandlede stillbildet og den lokale sikkerhetsovervåkingen på Bestemorenga.
- Opplyser at Reolink NVR for tiden gjør opptak hele døgnet, uten lyd eller appbasert fjerntilgang, med lokal tilgang og automatisk overskriving etter inntil syv dager.
- Dokumenterer formålet om å forebygge og oppklare innbrudd, tyveri og hærverk ved et avsidesliggende anlegg som tidligere har vært utsatt for innbrudd.
- Tar med at klubbens containere inneholder modellfly og annet utstyr av betydelig verdi.
- Forklarer hvem som kan se eller motta relevante opptak, og at opptakene ikke skal brukes til kontroll av medlemmer eller klubbaktivitet.
- Opplyser at styret skal behandle fortsatt 24/7-opptak og dokumentere nødvendighets- og interesseavveiningen, mens dagens oppsett fortsetter frem til behandlingen er gjennomført.
- Oppdaterer installasjonssjekklisten og testene for kameraopplysningene.

## 1.6.11 – 2026-07-30

- Oppretter en komplett, Git-versjonert personvernerklæring på `/personvern/`.
- Beskriver behandling knyttet til tekniske logger, WordPress-kontoer, e-post, samtykkevalg, medlemsadministrasjon, webkamera og den daværende værmodulen.
- Forklarer formål, behandlingsgrunnlag, mottakere, lagringskriterier og de registrertes rettigheter, med kontaktvei og lenke til Datatilsynet.
- Oppretter siden automatisk og velger den som WordPress-personvernside dersom ingen annen side allerede er valgt.
- Legger Personvern og Complianz' dynamiske informasjonskapsellenke i bunnteksten.
- Tilpasser sidefelt, metadata, dokumentasjon og automatiske tester til den nye siden.
- Oppdaterer utvidelsesplanen slik at Complianz og Really Simple Security har tydelige roller i den anbefalte driften.
- Legger kontroll av kameravinkel, identifiserbarhet og informasjon på området inn i installasjonssjekklisten.

## 1.6.10 – 2026-07-24

- Forklarer presist forskjellen mellom 16-årshovedregelen i åpen kategori og opplæring i NLFs godkjente sikkerhetssystem.
- Fremhever at NLF ikke har en nedre aldersgrense for å starte modellflyopplæring, men normalt anbefaler 12 år og individuell instruktørvurdering for yngre kandidater.
- Presiserer at barn under 16 år kan ta A-bevis og fly selvstendig i klubbregi etter bestått opplæring og oppflyging, innenfor bevisets rettigheter og øvrige regler.
- Legger informasjonen på både Nytt medlem og Medlemsfordeler, med lenker til Luftfartstilsynet og NLFs krav til A-bevis.
- Oppdaterer den nedlastbare velkomstguiden og de automatiske innholdstestene med samme forklaring.

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
- Reduserer værwidgeten til 400 piksler og bruker leverandørens lyse standardutforming.
- Beholder webkameraets størrelse og lar rutene stables ryddig på mobil.

## 1.5.8 – 2026-07-20

- Erstatter Yr-kortet på forsiden med klubbens daværende lokale værstasjon.
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
