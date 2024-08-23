<?php
/**
 * Title: Card
 * Slug: launchpad/part-card
 * Inserter: yes
 */

?>
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|normal","padding":{"top":"0","bottom":"var:preset|spacing|large","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"className":"card","layout":{"type":"default"}} -->
<div class="wp-block-group card" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:var(--wp--preset--spacing--large);padding-left:0">
	<!-- wp:image {"aspectRatio":"16/9","scale":"cover","sizeSlug":"card-image","linkDestination":"none"} -->
	<figure class="wp-block-image"><img alt=""/></figure>
	<!-- /wp:image -->

	<!-- wp:heading {"fontSize":"heading-3"} -->
	<h2 class="wp-block-heading has-heading-3-font-size">Card title</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph -->
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quis libero at dui mollis tempus at eu nunc. Integer erat massa, aliquet quis blandit eget, tempor at dui.</p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons -->
	<div class="wp-block-buttons">
		<!-- wp:button {"textColor":"white"} -->
		<div class="wp-block-button">
			<a class="wp-block-button__link has-white-color has-text-color wp-element-button" href="#">Card button</a>
		</div><!-- /wp:button -->
	</div><!-- /wp:buttons -->
</div><!-- /wp:group -->
