<?php
/**
 * Lightweight member password gate for the Avinor agreement.
 *
 * The agreement itself remains a public theme asset. This gate is intended as
 * a practical, shared-password barrier for club members, not as a replacement
 * for individual user accounts or access-controlled file storage.
 *
 * @package BMFK
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the stored one-way password hash.
 *
 * @return string
 */
function bmfk_avinor_password_hash() {
	return (string) get_option( 'bmfk_avinor_password_hash', '' );
}

/**
 * Return the cookie name used to remember approved browsers.
 *
 * @return string
 */
function bmfk_avinor_access_cookie_name() {
	return 'bmfk_avinor_access';
}

/**
 * Build a signed browser token tied to the current password hash.
 *
 * Changing or removing the password therefore invalidates all old tokens.
 *
 * @return string
 */
function bmfk_avinor_access_token() {
	$password_hash = bmfk_avinor_password_hash();

	if ( '' === $password_hash ) {
		return '';
	}

	return wp_hash( 'bmfk_avinor_access|' . $password_hash, 'auth' );
}

/**
 * Determine whether the current request already has access.
 *
 * Administrators may verify the result without entering the shared password.
 *
 * @return bool
 */
function bmfk_avinor_access_granted() {
	if ( current_user_can( 'manage_options' ) ) {
		return true;
	}

	$expected_token = bmfk_avinor_access_token();
	if ( '' === $expected_token || empty( $_COOKIE[ bmfk_avinor_access_cookie_name() ] ) ) {
		return false;
	}

	$cookie_token = sanitize_text_field( wp_unslash( $_COOKIE[ bmfk_avinor_access_cookie_name() ] ) );

	return hash_equals( $expected_token, $cookie_token );
}

/**
 * Remember access in the browser for 30 days.
 *
 * @return void
 */
function bmfk_remember_avinor_access() {
	$token = bmfk_avinor_access_token();
	if ( '' === $token || headers_sent() ) {
		return;
	}

	$cookie_name = bmfk_avinor_access_cookie_name();
	$expires     = time() + ( 30 * DAY_IN_SECONDS );
	$domain      = defined( 'COOKIE_DOMAIN' ) && COOKIE_DOMAIN ? COOKIE_DOMAIN : '';

	setcookie(
		$cookie_name,
		$token,
		array(
			'expires'  => $expires,
			'path'     => '/',
			'domain'   => $domain,
			'secure'   => is_ssl(),
			'httponly' => true,
			'samesite' => 'Lax',
		)
	);

	$_COOKIE[ $cookie_name ] = $token;
}

/**
 * Return the agreement URL only from server-side code.
 *
 * @return string
 */
function bmfk_avinor_agreement_url() {
	return bmfk_asset_url( 'documents/avinor-bestemorenga-avtale-2026.pdf' );
}

/**
 * Render the cache-safe access panel inserted by the Markdown renderer.
 *
 * The initial HTML never contains the PDF URL. JavaScript asks WordPress for
 * the URL after the shared password or remembered browser token is verified.
 *
 * @return string
 */
function bmfk_avinor_agreement_gate() {
	ob_start();
	?>
	<section
		id="avinor-avtale"
		class="bmfk-document-gate wp-dark-mode-ignore"
		data-bmfk-document-gate
		data-endpoint="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>"
	>
		<div class="bmfk-document-gate__intro">
			<span class="bmfk-document-gate__eyebrow"><?php esc_html_e( 'Medlemsdokument', 'bmfk' ); ?></span>
			<h3><?php esc_html_e( 'Avtale med Bodø kontrolltårn', 'bmfk' ); ?></h3>
			<p><?php esc_html_e( 'Avtalen er for klubbens medlemmer. Passord fås av styret.', 'bmfk' ); ?></p>
		</div>

		<form
			class="bmfk-document-gate__form"
			data-bmfk-document-form
			method="post"
			action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>"
			autocomplete="off"
		>
			<input type="hidden" name="action" value="bmfk_avinor_access">
			<label for="bmfk-avinor-password"><?php esc_html_e( 'Passord', 'bmfk' ); ?></label>
			<div class="bmfk-document-gate__controls">
				<input
					id="bmfk-avinor-password"
					name="password"
					type="password"
					required
					maxlength="128"
					autocomplete="current-password"
					data-bmfk-document-password
				>
				<button type="submit" data-bmfk-document-submit><?php esc_html_e( 'Lås opp', 'bmfk' ); ?></button>
			</div>
			<p class="bmfk-document-gate__status" data-bmfk-document-status aria-live="polite"></p>
		</form>

		<div class="bmfk-document-gate__unlocked" data-bmfk-document-unlocked hidden>
			<p><?php esc_html_e( 'Tilgang godkjent. Avtalen er klar til å åpnes.', 'bmfk' ); ?></p>
			<a
				class="bmfk-document-gate__link"
				data-bmfk-document-link
				href="#"
				target="_blank"
				rel="noopener noreferrer"
			><?php esc_html_e( 'Åpne avtalen med Bodø kontrolltårn (PDF)', 'bmfk' ); ?></a>
		</div>
	</section>
	<?php

	return (string) ob_get_clean();
}

/**
 * Verify the shared password and return the agreement URL.
 *
 * This endpoint is deliberately POST-only and disables caching. A status
 * request without a password is also used to restore remembered access.
 *
 * @return void
 */
function bmfk_ajax_avinor_access() {
	nocache_headers();

	if ( 'POST' !== strtoupper( isset( $_SERVER['REQUEST_METHOD'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_METHOD'] ) ) : '' ) ) {
		wp_send_json_error(
			array(
				'code'    => 'method_not_allowed',
				'message' => __( 'Ugyldig forespørsel.', 'bmfk' ),
			),
			405
		);
	}

	$password_hash = bmfk_avinor_password_hash();
	if ( '' === $password_hash ) {
		wp_send_json_error(
			array(
				'code'    => 'not_configured',
				'message' => __( 'Passordtilgangen er ikke konfigurert ennå. Kontakt styret.', 'bmfk' ),
			),
			503
		);
	}

	if ( bmfk_avinor_access_granted() ) {
		wp_send_json_success(
			array(
				'url' => bmfk_avinor_agreement_url(),
			)
		);
	}

	$password = isset( $_POST['password'] ) ? trim( (string) wp_unslash( $_POST['password'] ) ) : '';
	if ( '' === $password ) {
		wp_send_json_error(
			array(
				'code'    => 'locked',
				'message' => '',
			),
			401
		);
	}

	if ( strlen( $password ) > 128 || ! wp_check_password( $password, $password_hash ) ) {
		wp_send_json_error(
			array(
				'code'    => 'incorrect',
				'message' => __( 'Feil passord. Prøv på nytt.', 'bmfk' ),
			),
			403
		);
	}

	bmfk_remember_avinor_access();
	wp_send_json_success(
		array(
			'url' => bmfk_avinor_agreement_url(),
		)
	);
}
add_action( 'wp_ajax_bmfk_avinor_access', 'bmfk_ajax_avinor_access' );
add_action( 'wp_ajax_nopriv_bmfk_avinor_access', 'bmfk_ajax_avinor_access' );

/**
 * Register the password administration page below Appearance.
 *
 * @return void
 */
function bmfk_register_document_access_page() {
	add_theme_page(
		__( 'BMFK dokumenttilgang', 'bmfk' ),
		__( 'Dokumenttilgang', 'bmfk' ),
		'manage_options',
		'bmfk-document-access',
		'bmfk_render_document_access_page'
	);
}
add_action( 'admin_menu', 'bmfk_register_document_access_page' );

/**
 * Redirect back to the settings page with a status notice.
 *
 * @param string $notice Notice code.
 * @return void
 */
function bmfk_document_access_redirect( $notice ) {
	$url = add_query_arg(
		array(
			'page'               => 'bmfk-document-access',
			'bmfk_access_notice' => sanitize_key( $notice ),
		),
		admin_url( 'themes.php' )
	);

	wp_safe_redirect( $url );
	exit;
}

/**
 * Save or remove the shared password.
 *
 * Only the one-way hash is stored. The password is never written to the theme,
 * Git repository or an administrator notice.
 *
 * @return void
 */
function bmfk_save_document_access_password() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die(
			esc_html__( 'Du har ikke tilgang til denne innstillingen.', 'bmfk' ),
			esc_html__( 'Ingen tilgang', 'bmfk' ),
			array( 'response' => 403 )
		);
	}

	check_admin_referer( 'bmfk_save_document_access_password' );

	$operation = isset( $_POST['bmfk_operation'] ) ? sanitize_key( wp_unslash( $_POST['bmfk_operation'] ) ) : 'save';
	if ( 'remove' === $operation ) {
		delete_option( 'bmfk_avinor_password_hash' );
		bmfk_document_access_redirect( 'removed' );
	}

	$password     = isset( $_POST['bmfk_avinor_password'] ) ? trim( (string) wp_unslash( $_POST['bmfk_avinor_password'] ) ) : '';
	$confirmation = isset( $_POST['bmfk_avinor_password_confirm'] ) ? trim( (string) wp_unslash( $_POST['bmfk_avinor_password_confirm'] ) ) : '';

	if ( strlen( $password ) < 6 || strlen( $password ) > 128 ) {
		bmfk_document_access_redirect( 'length' );
	}

	if ( ! hash_equals( $password, $confirmation ) ) {
		bmfk_document_access_redirect( 'mismatch' );
	}

	update_option( 'bmfk_avinor_password_hash', wp_hash_password( $password ), false );
	bmfk_document_access_redirect( 'updated' );
}
add_action( 'admin_post_bmfk_save_document_access_password', 'bmfk_save_document_access_password' );

/**
 * Render the administrator-facing password page.
 *
 * @return void
 */
function bmfk_render_document_access_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$notice       = isset( $_GET['bmfk_access_notice'] ) ? sanitize_key( wp_unslash( $_GET['bmfk_access_notice'] ) ) : '';
	$is_configured = '' !== bmfk_avinor_password_hash();
	$messages     = array(
		'updated'  => array( 'success', __( 'Passordet er lagret. Tidligere godkjenninger er nå ugyldige.', 'bmfk' ) ),
		'removed'  => array( 'success', __( 'Passordet er fjernet. Avtalen kan ikke låses opp før et nytt passord er satt.', 'bmfk' ) ),
		'length'   => array( 'error', __( 'Passordet må inneholde mellom 6 og 128 tegn.', 'bmfk' ) ),
		'mismatch' => array( 'error', __( 'Passordene var ikke like. Prøv på nytt.', 'bmfk' ) ),
	);
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'BMFK dokumenttilgang', 'bmfk' ); ?></h1>

		<?php if ( isset( $messages[ $notice ] ) ) : ?>
			<div class="notice notice-<?php echo esc_attr( $messages[ $notice ][0] ); ?> is-dismissible">
				<p><?php echo esc_html( $messages[ $notice ][1] ); ?></p>
			</div>
		<?php endif; ?>

		<p><?php esc_html_e( 'Her setter du medlemspassordet som låser opp Avinor-avtalen på Flyplassregler-siden.', 'bmfk' ); ?></p>
		<p>
			<strong><?php esc_html_e( 'Status:', 'bmfk' ); ?></strong>
			<?php echo $is_configured ? esc_html__( 'Passord er konfigurert.', 'bmfk' ) : esc_html__( 'Passord er ikke konfigurert.', 'bmfk' ); ?>
		</p>
		<p class="description"><?php esc_html_e( 'Passordet lagres som en enveis hash og kan ikke vises senere. Skriv inn et nytt passord for å bytte det.', 'bmfk' ); ?></p>

		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" autocomplete="off">
			<input type="hidden" name="action" value="bmfk_save_document_access_password">
			<input type="hidden" name="bmfk_operation" value="save">
			<?php wp_nonce_field( 'bmfk_save_document_access_password' ); ?>

			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="bmfk-avinor-password-admin"><?php esc_html_e( 'Nytt medlemspassord', 'bmfk' ); ?></label></th>
					<td>
						<input id="bmfk-avinor-password-admin" class="regular-text" name="bmfk_avinor_password" type="password" minlength="6" maxlength="128" required autocomplete="new-password">
						<p class="description"><?php esc_html_e( 'Bruk minst seks tegn. Del passordet kun med klubbens medlemmer.', 'bmfk' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="bmfk-avinor-password-confirm"><?php esc_html_e( 'Gjenta passordet', 'bmfk' ); ?></label></th>
					<td><input id="bmfk-avinor-password-confirm" class="regular-text" name="bmfk_avinor_password_confirm" type="password" minlength="6" maxlength="128" required autocomplete="new-password"></td>
				</tr>
			</table>

			<?php submit_button( $is_configured ? __( 'Bytt passord', 'bmfk' ) : __( 'Lagre passord', 'bmfk' ) ); ?>
		</form>

		<?php if ( $is_configured ) : ?>
			<hr>
			<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<input type="hidden" name="action" value="bmfk_save_document_access_password">
				<input type="hidden" name="bmfk_operation" value="remove">
				<?php wp_nonce_field( 'bmfk_save_document_access_password' ); ?>
				<?php submit_button( __( 'Fjern passordtilgang', 'bmfk' ), 'secondary', 'submit', false, array( 'onclick' => "return confirm('" . esc_js( __( 'Vil du fjerne passordet?', 'bmfk' ) ) . "');" ) ); ?>
			</form>
		<?php endif; ?>

		<p><a href="<?php echo esc_url( home_url( '/flyplassregler/#avinor-avtale' ) ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Åpne Flyplassregler for å teste', 'bmfk' ); ?></a></p>
	</div>
	<?php
}
