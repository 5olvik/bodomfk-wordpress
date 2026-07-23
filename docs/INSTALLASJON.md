# Installere og oppdatere BMFK-temaet

Dette er rutinen for versjon 1.6.7 og nyere. Den tidligere migreringsutvidelsen er ferdig brukt og skal ikke installeres på nytt.

## Før oppdatering

1. Ta en fersk sikkerhetskopi av nettstedet og databasen.
2. Kontroller at **WP Dark Mode** og **Email Address Encoder** er aktive.
3. Last ned tema-ZIP-en fra nyeste utgivelse på [GitHub Releases](https://github.com/5olvik/bodomfk-wordpress/releases).

Filen skal hete omtrent `bodomfk-modern-theme-1.6.7.zip`. Ikke last opp «Source code (zip)»; den inneholder hele GitHub-prosjektet og kan ikke installeres direkte som tema.

## Oppdater i WordPress

1. Gå til **Utseende → Temaer → Legg til nytt tema → Last opp tema**.
2. Velg `bodomfk-modern-theme-1.6.7.zip`.
3. Trykk **Installer nå**.
4. Når WordPress finner den gamle versjonen, velg **Erstatt gjeldende med opplastet**.
5. Kontroller at **Bodø Modellflyklubb Modern 1.6.7** fortsatt er aktivt.

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
- At Bestemorenga beskrives som rett utenfor femkilometersonen, og at flyging vest for rullebanen kan berøre sonen.
- At FPV-lenkene åpner NLFs digitale sjekkliste og informasjon om teoriprøven.
- Gå til **Utseende → Dokumenttilgang**, sett medlemspassordet til Avinor-avtalen og noter det på et trygt sted.
- Åpne Flyplassregler i et privat nettleservindu og kontroller at feil passord avvises, mens riktig passord viser PDF-knappen.
- At den tidligere PDF-en med flyplass- og sikkerhetsregler er merket som et historisk dokument fra 2018.
- At `post@bodomfk.no` og `faktura@bodomfk.no` vises riktig på kontaktsiden og i bunnteksten.
- At Google Maps- og Grasrotandelen-lenkene nederst på siden åpner riktig klubbside.
- At Nytt medlem, Medlemsfordeler, Klubbhytta, Kontakt oss og Flyplassregler viser tekstene fra GitHub uten synlige strukturmarkører.
- At `/nytt-medlem/` er opprettet, og at PDF-knappen åpner den oppdaterte velkomstguiden.
- At `superpwa-manifest.json` viser JSON og at `superpwa-sw.js` viser JavaScript uten en WordPress 404-side.
- At webkamerabildet oppdateres i den installerte PWA-en og ikke hentes fra en gammel service-worker-cache.
- At kortene har god kontrast i både lys og mørk visning.

Tøm eventuell cache på webhotellet eller i WordPress hvis gamle farger eller filer fortsatt vises.

## Git-versjonerte sidetekster

Nytt medlem, Medlemsfordeler, Klubbhytta, Kontakt oss og Flyplassregler henter hovedinnholdet fra Markdown-filene i temaets `content/pages`-mappe. WordPress-innholdet brukes automatisk som reserve hvis en fil mangler. Endringer i WordPress-redigeringen overstyrer derfor ikke GitHub-teksten så lenge den tilhørende filen finnes. Se [INNHOLD-I-GITHUB.md](INNHOLD-I-GITHUB.md) for bidragsrutinen.

## Redigere klubbinformasjon

Gå til **Utseende → Tilpass → Klubbinformasjon** for å endre:

- innmeldingslenke;
- lokale regler;
- Facebook-grupper;
- åpningstider;
- kontakt- og fakturaadresse.

Medlemspassordet til Avinor-avtalen styres separat under **Utseende → Dokumenttilgang**. Se [DOKUMENTTILGANG.md](DOKUMENTTILGANG.md).

## Utvidelser

Behold **WP Dark Mode** og **Email Address Encoder**. Se [UTVIDELSESPLAN.md](UTVIDELSESPLAN.md) for den anbefalte minimale driften.

Utvidelsen **BMFK Modern – oppsett og opprydding** er utfaset. Dersom den fremdeles finnes under **Utvidelser**, kan den deaktiveres og slettes etter at 1.4.0 er installert.

## Tilbakerulling

Hvis en oppdatering gir en alvorlig feil, aktiver et standardtema midlertidig eller gjenopprett siste sikkerhetskopi. Tidligere tema-ZIP-er ligger under [GitHub Releases](https://github.com/5olvik/bodomfk-wordpress/releases).
