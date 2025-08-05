<?php
/**
 * Add custom post types
 */

namespace Launchpad\PostTypes;

/**
 * Add custom post types.
 */
function register_post_types(): void {
	\register_extended_post_type(
		'global-banner',
		array(
			'show_in_feed' => false,
			'show_in_rest' => true,
			'public' => false,
			'show_ui' => true,
			'has_archive' => false,
			'supports' => array( 'title', 'editor', 'revisions' ),
			'template' => array(
				array(
					'launchpad-blocks/global-banner',
					array(),
					array(
						array(
							'core/paragraph',
							array(
								'placeholder' => 'Add some text here...',
								'style' => array(
									'layout' => array(
										'selfStretch' => 'fill',
										'flexSize' => null,
									),
								),
							),
						),
					),
				),
			),
			'template_lock' => 'all',
		),
		array(
			'singular' => 'Global banner',
			'plural'   => 'Global banners',
			'slug'     => 'global-banner',
		)
	);
}
add_action( 'init', __NAMESPACE__ . '\\register_post_types' );
