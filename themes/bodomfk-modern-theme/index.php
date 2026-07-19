<?php
/**
 * Default archive template.
 *
 * @package BMFK
 */

get_header();
?>
<main id="main-content">
	<header class="page-hero"><div class="wrap"><span class="eyebrow">Bodø Modellflyklubb</span><h1><?php echo esc_html( get_the_archive_title() ?: get_bloginfo( 'name' ) ); ?></h1></div></header>
	<div class="page-content-wrap wrap"><div class="entry-content">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article <?php post_class(); ?>><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php the_excerpt(); ?></article>
		<?php endwhile; the_posts_navigation(); else : ?><p><?php esc_html_e( 'Ingen innlegg ble funnet.', 'bmfk' ); ?></p><?php endif; ?>
	</div></div>
</main>
<?php get_footer(); ?>
