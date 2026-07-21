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

$new_member_html = bmfk_git_page_content( 'nytt-medlem' );
foreach ( array( 'Min idrett', 'TMS', 'Ansvarsforsikring', 'Operatørregistrering', 'OBSREG', '993 764 299' ) as $required_text ) {
	if ( false === strpos( $new_member_html, $required_text ) ) {
		$errors[] = 'nytt-medlem.md: mangler ' . $required_text;
	}
}

if ( false === strpos( $new_member_html, 'velkommen-som-medlem-2026.pdf' ) ) {
	$errors[] = 'nytt-medlem.md: mangler lenke til den oppdaterte velkomstguiden';
}

if ( false === strpos( $new_member_html, 'i ytterkanten av femkilometersonen rundt Bodø lufthavn' ) ) {
	$errors[] = 'nytt-medlem.md: mangler presis beskrivelse av femkilometersonen';
}

if ( $errors ) {
	fwrite( STDERR, implode( PHP_EOL, $errors ) . PHP_EOL );
	exit( 1 );
}

echo "Git-innhold OK\n";
