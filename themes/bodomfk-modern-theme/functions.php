<?php
/**
 * Theme functions for Bodø Modellflyklubb Modern.
 *
 * @package BMFK
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BMFK_THEME_VERSION', '1.5.6' );

define( 'BMFK_INCIDENT_REPORT_URL', 'https://nlf.no/grener/modellfly/rapportere-hendelse/' );
define( 'BMFK_HANDBOOK_URL', 'https://nlf.no/grener/modellfly/sikkerhet-utdanning/modellflyhandboka/' );
define( 'BMFK_PUBLIC_WEBCAM_URL', 'https://webcam.bodomfk.no/' );
define( 'BMFK_YR_URL', 'https://www.yr.no/nb/v%C3%A6rvarsel/daglig-tabell/1-269332/Norge/Nordland/Bod%C3%B8/Bestemorenga' );
define( 'BMFK_YR_WIDGET_URL', 'https://www.yr.no/nb/innhold/1-269332/card.html?mode=dark' );

require_once get_template_directory() . '/inc/content-pages.php';
require_once get_template_directory() . '/inc/webcam.php';

function bmfk_theme_setup() {
	load_theme_textdomain( 'bmfk', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	register_nav_menus(
		array(
			'primary' => __( 'Hovedmeny', 'bmfk' ),
		)
	);
}
add_action( 'after_setup_theme', 'bmfk_theme_setup' );

function bmfk_enqueue_assets() {
	wp_enqueue_style( 'bmfk-style', get_stylesheet_uri(), array(), BMFK_THEME_VERSION );
	wp_enqueue_script(
		'bmfk-site',
		get_template_directory_uri() . '/assets/js/site.js',
		array(),
		BMFK_THEME_VERSION,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);
}
add_action( 'wp_enqueue_scripts', 'bmfk_enqueue_assets' );

/**
 * Prioritize the large visual that visitors see first on the front page.
 *
 * @param array $preload_resources Existing preload resources.
 * @return array
 */
function bmfk_preload_resources( $preload_resources ) {
	if ( is_front_page() ) {
		$preload_resources[] = array(
			'href'          => bmfk_asset_url( 'images/bmfk-hero.webp' ),
			'as'            => 'image',
			'type'          => 'image/webp',
			'fetchpriority' => 'high',
		);
	}

	return $preload_resources;
}
add_filter( 'wp_preload_resources', 'bmfk_preload_resources' );

function bmfk_asset_url( $path ) {
	return get_template_directory_uri() . '/assets/' . ltrim( $path, '/' );
}

function bmfk_setting( $key, $default = '' ) {
	return get_theme_mod( $key, $default );
}

/**
 * Return a clickable, obfuscated email address.
 *
 * Email Address Encoder only filters selected WordPress content in its free
 * version. The footer is rendered by the theme, so use the plugin shortcode
 * explicitly there. WordPress' antispambot() is kept as a safe fallback.
 *
 * @param string $email Email address to display.
 * @param string $class Optional CSS class for the link.
 * @return string
 */
function bmfk_protected_email_link( $email, $class = '' ) {
	$email = sanitize_email( $email );
	$class = sanitize_html_class( $class );

	if ( ! $email ) {
		return '';
	}

	if ( shortcode_exists( 'encode' ) ) {
		$shortcode = sprintf(
			'[encode link="mailto:%1$s"%2$s]%1$s[/encode]',
			$email,
			$class ? ' class="' . $class . '"' : ''
		);

		return do_shortcode( $shortcode );
	}

	$encoded = antispambot( $email );

	return sprintf(
		'<a href="mailto:%1$s"%2$s>%1$s</a>',
		$encoded,
		$class ? ' class="' . esc_attr( $class ) . '"' : ''
	);
}

function bmfk_register_customizer( $wp_customize ) {
	$wp_customize->add_section(
		'bmfk_club_settings',
		array(
			'title'       => __( 'Klubbinformasjon', 'bmfk' ),
			'description' => __( 'Lenker og praktisk informasjon som brukes flere steder på nettsiden.', 'bmfk' ),
			'priority'    => 30,
		)
	);

	$url_settings = array(
		'bmfk_membership_url'       => array( __( 'Lenke for innmelding', 'bmfk' ), 'https://blimedlem.bodomfk.no/' ),
		'bmfk_incident_url'         => array( __( 'Lenke for hendelse/uhell', 'bmfk' ), BMFK_INCIDENT_REPORT_URL ),
		'bmfk_local_rules_url'      => array( __( 'Lenke til lokale regler', 'bmfk' ), home_url( '/flyplassregler/' ) ),
		'bmfk_facebook_members_url' => array( __( 'Facebook medlemsgruppe', 'bmfk' ), 'https://www.facebook.com/groups/bodomfk' ),
		'bmfk_facebook_market_url'  => array( __( 'Offentlig Facebook-gruppe', 'bmfk' ), 'https://www.facebook.com/groups/bodomfksalg' ),
	);

	foreach ( $url_settings as $id => $data ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $data[1],
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $data[0],
				'section' => 'bmfk_club_settings',
				'type'    => 'url',
			)
		);
	}

	$text_settings = array(
		'bmfk_electric_hours'   => array( __( 'Åpningstid elektromotor', 'bmfk' ), __( 'Hele døgnet', 'bmfk' ) ),
		'bmfk_combustion_hours' => array( __( 'Åpningstid forbrenningsmotor', 'bmfk' ), '09:00–21:00' ),
		'bmfk_contact_email'    => array( __( 'E-postadresse – generelle henvendelser', 'bmfk' ), 'post@bodomfk.no' ),
		'bmfk_invoice_email'    => array( __( 'E-postadresse – faktura', 'bmfk' ), 'faktura@bodomfk.no' ),
	);

	foreach ( $text_settings as $id => $data ) {
		$sanitize_callback = in_array( $id, array( 'bmfk_contact_email', 'bmfk_invoice_email' ), true ) ? 'sanitize_email' : 'sanitize_text_field';
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $data[1],
				'sanitize_callback' => $sanitize_callback,
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $data[0],
				'section' => 'bmfk_club_settings',
				'type'    => 'text',
			)
		);
	}
}
add_action( 'customize_register', 'bmfk_register_customizer' );

function bmfk_primary_menu_fallback() {
	?>
	<ul class="menu">
		<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Hjem', 'bmfk' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/#facebook-grupper' ) ); ?>"><?php esc_html_e( 'Facebook-grupper', 'bmfk' ); ?></a></li>
		<li><a href="<?php echo esc_url( BMFK_PUBLIC_WEBCAM_URL ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Webkamera', 'bmfk' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/medlemsfordeler/' ) ); ?>"><?php esc_html_e( 'Medlemsfordeler', 'bmfk' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/klubbhytta/' ) ); ?>"><?php esc_html_e( 'Klubbhytta', 'bmfk' ); ?></a></li>
		<li><a href="<?php echo esc_url( bmfk_setting( 'bmfk_local_rules_url', home_url( '/flyplassregler/' ) ) ); ?>"><?php esc_html_e( 'Flyplassregler', 'bmfk' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/kontaktoss/' ) ); ?>"><?php esc_html_e( 'Kontakt', 'bmfk' ); ?></a></li>
	</ul>
	<?php
}

function bmfk_body_classes( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'bmfk-front-page';
	}
	return $classes;
}
add_filter( 'body_class', 'bmfk_body_classes' );

/**
 * WordPress marks both the front-page link and a front-page anchor as current.
 * Only the actual front-page link should look selected when the page opens.
 *
 * @param string[] $classes Menu item CSS classes.
 * @param WP_Post  $item    Menu item.
 * @return string[]
 */
function bmfk_fragment_menu_classes( $classes, $item ) {
	if ( is_front_page() && ! empty( $item->url ) && false !== strpos( $item->url, '#' ) ) {
		$classes = array_diff(
			$classes,
			array( 'current-menu-item', 'current_page_item', 'current-menu-ancestor', 'current_page_ancestor' )
		);
	}

	return $classes;
}
add_filter( 'nav_menu_css_class', 'bmfk_fragment_menu_classes', 10, 2 );

/**
 * Keep front-page anchor state correct and route webcam menu links locally.
 *
 * @param array    $attributes Link attributes.
 * @param WP_Post $item       Menu item.
 * @return array
 */
function bmfk_fragment_menu_link_attributes( $attributes, $item ) {
	if ( is_front_page() && ! empty( $item->url ) && false !== strpos( $item->url, '#' ) ) {
		unset( $attributes['aria-current'] );
	}

	if ( isset( $item->title ) && 'webkamera' === strtolower( trim( wp_strip_all_tags( $item->title ) ) ) ) {
		$attributes['href']   = BMFK_PUBLIC_WEBCAM_URL;
		$attributes['target'] = '_blank';
		$attributes['rel']    = 'noopener noreferrer';
	}

	return $attributes;
}
add_filter( 'nav_menu_link_attributes', 'bmfk_fragment_menu_link_attributes', 10, 2 );

/**
 * Keep the document title compact and useful in search results.
 *
 * @param string $title Generated document title.
 * @return string
 */
function bmfk_document_title( $title ) {
	if ( is_front_page() ) {
		return 'Bodø Modellflyklubb | Modellfly, droner og FPV i Bodø';
	}

	return $title;
}
add_filter( 'pre_get_document_title', 'bmfk_document_title' );

/**
 * Return the most relevant description for the current public page.
 *
 * @return string
 */
function bmfk_meta_description() {
	$descriptions = array(
		'front'             => 'Bodø Modellflyklubb samler modellflygere, dronepiloter og FPV-interesserte ved Bestemorenga. Se flyplassregler, webkamera og medlemsfordeler.',
		'medlemsfordeler'   => 'Se medlemsfordelene i Bodø Modellflyklubb: trygg flyplass, opplæring, klubbmiljø og forsikringsinformasjon gjennom NLF.',
		'klubbhytta'        => 'Informasjon for medlemmer om adgang til klubbhytta ved modellflyplassen på Bestemorenga.',
		'flyplassregler'    => 'Gjeldende sikkerhetsinformasjon for Bestemorenga modellflyplass og avtalen mellom Bodø Modellflyklubb og Bodø kontrolltårn.',
		'kontaktoss'        => 'Kontakt Bodø Modellflyklubb for generelle henvendelser, medlemsinformasjon og faktura, eller finn riktig Facebook-gruppe.',
		'gruppeansvarlige'  => 'Kontaktpersoner og ansvarlige for opplæring, sikkerhet, bane og nettsider i Bodø Modellflyklubb.',
	);

	if ( is_front_page() ) {
		return $descriptions['front'];
	}

	if ( is_page() ) {
		$slug = get_post_field( 'post_name', get_queried_object_id() );
		if ( isset( $descriptions[ $slug ] ) ) {
			return $descriptions[ $slug ];
		}
	}

	if ( is_singular() ) {
		return wp_trim_words( wp_strip_all_tags( get_the_excerpt() ), 26, '…' );
	}

	return get_bloginfo( 'description' );
}

/**
 * Add lightweight search and social-sharing metadata without another plugin.
 */
function bmfk_output_meta_tags() {
	if ( is_404() || is_admin() ) {
		return;
	}

	$description = bmfk_meta_description();
	$title       = wp_get_document_title();
	$url         = is_singular() ? get_permalink() : home_url( '/' );
	$image       = bmfk_asset_url( 'images/bmfk-hero.webp' );
	?>
	<meta name="description" content="<?php echo esc_attr( $description ); ?>">
	<meta property="og:locale" content="nb_NO">
	<meta property="og:type" content="website">
	<meta property="og:site_name" content="Bodø Modellflyklubb">
	<meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
	<meta property="og:description" content="<?php echo esc_attr( $description ); ?>">
	<meta property="og:url" content="<?php echo esc_url( $url ); ?>">
	<meta property="og:image" content="<?php echo esc_url( $image ); ?>">
	<meta property="og:image:width" content="2033">
	<meta property="og:image:height" content="774">
	<meta property="og:image:alt" content="Bodø Modellflyklubb ved modellflyplassen på Bestemorenga">
	<meta name="twitter:card" content="summary_large_image">
	<?php
}
add_action( 'wp_head', 'bmfk_output_meta_tags', 2 );

/**
 * Prevent thin WordPress attachment pages from remaining in search results.
 * Direct media files are unaffected.
 */
function bmfk_redirect_attachment_pages() {
	if ( ! is_attachment() ) {
		return;
	}

	$attachment_id = get_queried_object_id();
	$slug          = get_post_field( 'post_name', $attachment_id );
	$rules_slugs   = array(
		'flyplass-og-sikkerhetsregler-08-01-18',
		'handlingsplan-ved-ulykker-26-02-2018',
	);

	if ( in_array( $slug, $rules_slugs, true ) ) {
		$destination = home_url( '/flyplassregler/' );
	} else {
		$parent_id   = wp_get_post_parent_id( $attachment_id );
		$destination = $parent_id && 'publish' === get_post_status( $parent_id ) ? get_permalink( $parent_id ) : home_url( '/' );
	}

	wp_safe_redirect( $destination, 301, 'BMFK' );
	exit;
}
add_action( 'template_redirect', 'bmfk_redirect_attachment_pages', 1 );

/**
 * Tell WP Dark Mode to leave theme-owned surfaces alone. The theme supplies
 * exact dark colors for these elements and the plugin only controls the mode.
 *
 * @param string $block_content Rendered block HTML.
 * @param array  $block         Parsed block.
 * @return string
 */
function bmfk_protect_theme_blocks_from_dark_mode( $block_content, $block ) {
	if ( ! in_array( $block['blockName'] ?? '', array( 'core/column', 'core/button' ), true ) || ! class_exists( 'WP_HTML_Tag_Processor' ) ) {
		return $block_content;
	}

	$processor = new WP_HTML_Tag_Processor( $block_content );
	if ( $processor->next_tag() ) {
		$processor->add_class( 'wp-dark-mode-ignore' );
		return $processor->get_updated_html();
	}

	return $block_content;
}
add_filter( 'render_block', 'bmfk_protect_theme_blocks_from_dark_mode', 10, 2 );

/**
 * Apply the small, one-time data adjustments required by theme version 1.4.0.
 * This replaces the old general-purpose migration plugin.
 */
function bmfk_upgrade_to_140() {
	if ( version_compare( (string) get_option( 'bmfk_theme_content_version', '1.3.0' ), '1.4.0', '>=' ) ) {
		return;
	}

	$legacy_incident_urls = array( '', 'https://nlfmodellfly.wufoo.com/', 'http://nlfmodellfly.wufoo.com/' );
	$current_incident_url = (string) get_theme_mod( 'bmfk_incident_url', '' );
	if ( in_array( $current_incident_url, $legacy_incident_urls, true ) ) {
		set_theme_mod( 'bmfk_incident_url', BMFK_INCIDENT_REPORT_URL );
	}

	$rules_page = get_page_by_path( 'flyplassregler' );
	if ( $rules_page ) {
		$content = str_replace(
			array(
				'https://nlf.no/siteassets/modellfly/sikkerhet-og-utdanning/modellflyhandboka/modellflyhandboka/modellflyhandboka-v-2.2---01.06-2025.pdf',
				'https://nlfmodellfly.wufoo.com/',
				'http://nlfmodellfly.wufoo.com/',
				'<!-- wp:paragraph --><p><a href="/wp-content/uploads/2018/02/Flyplass-og-sikkerhetsregler-08.01.18.pdf">Historisk dokument: flyplass- og sikkerhetsregler fra 2018</a></p><!-- /wp:paragraph -->',
			),
			array( BMFK_HANDBOOK_URL, BMFK_INCIDENT_REPORT_URL, BMFK_INCIDENT_REPORT_URL, '' ),
			$rules_page->post_content
		);

		if ( $content !== $rules_page->post_content ) {
			wp_update_post( array( 'ID' => $rules_page->ID, 'post_content' => $content ) );
		}
	}

	$heading_replacements = array(
		'<!-- wp:heading {"level":3} --><h3>Kontakt klubben</h3><!-- /wp:heading -->'   => '<!-- wp:heading --><h2>Kontakt klubben</h2><!-- /wp:heading -->',
		'<!-- wp:heading {"level":3} --><h3>Postadresse</h3><!-- /wp:heading -->'       => '<!-- wp:heading --><h2>Postadresse</h2><!-- /wp:heading -->',
		'<!-- wp:heading {"level":3} --><h3>Trygg flyplass</h3><!-- /wp:heading -->'    => '<!-- wp:heading --><h2>Trygg flyplass</h2><!-- /wp:heading -->',
		'<!-- wp:heading {"level":3} --><h3>Kunnskap og hjelp</h3><!-- /wp:heading -->' => '<!-- wp:heading --><h2>Kunnskap og hjelp</h2><!-- /wp:heading -->',
		'<!-- wp:heading {"level":3} --><h3>Ansvarsforsikring</h3><!-- /wp:heading -->' => '<!-- wp:heading --><h2>Ansvarsforsikring</h2><!-- /wp:heading -->',
		'<!-- wp:heading {"level":3} --><h3>Kompetanse</h3><!-- /wp:heading -->'        => '<!-- wp:heading --><h2>Kompetanse</h2><!-- /wp:heading -->',
		'<!-- wp:heading {"level":3} --><h3>Instruktører</h3><!-- /wp:heading -->'       => '<!-- wp:heading --><h2>Instruktører</h2><!-- /wp:heading -->',
		'<!-- wp:heading {"level":3} --><h3>Webansvarlig / IT</h3><!-- /wp:heading -->'  => '<!-- wp:heading --><h2>Webansvarlig / IT</h2><!-- /wp:heading -->',
		'<!-- wp:heading {"level":3} --><h3>Sikkerhet og miljø</h3><!-- /wp:heading -->' => '<!-- wp:heading --><h2>Sikkerhet og miljø</h2><!-- /wp:heading -->',
		'<!-- wp:heading {"level":3} --><h3>Banekomitéleder</h3><!-- /wp:heading -->'    => '<!-- wp:heading --><h2>Banekomitéleder</h2><!-- /wp:heading -->',
	);

	foreach ( array( 'kontaktoss', 'medlemsfordeler', 'gruppeansvarlige' ) as $page_slug ) {
		$page = get_page_by_path( $page_slug );
		if ( ! $page ) {
			continue;
		}

		$content = str_replace( array_keys( $heading_replacements ), array_values( $heading_replacements ), $page->post_content );
		if ( $content !== $page->post_content ) {
			wp_update_post( array( 'ID' => $page->ID, 'post_content' => $content ) );
		}
	}

	update_option( 'bmfk_theme_content_version', '1.4.0', false );
}
add_action( 'admin_init', 'bmfk_upgrade_to_140' );

// Remove obsolete WordPress metadata from the public page header.
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
