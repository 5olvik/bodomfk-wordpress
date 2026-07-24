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

Flyplassregler bruker også disse spesialmarkørene:

```md
[AvinorAgreement]
[HistoricalRules]
```

De viser passordpanelene for Avinor-avtalen og de historiske reglene fra 2018. Ikke erstatt markørene med direkte PDF-lenker. Begge panelene bruker passordet som settes i WordPress under **Utseende → Dokumenttilgang**. Passordet skal aldri skrives i Markdown-filen.

## Sikkerhetskritiske endringer

`flyplassregler.md` inneholder klubbens operative lokale regelverk. Endringer i flysone, åpningstider, adgang, maksimal aktivitet, tårnrutine, FPV-krav eller beredskap skal kontrolleres av styret eller klubbens sikkerhetsansvarlige før de slås sammen.

Når en lokal regel endres, skal den korte oversikten i `nytt-medlem.md` og PDF-en `assets/documents/velkommen-som-medlem-2026.pdf` kontrolleres samtidig. Dokumentet fra 2018 er historisk referanse og skal ikke redigeres for å beskrive dagens regler.

Påstander om aldersgrenser og selvstendig flyging skal skille tydelig mellom åpen kategori og flyging i regi av BMFK/NLF. Kontroller slike endringer mot Luftfartstilsynets gjeldende droneregler, Modellflyhåndboka og NLFs krav til A-bevis. Ikke forkort teksten til at det alltid er 16-årsgrense, eller at medlemskap alene gir rett til å fly uten tilsyn.

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
- `{{new_member_pdf_url}}`

Dermed kan kontaktadresser og enkelte lenker fortsatt endres under **Utseende → Tilpass → Klubbinformasjon** uten at samme verdi må skrives flere steder.

## Personvern og sikkerhet

Bare publisert informasjon skal ligge i innholdsfilene. Ikke legg til medlemslister, private telefonnumre, brukerdata, passord, API-nøkler, WordPress-eksporter eller backupfiler. WordPress XML-eksporten som ble brukt til førstegangsuthenting er ikke en del av repositoryet.

Begge de passordmerkede PDF-ene finnes fortsatt i Git-historikken og temaets offentlige filer. Passordpanelene er derfor en praktisk barriere, ikke dokumentbeskyttelse mot en person som allerede kjenner den direkte filadressen.
