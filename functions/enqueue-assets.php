<?php
/**
 * Enqueue global assets
 */

namespace Launchpad\Enqueue;

use Launchpad\Assets, WP_Error, Error;

$assets = new Assets();
add_action( 'wp_footer', array( $assets, 'output_manifest_file_for_js' ), 10 );
add_action( 'admin_footer', array( $assets, 'output_manifest_file_for_js' ), 10 );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the enqueue_block_assets
 *
 * @throws Error If there's an issue loading the asset.
 */
function add_editor_content_styles() {
	// We have to check is_admin because this hook also fires on the front end.
	if ( is_admin() ) {
		$assets = new Assets();

		$main_stylesheet = $assets->get_cached_asset_from_parent( '/css/styles.css' );
		if ( is_wp_error( $main_stylesheet ) ) {
			/**
			 * $main_stylesheet is WP_Error
			 *
			 * @var WP_Error $main_stylesheet
			 */
			throw new Error( wp_kses_post( $main_stylesheet->get_error_message() ) );
		}
		wp_enqueue_style( 'launchpad-theme', $main_stylesheet['source'], $main_stylesheet['dependencies'], $main_stylesheet['version'] );

		$editor_content_stylesheet = $assets->get_cached_asset_from_parent( '/css/editor-content.css' );
		if ( is_wp_error( $editor_content_stylesheet ) ) {
			/**
			 * $editor_content_stylesheet is WP_Error
			 *
			 * @var WP_Error $editor_content_stylesheet
			 */
			throw new Error( wp_kses_post( $editor_content_stylesheet->get_error_message() ) );
		}
		wp_enqueue_style( 'launchpad-editor-content', $editor_content_stylesheet['source'], $editor_content_stylesheet['dependencies'], $editor_content_stylesheet['version'] );
	}
}
add_action( 'enqueue_block_assets', __NAMESPACE__ . '\\add_editor_content_styles' );

/**
 * Add styles which are used to style editor controls
 *
 * Note that this function is hooked into the enqueue_block_editor_assets hook
 *
 * @throws Error If there's an issue loading the asset.
 */
function add_editor_control_styles() {
	$assets = new Assets();

	$editor_controls_stylesheet = $assets->get_cached_asset_from_parent( '/css/editor-controls.css' );
	if ( is_wp_error( $editor_controls_stylesheet ) ) {
		/**
		 * $editor_controls_stylesheet is WP_Error
		 *
		 * @var WP_Error $editor_controls_stylesheet
		 */
		throw new Error( wp_kses_post( $editor_controls_stylesheet->get_error_message() ) );
	}
	wp_enqueue_style( 'launchpad-editor-controls', $editor_controls_stylesheet['source'], $editor_controls_stylesheet['dependencies'], $editor_controls_stylesheet['version'] );
	
	$formatters_script = $assets->get_cached_asset_from_parent( '/js/formatters.js' );
	if ( is_wp_error( $formatters_script ) ) {
		/**
		 * $formatters_script is WP_Error
		 *
		 * @var WP_Error $formatters_script
		 */
		throw new Error( wp_kses_post( $formatters_script->get_error_message() ) );
	}
	wp_enqueue_script( 'launchpad-formatters', $formatters_script['source'], $formatters_script['dependencies'], $formatters_script['version'], array( 'strategy' => 'defer' ) );
}
add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\add_editor_control_styles' );

/**
 * Enqueue styles and scripts on the frontend.
 *
 * @throws Error If there's an issue loading the asset.
 */
function scripts() {
	$assets = new Assets();
	$main_stylesheet = $assets->get_cached_asset_from_parent( '/css/styles.css' );
	if ( is_wp_error( $main_stylesheet ) ) {
		/**
		 * $main_stylesheet is WP_Error
		 *
		 * @var WP_Error $main_stylesheet
		 */
		throw new Error( wp_kses_post( $main_stylesheet->get_error_message() ) );
	}
	wp_enqueue_style( 'launchpad-theme', $main_stylesheet['source'], $main_stylesheet['dependencies'], $main_stylesheet['version'] );
	wp_enqueue_style( 'launchpad-theme-info', get_template_directory_uri() . '/style.css', array(), filemtime( get_template_directory() . '/style.css' ) );

	$admin_bar_height_script = $assets->get_cached_asset_from_parent( '/js/fixWPAdminBarHeight.js' );
	if ( is_wp_error( $admin_bar_height_script ) ) {
		/**
		 * $admin_bar_height_script is WP_Error
		 *
		 * @var WP_Error $admin_bar_height_script
		 */
		throw new Error( wp_kses_post( $admin_bar_height_script->get_error_message() ) );
	}
	wp_enqueue_script( 'launchpad-fix-admin-bar-height', $admin_bar_height_script['source'], $admin_bar_height_script['dependencies'], $admin_bar_height_script['version'], array( 'strategy' => 'defer' ) );
	$prefers_reduced_motion_script = $assets->get_cached_asset_from_parent( '/js/prefersReducedMotion.js' );
	if ( is_wp_error( $prefers_reduced_motion_script ) ) {
		/**
		 * $prefers_reduced_motion_script is WP_Error
		 *
		 * @var WP_Error $prefers_reduced_motion_script
		 */
		throw new Error( wp_kses_post( $prefers_reduced_motion_script->get_error_message() ) );
	}
	wp_enqueue_script( 'launchpad-prefers-reduced-motion', $prefers_reduced_motion_script['source'], $prefers_reduced_motion_script['dependencies'], $prefers_reduced_motion_script['version'], array( 'strategy' => 'defer' ) );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\scripts', 10 );

/**
 * Enqueue scripts in the editor.
 *
 * @throws Error If there's an issue loading the asset.
 */
function editor_scripts() {
	$assets = new Assets();
	$register_custom_icons_script = $assets->get_cached_asset_from_parent( '/js/registerCustomIcons.js' );
	if ( is_wp_error( $register_custom_icons_script ) ) {
		/**
		 * $register_custom_icons_script is WP_Error
		 *
		 * @var WP_Error $register_custom_icons_script
		 */
		throw new Error( wp_kses_post( $register_custom_icons_script->get_error_message() ) );
	}
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
