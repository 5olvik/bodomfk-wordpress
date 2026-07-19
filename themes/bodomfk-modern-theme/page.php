<?php
/**
 * Standard page template.
 *
 * @package BMFK
 */

get_header();
?>
<main id="main-content">
	<?php while ( have_posts() ) : the_post(); ?>
		<header class="page-hero">
			<div class="wrap"><span class="eyebrow">Bodø Modellflyklubb</span><h1><?php the_title(); ?></h1></div>
		</header>
		<div class="page-content-wrap wrap">
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-content' ); ?>><?php the_content(); ?></article>
			<aside class="page-aside" aria-label="Nyttige lenker">
				<h2>Nyttige lenker</h2>
				<ul>
					<li><a href="<?php echo esc_url( bmfk_setting( 'bmfk_membership_url', 'https://blimedlem.bodomfk.no/' ) ); ?>">Bli medlem</a></li>
					<li><a href="<?php echo esc_url( bmfk_setting( 'bmfk_webcam_url', 'https://webcam.bodomfk.no/' ) ); ?>">Webkamera</a></li>
					<li><a href="<?php echo esc_url( bmfk_setting( 'bmfk_local_rules_url', home_url( '/flyplassregler/' ) ) ); ?>">Flyplassregler</a></li>
					<li><a href="<?php echo esc_url( home_url( '/kontaktoss/' ) ); ?>">Kontakt klubben</a></li>
				</ul>
			</aside>
		</div>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>
