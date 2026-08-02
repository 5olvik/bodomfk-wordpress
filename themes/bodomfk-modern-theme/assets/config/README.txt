BMFK WEBKAMERA – FILER FOR WEBHOTELLET
======================================

Disse filene er dokumenterte distribusjonsmaler. WordPress installerer dem
ikke automatisk, fordi den aktive kameramappen ligger utenfor temamappen.

1. webcam-processor.php.txt
   Kopier innholdet til /webcam/webcam.php på webhotellet.

   Scriptet:
   - venter til en NVR-opplasting har vært urørt i minst 90 sekunder;
   - kontrollerer filstørrelse, JPEG-format og fullført JPEG-avslutning;
   - hindrer overlappende cron-kjøringer med en låsefil;
   - skalerer, beskjærer og legger personvernfilter på bildet;
   - erstatter webcam.jpg atomisk og sletter ferdigbehandlede originaler.

   Cron kan fortsatt kjøre hvert minutt. En ny NVR-fil blir normalt behandlet
   på første kjøring etter at 90 sekunder har gått.

2. webcam-protection.htaccess.txt
   Kopier innholdet til /webcam/.htaccess på webhotellet.

   Filen slår av katalogvisning og sperrer direkte HTTP-tilgang til alle JPG-
   og JPEG-filer. WordPress kan fortsatt lese webcam.jpg lokalt fra filsystemet,
   og webcam.php kan fortsatt opprette, gi nytt navn til og slette filer.

KONTROLL ETTER ENDRING
----------------------

- PHP GD må være aktivt på webhotellet.
- /webcam/ må være skrivbar for PHP-brukeren og NVR-opplastingen.
- Kontroller at bodomfk.no viser et nytt bilde etter neste NVR-opplasting.
- Direkte åpning av /webcam/webcam.jpg skal avvises.
- Kontroller at øvre og nedre personvernfilter fortsatt er sterke nok.
- Behold en kopi av den fungerende webcam.php før scriptet erstattes.

Ikke legg passord, FTP-opplysninger, brukernavn eller kameranøkler i disse
filene eller i GitHub.
