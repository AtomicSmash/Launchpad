<?php
/**
 * Block patterns.
 */

namespace Launchpad\Blocks\Styles;

/**
 * Add custom styles to WP blocks.
 *
 * @see register_block_style
 */
function register_block_styles() {
	// Enter any custom block style variants here using register_block_style.
}
add_action( 'init', __NAMESPACE__ . '\\register_block_styles' );
