<?php
/**
 * Helper functions
 */

namespace Launchpad\Helpers;

use Launchpad\Assets, Error, WPSEO_Primary_Term, WP_Block;

/**
 * Icon function
 *
 * This function generates an SVG from an icon name and allows custom attributes to be passed in
 *
 * @param string              $icon_name Icon name.
 * @param array<string,mixed> $attributes The HTML attributes to add to the SVG element.
 *
 * @throws Error If there's an issue loading the sprite.
 */
function icon( string $icon_name, array $attributes = array() ): string {
	$assets = new Assets();
	$icon_sprite = $assets->get_cached_asset( 'icons/sprite.svg' );
	$attrs = join(
		' ',
		array_map(
			function ( $key ) use ( $attributes ) {
				if ( is_bool( $attributes[ $key ] ) ) {
					return $attributes[ $key ] ? $key : '';
				}
				return $key . '="' . $attributes[ $key ] . '"';
			},
			array_keys( $attributes )
		)
	);

	$result = '<svg xmlns="http://www.w3.org/2000/svg" ' . $attrs . '><use href="' . $icon_sprite['source'] . '#' . $icon_name . '"></use></svg>';
	return $result;
}

/**
 * Add Launchpad icon renderer to icon block.
 *
 * @param array<string,function> $renderers An associative array of the currently registered renderers.
 *
 * @return array<string,function>
 */
function add_launchpad_icons_renderer_to_icon_block( array $renderers ): array {
	return array(
		'launchpad' => function ( string $icon_name, array $attributes = array() ) {
			return \Launchpad\Helpers\icon( $icon_name, $attributes );
		},
		...$renderers,
	);
}
add_filter( 'launchpad_blocks_icon_renderers', __NAMESPACE__ . '\\add_launchpad_icons_renderer_to_icon_block' );

/**
 * Get primary term of a taxonomy
 *
 * @param string   $the_taxonomy The taxonomy to get the primary term of.
 * @param int|null $post_id The post to get the terms from. Defaults to the current post.
 *
 * @return WP_Term|null The term object if one is found, or null if not found.
 */
function get_primary_term( string $the_taxonomy, int|null $post_id = null ): \WP_Term|null {
	$post_id = $post_id ?? get_the_ID();
	$term = null;
	if ( class_exists( 'WPSEO_Primary_Term' ) ) {
		// Show the post's 'Primary' category, if this Yoast feature is available, & one is set
		$yoast_primary_term = ( new \WPSEO_Primary_Term( $the_taxonomy, $post_id ) )->get_primary_term();
		if ( $yoast_primary_term ) {
			$term = get_term( $yoast_primary_term, $the_taxonomy );
			return $term;
		}
	}
	$the_terms = get_the_terms( $post_id, $the_taxonomy );
	if ( ! is_wp_error( $the_terms ) && $the_terms ) {
		$term = $the_terms[0];
	}
	return $term;
}

/**
 * Escape the value of a telephone number for use in a tel: link.
 *
 * @param string $phone_number The phone number to escape.
 */
function esc_tel_link( string $phone_number ): string {
	if ( str_starts_with( $phone_number, '+' ) && str_contains( $phone_number, '(0)' ) ) {
		$phone_number = str_replace( '(0)', '', $phone_number );
	}
	// Remove all characters that aren't numbers or the plus symbol.
	return (string) preg_replace( '/([^+0-9])/', '', $phone_number );
}
