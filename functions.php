<?php
/**
 * Functions file
 *
 * This is where you load all functions required by the theme.
 */

namespace Launchpad;

define( 'LAUNCHPAD_THEME_VERSION', '1.0.0-beta.0' );

require_once 'classes/class-assets.php';

use Launchpad\Enqueue\Assets;

$assets = new Assets();
add_action( 'wp_footer', array( $assets, 'output_manifest_file_for_js' ), 10 );
add_action( 'admin_footer', array( $assets, 'output_manifest_file_for_js' ), 10 );

if ( ! function_exists( 'theme_setup' ) ) :
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

		// Enqueue editor styles.
		$assets = new Assets();
		add_editor_style(
			$assets->get_cached_asset_from_parent(
				'/css/styles.css',
				array(
					'relative' => true,
				)
			)
		);
		add_editor_style(
			$assets->get_cached_asset_from_parent(
				'/css/editor-styles.css',
				array(
					'relative' => true,
				)
			)
		);
	}
endif;
add_action( 'after_setup_theme', __NAMESPACE__ . '\\theme_setup' );

/**
 * Enqueue styles and scripts on the frontend.
 */
function scripts() {
	$assets = new Assets();
	// phpcs:disable WordPress.WP.EnqueuedResourceParameters.MissingVersion
	// For CSS, only load the parent theme CSS so we can overwrite it in the child theme easily.
	wp_enqueue_style( 'launchpad-theme', $assets->get_cached_asset_from_parent( '/css/styles.css' ), array(), null );
	wp_enqueue_style( 'launchpad-theme-info', get_template_directory_uri() . '/style.css', array(), filemtime( get_template_directory() . '/style.css' ) );

	// For JS, let the child theme overwrite the file by providing it so there isn't a JS conflict and the child theme doesn't need to deregister these files.
	wp_enqueue_script( 'launchpad-fix-admin-bar-height', $assets->get_cached_asset( '/js/fixWPAdminBarHeight.js' ), array(), null, array( 'strategy' => 'defer' ) );
	wp_enqueue_script( 'launchpad-prefers-reduced-motion', $assets->get_cached_asset( '/js/prefersReducedMotion.js' ), array(), null, array( 'strategy' => 'defer' ) );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\scripts', 10 );

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

/**
 * Add custom styles to WP blocks.
 *
 * @see register_block_style
 */
function register_block_styles() {
	// Enter any custom block style variants here using register_block_style.
}
add_action( 'init', __NAMESPACE__ . '\\register_block_styles' );

/**
 * Re-add customiser for block theme to allow changing of certain settings.
 */
add_action( 'customize_register', '__return_true' );

/**
 * Add custom image sizes
 */
function add_custom_image_size() {
	// Enter any custom image sizes here using add_image_size.
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\\add_custom_image_size' );
/**
 * Show custom sizes in the size dropdown in the core image block
 *
 * @param array $sizes The existing image sizes.
 */
function core_image_size_options( $sizes ) {
		return array_merge(
			$sizes,
			array(
				// Add any custom image sizes to the image block here in 'slug' => __( 'display name', 'domain' ), format.
			)
		);
}
add_filter( 'image_size_names_choose', __NAMESPACE__ . '\\core_image_size_options' );

// phpcs:disable Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed,VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable
/**
 * Detect if there is a theme update
 *
 * @see https://developer.wordpress.org/reference/hooks/update_themes_hostname/
 *
 * @param array    $theme_data       Theme headers.
 * @param string   $theme_stylesheet Theme stylesheet.
 * @param string[] $locales          Installed locales to look up translations for.
 *
 * @return array|false $update {
 *     The theme update data with the latest details. Default false.
 *
 *     @type string $id           Optional. ID of the theme for update purposes, should be a URI
 *                                specified in the `Update URI` header field.
 *     @type string $theme        Directory name of the theme.
 *     @type string $version      The version of the theme.
 *     @type string $url          The URL for details of the theme.
 *     @type string $package      Optional. The update ZIP for the theme.
 *     @type string $tested       Optional. The version of WordPress the theme is tested against.
 *     @type string $requires_php Optional. The version of PHP which the theme requires.
 *     @type bool   $autoupdate   Optional. Whether the theme should automatically update.
 *     @type array  $translations {
 *         Optional. List of translation updates for the theme.
 *
 *         @type string $language   The language the translation update is for.
 *         @type string $version    The version of the theme this translation is for.
 *                                  This is not the version of the language file.
 *         @type string $updated    The update timestamp of the translation file.
 *                                  Should be a date in the `YYYY-MM-DD HH:MM:SS` format.
 *         @type string $package    The ZIP location containing the translation update.
 *         @type string $autoupdate Whether the translation should be automatically installed.
 *     }
 * }
 */
function check_for_theme_updates( $theme_data, $theme_stylesheet, $locales ) {
	// TODO: add mechanism to detect when a new version is available.
	return false;
}
add_filter( 'update_themes_atomicsmash.co.uk', __NAMESPACE__ . '\\check_for_theme_updates', 10, 3 );
// phpcs:enable Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed,VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable
