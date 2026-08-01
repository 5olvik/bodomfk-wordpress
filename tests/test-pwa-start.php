<?php
/**
 * Lightweight runtime test for the SuperPWA camera start integration.
 */

define( 'ABSPATH', __DIR__ );

$filters          = array();
$actions          = array();
$options          = array();
$manifest_updates = 0;

function add_filter( $hook, $callback, $priority = 10 ) {
	global $filters;
	$filters[ $hook ] = array( $callback, $priority );
}

function add_action( $hook, $callback, $priority = 10 ) {
	global $actions;
	$actions[ $hook ] = array( $callback, $priority );
}

function home_url( $path = '/' ) {
	return 'https://example.com' . '/' . ltrim( $path, '/' );
}

function get_option( $key, $default = false ) {
	global $options;
	return array_key_exists( $key, $options ) ? $options[ $key ] : $default;
}

function update_option( $key, $value, $autoload = null ) {
	global $options;
	$options[ $key ] = $value;
	return true;
}

function superpwa_generate_manifest() {
	global $manifest_updates;
	$manifest_updates++;
}

require dirname( __DIR__ ) . '/themes/bodomfk-modern-theme/inc/pwa.php';

$errors = array();

if ( 'https://example.com/?bmfk_pwa=webkamera' !== bmfk_superpwa_start_url( 'https://example.com/' ) ) {
	$errors[] = 'Startadressen peker ikke til den robuste webkameraruten.';
}

if ( ! isset( $filters['superpwa_manifest_start_url'] ) || array( 'bmfk_superpwa_start_url', 10000 ) !== $filters['superpwa_manifest_start_url'] ) {
	$errors[] = 'SuperPWA-filteret er ikke registrert med forventet prioritet.';
}

if ( ! isset( $actions['admin_init'] ) || array( 'bmfk_activate_superpwa_camera_start', 30 ) !== $actions['admin_init'] ) {
	$errors[] = 'Aktiveringsoppgaven for manifestet er ikke registrert.';
}

bmfk_activate_superpwa_camera_start();
bmfk_activate_superpwa_camera_start();

if ( 1 !== $manifest_updates ) {
	$errors[] = 'Manifestet skal bygges nøyaktig én gang for versjon 1.6.13.';
}

if ( '1.6.13' !== get_option( 'bmfk_superpwa_camera_start_version' ) ) {
	$errors[] = 'Versjonen for PWA-starten ble ikke lagret.';
}

if ( $errors ) {
	fwrite( STDERR, implode( PHP_EOL, $errors ) . PHP_EOL );
	exit( 1 );
}

echo "PWA-starten peker robust til webkameraet.\n";
