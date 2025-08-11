<?php
/**
 * Enqueue global assets
 */

namespace Launchpad\Enqueue;

use Launchpad\Assets, WP_Error, Error;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the enqueue_block_assets
 *
 * @throws Error If there's an issue loading the asset.
 */
function add_editor_content_styles(): void {
	// We have to check is_admin because this hook also fires on the front end.
	if ( is_admin() ) {
		$assets = new Assets();

		$editor_content_stylesheet = $assets->get_cached_asset( 'styles/editor-content.scss' );
		if ( is_wp_error( $editor_content_stylesheet ) ) {
			/**
			 * $editor_content_stylesheet is WP_Error
			 *
			 * @var WP_Error $editor_content_stylesheet
			 */
			throw new Error( wp_kses_post( $editor_content_stylesheet->get_error_message() ) );
		}
		wp_enqueue_style( 'launchpad-editor-content', $editor_content_stylesheet['source'], $editor_content_stylesheet['dependencies'], $editor_content_stylesheet['version'] );
		if ( ! is_child_theme() ) {
			$variables_stylesheet = $assets->get_cached_asset( 'styles/variables.scss' );
			if ( is_wp_error( $variables_stylesheet ) ) {
				/**
				 * $variables_stylesheet is WP_Error
				 *
				 * @var WP_Error $variables_stylesheet
				 */
				throw new Error( wp_kses_post( $variables_stylesheet->get_error_message() ) );
			}
			wp_enqueue_style( 'launchpad-colours', $variables_stylesheet['source'], $variables_stylesheet['dependencies'], $variables_stylesheet['version'] );
		}
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
function add_editor_control_styles(): void {
	$assets = new Assets();

	$editor_controls_stylesheet = $assets->get_cached_asset( 'styles/editor-controls.scss' );
	if ( is_wp_error( $editor_controls_stylesheet ) ) {
		/**
		 * $editor_controls_stylesheet is WP_Error
		 *
		 * @var WP_Error $editor_controls_stylesheet
		 */
		throw new Error( wp_kses_post( $editor_controls_stylesheet->get_error_message() ) );
	}
	wp_enqueue_style( 'launchpad-editor-controls', $editor_controls_stylesheet['source'], $editor_controls_stylesheet['dependencies'], $editor_controls_stylesheet['version'] );

	$formatters_script = $assets->get_cached_asset( 'scripts/formatters.tsx' );
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
function scripts(): void {
	$assets = new Assets();
	$main_stylesheet = $assets->get_cached_asset( 'styles/styles.scss' );
	if ( is_wp_error( $main_stylesheet ) ) {
		/**
		 * $main_stylesheet is WP_Error
		 *
		 * @var WP_Error $main_stylesheet
		 */
		throw new Error( wp_kses_post( $main_stylesheet->get_error_message() ) );
	}
	wp_enqueue_style( 'launchpad-theme', $main_stylesheet['source'], $main_stylesheet['dependencies'], $main_stylesheet['version'] );
	if ( ! is_child_theme() ) {
		$variables_stylesheet = $assets->get_cached_asset( 'styles/variables.scss' );
		if ( is_wp_error( $variables_stylesheet ) ) {
			/**
			 * $variables_stylesheet is WP_Error
			 *
			 * @var WP_Error $variables_stylesheet
			 */
			throw new Error( wp_kses_post( $variables_stylesheet->get_error_message() ) );
		}
		wp_enqueue_style( 'launchpad-colours', $variables_stylesheet['source'], $variables_stylesheet['dependencies'], $variables_stylesheet['version'] );
		wp_enqueue_style( 'launchpad-theme-info', get_template_directory_uri() . '/style.css', array(), filemtime( get_template_directory() . '/style.css' ) );
	}

	$admin_bar_height_script = $assets->get_cached_asset( 'scripts/fixWPAdminBarHeight.ts' );
	if ( is_wp_error( $admin_bar_height_script ) ) {
		/**
		 * $admin_bar_height_script is WP_Error
		 *
		 * @var WP_Error $admin_bar_height_script
		 */
		throw new Error( wp_kses_post( $admin_bar_height_script->get_error_message() ) );
	}
	wp_enqueue_script( 'launchpad-fix-admin-bar-height', $admin_bar_height_script['source'], $admin_bar_height_script['dependencies'], $admin_bar_height_script['version'], array( 'strategy' => 'defer' ) );

	$transparent_header_script = $assets->get_cached_asset( 'scripts/transparentHeader.ts' );
	if ( is_wp_error( $transparent_header_script ) ) {
		/**
		 * $transparent_header_script is WP_Error
		 *
		 * @var WP_Error $transparent_header_script
		 */
		throw new Error( wp_kses_post( $transparent_header_script->get_error_message() ) );
	}
	wp_enqueue_script( 'launchpad-transparent-header', $transparent_header_script['source'], $transparent_header_script['dependencies'], $transparent_header_script['version'], array( 'strategy' => 'defer' ) );

	$prefers_reduced_motion_script = $assets->get_cached_asset( 'scripts/prefersReducedMotion.ts' );
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
function editor_scripts(): void {
	$assets = new Assets();
	$register_custom_icons_script = $assets->get_cached_asset( 'scripts/registerCustomIcons.tsx' );
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
