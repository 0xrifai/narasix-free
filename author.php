<?php
/**
 * The template for displaying author pages
 */

// Get theme options.
$post_listing_args = narasix_get_post_listing_args();

// Display user profile box.
$author_bio = get_the_author_meta( 'description' );
if ( ( $author_bio === '' ) && is_single() ) {
	return; // do not display author box on single page if there's no bio set.
}
$author_id = get_the_author_meta( 'ID' );
$author_name = get_the_author_meta( 'display_name', $author_id );
$author_post_counts = count_user_posts( $author_id );

// Setting up variables
$section_class = 'section w-full post-listing-section-' . $post_listing_args['post_layout'];

get_header();
?>

<div id="primary" class="content-area">
	<header class="bg-charcoal-100 dark:bg-charcoal-700/70 mb-6">
		<div class="max-w-7xl lg:px-16 mx-auto px-4 lg:px-16 py-4">
			<div class="flex flex-col flex-wrap py-8 sm:flex-row">
				<div class="flex-1">
					<div class="sm:flex-no-wrap mb-3 flex flex-wrap justify-center sm:flex-row sm:justify-between">
						<div class="mb-4 flex w-full text-center sm:text-left flex-wrap md:mb-0 md:w-auto">
							<h2 class="mt-4 w-full text-2xl sm:mt-0 font-semibold">
								<?php echo esc_html( $author_name ); ?>
							</h2>
							<?php
								if ( $author_post_counts > 0 ) {
								?>
									<span class="w-full">
										<?php echo esc_html__( 'Posts created: ', 'narasix-free' ) ?><?php echo esc_html( $author_post_counts ); ?>
									</span>
								<?php
								}
							?>
						</div>
					</div>
					<p class="px-4 leading-normal sm:px-0">
						<?php echo esc_html( $author_bio ); ?>
					</p>
				</div>
			</div>
		</div>
	</header>
	<?php
    if ( in_array( $post_listing_args['post_layout'], array( 'list-landscape' ) ) ) {
		?>
			<div class="max-w-7xl lg:px-16 mx-auto px-4 lg:px-16">
				<div class="relative grid grid-cols-12 gap-6 mx-auto">
					<main class="flex flex-col col-span-12 lg:col-span-8 lg:h-auto">
						<section class="<?php echo esc_attr( $section_class ); ?>">
						<?php
							if ( have_posts() ) {
								narasix_post_listing( $post_listing_args );
							} else {
								echo esc_html__( 'Nothing Found', 'narasix-free' );
							}
						?>
						</section>
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
	} ?>

</div><!-- #primary -->

<?php
get_footer();