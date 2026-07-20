<?php
/**
 * Privacy-conscious delivery of the Bestemorenga webcam image.
 *
 * @package BMFK
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the local source file used by the webcam endpoint.
 *
 * Define BMFK_WEBCAM_SOURCE_PATH in wp-config.php to override the default.
 * The filesystem path is never included in the public page markup.
 *
 * @return string
 */
function bmfk_webcam_source_path() {
	if ( defined( 'BMFK_WEBCAM_SOURCE_PATH' ) && BMFK_WEBCAM_SOURCE_PATH ) {
		return (string) BMFK_WEBCAM_SOURCE_PATH;
	}

	return trailingslashit( ABSPATH ) . 'webcam/webcam.jpg';
}

/**
 * Return the public WordPress endpoint used by the front page.
 *
 * @return string
 */
function bmfk_webcam_image_url() {
	return add_query_arg( 'bmfk_webcam', '1', home_url( '/' ) );
}

/**
 * End a failed webcam request without exposing the source path.
 *
 * @param int $status HTTP status code.
 */
function bmfk_webcam_error( $status ) {
	status_header( $status );
	header( 'Cache-Control: no-store, no-cache, must-revalidate, max-age=0' );
	header( 'X-Robots-Tag: noindex, nofollow, noarchive, noimageindex', true );
	header( 'X-Content-Type-Options: nosniff' );
	exit;
}

/**
 * Stream the webcam image through WordPress.
 *
 * The endpoint accepts only same-site POST requests with a valid WordPress
 * nonce. It also disables caching, search indexing and third-party embedding.
 * Direct HTTP access to /webcam/webcam.jpg can therefore be denied after this
 * endpoint has been verified on the web hotel.
 */
function bmfk_serve_webcam_image() {
	if ( ! isset( $_GET['bmfk_webcam'] ) || '1' !== sanitize_text_field( wp_unslash( $_GET['bmfk_webcam'] ) ) ) {
		return;
	}

	$method = isset( $_SERVER['REQUEST_METHOD'] ) ? strtoupper( sanitize_text_field( wp_unslash( $_SERVER['REQUEST_METHOD'] ) ) ) : 'GET';
	if ( 'POST' !== $method ) {
		bmfk_webcam_error( 404 );
	}

	$nonce = isset( $_POST['bmfk_webcam_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['bmfk_webcam_nonce'] ) ) : '';
	if ( ! wp_verify_nonce( $nonce, 'bmfk_webcam_image' ) ) {
		bmfk_webcam_error( 403 );
	}

	$source = realpath( bmfk_webcam_source_path() );
	if ( ! $source || ! is_file( $source ) || ! is_readable( $source ) ) {
		bmfk_webcam_error( 404 );
	}

	$image_info = @getimagesize( $source ); // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged -- Invalid files must return a generic 404.
	if ( ! $image_info || IMAGETYPE_JPEG !== $image_info[2] ) {
		bmfk_webcam_error( 404 );
	}

	$file_size = filesize( $source );
	if ( false === $file_size || $file_size > 10 * MB_IN_BYTES ) {
		bmfk_webcam_error( 404 );
	}

	while ( ob_get_level() ) {
		ob_end_clean();
	}

	status_header( 200 );
	header( 'Content-Type: image/jpeg' );
	header( 'Content-Length: ' . (string) $file_size );
	header( 'Content-Disposition: inline; filename="bestemorenga-webkamera.jpg"' );
	header( 'Cache-Control: no-store, no-cache, must-revalidate, max-age=0' );
	header( 'Pragma: no-cache' );
	header( 'Expires: 0' );
	header( 'X-Robots-Tag: noindex, nofollow, noarchive, noimageindex', true );
	header( 'X-Content-Type-Options: nosniff' );
	header( 'Cross-Origin-Resource-Policy: same-origin' );

	readfile( $source ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_readfile -- Binary streaming is intentional.

	exit;
}
add_action( 'template_redirect', 'bmfk_serve_webcam_image', 0 );
