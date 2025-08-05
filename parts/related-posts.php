<?php
/**
 * Template part: Displays the related posts
 */

?>

<?php
		$related_posts_query = new WP_Query(
			array(
				'posts_per_page' => 3,
				'post_type' => get_post_type(),
				'post__not_in' => array( get_the_ID() ),
			)
		);

		if ( $related_posts_query->have_posts() ) :
			?>
			<div class="related_posts_wrapper is-layout-constrained has-global-padding">
				<h2 class="related_posts_title">
					<?php echo esc_html__( 'You might also be interested in', 'launchpad' ); ?>
				</h2>
				<div class="related_posts">
					<?php
					while ( $related_posts_query->have_posts() ) :
						$related_posts_query->the_post();
						get_template_part( 'parts/post-card' );
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			</div>
			<?php
		endif;
		?>
