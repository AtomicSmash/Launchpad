<?php
/**
 * Enqueue global assets
 */

namespace Launchpad\Enqueue;

use Launchpad\Assets;

$assets = new Assets();
add_action( 'wp_footer', array( $assets, 'output_manifest_file_for_js' ), 10 );
add_action( 'admin_footer', array( $assets, 'output_manifest_file_for_js' ), 10 );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the enqueue_block_assets
 */
function add_editor_content_styles() {
	// Enqueue editor styles.
	$assets = new Assets();

	$main_stylesheet = $assets->get_cached_asset_from_parent( '/css/styles.css' );
	wp_enqueue_style( 'launchpad-theme', $main_stylesheet['source'], $main_stylesheet['dependencies'], $main_stylesheet['version'] );

	$editor_content_stylesheet = $assets->get_cached_asset_from_parent( '/css/editor-content.css' );
	wp_enqueue_style( 'launchpad-editor-content', $editor_content_stylesheet['source'], $editor_content_stylesheet['dependencies'], $editor_content_stylesheet['version'] );
}
add_action( 'enqueue_block_assets', __NAMESPACE__ . '\\add_editor_content_styles' );

/**
 * Add styles which are used to style editor controls
 *
 * Note that this function is hooked into the enqueue_block_editor_assets hook
 */
function add_editor_control_styles() {
	if ( is_admin() ) {
			// Enqueue editor control styles.
		$assets = new Assets();

		$editor_controls_stylesheet = $assets->get_cached_asset_from_parent( '/css/editor-controls.css' );
		wp_enqueue_style( 'launchpad-editor-controls', $editor_controls_stylesheet['source'], $editor_controls_stylesheet['dependencies'], $editor_controls_stylesheet['version'] );
		
		$formatters_script = $assets->get_cached_asset_from_parent( '/js/formatters.js' );
		wp_enqueue_script( 'launchpad-formatters', $formatters_script['source'], $formatters_script['dependencies'], $formatters_script['version'], array( 'strategy' => 'defer' ) );
	}
}
add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\add_editor_control_styles' );

/**
 * Enqueue styles and scripts on the frontend.
 */
function scripts() {
	$assets = new Assets();
	// For CSS, only load the parent theme CSS so we can overwrite it in the child theme easily.
	$main_stylesheet = $assets->get_cached_asset_from_parent( '/css/styles.css' );
	wp_enqueue_style( 'launchpad-theme', $main_stylesheet['source'], $main_stylesheet['dependencies'], $main_stylesheet['version'] );
	wp_enqueue_style( 'launchpad-theme-info', get_template_directory_uri() . '/style.css', array(), filemtime( get_template_directory() . '/style.css' ) );

	// For JS, let the child theme overwrite the file by providing it so there isn't a JS conflict and the child theme doesn't need to deregister these files.
	$admin_bar_height_script = $assets->get_cached_asset( '/js/fixWPAdminBarHeight.js' );
	wp_enqueue_script( 'launchpad-fix-admin-bar-height', $admin_bar_height_script['source'], $admin_bar_height_script['dependencies'], $admin_bar_height_script['version'], array( 'strategy' => 'defer' ) );
	$prefers_reduced_motion_script = $assets->get_cached_asset( '/js/prefersReducedMotion.js' );
	wp_enqueue_script( 'launchpad-prefers-reduced-motion', $prefers_reduced_motion_script['source'], $prefers_reduced_motion_script['dependencies'], $prefers_reduced_motion_script['version'], array( 'strategy' => 'defer' ) );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\scripts', 10 );

/**
 * Enqueue scripts in the editor.
 */
function editor_scripts() {
	$assets = new Assets();
	$register_custom_icons_script = $assets->get_cached_asset( '/js/registerCustomIcons.js' );
	wp_enqueue_script(
		'launchpad-register-custom-icons',
		$register_custom_icons_script['source'],
		$register_custom_icons_script['dependencies'],
		$register_custom_icons_script['version'],
		true
	);
}
add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\editor_scripts', 10 );

/**
 * Fix for enqueue_block_assets loading twice in editor.
 */
function remove_iframe_styles_from_editor() {
	wp_dequeue_style( 'launchpad-theme' );
	wp_dequeue_style( 'launchpad-editor-content' );
}
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\\remove_iframe_styles_from_editor', 10 );
