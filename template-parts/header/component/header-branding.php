<?php
/**
 * Display header branding
 */
?>

<div class="site-branding">

	<?php if ( has_custom_logo() ) { ?>

		<div id="logo" class="site-branding site-branding-image">
			<?php the_custom_logo(); ?>
		</div><!-- #logo -->

	<?php } ?>

	<?php if (display_header_text()==true) { ?>

		<div class="site-title-desc">

			<div class="site-branding site-branding-text <?php if (empty(get_bloginfo('description'))) { echo 'no-desc'; } ?>">
				<h1><a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo('name'); ?></a></h1>
			</div><!-- .site-title -->	

			<div class="site-description">
				<?php bloginfo('description'); ?>
			</div><!-- .site-desc -->

		</div><!-- .site-title-desc -->

	<?php } ?>

</div><!-- .site-branding -->		