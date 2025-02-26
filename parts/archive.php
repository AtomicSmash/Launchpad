<?php
/**
 * The template for displaying default queried posts on archive pages
 */

$description = get_the_archive_description();

the_archive_title( '<h1 class="page-title">', '</h1>' );

if ( $description ) :
	?>
	<div class="archive-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
	<?php
endif;

if ( have_posts() ) :
	?>
<section class="archive__posts">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article <?php post_class( 'c-archive-post' ); ?>>
			<div class="c-archive-post__image_wrapper">
				<?php
				echo wp_kses_post(
					Launchpad\Media\get_featured_image(
						'medium',
						array(
							'loading' => 'lazy',
							'class' => 'c-archive-post__image',
						)
					)
				);
				?>
			</div>
			<div class="c-archive-post__content">
				<h2 class="c-archive-post__title"><?php the_title(); ?></h2>
				<div class="c-archive-post__excerpt"><?php the_excerpt(); ?></div>
				<a href="<?php the_permalink(); ?>" class="c-archive-post__link">
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
	?>
	</section>
	<?php
	the_posts_pagination();
else :
	?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'launchpad' ); ?></p>
	<?php
endif;
?>
