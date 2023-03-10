<?php
/**
 * The template for displaying all single posts
 */

get_header();
?>
<div id="primary" class="content-single">
	<?php
	/* Start the Loop */
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post(); ?> 
				<div class="max-w-7xl mx-auto lg:px-16 lg:mt-6">
					<div class="relative grid grid-cols-12 gap-6 mx-auto pb-6">
						<div class="single-with-sidebar flex flex-col col-span-12 lg:col-span-8 lg:h-auto lg:pr-2">
							<?php
								narasix_get_template_part( 'template-parts/single/header/single-header-thumbnail' );
							?>
							<div class="px-4 mt-6">
								<?php narasix_get_template_part( 'template-parts/single/content'); ?>
							</div>
							<div class="max-lg:px-4 mt-4 border-t pt-4">

								<?php
									// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || get_comments_number() ) {
									?>
										<?php comments_template(); ?>
									<?php
									}
								?>
							</div>
						</div>
						<aside class="col-span-12 mt-6 lg:mt-0 max-lg:px-4 flex flex-col lg:col-span-4 sidebar js-nsix-sticky-sidebar">

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

