<?php
/**
 * Theme setup
 */

namespace Launchpad\Updates;

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
