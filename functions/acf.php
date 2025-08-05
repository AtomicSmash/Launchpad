<?php
/**
 * ACF filters and hooks
 */

namespace Launchpad\ACF;

if ( wp_get_environment_type() !== 'development' ) {
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
	define( 'ACF_LITE', true );
}

/**
 * Load ACF fields from Launchpad when in child theme.
 *
 * @param string[] $paths The ACF paths to load json from.
 *
 * @return string[]
 */
function load_acf_fields_from_launchpad( array $paths ): array {
	$paths[] = get_template_directory() . '/acf-json';

	return $paths;
}
add_filter( 'acf/settings/load_json', __NAMESPACE__ . '\\load_acf_fields_from_launchpad' );
