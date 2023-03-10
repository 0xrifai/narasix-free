<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 */

// Get theme options.
$post_listing_args = narasix_get_post_listing_args();
$sidebar = narasix_get_option( 'blog_sidebar', 'nsix-default' );



get_header();

?>

<div id="primary" class="content-area">

<?php	
	if ( have_posts() ) {
	    if ( in_array( $post_listing_args['post_layout'], array( 'list-landscape' ) ) ) {
		?>
			<div class="max-w-7xl mx-auto px-4 lg:px-16">
				<?php get_template_part( 'template-parts/page/header/page-header' ); ?>
				<div class="relative grid grid-cols-12 gap-6 mx-auto">
					<main class="flex flex-col col-span-12 lg:col-span-8 lg:h-auto">
						<section class="<?php echo esc_attr( $section_class ); ?>">
							<?php
								narasix_post_listing( $post_listing_args );
							?>
						</section>
					</main><!-- #main -->

					<aside class="col-span-12 mt-6 lg:mt-0 flex flex-col lg:col-span-4 sidebar js-nsix-sticky-sidebar">
							<?php
							
							echo '<div class="theiaStickySidebar">';
							
							if ( is_active_sidebar( 'nsix-default' ) ) {
									dynamic_sidebar( 'nsix-default' );
							} elseif ( current_user_can( 'administrator' ) ) {
								global $wp_registered_sidebars;
								$sidebar_name = $wp_registered_sidebars['nsix-default']['name'];
								echo '<p style="padding: 32px;background-color:#f5f5f5;">';
								printf(
									/* translators: 1: sidebar's name */
								esc_html__( 'Place widgets in %1$s widget area to make them appear here', 'narasix-free' ), $sidebar_name
								);
								echo '</p>';
							}
							echo '</div>';
							?>
					</aside>
				</div>
			</div>
    <?php
		}
	} 
?>

</div><!-- #primary -->

<?php
get_footer();