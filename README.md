# Bodø Modellflyklubb – WordPress

Åpen kildekode for moderniseringen av [bodomfk.no](https://bodomfk.no/): et selvstendig WordPress-tema og et kontrollert migreringsverktøy for klubbens eksisterende nettsted.

![Forhåndsvisning av BMFK-temaet](themes/bodomfk-modern-theme/screenshot.png)

## Hva prosjektet inneholder

- `themes/bodomfk-modern-theme/` – responsivt WordPress-tema uten avhengighet til GeneratePress, GP Premium eller en sidebygger.
- `plugins/bmfk-modern-setup/` – midlertidig migrerings- og oppryddingsverktøy for den eksisterende siden.
- `docs/INSTALLASJON.md` – trinnvis installasjon og kontroll.
- `docs/UTVIDELSESPLAN.md` – vurdering av de gamle WordPress-utvidelsene.

Temaet bruker klubbens egen visuelle identitet og inkluderer:

- hovedbanner og moderne forside;
- mobilmeny og responsivt oppsett;
- tydelige snarveier til innmelding, webkamera og sikkerhetsinformasjon;
- presentasjon av klubbens aktiviteter;
- en fremhevet Facebook-velger høyt på forsiden for medlemsgruppen og den offentlige gruppen;
- tydelige kortflater som er tilpasset både Light og Dark via WP Dark Mode;
- beskyttede kontaktadresser for generelle henvendelser og faktura;
- redigerbare lenker og åpningstider i WordPress Customizer;
- tilgjengelig navigasjon uten eksterne JavaScript- eller fontavhengigheter.

## Viktig om sikkerhet og personvern

Repositoryet skal **aldri** inneholde:

- `wp-config.php`, `.env` eller passord;
- WordPress-database eller SQL-eksport;
- Duplicator-/backupfiler eller `installer.php`;
- WordPress-opplastinger som ikke er eksplisitt godkjent for offentlig bruk;
- personopplysninger eller lister over medlemmer og brukerkontoer.

Se [SECURITY.md](SECURITY.md) hvis du oppdager en sikkerhetsfeil eller sensitiv informasjon.

## Installere temaet

1. Last ned repositoryet eller pakk mappen `themes/bodomfk-modern-theme` som ZIP.
2. Gå til **Utseende → Temaer → Legg til nytt → Last opp tema**.
3. Installer og aktiver temaet.
4. Følg deretter [installasjonsveiledningen](docs/INSTALLASJON.md) dersom en eksisterende BMFK-side skal migreres.

Migreringsutvidelsen er laget for klubbens eksisterende nettsted og bør ikke aktiveres på andre WordPress-installasjoner uten gjennomgang.

## Utvikling

Prosjektet bruker vanlig PHP, HTML, CSS og JavaScript uten en egen byggeprosess. Krav:

- WordPress 6.4 eller nyere
- PHP 7.4 eller nyere

Test alltid endringer i en staging-kopi og kontroller både desktop og mobil før en pull request sendes.

## Bidra

Forslag, feilrettinger og designforbedringer er velkomne. Les [CONTRIBUTING.md](CONTRIBUTING.md), opprett gjerne en issue og send endringen som en pull request.

## Lisens

Koden distribueres under [GNU General Public License v2.0](LICENSE), i tråd med WordPress-økosystemet. Bilder og klubbmerker tilhører Bodø Modellflyklubb og skal ikke brukes som om de representerer andre organisasjoner.
