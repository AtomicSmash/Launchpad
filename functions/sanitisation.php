<?php
/**
 * Sanitisation
 */

namespace Launchpad\Sanitisation;

add_filter(
	'wp_kses_allowed_html',
	function ( $tags ) {
		return $tags;
	},
	10,
	2
);
