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
		get_template_part( 'parts/post-card', get_post_type() );
		endwhile;
	?>
	</section>
	<?php
	the_posts_pagination();
else :
	get_template_part( 'parts/no-results', get_post_type() );
endif;
?>
