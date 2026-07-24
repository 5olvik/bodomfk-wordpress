# Bidra til BMFK-nettsiden

Takk for at du vil hjelpe Bodø Modellflyklubb.

## Før du begynner

1. Se etter en eksisterende issue som beskriver endringen.
2. Opprett en ny issue dersom større funksjon eller designendring bør avklares først.
3. Lag en egen branch fra `main`.
4. Hold hver pull request avgrenset til én logisk endring.

Skal du bare endre en fast sidetekst, les [veiledningen for Git-versjonert innhold](docs/INNHOLD-I-GITHUB.md) og rediger riktig Markdown-fil under `themes/bodomfk-modern-theme/content/pages/`.

## Krav til endringer

- Behold støtte for WordPress 6.4+ og PHP 7.4+.
- Bruk WordPress-funksjoner for escaping og sanitering.
- Ikke legg til sidebygger, sporingsverktøy, eksterne fonter eller tunge rammeverk uten diskusjon.
- Kontroller tastaturnavigasjon, kontrast og mobilvisning.
- Optimaliser bilder før de legges inn.
- Oppdater dokumentasjonen når installasjon eller administrasjon endres.
- Få endringer i lokale flyplass- og sikkerhetsregler kontrollert av styret eller klubbens sikkerhetsansvarlige, og hold kortversjonen og velkomst-PDF-en samkjørt.

## Test før pull request

- Forside og alle sidemaler på desktop.
- Mobilmeny og horisontal scrolling på liten skjerm.
- Alle eksterne lenker.
- PHP-syntaks og JavaScript-syntaks.
- At endringen ikke introduserer passord, private persondata eller backupfiler. Offisielle dokumenter med navn eller signatur krever klubbens godkjenning før publisering.
- At `Version` i temaets `style.css` økes når en temaendring skal publiseres som en ny utgivelse.

## Pull request

Beskriv:

- hva som er endret;
- hvorfor endringen er nødvendig;
- hvordan den er testet;
- skjermbilder ved visuelle endringer.

Ikke bruk ekte medlems- eller brukerdata i tester eller skjermbilder.

Når en temaendring blir slått sammen til `main`, kontrollerer GitHub Actions PHP og JavaScript, bygger en installerbar tema-ZIP og publiserer den under **Releases**.
