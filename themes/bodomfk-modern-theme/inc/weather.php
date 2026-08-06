<?php
/**
 * Server-side weather data for the front-page weather panel.
 *
 * @package BMFK
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return a provider-friendly User-Agent with public contact information.
 *
 * @return string
 */
function bmfk_weather_user_agent() {
	return 'BMFK-Weather/' . BMFK_THEME_VERSION . ' (+https://bodomfk.no/; post@bodomfk.no)';
}

/**
 * Convert a direction in degrees to a Norwegian compass label.
 *
 * @param mixed $degrees Direction in degrees.
 * @return string
 */
function bmfk_weather_direction_label( $degrees ) {
	if ( ! is_numeric( $degrees ) ) {
		return '';
	}

	$labels = array( 'N', 'NØ', 'Ø', 'SØ', 'S', 'SV', 'V', 'NV' );
	$normal = fmod( (float) $degrees + 360.0, 360.0 );
	$index  = (int) floor( ( $normal + 22.5 ) / 45.0 ) % 8;

	return $labels[ $index ];
}

/**
 * Determine a safe cache lifetime from an HTTP Expires header.
 *
 * @param array|WP_Error $response HTTP response.
 * @param int            $fallback Fallback lifetime in seconds.
 * @return int
 */
function bmfk_weather_cache_ttl( $response, $fallback ) {
	$expires = wp_remote_retrieve_header( $response, 'expires' );
	$until   = $expires ? strtotime( $expires ) : false;
	$ttl     = $until ? $until - time() : (int) $fallback;

	return max( 5 * MINUTE_IN_SECONDS, min( 2 * HOUR_IN_SECONDS, $ttl ) );
}

/**
 * Return the last successful response when a provider is temporarily down.
 *
 * @param string $cache_key Cache key without suffix.
 * @return array|null
 */
function bmfk_weather_last_good( $cache_key ) {
	$data = get_transient( $cache_key . '_last_good' );

	if ( ! is_array( $data ) ) {
		return null;
	}

	$data['is_stale'] = true;

	return $data;
}

/**
 * Cache a provider failure briefly and prefer the last successful response.
 *
 * @param string $cache_key Cache key without suffix.
 * @return array|null
 */
function bmfk_weather_unavailable( $cache_key ) {
	$data = bmfk_weather_last_good( $cache_key );

	if ( is_array( $data ) ) {
		set_transient( $cache_key, $data, 5 * MINUTE_IN_SECONDS );

		return $data;
	}

	set_transient( $cache_key, 'unavailable', 5 * MINUTE_IN_SECONDS );

	return null;
}

/**
 * Store fresh and fallback copies of a successful provider response.
 *
 * @param string $cache_key Cache key without suffix.
 * @param array  $data Parsed weather data.
 * @param int    $ttl Fresh cache lifetime in seconds.
 * @return array
 */
function bmfk_weather_store( $cache_key, $data, $ttl ) {
	$data['is_stale']   = false;
	$data['fetched_at'] = time();

	set_transient( $cache_key, $data, $ttl );
	set_transient( $cache_key . '_last_good', $data, 6 * HOUR_IN_SECONDS );

	return $data;
}

/**
 * Fetch a current Locationforecast point.
 *
 * These are model forecasts for exact locations, not station observations.
 *
 * @param string $cache_key Cache key without suffix.
 * @param string $url Locationforecast API URL.
 * @param string $name Location name.
 * @param string $kind Short description shown to visitors.
 * @return array|null
 */
function bmfk_weather_get_met_forecast( $cache_key, $url, $name, $kind ) {
	$cached = get_transient( $cache_key );

	if ( is_array( $cached ) ) {
		return $cached;
	}

	if ( false !== $cached ) {
		return null;
	}

	$response = wp_remote_get(
		$url,
		array(
			'timeout'    => 4,
			'user-agent' => bmfk_weather_user_agent(),
			'headers'    => array( 'Accept' => 'application/json' ),
		)
	);

	if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
		return bmfk_weather_unavailable( $cache_key );
	}

	$payload           = json_decode( wp_remote_retrieve_body( $response ), true );
	$point             = isset( $payload['properties']['timeseries'][0] ) ? $payload['properties']['timeseries'][0] : null;
	$details           = isset( $point['data']['instant']['details'] ) ? $point['data']['instant']['details'] : null;
	$next_hour_details = isset( $point['data']['next_1_hours']['details'] )
		? $point['data']['next_1_hours']['details']
		: null;

	if ( ! is_array( $details ) || ! isset( $details['wind_speed'], $details['wind_from_direction'] ) ) {
		return bmfk_weather_unavailable( $cache_key );
	}

	$forecast_time = isset( $point['time'] ) ? strtotime( $point['time'] ) : false;

	$data = array(
		'name'              => $name,
		'kind'              => $kind,
		'source'            => 'MET Norway',
		'source_url'        => BMFK_MET_FORECAST_SOURCE_URL,
		'time'              => false === $forecast_time ? time() : $forecast_time,
		'wind_speed'        => (float) $details['wind_speed'],
		'wind_gust'         => isset( $details['wind_speed_of_gust'] ) ? (float) $details['wind_speed_of_gust'] : null,
		'direction_degrees' => (float) $details['wind_from_direction'],
		'direction_label'   => bmfk_weather_direction_label( $details['wind_from_direction'] ),
		'temperature'       => isset( $details['air_temperature'] ) ? (float) $details['air_temperature'] : null,
		'precipitation'     => is_array( $next_hour_details ) && isset( $next_hour_details['precipitation_amount'] )
			? (float) $next_hour_details['precipitation_amount']
			: null,
	);

	return bmfk_weather_store( $cache_key, $data, bmfk_weather_cache_ttl( $response, 30 * MINUTE_IN_SECONDS ) );
}

/**
 * Fetch the current model forecast for Bestemorenga.
 *
 * @return array|null
 */
function bmfk_weather_get_bestemorenga_forecast() {
	return bmfk_weather_get_met_forecast(
		'bmfk_weather_met_bestemorenga_v2',
		BMFK_MET_BESTEMORENGA_URL,
		'Bestemorenga',
		'Prognose · 109 moh.'
	);
}

/**
 * Fetch the current model forecast for Keiservarden.
 *
 * @return array|null
 */
function bmfk_weather_get_keiservarden_forecast() {
	return bmfk_weather_get_met_forecast(
		'bmfk_weather_met_keiservarden_v2',
		BMFK_MET_KEISERVARDEN_URL,
		'Keiservarden',
		'Prognose · 366 moh.'
	);
}

/**
 * Fetch the latest measured METAR observation from Bodø airport (ENBO).
 *
 * @return array|null
 */
function bmfk_weather_get_bodo_metar() {
	$cache_key = 'bmfk_weather_metar_enbo_v2';
	$cached    = get_transient( $cache_key );

	if ( is_array( $cached ) ) {
		return $cached;
	}

	if ( false !== $cached ) {
		return null;
	}

	$response = wp_remote_get(
		BMFK_METAR_URL,
		array(
			'timeout'    => 4,
			'user-agent' => bmfk_weather_user_agent(),
			'headers'    => array( 'Accept' => 'application/json' ),
		)
	);

	if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
		return bmfk_weather_unavailable( $cache_key );
	}

	$payload = json_decode( wp_remote_retrieve_body( $response ), true );
	$report  = isset( $payload[0] ) && is_array( $payload[0] ) ? $payload[0] : null;

	if ( ! is_array( $report ) || ! isset( $report['wspd'] ) ) {
		return bmfk_weather_unavailable( $cache_key );
	}

	$direction_degrees = isset( $report['wdir'] ) && is_numeric( $report['wdir'] ) ? (float) $report['wdir'] : null;
	$observation_time  = isset( $report['obsTime'] ) && is_numeric( $report['obsTime'] )
		? (int) $report['obsTime']
		: ( isset( $report['obsTime'] ) ? strtotime( $report['obsTime'] ) : time() );

	if ( false === $observation_time ) {
		$observation_time = time();
	}

	$data = array(
		'name'              => 'Bodø lufthavn',
		'kind'              => 'Målt referanse',
		'source'            => 'METAR ENBO',
		'source_url'        => BMFK_METAR_SOURCE_URL,
		'time'              => $observation_time,
		'wind_speed'        => round( (float) $report['wspd'] * 0.514444, 1 ),
		'wind_gust'         => isset( $report['wgst'] ) && is_numeric( $report['wgst'] ) ? round( (float) $report['wgst'] * 0.514444, 1 ) : null,
		'direction_degrees' => $direction_degrees,
		'direction_label'   => null === $direction_degrees ? 'Variabel' : bmfk_weather_direction_label( $direction_degrees ),
		'temperature'       => isset( $report['temp'] ) && is_numeric( $report['temp'] ) ? (float) $report['temp'] : null,
		'precipitation'     => null,
	);

	return bmfk_weather_store( $cache_key, $data, 10 * MINUTE_IN_SECONDS );
}

/**
 * Return all sources used by the front-page weather panel.
 *
 * @return array
 */
function bmfk_get_weather_data() {
	return array(
		'bestemorenga' => bmfk_weather_get_bestemorenga_forecast(),
		'keiservarden' => bmfk_weather_get_keiservarden_forecast(),
		'metar'         => bmfk_weather_get_bodo_metar(),
	);
}

/**
 * Format a weather timestamp in Bodø's local time.
 *
 * The explicit named timezone keeps daylight-saving time correct even if the
 * WordPress installation uses a fixed UTC offset instead of Europe/Oslo.
 *
 * @param int $timestamp Unix timestamp.
 * @return string
 */
function bmfk_weather_local_time( $timestamp ) {
	static $timezone = null;

	if ( null === $timezone ) {
		$timezone = new DateTimeZone( 'Europe/Oslo' );
	}

	return wp_date( 'H:i', (int) $timestamp, $timezone );
}

/**
 * Render the station cards used on the front page and by the refresh endpoint.
 *
 * @param array|null $weather_data Optional preloaded weather data.
 * @return string Escaped station-card markup.
 */
function bmfk_weather_stations_html( $weather_data = null ) {
	if ( ! is_array( $weather_data ) ) {
		$weather_data = bmfk_get_weather_data();
	}

	ob_start();
	?>
	<?php foreach ( $weather_data as $station_key => $station ) : ?>
		<article class="field-weather__station field-weather__station--<?php echo esc_attr( $station_key ); ?>">
			<?php if ( is_array( $station ) ) : ?>
				<?php
				$is_old     = ! empty( $station['is_stale'] ) || ( time() - (int) $station['time'] ) > 90 * MINUTE_IN_SECONDS;
				$time_label = 'metar' === $station_key ? 'Målt' : 'Gjelder';
				?>
				<div class="field-weather__station-heading">
					<div>
						<h4><?php echo esc_html( $station['name'] ); ?></h4>
						<span><?php echo esc_html( $station['kind'] ); ?></span>
					</div>
					<a href="<?php echo esc_url( $station['source_url'] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $station['source'] ); ?></a>
				</div>
				<div class="field-weather__reading">
					<strong><?php echo esc_html( number_format_i18n( $station['wind_speed'], 1 ) ); ?></strong>
					<span>m/s</span>
					<span class="field-weather__direction">
						<?php if ( null !== $station['direction_degrees'] ) : ?>
							<span class="field-weather__arrow" style="--weather-direction: <?php echo esc_attr( $station['direction_degrees'] ); ?>deg" aria-hidden="true">↑</span>
						<?php endif; ?>
						<?php echo esc_html( $station['direction_label'] ); ?>
					</span>
				</div>
				<div class="field-weather__meta">
					<span>Kast <strong><?php echo null === $station['wind_gust'] ? '–' : esc_html( number_format_i18n( $station['wind_gust'], 1 ) ) . ' m/s'; ?></strong></span>
					<?php if ( isset( $station['temperature'] ) ) : ?>
						<span>Temp <strong><?php echo esc_html( number_format_i18n( $station['temperature'], 1 ) ); ?> °C</strong></span>
					<?php endif; ?>
					<?php if ( isset( $station['precipitation'] ) ) : ?>
						<span>Nedbør 1 t. <strong><?php echo esc_html( number_format_i18n( $station['precipitation'], 1 ) ); ?> mm</strong></span>
					<?php endif; ?>
					<time datetime="<?php echo esc_attr( gmdate( DATE_W3C, (int) $station['time'] ) ); ?>"<?php echo $is_old ? ' class="is-old"' : ''; ?>><?php echo esc_html( $time_label . ' ' . bmfk_weather_local_time( $station['time'] ) ); ?><?php echo $is_old ? ' · eldre' : ''; ?></time>
				</div>
			<?php else : ?>
				<h4>Datakilden er midlertidig utilgjengelig</h4>
				<p>Prøv igjen om litt.</p>
			<?php endif; ?>
		</article>
	<?php endforeach; ?>
	<?php

	return (string) ob_get_clean();
}

/**
 * Return fresh station markup to an already open front page.
 *
 * @return WP_REST_Response
 */
function bmfk_weather_rest_response() {
	$response = rest_ensure_response(
		array(
			'html'         => bmfk_weather_stations_html(),
			'refreshed_at' => time(),
		)
	);

	$response->header( 'Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0' );
	$response->header( 'Pragma', 'no-cache' );

	return $response;
}

/**
 * Register the public, read-only weather refresh endpoint.
 */
function bmfk_register_weather_rest_route() {
	register_rest_route(
		'bmfk/v1',
		'/weather',
		array(
			'methods'             => 'GET',
			'callback'            => 'bmfk_weather_rest_response',
			'permission_callback' => '__return_true',
		)
	);
}
add_action( 'rest_api_init', 'bmfk_register_weather_rest_route' );
