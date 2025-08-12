<?php
/**
 * Template part: Displays the post header
 */

namespace Launchpad\TemplateParts\PostHeader;

$show_author = apply_filters( 'launchpad_show_author_on_post_header', true ); // display author in header next to date
if ( ! is_bool( $show_author ) ) {
	$show_author = true;
}

?>

<div class="post_header">
	<div class="post_header__container">
		<div class="post_header__inner-container">
			<div class="post_header__background"></div>
			<div class="post_header__content-wrapper">
				<div class="post_header__content">
					<div class="post_header__body">

						<?php
						echo wp_kses_post(
							\LaunchpadBlocks\Blocks\ToPHP\render_block(
								'core/buttons',
								array(),
								array(
									\LaunchpadBlocks\Blocks\ToPHP\get_block_comment(
										'core/button',
										array(
											'url' => get_post_type_archive_link( get_post_type() ),
											'text' => __( 'Back to archive', 'launchpad' ),
											'className' => 'is-style-outline is-style-outline--1',
										)
									),
								)
							)
						);
						?>

						<?php
						$categories = get_categories(
							array(
								'orderby' => 'name',
								'parent'  => 0,
							)
						);
						?>
						<?php if ( $categories ) : ?>
							<ul class="post_header__categories_list">
							<?php foreach ( $categories as $category ) : ?>
								<?php
								$category_link = sprintf(
									'<a href="%1$s">%2$s</a>',
									get_category_link( $category->term_id ),
									\Launchpad\Components\Chip\render( $category->name )
								);
								?>

							<li class="post_header__categories_list_item"><?php echo wp_kses_post( $category_link ); ?></li>
						<?php endforeach; ?>
						</ul>
						<?php endif; ?>
						<h1 class="post_header__title"><?php the_title(); ?></h1>

						<div class="post_meta">
							<?php if ( $show_author ) : ?>
								<?php get_template_part( 'parts/author-byline' ); ?>
							<?php endif; ?>
							<div class="post_meta__date">
									<?php
									get_the_date();
									echo esc_html( get_the_date() );
									?>
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="post_header__image_wrapper">
				<?php echo wp_kses_post( \Launchpad\Media\get_featured_image( 'full', array( 'class' => 'post_header__featured_image' ) ) ); ?>
			</div>
		</div>
	</div>
</div>
