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

if ( false === strpos( $new_member_html, 'velkommen-som-medlem-2026.pdf' ) ) {
	$errors[] = 'nytt-medlem.md: mangler lenke til den oppdaterte velkomstguiden';
}

if ( false === strpos( $new_member_html, 'rett utenfor femkilometersonen rundt Bodø lufthavn' ) ) {
	$errors[] = 'nytt-medlem.md: mangler presis beskrivelse av femkilometersonen';
}

if ( false === strpos( $new_member_html, 'Flyging vest for rullebanen kan likevel berøre sonen' ) ) {
	$errors[] = 'nytt-medlem.md: mangler forklaring om flyging vest for rullebanen';
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

if ( $errors ) {
	fwrite( STDERR, implode( PHP_EOL, $errors ) . PHP_EOL );
	exit( 1 );
}

echo "Git-innhold OK\n";
