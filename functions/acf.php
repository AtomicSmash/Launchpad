<?php
/**
 * Add custom post types
 */

namespace Launchpad\ACF;

if ( wp_get_environment_type() !== 'development' ) {
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
	define( 'ACF_LITE', true );
}
