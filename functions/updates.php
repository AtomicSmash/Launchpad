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
 * @param array<string,mixed>|false $update           The update data.
 * @param array<string,mixed>       $theme_data       Theme headers.
 * @param string                    $theme_stylesheet Theme stylesheet.
 * @param string[]                  $locales          Installed locales to look up translations for.
 *
 * @return array{id:string,theme:string,version:string,url:string,package:string,tested:string,requires_php:string,autoupdate:bool,translations:array{language:string,version:string,updated:string,package:string,autoupdate:bool}}|false $update The theme update data with the latest details. Default false.
 */
function check_for_theme_updates( array|false $update, array $theme_data, string $theme_stylesheet, array $locales ): array|false {
	// TODO: add mechanism to detect when a new version is available.
	return false;
}
add_filter( 'update_themes_atomicsmash.co.uk', __NAMESPACE__ . '\\check_for_theme_updates', 10, 4 );
// phpcs:enable Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed,VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable
