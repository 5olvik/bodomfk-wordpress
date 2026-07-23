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
	return '<section data-bmfk-document-gate>Avtalen er for klubbens medlemmer.</section>';
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
if ( false === strpos( $rules_html, 'flyplass-og-sikkerhetsregler-2018.pdf' ) || false === strpos( $rules_html, 'Historisk dokument fra 2018' ) ) {
	$errors[] = 'flyplassregler.md: mangler tydelig merket historisk PDF fra 2018';
}

if ( false === strpos( $rules_html, 'data-bmfk-document-gate' ) ) {
	$errors[] = 'flyplassregler.md: mangler passordpanelet for Avinor-avtalen';
}

if ( false !== strpos( $rules_html, 'avinor-bestemorenga-avtale-2026.pdf' ) ) {
	$errors[] = 'flyplassregler.md: eksponerer Avinor-lenken før passordkontroll';
}

foreach ( array(
	'Medlem i BMFK og NLF',
	'Ikke medlem i NLF',
	'A1/A3-kompetanse fra flydrone.no er ikke nødvendig',
	'Operatørregistrering og pilotkompetanse er to forskjellige krav',
	'rett utenfor femkilometersonen rundt Bodø lufthavn',
	'Flyging vest for rullebanen kan likevel berøre sonen',
	'i regi av Bodø Modellflyklubb og under NLFs sikkerhetssystem',
	'Særskilt for FPV',
	'sjekkliste-fpv',
	'ta-teoriprove-for-fpv',
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
	'FPV - sjekkliste og teoriprøve',
	'sjekkliste-fpv',
	'ta-teoriprove-for-fpv',
) as $required_text ) {
	if ( false === strpos( $new_member_html, $required_text ) ) {
		$errors[] = 'nytt-medlem.md: mangler regelverksforklaring: ' . $required_text;
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
