<?php
/**
 * Site header.
 *
 * @package BMFK
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#04152f">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main-content"><?php esc_html_e( 'Hopp til innhold', 'bmfk' ); ?></a>

<header class="site-header wp-dark-mode-ignore" data-site-header>
	<div class="header-inner wrap">
		<a class="site-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Bodø Modellflyklubb – forsiden', 'bmfk' ); ?>">
			<img class="site-brand__logo" src="<?php echo esc_url( bmfk_asset_url( 'images/bmfk-logo.webp' ) ); ?>" alt="" width="54" height="54" decoding="async">
			<span>
				<span class="site-brand__name">Bodø Modellflyklubb</span>
				<span class="site-brand__meta">Stiftet 1973 · Bestemorenga</span>
			</span>
		</a>

		<nav id="primary-navigation" class="primary-navigation" aria-label="<?php esc_attr_e( 'Hovedmeny', 'bmfk' ); ?>" data-navigation>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'fallback_cb'    => 'bmfk_primary_menu_fallback',
					'depth'          => 1,
				)
			);
			?>
		</nav>

		<a class="header-cta wp-dark-mode-ignore" href="<?php echo esc_url( bmfk_setting( 'bmfk_membership_url', 'https://blimedlem.bodomfk.no/' ) ); ?>">Bli medlem</a>

		<button class="menu-toggle" type="button" aria-controls="primary-navigation" aria-expanded="false" data-menu-toggle>
			<span class="screen-reader-text"><?php esc_html_e( 'Åpne meny', 'bmfk' ); ?></span>
			<svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
		</button>
	</div>
</header>
