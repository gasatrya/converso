<?php
/**
 * Register block styles.
 */
function converso_register_block_styles() {
	$block_styles = array(
		'core/button' => array(
			'light' => __( 'Light', 'converso' ),
			'shadow' => __( 'Shadow', 'converso' ),
		),
		'core/columns' => array(
			'column-reverse' => __( 'Reverse', 'converso' ),
		),
		'core/cover' => array(
			'gradient' => __( 'Gradient', 'converso' ),
		),
		'core/heading' => array(
			'balanced' => __( 'Balanced', 'converso' ),
		),
		'core/list' => array(
			'no-style' => __( 'No Style', 'converso' ),
		),
		'core/social-links' => array(
			'outline' => __( 'Outline', 'converso' ),
		),
	);
	foreach ( $block_styles as $block => $styles ) {
		foreach ( $styles as $style_name => $style_label ) {
			register_block_style(
				$block,
				array(
					'name' => $style_name,
					'label' => $style_label,
				)
			);
		}
	}
}
add_action( 'init', 'converso_register_block_styles' );
