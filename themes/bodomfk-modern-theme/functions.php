<?php
/**
 * Theme functions for Bodø Modellflyklubb Modern.
 *
 * @package BMFK
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BMFK_THEME_VERSION', '1.1.0' );

function bmfk_theme_setup() {
	load_theme_textdomain( 'bmfk', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 512,
			'width'       => 512,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Hovedmeny', 'bmfk' ),
			'footer'  => __( 'Bunnmeny', 'bmfk' ),
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
		true
	);
}
add_action( 'wp_enqueue_scripts', 'bmfk_enqueue_assets' );

function bmfk_asset_url( $path ) {
	return get_template_directory_uri() . '/assets/' . ltrim( $path, '/' );
}

function bmfk_setting( $key, $default = '' ) {
	return get_theme_mod( $key, $default );
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
		'bmfk_webcam_url'           => array( __( 'Lenke til webkamera', 'bmfk' ), 'https://webcam.bodomfk.no/' ),
		'bmfk_incident_url'         => array( __( 'Lenke for hendelse/uhell', 'bmfk' ), 'https://nlfmodellfly.wufoo.com/' ),
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
		'bmfk_contact_email'    => array( __( 'E-postadresse', 'bmfk' ), 'post@bodomfk.no' ),
	);

	foreach ( $text_settings as $id => $data ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $data[1],
				'sanitize_callback' => 'sanitize_text_field',
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
		<li><a href="<?php echo esc_url( bmfk_setting( 'bmfk_webcam_url', 'https://webcam.bodomfk.no/' ) ); ?>"><?php esc_html_e( 'Webkamera', 'bmfk' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/medlemsfordeler/' ) ); ?>"><?php esc_html_e( 'Medlemsfordeler', 'bmfk' ); ?></a></li>
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

// Keep the public site light and independent of legacy presentation plugins.
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
