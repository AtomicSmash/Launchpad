<?php
/**
 * Title: Transparent Header
 * Slug: launchpad/transparent-header
 * Categories: header
 * Block Types: core/template-part/header
 * Description: Site header with transparent background.
 */

?>
<!-- wp:group {"layout":{"type":"constrained"}, "className":"transparent-header"} -->
<div class="wp-block-group transparent-header">
	<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group">
		<!-- wp:site-logo /-->

		<!-- wp:template-part {"slug":"navigation","theme":"launchpad","area":"uncategorized"} /-->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
