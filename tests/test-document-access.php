<?php
/**
 * Lightweight runtime test for the shared document password panels.
 */

define( 'ABSPATH', __DIR__ );
define( 'DAY_IN_SECONDS', 86400 );

function get_option( $key, $default = '' ) {
	return $default;
}

function bmfk_asset_url( $path ) {
	return 'https://example.com/theme/assets/' . ltrim( $path, '/' );
}

function sanitize_key( $value ) {
	return preg_replace( '/[^a-z0-9_-]/', '', strtolower( (string) $value ) );
}

function sanitize_html_class( $value ) {
	return sanitize_key( $value );
}

function sanitize_text_field( $value ) {
	return trim( (string) $value );
}

function wp_unslash( $value ) {
	return $value;
}

function wp_parse_args( $args, $defaults = array() ) {
	return array_merge( $defaults, $args );
}

function wp_hash( $value, $scheme = 'auth' ) {
	return hash( 'sha256', $scheme . '|' . $value );
}

function current_user_can() {
	return false;
}

function is_ssl() {
	return true;
}

function __( $text ) {
	return $text;
}

function esc_html( $text ) {
	return htmlspecialchars( (string) $text, ENT_QUOTES, 'UTF-8' );
}

function esc_html_e( $text ) {
	echo esc_html( $text );
}

function esc_attr( $text ) {
	return htmlspecialchars( (string) $text, ENT_QUOTES, 'UTF-8' );
}

function esc_url( $url ) {
	return filter_var( $url, FILTER_SANITIZE_URL );
}

function admin_url( $path = '' ) {
	return 'https://example.com/wp-admin/' . ltrim( $path, '/' );
}

function add_action() {}

require dirname( __DIR__ ) . '/themes/bodomfk-modern-theme/inc/document-access.php';

$errors = array();

$expected_documents = array(
	'avinor'     => 'avinor-bestemorenga-avtale-2026.pdf',
	'rules-2018' => 'flyplass-og-sikkerhetsregler-2018.pdf',
);

foreach ( $expected_documents as $document => $filename ) {
	$url = bmfk_protected_document_url( $document );
	if ( false === strpos( $url, $filename ) ) {
		$errors[] = 'Dokumentregisteret mangler ' . $document;
	}
}

if ( '' !== bmfk_protected_document_url( 'unknown-document' ) ) {
	$errors[] = 'Dokumentregisteret tillater et ukjent dokument';
}

$avinor_gate = bmfk_avinor_agreement_gate();
if ( false === strpos( $avinor_gate, 'data-document="avinor"' ) || false === strpos( $avinor_gate, 'id="avinor-avtale"' ) ) {
	$errors[] = 'Avinor-panelet mangler riktig dokument-ID';
}
if ( false !== strpos( $avinor_gate, 'avinor-bestemorenga-avtale-2026.pdf' ) ) {
	$errors[] = 'Avinor-panelet eksponerer PDF-lenken i låst HTML';
}

$historical_gate = bmfk_historical_rules_gate();
if ( false === strpos( $historical_gate, 'data-document="rules-2018"' ) || false === strpos( $historical_gate, 'id="historiske-regler-2018"' ) ) {
	$errors[] = '2018-panelet mangler riktig dokument-ID';
}
if ( false === strpos( $historical_gate, 'Bruk samme passord som for Avinor-avtalen.' ) ) {
	$errors[] = '2018-panelet forklarer ikke at passordet er felles';
}
if ( false !== strpos( $historical_gate, 'flyplass-og-sikkerhetsregler-2018.pdf' ) ) {
	$errors[] = '2018-panelet eksponerer PDF-lenken i låst HTML';
}

$site_js = file_get_contents( dirname( __DIR__ ) . '/themes/bodomfk-modern-theme/assets/js/site.js' );
foreach ( array(
	"body.set('document', documentId)",
	'bmfk:document-access-granted',
) as $required_javascript ) {
	if ( false === strpos( $site_js, $required_javascript ) ) {
		$errors[] = 'site.js mangler dokumentportlogikk: ' . $required_javascript;
	}
}

if ( $errors ) {
	fwrite( STDERR, implode( PHP_EOL, $errors ) . PHP_EOL );
	exit( 1 );
}

echo "Dokumenttilgang OK\n";
