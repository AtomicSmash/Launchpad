<?php
/**
 * Media
 */

namespace Launchpad\Media;

/**
 * Get the featured image for the current post.
 *
 * @param string $size Optional. Image size. Accepts any registered image size name, or an array
 *                               of width and height values in pixels (in that order). Default 'thumbnail'.
 * @param array  $attributes @see wp_get_attachment_image().
 */
function get_featured_image( string $size = 'thumbnail', $attributes = array() ) {
	$image_id = get_field( 'placeholder_image', 'options' );
	if ( has_post_thumbnail() ) {
		$image = get_the_post_thumbnail( null, $size, $attributes );
	} elseif ( false !== $image_id ) {
		$image = wp_get_attachment_image( $image_id, $size, false, $attributes );
	}
	return $image;
}
