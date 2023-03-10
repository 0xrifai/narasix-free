<?php
/**
 * The header for the theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class('antialiased'); ?>>
<div id="nsix-site">
	<div class="site-container">
		<a class="skip-link sr-only" href="#content"><?php esc_html_e( 'Skip to content', 'narasix' ); ?></a>

		<header id="masthead" class="site-header">
			<?php get_template_part( 'template-parts/header/header-layout' ); ?>
		</header>

	<?php get_template_part( 'template-parts/header/header-sticky' ); ?>

		<div class="site-content">