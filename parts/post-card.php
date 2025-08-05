<?php
/**
 * Template part: Post card
 */

namespace Launchpad\TemplateParts\PostCard;

$kind_of_post = \Launchpad\Helpers\get_primary_term( 'category' );
$parent_term = $kind_of_post;
while ( $parent_term && 0 !== $parent_term->parent ) {
	$parent_term = get_term( $parent_term->parent, 'category' );
}

$show_author = apply_filters( 'launchpad_show_author_on_post_card', true ); // display author at bottom of card
if ( ! is_bool( $show_author ) ) {
	$show_author = true;
}

?>

<article <?php post_class( 'c-archive-post' ); ?>>
	<?php
	if ( $parent_term ) :
		echo wp_kses_post( \Launchpad\Components\Chip\render( $parent_term->name, $parent_term->slug . ' c-archive-post__primary-category' ) );
		endif;
	?>
	<div class="c-archive-post__image_wrapper">
		<?php
		echo wp_kses_post(
			\Launchpad\Media\get_featured_image(
				'large',
				array(
					'loading' => 'lazy',
					'class' => 'c-archive-post__image',
				)
			)
		);
		?>
	</div>
	<div class="c-archive-post__content">
		<p class="c-archive-post__date"><?php echo get_the_date(); ?></p>
		<h2 class="c-archive-post__title"><?php the_title(); ?></h2>
		<div class="c-archive-post__excerpt"><?php the_excerpt(); ?></div>
	</div>
	<a href="<?php the_permalink(); ?>" class="c-archive-post__link">
			<?php
			echo wp_kses_post(
				sprintf(
					/* translators: %s: "post" for visual users or the post title for screen readers */
					__(
						'Read %s',
						'launchpad'
					),
					'<span class="screen-reader-text">' . get_the_title() . '</span><span aria-hidden="true">' . _x( 'post', 'one part of "Read post"', 'launchpad' ) . '</span>'
				)
			);
			?>
		</a>
		<?php if ( $show_author ) : ?>
		<div class="c-archive-post__meta_wrapper">
			<div class="post_meta">
				<?php get_template_part( 'parts/author-byline' ); ?>
			</div>
		</div>
		<?php endif; ?>
</article>
