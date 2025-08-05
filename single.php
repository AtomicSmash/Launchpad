<?php
/**
 * The blog post article template.
 */

get_header();
while ( have_posts() ) :
	the_post();
	?>
	<div class="template-content">
		<?php get_template_part( 'parts/yoast-breadcrumbs' ); ?>
		<?php get_template_part( 'parts/post-header' ); ?>

		<main id="skip-link-target" class="flow has-global-padding is-layout-constrained single_post_main_content">
			<?php
			the_content();
			?>
		</main>
	</div>
	<?php get_template_part( 'parts/related-posts' ); ?>
	<?php
endwhile;
get_footer();
?>
