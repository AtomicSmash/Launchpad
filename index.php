<?php
/**
 * The index file for the theme.
 */

?>
<?php get_header(); ?>
<div class="template-content">
	<main id="skip-link-target" class="flow is-layout-constrained has-global-padding">
		<?php
		while ( have_posts() ) {
			the_post();
			the_content();
		}
		?>
	</main>
</div>
<?php get_footer(); ?>
