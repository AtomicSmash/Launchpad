<?php
/**
 * Menus
 */

namespace Launchpad\Menus;

/**
 * Register navigation menus
 */
function register_menus(): void {
	register_nav_menus(
		array(
			'footer_navigation_1' => __( 'Footer Navigation 1', 'launchpad' ),
			'footer_navigation_2' => __( 'Footer Navigation 2', 'launchpad' ),
			'footer_navigation_3' => __( 'Footer Navigation 3', 'launchpad' ),
		)
	);
}

add_filter( 'init', __NAMESPACE__ . '\\register_menus' );
