<?php
/**
 * Front page template.
 *
 * @package BMFK
 */

get_header();

$membership_url = bmfk_setting( 'bmfk_membership_url', 'https://blimedlem.bodomfk.no/' );
$incident_url   = bmfk_setting( 'bmfk_incident_url', BMFK_INCIDENT_REPORT_URL );
$rules_url      = bmfk_setting( 'bmfk_local_rules_url', home_url( '/flyplassregler/' ) );
$facebook_group = bmfk_setting( 'bmfk_facebook_members_url', 'https://www.facebook.com/groups/bodomfk' );
$facebook_sale  = bmfk_setting( 'bmfk_facebook_market_url', 'https://www.facebook.com/groups/bodomfksalg' );
?>

<main id="main-content">
	<section class="hero" aria-label="Bodø Modellflyklubb">
		<img class="hero-banner" src="<?php echo esc_url( bmfk_asset_url( 'images/bmfk-hero.webp' ) ); ?>" alt="Bodø Modellflyklubb ved modellflyplassen på Bestemorenga" width="2033" height="774" loading="eager" decoding="async" fetchpriority="high">
	</section>

	<nav class="quick-actions wp-dark-mode-ignore" aria-label="Snarveier">
		<a class="quick-action" href="<?php echo esc_url( $membership_url ); ?>">
			<span class="quick-action__icon"><svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg></span>
			<span><strong>Bli medlem</strong><small>Kom i gang med hobbyen</small></span>
		</a>
		<a class="quick-action" href="#flyplassen">
			<span class="quick-action__icon"><svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="6" width="14" height="12" rx="2"/><path d="m17 10 4-2v8l-4-2z"/></svg></span>
			<span><strong>Webkamera</strong><small>Se forholdene på banen</small></span>
		</a>
		<a class="quick-action" href="<?php echo esc_url( $rules_url ); ?>">
			<span class="quick-action__icon"><svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/></svg></span>
			<span><strong>Flyplassregler</strong><small>Les før du flyr</small></span>
		</a>
		<a class="quick-action" href="<?php echo esc_url( $incident_url ); ?>">
			<span class="quick-action__icon"><svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 9v4M12 17h.01"/><path d="M10.3 3.6 2.4 17.2A2 2 0 0 0 4.1 20h15.8a2 2 0 0 0 1.7-2.8L13.7 3.6a2 2 0 0 0-3.4 0Z"/></svg></span>
			<span><strong>Meld hendelse</strong><small>Rapporter uhell eller avvik</small></span>
		</a>
	</nav>

	<section class="facebook-hub wp-dark-mode-ignore" id="facebook-grupper" aria-labelledby="facebook-hub-title">
		<div class="wrap facebook-hub__layout">
			<div class="facebook-hub__intro">
				<span class="eyebrow">Møteplassen vår på Facebook</span>
				<h2 id="facebook-hub-title">Finn riktig Facebook-kanal</h2>
				<p>Klubben har to grupper. Velg medlemsgruppen for intern klubbinformasjon, eller den offentlige gruppen for kjøp, salg og åpen prat om hobbyen.</p>
			</div>
			<div class="facebook-hub__grid">
				<a class="facebook-channel facebook-channel--members" href="<?php echo esc_url( $facebook_group ); ?>" target="_blank" rel="noopener noreferrer">
					<span class="facebook-channel__topline"><span class="facebook-channel__icon" aria-hidden="true">f</span><span class="facebook-channel__badge">Kun for medlemmer</span></span>
					<h3>Medlemsgruppen</h3>
					<p>Viktig klubbinformasjon, aktiviteter, praktiske beskjeder og diskusjoner mellom medlemmene.</p>
					<span class="facebook-channel__link">Gå til medlemsgruppen <span aria-hidden="true">↗</span></span>
				</a>
				<a class="facebook-channel facebook-channel--public" href="<?php echo esc_url( $facebook_sale ); ?>" target="_blank" rel="noopener noreferrer">
					<span class="facebook-channel__topline"><span class="facebook-channel__icon" aria-hidden="true">f</span><span class="facebook-channel__badge">Åpen for alle</span></span>
					<h3>Offentlig Facebook-gruppe</h3>
					<p>Kjøp og salg av modellflyutstyr, tips, spørsmål og åpen kontakt med modellflymiljøet i Bodø.</p>
					<span class="facebook-channel__link">Åpne den offentlige gruppen <span aria-hidden="true">↗</span></span>
				</a>
			</div>
		</div>
	</section>

	<section class="intro-section" id="om">
		<div class="wrap intro-grid">
			<div class="intro-copy">
				<span class="eyebrow">Velkommen til klubben</span>
				<h1>Mange drømmer om å fly. <span>Vi gjør det – radiostyrt.</span></h1>
				<p>Bodø Modellflyklubb er møteplassen for deg som bygger, flyr eller bare er nysgjerrig på modellfly, helikopter, droner og FPV. Hos oss finner du kunnskap, trygg opplæring og et miljø som heier på nye piloter.</p>
				<div class="button-row">
					<a class="button button--orange wp-dark-mode-ignore" href="<?php echo esc_url( $membership_url ); ?>">Jeg vil bli medlem <span aria-hidden="true">→</span></a>
					<a class="button button--ghost" href="<?php echo esc_url( home_url( '/medlemsfordeler/' ) ); ?>">Se medlemsfordelene</a>
				</div>
			</div>
			<div class="intro-values wp-dark-mode-ignore">
				<blockquote>«Det handler om mestring i lufta – og menneskene du deler opplevelsen med på bakken.»</blockquote>
				<ul class="value-list" aria-label="Klubbens verdier">
					<li>Fly</li>
					<li>Fellesskap</li>
					<li>Hobby</li>
					<li>Glede</li>
				</ul>
			</div>
		</div>
	</section>

	<section class="disciplines-section" aria-labelledby="disciplines-title">
		<div class="wrap">
			<div class="section-heading section-heading--center">
				<span class="eyebrow">Én klubb · mange muligheter</span>
				<h2 id="disciplines-title">Finn din måte å fly på</h2>
				<p>Fra den aller første skumflymodellen til stormodell, presisjonsflyging og FPV. Vi deler erfaring og hjelper hverandre videre.</p>
			</div>
			<div class="discipline-grid">
				<article class="discipline-card wp-dark-mode-ignore">
					<span class="discipline-card__icon"><svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8"><path d="m2 16 20-5-20-5 5 5-5 5Z"/><path d="m8 14 3 6 2-7M8 9l3-6 2 7"/></svg></span>
					<h3>Modellfly</h3>
					<p>Elektro, seilfly, forbrenningsmotor, akro og stormodeller – fra nybegynner til erfaren pilot.</p>
				</article>
				<article class="discipline-card wp-dark-mode-ignore">
					<span class="discipline-card__icon"><svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 7h16M12 7v5M8 12h8l2 7H6l2-7Z"/><path d="M2 4h8M14 4h8"/></svg></span>
					<h3>Helikopter</h3>
					<p>Fra stabil innlæring til avansert 3D-flyging med elektriske og større radiostyrte helikoptre.</p>
				</article>
				<article class="discipline-card wp-dark-mode-ignore">
					<span class="discipline-card__icon"><svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="6" cy="6" r="3"/><circle cx="18" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="18" r="3"/><path d="m8 8 3 3m2 2 3 3m0-8-3 3m-2 2-3 3"/></svg></span>
					<h3>Droner &amp; FPV</h3>
					<p>Multirotor, FPV og racing i et miljø med fokus på sikkerhet, teknikk og gode flyopplevelser.</p>
				</article>
				<article class="discipline-card wp-dark-mode-ignore">
					<span class="discipline-card__icon"><svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.9M16 3.1a4 4 0 0 1 0 7.8"/></svg></span>
					<h3>Miljø &amp; opplæring</h3>
					<p>Instruktører og klubbkamerater hjelper deg trygt i gang – og det er alltid plass til en prat ved klubbhytta.</p>
				</article>
			</div>
		</div>
	</section>

	<section class="field-section" id="flyplassen">
		<div class="wrap">
			<div class="field-panel wp-dark-mode-ignore">
				<div class="field-copy">
					<span class="eyebrow">Bestemorenga modellflyplass</span>
					<h2>Gode forhold starter med en rask sjekk.</h2>
					<p>Se webkameraet før du kjører hjemmefra, og kontroller alltid gjeldende flyplass- og sikkerhetsregler før aktiviteten starter.</p>
					<div class="hours-grid" role="group" aria-label="Banens åpningstider">
						<div class="hours-card wp-dark-mode-ignore"><small>Elektromotor</small><strong><?php echo esc_html( bmfk_setting( 'bmfk_electric_hours', 'Hele døgnet' ) ); ?></strong></div>
						<div class="hours-card wp-dark-mode-ignore"><small>Forbrenningsmotor</small><strong><?php echo esc_html( bmfk_setting( 'bmfk_combustion_hours', '09:00–21:00' ) ); ?></strong></div>
					</div>
					<div class="button-row">
						<a class="button button--orange wp-dark-mode-ignore" href="#webkamera">Åpne webkamera</a>
						<a class="button wp-dark-mode-ignore" href="<?php echo esc_url( $rules_url ); ?>">Les reglene</a>
					</div>
				</div>
				<div class="field-visual" role="img" aria-label="Modellfly og piloter ved flyplassen på Bestemorenga">
					<span class="live-badge">Kamera tilgjengelig</span>
				</div>
			</div>

			<section class="field-live-grid" id="webkamera" aria-labelledby="field-live-title">
				<div class="field-live-copy">
					<span class="eyebrow">Direkte fra Bestemorenga</span>
					<h2 id="field-live-title">Se forholdene før du kjører.</h2>
					<div class="field-weather wp-dark-mode-ignore">
						<iframe src="<?php echo esc_url( BMFK_YR_WIDGET_URL ); ?>" title="Værvarsel for Bestemorenga fra Yr" loading="lazy" scrolling="no"></iframe>
						<a class="field-weather__link" href="<?php echo esc_url( BMFK_YR_URL ); ?>" target="_blank" rel="noopener noreferrer">Se hele værvarselet på Yr <span aria-hidden="true">↗</span></a>
					</div>
				</div>
				<div class="field-webcam-card wp-dark-mode-ignore">
					<div class="field-webcam" aria-label="Webkamera fra Bodø Modellflyklubb på Bestemorenga via Windy">
						<a name="windy-webcam-timelapse-player" data-id="1577496579" data-play="day" data-loop="0" data-auto-play="0" data-force-full-screen-on-overlay-play="0" data-interactive="1" href="https://windy.com/webcams/1577496579" target="_blank" rel="noopener noreferrer">Lopsmarka › South: Bodø Modellflyklubb</a><script async type="text/javascript" src="https://webcams.windy.com/webcams/public/embed/v2/script/player.js"></script>
					</div>
				</div>
			</section>
		</div>
	</section>

	<section class="safety-section" id="sikkerhet" aria-labelledby="safety-title">
		<div class="wrap">
			<div class="section-heading">
				<span class="eyebrow">Trygghet først</span>
				<h2 id="safety-title">Kunnskap gir bedre flyging</h2>
				<p>Regelverket utvikler seg. Bruk alltid oppdaterte kilder fra klubben, NLF og Luftfartstilsynet – ikke gamle kopier du tilfeldigvis har lagret.</p>
			</div>
			<div class="safety-grid">
				<article class="safety-card wp-dark-mode-ignore">
					<span class="safety-card__number">01 · LOKALT</span>
					<h3>Flyplassregler</h3>
					<p>Sett deg inn i flysoner, pilotområde, åpningstider og lokale prosedyrer før du flyr.</p>
					<a href="<?php echo esc_url( $rules_url ); ?>">Åpne lokale regler <span aria-hidden="true">→</span></a>
				</article>
				<article class="safety-card wp-dark-mode-ignore">
					<span class="safety-card__number">02 · NLF</span>
					<h3>Modellflyhåndboka</h3>
					<p>NLFs godkjente sikkerhetssystem beskriver krav til organisert modellflyging og kompetanse.</p>
					<a href="<?php echo esc_url( BMFK_HANDBOOK_URL ); ?>">Se gjeldende håndbok <span aria-hidden="true">→</span></a>
				</article>
				<article class="safety-card wp-dark-mode-ignore">
					<span class="safety-card__number">03 · OPPLÆRING</span>
					<h3>Kompetansebevis</h3>
					<p>Klubben tilbyr et miljø der du kan få veiledning og bygge kompetanse på riktig modelltype.</p>
					<a href="https://nlf.no/grener/modellfly/sikkerhet-utdanning/kompetansebevis/kompetansebevis-oversikt/">Se bevis og krav <span aria-hidden="true">→</span></a>
				</article>
			</div>
		</div>
	</section>

	<section class="gallery-section" aria-labelledby="gallery-title">
		<div class="wrap">
			<div class="section-heading">
				<span class="eyebrow">Fra flyplassen</span>
				<h2 id="gallery-title">Hobbyen ser best ut i lufta</h2>
				<p>Noen glimt fra aktiviteten, modellene og miljøet rundt banen på Bestemorenga.</p>
			</div>
			<section class="gallery-grid" aria-label="Bildegalleri fra modellflyplassen" tabindex="0">
				<figure class="gallery-item"><img src="<?php echo esc_url( bmfk_asset_url( 'images/gallery-aircraft.webp' ) ); ?>" alt="Modellfly klare på bakken" width="1200" height="800" loading="lazy" decoding="async"><figcaption>Klar for neste tur</figcaption></figure>
				<figure class="gallery-item"><img src="<?php echo esc_url( bmfk_asset_url( 'images/gallery-fpv.webp' ) ); ?>" alt="FPV-pilot med radiostyrt quad" width="1200" height="800" loading="lazy" decoding="async"><figcaption>FPV og multirotor</figcaption></figure>
				<figure class="gallery-item"><img src="<?php echo esc_url( bmfk_asset_url( 'images/gallery-helicopter.webp' ) ); ?>" alt="Radiostyrt helikopter over banen" width="1200" height="800" loading="lazy" decoding="async"><figcaption>Helikopterflyging</figcaption></figure>
				<figure class="gallery-item"><img src="<?php echo esc_url( bmfk_asset_url( 'images/gallery-pilot.webp' ) ); ?>" alt="Pilot med modellfly" width="1200" height="800" loading="lazy" decoding="async"><figcaption>Flyglede på bakken</figcaption></figure>
				<figure class="gallery-item"><img src="<?php echo esc_url( bmfk_asset_url( 'images/gallery-building.webp' ) ); ?>" alt="Klargjøring av modellfly" width="1200" height="800" loading="lazy" decoding="async"><figcaption>Klargjøring og fellesskap</figcaption></figure>
			</section>
		</div>
	</section>

	<section class="join-section">
		<div class="wrap">
			<div class="join-panel wp-dark-mode-ignore">
				<div><span class="eyebrow">Klar for å ta av?</span><h2>Bli en del av miljøet på Bestemorenga.</h2><p>Du trenger ikke kunne alt før du kommer. Nysgjerrighet holder lenge – resten lærer vi sammen.</p></div>
				<div class="button-row"><a class="button button--orange wp-dark-mode-ignore" href="<?php echo esc_url( $membership_url ); ?>">Bli medlem nå <span aria-hidden="true">→</span></a></div>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
