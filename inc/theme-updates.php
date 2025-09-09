<?php
/**
 * Check for theme updates.
 */
function converso_theme_updates( $transient ) {
	$update_url = 'https://briangardner.com/converso-updates.json';

	$response = wp_remote_get( $update_url );
	if ( is_wp_error( $response ) ) {
		return $transient;
	}

	$data = json_decode( wp_remote_retrieve_body( $response ) );
	if ( ! $data ) {
		return $transient;
	}

	$theme = wp_get_theme( 'converso' );
	$current_version = $theme->get( 'Version' );

	if ( version_compare( $current_version, $data->version, '<' ) ) {
		$transient->response['converso'] = array(
			'theme' => 'converso',
			'new_version' => $data->version,
			'url' => 'https://briangardner.com/converso/changelog/',
			'package' => $data->download_url,
		);
	}

	return $transient;
}
add_filter( 'pre_set_site_transient_update_themes', 'converso_theme_updates' );
