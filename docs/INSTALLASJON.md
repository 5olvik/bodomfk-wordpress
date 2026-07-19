# Installere og oppdatere BMFK-temaet

Dette er rutinen for versjon 1.4.1 og nyere. Den tidligere migreringsutvidelsen er ferdig brukt og skal ikke installeres på nytt.

## Før oppdatering

1. Ta en fersk sikkerhetskopi av nettstedet og databasen.
2. Kontroller at **WP Dark Mode** og **Email Address Encoder** er aktive.
3. Last ned tema-ZIP-en fra nyeste utgivelse på [GitHub Releases](https://github.com/5olvik/bodomfk-wordpress/releases).

Filen skal hete omtrent `bodomfk-modern-theme-1.4.1.zip`. Ikke last opp «Source code (zip)»; den inneholder hele GitHub-prosjektet og kan ikke installeres direkte som tema.

## Oppdater i WordPress

1. Gå til **Utseende → Temaer → Legg til nytt tema → Last opp tema**.
2. Velg `bodomfk-modern-theme-1.4.1.zip`.
3. Trykk **Installer nå**.
4. Når WordPress finner den gamle versjonen, velg **Erstatt gjeldende med opplastet**.
5. Kontroller at **Bodø Modellflyklubb Modern 1.4.1** fortsatt er aktivt.

Temaet utfører nødvendige, små innholdsjusteringer automatisk første gang en administrator åpner kontrollpanelet. Dette oppdaterer utdaterte NLF-lenker og overskriftsnivåer, men kjører ikke den gamle innholdsmigreringen på nytt.

## Kontroller etter oppdatering

- Forsiden og banneret på PC og mobil.
- Mobilmenyen, tastaturfokus og Light/Dark-bryteren.
- At Facebook-valget ligger høyt på forsiden og åpner:
  - medlemsgruppen: `https://www.facebook.com/groups/bodomfk`
  - offentlig gruppe: `https://www.facebook.com/groups/bodomfksalg`
- At **Meld hendelse** åpner NLFs side for hendelsesrapportering.
- At Modellflyhåndboka åpnes via NLFs oppdaterte oversiktsside.
- At flyplassreglene viser avtalen med Bodø kontrolltårn og at PDF-en åpnes.
- At `post@bodomfk.no` og `faktura@bodomfk.no` vises riktig på kontaktsiden og i bunnteksten.
- At kortene har god kontrast i både lys og mørk visning.

Tøm eventuell cache på webhotellet eller i WordPress hvis gamle farger eller filer fortsatt vises.

## Redigere klubbinformasjon

Gå til **Utseende → Tilpass → Klubbinformasjon** for å endre:

- innmeldingslenke;
- webkamera og lokale regler;
- Facebook-grupper;
- åpningstider;
- kontakt- og fakturaadresse.

## Utvidelser

Behold **WP Dark Mode** og **Email Address Encoder**. Se [UTVIDELSESPLAN.md](UTVIDELSESPLAN.md) for den anbefalte minimale driften.

Utvidelsen **BMFK Modern – oppsett og opprydding** er utfaset. Dersom den fremdeles finnes under **Utvidelser**, kan den deaktiveres og slettes etter at 1.4.0 er installert.

## Tilbakerulling

Hvis en oppdatering gir en alvorlig feil, aktiver et standardtema midlertidig eller gjenopprett siste sikkerhetskopi. Tidligere tema-ZIP-er ligger under [GitHub Releases](https://github.com/5olvik/bodomfk-wordpress/releases).
