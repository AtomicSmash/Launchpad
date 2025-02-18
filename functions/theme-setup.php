<?php
/**
 * Theme setup
 */

namespace Launchpad\ThemeSetup;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook.
 */
function theme_setup() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'unlink-homepage-logo' );
	add_theme_support( 'block-template-parts' );
	add_theme_support( 'post-thumbnails' );
	remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\\theme_setup', 15 );

/**
 * Apply ugly hack to set correct root editor container classes
 *
 * Setting settings.useRootPaddingAwareAlignments to true should result in the global
 * padding class being added properly, but it does not so we add them manually. This
 * allows front-end and back-end layouts to match, since both containers use the same
 * padding.
 *
 * @see https://stackoverflow.com/questions/75912533/has-global-padding-not-added-to-is-root-container-in-wordpress
 */
function root_editor_container_padding_fix() {
	echo "<script>
		function getRootContainer() {
			let rootContainer = null;
			const timeStarted = Date.now();
			while (!rootContainer && Date.now() - timeStarted <= 5000) {
				const editorCanvas = document.querySelector('iframe[name=\"editor-canvas\"]');
				if (editorCanvas) {
					rootContainer =
						editorCanvas.contentWindow.document.querySelector(\".is-root-container\");
				} else {
					rootContainer = document.querySelector(\".is-root-container\");
				}
			}
			return rootContainer;
		}
		function setRootClass(rootContainer) {
			if (!rootContainer.classList.contains(\"has-global-padding\")) {
				rootContainer.classList.add(\"has-global-padding\");
				return rootContainer;
			}
		}
		window.addEventListener(\"load\", function () {
			const rootContainer = getRootContainer();
			if (rootContainer) {
				setRootClass(rootContainer);
				let debounceResizeTimeout = null;
				new ResizeObserver(() => {
					clearTimeout(debounceResizeTimeout);
					debounceResizeTimeout = setTimeout(() => {
						setRootClass(rootContainer);
					}, 100);
				}).observe(rootContainer);
			}
		});
	</script>";
}
add_action( 'admin_footer-post.php', __NAMESPACE__ . '\\root_editor_container_padding_fix' ); // Fired on post edit page
add_action( 'admin_footer-post-new.php', __NAMESPACE__ . '\\root_editor_container_padding_fix' ); // Fired on add new post page
