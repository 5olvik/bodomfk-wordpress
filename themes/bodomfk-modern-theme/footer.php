<?php
/**
 * Site footer.
 *
 * @package BMFK
 */

$email = bmfk_setting( 'bmfk_contact_email', 'post@bodomfk.no' );
?>
<footer class="site-footer">
	<div class="footer-main wrap">
		<div class="footer-column">
			<div class="footer-brand">
				<img src="<?php echo esc_url( bmfk_asset_url( 'images/bmfk-logo.webp' ) ); ?>" alt="" width="66" height="66" loading="lazy">
				<div><strong>Bodø Modellflyklubb</strong><span>Fly · Fellesskap · Hobby · Glede</span></div>
			</div>
			<p class="footer-intro">Klubben for modellfly, helikopter, droner og FPV i Bodø. Vi holder til ved Bestemorenga aktivitetspark.</p>
		</div>
		<div class="footer-column">
			<h2>Snarveier</h2>
			<ul>
				<li><a href="<?php echo esc_url( bmfk_setting( 'bmfk_membership_url', 'https://blimedlem.bodomfk.no/' ) ); ?>">Bli medlem</a></li>
				<li><a href="<?php echo esc_url( bmfk_setting( 'bmfk_webcam_url', 'https://webcam.bodomfk.no/' ) ); ?>">Webkamera</a></li>
				<li><a href="<?php echo esc_url( bmfk_setting( 'bmfk_local_rules_url', home_url( '/flyplassregler/' ) ) ); ?>">Flyplassregler</a></li>
				<li><a href="<?php echo esc_url( bmfk_setting( 'bmfk_incident_url', 'https://nlfmodellfly.wufoo.com/' ) ); ?>">Meld hendelse/uhell</a></li>
			</ul>
		</div>
		<div class="footer-column">
			<h2>Kontakt</h2>
			<ul>
				<li><a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo esc_html( antispambot( $email ) ); ?></a></li>
				<li><a href="<?php echo esc_url( bmfk_setting( 'bmfk_facebook_members_url', 'https://www.facebook.com/groups/bodomfk' ) ); ?>">Facebook: medlemsgruppen</a></li>
				<li><a href="<?php echo esc_url( bmfk_setting( 'bmfk_facebook_market_url', 'https://www.facebook.com/groups/bodomfksalg' ) ); ?>">Facebook: offentlig gruppe</a></li>
				<li>Postboks 410, 8001 Bodø</li>
				<li>Org.nr. 993 764 299</li>
			</ul>
		</div>
	</div>
	<div class="footer-bottom wrap">
		<span>© <?php echo esc_html( gmdate( 'Y' ) ); ?> Bodø Modellflyklubb</span>
		<span>Stiftet i 1973 · Bestemorenga, Bodø</span>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
