<?php
/**
 * Block registration.
 */

namespace Launchpad\Blocks\Disable;

use WP_Block_Type_Registry;

/**
 * Deregister blocks
 *
 * In general we want to support as many blocks as possible,
 * but in the rare case you need to remove a block, you can do so here.
 *
 * @param string[]|true $allowed_block_types The allowed block names in the editor.
 *
 * @return string[]
 */
function disable_specific_blocks( array|bool $allowed_block_types ): array {
	// Add block names to this array to disable them
	$disabled_blocks = array(
		'core/details', // we disable this in favour of the Launchpad Blocks Accordion block for accessibility reasons.
		'core/accordion', // we disable this to avoid confusion with the Launchpad Blocks Accordion block.
	);

	$allowed_block_types = ( true === $allowed_block_types ) ? array_keys(
		WP_Block_Type_Registry::get_instance()->get_all_registered()
	) : $allowed_block_types;

	$new_allowed_block_types = array();
	foreach ( $allowed_block_types as $block_name ) {

		if ( in_array( $block_name, $disabled_blocks, true ) ) {
			continue;
		}
		$new_allowed_block_types[] = $block_name;
	}

	return $new_allowed_block_types;
}
add_filter( 'allowed_block_types_all', __NAMESPACE__ . '\\disable_specific_blocks', 10, 1 );
