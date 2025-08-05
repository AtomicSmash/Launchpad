<?php
/**
 * Title: Header
 * Slug: launchpad/header
 * Categories: header
 * Block Types: core/template-part/header
 * Description: Site header with site title and navigation.
 */

?>
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group">
	<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group">
		<!-- wp:site-logo /-->

		<!-- wp:template-part {"slug":"navigation","theme":"launchpad","area":"uncategorized"} /-->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
