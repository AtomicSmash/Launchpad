<?php
/**
 * The search results page for the theme.
 */

?>
<?php get_header(); ?>
<div class="template-content">
	<main id="skip-link-target" class="contained">
		<h1>
			<?php
			echo esc_html(
				sprintf(
					/* translators: %s: search phrase */
					__(
						'Search results: %s',
						'launchpad'
					),
					get_search_query()
				)
			);
			?>
		</h1>
		<?php
		echo get_search_form();
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				$the_post_type = get_post_type_object( get_post_type() );
				?>
				<article <?php post_class( 'c-search-result' ); ?>>
					<div class="c-search-result__image_wrapper">
						<?php
						echo wp_kses_post(
							Launchpad\Media\get_featured_image(
								'medium',
								array(
									'loading' => 'lazy',
									'class' => 'c-search-result__image',
								)
							)
						);
						?>
					</div>
					<div class="c-search-result__content">
						<h2 class="c-search-result__title"><?php the_title(); ?><span class="c-chip c-search-result__post_type"><?php echo esc_html( $the_post_type->labels->singular_name ); ?></span></h2>
						<div class="c-search-result__excerpt"><?php the_excerpt(); ?></div>
						<a href="<?php the_permalink(); ?>" class="c-search-result__link">
							<?php
							echo wp_kses_post(
								sprintf(
									/* translators: %s: "more" for visual users or the post title for screen readers */
									__(
										'Read %s',
										'launchpad'
									),
									'<span class="screen-reader-text">' . get_the_title() . '</span><span aria-hidden="true">' . _x( 'more', 'one part of "Read more"', 'launchpad' ) . '</span>'
								)
							);
							?>
						</a>
					</div>
				</article>
				<?php
			endwhile;
			the_posts_pagination();
		else :
			get_template_part( 'parts/no-results', 'search' );
		endif;
		?>
	</main>
</div>
<?php get_footer(); ?>
