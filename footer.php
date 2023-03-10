<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 */

?>
	</div>
		<div class="site-footer py-2 mt-8 bg-charcoal-200 dark:bg-charcoal-900">
			<footer class="max-w-7xl mx-auto px-4 lg:px-16">
				<?php get_template_part( 'template-parts/footer/footer-layout' ); ?>
			</footer>
		</div>
	</div><!-- .site-container -->
	<?php get_template_part( 'template-parts/header/component/navigation-canvas' ); ?>
	<?php if ( is_single() ) {
		get_template_part( 'template-parts/single/component/social-share' );
	} ?>
	<?php get_template_part( 'template-parts/header/component/header-search' ); ?>
	
	<button class="js-nsix-back-top-btn hidden lg:block bg-charcoal-100 dark:bg-charcoal-700 shadow-lg nsix-back-to-top"><span class="sr-only"><?php echo esc_html__( 'Back to top', 'narasix-free' ); ?></span><?php echo narasix_svg_icon( array( 'icon' => 'arrow-up' ) ); ?></button>
</div><!-- .site -->

<div class="overlay modal-close"></div>

<?php wp_footer(); ?>

</body>
</html>