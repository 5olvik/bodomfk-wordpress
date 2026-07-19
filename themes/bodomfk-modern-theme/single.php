<?php
/**
 * Single post template.
 *
 * @package BMFK
 */

get_header();
?>
<main id="main-content">
	<?php while ( have_posts() ) : the_post(); ?>
	<header class="page-hero"><div class="wrap"><span class="eyebrow"><?php echo esc_html( get_the_date() ); ?></span><h1><?php the_title(); ?></h1></div></header>
	<div class="page-content-wrap wrap"><article <?php post_class( 'entry-content' ); ?>><?php the_content(); ?></article></div>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>
