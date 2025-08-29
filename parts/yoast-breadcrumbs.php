<?php
/**
 * Template part: Output Yoast breadcrumbs
 */

?>

<?php if ( function_exists( 'yoast_breadcrumb' ) ) : ?>
<div class="breadcrumbs__wrapper is-layout-constrained has-global-padding">
	<div class="yoast_breadcrumbs__container">
		<?php yoast_breadcrumb( '<p id="breadcrumbs" class="yoast-breadcrumbs">', '</p>' ); ?>
	</div>
</div>
<?php endif; ?>
