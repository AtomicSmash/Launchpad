<?php
/**
 * ACF filters and hooks
 */

namespace Launchpad\Compatibility\WP_Rocket;

/** Prevent adding WP_CACHE constant to wp-config because it messes with our multi-config setup */
add_filter( 'rocket_set_wp_cache_constant', '__return_false' );

/**
 * Disable caching on non-production environments
 *
 * @link http://docs.wp-rocket.me/article/61-disable-page-caching
 */
function disable_wp_rocket_caching_on_staging() {
	return wp_get_environment_type() === 'production';
}
add_filter( 'do_rocket_generate_caching_files', __NAMESPACE__ . '\\disable_wp_rocket_caching_on_staging' );
