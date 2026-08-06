<?php
/**
 * Lightweight runtime test for the Git-managed content renderer.
 */

define( 'ABSPATH', __DIR__ );
define( 'BMFK_INCIDENT_REPORT_URL', 'https://example.com/incident' );
define( 'BMFK_HANDBOOK_URL', 'https://example.com/handbook' );

function bmfk_setting( $key, $default = '' ) {
	return $default;
}

function bmfk_asset_url( $path ) {
	return 'https://example.com/theme/assets/' . ltrim( $path, '/' );
}

function bmfk_cookie_policy_url() {
	return 'https://example.com/cookie-policy-eu/';
}

function home_url( $path = '/' ) {
	return 'https://example.com' . '/' . ltrim( $path, '/' );
}

function bmfk_protected_email_link( $email, $class = '' ) {
	return '<a href="mailto:' . htmlspecialchars( $email, ENT_QUOTES, 'UTF-8' ) . '">' . htmlspecialchars( $email, ENT_QUOTES, 'UTF-8' ) . '</a>';
}

function bmfk_avinor_agreement_gate() {
	return '<section data-bmfk-document-gate data-document="avinor">Avtalen er for klubbens medlemmer.</section>';
}

function bmfk_historical_rules_gate() {
	return '<section data-bmfk-document-gate data-document="rules-2018">Dokumentet er for styret.</section>';
}

function esc_html( $text ) {
	return htmlspecialchars( $text, ENT_QUOTES, 'UTF-8' );
}

function esc_url( $url, $protocols = null ) {
	return filter_var( $url, FILTER_SANITIZE_URL );
}

function get_template_directory() {
	return dirname( __DIR__ ) . '/themes/bodomfk-modern-theme';
}

function add_filter() {}
function add_action() {}

require get_template_directory() . '/inc/content-pages.php';

$errors = array();

foreach ( bmfk_git_content_pages() as $slug => $filename ) {
	$html = bmfk_git_page_content( $slug );

	if ( null === $html || '' === trim( $html ) ) {
		$errors[] = $filename . ': ga ikke HTML';
		continue;
	}

	if ( false !== strpos( $html, ':::' ) || preg_match( '/\{\{[^}]+\}\}/', $html ) ) {
		$errors[] = $filename . ': har ubehandlede strukturmarkorer eller plassholdere';
	}

	if ( substr_count( $html, '<div' ) !== substr_count( $html, '</div>' ) ) {
		$errors[] = $filename . ': har ubalanserte div-elementer';
	}

	if ( preg_match( '/<h1[\s>]/i', $html ) ) {
		$errors[] = $filename . ': inneholder H1 som skal komme fra WordPress';
	}
}

$rules_html = bmfk_git_page_content( 'flyplassregler' );
if ( false === strpos( $rules_html, 'Historisk dokument fra 2018' ) || false === strpos( $rules_html, 'data-document="rules-2018"' ) ) {
	$errors[] = 'flyplassregler.md: mangler passordpanelet for historisk PDF fra 2018';
}

if ( 2 !== substr_count( $rules_html, 'data-bmfk-document-gate' ) || false === strpos( $rules_html, 'data-document="avinor"' ) ) {
	$errors[] = 'flyplassregler.md: mangler de to dokumentportene';
}

if ( false !== strpos( $rules_html, 'avinor-bestemorenga-avtale-2026.pdf' ) ) {
	$errors[] = 'flyplassregler.md: eksponerer Avinor-lenken før passordkontroll';
}

if ( false !== strpos( $rules_html, 'flyplass-og-sikkerhetsregler-2018.pdf' ) ) {
	$errors[] = 'flyplassregler.md: eksponerer historisk PDF-lenke før passordkontroll';
}

foreach ( array(
	'Medlem i BMFK og NLF',
	'Ikke medlem i NLF',
	'A1/A3-kompetanse fra flydrone.no er ikke nødvendig',
	'Operatørregistrering og pilotkompetanse er to forskjellige krav',
	'rett utenfor femkilometersonen rundt Bodø lufthavn',
	'Flyging vest for rullebanen kan likevel berøre sonen',
	'i regi av Bodø Modellflyklubb og under NLFs sikkerhetssystem',
	'FPV, helikopter, multirotor og automatiske funksjoner',
	'sjekkliste-fpv',
	'ta-teoriprove-for-fpv',
	'Lokalt regelverk for Bestemorenga',
	'Oppdatert 24. juli 2026',
	'maksimalt <strong>tre modeller</strong>',
	'Flyging over 120 meter',
	'Modellfly har alltid vikeplikt for bemannede luftfartøy',
	'Kontroll før flyging',
	'Sikkerhet på bakken og bruk av området',
	'Hendelser, avvik og brudd på reglene',
) as $required_text ) {
	if ( false === strpos( $rules_html, $required_text ) ) {
		$errors[] = 'flyplassregler.md: mangler ' . $required_text;
	}
}

foreach ( array( 'nær yttergrensen av femkilometersonen', 'kun organisert aktivitet på Bestemorenga' ) as $outdated_text ) {
	if ( false !== strpos( $rules_html, $outdated_text ) ) {
		$errors[] = 'flyplassregler.md: inneholder utdatert formulering: ' . $outdated_text;
	}
}

$new_member_html = bmfk_git_page_content( 'nytt-medlem' );
foreach ( array( 'Min idrett', 'TMS', 'Ansvarsforsikring', 'Operatørregistrering', 'OBSREG', '993 764 299' ) as $required_text ) {
	if ( false === strpos( $new_member_html, $required_text ) ) {
		$errors[] = 'nytt-medlem.md: mangler ' . $required_text;
	}
}

if ( false !== stripos( $new_member_html, 'velkommen-som-medlem-2026.pdf' ) || file_exists( get_template_directory() . '/assets/documents/velkommen-som-medlem-2026.pdf' ) ) {
	$errors[] = 'Nytt medlem skal vedlikeholdes som nettside og ikke dupliseres som PDF';
}

if ( false === strpos( $new_member_html, 'rett utenfor femkilometersonen rundt Bodø lufthavn' ) ) {
	$errors[] = 'nytt-medlem.md: mangler presis beskrivelse av femkilometersonen';
}

if ( false === strpos( $new_member_html, 'Flyging vest for rullebanen kan likevel berøre sonen' ) ) {
	$errors[] = 'nytt-medlem.md: mangler forklaring om flyging vest for rullebanen';
}

$app_guide_html = bmfk_git_page_content( 'bruk-som-app' );
foreach ( array(
	'iPhone og iPad',
	'Android',
	'Chrome på Windows, Mac og Linux',
	'Legg til på Hjem-skjerm',
	'https://bodomfk.no/?bmfk_pwa=webkamera',
	'den grå adresselinjen inneholder <strong>?bmfk_pwa=webkamera</strong>',
	'Hvis den bare viser https://bodomfk.no/',
	'Installer siden som app',
	'Appikonet åpner direkte ved webkamera og vær',
	'Hvis installasjonsvalget mangler',
	'Hvis appen ikke åpner ved webkameraet',
) as $required_text ) {
	if ( false === strpos( $app_guide_html, $required_text ) ) {
		$errors[] = 'bruk-som-app.md: mangler ' . $required_text;
	}
}

if ( false === strpos( $app_guide_html, 'https://example.com/#webkamera' ) ) {
	$errors[] = 'bruk-som-app.md: mangler dynamisk lenke til webkameraet';
}

if ( false !== stripos( $app_guide_html, '.pdf' ) || file_exists( get_template_directory() . '/assets/documents/bmfk-pwa-bruksanvisning.pdf' ) ) {
	$errors[] = 'Appveiledningen skal vedlikeholdes som nettside og ikke dupliseres som PDF';
}

$privacy_html = bmfk_git_page_content( 'personvern' );
foreach ( array(
	'Bodø Modellflyklubb er behandlingsansvarlig',
	'993 764 299',
	'Vanlige besøk og sikkerhet',
	'Kamera på Bestemorenga',
	'Offentlig webkamera',
	'hvert tiende minutt',
	'Lokal sikkerhetsovervåking',
	'videoopptak hele døgnet',
	'tidligere vært utsatt for innbrudd',
	'containere',
	'modellfly og annet utstyr av betydelig verdi',
	'Det tas ikke opp lyd',
	'UUID- og appbaserte fjerntilgang er deaktivert',
	'inntil syv dager',
	'Styret skal behandle den videre bruken av døgnkontinuerlig opptak',
	'Dagens 24/7-oppsett fortsetter',
	'Meteorologisk institutt',
	'AviationWeather.gov',
	'WeatherLink',
	'vind, temperatur og forventet nedbør',
	'værpanelet setter ingen tredjeparts informasjonskapsler',
	'PRO ISP',
	'Zoho',
	'Norges idrettsforbund og Norges Luftsportforbund',
	'Vi lagrer ikke opplysninger lenger enn nødvendig',
	'Dine rettigheter',
	'Datatilsynet',
	'Sist oppdatert: 6. august 2026',
) as $required_text ) {
	if ( false === strpos( $privacy_html, $required_text ) ) {
		$errors[] = 'personvern.md: mangler ' . $required_text;
	}
}

if ( false === strpos( $privacy_html, 'https://example.com/cookie-policy-eu/' ) ) {
	$errors[] = 'personvern.md: mangler dynamisk lenke til informasjonskapsler';
}

if ( false !== strpos( $privacy_html, '{{' ) ) {
	$errors[] = 'personvern.md: har ubehandlede plassholdere';
}

if ( false !== stripos( $privacy_html, 'WindNerd' ) ) {
	$errors[] = 'personvern.md: omtaler fortsatt den utgående værleverandøren';
}

if ( false === strpos( $new_member_html, 'avtale med Bodø kontrolltårn gjelder flyging i regi av Bodø Modellflyklubb og under NLFs sikkerhetssystem' ) ) {
	$errors[] = 'nytt-medlem.md: mangler avgrensning av avtalen med kontrolltårnet';
}

foreach ( array(
	'åpen kategori',
	'Operatørregistrering og merking er egne krav',
	'Les hele forklaringen under Flyplassregler',
	'Barn og ungdom kan fly selvstendig gjennom klubben',
	'Hovedregelen er at piloten må være minst 16 år',
	'NLF har ingen nedre aldersgrense for å starte modellflyopplæring',
	'Generelt anbefales det at kandidaten har fylt 12 år',
	'barn under 16 år som har gjennomført opplæringen og bestått oppflyging til A-bevis',
	'fly selvstendig i regi av BMFK/NLF innenfor rettighetene beviset gir',
	'vedlegg-b---krav-til-modellflybevis-a_-v.1.4.pdf',
	'FPV - sjekkliste og teoriprøve',
	'sjekkliste-fpv',
	'ta-teoriprove-for-fpv',
	'Lokale regler - kortversjon',
	'maksimalt tre modeller',
	'Fly aldri over depotet',
	'Bemannede luftfartøy har alltid prioritet',
) as $required_text ) {
	if ( false === strpos( $new_member_html, $required_text ) ) {
		$errors[] = 'nytt-medlem.md: mangler regelverksforklaring: ' . $required_text;
	}
}

$benefits_html = bmfk_git_page_content( 'medlemsfordeler' );
foreach ( array(
	'Barn og ungdom',
	'NLF har ingen nedre aldersgrense for å starte modellflyopplæring',
	'Barn under 16 år kan ta A-bevis og fly selvstendig i klubbregi',
	'Kompetanse, modellkategori og lokale regler avgjør hva piloten kan fly',
) as $required_text ) {
	if ( false === strpos( $benefits_html, $required_text ) ) {
		$errors[] = 'medlemsfordeler.md: mangler alders- og kompetanseforklaring: ' . $required_text;
	}
}

foreach ( array( 'nær yttergrensen av femkilometersonen', 'kun organisert aktivitet på Bestemorenga' ) as $outdated_text ) {
	if ( false !== strpos( $new_member_html, $outdated_text ) ) {
		$errors[] = 'nytt-medlem.md: inneholder utdatert formulering: ' . $outdated_text;
	}
}

$style_source     = file_get_contents( get_template_directory() . '/style.css' );
$functions_source = file_get_contents( get_template_directory() . '/functions.php' );
$weather_source   = file_get_contents( get_template_directory() . '/inc/weather.php' );
$site_js_source   = file_get_contents( get_template_directory() . '/assets/js/site.js' );
$footer_source    = file_get_contents( get_template_directory() . '/footer.php' );
$front_source     = file_get_contents( get_template_directory() . '/front-page.php' );
$style_version    = '';
$constant_version = '';

if (
	false === strpos( $style_source, 'html body .wp-dark-mode-floating-switch.wp-dark-mode-ignore' ) ||
	false === strpos( $style_source, 'left: 18px !important;' ) ||
	false !== strpos( $style_source, 'bottom: 86px !important;' )
) {
	$errors[] = 'style.css: Light/Dark-bryteren skal være synlig nederst til venstre';
}

if (
	false === strpos( $front_source, '<h1 class="screen-reader-text">Bodø Modellflyklubb' ) ||
	false === strpos( $front_source, '<h2 class="intro-copy__title">Mange drømmer om å fly.' ) ||
	strpos( $front_source, '<h1 class="screen-reader-text">' ) > strpos( $front_source, '<h2 id="facebook-hub-title">' )
) {
	$errors[] = 'front-page.php: hovedoverskriften må komme før Facebook-seksjonens H2';
}

foreach ( array( 'api.met.no', 'lat=67.3003', 'lat=67.3150', 'altitude=366', 'aviationweather.gov', 'ids=ENBO', 'embeddablePage/show/8cead75f6eca41bd84ecc89fa8a34070/slim' ) as $required_weather_setting ) {
	if ( false === strpos( $functions_source, $required_weather_setting ) ) {
		$errors[] = 'functions.php: den åpne værkilden mangler ' . $required_weather_setting;
	}
}

foreach ( array( '.field-weather', '.field-weather__station--metar', '.field-weather__live-link', '--weather-direction', 'grid-template-columns: repeat(3, minmax(0, 1fr));' ) as $required_weather_style ) {
	if ( false === strpos( $style_source, $required_weather_style ) ) {
		$errors[] = 'style.css: det responsive værpanelet mangler ' . $required_weather_style;
	}
}

foreach ( array( 'wp_remote_get', 'get_transient', 'set_transient', 'BMFK-Weather/', 'bmfk_weather_get_keiservarden_forecast', 'next_1_hours', 'precipitation_amount', 'temperature', '0.514444', 'Europe/Oslo', 'bmfk_weather_stations_html', 'register_rest_route', 'Cache-Control' ) as $required_weather_code ) {
	if ( false === strpos( $weather_source, $required_weather_code ) ) {
		$errors[] = 'inc/weather.php: serverhenting eller mellomlagring mangler ' . $required_weather_code;
	}
}

foreach ( array( '[data-weather-panel]', '[data-weather-stations]', 'weatherEndpoint', "searchParams.set('_', String(Date.now()))", '5 * 60 * 1000' ) as $required_weather_refresh ) {
	if ( false === strpos( $site_js_source, $required_weather_refresh ) ) {
		$errors[] = 'site.js: automatisk væroppdatering mangler ' . $required_weather_refresh;
	}
}

if (
	false === strpos( $front_source, 'Bodø-vinden' ) ||
	false === strpos( $front_source, 'Bestemorenga og Keiservarden' ) ||
	false === strpos( $front_source, 'faktisk METAR-måling' ) ||
	false === strpos( $weather_source, 'Nedbør 1 t.' ) ||
	false === strpos( $front_source, 'Faktisk Bestemorenga-måling' ) ||
	false === strpos( $front_source, 'data-weather-panel' ) ||
	false === strpos( $front_source, 'data-weather-endpoint' ) ||
	false === strpos( $front_source, 'data-weather-stations' ) ||
	false !== strpos( $front_source, 'Åpne værdata · test' ) ||
	false !== strpos( $front_source, 'Tre lokale referanser. Ingen iframe.' ) ||
	false !== stripos( $front_source, '<iframe' ) ||
	false !== stripos( $front_source, 'WindNerd' ) ||
	false !== stripos( $front_source, 'Holfuy' ) ||
	false !== stripos( $functions_source, 'WindNerd' ) ||
	false !== stripos( $functions_source, 'Holfuy' )
) {
	$errors[] = 'front-page.php: åpent værpanel, tydelig kildetype eller iframe-opprydding mangler';
}

foreach ( array(
	'<h3>Medlem i BMFK og NLF</h3>',
	'<h4>Hvem kan fly?</h4>',
	'<h4>Når du flyr</h4>',
) as $required_heading ) {
	if ( false === strpos( $rules_html, $required_heading ) ) {
		$errors[] = 'flyplassregler.md: mangler semantisk overskrift ' . $required_heading;
	}
}

foreach ( array(
	'<h3>Bodø Modellflyklubb</h3>',
	'<h4>Før og under flyging</h4>',
	'<h3>Medlemsgruppen</h3>',
) as $required_heading ) {
	if ( false === strpos( $new_member_html, $required_heading ) ) {
		$errors[] = 'nytt-medlem.md: mangler semantisk overskrift ' . $required_heading;
	}
}

$config_directory = get_template_directory() . '/assets/config';
$processor_source = file_get_contents( $config_directory . '/webcam-processor.php.txt' );
$htaccess_source  = file_get_contents( $config_directory . '/webcam-protection.htaccess.txt' );

foreach ( array( 'minimumFileAge', 'LOCK_EX | LOCK_NB', 'hasCompleteJpegEnding', 'webcam-processing.jpg' ) as $required_code ) {
	if ( false === strpos( $processor_source, $required_code ) ) {
		$errors[] = 'webcam-processor.php.txt: mangler ' . $required_code;
	}
}

if ( false === strpos( $htaccess_source, 'Options -Indexes' ) || false === strpos( $htaccess_source, 'Require all denied' ) ) {
	$errors[] = 'webcam-protection.htaccess.txt: mangler katalog- eller bildebeskyttelse';
}

$readme_source     = file_get_contents( dirname( __DIR__ ) . '/README.md' );
$install_source    = file_get_contents( dirname( __DIR__ ) . '/docs/INSTALLASJON.md' );
$extensions_source = file_get_contents( dirname( __DIR__ ) . '/docs/UTVIDELSESPLAN.md' );

foreach ( array( 'WP Dark Mode', 'Email Address Encoder', 'SuperPWA', 'Complianz', 'Really Simple Security' ) as $extension_name ) {
	if (
		false === strpos( $readme_source, $extension_name ) ||
		false === strpos( $install_source, $extension_name ) ||
		false === strpos( $extensions_source, $extension_name )
	) {
		$errors[] = 'Dokumentasjonen mangler aktiv utvidelse: ' . $extension_name;
	}
}

if ( ! preg_match( '/^Version:\s*([0-9]+\.[0-9]+\.[0-9]+)$/m', $style_source, $style_match ) ) {
	$errors[] = 'style.css: mangler gyldig temanummer';
} else {
	$style_version = $style_match[1];
}

if ( ! preg_match( "/define\(\s*'BMFK_THEME_VERSION',\s*'([0-9]+\.[0-9]+\.[0-9]+)'\s*\)/", $functions_source, $constant_match ) ) {
	$errors[] = 'functions.php: mangler BMFK_THEME_VERSION';
} else {
	$constant_version = $constant_match[1];
}

if ( $style_version && $constant_version && $style_version !== $constant_version ) {
	$errors[] = 'Versjonen i style.css og BMFK_THEME_VERSION er forskjellige';
}

if ( false === strpos( $footer_source, 'Nettsideversjon' ) || false === strpos( $footer_source, 'BMFK_THEME_VERSION' ) ) {
	$errors[] = 'footer.php: mangler automatisk nettsideversjon';
}

if ( $errors ) {
	fwrite( STDERR, implode( PHP_EOL, $errors ) . PHP_EOL );
	exit( 1 );
}

echo "Git-innhold OK\n";
