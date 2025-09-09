<?php
/**
 * Add Sidebar template part.
 */
function converso_template_parts( array $areas ) {
	$areas[] = array(
		'area' => 'sidebar',
		'area_tag' => 'section',
		'label' => __( 'Sidebar', 'converso' ),
		'description' => __( 'The Sidebar template defines a page area that typically contains secondary content, navigation, or social icons.', 'converso' ),
		'icon' => 'sidebar',
	);

	return $areas;
}
add_filter( 'default_wp_template_part_areas', 'converso_template_parts' );
