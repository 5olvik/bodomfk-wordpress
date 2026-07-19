<?php
/**
 * Plugin Name: BMFK Modern – oppsett og opprydding
 * Description: Flytter Bodø Modellflyklubb bort fra SiteOrigin/Ultimate Member, arkiverer gamle innloggingssider og hjelper med kontrollert deaktivering av gamle utvidelser.
 * Version: 1.3.0
 * Author: Bodø Modellflyklubb
 * Requires at least: 6.4
 * Requires PHP: 7.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BMFK_SETUP_VERSION', '1.3.0' );

function bmfk_setup_admin_menu() {
	add_management_page(
		'BMFK modernisering',
		'BMFK modernisering',
		'manage_options',
		'bmfk-modernisering',
		'bmfk_setup_render_page'
	);
}
add_action( 'admin_menu', 'bmfk_setup_admin_menu' );

function bmfk_setup_legacy_plugins() {
	return array(
		'gp-premium/gp-premium.php'                                  => array( 'GP Premium', 'Erstattes av det selvstendige BMFK-temaet.', true ),
		'siteorigin-panels/siteorigin-panels.php'                    => array( 'SiteOrigin Page Builder', 'Forsiden og relevante sider er flyttet til temaet/WordPress-kjernen.', true ),
		'so-widgets-bundle/so-widgets-bundle.php'                    => array( 'SiteOrigin Widgets Bundle', 'Var støttepakke for den gamle sidebyggeren.', true ),
		'ultimate-member/ultimate-member.php'                        => array( 'Ultimate Member', 'De offentlige medlemssidene med innlogging er ikke lenger i bruk.', true ),
		'um-online/um-online.php'                                    => array( 'Ultimate Member – Online', 'Tillegg til den utgåtte innloggingsløsningen.', true ),
		'um-recaptcha/um-recaptcha.php'                              => array( 'Ultimate Member – reCAPTCHA', 'Tillegg til den utgåtte innloggingsløsningen.', true ),
		'classic-editor/classic-editor.php'                          => array( 'Classic Editor', 'Nye sider er laget for WordPress blokkredigering.', true ),
		'disable-comments/disable-comments.php'                      => array( 'Disable Comments', 'Oppsettet lukker kommentarer med WordPress-kjernen.', true ),
		'photo-gallery/photo-gallery.php'                            => array( 'Photo Gallery', 'Galleriet er bygget inn uten egen galleriutvidelse.', true ),
		'easy-video-player/easy-video-player.php'                    => array( 'Easy Video Player', 'Ingen aktive offentlige sider trenger avspilleren.', true ),
		'wp-dark-mode/plugin.php'                                    => array( 'WP Dark Mode', 'Beholdes: gir besøkende et godt valg mellom Light og Dark.', false ),
		'wp-maintenance-mode/wp-maintenance-mode.php'                => array( 'Maintenance Mode', 'Kan fjernes når lanseringen er ferdig.', true ),
		'jetpack/jetpack.php'                                        => array( 'Jetpack', 'Det nye temaet bruker ikke Jetpack-galleri eller presentasjonsfunksjoner.', true ),
		'email-address-encoder/email-address-encoder.php'            => array( 'Email Address Encoder', 'Beholdes: beskytter klubbens e-postadresser i sideinnhold og bunntekst.', false ),
		'disable-auto-update-email-notifications/disable-auto-update-email-notifications.php' => array( 'Disable auto-update emails', 'Lite hjelpeplugin som kan erstattes av normal WordPress-drift.', true ),
		'burst-statistics/burst.php'                                 => array( 'Burst Statistics', 'Valgfri statistikk; fjern for en enklere og mer personvernvennlig side.', true ),
		'ninja-forms/ninja-forms.php'                                => array( 'Ninja Forms', 'Kontakt skjer via e-post/Facebook og offentlig kontaktside bruker ikke skjema.', true ),
		'complianz-gdpr/complianz-gpdr.php'                          => array( 'Complianz GDPR', 'Vurder etter at statistikk og tredjepartsinnbygginger er borte. Ikke forhåndsvalgt.', false ),
		'really-simple-ssl/rlrsssl-really-simple-ssl.php'            => array( 'Really Simple SSL', 'Behold til HTTPS og omdirigering er verifisert uten plugin.', false ),
		'duplicator/duplicator.php'                                  => array( 'Duplicator', 'Behold til ny side er lansert og en fersk sikkerhetskopi er tatt.', false ),
	);
}

function bmfk_setup_airfield_agreement_url() {
	return trailingslashit( get_template_directory_uri() ) . 'assets/documents/avinor-bestemorenga-avtale-2026.pdf';
}

function bmfk_setup_airfield_agreement_path() {
	return trailingslashit( get_template_directory() ) . 'assets/documents/avinor-bestemorenga-avtale-2026.pdf';
}

function bmfk_setup_page_content() {
	$airfield_agreement_url = esc_url( bmfk_setup_airfield_agreement_url() );

	return array(
		'medlemsfordeler' => array(
			'title'   => 'Medlemsfordeler',
			'content' => '<!-- wp:paragraph {"fontSize":"large"} --><p class="has-large-font-size">Som medlem blir du en del av et aktivt fag- og klubbmiljø for modellfly, helikopter, droner og FPV.</p><!-- /wp:paragraph -->
<!-- wp:columns --><div class="wp-block-columns"><!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":3} --><h3>Trygg flyplass</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Tilgang til klubbens anlegg på Bestemorenga og aktivitet i organiserte, trygge rammer.</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":3} --><h3>Kunnskap og hjelp</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Erfarne piloter og instruktører som hjelper deg med modeller, radio, oppsett og flyging.</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns -->
<!-- wp:columns --><div class="wp-block-columns"><!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":3} --><h3>Ansvarsforsikring</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Medlemskap i NLF Modellflyseksjonen inkluderer ansvarsforsikring, med unntak av støttemedlemskap. Les alltid de gjeldende vilkårene hos NLF.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><a href="https://nlf.no/grener/modellfly/forsikring/sporsmal-og-svar-om-forsikring/">Les om forsikringen hos NLF →</a></p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":3} --><h3>Kompetanse</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Mulighet for strukturert opplæring og kompetansebevis for aktuell modelltype.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><a href="https://nlf.no/grener/modellfly/sikkerhet-utdanning/kompetansebevis/kompetansebevis-oversikt/">Se kompetansebevis hos NLF →</a></p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns -->
<!-- wp:quote --><blockquote class="wp-block-quote"><p>Regler og forsikringsvilkår kan endres. Kontroller alltid gjeldende informasjon hos klubben og NLF før du flyr.</p></blockquote><!-- /wp:quote -->
<!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="https://blimedlem.bodomfk.no/">Bli medlem</a></div><!-- /wp:button --></div><!-- /wp:buttons -->',
		),
		'klubbhytta' => array(
			'title'   => 'Adgang til klubbhytta',
			'content' => '<!-- wp:paragraph {"fontSize":"large"} --><p class="has-large-font-size">Klubbhytta er samlingspunktet vårt ved modellflyplassen på Bestemorenga.</p><!-- /wp:paragraph -->
<!-- wp:heading {"level":2} --><h2>Tilgang for medlemmer</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Nøkkel eller adgang til klubbhytta fås ved å kontakte styret på <a href="mailto:post@bodomfk.no">post@bodomfk.no</a>. Den registrerte ordningen har en avgift på 300 kroner via Vipps og gjelder så lenge medlemskapet er aktivt.</p><!-- /wp:paragraph -->
<!-- wp:quote --><blockquote class="wp-block-quote"><p>Kontroller pris og gjeldende adgangsrutine med styret før betaling. Tilgangen kan fjernes dersom medlemskontingenten ikke er betalt innen klubbens frist.</p></blockquote><!-- /wp:quote -->',
		),
		'kontaktoss' => array(
			'title'   => 'Kontakt oss',
			'content' => '<!-- wp:paragraph {"fontSize":"large"} --><p class="has-large-font-size">For klubbinformasjon og miljøet rundt hobbyen bruker vi to Facebook-grupper. Du kan også kontakte styret på e-post.</p><!-- /wp:paragraph -->
<!-- wp:columns --><div class="wp-block-columns"><!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":3} --><h3>Kontakt klubben</h3><!-- /wp:heading --><!-- wp:paragraph --><p><strong>Generelle henvendelser</strong><br>[encode link="mailto:post@bodomfk.no"]post@bodomfk.no[/encode]</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Fakturaer og regninger</strong><br>[encode link="mailto:faktura@bodomfk.no"]faktura@bodomfk.no[/encode]</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Facebook for medlemmer</strong><br><a href="https://www.facebook.com/groups/bodomfk">Bodø Modellflyklubb – medlemsgruppen</a></p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Offentlig Facebook-gruppe</strong><br><a href="https://www.facebook.com/groups/bodomfksalg">Kjøp, salg og åpen hobbyprat</a></p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":3} --><h3>Postadresse</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Bodø Modellflyklubb<br>Postboks 410<br>8001 Bodø</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Organisasjonsnummer</strong><br>993 764 299</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns -->
<!-- wp:heading {"level":2} --><h2>Spørsmål om NLF-medlemskap</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Har du spørsmål om registrering eller medlemskapet hos Norges Luftsportforbund, kan du kontakte <a href="https://nlf.no/">NLF direkte</a>.</p><!-- /wp:paragraph -->',
		),
		'flyplassregler' => array(
			'title'   => 'Flyplass og sikkerhet',
			'content' => '<!-- wp:paragraph {"fontSize":"large"} --><p class="has-large-font-size">Sikker flyging starter med riktig og oppdatert informasjon.</p><!-- /wp:paragraph -->
<!-- wp:heading {"level":2} --><h2>Avtale med Bodø kontrolltårn</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p><strong>Datert 26. mai 2026:</strong> Bodø kontrolltårn gir Bodø Modellflyklubb generell tillatelse til å operere på Bestemorenga modellflyplass, selv om deler av flygingen kan berøre 5 km-sonen rundt Bodø lufthavn. Tillatelsen forutsetter at aktiviteten følger Norges Luftsportforbunds regelverk i Modellflyhåndboken.</p><!-- /wp:paragraph -->
<!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="' . $airfield_agreement_url . '" target="_blank" rel="noopener">Åpne avtalen med Bodø kontrolltårn (PDF)</a></div><!-- /wp:button --></div><!-- /wp:buttons -->
<!-- wp:quote --><blockquote class="wp-block-quote"><p><strong>Viktig:</strong> Tillatelsen gjelder klubbens organiserte aktivitet ved Bestemorenga og er ikke et generelt unntak for droneflyging andre steder. Gjeldende lokale regler og Modellflyhåndboken skal alltid følges.</p></blockquote><!-- /wp:quote -->
<!-- wp:heading {"level":2} --><h2>Gjeldende kilder</h2><!-- /wp:heading -->
<!-- wp:list --><ul><li><a href="https://nlf.no/siteassets/modellfly/sikkerhet-og-utdanning/modellflyhandboka/modellflyhandboka/modellflyhandboka-v-2.2---01.06-2025.pdf">NLF Modellflyhåndboka, versjon 2.2</a></li><li><a href="https://nlf.no/grener/modellfly/sikkerhet-utdanning/kompetansebevis/kompetansebevis-oversikt/">NLF – kompetansebevis og krav</a></li><li><a href="https://www.luftfartstilsynet.no/droner/droneregler/droneregler/">Luftfartstilsynet – droneregler og modellflyging</a></li><li><a href="https://nlfmodellfly.wufoo.com/">Meld hendelse eller uhell</a></li></ul><!-- /wp:list -->
<!-- wp:heading {"level":2} --><h2>Lokale flyplassregler</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Følg alltid gjeldende oppslag og instrukser ved modellflyplassen om flysoner, pilotområde, høyde, varsling, åpningstider og lokale prosedyrer. Kontakt styret før flyging dersom noe er uklart.</p><!-- /wp:paragraph -->
<!-- wp:paragraph --><p><a href="/wp-content/uploads/2018/02/Flyplass-og-sikkerhetsregler-08.01.18.pdf">Historisk dokument: flyplass- og sikkerhetsregler fra 2018</a></p><!-- /wp:paragraph -->',
		),
		'gruppeansvarlige' => array(
			'title'   => 'Gruppeansvarlige',
			'content' => '<!-- wp:paragraph --><p>Ta kontakt med klubben dersom du er usikker på hvem du skal henvende deg til. Listen bør gjennomgås av styret minst én gang i året.</p><!-- /wp:paragraph -->
<!-- wp:columns --><div class="wp-block-columns"><!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":3} --><h3>Instruktører</h3><!-- /wp:heading --><!-- wp:list --><ul><li>Vegard Aasen</li><li>Thomas Solvik</li></ul><!-- /wp:list --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":3} --><h3>Webansvarlig / IT</h3><!-- /wp:heading --><!-- wp:list --><ul><li>Thomas Solvik</li><li>Jørgen Skar</li></ul><!-- /wp:list --></div><!-- /wp:column --></div><!-- /wp:columns -->
<!-- wp:columns --><div class="wp-block-columns"><!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":3} --><h3>Sikkerhet og miljø</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Robert Jenssen</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":3} --><h3>Banekomitéleder</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Stein Rune Haugen</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns -->',
		),
	);
}

function bmfk_setup_backup_and_update_page( $page, $data ) {
	if ( ! get_post_meta( $page->ID, '_bmfk_pre_modern_content', true ) ) {
		add_post_meta( $page->ID, '_bmfk_pre_modern_content', $page->post_content, true );
		add_post_meta( $page->ID, '_bmfk_pre_modern_title', $page->post_title, true );
	}

	return wp_update_post(
		array(
			'ID'             => $page->ID,
			'post_title'     => $data['title'],
			'post_content'   => $data['content'],
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
		),
		true
	);
}

function bmfk_setup_create_menu() {
	$menu_name = 'Hovedmeny 2026';
	$menu      = wp_get_nav_menu_object( $menu_name );
	$menu_id   = $menu ? (int) $menu->term_id : wp_create_nav_menu( $menu_name );

	if ( is_wp_error( $menu_id ) ) {
		return $menu_id;
	}

	$existing_items = wp_get_nav_menu_items( $menu_id );

	if ( ! $existing_items ) {
		$items = array(
			array( 'Hjem', home_url( '/' ) ),
			array( 'Facebook-grupper', home_url( '/#facebook-grupper' ) ),
			array( 'Webkamera', 'https://webcam.bodomfk.no/' ),
			array( 'Medlemsfordeler', home_url( '/medlemsfordeler/' ) ),
			array( 'Klubbhytta', home_url( '/klubbhytta/' ) ),
			array( 'Flyplassregler', home_url( '/flyplassregler/' ) ),
			array( 'Kontakt', home_url( '/kontaktoss/' ) ),
		);

		foreach ( $items as $item ) {
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title'  => $item[0],
					'menu-item-url'    => $item[1],
					'menu-item-status' => 'publish',
				)
			);
		}
	} else {
		$facebook_url = home_url( '/#facebook-grupper' );
		$has_facebook = false;
		foreach ( $existing_items as $existing_item ) {
			if ( $facebook_url === $existing_item->url ) {
				$has_facebook = true;
				break;
			}
		}

		if ( ! $has_facebook ) {
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-title'  => 'Facebook-grupper',
					'menu-item-url'    => $facebook_url,
					'menu-item-status' => 'publish',
				)
			);
		}
	}

	$locations            = get_theme_mod( 'nav_menu_locations', array() );
	$locations['primary'] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );

	return $menu_id;
}

function bmfk_setup_run_migration() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Du har ikke tilgang til denne handlingen.', 'bmfk' ) );
	}
	check_admin_referer( 'bmfk_run_migration' );

	$updated = 0;
	foreach ( bmfk_setup_page_content() as $slug => $data ) {
		$page = get_page_by_path( $slug );
		if ( ! $page ) {
			$result = wp_insert_post(
				array(
					'post_title'     => $data['title'],
					'post_name'      => $slug,
					'post_content'   => $data['content'],
					'post_type'      => 'page',
					'post_status'    => 'publish',
					'comment_status' => 'closed',
					'ping_status'    => 'closed',
				),
				true
			);
			if ( ! is_wp_error( $result ) ) {
				++$updated;
			}
		} else {
			$result = bmfk_setup_backup_and_update_page( $page, $data );
			if ( ! is_wp_error( $result ) ) {
				++$updated;
			}
		}
	}

	$front_page = get_page_by_path( 'hjem' );
	if ( $front_page ) {
		if ( ! get_post_meta( $front_page->ID, '_bmfk_pre_modern_content', true ) ) {
			add_post_meta( $front_page->ID, '_bmfk_pre_modern_content', $front_page->post_content, true );
		}
		wp_update_post(
			array(
				'ID'             => $front_page->ID,
				'post_content'   => '<!-- wp:paragraph --><p>Forsiden vises av temaet Bodø Modellflyklubb Modern.</p><!-- /wp:paragraph -->',
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
			)
		);
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page->ID );
	}

	$legacy_slugs = array( 'user', 'login', 'register', 'members', 'logout', 'account', 'password-reset' );
	foreach ( $legacy_slugs as $slug ) {
		$page = get_page_by_path( $slug );
		if ( $page && 'publish' === $page->post_status ) {
			update_post_meta( $page->ID, '_bmfk_pre_modern_status', $page->post_status );
			wp_update_post( array( 'ID' => $page->ID, 'post_status' => 'draft' ) );
		}
	}

	global $wpdb;
	$wpdb->query( "UPDATE {$wpdb->posts} SET comment_status = 'closed', ping_status = 'closed' WHERE post_type IN ('post','page')" ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
	update_option( 'default_comment_status', 'closed' );
	update_option( 'default_ping_status', 'closed' );
	remove_theme_mod( 'bmfk_facebook_page_url' );
	set_theme_mod( 'bmfk_facebook_members_url', 'https://www.facebook.com/groups/bodomfk' );
	set_theme_mod( 'bmfk_facebook_market_url', 'https://www.facebook.com/groups/bodomfksalg' );
	set_theme_mod( 'bmfk_contact_email', 'post@bodomfk.no' );
	set_theme_mod( 'bmfk_invoice_email', 'faktura@bodomfk.no' );
	bmfk_setup_create_menu();
	update_option( 'bmfk_modern_migrated_at', current_time( 'mysql' ) );

	wp_safe_redirect( add_query_arg( array( 'page' => 'bmfk-modernisering', 'bmfk_migrated' => $updated ), admin_url( 'tools.php' ) ) );
	exit;
}
add_action( 'admin_post_bmfk_run_migration', 'bmfk_setup_run_migration' );

/**
 * Update only the public contact page without rewriting the other migrated pages.
 */
function bmfk_setup_update_contact_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Du har ikke tilgang til denne handlingen.', 'bmfk' ) );
	}

	check_admin_referer( 'bmfk_update_contact' );

	$pages = bmfk_setup_page_content();
	$page  = get_page_by_path( 'kontaktoss' );

	if ( ! $page || empty( $pages['kontaktoss'] ) ) {
		wp_safe_redirect( add_query_arg( array( 'page' => 'bmfk-modernisering', 'bmfk_contact_updated' => 0 ), admin_url( 'tools.php' ) ) );
		exit;
	}

	$result = bmfk_setup_backup_and_update_page( $page, $pages['kontaktoss'] );
	set_theme_mod( 'bmfk_contact_email', 'post@bodomfk.no' );
	set_theme_mod( 'bmfk_invoice_email', 'faktura@bodomfk.no' );

	wp_safe_redirect(
		add_query_arg(
			array(
				'page'                 => 'bmfk-modernisering',
				'bmfk_contact_updated' => is_wp_error( $result ) ? 0 : 1,
			),
			admin_url( 'tools.php' )
		)
	);
	exit;
}
add_action( 'admin_post_bmfk_update_contact', 'bmfk_setup_update_contact_page' );

/**
 * Update only the airfield rules page with the current Avinor agreement.
 */
function bmfk_setup_update_airfield_rules_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Du har ikke tilgang til denne handlingen.', 'bmfk' ) );
	}

	check_admin_referer( 'bmfk_update_airfield_rules' );

	$pages = bmfk_setup_page_content();
	$page  = get_page_by_path( 'flyplassregler' );

	if ( ! $page || empty( $pages['flyplassregler'] ) || ! file_exists( bmfk_setup_airfield_agreement_path() ) ) {
		wp_safe_redirect( add_query_arg( array( 'page' => 'bmfk-modernisering', 'bmfk_airfield_rules_updated' => 0 ), admin_url( 'tools.php' ) ) );
		exit;
	}

	$result = bmfk_setup_backup_and_update_page( $page, $pages['flyplassregler'] );

	wp_safe_redirect(
		add_query_arg(
			array(
				'page'                         => 'bmfk-modernisering',
				'bmfk_airfield_rules_updated' => is_wp_error( $result ) ? 0 : 1,
			),
			admin_url( 'tools.php' )
		)
	);
	exit;
}
add_action( 'admin_post_bmfk_update_airfield_rules', 'bmfk_setup_update_airfield_rules_page' );

function bmfk_setup_deactivate_plugins() {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		wp_die( esc_html__( 'Du har ikke tilgang til denne handlingen.', 'bmfk' ) );
	}
	check_admin_referer( 'bmfk_deactivate_plugins' );

	$allowed  = array_keys( bmfk_setup_legacy_plugins() );
	$selected = isset( $_POST['plugins'] ) ? array_map( 'sanitize_text_field', wp_unslash( (array) $_POST['plugins'] ) ) : array();
	$selected = array_values( array_intersect( $allowed, $selected ) );

	if ( $selected ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
		deactivate_plugins( $selected, false, false );
	}

	wp_safe_redirect( add_query_arg( array( 'page' => 'bmfk-modernisering', 'bmfk_deactivated' => count( $selected ) ), admin_url( 'tools.php' ) ) );
	exit;
}
add_action( 'admin_post_bmfk_deactivate_plugins', 'bmfk_setup_deactivate_plugins' );

function bmfk_setup_render_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	require_once ABSPATH . 'wp-admin/includes/plugin.php';
	$theme       = wp_get_theme();
	$theme_ready = 'Bodø Modellflyklubb Modern' === $theme->get( 'Name' );
	$agreement_ready = file_exists( bmfk_setup_airfield_agreement_path() );
	$migrated_at = get_option( 'bmfk_modern_migrated_at' );
	?>
	<div class="wrap">
		<h1>BMFK modernisering</h1>
		<p>Denne siden gjør overgangen kontrollert og reverserbar. Den sletter ikke brukere eller gamle sider.</p>

		<?php if ( isset( $_GET['bmfk_migrated'] ) ) : // phpcs:ignore WordPress.Security.NonceVerification.Recommended ?>
			<div class="notice notice-success"><p>Innholdet er migrert. Gamle innloggingssider er arkivert som utkast.</p></div>
		<?php endif; ?>
		<?php if ( isset( $_GET['bmfk_deactivated'] ) ) : // phpcs:ignore WordPress.Security.NonceVerification.Recommended ?>
			<div class="notice notice-success"><p>Valgte utvidelser ble deaktivert. De er ikke slettet og kan aktiveres igjen.</p></div>
		<?php endif; ?>
		<?php if ( isset( $_GET['bmfk_contact_updated'] ) ) : // phpcs:ignore WordPress.Security.NonceVerification.Recommended ?>
			<?php if ( '1' === sanitize_text_field( wp_unslash( $_GET['bmfk_contact_updated'] ) ) ) : ?>
				<div class="notice notice-success"><p>Kontaktsiden er oppdatert med egne adresser for generelle henvendelser og faktura.</p></div>
			<?php else : ?>
				<div class="notice notice-error"><p>Kontaktsiden kunne ikke oppdateres. Kontroller at siden med adressen «kontaktoss» finnes.</p></div>
			<?php endif; ?>
		<?php endif; ?>
		<?php if ( isset( $_GET['bmfk_airfield_rules_updated'] ) ) : // phpcs:ignore WordPress.Security.NonceVerification.Recommended ?>
			<?php if ( '1' === sanitize_text_field( wp_unslash( $_GET['bmfk_airfield_rules_updated'] ) ) ) : ?>
				<div class="notice notice-success"><p>Siden «Flyplass og sikkerhet» er oppdatert med avtalen fra Bodø kontrolltårn.</p></div>
			<?php else : ?>
				<div class="notice notice-error"><p>Siden kunne ikke oppdateres. Kontroller at siden «flyplassregler» finnes og at tema versjon 1.3.0 eller nyere er installert.</p></div>
			<?php endif; ?>
		<?php endif; ?>

		<div class="card" style="max-width:1000px;padding:22px;margin-top:20px">
			<h2>1. Flytt innholdet bort fra gamle utvidelser</h2>
			<p><strong>Aktivt tema:</strong> <?php echo esc_html( $theme->get( 'Name' ) ); ?></p>
			<?php if ( ! $theme_ready ) : ?><p style="color:#b32d2e"><strong>Aktiver «Bodø Modellflyklubb Modern» før du kjører migreringen.</strong></p><?php endif; ?>
			<?php if ( $migrated_at ) : ?><p>Migreringen ble sist kjørt <?php echo esc_html( $migrated_at ); ?>.</p><?php endif; ?>
			<p>Handlingen tar sikkerhetskopi av det gamle sideinnholdet i sidens metadata, lager ren blokkredigert tekst, lukker kommentarer, lager ny hovedmeny og setter gamle Ultimate Member-sider til utkast.</p>
			<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<input type="hidden" name="action" value="bmfk_run_migration">
				<?php wp_nonce_field( 'bmfk_run_migration' ); ?>
				<?php
				$button_attributes = $theme_ready ? array() : array( 'disabled' => 'disabled' );
				submit_button( 'Kjør innholdsmigrering', 'primary', 'submit', false, $button_attributes );
				?>
			</form>
		</div>

		<div class="card" style="max-width:1000px;padding:22px;margin-top:20px">
			<h2>2. Oppdater kontaktinformasjon</h2>
			<p>Oppdaterer bare siden «Kontakt oss» med <strong>post@bodomfk.no</strong> for generelle henvendelser og <strong>faktura@bodomfk.no</strong> for fakturaer. Email Address Encoder brukes til å beskytte begge adressene.</p>
			<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<input type="hidden" name="action" value="bmfk_update_contact">
				<?php wp_nonce_field( 'bmfk_update_contact' ); ?>
				<?php submit_button( 'Oppdater kontaktsiden', 'primary', 'submit', false ); ?>
			</form>
		</div>

		<div class="card" style="max-width:1000px;padding:22px;margin-top:20px">
			<h2>3. Oppdater flyplassreglene</h2>
			<p>Oppdaterer bare siden «Flyplass og sikkerhet» med avtalen fra Bodø kontrolltårn, datert 26. mai 2026. PDF-en følger temaet og åpnes fra en tydelig knapp på siden.</p>
			<?php if ( ! $agreement_ready ) : ?><p style="color:#b32d2e"><strong>Installer tema versjon 1.3.0 før du oppdaterer flyplassreglene.</strong></p><?php endif; ?>
			<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<input type="hidden" name="action" value="bmfk_update_airfield_rules">
				<?php wp_nonce_field( 'bmfk_update_airfield_rules' ); ?>
				<?php
				$button_attributes = $theme_ready && $agreement_ready ? array() : array( 'disabled' => 'disabled' );
				submit_button( 'Oppdater flyplassreglene', 'primary', 'submit', false, $button_attributes );
				?>
			</form>
		</div>

		<div class="card" style="max-width:1000px;padding:22px;margin-top:20px">
			<h2>4. Deaktiver gamle utvidelser</h2>
			<p>Kjør dette etter at du har kontrollert forsiden, undersidene, menyen og mobilvisningen. Dette deaktiverer – det sletter ikke.</p>
			<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<input type="hidden" name="action" value="bmfk_deactivate_plugins">
				<?php wp_nonce_field( 'bmfk_deactivate_plugins' ); ?>
				<table class="widefat striped">
					<thead><tr><th style="width:50px">Velg</th><th>Utvidelse</th><th>Vurdering</th><th>Status</th></tr></thead>
					<tbody>
					<?php foreach ( bmfk_setup_legacy_plugins() as $file => $data ) : $active = is_plugin_active( $file ); ?>
						<tr>
							<td><input type="checkbox" name="plugins[]" value="<?php echo esc_attr( $file ); ?>" <?php checked( $data[2] && $active ); ?> <?php disabled( ! $active ); ?>></td>
							<td><strong><?php echo esc_html( $data[0] ); ?></strong></td>
							<td><?php echo esc_html( $data[1] ); ?></td>
							<td><?php echo $active ? '<span style="color:#b32d2e">Aktiv</span>' : '<span style="color:#16803a">Ikke aktiv</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<p><strong>Ikke slett Duplicator eller den gamle sikkerhetskopien før den nye siden er kontrollert og sikkerhetskopiert.</strong></p>
				<?php submit_button( 'Deaktiver valgte utvidelser', 'secondary' ); ?>
			</form>
		</div>
	</div>
	<?php
}
