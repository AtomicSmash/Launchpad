<?php
/**
 * Assets class
 */

namespace Launchpad;

/**
 * Get assets from launchpad theme.
 */
class Assets extends \AtomicSmash\CompilerHelpers\Assets {
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->context_folder = realpath( __DIR__ . '/../' );
		parent::__construct();
	}
}
