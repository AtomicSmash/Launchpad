<?php
/**
 * The footer file for the theme.
 */

	$menu_locations = get_nav_menu_locations();

	$footer_navigation_1_name = '';
	$footer_navigation_2_name = '';
	$footer_navigation_3_name = '';

if ( has_nav_menu( ( 'footer_navigation_1' ) ) ) {
	$footer_navigation_1 = get_term( $menu_locations['footer_navigation_1'], 'nav_menu' );
	$footer_navigation_1_name = $footer_navigation_1->name;
}

if ( has_nav_menu( ( 'footer_navigation_2' ) ) ) {
	$footer_navigation_2 = get_term( $menu_locations['footer_navigation_2'], 'nav_menu' );
	$footer_navigation_2_name = $footer_navigation_2->name;
}

if ( has_nav_menu( ( 'footer_navigation_3' ) ) ) {
	$footer_navigation_3 = get_term( $menu_locations['footer_navigation_3'], 'nav_menu' );
	$footer_navigation_3_name = $footer_navigation_3->name;
}
?>

		<footer id="footer" role="contentinfo" class="site-footer footer">
			<div class="footer__row">
				<div class="footer__column">
					<div>
						<?php if ( has_custom_logo() ) : ?>
							<div class="is-default-size wp-block-site-logo">
								<div class="footer__site-logo"><?php the_custom_logo(); ?></div>
							</div>
						<?php endif; ?>
						<div class="footer__socials">
							<?php block_template_part( 'socials' ); ?>
						</div>
					</div>
					<a href="#top" class="footer__back-to-top">Back to top</a>
				</div>
				<nav class="footer__navigation">
					<?php if ( has_nav_menu( 'footer_navigation_1' ) ) : ?>
						<div class="footer__navigation-group">
							<h3 class="footer__navigation-heading"><?php echo esc_html( $footer_navigation_1_name ); ?></h3>
							<ul class="footer__navigation-list footer__navigation-list--one">
								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'footer_navigation_1',
										'items_wrap'     => '%3$s',
										'container'      => false,
										'depth'          => 1,
										'link_before'    => '<span>',
										'link_after'     => '</span>',
										'fallback_cb'    => false,
									)
								);
								?>
							</ul>
						</div>
					<?php endif; ?>

					<?php if ( has_nav_menu( 'footer_navigation_2' ) ) : ?>
						<div class="footer__navigation-group">
						<h3 class="footer__navigation-heading"><?php echo esc_html( $footer_navigation_2_name ); ?></h3>
							<ul class="footer__navigation-list footer__navigation-list--two">
								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'footer_navigation_2',
										'items_wrap'     => '%3$s',
										'container'      => false,
										'depth'          => 1,
										'link_before'    => '<span>',
										'link_after'     => '</span>',
										'fallback_cb'    => false,
									)
								);
								?>
							</ul>
						</div>
					<?php endif; ?>

					<?php if ( has_nav_menu( 'footer_navigation_3' ) ) : ?>
						<div class="footer__navigation-group">
						<h3 class="footer__navigation-heading"><?php echo esc_html( $footer_navigation_3_name ); ?></h3>
							<ul class="footer__navigation-list footer__navigation-list--three">
								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'footer_navigation_3',
										'items_wrap'     => '%3$s',
										'container'      => false,
										'depth'          => 1,
										'link_before'    => '<span>',
										'link_after'     => '</span>',
										'fallback_cb'    => false,
									)
								);
								?>
							</ul>
						</div>
					<?php endif; ?>
				</nav>
			</div>
			<div class="footer__full-width-row">
				<div class="footer__full-width-row-container">
					<div class="footer__logos">
						<?php block_template_part( 'footer-logos' ); ?>
					</div>
					<div class="footer__details">
						<p>©Launchpad <?php echo esc_html( gmdate( 'Y' ) ); ?></p>
						<span>Website built by <a href="https://atomicsmash.co.uk/" target="_blank">Atomic Smash</a></span>
					</div>
				</div>
			</div>
		</footer>
	</div><!-- .site-blocks /-->
	<?php wp_footer(); ?>
</body>
</html>
