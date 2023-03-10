<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 */
get_header();
?>
<div id="primary" class="content-area">
	<?php
	/* Start the Loop */
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			?>
				<div class="max-w-7xl mx-auto px-4 lg:px-16">
					<?php get_template_part( 'template-parts/page/header/page-header' ); ?>
					<div class="relative grid grid-cols-12 gap-6 mx-auto">
						<main class="flex flex-col col-span-12 lg:col-span-8 lg:h-auto">
							<?php get_template_part( 'template-parts/page/content'); ?>
						</main>
						<aside class="col-span-12 mt-6 lg:mt-0 flex flex-col lg:col-span-4 sidebar js-nsix-sticky-sidebar">
							<?php
								if ( is_active_sidebar( 'nsix-default' ) ) {
										dynamic_sidebar( 'nsix-default' );
								}
							?>
						</aside>
					</div>
				</div>
			<?php
		}
	}; // End of the loop.
	?>
</div><!-- #primary -->

<?php get_footer();