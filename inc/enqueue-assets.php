<?php
/**
 * Enqueue theme stylesheet.
 */
function converso_enqueue_style_sheet() {
	wp_enqueue_style( 'converso', get_template_directory_uri() . '/style.css', array(), wp_get_theme( 'converso' )->get( 'Version' ) );
	wp_enqueue_script( 'converso-header', get_template_directory_uri() . '/assets/js/scroll-header.js', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'converso_enqueue_style_sheet' );
