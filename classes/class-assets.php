<?php
/**
 * Assets class
 */

namespace Launchpad\Enqueue;

use WP_Error;

/**
 * Assets class
 */
class Assets {
	/**
	 * The folder to find the built assets relative to the theme root.
	 *
	 * @var string
	 */
	private $theme_build_folder;
	
	/**
	 * Manifest content for the parent theme
	 *
	 * @var array
	 */
	private $parent_theme_manifest;

	/**
	 * Manifest content for the child theme
	 *
	 * @var array
	 */
	private $child_theme_manifest;

	/**
	 * Constructor
	 *
	 * @param array $args {
	 *    Optional. An array of arguments.
	 *
	 *    @type string $theme_build_folder The folder to find the built assets relative to the theme root. Default '/dist'.
	 * }
	 */
	public function __construct( $args = array() ) {
		$default_args = array(
			'theme_build_folder' => '/dist',
		);
		$args = array_merge( $default_args, $args );
		$this->theme_build_folder = $args['theme_build_folder'];
		$this->parent_theme_manifest = file_exists( get_parent_theme_file_path( 'dist/mix-manifest.json' ) ) ? wp_json_file_decode(
			get_parent_theme_file_path( $this->theme_build_folder . '/mix-manifest.json' ),
			array(
				'associative' => true,
			)
		) : array();
		$this->child_theme_manifest = file_exists( get_theme_file_path( 'dist/mix-manifest.json' ) ) ? wp_json_file_decode(
			get_theme_file_path( $this->theme_build_folder . '/mix-manifest.json' ),
			array(
				'associative' => true,
			)
		) : array();
	}
	/**
	 * Get cached asset
	 *
	 * Gets the filename of a cached asset from the manifest file. This function will search for an entry in the child theme manifest first, falling back to the manifest in the parent theme, and returning an error if it's not found in either.
	 *
	 * @param String $filename Name of the file in the manifest.
	 * @param array  $args {
	 *     Optional. An array of arguments.
	 *
	 *     @type bool $query    Whether to include the query parameter in the returned value. Default false. Accepts true,false.
	 *     @type bool $relative Whether to return the file in a theme folder relative format. Default false. Accepts true,false.
	 * }
	 * @return String Cached file name
	 */
	public function get_cached_asset( string $filename, $args = array() ) {
		$default_args = array(
			'query' => false,
			'relative' => false,
		);
		$args = array_merge( $default_args, $args );
		if ( empty( $this->child_theme_manifest[ $filename ] ) ) {
			return $this->get_cached_asset_from_parent( $filename );
		}
		$asset = $this->child_theme_manifest[ $filename ];
		if ( false === $args['query'] && str_contains( $asset, '?' ) ) {
			// Remove query parameters.
			$asset = explode( '?', $asset )[0];
		}
		return $args['relative'] ? $this->theme_build_folder . $asset : get_theme_file_uri( $this->theme_build_folder . $asset );
	}

	/**
	 * Get cached asset from the parent theme.
	 *
	 * Gets the filename of a cached asset from the parent theme manifest file.
	 *
	 * @param String $filename Name of the file in the manifest.
	 * @param array  $args {
	 *     Optional. An array of arguments.
	 *
	 *     @type bool $query    Whether to include the query parameter in the returned value. Default false. Accepts true,false.
	 *     @type bool $relative Whether to return the file in a theme folder relative format. Default false. Accepts true,false.
	 * }
	 * @return String Cached file name
	 */
	public function get_cached_asset_from_parent( string $filename, $args = array() ) {
		$default_args = array(
			'query' => false,
			'relative' => false,
		);
		$args = array_merge( $default_args, $args );
		if ( empty( $this->parent_theme_manifest[ $filename ] ) ) {
			return new WP_Error( 'enqueued_file_missing', __( 'The cached asset you were looking for is not in the manifest. Ensure you have spelled it correctly.', 'launchpad' ) );
		}
		$asset = $this->parent_theme_manifest[ $filename ];
		if ( false === $args['query'] && str_contains( $asset, '?' ) ) {
			// Remove query parameters.
			$asset = explode( '?', $asset )[0];
		}
		return $args['relative'] ? $this->theme_build_folder . $asset : get_parent_theme_file_uri( $this->theme_build_folder . $asset );
	}

	/**
	 * Create and echo a JS script tag with the contents of our manifests so our JS files can access cached files.
	 *
	 * Example:
	 * ```
	 * add_action( 'wp_footer', array( $assets, 'output_manifest_file_for_js' ), 10 );
	 * ```
	 */
	public function output_manifest_file_for_js() {
		printf(
			'<script type="text/javascript">var cachedFileManifests = %s</script>',
			wp_json_encode(
				array(
					'parent_theme_manifest' => $this->parent_theme_manifest,
					'child_theme_manifest' => $this->child_theme_manifest,
				)
			)
		);
	}
}
