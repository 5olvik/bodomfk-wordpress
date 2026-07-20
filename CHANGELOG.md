# Endringslogg

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
