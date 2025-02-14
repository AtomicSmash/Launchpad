<?php
/**
 * The header file for the theme.
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo esc_html( wp_get_document_title() ); ?></title>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<a class="skip-link screen-reader-text" href="#skip-link-target">Skip to content</a>
	<div class="site-blocks">
		<header id="header" role="banner" class="site-header is-layout-constrained has-global-padding">
			<?php block_template_part( 'header' ); ?>
		</header>
