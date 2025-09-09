<?php
/**
 * Register pattern category.
 */
function converso_register_pattern_category( $slug, $label, $description ) {
	register_block_pattern_category(
		'converso-' . $slug,
		array(
			'label' => __( $label, 'converso' ),
			'description' => __( $description, 'converso' ),
		)
	);
}

/**
 * Register pattern categories.
 */
function converso_register_pattern_categories() {
	$categories = array(
		'about' => array( __( 'About', 'converso' ), __( 'A collection of about patterns for Converso.', 'converso' ) ),
		'call-to-action' => array( __( 'Call to Action', 'converso' ), __( 'A collection of call to action patterns for Converso.', 'converso' ) ),
		'content' => array( __( 'Content', 'converso' ), __( 'A collection of content patterns for Converso.', 'converso' ) ),
		'faq' => array( __( 'FAQs', 'converso' ), __( 'A collection of FAQ patterns for Converso.', 'converso' ) ),
		'featured' => array( __( 'Featured', 'converso' ), __( 'A collection of featured patterns for Converso.', 'converso' ) ),
		'footer' => array( __( 'Footer', 'converso' ), __( 'A collection of footer patterns for Converso.', 'converso' ) ),
		'gallery' => array( __( 'Gallery', 'converso' ), __( 'A collection of gallery patterns for Converso.', 'converso' ) ),
		'header' => array( __( 'Header', 'converso' ), __( 'A collection of header patterns for Converso.', 'converso' ) ),
		'hero' => array( __( 'Hero', 'converso' ), __( 'A collection of hero patterns for Converso.', 'converso' ) ),
		'posts' => array( __( 'Posts', 'converso' ), __( 'A collection of posts patterns for Converso.', 'converso' ) ),
		'pricing' => array( __( 'Pricing', 'converso' ), __( 'A collection of pricing patterns for Converso.', 'converso' ) ),
		'team' => array( __( 'Team', 'converso' ), __( 'A collection of team patterns for Converso.', 'converso' ) ),
		'template' => array( __( 'Template', 'converso' ), __( 'A collection of template patterns for Converso.', 'converso' ) ),
		'testimonials' => array( __( 'Testimonials', 'converso' ), __( 'A collection of testimonials patterns for Converso.', 'converso' ) ),
	);

	foreach ( $categories as $slug => $details ) {
		converso_register_pattern_category( $slug, $details[0], $details[1] );
	}
}
add_action( 'init', 'converso_register_pattern_categories' );
