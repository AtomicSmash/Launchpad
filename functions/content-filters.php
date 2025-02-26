<?php
/**
 * Filters for content tags
 */

namespace Launchpad\Content\Filters;

/**
 * A function for updating the archive title to remove prefixes.
 *
 * @param string $title the current title to be filtered.
 */
function update_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	}
	return $title;
}

add_filter( 'get_the_archive_title', __NAMESPACE__ . '\\update_archive_title' );
