<?php
/**
 * Add theme settings page.
 */

// Define all options at the top (single source of truth).
$converso_color_options = array(
	'base' => 'Base',
	'contrast' => 'Contrast'
);

$converso_category_options = array(
	'about' => 'About',
	'call_to_action' => 'Call to Action',
	'content' => 'Content',
	'faq' => 'FAQs',
	'featured' => 'Featured',
	'footer' => 'Footer',
	'gallery' => 'Gallery',
	'header' => 'Header',
	'hero' => 'Hero',
	'posts' => 'Posts',
	'pricing' => 'Pricing',
	'team' => 'Team',
	'template' => 'Template',
	'testimonials' => 'Testimonials'
);

// Option keys (for settings registration)
$converso_all_options = array_merge( array_keys( $converso_color_options ), array_keys( $converso_category_options ) );

/**
 * Add theme settings as a submenu under Appearance > Converso.
 */
add_action( 'admin_menu', function () {
	add_submenu_page(
		'themes.php',
		'Converso Settings',
		'Converso',
		'manage_options',
		'converso',
		'converso_theme_settings',
		150
	);
} );

/**
 * Display content for theme settings.
 */
function converso_theme_settings() {
	global $converso_color_options, $converso_category_options;

	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'You do not have sufficient permissions to access this page.' );
	}
	?>
	<div class="wrap">
		<h1><?php echo esc_html__( 'Theme Settings', 'converso' ); ?></h1>
		<p>
			<?php echo esc_html__( 'Enable these patterns ', 'converso' ); ?>
			<strong><?php echo esc_html__( 'by color', 'converso' ); ?></strong>
			<?php echo esc_html__( ' to display in the Block Inserter and Site Editor.', 'converso' ); ?>
		</p>
		<form method="post" action="options.php">
			<?php settings_fields( 'converso-theme-settings-group' ); ?>
			<?php do_settings_sections( 'converso-theme-settings-group' ); ?>

			<!-- COLOR OPTIONS -->
			<div style="max-width:880px; width:100%;">
				<table class="form-table" style="width:880px; min-width:880px;">
					<tr>
						<?php
						$color_keys = array_keys( $converso_color_options );
						$color_per_row = 4;
						while ( count( $color_keys ) % $color_per_row !== 0 ) {
							$color_keys[] = null;
						}
						foreach ( $color_keys as $i => $key ) {
							if ( $i > 0 && $i % $color_per_row === 0 )
								echo '</tr><tr>';
							echo '<td style="width:220px; vertical-align:middle;">';
							if ( $key ) {
								echo '<label style="font-weight:normal;">';
								echo '<input type="checkbox" name="converso_setting_option_' . esc_attr( $key ) . '" value="1" ' . checked( 1, get_option( 'converso_setting_option_' . $key, '1' ), false ) . ' style="margin-right:6px;"/>';
								echo esc_html__( $converso_color_options[ $key ], 'converso' );
								echo '</label>';
							}
							echo '</td>';
						}
						?>
					</tr>
				</table>
			</div>

			<hr style="max-width:880px; margin:16px 0 32px 0; border: none; border-top: 1px solid #ccd0d4;">
			<p style="max-width:880px;">
				<?php echo esc_html__( 'Enable these patterns ', 'converso' ); ?>
				<strong><?php echo esc_html__( 'by category', 'converso' ); ?></strong>
				<?php echo esc_html__( ' to display in the Block Inserter and Site Editor.', 'converso' ); ?>
			</p>

			<!-- CATEGORY OPTIONS -->
			<div style="max-width:880px; width:100%;">
				<table class="form-table" style="width:880px; min-width:880px;">
					<?php
					$category_keys = array_keys( $converso_category_options );
					$category_per_row = 4;
					while ( count( $category_keys ) % $category_per_row !== 0 ) {
						$category_keys[] = null;
					}
					for ( $i = 0; $i < count( $category_keys ); $i++ ) {
						if ( $i % $category_per_row === 0 )
							echo '<tr valign="top">';
						echo '<td style="width:220px; vertical-align:middle;">';
						$key = $category_keys[ $i ];
						if ( $key ) {
							echo '<label style="font-weight:normal;">';
							echo '<input type="checkbox" name="converso_setting_option_' . esc_attr( $key ) . '" value="1" ' . checked( 1, get_option( 'converso_setting_option_' . $key, '1' ), false ) . ' style="margin-right:6px;"/>';
							echo esc_html__( $converso_category_options[ $key ], 'converso' );
							echo '</label>';
						}
						echo '</td>';
						if ( ( $i + 1 ) % $category_per_row === 0 )
							echo '</tr>';
					}
					?>
				</table>
			</div>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

/**
 * Register settings with sanitization.
 */
add_action( 'admin_init', function () use ($converso_all_options) {
	foreach ( $converso_all_options as $option ) {
		register_setting( 'converso-theme-settings-group', 'converso_setting_option_' . $option, 'sanitize_converso_theme_option' );
	}
} );

/**
 * Sanitize callback function.
 */
function sanitize_converso_theme_option( $input ) {
	return $input === '1' ? '1' : '0';
}

/**
 * Unregister patterns based on settings.
 */
add_action( 'init', function () {
	$patterns = [ 
		'converso_setting_option_base' => [ 
			'converso/about-half',
			'converso/about-split',
			'converso/call-to-action-button',
			'converso/call-to-action-centered',
			'converso/call-to-action-outline',
			'converso/call-to-action-promo',
			'converso/call-to-action-stacked',
			'converso/content-links',
			'converso/content-logos',
			'converso/content-social-numbers',
			'converso/faq-columns',
			'converso/faq-stacked',
			'converso/featured-columns',
			'converso/featured-content-boxes',
			'converso/featured-intro-columns',
			'converso/footer-mega',
			'converso/footer-multi-column',
			'converso/footer-split',
			'converso/footer-stacked',
			'converso/gallery-grid-multi',
			'converso/gallery-grid-square',
			'converso/gallery-mosaic',
			'converso/gallery-row',
			'converso/gallery-text-images',
			'converso/header-logo-button',
			'converso/header-logo-social',
			'converso/header-site-logo',
			'converso/header-title-separator',
			'converso/hero-basic-text-button',
			'converso/hero-columns-image-text',
			'converso/hero-columns-text-image',
			'converso/hero-cover-stack',
			'converso/hero-image-text-buttons',
			'converso/hero-stacked-text-image',
			'converso/posts-grid',
			'converso/posts-list',
			'converso/pricing-2-columns',
			'converso/pricing-3-columns',
			'converso/team-columns',
			'converso/team-single-image-text',
			'converso/team-single-text-image',
			'converso/template-page-cover',
			'converso/template-page-featured',
			'converso/template-page-sidebar',
			'converso/template-post-cover',
			'converso/template-post-featured',
			'converso/template-post-sidebar',
			'converso/testimonials-bold',
			'converso/testimonials-columns',
			'converso/testimonials-grid',
			'converso/testimonials-single'
		],
		'converso_setting_option_contrast' => [ 
			'converso/about-half-contrast',
			'converso/about-split-contrast',
			'converso/call-to-action-button-contrast',
			'converso/call-to-action-centered-contrast',
			'converso/call-to-action-outline-contrast',
			'converso/call-to-action-promo-contrast',
			'converso/call-to-action-stacked-contrast',
			'converso/content-links-contrast',
			'converso/content-logos-contrast',
			'converso/content-social-numbers-contrast',
			'converso/faq-columns-contrast',
			'converso/faq-stacked-contrast',
			'converso/featured-columns-contrast',
			'converso/featured-content-boxes-contrast',
			'converso/featured-intro-columns-contrast',
			'converso/footer-contrast',
			'converso/footer-mega-contrast',
			'converso/footer-multi-column-contrast',
			'converso/footer-split-contrast',
			'converso/footer-stacked-contrast',
			'converso/gallery-grid-multi-contrast',
			'converso/gallery-grid-square-contrast',
			'converso/gallery-mosaic-contrast',
			'converso/gallery-row-contrast',
			'converso/gallery-text-images-contrast',
			'converso/header-contrast',
			'converso/header-logo-button-contrast',
			'converso/header-logo-social-contrast',
			'converso/header-site-logo-contrast',
			'converso/header-title-separator-contrast',
			'converso/hero-basic-text-button-contrast',
			'converso/hero-columns-image-text-contrast',
			'converso/hero-columns-text-image-contrast',
			'converso/hero-cover-stack-contrast',
			'converso/hero-image-text-buttons-contrast',
			'converso/hero-stacked-text-image-contrast',
			'converso/posts-contrast',
			'converso/posts-grid-contrast',
			'converso/posts-list-contrast',
			'converso/pricing-2-columns-contrast',
			'converso/pricing-3-columns-contrast',
			'converso/team-columns-contrast',
			'converso/team-single-image-text-contrast',
			'converso/team-single-text-image-contrast',
			'converso/testimonials-bold-contrast',
			'converso/testimonials-columns-contrast',
			'converso/testimonials-grid-contrast',
			'converso/testimonials-single-contrast'
		],
		'converso_setting_option_about' => [ 
			'converso/about-half-contrast',
			'converso/about-half',
			'converso/about-split-contrast',
			'converso/about-split'
		],
		'converso_setting_option_call_to_action' => [ 
			'converso/call-to-action-button-contrast',
			'converso/call-to-action-button',
			'converso/call-to-action-centered-contrast',
			'converso/call-to-action-centered',
			'converso/call-to-action-outline-contrast',
			'converso/call-to-action-outline',
			'converso/call-to-action-promo-contrast',
			'converso/call-to-action-promo',
			'converso/call-to-action-stacked-contrast',
			'converso/call-to-action-stacked'
		],
		'converso_setting_option_content' => [ 
			'converso/content-links-contrast',
			'converso/content-links',
			'converso/content-logos-contrast',
			'converso/content-logos',
			'converso/content-social-numbers-contrast',
			'converso/content-social-numbers'
		],
		'converso_setting_option_faq' => [ 
			'converso/faq-columns-contrast',
			'converso/faq-columns',
			'converso/faq-stacked-contrast',
			'converso/faq-stacked'
		],
		'converso_setting_option_featured' => [ 
			'converso/featured-columns-contrast',
			'converso/featured-columns',
			'converso/featured-content-boxes-contrast',
			'converso/featured-content-boxes',
			'converso/featured-intro-columns-contrast',
			'converso/featured-intro-columns'
		],
		'converso_setting_option_footer' => [ 
			'converso/footer-contrast',
			'converso/footer-mega-contrast',
			'converso/footer-mega',
			'converso/footer-multi-column-contrast',
			'converso/footer-multi-column',
			'converso/footer-split-contrast',
			'converso/footer-split',
			'converso/footer-stacked-contrast',
			'converso/footer-stacked'
		],
		'converso_setting_option_gallery' => [ 
			'converso/gallery-grid-multi-contrast',
			'converso/gallery-grid-multi',
			'converso/gallery-grid-square-contrast',
			'converso/gallery-grid-square',
			'converso/gallery-mosaic-contrast',
			'converso/gallery-mosaic',
			'converso/gallery-row-contrast',
			'converso/gallery-row',
			'converso/gallery-text-images-contrast',
			'converso/gallery-text-images'
		],
		'converso_setting_option_header' => [ 
			'converso/header-contrast',
			'converso/header-logo-button-contrast',
			'converso/header-logo-button',
			'converso/header-logo-social-contrast',
			'converso/header-logo-social',
			'converso/header-site-logo-contrast',
			'converso/header-site-logo',
			'converso/header-title-separator-contrast',
			'converso/header-title-separator'
		],
		'converso_setting_option_hero' => [ 
			'converso/hero-basic-text-button-contrast',
			'converso/hero-basic-text-button',
			'converso/hero-columns-image-text-contrast',
			'converso/hero-columns-image-text',
			'converso/hero-columns-text-image-contrast',
			'converso/hero-columns-text-image',
			'converso/hero-cover-stack-contrast',
			'converso/hero-cover-stack',
			'converso/hero-image-text-buttons-contrast',
			'converso/hero-image-text-buttons',
			'converso/hero-stacked-text-image-contrast',
			'converso/hero-stacked-text-image'
		],
		'converso_setting_option_posts' => [ 
			'converso/posts-contrast',
			'converso/posts-grid-contrast',
			'converso/posts-grid',
			'converso/posts-list-contrast',
			'converso/posts-list'
		],
		'converso_setting_option_pricing' => [ 
			'converso/pricing-2-columns-contrast',
			'converso/pricing-2-columns',
			'converso/pricing-3-columns-contrast',
			'converso/pricing-3-columns'
		],
		'converso_setting_option_team' => [ 
			'converso/team-columns-contrast',
			'converso/team-columns',
			'converso/team-single-image-text-contrast',
			'converso/team-single-image-text',
			'converso/team-single-text-image-contrast',
			'converso/team-single-text-image'
		],
		'converso_setting_option_template' => [ 
			'converso/template-page-cover',
			'converso/template-page-featured',
			'converso/template-page-sidebar-left',
			'converso/template-page-sidebar-right',
			'converso/template-post-cover',
			'converso/template-post-featured',
			'converso/template-post-sidebar-left',
			'converso/template-post-sidebar-right'
		],
		'converso_setting_option_testimonials' => [ 
			'converso/testimonials-bold-contrast',
			'converso/testimonials-bold',
			'converso/testimonials-columns-contrast',
			'converso/testimonials-columns',
			'converso/testimonials-grid-contrast',
			'converso/testimonials-grid',
			'converso/testimonials-single-contrast',
			'converso/testimonials-single'
		]
	];

	foreach ( $patterns as $option => $pattern_ids ) {
		if ( get_option( $option, '1' ) !== '1' ) {
			foreach ( $pattern_ids as $pattern_id ) {
				unregister_block_pattern( $pattern_id );
			}
		}
	}
} );
