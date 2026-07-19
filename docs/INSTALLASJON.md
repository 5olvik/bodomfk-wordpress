# Bodø Modellflyklubb – modernisering

Dette repositoryet inneholder et nytt, selvstendig WordPress-tema og en midlertidig oppsettsutvidelse. Temaet er ikke avhengig av GeneratePress, GP Premium, SiteOrigin, Jetpack, Photo Gallery eller Ultimate Member.

## Innhold

- `themes/bodomfk-modern-theme/` – det nye WordPress-temaet.
- `plugins/bmfk-modern-setup/` – migrering og kontrollert deaktivering av gamle utvidelser.
- `docs/UTVIDELSESPLAN.md` – anbefalt opprydding.

Last ned repositoryet og komprimer temamappen og pluginmappen hver for seg. ZIP-filene må inneholde henholdsvis toppmappen `bodomfk-modern-theme` og `bmfk-modern-setup`.

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
- Webkamera, innmelding, Facebook-lenker og hendelsesskjema.
- At åpningstidene er riktige.
- At lenken til lokale flyplassregler peker på den faktisk gjeldende versjonen.
- At klubbens ansvarlige og nøkkelavgiften fortsatt er riktige.

Åpningstider og lenker kan endres under **Utseende → Tilpass → Klubbinformasjon**.

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
