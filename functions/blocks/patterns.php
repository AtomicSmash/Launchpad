<?php
/**
 * Block patterns.
 */

namespace Launchpad\Blocks\Patterns;

/**
 * Registers block pattern categories
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_pattern_category/
 */
function launchpad_block_patterns_init(): void {
	register_block_pattern_category(
		'launchpad',
		array(
			'label' => __( 'Launchpad', 'launchpad' ),
		)
	);
	register_block_pattern_category(
		'spacers',
		array(
			'label' => __( 'Spacers', 'launchpad' ),
		)
	);
}
add_action( 'init', __NAMESPACE__ . '\\launchpad_block_patterns_init' );
