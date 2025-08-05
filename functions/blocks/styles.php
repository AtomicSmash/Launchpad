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
function register_block_styles(): void {
	// Enter any custom block style variants here using register_block_style.
	register_block_style(
		array(
			'core/paragraph',
		),
		array(
			'name'  => 'body-large',
			'label' => 'Large',
		),
	);

	register_block_style(
		array(
			'core/paragraph',
			'core/heading',
		),
		array(
			'name'  => 't-1',
			'label' => 'T1',
		),
	);

	register_block_style(
		array(
			'core/paragraph',
			'core/heading',
		),
		array(
			'name'  => 't-2',
			'label' => 'T2',
		),
	);

	register_block_style(
		array(
			'core/paragraph',
			'core/heading',
		),
		array(
			'name'  => 't-3',
			'label' => 'T3',
		),
	);

	register_block_style(
		array(
			'core/paragraph',
			'core/heading',
		),
		array(
			'name'  => 't-4',
			'label' => 'T4',
		),
	);

	register_block_style(
		array(
			'core/paragraph',
			'core/heading',
		),
		array(
			'name'  => 't-5',
			'label' => 'T5',
		),
	);

	register_block_style(
		array(
			'core/paragraph',
			'core/heading',
		),
		array(
			'name'  => 't-6',
			'label' => 'T6',
		),
	);
}
add_action( 'init', __NAMESPACE__ . '\\register_block_styles' );
