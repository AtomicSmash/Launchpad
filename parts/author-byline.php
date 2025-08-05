<?php
/**
 * Template part: Post card
 */

namespace Launchpad\TemplateParts\PostCard;

?>
<div class="post_byline">
	<div class="post_byline__author_image">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
	</div>

	<div class="post_byline__author_name">
	<?php
	$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
	$author_name = get_the_author();

	echo wp_kses_post(
		sprintf(
		/* translators: %s is the authors name */
			__(
				'Written by %s',
				'launchpad'
			),
			'<a class="post_byline__author_link" href="' . esc_url( $author_url ) . '">' . esc_html( $author_name ) . '</a>'
		)
	);
	?>
	</div>
</div>
