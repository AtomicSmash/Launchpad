<?php
/**
 * SEO
 */

namespace Launchpad\SEO;

/**
 * Lowers the metabox priority for Yoast SEO's metabox.
 *
 * @return string The metabox priority.
 */
function lower_yoast_metabox_priority(): string {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', __NAMESPACE__ . '\\lower_yoast_metabox_priority' );
