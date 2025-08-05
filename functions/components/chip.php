<?php
/**
 * Chip component
 */

namespace Launchpad\Components\Chip;

/**
 * A function used to render a chip.
 *
 * @param string $content The content within the chip.
 * @param string $class_name An optional class to add to the chip.
 */
function render( string $content, string $class_name = '' ): string {

	return '<span class="c-chip' . ( ! empty( $class_name ) ? ' ' . esc_attr( $class_name ) : '' ) . '">
		' . wp_kses_post( $content ) . '
	</span>';
}
