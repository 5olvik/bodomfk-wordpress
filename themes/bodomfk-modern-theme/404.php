<?php
/**
 * Not found template.
 *
 * @package BMFK
 */

get_header();
?>
<main id="main-content" class="error-404 wrap">
	<span class="eyebrow">404 · Utenfor flysonen</span>
	<h1>Her var det ingen landingsstripe.</h1>
	<p>Siden finnes ikke, eller har fått en ny adresse. Gå tilbake til forsiden og prøv en av snarveiene der.</p>
	<a class="button button--orange" href="<?php echo esc_url( home_url( '/' ) ); ?>">Til forsiden</a>
</main>
<?php get_footer(); ?>
