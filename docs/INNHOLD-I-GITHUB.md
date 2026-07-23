# Endre sidetekster via GitHub

Fra tema 1.5.0 er GitHub hovedkilden for innholdet på disse offentlige informasjonssidene:

| WordPress-side | Innholdsfil |
| --- | --- |
| Nytt medlem | `themes/bodomfk-modern-theme/content/pages/nytt-medlem.md` |
| Medlemsfordeler | `themes/bodomfk-modern-theme/content/pages/medlemsfordeler.md` |
| Klubbhytta | `themes/bodomfk-modern-theme/content/pages/klubbhytta.md` |
| Kontakt oss | `themes/bodomfk-modern-theme/content/pages/kontaktoss.md` |
| Flyplassregler | `themes/bodomfk-modern-theme/content/pages/flyplassregler.md` |

Forsiden og nyheter/innlegg følger fortsatt sine vanlige WordPress- og temarutiner.

## Foreslå en tekstendring

1. Åpne riktig `.md`-fil på GitHub.
2. Trykk blyantikonet for å redigere.
3. Endre bare teksten og lenkene som skal oppdateres.
4. Velg å opprette en ny gren og pull request.
5. Beskriv kort hva som er endret og hvorfor.
6. Etter kontroll og sammenslåing bygger GitHub automatisk en ny tema-ZIP når versjonsnummeret er oppdatert.

Endringen kommer på bodomfk.no når den nye tema-ZIP-en er installert i WordPress. Ikke rediger samme tekst i WordPress; feltet der er bare en reserve hvis Git-filen skulle mangle.

## Vanlig Markdown

```md
## Mellomoverskrift

Et vanlig avsnitt med **uthevet tekst** og en [lenke](https://example.com/).

- Første punkt
- Andre punkt

> En viktig merknad eller advarsel.
```

En omvendt skråstrek (`\`) helt på slutten av en linje lager et kontrollert linjeskift, for eksempel i en adresse.

## Strukturmarkører

Eksisterende markører sørger for at kort, kolonner og knapper beholder utformingen. Ikke fjern dem når du bare endrer tekst.

```md
:::columns
:::column
## Første kort

Tekst i første kolonne.

:::column
## Andre kort

Tekst i andre kolonne.
:::endcolumns

[Button: Les mer](https://example.com/)
```

Flyplassregler bruker også denne spesialmarkøren:

```md
[AvinorAgreement]
```

Den viser passordpanelet for Avinor-avtalen. Ikke erstatt markøren med en direkte PDF-lenke. Passordet settes i WordPress under **Utseende → Dokumenttilgang** og skal aldri skrives i Markdown-filen.

## Verdier som styres av WordPress

Disse plassholderne kan brukes i innholdsfilene og blir erstattet når siden vises:

- `{{contact_email_link}}`
- `{{invoice_email_link}}`
- `{{membership_url}}`
- `{{incident_url}}`
- `{{handbook_url}}`
- `{{rules_url}}`
- `{{clubhouse_url}}`
- `{{contact_url}}`
- `{{group_contacts_url}}`
- `{{webcam_url}}`
- `{{facebook_members_url}}`
- `{{facebook_market_url}}`
- `{{electric_hours}}`
- `{{combustion_hours}}`
- `{{rules_2018_pdf_url}}`
- `{{new_member_pdf_url}}`

Dermed kan kontaktadresser og enkelte lenker fortsatt endres under **Utseende → Tilpass → Klubbinformasjon** uten at samme verdi må skrives flere steder.

## Personvern og sikkerhet

Bare publisert informasjon skal ligge i innholdsfilene. Ikke legg til medlemslister, private telefonnumre, brukerdata, passord, API-nøkler, WordPress-eksporter eller backupfiler. WordPress XML-eksporten som ble brukt til førstegangsuthenting er ikke en del av repositoryet.

Avinor-PDF-en finnes fortsatt i Git-historikken og temaets offentlige filer. Passordpanelet er derfor en praktisk medlemsbarriere, ikke dokumentbeskyttelse mot en person som allerede kjenner den direkte filadressen.
