<?php
/**
 * Theme setup
 */

namespace Launchpad\BodyModifications;

/**
 * Add classes to the body on the front end.
 *
 * @param array $classes An array of class names.
 */
function body_classes( $classes ) {
	$classes[] = 'no-js';
   
	return $classes;
}
add_filter( 'body_class', __NAMESPACE__ . '\\body_classes' );

/**
 * Add JS to change the body class if JS is enabled
 */
function update_body_class() {
	?>
			<script>
				document.body.classList.replace("no-js", "js");
			</script>
	<?php
}
add_action( 'wp_footer', __NAMESPACE__ . '\\update_body_class' );
