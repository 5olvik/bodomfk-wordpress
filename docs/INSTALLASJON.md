# Bodø Modellflyklubb – modernisering

Dette repositoryet inneholder et nytt, selvstendig WordPress-tema og en midlertidig oppsettsutvidelse. Temaet er ikke avhengig av GeneratePress, GP Premium, SiteOrigin, Jetpack, Photo Gallery eller Ultimate Member.

**Versjon 1.1:** Facebook-valget er flyttet høyt opp på forsiden. Den fjernede Facebook-siden er tatt bort, og løsningen peker nå bare til medlemsgruppen og den offentlige gruppen.

**Versjon 1.1.1:** Rettet en feil som gjorde knappen «Kjør innholdsmigrering» grå selv når riktig tema var aktivt.

**Versjon 1.2.0:** Beholder WP Dark Mode og Light/Dark-bryteren, gir alle kortflater tydeligere kontrast i begge visninger og legger inn `post@bodomfk.no` og `faktura@bodomfk.no` med Email Address Encoder.

**Versjon 1.3.0:** Legger avtalen med Bodø kontrolltårn, datert 26. mai 2026, under «Flyplassregler» og gir en egen oppdateringsknapp som ikke overskriver de andre migrerte sidene.

## Innhold

- `themes/bodomfk-modern-theme/` – det nye WordPress-temaet.
- `plugins/bmfk-modern-setup/` – migrering og kontrollert deaktivering av gamle utvidelser.
- `docs/UTVIDELSESPLAN.md` – anbefalt opprydding.

Last ned repositoryet og komprimer temamappen og pluginmappen hver for seg. ZIP-filene må inneholde henholdsvis toppmappen `bodomfk-modern-theme` og `bmfk-modern-setup`.

## Oppdatere fra versjon 1.2.0 til 1.3.0

1. Last opp `bodomfk-modern-theme.zip` under **Utseende → Temaer → Legg til nytt tema → Last opp tema**, og velg å erstatte den installerte versjonen.
2. Last opp `bmfk-modern-setup.zip` under **Utvidelser → Legg til ny utvidelse → Last opp utvidelse**, og erstatt den installerte versjonen.
3. Gå til **Verktøy → BMFK modernisering** og trykk **Oppdater flyplassreglene**.
4. Åpne siden **Flyplassregler** og kontroller at knappen til avtalen med Bodø kontrolltårn åpner PDF-en.

Du skal ikke kjøre hele innholdsmigreringen på nytt for denne oppdateringen.

## Før du starter

1. Behold Duplicator-pakken fra før moderniseringen på et trygt sted.
2. Ta helst en ny backup rett før installasjon dersom innholdet på den aktive siden er endret.
3. Gjør installasjonen når du har tid til å kontrollere siden både på PC og mobil.
4. Ikke slett gamle utvidelser i første runde. Deaktivering er nok frem til alt er verifisert.

## Installasjon

1. Gå til **Utseende → Temaer → Legg til nytt tema → Last opp tema**.
2. Last opp ZIP-filen du laget av `themes/bodomfk-modern-theme`.
3. Installer og aktiver **Bodø Modellflyklubb Modern**.
4. Gå til **Utvidelser → Legg til ny utvidelse → Last opp utvidelse**.
5. Last opp ZIP-filen du laget av `plugins/bmfk-modern-setup`, og aktiver den.
6. Gå til **Verktøy → BMFK modernisering**.
7. Trykk **Kjør innholdsmigrering**.

Hvis migreringen allerede er kjørt, bruker du de egne knappene under **Verktøy → BMFK modernisering**. «Oppdater kontaktsiden» og «Oppdater flyplassreglene» endrer bare den aktuelle siden og lar de andre sidene være urørt.

Migreringen:

- gjør om relevante SiteOrigin-sider til vanlig WordPress-blokkinnhold;
- tar vare på det gamle sideinnholdet i metadata før endring;
- setter de gamle Ultimate Member-sidene til utkast;
- lukker kommentarer og pingbacks;
- lager og aktiverer en ny hovedmeny;
- sletter ikke WordPress-brukere eller utvidelser.

## Kontroller før opprydding

- Forsiden, banneret og alle snarveier.
- Menyen på PC og mobil.
- Medlemsfordeler, klubbhytta, kontakt og gruppeansvarlige.
- Webkamera, innmelding og hendelsesskjema.
- Facebook-velgeren høyt på forsiden: medlemsgruppen skal peke til `https://www.facebook.com/groups/bodomfk`, og den offentlige gruppen til `https://www.facebook.com/groups/bodomfksalg`.
- Kontaktsiden og bunnteksten: `post@bodomfk.no` skal brukes for generelle henvendelser og `faktura@bodomfk.no` for faktura.
- Light/Dark-bryteren og at kortene er tydelig skilt fra bakgrunnen i begge visninger.
- At åpningstidene er riktige.
- At lenken til lokale flyplassregler peker på den faktisk gjeldende versjonen.
- At knappen til avtalen med Bodø kontrolltårn åpner PDF-en, og at omtalen tydelig avgrenser tillatelsen til klubbens aktivitet ved Bestemorenga.
- At klubbens ansvarlige og nøkkelavgiften fortsatt er riktige.

Åpningstider og lenker kan endres under **Utseende → Tilpass → Klubbinformasjon**.

Behold **WP Dark Mode** og **Email Address Encoder** aktive. Under **Innstillinger → Email Encoder** kan du bruke Page Scanner for å kontrollere at e-postadressene er kodet i HTML-kilden.

## Deaktiver gamle utvidelser

Når kontrollen er utført, gå tilbake til **Verktøy → BMFK modernisering**. Listen viser hvilke utvidelser som er aktive og hvorfor de ikke lenger behøves. De anbefalte utvidelsene er forhåndsvalgt.

Velg **Deaktiver valgte utvidelser**. Handlingen sletter ingenting. Hvis noe uventet skjer, kan utvidelsen aktiveres igjen.

Vent med å fjerne Duplicator, Really Simple SSL og Complianz til punktene i `UTVIDELSESPLAN.md` er kontrollert.

## Brukerkontoer

Backupen inneholder 11 WordPress-brukere. De gamle offentlige innloggingssidene blir arkivert, men brukerkontoene slettes ikke automatisk. Gå gjennom **Brukere → Alle brukere** manuelt:

- behold bare kontoer som faktisk trenger tilgang til administrasjonen;
- fjern eller nedgrader gamle medlem-/testkontoer;
- kontroller at ingen ukjente kontoer har administratorrolle;
- bruk unike passord og tofaktorautentisering for administratorer.

## Når alt fungerer

1. Ta en ny komplett sikkerhetskopi.
2. Slett utvidelser som har vært deaktivert uten problemer.
3. Deaktiver og slett oppsettsutvidelsen `BMFK Modern – oppsett og opprydding`. Temaet trenger den ikke i normal drift.
4. Behold én kopi av gammel og én kopi av ny side utenfor webhotellet.
