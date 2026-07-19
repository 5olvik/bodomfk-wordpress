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
		<?php
		$page_slug       = get_post_field( 'post_name', get_the_ID() );
		$git_page_content = bmfk_git_page_content( $page_slug );
		$useful_links = array(
			array( 'label' => 'Bli medlem', 'url' => bmfk_setting( 'bmfk_membership_url', 'https://blimedlem.bodomfk.no/' ) ),
			array( 'label' => 'Webkamera', 'url' => BMFK_WINDY_WEBCAM_URL ),
			array( 'label' => 'Flyplassregler', 'url' => bmfk_setting( 'bmfk_local_rules_url', home_url( '/flyplassregler/' ) ), 'slug' => 'flyplassregler' ),
			array( 'label' => 'Kontakt klubben', 'url' => home_url( '/kontaktoss/' ), 'slug' => 'kontaktoss' ),
		);

		if ( 'kontaktoss' === $page_slug ) {
			$useful_links[] = array( 'label' => 'Kontaktpersoner og ansvarlige', 'url' => home_url( '/gruppeansvarlige/' ), 'slug' => 'gruppeansvarlige' );
		}
		?>
		<header class="page-hero">
			<div class="wrap"><span class="eyebrow">Bodø Modellflyklubb</span><h1><?php the_title(); ?></h1></div>
		</header>
		<div class="page-content-wrap wrap">
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-content' ); ?>>
				<?php
				if ( null !== $git_page_content ) {
					echo $git_page_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped by the Markdown renderer.
				} else {
					the_content();
				}
				?>
			</article>
			<aside class="page-aside wp-dark-mode-ignore" aria-label="Nyttige lenker">
				<h2>Nyttige lenker</h2>
				<ul>
					<?php foreach ( $useful_links as $useful_link ) : ?>
						<?php if ( isset( $useful_link['slug'] ) && $page_slug === $useful_link['slug'] ) { continue; } ?>
						<li><a href="<?php echo esc_url( $useful_link['url'] ); ?>"><?php echo esc_html( $useful_link['label'] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</aside>
		</div>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>
